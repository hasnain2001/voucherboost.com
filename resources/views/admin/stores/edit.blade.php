@extends('admin.master')
@section('title')
Update
@endsection
@section('main-content')
<style>
input{
color: darkblue;
}
</style>




<div class="content-wrapper">

<section class="content-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dahboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.store.store') }}">stores</a></li>
          <li class="breadcrumb-item active" aria-current="page">edite</li>
          <li class="breadcrumb-item active" aria-current="page">{{ $stores->name }}</li>
        </ol>
      </nav>
<h1 style="font-size: 22px;">Update Store</h1>

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
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif
<form name="UpdateStore" id="UpdateStore" method="POST" enctype="multipart/form-data" action="{{ route('admin.store.update', $stores->id) }}">
@csrf
<div class="row">
<div class="col-6">
<div class="card">
<div class="card-body">
<div class="form-group">
<label for="name">Store Name <span class="text-danger">*</span></label>
<input type="text" class="form-control" name="name" id="name" value="{{ $stores->name }}" required>
</div>
<div class="form-group">
<label for="slug">Store Url/Slug <span class="text-danger">*</span></label>
<input type="text" class="form-control" name="slug" id="slug" value="{{ $stores->slug }}" placeholder="define your store  url/slug " required>
<small id="slug-message"></small> <!-- Added this line -->
</div>
<div class="form-group">
<label for="description">Description</label>
<textarea name="description" id="description" class="form-control" cols="30" rows="2" >{{ $stores->description }}</textarea>
</div>

{{-- <div class="form-group">
<label for="url">URL <span class="text-danger">*</span></label>
<input type="url" class="form-control" name="url" id="url" value="{{ $stores->url }}" required>
</div> --}}
<div class="form-group">
<label for="url"> URL <span class="text-danger">*</span></label>
<input  type="url" class="form-control" name="url" id="url" value="{{ $stores->url }} " required>
</div>
<div class="form-group">
    <label for="destination_url">Destination URL\Affiliate Links <span class="text-danger">*</span></label>
    <input  type="url" class="form-control" name="destination_url" id="destination_url" value="{{ $stores->destination_url }} " required>
    </div>
    <div class="form-group">
        <label for="name">Meta Title<span class="text-danger">*</span></label>
        @error('title')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <input type="text" class="form-control" name="title" id="name" value="{{ $stores->title }} ">

        </div>

        <div class="form-group">
        <label for="meta_tag">Meta Tag <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta_tag" id="meta_tag" value="{{ $stores->meta_tag }}">
        </div>

</div>
</div>
</div>
<div class="col-6">
<div class="card">
<div class="card-body">
{{-- <div class="form-group">
<label for="name">Top Store <span class="text-danger">*</span></label>
<input type="number" class="form-control" name="top_store" id="top_store" value="{{ $stores->top_store }}" min="0"  >
</div> --}}

    <div class="form-group">
    <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ $stores->meta_keyword }}">
    </div>


<div class="form-group">
    <label for="meta_description">Meta Description</label>
    @error('meta_description')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="1" style="resize: none;">{{ old('meta_description', $stores->meta_description) }}</textarea>

    </div>
    <div class="form-group">
        <label for="top_store">Top Store <span class="text-danger">*</span></label>
        <input type="radio" name="top_store" id="not_top_store" value="0" {{ $stores->top_store == '0' ? 'checked' : '' }} required> Not Top Store
        <input type="radio" name="top_store" id="top_store" value="1" {{ $stores->top_store == '1' ? 'checked' : '' }}> Top Store
        @error('top_store')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group d-flex align-items-center">
        <label for="status" class="mr-2">Status <span class="text-danger">*</span></label>
        <input type="radio" name="status" id="enable" {{ $stores->status == 'enable' ? 'checked' : '' }} value="enable">
        <label for="enable" class="mr-3 ml-1">Enable</label>
        <input type="radio" name="status" id="disable" {{ $stores->status == 'disable' ? 'checked' : '' }} value="disable">
        <label for="disable" class="mr-4 ml-1">Disable</label>

        {{-- <label for="authentication" class="mr-2">Authentication</label>
        <input type="checkbox" name="authentication" id="authentication" {{ $stores->authentication == 'top_stores' ? 'checked' : '' }} value="top_stores">
        <label for="authentication" class="ml-1">Top Store</label> --}}
      </div>

<div class="form-group">
    <label for="category">Category <span class="text-danger">*</span></label>
    <select name="category" id="category" class="form-control">
    <option value="" disabled selected>{{ $stores->category }}</option>
    @foreach($categories as $category)
    <option value="{{ $category->slug }}">{{ $category->slug }}</option>
    @endforeach
    </select>


    </div>
    <div class="form-group">
    <label for="lang">Language <span class="text-danger">*</span></label>
    <select name="language_id" id="lang" class="form-control">
        <option disabled>--Select Langs--</option>

        <!-- Loop through languages and set the selected option -->
        @foreach ($langs as $lang)
            <option value="{{ $lang->id }}"
                {{ isset($stores->language_id) && $stores->language_id == $lang->id ? 'selected' : '' }}>
                {{ $lang->code }}
            </option>
        @endforeach
    </select>



    </div>
<div class="form-group">
<label for="network">Network <span class="text-danger">*</span></label>
<select name="network" id="network" class="form-control">
<option value="" disabled selected>{{ $stores->network }}</option>
@foreach($networks as $network)
<option value="{{ $network->title }}">{{ $network->title }}</option>
@endforeach
</select>
</div>
<div class="form-group">
    <label for="about">about Description</label>
    <textarea name="about" id="about" class="form-control" cols="30" rows="5" style="resize: none;" >{{ $stores->about }}</textarea>
    </div>
<div class="form-group">
<label for="store_image">Store Image <span class="text-danger">*</span></label>
<input type="file" class="form-control" name="store_image" id="store_image">
@if($stores->store_image)
<input type="hidden" name="previous_image" value="{{ $stores->store_image }}">
<img src="{{ asset('uploads/stores/'.$stores->store_image) }}" alt="Current Store Image" style="max-width: 200px;">
@else
<p>No image uploaded</p>
@endif
</div>
<!-- Placeholder for displaying selected image -->
<div id="imagePreview"></div>



</div>
</div>
<div class="col-9">
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-dark">Reset</button>
        <a href="{{ route('admin.stores') }}" class="btn btn-secondary">Cancel</a>
      </div>


    </div>
</div>
<div class="form-group">
    <label for="">Main Content</label>
    <div id="container">
    <textarea required id="editor" name="content" >
        {!!$stores->content!!}
    </textarea>
    </div>
    </div>

</div>
</form>
</div>
</section>
</div>
<script>
// JavaScript to preview the selected image
document.getElementById('store_image').addEventListener('change', function() {
var file = this.files[0];
if (file) {
var reader = new FileReader();
reader.onload = function(event) {
var imgElement = document.createElement('img');
imgElement.setAttribute('src', event.target.result);
imgElement.setAttribute('class', 'preview-image'); // Optional: Add CSS class for styling
imgElement.setAttribute('style', 'max-width: 100%; height: auto;'); // Optional: Add styling
document.getElementById('imagePreview').innerHTML = ''; // Clear previous preview, if any
document.getElementById('imagePreview').appendChild(imgElement);
}
reader.readAsDataURL(file);
} else {
document.getElementById('imagePreview').innerHTML = ''; // Clear preview if no file selected
}
});
</script>
   <script>
    // Filter non-alphabetic characters in the 'name' input field and auto-fill 'slug'
    const inputOne = document.getElementById('name');
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

@endsection
