 @extends('app_template')
 @section('title','Order Tracking')
 @section('content')

<style>
    #loading-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
    }

    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

    <div id="loading-container">
        <div class="loader"></div>
    </div>

    <!-- tracking page start -->
    <section class="tracking-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Status for Order No: {{$order_info->orders_id}}</h3>
                    <div class="wrapper">
                        @php
                            $statuses = ['Placed', 'Accept', 'Dispatch', 'Delivered'];
                            $labels = ['Order Placed', 'Preparing to Ship', 'Shipped', 'Delivered'];
                            $currentIndex = array_search($order_info->order_status, $statuses);
                            if ($currentIndex === false) $currentIndex = -1;
                        @endphp
                        <div class="arrow-steps clearfix">
                            @foreach($statuses as $i => $status)
                                <div class="step {{ $i < $currentIndex ? 'done' : '' }} {{ $i == $currentIndex ? 'done current' : '' }}">
                                    <span>{{ $labels[$i] }}</span>
                                </div>
                            @endforeach
                            @if($order_info->order_status == 'Return')
                                <div class="step current"><span>Returned</span></div>
                            @endif
                            @if($order_info->order_status == 'Cancel')
                                <div class="step current"><span>Canceled</span></div>
                            @endif
                        </div>
                    </div>
                    <div class="row border-part">
                        <div class="col-xl-2 col-md-3 col-sm-4">
                            <div class="product-detail">
                                @if(isset($order_products) && $order_products->count() > 0)
                                    <img src="{{ asset('assets/images/products/' . $order_products->first()->product_image) }}" class="img-fluid blur-up lazyload" alt="{{ $order_products->first()->product_name }}">
                                @else
                                    <img src="{{ asset('assets/images/fashion/pro/1.jpg') }}" class="img-fluid blur-up lazyload" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-sm-8">
                            <div class="tracking-detail">
                                <ul>
                                   
                                    <li>
                                        <div class="left">
                                            <span>Customer number</span>
                                        </div>
                                        <div class="right">
                                            <span>{{$order_info->orders_id}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>order date</span>
                                        </div>
                                        <div class="right">
                                            
                                            <span> {{ date('d M Y',strtotime($order_info->order_date)) }}</span>
                                        </div>
                                    </li>
                                    @if($order_info->delivery_date!=null)
                                    <li>
                                        <div class="left">
                                            <span>Ship Date</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ date('d M Y',strtotime($order_info->delivery_date)) }}</span>
                                        </div>
                                    </li>
                                    @else
                                    <li>
                                        <div class="left">
                                            <span>Expected Date</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ date('d M Y',strtotime($order_info->order_date. " +7 days")) }}</span>
                                        </div>
                                    </li>
                                    @endif
                                    <li>
                                        <div class="left">
                                            <span>Shipping Address</span>
                                        </div>
                                        <div class="right">
                                            <ul class="order-detail">
                                                <li>Name:{{$order_info->firstname}}{{$order_info->lastname}}</li>
                                                <li>Address: {{$order_info->address}}</li>
                                                <li>Town:{{$order_info->town}}</li>
                                                
                                                <li>State:{{$order_info->state}}</li>
                                                <li>Country:{{$order_info->country}}</li>
                                                <li>Contact No:{{$order_info->phone}}</li>
                                            </ul>
                                    
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tracking page end -->

@endsection