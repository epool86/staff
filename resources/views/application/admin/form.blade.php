@extends('layouts.master')

@section('top_script')
<style type="text/css">
	.input-danger {
		border: 1px solid #FF0000;
	}
</style>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.form.submit') }}">
	@csrf

	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control @error('name') input-danger @enderror" value="{{ old('name') }}">
		@error('name')
			<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control @error('email') input-danger @enderror" value="{{ old('email') }}">
		@error('email')
			<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

	<div class="form-group">
		<label>Gender</label>
		<select name="gender" class="form-control @error('gender') input-danger @enderror">
			<option @if(old('gender') == 'male') selected @endif value="male">Male</option>
			<option @if(old('gender') == 'female') selected @endif value="female">Female</option>
		</select>
		@error('gender')
			<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>

</form>
@endsection