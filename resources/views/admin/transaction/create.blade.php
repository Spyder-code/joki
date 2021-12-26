@extends('layouts.dashboard')
@section('title','Create Transaksi')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex">
            <div class="top-left-button-container mr-5">
                <div class="btn-group">
                    <div class="top-right-button-container">
                        <a href="{{ route('transaction.index') }}" class="btn btn-outline-primary btn-lg">Back</a>
                    </div>
                </div>
            </div>
            <h1>Create Transaksi</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('transaction.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col">
                                <label for="name">Kategori pesanan <small>(Wajib)</small></label>
                                <select name="category_id" class="form-control" required>
                                    <option value="0" disabled selected>-Pilih Kategori pesanan-</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="title">Subjek pesanan <small>(Wajib)</small></label>
                                <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note">Detail pesanan <small>(Wajib)</small></label>
                            <textarea name="note" required cols="30" rows="5" class="form-control" >{{ old('note') }}</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="deadline">Deadline <small>(Wajib)</small></label>
                                <input type="datetime-local" name="deadline" id="deadline" class="form-control" required value="{{ old('deadline') }}">
                            </div>
                            <div class="col">
                                <label for="deadline">Price <small>(Wajib)</small></label>
                                <input type="number" name="price" id="price" class="form-control" required value="{{ old('price') }}">
                            </div>
                            <div class="col">
                                <label for="Customer">Customer Tipe</label>
                                <select name="customer_tipe" id="customer-tipe" class="form-control">
                                    <option value="1" selected>Customer Lama</option>
                                    <option value="0">Customer Baru</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="customer-tipe-1">
                            <label for="customer">Nama Customer <small>(Wajib)</small></label>
                            <select name="customer_id" id="customer-tipe" required class="select2 form-control">
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="customer-tipe-0">
                            <div class="form-group row" id="customer-tipe-1">
                                <div class="col">
                                    <label for="name">Name <small>(Wajib)</small></label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="username">Username <small>(Wajib)</small></label>
                                    <input type="text" name="username" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="phone">Phone <small>(Wajib)</small></label>
                                    <input type="number" name="phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file">File-file pendukung <small>(Optional)</small></label>
                            <input type="file" name="file" class=" form-control-file" multiple>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#customer-tipe-0').hide();
        $('#customer-tipe').change(function (e) {
            var val = $(this).val();
            if (val==1) {
                $('#customer-tipe-0').hide();
                $('#customer-tipe-1').show();
            } else {
                $('#customer-tipe-1').hide();
                $('#customer-tipe-0').show();
            }
        });
    </script>
@endsection
