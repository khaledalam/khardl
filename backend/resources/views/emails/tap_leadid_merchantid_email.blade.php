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

    <title>Khardl | TAP Lead ID to Merchant ID</title>
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
                                        <h4 style="font-weight: 700;color: red" class="mt-4 mb-4 pb-1">NEW LEAD ID (automated email)</h4>
                                        <p style="text-align: left;"><b>Hello TAP Team,</b><br/>
                                            New Lead ID has been created: {{$lead_id}}
                                            <br/>
                                            Please reply to his email with the Merchant ID of this Lead ID and add Merchant ID to Google Sheet below.
                                            <br />
                                            We appreciate your cooperation
                                        <div class="text-center mt-5">
                                            <a style="color: red; text-decoration: none;" href="https://docs.google.com/spreadsheets/d/1xfrMiXG5GYDirI-vGKWCesbjgxv6jV5fSkwEocrKnbA/edit?usp=sharing"><button
                                                    class="btn btn-outline-danger">Google Sheet</button></a>
                                        </div>
                                        <br>
                                        <br>
                                        <b style="text-align: left; display: flex; justify-content: left; align-items: start;">Thank you,</b><br />
                                        Development Team<br/>
                                        Khardl
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
