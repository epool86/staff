@extends('layouts.master')

@section('title')
All My Leaves
@endsection

@section('header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All My Leaves</h1>
    <a href="{{ route('staff.application.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> 
        Apply Leave
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
                        <td>Leave Type</td>
                        <td>Date From</td>
                        <td>Date To</td>
                        <td>Remark</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    @php($i = 0)
                    @foreach($applications as $application)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $application->leave->name }}</td>
                        <td>{{ $application->date_from }}</td>
                        <td>{{ $application->date_to }}</td>
                        <td>{{ $application->date_from }}</td>
                        <td>{{ $application->remark }}</td>
                        <td>
                            @if($application->status == 0)
                                Pending
                            @elseif($application->status == 1)
                                Approved
                            @else
                                Rejected
                            @endif
                        </td>
                        <td>      
                            <button type="button" class="btn btn-sm btn-danger btn-confirm" 
                            data-id="{{ $application->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                            <a href="{{ route('staff.application.edit', $application->id) }}" class="btn btn-sm btn-primary">
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

            $('#form-delete').attr('action', "application/"+id).submit();

          }
        });

    });


</script>
@endsection