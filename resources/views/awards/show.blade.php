@extends('layouts.app')

@section('content')
<div class="container">
	@include('awards._award', $award)
</div>
@endsection
