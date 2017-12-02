@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h4>Create your award</h4>
		</div>
		<div class="card-body">
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
					<label for="tags">Tags</label>
					{{--  <select name="tags[]" id="tags" multiple>
						@foreach($tags as $tag)
							<option value="{{ $tag->id }}">{{ $tag->name }}</option>
						@endforeach
					</select>  --}}
					{{--  <pre>{{ $tagsSelect[0] }}</pre>  --}}
					<multi-select :options="{{ $tags }}"></multi-select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
