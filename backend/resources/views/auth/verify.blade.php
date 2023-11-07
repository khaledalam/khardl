@extends('layouts.app')

@section('content')
<section class="gradient-form d-flex justify-content-center align-items-center"
        style="background-color: #ffffff00; height: 100vh;">
        <div class="container mt-0 py-0 align-items-center justify-content-center">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-4">
                    <div style=" box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.374);" class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                                <div class="card-body mx-md-4 pb-5">
                                    <div class="text-center">
                                        <div class="logo rounded-3">
                                            <i class="fa-solid fa-square-envelope mt-4 mb-5 fa-2xl" style="font-size: 70px;"></i>
                                        </div>
                                        <h5 class="mt-1 mb-4 pb-1">Verify your email address</h5>
                                        <p>Please click on the link in the email we just sent you to confirm your email
                                            address</p>
                                        @if (session('status') == 'verification-link-sent')
                                            <div class="mb-4 font-medium text-sm text-green-600">
                                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <div>
                                                <button type="submit"class="btn btn-outline-secondary mt-4 w-50" style="text-decoration: none; cursor: pointer;">
                                                    Resend Email
                                                </button>
                                            </div>
                                        </form>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                            
                                            <button type="submit" class="btn btn-danger mt-4 w-50"
                                            style=" text-decoration: none; cursor: pointer;">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://kit.fontawesome.com/d2d3f16619.js" crossorigin="anonymous"></script>
@endsection
