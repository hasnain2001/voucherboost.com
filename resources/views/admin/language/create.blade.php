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
            <form name="Createlanguage" id="Createlanguage" method="POST" action="{{ route('admin.lang.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">language Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" required  value="{{ old('name') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="code">language code /fr/es/de/ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="code" id="code" required  value="{{ old('code') }}" >
                                </div>

                            </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="flag" class="font-weight-bold">Country Flag <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="flag" id="flag" >
                                        <label class="custom-file-label" for="flag">Choose flag image</label>
                                    </div>
                                    <small class="form-text text-muted">Recommended: 16:9 ratio, PNG format</small>
                                    <div class="mt-2" id="flag-preview-container" style="display:none;">
                                        <img id="flag-preview" src="#" alt="Flag Preview" class="img-thumbnail" style="max-width: 100px; max-height: 60px;">
                                    </div>
                                </div>
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
@push('scripts')
<script>
    // Preview flag image before upload
    document.getElementById('flag').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('flag-preview');
                preview.src = e.target.result;
                document.getElementById('flag-preview-container').style.display = 'block';
            }
            reader.readAsDataURL(file);

            // Update the custom file label
            const label = document.querySelector('.custom-file-label');
            label.textContent = file.name;
        }
    });

    // Add bs-custom-file-input for better file input styling
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endpush
