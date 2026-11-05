@extends('layout.auth.master')
@section('title', 'Seller Portal - Trymenow')
@section('contents')
    @include('paritials.css.login-css')
    <style>
        .become-seller-btn {
            text-transform: none !important;
            letter-spacing: 0 !important;
            white-space: normal !important;
            line-height: 1.35 !important;
            font-size: 0.9rem !important;
            padding: 10px 12px !important;
        }
        @media (max-width: 576px) {
            .auth-card-body {
                padding: 24px 18px !important;
            }
            .become-seller-box-inner {
                padding: 12px 10px !important;
            }
            .become-seller-btn {
                font-size: 0.82rem !important;
                padding: 9px 6px !important;
            }
        }
    </style>
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row">

                    <div class="col-12 m-auto p-0" style="max-width: 350px;">
                        <div class="card" style="border-radius: 18px; overflow: hidden; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.3);">
                            <div class="card-body auth-card-body" style="background: #ffffff; padding: 22px 24px; color: #333;">
                                <div class="logo-wrapper text-center mb-2">
                                    <a href="/">
                                        <img src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt="Logo" style="width: 135px; max-width: 100%; height: auto;">
                                    </a>
                                </div>


                                @if(@$error)
                                    <h6 style="color:#ff5e57;" class="text-center mb-2">{{ @$error }}</h6>
                                @endif
                                <form action="{{ route('vendorlogin') }}" method="post" id="vendorLoginForm">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="username" style="font-weight: 500; opacity: 0.9; margin-bottom: 4px; display: block; font-size: 0.92rem; color: #555;">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{ request()->cookie('remember_vendor_username') ?? Cookie::get('remember_vendor_username') ?? old('username') }}" placeholder="Enter your username" required style="border-radius: 8px; padding: 8px 12px; border: 1px solid #ddd; background: #f9f9f9; color: #333; font-size: 0.92rem;">
                                    </div>

                                    <div class="form-group mb-2 position-relative">
                                        <label for="pwd" style="font-weight: 500; opacity: 0.9; margin-bottom: 4px; display: block; font-size: 0.92rem; color: #555;">Password</label>
                                        <div style="position: relative;">
                                            <input type="password" class="form-control" id="pwd" name="password" value="{{ request()->cookie('remember_vendor_password') ?? Cookie::get('remember_vendor_password') ?? '' }}" placeholder="Enter your password" required style="border-radius: 8px; padding: 8px 38px 8px 12px; border: 1px solid #ddd; background: #f9f9f9; color: #333; font-size: 0.92rem;">
                                            <i class="fa fa-eye-slash" id="togglePassword" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888; font-size: 0.92rem;"></i>
                                        </div>
                                    </div>

                                    <div class="form-terms d-flex justify-content-between align-items-center mb-3" style="margin-top: 10px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1" {{ (request()->hasCookie('remember_vendor_check') || Cookie::has('remember_vendor_check') || request()->hasCookie('remember_vendor_username') || Cookie::has('remember_vendor_username') || old('remember')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember" style="font-size: 0.88rem; opacity: 0.9; color: #555;"> Remember me</label>
                                        </div>
                                        <a href="javascript:void(0)" id="openForgotModal" style="color: #ff5e57; font-size: 0.85rem; text-decoration: none; font-weight: 600;">Forgot password?</a>
                                    </div>

                                    <div class="form-button text-center mt-2">
                                        <button type="submit" name="submit" class="btn w-100" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #fff; font-weight: 700; border-radius: 10px; padding: 9px; border: none; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.3); text-transform: uppercase; font-size: 0.92rem; letter-spacing: 0.5px;">Login</button>
                                    </div>

                                </form>

                                <!-- New User / Become a Seller Box -->
                                <div class="become-seller-wrapper mt-3 pt-2 text-center" style="border-top: 1px solid #f1f5f9; margin-top: 12px;">
                                    <div class="become-seller-box-inner" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px 12px;">
                                        <div style="font-size: 0.82rem; color: #475569; font-weight: 600; margin-bottom: 5px; letter-spacing: 0.2px;">
                                            New to TrymeNow?
                                        </div>
                                        <a href="{{ url('seller/register') }}" class="btn w-100 become-seller-btn" style="background: #1e293b; color: #ffffff; font-weight: 600; border-radius: 8px; padding: 8px 8px; font-size: 0.82rem; border: none; display: flex; align-items: center; justify-content: center; text-align: center; text-transform: none !important; letter-spacing: 0 !important; white-space: normal !important; box-shadow: 0 4px 12px rgba(30, 41, 59, 0.15); text-decoration: none;">
                                            Click here to become a seller
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Vendor Forgot Password Modal -->
    <div class="modal fade" id="vendorForgotModal" tabindex="-1" aria-labelledby="vendorForgotModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 350px; margin: 1.75rem auto;">
            <div class="modal-content" style="border-radius: 18px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.3); overflow: hidden; background: #fff;">
                <div class="modal-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #ffa801, #ff5e57); color: #fff; padding: 18px 22px; border-bottom: none;">
                    <h5 class="modal-title mb-0" id="vendorForgotModalLabel" style="font-weight: 700; font-size: 1.15rem; display: flex; align-items: center; gap: 10px; color: #fff;">
                        <i class="fa fa-key" style="font-size: 1.05rem;"></i> Reset Seller Password
                    </h5>
                    <button type="button" class="close-forgot-modal" aria-label="Close" style="opacity: 0.85; background: none; border: none; font-size: 1.75rem; color: #fff; line-height: 1; cursor: pointer; padding: 0;">&times;</button>
                </div>
                <div class="modal-body" style="padding: 22px 25px; background: #ffffff;">
                    <div id="forgotAlert" style="display: none; padding: 12px 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.95rem; line-height: 1.4;"></div>

                    <!-- STEP 1: Enter Identifier -->
                    <div id="forgotStep1">
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 20px; line-height: 1.5;">
                            Enter your registered <strong>Email</strong> to receive a password reset verification code.
                        </p>
                        <div class="form-group mb-4">
                            <label for="forgotIdentifier" style="font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 1rem;">Email</label>
                            <div style="position: relative;">
                                <input type="email" id="forgotIdentifier" class="form-control" placeholder="e.g. seller@email.com" style="border-radius: 10px; padding: 12px 15px 12px 42px; border: 1px solid #ddd; background: #f9f9f9; font-size: 1.05rem; color: #333;">
                                <i class="fa fa-envelope" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #888;"></i>
                            </div>
                        </div>
                        <button type="button" id="btnSendOtp" class="btn w-100" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; font-size: 1rem; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.3);">
                            <span class="btn-text">Send Verification Code</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border-width: 0.15em;"></span>
                        </button>
                    </div>

                    <!-- STEP 2: Enter OTP -->
                    <div id="forgotStep2" style="display: none;">
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 20px; line-height: 1.5;">
                            Enter the 6-digit OTP code sent to your email: <br><strong id="displayMaskedEmail" style="color: #ff5e57;"></strong>
                        </p>
                        <div class="form-group mb-3">
                            <label for="forgotOtp" style="font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 1rem;">6-Digit OTP Code</label>
                            <input type="text" id="forgotOtp" maxlength="6" class="form-control text-center" placeholder="123456" style="border-radius: 10px; padding: 12px; border: 1px solid #ddd; background: #f9f9f9; font-size: 1.5rem; letter-spacing: 8px; font-weight: 700; color: #ff5e57;">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span style="font-size: 0.85rem; color: #888;">Didn't receive code?</span>
                            <a href="javascript:void(0)" id="btnResendOtp" style="font-size: 0.9rem; color: #ff5e57; font-weight: 600; text-decoration: none;">Resend OTP</a>
                        </div>
                        <button type="button" id="btnVerifyOtp" class="btn w-100 mb-3" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; font-size: 1rem; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.3);">
                            <span class="btn-text">Verify Code</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border-width: 0.15em;"></span>
                        </button>
                        <div class="text-center">
                            <a href="javascript:void(0)" class="btnBackToStep1" style="color: #888; font-size: 0.9rem; text-decoration: none;"><i class="fa fa-arrow-left"></i> Change Email</a>
                        </div>
                    </div>

                    <!-- STEP 3: Set New Password -->
                    <div id="forgotStep3" style="display: none;">
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 20px; line-height: 1.5;">
                            Create a new secure password for your seller account.
                        </p>
                        <div class="form-group mb-3 position-relative">
                            <label for="newVendorPassword" style="font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 1rem;">New Password</label>
                            <div style="position: relative;">
                                <input type="password" id="newVendorPassword" class="form-control" placeholder="Enter new password" style="border-radius: 10px; padding: 12px 45px 12px 15px; border: 1px solid #ddd; background: #f9f9f9; font-size: 1.05rem; color: #333;">
                                <i class="fa fa-eye-slash toggle-modal-pwd" data-target="newVendorPassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"></i>
                            </div>
                        </div>
                        <div class="form-group mb-4 position-relative">
                            <label for="confirmVendorPassword" style="font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 1rem;">Confirm New Password</label>
                            <div style="position: relative;">
                                <input type="password" id="confirmVendorPassword" class="form-control" placeholder="Re-enter new password" style="border-radius: 10px; padding: 12px 45px 12px 15px; border: 1px solid #ddd; background: #f9f9f9; font-size: 1.05rem; color: #333;">
                                <i class="fa fa-eye-slash toggle-modal-pwd" data-target="confirmVendorPassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"></i>
                            </div>
                        </div>
                        <button type="button" id="btnResetPassword" class="btn w-100 mb-3" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; font-size: 1rem; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.3);">
                            <span class="btn-text">Save New Password</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border-width: 0.15em;"></span>
                        </button>
                    </div>

                    <!-- STEP 4: Success Message -->
                    <div id="forgotStepSuccess" style="display: none; text-align: center; padding: 15px 0;">
                        <div style="width: 70px; height: 70px; border-radius: 50%; background: #e8f8f5; color: #1dd1a1; display: inline-flex; align-items: center; justify-content: center; font-size: 2.2rem; margin: 0 auto 15px auto;">
                            <i class="fa fa-check"></i>
                        </div>
                        <h4 style="font-weight: 700; color: #1e272e; margin-bottom: 10px;">Password Reset!</h4>
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 25px; line-height: 1.5;">
                            Your seller password has been updated successfully. You can now log in with your new password.
                        </p>
                        <button type="button" class="btn w-100 close-forgot-modal" style="background: linear-gradient(90deg, #ffa801 0%, #ff5e57 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; font-size: 1rem; box-shadow: 0 4px 15px rgba(255, 168, 1, 0.3);">
                            Proceed to Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Custom Backdrop Fallback -->
    <div id="modalCustomBackdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); z-index: 1040; backdrop-filter: blur(4px);"></div>

    <!-- Show/Hide Password & Remember Me Persistence Script -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const pwdField = document.getElementById('pwd');
            const type = pwdField.getAttribute('type') === 'password' ? 'text' : 'password';
            pwdField.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Toggle modal password fields
        document.querySelectorAll('.toggle-modal-pwd').forEach(function(icon) {
            icon.addEventListener('click', function() {
                var targetId = this.getAttribute('data-target');
                var field = document.getElementById(targetId);
                if (field) {
                    var type = field.getAttribute('type') === 'password' ? 'text' : 'password';
                    field.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                }
            });
        });

        // Client-side persistence for Remember Me
        document.addEventListener('DOMContentLoaded', function() {
            var usernameField = document.getElementById('username');
            var passwordField = document.getElementById('pwd');
            var rememberField = document.getElementById('remember');
            var loginForm = document.getElementById('vendorLoginForm');

            try {
                if (localStorage.getItem('remember_vendor_check') === '1') {
                    if (rememberField) rememberField.checked = true;
                    if (usernameField && (!usernameField.value || usernameField.value.trim() === '')) {
                        var savedUser = localStorage.getItem('remember_vendor_username');
                        if (savedUser) usernameField.value = savedUser;
                    }
                    if (passwordField && (!passwordField.value || passwordField.value.trim() === '')) {
                        var savedPass = localStorage.getItem('remember_vendor_password');
                        if (savedPass) passwordField.value = savedPass;
                    }
                } else if (rememberField && rememberField.checked) {
                    localStorage.setItem('remember_vendor_check', '1');
                    if (usernameField && usernameField.value) localStorage.setItem('remember_vendor_username', usernameField.value);
                    if (passwordField && passwordField.value) localStorage.setItem('remember_vendor_password', passwordField.value);
                }
            } catch(e) {}

            if (loginForm) {
                loginForm.addEventListener('submit', function() {
                    try {
                        if (rememberField && rememberField.checked) {
                            localStorage.setItem('remember_vendor_check', '1');
                            if (usernameField) localStorage.setItem('remember_vendor_username', usernameField.value);
                            if (passwordField) localStorage.setItem('remember_vendor_password', passwordField.value);
                        } else {
                            localStorage.removeItem('remember_vendor_check');
                            localStorage.removeItem('remember_vendor_username');
                            localStorage.removeItem('remember_vendor_password');
                        }
                    } catch(e) {}
                });
            }

            // Vendor Forgot Password Modal Logic
            var $modal = $('#vendorForgotModal');
            var $backdrop = $('#modalCustomBackdrop');
            var resetVendorUsername = '';

            function showAlert(msg, isError) {
                var $al = $('#forgotAlert');
                $al.removeClass('alert-success alert-danger')
                   .addClass(isError ? 'alert-danger' : 'alert-success')
                   .css({
                       'display': 'block',
                       'background-color': isError ? '#ffeaa7' : '#e8f8f5',
                       'color': isError ? '#d63031' : '#00b894',
                       'border': '1px solid ' + (isError ? '#ff7675' : '#55efc4')
                   })
                   .html(msg);
            }

            function hideAlert() {
                $('#forgotAlert').hide().empty();
            }

            function showStep(stepNumber) {
                hideAlert();
                $('#forgotStep1, #forgotStep2, #forgotStep3, #forgotStepSuccess').hide();
                if (stepNumber === 1) $('#forgotStep1').show();
                else if (stepNumber === 2) $('#forgotStep2').show();
                else if (stepNumber === 3) $('#forgotStep3').show();
                else if (stepNumber === 4) $('#forgotStepSuccess').show();
            }

            function openModal() {
                var currentVal = $('#username').val() ? $('#username').val().trim() : '';
                if (currentVal && currentVal.indexOf('@') !== -1) {
                    $('#forgotIdentifier').val(currentVal);
                } else {
                    $('#forgotIdentifier').val('');
                }
                showStep(1);
                $modal.css({'display': 'block', 'z-index': 1050}).addClass('show');
                $backdrop.show();
                $('body').addClass('modal-open');
                setTimeout(function() {
                    $('#forgotIdentifier').focus();
                }, 200);
            }

            function closeModal() {
                $modal.removeClass('show').hide();
                $backdrop.hide();
                $('body').removeClass('modal-open');
                if (resetVendorUsername) {
                    $('#username').val(resetVendorUsername);
                    $('#pwd').val('').focus();
                }
            }

            $('#openForgotModal').on('click', function(e) {
                e.preventDefault();
                openModal();
            });

            $('.close-forgot-modal, #modalCustomBackdrop').on('click', function(e) {
                e.preventDefault();
                closeModal();
            });

            $('.btnBackToStep1').on('click', function(e) {
                e.preventDefault();
                showStep(1);
            });

            function setBtnLoading($btn, isLoading) {
                if (isLoading) {
                    $btn.prop('disabled', true);
                    $btn.find('.btn-text').addClass('d-none');
                    $btn.find('.spinner-border').removeClass('d-none');
                } else {
                    $btn.prop('disabled', false);
                    $btn.find('.btn-text').removeClass('d-none');
                    $btn.find('.spinner-border').addClass('d-none');
                }
            }

            // Step 1: Send OTP
            $('#btnSendOtp, #btnResendOtp').on('click', function() {
                var $btn = $(this);
                var identifier = $('#forgotIdentifier').val() ? $('#forgotIdentifier').val().trim() : '';
                if (!identifier) {
                    showAlert('Please enter your registered email address.', true);
                    $('#forgotIdentifier').focus();
                    return;
                }

                setBtnLoading($btn, true);
                hideAlert();

                $.ajax({
                    url: '{{ route("vendor.forgot.send_otp") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        identifier: identifier
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        setBtnLoading($btn, false);
                        if (res.status === 'success') {
                            if (res.masked_email) {
                                $('#displayMaskedEmail').text(res.masked_email);
                            }
                            showStep(2);
                            showAlert(res.msg, false);
                            if (res.dev_otp) {
                                $('#forgotOtp').val(res.dev_otp);
                            } else {
                                $('#forgotOtp').val('').focus();
                            }
                        } else {
                            showAlert(res.msg || 'Unable to find seller account.', true);
                        }
                    },
                    error: function(xhr) {
                        setBtnLoading($btn, false);
                        var errMsg = 'Error sending verification code. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.msg) {
                            errMsg = xhr.responseJSON.msg;
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        }
                        showAlert(errMsg, true);
                    }
                });
            });

            // Step 2: Verify OTP
            $('#btnVerifyOtp').on('click', function() {
                var $btn = $(this);
                var otp = $('#forgotOtp').val() ? $('#forgotOtp').val().trim() : '';
                if (!otp || otp.length !== 6) {
                    showAlert('Please enter the valid 6-digit verification code.', true);
                    $('#forgotOtp').focus();
                    return;
                }

                setBtnLoading($btn, true);
                hideAlert();

                $.ajax({
                    url: '{{ route("vendor.forgot.verify_otp") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        otp: otp
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        setBtnLoading($btn, false);
                        if (res.status === 'success') {
                            showStep(3);
                            showAlert(res.msg, false);
                            $('#newVendorPassword').val('').focus();
                            $('#confirmVendorPassword').val('');
                        } else {
                            showAlert(res.msg || 'Invalid verification code.', true);
                        }
                    },
                    error: function(xhr) {
                        setBtnLoading($btn, false);
                        showAlert('Error verifying code. Please try again.', true);
                    }
                });
            });

            // Step 3: Reset Password
            $('#btnResetPassword').on('click', function() {
                var $btn = $(this);
                var newPassword = $('#newVendorPassword').val();
                var confirmPassword = $('#confirmVendorPassword').val();

                if (!newPassword || newPassword.length < 5) {
                    showAlert('New password must be at least 5 characters long.', true);
                    $('#newVendorPassword').focus();
                    return;
                }

                if (newPassword !== confirmPassword) {
                    showAlert('Passwords do not match. Please re-enter.', true);
                    $('#confirmVendorPassword').focus();
                    return;
                }

                setBtnLoading($btn, true);
                hideAlert();

                $.ajax({
                    url: '{{ route("vendor.forgot.reset") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        new_password: newPassword,
                        confirm_password: confirmPassword
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        setBtnLoading($btn, false);
                        if (res.status === 'success') {
                            resetVendorUsername = res.username || '';
                            showStep(4);
                        } else {
                            showAlert(res.msg || 'Unable to update password.', true);
                        }
                    },
                    error: function(xhr) {
                        setBtnLoading($btn, false);
                        showAlert('Error updating password. Please try again.', true);
                    }
                });
            });
        });
    </script>
@endsection
