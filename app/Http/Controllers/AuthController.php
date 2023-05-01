<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:web', ['except' => ['login_process', 'register']]);
    }

    public function login_process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return Redirect::back()->withErrors(['error' => 'Unauthorized']);
        }
        if ($this->createNewToken($token)) {
            return redirect('dashboard')->with('success', "User Added successfully.");
        }
    }

    public function register_process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors()->toJson());
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function logout()
    {

        Auth::logout();
        Cookie::forget('access_token');
        return redirect()->route('login');

        // auth()->logout();
        // return response()->json(['message' => 'User successfully signed out']);
    }


    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    public function profile()
    {
        if (auth()->user()->id) {
            $users = User::where(['id' => auth()->user()->id, 'active_status' => 1, 'auth_level' => 8])->first();
            return view("pages.users.profile", ['users' => $users]);
        } else {
            redirect('/logout');
        }
    }

    public function updateUser(Request $request)
    {
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
        } else {
            $image_name = DB::table('users')->where(['id' => auth()->user()->id])->value('profile_pic');
        }
        if ($request->password) {
            $user_update = User::where("id", auth()->user()->id)->update(["name" => $request->name, "email" => $request->email, 'profile_pic' => $image_name, 'password' => bcrypt($request->password)]);
        } else {
            $user_update = User::where("id", auth()->user()->id)->update(["name" => $request->name, "email" => $request->email, 'profile_pic' => $image_name]);
        }
        if ($user_update > 0) {
            return redirect('profile')->with('success', "User Updated successfully.");
        } else {
            return redirect()->back()->withErrors(['error' => ['Inappropriate Submisssion']]);
        }
    }



    public function login()
    {
        return view("login");
    }

    public function register()
    {
        return view("register");
    }

    public function dashboard()
    {

        $post_on_approval = Posts::where('approval_status', 0)->where('force_stop_status', 0)->count();

        // $post_on_approval = DB::table('posts as p')
        // ->select('p.id as post_id', 'p.youtube_link', 'p.post_image', 'p.title as post_title', 'category.name as category_name', 'tags.name as tag_name', 'p.approval_status')
        // ->join('post_categories', 'post_categories.post_id', '=', 'p.id')
        // ->join('post_tags', 'post_tags.post_id', '=', 'p.id')
        // ->join('category', 'category.id', '=', 'post_categories.category_id')
        // ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
        // ->where('p.status', 1)
        // ->get();
        $post_on_schedule = Posts::where('approval_status', 1)
            ->where('post_now', 0)->where('approval_status', 1)
            ->where(function ($query) {
                $query->whereDate('schedule_date', '>=', date('Y-m-d H:i:s'))
                    ->orWhereNull('schedule_date');
            })
            ->where('force_stop_status', 0)
            ->count();

        // $post_on_schedule = DB::table('posts as p')
        //     ->select('p.id as post_id', 'p.youtube_link', 'p.post_image', 'p.schedule_date', 'p.title as post_title', 'category.name as category_name', 'tags.name as tag_name', 'p.approval_status')
        //     ->join('post_categories', 'post_categories.post_id', '=', 'p.id')
        //     ->join('post_tags', 'post_tags.post_id', '=', 'p.id')
        //     ->join('category', 'category.id', '=', 'post_categories.category_id')
        //     ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
        //     ->where('p.status', 1)
        //     ->where('p.approval_status', 1)
        //     ->get();

        $post_on_site = Posts::where('approval_status', 1)
            ->where(function ($query) {
                $query->whereDate('schedule_date', '<=', date('Y-m-d H:i:s'))
                    ->orWhereNull('schedule_date');
            })
            ->where(function ($query) {
                $query->whereDate('post_end_date', '>=', date('Y-m-d H:i:s'))
                    ->orWhereNull('post_end_date');
            })
            ->where('force_stop_status', 0)
            ->count();
           





        $post_on_expired = DB::table('posts as p')
            ->select('p.id as post_id', 'p.created_at', 'p.post_end_date','p.post_type', 'p.schedule_date', 'p.title as post_title', 'category.name as category_name', 'tags.name as tag_name', 'p.approval_status')
            ->join('post_categories', 'post_categories.post_id', '=', 'p.id')
            ->join('post_tags', 'post_tags.post_id', '=', 'p.id')
            ->join('category', 'category.id', '=', 'post_categories.category_id')
            ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
            ->where('p.active_status', 1)
            ->where('p.approval_status', 1)
            ->whereDate('p.post_end_date', '<=', date('Y-m-d'))
            ->where('force_stop_status', 0)
            ->get();

        $users = User::where(['active_status' => 1, 'auth_level' => 8])->get();

        return view("welcome", ["post_on_approval" => $post_on_approval, "post_on_schedule" => $post_on_schedule, "post_on_site" => $post_on_site, "post_on_expired" => count($post_on_expired), "users" => count($users)]);
    }
}
