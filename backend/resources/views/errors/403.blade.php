<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>403 - Unauthorized</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
    background-color: rgba(26,32,44,1);
    }

    .error-container {
      max-width: 600px;
      margin: 200px auto;
      padding: 20px;
      background-color: #c0d123;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .error-heading {
      font-size: 36px;
      color: #dc3545;
      margin-bottom: 20px;
    }

    .error-message {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .back-btn {
      padding: 10px 20px;
      font-size: 18px;
      color: #fff;
      background-color: #000000;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .back-btn:hover {
      background-color: #000000;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="error-container">
    <img style="max-height: 80px" src="{{ global_asset('images/Logo.webp') }}" alt="">
    <h1 class="error-heading">403 - {{ __('messages.Unauthorized') }}</h1>
    <p class="error-message">{{ __('messages.You are not authorized to access this page.') }}</p>
    <a href="{{ route('home') }}" class="back-btn">{{ __('messages.Go to Homepage') }}</a>
  </div>
</body>
</html>
