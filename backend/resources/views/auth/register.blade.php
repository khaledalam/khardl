@extends('layouts.app')
<head>
    <style>
        .swiper {
            width: 100%;
            height: 100vh;
        }

        .swiper-slide {
            font-size: 18px;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: center;
            padding: 20px;
        }

        .swiper-slide img {
            width: 120px;
            height: 120px;
            margin-bottom: 10px;
        }

        .swiper-slide h1,
        .swiper-slide p {
            margin: 10px 0;
        }

        .swiper-slide {
            position: relative;
        }

        .btn-read-more {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .sidebar {
            display: none;
            border-radius: 22px 22px 0 0;
        }

        @keyframes popin {
            0% {
                opacity: 0;
                transform: scale(0.5);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }


        @keyframes slideLeft {
            0% {
                left: 0;
            }

            100% {
                left: -150%;
            }
        }

        #delivery,
        #info,
        #contract,
        #optionsPage {
            position: relative;
            animation-name: slideLeft2;
            animation-duration: 0.9s;
            animation-fill-mode: forwards;
        }

        @keyframes slideLeft2 {
            0% {
                left: 150%;
            }

            100% {
                left: 0%;
            }
        }

        .slide-left {
            position: relative;
            animation-name: slideLeft;
            animation-duration: 0.2s;
            animation-fill-mode: forwards;
        }

        body {
            background-color: #fff;
        }

        #contract {
            display: none;
        }

        #regForm {
            background-color: #ffffff;
            margin: 100px auto;
            padding: 40px;
            width: 70%;
            min-width: 300px;
        }

        .tab {
            display: none;
        }

        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active {
            opacity: 1;
        }

        .step.finish {
            background-color: #2f5cff;
        }

        .swiper-pagination-vertical.swiper-pagination-bullets,
        .swiper-vertical>.swiper-pagination-bullets {
            transform: translate3d(0, -300%, 0);
        }

        .form-check {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            width: 300px;
            height: 200px;
            transform: scale(1.3);
        }

        form input[type=radio] {
            box-shadow: 0 0 0 black;
        }
    </style>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
