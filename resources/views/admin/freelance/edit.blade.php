@extends('layouts.dashboard')
@section('title','edit Freelance')
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
            <h1>Edit data freelance</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('freelance.update',$freelance) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ $freelance->name }}">
                            </div>
                            <div class="col">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required value="{{ $freelance->username }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required value="{{ $freelance->email }}">
                            </div>
                            <div class="col">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" id="phone" class="form-control" required value="{{ $freelance->phone }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
