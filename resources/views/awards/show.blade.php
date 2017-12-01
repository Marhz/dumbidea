@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card award">
		<div class="card-header award__title flex">
			<div class="award__title-infos">
				<h4 class="no-margin">{{ $award->title }}</h4>
				<em>by {{ $award->owner->name }}</em>
			</div>
			<div class="award_title-controls">
				<button>test</button>
			</div>
		</div>
		<div class="card-body award__image flex">
			<img src="{{ asset($award->image) }}" alt="{{ $award->title }}">
		</div>
	</div>
</div>
@endsection
