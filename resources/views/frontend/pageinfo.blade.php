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

    <!-- Page Header -->
    <div class="page-header" style="background: linear-gradient(135deg, #172337 0%, #0088dd 100%); padding: 40px 0; text-align: left; color: #ffffff;">
        <div class="container">
            <h1 class="page-title text-white" style="font-size: 2.2rem; font-weight: 700; margin: 0;">
                {{ $pageinfo->page_title ?? 'Contact Us' }}
            </h1>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="page-content mt-10 mb-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-12">
                    @if($pageinfo)
                        <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 16px; overflow: hidden; background: #ffffff;">
                            <div class="card-body" style="padding: 40px 50px; line-height: 1.8; color: #444444; font-size: 1.1rem;">
                                {!! $pageinfo->page_content !!}
                            </div>
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
        </div>
    </div>
</main>
@endsection
