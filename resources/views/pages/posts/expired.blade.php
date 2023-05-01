@extends('layouts.app')
@section('content')

<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="page-bar m-0 ">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Expired</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Expired</li>
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
                                    <th>Post Date</th>
                                    <th>Post Expired Date</th>
                                    <th>Post ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $p)
                                <tr>
                                    <td>{{$p['created_at']}}</td>
                                    <td>{{$p['post_end_date']}}</td>
                                    <td>{{$p['post_id']}}</td>
                                    <td>{{$p['post_title']}}</td>
                                    <td>{{$p['category_name']}}</td>
                                    <td>{{$p['tag_name']}}</td>
                                    @if($p['force_stop_status'] == 1)
                                    <td> <span class="label label-warning">Declained</span></td>
                                    @elseif($p['force_stop_status'] == 2)
                                    <td> <span class="label label-primary">Removed</span></td>
                                    @else
                                    <td> <span class="label label-info">Expired</span></td>
                                    @endif
                                    <td>
                                        <a href="{{route('editExpiredPost',['id'=>$p['post_id']])}}"><button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button"><i class="fa fa-pencil"></i> Edit</button></a>
                                        <button class="btn btn-xs btn-danger dropdown-toggle no-margin" data-type="confirm" type="button" onclick="delete_item(<?php echo $p['post_id']; ?>);"><i class="fa fa-trash"></i> Delete</button>
                                        @if($p['force_stop_status'] == 1 ||$p['force_stop_status'] == 2)
                                        <button class="btn btn-xs  btn-warning" type="button" onclick="approve_item(<?php echo $p['post_id']; ?>,2);"><i class="fa fa-undo"></i> Relive</button>
                                        @endif
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
            var txt = "Yes Remove It!";
            var typeStatus = "Remove";
        } else if (status == 0) {
            var txt = "Yes Approve It!";
            var typeStatus = "Approve";
        }
        else {
            var txt = "Yes Undo It!";
            var typeStatus = "Undo";
        }
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Undo Post!",
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