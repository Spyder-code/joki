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
			<div class="title">Detail Pesanan</div>
		</div>
	</div>
	<div class="page-content">
		<!-- ads details -->

		<!-- separator -->
		<div class="separator-medium"></div>
		<!-- end separator -->

		<div class="detail-title">
			<div class="container">
				<div class="tag-category">
					<span>{{ $transaction->category->name }}</span>
				</div>
				<p class="price-item">Rp. {{ $transaction->price==null?'--.---':$transaction->price }}</p>

				<!-- separator -->
				<div class="separator-small"></div>
				<!-- end separator -->

				<p class="title-item title-item-large">{{ $transaction->title }}</p>
				<!-- separator -->

				<div class="separator-small"></div>
				<!-- end separator -->

				<div class="short-info">
					<p class="text-small">Pesanan dibuat : <span>{{ date('d F Y', strtotime($transaction->created_at)) }}</span></p>
					<p class="text-small">Deadline : <span>{{ date('d F Y', strtotime($transaction->deadline)) }}</span></p>
					<p class="text-small">Status :
                        <span>
                            @if ($transaction->transaction_status_id==1)
                                <strong class="color-gray">Pending</strong>
                            @elseif($transaction->transaction_status_id==2)
                                <strong class="color-yellow">On progress</strong>
                            @elseif($transaction->transaction_status_id==3)
                                <strong class="color-green">Success</strong>
                            @elseif($transaction->transaction_status_id==4)
                                <strong class="color-red">Cancel</strong>
                            @elseif($transaction->transaction_status_id==5)
                                <strong class="color-blue">Revisi</strong>
                            @endif
                        </span>
                    </p>
				</div>

				<!-- separator -->
				<div class="separator-small"></div>
				<!-- end separator -->

				<div class="item-detail-action bg-color-lightblue padding-vertical padding-horizontal color-white">
					<p>{{ $transaction->notif->message }}</p>
				</div>

                @if ($transaction->transaction_status_id==1)
                <div class="separator-small"></div>

                <div class="item-detail-action">
                    <a href="https://api.whatsapp.com/send?phone=6283857317946&text=Assalamu'alaikum%20kak.%0ASaya%20mau%20konfirmasi%20pesanan%0A{{ route('transaction.show',$transaction) }}" target="d_blank" class="button link external">Konfirmasi Admin</a>
                </div>
                @endif

				<!-- divider -->
				<div class="divider-h"></div>
				<!-- end divider -->

			</div>
		</div>

		<div class="item-description">
			<div class="block-title title-small no-margin-top">
				<h3>Detail</h3>
			</div>
			<div class="container">
				<p>{{ $transaction->note }}</p>
			</div>
		</div>

		<div class="item-details">
			<div class="block-title title-small">
				<h3>File Pendukung</h3>
			</div>
			@foreach ($file as $item)
            <div class="container display-flex justify-content-space-between margin-top">
				<p>{{ $item->name }}</p>
                <a href="{{ $item->url }}" target="d_blank" class="link external color-blue"><ion-icon name="download" style="font-size: 20px"></ion-icon> Download</a>
			</div>
            @endforeach
            <div class="separator-large"></div>

                <div class="item-detail-action">
                    <form class="list" action="{{ route('transaction.addFile',$transaction) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <ul>
                            <li class="item-content item-input">
                                <div class="item-inner">
                                    <div class="item-input-wrap">
                                        <input type="file" name="file[]" multiple required validate>
                                    </div>
                                </div>
                            </li>
                            <li class="item-content item-input">
                                <button type="submit" class="button">Tambah File</button>
                            </li>
                        </ul>
                    </form>
                </div>
		</div>

		<!-- separator -->
		<div class="separator-medium"></div>
		<!-- end separator -->

		<div class="block-title">
			<h3>Penerimaan Pesanan</h3>
            <small class="color-brown">Download hasil pesanan disini</small>
		</div>
		<div class="seller-info">
			<div class="container">
				<div class="content {{ $transaction->transaction_status_id==3?'bg-color-primary':'bg-color-yellow' }}">
					<div class="title-name">
                        @if ($transaction->transaction_status_id==3)
                            <h5 class="color-white">Pesanan selesai</h5>
                            <p class="text-small color-white"><span></span>{{ date('d F Y', strtotime($transaction->updated_at)) }}</p>
                            <button class="button button-small button-with-auto">Download File</button>
                        @else
                            <h5 class="color-white text-center">Pesanan Belum Selesai</h5>
                        @endif
					</div>
				</div>
			</div>
		</div>

		<div class="block-title block-title-center">
			<h3>Contact Admin</h3>
		</div>
		<div class="contact-seller profile-media">
			<div class="container">
				<ul>
					<li><a href="https://wa.me/6283857317946" class="bg-green link external" target="d_blank"><ion-icon name="call-outline"></ion-icon></a></li>
					<li><a href="https://wa.me/6283857317946" class="bg-blue link external" target="d_blank"><ion-icon name="chatbox-outline"></ion-icon></a></li>
					<li><a href="https://wa.me/6283857317946" class="bg-red link external" target="d_blank"><ion-icon name="mail-outline"></ion-icon></a></li>
				</ul>
			</div>
		</div>

		<div class="block-title">
			<h3>Review Kami</h3>
		</div>
		@if ($transaction->transaction_status_id==3)
        <div class="container text-center">
            @if ($review==null)
                <ion-icon name="star" id="star-1" onclick="star(1)" style="font-size:30px"></ion-icon>
                <ion-icon name="star" id="star-2" onclick="star(2)" style="font-size:30px"></ion-icon>
                <ion-icon name="star" id="star-3" onclick="star(3)" style="font-size:30px"></ion-icon>
                <ion-icon name="star" id="star-4" onclick="star(4)" style="font-size:30px"></ion-icon>
                <ion-icon name="star" id="star-5" onclick="star(5)" style="font-size:30px"></ion-icon>
            @else
                @for ($i = 0; $i < $review->star; $i++)
                    <ion-icon name="star" class="color-yellow" style="font-size:30px"></ion-icon>
                @endfor
            @endif
        </div>

        <div class="separator-large"></div>

        <form class="list" action="{{ route('transaction.review') }}"  method="post">
            @csrf
            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
            <input type="hidden" name="star" id="star-input">
            <ul>
                <li class="item-content item-input">
                    <div class="item-inner">
                        <div class="item-input-wrap">
                            <textarea required validate cols="30" rows="10" placeholder="Tulis review" name="message" {{ $review==null?'': 'readonly' }}>{{ $review==null?'':$review->message }}</textarea>
                        </div>
                    </div>
                </li>
                <li class="item-content item-input">
                    @if ($review==null)
                        <button type="submit" class="button">Review</button>
                    @endif
                </li>
            </ul>
        </form>
        @else
            <div class="separator-large"></div>
            <p class="text-center"><small>Review belum bisa dilakukan sebelum pesanan diterima</small></p>
        @endif


		<!-- separator -->
		<div class="separator-large"></div>
		<!-- end separator -->

		<!-- end ads details -->
	</div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script>
        function star(id){
                for (let i = 1; i <= 5; i++) {
                    if(i<=id){
                        $('#star-'+i).addClass('color-yellow');
                    }else{
                        $('#star-'+i).removeClass('color-yellow');
                    }
                }
                $('#star-input').val(id);
            }
        var notificationPesanan = app.notification.create({
            // icon: '<i class="icon demo-icon">7</i>',
            title: 'Message',
            titleRightText: 'now',
            subtitle: '<small class="color-green">File berhasil diupload!</small>',
            // text: 'Click me to close',
            closeOnClick: true,
            // closeButton: true
        })
        var notificationReview = app.notification.create({
            // icon: '<i class="icon demo-icon">7</i>',
            title: 'Message',
            titleRightText: 'now',
            subtitle: '<small class="color-green">Review berhasil ditambah!</small>',
            // text: 'Click me to close',
            closeOnClick: true,
            // closeButton: true
        })
        var notificationError = app.notification.create({
            // icon: '<i class="icon demo-icon">7</i>',
            title: 'Message',
            titleRightText: 'now',
            subtitle: '<small class="color-red">File tidak berhasil diupload!</small>',
            // text: 'Click me to close',
            closeOnClick: true,
            // closeButton: true
        })

        @if (session('pesanan'))
            notificationPesanan.open();
        @endif
        @if (session('review'))
            notificationReview.open();
        @endif
        @if (session('error'))
            notificationError.open();
        @endif
    </script>
@endsection
