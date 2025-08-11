@extends('admin.layouts.master')
@section('title')
    Update
@endsection
@section('main-content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Network</h1>
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

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form name="UpdateNetwork" id="UpdateNetwork" method="POST" action="{{ route('admin.lang.update', $language->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Network Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $language->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="code">language code /en  /fr/es/de/ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="code" id="code" value="{{ $language->code }}" required>
                                </div>
                                  <div class="form-group mb-0">
                                    <label for="flag" class="font-weight-bold">Country Flag <span class="text-danger">*</span></label>
                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" name="flag" id="flag" accept="image/png,image/jpeg">
                                        <label class="custom-file-label" for="flag">Choose flag image</label>
                                    </div>
                                    <small class="form-text text-muted">Recommended: 16:9 ratio, PNG format</small>
                                    <div class="mt-2" id="flag-preview-container" style="display:none;">
                                        <img id="flag-preview" src="#" alt="Flag Preview" class="img-thumbnail border" style="max-width: 100px; max-height: 60px;">
                                    </div>
                                    <div class="mt-2">
                                        <img src="{{ asset('uploads/flags/' . $language->flag) }}"
                                             class="rounded border"
                                             alt="{{ $language->name }}"
                                             width="60"
                                             onerror="this.onerror=null;this.src='{{ asset('assets/images/no-image-found.png') }}'"
                                             loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            {{-- <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label><br>
                                    <input type="radio" name="status" id="enable" {{ $language->status == 'enable' ? 'checked' : '' }} value="enable">&nbsp;<label for="enable">Enable</label>
                                    <input type="radio" name="status" id="disable" {{ $language->status == 'disable' ? 'checked' : '' }} value="disable">&nbsp;<label for="disable">Disable</label>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.network') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    // Show selected file name
    document.querySelector('.custom-file-input').addEventListener('change', function(e){
        var fileName = document.getElementById("flag").files[0]?.name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    });

    // Preview flag image
    document.getElementById('flag').addEventListener('change', function(event){
        const [file] = event.target.files;
        if(file){
            const preview = document.getElementById('flag-preview');
            preview.src = URL.createObjectURL(file);
            document.getElementById('flag-preview-container').style.display = 'block';
        }
    });
</script>
@endpush
