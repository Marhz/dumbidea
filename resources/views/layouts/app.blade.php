<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" async defer>
	<script>
        window.App = {!! json_encode([
            'user' => auth()->user(),
            'guest' => auth()->guest()
        ]) !!}
    </script>
    <style>
		[v-cloak] {
			display: none;
		}
	</style>
</head>

<body>
	<div id="app">
		<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Laravel') }}
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
					<ul class="navbar-nav">
						@if (Auth::guest())
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
						@else                         
                            @can('create', App\Award::class)
                                <li class="nav-item flex">
                                    <a href="{{ route('awards.create') }}">
                                        <button class="btn btn-success">New award</button>
                                    </a>
                                </li>
                            @else
                                <v-countdown v-cloak inline-template class="nav-item flex" timestamp="{{ auth()->user()->nextAvailableAward() * 1000 }}">
                                    <div class="flex">
                                        <div v-if="!done" class="countdown">
                                            @{{ format(remaining.hours) }}:@{{ format(remaining.minutes) }}:@{{ format(remaining.seconds) }}
                                        </div>
                                        <a href="{{ route('awards.create') }}" class="ml-2">
                                            <button class="btn btn-success" :disabled="!done">New award</button>
                                        </a>
                                    </div>
                                </v-countdown>
                        @endif
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle flex justify-content-start" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="is32x32 mr-2">
                                        <async-img src="{{ auth()->user()->avatar }}"></async-img>
                                    </div>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a href="{{ route('profile.show') }}" class="dropdown-item">Profile</a>
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
		@yield('content')
        <flash-messages :message="{{ json_encode(session('flash')) }}"></flash-messages>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
