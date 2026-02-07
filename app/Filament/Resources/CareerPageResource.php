<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerPageResource\Pages;
use App\Models\CareerPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;

class CareerPageResource extends Resource
{
    protected static ?string $model = CareerPage::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Page Carrières';
    protected static ?string $navigationGroup = 'Gestion du Site';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Liens des Boutons de Candidature')
                    ->description('Gérez ici les liens vers vos formulaires ou prises de rendez-vous.')
                    ->schema([
                        Forms\Components\TextInput::make('link_advisor_licensed')
                            ->label('Lien : Conseiller (Avec Permis)')
                            ->url()
                            ->placeholder('https://...')
                            ->prefixIcon('heroicon-m-link'),

                        Forms\Components\TextInput::make('link_future_advisor')
                            ->label('Lien : Futur Conseiller (Sans Permis)')
                            ->url()
                            ->placeholder('https://...')
                            ->prefixIcon('heroicon-m-academic-cap'),

                        Forms\Components\TextInput::make('link_agency')
                            ->label('Lien : Cabinets')
                            ->url()
                            ->placeholder('https://...')
                            ->prefixIcon('heroicon-m-building-office'),

                        Forms\Components\TextInput::make('link_team_leader')
                            ->label('Lien : Leader d\'équipe')
                            ->url()
                            ->placeholder('https://...')
                            ->prefixIcon('heroicon-m-users'),

                        Forms\Components\TextInput::make('contact_email')
                            ->label('Email de contact (Fallback)')
                            ->email()
                            ->default('candidature@vipgpi.ca')
                            ->required(),
                        Section::make('Vidéos')
                            ->schema([
                                Forms\Components\TextInput::make('video_env')
                                    ->label('Vidéo : Environnement (Lien Embed)')
                                    ->placeholder('Ex: https://www.youtube.com/embed/VIDEO_ID')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('video_culture')
                                    ->label('Vidéo : Culture (Lien Embed)')
                                    ->placeholder('Ex: https://www.youtube.com/embed/VIDEO_ID')
                                    ->columnSpanFull(),
                            ]),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contact_email')->label('Email Contact'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Dernière modif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            // C'est ICI la correction : on utilise les pages standards
            'index' => Pages\ListCareerPages::route('/'),
            'create' => Pages\CreateCareerPage::route('/create'),
            'edit' => Pages\EditCareerPage::route('/{record}/edit'),
        ];
    }
}
