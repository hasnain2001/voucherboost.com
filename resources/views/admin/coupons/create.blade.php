@extends('admin.master')
@section('title')
Create | Coupons
@endsection
@section('main-content')
<style>


.radio-container,
.checkbox-container {
display: flex;
flex-wrap: wrap;
gap: 15px; /* Adjust spacing between items within each group */
align-items: center;
}

.radio-container input[type="radio"],
.checkbox-container input[type="checkbox"] {
margin-right: 5px; /* Adjust spacing between the input and label */
}

</style>
<div class="content-wrapper">
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Create Coupon</h1>
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
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
<div class="form-group">
<form name="CreateCoupon" id="CreateCoupon" method="POST" action="{{ route('admin.coupon.store') }}">
@csrf
<div class="row">
<div class="col-6">
<div class="card">
<div class="card-body">
<div class="form-group">
<label for="name">Coupon Name <span class="text-danger">*</span></label>
<input type="text" class="form-control" name="name" id="name" value="{{ old('name', request()->input('name')) }}" required>
</div>
<div class="form-group">
<label for="description">Description <span class="text-danger">*</span></label>
<textarea name="description" id="description" class="form-control" cols="20" rows="3" style="resize: none;">{{ old('description') }}</textarea>
</div>
<div class="form-check">
    <input type="checkbox" class="form-check-input" id="toggleCodeCheckbox"
        onchange="toggleCodeInput(this)"
        {{ old('code') ? 'checked' : '' }}>
    <label class="form-check-label" for="toggleCodeCheckbox">Enable Code Input</label>
</div>
<div class="form-group" id="codeInputGroup" style="display: none;">
    <label for="code">Code</label>
    <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}">
</div>


<div class="form-group">
    <label for="ending_date">Ending Date <span class="text-danger">*</span></label>
    <input type="date" class="form-control" name="ending_date" id="ending_date" value="{{ old('ending_date') }}" required>
    <small id="dateError" class="text-danger" style="display: none;">Please select a future date.</small>
</div>

<div class="form-group">
    <label for="store">Store <span class="text-danger">*</span></label>
    <select name="store" id="store" class="form-control" onchange="updateDestinationAndLanguage()" required>
        <option value="" disabled selected>--Select Store--</option>
        @foreach($stores as $store)
            <option value="{{ $store->slug }}" data-url="{{ $store->destination_url }}" data-language-id="{{ $store->language_id }}"
                {{ old('store') == $store->slug ? 'selected' : '' }}>
                {{ $store->slug }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="destination_url">Destination URL <span class="text-danger">*</span></label>
    <input type="url" class="form-control" name="destination_url" id="destination_url" value="{{ old('destination_url') }}" required>
</div>



</div>
</div>
</div>
<div class="col-6">
<div class="card">
<div class="card-body">
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
<label for="top_coupons">Top Coupons Code <span class="text-danger">*</span></label><br>
@for ($i = 0; $i <= 10; $i++)
<input type="radio" name="top_coupons" id="top_{{ $i }}" value="{{ $i }}" {{ old('top_coupons') == $i ? 'checked' : '' }}>
<label for="top_{{ $i }}">{{ $i }}</label>
@endfor
</div>
<div class="form-group">
<label for="status">Status <span class="text-danger">*</span></label><br>
<div class="radio-container">
<input type="radio" name="status" id="enable" value="enable" {{ old('status') == 'enable' ? 'checked' : '' }} required>
<label for="enable">Enable</label>
<input type="radio" name="status" id="disable" value="disable" {{ old('status') == 'disable' ? 'checked' : '' }} required>
<label for="disable">Disable</label>
</div>
<label for="authentication">Authentication</label><br>
@foreach (['never expire', 'featured', 'free shipping', 'coupon code', 'top deals', 'valentine' ] as $auth)
<input type="radio" name="authentication" id="{{ $auth }}" value="{{ $auth }}"
{{ old('authentication') === $auth ? 'checked' : '' }}>
<label for="{{ $auth }}">{{ ucfirst(str_replace('_', ' ', $auth)) }}</label>
@endforeach
{{-- <div class="checkbox-container">
@foreach (['never expire', 'featured', 'free shipping', 'coupon code', 'top deals', 'valentine'] as $auth)
<input type="radio" name="authentication" id="{{ $auth }}" value="{{ $auth }}"
{{ old('authentication') === $auth ? 'checked' : '' }}>
<label for="{{ $auth }}">{{ ucfirst(str_replace('_', ' ', $auth)) }}</label>
@endforeach
--}}
{{-- <!-- Other Option -->
<div class="form-check">
<input type="radio" class="form-check-input" name="authentication" id="toggleOtherCheckbox" value="other"
{{ old('authentication') === 'other' ? 'checked' : '' }} onchange="toggleOtherInput(this)">
<label class="form-check-label" for="toggleOtherCheckbox">Other</label>
</div>

<!-- Hidden Input for Other -->
<div class="form-group" id="otherInputGroup" style="display: none;">
<label for="otherAuthentication">Please specify</label>
<input type="text" class="form-control" name="authentication" id="otherAuthentication"
value="{{ old('other_authentication') }}">
</div>
</div> --}}




</div>




<div class="col-6">
<button type="submit" class="btn btn-primary">Save</button>
<button type="reset" class=" btn  btn-lisght">Reset</button>
<a href="{{ route('admin.coupon') }}" class="btn btn-secondary">Cancel</a>
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
    document.getElementById('ending_date').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Set time to midnight to compare only dates

        if (selectedDate < today) {
            document.getElementById('dateError').style.display = 'block';
            this.value = ''; // Clear the input value
        } else {
            document.getElementById('dateError').style.display = 'none';
        }
    });

    function updateDestinationAndLanguage() {
    const storeSelect = document.getElementById('store');
    const selectedOption = storeSelect.options[storeSelect.selectedIndex];

    // Get the destination URL and language ID from the selected store
    const destinationUrl = selectedOption.getAttribute('data-url') || '';
    const languageId = selectedOption.getAttribute('data-language-id') || '';

    // Update the destination URL input field
    document.getElementById('destination_url').value = destinationUrl;

    // Set the selected language in the language dropdown
    const languageSelect = document.getElementById('language_id');
    if (languageId) {
        languageSelect.value = languageId;
    }
}

</script>

<script>

function toggleOtherInput(checkboxElement) {
const otherInputGroup = document.getElementById('otherInputGroup');

if (checkboxElement.checked) {
otherInputGroup.style.display = 'block'; // Show the input field
} else {
otherInputGroup.style.display = 'none'; // Hide the input field
}
}
function toggleCodeInput(checkboxElement) {
    const codeInputGroup = document.getElementById('codeInputGroup');
    const codeInput = document.getElementById('code');

    if (checkboxElement.checked) {
        // Show the input group if the checkbox is checked
        codeInputGroup.style.display = 'block';
    } else {
        // Hide the input group and clear the input value if the checkbox is unchecked
        codeInputGroup.style.display = 'none';
        codeInput.value = ''; // Clear the input value
    }
}

// Ensure the input is shown if there's an old value
window.onload = function () {
    const checkbox = document.getElementById('toggleCodeCheckbox');
    const codeInputGroup = document.getElementById('codeInputGroup');
    const codeInput = document.getElementById('code');

    if (checkbox.checked) {
        codeInputGroup.style.display = 'block';
    } else {
        codeInputGroup.style.display = 'none';
        codeInput.value = ''; // Clear the input value if the checkbox is not checked
    }
};
</script>


@endsection
