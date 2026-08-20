@extends('app_template')

@section('title', 'Categories - Tryneww')

@section('content')
<main class="main">
    <nav class="breadcrumb-nav" style="margin-bottom: 0;">
        <div class="container">
            <ul class="breadcrumb" style="padding: 10px 0 0 0;">
                <li><a href="{{ url('home') }}">Home</a></li>
                <li>Categories</li>
            </ul>
        </div>
    </nav>

    <!-- Start of Page Content -->
    <div class="page-content" style="padding: 10px 0; background: #fafafa;">
        <div class="container">
            @foreach($categorymain as $mainCat)
                @if(count($mainCat->submenu) > 0)
                    <div class="category-section mb-10" style="margin-bottom: 50px;">
                        <h2 class="title" style="font-size: 20px; font-weight: 700; color: #222; border-bottom: 2px solid #ddd; padding-bottom: 12px; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $mainCat->category_main_name }}
                        </h2>
                        
                        <div class="category-grid">
                            @foreach($mainCat->submenu as $cat)
                                <div class="category-wrap text-center" style="background: #fff; border: 1px solid #e5e5e5; border-radius: 8px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.02); height: 100%;">
                                    <a href="{{ url('category/' . ($cat->slug ?? $cat->id)) }}" style="display: block; text-decoration: none; color: inherit; height: 100%;">
                                        <div class="category-img-container">
                                            @if($cat->category_image)
                                                <img src="{{ asset('assets/images/category/' . $cat->category_image) }}" alt="{{ $cat->category_name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                            @else
                                                <img src="{{ asset('frontend/images/favicon.png') }}" alt="{{ $cat->category_name }}" style="width: 50px; opacity: 0.4;">
                                            @endif
                                        </div>
                                        <div class="category-info" style="padding: 10px 5px;">
                                            <h3 class="category-title" style="font-size: 13px; font-weight: 600; color: #333; margin: 0; text-transform: capitalize; transition: color 0.25s ease;">
                                                {{ $cat->category_name }}
                                            </h3>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</main>

<style>
    .breadcrumb-nav {
        border-bottom: 0 !important;
    }
    .breadcrumb {
        border-bottom: 0 !important;
    }
    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }
    @media (min-width: 768px) {
        .category-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
    }
    @media (min-width: 992px) {
        .category-grid {
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }
    }
    .category-img-container {
        aspect-ratio: 1;
        width: 100%;
        overflow: hidden;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .category-wrap {
        cursor: pointer;
    }
    .category-wrap:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.08) !important;
        border-color: #0088dd !important;
    }
    .category-wrap:hover img {
        transform: scale(1.08);
    }
    .category-wrap:hover .category-title {
        color: #0088dd !important;
    }
</style>
@endsection
