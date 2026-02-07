<div class="chat-wrapper">
    <div class="chat-container">
        {{-- BIENVENUE --}}
        <div class="messages__item">
            <div class="messages__wrapper">
                <div class="agent-avatar__icon"><img src="{{ $agentImage }}"></div>
                <div class="agent-msg">
                    {{-- Utilisation de {!! !!} car le texte contient un <br> --}}
                    {!! __('chat.welcome') !!}
                </div>
            </div>
        </div>

        {{-- QUESTIONS / RÉPONSES --}}
        @include('livewire.quote-auto-steps')
    </div>

    {{-- ZONE DE RÉPONSE FIXE --}}
    <div class="response-area">
        <div class="response-container mx-auto">
            @if($step == 'year')
            <select wire:model.live="vehicle_year" class="form-select form-select-lg shadow-sm" wire:key="sel-year">
                <option value="">{{ __('chat.select_year') }}</option>
                @for ($i = date('Y') + 1; $i >= 1995; $i--) <option value="{{ $i }}">{{ $i }}</option> @endfor
            </select>

            @elseif($step == 'brand')
            <select wire:model.live="vehicle_brand" class="form-select form-select-lg shadow-sm" wire:key="sel-brand">
                <option value="">{{ __('chat.select_brand') }}</option>
                @foreach($brands as $brand) <option value="{{ $brand->id }}">{{ $brand->name }}</option> @endforeach
            </select>

            @elseif($step == 'model')
            <select wire:model.live="vehicle_model" class="form-select form-select-lg shadow-sm" wire:key="sel-model">
                <option value="">{{ __('chat.select_model') }}</option>
                @foreach($models as $model) <option value="{{ $model->id }}">{{ $model->name }}</option> @endforeach
            </select>

            @elseif($step == 'renewal_date')
            <div class="input-group" wire:key="area-renewal">
                {{-- Champ Date --}}
                <input type="date" wire:model="renewal_date" class="form-control form-control-lg shadow-sm">

                {{-- Bouton Envoyer --}}
                <button wire:click="submitRenewalDate" class="btn btn-primary px-4">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>

            @elseif($step == 'usage')
            <div class="d-flex gap-2" wire:key="btn-usage">
                <button wire:click="save('usage', 'Personnel')"
                    class="btn btn-outline-primary flex-grow-1 py-3 shadow-sm">{{ __('chat.btn_personal') }}</button>
                <button wire:click="save('usage', 'Commercial')"
                    class="btn btn-outline-primary flex-grow-1 py-3 shadow-sm">{{ __('chat.btn_commercial') }}</button>
            </div>

            @elseif($step == 'km_annuel')
            <div class="d-flex gap-2 flex-wrap" wire:key="area-km">
                <button wire:click="setKm('0-15 000 km')" class="btn btn-outline-primary flex-grow-1 py-3">0-15
                    000</button>
                <button wire:click="setKm('15-20 000 km')" class="btn btn-outline-primary flex-grow-1 py-3">15-20
                    000</button>
                <button wire:click="setKm('20 000+ km')" class="btn btn-outline-primary flex-grow-1 py-3">20 000
                    +</button>
            </div>

            @elseif($step == 'address')
            <div class="input-group" wire:key="area-addr">
                <input type="text" wire:model="address" class="form-control form-control-lg"
                    placeholder="{{ __('chat.placeholder_address') }}">
                <button wire:click="submitAddress" class="btn btn-primary px-4">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>

            @elseif($step == 'identity')
            <div wire:key="area-identity">
                <div class="input-group">
                    <input type="text" wire:model="first_name" class="form-control form-control-lg"
                        placeholder="{{ __('chat.placeholder_firstname') }}">
                    <input type="text" wire:model="last_name" class="form-control form-control-lg"
                        placeholder="{{ __('chat.placeholder_lastname') }}">
                    <button wire:click="submitIdentity" class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>

            @elseif($step == 'age') {{-- J'ai renommé l'étape 'birth_date' en 'age' --}}
            <div class="input-group" wire:key="area-age">
                <input type="number" wire:model="age" class="form-control form-control-lg shadow-sm"
                    placeholder="{{ __('chat.placeholder_age') }}" min="16" max="99">
                <button wire:click="submitAge" class="btn btn-primary px-4"><i class="fas fa-paper-plane"></i></button>
            </div>

            @elseif($step == 'email')
            <div class="input-group" wire:key="area-email">
                <input type="email" wire:model="email" class="form-control form-control-lg shadow-sm"
                    placeholder="{{ __('chat.placeholder_email') }}">
                <button wire:click="submitEmail" class="btn btn-primary px-4"><i
                        class="fas fa-paper-plane"></i></button>
            </div>

            @elseif($step == 'phone')
            <div class="input-group" wire:key="area-phone">
                <input type="tel" wire:model="phone" class="form-control form-control-lg"
                    placeholder="{{ __('chat.placeholder_phone') }}">
                <button wire:click="submitPhone" class="btn btn-primary px-4"><i
                        class="fas fa-paper-plane"></i></button>
            </div>

            @elseif($step == 'license_number')
            <div wire:key="area-license">
                <div class="input-group mb-2">
                    <input type="text" wire:model="license_number" class="form-control form-control-lg"
                        placeholder="{{ __('chat.placeholder_license') }}">
                    <button wire:click="submitLicense" class="btn btn-primary px-4"><i
                            class="fas fa-paper-plane"></i></button>
                </div>
                <button wire:click="skipLicense"
                    class="btn btn-link btn-sm w-100 text-decoration-none">{{ __('chat.btn_skip_license') }}</button>
            </div>

            @elseif($step == 'final')
            <div wire:key="area-final" class="text-center p-2">
                <div class="alert alert-success border-0 shadow-sm mb-3">
                    <i class="fas fa-check-circle me-2"></i> {{ __('chat.final_success_msg') }}
                </div>
                <button wire:click="finalize" class="btn btn-success btn-lg w-100 py-3 shadow border-0"
                    style="background-color: #28a745;">
                    {{ __('chat.btn_finalize') }}
                </button>
            </div>
            @endif
        </div>
    </div>

    <script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('scroll-down', () => {
            setTimeout(() => {
                window.scrollTo({
                    top: document.body.scrollHeight,
                    behavior: 'smooth'
                });
            }, 100);
        });
    });
    </script>
</div>