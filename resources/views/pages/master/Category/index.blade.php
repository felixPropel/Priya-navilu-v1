@extends('layouts.app')
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <a href="{{url('categoryMaster/create')}}"><button type="button" class="btn btn-xs btn-success">+ ADD</button></a>
        <div class="page-bar m-0">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Category</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Master<i class="fa fa-angle-right"></i></li>
                    <li class="active">Category</li>
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
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($models as $model)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$model->name}}</td>
                                    <td> <a href="{{url('categoryMaster',['id'=>$model->id])}}"><button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button"><i class="fa fa-pencil"></i> Edit</button></a>
                                    <button class="btn btn-xs btn-danger dropdown-toggle no-margin" data-type="confirm" type="button" onclick="delete_item(<?php echo $model->id; ?>);"><i class="fa fa-trash"></i> Delete</button>
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
                    url: "{{route('deletecategoryMaster')}}",
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
                        'Tag has been deleted.',
                        'success'
                    );

                }
            }
        });
    }
</script>