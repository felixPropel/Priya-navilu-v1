@extends('layouts.app')
@section('content')

<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Permissions</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit Permissions</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="card card-box">
                    <div class="card-head">


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form action="{{route('updatePermission',['id'=>$id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Permission Name</label>
                                    <input type="text" class="form-control" name="permission_name" id="simpleFormEmail" placeholder="Enter Permission" value="{{$default->name}}" />
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
