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
			<div class="title">Halaman Tidak Ditemukan!</div>
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
				<h3>Halaman Tidak Ditemukan!</h3>
			</div>

			<!-- separator -->
			<div class="separator-large"></div>
			<!-- end separator -->

            <div class="container">
                <a href="{{ url('/') }}" class="button link external" >Kembali ke beranda</a>
            </div>
		</div>
		<!-- end sign in -->

		<!-- separator -->
		<div class="separator-large"></div>
		<!-- end separator -->

	</div>
</div>
@endsection

