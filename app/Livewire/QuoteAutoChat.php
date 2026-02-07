<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Submission;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NewSubmissionAdmin;
use App\Services\LeadDispatcher;

class QuoteAutoChat extends Component
{
    // --- PROPRIÉTÉS ---
    public $step = 'year';
    public $data = [];
    public Submission $submission; // Typage fort

    // Info Agent
    public $advisorCode;
    public $agentName = 'Julie'; // Valeur par défaut
    public $agentImage;

    // Listes déroulantes
    public $brands;
    public $models = [];

    // Inputs du formulaire
    // Note : On garde tout en public pour le binding Livewire
    public $vehicle_year;
    public $vehicle_brand;
    public $vehicle_model;
    public $renewal_date;
    public $usage; // Ajouté pour binding
    public $first_name;
    public $last_name;
    public $address;
    public $email;
    public $phone;
    public $age; // Remplace birth_date
    public $license_number;

    // --- DÉFINITION DE L'ORDRE DES ÉTAPES ---
    // Clé = Nom de l'étape, Valeur = Champ requis dans $data pour passer à la suite
    protected $stepOrder = [
        'year'           => 'year',
        'brand'          => 'brand',
        'model'          => 'model',
        'renewal_date'   => 'renewal_date',
        'usage'          => 'usage',
        'km_annuel'      => 'km_annuel',
        'address'        => 'address',
        'identity'       => ['first_name', 'last_name'], // Tableau car 2 champs requis
        'age'            => 'age',
        'email'          => 'email',
        'phone'          => 'phone',
        'license_number' => 'license_number',
    ];

    // --- INITIALISATION ---
    // AJOUT : On injecte LeadDispatcher ici
    public function mount(LeadDispatcher $dispatcher)
    {
        if (!session('has_consented')) {
            return redirect()->route('consent.show');
        }

        // --- LOGIQUE DE DISTRIBUTION ---
        // 1. Si aucun conseiller n'est dans la session (client organique)
        if (!session()->has('current_advisor_code')) {
            // 2. On demande au Dispatcher d'en choisir un
            $assignedAdvisor = $dispatcher->assignAdvisor();

            // 3. Si un conseiller est trouvé, on le stocke en session
            if ($assignedAdvisor) {
                session(['current_advisor_code' => $assignedAdvisor->advisor_code]);
            }
        }
        // -------------------------------

        // Chargement Conseiller (La session est maintenant remplie soit par le lien, soit par le Dispatcher)
        $this->advisorCode = session('current_advisor_code');
        $advisor = User::where('advisor_code', $this->advisorCode)->first();

        if ($advisor) {
            $this->agentName = $advisor->first_name;
            $this->agentImage = $advisor->image ? asset($advisor->image) : asset('assets/img/agent-default.jpg');
        } else {
            // Fallback si le dispatcher n'a rien trouvé ou si le code est invalide
            $this->agentImage = asset('assets/img/agent-default.jpg');
        }

        // Chargement Données initiales
        $this->brands = VehicleBrand::orderBy('name')->get();

        if (session()->has('current_submission_id')) {
            $submission = Submission::find(session('current_submission_id'));
            if ($submission) {
                $this->submission = $submission;
                $this->data = $submission->data ?? [];
                $this->fillPropertiesFromData();
                $this->calculateStep();
            }
        }
    }

    // --- LOGIQUE CENTRALE ---

    /**
     * Détermine l'étape actuelle en fonction des données présentes
     */
    public function calculateStep()
    {
        $this->step = 'final'; // Par défaut, on finit

        foreach ($this->stepOrder as $stepName => $requiredFields) {
            $missing = false;

            if (is_array($requiredFields)) {
                // Si plusieurs champs sont requis pour une étape (ex: identity)
                foreach ($requiredFields as $field) {
                    if (!isset($this->data[$field]) || $this->data[$field] === '') {
                        $missing = true;
                        break;
                    }
                }
            } else {
                // Si un seul champ requis
                if (!isset($this->data[$requiredFields]) || $this->data[$requiredFields] === '') {
                    $missing = true;
                }
            }

            if ($missing) {
                $this->step = $stepName;
                break; // On s'arrête à la première étape incomplète
            }
        }

        // Logique spécifique pour recharger les modèles si on revient en arrière
        if ($this->step == 'model' && isset($this->data['brand_id'])) {
            $this->models = VehicleModel::where('vehicle_brand_id', $this->data['brand_id'])
                ->orderBy('name')
                ->get();
        }
    }

