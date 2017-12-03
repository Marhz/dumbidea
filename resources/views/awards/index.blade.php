@extends('layouts.app')

@section('content')
<div class="container">
	@if (isset($tag))
		<h1>{{ $tag->name }}</h1>
		<hr>
	@endif
	<div class="row justify-content-md-center">
		<div class="col-md-3">
			@include('awards._latest')
		</div>
		<div class="col-md-6">
			@foreach ($awards as $award)
				@include('awards._award', $award)
			@endforeach
		</div>
		<div class="col-md-3">
			@include('tags._list')
		</div>
	</div>
</div>
@endsection
