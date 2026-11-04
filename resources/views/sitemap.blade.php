{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($urls as $url)
    <url>
        <loc>{{ $url['location'] }}</loc>
@if ($url['last_modified'])
        <lastmod>{{ $url['last_modified'] }}</lastmod>
@endif
@if (isset($url['changefreq']))
        <changefreq>{{ $url['changefreq'] }}</changefreq>
@endif
@if (isset($url['priority']))
        <priority>{{ $url['priority'] }}</priority>
@endif
    </url>
@endforeach
</urlset>