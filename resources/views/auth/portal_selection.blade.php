@extends('layout.auth.master')
@section('contents')
    @include('paritials.css.login-css')
    <div class="page-wrapper" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #f0f2f5;">
        <div class="container">
            <div class="text-center mb-5">
                <img src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt="Logo" style="width: 150px; margin-bottom: 20px;">
                <h2 style="font-weight: 800; color: #2d3436; text-transform: uppercase; letter-spacing: 2px;">Select Your Portal</h2>
                <p style="color: #636e72; font-size: 1.1rem;">Choose the portal you wish to access today</p>
            </div>
            
            <div class="row justify-content-center">
                <!-- Admin Card -->
                <div class="col-md-4 mb-4">
                    <a href="/admin/login" style="text-decoration: none;">
                        <div class="card portal-card h-100" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.3s ease; overflow: hidden; background: #fff;">
                            <div class="card-body text-center p-5">
                                <div class="icon-wrapper mb-4" style="width: 80px; height: 80px; background: rgba(0, 206, 201, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                    <i class="fa fa-user-shield" style="font-size: 2.5rem; color: #00cec9;"></i>
                                </div>
                                <h3 style="font-weight: 700; color: #2d3436; margin-bottom: 15px;">Admin</h3>
                                <p style="color: #636e72;">Secure access for system administrators and managers.</p>
                                <div class="mt-4">
                                    <span class="btn" style="background: #00cec9; color: #fff; border-radius: 10px; padding: 10px 25px; font-weight: 600;">Enter Portal</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Staff Card -->
                <div class="col-md-4 mb-4">
                    <a href="/staff/login" style="text-decoration: none;">
                        <div class="card portal-card h-100" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.3s ease; overflow: hidden; background: #fff;">
                            <div class="card-body text-center p-5">
                                <div class="icon-wrapper mb-4" style="width: 80px; height: 80px; background: rgba(72, 52, 212, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                    <i class="fa fa-users-cog" style="font-size: 2.5rem; color: #4834d4;"></i>
                                </div>
                                <h3 style="font-weight: 700; color: #2d3436; margin-bottom: 15px;">Staff</h3>
                                <p style="color: #636e72;">Employee portal for day-to-day operations and tasks.</p>
                                <div class="mt-4">
                                    <span class="btn" style="background: #4834d4; color: #fff; border-radius: 10px; padding: 10px 25px; font-weight: 600;">Enter Portal</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <style>
        .portal-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2) !important;
        }
        .portal-card:hover h3 {
            color: #1e3799 !important;
        }
    </style>
@endsection
