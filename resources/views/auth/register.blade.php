@extends('welcome')


@section('title', 'registers')

@section('content')
    <div class="container">
    	<div class="row">
    		<div class="col-md-6 mx-auto" style="margin-top: -80px;">
    			<h1 class="text-center text-muted mb-3 mt-5">Register</h1>
                <p class="text-center text-muted mb-5">create an account if don't have one</p>

                <form method="POST" action="{{route('register')}}" class="row g-3" id="form-register">
                	@csrf
                <div class="col-md-6">
    				<label for="firstname" class="form-label">First name</label>
   					 <input type="text" class="form-control" id="firstname" name="firstname" value="{{old('firstname')}}" required autocomplete="firstname" autofocus>
   					 <small class="text-danger fw-bold" id="error-register-firstname"></small>
 				 </div>
 				 <div class="col-md-6">
 				 	<label for="lastname" class="form-label">Lastname</label>
 				 	<input type="text" name="lastname" id="lastname" class="form-control" value="{{old('lastname')}}" autocomplete="lastname" autofocus required>
 				 	<small class="text-danger fw-bold" id="error-register-lastname"></small>
 				 </div>
                
                <div class="col-md-12">
                	<label for="email" class="form-label">email</label>
					<input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" autocomplete="email" autofocus url-emailExist="{{ route('app_exist_email') }}" token="{{ csrf_token() }}">
                	<small class="text-danger fw-bold" id="error-register-email"></small>
                </div>

                <div class="col-md-6">
                	<label for="password" class="form-label">Password</label>
                	<input type="password" name="password" id="password" class="form-control" value="{{old('password')}}" autocomplete="password" autofocus>
                	<small class="text-danger fw-bold" id="error-register-password"></small>
                </div>

                <div class="col-md-6">
                	<label for="password-confirm" class="form-label">Confirmer votre password</label>
                	<input type="password" name="password-confirm" id="password-confirm" class="form-control" value="{{old('password-confirm')}}" autocomplete="password-confirm" autofocus>
                	<small class="text-danger fw-bold" id="error-register-password-confirm"></small>
                </div>

            	<div class="col-md-6">
                	<div class="form-check">
                		<input type="checkbox" class="form-check-input" value="" id="agreeTerms">
                		<label class="form-check-label" for="agreeTerms">Agree terms</label><br>
                		<small class="text-danger fw-bold" id="error-register-agreeTerms"></small>
                	</div>
            	</div>

            	<div class="d-grid gap-2">
            		<button class="btn btn-primary" type="button" id="register-user">Register</button>
            	</div>
            		<div class="col-md-6">
            		<p class="text-center text-muted mt-3">
						already have an account ?
						<a href="{{route('login')}}"> Login </a>
					</p>
				</div>
                </form>
    		</div>
    	</div>
    	
    </div>
@endsection
