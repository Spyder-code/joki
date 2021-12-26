@extends('layouts.dashboard')
@section('title','Data Transaksi')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>List Transaksi</h1>
            @if (Auth::user()->role_id==1)
            <div class="top-right-button-container">
                <div class="btn-group">
                    <div class="top-right-button-container">
                        <a href="{{ route('transaction.create') }}" class="btn btn-outline-primary btn-lg">TAMBAH DATA</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

<div class="row">
    <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="data-table  nowrap" data-order="[[ 1, &quot;desc&quot; ]]">
                        <thead>
                            <tr>
                                <th>No</th>
                                @if (Auth::user()->role_id==1)
                                <th>Nama Customer</th>
                                @endif
                                <th>Category</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if (Auth::user()->role_id==1)
                                    <td>{{ $item->user->name }}</td>
                                    @endif
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->price==null?'--.---':$item->price }}</td>
                                    <td>{{ date('d F Y', strtotime($item->deadline)) }}</td>
                                    <td>
                                        <span>
                                            @if ($item->transaction_status_id==1)
                                                <strong class="alert alert-secondary">Pending</strong>
                                            @elseif($item->transaction_status_id==2)
                                                <strong class="alert alert-warning">On progress</strong>
                                            @elseif($item->transaction_status_id==3)
                                                <strong class="alert alert-success">Success</strong>
                                            @elseif($item->transaction_status_id==4)
                                                <strong class="alert alert-danger">Cancel</strong>
                                            @elseif($item->transaction_status_id==5)
                                                <strong class="alert alert-primary">Ready</strong>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="d-flex justify-content-between">
                                        @if (Auth::user()->role_id==1)

                                            @if ($item->transaction_status_id==1)
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#item-{{ $loop->iteration }}">Konfirmasi</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="item-{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="item-{{ $loop->iteration }}Label" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{ route('transaction.confirmation',$item) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title">Konfirmasi Pesanan</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Harga</label>
                                                                        <input type="number" name="price" id="price" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group" id="freelance-tipe-1">
                                                                        <label for="freelance">Freelance <small>(Optional)</small></label>
                                                                        <select name="freelance_id" id="freelance-tipe"  class="select2s form-control">
                                                                            <option value="" selected></option>
                                                                            @foreach ($user as $us)
                                                                                <option value="{{ $us->id }}">{{ $us->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure?')">Konfirmasi</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        @if ($item->transaction_status_id==2 || $item->transaction_status_id==3|| $item->transaction_status_id==4)
                                        <a href="https://wa.me/{{ hp($item->freelance->user->phone) }}" target="d_blank" class="btn btn-sm btn-success">Whats App</a>
                                        @endif
                                        <a href="{{ $item->transaction_status_id==1?route('transaction.show',['transaction'=>$item->id]):route('transaction.get',['transaction'=>$item->id]) }}" target="d_blank" class="btn btn-sm btn-info">Detail</a>
                                        <a href="{{ route('transaction.edit',['transaction'=>$item->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('transaction.destroy',['transaction'=>$item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                        @else
                                            @if ($item->transaction_status_id==5||$item->transaction_status_id==2||$item->transaction_status_id==3)
                                            <a href="{{ route('transaction.get',$item) }}" class="btn btn-sm btn-info">Detail Pekerjaan</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@php
    function hp($nohp) {
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 2)=='62'){
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '62'.substr(trim($nohp), 1);
            }
        }
        return $hp;
    }
@endphp
@endsection
@section('js')
<script>
    $('#table').dataTable();
</script>
@endsection
