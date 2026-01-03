@extends('layout.auth.master')
@section('contents')
    @include('paritials.css.login-css')
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row">

                    <div class="col-md-5 m-auto p-0">
                        <div class="card" style="border-radius: 15px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                            <div class="card-body" style="background-color: #636e72; padding: 40px; color: #fff;">
                                <div class="logo-wrapper text-center mb-4">
                                    <a href="index.html">
                                        <img src="{{ asset('assets/images/dashboard/logo/logo.png') }}" alt="Logo" style="width: 120px;">
                                    </a>
                                </div>
                                
                                @if(@$error)
                                    <h5 style="color:#ff6b6b;" class="text-center">{{ $error }}</h5>
                                    <br>
                                @endif

                                <h3>ADMIN LOGIN</h3>

                                <form action="{{ route('adminlogin') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="username" style="font-weight: 600;">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required style="border-radius: 8px; padding: 10px; border: none;">
                                    </div>

                                    <div class="form-group mb-3 position-relative">
                                        <label for="pwd" style="font-weight: 600;">Password</label>
                                        <div style="position: relative;">
                                            <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter your password" required style="border-radius: 8px; padding: 10px 40px 10px 10px; border: none;">
                                            <i class="fa fa-eye-slash" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: black;"></i>
                                        </div>
                                    </div>

                                    <div class="form-terms d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="form-button text-center mt-4">
                                        <button type="submit" name="submit" class="btn w-100" style="background-color: #00cec9; color: #fff; font-weight: 600; border-radius: 10px; padding: 10px;">Login</button>
                                        <button type="button" onclick="window.location.reload();" class="btn w-100 mt-2" style="background-color: #d63031; color: #fff; font-weight: 600; border-radius: 10px; padding: 10px;">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Show/Hide Password Script -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const pwdField = document.getElementById('pwd');
            const type = pwdField.getAttribute('type') === 'password' ? 'text' : 'password';
            pwdField.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
