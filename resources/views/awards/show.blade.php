@extends('layouts.app')

@section('content')
<div class="container">
	<div class="panel panel-default award">
		<div class="panel-heading award__title flex">
			<div class="award__title-infos">
				<h4 class="no-margin">{{ $award->title }}</h4>
				<em>{{ $award->owner->name }}</em>
			</div>
			<div class="award_title-controls">
				<button>test</button>
			</div>
		</div>
		<div class="panel-body award__image flex">
			<img src="{{ asset($award->image) }}" alt="{{ $award->title }}">
		</div>
	</div>
</div>
@endsection
