@extends('layouts.user')
@section('content')
<div class="view view-main view-init ios-edges" data-url="/">
    <div class="page page-home page-with-subnavbar">

        <div class="toolbar tabbar tabbar-labels toolbar-bottom elevation-6 bg-white">
            <div class="toolbar-inner">
                <a href="#tab-home" class="tab-link tab-link-active">
                    <ion-icon name="home-outline"></ion-icon>
                    <span class="tabbar-label">Home</span>
                </a>
                <a href="{{ Auth::check()?'#pesanan':route('user.account') }}" class="tab-link {{ Auth::check()?'':'link external' }}">
                    <ion-icon name="cart-outline"></ion-icon>
                    <span class="tabbar-label">Pesanan</span>
                </a>
                <a href="{{ route('user.buat.pesanan') }}" class="tab-link link external addding-ads">
                    <span class="adding-ads">
                        <ion-icon name="add-outline"></ion-icon>
                    </span>
                </a>
                <a href="{{ Auth::check()?'#notifikasi':route('user.account') }}" class="tab-link {{ Auth::check()?'':'link external' }}">
                    <ion-icon name="notifications-outline"></ion-icon>
                    <span class="tabbar-label">Notifikasi <sup class="color-red" style="font-size: 10pt;"></sup></span>
                </a>
                <a href="{{ Auth::check()?'#tab-profile':route('user.account') }}" class="tab-link {{ Auth::check()?'':'link external' }}">
                    <ion-icon name="person-outline"></ion-icon>
                    <span class="tabbar-label">Profile</span>
                </a>
            </div>
        </div>

        <div class="tabs">
            <div id="tab-home" class="tab tab-home tab-active">
                <!-- ===== TAB HOME ===== -->

                <!-- navbar -->
                <div class="navbar navbar-transparent">
                    <div class="navbar-bg"></div>
                    <div class="navbar-inner sliding">
                        <div class="left">
                            <a href="#" class="link panel-open" data-panel=".sidebar-left">
                                <ion-icon name="menu-outline"></ion-icon>
                            </a>
                        </div>
                        <div class="right">
                            <a href="#notifikasi" data-transition="f7-dive" class="tab-link">
                                <ion-icon name="notifications-outline"></ion-icon><sup class="color-red" style="font-size: 10pt;"></sup>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end navbar -->

                <!-- sidebar / panel -->
                <div class="panel-backdrop"></div>
                <div class="panel panel-left sidebar-left panel-cover panel-init">

                    <!-- separator -->
                    <div class="separator-large"></div>
                    <!-- end separator -->

                    <div class="panel-header">
                        <div class="container">
                            <div class="content">
                                @if (Auth::check())
                                <img src="{{ Auth::user()->avatar }}" alt="">
                                <div class="title-name">
                                    <h5>{{ Auth::user()->name }}</h5>
                                    <p class="text-small">{{ Auth::user()->username }}</p>
                                </div>
                                @else
                                <h3 class="text-center mb-5">Masuk Aplikasi</h3>
                                <hr>
                                <br>
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
                                </div>
                                {{-- <div class="contact-button">
                                    <a href="{{ route('user.account') }}" class="button link external">Login</a>
                                </div> --}}
                                @endif
                            </div>
                        </div>
                    </div>

                    @if (Auth::check())
                    <div class="list">
                        <ul>
                            <li>
                                <a href="#pesanan" data-transition="f7-dive" class="tab-link item-content panel-close">
                                    <div class="item-media">
                                        <ion-icon name="documents-outline" class="color-blue"></ion-icon>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title">Pesanan saya</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.account') }}" class="item-link link external item-content panel-close">
                                    <div class="item-media">
                                        <ion-icon name="settings-outline" class="color-green"></ion-icon>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title">Account</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}" class="item-link item-content link external">
                                    <div class="item-media">
                                        <ion-icon name="log-out-outline" class="color-red"></ion-icon>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title">Logout</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif

                </div>
                <!-- end sidebar / panel -->

                <!-- hader page -->
                <div class="header-title">
                    <div class="container">
                        <h3>Jasa Joki Tugas</h3>
                        <br>
                        <p>Pengerjaan cepat, aman dan sudah dipercaya banyak customer.</p>
                    </div>
                </div>
                <!-- end hader page -->

                <!-- separator -->
                <div class="separator-small"></div>
                <!-- end separator -->

                <!-- header searchbar -->
                <div class="header-searchbar">
                    <!-- <form class="searchbar">
                        <div class="searchbar-inner">
                            <div class="searchbar-input-wrap">
                                <input type="search" placeholder="Find Laptop, Handphone, and other">
                                <i class="searchbar-icon"></i>
                                <span class="input-clear-button"></span>
                            </div>
                            <span class="searchbar-disable-button">Cancel</span>
                        </div>
                    </form> -->
                </div>
                <!-- end header searchbar -->

                <!-- categories -->
                <div class="categories">
                    <div class="block-title">
                        <h3>Categories</h3>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-33">
                                <a onClick="window.location.href = '{{ route('user.buat.pesanan') }}'" data-transition="f7-dive">
                                    <div class="content">
                                        <ion-icon name="journal-outline" class="color-blue"></ion-icon>
                                        <h6 class="second-title">Makalah</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-33">
                                <a onClick="window.location.href = '{{ route('user.buat.pesanan') }}'" data-transition="f7-dive">
                                    <div class="content">
                                        <ion-icon name="book-outline" class="color-purple"></ion-icon>
                                        <h6 class="second-title">Skripsi</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-33">
                                <a onClick="window.location.href = '{{ route('user.buat.pesanan') }}'" data-transition="f7-dive">
                                    <div class="content">
                                        <ion-icon name="brush-outline" class="color-orange"></ion-icon>
                                        <h6 class="second-title">Desain</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-33">
                                <a onClick="window.location.href = '{{ route('user.buat.pesanan') }}'" data-transition="f7-dive">
                                    <div class="content">
                                        <ion-icon name="print-outline" class="color-red"></ion-icon>
                                        <h6 class="second-title">Writing</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-33">
                                <a onClick="window.location.href = '{{ route('user.buat.pesanan') }}'" data-transition="f7-dive">
                                    <div class="content">
                                        <ion-icon name="logo-github" class="color-green"></ion-icon>
                                        <h6 class="second-title">Program</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-33">
                                <a onclick="window.location.href ='{{ route('user.category') }}'" data-transition="f7-dive">
                                    <div class="content" style="width: auto">
                                        <ion-icon name="grid-outline" class="color-brown"></ion-icon>
                                        <h6 class="second-title">Show All</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end categories -->

                <!-- separator -->
                <div class="separator-large"></div>
                <!-- end separator -->

                <!-- promo banner -->
                <div class="promo-banner">
                    <div class="container">
                        <a href="">
                            <div class="content-box">
                                <div class="content color-white content-left">
                                    <h5 class="title-item color-white">Promo Desember</h5>
                                    <p class="text-small">Potongan 10% untuk pengguna baru.</p>
                                </div>
                                <div class="content content-right">
                                    <div class="button button-icon-large">
                                        <ion-icon name="arrow-forward-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- end promo banner -->

                <!-- separator -->
                <div class="separator-large"></div>
                <!-- end separator -->

                <!-- ===== END TAB HOME ===== -->
            </div>

            <div id="pesanan" class="tab tab-favorite">
                <!-- ===== TAB FAVORITES ===== -->

                <!-- navbar -->
                <div class="navbar">
                    <div class="navbar-inner sliding">
                        <div class="left"></div>
                        <div class="title">Pesanan saya</div>
                        <div class="right">
                            <a href="" class="link">
                                <ion-icon name="search-outline"></ion-icon>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end navbar -->

                <!-- separator -->
                <div class="separator-small"></div>
                <!-- end separator -->
                @if ($transaction->count()==0)
                    <h1 class="text-center fab fab-center-center">
                        <strong>Belum Ada Pesanan</strong><br>
                        <ion-icon name="sad"></ion-icon>
                    </h1>
                @endif

                @foreach ($transaction as $item)
                <div onclick="window.location.href = '{{ route('transaction.show',$item) }}'" class="favorites">
                    <div class="container">
                        <div class="content-wrapper">
                            @if ($item->transaction_status_id==1)
                            <a href="#">
                                <div class="favorite-symbol bg-color-gray"><ion-icon name="clipboard-outline" class="color-white"></ion-icon></div>
                            </a>
                            @elseif($item->transaction_status_id==2)
                            <a href="#">
                                <div class="favorite-symbol bg-color-yellow"><ion-icon name="hourglass-outline" class="color-white"></ion-icon></div>
                            </a>
                            @elseif($item->transaction_status_id==3)
                            <a href="#">
                                <div class="favorite-symbol bg-color-green"><ion-icon name="checkmark-circle-outline" class="color-white"></ion-icon></div>
                            </a>
                            @elseif($item->transaction_status_id==4)
                            <a href="#">
                                <div class="favorite-symbol bg-color-red"><ion-icon name="close-circle-outline" class="color-white"></ion-icon></div>
                            </a>
                            @elseif($item->transaction_status_id==5)
                            <a href="#">
                                <div class="favorite-symbol bg-color-blue"><ion-icon name="clipboard-outline" class="color-white"></ion-icon></div>
                            </a>
                            @endif
                            <div class="boxed">
                                <p class="title-item">{{ $item->title }}</p>
                                <p class="price-item">Rp. {{ $item->price==null?'--.---':$item->price }}</p>
                                <strong class="location-item display-flex justify-content-space-between">Deadline: {{ date('d F Y', strtotime($item->deadline)) }}
                                    @if ($item->transaction_status_id==1)
                                        <strong class="color-gray">Pending</strong>
                                    @elseif($item->transaction_status_id==2)
                                        <strong class="color-yellow">On progress</strong>
                                    @elseif($item->transaction_status_id==3)
                                        <strong class="color-green">Success</strong>
                                    @elseif($item->transaction_status_id==4)
                                        <strong class="color-red">Cancel</strong>
                                    @elseif($item->transaction_status_id==5)
                                        <strong class="color-blue">Revisi</strong>
                                    @endif
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- separator -->
                <div class="separator-small"></div>
                <!-- end separator -->
                @endforeach

                <!-- separator -->
                <div class="separator-large"></div>
                <!-- end separator -->

                <!-- ===== END TAB FAVORITES ===== -->
            </div>

            <div id="notifikasi" class="tab tab-notification">
                <!-- ===== TAB FAVORITES ===== -->

                <!-- navbar -->
                <div class="navbar">
                    <div class="navbar-inner sliding">
                        <div class="left"></div>
                        <div class="title">Notifikasi</div>
                        <div class="right">
                            <a href="" class="link">
                                <ion-icon name="search-outline"></ion-icon>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end navbar -->

                <!-- separator -->
                <div class="separator-small"></div>
                <!-- end separator -->
                @if ($notifikasi->count()==0)
                    <h1 class="text-center fab fab-center-center">
                        <ion-icon name="sad"></ion-icon>
                    </h1>
                @endif

                @foreach ($notifikasi as $item)
                <div class="favorites">
                    <div class="container">
                        <div class="content-wrapper">
                            @if ($item->notification_type_id==1)
                            <a href="#">
                                <div class="favorite-symbol bg-color-gray"><ion-icon name="clipboard-outline" class="color-white"></ion-icon></div>
                            </a>
                            @elseif($item->notification_type_id==2)
                            <a href="#">
                                <div class="favorite-symbol bg-color-yellow"><ion-icon name="hourglass-outline" class="color-white"></ion-icon></div>
                            </a>
                            @elseif($item->notification_type_id==3)
                            <a href="#">
                                <div class="favorite-symbol bg-color-green"><ion-icon name="checkmark-circle-outline" class="color-white"></ion-icon></div>
                            </a>
                            @elseif($item->notification_type_id==4)
                            <a href="#">
                                <div class="favorite-symbol bg-color-red"><ion-icon name="close-circle-outline" class="color-white"></ion-icon></div>
                            </a>
                            @elseif($item->notification_type_id==5)
                            <a href="#">
                                <div class="favorite-symbol bg-color-blue"><ion-icon name="clipboard-outline" class="color-white"></ion-icon></div>
                            </a>
                            @endif
                            <div class="boxed">
                                <p class="price-item">{{ $item->trans->title }}</p>
                                <p class=" margin-bottom">{{ $item->notification_type->message }}</p>
                                <strong class="location-item display-flex justify-content-space-between">-
                                    <strong class="color-gray">{{ date('d F Y', strtotime($item->created_at)) }}</strong>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- separator -->
                <div class="separator-small"></div>
                <!-- end separator -->
                @endforeach

                <!-- separator -->
                <div class="separator-large"></div>
                <!-- end separator -->

                <!-- ===== END TAB FAVORITES ===== -->
            </div>

            <div id="tab-profile" class="tab tab-profile">

                <!-- separator -->
                <div class="separator-extra-large"></div>
                <!-- end separator -->

                <!-- ===== TAB PROFILE ===== -->
                <div class="container">
                    @if (Auth::check())
                    <div class="header-profile">
                        <img src="{{ Auth::user()->avatar }}" alt="">
                        <div class="title-name">
                            <h4 class="">{{ Auth::user()->name }}</h4>
                        </div>

                        <!-- separator -->
                        <div class="separator-medium"></div>
                        <!-- end separator -->

                        <div class="profile-statistic">
                            <div class="row">
                                <div class="col-33">
                                    <div class="content">
                                        <h4>ID{{ Auth::id() }}</h4>
                                        <span>Customer</span>
                                    </div>
                                </div>
                                <div class="col-33">
                                    <span class="line-divider"></span>
                                </div>
                                <div class="col-33">
                                    <div class="content">
                                        <h4>19</h4>
                                        <span>Pesanan</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="separator-medium"></div>
                        <!-- end separator -->

                        <div class="contact-button">
                            <button class="button">{{ Auth::user()->username }}</button>
                        </div>

                        <!-- separator -->
                        <div class="separator-medium"></div>
                        <!-- end separator -->

                    </div>
                    @endif
                </div>

                <div class="list">
                    <ul>
                        <!-- <li>
                            <a href="/notifications/" data-transition="f7-dive" class="item-link item-content">
                                <div class="item-media">
                                    <ion-icon name="notifications-outline" class="color-red"></ion-icon>
                                </div>
                                <div class="item-inner">
                                    <div class="item-title">Notification</div>
                                </div>
                            </a>
                        </li> -->
                        <li>
                            <a href="{{ route('user.account') }}" data-transition="f7-dive" class="item-link link external item-content">
                                <div class="item-media">
                                    <ion-icon name="settings-outline" class="color-green"></ion-icon>
                                </div>
                                <div class="item-inner">
                                    <div class="item-title">Account</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.logout') }}" class="item-link link external item-content">
                                <div class="item-media">
                                    <ion-icon name="log-out-outline" class="color-red"></ion-icon>
                                </div>
                                <div class="item-inner">
                                    <div class="item-title">Logout</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- ===== END TAB PROFILE ===== -->
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
    <script>
        var notificationLogin = app.notification.create({
            // icon: '<i class="icon demo-icon">7</i>',
            title: 'Message',
            titleRightText: 'now',
            subtitle: '<small class="color-green">Anda berhasil login</small>',
            // text: 'Click me to close',
            closeOnClick: true,
            // closeButton: true
        })
        var notificationLogout = app.notification.create({
            // icon: '<i class="icon demo-icon">7</i>',
            title: 'Message',
            titleRightText: 'now',
            subtitle: '<small class="color-green">Anda berhasil logout</small>',
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

        @if (session('login'))
            notificationLogin.open();
        @endif
        @if (session('logout'))
            notificationLogout.open();
        @endif
        @if (session('error'))
            notificationError.open();
        @endif
    </script>
@endsection
