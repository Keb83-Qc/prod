<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: sans-serif;
        color: #333;
        line-height: 1.6;
    }

    .btn {
        background-color: #c9a050;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }

    .box {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #eee;
        margin: 20px 0;
    }

    .code {
        font-family: monospace;
        font-size: 1.2em;
        background: #eee;
        padding: 3px 6px;
        border-radius: 4px;
    }
    </style>
</head>

<body>
    <h2>Bonjour {{ $advisor->first_name }},</h2>

    <p>Voici ton <strong>lien de consentement client</strong> unique.</p>
    <p>Ce lien permet à tes clients d'accepter les conditions de traitement de données avant de débuter leur soumission
        auto.</p>

    <div class="box">
        <p><strong>Ton Lien :</strong> <br>
            <a href="{{ $link }}">{{ $link }}</a>
        </p>
    </div>

    <p>Lorsqu'un client utilise ce lien et accepte le consentement, la soumission te sera automatiquement assignée.</p>

    <p style="text-align: center; margin-top: 30px;">
        <a href="{{ $link }}" class="btn">Tester mon lien</a>
    </p>

    <p>L'équipe VIP GPI</p>
</body>

</html>