@extends('layouts.app')

@section('content')
<div class="container">
	@if (isset($tag))
		<h1>{{ $tag->name }}</h1>
		<hr>
	@endif

	<div class="row justify-content-md-center">
		<div class="col-md-8">
			@foreach ($awards as $award)
				@include('awards._award', $award)
			@endforeach
		</div>
		<div class="col-md-4">
			.
		</div>
	</div>
</div>
@endsection
