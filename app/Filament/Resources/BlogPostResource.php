<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Articles de Blog';
    protected static ?string $recordTitleAttribute = 'title_fr';

    public static function getNavigationGroup(): ?string
    {
        return 'Marketing';
    }

    public static function form(Form $form): Form
    {
        // 1. DÉFINITION DES LANGUES (Vous pouvez les mettre dans un config file)
        $locales = [
            'fr' => 'Français',
            'en' => 'Anglais',
            // 'ht' => 'Créole', // Ajout facile !
            // 'de' => 'Allemand',
        ];

        // Catégories & Auteurs (inchangé)
        $categories = array_keys(BlogPost::CATEGORY_MAPPING);
        $catOptions = array_combine($categories, $categories);
        $authors = User::query()
            ->select(['first_name', 'last_name'])
            ->get()
            ->mapWithKeys(fn($user) => [trim("{$user->first_name} {$user->last_name}") => trim("{$user->first_name} {$user->last_name}")])
            ->toArray();

        return $form->schema([
            Grid::make(3)->schema([

                // === COLONNE GAUCHE (CONTENU) ===
                Group::make()->schema([
                    Section::make()
                        ->schema([
                            Tabs::make('Langues')
                                ->tabs(function () use ($locales) {
                                    $tabs = [];

                                    // --- BOUCLE DYNAMIQUE ---
                                    foreach ($locales as $code => $label) {
                                        $tabs[] = Tabs\Tab::make($label)
                                            ->icon($code === 'fr' ? 'heroicon-m-language' : 'heroicon-m-globe-alt')
                                            ->schema([

                                                // TITRE (Notation par points : title.fr)
                                                TextInput::make("title.$code")
                                                    ->label("Titre ($code)")
                                                    ->required($code === 'fr') // Requis seulement pour la langue par défaut ?
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(
                                                        fn($state, $set, $operation) =>
                                                        $operation === 'create' ? $set("slug.$code", Str::slug($state)) : null
                                                    ),

                                                // SLUG DYNAMIQUE
                                                TextInput::make("slug.$code")
                                                    ->label("Permalien URL ($code)")
                                                    ->prefix(config('app.url') . ($code === 'fr' ? '' : "/$code") . '/blog/')
                                                    ->required($code === 'fr')
                                                    // VALIDATION DYNAMIQUE JSON
                                                    ->unique(table: 'blog_posts', column: "slug->$code", ignoreRecord: true),

                                                // CONTENU
                                                RichEditor::make("content.$code")
                                                    ->label("Contenu ($code)")
                                                    ->required($code === 'fr')
                                                    ->fileAttachmentsDirectory('blog-content')
                                                    ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'undo', 'redo']),
                                            ]);
                                    }
                                    return $tabs;
                                }),
                        ]),
                ])->columnSpan(['lg' => 2]),

                // === COLONNE DROITE (SIDEBAR) ===
                Group::make()->schema([
                    Section::make('Publication')
                        ->schema([
                            // Ici on utilise aussi la notation par points pour la catégorie si elle est traduisible
                            // Sinon, gardez 'category' tout court. Supposons qu'elle est traduisible :
                            Select::make('category.fr')
                                ->label('Catégorie (Principale)')
                                ->options($catOptions)
                                ->required(),

                            Select::make('author')
                                ->label('Auteur')
                                ->options($authors)
                                ->default('VIP GPI')
                                ->searchable()
                                ->required(),

                            DateTimePicker::make('created_at')
                                ->label('Date')
                                ->default(now()),
                        ]),

                    Section::make('Image')
                        ->schema([
                            // 1. APERÇU DE L'IMAGE ACTUELLE (Pour les vieilles images / assets)
                            Forms\Components\Placeholder::make('current_image_preview')
                                ->label('Aperçu actuel')
                                ->hidden(fn($operation) => $operation === 'create') // On cache à la création
                                ->content(function ($record) {
                                    // Si pas d'enregistrement ou pas d'image, on affiche un texte vide
                                    if (! $record || blank($record->image)) {
                                        return null;
                                    }

                                    // On utilise votre accesseur image_url qui gère déjà tous les cas (http, assets, storage)
                                    return new \Illuminate\Support\HtmlString(
                                        '<img src="' . e($record->image_url) . '"
                                            style="width:100%; max-height:200px; object-fit:cover; border-radius: 8px; border: 1px solid #ddd;"
                                            alt="Image actuelle">'
                                    );
                                }),

                            // 2. LE CHAMP D'UPLOAD (Pour changer l'image)
                            FileUpload::make('image')
                                ->label('Changer l\'image') // On remet un label pour que ce soit clair
                                ->image()
                                ->directory('blog')
                                ->imageEditor()
                                // Logique de renommage avec le slug
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, callable $get): string {
                                    $name = $get('slug.fr') ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                                    return (string) str($name)->slug()->append('-' . time() . '.' . $file->getClientOriginalExtension());
                                })
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. IMAGE
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Aperçu')
                    ->width(80)->height(50)
                    ->square(false)
                    ->defaultImageUrl(asset('assets/img/default.jpg')),

                // 2. TITRE & CATÉGORIE
                Tables\Columns\TextColumn::make('title_fr')
                    ->label('Article')
                    // --- MODIFICATION ICI ---
                    ->description(function (BlogPost $record) {
                        // On prend la catégorie (limité à 30 caractères) et on ajoute le slug
                        return Str::limit(strip_tags($record->category_fr), 30) . " — /" . $record->slug_fr;
                    })
                    // ------------------------
                    ->searchable(query: fn($query, $search) => $query->where('title->fr', 'like', "%{$search}%"))
                    ->sortable(query: fn($query, $direction) => $query->orderBy('title->fr', $direction))
                    ->weight('bold')
                    ->wrap(),

                // 3. (Auteur retiré ici comme demandé)

                // 4. ÉTAT DU FICHIER (Vérifie dossier + nom)
                Tables\Columns\IconColumn::make('is_file_optimized')
                    ->label('État Image')
                    ->boolean()
                    ->getStateUsing(function ($record) {
                        if (empty($record->image)) return false;
                        // Si c'est un asset ou url externe, on considère que c'est OK (vert)
                        if (str_starts_with($record->image, 'http') || str_starts_with($record->image, 'assets')) return true;

                        $slug = $record->getTranslation('slug', 'fr');

                        // CRITÈRES : Doit être dans le dossier 'blog/' ET contenir le slug
                        $isInBlogFolder = str_starts_with($record->image, 'blog/');
                        $hasSlugInName  = str_contains($record->image, $slug);

                        return $isInBlogFolder && $hasSlugInName;
                    })
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-exclamation-triangle') // Triangle attention si mal placé
                    ->trueColor('success') // Vert
                    ->falseColor('warning') // Orange/Jaune
                    ->alignCenter()
                    ->tooltip(fn($state) => $state ? 'Image bien rangée' : 'Image mal placée ou mal nommée'),

                // 5. DATE
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->color('gray')
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // --- BOUTON DE RÉPARATION (CORRIGÉ) ---
                Tables\Actions\Action::make('fix_image')
                    ->label('Ranger & Renommer')
                    ->icon('heroicon-m-folder-arrow-down')
                    ->color('danger')
                    ->button()

                    // === LA CORRECTION EST ICI ===
                    ->size('xs') // On utilise simplement 'xs' au lieu de la classe
                    // =============================

                    ->requiresConfirmation()
                    ->modalHeading('Déplacer et renommer l\'image ?')
                    ->modalDescription('L\'image sera déplacée dans le dossier "blog/" et renommée pour le SEO.')
                    ->hidden(function (BlogPost $record) {
                        if (empty($record->image)) return true;
                        if (str_starts_with($record->image, 'http') || str_starts_with($record->image, 'assets')) return true;

                        $slug = $record->getTranslation('slug', 'fr');
                        return str_starts_with($record->image, 'blog/') && str_contains($record->image, $slug);
                    })
                    ->action(function (BlogPost $record) {
                        $disk = \Illuminate\Support\Facades\Storage::disk('public');

                        if (! $disk->exists($record->image)) {
                            \Filament\Notifications\Notification::make()->title('Fichier introuvable')->danger()->send();
                            return;
                        }

                        $slug = $record->getTranslation('slug', 'fr');
                        $extension = pathinfo($record->image, PATHINFO_EXTENSION);
                        $newPath = 'blog/' . $slug . '-' . time() . '.' . $extension;

                        if ($disk->move($record->image, $newPath)) {
                            $record->update(['image' => $newPath]);
                            \Filament\Notifications\Notification::make()->title('Image rangée avec succès !')->success()->send();
                        }
                    }),

                // MENU DÉROULANT CLASSIQUE
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
