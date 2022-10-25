@extends('welcome')


@section('title', 'forgot password')

@section('content')



    <div class="container">
        <div class="row">
	        <div class="col-md-4 mx-auto">
            <h1 class="text-center text-muted mb-3 mt-5">forgot password !</h1>
				<p class="text-center text-muted mb-5">please enter your email address. we will send you a link to reset yor password !</p>
                <form method="POST" action="{{route('app_forgotpassword')}}">
                    @csrf
                    
                        {{-- On inclus des méssages d'alerts --}}
                        @include('alerts.alert-message')
                        <label for="email-send" class="form-label">Email</label>
                        <input type="email" name="email-send" id="email-send" class="form-control @error('email-error') is-invalid @enderror" placeholder="please enter your email address" value="@if(Session::has('old_email')) {{ Session::get('old_email') }} @endif" required>
                        
                            <div class="d-grid gap-2 mt-4 mb-5">
						        <button class="btn btn-primary" type="submit">Reset password</button>
					        </div>
					        
                            <p class="text-center text muted">Back to login <a href="{{route('login')}}">login</a></p>
                </form>

            </div>
        </div>
    </div>

@endsection