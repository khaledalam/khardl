<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="{{ global_asset('images/Logo.webp')}}" />
    <link rel="shortcut png" href="{{ global_asset('images/Logo.webp')}}" />
    <link rel="icon" href="{{ global_asset('images/Logo.webp')}}" />
    <link href="{{ global_asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <title>{{ __('Promoters') }}</title>
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
        <h1>{{ __('Information') }}</h1>
        <hr>
        <table class="table table-responsive">
            <thead>
                <th class="fs-4 font-weight-bold text-black">{{ __('Name') }}</th>
                <th class="fs-4 font-weight-bold text-black">{{ __('URL') }}</th>
                <th class="fs-4 font-weight-bold text-black">{{ __('The number of users who used the link') }}</th>
                <th class="fs-4 font-weight-bold text-black">{{ __('Registered Users Count') }}</th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-primary">
                        {{ $promoter->name }}
                    </td>
                    <td>
                        <h4 style="display: inline-block">
                            <a href="/register/?ref={{ $promoter->url }}" target="_blank" class="text-primary fw-bolder text-hover-primary ">
                                {{ __('Click here') }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5" />
                                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z" />
                                </svg>
                            </a>
                        </h4>
                    </td>
                    <td>
                        <strong class="text-success">{{ $promoter->entered }}</strong>
                    </td>
                    <td>
                        <strong class="text-success">{{ $promoter->registered }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
    </div>

</body>
</html>
