<x-layouts.app :title="__('chat.success_title') . ' - VIP GPI'">

    <div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="card shadow-lg border-0 rounded-4 p-4 text-center" style="max-width: 500px;">
            <div class="card-body">

                {{-- Animation du crochet vert --}}
                <div class="success-animation mb-4">
                    <div class="checkmark-circle">
                        <div class="checkmark draw"></div>
                    </div>
                </div>

                <h1 class="fw-bold mb-3" style="color: #0E1030;">{{ __('chat.success_title') }}</h1>

                <p class="lead text-muted mb-4">
                    {{ __('chat.success_subtitle') }}
                </p>

                <div class="alert alert-light border mb-4">
                    <p class="mb-0 small text-start">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        {{-- Utilisation de {!! !!} pour garder le gras sur le nom de l'entreprise --}}
                        {!! __('chat.success_info') !!}
                    </p>
                </div>

                <a href="/" class="btn btn-primary btn-lg w-100 rounded-pill"
                    style="background-color: #c9a050; border: none;">
                    {{ __('chat.btn_home') }} <i class="fas fa-home ms-2"></i>
                </a>

            </div>
        </div>
    </div>

    {{-- CSS pour l'animation du crochet (Checkmark) --}}
    <style>
        .checkmark-circle {
            width: 80px;
            height: 80px;
            position: relative;
            display: inline-block;
            vertical-align: top;
            border-radius: 50%;
            border: 2px solid #28a745;
            margin: 0 auto;
        }

        .checkmark.draw:after {
            animation-duration: 800ms;
            animation-timing-function: ease;
            animation-name: checkmark;
            transform: scaleX(-1) rotate(135deg);
        }

        .checkmark:after {
            opacity: 1;
            height: 40px;
            width: 20px;
            transform-origin: left top;
            border-right: 3px solid #28a745;
            border-top: 3px solid #28a745;
            content: '';
            left: 22px;
            top: 40px;
            position: absolute;
        }

        @keyframes checkmark {
            0% {
                height: 0;
                width: 0;
                opacity: 1;
            }

            20% {
                height: 0;
                width: 20px;
                opacity: 1;
            }

            40% {
                height: 40px;
                width: 20px;
                opacity: 1;
            }

            100% {
                height: 40px;
                width: 20px;
                opacity: 1;
            }
        }
    </style>

</x-layouts.app>
