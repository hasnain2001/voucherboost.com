@extends('admin.layouts.master')
@section('title')
Create | Coupons
@endsection

@push('styles')
<style>
    .radio-group, .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
        padding: 10px 0;
    }

    .radio-group label, .checkbox-group label {
        margin-bottom: 0;
        cursor: pointer;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        padding: 10px 15px;
        font-weight: 600;
    }

    .card-body {
        padding: 20px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eee;
        color: #495057;
    }
</style>
@endpush

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Coupon</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.coupon') }}">Coupons</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Alerts -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa fa-check-circle mr-2"></i>
                {{ session('success') }}
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

            <!-- Form -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Coupon Information</h3>
                </div>

                <form name="CreateCoupon" id="CreateCoupon" method="POST" action="{{ route('admin.coupon.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Basic Information Section -->
                                <div class="form-section">
                                    <div class="section-title">Basic Information</div>

                                    <div class="form-group">
                                        <label for="name">Coupon Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" class="form-control"
                                                  rows="3" style="resize: none;">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="toggleCodeCheckbox"
                                                   onchange="toggleCodeInput(this)" {{ old('code') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="toggleCodeCheckbox">Enable Custom Code</label>
                                        </div>

                                        <div class="form-group mt-2" id="codeInputGroup" style="display: none;">
                                            <label for="code">Coupon Code</label>
                                            <input type="text" class="form-control" name="code" id="code"
                                                   value="{{ old('code') }}" placeholder="Enter custom code">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="ending_date">Ending Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="ending_date" id="ending_date"
                                               value="{{ old('ending_date') }}" required>
                                        <small id="dateError" class="text-danger" style="display: none;">
                                            Please select a future date.
                                        </small>
                                    </div>
                                </div>

                                <!-- Store & Language Section -->
                                <div class="form-section">
                                    <div class="section-title">Store & Language</div>

                                  <div class="mb-3">
                                    <label for="store_id" class="form-label">Store <span class="text-danger">*</span></label>
                                    <select name="store_id" id="store_id" class="form-select" onchange="updateDestinationAndLanguage()" required>
                                            <option value="" disabled {{ old('store_id') ? '' : 'selected' }}>-- Select Store --</option>
                                            @foreach($stores as $store)
                                                <option value="{{ $store->id }}"
                                                        data-language-id="{{ $store->language_id }}"
                                                        {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                                    {{ $store->name }}
                                                </option>
                                            @endforeach
                                        </select>
                            </div>
                            <div class="mb-3">
                                <label for="language_id" class="form-label">Language <span class="text-danger">*</span></label>
                                <select name="language_id" id="language_id" class="form-select" required>
                                    <option value="" disabled {{ old('language_id') ? '' : 'selected' }}>-- Select Language --</option>
                                    @foreach($langs as $language)
                                        <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Ranking Section -->
                                <div class="form-section">
                                    <div class="section-title">Ranking</div>

                                    <div class="form-group">
                                        <label>Top Coupons Position <span class="text-danger">*</span></label>
                                        <div class="radio-group">
                                            @for ($i = 0; $i <= 10; $i++)
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="top_{{ $i }}" name="top_coupons"
                                                           value="{{ $i }}" class="custom-control-input"
                                                           {{ old('top_coupons') == $i ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="top_{{ $i }}">{{ $i }}</label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Section -->
                                <div class="form-section">
                                    <div class="section-title">Status</div>

                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <div class="radio-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="enable" name="status" value="enable"
                                                       class="custom-control-input" {{ old('status', 'enable') == 'enable' ? 'checked' : '' }} required>
                                                <label class="custom-control-label" for="enable">Enable</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="disable" name="status" value="disable"
                                                       class="custom-control-input" {{ old('status') == 'disable' ? 'checked' : '' }} required>
                                                <label class="custom-control-label" for="disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Authentication Section -->
                                <div class="form-section">
                                    <div class="section-title">Authentication</div>

                                    <div class="form-group">
                                        <label>Authentication Type</label>
                                        <div class="radio-group">
                                            @foreach (['never expire', 'featured', 'free shipping', 'coupon code', 'top deals', 'valentine'] as $auth)
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="{{ str_replace(' ', '_', $auth) }}"
                                                           name="authentication" value="{{ $auth }}"
                                                           class="custom-control-input"
                                                           {{ old('authentication') === $auth ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="{{ str_replace(' ', '_', $auth) }}">
                                                        {{ ucfirst($auth) }}
                                                    </label>
                                                </div>
                                            @endforeach

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="toggleOtherCheckbox" name="authentication"
                                                       value="other" class="custom-control-input"
                                                       {{ old('authentication') === 'other' ? 'checked' : '' }}
                                                       onchange="toggleOtherInput(this)">
                                                <label class="custom-control-label" for="toggleOtherCheckbox">Other</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-2" id="otherInputGroup" style="display: none;">
                                            <label for="otherAuthentication">Specify Authentication</label>
                                            <input type="text" class="form-control" name="other_authentication"
                                                   id="otherAuthentication" value="{{ old('other_authentication') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Footer -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Save Coupon
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo mr-1"></i> Reset
                        </button>
                        <a href="{{ route('admin.coupon') }}" class="btn btn-default float-right">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection


@push('scripts')
<script>
    // Initialize Select2
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        // Show code input if there's an old value
        if ($('#toggleCodeCheckbox').is(':checked')) {
            $('#codeInputGroup').show();
        }

        // Show other input if "Other" is selected
        if ($('#toggleOtherCheckbox').is(':checked')) {
            $('#otherInputGroup').show();
        }
    });
      function updateDestinationAndLanguage() {
            updateLanguageFromStore();
            // If you have destination URL logic, it would go here
        }

        function updateLanguageFromStore() {
            const storeSelect = document.getElementById('store_id');
            const selectedOption = storeSelect.options[storeSelect.selectedIndex];
            const languageId = selectedOption.getAttribute('data-language-id');

            // Update language selection
            if (languageId) {
                const languageSelect = document.getElementById('language_id');
                // Find the option with matching value and select it
                for (let i = 0; i < languageSelect.options.length; i++) {
                    if (languageSelect.options[i].value == languageId) {
                        languageSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        }

    // Date validation
    document.getElementById('ending_date').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            document.getElementById('dateError').style.display = 'block';
            this.value = '';
        } else {
            document.getElementById('dateError').style.display = 'none';
        }
    });

    // Toggle other authentication input
    function toggleOtherInput(checkboxElement) {
        if ($(checkboxElement).is(':checked')) {
            $('#otherInputGroup').show();
        } else {
            $('#otherInputGroup').hide();
        }
    }

    // Toggle coupon code input
    function toggleCodeInput(checkboxElement) {
        if ($(checkboxElement).is(':checked')) {
            $('#codeInputGroup').show();
        } else {
            $('#codeInputGroup').hide();
            $('#code').val('');
        }
    }
</script>
@endpush
