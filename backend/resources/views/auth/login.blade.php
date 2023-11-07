@extends('layouts.app')
<title>Login</title>
@section('content')
<div class="container">
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
                                        <h4 class="mt-1 mb-4 pb-1">LOGIN</h4>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="d-flex align-items-center justify-content-center">
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="inputEmail">Email</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="inputPassword">Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-outline">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button style="width: 100%;" class="btn btn-outline-primary mt-3"
                                                type="submit">Log in</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a class="text-muted mx-3" href="{{ route('password.request') }}">Forgot password?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4 mt-3">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <a href="{{url('/register')}}"><button type="button"
                                                    class="btn btn-outline-dark">Create new</button></a>
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
</div>
@endsection
