<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\RolesMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function users()
    {
        if (auth()->user()->id) {
            $users = User::where(['active_status' => 1])->get();
            return view("pages.users.users", ['users' => $users]);
        } else {
            redirect('/logout');
        }
    }

    public function addUser()
    {
        if (auth()->user()->id) {
            $roles = Roles::where('active_status', 1)->get();
            $role_master = RolesMaster::where('active_status', 1)->get();
            return view("pages.users.add_user", ["roles" => $roles, "role_master" => $role_master]);
        } else {
            redirect('/logout');
        }
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors()->toJson());
        }
        $authLevel = RolesMaster::where('id', $request->role)->first()->is_admin;
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->auth_level = ($authLevel) ? 9 : 8;
        $user->role = $request->role;
        $user->statuactive_status = 1;
        $user->save();
        $user_id = $user->id;

        if ($user) {
            return redirect('users')->with('success', "User Added successfully.");
        } else {
            return redirect()->back()->withErrors(['error' => ['Insert Error']]);
        }
    }

    public function editUser(Request $request)
    {
        $id = $request->id;
        $default = $this->get_default_user($id);
        $role_master = RolesMaster::where('active_status', 1)->get();
        return view("pages.users.edit_user", ['id' => $id, 'default' => $default, 'role_master' => $role_master]);
    }

    public function get_default_user($id)
    {
        $user = DB::table('users as u')
            ->select('*')
            ->where('u.id', '=', $id)
            ->first();
        return $user;
    }

    public function updateUser(Request $request)
    {
        
        $id = $request->id;
        $is_admin = RolesMaster::where('id', $request->role)->first()->is_admin;
        $authLevel = ($is_admin) ?9 : 8;
        $users = User::where("id", $id)->update(["name" => $request->name, 'email' => $request->email, 'role' => $request->role, 'auth_level' => $authLevel]);
        if ($request->password != "") {
            $user_update = User::where("id", $id)->update(["password" => bcrypt($request->password)]);
        }
        if ($users > 0) {
            return redirect('users')->with('success', "User Updated successfully.");
        }
    }

    public function deleteUser(Request $request)
    {
        $id = $request->id;
        $post_update = User::where("id", $id)->update(["status" => 0]);
        $res = User::where('id', $id)->delete();
        echo json_encode($post_update);
    }
}
