@extends('layouts.dashboard')
@section('title','Dashboard | '.Auth::user()->name)
@section('content')
<div class="icon-cards-row">
    <div class="glide dashboard-numbers">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <li class="glide__slide">
                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="simple-icon-user"></i>
                            <p class="card-text mb-0">Transaksi Success</p>
                            <p class="lead text-center">{{ $count['finish'] }}</p>
                        </div>
                    </a>
                </li>
                <li class="glide__slide">
                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-female-2"></i>
                            <p class="card-text mb-0">Transaksi On Progress</p>
                            <p class="lead text-center">{{ $count['progress'] }}</p>
                        </div>
                    </a>
                </li>
                @if (Auth::user()->role_id==1)
                <li class="glide__slide">
                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-arrow-refresh"></i>
                            <p class="card-text mb-0">Transaksi Pending</p>
                            <p class="lead text-center">{{ $count['pending'] }}</p>
                        </div>
                    </a>
                </li>
                @else
                <li class="glide__slide">
                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-arrow-refresh"></i>
                            <p class="card-text mb-0">Rating</p>
                            <p class="lead text-center">{{ $rating }}</p>
                        </div>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>{{ Auth::user()->role_id==1?'Transaksi Masuk':'On progress' }}</h1>
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
                                                    <strong class="alert alert-primary">Revisi</strong>
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
                                            <a href="{{ $item->transaction_status_id==1?route('transaction.show',['transaction'=>$item->id]):route('transaction.get',['transaction'=>$item->id]) }}" target="d_blank" class="btn btn-sm btn-info">Detail</a>
                                            <a href="{{ route('transaction.edit',['transaction'=>$item->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('transaction.destroy',['transaction'=>$item->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                            @else
                                                @if ($item->transaction_status_id==5||$item->transaction_status_id==2)
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
@endsection

@section('js')
<script>
    $('#table').dataTable();
</script>
@endsection
