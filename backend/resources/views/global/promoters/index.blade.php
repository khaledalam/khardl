<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promoter control</title>
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

    h1 {
      color: #333;
    }

    .value {
      font-size: 24px;
      margin: 10px 0;
    }

    .count {
      font-size: 36px;
      color: #c3da0b;
    }
  </style>
</head>
<body>

  <div class="container">
    <img style="max-height: 80px" src="{{ asset('images/Logo.webp') }}" alt="">
    <h1>Current users</h1>

    <div class="value">
      <strong>Name:</strong> {{ $promoter->name }}
    </div>

    <div class="value">
      <strong>URL:</strong> {{ $promoter->url }}
    </div>

    <div class="value">
      <strong>Entered Users Count:</strong>
      <span class="count">{{ $promoter->entered }}</span>
    </div>

    <div class="value">
      <strong>Registered Users Count:</strong>
      <span class="count">{{ $promoter->registered }}</span>
    </div>
  </div>

</body>
</html>
