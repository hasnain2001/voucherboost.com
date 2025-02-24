@extends('employee.master')
@section('title')
    Create
@endsection


@section('main-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Store</h1>
                    </div>
                </div>
            </div>
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

<form name="CreateStore" id="CreateStore" method="POST" enctype="multipart/form-data" action="{{ route('employee.store.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Store Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Url/Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" required>
                                        <span id="slug-message"></span>
                                        @error('slug')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="3" style="resize: none;" required>{{ old('description') }}</textarea>
                                        @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="destination_url"> URL <span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" name="url" id="url" value="{{ old('destination_url') }}" required>
                                        @error('url')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="destination_url">Destination URL\Affiliate Links <span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" name="destination_url" id="destination_url" value="{{ old('destination_url') }}" required>
                                        @error('destination_url')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword') }}">
                                        @error('meta_keyword')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" cols="20" rows="2" style="resize: none;">{{ old('meta_description') }}</textarea>
                                        @error('meta_description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="top_store">Top Store <span class="text-danger">*</span></label>
                                        <input type="radio" name="top_store" id="not_top_store" value="0" {{ old('top_store') == '0' ? 'checked' : '' }} required> Not Top Store
                                        <input type="radio" name="top_store" id="top_store" value="1" {{ old('top_store') == '1' ? 'checked' : '' }}> Top Store
                                        @error('top_store')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <input type="radio" name="status" id="enable" value="enable" {{ old('status') == 'enable' ? 'checked' : '' }} required> Enable
                                        <input type="radio" name="status" id="disable" value="disable" {{ old('status') == 'disable' ? 'checked' : '' }}> Disable
                                        @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="network">Network <span class="text-danger">*</span></label>
                                        <select name="network" id="network" class="form-control">
                                            <option value="" disabled {{ old('network') ? '' : 'selected' }}>--Select Network--</option>
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
                                    <div class="form-group">
                                        <label for="category">Category <span class="text-danger">*</span></label>
                                        <select name="category" id="category" class="form-control" required>
                                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>--Select Category--</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->slug }}" {{ old('category') == $category->slug ? 'selected' : '' }}>
                                                {{ $category->slug }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="language_id">Language <span class="text-danger">*</span></label>
                                        <select name="language_id" id="language_id" class="form-control" required>
                                            <option value="" disabled {{ old('language_id') ? '' : 'selected' }}>--Select Language--</option>
                                            @foreach ($langs as $lang)
                                            <option value="{{ $lang->id }}" {{ old('language_id') == $lang->id ? 'selected' : '' }}>
                                                {{ $lang->code }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('language_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div> --}}
                                        <div class="form-group">
                                        <label for="store_image">Store Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="store_image" id="store_image"  value="{{ old('store_image') }}" required>
                                        @error('store_image')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Save</button>
                          <a href="{{ route('employee.store.store') }}" class=" btn btn-danger">Cancel</a>
                          <button type="reset" class="btn btn-light">Reset</button>
                                    </div>
                                </div>
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
