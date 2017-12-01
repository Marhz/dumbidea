@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-md-8">
			@foreach ($awards as $award)
				<div class="card mb-5">
					<div class="card-header">
						<h4>{{ $award->title }}</h4>
					</div>
					<div class="card-body">
						<img src="{{ $award->image }}" alt="{{ $award->title }}">
					</div>
				</div>			
			@endforeach
		</div>
		<div class="col-md-4">
			.
		</div>
	</div>
</div>
@endsection
