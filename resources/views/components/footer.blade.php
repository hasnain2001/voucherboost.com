
    <div class="footer-signup py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5>Sign up for our weekly email newsletter with the best money-saving coupons.</h5>
                    <p>We’ll never share your email address with a third-party.</p>
                </div>
                <div class="col-md-6">
                    <form class="d-flex align-items-center subscribe">
                        <input type="email" class="me-3" placeholder="Enter Your Email">
                        <button type="submit" class="subscribe-btn">Subscribe &#9993;</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <footer>
        <div class="separator"></div>
        <div class="footer-links">
            <div class="footer-logo">
                <a href="/">
                <img src="{{asset('images/logo.png')}}" alt="Logo">
            </a>
                <p style="max-width: 250px; font-size: 14px;">Disclaimer: "We may earn a commission when you use one of our coupons/links to make a purchase."</p>
            </div>
            <div>
                <h3>@lang('nav.Quick Links')</h3>
                <p><a href="{{route('20-off-offers',['lang' => app()->getLocale()])}}">@lang('nav.20% OFFERS')</a></p>
                <p><a href="{{route('FREE-DELIVERY',['lang' => app()->getLocale()])}}">@lang('nav.FREE DELIVERY')</a></p>
                <p><a href="{{route('stores',['lang' => app()->getLocale()])}}">@lang('nav.stores')</a></p>
                <p><a href="{{route('categories',['lang' => app()->getLocale()])}}">@lang('nav.cateories')</a></p>
            </div>
            <div>
                <h3>Information</h3>
                <p><a class="@if(Route::currentRouteName() == 'about') active @endif" href="{{route('about',['lang' => app()->getLocale()])}}">Who Are We</a></p>
                <p><a class="@if(Route::currentRouteName() == 'privacy') active @endif" href="{{route('privacy',['lang' => app()->getLocale()])}}">Privacy Policy</a></p>
                <p><a class=" @if(Route::currentRouteName() == 'terms_and_condition') active @endif" href="{{route('terms_and_condition',['lang' => app()->getLocale()])}}">Terms of Use</a></p>
                <p><a class="@if(Route::currentRouteName() == 'contact') active @endif" href="{{route('contact',['lang' => app()->getLocale()])}}">Contact</a></p>
            </div>
            <div>
                <h3>@lang('nav.Popular Stores')</h3>
                <div class="popular-stores">
                    @foreach ($populorstores as $store)
                    <ul>
                        <li><p><a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}">{{$store->name}}</a></p></li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyright &copy; {{ date('Y') }} | @lang('nav.Company Name. All rights reserved')</p>
        </div>
    </footer>
