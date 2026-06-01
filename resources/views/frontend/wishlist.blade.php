@extends('app_template')
@section('title','My Wishlist')
@section('content')

<main class="main wishlist-page">

    <nav class="breadcrumb-nav mb-10">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Wishlist</li>
            </ul>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <h3 class="wishlist-title">My Wishlist</h3>
            <table class="shop-table wishlist-table">
                <thead>
                    <tr>
                        <th class="product-name" style="text-align: center; width: 12%;"><span>Product</span></th>
                        <th class="product-name" style="text-align: center; width: 33%;">Product Name</th>
                        <th class="product-price" style="text-align: center; width: 15%;"><span>Price</span></th>
                        <th class="" style="text-align: center; width: 20%;"><span>Stock Availability</span></th>
                        <th class="wishlist-action" style="text-align: center; width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=0; @endphp
                                @if($wishCount>0)
                                @foreach ($wishlist as $product)
                                @php  $i++; @endphp
                                
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;" class="product-thumbnail">
                                        <div class="p-relative">
                                            <a href="{{url('products', $product->slug ?? $product->ecom_product_id)}}">
                                                <figure>
                                                    <img src="{{ asset('assets/images/products/' . $product->product_image) }}" alt="product" style="width:55px; height:55px; object-fit:contain; margin:0 auto;">
                                                </figure>
                                            </a>
                                            {{-- <a   href="{{url('Delete_wishlist',$product->ecom_wishlist_id)}}" class="btn btn-close"><i
                                                    class="fas fa-times"></i></a> --}}
                                        </div>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;" class="product-name">
                                        <a href="{{url('products', $product->slug ?? $product->ecom_product_id)}}">
                                        {{ $product->product_name }}
                                        </a>
                                    </td>
                                    <td  style="text-align: center; vertical-align: middle;" class="product-price">
                                        @php
                                            $retailPrice = (float) ($product->retail_price ?? 0);
                                            $sellingPrice = (float) ($product->selling_price ?? 0);
                                            if ($retailPrice > 0) {
                                                $discount_percentage = (($retailPrice - $sellingPrice) / $retailPrice) * 100;
                                                $discount_rounded = round($discount_percentage / 10) * 10;
                                            } else {
                                                $discount_rounded = 0;
                                            }
                                        @endphp
                                        <ins class="new-price" style="text-decoration: none;">
                                            <span style="font-family: Arial, sans-serif;">₹</span> {{ $product->selling_price }} 
                                            <del style="font-size: 0.8em; color: #888; font-weight: 400; margin: 0 4px;"><span class="currencySymbol" style="font-family: Arial, sans-serif;">₹</span> {{ $product->retail_price }}</del> 
                                            <span style="color: #27ae60; font-weight: 700; font-size: 1.4rem; margin-left: 5px;">{{ $discount_rounded }}% Off</span>
                                        </ins>
                                    </td>
                                    <td  style="text-align: center; vertical-align: middle; white-space: nowrap;" >
                                        <span class="wishlist-in-stock">In Stock</span>
                                    </td>
                                    <td  style="text-align: center; vertical-align: middle;" class="wishlist-action">
                                        <div style="display: flex; justify-content: center; gap: 10px; align-items: center; flex-wrap: wrap;">
                                            <a href="{{url('delete_wishlist',$product->ecom_wishlist_id)}}"
                                                class="btn btn-default btn-rounded btn-sm">Remove 
                                                </a>
                                            <a href="{{url('products', $product->slug ?? $product->ecom_product_id)}}" class="btn btn-dark btn-rounded btn-sm btn-cart">View</a>
                                        </div>
                                    </td>
                                </tr>
                    
                                @endforeach
                                @else
                                <tr data-id="1">
                                    <td colspan="5">
                                        <center><i class="d-icon-bag"></i> Your Wishlist is Empty</center>
                                    </td>
                                </tr>
                                @endif
                </tbody>
            </table>
            
            <div class="wishlist-actions mt-4 mb-4">
                <a href="{{ url('/home') }}" class="btn back-to-shop btn-dark btn-rounded">Back to Shop</a>
            </div>
        </div>
    </div>

</main>
        
@endsection