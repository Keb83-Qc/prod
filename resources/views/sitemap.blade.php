<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1.0</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ url('/about') }}</loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/contact') }}</loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/equipe') }}</loc>
        <priority>0.9</priority>
        <changefreq>weekly</changefreq>
    </url>

    @foreach($members as $m)
    <url>
        <loc>{{ url('/conseiller/' . $m->slug) }}</loc>
        <priority>0.8</priority>
    </url>
    @endforeach
</urlset>
