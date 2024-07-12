@extends('frontend.master')

@section('header')

@endsection

@section('content')
<main>
	<!-- section -->
	<section class="my-lg-14 my-8">
		<div class="container">
			<!-- row -->
			<div class="row justify-content-center align-items-center">
				<div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
					<!-- img -->
					<img src="../assets/images/svg-graphics/signin-g.svg" alt="" class="img-fluid" />
				</div>
				<!-- col -->
				<div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
					<div class="mb-lg-9 mb-5">
						<h1 class="mb-1 h2 fw-bold">Sign in to EasyChows</h1>
						<p>Yet to register? <a href='/register'>Click here</a> to Sign In.</p>
					</div>

					<form method="POST" action="{{ route('login') }}">
						@csrf

						<!-- Email Address -->
						<div>
							<x-label for="email" :value="__('Email')" />

							<x-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
						</div>

						<!-- Password -->
						<div class="mt-4">
							<x-label for="password" :value="__('Password')" />

							<x-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
						</div>

						<!-- Remember Me -->
						<div class="block mt-4">
							<label for="remember_me" class="inline-flex items-center">
								<input id="remember_me" type="checkbox" class=" rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
								<span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
							</label>
						</div>

						<div class="flex items-center justify-end mt-4">
							@if (Route::has('password.request'))
							<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
								{{ __('Forgot your password?') }}
							</a>
							@endif

							<x-button class="ml-3">
								{{ __('Log in') }}
							</x-button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>

@endsection

