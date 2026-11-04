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
            max-width: 800px;
            margin: 0 auto;
            box-sizing: border-box;
        }
        .card.seller-card {
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
            background: #ffffff;
            width: 100%;
            margin: 0 auto;
        }
        .card.seller-card .card-body.seller-card-body,
        .seller-card-body {
            padding: 48px 56px !important;
            color: #333;
            box-sizing: border-box !important;
        }
        .seller-form-label {
            font-weight: 500;
            font-size: 14px;
            color: #333333;
            margin-bottom: 5px;
            display: block;
        }
        .seller-form-control,
        .seller-card input.form-control,
        .seller-card textarea.form-control {
            border-radius: 4px !important;
            height: 38px !important;
            padding: 6px 12px !important;
            border: 1px solid #ced4da !important;
            background: #ffffff !important;
            font-size: 14px !important;
            width: 100% !important;
            box-sizing: border-box !important;
            color: #495057 !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
            box-shadow: none !important;
        }
        textarea.seller-form-control,
        .seller-card textarea.form-control {
            height: auto !important;
            min-height: 70px !important;
            padding: 8px 12px !important;
            line-height: 1.5 !important;
        }
        .seller-form-control:focus,
        .seller-card input.form-control:focus,
        .seller-card textarea.form-control:focus {
            border-color: #80bdff !important;
            outline: 0 !important;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15) !important;
            background: #ffffff !important;
        }
        .seller-form-control::placeholder,
        .seller-card input.form-control::placeholder,
        .seller-card textarea.form-control::placeholder {
            text-transform: none !important;
        }

        /* Seamless Mobile Number Input Group matching Image 2 */
        .phone-input-group {
            display: flex;
            align-items: center;
            height: 38px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            background: #ffffff;
            overflow: hidden;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .phone-input-group:focus-within {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        }
        .phone-input-prefix {
            background: #e9ecef;
            color: #495057;
            font-weight: 500;
            font-size: 14px;
            padding: 0 12px;
            height: 100%;
            display: flex;
            align-items: center;
            border-right: 1px solid #ced4da;
            user-select: none;
            flex-shrink: 0;
        }
        .phone-input-field {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            background: transparent !important;
            height: 100% !important;
            width: 100% !important;
            padding: 6px 12px !important;
            font-size: 14px !important;
            color: #495057 !important;
        }

        /* Error message matching Image 2 */
        .invalid-feedback-custom {
            display: none;
            color: #dc3545;
            font-size: 13px;
            margin-top: 4px;
            font-weight: 400;
            line-height: 1.3;
        }

        /* UIN Create Link Button */
        .uin-link-btn {
            font-size: 11px;
            padding: 2px 10px;
            border-radius: 4px;
            background: #fff5f5;
            color: #ff5e57;
            border: 1px solid #ff5e57;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(255, 94, 87, 0.15);
        }
        .uin-link-btn:hover {
            background: #ff5e57;
            color: #ffffff;
            border-color: #ff5e57;
            text-decoration: none;
        }

        /* SweetAlert2 OK Button explicit styling */
        .swal2-actions {
            display: flex !important;
            justify-content: center !important;
            margin-top: 20px !important;
            z-index: 999999 !important;
        }
        .swal2-confirm,
        button.swal2-confirm {
            display: inline-block !important;
            background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%) !important;
            color: #ffffff !important;
            font-size: 15px !important;
            font-weight: 700 !important;
            border-radius: 8px !important;
            padding: 10px 36px !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(255, 168, 1, 0.4) !important;
            cursor: pointer !important;
            opacity: 1 !important;
            visibility: visible !important;
            min-width: 120px !important;
        }
        /* Keep text box border clean gray #ced4da even on invalid state (Image 2 style) */
        .phone-input-group,
        .phone-input-group.is-invalid,
        .seller-form-control,
        .seller-form-control.is-invalid,
        .seller-card input.form-control.is-invalid,
        .seller-card textarea.form-control.is-invalid,
        form :invalid {
            border-color: #ced4da !important;
            box-shadow: none !important;
            background-image: none !important;
        }

        /* Responsive styling for Mobile */
        @media (max-width: 768px) {
            .seller-register-page {
                padding: 0 !important;
                background: #ffffff !important;
                min-height: 100vh !important;
                align-items: flex-start !important;
            }
            .seller-card-container {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .card.seller-card {
                border-radius: 0 !important;
                border: none !important;
                box-shadow: none !important;
                width: 100% !important;
                margin: 0 !important;
            }
            .card.seller-card .card-body.seller-card-body,
            .seller-card-body {
                padding: 24px 16px !important;
            }
            .seller-form-control,
            .phone-input-group {
                height: 38px !important;
                font-size: 14px !important;
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
                            <img src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt="Logo" style="width: 160px; max-width: 100%; height: auto;">
                        </a>
                    </div>

                    <!-- Header & Subtitle -->
                    <h3 class="text-center mb-2" style="font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase; font-size: 1.45rem; color: #1e272e;">
                        Become a Seller
                    </h3>
                    <p class="text-center text-muted mb-4" style="font-size: 0.95rem; color: #64748b !important; max-width: 480px; margin: 0 auto 28px; line-height: 1.5;">
                        Fill in your details below to partner with TrymeNow and grow your business.
                    </p>

                    <!-- Validation Errors -->
                    @if(isset($errors) && $errors->any())
                        <div class="alert alert-danger" style="border-radius: 8px; padding: 12px 18px; margin-bottom: 24px;">
                            <ul class="mb-0" style="padding-left: 20px;">
                                @foreach($errors->all() as $err)
                                    <li style="font-size: 0.9rem;">{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('seller.register.submit') }}" method="post" id="sellerRegisterForm" novalidate>
                        @csrf

                        <!-- Row 1: Shop Name & Owner Name -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6 col-12">
                                <label for="shop_name" class="seller-form-label">
                                    Shop Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="seller-form-control form-control" id="shop_name" name="shop_name" value="{{ old('shop_name') }}" placeholder="Please enter shop name" required>
                                <div class="invalid-feedback-custom" id="shop_name_feedback">Please enter shop name</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="owner_name" class="seller-form-label">
                                    Owner Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="seller-form-control form-control" id="owner_name" name="owner_name" value="{{ old('owner_name') }}" placeholder="Please enter owner name" required>
                                <div class="invalid-feedback-custom" id="owner_name_feedback">Please enter owner name</div>
                            </div>
                        </div>

                        <!-- Row 2: Mobile Number & Email Address -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6 col-12">
                                <label for="mobile_number" class="seller-form-label">
                                    Mobile Number <span class="text-danger">*</span>
                                </label>
                                <div class="phone-input-group">
                                    <span class="phone-input-prefix">+91</span>
                                    <input type="tel" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" class="phone-input-field" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Please enter mobile number" oninput="this.value = this.value.replace(/[^0-9]/g, '')" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
                                </div>
                                <div class="invalid-feedback-custom" id="mobile_number_feedback">Please enter mobile number</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="email" class="seller-form-label">
                                    E-Mail
                                </label>
                                <input type="email" class="seller-form-control form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Please enter e-mail">
                                <div class="invalid-feedback-custom" id="email_feedback">Please enter valid e-mail</div>
                            </div>
                        </div>

                        <!-- Row 3: Pincode & Business Category -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6 col-12">
                                <label for="pincode" class="seller-form-label">
                                    Pincode <span class="text-danger">*</span>
                                </label>
                                <input type="text" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" class="seller-form-control form-control" id="pincode" name="pincode" value="{{ old('pincode') }}" placeholder="Please enter pincode" oninput="this.value = this.value.replace(/[^0-9]/g, '')" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
                                <div class="invalid-feedback-custom" id="pincode_feedback">Please enter valid 6-digit pincode</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="business_category" class="seller-form-label">
                                    Business Category
                                </label>
                                <input type="text" class="seller-form-control form-control" id="business_category" name="business_category" value="{{ old('business_category') }}" placeholder="Please enter business category">
                            </div>
                        </div>

                        <!-- Row 4: GSTIN / UIN (Optional) -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="gstin_or_uin" class="seller-form-label mb-0">
                                    GSTIN / UIN
                                </label>
                                <a href="https://reg.gst.gov.in/registration/generateuid?utm_source=meesho&utm_medium=website&utm_campaign=header" target="_blank" rel="noopener noreferrer" class="btn btn-sm uin-link-btn" title="Generate UIN on GST Portal">
                                    <i class="fa fa-external-link"></i> Create UIN
                                </a>
                            </div>
                            <input type="text" class="seller-form-control form-control" id="gstin_or_uin" name="gstin_or_uin" value="{{ old('gstin_or_uin', old('gstin', old('uin'))) }}" placeholder="Please enter GSTIN or UIN" maxlength="50">
                        </div>

                        <!-- Row 4: Address -->
                        <div class="mb-3">
                            <label for="address" class="seller-form-label">
                                Address
                            </label>
                            <textarea class="seller-form-control form-control" id="address" name="address" rows="2" placeholder="Please enter address">{{ old('address') }}</textarea>
                        </div>

                        <!-- Row 5: Notes -->
                        <div class="mb-4">
                            <label for="message" class="seller-form-label">
                                Additional Notes (Optional)
                            </label>
                            <textarea class="seller-form-control form-control" id="message" name="message" rows="2" placeholder="Any specific requirements or products you sell...">{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn w-100" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #fff; font-weight: 700; border-radius: 8px; height: 44px; border: none; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.35); text-transform: uppercase; font-size: 0.95rem; letter-spacing: 0.5px; transition: all 0.2s ease;">
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

                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal Popup Fallback -->
    <div id="sellerSuccessModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.65); z-index: 999999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
        <div style="background: #ffffff; border-radius: 20px; max-width: 440px; width: 90%; padding: 32px 24px; text-align: center; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
            <div style="width: 72px; height: 72px; background: #ecfdf5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; color: #10b981; font-size: 36px;">
                <i class="fa fa-check-circle"></i>
            </div>
            <h3 style="font-size: 1.35rem; font-weight: 700; color: #1e293b; margin-bottom: 10px;">
                Request Submitted Successfully!
            </h3>
            <p id="sellerModalText" style="font-size: 0.98rem; color: #64748b; line-height: 1.6; margin-bottom: 24px;">
                Admin will contact you soon.
            </p>
            <button type="button" id="sellerModalOkBtn" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #ffffff; font-weight: 700; border-radius: 12px; padding: 12px 36px; border: none; font-size: 1rem; cursor: pointer; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.35); min-width: 140px;">
                OK
            </button>
        </div>
    </div>

    <!-- SweetAlert2 & Submission Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showSuccessPopup(message) {
            var msg = message || 'Admin will contact you soon.';
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: '<span style="color:#1e293b; font-weight:700;">Request Submitted Successfully!</span>',
                    html: '<p style="color:#64748b; font-size:1rem; margin-top:8px;">' + msg + '</p>',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ff5e57',
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = "{{ url('seller/login') }}";
                });
            } else {
                var modal = document.getElementById('sellerSuccessModal');
                if (modal) {
                    var modalText = document.getElementById('sellerModalText');
                    if (modalText) {
                        modalText.innerText = msg;
                    }
                    modal.style.display = 'flex';
                } else {
                    alert('Request Submitted Successfully!\n' + msg);
                    window.location.href = "{{ url('seller/login') }}";
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var okBtn = document.getElementById('sellerModalOkBtn');
            if (okBtn) {
                okBtn.addEventListener('click', function() {
                    window.location.href = "{{ url('seller/login') }}";
                });
            }

            @if(session('success'))
                showSuccessPopup("{{ session('success') }}");
            @endif

            var $form = $('#sellerRegisterForm');
            if ($form.length) {
                // Real-time input error clearing on type
                $('#shop_name').on('input keyup', function() {
                    if ($(this).val().trim()) {
                        $('#shop_name_feedback').hide();
                    }
                });
                $('#owner_name').on('input keyup', function() {
                    if ($(this).val().trim()) {
                        $('#owner_name_feedback').hide();
                    }
                });
                $('#mobile_number').on('input keyup paste', function() {
                    var v = $(this).val().replace(/[^0-9]/g, '');
                    if ($(this).val() !== v) {
                        $(this).val(v);
                    }
                    if (v && /^[0-9]{10}$/.test(v)) {
                        $('#mobile_number_feedback').hide();
                    }
                });
                $('#pincode').on('input keyup', function() {
                    var v = $(this).val().replace(/[^0-9]/g, '');
                    if ($(this).val() !== v) {
                        $(this).val(v);
                    }
                    if (v && /^[0-9]{6}$/.test(v)) {
                        $('#pincode_feedback').hide();
                    }
                });
                $('#email').on('input keyup', function() {
                    var v = $(this).val().trim();
                    if (!v || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) {
                        $('#email_feedback').hide();
                    }
                });

                $form.on('submit', function(e) {
                    e.preventDefault();

                    var isValid = true;
                    var $firstInvalid = null;

                    // 1. Shop Name
                    var shopName = $('#shop_name').val().trim();
                    if (!shopName) {
                        $('#shop_name_feedback').show();
                        isValid = false;
                        if (!$firstInvalid) $firstInvalid = $('#shop_name');
                    } else {
                        $('#shop_name_feedback').hide();
                    }

                    // 2. Owner Name
                    var ownerName = $('#owner_name').val().trim();
                    if (!ownerName) {
                        $('#owner_name_feedback').show();
                        isValid = false;
                        if (!$firstInvalid) $firstInvalid = $('#owner_name');
                    } else {
                        $('#owner_name_feedback').hide();
                    }

                    // 3. Mobile Number
                    var mobileNumber = $('#mobile_number').val().trim();
                    if (!mobileNumber || !/^[0-9]{10}$/.test(mobileNumber)) {
                        $('#mobile_number_feedback').show();
                        isValid = false;
                        if (!$firstInvalid) $firstInvalid = $('#mobile_number');
                    } else {
                        $('#mobile_number_feedback').hide();
                    }

                    // 4. Pincode
                    var pincode = $('#pincode').val().trim();
                    if (!pincode || !/^[0-9]{6}$/.test(pincode)) {
                        $('#pincode_feedback').show();
                        isValid = false;
                        if (!$firstInvalid) $firstInvalid = $('#pincode');
                    } else {
                        $('#pincode_feedback').hide();
                    }

                    // 5. Email (Optional)
                    var email = $('#email').val().trim();
                    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                        $('#email_feedback').show();
                        isValid = false;
                        if (!$firstInvalid) $firstInvalid = $('#email');
                    } else {
                        $('#email_feedback').hide();
                    }

                    if (!isValid) {
                        if ($firstInvalid) {
                            $firstInvalid.focus();
                        }
                        return false;
                    }

                    var $submitBtn = $form.find('button[type="submit"]');
                    var originalBtnHtml = $submitBtn.html();

                    $submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Submitting...');

                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: $form.serialize(),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            $submitBtn.prop('disabled', false).html(originalBtnHtml);
                            $form[0].reset();
                            $('.invalid-feedback-custom').hide();
                            showSuccessPopup(response.message || 'Admin will contact you soon.');
                        },
                        error: function(xhr) {
                            $submitBtn.prop('disabled', false).html(originalBtnHtml);
                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, val) {
                                    var $feedback = $('#' + key + '_feedback');
                                    if ($feedback.length) {
                                        $feedback.text(val[0]).show();
                                    }
                                });
                            } else {
                                $form.off('submit').submit();
                            }
                        }
                    });
                });
            }
        });
    </script>
@endsection
