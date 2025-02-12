@extends('admin.master')
@section('title')
    Create
@endsection
@section('main-content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create language</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <form name="Createlanguage" id="Createlanguage" method="POST" action="{{ route('admin.lang.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">language Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="code">language code /fr/es/de/ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="code" id="code" required>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                 
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                       
                        <a href="{{ route('admin.lang') }}" class="btn btn-secondary">Cancel</a>
                        <button type="reset" class="btn btn-dark">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection