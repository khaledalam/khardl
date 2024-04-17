<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />

    <link rel="stylesheet" href="login.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <title>{{__("Renew Subscription")}}</title>
</head>

<body>

    <section class="gradient-form d-flex justify-content-center align-items-center"
        style="background-color: #ffffff00; height: 100vh;">
        <div class="container mt-0 py-0 align-items-center justify-content-center">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-7">
                    <div style=" box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.374);" class="card text-black">
                        <div class="row g-0">
                            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                                <div class="card-body mx-md-4 pb-5">
                                    <div class="text-center">
                                        <div class="logo">
                                            <img src="{{ global_asset('images/Logo.webp') }}" style="width: 185px;"
                                                alt="logo">

                                        </div>

                                        <p style="text-align: left;">
                                            <b>Dear {{ $user->first_name }}</b><br>
                                            <p>
                                                We hope this message finds you well.
                                            </p>
                                            <p>
                                                We regret to inform you that your current subscription for the restaurant "{{ $restaurant_name }}" has been suspended.
                                            </p>
                                            @if($type == 'website')
                                            <p>
                                                To proceed with the renewal and start receiving orders again, please follow this link: <a href="{{ $url }}">Renew Subscription</a>. Our team is ready to assist you throughout the process and answer any questions you may have.
                                            </p>
                                        @elseif($type == 'app')
                                            <p>
                                                Unfortunately, your customers cannot place orders through the app until your subscription is renewed. To proceed with the renewal and start receiving orders again, please follow this link: <a href="{{ $url }}">Renew Subscription</a>. Our team is ready to assist you throughout the process and answer any questions you may have.
                                            </p>
                                        @endif
                                            <p>
                                                Thank you for choosing our services. We value your partnership and look forward to continuing our collaboration.
                                            </p>
                                            <p>
                                                Best regards,<br>
                                                Khardl
                                            </p>
                                            <br>
                                        </p>
                                        <br>
                                        <br>
                                        <b style="text-align: left; display: flex; justify-content: left; align-items: start;">Thank you</b>
                                        <br><br><small><i>This email was sent from an email address that can't receive emails. Please don't reply to this email.</i></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/d2d3f16619.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
