@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('carte-de-credit.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('carte-de-credit.intro_text') }}</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="https://neo.cc/refer/S8L3Q5Y4" target="_blank" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">{{ __('carte-de-credit.btn_apply') }}</a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">{{ __('carte-de-credit.btn_contact') }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal">
                    <img src="{{ asset('assets/img/image-21.jpg') }}" alt="Carte de crédit" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
                </a>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 order-2 order-lg-1 text-center">
                <img src="{{ asset('assets/img/image-221.jpg') }}" alt="App Neo" class="img-fluid rounded shadow-lg" style="max-height: 600px;">
            </div>
            <div class="col-lg-7 order-1 order-lg-2 mb-5 mb-lg-0 ps-lg-5">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('carte-de-credit.neo_title') }}</h3>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-dark fs-5" style="line-height: 1.8;">
                    <p>{{ __('carte-de-credit.neo_text') }}</p>
                </div>
                <div class="mt-4">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> {{ __('carte-de-credit.features.f1') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> {{ __('carte-de-credit.features.f2') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> {{ __('carte-de-credit.features.f3') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('carte-de-credit.table_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="text-center mt-5">
            <a href="https://neo.cc/refer/S8L3Q5Y4" target="_blank" class="btn btn-primary rounded-pill px-5 py-3 shadow text-white fw-bold text-uppercase">{{ __('carte-de-credit.btn_get') }}</a>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('carte-de-credit.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-credit-card fa-3x"></i></div>
                <p class="text-muted">Aucun article disponible.</p>
            </div>
            @elseif(isset($conseils))
            @foreach($conseils as $post)
            @php
            $lang = app()->getLocale();
            $title = ($lang == 'en' && !empty($post->title_en)) ? $post->title_en : $post->title;
            $rawContent = ($lang == 'en' && !empty($post->content_en)) ? $post->content_en : $post->content;
            $desc = Str::limit(strip_tags(html_entity_decode($rawContent)), 100, '...');
            $imgSrc = !empty($post->image) ? asset($post->image) : asset('assets/img/default.jpg');
            $link = url('/article/' . $post->id);
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div style="height: 200px; background-color: #ddd; background-image: url('{{ $imgSrc }}'); background-size: cover; background-position: center;"></div>
                    <div class="card-body text-center p-4 d-flex flex-column">
                        <h5 class="card-title fw-bold mb-3 text-dark">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('carte-de-credit.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }
</style>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-body p-0 position-relative text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <img src="{{ asset('assets/img/image-21.jpg') }}" class="img-fluid rounded shadow-lg" alt="Carte de crédit">
            </div>
        </div>
    </div>
</div>

@include('partials.footer')