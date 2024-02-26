<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <title>Khardl | Contact Us Form</title>
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
                                            <img src="{{global_asset('img/logo.png')}}" style="width: 185px;"
                                                alt="logo">
                                        </div>
                                        <h4 style="font-weight: 700;color: green;" class="mt-4 mb-4 pb-1">New Contact Us form input</h4>
                                        <p style="text-align: left;"><b>Hello,</b><br/><br />

                                            <br /><br />
                                            <b>Email:</b> {{$email}}<br/>
                                            <b>Phone Number:</b> {{$phone_number}}<br/>
                                            <b>Business Name:</b> {{$business_name}}<br/>
                                            <b>Responsible person name:</b> {{$responsible_person_name}}<br/>
                                        </p>
                                        <br />
                                        Thanks,
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
