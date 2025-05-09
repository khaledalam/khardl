<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Khardl, Digital Ecosystem Solution For Restaurants, Create your website and app with Khardl in minutes, start selling right away, and pay based on your orders only">
    <meta name="keywords" content="Khardl, Restaurants Ecosystem, food">
    <meta name="author" content="Khardl">
    <meta property="og:title" content="Khardl - Digital Ecosystem Solution For Restaurants" />
    <meta property="og:description" content="Khardl, Digital Ecosystem Solution For Restaurants, Create your website and app with Khardl in minutes, start selling right away, and pay based on your orders only" />
    <meta property="og:image" content="{{ global_asset('images/Logo_White.svg')}}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Khardl - Digital Ecosystem Solution For Restaurants</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="canonical" href="{{ global_asset('images/Logo_White.svg')}}" />
    <link rel="shortcut png" href="{{ global_asset('images/Logo_White.svg')}}"/>
    <link rel="icon" href="{{ global_asset('images/Logo_White.svg')}}"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
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
        const sentry_on = "{{ strlen(env('SENTRY_LARAVEL_DSN')) > 5 ? '1' : '0' }}"

    </script>
    <script type="text/javascript" src="{{ mix('js/central.js') }}"></script>

    @if(App\Models\CentralSetting::first()?->live_chat_enabled)
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/6590b4fe8d261e1b5f4dafa8/1hiuk611o';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        @endif
</body>
</html>
