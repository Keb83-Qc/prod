@include('partials.header')

<section class="section-padding bg-light py-5">
    <div class="container">
        {{-- Formulaire de filtre --}}
        <div class="row justify-content-center mb-5">
            <div class="col-md-10 col-lg-8">
                <form method="GET" action="{{ url('/equipe') }}" class="card border-0 shadow-sm p-2 rounded-pill">
                    <div class="input-group">

                        {{-- ICÔNE RECHERCHE --}}
                        <span class="input-group-text bg-white border-0 ps-3 text-muted rounded-pill-start">
                            <i class="fas fa-search"></i>
                        </span>

                        {{-- SELECT VILLE --}}
                        <select name="ville" class="form-select border-0 bg-transparent fw-bold text-dark focus-none"
                            onchange="this.form.submit()">
                            <option value="">{{ __('TeamController.filter_all') }} (Villes)</option>
                            @foreach($cities as $city)
                            <option value="{{ $city }}" {{ $selected_city == $city ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                            @endforeach
                        </select>

                        {{-- SÉPARATEUR VISUEL --}}
                        <span class="border-end mx-2 my-2"></span>

                        {{-- SELECT LANGUE --}}
                        <select name="langue" class="form-select border-0 bg-transparent fw-bold text-dark focus-none"
                            onchange="this.form.submit()">
                            <option value="">Toutes les langues</option>
                            @foreach($available_languages as $code => $label)
                            <option value="{{ $code }}" {{ $selected_lang == $code ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>

                        {{-- BOUTON --}}
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
                            {{ __('TeamController.filter_btn') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- SI AUCUN RÉSULTAT --}}
        @if($members->isEmpty())
        <div class="text-center text-muted py-5">
            <div class="mb-3"><i class="fas fa-search fa-3x opacity-25"></i></div>
            <h3>{{ __('TeamController.no_results_title') }}</h3>
            <a href="{{ url('/equipe') }}" class="btn btn-outline-dark rounded-pill mt-3 px-4">
                {{ __('TeamController.no_results_btn') }}
            </a>
        </div>
        @else

        {{-- LISTE DES MEMBRES --}}
        <div class="row g-4 justify-content-center">

            @foreach($members as $m)
            @php
            // 1. Image et Lien
            $img = $m->image_url;
            $link_profile = empty($m->slug) ? '#' : url('/conseiller/' . $m->slug);

            // 2. Gestion de la langue
            $lang = app()->getLocale();

            // 3. Gestion du Titre (Correction du bug Array)
            $display_role = 'Conseiller'; // Valeur par défaut

            if ($m->title) {
            // Si 'name' est un tableau (traduit via Translatable)
            if (is_array($m->title->name)) {
            $display_role = $m->title->name[$lang] ?? ($m->title->name['fr'] ?? array_values($m->title->name)[0]);
            }
            // Si c'est du JSON string
            elseif (is_string($m->title->name) && str_starts_with($m->title->name, '{')) {
            $decoded = json_decode($m->title->name, true);
            $display_role = $decoded[$lang] ?? ($decoded['fr'] ?? $m->title->name);
            }
            // Si c'est une simple chaine
            else {
            $display_role = $m->title->name;
            }
            }
            // Si pas de titre, on prend le rôle système
            elseif ($m->role) {
            $display_role = ucfirst($m->role->name);
            }

            // 4. Langues parlées
            $langs = $m->languages ?? [];
            @endphp

            <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-stretch">
                <div class="card team-card w-100 shadow-sm border-0 h-100 position-relative overflow-hidden">
                    <div class="card-body d-flex flex-column align-items-center p-4">

                        {{-- PHOTO --}}
                        <div class="mb-3 position-relative d-inline-block">
                            <a href="{{ $link_profile }}" class="d-block text-decoration-none">
                                <img src="{{ $img }}" alt="{{ $m->first_name }}"
                                    class="rounded-circle shadow border border-4 border-white transition-hover"
                                    style="width: 130px; height: 130px; object-fit: cover;">
                            </a>
                        </div>

                        {{-- INFOS --}}
                        <div class="team-info text-center flex-grow-1 w-100">
                            <h4 class="fw-bold mb-1 text-dark text-truncate px-2">
                                {{ $m->first_name }} {{ $m->last_name }}
                            </h4>

                            {{-- ICI LE TITRE CORRIGÉ --}}
                            <div class="team-role text-primary small fw-bold text-uppercase mb-2 text-truncate px-2">
                                {{ $display_role }}
                            </div>

                            {{-- VILLE --}}
                            @if(!empty($m->city))
                            <div class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $m->city }}
                            </div>
                            @endif

                            {{-- LANGUES --}}
                            @if(!empty($langs))
                            <div class="mb-3">
                                @foreach($langs as $lng)
                                <span class="badge bg-light text-secondary border rounded-pill small fw-normal">
                                    {{ strtoupper($lng) }}
                                </span>
                                @endforeach
                            </div>
                            @endif

                        </div>

                        {{-- BOUTONS --}}
                        <div class="d-grid gap-2 w-100 mt-auto">
                            @if(!empty($m->booking_url))
                            <a href="{{ $m->booking_url }}" target="_blank"
                                class="btn btn-primary rounded-pill fw-bold shadow-sm py-2">
                                <i class="fas fa-calendar-check me-2"></i> {{ __('TeamController.btn_appointment') }}
                            </a>
                            @else
                            <a href="{{ $link_profile }}"
                                class="btn btn-outline-primary rounded-pill fw-bold shadow-sm py-2">
                                <i class="fas fa-user me-2"></i> {{ __('TeamController.btn_profile') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        @endif
    </div>
</section>

@include('partials.footer')