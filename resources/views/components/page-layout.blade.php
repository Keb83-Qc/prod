@props(['withBlog' => true])

@include('partials.header')

<main>
    {{ $slot }}
</main>

{{-- LOGIQUE INTELLIGENTE DU BLOG --}}
@if (isset($blog))
{{-- 1. Si la page fournit un blog personnalisé, on l'affiche --}}
{{ $blog }}
@elseif($withBlog)
{{-- 2. Sinon, si le blog est activé, on affiche celui par défaut --}}
<x-blog-section limit="3" />
@endif

@include('partials.footer')