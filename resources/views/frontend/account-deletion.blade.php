@extends('app_template')
@section('title', 'Account Deletion Request - Play Store Compliance')
@section('content')
<style>
    /* Google Play Store Account Deletion Page Styling */
    .deletion-hero-header {
        background: linear-gradient(135deg, #6366f1 0%, #7c3aed 50%, #4f46e5 100%);
        padding: 50px 20px 80px;
        text-align: center;
        color: #ffffff;
        position: relative;
    }
    .deletion-hero-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        letter-spacing: -0.02em;
    }
    
    .deletion-main-container {
        max-width: 580px;
        margin: -50px auto 60px;
        padding: 0 15px;
        position: relative;
        z-index: 10;
    }
    
    .deletion-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 20px 30px rgba(15, 23, 42, 0.08), 0 4px 10px rgba(15, 23, 42, 0.03);
        padding: 36px 32px;
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    
    .deletion-title-wrapper {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }
    .deletion-title-accent {
        width: 4px;
        height: 24px;
        background-color: #6366f1;
        border-radius: 2px;
        margin-right: 12px;
        display: inline-block;
        flex-shrink: 0;
    }
    .deletion-card-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    
    .deletion-card-description {
        font-size: 0.925rem;
        color: #475569;
        line-height: 1.5;
        margin-bottom: 24px;
    }
    
    .deletion-form-box {
        background: #fef2f2;
        border: 1px solid #fee2e2;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 28px;
    }
    
    .deletion-form-group {
        margin-bottom: 0;
    }
    
    .deletion-label {
        display: block;
        font-weight: 600;
        color: #1e293b;
        font-size: 0.875rem;
        margin-bottom: 8px;
    }
    
    .deletion-input {
        width: 100%;
        padding: 13px 16px;
        font-size: 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #ffffff;
        color: #0f172a;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    .deletion-input:focus {
        border-color: #ef4444;
        outline: none;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
    }
    
    .btn-permanently-delete {
        width: 100%;
        background: #ef4444;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.975rem;
        border: none;
        border-radius: 8px;
        padding: 14px 20px;
        margin-top: 16px;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.1s, box-shadow 0.2s;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-permanently-delete:hover {
        background: #dc2626;
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
    }
    .btn-permanently-delete:active {
        transform: scale(0.99);
    }
    .btn-permanently-delete:disabled {
        background: #9ca3af;
        cursor: not-allowed;
        box-shadow: none;
    }
    
    .deletion-important-box {
        border: 1.5px dashed #cbd5e1;
        background: #f8fafc;
        border-radius: 14px;
        padding: 22px 24px;
    }
    
    .important-heading {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 0;
        margin-bottom: 16px;
    }
    
    .important-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .important-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 0.885rem;
        color: #475569;
        line-height: 1.55;
        margin-bottom: 14px;
    }
    .important-item:last-child {
        margin-bottom: 0;
    }
    
    .checkmark-icon {
        color: #10b981;
        font-weight: 800;
        font-size: 1.1rem;
        flex-shrink: 0;
        margin-top: 1px;
    }
    
    .alert-status-box {
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 0.925rem;
        line-height: 1.5;
        display: none;
    }
    .alert-status-box.alert-success {
        background-color: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        display: block;
    }
    .alert-status-box.alert-danger {
        background-color: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
        display: block;
    }
    
    /* Spinner */
    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: 0.15em;
        border: 2px solid #ffffff;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
        display: inline-block;
        margin-right: 8px;
    }
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }
    
    @media (max-width: 576px) {
        .deletion-card {
            padding: 24px 18px;
        }
        .deletion-form-box {
            padding: 18px 14px;
        }
        .deletion-hero-header h1 {
            font-size: 1.75rem;
        }
    }
</style>

