@extends('admin.master')
@section('title', 'Create | Blog')

@section('main-content')
<div class="content-wrapper py-2">
    <div class=" container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white text-center">
                        <h4>Create Blog</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
                            @csrf
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
                                    <strong>Validation error(s):</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required value="{{ old('title') }}" />
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug / URL</label>
<input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" required />
                                <small id="slug-message" class="text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="blog_image">Blog Image</label>
                                <input type="file" class="form-control" name="category_image" id="blog_image" required />
                            </div>
                            <div id="imagePreview" class="mt-2"></div>
                            <div class="form-group">
                                <label for="editor">Main Content</label>
                                <textarea name="content" id="editor" class="form-control">{{ old('content') }}</textarea>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="meta_title"> Category </label>
                                <select name="category" id="category" class="form-control" required >
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}" {{ old('category') == $category->slug ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
<div class="form-group form-check">
<input type="checkbox" class="form-check-input" name="top" id="top" value="top" {{ old('top') == 'top' ? 'checked' : '' }}>
<label class="form-check-label" for="top">Top Blog</label>
</div>
<div class="form-group">
    <label for="name">Meta Title<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title')}}" >
</div>
                            <div class="form-group">
                                <label for="meta_keyword">Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword') }}">
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control" rows="4">{{ old('meta_description') }}</textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-dark w-50">Submit</button>
                                <button type="reset" class="btn btn-success w-50">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // JavaScript to preview the selected image
    document.getElementById('blog_image').addEventListener('change', function() {
    var file = this.files[0];
    if (file) {
    var reader = new FileReader();
    reader.onload = function(event) {
    var imgElement = document.createElement('img');
    imgElement.setAttribute('src', event.target.result);
    imgElement.setAttribute('class', 'preview-image'); // Optional: Add CSS class for styling
    imgElement.setAttribute('style', 'max-width: 100%; height: 50px;'); // Optional: Add styling
    document.getElementById('imagePreview').innerHTML = ''; // Clear previous preview, if any
    document.getElementById('imagePreview').appendChild(imgElement);
    }
    reader.readAsDataURL(file);
    } else {
    document.getElementById('imagePreview').innerHTML = ''; // Clear preview if no file selected
    }
    });

    // Filter non-alphabetic characters in the 'name' input field and auto-fill 'slug'
    const inputOne = document.getElementById('title');
    const textOnlyInput = document.getElementById('slug');

    inputOne.addEventListener('input', () => {
    const value = inputOne.value;
    // Filter out non-alphabetic characters and update slug automatically
    const filteredValue = value.replace(/[^A-Za-z\s]/g, '');
    textOnlyInput.value = filteredValue;

    // Automatically check slug existence after auto-filling
    checkSlugExistence(filteredValue);
    });

    $(document).ready(function() {
    // Check slug existence when the user types manually in the slug field
    $('#slug').on('keyup', function() {
    var slug = $(this).val();

    // Check if the slug has any value (optional: avoid AJAX if empty)
    if (slug) {
    checkSlugExistence(slug);
    } else {
    $('#slug-message').text('Please enter a slug').css('color', 'black');
    }
    });
    });

    // Function to check if the slug exists
    function checkSlugExistence(slug) {
    $.ajax({
    url:'{{ route('blog.check.slug') }}',
    method: 'POST',
    data: {
    _token: '{{ csrf_token() }}',
    slug: slug
    },
    success: function(response) {
    if (response.exists) {
    $('#slug-message').text('Blog already exists').css('color', 'red');
    } else {
    $('#slug-message').text('Blog is available').css('color', 'green');
    }
    }
    });
    }
    </script>
@endsection
