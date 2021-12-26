@extends('layouts.dashboard')
@section('title','Data Freelance')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>List Freelance</h1>

            <div class="top-right-button-container">
                <div class="btn-group">
                    <button class="btn btn-outline-success btn-lg dropdown-toggle" type="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    EXPORT
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="dataTablesExcel" href="#">Excel</a>
                    <a class="dropdown-item" id="dataTablesPrint" href="#">Print</a>
                    <a class="dropdown-item" id="dataTablesPdf" href="#">Pdf</a>
                </div>
                <div class="top-right-button-container">
                    <a href="" class="btn btn-outline-primary btn-lg">
                        TAMBAH DATA</a>
                    </div>
                </div>

            </div>

            {{-- <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Library</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </nav> --}}
            <div class="mb-2">
                <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                role="button" aria-expanded="true" aria-controls="displayOptions">
                Display Options
                <i class="simple-icon-arrow-down align-middle"></i>
            </a>
            <div class="collapse dont-collapse-sm" id="displayOptions">
                <div class="d-block d-md-inline-block">
                    <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                        <input class="form-control" placeholder="Search Table" id="searchDatatable">
                    </div>
                </div>
                <div class="float-md-right dropdown-as-select" id="pageCountDatatable">
                    <span class="text-muted text-small">Displaying 1-10 of 40 items </span>
                    <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    10
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">5</a>
                    <a class="dropdown-item active" href="#">10</a>
                    <a class="dropdown-item" href="#">20</a>
                </div>
            </div>
        </div>
    </div>
    <div class="separator"></div>
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
                        <th class="empty">&nbsp;</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Hp/Telepon</th>
                        <th>Tanggal daftar</th>
                        <th class="empty">&nbsp;</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($freelance as $item)
                        <tr>
                            <td></td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                            <td></td>
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
