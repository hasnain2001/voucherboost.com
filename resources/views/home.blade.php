    @extends('welcome')
    @section('title')
    Redeem Relax - Best Deals and Discounts | Redeem Relax
    @endsection
    @section('description')
    Find the best deals, discounts, and coupons on Redeem Relax. Save money on your favorite products from top brands.
    @endsection
    @section('keywords')
    deals, discounts, coupons, savings, affiliate marketing, promo codes, cashback, online shopping, special offers, vouchers, best prices, holiday sales, seasonal discounts, gift cards, price comparison, money-saving tips
    @endsection
    <style>
    .slider-image {
    height: 450px;
    width: 100%;
    }
    /* Blog Section */
    .blog-section {
    padding: 40px 20px;
    background-color: #f9f9f9;
    }
    .blog-section h2{
    font-size: 22px;
    text-align: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color:
    }

    /* Blog Container */
    .blog-container {
    display: grid; /* Use CSS Grid for layout */
    grid-template-columns: repeat(4, 1fr); /* 4 columns per row */
    gap: 20px; /* Space between cards */
    justify-content: center;
    align-items: start;
    }

    /* Blog Card */
    .blog-card {

    border: 1px solid #ddd;
    border-radius: 2px;
    overflow: hidden;

    height: 250px; background-color: #f7f7f7;
    /* box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); */
    /* transition: transform 0.3s ease, box-shadow 0.3s ease; */
    }

    .blog-card:hover {
    /* transform: translateY(-5px); */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Blog Image */
    .blog-image {
    width: 100%;
    height: 140px; /* Fixed height for consistency */
    object-fit: fill; /* Ensures the image covers the area without distortion */
    }

    /* Blog Title */
    .blog-title {
    font-size: 15px;
    font-weight: 600;
    margin: 15px 10px;
    text-align: center;
    color: #333;
    }
    .blog-catory{
    padding:20px ;
    color: #f55a42;
    }

    /* Read More Button */
    .read-more {
    display: block;
    text-align: center;
    margin: 10px;
    padding: 10px 15px;
    background-color: #111a23;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    }

    .read-more:hover {
    background-color: #0056b3;
    }
    .blog-link{
    color: #111a23;
    text-decoration: none;
    }
    .h-1{
    font-size: 25px;
    color: #333;
    text-align: center;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
    .blog-container {
    grid-template-columns: repeat(2, 1fr); /* Two columns on medium screens */
    }
    }

    @media (max-width: 576px) {
    .blog-container {
    grid-template-columns: 1fr; /* One column on small screens */
    }
    }
    .custom-image {
    border-radius: 20px;
    }
    .highlight {
    color: #f55a42; /* Change to match the "Everyday" text color */
    }
    .custom-btn {
    background-color: #f55a42;
    color: #fff;
    border: none;
    }
    .custom-btn:hover {
    background-color: #d04836;
    }
    body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.hero-section {
    background: linear-gradient(to right, #2a00b7, #b20078);
    color: white;
    padding: 50px 0;
    padding-bottom: 200px;
    text-align: left;
    position: relative;
    overflow: hidden;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}






    .hero-content {
    max-width: 600px;
    }
    .highlight {
    color: rgb(253, 100, 40);
    font-weight: bold;
    }
    .highlight-alt {
    color: #ff6347;
    font-weight: bold;
    }
    .circle-container {
    position: absolute;
    left: 50px;
    top: 50px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    }
    .circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    }
    .circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }
    .btn-custom {
    background-color: #ff6347;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    color: white;
    font-weight: bold;
    }
    .img-blog{
    width: 100%;
    height: 250px;

    }
</style>
@section('main-content')
<main class=" text-capitalize">

<section class="hero-section d-flex align-items-center justify-content-center position-relative">


    <div class="container">
    <div class="row">
    <div class="col-lg-6 position-relative">
    <div class="circle-container">
    @foreach ($category as $category)
    <a href="{{ route('related_category', ['slug' => Str::slug($category->slug)]) }}" >
    <div class="circle"><img src="{{ asset('uploads/categories/' . $category->category_image) }}" alt="Image 1"></div>

    </a>
    @endforeach
    </div>
    </div>
    <div class="col-lg-6 hero-content">
    <h2><span class="highlight">#SHAREASALE</span></h2>
    <h3>Explore The Latest Trending <span class="highlight-alt">Ideas In Our Fresh</span> Look Book Collection.</h3>
    <p>Cool way to live</p>
    <button class="btn-custom">About Us</button>
    </div>
    </div>

    </div>


    </section>




<section class="blog-section">
<div class="container">
    <h1 class="h-1">Upgrade Your Wardrobe <span>And EnhanceYour </span>Living Spaces.</h1>
    <div class="blog-container">

        @foreach ($blogs as $blog)
            @php
                $blogurl = $blog->slug
                    ? route('blog-details', ['slug' => Str::slug($blog->slug)])
                    : '#';
            @endphp
            <!-- Blog Card -->
            <div class="blog-card">
                <a href="{{ $blogurl }}" class="blog-link ">
                    <img src="{{ asset($blog->category_image) }}" class="blog-image" alt="Blog Post Image">
                    <h5 class="blog-title">{{ $blog->title }}</h5>
                </a>
                <span class=" blog-catory">{{$blog->category}}</span>
                {{-- <a href="{{ $blogurl }}" class="read-more">Read More</a> --}}
            </div>
        @endforeach
    </div>
</div>
</section>
<section>
    <div class="container py-5">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h1 class="fw-bold">Discover Fresh Ideas <span class="highlight">Everyday</span></h1>
            <p class="mt-3">We will discuss the new ideas of the Fashion and Lifestyle.</p>
            <p>Join us in embracing the transformative influence of fashion, a journey that goes beyond clothing to embody self-expression.</p>

                @foreach ($categories as $category)
            @if($category->title === 'Fashion')
            <a href="{{ route('related_category', ['slug' => Str::slug($category->slug)]) }}" class="btn custom-btn mt-3">
                Fashion Blogs →
            </a>

        @endif
            @endforeach



          </div>
          <div class="col-md-6 text-center">
            <img src="{{ asset('images/img-1.png') }}" alt="Fashion Image" class="img-fluid custom-image">
          </div>
        </div>
      </div>
</section>
<section>
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/img-1.png') }}" alt="Fashion Image" class="img-fluid custom-image">
              </div>
          <div class="col-md-6">
            <h1 class="fw-bold">Great Choices For  <span class="highlight">Your Loves One</span></h1>
            <p class="mt-3">We will discuss the new ideas of the Fashion and Lifestyle.</p>
            <p>Join us in embracing the transformative influence of fashion, a journey that goes beyond clothing to embody self-expression.</p>
            @foreach ($categories as $category)
            @if ($category->slug === 'Accessories')
                <a href="{{ route('related_category', ['slug' => $category->slug]) }}" class="btn custom-btn mt-3">
                    Accessories Blogs →
                </a>
            @endif
        @endforeach

          </div>

        </div>
      </div>
</section>
<section class="blog-section">
    <h1 class="h-1">Upgrade Your Wardrobe <span>And EnhanceYour </span>Living Spaces.</h1>
    <div class="blog-container container">

        @foreach ($topblogs as $blog)
            @php
                $blogurl = $blog->slug
                    ? route('blog-details', ['slug' => Str::slug($blog->slug)])
                    : '#';
            @endphp
            <!-- Blog Card -->
            <div class="blog-card">
                <a href="{{ $blogurl }}" class="blog-link ">
                    <img src="{{ asset($blog->category_image) }}" class="blog-image" alt="Blog Post Image">
                    <h5 class="blog-title">{{ $blog->title }}</h5>
                </a>
                <span class=" blog-catory">{{$blog->category}}</span>
                {{-- <a href="{{ $blogurl }}" class="read-more">Read More</a> --}}
            </div>
        @endforeach
    </div>
</section>
<section>
<div class="container py-5">
<div class="text-center">
<h5>All The Essentials For <span style="color: #d04836;">Your Active Pet's</span> on-the-move Lifestyle</h5>
<p>Offering pet essentials is more than just providing supplies; it's about nurturing a lifestyle that celebrates the incomparable connection between pets and their human companions.</p>
</div>
</div>
</section>
<section>
    <div class="container py-5">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h1 class="fw-bold">Inspiration To <span class="highlight">Propel Your Pet's </span>Adventure Forward.
            </h1>
            <p class="mt-3">Your pet doesn’t have to wait. Get everything delivered right blog</p>
            <p>We Will take care of your demands.</p>

                @foreach ($categories as $category)
                @if($category->title === 'Pets')
            <a href="{{ route('related_category', ['slug' => Str::slug($category->slug)]) }}" class="btn custom-btn mt-3">
                Pets Blogs →
            </a>

        @endif
            @endforeach



          </div>
          <div class="col-md-6 text-center">
            <img src="{{ asset('images/img-2.png') }}" alt="Fashion Image" class="img-fluid custom-image">
          </div>
        </div>
      </div>
</section>

<section class="blog-section py-5 bg-light">
    <div class="container">
        <h1 class="text-center mb-4">
            Unforgettable Destination
            <span class=" highlight fw-bold"> To Indulge In A Multitude Of Activities </span>
            Multitude Of Activities
        </h1>
        <div class="row g-4">
            @foreach ($latestblogs as $blog)
                @php
                    $blogurl = $blog->slug
                        ? route('blog-details', ['slug' => Str::slug($blog->slug)])
                        : '#';
                @endphp
                <!-- Blog Card -->
                <div class="col-md-6 col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <a href="{{ $blogurl }}" class="text-decoration-none">
                            <img src="{{ asset($blog->category_image) }}" class="img-blog card-img-top rounded-top" alt="Blog Post Image">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ $blogurl }}" class="text-dark fw-bold text-decoration-none">
                                    {{ $blog->title }}
                                </a>
                            </h5>
                            <span>{{$blog->category}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


</main>

@endsection
