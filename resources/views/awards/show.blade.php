@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-md-3 d-none d-md-flex">
			@include('awards._latest')
		</div>
		<div class="col-md-3 col-xs-12 order-md-2">
			@include('tags._list')
			@include('awards._trending')
		</div>
		<div class="col-md-6 col-xs-12 order-md-1">
			@include('awards._award', $award)
			<div class="comments">
				<v-comments :award-id="{{ $award->id }}"></v-comments>
			</div>
		</div>
	</div>
</div>
@endsection
