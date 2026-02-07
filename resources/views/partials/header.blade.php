<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mega-menu.css') }}?v={{ time() }}">



    {{-- Schema.org Spécifique --}}
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FinancialService",
            "name": "VIP GPI Services Financiers",
            "image": "{{ asset('assets/img/VIP_Logo_Gold_Gradient10.png') }}",
            "telephone": "+14388382630",
            "email": "admin@vipgpi.ca",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "2990 av. Pierre-Péladeau, suite 400",
                "addressLocality": "Laval",
                "addressRegion": "QC",
                "postalCode": "H7T 3B3",
                "addressCountry": "CA"
            },
            "url": "{{ url('/') }}"
        }
    </script>
</head>

<body class="d-flex flex-column min-vh-100">



    {{-- MENU PRINCIPAL --}}
    @include('partials.menu')

    {{-- PAGE HEADER (IMAGE + TITRE) --}}
    @if(!request()->routeIs('home') && !request()->routeIs('landing') && isset($header_title))
    @php
    $bg_image = $header_bg ?? asset('assets/img/canvas.png');
    $display_title = $header_title;
    $display_subtitle = $header_subtitle ?? '';
    @endphp

    <section class="page-header d-flex align-items-center justify-content-center text-center"
        style="background-image: url('{{ $bg_image }}');
           min-height: 400px;
           padding: 60px 20px;
           background-size: cover;
           background-position: center top;
           position: relative;">

        <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(14, 16, 48, 0.1);">
        </div>

        <div class="container position-relative z-2">
            {{-- 1. TITRE --}}
            <h1 class="display-4 fw-bold text-white mb-3" style="font-size: clamp(2rem, 5vw, 3.5rem);">
                {!! $display_title !!} {{-- Utilisation de {!! !!} pour permettre le HTML (span coloré) --}}
            </h1>

            {{-- 2. SOUS-TITRE --}}
            @if(!empty($display_subtitle))
            <p class="lead text-white-50 mx-auto mb-4" style="max-width: 700px; font-size: clamp(1rem, 3vw, 1.25rem);">
                {{ $display_subtitle }}
            </p>
            @endif

            {{-- 3. BOUTON DYNAMIQUE (NOUVEAU) --}}
            @if(isset($header_btn_text) && isset($header_btn_link))
            <div class="mt-4 animate__animated animate__fadeInUp">
                <a href="{{ $header_btn_link }}"
                    class="btn btn-warning btn-lg px-5 py-3 fw-bold rounded-pill text-dark shadow-lg hover-scale">
                    {{ $header_btn_text }}
                </a>
            </div>
            @endif
        </div>

    </section>
    @endif