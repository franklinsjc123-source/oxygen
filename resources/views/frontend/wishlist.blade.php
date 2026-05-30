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
                                            <a href="{{url('productVar',$product->ecom_product_id)}}">
                                                <figure>
                                                    <img src="{{ asset('assets/images/products/' . $product->product_image) }}"  alt="product" style="width:80px; height:80px; object-fit:contain; margin:0 auto;">
                                                </figure>
                                            </a>
                                            {{-- <a   href="{{url('Delete_wishlist',$product->ecom_wishlist_id)}}" class="btn btn-close"><i
                                                    class="fas fa-times"></i></a> --}}
                                        </div>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;" class="product-name">
                                        <a href="{{url('productVar',$product->ecom_product_id)}}">
                                        {{ $product->product_name }}
                                        </a>
                                    </td>
                                    <td  style="text-align: center; vertical-align: middle;" class="product-price"><ins class="new-price">Rs. {{ $product->selling_price }} <del><span class="currencySymbol">Rs.</span> {{ $product->retail_price }} </del></ins></td>
                                    <td  style="text-align: center; vertical-align: middle; white-space: nowrap;" >
                                        <span class="wishlist-in-stock">In Stock</span>
                                    </td>
                                    <td  style="text-align: center; vertical-align: middle;" class="wishlist-action">
                                        <div style="display: flex; justify-content: center; gap: 10px; align-items: center; flex-wrap: wrap;">
                                            <a href="{{url('delete_wishlist',$product->ecom_wishlist_id)}}"
                                                class="btn btn-default btn-rounded btn-sm">Remove 
                                                </a>
                                            <a href="{{url('productVar',$product->ecom_product_id)}}" class="btn btn-dark btn-rounded btn-sm btn-cart">View</a>
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