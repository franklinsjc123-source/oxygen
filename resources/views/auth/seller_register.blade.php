@extends('layout.auth.master')
@section('title', 'Become a Seller - Trymenow')
@section('contents')
    @include('paritials.css.login-css')
    <!-- page-wrapper Start-->
    <div class="page-wrapper" style="min-height: 100vh; display: flex; align-items: center; padding: 30px 15px; background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ec 100%);">
        <div class="authentication-box" style="width: 100%;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-9 col-12 p-0">
                        <div class="card" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15);">
                            <div class="card-body" style="background: #ffffff; padding: 35px 40px; color: #333;">
                                
                                <!-- Logo -->
                                <div class="logo-wrapper text-center mb-3">
                                    <a href="/">
                                        <img src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt="Logo" style="width: 165px; max-width: 100%; height: auto;">
                                    </a>
                                </div>

                                <h3 class="text-center mb-1" style="font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; font-size: 1.4rem; color: #1e272e;">
                                    Become a Seller
                                </h3>
                                <p class="text-center text-muted mb-4" style="font-size: 0.95rem;">
                                    Fill in your details below to partner with TrymeNow and grow your business.
                                </p>

                                <!-- Success Alert -->
                                @if(session('success'))
                                    <div class="alert alert-success d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 15px;">
                                        <i class="fa fa-check-circle me-2" style="font-size: 1.3rem;"></i>
                                        <div>
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                    <div class="text-center mt-3 mb-2">
                                        <a href="{{ url('seller/login') }}" class="btn btn-outline-primary" style="border-radius: 10px; font-weight: 600;">
                                            &larr; Back to Seller Login
                                        </a>
                                    </div>
                                @else

                                    <!-- Validation Errors -->
                                    @if($errors->any())
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

                                        <div class="row">
                                            <!-- Shop / Business Name -->
                                            <div class="col-md-6 mb-3">
                                                <label for="shop_name" class="form-label" style="font-weight: 600; font-size: 0.95rem; color: #475569;">
                                                    Shop / Business Name <span style="color: #ff5e57;">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ old('shop_name') }}" placeholder="e.g. Sri Krishna Stores" required style="border-radius: 10px; padding: 10px 14px; border: 1px solid #cbd5e1; background: #f8fafc; font-size: 0.95rem;">
                                            </div>

                                            <!-- Owner / Contact Person -->
                                            <div class="col-md-6 mb-3">
                                                <label for="owner_name" class="form-label" style="font-weight: 600; font-size: 0.95rem; color: #475569;">
                                                    Owner / Contact Person <span style="color: #ff5e57;">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ old('owner_name') }}" placeholder="e.g. John Doe" required style="border-radius: 10px; padding: 10px 14px; border: 1px solid #cbd5e1; background: #f8fafc; font-size: 0.95rem;">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Mobile Number -->
                                            <div class="col-md-6 mb-3">
                                                <label for="mobile_number" class="form-label" style="font-weight: 600; font-size: 0.95rem; color: #475569;">
                                                    Mobile Number <span style="color: #ff5e57;">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-right: none; border-radius: 10px 0 0 10px; font-weight: 600; color: #64748b;">+91</span>
                                                    <input type="tel" pattern="[0-9]{10}" maxlength="10" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="10-digit mobile number" required style="border-radius: 0 10px 10px 0; padding: 10px 14px; border: 1px solid #cbd5e1; background: #f8fafc; font-size: 0.95rem;">
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label" style="font-weight: 600; font-size: 0.95rem; color: #475569;">
                                                    Email Address
                                                </label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="e.g. shop@example.com" style="border-radius: 10px; padding: 10px 14px; border: 1px solid #cbd5e1; background: #f8fafc; font-size: 0.95rem;">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- City / Town -->
                                            <div class="col-md-6 mb-3">
                                                <label for="city" class="form-label" style="font-weight: 600; font-size: 0.95rem; color: #475569;">
                                                    City / Town <span style="color: #ff5e57;">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" placeholder="e.g. Chennai, Madurai" required style="border-radius: 10px; padding: 10px 14px; border: 1px solid #cbd5e1; background: #f8fafc; font-size: 0.95rem;">
                                            </div>

                                            <!-- Business Category -->
                                            <div class="col-md-6 mb-3">
                                                <label for="business_category" class="form-label" style="font-weight: 600; font-size: 0.95rem; color: #475569;">
                                                    Business Category
                                                </label>
                                                <select class="form-control" id="business_category" name="business_category" style="border-radius: 10px; padding: 10px 14px; border: 1px solid #cbd5e1; background: #f8fafc; font-size: 0.95rem;">
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
                                        </div>

                                        <!-- Address -->
                                        <div class="mb-3">
                                            <label for="address" class="form-label" style="font-weight: 600; font-size: 0.95rem; color: #475569;">
                                                Shop Address / Landmark
                                            </label>
                                            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter shop address or landmark" style="border-radius: 10px; padding: 10px 14px; border: 1px solid #cbd5e1; background: #f8fafc; font-size: 0.95rem;">{{ old('address') }}</textarea>
                                        </div>

                                        <!-- Message / Note -->
                                        <div class="mb-3">
                                            <label for="message" class="form-label" style="font-weight: 600; font-size: 0.95rem; color: #475569;">
                                                Additional Notes (Optional)
                                            </label>
                                            <textarea class="form-control" id="message" name="message" rows="2" placeholder="Any specific requirements or products you sell..." style="border-radius: 10px; padding: 10px 14px; border: 1px solid #cbd5e1; background: #f8fafc; font-size: 0.95rem;">{{ old('message') }}</textarea>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn w-100" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 13px; border: none; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.35); text-transform: uppercase; font-size: 1rem; letter-spacing: 0.5px;">
                                                Submit Registration
                                            </button>
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
            </div>
        </div>
    </div>
@endsection