    /**
     * Sauvegarde unique vers la Base de Données
     */
    public function persist($key, $value)
    {
        // 1. Mise à jour locale
        $this->data[$key] = $value;

        // 2. Création ou Mise à jour DB
        if (!isset($this->submission)) {
            $this->submission = Submission::create([
                'type' => 'auto',
                'advisor_code' => $this->advisorCode,
                'data' => $this->data
            ]);
            session(['current_submission_id' => $this->submission->id]);
        } else {
            $this->submission->update(['data' => $this->data]);
        }

        // 3. Recalcul et Scroll
        $this->calculateStep();
        $this->dispatch('scroll-down');
    }

    // --- HANDLERS (UPDATED) ---

    // Année
    public function updatedVehicleYear($val)
    {
        if (!empty($val)) $this->persist('year', $val);
    }

    // Marque
    public function updatedVehicleBrand($val)
    {
        $brand = VehicleBrand::find($val);
        if ($brand) {
            $this->data['brand_id'] = $brand->id; // On garde l'ID pour charger les modèles
            $this->models = VehicleModel::where('vehicle_brand_id', $brand->id)->orderBy('name')->get();
            $this->persist('brand', $brand->name);
        }
    }

    // Modèle
    public function updatedVehicleModel($val)
    {
        $model = VehicleModel::find($val);
        if ($model) $this->persist('model', $model->name);
    }

    // --- HANDLERS (SUBMIT / CLICKS) ---

    public function submitRenewalDate()
    {
        $this->validate(['renewal_date' => 'required|date']);
        $this->persist('renewal_date', $this->renewal_date);
    }

    // Boutons Usage (Personnel/Commercial)
    public function save($field, $value)
    {
        $this->persist($field, $value);
    }

    // Boutons KM
    public function setKm($val)
    {
        $this->persist('km_annuel', $val);
    }

    public function submitAddress()
    {
        $this->validate(['address' => 'required|string|min:5']);
        $this->persist('address', $this->address);
    }

    public function submitIdentity()
    {
        $this->validate([
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
        ]);

        $this->data['first_name'] = $this->first_name;
        // On passe 'last_name' à persist pour déclencher la sauvegarde
        // Comme 'identity' nécessite les deux champs dans $stepOrder, le calcul se fera correctement
        $this->persist('last_name', $this->last_name);
    }

    public function submitAge()
    {
        $this->validate(['age' => 'required|integer|min:16|max:100']);
        $this->persist('age', $this->age);
    }

    public function submitEmail()
    {
        $this->validate(['email' => 'required|email']);
        $this->persist('email', $this->email);
    }

    public function submitPhone()
    {
        $this->validate(['phone' => 'required|string|min:10']);
        $this->persist('phone', $this->phone);
    }

    public function submitLicense()
    {
        $val = !empty($this->license_number) ? $this->license_number : 'Non fourni';
        $this->persist('license_number', $val);
    }

    public function skipLicense()
    {
        $this->persist('license_number', 'Non fourni');
    }

    // --- NAVIGATION & UTILITAIRES ---

    public function goToStep($name)
    {
        $this->step = $name;
        $this->dispatch('scroll-down');
    }

    private function fillPropertiesFromData()
    {
        // Remplit les variables publiques (pour les inputs) avec les données de la DB
        foreach ($this->data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
        // Mapping spécifique si les noms diffèrent légèrement
        if (isset($this->data['year'])) $this->vehicle_year = $this->data['year'];
        if (isset($this->data['brand_id'])) $this->vehicle_brand = $this->data['brand_id']; // Pour le select
        if (isset($this->data['model_id'])) $this->vehicle_model = $this->data['model_id']; // Si vous stockez l'ID
    }

    // --- FINALISATION ---

    public function finalize()
    {
        if (!$this->submission) return;

        // 1. Préparation des destinataires
        $recipients = array_filter([
            env('INSURANCE_BROKER_EMAIL'),
            // Si le conseiller existe, on l'ajoute
            User::where('advisor_code', $this->advisorCode)->value('email')
        ]);

        $recipients = array_unique($recipients);

        // 2. Envoi
        if (!empty($recipients)) {
            try {
                Mail::to($recipients)->send(new NewSubmissionAdmin($this->submission));
                Log::info("Soumission Auto {$this->submission->id} envoyée à : " . implode(', ', $recipients));
            } catch (\Exception $e) {
                Log::error("Erreur Mail Soumission Auto {$this->submission->id}: " . $e->getMessage());
            }
        } else {
            Log::warning("Aucun destinataire pour Soumission Auto {$this->submission->id}");
        }

        // 3. Reset et Redirection
        session()->forget(['current_submission_id', 'current_advisor_code']);
        return redirect()->route('quote.success');
    }

    public function render()
    {
        return view('livewire.quote-auto-chat');
    }
}
