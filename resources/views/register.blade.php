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
            <h2>Register</h2>
            @foreach( $errors->all() as $message )
          <span style="color:red;">{{ $message }}</span>
        @endforeach
            <form action="{{route('register_process')}}" method="post">
                @csrf
                <input type="text" name="name" placeholder="Enter Name" />
                <input type="text" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <input type="password" name="password_confirmation" placeholder="Confirm Password" />
                <button type="submit">Register</button>
                </div>
            </form>
        </div>
      
    </div>
 @endsection