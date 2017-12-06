@extends('layouts.app')

@section('content')
<div class="container">
	@if (isset($tag))
		<h1>{{ $tag->name }}</h1>
		<hr>
	@endif
	<div class="row justify-content-md-center">
		<div class="col-md-3 d-none d-md-flex">
			@include('awards._latest')
		</div>
		<div class="col-md-3 col-xs-12 order-md-2">
			@include('tags._list')
		</div>
		<div class="col-md-6 col-xs-12 order-md-1">
			@foreach ($awards as $award)
				@include('awards._award', $award)
			@endforeach
			{{ $awards->links() }}
		</div>
	</div>
</div>
@endsection