@section('content')
<div class="container">
    {{-- <section class="h-100 gradient-form" style="background-color: #ffffff00;">
        <div class="container mt-3 py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div style=" box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.374);" class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <div class="logo rounded-3">
                                            <img src="{{asset('img/logo.png')}}" style="width: 185px;"
                                                alt="logo">
                                        </div>
                                        <h4 class="mt-1 mb-5 pb-1">REGISTER</h4>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="first_name">First name</label>
                                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                                    @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="last_name">Last name</label>
                                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="restaurant_name">Restaurant
                                                        name</label>
                                                        <input id="restaurant_name" type="text" class="form-control" name="restaurant_name" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="password-confirm">Confirm
                                                        password</label>
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="phone_number">Contact phone
                                                        number</label>
                                                        <input id="phone_number" type="tel" class="form-control" name="phone_number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="inputCR">Commercial
                                                        Registration</label>
                                                        <input id="commercial_registration" type="file" accept="image/*, .pdf" class="form-control" name="commercial_registration" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button style="width: 100%;" class="btn btn-outline-primary mt-3"
                                                type="submit">Sign up</button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4 mt-3">
                                            <p class="mb-0 me-2">Already have an account?</p>
                                            <a href="{{url('login')}}">
                                                <button type="button" class="btn btn-outline-dark">Login</button>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="h-100" style="background-color: #ffffff00;">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="container mt-3 h-100">
                
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div style="width: 100%; height: 70px; display: none;"
                            class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark sidebar">
                            <button id="prevBtn" onclick="nextPrev(-1)" style="width: fit-content;"
                                class="btn btn-primary prev" type="button">Previous</button>
                            <div style="display: flex; align-items: end; justify-content: end;" class="mb-1 mt-3">
                                <div style="display: flex; align-items: end; justify-content: end; position: absolute;"
                                    class="me-1  mb-3">
                                    <button id="nextBtnTop" onclick="nextPrev(1)" style="width: fit-content;"
                                        class="btn btn-primary mt-3 next" type="button">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="card text-black"
                            style="width: 100%; max-width: 1100px; height: 660px; overflow: hidden;box-shadow: 0 10px 20px rgba(0, 0, 0, 0.269);">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <div class="text-center">
                                            <div class="logo"></div>
                                            <div id="info" class="page">
                                                <h2 class="mb-4 pb-1">REGISTER</h2>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="inputFirstName">First
                                                                    name</label>
                                                                <input placeholder="John" value="{{ old('first_name') }}" type="text" id="inputFirstName"
                                                                    name="first_name" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="inputLastName">Last
                                                                    name</label>
                                                                <input placeholder="Doe" value="{{ old('last_name') }}" type="text" id="inputLastName"
                                                                    name="last_name" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="inputEmail">Email</label>
                                                                <input placeholder="Johndoe@example.com" value="{{ old('email') }}" type="email"
                                                                    id="inputEmail" name="email" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                    for="inputRestaurantName">Restaurant
                                                                    name</label>
                                                                <input placeholder="Burger shop" value="{{ old('restaurant_name') }}" type="text"
                                                                    name="restaurant_name" id="inputRestaurantName"
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                    for="inputPassword">Password</label>
                                                                <div class="input-group">
                                                                    <input placeholder="Enter password" type="password"
                                                                        id="inputPassword" name="password"
                                                                        class="form-control" />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text" id="showPasswordToggle" onclick="togglePasswordVisibility()"><i class="fa fa-eye"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="inputConfirmPassword">Confirm
                                                                    password</label>
                                                                <div class="input-group">
                                                                    <input placeholder="Enter password again" type="password"
                                                                        name="password_confirmation" id="inputConfirmPassword"
                                                                        class="form-control" />
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" id="showPasswordConfirmToggle" onclick="togglePasswordConfirmVisibility()"><i class="fa fa-eye"></i></span>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="inputPhoneNumber">Phone
                                                                    number</label>
                                                                    <input type="tel" pattern="[0-9+]{10,14}" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 43" minlength="10" maxlength="14" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" name="phone_number" id="phone_number" placeholder="05XXXXXXXX" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="inputCR">Commercial
                                                                    Registration</label>
                                                                <input type="file" name="commercial_registration"
                                                                    accept="image/*, .pdf" id="inputCR"
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                        <button id="nextBtn" onclick="nextPrev(1)" style="width: 100%"
                                                            class="btn btn-primary mt-3 next" type="button">Next</button>
                                                    </div>

                                                    <div class="d-flex align-items-center justify-content-center pb-4 mt-3">
                                                        <p class="mb-0 me-2">Already have an account?</p>
                                                        <a href="{{ route('login') }}">
                                                            <button type="button"
                                                                class="btn btn-outline-dark">Login</button>
                                                        </a>
                                                    </div>
                                                
                                            </div>

                                            <div style="display: none;" id="optionsPage" class="page">
                                                <div class="ms-5 text-start" id="surveyQuestions">
                                                    <div class="ms-5 text-start text-danger">
                                                        @if ($errors->any())
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <label class="my-2"><i class="fa-solid fa-arrow-right"></i> Do you want to have a mobile application as well for your restaurant?</label>
                                                    <input type="radio" name="has_mobile_app" value="1" class="toggle-trigger"> Yes
                                                    <input type="radio" name="has_mobile_app" value="0" class="toggle-trigger"> No
                                                
                                                    <div class="toggle-content" data-toggle="has_mobile_app" data-value="1">
                                                        <label class="my-2"><i class="fa-solid fa-arrow-right"></i> Do you want to have delivery system besides pickup?</label>
                                                        <input type="radio" name="has_delivery_system" value="1" class="toggle-trigger"> Yes
                                                        <input type="radio" name="has_delivery_system" value="0" class="toggle-trigger"> No
                                                
                                                        <div class="toggle-content" data-toggle="has_delivery_system" data-value="1">
                                                            <label class="my-2"><i class="fa-solid fa-arrow-right"></i> Do you have your own deliveries?</label>
                                                            <input type="radio" name="has_own_deliveries" value="1" class="toggle-trigger"> Yes
                                                            <input type="radio" name="has_own_deliveries" value="0" class="toggle-trigger"> No
                                                
                                                            <div class="toggle-content" data-toggle="has_own_deliveries" data-value="1">
                                                                <label class="my-2"><i class="fa-solid fa-arrow-right"></i> Do you want to use our delivery app for your drivers?</label>
                                                                <input type="radio" name="use_delivery_app" value="1"> Yes
                                                            </div>
                                                
                                                            <div class="toggle-content" data-toggle="has_own_deliveries" data-value="0">
                                                                <label class="my-2"><i class="fa-solid fa-arrow-right"></i> Do you want to sign a contract with delivery companies?</label>
                                                                <input type="radio" name="sign_contract_with_delivery" value="1"> Yes
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <label class="my-2"><i class="fa-solid fa-arrow-right"></i> Do you have one of the following cashier systems?</label>
                                                    <input type="radio" name="has_cashier_system" value="1" class="toggle-trigger"> Yes
                                                    <input type="radio" name="has_cashier_system" value="0" class="toggle-trigger"> No
                                                
                                                    <div class="toggle-content" data-toggle="has_cashier_system" data-value="0">
                                                        <label class="my-2"><i class="fa-solid fa-arrow-right"></i> Do you want to use our app to receive your orders on?</label>
                                                        <input type="radio" name="use_order_app" value="1"> Yes
                                                    </div>
                                                    <button id="registerBtn2" style="width: 100%; display: none;"
                                                    class="btn btn-primary mt-5 next" type="submit">Register</button>
                                                </div>
                                                                                        
                                            </div>



                                            <div style="display: none" id="delivery" class="page">
                                                <h4 class="mt-1 mb-4 pb-1 delivery-title" style="display: none;">Choose
                                                    delivery services</h4>
                                                <div class="swiper mySwiper" style="flex-grow: 1;">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <img style="border-radius: 50%; border:3px solid black;"
                                                                class="" src="delivery.jpg">
                                                            <div>
                                                                <button type="button" style="margin-right: 110px;"
                                                                    class="btn btn-outline-primary btn-read-more read-more"
                                                                    id="read-more">Read
                                                                    more</button>
                                                                <a><button type="button"
                                                                        class="btn btn-outline-success btn-read-more select"
                                                                        id="select">Download</button></a>
                                                            </div>
                                                            <h1>Express delivery service</h1>
                                                            <p class="me-3" style="text-align: left;">Lorem ipsum dolor sit
                                                                amet consectetur adipisicing elit. Repudiandae expedita quia
                                                                mollitia atque deleniti quaerat, rem tenetur ut libero
                                                                facilis. Incidunt assumenda fugit recusandae delectus.
                                                                Veritatis nulla et perspiciatis voluptas! Lorem ipsum dolor
                                                                sit amet consectetur adipisicing elit. Dolorum modi libero
                                                                quidem, eligendi aperiam delectus minus a iure saepe. Enim
                                                                doloremque nobis velit deserunt voluptate, quo aliquam
                                                                incidunt illum sit?</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-pagination"></div>
                                            </div>

                                            <div style="display: none;" id="contract" class="page">
                                                <h4 class="mt-1 mb-4 pb-1 delivery-title">Delivery
                                                    contract</h4>
                                                <input type="file" accept=".zip,.rar,.7zip" name="signed_contract_delivery_company"
                                                    id="inputCR" class="form-control"/>

                                                <button id="registerBtn" style="width: 100%"
                                                    class="btn btn-primary mt-5 next" type="submit">Register</button>
                                            </div>

                                            <div style="display: none;" id="readMorePage">
                                                <div style=" z-index: 200;width: 100%; height: 100%;">

                                                    <button type="button" onclick="closeReadMore()" style="margin-right: 110px;"
                                                        id="close" class="btn btn-outline-danger btn-read-more close"
                                                        id="read-more">Close</button>

                                                    <p style="text-align: left;" class="mt-5">Lorem ipsum dolor sit amet
                                                        consectetur adipisicing elit. At qui eos
                                                        possimus recusandae assumenda hic repellendus vero quibusdam ex,
                                                        aspernatur dolore quam, quo molestias ea illo tempore voluptatem
                                                        perferendis labore, quod laudantium saepe eius praesentium. Iure
                                                        impedit veritatis, aspernatur dolorum libero provident. Dignissimos
                                                        hic suscipit ex, dolores quia necessitatibus vel? laudantium saepe
                                                        eius</p>

                                                    <table class="table table-light table-striped table-bordered mt-5"
                                                        style="width: 100%; height: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Setup fees</th>
                                                                <th scope="col">Monthly fees</th>
                                                                <th scope="col">Mada</th>
                                                                <th scope="col">Visa & Master</th>
                                                                <th scope="col">STC Pay</th>
                                                                <th scope="col">Cashout conditions</th>
                                                                <th scope="col">Time till live</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>$200</td>
                                                                <td>$1100</td>
                                                                <td>1.5%</td>
                                                                <td>1.8%</td>
                                                                <td>2%</td>
                                                                <td>Minimun $50</td>
                                                                <td>1 month</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <p style="text-align: left;" class="mt-5">Lorem ipsum dolor sit amet
                                                        consectetur adipisicing elit. At qui eos
                                                        possimus recusandae assumenda hic repellendus vero quibusdam ex,
                                                        aspernatur dolore quam, quo molestias ea illo tempore voluptatem
                                                        perferendis labore, quod laudantium saepe eius praesentium. Iure
                                                        impedit veritatis, aspernatur dolorum libero provident. Dignissimos
                                                        hic suscipit ex, dolores quia necessitatibus vel? laudantium saepe
                                                        eius</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </form>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            function toggleQuestions() {
                const hasMobileApp = $('input[name="has_mobile_app"]:checked').val();
                const hasDeliverySystem = $('input[name="has_delivery_system"]:checked').val();
                const hasOwnDeliveries = $('input[name="has_own_deliveries"]:checked').val();
                const hasCashierSystem = $('input[name="has_cashier_system"]:checked').val();
    
                if (hasDeliverySystem === '1') {
                    $('.toggle-content[data-toggle="has_delivery_system"][data-value="1"]').show();
                    var nextTop = $("#nextBtnTop");
                    var registerButton = $("#registerBtn2");
    
                    registerButton.css("display", "none");
                    nextTop.css("display", "inline-block");
                } else {
                    var nextTop = $("#nextBtnTop");
                    var registerButton = $("#registerBtn2");
    
                    registerButton.css("display", "inline-block");
                    nextTop.css("display", "none");
                    $('.toggle-content[data-toggle="has_delivery_system"]').hide(); 
                    $('input[name="has_own_deliveries"]').prop('checked', false);
                    $('input[name="sign_contract_with_delivery"]').prop('checked', false);
                    $('input[name="use_delivery_app"]').prop('checked', false);
                }
    
                if (hasOwnDeliveries === '1') {
                    $('input[name="use_delivery_app"]').prop('required', true);
                    $('.toggle-content[data-toggle="has_own_deliveries"][data-value="1"]').show();
                    $('.toggle-content[data-toggle="has_own_deliveries"][data-value="0"]').hide();
                    $('input[name="sign_contract_with_delivery"]').prop('checked', false);
                } else {
                    $('.toggle-content[data-toggle="has_own_deliveries"][data-value="1"]').hide();
                    $('.toggle-content[data-toggle="has_own_deliveries"][data-value="0"]').show();
                    $('input[name="use_delivery_app"]').prop('required', false).val('');
                    $('input[name="use_delivery_app"]').prop('checked', false);
                }
    
                if (hasCashierSystem === '0') {
                    $('.toggle-content[data-toggle="has_cashier_system"][data-value="0"]').show();
                    $('input[name="use_order_app"]').prop('required', true);
                } else {
                    $('.toggle-content[data-toggle="has_cashier_system"]').hide();
                    $('input[name="use_order_app"]').prop('checked', false);
                    $('input[name="use_order_app"]').prop('required', false).val('');
                }
            }
    
            // Call the function initially
            toggleQuestions();
    
            // Call the function whenever a radio button is clicked
            $('input[type="radio"]').on('change', function() {
                toggleQuestions();
            });
        });
    </script>




    <script>
        document.getElementById("nextBtnTop").addEventListener("click", function () {
            submitForm();
        });

        function submitForm() {
            var selectedOption1 = document.querySelector('input[name="1"]:checked');
            var selectedOption2 = document.querySelector('input[name="2"]:checked');
            var selectedOption3 = document.querySelector('input[name="3"]:checked');
        }

        var next = document.getElementById("nextBtn")
        var register = document.getElementById("registerBtn")
        var nextTop = document.getElementById("nextBtnTop")
        var options = document.getElementById("optionsPage")

        var currentTab = 0;

        showTab(currentTab);

        var registerButton = $("#registerBtn2");
    
        function showTab(n) {
            var x = document.getElementsByClassName("page");

            x[n].style.display = "inline";

            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
                nextTop.style.display = 'none';
            } else {
                document.getElementById("prevBtn").style.display = "inline";
                next.style.display = 'inline-block';

            }
            if (n == (x.length - 1)) {
                nextTop.style.display = 'none';
                // register.textContent = 'Register';
            }
            else if(registerButton.css('display') == 'none'){
                nextTop.style.display = 'inline-block';
            }
            if (registerButton.css('display') == 'inline-block') {
                nextTop.style.display = 'none';
            }
            else{
                nextTop.style.display = 'inline-block';
            }
        }

        function nextPrev(n) {

            var x = document.getElementsByClassName("page");
            x[currentTab].style.display = "none";
            currentTab = currentTab + n;
            if (currentTab >= x.length) {
                document.getElementById("regForm").submit();
                return false;
            }
            showTab(currentTab);
        }

    </script>

    <script>
        var readMorePage = document.getElementById("readMorePage");
        var deliveryPage = document.getElementById("delivery");

        const readButtons = document.querySelectorAll('.read-more');
        readButtons.forEach(button => {
            button.addEventListener('click', toggleReadMore);
        });


        function toggleReadMore() {
            deliveryPage.style.display = 'none';
            readMorePage.style.display = 'inline-block';
        }
        function closeReadMore() {
            deliveryPage.style.display = 'inline-block';
            readMorePage.style.display = 'none';
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            direction: "vertical",
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("inputPassword");
            var passwordToggle = document.getElementById("showPasswordToggle");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                passwordInput.type = "password";
                passwordToggle.innerHTML = '<i class="fa fa-eye"></i>';
            }
        }

        function togglePasswordConfirmVisibility() {
            var passwordConfirmInput = document.getElementById("inputConfirmPassword");
            var passwordConfirmToggle = document.getElementById("showPasswordConfirmToggle");
            if (passwordConfirmInput.type === "password") {
                passwordConfirmInput.type = "text";
                passwordConfirmToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                passwordConfirmToggle.innerHTML = '<i class="fa fa-eye"></i>';
                passwordConfirmInput.type = "password";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/d2d3f16619.js" crossorigin="anonymous"></script>

    <script src="sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 </div>
@endsection


