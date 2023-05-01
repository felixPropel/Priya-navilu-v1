@extends('layouts.app')
@section('content')

<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
      <a href="{{route('addRoles')}}"><button type="button" class="btn btn-xs btn-success">+ ADD</button></a>
        <div class="row">
                        <div class="col-md-12">
                            <div class="card card-topline-aqua">
                               
                                <div class="card-body ">
               
                                    <table id="example1" class="display" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Roles</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($role_master as $key=>$p)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$p->role_name}}</td>
                                                <td >
                                                <a href="{{route('editRoles',['id'=>$p->id])}}"><button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button"><i class="fa fa-pencil"></i> Edit</button></a>
                                                <button class="btn btn-xs btn-danger dropdown-toggle no-margin" data-type="confirm" type="button" onclick="delete_item(<?php echo $p->id;?>);"><i class="fa fa-trash"></i> Delete</button>
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
                    url: "{{route('deleteRoles')}}",
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
                        'Role has been deleted.',
                        'success'
                    );

                }
            }
        });
    }


    function approve_item(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to approve!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
        }).then(isConfirmed => {
            if (isConfirmed.value) {
                $.ajax({
                    url: "{{route('approvePost')}}",
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
                        'Approved!',
                        'Post has been Approved.',
                        'success'
                    );

                }
            }
        });
    }
</script>