<main class="deletion-page-wrapper">
    <!-- Purple Header Banner -->
    <div class="deletion-hero-header">
        <div class="container">
            <h1>Account Deletion Request</h1>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="deletion-main-container">
        <div class="deletion-card">

            <!-- Server Flash Messages -->
            @if(session('success'))
                <div class="alert-status-box alert-success">
                    <strong>Success:</strong> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-status-box alert-danger">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            <!-- Dynamic AJAX Response Box -->
            <div id="deletionResponseAlert" class="alert-status-box"></div>

            <!-- Header Section -->
            <div class="deletion-title-wrapper">
                <span class="deletion-title-accent"></span>
                <h2 class="deletion-card-title">Delete your account</h2>
            </div>
            <p class="deletion-card-description">
                Please enter your registered mobile number below to delete your account and all associated data.
            </p>

            <!-- Deletion Form Box -->
            <div class="deletion-form-box">
                <form id="accountDeletionForm" action="{{ route('account.deletion.process') }}" method="POST">
                    @csrf
                    <div class="deletion-form-group">
                        <label for="customer_mobileno" class="deletion-label">Phone Number (10 Digits)</label>
                        <input 
                            type="tel" 
                            name="customer_mobileno" 
                            id="customer_mobileno" 
                            class="deletion-input" 
                            placeholder="E.g. 9876543210" 
                            maxlength="10" 
                            pattern="[0-9]{10}"
                            required 
                            autocomplete="tel"
                        >
                        <button type="submit" id="btnDeleteAccount" class="btn-permanently-delete">
                            <span id="btnDeleteText">Permanently Delete Account</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Important Information Section -->
            <div class="deletion-important-box">
                <h3 class="important-heading">Important Information</h3>
                <ul class="important-list">
                    <li class="important-item">
                        <span class="checkmark-icon">✓</span>
                        <span>Your account information (name, phone number, email) will be <strong>permanently deleted.</strong></span>
                    </li>
                    <li class="important-item">
                        <span class="checkmark-icon">✓</span>
                        <span>Order history may be retained for legal and accounting purposes for a limited time as required by law.</span>
                    </li>
                    <li class="important-item">
                        <span class="checkmark-icon">✓</span>
                        <span>After deletion, your data <strong>cannot be recovered.</strong></span>
                    </li>
                    <li class="important-item">
                        <span class="checkmark-icon">✓</span>
                        <span>Deletion requests are processed instantly and data removal takes <strong>3–5 working days.</strong></span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('accountDeletionForm');
    const input = document.getElementById('customer_mobileno');
    const submitBtn = document.getElementById('btnDeleteAccount');
    const btnText = document.getElementById('btnDeleteText');
    const responseAlert = document.getElementById('deletionResponseAlert');

    // Filter input to allow numbers only
    input.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const mobile = input.value.trim();
        if (mobile.length !== 10) {
            showAlert('danger', 'Please enter a valid 10-digit mobile number.');
            input.focus();
            return;
        }

        // Confirm deletion intent
        if (!confirm('Are you sure you want to permanently delete your account registered with ' + mobile + '? This action cannot be undone.')) {
            return;
        }

        // Set loading state
        submitBtn.disabled = true;
        btnText.innerHTML = '<span class="spinner-border-sm"></span> Processing Deletion...';
        responseAlert.style.display = 'none';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            const data = await response.json();
            if (response.ok && data.status === 'success') {
                showAlert('success', data.message);
                form.reset();
            } else {
                showAlert('danger', data.message || 'Account deletion failed. Please check the mobile number and try again.');
            }
        })
        .catch(error => {
            console.error('Account deletion error:', error);
            showAlert('danger', 'An unexpected error occurred while processing your request. Please try again.');
        })
        .finally(() => {
            submitBtn.disabled = false;
            btnText.textContent = 'Permanently Delete Account';
        });
    });

    function showAlert(type, message) {
        responseAlert.className = 'alert-status-box alert-' + type;
        responseAlert.innerHTML = '<strong>' + (type === 'success' ? 'Success:' : 'Error:') + '</strong> ' + message;
        responseAlert.style.display = 'block';
        responseAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
});
</script>
@endsection
