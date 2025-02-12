@extends('admin.datatable')
@section('datatable-title')
    Sliders
@endsection
@section('datatable-content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sliders</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">Add New</a>
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
                                        <th>Slider Name</th>
                                        <th>Description</th>
                                        <th>Slider Image</th>
                                        <th>Added</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $slider->title }}</td>
                                            <td>{{ $slider->description }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/slider/'.$slider->image) }}" alt="{{ $slider->title }}" style="width: 100px;">
                                            </td>
                                            <td>
                                                {{ $slider->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                                            </td>
                                            <td>{{ $slider->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.slider.delete', $slider->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm">Delete</a>
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
    </section>


@endsection
