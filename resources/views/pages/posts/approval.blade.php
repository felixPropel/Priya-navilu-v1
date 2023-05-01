@extends('layouts.app')
@section('content')


<!-- end sidebar menu -->
<!-- start page content -->

<div class="page-content-wrapper">

    <div class="page-content">
        <div class="page-bar m-0">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Approval</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Approval</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-body ">
                        <table id="example1" class="display" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Post ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $p)
                                <tr>
                                    <td>{{$p['post_id']}}</td>
                                    <td>{{$p['post_title']}}</td>
                                    <td>{{$p['category_name']}}</td>
                                    <td>{{$p['tag_name']}}</td>
                                    <td>@if($p['approval_status']==1)
                                        Approved
                                        @else
                                        Waiting
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('editApprovalPost',['id'=>$p['post_id']])}}"><button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button"><i class="fa fa-pencil"></i> Edit</button></a>
                                        <!-- <button class="btn btn-xs btn-danger dropdown-toggle no-margin" data-type="confirm" type="button" onclick="delete_item(<?php echo $p['post_id']; ?>);"><i class="fa fa-trash"></i> Delete</button> -->
                                        @if($p['approval_status']!=1)
                                        <button class="btn btn-xs btn-success dropdown-toggle no-margin" type="button" onclick="approve_item(<?php echo $p['post_id']; ?>,0);"><i class="fa fa-check"></i> Approve</button>
                                        @endif
                                        <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" onclick="approve_item(<?php echo $p['post_id']; ?>,1);"><i class="fa fa-times"></i> Decline</button>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<script>
    function delete_item(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(isConfirmed => {
            if (isConfirmed.value) {
                $.ajax({
                    url: "{{route('deletePost')}}",
                    type: 'ajax',
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(result) {
                        if (result) {
                            window.location.reload();
                        }
                    }
                });
                if (isConfirmed.value) {
                    Swal.fire(
                        'Deleted!',
                        'Post has been deleted.',
                        'success'
                    );

                }
            }
        });
    }


    function approve_item(id, status) {
        if (status == 1) {
            var txt = "Yes Decline It!";
            var typeStatus = "Decline";
        } else if (status == 0) {
            var txt = "Yes Approve It!";
            var typeStatus = "Approve";
        }
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change status!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: txt
        }).then(isConfirmed => {
            if (isConfirmed.value) {
                $.ajax({
                    url: "{{route('approvePost')}}",
                    type: 'ajax',
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        typeStatus: typeStatus,
                    },
                    success: function(result) {
                        if (result) {
                            console.log(result);
                            window.location.reload();
                        }
                    }
                });
                if (isConfirmed.value) {
                    Swal.fire(
                        'Status Updated!',
                        'Post Status Changed.',
                        'success'
                    );

                }
            }
        });
    }
</script>