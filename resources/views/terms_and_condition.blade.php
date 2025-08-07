@extends('layouts.welcome')
@section('title')
 VoucherBoost Terms & Conditions | Your Guide to Safe & Smart Savings
@endsection

@section('description')
    Read the terms and conditions of VoucherBoost to understand the rules and guidelines for using our coupon codes and deals.
@endsection

@section('keywords')
    terms and conditions, voucherboost policies, user agreement, coupon rules, discount guidelines
@endsection
@push('styles')
<!-- Styles -->
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f7f8fa;
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* .contain {
        max-width: 800px;
        margin: 50px auto;
        padding: 25px;
        background-color: #fff;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        border-top: 4px solid #007bff;
        border-bottom: 4px solid #007bff;
    } */

    h1 {
        font-size: 2.8rem;
        margin-bottom: 20px;
        color: #030303;
        text-align: center;
        font-weight: 700;
        position: relative;

    }

    h1:before {
        content: "";
        position: absolute;
        left: 50%;
        bottom: -10px;
        transform: translateX(-50%);
        width: 345px;
        height: 3px;
        background-color: #000000;

        border-radius: 5px;
    }

    h2 {
        font-size: 1.8rem;
        margin-top: 35px;
        margin-bottom: 20px;
        color: #000000;
        border-left: 4px solid #000000;
        padding-left: 15px;
        position: relative;
    }

    h2:before {
        content: "\f0f6";
        font-family: "FontAwesome";
        position: absolute;
        left: -30px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.5rem;
        color: #000000;
    }

    .terms p,
    li {
        font-size: 1.05rem;
        line-height: 1.8;
        margin-bottom: 15px;
        color: #555;
    }



    .divider {
        height: 1px;
        background-color: #e1e1e1;
        margin: 40px 0;
    }

    .contact-info ul {
        padding-left: 0;
        list-style-type: none;
    }

    .contact-info ul li {
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .contact-info ul li .fas {
        margin-right: 10px;
        color: #007bff;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
            margin: 20px auto;
        }

        h1 {
            font-size: 2.3rem;
        }

        h2 {
            font-size: 1.6rem;
        }


    }
</style>
@endpush
@section('main-content')
<div class="container">
    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none text-primary" style="font-weight: 500;">@lang('nav.home')</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">@lang('nav.terms_conditions')</li>
        </ol>
    </nav>
</div>
<main class="text-capitalize terms">
    <div class="container bg-light">
        <div class="container">
            <h1>@lang('terms.heading')</h1>
        </div>
        <br><br>

        <section class="welcome-section">
            <h2>@lang('terms.intro.heading')</h2>
            <p>@lang('terms.intro.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.agreement.heading')</h2>
            <p>@lang('terms.sections.agreement.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.use.heading')</h2>
            <p>@lang('terms.sections.use.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.registration.heading')</h2>
            <p>@lang('terms.sections.registration.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.content.heading')</h2>
            <p>@lang('terms.sections.content.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.user_content.heading')</h2>
            <p>@lang('terms.sections.user_content.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.links.heading')</h2>
            <p>@lang('terms.sections.links.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.termination.heading')</h2>
            <p>@lang('terms.sections.termination.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.liability.heading')</h2>
            <p>@lang('terms.sections.liability.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.indemnification.heading')</h2>
            <p>@lang('terms.sections.indemnification.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.law.heading')</h2>
            <p>@lang('terms.sections.law.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.changes.heading')</h2>
            <p>@lang('terms.sections.changes.content')</p>
        </section>

        <section class="welcome-section">
            <h2>@lang('terms.sections.contact.heading')</h2>
            <p>@lang('terms.sections.contact.content')</p>
            <ul>
                <li>@lang('terms.sections.contact.email')</li>
            </ul>
        </section>
    </div>
</main>
@endsection
