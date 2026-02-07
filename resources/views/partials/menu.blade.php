<!-- TOP BAR -->
<div class="vip-topbar">
    <div class="container d-flex align-items-center justify-content-between py-2">
        <div class="d-none d-md-flex align-items-center gap-2 vip-topbar-left">
            <i class="fas fa-shield-alt text-warning"></i>
            <span>{{ __('menu.topbar.tagline') }}</span>
        </div>

        <div class="d-flex align-items-center gap-3 ms-auto vip-topbar-right">
            <div class="vip-lang small">
                <a href="/switch-language/fr" class="{{ app()->getLocale() === 'fr' ? 'is-active' : '' }}">FR</a>
                <span class="sep">|</span>
                <a href="/switch-language/en" class="{{ app()->getLocale() === 'en' ? 'is-active' : '' }}">EN</a>
            </div>

            <a href="/evenements" class="vip-topbar-link">
                <i class="fas fa-calendar-alt me-1"></i> {{ __('menu.topbar.events') }}
            </a>

            <a href="/login" class="vip-topbar-link opacity-75">
                <i class="fas fa-lock me-1"></i> {{ __('menu.topbar.advisor') }}
            </a>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-xl vip-navbar sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://vipgpi.ca/assets/img/VIP_Logo_Gold_Gradient10.png" alt="VIP GPI" class="vip-logo" width="200">
        </a>

        <button class="navbar-toggler border-0 p-2" type="button"
            data-bs-toggle="collapse" data-bs-target="#vipNav"
            aria-controls="vipNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-bars fa-lg text-white"></span>
        </button>

        <div class="collapse navbar-collapse" id="vipNav">
            <ul class="navbar-nav ms-auto align-items-xl-center gap-xl-1">

                <li class="nav-item"><a class="nav-link" href="/">{{ __('menu.nav.home') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="/about">{{ __('menu.nav.about') }}</a></li>

                <!-- MEGA MENU (Desktop) -->
                <li class="nav-item dropdown vip-mega d-none d-xl-block">
                    <a class="nav-link dropdown-toggle" href="#" id="vipServices"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        {{ __('menu.nav.services') }}
                    </a>

                    <div class="dropdown-menu vip-mega-menu p-0 border-0 shadow-lg" aria-labelledby="vipServices">
                        <div class="vip-mega-shell p-3 p-xxl-4">
                            <div class="row g-4">

                                <!-- Colonne gauche (tabs) -->
                                <div class="col-4 col-xxl-3">
                                    <div class="nav flex-column nav-pills vip-mega-pills" id="vipMegaTabs" role="tablist">
                                        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pane-assurances" type="button" role="tab">
                                            {{ __('menu.mega.tabs.insurance') }}
                                        </button>
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pane-epargne" type="button" role="tab">
                                            {{ __('menu.mega.tabs.savings') }}
                                        </button>
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pane-pret" type="button" role="tab">
                                            {{ __('menu.mega.tabs.loan') }}
                                        </button>
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pane-hypo" type="button" role="tab">
                                            {{ __('menu.mega.tabs.mortgage') }}
                                        </button>
                                    </div>

                                    <div class="vip-mega-cta mt-3 p-3">
                                        <div class="vip-mega-cta-title">{{ __('menu.mega.cta.title') }}</div>
                                        <div class="vip-mega-cta-sub">{{ __('menu.mega.cta.sub') }}</div>
                                        <a class="btn vip-btn-gold w-100 mt-2" href="/contact">
                                            {{ __('menu.mega.cta.btn') }}
                                        </a>
                                    </div>
                                </div>

                                <!-- Colonne droite (contenu) -->
                                <div class="col-8 col-xxl-9">
                                    <div class="tab-content">

                                        <!-- INSURANCE -->
                                        <div class="tab-pane fade show active" id="pane-assurances" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <div class="vip-mega-title">{{ __('menu.mega.sections.insurance.protection') }}</div>
                                                    <a class="vip-mega-link" href="/assurance-vie">{{ __('menu.mega.links.insurance.protection.life') }}</a>
                                                    <a class="vip-mega-link" href="/assurance-maladie-grave">{{ __('menu.mega.links.insurance.protection.critical') }}</a>
                                                    <a class="vip-mega-link" href="/assurance-invalidite-individuelle">{{ __('menu.mega.links.insurance.protection.disability_ind') }}</a>
                                                    <a class="vip-mega-link" href="/assurance-invalidite-de-groupe">{{ __('menu.mega.links.insurance.protection.disability_grp') }}</a>
                                                    <a class="vip-mega-link" href="/assurance-complementaire-dentaire">{{ __('menu.mega.links.insurance.protection.complementary') }}</a>
                                                </div>

                                                <div class="col-6">
                                                    <div class="vip-mega-title">{{ __('menu.mega.sections.insurance.damage') }}</div>
                                                    <a class="vip-mega-link" href="/assurance-auto">{{ __('menu.mega.links.insurance.damage.auto') }}</a>
                                                    <a class="vip-mega-link" href="/assurance-habitation">{{ __('menu.mega.links.insurance.damage.home') }}</a>
                                                    <a class="vip-mega-link" href="/assurance-responsabilite-professionnelle">{{ __('menu.mega.links.insurance.damage.liability') }}</a>
                                                    <a class="vip-mega-link" href="/assurance-commerciale">{{ __('menu.mega.links.insurance.damage.commercial') }}</a>
                                                    <a class="vip-mega-link" href="/assurance-voyage">{{ __('menu.mega.links.insurance.damage.travel') }}</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SAVINGS -->
                                        <div class="tab-pane fade" id="pane-epargne" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <div class="vip-mega-title">{{ __('menu.mega.sections.savings.savings') }}</div>
                                                    <a class="vip-mega-link" href="/reer">{{ __('menu.mega.links.savings.left.reer') }}</a>
                                                    <a class="vip-mega-link" href="/celi">{{ __('menu.mega.links.savings.left.celi') }}</a>
                                                    <a class="vip-mega-link" href="/celiapp">{{ __('menu.mega.links.savings.left.celiapp') }}</a>
                                                    <a class="vip-mega-link" href="/reei">{{ __('menu.mega.links.savings.left.reei') }}</a>
                                                    <a class="vip-mega-link" href="/rene">{{ __('menu.mega.links.savings.left.rene') }}</a>
                                                </div>
                                                <div class="col-6">
                                                    <div class="vip-mega-title">{{ __('menu.mega.sections.savings.retirement') }}</div>
                                                    <a class="vip-mega-link" href="/cri">{{ __('menu.mega.links.savings.right.cri') }}</a>
                                                    <a class="vip-mega-link" href="/frv">{{ __('menu.mega.links.savings.right.frv') }}</a>
                                                    <a class="vip-mega-link" href="/ferr">{{ __('menu.mega.links.savings.right.ferr') }}</a>
                                                    <a class="vip-mega-link" href="/reee">{{ __('menu.mega.links.savings.right.reee') }}</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- LOAN -->
                                        <div class="tab-pane fade" id="pane-pret" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <div class="vip-mega-title">{{ __('menu.mega.sections.loan.financing') }}</div>
                                                    <a class="vip-mega-link" href="/pret-reer">{{ __('menu.mega.links.loan.reer') }}</a>
                                                    <a class="vip-mega-link" href="/pret-reee">{{ __('menu.mega.links.loan.reee') }}</a>
                                                    <a class="vip-mega-link" href="/pret-investissement">{{ __('menu.mega.links.loan.invest') }}</a>
                                                    <a class="vip-mega-link" href="/carte-de-credit">{{ __('menu.mega.links.loan.cc') }}</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MORTGAGE -->
                                        <div class="tab-pane fade" id="pane-hypo" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <div class="vip-mega-title">{{ __('menu.mega.sections.mortgage.mortgage') }}</div>
                                                    <a class="vip-mega-link" href="/programme-dachat-clef-en-main">{{ __('menu.mega.links.mortgage.turnkey') }}</a>
                                                    <a class="vip-mega-link" href="/pret-hypothecaire">{{ __('menu.mega.links.mortgage.mortgage') }}</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /tab-content -->
                                </div>
                            </div><!-- /row -->
                        </div><!-- /shell -->
                    </div><!-- /menu -->
                </li>

                <!-- Liens normaux -->
                <li class="nav-item"><a class="nav-link" href="/equipe">{{ __('menu.nav.team') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="/blog">{{ __('menu.nav.blog') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="/carrieres">{{ __('menu.nav.careers') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="/partenaires">{{ __('menu.nav.partners') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">{{ __('menu.nav.contact') }}</a></li>

                <!-- CTA -->
                <li class="nav-item ms-xl-2 my-3 my-xl-0">
                    <a href="/contact" class="btn vip-btn-gold rounded-pill px-4 py-2 w-100 w-xl-auto">
                        {{ __('menu.nav.cta') }}
                    </a>
                </li>

                <!-- Mobile: lien Services simple -->
                <li class="nav-item d-xl-none">
                    <a class="nav-link" href="/services">{{ __('menu.nav.services_mobile') }}</a>
                </li>

            </ul>
        </div>
    </div>
</nav>