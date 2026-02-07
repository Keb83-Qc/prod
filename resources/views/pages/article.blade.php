@include('partials.header')

@php
// 1. DÉFINITIONS DES VARIABLES MANQUANTES
// Le modèle gère la traduction automatiquement via $article->title / $article->content

$displayTitle = $article->title;

// Si la catégorie est vide, on met le défaut traduit
$displayCat = !empty($article->category) ? $article->category : __('article.default_category');

// Nettoyage du contenu HTML
$content = html_entity_decode($article->content);

// Image de fond (Header)
$headerBg = !empty($header_bg) ? $header_bg : asset('assets/img/Entete-page-blog1.jpg');
@endphp
<style>
    /* Amélioration de l'affichage des articles de blog */
    .article-content table {
        width: 100%;
        margin-bottom: 1.5rem;
        border-collapse: collapse;
    }

    .article-content th,
    .article-content td {
        padding: 12px;
        border: 1px solid #dee2e6;
    }

    .article-content th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    /* Empêche les images trop grandes de briser le site */
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    /* Nettoyage des paragraphes vides */
    .article-content p:empty {
        display: none;
    }
</style>

<section class="page-header article-header overlay-dark"
    style="background-image: url('{{ $headerBg }}'); min-height: 50vh; display: flex; align-items: center; position: relative; background-size: cover; background-position: center;">

    <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5);"></div>

    <div class="container position-relative z-2 text-center text-lg-start">
        <div class="row">
            <div class="col-lg-9">
                <span class="badge bg-warning text-dark mb-2 rounded-0 text-uppercase letter-spacing-2">
                    {{ $displayCat }}
                </span>
                <h1 class="display-4 fw-bold text-white mb-3">{{ $displayTitle }}</h1>

                <div class="article-meta text-white-50 small">
                    <span class="me-3">
                        <i class="far fa-clock text-warning me-2"></i>
                        {{-- Date formatée selon la langue locale --}}
                        {{ $article->created_at->locale(app()->getLocale())->isoFormat('D MMMM YYYY') }}
                    </span>
                    <span>
                        <i class="far fa-user text-warning me-2"></i>{{ $article->author ?? 'VIP GPI' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row">

            {{-- CONTENU PRINCIPAL --}}
            <div class="col-lg-8 pe-lg-5">

                @if(!empty($article->image))
                <div class="mb-5 shadow-sm featured-image-wrapper mx-auto" style="max-width: 850px;">
                    {{-- On limite la hauteur à 450px et on centre l'image dans son cadre --}}
                    <div style="max-height: 400px; width: 100%; overflow: hidden; border-radius: 12px;">
                        <img src="{{ $article->image_url ?? asset('storage/'.$article->image) }}"
                            alt="{{ $displayTitle }}" class="w-100 h-100 object-fit-cover">
                    </div>
                    {{-- Optionnel : Petit crédit photo ou légende sous l'image --}}
                    <div class="text-center mt-2">
                        <small class="text-muted fst-italic">{{ $displayTitle }}</small>
                    </div>
                </div>
                @endif

                <article class="article-content text-dark mb-5 user-generated-content">
                    {!! $content !!}
                </article>

                <div class="d-flex align-items-center justify-content-between border-top border-bottom py-3 mb-5">
                    <span class="fw-bold small text-uppercase">{{ __('article.share') }}</span>
                    <div class="social-share">
                        <a href="#" class="btn btn-sm btn-light rounded-circle me-1"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-light rounded-circle me-1"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>

                {{-- NAVIGATION (Précédent / Suivant) --}}
                <div class="row g-3 mb-5 navigation-area">
                    <div class="col-6">
                        @if($prevPost)
                        <a href="{{ url('/article/' . $prevPost->slug) }}"
                            class="nav-article-link text-start d-block p-4 border rounded h-100 text-decoration-none hover-lift">
                            <small class="text-muted text-uppercase d-block mb-1">
                                <i class="fas fa-arrow-left me-1"></i> {{ __('article.previous') }}
                            </small>
                            {{-- Le modèle gère la langue du titre automatiquement --}}
                            <span class="fw-bold text-dark">{{ Str::limit($prevPost->title, 40) }}</span>
                        </a>
                        @endif
                    </div>
                    <div class="col-6">
                        @if($nextPost)
                        <a href="{{ url('/article/' . $nextPost->slug) }}"
                            class="nav-article-link text-end d-block p-4 border rounded h-100 text-decoration-none hover-lift">
                            <small class="text-muted text-uppercase d-block mb-1">
                                {{ __('article.next') }} <i class="fas fa-arrow-right ms-1"></i>
                            </small>
                            <span class="fw-bold text-dark">{{ Str::limit($nextPost->title, 40) }}</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">
                <div class="sidebar-wrapper ps-lg-4 mt-5 mt-lg-0">

                    {{-- Recherche --}}
                    <div class="sidebar-widget mb-5">
                        <h4 class="widget-title">{{ __('article.search_title') }}</h4>
                        <form action="{{ url('/blog') }}" method="get" class="position-relative">
                            <input type="text" name="search" class="form-control rounded-0 py-2 ps-3 pe-5"
                                placeholder="{{ __('article.search_placeholder') }}">
                            <button type="submit" class="btn position-absolute top-0 end-0 text-muted">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Articles Récents --}}
                    <div class="sidebar-widget mb-5">
                        <h4 class="widget-title">{{ __('article.recent_articles') }}</h4>
                        <ul class="list-unstyled">
                            @foreach($recentPosts as $rp)
                            <li class="mb-3 d-flex align-items-start">
                                @if(!empty($rp->image))
                                {{-- Utilisation de l'accesseur image_url --}}
                                <img src="{{ $rp->image_url ?? asset('storage/'.$rp->image) }}" class="me-3 rounded"
                                    style="width: 70px; height: 70px; object-fit: cover;">
                                @endif
                                <div>
                                    <h6 class="mb-1 fw-bold" style="font-size: 0.95rem;">
                                        <a href="{{ url('/article/' . $rp->id) }}"
                                            class="text-dark text-decoration-none hover-gold">
                                            {{ $rp->title }} {{-- Titre traduit auto --}}
                                        </a>
                                    </h6>
                                    <small class="text-muted" style="font-size: 0.8rem;">
                                        <i class="far fa-clock me-1"></i>
                                        {{ $rp->created_at->locale(app()->getLocale())->isoFormat('D MMM YYYY') }}
                                    </small>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Catégories --}}
                    <div class="sidebar-widget mb-5">
                        <h4 class="widget-title">{{ __('article.categories') }}</h4>
                        <ul class="list-unstyled category-list">
                            {{-- On suppose que $categories est passé depuis le contrôleur --}}
                            @if(isset($categories))
                            @foreach($categories as $catName)
                            @php
                            // Petit hack pour afficher la traduction si $catName est le JSON brut ou la clé FR
                            // Si vous passez les clés FR depuis le contrôleur, vous pouvez utiliser __() ou un mapping
                            // Ici on assume que c'est le texte à afficher
                            $displayCatList = $catName;

                            // Si $catName est une clé de notre mapping (ex: 'Actualités'), on peut tenter de le
                            traduire
                            // Mais le plus simple est de laisser le contrôleur envoyer les données propres
                            @endphp
                            <li class="border-bottom py-2">
                                {{-- Pour le lien, on utilise la valeur brute (FR) pour le filtre --}}
                                <a href="{{ url('/blog?category=' . urlencode($catName)) }}"
                                    class="text-secondary text-decoration-none d-flex justify-content-between align-items-center hover-gold">
                                    <span><i class="fas fa-chevron-right me-2 small text-warning"></i>
                                        {{ $catName }}</span>
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>

                    {{-- Widget Contact --}}
                    <div class="sidebar-widget bg-light p-4 text-center border-top border-3 border-warning shadow-sm">
                        <h5 class="fw-bold mb-3">{{ __('article.need_advice_title') }}</h5>
                        <p class="small text-muted mb-3">
                            {{ __('article.need_advice_text') }}
                        </p>
                        <a href="{{ url('/contact') }}"
                            class="btn btn-sm btn-primary rounded-pill px-4">{{ __('article.contact_btn') }}</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@include('partials.footer')