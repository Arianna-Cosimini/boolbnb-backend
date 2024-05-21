<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Non Trovata - Errore 404</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.svg') }}">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        .container h1 {
            font-size: 72px;
            margin: 0;
        }
        .container p {
            font-size: 24px;
        }
        .container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            color: #fff;
            background-color: #ff385c;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .container a:hover {
            background-color: #cb2a48;
        }

        a.logo {
            background-color: transparent;
            padding: 0; 
            margin-bottom: 50px
        }

        a.logo:hover {
            background-color: transparent;
        }

    </style>
</head>
<body>
    <div class="container">
        <a class="logo" href="{{ url('http://localhost:5174/') }}">
            <div class="logo_laravel">
                <img src="{{ asset('logo/boolbnb.svg')}}" style="fill:#333" alt="boolbnb logo" width="130px">
            </div>
        </a>
        <h1>404</h1>
        <p>Oops! La pagina che stai cercando non è stata trovata.</p>
        <a href="{{ url('/') }}">Torna alla Homepage</a>
    </div>
</body>
</html>
