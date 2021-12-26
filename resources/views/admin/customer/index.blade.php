@extends('layouts.dashboard')
@section('title','Data Customer')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>List Customer</h1>
            <div class="top-right-button-container">
                <div class="btn-group">
                    <div class="top-right-button-container">
                        <a href="{{ route('customer.create') }}" class="btn btn-outline-primary btn-lg">TAMBAH DATA</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
        <div class="card">
            <div class="card-body">
                <table id="table" class="data-table  nowrap"
                data-order="[[ 1, &quot;desc&quot; ]]">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Hp/Telepon</th>
                        <th>Tanggal daftar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>+{{ $item->phone }}</td>
                            <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('customer.edit',$item) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('customer.destroy',$item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
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
@endsection
@section('js')
<script>
    $('#table').dataTable();
</script>
@endsection
