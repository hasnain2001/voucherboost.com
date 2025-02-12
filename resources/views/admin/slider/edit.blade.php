@extends('admin.master')
@section('title', 'Update | Slider')
@section('main-content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-primary"><i class="fas fa-edit"></i> Update Slider</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle"></i> <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Validation error(s):</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Update Form -->
            <form name="UpdateSlider" id="UpdateSlider" method="POST" enctype="multipart/form-data" action="{{ route('admin.slider.update', $slider->id) }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-lg">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0"><i class="fas fa-image"></i> Edit Slider Details</h4>
                            </div>
                            <div class="card-body">
                                <!-- Title -->
                                <div class="form-group">
                                    <label for="title" class="font-weight-bold">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $slider->title }}" placeholder="Enter slider title" required>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description" class="font-weight-bold">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter slider description" required>{{ $slider->description }}</textarea>
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group">
                                    <label for="image" class="font-weight-bold">Slider Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file" name="image" id="image" onchange="previewImage(event)">
                                    
                                    <div class="mt-3">
                                        <label class="font-weight-bold">Current Image:</label><br>
                                        @if ($slider->image)
                                            <img src="{{ asset('uploads/slider/' . $slider->image) }}" class="img-thumbnail shadow-sm" style="max-width: 120px;">
                                        @else
                                            <span class="badge badge-secondary">No Image</span>
                                        @endif
                                    </div>
                                         {{-- Status --}}

                                    
                                    <!-- Preview container -->
                                    <div id="imagePreview" class="mt-3"></div>
                                </div>
                                <div class="form-group"></div>
                                <label for="status" class="font-weight-bold">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="active" {{ $slider->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $slider->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                                <!-- Submit Button -->
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="fas fa-save"></i> Update Slider
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- Image Preview Script -->
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.createElement('img');
            output.src = reader.result;
            output.classList.add("img-thumbnail", "shadow-sm");
            output.style.maxWidth = "120px";
            document.getElementById('imagePreview').innerHTML = '';
            document.getElementById('imagePreview').appendChild(output);
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
