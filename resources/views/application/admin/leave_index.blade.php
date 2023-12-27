@extends('layouts.master')

@section('title')
Manage Leaves
@endsection

@section('header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Leaves</h1>
    <a href="{{ route('admin.leave.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> 
        Add New Leave
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <div class="card-body">

                @if(Session::has('success-msg'))
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        {{ Session::get('success-msg') }}
                    </div>
                </div>
                @endif

                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Leave Name</td>
                        <td>Description</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    @php($i = 0)
                    @foreach($leaves as $leave)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $leave->name }}</td>
                        <td>{{ $leave->description }}</td>
                        <td>
                            @if($leave->status == 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>      
                            <button type="button" class="btn btn-sm btn-danger btn-confirm" 
                            data-id="{{ $leave->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                            <a href="{{ route('admin.leave.edit', $leave->id) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
</div>

<form method="POST" id="form-delete" action="">
    <input type="hidden" name="_method" value="DELETE">
    @csrf
</form>

@endsection

@section('bottom_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">

    $('.btn-confirm').click(function (e) {

        var id = $(this).data('id');
        
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this record",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            $('#form-delete').attr('action', "leave/"+id).submit();

          }
        });

    });


</script>
@endsection