@extends('layouts.login.app')
@section('content')

<div class="form-title">
        <h1>Login Form</h1>
    </div>
   
    <!-- Login Form-->
    <div class="login-form text-center">
        <div class="toggle"><i class="fa fa-user-plus"></i>
        </div>
        <div class="form formLogin">
            <h2>Login to your account</h2>
            @foreach( $errors->all() as $message )
          <span style="color:red;">{{ $message }}</span>
        @endforeach
            <form action="{{route('login_process')}}" method="post">
                @csrf
                <input type="text" name="email" placeholder="Username" />
                <input type="password" name="password" placeholder="Password" />
                <div class="remember text-left">
                    <div class="checkbox checkbox-primary">
                        <input id="checkbox2" type="checkbox" checked="" />
                        <label for="checkbox2">
                            Remember me
                        </label>
                    </div>
                </div>
                <button type="submit">Login</button>
                <div class="forgetPassword"><a href="javascript:void(0)">Forgot your password?</a>
                </div>
            </form>
        </div>
        <div class="form formRegister">
            <h2>Create an account</h2>
            <form action="{{route('register_process')}}" method="post">
                @csrf                
              
                <input type="text"name="name" placeholder="Full Name" />                  
                <input type="email" name="email" placeholder="Email Address" /> 
                <input type="password" name="password" placeholder="Password" />   
                <input type="password" name="password_confirmation" placeholder="confirmation Password" />           
                <button>Register</button>
            </form>
        </div>
        <div class="form formReset">
            <h2>Reset your password?</h2>
            <form />
                <input type="email" placeholder="Email Address" />
                <button>Send Verification Email</button>
            </form>
        </div>
    </div>
 @endsection