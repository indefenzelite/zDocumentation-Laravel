<?php echo trim($xml); ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  {{-- Static Pages --}}
  <url>
      <loc>{{ url('/') }}/</loc>
      <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
  </url>
  <url>
      <loc>{{ url('/contact') }}/</loc>
      <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
  </url>
  <url>
      <loc>{{ url('/work') }}/</loc>
      <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
  </url>
  <url>
      <loc>{{ url('/about') }}/</loc>
      <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
  </url>
  
  <url>
      <loc>{{ url('/faq') }}/</loc>
      <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
  </url>

  {{-- Pages --}}
    @foreach ($website_pages as $website_page)
        <url>
            <loc>{{ url('/') }}/page/{{ $website_page->slug }}</loc>
            <lastmod>{{ $website_page->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
  {{-- Article --}}
  
    @foreach ($articles as $article)
        <url>
            <loc>{{ url('/') }}/blog/{{ $article->slug }}</loc>
            <lastmod>{{ $article->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>