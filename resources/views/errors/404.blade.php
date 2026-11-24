@extends('errors.layout')

@section('title', '404 - Page Not Found | TryMeNow')

@section('content')
    <div class="icon-circle info">
        <svg width="34" height="34" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <div class="error-code">Error 404</div>
    <h1 class="error-title">Page Not Found</h1>
    <p class="error-desc">The page you were looking for doesn't exist or may have been moved.</p>
    <div class="action-btns">
        <a href="{{ url('/seller/login') }}" class="btn btn-primary">
            Go to Seller Dashboard
        </a>
    </div>
@endsection
