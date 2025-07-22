@extends('admin.master')
@section('title')
    Update Store
@endsection
@section('styles')
    <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgb(248, 10, 10);
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
        input {
            color: darkblue;
        }
    </style>
@endsection
@section('main-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-store-alt"></i> Update Store</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.stores') }}">Stores</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                            <li class="breadcrumb-item active">{{ $stores->name }}</li>
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
                <form name="UpdateStore" id="UpdateStore" method="POST" enctype="multipart/form-data" action="{{ route('admin.store.update', $stores->id) }}">
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
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $stores->name }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">URL Slug <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ url('/store/') }}/</span>
                                            </div>
                                            <input type="text" class="form-control" name="slug" id="slug" value="{{ $stores->slug }}" required>
                                        </div>
                                        <small id="slug-message" class="form-text"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Short Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="2">{{ $stores->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="url">Store Website URL <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                            </div>
                                            <input type="url" class="form-control" name="url" id="url" value="{{ $stores->url }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="destination_url">Affiliate URL <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                                            </div>
                                            <input type="url" class="form-control" name="destination_url" id="destination_url" value="{{ $stores->destination_url }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                        <input type="text" class="form-control" name="title" id="title" value="{{ $stores->title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keywords <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ $stores->meta_keyword }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="3">{{ $stores->meta_description }}</textarea>
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
                                                    <label class="btn btn-outline-success {{ $stores->status == 'enable' ? 'active' : '' }}">
                                                        <input type="radio" name="status" value="enable" {{ $stores->status == 'enable' ? 'checked' : '' }}> Enable
                                                    </label>
                                                    <label class="btn btn-outline-danger {{ $stores->status == 'disable' ? 'active' : '' }}">
                                                        <input type="radio" name="status" value="disable" {{ $stores->status == 'disable' ? 'checked' : '' }}> Disable
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Top Store <span class="text-danger">*</span></label>
                                                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary {{ $stores->top_store == 0 ? 'active' : '' }}">
                                                        <input type="radio" name="top_store" value="0" {{ $stores->top_store == 0 ? 'checked' : '' }}> Regular
                                                    </label>
                                                    <label class="btn btn-outline-warning {{ $stores->top_store == 1 ? 'active' : '' }}">
                                                        <input type="radio" name="top_store" value="1" {{ $stores->top_store == 1 ? 'checked' : '' }}> Top Store
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="network">Affiliate Network <span class="text-danger">*</span></label>
                                        <select name="network" id="network" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Select Network --</option>
                                            @foreach ($networks as $network)
                                                <option value="{{ $network->title }}" {{ $stores->network == $network->title ? 'selected' : '' }}>
                                                    {{ $network->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category <span class="text-danger">*</span></label>
                                        <select name="category" id="category" class="form-control select2" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->slug }}" {{ $stores->category == $category->slug ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="lang">Language <span class="text-danger">*</span></label>
                                        <select name="language_id" id="lang" class="form-control select2">
                                            <option value="">-- Select Language --</option>
                                            @foreach ($langs as $lang)
                                                <option value="{{ $lang->id }}" {{ $stores->language_id == $lang->id ? 'selected' : '' }}>
                                                    {{ $lang->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="store_image">Store Logo <span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="store_image" id="store_image">
                                            <label class="custom-file-label" for="store_image">Choose file</label>
                                        </div>
                                        <small class="form-text text-muted">Recommended size: 300x300 pixels</small>
                                        <div class="mt-2 text-center" id="imagePreview">
                                            @if($stores->store_image)
                                                <img src="{{ asset('uploads/stores/'.$stores->store_image) }}" class="img-thumbnail" style="max-height: 150px;" id="previewImage">
                                                <input type="hidden" name="previous_image" value="{{ $stores->store_image }}">
                                            @else
                                                <img src="{{ asset('admin/dist/img/default-store.png') }}" class="img-thumbnail" style="max-height: 150px;" id="previewImage">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                        <textarea name="about" id="about" class="form-control" rows="5">{{ $stores->about }}</textarea>
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
                                        <textarea id="editor" name="content" >{!! $stores->content !!}</textarea>
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
                                        <i class="fas fa-save mr-1"></i> Update Store
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

@section('scripts')
      <script>
            // Filter non-alphabetic characters in the 'name' input field and auto-fill 'slug' and 'destination_url'
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');
            const destinationUrlInput = document.getElementById('url');

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
        </script>
    <script>
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
@endsection


