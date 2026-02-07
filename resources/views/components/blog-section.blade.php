<section class="section-padding bg-white">
    <div class="container">
        {{-- En-tête de section --}}
        <div class="text-center mb-5">
            @if($subtitle)
            <span class="text-uppercase fw-bold letter-spacing-2 text-primary small">
                {{ $subtitle }}
            </span>
            @endif

            <h2 class="fw-bold mt-2 display-6">
                {{ $title }}
            </h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        {{-- Liste des articles --}}
        <div class="row g-3 g-lg-4 justify-content-center">
            @forelse($posts as $post)
            @php
            $lang = app()->getLocale();
            $postTitle = $post->title;
            if (is_array($postTitle) || (is_string($postTitle) && str_starts_with($postTitle, '{'))) {
            $postTitle = $post->getTranslation('title', $lang);
            }
            $postContent = $post->content;
            if (is_array($postContent) || (is_string($postContent) && str_starts_with($postContent, '{'))) {
            $postContent = $post->getTranslation('content', $lang);
            }
            $intro = Str::limit(strip_tags(html_entity_decode($postContent)), 100, '...');
            $imgSrc = asset('assets/img/default.jpg');
            if (!empty($post->image)) {
            if (str_starts_with($post->image, 'http') || str_starts_with($post->image, 'assets')) {
            $imgSrc = $post->image;
            } else {
            $imgSrc = asset('storage/' . $post->image);
            }
            }
            $dateFormatted = $post->created_at->translatedFormat('d M, Y');
            $slug = $post->slug;
            if (is_array($slug) || (is_string($slug) && str_starts_with($slug, '{'))) {
            $slug = $post->getTranslation('slug', $lang);
            }
            $link = route('blog.show', ['post' => $slug]);
            @endphp

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex align-items-stretch">
                {{-- CORRECTION ICI : Ajout de position-relative --}}
                <div class="blog-card position-relative h-100 w-100 d-flex flex-column shadow-sm hover-card rounded overflow-hidden">

                    <a href="{{ $link }}" class="blog-thumb ratio ratio-16x9 d-block">
                        <img src="{{ $imgSrc }}" alt="{{ $postTitle }}" class="w-100 h-100 object-fit-cover">
                    </a>

                    <div class="blog-content d-flex flex-column flex-grow-1 p-3">
                        <div class="blog-meta text-muted text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">
                            <i class="far fa-clock me-1 text-warning"></i> {{ $dateFormatted }}
                        </div>

                        <h4 class="blog-title mb-2 fw-bold" style="font-size: 1.1rem; line-height: 1.3;">
                            {{-- Le stretched-link va maintenant s'arrêter aux limites de .blog-card --}}
                            <a href="{{ $link }}" class="text-dark text-decoration-none stretched-link">
                                {{ $postTitle }}
                            </a>
                        </h4>

                        <p class="text-muted small flex-grow-1 mb-3" style="line-height: 1.5;">
                            {!! $intro !!}
                        </p>

                        <div class="mt-auto border-top pt-2">
                            {{-- Note : Ce lien fonctionne grâce au z-index css ajouté plus bas --}}
                            <a href="{{ $link }}" class="text-uppercase small fw-bold text-dark text-decoration-none hover-gold" style="font-size: 0.8rem;">
                                {{ __('home.read_more') }} <i class="fas fa-arrow-right ms-1 text-warning small"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                <p>{{ __('home.no_news') }}</p>
            </div>
            @endforelse
        </div>

        {{-- CORRECTION ICI : Ajout de position-relative et z-index --}}
        <div class="text-center mt-5 position-relative" style="z-index: 10;">
            <a href="{{ url('/blog') }}" class="btn btn-outline-dark rounded-pill px-4 btn-sm fw-bold">
                {{ __('home.view_all_news') }} <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<style>
    .object-fit-cover {
        object-fit: cover;
    }

    .stretched-link::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        content: "";
    }

    /* Important pour que le lien "lire plus" reste cliquable malgré le stretched-link */
    .blog-card .border-top a {
        position: relative;
        z-index: 2;
    }
</style>