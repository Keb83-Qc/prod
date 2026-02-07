<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Partner;
use App\Models\CareerPage;

class PageController extends Controller
{
    private function getConseils(array $keywords)
    {
        // ... (votre code actuel pour getConseils reste identique)
        return BlogPost::where(function ($query) use ($keywords) {
            foreach ($keywords as $word) {
                $query->orWhere('category->fr', 'LIKE', "%{$word}%");
            }
        })
            ->latest()
            ->take(3)
            ->get();
    }

    // --- PAGES GÉNÉRALES ---

    public function about()
    {
        $title = __('PageController.about.header_title');
        $description = __('PageController.about.header_subtitle');
        $image = asset('assets/img/En-tete-A-propos-de-nous.jpg');

        return view('pages.about', [
            'header_title' => $title,
            'header_subtitle' => $description,
            'header_bg' => $image,
        ]);
    }

    public function construction()
    {
        $title = __('PageController.construction.header_title');

        return view('pages.construction', [
            'header_title' => $title,
            'header_bg' => asset('assets/img/canvas.png'),
        ]);
    }

    public function partenaires()
    {
        $title = __('PageController.partenaires.header_title');
        $desc = __('PageController.partenaires.header_subtitle');
        $partners = Partner::where('is_visible', true)->orderBy('sort_order', 'asc')->get();

        return view('pages.partenaires', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => asset('assets/img/background-partenaires.jpg'),
            'partners' => $partners,
        ]);
    }

    // --- PAGES ASSURANCES ---

    public function assurances()
    {
        $title = __('PageController.assurances.header_title');
        $desc = __('PageController.assurances.header_subtitle');
        $img = asset('assets/img/assurance-main.jpg');

        return view('pages.assurance', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Assurance']),
        ]);
    }

    public function assuranceVie()
    {
        $title = __('PageController.assurance_vie.header_title');
        $desc = __('PageController.assurance_vie.header_subtitle');
        $img = asset('assets/img/service-assurance.png');

        return view('pages.assurance-vie', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Vie', 'Décès']),
        ]);
    }

    public function assuranceMaladieGrave()
    {
        $title = __('PageController.maladie_grave.header_title');
        $desc = __('PageController.maladie_grave.header_subtitle');
        $img = asset('assets/img/assurance-main.jpg');

        return view('pages.assurance-maladie-grave', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Maladie', 'Santé', 'Grave']),
        ]);
    }

    public function assuranceComplementaireDentaire()
    {
        $title = __('assurance-complementaire-dentaire.title');
        $desc = __('assurance-complementaire-dentaire.subtitle');
        $img = asset('assets/img/asian-happy-woman-with-toothbrush-bathrobe-morning-mood.jpg');

        return view('pages.assurance-complementaire-dentaire', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Dentaire', 'Santé', 'Assurance']),
        ]);
    }

    public function assuranceInvalidite()
    {
        $title = __('PageController.invalidite.header_title');
        $desc = __('PageController.invalidite.header_subtitle');
        $img = asset('assets/img/service-assurance.png');

        return view('pages.assurance-invalidite', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Invalidité', 'Salaire', 'Revenu']),
        ]);
    }

    public function assuranceInvaliditeIndividuelle()
    {
        $title = __('PageController.invalidite_individuelle.header_title');
        $desc = __('PageController.invalidite_individuelle.header_subtitle');
        $img = asset('assets/img/Entete-assurance-individuelle.jpg');

        return view('pages.assurance-invalidite-individuelle', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Invalidité', 'Individuelle']),
        ]);
    }

    public function assuranceInvaliditeDeGroupe()
    {
        $title = __('PageController.assurance_groupe.header_title');
        $desc = __('PageController.assurance_groupe.header_subtitle');
        $img = asset('assets/img/En-tete-Assurance-de-groupe12.jpg');

        return view('pages.assurance-invalidite-de-groupe', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Groupe', 'Collective', 'Entreprise']),
        ]);
    }

    public function assuranceDommages()
    {
        $title = __('PageController.dommages.header_title');
        $desc = __('PageController.dommages.header_subtitle');
        $img = asset('assets/img/assurance-main.jpg');

        return view('pages.assurance-dommages', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Dommage', 'Générale', 'Biens']),
        ]);
    }

    public function assuranceAuto()
    {
        $title = __('PageController.auto.header_title');
        $desc = __('PageController.auto.header_subtitle');
        $img = asset('assets/img/Entete-assurance-auto.jpg');

        return view('pages.assurance-auto', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Auto', 'Véhicule', 'Voiture']),
        ]);
    }

    public function assuranceHabitation()
    {
        $title = __('PageController.habitation.header_title');
        $desc = __('PageController.habitation.header_subtitle');
        $img = asset('assets/img/Entete-assurance-habitation.jpg');

        return view('pages.assurance-habitation', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Habitation', 'Maison', 'Logement']),
        ]);
    }

    public function assuranceResponsabilite()
    {
        $title = __('PageController.responsabilite.header_title');
        $desc = __('PageController.responsabilite.header_subtitle');
        $img = asset('assets/img/En-tete-Ass-reponsabilite-civile.jpg');

        return view('pages.assurance-responsabilite-professionnelle', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Responsabilité', 'Professionnelle', 'Civile']),
        ]);
    }

    public function assuranceCommerciale()
    {
        $title = __('PageController.commerciale.header_title');
        $desc = __('PageController.commerciale.header_subtitle');
        $img = asset('assets/img/En-tete-assurance-commerciale.jpg');

        return view('pages.assurance-commerciale', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Commercial', 'Entreprise', 'Affaires']),
        ]);
    }

    public function assuranceVoyage()
    {
        $title = __('PageController.voyage.header_title');
        $desc = __('PageController.voyage.header_subtitle');
        $img = asset('assets/img/assurance-main.jpg');

        return view('pages.assurance-voyage', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Voyage']),
        ]);
    }

    public function assuranceVieHypothecaire()
    {
        $title = __('PageController.vie_hypothecaire.header_title');
        $desc = __('PageController.vie_hypothecaire.header_subtitle');
        $img = asset('assets/img/service-hypotheque.png');

        return view('pages.assurance-vie-hypothecaire', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Hypothécaire', 'Hypothèque']),
        ]);
    }

    // --- PAGES ÉPARGNE & RETRAITE ---

    public function epargne()
    {
        $title = __('PageController.epargne.header_title');
        $desc = __('PageController.epargne.header_subtitle');
        $img = asset('assets/img/EN-TETE-EPARGNE.jpg');

        return view('pages.epargne', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Épargne', 'Placement', 'Investissement']),
        ]);
    }

    public function reer()
    {
        $title = __('PageController.reer.header_title');
        $desc = __('PageController.reer.header_subtitle');
        $img = asset('assets/img/En-tete-REER.jpg');

        return view('pages.reer', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['REER', 'Retraite']),
        ]);
    }

    public function celi()
    {
        $title = __('PageController.celi.header_title');
        $desc = __('PageController.celi.header_subtitle');
        $img = asset('assets/img/En-tete-Celi.jpg');

        return view('pages.celi', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['CELI', 'Épargne']),
        ]);
    }

    public function celiapp()
    {
        $title = __('PageController.celiapp.header_title');
        $desc = __('PageController.celiapp.header_subtitle');
        $img = asset('assets/img/En-tete-CELIAPP.jpg');

        return view('pages.celiapp', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['CÉLIAPP', 'Propriété', 'Achat']),
        ]);
    }

    public function reei()
    {
        $title = __('PageController.reei.header_title');
        $desc = __('PageController.reei.header_subtitle');
        $img = asset('assets/img/En-tete-REER.jpg');

        return view('pages.reei', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['REEI', 'Invalidité', 'Épargne']),
        ]);
    }

    public function rene()
    {
        $title = __('PageController.rene.header_title');
        $desc = __('PageController.rene.header_subtitle');
        $img = asset('assets/img/AdobeStock_650596699.jpg');

        return view('pages.rene', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Non enregistré', 'RENE']),
        ]);
    }

    public function cri()
    {
        $title = __('PageController.cri.header_title');
        $desc = __('PageController.cri.header_subtitle');
        $img = asset('assets/img/En-tete-CRI.jpg');

        return view('pages.cri', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['CRI', 'Immobilisé']),
        ]);
    }

    public function frv()
    {
        $title = __('PageController.frv.header_title');
        $desc = __('PageController.frv.header_subtitle');
        $img = asset('assets/img/En-tete-FRV.jpg');

        return view('pages.frv', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['FRV', 'Rente']),
        ]);
    }

    public function ferr()
    {
        $title = __('PageController.ferr.header_title');
        $desc = __('PageController.ferr.header_subtitle');
        $img = asset('assets/img/En-tete-FERR.jpg');

        return view('pages.ferr', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['FERR', 'Rente']),
        ]);
    }

    public function reee()
    {
        $title = __('PageController.reee.header_title');
        $desc = __('PageController.reee.header_subtitle');
        $img = asset('assets/img/En-tete-REEE-.jpg');

        return view('pages.reee', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['REEE', 'Études', 'Enfants']),
        ]);
    }

    // --- PAGES PRÊTS & HYPOTHÈQUES ---

    public function prets()
    {
        $title = __('PageController.prets.header_title');
        $desc = __('PageController.prets.header_subtitle');
        $img = asset('assets/img/service-pret.png');

        return view('pages.pret', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Prêt', 'Emprunt', 'Dette']),
        ]);
    }

    public function hypotheque()
    {
        $title = __('PageController.hypotheque.header_title');
        $desc = __('PageController.hypotheque.header_subtitle');
        $img = asset('assets/img/service-hypotheque.png');

        return view('pages.hypotheque', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Hypothèque', 'Maison']),
        ]);
    }

    public function achatClefEnMain()
    {
        $title = __('PageController.clef_en_main.header_title');
        $desc = __('PageController.clef_en_main.header_subtitle');
        $img = asset('assets/img/En-tete-programme-clef-en-main.jpg');

        return view('pages.programme-dachat-clef-en-main', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Achat', 'Clef en main', 'Propriété']),
        ]);
    }

    public function pretHypothecaire()
    {
        $title = __('PageController.pret_hypothecaire.header_title');
        $desc = __('PageController.pret_hypothecaire.header_subtitle');
        $img = asset('assets/img/En-tete-pret-hypothecaire.jpg');

        return view('pages.pret-hypothecaire', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Hypothécaire', 'Prêt']),
        ]);
    }

    public function pretReer()
    {
        $title = __('PageController.pret_reer.header_title');
        $desc = __('PageController.pret_reer.header_subtitle');
        $img = asset('assets/img/En-tete-pret-reer.jpg');

        return view('pages.pret-reer', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Prêt REER', 'REER']),
        ]);
    }

    public function pretReee()
    {
        $title = __('PageController.pret_reee.header_title');
        $desc = __('PageController.pret_reee.header_subtitle');
        $img = asset('assets/img/En-tete-pret-REEE.jpg');

        return view('pages.pret-reee', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Prêt REEE', 'REEE']),
        ]);
    }

    public function pretInvestissement()
    {
        $title = __('PageController.pret_investissement.header_title');
        $desc = __('PageController.pret_investissement.header_subtitle');
        $img = asset('assets/img/En-tete-Pret-pour-Investissements.jpg');

        return view('pages.pret-investissement', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Levier', 'Investissement', 'Prêt']),
        ]);
    }

    public function carteCredit()
    {
        $title = __('PageController.carte_credit.header_title');
        $desc = __('PageController.carte_credit.header_subtitle');
        $img = asset('assets/img/credit-card.webp');

        return view('pages.carte-de-credit', [
            'header_title' => $title,
            'header_subtitle' => $desc,
            'header_bg' => $img,
            'conseils' => $this->getConseils(['Crédit', 'Carte', 'Banque']),
        ]);
    }

    public function carrieres()
    {
        $careerSettings = \App\Models\CareerPage::first();

        return view('pages.carrieres', [
            // Titre et Image
            'header_title' => __('carrieres.hero_title'),
            'header_subtitle' => __('carrieres.hero_subtitle'),
            'header_bg' => asset('assets/img/carrieres1.jpg'),

            // LE BOUTON DYNAMIQUE
            'header_btn_text' => __('carrieres.hero_cta'), // Clé du texte du bouton
            'header_btn_link' => '#pipelines',              // Lien vers l'ancre en bas de page

            'careerSettings' => $careerSettings,
        ]);
    }
}
