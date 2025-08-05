@extends('admin.master')
@section('title', 'Create | Slider')
@section('styles')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: none;
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
        padding: 1.25rem 1.5rem;
    }

    .section-title {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-right: 10px;
        font-size: 1.1rem;
        color: #6c757d;
    }

    .form-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid #4e73df;
    }

    .preview-image-container {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        min-height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .preview-image-container:hover {
        border-color: #adb5bd;
    }

    .preview-image-container.has-image {
        border-color: #28a745;
        background-color: rgba(40, 167, 69, 0.05);
    }

    .preview-image {
        max-width: 100%;
        max-height: 200px;
        border-radius: 6px;
    }

    .custom-file-label::after {
        content: "Browse";
        background-color: #e9ecef;
        color: #495057;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
        padding: 0.5rem 1.75rem;
        font-weight: 500;
    }

    .btn-outline-secondary {
        padding: 0.5rem 1.75rem;
        font-weight: 500;
    }

    .alert {
        border-radius: 8px;
    }

    .required-asterisk {
        color: #dc3545;
        font-weight: bold;
        margin-left: 3px;
    }
</style>
@endsection
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Slider</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.slider') }}">Sliders</a></li>
                        <li class="breadcrumb-item active">Create Slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0"><i class="fas fa-plus-circle mr-2"></i>Create New Slider</h3>
                        </div>

                        <div class="card-body p-4">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa fa-exclamation-triangle mr-2"></i> Please fix the following errors
                                <ul class="mt-2 mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <form name="CreateSlider" id="CreateSlider" method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                                @csrf

                                <!-- Slider Details Section -->
                                <div class="form-section">
                                    <h5 class="section-title"><i class="fas fa-info-circle mr-2"></i>Slider Details</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="title" class="form-label">Title <span class="required-asterisk">*</span></label>
                                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required placeholder="Enter slider title">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="form-label d-block">Status <span class="required-asterisk">*</span></label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status" id="status_active" value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="status_active">Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status" id="status_inactive" value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status_inactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="description" class="form-label">Description <span class="required-asterisk">*</span></label>
                                        <textarea class="form-control" name="description" id="description" rows="3" required placeholder="Enter slider description">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="url" class="form-label">Destination URL <span class="required-asterisk">*</span></label>
                                        <input type="url" class="form-control" name="url" id="url" value="{{ old('url') }}" required placeholder="https://example.com">
                                    </div>
                                </div>

                                <!-- Store Information Section -->
                                <div class="form-section">
                                    <h5 class="section-title"><i class="fas fa-store mr-2"></i>Store Information</h5>
                                    <div class="form-group mb-4">
                                        <label for="store_id" class="form-label">Store <span class="required-asterisk">*</span></label>
                                           <select name="store_id" id="store_id" class="form-select" onchange="updateSelections()" required aria-label="Default select example">
                                            <option value="" disabled {{ old('store_id') ? '' : 'selected' }}>-- Select Store --</option>
                                            @foreach($stores as $store)
                                                <option value="{{ $store->id }}"
                                                        data-language-id="{{ $store->language_id }}"
                                                        data-category-id="{{ $store->category_id }}"
                                                        {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                                    {{ $store->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class=" mb-4">
                                                <label for="language_id" class="form-label">Language <span class="required-asterisk">*</span></label>
                                                <select name="language_id" id="language_id" class="form-select" required>
                                                    <option value="" disabled {{ old('language_id') ? '' : 'selected' }}>-- Select Language --</option>
                                                    @foreach($languages as $language)
                                                        <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                                            {{ $language->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label for="category_id" class="form-label">Category <span class="required-asterisk">*</span></label>
                                                <select name="category_id" id="category_id" class="form-select" required>
                                                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Select Category --</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Upload Section -->
                                <div class="form-section">
                                    <h5 class="section-title"><i class="fas fa-image mr-2"></i>Slider Image</h5>
                                    <div class="form-group mb-0">
                                        <label for="image" class="form-label">Upload Image <span class="required-asterisk">*</span></label>
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" name="image" id="image" required onchange="previewImage(event)">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        <div class="alert alert-info p-2 mb-3">
                                            <small><i class="fas fa-info-circle mr-2"></i>Recommended size: 1200x400 pixels | Max file size: 2MB | Supported formats: JPEG, PNG</small>
                                        </div>
                                        <div class="preview-image-container" id="imagePreviewContainer">
                                            <span class="text-muted" id="noImageText"><i class="fas fa-image fa-2x mb-2 d-block"></i>No image selected</span>
                                            <img id="imagePreview" class="preview-image d-none img-fluid rounded">
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="text-center mt-4 pt-3">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save mr-2"></i> Create Slider
                                    </button>
                                    <a href="{{ route('admin.slider') }}" class="btn btn-outline-secondary px-4 ml-2">
                                        <i class="fas fa-times mr-2"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize selections based on initially selected store (if any)
        updateSelections();

        // Update custom file input label
        bsCustomFileInput.init();

        // Date validation (if you have a date field)
        const dateInput = document.getElementById('ending_date');
        if (dateInput) {
            dateInput.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    document.getElementById('dateError').style.display = 'block';
                    this.value = '';
                } else {
                    document.getElementById('dateError').style.display = 'none';
                }
            });
        }
    });

    function updateSelections() {
        const storeSelect = document.getElementById('store_id');
        const selectedOption = storeSelect.options[storeSelect.selectedIndex];
        const languageId = selectedOption.getAttribute('data-language-id');
        const categoryId = selectedOption.getAttribute('data-category-id');

        // Update language selection
        if (languageId) {
            const languageSelect = document.getElementById('language_id');
            for (let i = 0; i < languageSelect.options.length; i++) {
                if (languageSelect.options[i].value == languageId) {
                    languageSelect.selectedIndex = i;
                    break;
                }
            }
        }

        // Update category selection
        if (categoryId) {
            const categorySelect = document.getElementById('category_id');
            for (let i = 0; i < categorySelect.options.length; i++) {
                if (categorySelect.options[i].value == categoryId) {
                    categorySelect.selectedIndex = i;
                    break;
                }
            }
        }
    }

    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        const noImageText = document.getElementById('noImageText');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                noImageText.classList.add('d-none');
                previewImage.classList.remove('d-none');
                previewImage.setAttribute('src', e.target.result);
                previewContainer.classList.add('has-image');
            }

            reader.readAsDataURL(input.files[0]);

            // Update the file label
            const fileName = input.files[0].name;
            const label = input.nextElementSibling;
            label.textContent = fileName;
        }
    }
</script>
@endpush
