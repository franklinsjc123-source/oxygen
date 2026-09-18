@extends('app_template')
@section('title', $pageinfo->page_title ?? 'Page Info')
@section('content')
<main class="main">
    <!-- Breadcrumb Nav -->
    <nav class="breadcrumb-nav mb-4 mt-4">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ url('home') }}">Home</a></li>
                <li>{{ $pageinfo->page_name ?? 'Contact Us' }}</li>
            </ul>
        </div>
    </nav>

  
    <!-- Main Content Area -->
    <div class="page-content mt-4 mb-10">
        <div class="container">
            @if($pageinfo)
                <div style="line-height: 1.8; color: #444444; font-size: 1.1rem;">
                    {!! $pageinfo->page_content !!}
                </div>
            @else
                <div class="text-center py-10">
                    <i class="w-icon-exclamation-triangle" style="font-size: 4rem; color: #ff3366;"></i>
                    <h2 class="mt-4">Page Not Found</h2>
                    <p class="text-muted">The requested page could not be found or is inactive.</p>
                    <a href="{{ url('home') }}" class="btn btn-primary btn-rounded mt-4">Go Back Home</a>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
