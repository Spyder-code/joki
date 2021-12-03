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
			<div class="title">Categories</div>
		</div>
	</div>
	<div class="page-content">

		<!-- separator -->
		<div class="separator-medium"></div>
		<!-- end separator -->

		<!-- all categories -->
		<div class="categories">
			<div class="container">
				<div class="row">
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="journal-outline" class="color-blue"></ion-icon>
								<h6 class="second-title">Makalah</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="book-outline" class="color-purple"></ion-icon>
								<h6 class="second-title">Skripsi</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="brush-outline" class="color-orange"></ion-icon>
								<h6 class="second-title">Desain</h6>
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="print-outline" class="color-red"></ion-icon>
								<h6 class="second-title">Writing</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="logo-github" class="color-green"></ion-icon>
								<h6 class="second-title">Program</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="albums-outline" class="color-brown"></ion-icon>
								<h6 class="second-title">Power Point</h6>
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="bookmarks-outline" class="color-blue"></ion-icon>
								<h6 class="second-title">Resume</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="bar-chart-outline" class="color-purple"></ion-icon>
								<h6 class="second-title">Statistika</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="book-outline" class="color-orange"></ion-icon>
								<h6 class="second-title">Review</h6>
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="move" class="color-red"></ion-icon>
								<h6 class="second-title">Soal SMA</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="ribbon-outline" class="color-green"></ion-icon>
								<h6 class="second-title">Soal Kuliah</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="desktop-outline" class="color-brown"></ion-icon>
								<h6 class="second-title">Computers</h6>
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="color-palette-outline" class="color-blue"></ion-icon>
								<h6 class="second-title">Art</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="film-outline" class="color-purple"></ion-icon>
								<h6 class="second-title">Edit Video</h6>
							</div>
						</a>
					</div>
					<div class="col-33">
						<a href="/category-details/" data-transition="f7-dive">
							<div class="content">
								<ion-icon name="shapes-outline" class="color-orange"></ion-icon>
								<h6 class="second-title">Decoration</h6>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- end all categories -->

		<!-- separator -->
		<div class="separator-large"></div>
		<!-- end separator -->

	</div>
</div>
@endsection
