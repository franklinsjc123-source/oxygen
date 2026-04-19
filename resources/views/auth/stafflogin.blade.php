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
                            <div class="card-body" style="background: #ffffff; padding: 30px 40px; color: #333;">
                                <div class="logo-wrapper text-center mb-3">
                                    <a href="/">
                                        <img src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt="Logo" style="width: 110px;">
                                    </a>
                                </div>

                                <div class="portal-nav d-flex justify-content-center mb-4" style="background: #f1f2f6; padding: 5px; border-radius: 15px;">
                                    <a href="/admin/login" style="flex: 1; text-align: center; padding: 10px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 1rem; {{ request()->is('admin*') ? 'background: #fff; color: #1e3799; box-shadow: 0 2px 10px rgba(0,0,0,0.1);' : 'color: #747d8c;' }}">Admin</a>
                                    <a href="/staff/login" style="flex: 1; text-align: center; padding: 10px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 1rem; {{ request()->is('staff*') ? 'background: #fff; color: #1e3799; box-shadow: 0 2px 10px rgba(0,0,0,0.1);' : 'color: #747d8c;' }}">Staff</a>
                                    <a href="/vendor/login" style="flex: 1; text-align: center; padding: 10px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 1rem; {{ request()->is('vendor*') ? 'background: #fff; color: #1e3799; box-shadow: 0 2px 10px rgba(0,0,0,0.1);' : 'color: #747d8c;' }}">Vendor</a>
                                </div>
                                @if(@$error)
                                    <h6 style="color:#ff4d4d;" class="text-center mb-2">{{ @$error }}</h6>
                                @endif
                                <h3 class="text-center mb-3" style="font-weight: 700; letter-spacing: 1px; text-transform: uppercase; font-size: 1.5rem; color: #1e3799;">Staff Portal</h3>
                                
                                <form action="{{ route('stafflogin') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="username" style="font-weight: 500; opacity: 0.9; margin-bottom: 5px; display: block; font-size: 1.2rem; color: #555;">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required style="border-radius: 10px; padding: 12px 15px; border: 1px solid #ddd; background: #f9f9f9; color: #333; font-size: 1.2rem;">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="pwd" style="font-weight: 500; opacity: 0.9; margin-bottom: 5px; display: block; font-size: 1.2rem; color: #555;">Password</label>
                                        <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password" required style="border-radius: 10px; padding: 12px 15px; border: 1px solid #ddd; background: #f9f9f9; color: #333; font-size: 1.2rem;">
                                    </div>

                                    <div class="form-terms d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember" style="background-color: transparent; border-color: #ccc; transform: scale(1.2); margin-right: 8px;">
                                            <label class="form-check-label" for="remember" style="font-size: 1.2rem; opacity: 0.8; color: #555;">Remember me</label>
                                        </div>
                                        <a href="#" style="color: #666; font-size: 0.9rem; text-decoration: none;">Forgot password?</a>
                                    </div>

                                    <div class="form-button text-center mt-4">
                                        <button type="submit" name="submit" class="btn w-100 mb-2" style="background: linear-gradient(90deg, #4834d4 0%, #686de0 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; box-shadow: 0 4px 15px rgba(72, 52, 212, 0.4); text-transform: uppercase;">Login</button>
                                        <button type="button" onclick="window.history.back();" class="btn w-100" style="background: #eee; color: #444; font-weight: 600; border-radius: 12px; padding: 10px; border: none; font-size: 0.9rem;">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
