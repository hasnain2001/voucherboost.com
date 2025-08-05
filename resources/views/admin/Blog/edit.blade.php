@extends('admin.master')
@section('title', 'Update Blog')
@push('styles')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        border: none;
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
        background: linear-gradient(135deg, #434343 0%, #000000 100%);
        padding: 1.5rem;
        color: white;
    }

    .content-header {
        background: transparent;
        padding: 15px 0;
    }

    .form-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #eaeaea;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #495057;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-right: 8px;
    }

    .preview-image {
        max-height: 150px;
        border-radius: 5px;
        margin-top: 10px;
        border: 1px solid #ddd;
        padding: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, #434343 0%, #000000 100%);
        border: none;
        transition: all 0.3s;
        padding: 10px 25px;
        font-weight: 500;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .btn-reset {
        background: #6c757d;
        border: none;
        transition: all 0.3s;
        padding: 10px 25px;
        font-weight: 500;
    }

    .btn-reset:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-cancel {
        background: #dc3545;
        border: none;
        transition: all 0.3s;
        padding: 10px 25px;
        font-weight: 500;
    }

    .btn-cancel:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .required-asterisk {
        color: #dc3545;
    }

    #slug-message {
        font-size: 0.85rem;
        margin-top: 0.25rem;
        font-weight: 500;
    }

    .ck-editor__editable {
        min-height: 300px;
        border-radius: 5px;
    }

    .current-image {
        max-width: 200px;
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 5px;
        margin-top: 10px;
    }

    .image-preview-container {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 15px;
    }

    .custom-file-label::after {
        content: "Browse";
    }

    .alert {
        border-radius: 5px;
    }
</style>
@endpush

