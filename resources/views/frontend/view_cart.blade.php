 @extends('app_template')
@section('title','View Products')
@section('content')
<style>
    .shop-table.cart-table th,
    .shop-table.cart-table td {
        vertical-align: middle;
    }

    .shop-table.cart-table .product-image,
    .shop-table.cart-table .product-thumbnail {
        width: 120px;
    }

    .shop-table.cart-table .product-name {
        padding-left: 16px;
        text-align: left;
    }
</style>
 <!-- Start of Main -->
        <main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="active"><a href="#">Shopping Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="order.html">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-12 pr-lg-4 mb-6">
                            <table class="shop-table cart-table">
                                <thead>
                                    <tr>
                                        <th class="product-image"><span>Image</span></th>
                                        <th class="product-name">Product Name</th>
                                        <th class="product-price text-center"><span>Price</span></th>
                                        <th class="product-quantity text-center"><span>Quantity</span></th>
                                        <th class="product-subtotal text-center"><span>Subtotal</span></th>
                                    </tr>
                                </thead>
                                <tbody id="cartView">
                                    @include('frontend.show_cart', ['records' => $records ?? []])
                                </tbody>
                            </table>

                            <div class="cart-action mb-6">
                                <a href="{{url('/')}}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                              <a href="{{url('/checkoutPage')}}" class="btn btn-dark btn-rounded btn-shopping">
                                        Proceed to checkout<i class="w-icon-long-arrow-right"></i></a></div>

                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
 @endsection
