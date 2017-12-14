@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h4>Create your award</h4>
		</div>
		{{ dump($errors) }}
		<div class="card-body">
			<form action="{{ route('awards.store') }}" method="POST" enctype='multipart/form-data'>
				{{ csrf_field() }}
				<div class="form-group">
					<label for="title">Title</label>
					<input 
						type="text" 
						name="title" 
						id="title" 
						class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" 
						placeholder="Your title...." 
						value="{{ old('title') }}" 
					/>
					@if($errors->has('title'))
						@foreach($errors->get('title') as $error)
							<div class="invalid-feedback">{{ $error }}</div>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input 
						type="file" 
						name="image" 
						id="image" 
						class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" 
					/>
					@if($errors->has('image'))
						@foreach($errors->get('image') as $error)
							<div class="invalid-feedback">{{ $error }}</div>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label for="tags">Tags</label>
					<multi-select 
						:options="{{ $tags }}" 
						class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}"
					></multi-select>
					@if($errors->has('tags'))
						@foreach($errors->get('tags') as $error)
							<div class="invalid-feedback">{{ $error }}</div>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
