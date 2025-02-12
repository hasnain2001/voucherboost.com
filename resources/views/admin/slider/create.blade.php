@extends('admin.master')
@section('title', 'Create | Slider')
@section('main-content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Create Slider</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body">
                            <form name="CreateSlider" id="CreateSlider" method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                                @csrf
                                
                                {{-- Title --}}
                                <div class="form-group mb-3">
                                    <label for="title" class="fw-bold">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control border-dark" name="title" id="title" value="{{ old('title') }}" >
                                </div>

                                {{-- Description --}}
                                <div class="form-group mb-3">
                                    <label for="description" class="fw-bold">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control border-dark" name="description" id="description" rows="3" >{{ old('description') }}</textarea>
                                </div>

                                {{-- Image Upload --}}
                                <div class="form-group mb-3">
                                    <label for="image" class="fw-bold">Slider Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control border-dark" name="image" id="image" required onchange="previewImage(event)">
                                    <div id="imagePreview" class="mt-3"></div>
                                </div>

                                {{-- Status --}}
                                <div class="form-group mb-4">
                                    <label for="status" class="fw-bold">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control border-dark" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                {{-- Submit Button --}}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark px-4 py-2 fw-bold">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

{{-- Image Preview Script --}}
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('imagePreview');
            output.innerHTML = `<img src="${reader.result}" class="img-thumbnail mt-2" width="200">`;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
