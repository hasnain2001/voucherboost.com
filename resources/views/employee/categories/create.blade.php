@extends('employee.layouts.master')
@section('title')
    Create
@endsection
@section('main-content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>{{ session('success') }}</b>
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
            <form name="CreateCategory" id="CreateCategory" method="POST" enctype="multipart/form-data" action="{{ route('employee.category.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Category Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Category Url/slug <span class="text-danger">* only text input</span></label>
                                    <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="meta_tag">Meta Tag <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_tag" id="meta_tag" value="{{ old('meta_tag') }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword') }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="4" style="resize: none;">{{ old('meta_description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category_image">Category Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="category_image" id="category_image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label><br>
                                    <input type="radio" name="status" id="enable" value="enable" {{ old('status') == 'enable' ? 'checked' : '' }}>&nbsp;<label for="enable">Enable</label>
                                    <input type="radio" name="status" id="disable" value="disable" {{ old('status') == 'disable' ? 'checked' : '' }}>&nbsp;<label for="disable">Disable</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('employee.category') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script>
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
</script>
@endsection
