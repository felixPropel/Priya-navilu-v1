<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Roles;
use App\Models\RolesMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{

    public function Permissions()
    {
        if (auth()->user()->id) {
            $permissions = Permissions::where('active_status', 1)->get();
            return view("pages.roles.permissions", ['permissions' => $permissions]);
        } else {
            redirect('/logout');
        }
    }

    public function addPermission()
    {
        if (auth()->user()->id) {
            return view("pages.roles.add_permission");
        } else {
            redirect('/logout');
        }
    }

    public function storePermission(Request $request)
    {
        if (auth()->user()->id) {
            if ($request->submit) {
                $permission = new Permissions();
                $permission->name = $request->permission_name;
                $permission->active_status = 1;
                $permission->save();
                $permission_id = $permission->id;
                if ($permission_id > 0) {
                    return redirect('Permissions')->with('success', "Permission Added successfully.");
                } else {
                    return redirect()->back()->withErrors(['error' => ['Insert Error']]);
                }
            }
            redirect('/Permissions');
        } else {
            redirect('/logout');
        }
    }

    public function editPermission(Request $request)
    {
        $id = $request->id;
        $default = $this->get_default_permission($id);
        // dd($default);
        return view("pages.roles.edit_permission", ['id' => $id, 'default' => $default]);
    }

    public function get_default_permission($id)
    {
        $permission = DB::table('permissions as p')
            ->select('*')
            ->where('p.id', '=', $id)
            ->first();
        return $permission;
    }

    public function updatePermission(Request $request)
    {
        $id = $request->id;
        $Permissions = Permissions::where("id", $id)->update(["name" => $request->permission_name]);
        if ($Permissions > 0) {
            return redirect('Permissions')->with('success', "Permission Updated successfully.");
        }
    }

    public function deletePermission(Request $request)
    {
        $id = $request->id;
        $post_update = Permissions::where("id", $id)->update(["active_status" => 0]);
        echo json_encode($post_update);
    }


    public function Roles()
    {
        if (auth()->user()->id) {
            $permission = Permissions::where('active_status', 1)->get()->toArray();
            $roles = $this->roles_main();
            $role_master = RolesMaster::where('active_status', 1)->get();
            return view("pages.roles.roles", ['permission' => $permission, "roles" => $roles, "role_master" => $role_master]);
        } else {
            redirect('/logout');
        }
    }

    public function roles_main()
    {
        $roles = DB::table('roles as r')
            ->select('r.id', 'r.role_id', 'r.permission_id', 'r.permission_status', 'rm.role_name', 'p.name as permission_name')
            ->join('permissions as p', 'p.id', '=', 'r.permission_id')
            ->join('role_master as rm', 'rm.id', '=', 'r.role_id')
            ->where('r.active_status', '=', 1)
            ->get();
        return $roles;
    }

    public function addRoles()
    {
        if (auth()->user()->id) {
            $permission = Permissions::where('active_status', 1)->get();
            $roles = Roles::where('active_status', 1)->get();
            $role_master = RolesMaster::where('active_status', 1)->get();
            return view("pages.roles.add_roles", ['permission' => $permission, "roles" => $roles, "role_master" => $role_master]);
        } else {
            redirect('/logout');
        }
    }

    public function storeRoles(Request $request)
    {

        if (auth()->user()->id) {
            if ($request->submit) {
                $role_master = new RolesMaster();
                $role_master->role_name = $request->role_name;
                $role_master->active_status = 1;
                $role_master->is_admin = (isset($request->authlevel) ? 1 : 0);
                $role_master->save();
                $role_master_id = $role_master->id;
                if ($role_master_id > 0) {
                    foreach ($request->permission_id as $key => $permission_id) {
                        $role = new Roles();
                        $role->role_id = $role_master_id;
                        $role->permission_id = $permission_id;
                        $role->permission_status = $request->permission[$key];
                        $role->active_status = 1;
                        $role->save();
                        $role = $role->id;
                    }
                    return redirect('Roles')->with('success', "Roles Added successfully.");
                } else {
                    return redirect()->back()->withErrors(['error' => ['Insert Error']]);
                }
            }
            redirect('/Roles');
        } else {
            redirect('/logout');
        }
    }

    public function editRoles(Request $request)
    {
        $id = $request->id;
        $default = $this->get_default_roles($id);
        $permission = Permissions::where('active_status', 1)->get();
        $roles = Roles::where('active_status', 1)->get();
        $role_master = RolesMaster::where('active_status', 1)->get();
        return view("pages.roles.edit_roles", ['id' => $id, 'default' => $default, 'permission' => $permission, "roles" => $roles, "role_master" => $role_master]);
    }



    public function get_default_roles($id)
    {
        $roles = DB::table('roles as r')
            ->select('r.id', 'r.role_id', 'r.permission_id', 'r.permission_status', 'rm.role_name', 'rm.is_admin', 'p.name as permission_name')
            ->join('permissions as p', 'p.id', '=', 'r.permission_id')
            ->join('role_master as rm', 'rm.id', '=', 'r.role_id')
            ->where('r.role_id', '=', $id)
            ->get();
        return $roles;
    }

    public function updateRoles(Request $request)
    {
        //dd($request->all());
        $id = $request->id;
        $isAdmin = isset($request->authlevel) ? 1 : 0;
        $oldIsAdminValue = RolesMaster::where("id", $id)->first()->is_admin;
        if ($oldIsAdminValue != $isAdmin) {
            $authLevel = ($isAdmin) ? 9 : 8;
            $userModels = User::where("role", $id)->get();
            foreach ($userModels as $userModel) {
                $userModel->auth_level = $authLevel;
                $userModel->save();
            }
        }

        $rolemaster = RolesMaster::where("id", $id)->update(["role_name" => $request->role_name, 'is_admin' => $isAdmin]);
        if ($rolemaster > 0) {
            //$res = Roles::where('role_id', $id)->delete();
            foreach ($request->permission_id as $key => $permission_id) {
                $role = Roles::where('role_id', $id)->where('permission_id', $permission_id)->first();
                $role->role_id = $id;
                $role->permission_id = $permission_id;
                $role->permission_status = $request->permission[$key];
                $role->active_status = 1;
                $role->save();
                $role = $role->id;
            }
            return redirect('Roles')->with('success', "Roles Updated successfully.");
        }
    }

    public function deleteRoles(Request $request)
    {
        $id = $request->id;
        $post_update = RolesMaster::where("id", $id)->update(["active_status" => 0]);
        echo json_encode($post_update);
    }
}
