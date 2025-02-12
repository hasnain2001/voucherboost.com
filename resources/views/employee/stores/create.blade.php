@extends('admin.master')
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

                <form name="CreateStore" id="CreateStore" method="POST" enctype="multipart/form-data"
                    action="{{ route('admin.store.store') }}">
                    @csrf
                    <div class="row">
                 
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Store Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Url/Slug<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="slug" id="slug" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="3" style="resize: none;"
                                            required></textarea>
                                    </div>

                                    {{-- <div class="form-group">
                                    <label for="url">URL <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control" name="url" id="url" required>
                                </div> --}}
                                    <div class="form-group">
                                        <label for="destination_url">Destination URL <span
                                                class="text-danger">*</span></label>
                                        <input type="url" class="form-control" name="destination_url"
                                            id="destination_url" required>
                                    </div>
                                    <div class="form-group">

                                        <div class="form-group">
                                            <label for="category">Category <span class="text-danger">*</span></label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="" disabled selected>--Select Category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->slug }}">{{ $category->slug }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                <div class="form-group">
                                            <label for="lang">Language <span class="text-danger">*</span></label>
                                            <select name="language_id" id="lang" class="form-control" required>
                                                <option disabled selected>--Select Langs--</option>
                                                @foreach ($langs as $lang)
                                                    <option value="{{ $lang->id }}">{{ $lang->code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    
                                    <div class="form-group">
                                        <label for="name">Meta Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tag">Meta Tag <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="meta_tag" id="meta_tag">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="5"
                                            style="resize: none;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    {{-- <div class="form-group">
                                    <label for="name">Top Store <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="top_store" id="top_store" min="0" value="0">

                                </div> --}}
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label><br>
                                        <input type="radio" name="status" id="enable" value="enable"
                                            required>&nbsp;<label for="enable">Enable</label>
                                        <input type="radio" name="status" id="disable" value="disable">&nbsp;<label
                                            for="disable">Disable</label>
                                    </div>

                                    {{-- <div class="form-group">
                                    <label for="authentication">Authentication</label><br>
                                    <input type="checkbox" name="authentication" id="authentication" value="top_stores">&nbsp;<label for="authentication">Top Store</label>
                                </div> --}}
                                    <div class="form-group">
                                        <label for="network">Network <span class="text-danger">*</span></label>
                                        <select name="network" id="network" class="form-control">
                                            <option value="" disabled selected>--Select Network--</option>
                                            @foreach ($networks as $network)
                                                <option value="{{ $network->title }}">{{ $network->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="store_image">Store Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="store_image" id="store_image"
                                            required>
                                    </div>
                                    <!-- Placeholder for displaying selected image -->
                                    <div id="imagePreview"></div>
                                    <div class="col-12">

                                        <button type="submit" class="btn btn-primary">Save</button>
                                        {{-- <a href="{{ route('admin.store') }}" class="btn btn-secondary">Cancel</a> --}}
                                        <button type="reset" class="btn btn-light"> Reset</button>

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
    </script>

@endsection
