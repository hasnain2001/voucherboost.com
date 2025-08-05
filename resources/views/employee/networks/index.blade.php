@extends('employee.layouts.datatable')
@section('datatable-title')
    Networks
@endsection
@section('datatable-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Networks</h1>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a href="{{ route('employee.network.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b>{{ session('success') }}</b>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="SearchTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Network Name</th>
                                            <th>Status</th>
                                            <th>Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($networks as $network)
                                            <tr>
                                                <td>{{ $network->title }}</td>
                                                <td>
                                                    @if ($network->status == "disable")
                                                        <i class="fa fa-fw fa-times-circle"></i>
                                                    @else
                                                        <i class="fa fa-fw fa-check-circle"></i>
                                                    @endif
                                                </td>
                                                <td>{{ $network->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('employee.network.edit', $network->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                    <a href="{{ route('employee.network.delete', $network->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
