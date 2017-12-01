@extends('layouts.app')

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel panel-heading">
			<h4>Create your award</h4>
		</div>
		<div class="panel panel-body">
			<form action="{{ route('awards.store') }}" method="POST" enctype='multipart/form-data'>
				{{ csrf_field() }}
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" class="form-control" placeholder="Your title...." value="" required />
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" name="image" id="image" class="form-control" required />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
