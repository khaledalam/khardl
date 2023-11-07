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

    <title>Denied</title>
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
                                            <img src="chilis-restaurant-logo-png-4.png" style="width: 185px;"
                                                alt="logo">
                                        </div>
                                        <h4 style="font-weight: 700;color: red" class="mt-4 mb-4 pb-1">APPROVED</h4>
                                        <p style="text-align: left;"><b>Dear {{ $user->first_name }},</b><br>

                                            We regret to inform you that your account request has been denied. Our team
                                            has reviewed your information and determined that it does not meet our
                                            criteria for approval at this time.
                                            Reason for Denial:
                                            Upon careful consideration, we have found that certain information provided
                                            does not align with our requirements or guidelines
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <b>Next Steps:</b>
                                            <br>
                                            We understand that you may need to update or modify certain details in order
                                            to meet our criteria. To proceed further, please click on the button below
                                            to access your account and make the necessary changes

                                            If you have any questions or need assistance, please don't hesitate to reach
                                            out to our support team. We appreciate your understanding and cooperation
                                        <div class="text-center mt-5">
                                            <a style="color: red; text-decoration: none;" href="{{ url('/') }}"><button
                                                    class="btn btn-outline-danger">Proceed to Update</button></a>
                                        </div>
                                        <br>
                                        <br>
                                        <b style="text-align: left; display: flex; justify-content: left; align-items: start;">Thank you</b>
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