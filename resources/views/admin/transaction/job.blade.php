@extends('layouts.dashboard')
@section('title','Edit Transaksi')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex">
            <div class="top-left-button-container mr-5">
                {{-- <div class="btn-group">
                    <div class="top-right-button-container">
                        <a href="{{ route('transaction.ready') }}" class="btn btn-outline-primary btn-lg">Back</a>
                    </div>
                </div> --}}
            </div>
            <h1>{{ $transaction->transaction_status_id!=5?'Detail':'Ambil' }} Pekerjaan</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="name">Kategori pesanan <small>(Wajib)</small></label>
                                <input type="text" readonly id="category_id" class="form-control" required value="{{ $transaction->category->name }}">
                                </select>
                            </div>
                            <div class="col">
                                <label for="title">Subjek pesanan <small>(Wajib)</small></label>
                                <input type="text" readonly id="title" class="form-control" required value="{{ $transaction->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note">Detail pesanan <small>(Wajib)</small></label>
                            <textarea readonly required cols="30" rows="5" class="form-control" >{{ $transaction->note }}</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="deadline">Deadline <small>(Wajib)</small></label>
                                <input type="date" readonly id="deadline" class="form-control" required value="{{ date('Y-m-d', strtotime($transaction->deadline)) }}">
                            </div>
                            <div class="col">
                                <label for="price">Harga</label>
                                <input type="number" readonly {{ $transaction->price==''?'autofocus':'' }} id="price" class="form-control" required value="{{ $transaction->price }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="soal">File-file pendukung/soal</label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">File Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($file as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td><a href="{{ $item->url }}" target="d_blank" class="badge badge-success badge-sm ml-4">Download </a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($transaction->transaction_status_id!=5)
                            <div class="form-group row">
                                <div class="col">
                                    <form name="update-form" id="update-form" action="{{ route('transaction.update',$transaction) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="progress-file">Upload Progress Pengerjaan (image/video/file)</label>
                                            <div class="d-flex">
                                                <input type="file" name="file_progress[]" required multiple class="form-control">
                                                <button class="badge badge-success badge-sm" onclick="submit()">Add File</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="form-group">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">File Name</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($file_progress as $item)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ $item->url }}" target="d_blank" class="badge badge-success badge-sm mr-2">Download </a>
                                                        <form name="delete_file_progress" id="delete_file_progress" action="{{ route('file.destroy',$item) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" form="delete_file_progress" class="badge badge-danger badge-sm ml-2">Delete </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col">
                                    <form name="update-form" id="update-form" action="{{ route('transaction.update',$transaction) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="progress-file">Ulpoad File Pekerjaan <strong>(tanda pekerjaan telah selesai)</strong></label>
                                            <div class="d-flex">
                                                <input type="file" name="file_finish[]" required multiple class="form-control">
                                                <button type="submit" class="badge badge-success badge-sm" onclick="return confirm('Apakah pekerjaan telah selesai?')">Add File</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="form-group">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">File Name</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($file_finish as $item)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ $item->url }}" target="d_blank" class="badge badge-success badge-sm mr-2">Download </a>
                                                        <form name="delete_file_finish" id="delete_file_finish" action="{{ route('file.destroy',$item) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" form="delete_file_finish" class="badge badge-danger badge-sm ml-2">Delete </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                        <form action="{{ route('transaction.take',$transaction) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success" onclick="return confirm('are you sure?')">Ambil Pekerjaan</button>
                        </form>
                        @endif
                    </div>
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
