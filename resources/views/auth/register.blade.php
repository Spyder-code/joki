@extends('layouts.user')
@section('content')
<div class="page">
	<div class="navbar navbar-transparent">
		<div class="navbar-bg"></div>
		<div class="navbar-inner sliding">
			<div class="left">
				<a href="{{ url('/') }}" class="link external">
					<i class="icon icon-back"></i>
				</a>
			</div>
			<div class="title">Sign Up</div>
		</div>
	</div>
	<div class="page-content">

		<!-- separator -->
		<div class="separator-large"></div>
		<!-- end separator -->

		<!-- sign up -->
		<div class="sign-up">
			<div class="content text-center">
				<img class="image-illustration" src="{{ asset('images/new-logo.png') }}" alt="">
				<h3>Create Account</h3>
			</div>

			<!-- separator -->
			<div class="separator-large"></div>
			<!-- end separator -->

			<div class="content-form">
				<form class="list" action="{{ route('register') }}" method="POST">
                    @csrf
					<ul>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="text" placeholder="Name" name="name" required validate>
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="text" placeholder="Username" name="username" required validate>
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="number" placeholder="Phone" name="phone" required validate>
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="email" placeholder="Email" name="email" required validate>
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="password" placeholder="Password" name="password" required validate>
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="password" placeholder="Confirm Password" name="password_confirmation" required validate>
								</div>
							</div>
						</li>
					</ul>
					<div class="button-default">
						<div class="container">
							<button class="button" type="submit">Sign Up</button>
						</div>
					</div>
				</form>

			</div>
		</div>
		<!-- end sign up -->

		<!-- separator -->
		<div class="separator-large"></div>
		<!-- end separator -->

	</div>
</div>
@endsection
