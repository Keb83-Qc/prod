<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        /* On reprend la police et la couleur de fond du chatbot */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }

        /* Le conteneur principal ressemble à une grosse bulle "Agent" */
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* En-tête : reprend la couleur "User Message" (#0E1030) */
        .header {
            background: #0E1030;
            color: #fff;
            padding: 30px 25px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .header p {
            margin: 5px 0 0 0;
            opacity: 0.7;
            font-size: 13px;
        }

        .content {
            padding: 30px;
        }

        /* Bloc Conseiller stylisé */
        .advisor-box {
            background-color: #f4f7f6;
            border-left: 5px solid #0E1030;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 0 10px 10px 0;
        }

        /* Titres de section */
        .section-title {
            color: #0E1030;
            font-weight: 700;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 25px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #f4f7f6;
        }

        /* Lignes de données */
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f9f9f9;
        }

        .label {
            color: #666;
            font-size: 14px;
        }

        .value {
            font-weight: 600;
            color: #0E1030;
            text-align: right;
        }

        /* Liens (Email/Tel) */
        a {
            color: #0E1030;
            text-decoration: none;
            border-bottom: 1px dotted #0E1030;
        }

        .footer {
            background: #f9f9f9;
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #eee;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            {{-- Affiche le Type (Auto) dynamiquement --}}
            <h2>Nouvelle Soumission {{ ucfirst($submission->type ?? 'Auto') }}</h2>
            <p>Reçue le {{ $submission->created_at->format('d/m/Y à H:i') }}</p>
        </div>

        <div class="content">

            <div class="advisor-box">
                <div style="text-transform: uppercase; font-size: 10px; color: #666; font-weight: bold; margin-bottom: 4px;">
                    Source du lead</div>
                <div style="font-size: 15px; font-weight: bold; color: #0E1030;">
                    @if($advisor)
                    👤 {{ $advisor->first_name }} {{ $advisor->last_name }}
                    <span style="font-weight: normal; font-size: 13px; color: #555;">(Code: {{ $advisor->advisor_code }})</span>
                    @else
                    🌐 Site Web Général
                    @endif
                </div>
            </div>

            <p style="margin-bottom: 20px;">Bonjour,</p>
            <p style="margin-bottom: 30px; line-height: 1.6;">Le chatbot VIP GPI a finalisé une nouvelle demande. Voici les détails au format fiche client :</p>

            <div class="section-title">🚙 Le Véhicule</div>

            <div class="info-row">
                <span class="label">Marque :&nbsp;</span>
                <span class="value">{{ $submission->data['brand'] ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="label">Modèle :&nbsp;</span>
                <span class="value">{{ $submission->data['model'] ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="label">Année :&nbsp;</span>
                <span class="value">{{ $submission->data['year'] ?? '-' }}</span>
            </div>
            {{-- AJOUT : Date de renouvellement --}}
            <div class="info-row">
                <span class="label">Renouvellement :&nbsp;</span>
                <span class="value">{{ $submission->data['renewal_date'] ?? 'Non spécifié' }}</span>
            </div>

            <div class="section-title">📍 Usage & Habitation</div>

            <div class="info-row">
                <span class="label">Usage :&nbsp;</span>
                <span class="value">{{ $submission->data['usage'] ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="label">Kilométrage :&nbsp;</span>
                <span class="value">{{ $submission->data['km_annuel'] ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="label">Adresse :&nbsp;</span>
                <span class="value">
                    <a href="https://maps.google.com/?q={{ urlencode($submission->data['address'] ?? '') }}" target="_blank">
                        {{ $submission->data['address'] ?? '-' }}
                    </a>
                </span>
            </div>

            <div class="section-title">👤 Conducteur</div>

            <div class="info-row">
                <span class="label">Nom complet :&nbsp;</span>
                <span class="value">{{ $submission->data['first_name'] ?? '' }} {{ $submission->data['last_name'] ?? '' }}</span>
            </div>

            {{-- MODIFICATION : Âge au lieu de Date de naissance --}}
            <div class="info-row">
                <span class="label">Âge :&nbsp;</span>
                <span class="value">{{ $submission->data['age'] ?? '-' }} ans</span>
            </div>

            <div class="info-row">
                <span class="label">Numéro de permis :&nbsp;</span>
                <span class="value" style="color: #d9534f;">{{ $submission->data['license_number'] ?? 'Non fourni' }}</span>
            </div>

            <div class="section-title">📞 Contact</div>

            <div class="info-row">
                <span class="label">Courriel :&nbsp;</span>
                <span class="value"><a href="mailto:{{ $submission->data['email'] ?? '' }}">{{ $submission->data['email'] ?? '-' }}</a></span>
            </div>
            <div class="info-row">
                <span class="label">Téléphone :&nbsp;</span>
                <span class="value"><a href="tel:{{ $submission->data['phone'] ?? '' }}">{{ $submission->data['phone'] ?? '-' }}</a></span>
            </div>

        </div>

        <div class="footer">
            Système VIP Gestion de Patrimoine Inc. &copy; {{ date('Y') }}<br>
            Message envoyé automatiquement. ID: #{{ $submission->id }}
        </div>
    </div>
</body>

</html>