@extends('layouts.app')
@section('content')

<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title"><?php echo (isset($model)) ? "Edit Showroom" : "Add Showroom" ?></div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Master<i class="fa fa-angle-right"></i></li>
                    <li class="active">Showroom</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="card card-box">
                    <div class="card-head">
                    </div>
                    <div class="card-body " id="bar-parent">

                        <form action="{{url('showroomMaster')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="id" id="id" placeholder="Enter Showroom Name" value="<?php echo (isset($model)) ? $model->id : "" ?>" />

                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Showroom Name</label>
                                        <input type="text" required class="form-control" name="name" id="tag" placeholder="Enter Showroom Name" value="<?php echo (isset($model)) ? $model->name : "" ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Showroom City</label>
                                        <input type="text" required class="form-control" name="city" id="tag" placeholder="Enter Showroom Name" value="<?php echo (isset($model)) ? $model->showroom_city : "" ?>" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Email_Id</label>
                                        <input type="email" required class="form-control" name="email_id" id="tag" placeholder="Enter Showroom Email_id" value="<?php echo (isset($model)) ? $model->email_id : "" ?>" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Contact Number</label>
                                        <input type="number" required class="form-control" name="number" id="tag" placeholder="Enter Showroom Number" value="<?php echo (isset($model)) ? $model->contact_number : "" ?>" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">geo Location</label>
                                        <textarea  class="form-control"  name="geolocation" rows="4" cols="50"><?php echo (isset($model)) ? $model->geo_location : "" ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Showroom Address</label>
                                        <textarea  class="form-control"  name="address" rows="4" cols="50"><?php echo (isset($model)) ? $model->showroom_address : "" ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 d-grid gap-2 col-6 mx-auto">
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