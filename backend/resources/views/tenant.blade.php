<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ucfirst($restaurant_name)}} restaurant powered by Khardl Ecosystem">
    <meta name="keywords" content="{{ucfirst($restaurant_name)}}, Khardl, Restaurants Ecosystem, food">
    <meta name="author" content="Khardl">
    <meta property="og:title" content="{{ucfirst($restaurant_name)}} - {{__('khardl')}}" />
    <meta property="og:description" content="Khardl, Digital Ecosystem Solution For Restaurants, Create your website and app with Khardl in minutes, start selling right away, and pay based on your orders only" />
    <meta property="og:image" content="{{ $logo ?? global_asset('img/logo.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ucfirst($restaurant_name)}} - {{__('khardl')}}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') . "?id=" . trim(exec('git log --pretty="%h" -n1 HEAD')) }}">
    <link rel="canonical" href="{{ $logo ?? global_asset('img/logo.png') }}" />
    <link rel="shortcut png" href="{{ $logo ?? global_asset('img/logo.png') }}"/>
    <link rel="icon" href="{{ $logo ?? global_asset('img/logo.png') }}"/>
{{--    <link rel="preconnect" href="https://fonts.googleapis.com" />--}}
{{--        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />--}}
{{--        <link--}}
{{--            href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600&display=swap"--}}
{{--            rel="stylesheet"--}}
{{--        />--}}
{{--        <style>--}}
{{--            @import url("https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap");--}}
{{--        </style>--}}
</head>
<body>
    <div id="root"></div>
    <script>
        window.csrfToken = "{{ csrf_token() }}";
        const url_tenant = "{{request()->getSchemeAndHttpHost() }}"
        const url_central = "{{env('APP_URL') }}"
            //    const url_tenant = "{{ preg_replace("/^http:/i", 'https:', request()->getSchemeAndHttpHost())}}";
        const tap_public_key = "{{env('TAP_PAYMENT_TECHNOLOGY_PUBLIC_KEY')}}";
    </script>
    <script type="text/javascript" src="{{ mix('js/tenant.js') . "?id=" . trim(exec('git log --pretty="%h" -n1 HEAD')) }}"></script>
    <style>

        #gosell-gateway {
        top: -60% !important;
        }
    </style>
</body>
</html>
