<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @php
        $currentDate = now()->toAtomString();
    @endphp

    <!-- Static pages -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ $currentDate }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/about') }}</loc>
        <lastmod>{{ $currentDate }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/contact') }}</loc>
        <lastmod>{{ $currentDate }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    <!-- Dynamic posts -->
    @foreach ($stores as $store)
    <url>
        <loc>{{ url('/store/' . $store->slug) }}</loc>
        <lastmod>{{ $store->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

</urlset>
