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
                                        <img src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt="Logo" style="width: 175px; max-width: 100%; height: auto;">
                                    </a>
                                </div>

                                <div class="portal-nav d-flex justify-content-center mb-4" style="background: #f1f2f6; padding: 5px; border-radius: 15px;">
                                    <a href="{{ url('/admin/login') }}" style="flex: 1; text-align: center; padding: 10px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 1rem; {{ request()->is('*admin*') ? 'background: #fff; color: #1e3799; box-shadow: 0 2px 10px rgba(0,0,0,0.1);' : 'color: #747d8c;' }}">Admin</a>
                                    <a href="{{ url('/staff/login') }}" style="flex: 1; text-align: center; padding: 10px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 1rem; {{ request()->is('*staff*') ? 'background: #fff; color: #1e3799; box-shadow: 0 2px 10px rgba(0,0,0,0.1);' : 'color: #747d8c;' }}">Staff</a>
                                </div>
                                @if(@$error)
                                    <h6 style="color:#ff4d4d;" class="text-center mb-2">{{ @$error }}</h6>
                                @endif
                                <h3 class="text-center mb-3" style="font-weight: 700; letter-spacing: 1px; text-transform: uppercase; font-size: 1.5rem; color: #1e3799;">Staff Portal</h3>
                                
                                <form action="{{ route('stafflogin') }}" method="post" id="staffLoginForm">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="username" style="font-weight: 500; opacity: 0.9; margin-bottom: 5px; display: block; font-size: 1.2rem; color: #555;">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{ request()->cookie('remember_staff_username') ?? Cookie::get('remember_staff_username') ?? old('username') }}" placeholder="Enter username" required style="border-radius: 10px; padding: 12px 15px; border: 1px solid #ddd; background: #f9f9f9; color: #333; font-size: 1.2rem;">
                                    </div>

                                    <div class="form-group mb-3 position-relative">
                                        <label for="pwd" style="font-weight: 500; opacity: 0.9; margin-bottom: 5px; display: block; font-size: 1.2rem; color: #555;">Password</label>
                                        <div style="position: relative;">
                                            <input type="password" class="form-control" id="pwd" name="password" value="{{ request()->cookie('remember_staff_password') ?? Cookie::get('remember_staff_password') ?? '' }}" placeholder="Enter password" required style="border-radius: 10px; padding: 12px 45px 12px 15px; border: 1px solid #ddd; background: #f9f9f9; color: #333; font-size: 1.2rem;">
                                            <i class="fa fa-eye-slash" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"></i>
                                        </div>
                                    </div>

                                    <div class="form-terms d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1" {{ (request()->hasCookie('remember_staff_check') || Cookie::has('remember_staff_check') || request()->hasCookie('remember_staff_username') || Cookie::has('remember_staff_username') || old('remember')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember" style="font-size: 1.15rem; opacity: 0.9; color: #555;">Remember me</label>
                                        </div>
                                        <a href="javascript:void(0)" id="openForgotModal" style="color: #4834d4; font-size: 0.95rem; text-decoration: none; font-weight: 600;">Forgot password?</a>
                                    </div>

                                    <div class="form-button text-center mt-4">
                                        <button type="submit" name="submit" class="btn w-100" style="background: linear-gradient(90deg, #4834d4 0%, #686de0 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; box-shadow: 0 4px 15px rgba(72, 52, 212, 0.4); text-transform: uppercase;">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Staff Forgot Password Modal -->
    <div class="modal fade" id="staffForgotModal" tabindex="-1" aria-labelledby="staffForgotModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px; margin: 1.75rem auto;">
            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.3); overflow: hidden; background: #fff;">
                <div class="modal-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #1e3799, #4834d4); color: #fff; padding: 20px 25px; border-bottom: none;">
                    <h5 class="modal-title mb-0" id="staffForgotModalLabel" style="font-weight: 700; font-size: 1.25rem; display: flex; align-items: center; gap: 10px; color: #fff;">
                        <i class="fa fa-key" style="font-size: 1.1rem;"></i> Reset Staff Password
                    </h5>
                    <button type="button" class="close-forgot-modal" aria-label="Close" style="opacity: 0.85; background: none; border: none; font-size: 1.75rem; color: #fff; line-height: 1; cursor: pointer; padding: 0;">&times;</button>
                </div>
                <div class="modal-body" style="padding: 25px 30px; background: #ffffff;">
                    <div id="forgotAlert" style="display: none; padding: 12px 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.95rem; line-height: 1.4;"></div>

                    <!-- STEP 1: Enter Identifier -->
                    <div id="forgotStep1">
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 20px; line-height: 1.5;">
                            Enter your staff <strong>Username</strong>, <strong>Employee ID</strong>, or registered <strong>Email</strong> to receive a password reset verification code.
                        </p>
                        <div class="form-group mb-4">
                            <label for="forgotIdentifier" style="font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 1rem;">Username / Emp ID / Email</label>
                            <div style="position: relative;">
                                <input type="text" id="forgotIdentifier" class="form-control" placeholder="e.g. EMP001 or 100001" style="border-radius: 10px; padding: 12px 15px 12px 42px; border: 1px solid #ddd; background: #f9f9f9; font-size: 1.05rem; color: #333;">
                                <i class="fa fa-user" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #888;"></i>
                            </div>
                        </div>
                        <button type="button" id="btnSendOtp" class="btn w-100" style="background: linear-gradient(90deg, #4834d4 0%, #686de0 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; font-size: 1rem; box-shadow: 0 4px 15px rgba(72, 52, 212, 0.3);">
                            <span class="btn-text">Send Verification Code</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border-width: 0.15em;"></span>
                        </button>
                    </div>

                    <!-- STEP 2: Enter OTP -->
                    <div id="forgotStep2" style="display: none;">
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 20px; line-height: 1.5;">
                            Enter the 6-digit OTP code sent to your email: <br><strong id="displayMaskedEmail" style="color: #1e3799;"></strong>
                        </p>
                        <div class="form-group mb-3">
                            <label for="forgotOtp" style="font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 1rem;">6-Digit OTP Code</label>
                            <input type="text" id="forgotOtp" maxlength="6" class="form-control text-center" placeholder="123456" style="border-radius: 10px; padding: 12px; border: 1px solid #ddd; background: #f9f9f9; font-size: 1.5rem; letter-spacing: 8px; font-weight: 700; color: #1e3799;">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span style="font-size: 0.85rem; color: #888;">Didn't receive code?</span>
                            <a href="javascript:void(0)" id="btnResendOtp" style="font-size: 0.9rem; color: #4834d4; font-weight: 600; text-decoration: none;">Resend OTP</a>
                        </div>
                        <button type="button" id="btnVerifyOtp" class="btn w-100 mb-3" style="background: linear-gradient(90deg, #4834d4 0%, #686de0 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; font-size: 1rem; box-shadow: 0 4px 15px rgba(72, 52, 212, 0.3);">
                            <span class="btn-text">Verify Code</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border-width: 0.15em;"></span>
                        </button>
                        <div class="text-center">
                            <a href="javascript:void(0)" class="btnBackToStep1" style="color: #888; font-size: 0.9rem; text-decoration: none;"><i class="fa fa-arrow-left"></i> Change Username / Email</a>
                        </div>
                    </div>

                    <!-- STEP 3: Set New Password -->
                    <div id="forgotStep3" style="display: none;">
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 20px; line-height: 1.5;">
                            Create a new secure password for your staff account.
                        </p>
                        <div class="form-group mb-3 position-relative">
                            <label for="newStaffPassword" style="font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 1rem;">New Password</label>
                            <div style="position: relative;">
                                <input type="password" id="newStaffPassword" class="form-control" placeholder="Enter new password" style="border-radius: 10px; padding: 12px 45px 12px 15px; border: 1px solid #ddd; background: #f9f9f9; font-size: 1.05rem; color: #333;">
                                <i class="fa fa-eye-slash toggle-modal-pwd" data-target="newStaffPassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"></i>
                            </div>
                        </div>
                        <div class="form-group mb-4 position-relative">
                            <label for="confirmStaffPassword" style="font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 1rem;">Confirm New Password</label>
                            <div style="position: relative;">
                                <input type="password" id="confirmStaffPassword" class="form-control" placeholder="Confirm new password" style="border-radius: 10px; padding: 12px 45px 12px 15px; border: 1px solid #ddd; background: #f9f9f9; font-size: 1.05rem; color: #333;">
                                <i class="fa fa-eye-slash toggle-modal-pwd" data-target="confirmStaffPassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"></i>
                            </div>
                        </div>
                        <button type="button" id="btnResetPassword" class="btn w-100" style="background: linear-gradient(90deg, #10ac84 0%, #1dd1a1 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; font-size: 1rem; box-shadow: 0 4px 15px rgba(29, 209, 161, 0.4);">
                            <span class="btn-text">Reset Password</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border-width: 0.15em;"></span>
                        </button>
                    </div>

                    <!-- STEP 4: Success Message -->
                    <div id="forgotStepSuccess" style="display: none; text-align: center; padding: 15px 0;">
                        <div style="width: 70px; height: 70px; border-radius: 50%; background: #e8f8f5; color: #1dd1a1; display: inline-flex; align-items: center; justify-content: center; font-size: 2.2rem; margin: 0 auto 15px auto;">
                            <i class="fa fa-check"></i>
                        </div>
                        <h4 style="font-weight: 700; color: #1e3799; margin-bottom: 10px;">Password Reset!</h4>
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 25px; line-height: 1.5;">
                            Your staff password has been updated successfully. You can now log in with your new password.
                        </p>
                        <button type="button" class="btn w-100 close-forgot-modal" style="background: linear-gradient(90deg, #4834d4 0%, #686de0 100%); color: #fff; font-weight: 700; border-radius: 12px; padding: 12px; border: none; font-size: 1rem; box-shadow: 0 4px 15px rgba(72, 52, 212, 0.3);">
                            Proceed to Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Custom Backdrop Fallback -->
    <div id="modalCustomBackdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); z-index: 1040; backdrop-filter: blur(4px);"></div>

    <!-- Scripts -->
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
            var loginForm = document.getElementById('staffLoginForm');

            try {
                if (localStorage.getItem('remember_staff_check') === '1') {
                    if (rememberField) rememberField.checked = true;
                    if (usernameField && (!usernameField.value || usernameField.value.trim() === '')) {
                        var savedUser = localStorage.getItem('remember_staff_username');
                        if (savedUser) usernameField.value = savedUser;
                    }
                    if (passwordField && (!passwordField.value || passwordField.value.trim() === '')) {
                        var savedPass = localStorage.getItem('remember_staff_password');
                        if (savedPass) passwordField.value = savedPass;
                    }
                } else if (rememberField && rememberField.checked) {
                    localStorage.setItem('remember_staff_check', '1');
                    if (usernameField && usernameField.value) localStorage.setItem('remember_staff_username', usernameField.value);
                    if (passwordField && passwordField.value) localStorage.setItem('remember_staff_password', passwordField.value);
                }
            } catch(e) {}

            if (loginForm) {
                loginForm.addEventListener('submit', function() {
                    try {
                        if (rememberField && rememberField.checked) {
                            localStorage.setItem('remember_staff_check', '1');
                            if (usernameField) localStorage.setItem('remember_staff_username', usernameField.value);
                            if (passwordField) localStorage.setItem('remember_staff_password', passwordField.value);
                        } else {
                            localStorage.removeItem('remember_staff_check');
                            localStorage.removeItem('remember_staff_username');
                            localStorage.removeItem('remember_staff_password');
                        }
                    } catch(e) {}
                });
            }
        });

        // ══════════════════════════════════════════════════════════════
        // Staff Forgot Password Modal Interactive Workflow
        // ══════════════════════════════════════════════════════════════
        $(document).ready(function() {
            var $modal = $('#staffForgotModal');
            var $backdrop = $('#modalCustomBackdrop');
            var $alert = $('#forgotAlert');
            var resetStaffUsername = '';

            function showAlert(msg, isError) {
                $alert.css({
                    'display': 'block',
                    'background': isError ? '#ffebee' : '#e8f8f5',
                    'color': isError ? '#c62828' : '#00796b',
                    'border': '1px solid ' + (isError ? '#ffcdd2' : '#b2dfdb')
                }).html(msg);
            }

            function hideAlert() {
                $alert.hide().empty();
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
                var currentUsername = $('#username').val() ? $('#username').val().trim() : '';
                if (currentUsername) {
                    $('#forgotIdentifier').val(currentUsername);
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
                if (resetStaffUsername) {
                    $('#username').val(resetStaffUsername);
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
                    showAlert('Please enter your staff username, employee ID, or email.', true);
                    $('#forgotIdentifier').focus();
                    return;
                }

                setBtnLoading($btn, true);
                hideAlert();

                $.ajax({
                    url: '{{ route("staff.forgot.send_otp") }}',
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
                            showAlert(res.msg || 'Unable to find staff account.', true);
                        }
                    },
                    error: function(xhr) {
                        setBtnLoading($btn, false);
                        var errMsg = 'Unable to send OTP. Please check your connection and try again.';
                        if (xhr.responseJSON && xhr.responseJSON.msg) {
                            errMsg = xhr.responseJSON.msg;
                        }
                        showAlert(errMsg, true);
                    }
                });
            });

            // Step 2: Verify OTP
            $('#btnVerifyOtp').on('click', function() {
                var $btn = $(this);
                var otp = $('#forgotOtp').val() ? $('#forgotOtp').val().trim() : '';
                if (!otp || otp.length < 4) {
                    showAlert('Please enter the 6-digit OTP code received on email.', true);
                    $('#forgotOtp').focus();
                    return;
                }

                setBtnLoading($btn, true);
                hideAlert();

                $.ajax({
                    url: '{{ route("staff.forgot.verify_otp") }}',
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
                            $('#newStaffPassword').focus();
                        } else {
                            showAlert(res.msg || 'Invalid OTP code. Please try again.', true);
                        }
                    },
                    error: function(xhr) {
                        setBtnLoading($btn, false);
                        var errMsg = 'Invalid OTP code. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.msg) {
                            errMsg = xhr.responseJSON.msg;
                        }
                        showAlert(errMsg, true);
                    }
                });
            });

            // Step 3: Reset Password
            $('#btnResetPassword').on('click', function() {
                var $btn = $(this);
                var newPassword = $('#newStaffPassword').val();
                var confirmPassword = $('#confirmStaffPassword').val();

                if (!newPassword || newPassword.length < 5) {
                    showAlert('Password must be at least 5 characters long.', true);
                    $('#newStaffPassword').focus();
                    return;
                }

                if (newPassword !== confirmPassword) {
                    showAlert('New password and confirmation do not match.', true);
                    $('#confirmStaffPassword').focus();
                    return;
                }

                setBtnLoading($btn, true);
                hideAlert();

                $.ajax({
                    url: '{{ route("staff.forgot.reset") }}',
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
                            if (res.username) {
                                resetStaffUsername = res.username;
                            }
                            showStep(4);
                        } else {
                            showAlert(res.msg || 'Failed to reset password. Please try again.', true);
                        }
                    },
                    error: function(xhr) {
                        setBtnLoading($btn, false);
                        var errMsg = 'Failed to reset password. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.msg) {
                            errMsg = xhr.responseJSON.msg;
                        }
                        showAlert(errMsg, true);
                    }
                });
            });
        });
    </script>
@endsection
