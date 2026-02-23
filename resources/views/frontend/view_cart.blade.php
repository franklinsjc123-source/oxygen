 @extends('app_template')
 @section('title','View Products')
 @section('content')
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
                                        <th class="product-price"><span>Price</span></th>
                                        <th class="product-quantity"><span>Quantity</span></th>
                                        <th class="product-subtotal"><span>Subtotal</span></th>
                                    </tr>
                                </thead>
                                <tbody id="cartView">
								<?php
                                    if(isset($records)){
                                       
                                    foreach ($records as $row) {
                                         $image = $row['attributes']['image'];
                                         //print_r($row);
                                        
                                    ?>

                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="product-default.html">
                                                    <figure>
                                                        <img src="<?= asset('assets/images/products/'.$image) ?>" alt="product"
                                                            width="300" height="338">
                                                    </figure>
                                                </a>
                                                <button type="button" class="btn btn-close" onclick="removeCart('<?= $row['id'] ?>')"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="#">
                                               {{ $row['name'] }}
                                            </a>
                                            @php
                                                $size = $row['attributes']['size'] ?? '';
                                                $color = $row['attributes']['color'] ?? '';
                                            @endphp
                                            @if($size || $color)
                                                <div class="text-muted" style="font-size: 12px;">
                                                    @if($size)
                                                        <span>Size: {{ $size }}</span>
                                                    @endif
                                                    @if($size && $color)
                                                        <span> | </span>
                                                    @endif
                                                    @if($color)
                                                        <span>Color: {{ $color }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                        <td class="product-price"><span class="amount">Rs.{{ $row['price'] }}</span></td>
                                        <td class="product-quantity">
                                            <div class="input-group">
                                                <input class="form-control" value="<?= $row['quantity'] ?>" type="number" min="1" max="100" id="quantity{{$row['id']}}" readonly> 
                                                <button class="w-icon-plus" onclick="updateQty('{{$row['id']}}','Add')"></button>
                                                <button class=" w-icon-minus" onclick="updateQty('{{$row['id']}}','Minus')"></button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">Rs.{{ $row['price'] * $row['quantity'] }}</span>
                                        </td>
                                    </tr>
									<?php } }else{ ?>                                       
                                        <tr data-id="1">
                                            <td colspan="5">
                                                <center><i class="d-icon-bag"></i> Your Cart is Empty</center>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
