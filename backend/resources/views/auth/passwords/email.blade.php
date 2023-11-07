@extends('layouts.app')

@section('content')
<div class="container">
    <br><br>
    <section class="h-100 gradient-form" style="background-color: #ffffff00;">
        <div class="container mt-3 py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-5">
                    <div style=" box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.374);" class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <div class="logo rounded-3">
                                            <img src="{{asset('img/logo.png')}}" style="width: 185px;"
                                                alt="logo">
                                        </div>
                                        <h4 class="mt-1 mb-4 pb-1">RESET PASSWORD</h4>
                                    </div>

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="d-flex align-items-center justify-content-center">
                                        </div>
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="inputEmail">Email</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="johndoe@example.com">
                                        </div>
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button style="width: 100%;" class="btn btn-outline-primary mt-3"
                                                type="submit">Send link</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a class="text-muted mx-3" href="{{ route('login') }}">Go back to login</a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
