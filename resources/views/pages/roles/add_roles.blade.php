@extends('layouts.app')
@section('content')

<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add New Role</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add Role</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Role</header>

                    </div>
                    <div class="card-body " id="bar-parent">
                        <form id="form" action="{{route('storeRoles')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Role Name</label>
                                        <input type="text" class="form-control" name="role_name" id="simpleFormEmail" placeholder="Enter Role Name" required />
                                    </div>
                                </div>


                            </div>
                            <div class="row col-md-12">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" id="" name="authlevel" value="9" class="isAdminEvent">Is Admin
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <p>Permissions</p>
                            </div>

                            <div class="row col-md-12">
                                @foreach($permission as $p)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="hidden" name="permission_id[]" value="{{$p->id}}">
                                        <input type="checkbox" id="{{$p->name}}" name="permission[]" value="1" class="permissionCheckBox">
                                        <label for="{{$p->name}}">{{$p->name}}</label><br>
                                    </div>
                                </div>
                                @endforeach
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
            $(this).find('.permissionCheckBox').prop('disabled', false);
            $(this).find('.permissionCheckBox:not(:checked)').prop('checked', true).val(0);
        });
        $('.isAdminEvent').change(function() {
            if (this.checked) {
                console.log("checked");
                $('input:checkbox').not(this).prop('checked', this.checked);
                $('input:checkbox').not(this).prop('disabled', true);
            } else {
                console.log("unchecked");
                $('input:checkbox').not(this).prop('checked', false);
                $('input:checkbox').not(this).prop('disabled', false);
            }
        });
    });
</script>