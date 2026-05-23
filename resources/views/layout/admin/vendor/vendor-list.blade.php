@extends('layout.auth.master')
@section('contents')
<style>
    .table td, .table th {
        white-space: nowrap !important;
    }
</style>
    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu');
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.auth.sidemenu');
        <!-- Page Sidebar Ends-->

        <!-- Right sidebar Start-->

        <!-- Right sidebar Ends-->


        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Vendor Listings

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">User Listings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">

                <div class="row">

                    <div class="col-sm-12">

                        <div class="card">

                            <div class="card-body">
                                <a href="{{ route('vendorcreate.index') }}" class="btn  btn-primary"><i class="fa fa-plus"></i> Add
                                    vendor</a>



                                <table class="table" id="table" data-click-to-select="true" data-sort-name="id"
                                    data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"
                                    data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true"
                                    data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true"
                                    data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                                    <thead>
                                        <tr>
                                            <th data-field="sno" data-sortable="true">S.No.</th>
                                            <th data-field="image">IMAGE</th>
                                            <th data-field="shopdetails">SHOP DETAILS</th>
                                            <th data-field="vendordetails" data-sortable="true">VENDOR DETAILS</th>
                                            <th data-field="package" data-sortable="true">PACKAGE DETAILS</th>
                                            <th data-field="business" data-sortable="true">BUSINESS DETAILS</th>
                                            <th data-field="rm_sales" data-sortable="true">RM & SALES DETAILS</th>
                                            <th data-field="address" data-sortable="true">SHOP ADDRESS</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($vendorlist as $vendor_list)
                                            @php
                                                $zoneLabel = $vendor_list->zone;
                                                if (isset($zoneMap) && is_numeric($vendor_list->zone)) {
                                                    $zoneLabel = $zoneMap[(int) $vendor_list->zone] ?? $vendor_list->zone;
                                                }
                                            @endphp
                                            
                                            @php
                                                $vendor_id = DB::table('users')
                                                    ->join('vendor_details', 'users.id', '=', 'vendor_details.user_id')
                                                    ->where('users.id', $vendor_list->id)
                                                    ->first();
                                         //dd($vendor_id->login_id);
                                             
                                            @endphp
                                        <tr>
                                            <td style="white-space: nowrap;">
                                                <b>{{ str_pad($vendor_list->id, 4, '0', STR_PAD_LEFT) }}</b><br>
                                                <span class="text-secondary">{{ $zoneLabel }}</span><br>
                                                <span class="text-secondary">{{ $vendor_list->route }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <img src="{{ asset('assets/images/vendor/profile') . '/' . $vendor_list->profile_image  }}"
                                                        alt=""
                                                        class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                </div>
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <b>{{$vendor_list->shop_name}}</b><br>
                                                <span class="text-secondary">{{$vendor_list->owner_name}}</span><br>
                                                <span class="text-secondary">{{$vendor_list->business_category}}</span>
                                            </td>
                                            <td style="white-space: nowrap;"> 
                                                <span><b>{{$vendor_list->username ?? $vendor_list->owner_name}}</b></span><br>
                                                <span>{{$vendor_list->email }}</span><br>
                                                @if($vendor_list->mobile_number1)<span>+91 {{$vendor_list->mobile_number1 }}</span>@endif 
                                                @if($vendor_list->mobile_number2)<span> / +91 {{$vendor_list->mobile_number2 }}</span>@endif
                                            </td>
                                            
                                            @php 
                                                $userlist=DB::table('packages as packages')
                                                    ->join('vendor_details  as vendor_details', 'vendor_details.package_id', '=', 'packages.id')->where('package_id',$vendor_list->package_id )->first();
                                            @endphp
                                            <td style="white-space: nowrap;"> 
                                                <span><b> {{ $userlist->name ?? 'No Package' }}</b></span><br>
                                                <span>Partner since : {{ date('M d, Y', strtotime($vendor_list->created_at)) }}</span><br>
                                                <span>Renewal Date : {{ $vendor_list->next_renewal_date ? date('M d, Y', strtotime($vendor_list->next_renewal_date)) : '' }}</span>
                                            </td>
                                            
                                            @php
                                                $in_stock = DB::table('products')->where('vendor_id', $vendor_list->id)->count();
                                            @endphp
                                            <td style="white-space: nowrap;">
                                                <span>In-Stock : <b>{{ $in_stock }}</b></span><br>
                                                <span>Viewers : <b>{{ $vendor_list->view_count ?? 0 }}</b></span>
                                            </td>

                                            @php
                                                $rm_staff = DB::table('staffother')->where('id', $vendor_list->staff_id)->first();
                                                
                                                $total_orders = DB::table('ecom_order_product')
                                                    ->join('products', 'products.id', '=', 'ecom_order_product.product_id')
                                                    ->where('products.vendor_id', $vendor_list->id)
                                                    ->count();
                                                    
                                                $return_cancel = DB::table('ecom_order_product')
                                                    ->join('products', 'products.id', '=', 'ecom_order_product.product_id')
                                                    ->where('products.vendor_id', $vendor_list->id)
                                                    ->whereIn('ecom_order_product.order_status', ['Returned', 'Cancelled', 'Canceled', 'Cancel'])
                                                    ->count();
                                            @endphp
                                            <td style="white-space: nowrap;">
                                                <span>RM : <b>{{ $rm_staff->fullname ?? ($rm_staff->username ?? 'N/A') }}</b></span><br>
                                                <span>Total Orders : <b>{{ $total_orders }}</b></span><br>
                                                <span>Return / Cancel : <b>{{ $return_cancel }}</b></span>
                                            </td>

                                            <td style="white-space: nowrap;">
                                                <span>{{ $vendor_list->address }}</span><br>
                                                <span>{{ $vendor_list->address1 }}</span><br>
                                                <span>{{ $vendor_list->state }}, {{ $vendor_list->city }}, {{ $vendor_list->pincode }}</span>
                                            </td>



                                            <td>
                                                <div class="mt-2 d-flex">
                                                    
                                                    <form action="{{ route('vendorcreate.edit', $vendor_list->id) }}"
                                                        method="get">
                                                        @method('EDIT')
                                                        @csrf 
                                                    <button type="submit" class="btn btn-secondary mx-1">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                            </form>
                                                    {{-- <a href="#" class="badge badge-secondary px-2"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Edit"><i class="fa fa-pencil"></i> </a> --}}

                                                    {{-- <a href="#" onclick="return delete_maincategory()"
                                                        class="badge badge-warning px-2" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Delete"><i
                                                            class="fa fa-trash"></i></a> --}}
                                                       @if (session()->get('log_type') == 'Admin')
                                                        <form action="{{ route('vendorcreate.destroy', $vendor_list->id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning mx-1"
                                                                onclick="return confirm('Are you sure, you want to delete it?')"><i
                                                                    class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
														@endif
                                                </div>
                                            </td>

                                        </tr>

                                     
    @endforeach



                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </div>
@endsection

