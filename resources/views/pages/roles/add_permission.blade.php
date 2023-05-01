@extends('layouts.app')
@section('content')

<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add New Post</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Permission</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Simple Form</header>

                    </div>
                    <div class="card-body " id="bar-parent">
                        <form action="{{route('storePermission')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Permission Name</label>
                                    <select  class="form-control chosen-select" name="permission_name" id="simpleFormEmail" placeholder="Enter Permission" >
                                       <option selected disabled>Choose Permission</option>
                                        <option value="Add New Post">Add New Post</option>
                                        <option value="Post on Approval">Post on Approval</option>
                                        <option value="Post on Schedule">Post on Schedule</option>
                                        <option value="Post on Site">Post on Site</option>
                                        <option value="Post on Expired">Post on Expired</option>
                                        <option value="Permissions">Permissions</option>
                                        <option value="Roles">Roles</option>
                                        <option value="Users">Users</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="simpleFormEmail"><div class=""></div></label>
                                    <button type="submit" name="submit" value="post_approve" class="form-control btn btn-primary">submit</button>
                                </div>
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
