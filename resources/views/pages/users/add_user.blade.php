@extends('layouts.app')
@section('content')

<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add New User</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add User</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="card card-box">
                    <div class="card-head">
                        <header>User</header>
                        @foreach( $errors->all() as $message )
          <span style="color:red;">{{ $message }}</span>
        @endforeach
                    </div>
                    <div class="card-body " id="bar-parent">
                        <form id="form" action="{{route('storeUser')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Role</label>
                                        <select name="role" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach($role_master as $role)
                                            <option value="{{$role->id}}">{{$role->role_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password" />
                                    </div>
                                </div>
                               
                            </div>

                            

                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">
                                            <div class=""></div>
                                        </label>
                                        <button type="submit" name="submit" value="post_approve" class="form-control btn btn-primary">submit</button>
                                    </div>
                                </div>

                    </div>


                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    // when page is ready
    $(document).ready(function() {
         // on form submit
        $("#form").on('submit', function() {
            // to each unchecked checkbox
            $(this).find('input[type=checkbox]:not(:checked)').prop('checked', true).val(0);
        })
    })
</script>