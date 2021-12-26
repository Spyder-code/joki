@extends('layouts.dashboard')
@section('title','Create Freelance')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex">
            <div class="top-left-button-container mr-5">
                <div class="btn-group">
                    <div class="top-right-button-container">
                        <a href="{{ route('freelance.index') }}" class="btn btn-outline-primary btn-lg">Back</a>
                    </div>
                </div>
            </div>
            <h1>Create Freelance</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('freelance.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="role_id" value="2">
                        <div class="form-group row">
                            <div class="col">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                            </div>
                            <div class="col">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required value="{{ old('username') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                            </div>
                            <div class="col">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" id="phone" class="form-control" required value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required value="{{ old('password') }}">
                            </div>
                            <div class="col">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required value="{{ old('password_confirmation') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
