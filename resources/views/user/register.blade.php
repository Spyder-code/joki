@extends('layouts.user')
@section('content')
<div class="page">
	<div class="navbar navbar-transparent">
		<div class="navbar-bg"></div>
		<div class="navbar-inner sliding">
			<div class="left">
				<a class="link back">
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
				<form class="list">
					<ul>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="text" placeholder="Name">
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="email" placeholder="Email">
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="password" placeholder="Password">
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="password" placeholder="Confirm Password">
								</div>
							</div>
						</li>
					</ul>
					<div class="button-default">
						<div class="container">
							<button class="button">Sign Up</button>
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
