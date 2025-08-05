@extends('employee.layouts.master')
@section('title', 'Create | Blog')
@push('styles')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
        background: linear-gradient(135deg, #434343 0%, #000000 100%);
        padding: 1.5rem;
    }

    .card-header h4 {
        margin: 0;
        font-weight: 600;
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
    }

    .preview-image {
        max-height: 150px;
        border-radius: 5px;
        margin-top: 10px;
        border: 1px solid #ddd;
        padding: 5px;
    }

    .btn-submit {
        background: linear-gradient(135deg, #434343 0%, #000000 100%);
        border: none;
        transition: all 0.3s;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btn-reset {
        background: #6c757d;
        border: none;
        transition: all 0.3s;
    }

    .btn-reset:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .form-label {
        font-weight: 500;
        color: #495057;
    }

    #slug-message {
        font-size: 0.85rem;
        margin-top: 0.25rem;
        font-weight: 500;
    }

    .ck-editor__editable {
        min-height: 300px;
    }
</style>
@endpush
@section('main-content')
<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-white"><i class="fas fa-pen-fancy mr-2"></i> Create New Blog Post</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('employee.blog.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Success/Error Messages -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <strong>Validation error(s):</strong>
                                    <ul class="mb-0 pl-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Blog Content Section -->
                            <div class="form-section">
                                <div class="section-title">
                                    <i class="fas fa-file-alt mr-2"></i>Blog Content
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" id="title" required
                                                   value="{{ old('title') }}" placeholder="Enter blog title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slug">Slug / URL <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="slug" id="slug"
                                                   value="{{ old('slug') }}" required placeholder="Auto-generated slug">
                                            <span id="slug-message" class="d-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="blog_image">Featured Image <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="blog_image" required>
                                        <label class="custom-file-label" for="blog_image">Choose image file</label>
                                    </div>
                                    <small class="form-text text-muted">Recommended size: 1200x630 pixels</small>
                                    <div id="imagePreview" class="mt-3 text-center"></div>
                                </div>

                                <div class="form-group">
                                    <label for="editor">Main Content <span class="text-danger">*</span></label>
                                    <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content') }}</textarea>
                                    @error('content')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Category <span class="text-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group pt-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="top"
                                                       id="top" value="top" {{ old('top') == 'top' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="top">Featured Blog Post</label>
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
                                            <label for="store_id">Store <span class="text-danger">*</span></label>
                                            <select name="store_id" id="store_id" class="form-control"
                                                    onchange="updateDestinationAndLanguage()" required>
                                                <option value="" disabled {{ old('store_id') ? '' : 'selected' }}>Select Store</option>
                                                @foreach($stores as $store)
                                                    <option value="{{ $store->id }}"
                                                            data-language-id="{{ $store->language_id }}"
                                                            {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                                        {{ $store->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="language_id">Language <span class="text-danger">*</span></label>
                                            <select name="language_id" id="language_id" class="form-control" required>
                                                <option value="" disabled {{ old('language_id') ? '' : 'selected' }}>Select Language</option>
                                                @foreach($langs as $language)
                                                    <option value="{{ $language->id }}"
                                                        {{ old('language_id') == $language->id ? 'selected' : '' }}>
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
                                    <label for="meta_title">Meta Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                           value="{{ old('meta_title')}}" placeholder="Enter meta title for SEO">
                                    <small class="form-text text-muted">Recommended: 50-60 characters</small>
                                </div>

                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keywords</label>
                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword"
                                           value="{{ old('meta_keyword') }}" placeholder="Enter comma-separated keywords">
                                    <small class="form-text text-muted">Example: blog, article, news</small>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control"
                                              rows="4" placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
                                    <small class="form-text text-muted">Recommended: 150-160 characters</small>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-group mt-4">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-submit text-white w-50 mr-2">
                                        <i class="fas fa-save mr-2"></i>Publish Blog
                                    </button>
                                    <button type="reset" class="btn btn-reset text-white w-50 ml-2">
                                        <i class="fas fa-undo mr-2"></i>Reset Form
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'))
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

        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.innerHTML = `
                    <img src="${event.target.result}" class="preview-image img-fluid" alt="Preview">
                    <p class="mt-2 text-muted">${file.name}</p>
                `;
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }

        // Update custom file label
        const label = this.nextElementSibling;
        label.textContent = file ? file.name : 'Choose image file';
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
            }
        });
    }
</script>
@endpush
