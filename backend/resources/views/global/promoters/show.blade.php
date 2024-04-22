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
            max-width: 800px;
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
                
                @if($sub_coupon)<th class="fs-4 font-weight-bold text-black">{{ __('The number of users who used subscription coupon') }}</th>@endif

            </thead>
            <tbody>
                <tr>
                    <td class="text-primary">
                        {{ $promoter->name }}
                    </td>
                    <td>
                        <h4 style="display: inline-block">
                            <a href="#" onclick="copyToClipboard('{{ url('/register?ref=') . $promoter->url }}', this)" class="text-primary fw-bolder text-hover-primary ">
                                {{ __('Click here') }}
                                <svg id='Copy_24' width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>


                                    <g transform="matrix(1 0 0 1 12 12)" >
                                    <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" translate(-12, -12)" d="M 4 2 C 2.895 2 2 2.895 2 4 L 2 18 L 4 18 L 4 4 L 18 4 L 18 2 L 4 2 z M 8 6 C 6.895 6 6 6.895 6 8 L 6 20 C 6 21.105 6.895 22 8 22 L 20 22 C 21.105 22 22 21.105 22 20 L 22 8 C 22 6.895 21.105 6 20 6 L 8 6 z M 8 8 L 20 8 L 20 20 L 8 20 L 8 8 z" stroke-linecap="round" />
                                    </g>
                                    </svg>
                            </a>
                        </h4>
                        
                        <script>
                            function copyToClipboard(text, element) {
                                var dummy = document.createElement("textarea");
                                document.body.appendChild(dummy);
                                dummy.value = text;
                                dummy.select();
                                document.execCommand("copy");
                                document.body.removeChild(dummy);
                                
                                element.classList.remove('text-primary');
                                element.classList.add('text-khardl');
                                
                                setTimeout(function() {
                                    element.classList.add('text-primary');
                                    element.classList.remove('text-khardl');
                                }, 1000); 
                            }
                        </script>
                        
                        
                    </td>
                    <td>
                        <strong class="text-success">{{ $promoter->entered }}</strong>
                    </td>
                    <td>
                        <strong class="text-success">{{ $promoter->registered }}</strong>
                    </td>
                    @if($sub_coupon)
                    <td>
                        <strong class="text-success">{{ $sub_coupon->n_of_usage }}</strong>
                    </td>
                    @endif
                </tr>
            </tbody>
        </table>
        <hr>
    </div>

</body>
</html>
