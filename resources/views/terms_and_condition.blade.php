@extends('welcome')
@section('title')
Stores - Best Deals and Discounts on voucher Boost
@endsection
@section('description')
    Find the latest coupon codes and deals for your favorite stores. Save money on your online shopping with our exclusive discount codes.
@endsection
@section('keywords')
    coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection
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
@section('main-content')



<div class="container">
    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none text-primary" style="font-weight: 500;">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">@lang('terms.title')</li>
        </ol>
    </nav>
</div>
<main class=" text-capitalize terms ">
    <div class="container bg-light">
        <div class="container ">
    <h1>Terms And Condition</h1>
    </div>
    </section>
    <br>   <br>
    <section class="welcome-section">
    <h2>Welcome to voucherboost</h2>
    <p>These Terms & Conditions ("Terms") govern your use of the voucherboost website (the "Website") and all related services provided by voucherboost ("voucherboost", "we", "us", or "our"). By accessing or using the Website, you agree to be bound by these Terms. If you do not agree to these Terms, please do not use the Website.</p>
    </section>
    <section class="welcome-section">
    <h2>1. User Agreement</h2>
    <p>By using the Website, you agree to comply with these Terms and any additional terms that we may provide to you in connection with your use of specific features or services.</p>
    </section>
    <section class="welcome-section">
    <h2>2. Use of the Website</h2>
    <p>You may use the Website for your personal, non-commercial purposes only. You may not use the Website for any illegal or unauthorized purpose. You agree to comply with all applicable laws, rules, and regulations.</p>
    </section>
    <section class="welcome-section">
    <h2>3. Account Registration</h2>
    <p>In order to access certain features of the Website, you may be required to register for an account. When registering for an account, you agree to provide accurate, current, and complete information about yourself. You are solely responsible for maintaining the confidentiality of your account and password and for restricting access to your account. You agree to accept responsibility for all activities that occur under your account.</p>
    </section>
     <section class="welcome-section">
    <h2>4. Content</h2>
    <p>You acknowledge that all content on the Website, including but not limited to text, images, graphics, logos, and software, is owned by voucherboost or its licensors and is protected by copyright, trademark, and other intellectual property laws. You may not modify, reproduce, distribute, or create derivative works based on any content on the Website without the express written consent of voucherboost.</p>
    </section>
    <section class="welcome-section">
    <h2>5. User-Submitted Content</h2>
    <p>By submitting content to the Website, including but not limited to reviews, comments, and ratings, you grant voucherboost a non-exclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content throughout the world in any media.
    </p>
    </section>

    <section class="welcome-section">
    <h2>6. Links to Third-Party Websites</h2>
    <p>The Website may contain links to third-party websites or resources. You acknowledge and agree that voucherboost is not responsible or liable for: (i) the availability or accuracy of such websites or resources; or (ii) the content, products, or services on or available from such websites or resources. Links to such websites or resources do not imply any endorsement by voucherboost of such websites or resources or the content, products, or services available from such websites or resources. You acknowledge sole responsibility for and assume all risk arising from your use of any such websites or resources.
    </p>
    </section>
    <section class="welcome-section">
    <h2>7. Termination</h2>
    <p>voucherboost may terminate or suspend your access to the Website at any time, with or without cause, and with or without notice.
    </p>
    </section>
    <section class="welcome-section">
    <h2>8. Limitation of Liability</h2>
    <p>In no event shall voucherboost, its officers, directors, employees, or agents, be liable to you for any direct, indirect, incidental, special, punitive, or consequential damages whatsoever resulting from any (i) errors, mistakes, or inaccuracies of content; (ii) personal injury or property damage, of any nature whatsoever, resulting from your access to and use of the Website; (iii) any unauthorized access to or use of our secure servers and/or any and all personal information stored therein; (iv) any interruption or cessation of transmission to or from the Website; (v) any bugs, viruses, trojan horses, or the like, which may be transmitted to or through the Website by any third party; and/or (vi) any errors or omissions in any content or for any loss or damage of any kind incurred as a result of your use of any content posted, emailed, transmitted, or otherwise made available via the Website, whether based on warranty, contract, tort, or any other legal theory, and whether or not the company is advised of the possibility of such damages.
    </p>
    </section>

     <section class="welcome-section">
    <h2>9. Indemnification</h2>
    <p>You agree to indemnify and hold harmless voucherboost, its officers, directors, employees, and agents, from and against any claims, liabilities, damages, losses, and expenses, including without limitation reasonable legal and accounting fees, arising out of or in any way connected with your access to or use of the Website, or your violation of these Terms.
    </p>
    </section>

    <section class="welcome-section">
    <h2>10. Governing Law</h2>
    <p>
    These Terms shall be governed by and construed in accordance with the laws of [Your Jurisdiction], without regard to its conflict of law provisions.

    </p>
    </section>
     <section class="welcome-section">
    <h2>11. Changes to Terms</h2>
    <p>
     voucherboost reserves the right to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.
    </p>
    </section>
     <section class="welcome-section">
    <h2>12. Contact Us</h2>
    <p>
    If you have any questions about these Terms, please contact us at:

    <ul>
             <li>Email: contact@voucherboost.com</li>
             <li>Emal:voucherboost@gmail.comss</li>
         </ul>


    </p>
    </section>


    </div>
</main>
        @endsection

