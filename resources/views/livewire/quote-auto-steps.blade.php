{{-- resources/views/livewire/quote-auto-steps.blade.php --}}

{{-- ANNÉE --}}
@if($step == 'year' || isset($data['year']))
<div class="messages__item" wire:key="msg-year">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_year') }}</div>
    </div>
</div>
@if(isset($data['year']))
<div class="messages__item" wire:key="resp-year">
    <div class="user-message" wire:click="goToStep('year')">
        <span>{{ $data['year'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- MARQUE --}}
@if(isset($data['year']) && ($step == 'brand' || isset($data['brand'])))
<div class="messages__item" wire:key="msg-brand">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_brand') }}</div>
    </div>
</div>
@if(isset($data['brand']))
<div class="messages__item" wire:key="resp-brand">
    <div class="user-message" wire:click="goToStep('brand')">
        <span>{{ $data['brand'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- MODÈLE --}}
@if(isset($data['brand']) && ($step == 'model' || isset($data['model'])))
<div class="messages__item" wire:key="msg-model">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_model') }}</div>
    </div>
</div>
@if(isset($data['model']))
<div class="messages__item" wire:key="resp-model">
    <div class="user-message" wire:click="goToStep('model')">
        <span>{{ $data['model'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- DATE DE RENOUVELLEMENT (Nouveau Step) --}}
@if(isset($data['model']) && ($step == 'renewal_date' || isset($data['renewal_date'])))
<div class="messages__item" wire:key="msg-renewal">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_renewal') }}</div>
    </div>
</div>
@if(isset($data['renewal_date']))
<div class="messages__item" wire:key="resp-renewal">
    <div class="user-message" wire:click="goToStep('renewal_date')">
        <span>{{ $data['renewal_date'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- USAGE --}}
@if(isset($data['renewal_date']) && ($step == 'usage' || isset($data['usage'])))
<div class="messages__item" wire:key="msg-usage">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_usage') }}</div>
    </div>
</div>
@if(isset($data['usage']))
<div class="messages__item" wire:key="resp-usage">
    <div class="user-message" wire:click="goToStep('usage')">
        {{-- Pour l'usage, on pourrait aussi vouloir traduire la réponse affichée si on voulait être puriste, mais "Personnel/Commercial" est assez universel --}}
        <span>{{ $data['usage'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- KM ANNUEL --}}
@if(isset($data['usage']) && ($step == 'km_annuel' || isset($data['km_annuel'])))
<div class="messages__item" wire:key="msg-km">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_km') }}</div>
    </div>
</div>
@if(isset($data['km_annuel']))
<div class="messages__item" wire:key="resp-km">
    <div class="user-message" wire:click="goToStep('km_annuel')">
        <span>{{ $data['km_annuel'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- ADRESSE --}}
@if(isset($data['km_annuel']) && ($step == 'address' || isset($data['address'])))
<div class="messages__item" wire:key="msg-addr">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_address') }}</div>
    </div>
</div>
@if(isset($data['address']))
<div class="messages__item" wire:key="resp-addr">
    <div class="user-message" wire:click="goToStep('address')">
        <span>{{ $data['address'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- IDENTITÉ (Prénom + Nom) --}}
@if(isset($data['address']) && ($step == 'identity' || isset($data['first_name'])))
<div class="messages__item" wire:key="msg-identity">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_identity') }}</div>
    </div>
</div>

@if(isset($data['first_name']) && isset($data['last_name']))
<div class="messages__item" wire:key="resp-identity">
    <div class="user-message" wire:click="goToStep('identity')">
        <span>{{ $data['first_name'] }} {{ $data['last_name'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- AGE (Anciennement Date de naissance) --}}
@if(isset($data['first_name']))
<div class="messages__item" wire:key="msg-age">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        {{-- On utilise la nouvelle clé de traduction q_age --}}
        <div class="agent-msg">{{ __('chat.q_age') }}</div>
    </div>
</div>
@if(isset($data['age']))
<div class="messages__item" wire:key="resp-age">
    {{-- On appelle la fonction pour retourner à l'étape 'age' --}}
    <div class="user-message" wire:click="goToStep('age')">
        <span>{{ $data['age'] }} {{ app()->getLocale() == 'en' ? 'years old' : 'ans' }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- EMAIL --}}
@if(isset($data['birth_date']))
<div class="messages__item" wire:key="msg-email">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_email') }}</div>
    </div>
</div>
@if(isset($data['email']))
<div class="messages__item" wire:key="resp-email">
    <div class="user-message" wire:click="goToStep('email')">
        <span>{{ $data['email'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- TÉLÉPHONE --}}
@if(isset($data['email']) && ($step == 'phone' || isset($data['phone'])))
<div class="messages__item" wire:key="msg-phone">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_phone') }}</div>
    </div>
</div>
@if(isset($data['phone']))
<div class="messages__item" wire:key="resp-phone">
    <div class="user-message" wire:click="goToStep('phone')">
        <span>{{ $data['phone'] }}</span>
        <span class="edit-badge"><i class="fas fa-pen"></i></span>
    </div>
</div>
@endif
@endif

{{-- NUMÉRO DE PERMIS --}}
@if(isset($data['email']) && ($step == 'license_number' || isset($data['license_number'])))
<div class="messages__item" wire:key="msg-license">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_license') }}</div>
    </div>
</div>
@if(isset($data['license_number']))
<div class="messages__item" wire:key="resp-license">
    <div class="user-message" wire:click="goToStep('license_number')">
        <span>{{ $data['license_number'] }}</span>
    </div>
</div>
@endif
@endif

{{-- MESSAGE FINAL --}}
@if(isset($data['license_number']) && $step == 'final')
<div class="messages__item" wire:key="msg-finish">
    <div class="messages__wrapper">
        <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
        <div class="agent-msg">{{ __('chat.q_finish') }}</div>
    </div>
</div>
@endif