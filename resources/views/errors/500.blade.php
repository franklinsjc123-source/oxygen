@extends('errors.layout')

@section('title', '500 - Server Error | TryMeNow')

@section('content')
    <div class="icon-circle">
        <svg width="34" height="34" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
    </div>
    <div class="error-code">Error 500</div>
    <h1 class="error-title">Something went wrong</h1>
    <p class="error-desc">We experienced a temporary hiccup processing your request. Please try reloading or check back in a moment.</p>
    <div class="action-btns">
        <button onclick="window.location.reload();" class="btn btn-primary">
            🔄 Retry / Reload
        </button>
        <a href="{{ url('/seller/login') }}" class="btn btn-secondary">
            Go to Seller Dashboard
        </a>
    </div>
@endsection
