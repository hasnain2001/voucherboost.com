@extends('admin.layouts.master')
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
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Update Store</h1>
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
@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif
<form name="Updateuser" id="Updateuser" method="POST" enctype="multipart/form-data" action="{{ route('admin.user.update', $user->id) }}">
@csrf
<div class="row">
<div class="col-6">
<div class="card">
<div class="card-body">
    <div class="form-group">
        <label for="role">name <span class="text-danger">*</span></label>
    <span>{{$user->name}}</span>
    </div>
    <div class="form-group">
        <label for="role">Email <span class="text-danger">*</span></label>
    <span>{{$user->email}}</span>
    </div>
    <div class="form-group">
        <label for="role">User Role <span class="text-danger">*</span></label>
        <select name="role" id="role" class="form-control" required>
            <option disabled>--Select Role--</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
        </select>
    </div>



</div>
</div>
</div>

<div class="col-12">
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="reset" class="btn btn-dark">Reset</button>

    </div>
</div>

</div>
</form>
</div>
</section>
</div>

@endsection
