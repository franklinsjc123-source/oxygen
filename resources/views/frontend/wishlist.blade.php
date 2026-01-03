@extends('app_template')
@section('title','My Wishlist')
@section('content')

<main class="main wishlist-page">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Wishlist</h1>
        </div>
    </div>

    <nav class="breadcrumb-nav mb-10">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('demoEight') }}">Home</a></li>
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
                        <th class="product-name"><span>Product</span></th>
                        <th class="product-name">Product Name</th>
                        <th class="product-price"><span>Price</span></th>
                        <th class="product-stock-status"><span>Stock Status</span></th>
                        <th class="wishlist-action">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=0; @endphp
                                @if($wishCount>0)
                                @foreach ($wishlist as $product)
                                @php  $i++; $images=explode(',',$product->product_detail_image);  $img=substr($images[0], 2, -1);       @endphp
                                
                                <tr>
                                    <td style="text-align: center;" class="product-thumbnail">
                                        <div class="p-relative">
                                            <a href="{{url('productVar',$product->ecom_product_id)}}">
                                                <figure>
                                                    <img src="{{ asset('assets/images/products/detail') . '/' . $img }}"  alt="product" width="300"
                                                        height="338">
                                                </figure>
                                            </a>
                                            {{-- <a   href="{{url('Delete_wishlist',$product->ecom_wishlist_id)}}" class="btn btn-close"><i
                                                    class="fas fa-times"></i></a> --}}
                                        </div>
                                    </td>
                                    <td style="text-align: center;" class="product-name">
                                        <a href="{{url('productVar',$product->ecom_product_id)}}">
                                        {{ $product->product_name }}
                                        </a>
                                    </td>
                                    <td  style="text-align: center;" class="product-price"><ins class="new-price">Rs. {{ $product->selling_price }} <del><span class="currencySymbol">Rs.</span> {{ $product->retail_price }} </del></ins></td>
                                    <td  style="text-align: center;" class="product-stock-status">
                                        <span class="wishlist-in-stock">In Stock</span>
                                    </td>
                                    <td  style="text-align: center;" class="wishlist-action">
                                        <div class="d-lg-flex">
                                            <a href="{{url('delete_wishlist',$product->ecom_wishlist_id)}}"
                                                class="btn btn-default btn-rounded btn-sm mb-2 mb-lg-0">Remove 
                                                </a>
                                            <a href="{{url('productVar',$product->ecom_product_id)}}" class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to
                                                cart</a>
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
                                <tr class="cart_item wrap-buttons">
                                    <td class="wrap-btn-control" colspan="4">
                                        <a href="{{ url('/demoEight') }}" class="btn back-to-shop">Back to Shop</a>
                                    </td>
                                </tr>
                </tbody>
            </table>
            <div class="social-links">
                <label>Share On:</label>
                <div class="social-icons social-no-color border-thin">
                    <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                    <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                    <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                    <a href="#" class="social-icon social-email far fa-envelope"></a>
                    <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                </div>
            </div>
        </div>
    </div>

</main>
        
@endsection