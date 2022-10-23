@extends('welcome')


@section('title', 'logins')

@section('content')
    
<div class="container">
		<div class="row">
			<div class="col-md-4 mx-auto">
            <h1 class="text-center text-muted mb-3 mt-5">please sign in !</h1>
				<p class="text-center text-muted mb-5">yor article are waiting for you</p>
				<form method="POST" action="{{ route('login') }}">
					{{-- ce token @csrf protegera nos champs contre des injections--}}
					@csrf

					{{-- On inclus des méssages d'alerts --}}
					@include('alerts.alert-message')

					{{-- affichage d'alerte en cas de movaise saisie de l'email ou du password--}}
					
					@error('email')
						<div class="alert alert-danger text-center" role="alert">
							{{ $message }}
						</div>
					@enderror()
					@error('password')
						<div class="alert alert-danger text-center" role="alert">
							{{ $message }}
						</div>
					@enderror()

					<label for="email" class="form-label">Email</label>
					{{-- old('email') va afficher à l'utilisateur son récent email saisie avant s'il oublit--}}
					{{-- @error is-invalid @enderror pour mettre le cadre du champ en rouge en cas d'erreur d'email --}}
					<input type="email" name="email" id="email" class="form-control mb-3 @error('email') is-invalid @enderror" value="{{old('email')}}" required autocomplete="current-email" autofocus>
					
					{{-- @error is-invalid @enderror pour mettre le cadre du champ en rouge en cas d'erreur de password --}}
					
					<label for="password" class="form-label">Password</label>
					<input type="password" name="password" id="password" class="form-control mb-3 @error('password') is-invalid @enderror" required autocomplete="current-password">

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="form-check form-switch">
  							<input class="form-check-input" type="checkbox" role="{{old('remember') ? 'checked' : ''}}" name="remember" id="remember">
  							<label class="form-check-label" for="remember">Remember me</label>
							</div>
						</div>
						<div class="col-md-6 text-right tex t-end">
							<a href="{{route('app_forgotpassword')}}">forgot password ?</a>
						</div>
					</div>
					<div class="d-grid gap-2">
						<button class="btn btn-primary" type="submit">signin</button>
					</div>
					
					<p class="text-center text-muted mt-5">
						not registered yet ?
						<a href="{{route('register')}}"> Create an account </a>
					</p>
				</form>
			</div>
		</div>
	</div>


@endsection

