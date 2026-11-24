@extends('errors.layout')

@section('title', 'Session Expired | TryMeNow')

@section('content')
    <div class="icon-circle warning">
        <svg width="34" height="34" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <div class="error-code">Session Timeout</div>
    <h1 class="error-title">Your Session Expired</h1>
    <p class="error-desc">For your account security, your session has timed out due to inactivity. Please log in again to continue.</p>
    <div class="action-btns">
        <a href="{{ url('/seller/login') }}" class="btn btn-primary">
            🔐 Log In to Seller Portal
        </a>
    </div>
@endsection
