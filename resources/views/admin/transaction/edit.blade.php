@extends('layouts.dashboard')
@section('title','Edit Transaksi')
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
            <h1>Edit Transaksi</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('transaction.update',$transaction) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col">
                                <label for="name">Kategori pesanan <small>(Wajib)</small></label>
                                <select name="category_id" class="form-control" required>
                                    @foreach ($category as $item)
                                        <option {{ $item->id==$transaction->category_id?'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="title">Subjek pesanan <small>(Wajib)</small></label>
                                <input type="text" name="title" id="title" class="form-control" required value="{{ $transaction->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note">Detail pesanan <small>(Wajib)</small></label>
                            <textarea name="note" required cols="30" rows="5" class="form-control" >{{ $transaction->note }}</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="deadline">Deadline <small>(Wajib)</small></label>
                                <input type="date" name="deadline" id="deadline" class="form-control" required value="{{ date('Y-m-d', strtotime($transaction->deadline)) }}">
                            </div>
                            @if ($transaction->transaction_status_id!=1)
                            <div class="col">
                                <label for="price">Harga</label>
                                <input type="number" name="price" {{ $transaction->price==''?'autofocus':'' }} id="price" class="form-control" required value="{{ $transaction->price }}">
                            </div>
                            @endif
                            <div class="col">
                                <label for="customer">Nama Customer <small>(Wajib)</small></label>
                                <select name="customer_id" disabled id="customer-tipe" required class="select2s form-control">
                                    @foreach ($user as $item)
                                        <option {{ $transaction->customer_id==$item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
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
