@extends('admin.layouts.master')
@section('title')
    Create Store
@endsection
@push('styles')
    <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        .card-title {
            font-weight: 600;
            color: #444;
        }
        .select2-container--bootstrap4 .select2-selection--single {
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
        }
        .btn-group-toggle label {
            margin-bottom: 0;
        }
        #imagePreview {
            border: 1px dashed #ccc;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .custom-file-label::after {
            content: "Browse";
        }
        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
@endpush

@section('main-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-store-alt"></i> Create New Store</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.stores') }}">Stores</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- Alerts Section -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle mr-2"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Please fix the following issues:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Main Form -->
                <form name="CreateStore" id="CreateStore" method="POST" enctype="multipart/form-data" action="{{ route('admin.store.store') }}">
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Basic Information</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Store Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-store"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="e.g. Amazon" required>
                                        </div>
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">URL Slug <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ url('/store/') }}/</span>
                                            </div>
                                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" required>
                                        </div>
                                        <small id="slug-message" class="form-text"></small>
                                        @error('slug')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Short Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="2" placeholder="Brief description about the store">{{ old('description') }}</textarea>
                                        @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="url">Store Website URL <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                            </div>
                                            <input type="url" class="form-control" name="url" id="url" value="{{ old('url') }}" placeholder="https://www.example.com" required>
                                        </div>
                                        @error('url')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="destination_url">Affiliate URL <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                                            </div>
                                            <input type="url" class="form-control" name="destination_url" id="destination_url" value="{{ old('destination_url') }}" placeholder="https://www.example.com/affiliate" required>
                                        </div>
                                        @error('destination_url')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Store Settings</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status <span class="text-danger">*</span></label>
                                                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                                    <label class="btn btn-outline-success {{ old('status', 'enable') == 'enable' ? 'active' : '' }}">
                                                        <input type="radio" name="status" value="enable" {{ old('status', 'enable') == 'enable' ? 'checked' : '' }}> Enable
                                                    </label>
                                                    <label class="btn btn-outline-danger {{ old('status') == 'disable' ? 'active' : '' }}">
                                                        <input type="radio" name="status" value="disable" {{ old('status') == 'disable' ? 'checked' : '' }}> Disable
                                                    </label>
                                                </div>
                                                @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Top Store <span class="text-danger">*</span></label>
                                                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary {{ old('top_store', 0) == 0 ? 'active' : '' }}">
                                                        <input type="radio" name="top_store" value="0" {{ old('top_store', 0) == 0 ? 'checked' : '' }}> Regular
                                                    </label>
                                                    <label class="btn btn-outline-warning {{ old('top_store') == 1 ? 'active' : '' }}">
                                                        <input type="radio" name="top_store" value="1" {{ old('top_store') == 1 ? 'checked' : '' }}> Top Store
                                                    </label>
                                                </div>
                                                @error('top_store')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="network">Affiliate Network <span class="text-danger">*</span></label>
                                        <select name="network" id="network" class="form-control select2" style="width: 100%;">
                                            <option value="" disabled {{ old('network') ? '' : 'selected' }}>-- Select Network --</option>
                                            @foreach ($networks as $network)
                                                <option value="{{ $network->title }}" {{ old('network') == $network->title ? 'selected' : '' }}>
                                                    {{ $network->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('network')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                     <div class="mb-3">
                                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-select" required>
                                            <option value="" disabled selected>-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" data-language="{{ $category->language_id ?? '' }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="language_id" class="form-label">Language <span class="text-danger">*</span></label>
                                        <select name="language_id" id="language_id" class="form-select" required>
                                            <option value="" disabled selected>-- Select Language --</option>
                                            @foreach ($langs as $language)
                                                <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                                    {{ $language->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="store_image">Store Logo <span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="store_image" id="store_image" required>
                                            <label class="custom-file-label" for="store_image">Choose file</label>
                                        </div>
                                        <small class="form-text text-muted">Recommended size: 300x300 pixels</small>
                                        <div class="mt-2 text-center" id="imagePreview">
                                            <img src="{{ asset('images/default-store.png') }}" class="img-thumbnail" style="max-height: 150px;" id="previewImage">
                                        </div>
                                        @error('store_image')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-secondary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">SEO Settings</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Optimized title for search engines">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keywords <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword') }}" placeholder="comma, separated, keywords">
                                        @error('meta_keyword')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="3" placeholder="Brief description for search engine results">{{ old('meta_description') }}</textarea>
                                        @error('meta_description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-secondary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Additional Information</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="about">About Store</label>
                                        <textarea name="about" id="about" class="form-control" rows="3" placeholder="Detailed information about the store">{{ old('about') }}</textarea>
                                        @error('about')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Editor -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Store Content</h3>
                                         <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea id="editor" name="content" >{{ old('content') }}</textarea>
                                        @error('content')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="fas fa-save mr-1"></i> Save Store
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary px-4 ml-2">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </button>
                                    <a href="{{ route('admin.stores') }}" class="btn btn-danger px-4 ml-2">
                                        <i class="fas fa-times mr-1"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>


@endsection
@push('scripts')
    <script>
            // Filter non-alphabetic characters in the 'name' input field and auto-fill 'slug' and 'destination_url'
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');
            const destinationUrlInput = document.getElementById('url');
            const langSelect = document.getElementById('lang');

            nameInput.addEventListener('input', () => {
                const value = nameInput.value;

                // Filter out non-alphabetic characters (keeping spaces)
                const filteredValue = value.replace(/[^A-Za-z\s]/g, '');

                // Generate display slug (keep spaces but clean up multiple spaces)
                const displaySlug = filteredValue.toLowerCase().replace(/\s+/g, ' ').trim();

                // Generate URL-friendly slug (replace spaces with hyphens)
                const urlSlug = displaySlug.replace(/\s+/g, '-');

                // Generate destination URL
                const currentUrl = window.location.origin;
                const generatedDestinationUrl = currentUrl + '/store/' + urlSlug;

                // Update slug field with display version (with spaces)
                if (!slugInput.value || slugInput.value === slugInput.dataset.previousGenerated) {
                    slugInput.value = displaySlug;
                    slugInput.dataset.previousGenerated = displaySlug;
                    checkSlugExistence(urlSlug); // Check using the URL-friendly version
                }

                // Update destination URL with hyphenated version
                destinationUrlInput.value = generatedDestinationUrl;
                destinationUrlInput.dataset.previousGenerated = generatedDestinationUrl;
            });

            // Existing slug check functionality (modified to check URL-friendly version)
            $(document).ready(function() {
                $('#slug').on('keyup', function() {
                    var displaySlug = $(this).val();
                    var urlSlug = displaySlug.replace(/\s+/g, '-');
                    if (urlSlug) {
                        checkSlugExistence(urlSlug);
                    } else {
                        $('#slug-message').text('Please enter a slug').css('color', 'black');
                    }
                });
            });

          // Function to check if the slug exists
            function checkSlugExistence(slug) {
                $.ajax({
                    url: '{{ route('check.slug') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        slug: slug
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#slug-message').text('Store already exists').css('color', 'red');
                        } else {
                            $('#slug-message').text('Store is available').css('color', 'green');
                        }
                    }
                });
            }
            // JavaScript to handle image preview and update label with file name
                document.getElementById('store_image').addEventListener('change', function(event) {
                const file = event.target.files[0]; // Get the selected file
                const previewImage = document.querySelector('#imagePreview img'); // Get the image preview element
                const fileLabel = document.querySelector('label[for="store_image"]'); // Get the file input label

                if (file) {
                const reader = new FileReader(); // Create a FileReader object

                // Set up the FileReader to update the image source
                reader.onload = function(e) {
                previewImage.src = e.target.result; // Set the image source to the file's data URL
                previewImage.style.display = 'block'; // Show the image preview
                };

                reader.readAsDataURL(file); // Read the file as a data URL
                fileLabel.textContent = file.name; // Update the label with the file name
                } else {
                previewImage.src = '{{ asset('images/default-store.png') }}'; // Reset to default image
                previewImage.style.display = 'block'; // Show the default image
                fileLabel.textContent = 'Choose file'; // Reset the label text
                }
                });
    </script>
@endpush


