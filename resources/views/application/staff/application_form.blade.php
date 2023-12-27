@extends('layouts.master')

@section('title')
Application Details
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <div class="card-body">

                <?php 
                if($application->id){
                    $route = route('staff.application.update', $application->id);
                    $method = 'PUT';
                } else {
                    $route = route('staff.application.store');
                    $method = 'POST';
                }
                ?>
                
                <form method="POST" action="{{ $route }}">
                    <input type="hidden" name="_method" value="{{ $method }}">
                    @csrf

                    <div class="form-group">
                        <label>Leave Type</label>
                        <select name="leave_id" class="form-control @error('leave_id') input-danger @enderror">
                            @foreach($leaves as $leave)
                            <option @if(old('leave_id', $application->leave_id) == $leave->id) selected @endif 
                                value="{{ $leave->id }}">{{ $leave->name }}</option>
                            @endforeach
                        </select>
                        @error('leave_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Date From</label>
                        <input type="date" name="date_from" class="form-control @error('date_from') input-danger @enderror" value="{{ old('date_from', $application->date_from) }}">
                        @error('date_from')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Date To</label>
                        <input type="date" name="date_to" class="form-control @error('date_to') input-danger @enderror" value="{{ old('date_to', $application->date_to) }}">
                        @error('date_to')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Reason</label>
                        <textarea name="remark" class="form-control @error('remark') input-danger @enderror">{{ old('remark', $application->remark) }}</textarea>
                        @error('remark')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <a href="{{ route('staff.application.index') }}" class="btn btn-info">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection