<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Messagerie';

    public static function getNavigationGroup(): ?string
    {
        return 'Espace Conseiller';
    }

    public static function getNavigationBadge(): ?string
    {
        $id = Filament::auth()->id();
        if (! $id) return null;

        $count = Message::query()
            ->where('receiver_id', $id)
            ->where('is_read', false)
            ->count();

        return $count ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function getEloquentQuery(): Builder
    {
        $id = Filament::auth()->id();

        return parent::getEloquentQuery()
            ->when($id, fn(Builder $q) => $q->where('receiver_id', $id))
            ->latest();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Hidden::make('sender_id')
                ->default(fn() => Filament::auth()->id()),

            Forms\Components\Select::make('receiver_id')
                ->label('Destinataire')
                ->options(
                    fn() => User::query()
                        ->where('id', '!=', Filament::auth()->id())
                        ->orderBy('first_name')
                        ->get()
                        ->mapWithKeys(fn(User $user) => [
                            $user->id => trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')),
                        ])
                        ->toArray()
                )
                ->searchable()
                ->required()
                ->columnSpanFull(),

            Forms\Components\TextInput::make('subject')
                ->label('Sujet')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            Forms\Components\RichEditor::make('body')
                ->label('Message')
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sender.first_name')
                    ->label('De')
                    ->formatStateUsing(
                        fn($record) => $record->sender
                            ? trim($record->sender->first_name . ' ' . $record->sender->last_name)
                            : 'Système'
                    )
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-m-user-circle'),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Sujet')
                    ->searchable()
                    ->limit(60)
                    ->weight(fn(Message $record): string => $record->is_read ? 'normal' : 'extra-bold')
                    ->color(fn(Message $record): string => $record->is_read ? 'gray' : 'primary'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Reçu le')
                    ->dateTime('d M Y à H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('read')
                    ->label('Lire')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Lecture du message')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn() => \Filament\Actions\StaticAction::make('close')->label('Fermer'))
                    ->form([
                        Forms\Components\TextInput::make('subject')->label('Sujet')->disabled(),
                        Forms\Components\RichEditor::make('body')->label('Message')->disabled(),
                    ])
                    ->mountUsing(function (Message $record, ComponentContainer $form) {
                        if (! $record->is_read) {
                            $record->update(['is_read' => true]);
                        }

                        $form->fill([
                            'subject' => $record->subject,
                            'body' => $record->body,
                        ]);
                    })
                    ->modalFooterActions(function (Message $record, $action): array {
                        return [
                            /**
                             * =========================
                             * WORKFLOW INSCRIPTION (existant)
                             * =========================
                             */
                            Tables\Actions\Action::make('accept_registration')
                                ->label('Valider le candidat')
                                ->color('success')
                                ->icon('heroicon-o-check')
                                ->visible(fn() => isset($record->data['action_type']) && $record->data['action_type'] === 'registration_request')
                                ->requiresConfirmation()
                                ->modalHeading('Confirmer la validation')
                                ->action(function () use ($record, $action) {
                                    $record->refresh();
                                    if (! isset($record->data['action_type'])) return;

                                    $applicant = User::find($record->data['applicant_id'] ?? null);

                                    if ($applicant) {
                                        $roleConseiller = \App\Models\Role::where('name', 'conseiller')->first();
                                        $targetRoleId = $roleConseiller ? $roleConseiller->id : 3;

                                        $applicant->update(['role_id' => $targetRoleId]);

                                        $record->update([
                                            'body' => $record->body . "<br><br><strong>[TRAITÉ : VALIDÉ]</strong>",
                                            'data' => null,
                                            'is_read' => true,
                                        ]);

                                        Notification::make()->success()->title('Candidat validé en tant que Conseiller !')->send();
                                    } else {
                                        Notification::make()->danger()->title('Utilisateur introuvable.')->send();
                                    }

                                    $action->cancel();
                                }),

                            Tables\Actions\Action::make('reject_registration')
                                ->label('Refuser')
                                ->color('danger')
                                ->icon('heroicon-o-x-mark')
                                ->visible(fn() => isset($record->data['action_type']) && $record->data['action_type'] === 'registration_request')
                                ->requiresConfirmation()
                                ->modalHeading('Confirmer le refus')
                                ->action(function () use ($record, $action) {
                                    $record->refresh();
                                    if (! isset($record->data['action_type'])) return;

                                    $applicant = User::find($record->data['applicant_id'] ?? null);

                                    if ($applicant) {
                                        $applicant->delete();

                                        $record->update([
                                            'body' => $record->body . "<br><br><strong>[TRAITÉ : REFUSÉ]</strong>",
                                            'data' => null,
                                            'is_read' => true,
                                        ]);

                                        Notification::make()->success()->title('Candidat refusé.')->send();
                                    } else {
                                        $record->update(['data' => null]);
                                        Notification::make()->warning()->title('Déjà supprimé.')->send();
                                    }

                                    $action->cancel();
                                }),

                            /**
                             * =========================
                             * WORKFLOW BIO (final, non répétable)
                             * =========================
                             */
                            Tables\Actions\Action::make('approve_bio')
                                ->label('Approuver modif BIO')
                                ->color('success')
                                ->icon('heroicon-o-check')
                                ->visible(
                                    fn() => ($record->data['type'] ?? null) === 'bio_change_request'
                                        && (($record->status ?? 'pending') === 'pending')
                                )
                                ->requiresConfirmation()
                                ->modalHeading('Approuver la modification de bio ?')
                                ->action(function () use ($record, $action) {
                                    $record->refresh();

                                    if (($record->status ?? 'pending') !== 'pending') {
                                        Notification::make()->warning()->title('Cette demande a déjà été traitée.')->send();
                                        $action->cancel();
                                        return;
                                    }

                                    $payload = $record->data ?? [];
                                    $targetUserId = $payload['target_user_id'] ?? null;
                                    $proposedBio  = $payload['proposed_bio'] ?? null;
                                    $locale       = $payload['locale'] ?? 'fr';

                                    if (! $targetUserId || $proposedBio === null) {
                                        Notification::make()->danger()->title('Demande invalide (data manquant)')->send();
                                        $action->cancel();
                                        return;
                                    }

                                    $user = User::find($targetUserId);
                                    if (! $user) {
                                        Notification::make()->danger()->title('Utilisateur introuvable')->send();
                                        $action->cancel();
                                        return;
                                    }

                                    $field = $locale === 'en' ? 'bio_en' : 'bio_fr';
                                    $user->update([$field => $proposedBio]);

                                    // ✅ verrou : status + handled + marque traité dans data
                                    $record->update([
                                        'status' => 'approved',
                                        'handled_at' => now(),
                                        'handled_by' => Filament::auth()->id(),
                                        'is_read' => true,
                                        'data' => array_merge($record->data ?? [], ['treated' => true]),
                                    ]);

                                    // (optionnel) notifier l’utilisateur
                                    if ($record->sender_id) {
                                        Message::create([
                                            'sender_id' => Filament::auth()->id(),
                                            'receiver_id' => $record->sender_id,
                                            'subject' => 'Modification BIO approuvée',
                                            'body' => 'Votre demande de modification de biographie a été approuvée.',
                                            'is_read' => false,
                                            'status' => 'pending',
                                            'data' => [
                                                'type' => 'bio_change_response',
                                                'status' => 'approved',
                                            ],
                                        ]);
                                    }

                                    Notification::make()->success()->title('Bio appliquée et demande approuvée')->send();
                                    $action->cancel();
                                }),

                            Tables\Actions\Action::make('reject_bio')
                                ->label('Refuser modif BIO')
                                ->color('danger')
                                ->icon('heroicon-o-x-mark')
                                ->visible(
                                    fn() => ($record->data['type'] ?? null) === 'bio_change_request'
                                        && (($record->status ?? 'pending') === 'pending')
                                )
                                ->requiresConfirmation()
                                ->modalHeading('Refuser la modification de bio ?')
                                ->form([
                                    Forms\Components\Textarea::make('reason')
                                        ->label('Raison (optionnel)')
                                        ->rows(4),
                                ])
                                ->action(function (array $data) use ($record, $action) {
                                    $record->refresh();

                                    if (($record->status ?? 'pending') !== 'pending') {
                                        Notification::make()->warning()->title('Cette demande a déjà été traitée.')->send();
                                        $action->cancel();
                                        return;
                                    }

                                    $record->update([
                                        'status' => 'rejected',
                                        'handled_at' => now(),
                                        'handled_by' => Filament::auth()->id(),
                                        'is_read' => true,
                                        'data' => array_merge($record->data ?? [], [
                                            'treated' => true,
                                            'reject_reason' => ($data['reason'] ?? null),
                                        ]),
                                    ]);

                                    // (optionnel) notifier l’utilisateur
                                    if ($record->sender_id) {
                                        Message::create([
                                            'sender_id' => Filament::auth()->id(),
                                            'receiver_id' => $record->sender_id,
                                            'subject' => 'Modification BIO refusée',
                                            'body' => ($data['reason'] ?? '') ?: 'Votre demande a été refusée.',
                                            'is_read' => false,
                                            'status' => 'pending',
                                            'data' => [
                                                'type' => 'bio_change_response',
                                                'status' => 'rejected',
                                            ],
                                        ]);
                                    }

                                    Notification::make()->success()->title('Demande refusée')->send();
                                    $action->cancel();
                                }),
                        ];
                    }),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
        ];
    }
}
