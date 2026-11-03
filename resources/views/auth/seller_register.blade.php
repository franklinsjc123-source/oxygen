@extends('layout.auth.master')
@section('title', 'Become a Seller - Trymenow')
@section('contents')
    @include('paritials.css.login-css')
    <style>
        .seller-register-page {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: #f4f7f6;
            box-sizing: border-box;
        }
        .seller-card-container {
            width: 100%;
            max-width: 620px;
            margin: 0 auto;
            box-sizing: border-box;
        }
        .seller-card {
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
            background: #ffffff;
            width: 100%;
            margin: 0 auto;
        }
        .seller-card-body {
            padding: 40px 42px;
            color: #333;
            box-sizing: border-box;
        }
        .seller-form-label {
            font-weight: 600;
            font-size: 0.94rem;
            color: #475569;
            margin-bottom: 7px;
            display: block;
        }
        .seller-form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            font-size: 0.95rem;
            width: 100%;
            box-sizing: border-box;
            color: #1e293b;
            transition: all 0.2s ease;
        }
        .seller-form-control:focus {
            background: #ffffff;
            border-color: #38bdf8;
            outline: none;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
        }

        /* Generous, perfectly equal padding and spacing on mobile */
        @media (max-width: 576px) {
            .seller-register-page {
                padding: 25px 18px !important;
            }
            .seller-card-container {
                padding: 0 !important;
                margin: 0 auto !important;
            }
            .seller-card {
                border-radius: 18px !important;
                box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important;
            }
            .seller-card-body {
                padding: 32px 26px !important;
            }
            .seller-form-control {
                padding: 11px 14px !important;
                font-size: 0.92rem !important;
            }
            .seller-form-row {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
            .seller-form-row > [class*="col-"] {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
        }
    </style>

    <div class="seller-register-page">
        <div class="seller-card-container">
            <div class="card seller-card">
                <div class="card-body seller-card-body">
                    
                    <!-- Logo -->
                    <div class="logo-wrapper text-center mb-3">
                        <a href="/">
                            <img src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt="Logo" style="width: 155px; max-width: 100%; height: auto;">
                        </a>
                    </div>

                    <h3 class="text-center mb-1" style="font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; font-size: 1.35rem; color: #1e272e;">
                        Become a Seller
                    </h3>
                    <p class="text-center text-muted mb-4" style="font-size: 0.92rem; line-height: 1.4;">
                        Fill in your details below to partner with TrymeNow and grow your business.
                    </p>

                    <!-- Success Alert -->
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 15px; margin-bottom: 20px;">
                            <i class="fa fa-check-circle me-2" style="font-size: 1.3rem;"></i>
                            <div>
                                {{ session('success') }}
                            </div>
                        </div>
                        <div class="text-center mt-3 mb-2">
                            <a href="{{ url('seller/login') }}" class="btn btn-outline-primary" style="border-radius: 10px; font-weight: 600; padding: 10px 20px;">
                                &larr; Back to Seller Login
                            </a>
                        </div>
                    @else

                        <!-- Validation Errors -->
                        @if(isset($errors) && $errors->any())
                            <div class="alert alert-danger" style="border-radius: 12px; padding: 12px 18px; margin-bottom: 20px;">
                                <ul class="mb-0" style="padding-left: 20px;">
                                    @foreach($errors->all() as $err)
                                        <li style="font-size: 0.9rem;">{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('seller.register.submit') }}" method="post" id="sellerRegisterForm">
                            @csrf

                            <div class="row g-3 seller-form-row">
                                <!-- Shop / Business Name -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="shop_name" class="seller-form-label">
                                        Shop / Business Name <span style="color: #ff5e57;">*</span>
                                    </label>
                                    <input type="text" class="seller-form-control" id="shop_name" name="shop_name" value="{{ old('shop_name') }}" placeholder="e.g. Sri Krishna Stores" required>
                                </div>

                                <!-- Owner / Contact Person -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="owner_name" class="seller-form-label">
                                        Owner / Contact Person <span style="color: #ff5e57;">*</span>
                                    </label>
                                    <input type="text" class="seller-form-control" id="owner_name" name="owner_name" value="{{ old('owner_name') }}" placeholder="e.g. John Doe" required>
                                </div>

                                <!-- Mobile Number -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="mobile_number" class="seller-form-label">
                                        Mobile Number <span style="color: #ff5e57;">*</span>
                                    </label>
                                    <div class="input-group" style="width: 100%;">
                                        <span class="input-group-text" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-right: none; border-radius: 10px 0 0 10px; font-weight: 600; color: #64748b; padding: 0 12px;">+91</span>
                                        <input type="tel" pattern="[0-9]{10}" maxlength="10" class="seller-form-control" style="border-radius: 0 10px 10px 0;" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="10-digit number" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="email" class="seller-form-label">
                                        Email Address
                                    </label>
                                    <input type="email" class="seller-form-control" id="email" name="email" value="{{ old('email') }}" placeholder="e.g. shop@example.com">
                                </div>

                                <!-- City / Town -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="city" class="seller-form-label">
                                        City / Town <span style="color: #ff5e57;">*</span>
                                    </label>
                                    <input type="text" class="seller-form-control" id="city" name="city" value="{{ old('city') }}" placeholder="e.g. Chennai, Madurai" required>
                                </div>

                                <!-- Business Category -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="business_category" class="seller-form-label">
                                        Business Category
                                    </label>
                                    <select class="seller-form-control" id="business_category" name="business_category" style="cursor: pointer;">
                                        <option value="">Select Category</option>
                                        <option value="Fashion & Clothing" {{ old('business_category') == 'Fashion & Clothing' ? 'selected' : '' }}>Fashion & Clothing</option>
                                        <option value="Electronics & Mobiles" {{ old('business_category') == 'Electronics & Mobiles' ? 'selected' : '' }}>Electronics & Mobiles</option>
                                        <option value="Grocery & Supermarket" {{ old('business_category') == 'Grocery & Supermarket' ? 'selected' : '' }}>Grocery & Supermarket</option>
                                        <option value="Home & Kitchen" {{ old('business_category') == 'Home & Kitchen' ? 'selected' : '' }}>Home & Kitchen</option>
                                        <option value="Pharmacy & Health" {{ old('business_category') == 'Pharmacy & Health' ? 'selected' : '' }}>Pharmacy & Health</option>
                                        <option value="Beauty & Personal Care" {{ old('business_category') == 'Beauty & Personal Care' ? 'selected' : '' }}>Beauty & Personal Care</option>
                                        <option value="Automotive & Spare Parts" {{ old('business_category') == 'Automotive & Spare Parts' ? 'selected' : '' }}>Automotive & Spare Parts</option>
                                        <option value="Hardware & Electricals" {{ old('business_category') == 'Hardware & Electricals' ? 'selected' : '' }}>Hardware & Electricals</option>
                                        <option value="Other" {{ old('business_category') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <!-- Address -->
                                <div class="col-12 mb-3">
                                    <label for="address" class="seller-form-label">
                                        Shop Address / Landmark
                                    </label>
                                    <textarea class="seller-form-control" id="address" name="address" rows="2" placeholder="Enter shop address or landmark">{{ old('address') }}</textarea>
                                </div>

                                <!-- Message / Note -->
                                <div class="col-12 mb-3">
                                    <label for="message" class="seller-form-label">
                                        Additional Notes (Optional)
                                    </label>
                                    <textarea class="seller-form-control" id="message" name="message" rows="2" placeholder="Any specific requirements or products you sell...">{{ old('message') }}</textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn w-100" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 13px; border: none; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.35); text-transform: uppercase; font-size: 1rem; letter-spacing: 0.5px;">
                                        Submit Registration
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Back to Login -->
                        <div class="text-center mt-4 pt-3" style="border-top: 1px dashed #e2e8f0;">
                            <p class="mb-0" style="font-size: 0.95rem; color: #64748b;">
                                Already registered as a seller? 
                                <a href="{{ url('seller/login') }}" style="color: #ff5e57; font-weight: 600; text-decoration: none;">
                                    Login here
                                </a>
                            </p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
