@extends('layouts.app')
@section('content')

<style>
    .color-red {
    color: red;
}
</style>			
<!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper" style="background-color: white;">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <!-- <div class="page-title">Blank page</div> -->
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp; <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" row col-md-12 justify-content-around">
                          <!-- dblue -->
                          <a style="background-color:  #FFFFFF;border-top: 7px solid #c4f5c4;color: black;" href="{{route('postOnApproval')}}" class="btn btn-dblue btn-lg" role="button"><span class="color-red glyphicon glyphicon-th"></span>Post on Approval<br><br>
                          <span><i class="fa fa-check-square-o" aria-hidden="true"></i></span>&nbsp; &nbsp;<span class="color-red">{{$post_on_approval}}</span>
                           
                        </a>
                          <a style="background-color:  #FFFFFF;border-top: 7px solid #977ec4;color: black;" href="{{route('postOnSchedule')}}" class="btn btn-dblue btn-lg" role="button"><span class="color-red glyphicon glyphicon-th-large"></span>Post on Schedule<br><br>
                          <span> <i class="fa fa-calendar" aria-hidden="true"></i></span>&nbsp; &nbsp;<span class="color-red">{{$post_on_schedule}}</span></a>
                          <a style="background-color:  #FFFFFF;border-top: 7px solid #7ad6b9;;color: black;" href="{{route('postOnSite')}}" class="btn btn-dblue btn-lg" role="button"><span class="color-red glyphicon glyphicon-file"></span>Post on Site <br><br>
                          <span> <i class="fa fa-shield" aria-hidden="true"></i></span>&nbsp; &nbsp;
                          <span class="color-red">{{$post_on_site}}</span></a>
                          <a style="background-color:  #FFFFFF;    border-top: 7px solid #42cfd1;color: black;" href="{{route('postOnExpired')}}" class="btn btn-dblue btn-lg" role="button"><span class="color-red glyphicon glyphicon-time"></span> Post on Expired<br>
                          <br><span><i class="fa fa-clock-o" aria-hidden="true"></i></span>&nbsp; &nbsp;<span class="color-red">{{$post_on_expired}}</span></a>
                          <a style="background-color:  #FFFFFF;border-top: 7px solid #5984d3;color: black;" href="{{route('users')}}" class="btn btn-dblue btn-lg" role="button"><span class="color-red glyphicon glyphicon-user glyphsize"></span>Total Users<br><br>
                          <span><i class="fa fa-users" aria-hidden="true"></i></span>&nbsp; &nbsp;<span class="color-red">{{$users}}</span></a>
                        
                        </div>
                    </div>
                </div>
            </div>

@endsection