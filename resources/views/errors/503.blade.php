@extends('errors.layout')

@section('title', 'Under Maintenance | TryMeNow')

@section('content')
    <div class="icon-circle info">
        <svg width="34" height="34" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
        </svg>
    </div>
    <div class="error-code">Service Unavailable</div>
    <h1 class="error-title">Under Maintenance</h1>
    <p class="error-desc">We are currently performing scheduled maintenance or quick updates. We will be right back in a few minutes.</p>
    <div class="action-btns">
        <button onclick="window.location.reload();" class="btn btn-primary">
            🔄 Try Again
        </button>
    </div>
@endsection
