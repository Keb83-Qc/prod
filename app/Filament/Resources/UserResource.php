<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\TeamTitle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Section;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Liste des conseillers';

    // ✅ Nom singulier (Create/Edit, titres, etc.)
    protected static ?string $modelLabel = 'Conseiller';

    // ✅ Nom pluriel (liste, breadcrumbs, titres)
    protected static ?string $pluralModelLabel = 'Conseillers';

    protected static ?string $recordTitleAttribute = 'first_name';

    public static function getNavigationGroup(): ?string
    {
        return 'Gestion Conseillers';
    }

    private static function titleLabelFromJson(?array $name): string
    {
        $locale = app()->getLocale(); // 'fr' ou 'en'
        if (!$name) {
            return '';
        }

        return (string) ($name[$locale] ?? $name['fr'] ?? $name['en'] ?? '');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            // --- 1. IDENTITÉ ---
            Section::make('Identité')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                        ->label('Prénom')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($set, $state, $get) {
                            if ($get('last_name')) {
                                $set('slug', Str::slug($state . '-' . $get('last_name')));
                            }
                        }),

                    Forms\Components\TextInput::make('last_name')
                        ->label('Nom')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($set, $state, $get) {
                            if ($get('first_name')) {
                                $set('slug', Str::slug($get('first_name') . '-' . $state));
                            }
                        }),

                    Forms\Components\TextInput::make('slug')
                        ->label('Permalien (URL)')
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->unique(ignoreRecord: true),
                ]),

            Forms\Components\Grid::make(3)
                ->schema([
                    // --- 2. GAUCHE : BIOGRAPHIE (2/3) ---
                    Forms\Components\Group::make()
                        ->columnSpan(2)
                        ->schema([
                            Tabs::make('Biographie')
                                ->tabs([
                                    Tabs\Tab::make('Français')->icon('heroicon-m-language')
                                        ->schema([
                                            Forms\Components\RichEditor::make('bio_fr')
                                                ->label('Biographie (FR)')
                                                ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'h2', 'h3', 'undo', 'redo']),
                                        ]),
                                    Tabs\Tab::make('Anglais')->icon('heroicon-m-globe-alt')
                                        ->schema([
                                            Forms\Components\RichEditor::make('bio_en')
                                                ->label('Biography (EN)')
                                                ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'h2', 'h3', 'undo', 'redo']),
                                        ]),
                                ]),
                        ]),

                    // --- 3. DROITE : PHOTO & INFOS (1/3) ---
                    Forms\Components\Group::make()
                        ->columnSpan(1)
                        ->schema([
                            Section::make('Photo de Profil')
                                ->schema([
                                    Forms\Components\Placeholder::make('avatar_preview')
                                        ->label('Aperçu')
                                        ->content(fn($record) => $record && $record->image_url
                                            ? new \Illuminate\Support\HtmlString(
                                                "<img src='{$record->image_url}' style='width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 3px solid #ddd; margin: 0 auto; display: block;'>"
                                            )
                                            : 'Aucune image'),

                                    Forms\Components\FileUpload::make('image')
                                        ->label('Changer la photo')
                                        ->image()
                                        ->avatar()
                                        ->imageEditor()
                                        ->directory('team')
                                        ->getUploadedFileNameForStorageUsing(function ($file, $get) {
                                            $name = $get('slug') ?? Str::slug($get('first_name') . '-' . $get('last_name'));
                                            return $name . '-' . time() . '.' . $file->getClientOriginalExtension();
                                        })
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Connexion')
                                ->schema([
                                    Forms\Components\TextInput::make('email')
                                        ->email()
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->prefixIcon('heroicon-m-envelope'),

                                    Forms\Components\TextInput::make('password')
                                        ->label('Mot de passe')
                                        ->password()
                                        ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                        ->dehydrated(fn($state) => filled($state))
                                        ->required(fn(string $context): bool => $context === 'create'),

                                    // ✅ TITRE DU POSTE (team_titles.name = JSON)
                                    Forms\Components\Select::make('title_id')
                                        ->label('Titre du poste')
                                        ->options(function () {
                                            return TeamTitle::query()
                                                ->orderBy('id')
                                                ->get()
                                                ->mapWithKeys(function ($title) {
                                                    $label = self::titleLabelFromJson(is_array($title->name) ? $title->name : null);
                                                    return [$title->id => $label ?: ('Titre #' . $title->id)];
                                                })
                                                ->toArray();
                                        })
                                        ->searchable()
                                        ->preload()
                                        ->required(),

                                    // Rôle système (Relation OK car name = string côté roles)
                                    Forms\Components\Select::make('role_id')
                                        ->relationship('role', 'name')
                                        ->label('Rôle')
                                        ->searchable()
                                        ->preload()
                                        ->required(),

                                    Forms\Components\TextInput::make('advisor_code')
                                        ->label('Code conseiller')
                                        ->maxLength(50),

                                ]),
                        ]),
                ]),

            // --- 4. DETAILS SUPPLÉMENTAIRES (Replié) ---
            Section::make('Détails & Configuration')
                ->collapsed()
                ->schema([
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Téléphone')
                            ->prefixIcon('heroicon-m-phone'),

                        Forms\Components\TextInput::make('city')
                            ->label('Ville')
                            ->prefixIcon('heroicon-m-map-pin'),

                        Forms\Components\TextInput::make('position')
                            ->label("Ordre d'affichage")
                            ->numeric()
                            ->default(999),

                        Forms\Components\Select::make('languages')
                            ->label('Langues parlées')
                            ->multiple()
                            ->options([
                                'fr' => 'Français',
                                'en' => 'Anglais',
                                'es' => 'Espagnol',
                            ])
                            ->searchable(),

                        Forms\Components\TextInput::make('booking_url')
                            ->label('Lien Calendly/Booking')
                            ->url()
                            ->prefixIcon('heroicon-m-calendar')
                            ->columnSpan(2),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn($query) => $query
                    ->whereNotIn('id', [0])
                    ->where('first_name', '!=', 'System')
                    ->where('first_name', '!=', 'Robot')
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(asset('assets/img/agent-default.jpg')),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom Complet')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(['last_name'])
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('advisor_code')
                    ->label('Code conseiller')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                // ✅ Affichage du titre JSON en FR/EN
                Tables\Columns\TextColumn::make('title_display')
                    ->label('Titre du poste')
                    ->state(fn($record) => self::titleLabelFromJson(is_array($record->title?->name) ? $record->title->name : null))
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('role.name')
                    ->label('Rôle Système')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'admin' => 'warning',
                        'conseiller' => 'success',
                        default => 'gray',
                    })
                    ->toggleable(),

            ])
            ->defaultSort('position', 'asc')
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
