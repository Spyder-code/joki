@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-12 ">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.update',['id'=>Auth::id()]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label " for="image">Avatar</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ Auth::user()->avatar }}" alt="img" class="img-fluid">
                                    </div>
                                    <div class="col-md-10">
                                        Gambar Profile Anda sebaiknya memiliki rasio 1:1 dan berukuran tidak lebih dari 2MB.<br>
                                        <div class="input-group mb-3">
                                            <input id="avatar" type="file" name="avatar" class="form-control">
                                            <div class="input-group-append">
                                                <a id="lfm" data-input="avatar" data-preview="holder" class="btn btn-primary" style="color: white">Choose</a>
                                            </div>
                                        </div>
                                        @error('avatar')
                                        <span style="color:red" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-6 col-lg-6">
                                    <div class="form-group position-relative error-l-50">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6 col-lg-6">
                                    <div class="form-group position-relative error-l-50">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-6 col-lg-6">
                                    <div class="form-group position-relative error-l-50">
                                        <label>Nama Lengkap</label>
                                        <input type="nama" class="form-control" required id="nama" name="name" value="{{ Auth::user()->name }}" >

                                        @error('name')
                                        <span style="color:red" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-6 col-lg-6">
                                    <div class="form-group position-relative error-l-50">
                                        <label>Hp/Telepon</label>
                                        <input type="tel" class="form-control phone" required id="telepon" name="phone" value="{{ Auth::user()->phone }}">
                                        @error('phone')
                                        <span style="color:red" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-0 float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Change Password</h4>
                        <hr>
                        <form class="needs-validation" action="{{ route('profile.update.password',Auth::id()) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="email">Current Password</label>
                                <input id="current_password" type="password" class="form-control" name="current_password" tabindex="1" required>
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                                name="password" tabindex="2" required>
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input id="confirm-password" type="password" class="form-control" name="password_confirmation"
                                tabindex="2" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