@section('main-content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="fas fa-edit mr-2"></i>Update Blog
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blog.show') }}">Blogs</a></li>
                        <li class="breadcrumb-item active">Update</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle mr-2"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>Validation error(s):</strong>
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form name="UpdateCategory" id="UpdateCategory" method="POST" enctype="multipart/form-data" action="{{ route('admin.Blog.update', $blog->id) }}">
                @csrf
                @method('PUT')

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-pen-fancy mr-1"></i>Edit Blog Details
                                </h3>
                            </div>

                            <div class="card-body">
                                <!-- Blog Content Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-file-alt mr-2"></i>Blog Content
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">
                                                    Title <span class="required-asterisk">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="title" id="title"
                                                       value="{{ old('title', $blog->title) }}" required
                                                       placeholder="Enter blog title">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="slug">
                                                    Slug/URL <span class="required-asterisk">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="slug" id="slug"
                                                       value="{{ old('slug', $blog->slug) }}" required
                                                       placeholder="Auto-generated slug">
                                                <span id="slug-message" class="d-block"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="blog_image">
                                            Featured Image <span class="required-asterisk">*</span>
                                        </label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="category_image" id="blog_image">
                                            <label class="custom-file-label" for="blog_image">
                                                {{ asset($blog->image) ? 'Change image' : 'Choose image file' }}
                                            </label>

                                                 <img src="{{ asset($blog->image) }}" alt="Blog Image" class="img-thumbnail" style="height: 50px; width:100px;">
                                        </div>
                                        <small class="form-text text-muted">
                                            Recommended size: 1200x630 pixels (Max 2MB)
                                        </small>

                                        <div class="image-preview-container">
                                            @if ($blog->category_image)
                                                <div>
                                                    <p class="mb-1">Current Image:</p>
                                                    <img src="{{ asset($blog->category_image) }}" alt="Current Blog Image"
                                                         class="current-image img-fluid">
                                                </div>
                                            @endif
                                            <div id="imagePreview"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="editor">
                                            Content <span class="required-asterisk">*</span>
                                        </label>
                                        <textarea name="content" id="editor" class="form-control" rows="10">
                                            {!! old('content', $blog->content) !!}
                                        </textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">
                                                    Category <span class="required-asterisk">*</span>
                                                </label>
                                                <select name="category_id" id="category" class="form-control" required>
                                                    <option value="" disabled>Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group pt-4">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="top"
                                                           id="top" value="top"
                                                           {{ old('top', $blog->top) == 'top' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="top">
                                                        Featured Blog Post
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Store & Language Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-store mr-2"></i>Store & Language Settings
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="store_id">
                                                    Store <span class="required-asterisk">*</span>
                                                </label>
                                                <select name="store_id" id="store_id" class="form-control"
                                                        onchange="updateDestinationAndLanguage()" required>
                                                    <option value="" disabled {{ old('store_id') ? '' : 'selected' }}>
                                                        Select Store
                                                    </option>
                                                    @foreach($stores as $store)
                                                        <option value="{{ $store->id }}"
                                                                data-language-id="{{ $store->language_id }}"
                                                                {{ old('store_id', $blog->store_id) == $store->id ? 'selected' : '' }}>
                                                            {{ $store->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="language_id">
                                                    Language <span class="required-asterisk">*</span>
                                                </label>
                                                <select name="language_id" id="language_id" class="form-control" required>
                                                    <option value="" disabled {{ old('language_id') ? '' : 'selected' }}>
                                                        Select Language
                                                    </option>
                                                    @foreach($langs as $language)
                                                        <option value="{{ $language->id }}"
                                                            {{ old('language_id', $blog->language_id) == $language->id ? 'selected' : '' }}>
                                                            {{ $language->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SEO Settings Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-search mr-2"></i>SEO Settings
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_title">
                                            Meta Title <span class="required-asterisk">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="meta_title" id="meta_title"
                                               value="{{ old('meta_title', $blog->meta_title) }}"
                                               placeholder="Enter meta title for SEO">
                                        <small class="form-text text-muted">
                                            Recommended: 50-60 characters
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keyword">
                                            Meta Keywords
                                        </label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword"
                                               value="{{ old('meta_keyword', $blog->meta_keyword) }}"
                                               placeholder="Enter comma-separated keywords">
                                        <small class="form-text text-muted">
                                            Example: blog, article, news
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">
                                            Meta Description
                                        </label>
                                        <textarea name="meta_description" id="meta_description" class="form-control"
                                                  rows="4" placeholder="Enter meta description">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                        <small class="form-text text-muted">
                                            Recommended: 150-160 characters
                                        </small>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="form-group mt-4 text-right">
                                    <button type="reset" class="btn btn-reset text-white mr-2">
                                        <i class="fas fa-undo mr-2"></i>Reset
                                    </button>
                                    <a href="{{ route('admin.blog.show')}}" class="btn btn-cancel text-white mr-2">
                                        <i class="fas fa-times mr-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-submit text-white">
                                        <i class="fas fa-save mr-2"></i>Update Blog
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
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                    'blockQuote', 'insertTable', 'undo', 'redo', '|',
                    'codeBlock', 'imageUpload', 'mediaEmbed'
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });

    // Update language based on selected store
    function updateDestinationAndLanguage() {
        updateLanguageFromStore();
    }

    function updateLanguageFromStore() {
        const storeSelect = document.getElementById('store_id');
        const selectedOption = storeSelect.options[storeSelect.selectedIndex];
        const languageId = selectedOption.getAttribute('data-language-id');

        if (languageId) {
            const languageSelect = document.getElementById('language_id');
            for (let i = 0; i < languageSelect.options.length; i++) {
                if (languageSelect.options[i].value == languageId) {
                    languageSelect.selectedIndex = i;
                    break;
                }
            }
        }
    }

    // Image preview functionality
    document.getElementById('blog_image').addEventListener('change', function() {
        const file = this.files[0];
        const preview = document.getElementById('imagePreview');
        const label = this.nextElementSibling;

        if (file) {
            // Validate file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size exceeds 2MB limit');
                this.value = '';
                label.textContent = 'Choose image file';
                preview.innerHTML = '';
                return;
            }

            // Validate image type
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Only JPEG, PNG, and GIF images are allowed');
                this.value = '';
                label.textContent = 'Choose image file';
                preview.innerHTML = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                preview.innerHTML = `
                    <div>
                        <p class="mb-1">New Image Preview:</p>
                        <img src="${event.target.result}" class="preview-image img-fluid" alt="Preview">
                        <p class="mt-1 text-muted small">${file.name}</p>
                    </div>
                `;
            }
            reader.readAsDataURL(file);
            label.textContent = file.name;
        } else {
            preview.innerHTML = '';
            label.textContent = 'Choose image file';
        }
    });

    // Auto-generate slug from title
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    titleInput.addEventListener('input', () => {
        const value = titleInput.value;
        // Convert to slug format (lowercase, replace spaces with dashes, remove special chars)
        const slug = value.toLowerCase()
                         .replace(/[^\w\s]/g, '')
                         .replace(/\s+/g, ' ')
                         .replace(/-+/g, ' ');
        slugInput.value = slug;

        // Check slug availability
        if (slug) {
            checkSlugExistence(slug);
        }
    });

    // Check slug availability when typing in slug field
    slugInput.addEventListener('keyup', function() {
        const slug = this.value;
        if (slug) {
            checkSlugExistence(slug);
        } else {
            document.getElementById('slug-message').textContent = 'Please enter a slug';
        }
    });

    // AJAX function to check slug existence
    function checkSlugExistence(slug) {
        // Don't check if the slug hasn't changed from the original
        if (slug === '{{ $blog->slug }}') {
            document.getElementById('slug-message').textContent = '✅ Current URL';
            document.getElementById('slug-message').style.color = 'green';
            return;
        }

        $.ajax({
            url: '{{ route('blog.check.slug') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                slug: slug
            },
            success: function(response) {
                const slugMessage = document.getElementById('slug-message');
                if (response.exists) {
                    slugMessage.textContent = '❌ This URL is already in use';
                    slugMessage.style.color = 'red';
                } else {
                    slugMessage.textContent = '✅ This URL is available';
                    slugMessage.style.color = 'green';
                }
            },
            error: function(xhr) {
                console.error('Error checking slug:', xhr.responseText);
            }
        });
    }

    // Initialize the form with proper slug check
    $(document).ready(function() {
        // Check the initial slug value
        if ($('#slug').val()) {
            checkSlugExistence($('#slug').val());
        }
    });
</script>
@endpush
