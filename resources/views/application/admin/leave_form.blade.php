@extends('layouts.master')

@section('title')
Manage Leaves
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <div class="card-body">

                <?php 
                if($leave->id){
                    $route = route('admin.leave.update', $leave->id);
                    $method = 'PUT';
                } else {
                    $route = route('admin.leave.store');
                    $method = 'POST';
                }
                ?>
                
                <form method="POST" action="{{ $route }}">
                    <input type="hidden" name="_method" value="{{ $method }}">
                    @csrf

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name') input-danger @enderror" value="{{ old('name', $leave->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control @error('description') input-danger @enderror">{{ old('description', $leave->description) }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control @error('status') input-danger @enderror">
                            <option @if(old('status', $leave->status) == 1) selected @endif value="1">Active</option>
                            <option @if(old('status', $leave->status) == 0) selected @endif value="0">Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <a href="{{ route('admin.leave.index') }}" class="btn btn-info">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection