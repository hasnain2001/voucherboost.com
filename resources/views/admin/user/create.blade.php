@extends('admin.master')

@section('title')
Create User
@endsection

@section('main-content')
<div class="content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm animate__animated animate__fadeIn">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Create User</h3>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name"
                                value="{{ old('name') }}">
                            @error('name')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email"
                                value="{{ old('email') }}" autocomplete="off">
                            @error('email')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role">User Role <span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="">--Select Role--</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                            </select>
                        </div>

                        <div class="form-group @error('password') has-error @enderror">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary toggle-btn"
                                        onclick="togglePassword('password', this)">Show</button>
                                </div>
                            </div>
                            @error('password')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group @error('password_confirmation') has-error @enderror">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" placeholder="Confirm Password" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary toggle-btn"
                                        onclick="togglePassword('password_confirmation', this)">Show</button>
                                </div>
                            </div>
                            @error('password_confirmation')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class=" d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></script>
<script>
    function togglePassword(id, button) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
            button.textContent = "Hide";
            button.classList.add("btn-dark");
            button.classList.remove("btn-outline-secondary");
        } else {
            input.type = "password";
            button.textContent = "Show";
            button.classList.remove("btn-dark");
            button.classList.add("btn-outline-secondary");
        }
    }
</script>
@endsection
