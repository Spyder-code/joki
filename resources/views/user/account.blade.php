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
			<div class="title">Settings</div>
		</div>
	</div>
	<div class="page-content">
		<!-- navbar -->
		<div class="navbar">
			<div class="navbar-inner sliding">
				<div class="left"></div>
				<div class="title">My Account</div>
				<div class="right"></div>
			</div>
		</div>
		<!-- end navbar -->

		<!-- settings -->
		<div class="settings">

			<!-- separator -->
			<div class="separator-large"></div>
			<!-- end separator -->

			<div class="content-form">
				<form class="list" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
					<ul>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="text" placeholder="Name" required validate name="name" value="{{ Auth::user()->name }}">
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="text" placeholder="Username" required validate name="username" value="{{ Auth::user()->username }}">
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="text" readonly value="{{ Auth::user()->email }}">
								</div>
							</div>
						</li>
						<li class="item-content item-input">
							<div class="item-inner">
								<div class="item-input-wrap">
									<input type="number" name="phone" required validate value="{{ Auth::user()->phone }}">
								</div>
							</div>
						</li>
						<div class="add-image-content">
							<div class="container">
								<div class="content">
                                    <img id="output" class="full-width radius-top-only" src="#" alt="your image" />
									<label for="imgInp">
										<h6>Image</h6>
										<p class="text-extra-small">The image has to be png, jpg or jpeg</p>
										<input type="file" hidden name="image" id="imgInp" onchange="loadFile(event)">
									</label>
								</div>
							</div>
						</div>
					</ul>
					<div class="button-default">
						<div class="container">
							<div class="row">
								<div class="col-100">
									<button class="button" type="submit">Update Profile</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="block-title">
				<h3>Update Password</h3>
			</div>

			<form class="list" action="{{ route('profile.update.password') }}" method="POST">
                @csrf
                @method('PUT')
				<ul>
					<li class="item-content item-input">
						<div class="item-inner">
							<div class="item-input-wrap">
								<input type="password" required validate name="current_password" placeholder="Current Password">
								<span class="input-clear-button"></span>
							</div>
						</div>
					</li>
					<li class="item-content item-input">
						<div class="item-inner">
							<div class="item-input-wrap">
								<input type="password" required validate name="password" placeholder="New password">
								<span class="input-clear-button"></span>
							</div>
						</div>
					</li>
					<li class="item-content item-input">
						<div class="item-inner">
							<div class="item-input-wrap">
								<input type="password" required validate name="password_confirmation" placeholder="Confirm password">
								<span class="input-clear-button"></span>
							</div>
						</div>
					</li>
				</ul>
				<div class="button-default">
					<div class="container">
						<div class="row">
							<div class="col-100">
								<button class="button" type="submit">Change password</button>
							</div>
						</div>
					</div>
				</div>
			</form>

			<!-- separator -->
			<div class="separator-large"></div>
			<!-- end separator -->

		</div>
		<!-- end settings -->
	</div>
</div>
@endsection

@section('script')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            console.log(event);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var notificationSuccess = app.notification.create({
            // icon: '<i class="icon demo-icon">7</i>',
            title: 'Message',
            titleRightText: 'now',
            subtitle: '<small class="color-green">Account berhasil di update!</small>',
            // text: 'Click me to close',
            closeOnClick: true,
            // closeButton: true
        })
        var notificationSuccess = app.notification.create({
            // icon: '<i class="icon demo-icon">7</i>',
            title: 'Message',
            titleRightText: 'now',
            subtitle: '<small class="color-red">Data inputan salah!</small>',
            // text: 'Click me to close',
            closeOnClick: true,
            // closeButton: true
        })

        @if (session('success'))
            notificationSuccess.open();
        @endif
        @if (session('error'))
            notificationError.open();
        @endif
    </script>
@endsection
