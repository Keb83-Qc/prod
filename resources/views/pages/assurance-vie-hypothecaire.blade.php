@include('partials.header')

{{-- SECTION 1 : INTRO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">Assurance vie hypothécaire</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>
                        L’assurance-vie hypothécaire est un type d’assurance conçu pour rembourser le solde d’un prêt
                        hypothécaire en cas de décès de l’emprunteur. Le montant de la protection initiale diminue à
                        100% au fur et à mesure que le prêt est remboursé.
                    </p>
                    <p>
                        Elle prend généralement fin une fois la maison payée. En revanche, elle peut être convertie en
                        assurance personnelle au terme du contrat dans certains types de contrats. Toutefois, selon les
                        préférences, le capital d’assurance initial peut être nivelé ou décroissant jusqu’à concurrence
                        de 50 %.
                    </p>
                </div>

                {{-- Boutons d'action --}}
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}"
                        class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        Obtenir une cotation
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        Contactez-nous
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                {{-- Image récupérée de votre code --}}
                <img src="{{ asset('assets/img/A-cote-texte-hypotheeque.jpg') }}" alt="Assurance vie hypothécaire"
                    class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : POURQUOI C'EST ESSENTIEL ? (3 BLOCS ICÔNES) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">Pourquoi l’assurance-vie hypothécaire est
                essentielle ?</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/icons-2.png') }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold mb-3 text-dark">Protection financière pour la famille</h5>
                    <p class="text-muted small mb-0">Rembourse le solde du prêt en cas de décès, soulageant la famille
                        du fardeau financier et maintenant la stabilité du ménage.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/icons-1.png') }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold mb-3 text-dark">Éviter la saisie immobilière</h5>
                    <p class="text-muted small mb-0">Évite la saisie de la propriété par la banque en remboursant le
                        solde du prêt, protégeant ainsi le toit familial.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/icons-3.png') }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold mb-3 text-dark">Soulagement émotionnel</h5>
                    <p class="text-muted small mb-0">Offre la tranquillité d'esprit en évitant à la famille de
                        s'inquiéter des dettes hypothécaires lors de la perte d'un être cher.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : ASSURANCE PERSONNELLE VS INSTITUTION PRÊTEUSE --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">Assurance Personnelle vs Institution Prêteuse</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted w-75 mx-auto">
                L'hypothèque est souvent la plus grande dette d'une vie. Le choix entre une assurance personnelle ou
                bancaire dépend de vos besoins, mais les différences sont majeures.
            </p>
        </div>

        {{-- Grille des 6 avantages de l'assurance personnelle --}}
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="d-flex align-items-start p-3 border rounded h-100 hover-lift bg-light">
                    <img src="{{ asset('assets/img/insurance_1955512.png') }}" width="50" class="me-3 mt-1" alt="Icone">
                    <div>
                        <h6 class="fw-bold text-dark">1. Personnalisation</h6>
                        <p class="small text-muted mb-0">Adaptable à vos besoins spécifiques (montant, bénéficiaires,
                            conditions).</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="d-flex align-items-start p-3 border rounded h-100 hover-lift bg-light">
                    <img src="{{ asset('assets/img/b2c_4775304.png') }}" width="50" class="me-3 mt-1" alt="Icone">
                    <div>
                        <h6 class="fw-bold text-dark">2. Transférabilité</h6>
                        <p class="small text-muted mb-0">Elle vous suit si vous changez de prêteur, contrairement à
                            l'assurance bancaire.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="d-flex align-items-start p-3 border rounded h-100 hover-lift bg-light">
                    <img src="{{ asset('assets/img/fair-trade_4668463.png') }}" width="50" class="me-3 mt-1"
                        alt="Icone">
                    <div>
                        <h6 class="fw-bold text-dark">3. Stabilité des primes</h6>
                        <p class="small text-muted mb-0">Les primes peuvent rester fixes pendant la durée du contrat.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="d-flex align-items-start p-3 border rounded h-100 hover-lift bg-light">
                    <img src="{{ asset('assets/img/paperwork_8092235.png') }}" width="50" class="me-3 mt-1" alt="Icone">
                    <div>
                        <h6 class="fw-bold text-dark">4. Non imposable</h6>
                        <p class="small text-muted mb-0">Les prestations sont généralement exonérées d'impôt.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="d-flex align-items-start p-3 border rounded h-100 hover-lift bg-light">
                    <img src="{{ asset('assets/img/profile_13192937.png') }}" width="50" class="me-3 mt-1" alt="Icone">
                    <div>
                        <h6 class="fw-bold text-dark">5. Choix du bénéficiaire</h6>
                        <p class="small text-muted mb-0">Vous choisissez qui reçoit l'argent, pas la banque.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="d-flex align-items-start p-3 border rounded h-100 hover-lift bg-light">
                    <img src="{{ asset('assets/img/trial_10930240.png') }}" width="50" class="me-3 mt-1" alt="Icone">
                    <div>
                        <h6 class="fw-bold text-dark">6. Concurrence et choix</h6>
                        <p class="small text-muted mb-0">Vous pouvez comparer les offres de différentes compagnies.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : TABLEAU COMPARATIF --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">Tableau comparatif</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="table-responsive shadow-sm rounded bg-white">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th style="background-color: #323e89; font-weight: bold; color: white;">Caractéristiques</th>
                        <th style="background-color: #323e89; font-weight: bold; color: white;">Institutions prêteuses</th>
                        <th style="background-color: #323e89; font-weight: bold; color: white;">Assureurs privés</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: lightblue; color: black; font-weight: 500;">Propriété du contrat</td>
                        <td>Généralement l’institution prêteuse</td>
                        <td>Le ou les contractants</td>
                    </tr>
                    <tr>
                        <td style="background-color: lightblue; color: black; font-weight: 500;">Bénéficiaire</td>
                        <td>Généralement l’institution prêteuse</td>
                        <td>Au choix du ou des contractants</td>
                    </tr>
                    <tr>
                        <td style="background-color: lightblue; color: black; font-weight: 500;">Prime garantie</td>
                        <td>Non, sujet à augmenter à chaque renouvellement et augmentation des taux d’intérêts</td>
                        <td>Oui, la prime n’augmentera jamais sauf en cas d’augmentation de la couverture</td>
                    </tr>
                    <tr>
                        <td style="background-color: lightblue; color: black; font-weight: 500;">Transférabilité</td>
                        <td>Non, la couverture n’est pas transférable d’un prêteur à l’autre</td>
                        <td>Oui, la couverture suit le contractant. Donc, transférable.</td>
                    </tr>
                    <tr>
                        <td style="background-color: lightblue; color: black; font-weight: 500;">Capital d’assurance</td>
                        <td>
                            <ul class="ps-3 mb-0">
                                <li>Capital d’assurance décroissant à 100 %.</li>
                                <li>Seule la balance du prêt est payée.</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="ps-3 mb-0">
                                <li>Capital d’assurance nivelé ou décroissant à 50 %.</li>
                                <li>100% ou 50 % du prêt initial sera payé peu importe la balance du prêt.</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: lightblue; color: black; font-weight: 500;">Flexibilité</td>
                        <td>Généralement, impossible de personnaliser sa couverture</td>
                        <td>Le contractant peut personnaliser sa couverture sur mesure</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-5 text-center">
            <p class="text-muted fst-italic w-75 mx-auto">
                "Il est essentiel de bien comprendre les termes, les conditions, les exclusions et les coûts associés à toute assurance hypothécaire avant de prendre une décision. Consultez un conseiller indépendant."
            </p>
            <a href="{{ url('/contact') }}" class="btn btn-primary rounded-pill px-5 shadow-sm mt-3 text-white fw-bold">Parler à un expert</a>
        </div>
    </div>
</section>

{{-- SECTION 5 : ZONE CONSEILS (BLOG DYNAMIQUE) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">Zone conseils</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">Nos articles pour mieux comprendre l'assurance hypothécaire.</p>
        </div>

        <div class="row g-4 justify-content-center">

            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-home fa-3x"></i></div>
                <p class="text-muted">Aucun article disponible dans cette catégorie pour le moment.</p>
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
                    <div
                        style="height: 200px; background-color: #ddd; background-image: url('{{ $imgSrc }}'); background-size: cover; background-position: center;">
                    </div>

                    <div class="card-body text-center p-4 d-flex flex-column">
                        <div class="mb-2 text-muted small text-uppercase">
                            <i class="far fa-calendar-alt text-warning me-1"></i>
                            {{ $post->created_at->format('d M Y') }}
                        </div>
                        <h5 class="card-title fw-bold mb-3 text-dark">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">En
                                savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

        </div>
    </div>
</section>

{{-- Style CSS --}}
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