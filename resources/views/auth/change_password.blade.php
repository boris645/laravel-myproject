@extends('welcome')


@section('title', 'change password')

@section('content')

<div class="container">
        <div class="row">
	        <div class="col-md-4 mx-auto">
                <h1 class="text-center text-muted mb-3 mt-5">change password !</h1>
                <p class="text-center text-muted mb-5">please enter your new password !</p>

                <form action="{{ route('app_changepassword', ['token' => $activation_token]) }}" method="post">
                    @csrf
                    {{-- On inclus des méssages d'alerts --}}
                        @include('alerts.alert-message')

                        <label for="new-password" class="form-label">new password</label>
                        <input type="password" name="new-password" id="new-password" class="form-control mb-3" placeholder="Enter the new password">
                        
                        <label for="new-password-confirm" class="form-label">new password confirm</label>
                        <input type="password" name="new-password-confirm" id="new-password-confirm" class="form-control mb-3" placeholder="Enter the new password confirm">

                        <div class="d-grid gap-2 mt-4 mb-5">
						        <button class="btn btn-primary" type="submit">New password</button>
					        </div>
                </form>
            </div>
        </div>
</div>

@endsection