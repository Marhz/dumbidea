@extends('layouts.app')

@section('content')
<div class="container">
	@foreach ($awards as $award)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>{{ $award->title }}</h4>
			</div>
			<div class="panel-body">
				<img src="{{ $award->image }}" alt="{{ $award->title }}">
			</div>
		</div>
	@endforeach
</div>
@endsection
