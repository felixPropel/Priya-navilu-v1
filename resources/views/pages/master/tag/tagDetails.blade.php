@extends('layouts.app')
@section('content')

<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title"><?php echo (isset($model)) ? "Edit Tag" : "Add Tag" ?></div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Master<i class="fa fa-angle-right"></i></li>
                    <li class="active">Tag</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="card card-box">
                    <div class="card-head">


                    </div>
                    <div class="card-body " id="bar-parent">

                        <form action="{{url('tagMaster')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="id" id="id" placeholder="Enter Tag Name" value="<?php echo (isset($model)) ? $model->id : "" ?>" />


                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Tag Name</label>
                                        <input type="text" required class="form-control" name="name" id="tag" placeholder="Enter Tag Name" value="<?php echo (isset($model)) ? $model->name : "" ?>" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">
                                            <div class=""></div>
                                        </label>
                                        <button type="submit" name="submit" class="form-control btn btn-primary">submit</button>
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