@extends('layouts.user')
@section('content')
<div class="page">
	<div class="navbar navbar-transparent">
		<div class="navbar-bg"></div>
		<div class="navbar-inner sliding">
			<div class="left">
				<a class="link external" href="{{ url('/') }}">
					<i class="icon icon-back"></i>
				</a>
			</div>
			<div class="title">Sign In</div>
		</div>
	</div>
	<div class="page-content">

		<!-- separator -->
		<div class="separator-large"></div>
		<!-- end separator -->

		<!-- sign in -->
		<div class="sign-in">
			<div class="content text-center">
				<img class="image-illustration" src="{{ asset('images/new-logo.png') }}" alt="">
				<h3>Welcome Back!</h3>
			</div>

			<!-- separator -->
			<div class="separator-large"></div>
			<!-- end separator -->

			<div class="content-form">
				<form class="list" action="{{ route('login') }}" method="POST">
                    @csrf
					<ul>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="text" required name="username" placeholder="Username / Email">
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="password" required name="password" placeholder="Password">
								</div>
							</div>
						</li>
					</ul>
					<div class="button-default">
						<div class="container">
							<button class="button" type="submit">Sign In</button>
							<a href="{{ route('register') }}" class="button link external" >Sign Up</a>
						</div>
					</div>
				</form>

				<!-- separator -->
				<div class="separator-medium"></div>
				<!-- end separator -->

				<div class="link-forgot text-center text-small">
					<a href="#" class="color-accent">Forgot Password?</a>
				</div>
			</div>
		</div>
		<!-- end sign in -->

		<!-- separator -->
		<div class="separator-large"></div>
		<!-- end separator -->

	</div>
</div>
@endsection

@section('script')
    <script>
        var notification = app.notification.create({
            // icon: '<i class="icon demo-icon">7</i>',
            title: 'Message',
            titleRightText: 'now',
            subtitle: '<small>Harap login dahulu sebelum melanjutkan</small?',
            // text: 'Click me to close',
            closeOnClick: true,
            // closeButton: true
        })

        var notificationError = app.notification.create({
            // icon: '<i class="icon demo-icon">7</i>',
            title: 'Message',
            titleRightText: 'now',
            subtitle: '<small class="color-red">Username / Email And Password Are Wrong.</small>',
            // text: 'Click me to close',
            closeOnClick: true,
            // closeButton: true
        })

        @if (session('message'))
            notification.open();
        @endif
        @if (session('error'))
            notificationError.open();
        @endif
    </script>
@endsection
