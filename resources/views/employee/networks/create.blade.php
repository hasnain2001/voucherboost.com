@extends('employee.master')
@section('title')
    Create
@endsection
@section('main-content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Network</h1>
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
            <form name="CreateNetwork" id="CreateNetwork" method="POST" action="{{ route('employee.network.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Network Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label><br>
                                    <input type="radio" name="status" id="enable" checked value="enable">&nbsp;<label for="enable">Enable</label>
                                    <input type="radio" name="status" id="disable" value="disable">&nbsp;<label for="disable">Disable</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('employee.network') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection