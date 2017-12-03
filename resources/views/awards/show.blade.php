@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-md-3">
			@include('awards._latest')
		</div>
		<div class="col-md-6">
			@include('awards._award', $award)
			<div class="comments">
				<h3>Comments</h3>
				<v-comments :award-id="{{ $award->id }}"></v-comments>
				<hr>
			</div>
		</div>
		<div class="col-md-3">
			@include('tags._list')
		</div>
	</div>
</div>
@endsection
