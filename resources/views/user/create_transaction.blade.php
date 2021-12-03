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
			<div class="title">Buat Pesanan</div>
		</div>
	</div>
	<div class="page-content">

		<!-- separator -->
		<div class="separator-medium"></div>
		<!-- end separator -->

		<!-- add ads product details -->
		<div class="add-ads-product-details">
			<div class="block-title no-margin-top">
				<h3>Buat Pesanan</h3>
			</div>

			<form class="list" action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
				<ul>
                    <li class="item-content item-input">
                        <div class="item-inner">
							<div class="item-input-wrap input-dropdown-wrap"><small>Kategori pesanan <sup class="color-red">*</sup></small>
								<select name="category_id" required validate>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}" {{ old('category_id')==$item->id?'selected':'' }}>{{ $item->name }}</option>
                                    @endforeach
								</select>
							</div>
						</div>
                    </li>
					<li class="item-content item-input">
						<div class="item-inner">
							<div class="item-input-wrap"><small>Subjek pesanan <sup class="color-red">*</sup></small>
								<input type="text" name="title" value="{{ old('title') }}" required validate placeholder="Judul">
							</div>
						</div>
					</li>
					<li class="item-content item-input">
						<div class="item-inner">
							<div class="item-input-wrap"><sup>Detail pesanan <sup class="color-red">*</sup></sup>
								<textarea required validate cols="30" rows="10" placeholder="Deskripsi" name="note">{{ old('note') }}</textarea>
							</div>
						</div>
					</li>
					<li class="item-content item-input">
						<div class="item-inner">
							<div class="item-input-wrap"><sup>Deadline pengerjaan <sup class="color-red">*</sup></sup>
								<input type="date" name="deadline" required validate value="{{ old('deadline') }}">
							</div>
						</div>
					</li>
					<li class="item-content item-input">
						<div class="item-inner">
							<div class="item-input-wrap"><sup>File-file pendukung <sup class="color-blue">optional</sup></sup>
								<input type="file" name="file[]" multiple>
							</div>
						</div>
					</li>
					<li class="item-content item-input">
						<div class="item-inner">
							<div class="button-default">
                                <div class="container">
                                    @if (Auth::check())
                                        <button class="button w-100" type="submit">Buat pesanan</button>
                                    @else
                                        <a class="button button-fill sheet-open" href="#" data-sheet=".my-sheet-top">Buat pesanan</a>
                                    @endif
                                </div>
                            </div>
						</div>
					</li>
				</ul>
			</form>

		</div>
		<!-- end add ads product details -->

		<!-- separator -->
		<div class="separator-large"></div>
		<!-- end separator -->

	</div>
</div>

{{-- Modal --}}
<div class="sheet-modal sheet-modal-top my-sheet-top" style="height: 300px">
    <div class="toolbar toolbar-bottom">
        <div class="toolbar-inner">
            <div class="left"></div>
            <div class="right"><a class="link sheet-close" href="#"><small class="color-blue">Close</small></a></div>
        </div>
    </div>
    <div class="sheet-modal-inner">
        <div class="block">
            <h4>Anda harus login terlebih dahulu</h4>
            <div class="content-form">
                <form class="list" action="{{ route('login') }}" method="POST">
                    @csrf
                    <ul>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-input-wrap">
                                    <input type="text" required validate name="username" placeholder="Username / Email">
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-input-wrap">
                                    <input type="password" required validate name="password" placeholder="Password">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="button-default">
                        <div class="container">
                            <button class="button" type="submit">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
            subtitle: '<small class="color-red">Anda harus login terlebih dahulu.</small>',
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
