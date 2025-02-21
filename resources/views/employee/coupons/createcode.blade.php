@extends('employee.master')
@section('title')
    Create | Coupons
@endsection
@section('main-content')
<style>

</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Coupon  code </h1>
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
    <form name="CreateCoupon" id="CreateCoupon" method="POST" action="{{ route('employee.coupon.store') }}">
        @csrf
        <select class="form-select" aria-label="Default select example" onchange="navigateToPage(this)">
            <option selected>Select Deal/Code</option>
            <option value="{{ route('employee.coupon.code') }}">Code</option>
            <option value="{{ route('employee.coupon.create') }}">Deal</option>
        </select>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Coupon Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="3" style="resize: none;" ></textarea>
                        </div>
                       <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" class="form-control" name="code" id="code" required>
                                </div>
                        <div class="form-group">
                            <label for="destination_url">Destination URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" name="destination_url" id="destination_url" required>
                        </div>

                     <div class="form-group">

</div>

                        <div class="form-group">
                            <label for="ending_date">Ending Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="ending_date" id="ending_date" required>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                        <select name="language_id" id="language_id" class="form-control" required>
                            <option disabled selected>--Select Langs--</option>
                            @foreach ($langs as $lang)
                                <option value="{{ $lang->id }}">{{ $lang->code }}</option>
                            @endforeach
                        </select>
                      </div>
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label><br>
                            <input type="radio" name="status" id="enable" value="enable" required>&nbsp;<label for="enable">Enable</label>
                            <input type="radio" name="status" id="disable" value="disable" required>&nbsp;<label for="disable">Disable</label>
                        </div>
                        <div class="form-group">
                            <label for="top_coupons">Top Coupons Code <span class="text-danger">*</span></label><br>
                            @foreach (range(0, 15) as $value)
                                <input type="radio" name="top_coupons" id="top_{{ $value }}" value="{{ $value }}" onclick="updateTopCoupons({{ $value }})">
                                <label for="top_{{ $value }}">{{ $value }}</label>
                            @endforeach
                        </div>

                        <input type="hidden" name="top_coupons_hidden" id="top_coupons_hidden">


                                            <div class="form-group">
                            <label for="store">Store <span class="text-danger">*</span></label>
                            <select name="store" id="store" class="form-control" required>
                                <option value="" disabled selected>--Select Store--</option>
                                @foreach($stores as $store)
                                    <option value="{{ $store->slug }}">{{ $store->slug }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('employee.coupon') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>

</div>

    </section>
</div>
<script>
    function navigateToPage(selectElement) {
        var url = selectElement.value;
        if (url) {
            window.location.href = url; // Redirect to the selected URL
        }
    }

    function updateTopCoupons(value) {
        document.getElementById('top_coupons_hidden').value = value;
    }
    </script>

@endsection
