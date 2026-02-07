@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('pret-investissement.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('pret-investissement.intro_text') }}</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">{{ __('pret-investissement.btn_request') }}</a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">{{ __('pret-investissement.btn_contact') }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/quest-ce-quun-pret-pour-investissement.png') }}" alt="Prêt investissement" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <img src="{{ asset('assets/img/pret-Investissement.png') }}" alt="Pourquoi prêt" class="img-fluid rounded shadow-lg w-100">
            </div>
            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0 ps-lg-5">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('pret-investissement.why_title') }}</h3>
                <div class="text-dark text-justify" style="line-height: 1.8;">
                    <p>{{ __('pret-investissement.why_text') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret-investissement.who_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-primary text-white p-4 text-center hover-lift">
                    <h3 class="fw-bold mb-3">{{ __('pret-investissement.user_1_title') }}</h3>
                    <p class="small mb-0">{{ __('pret-investissement.user_1_desc') }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-secondary text-white p-4 text-center hover-lift">
                    <h3 class="fw-bold mb-3">{{ __('pret-investissement.user_2_title') }}</h3>
                    <p class="small mb-0">{{ __('pret-investissement.user_2_desc') }}</p>
                </div>
            </div>
        </div>
        <div class="mt-5 text-center px-lg-5">
            <p class="text-muted fst-italic">"{{ __('pret-investissement.disclaimer') }}"</p>
        </div>
    </div>
</section>

<section class="section-padding d-flex align-items-center" style="background-image: url('{{ asset('assets/img/AdobeStock_713694880.jpg') }}'); background-size: cover; background-position: center; min-height: 600px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-10">
                <div class="p-5 rounded shadow-lg" style="background-color: rgba(255, 255, 255, 0.9);">
                    <div class="mb-4">
                        <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret-investissement.advantages_title') }}</h2>
                        <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-top: 15px;"></div>
                    </div>
                    <ul class="list-unstyled text-dark fs-6 mb-0">
                        @foreach(__('pret-investissement.adv_list') as $adv)
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-check-circle text-success mt-1 me-3"></i>
                            <span>{{ $adv }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret-investissement.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-chart-line fa-3x"></i></div>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('pret-investissement.read_more') }}</a>
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

@include('partials.footer')