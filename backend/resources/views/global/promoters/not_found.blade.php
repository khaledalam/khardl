<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="{{ global_asset('img/logo.png')}}" />
    <link rel="shortcut png" href="{{ global_asset('img/logo.png')}}" />
    <link rel="icon" href="{{ global_asset('img/logo.png')}}" />
    <link href="{{ global_asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <title>{{ __('Not found') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #c3da0b;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body>

    <div class="container">
        <img style="max-height: 80px" src="{{ asset('images/Logo.webp') }}" alt="">
        <hr>
        <h4 class="alert alert-warning">
            {{ __('Not found promoter') }}
        </h4>
        <hr>

    </div>

</body>
</html>
