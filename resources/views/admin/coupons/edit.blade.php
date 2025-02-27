@extends('admin.master')
@section('title')
    Update
@endsection
@section('main-content')
<style>
    input, textarea {
        font-weight: bold;
        color: #333;
    }

    label {
        font-weight: bold;
    }

    .form-group-inline {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .form-group-inline label {
        margin-right: 10px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Coupon</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-check-circle"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>{{ session('success') }}</b>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form name="UpdateCoupon" id="UpdateCoupon" method="POST" action="{{ route('admin.coupon.update', $coupons->id) }}">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Coupon Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $coupons->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="5" style="resize: none;">{{ $coupons->description }}</textarea>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="toggleCodeCheckbox" onchange="toggleCodeInput(this)">
                                    <label class="form-check-label" for="toggleCodeCheckbox">Enable Code Input</label>
                                </div>
                                <div class="form-group" id="codeInputGroup" style="display: none;">
                                    <label for="code">Code</label>
                                    <input type="text" class="form-control" name="code" id="code" value="{{ $coupons->code }}">
                                </div>
                                <div class="form-group">
                                    <label for="ending_date">Ending Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="ending_date" id="ending_date" placeholder="Select a date"
                                           value="{{ \Carbon\Carbon::parse($coupons->ending_date)->format('Y-m-d') }}">
                                </div>
                                <div class="form-group-inline">
                                    <label for="status">Status:</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="status" id="enable" value="enable" {{ $coupons->status == 'enable' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable">Enable</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="status" id="disable" value="disable" {{ $coupons->status == 'disable' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="disable">Disable</label>
                                    </div>
                                </div>
                                <div class="form-group-inline">
                                    <label>Top Coupon:</label>
                                    @for ($i = 0; $i <= 5; $i++)
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="top_coupons" id="top_{{ $i }}" value="{{ $i }}" {{ $coupons->top_coupons == $i ? 'checked' : '' }}>
                                            <label class="form-check-label" for="top_{{ $i }}">{{ $i }}</label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Authentication:</label>
                                    @php $authOptions = ['never expire', 'Featured', 'free shipping', 'coupon code', 'top deals', 'valentine']; @endphp
                                    @foreach ($authOptions as $auth)
                                        <div class="form-check"><input type="radio" class="form-check-input" name="authentication" id="{{ $auth }}" value="{{ $auth }}" {{ $coupons->authentication === $auth ? 'checked' : '' }} onchange="toggleOtherInputVisibility(false)"><label class="form-check-label" for="{{ $auth }}">{{ ucfirst($auth) }}</label></div>
                                    @endforeach
                                    <div class="form-check"><input type="radio" class="form-check-input" name="authentication" id="otherOption" value="other" {{ !in_array($coupons->authentication, $authOptions) ? 'checked' : '' }} onchange="toggleOtherInputVisibility(true)"><label class="form-check-label" for="otherOption">Other</label></div>
                                    <div class="form-group" id="otherInputGroup" style="{{ !in_array($coupons->authentication, $authOptions) ? '' : 'display: none;' }}"><label for="otherAuthentication">Authentication</label><input type="text" class="form-control" name="authentication" id="otherAuthentication" value="{{ !in_array($coupons->authentication, $authOptions) ? $coupons->authentication : '' }}" oninput="updateAuthenticationValue(this)"></div>
                                </div>
                                <div class="form-group">
                                    <label for="store">Store <span class="text-danger">*</span></label>
                                    <select name="store" id="store" class="form-control" onchange="updateDestinationUrl()">
                                        <option value="" disabled selected>{{ $coupons->store }}</option>
                                        @foreach($stores as $store)
                                            <option value="{{ $store->slug }}" data-url="{{ $store->destination_url }}">{{ $store->slug }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="destination_url">Destination URL <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control" name="destination_url" id="destination_url" value="{{ $coupons->destination_url }}">
                                </div>
                                <div class="form-group">
                                    <label for="lang">Language <span class="text-danger">*</span></label>
                                    <select name="language_id" id="lang" class="form-control" required>
                                        <option disabled selected>{{ $coupons->language->code ?? '--Select Language--' }}</option>
                                        @foreach ($langs as $lang)
                                            <option value="{{ $lang->id }}">{{ $lang->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <a href="{{ route('admin.coupon') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    function toggleOtherInputVisibility(showOther) {
        const otherInputGroup = document.getElementById('otherInputGroup');
        const otherAuthentication = document.getElementById('otherAuthentication');

        if (showOther) {
            otherInputGroup.style.display = '';
            otherAuthentication.focus();
        } else {
            otherInputGroup.style.display = 'none';
            otherAuthentication.value = '';
        }
    }

    function updateAuthenticationValue(input) {
        const otherOption = document.getElementById('otherOption');
        otherOption.value = input.value; // Update the value of the "Other" radio button dynamically.
    }

    function updateDestinationUrl() {
        const storeSelect = document.getElementById('store');
        const selectedOption = storeSelect.options[storeSelect.selectedIndex];
        const destinationUrlInput = document.getElementById('destination_url');

        // Get the data-url attribute from the selected option
        const destinationUrl = selectedOption.getAttribute('data-url') || '';

        // Update the input field with the URL
        destinationUrlInput.value = destinationUrl;
    }

    function toggleCodeInput(checkboxElement) {
    const codeInputGroup = document.getElementById('codeInputGroup');
    if (checkboxElement.checked) {
        codeInputGroup.style.display = 'block'; // Show the input field
    } else {
        codeInputGroup.style.display = 'none'; // Hide the input field
    }
}

// Function to initialize the state of the checkbox and code input field on page load
function initializeCodeInput() {
    const toggleCodeCheckbox = document.getElementById('toggleCodeCheckbox');
    const codeInput = document.getElementById('code');
    const codeInputGroup = document.getElementById('codeInputGroup');

    // Check if the code input has a value
    if (codeInput.value.trim() !== '') {
        // If there's a value, check the checkbox and show the input field
        toggleCodeCheckbox.checked = true;
        codeInputGroup.style.display = 'block';
    } else {
        // If no value, ensure the checkbox is unchecked and the input field is hidden
        toggleCodeCheckbox.checked = false;
        codeInputGroup.style.display = 'none';
    }
}

// Call the initialization function when the page loads
document.addEventListener('DOMContentLoaded', initializeCodeInput);
</script>
@endsection
