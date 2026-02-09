<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbfCaseResource\Pages;
use App\Models\AbfCase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AbfCaseResource extends Resource
{
    protected static ?string $model = AbfCase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Analyse des besoins financiers';

    public static function getNavigationGroup(): ?string
    {
        return 'Espace Conseiller';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('advisor_user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Step::make('Dossier')
                    ->id('dossier')
                    ->schema([
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('advisor_code')
                                ->label('Code conseiller')
                                ->disabled()
                                ->dehydrated()
                                ->default(fn() => auth()->user()?->advisor_code),

                            Forms\Components\TextInput::make('advisor_name')
                                ->label('Conseiller')
                                ->disabled()
                                ->dehydrated(false)
                                ->default(fn() => trim((auth()->user()?->first_name ?? '') . ' ' . (auth()->user()?->last_name ?? ''))),

                            Forms\Components\Select::make('status')
                                ->label('Statut')
                                ->options([
                                    'draft' => 'Brouillon',
                                    'completed' => 'Complété',
                                    'signed' => 'Signé',
                                ])
                                ->default('draft')
                                ->required(),
                        ]),

                        Forms\Components\Textarea::make('payload.context.notes')
                            ->label('Notes (dossier)')
                            ->rows(4),
                    ]),

                Step::make('Client')
                    ->id('client')
                    ->schema([
                        Forms\Components\Section::make('Identité')
                            ->columns(3)
                            ->schema([
                                Forms\Components\TextInput::make('payload.client.first_name')
                                    ->label('Prénom')
                                    ->required()
                                    ->live(onBlur: true),

                                Forms\Components\TextInput::make('payload.client.last_name')
                                    ->label('Nom')
                                    ->required()
                                    ->live(onBlur: true),

                                Forms\Components\DatePicker::make('payload.client.birth_date')
                                    ->label('Date de naissance'),
                            ]),

                        Forms\Components\Section::make('Coordonnées')
                            ->columns(3)
                            ->schema([
                                Forms\Components\TextInput::make('payload.client.email')->label('Email')->email(),
                                Forms\Components\TextInput::make('payload.client.phone')->label('Téléphone'),
                                Forms\Components\TextInput::make('payload.client.city')->label('Ville'),
                            ]),

                        Forms\Components\Section::make('Emploi & Revenus')
                            ->columns(3)
                            ->schema([
                                Forms\Components\TextInput::make('payload.client.employer')->label('Employeur'),
                                Forms\Components\TextInput::make('payload.client.occupation')->label('Occupation'),
                                Forms\Components\TextInput::make('payload.client.annual_income')
                                    ->label('Revenu annuel')->numeric()->prefix('$'),
                            ]),
                    ]),

                Step::make('Conjoint')
                    ->id('conjoint')
                    ->schema([
                        Forms\Components\Toggle::make('payload.has_spouse')
                            ->label('Le client a un conjoint ?')
                            ->default(false)
                            ->live(),

                        Forms\Components\Section::make('Infos conjoint')
                            ->visible(fn(Get $get) => (bool) $get('payload.has_spouse'))
                            ->columns(3)
                            ->schema([
                                Forms\Components\TextInput::make('payload.spouse.first_name')->label('Prénom'),
                                Forms\Components\TextInput::make('payload.spouse.last_name')->label('Nom'),
                                Forms\Components\DatePicker::make('payload.spouse.birth_date')->label('Date de naissance'),
                                Forms\Components\TextInput::make('payload.spouse.email')->label('Email')->email(),
                                Forms\Components\TextInput::make('payload.spouse.phone')->label('Téléphone'),
                                Forms\Components\TextInput::make('payload.spouse.annual_income')
                                    ->label('Revenu annuel')->numeric()->prefix('$'),
                            ]),
                    ]),

                Step::make('Famille')
                    ->id('famille')
                    ->schema([
                        Forms\Components\Repeater::make('payload.dependents')
                            ->label('Enfants / personnes à charge')
                            ->collapsed()
                            ->defaultItems(0)
                            ->schema([
                                Forms\Components\TextInput::make('name')->label('Nom')->required(),
                                Forms\Components\DatePicker::make('birth_date')->label('Date de naissance'),
                                Forms\Components\Select::make('relationship')
                                    ->label('Lien')
                                    ->options([
                                        'child' => 'Enfant',
                                        'dependent' => 'Personne à charge',
                                    ])
                                    ->default('child'),
                                Forms\Components\Select::make('financial_dependency')
                                    ->label('Dépendance financière')
                                    ->options([
                                        'full' => 'Totale',
                                        'partial' => 'Partielle',
                                        'none' => 'Aucune',
                                    ])
                                    ->default('full'),
                            ])
                            ->columns(2),
                    ]),

                Step::make('Actifs')
                    ->id('actifs')
                    ->schema([
                        Forms\Components\Repeater::make('payload.assets')
                            ->label('Actifs')
                            ->collapsed()
                            ->defaultItems(0)
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Type')
                                    ->required()
                                    ->options([
                                        'cash' => 'Liquidités',
                                        'tfsa' => 'CELI',
                                        'rrsp' => 'REER',
                                        'nonreg' => 'Non-enregistré',
                                        'home' => 'Résidence principale',
                                        'rental' => 'Immeuble locatif',
                                        'vehicle' => 'Véhicule',
                                        'business' => 'Entreprise',
                                        'other' => 'Autre',
                                    ])
                                    ->live(),

                                Forms\Components\TextInput::make('description')
                                    ->label('Description')
                                    ->placeholder('Ex: CELI Desjardins, Condo Laval, etc.'),

                                Forms\Components\TextInput::make('value')
                                    ->label('Valeur')
                                    ->numeric()
                                    ->prefix('$')
                                    ->required(),

                                Forms\Components\Toggle::make('is_liquid')->label('Actif liquide ?')->default(false),

                                Forms\Components\Select::make('owner')
                                    ->label('Propriétaire')
                                    ->options([
                                        'client' => 'Client',
                                        'spouse' => 'Conjoint',
                                        'joint' => 'Commun',
                                    ])
                                    ->default('client'),

                                Forms\Components\TextInput::make('notes')
                                    ->label('Notes')
                                    ->columnSpanFull(),
                            ])
                            ->columns(3),
                    ]),

                Step::make('Passifs')
                    ->id('passifs')
                    ->schema([
                        Forms\Components\Repeater::make('payload.liabilities')
                            ->label('Dettes / passifs')
                            ->collapsed()
                            ->defaultItems(0)
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Type')
                                    ->required()
                                    ->options([
                                        'mortgage' => 'Hypothèque',
                                        'loc' => 'Marge de crédit',
                                        'loan' => 'Prêt',
                                        'credit' => 'Carte de crédit',
                                        'student' => 'Prêt étudiant',
                                        'other' => 'Autre',
                                    ]),

                                Forms\Components\TextInput::make('creditor')
                                    ->label('Créancier')
                                    ->placeholder('Ex: Desjardins, RBC...'),

                                Forms\Components\TextInput::make('balance')
                                    ->label('Solde')
                                    ->numeric()
                                    ->prefix('$')
                                    ->required(),

                                Forms\Components\TextInput::make('payment_monthly')
                                    ->label('Paiement mensuel')
                                    ->numeric()
                                    ->prefix('$'),

                                Forms\Components\TextInput::make('interest_rate')
                                    ->label('Taux (%)')
                                    ->numeric()
                                    ->suffix('%'),

                                Forms\Components\Select::make('owner')
                                    ->label('Responsable')
                                    ->options([
                                        'client' => 'Client',
                                        'spouse' => 'Conjoint',
                                        'joint' => 'Commun',
                                    ])
                                    ->default('client'),

                                Forms\Components\TextInput::make('notes')
                                    ->label('Notes')
                                    ->columnSpanFull(),
                            ])
                            ->columns(3),
                    ]),

                Step::make('Protections')
                    ->id('protections')
                    ->schema([
                        Forms\Components\Repeater::make('payload.insurances')
                            ->label('Protections / assurances existantes')
                            ->collapsed()
                            ->defaultItems(0)
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Type')
                                    ->required()
                                    ->options([
                                        'life' => 'Assurance vie',
                                        'disability' => 'Invalidité',
                                        'critical_illness' => 'Maladies graves',
                                        'long_term_care' => 'Soins longue durée',
                                        'group' => 'Collective (employeur)',
                                        'other' => 'Autre',
                                    ])
                                    ->live(),

                                Forms\Components\Select::make('insured')
                                    ->label('Assuré')
                                    ->options([
                                        'client' => 'Client',
                                        'spouse' => 'Conjoint',
                                    ])
                                    ->default('client')
                                    ->required(),

                                Forms\Components\TextInput::make('provider')
                                    ->label('Assureur / Fournisseur')
                                    ->placeholder('Ex: Industrielle Alliance'),

                                Forms\Components\TextInput::make('policy_number')->label('No. police'),

                                Forms\Components\TextInput::make('coverage')->label('Couverture')->numeric()->prefix('$'),
                                Forms\Components\TextInput::make('premium')->label('Prime')->numeric()->prefix('$'),

                                Forms\Components\TextInput::make('beneficiary')->label('Bénéficiaire'),

                                Forms\Components\Toggle::make('is_in_force')->label('En vigueur ?')->default(true),

                                Forms\Components\Textarea::make('notes')
                                    ->label('Notes')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])
                            ->columns(3),
                    ]),

                Step::make('Résumé')
                    ->id('resume')
                    ->schema([
                        Forms\Components\Section::make('Notes du conseiller')
                            ->schema([
                                Forms\Components\Textarea::make('payload.advisor_notes')
                                    ->label('Notes')
                                    ->rows(6),
                            ]),

                        Forms\Components\Section::make('Contrôle rapide')
                            ->columns(4)
                            ->schema([
                                Forms\Components\Placeholder::make('progress_percent')
                                    ->label('Progression')
                                    ->content(
                                        fn(?AbfCase $record) => $record?->progress_percent !== null
                                            ? ($record->progress_percent . '%')
                                            : '—'
                                    ),

                                Forms\Components\Placeholder::make('assets_total')
                                    ->label('Total actifs')
                                    ->content(fn(?AbfCase $record) => '$' . number_format((float)($record->results['totals']['assets_total'] ?? 0), 0, '.', ' ')),

                                Forms\Components\Placeholder::make('liabilities_total')
                                    ->label('Total passifs')
                                    ->content(fn(?AbfCase $record) => '$' . number_format((float)($record->results['totals']['liabilities_total'] ?? 0), 0, '.', ' ')),

                                Forms\Components\Placeholder::make('net_worth')
                                    ->label('Valeur nette')
                                    ->content(fn(?AbfCase $record) => '$' . number_format((float)($record->results['totals']['net_worth'] ?? 0), 0, '.', ' ')),
                            ]),
                    ]),
            ])
                ->extraAttributes(['class' => 'abf-wizard'])
                ->persistStepInQueryString('step')
                ->contained(false)      // ✅ enlève la limite de largeur du wizard
                ->columnSpanFull()
                ->skippable(), // <-- CRUCIAL pour naviguer librement sans casser ton "retour au step"
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('#')->sortable(),

                Tables\Columns\TextColumn::make('client_name')
                    ->label('Client')
                    ->state(fn(AbfCase $record) => trim(
                        ($record->payload['client']['first_name'] ?? '') . ' ' . ($record->payload['client']['last_name'] ?? '')
                    ) ?: '—')
                    ->searchable(),

                Tables\Columns\IconColumn::make('has_spouse')
                    ->label('Conjoint')
                    ->boolean()
                    ->state(fn(AbfCase $record) => (bool)($record->payload['has_spouse'] ?? false)),

                Tables\Columns\TextColumn::make('progress_percent')
                    ->label('Progression')
                    ->state(fn(AbfCase $record) => $record->progress_percent)
                    ->suffix('%')
                    ->badge()
                    ->color(fn(AbfCase $record) => match (true) {
                        ($record->progress_percent ?? 0) >= 90 => 'success',
                        ($record->progress_percent ?? 0) >= 50 => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'completed' => 'warning',
                        'signed' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Dernière modif')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ouvrir'),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbfCases::route('/'),
            'create' => Pages\CreateAbfCase::route('/create'),
            'edit' => Pages\EditAbfCase::route('/{record}/edit'),
        ];
    }
}
