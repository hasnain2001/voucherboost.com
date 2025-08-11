@extends('admin.layouts.datatable')

@section('datatable-title')
  Deleted Stores
@endsection
<style>
    .content-wrapper {
        padding: 20px;
        background-color: #f8f9fa;
    }
    h1 {
        font-family: 'Arial', sans-serif;
        font-size: 28px;
        color: #343a40;
    }
    .table {
        border: 1px solid #dee2e6;
        margin-bottom: 20px;
    }
    .table th {
        background-color: #000000;
        color: #fff;
        font-weight: bold;
    }
    .table td {
        color: #495057;
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f3f5;
    }
</style>
@section('datatable-content')
<div class="content-wrapper">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <h1 class="text-center mb-4">Deleted Stores</h1>
    <div class="table-responsive">
        <table id="SearchTable" class="table table-bordered table-hover table-striped align-middle text-center">
            <thead class="bg-primary text-white">
                <tr>
                    <th>ID</th>
                    <th>Store Name</th>
                    <th>Deleted By</th>
                    <th>Role User</th>
                    <th>Deleted At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedStores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->store_name }}</td>
                        <td>{{ $store->deletedBy->name ?? 'Unknown' }}</td>
                        <td>{{ $store->deletedBy->role ?? 'Unknown' }}</td>
<td><span class=" text-dark" data-bs-toggle="tooltip" title="{{ $store->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
{{ $store->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
</span></td>

<td><a href="{{ route('admin.delete-store-delete', $store->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
