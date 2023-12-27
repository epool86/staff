@extends('layouts.master')

@section('title')
All Leave Applications
@endsection

@section('header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Leave Applications</h1>
    <a href="{{ route('admin.application.export.excel') }}?status={{ $status }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> 
        Export Excel
    </a>
</div>
@endsection

@section('content')

<style type="text/css">
    .page-link {
        font-weight: bold;
    }
</style>
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

                Total Result = {{ $total_result }}

                <form method="GET" action="{{ route('admin.application.index') }}">
                <table>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="search" value="{{ $search }}">
                        </td>
                        <td>
                            <select class="form-control" name="month">
                                <option value="ALL" @if($month == 'ALL') selected @endif>All</option>
                                <option value="1" @if($month == 1) selected @endif>Januari</option>
                                <option value="2" @if($month == 2) selected @endif>Febuari</option>
                                <option value="3" @if($month == 3) selected @endif>Mac</option>
                                <option value="4" @if($month == 4) selected @endif>April</option>
                                <option value="5" @if($month == 5) selected @endif>Mei</option>
                                <option value="6" @if($month == 6) selected @endif>June</option>
                                <option value="7" @if($month == 7) selected @endif>July</option>
                                <option value="8" @if($month == 8) selected @endif>August</option>
                                <option value="9" @if($month == 9) selected @endif>September</option>
                                <option value="10" @if($month == 10) selected @endif>October</option>
                                <option value="11" @if($month == 11) selected @endif>November</option>
                                <option value="12" @if($month == 12) selected @endif>December</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="year">
                                <option value="ALL" @if($year == 'ALL') selected @endif>All</option>
                                <option value="2023" @if($year == 2023) selected @endif>2023</option>
                                <option value="2024" @if($year == 2024) selected @endif>2024</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="status">
                                <option value="ALL" @if($status == 'ALL') selected @endif>All</option>
                                <option value="0" @if($status == 0) selected @endif>Pending</option>
                                <option value="1" @if($status == 1) selected @endif>Approved</option>
                                <option value="2" @if($status == 2) selected @endif>Rejected</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </td>
                    </tr>
                </table>
                </form>

                <br>

                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Staff Name</td>
                        <td>Leave Type</td>
                        <td>Date From</td>
                        <td>Date To</td>
                        <td>Remark</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    @php($i = 0)
                    <?php 
                        $i = ($applications->currentPage() - 1) * $applications->perPage();
                    ?>
                    @foreach($applications as $application)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $application->user->name }}</td>
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

                {!! $applications->render() !!}

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