@extends('front_end.app')
@section('content')
<div class="page-wrapper">
    @include('front_end.common.header')
        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>{{ $pageinfo->page_title }} </li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <!-- Start of Shop Banner -->
                   <h4> {{ $pageinfo->page_title }} </h4>

                  

                    <!-- Start of Shop Category -->
                    

                    <!-- Start of Shop Content -->
                    <div class="shop-content row gutter-lg mb-11">
                       
                        <!-- Start of Shop Main Content -->
                        <div class="main-content">
                             {!! $pageinfo->page_content !!}
                        </div>
                        <!-- End of Shop Main Content -->
                    </div>
                    <!-- End of Shop Content -->
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->
</div>
@endsection