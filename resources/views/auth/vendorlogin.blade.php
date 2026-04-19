@extends('layout.auth.master')
@section('contents')
    @include('paritials.css.login-css')
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row">

                    <div class="col-md-5 m-auto p-0">
                        <div class="card" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.3);">
                            <div class="card-body" style="background: linear-gradient(135deg, #3c40c6 0%, #1e272e 100%); padding: 30px 40px; color: #fff;">
                                <div class="logo-wrapper text-center mb-3">
                                    <a href="/">
                                        <img src="{{ asset('assets/images/dashboard/logo/logo.png') }}" alt="Logo" style="width: 110px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));">
                                    </a>
                                </div>
                                @if(@$error)
                                    <h6 style="color:#ff5e57;" class="text-center mb-2">{{ @$error }}</h6>
                                @endif
                                <h3 class="text-center mb-3" style="font-weight: 700; letter-spacing: 1px; text-transform: uppercase; font-size: 1.5rem;">Vendor Portal</h3>
                                <form action="{{ route('vendorlogin') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="username" style="font-weight: 500; opacity: 0.9; margin-bottom: 5px; display: block; font-size: 1.2rem;">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required style="border-radius: 10px; padding: 12px 15px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: #fff; font-size: 1.2rem;">
                                    </div>

                                    <div class="form-group mb-3 position-relative">
                                        <label for="pwd" style="font-weight: 500; opacity: 0.9; margin-bottom: 5px; display: block; font-size: 1.2rem;">Password</label>
                                        <div style="position: relative;">
                                            <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter your password" required style="border-radius: 10px; padding: 12px 45px 12px 15px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: #fff; font-size: 1.2rem;">
                                            <i class="fa fa-eye-slash" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: rgba(255,255,255,0.6);"></i>
                                        </div>
                                    </div>

                                    <div class="form-terms d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember" name="remember" style="background-color: transparent; border-color: rgba(255,255,255,0.3); transform: scale(1.2); margin-right: 8px;">
                                            <label class="form-check-label" for="remember" style="font-size: 1.2rem; opacity: 0.8;"> Remember me</label>
                                        </div>
                                    </div>

                                    <div class="form-button text-center mt-1">
                                        <button type="submit" name="submit" class="btn w-100 mb-2" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 10px; border: none; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.3); text-transform: uppercase;">Login</button>
                                        <button type="button" onclick="window.location.reload();" class="btn w-100" style="background: rgba(255,255,255,0.1); color: #fff; font-weight: 600; border-radius: 12px; padding: 10px; border: none; font-size: 0.9rem;">Cancel</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
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
