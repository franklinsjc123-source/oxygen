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

    .shop-table.cart-table .product-remove {
        width: 140px;
    }

    .btn-action-remove {
        border: 1px solid #ff4b4b !important;
        color: #ff4b4b !important;
        background: transparent !important;
        transition: all 0.3s ease !important;
    }
    .btn-action-remove:hover {
        background: #ff4b4b !important;
        color: #fff !important;
    }

    .input-group button,
    .quantity-btn {
        position: relative !important;
        top: auto !important;
        right: auto !important;
        left: auto !important;
        transform: none !important;
        -webkit-transform: none !important;
        width: 22px !important;
        min-width: 22px !important;
        flex-shrink: 0 !important;
        height: 22px !important;
        font-size: 1.3rem !important;
        background: #0088dd !important;
        border-radius: 50% !important;
        border: none !important;
        box-shadow: 0 2px 4px rgba(0, 136, 221, 0.2) !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #ffffff !important;
        padding: 0 !important;
        margin: 0 4px !important;
        font-family: inherit !important;
        font-weight: bold !important;
        line-height: 1 !important;
    }
    .input-group button + button {
        margin-right: 0 !important;
    }

    /* ─── MOBILE SHOPPING CART CARD LAYOUT ─── */
    @media (max-width: 767px) {
        .cart .page-content .container {
            padding-left: 15px !important;
            padding-right: 15px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            max-width: 100% !important;
            width: 100% !important;
            overflow: visible !important;
        }

        .cart .page-content .row,
        .cart .page-content .col-lg-12 {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            width: 100% !important;
        }

        .cart .breadcrumb-nav {
            padding: 10px 0 !important;
            margin-bottom: 0 !important;
        }

        .cart .breadcrumb {
            padding: 5px 0 !important;
            margin-bottom: 0 !important;
            justify-content: center !important;
        }

        .cart .page-content {
            padding-top: 5px !important;
        }

        .cart .row.mb-10,
        .cart .col-lg-12.mb-6 {
            margin-bottom: 10px !important;
        }

        .shop-table.cart-table {
            border: none !important;
            width: 100% !important;
            overflow: visible !important;
        }

        .shop-table.cart-table thead {
            display: none !important;
        }

        .shop-table.cart-table tbody,
        .shop-table.cart-table tbody tr,
        .shop-table.cart-table tbody tr td {
            display: block !important;
            width: 100% !important;
            box-sizing: border-box !important;
            overflow: visible !important;
        }

        .shop-table.cart-table tbody tr {
            display: grid !important;
            grid-template-columns: 85px 1fr !important;
            grid-template-areas:
                "img name"
                "img price"
                "img qty"
                "img subtotal" !important;
            gap: 4px 12px !important;
            padding: 16px 0 !important;
            margin: 0 !important;
            border: none !important;
            border-bottom: 1px solid #f0f0f2 !important;
            background: #fff !important;
            position: relative !important;
            align-items: start !important;
        }

        /* ── Image (1st td) ── */
        .shop-table.cart-table tbody tr td:nth-child(1) {
            grid-area: img !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(1) .p-relative {
            width: 85px !important;
            height: 85px !important;
            background: #f5f6f8 !important;
            border-radius: 16px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            overflow: hidden !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(1) img {
            width: 65px !important;
            height: 65px !important;
            object-fit: contain !important;
            margin: 0 auto !important;
        }

        /* ── Product Name (2nd td) ── */
        .shop-table.cart-table tbody tr td:nth-child(2) {
            grid-area: name !important;
            padding: 0 !important;
            margin: 0 !important;
            text-align: left !important;
            font-size: 1.4rem !important;
            font-weight: 700 !important;
            color: #111 !important;
            line-height: 1.3 !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(2) a {
            color: #111 !important;
            font-weight: 700 !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(2) .text-muted {
            font-size: 1.1rem !important;
            color: #999 !important;
            font-weight: 400 !important;
        }

        /* ── Price (3rd td) ── */
        .shop-table.cart-table tbody tr td:nth-child(3) {
            grid-area: price !important;
            padding: 0 !important;
            margin: 0 !important;
            text-align: left !important;
            font-size: 1.5rem !important;
            font-weight: 800 !important;
            color: #111 !important;
        }

        /* ── Quantity (4th td) ── */
        .shop-table.cart-table tbody tr td:nth-child(4) {
            grid-area: qty !important;
            padding: 0 !important;
            margin: 0 !important;
            text-align: left !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(4) .input-group {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: auto !important;
            max-width: none !important;
            border: none !important;
            border-radius: 0 !important;
            overflow: visible !important;
            flex-wrap: nowrap !important;
            flex-direction: row !important;
            background: transparent !important;
            gap: 2px !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(4) .form-control {
            width: 24px !important;
            min-width: 24px !important;
            flex-shrink: 0 !important;
            height: 24px !important;
            text-align: center !important;
            font-size: 1.4rem !important;
            font-weight: 700 !important;
            padding: 0 !important;
            border: none !important;
            border-radius: 0 !important;
            background: transparent !important;
            color: #111 !important;
            -moz-appearance: textfield !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(4) .form-control::-webkit-inner-spin-button,
        .shop-table.cart-table tbody tr td:nth-child(4) .form-control::-webkit-outer-spin-button {
            -webkit-appearance: none !important;
            margin: 0 !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(4) .input-group button,
        .shop-table.cart-table tbody tr td:nth-child(4) button {
            position: relative !important;
            top: auto !important;
            right: auto !important;
            left: auto !important;
            transform: none !important;
            -webkit-transform: none !important;
            width: 22px !important;
            min-width: 22px !important;
            flex-shrink: 0 !important;
            height: 22px !important;
            font-size: 1.3rem !important;
            background: #0088dd !important;
            border-radius: 50% !important;
            border: none !important;
            box-shadow: 0 2px 4px rgba(0, 136, 221, 0.2) !important;
            cursor: pointer !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #ffffff !important;
            padding: 0 !important;
            margin: 0 2px !important;
            font-family: inherit !important;
            font-weight: bold !important;
            line-height: 1 !important;
        }

        /* ── Subtotal (5th td) ── */
        .shop-table.cart-table tbody tr td:nth-child(5) {
            grid-area: subtotal !important;
            display: block !important;
            padding: 4px 0 0 0 !important;
            margin: 0 !important;
            text-align: left !important;
            font-size: 1.3rem !important;
            font-weight: 700 !important;
            color: #111 !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(5)::before {
            content: "Subtotal: " !important;
            font-weight: 500 !important;
            color: #888 !important;
            font-size: 1.2rem !important;
        }

        /* ── Remove/Action (6th td) => X circle top-right ── */
        .shop-table.cart-table tbody tr td:nth-child(6) {
            position: absolute !important;
            top: 12px !important;
            right: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            width: auto !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(6) .btn-action-remove {
            width: 26px !important;
            height: 26px !important;
            min-width: 26px !important;
            background: #f0f0f2 !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #888 !important;
            font-size: 0 !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(6) .btn-action-remove i {
            display: none !important;
        }

        .shop-table.cart-table tbody tr td:nth-child(6) .btn-action-remove::after {
            content: "\00d7" !important;
            font-size: 18px !important;
            font-weight: 400 !important;
            line-height: 1 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            height: 100% !important;
            color: #888 !important;
            transform: translateY(-1px) !important;
        }

        /* Empty cart row */
        .shop-table.cart-table tbody tr[data-id] {
            display: block !important;
            text-align: center !important;
            padding: 40px 0 !important;
        }

        /* ── Cart Action Buttons ── */
        .cart-action.mb-6 {
            display: flex !important;
            flex-direction: column !important;
            align-items: stretch !important;
            width: 100% !important;
            gap: 12px !important;
            padding: 20px 0 !important;
        }
 
        .cart-action.mb-6 .btn {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 14px 20px !important;
            font-size: 1.3rem !important;
        }
    }

    .cart-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        padding: 20px 0;
    }

    .cart-action .btn-continue-shopping {
        font-size: 1.3rem;
        text-transform: uppercase;
        font-weight: 700;
        padding: 12px 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        max-width: 240px;
    }

    .cart-action .btn-proceed-checkout {
        font-size: 1.3rem;
        text-transform: uppercase;
        font-weight: 700;
        padding: 12px 24px;
        background-color: #0088dd !important;
        border-color: #0088dd !important;
        color: #fff !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        max-width: 240px;
    }
</style>
 <!-- Start of Main -->
        <main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="active"><a href="#">Shopping Cart</a></li>
                        <li><a href="{{url('/checkoutPage')}}">Checkout</a></li>
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
                                        <th class="product-remove"><span>Action</span></th>
                                    </tr>
                                </thead>
                                <tbody id="cartView">
                                    @include('frontend.show_cart', ['records' => $records ?? []])
                                </tbody>
                            </table>

                            <div class="cart-action mb-6">
                                <a href="{{url('/')}}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping btn-continue-shopping"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                                <a href="{{url('/checkoutPage')}}" class="btn btn-dark btn-rounded btn-shopping btn-proceed-checkout">Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                            </div>

                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
 @endsection
