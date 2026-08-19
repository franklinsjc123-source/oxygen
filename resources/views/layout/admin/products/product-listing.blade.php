@extends('layout.auth.master')
@section('contents')
    @include('paritials.css.product.productlist-css')
    @include('paritials.js.product.product-list-js')
    @include('paritials.css.display-css')



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
        <style>
        /*            icon-shape {*/
        /*    display: inline-flex;*/
        /*    align-items: center;*/
        /*    justify-content: center;*/
        /*    text-align: center;*/
        /*    vertical-align: middle;*/
        /*}*/

        /*    .icon-sm {*/
        /*        width: 2rem;*/
        /*        height: 2rem;*/
                
        /*    }*/


            .handle-counter { overflow: hidden; }

                .handle-counter .counter-minus,  .handle-counter .counter-plus,  .handle-counter input {
                float: left;
                text-align: center;
                }

                .handle-counter .counter-minus,  .handle-counter .counter-plus { text-align: center; }

                .handle-counter input {
                width: 50px;
                border-width: 1px;
                border-left: none;
                border-right: none;
                }

                /*.btn {*/
                /*padding: 6px 12px;*/
                /*border: 1px solid transparent;*/
                /*color: #fff;*/
                /*}*/

                /*.btn:disabled, .btn:disabled:hover {*/
                /*background-color: darkgrey;*/
                /*cursor: not-allowed;*/
                /*}*/

                /*.btn-primary { background-color: #009dda; }*/

                /*.btn-primary:hover, .btn-primary:focus { background-color: #0486b9; }*/
                
                .action-buttons-container {
                    display: flex;
                    gap: 8px;
                    overflow-x: auto;
                    white-space: nowrap;
                    padding-bottom: 10px;
                    margin-left: 15px;
                    margin-right: 15px;
                }
                
                .action-buttons-container .btn {
                    white-space: nowrap;
                }
                
                @media (max-width: 768px) {
                    .action-buttons-container .btn {
                        padding: 4px 8px;
                        font-size: 12px;
                    }
                }
            </style>

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid fcolor">
                <div class="page-header m-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Product Listings

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a>
                                </li>
                                <li class="breadcrumb-item active">Product Listings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid fcolor">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="mt-3 action-buttons-container" id="toolbar">
                                <a href="{{ route('products.crud.index') }}">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add
                                        Product
                                    </button>
                                </a>

                                <button class="btn border-warning text-warning delete">Delete</button>
                                <button class="btn border-success text-success active">Active</button>
                                <button class="btn border-danger text-danger deactive">De-Active</button>
                            </div>

                            <div class="pt-3 px-3">
                                <a href="{{ route('product.export') }}" class="btn btn-success px-2 float-right" style="float: right;" data-toggle="tooltip" data-placement="top" title="Report" data-original-title="Report">
                                    <i class="fa fa-list"></i> Download Report
                                </a>
                                <div class="clearfix"></div>
                            </div>
                            
                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id"
                                    data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"
                                    data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true"
                                    data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true"
                                    data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                                    <thead>
                                        <tr class="">
                                            <th><input type="checkbox" class ="checkbox" id="checkboxesMain"></th>
                                            
                                            <th style="width: 10%" data-field="PId" data-sortable="true">PRODUCT Id</th>
                                            
                                            <th style="width: 10%" data-field="id" data-sortable="true">IMAGE</th>
                                            <th style="width: 5%" data-field="pname" data-sortable="true">PRODUCT NAME</th>
                                            <th style="width: 5%" data-field="stock" data-sortable="true" class="">STOCK</th>
                                             {{-- <th style="width: 5%" data-field="offer" data-sortable="true">PRICE </th> --}}
                                            <th style="width: 5%" data-field="subCategory" data-sortable="true">SUB-CATEGORY</th>
                                            <th style="width: 5%" data-field="tags" data-sortable="true">TAGS </th>
                                            <th style="width: 5%" data-field="offer" data-sortable="true">OFFER </th>
                                           
                                            <!--<th style="width: 10%" data-field="startDate" data-sortable="true">START DATE </th>-->
                                            <!--<th style="width: 10%" data-field="endDate" data-sortable="true">END DATE </th>-->
                                            <th style="width: 5%" data-field="status" data-sortable="true">STATUS</th>
                                            <th style="width: 10%" data-field="created_by" data-sortable="true">CREATED BY</th>
                                            <th style="width: 20%" data-field="action" data-sortable="true">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       {{-- @dd($offers); --}}
                                        @foreach ($products_list as $products)
                                            <tr>
                                                <td><input type="checkbox" class="checkbox" data-id="{{ $products->id }}"></td>
                                                 <?php
                                               $login_id = str_pad($products->login_id, 4, '0', STR_PAD_LEFT);
                                               $vendor_seq = \DB::table('products')->where('login_id', $products->login_id)->where('id', '<=', $products->id)->count();
                                               $pro_id = str_pad($vendor_seq, 5, '0', STR_PAD_LEFT);
                                               $stockSummary = App\Models\Products\ProductsDetails::where('products_id', $products->product_id)
                                                    ->selectRaw('COALESCE(SUM(quantity),0) as total_qty, COALESCE(MAX(low_stock_limit),0) as low_limit')
                                                    ->first();
                                               $totalQty = (int) ($stockSummary->total_qty ?? 0);
                                               $lowLimit = (int) ($stockSummary->low_limit ?? 0);
                                               $isLowStock = $lowLimit > 0 && $totalQty <= $lowLimit;
                                                $produ = \DB::table('vendor_details')
                                                     ->leftJoin('zonals', 'vendor_details.zone', '=', 'zonals.id')
                                                     ->select('vendor_details.*', 'zonals.name as zone_name')
                                                     ->where('vendor_details.user_id', $products->login_id)
                                                     ->get();

                                                 if(count($produ) > 0 && !empty($produ[0]->zone_name))
                                                     {
                                                          $zone = $produ[0]->zone_name;
                                                     }else{
                                                          $zone = '';
                                                     }
                                                 ?>
                                                 <td>{{ (!empty($zone) ? $zone : '') . '-'.$login_id . '-'.$pro_id }}</td>
                                               
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="{{ asset('assets/images/products') . '/' . $products->product_image }}"
                                                            alt="" class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>{{ $products->product_name }}</div>
                                                    @if($isLowStock)
                                                        <small class="text-danger d-block">Low stock: {{ $totalQty }} left (limit {{ $lowLimit }})</small>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <span class="fw-bold">
                                                        <a href="#" data-id={{ $products->id }} title="Stock Quantity"
                                                            class="text-danger " onclick="getquantity('{{ $products->id }}', '{{ addslashes($products->product_name) }}')">{{ $totalQty }}</a>
                                                    </span>
                                                </td>
                                                {{-- @dd($product_price->selling_price); --}}
                                                  {{-- <td>{{ $product_price->selling_price}} </td> --}}
                                                {{-- <td>{{ $products->category_sub}} </td> --}}
                                                @php
                                                    $subcat_name = '-';
                                                    foreach($categorysub as $csub) {
                                                        if($csub->id == $products->category_sub) {
                                                            $subcat_name = $csub->category_sub_name;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                <td>{{ $subcat_name }}</td>
                                                <td>{{$products->collection}}</td>
                                                
                                                <td>
                                                    @php
                                                        $displayOffer = "";
                                                        foreach ($offers as $offerItem) {
                                                            $offerLabel = "";
                                                            if($offerItem->type == "Buy X Get Y Free") {
                                                                $offerLabel = 'Buy ' . $offerItem->buy . ' get ' . $offerItem->getoffer . ' free';
                                                            } elseif($offerItem->type == "Buy X @ Y") {
                                                                $offerLabel = 'Buy ' . $offerItem->buyproduct . ' get amount ' . $offerItem->getamt;
                                                            } else {
                                                                $offerLabel = $offerItem->type;
                                                            }

                                                            if ($offerItem->id == $products->offers || $offerLabel == $products->offers) {
                                                                $displayOffer = $offerLabel;
                                                                break;
                                                            }
                                                        }
                                                        
                                                        if (!$displayOffer && $products->offers) {
                                                            $displayOffer = $products->offers;
                                                        }
                                                    @endphp
                                                    
                                                    @if($displayOffer)
                                                        <a href="#" class="text-danger" data-bs-toggle="modal"
                                                           data-original-title="test1" data-bs-target="#offerModal">
                                                            {{ $displayOffer }}
                                                        </a>
                                                    @endif
                                                </td>
                                                    {{-- <td>{{ $products->selling_price }}</td> --}}
                                                  
                                                <!--<td class="">11-June-2022</td>-->
                                                <!--<td class="">15-Dec-2022</td>-->

                                                <td>
                                                    <label class="switch">
                                                        {{-- $status = $pin->status --}}
                                                        
                                                         @if($products->status  == 1){
                                                         <input type="checkbox"
                                                             class="status-toggle"
                                                             data-id="{{ $products->id }}"
                                                             checked id="togBtn">
                                                         }@else{
                                                             <input type="checkbox"
                                                             class="status-toggle"
                                                             data-id="{{ $products->id }}"
                                                              id="togBtn">
                                                         }
                                                         @endif
                                                         <div class="slider round">
                                                             <!--ADDED HTML -->
                                                             <span class="on">Active</span>
                                                             <span class="off">Inactive </span>                                                                
                                                             <!--END-->
                                                         </div>
                                                     </label>

                                                </td>
                                                <td>
                                                    @if($products->logintype == 'Vendor')
                                                        @php
                                                            $vendorName = App\Models\vendor\vendorcreate::where('user_id', $products->login_id)->value('shop_name') ?? 'Vendor';
                                                        @endphp
                                                        {{ $vendorName }}
                                                    @else
                                                        Admin
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="mt-2 d-flex">
                                                         {{-- <a href="{{ route('products.crud.view', $products->id) }}"
                                                            class="btn btn-secondary mx-1"><i class="fab fa-mdb"></i>
                                                        </a>  --}}

                                                        <a href="{{ route('products.crud.edit', ['id'=>$products->id, 'sub_id'=>$products->category_sub]) }}"
                                                            class="btn btn-secondary mx-1"><i class="fa fa-pencil"></i>
                                                        </a>
														 @if (session()->get('log_type') == 'Admin')
                                                        <form action="{{ route('products.crud.destroy', $products->id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button" class="btn btn-warning mx-1 delete-btn"><i
                                                                    class="fa fa-trash" title="Delete"></i>
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

                <!-- Stock model start-->
               <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Stock Model </h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <form action="" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="container-fluid">
                                   
                                     <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3">
                                        <div class="col">
                                            <div class="p-3">
                                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="color">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-3">
                                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="size">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-3">
                                                <div class="input-group w-auto justify-content-end align-items-center">
                                                    <div class="handle-counter" id="handleCounter">
                                                        
                                                          <button class="counter-minus btn btn-primary">-</button>
                                                        
                                                          <input type="text" value="3">
                                                        
                                                          <button class="counter-plus btn btn-primary">+</button>
                                                        
                                                        </div>
                                                        
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                             <div class="p-3">
                                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="price">
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4 ml-auto">.col-md-4 .ml-auto</div> --}}
                                      </div>
                                    
                            </div>

                            <div class="modal-footer">
                                <a href="category.php" onclick="return confirm('Are you sure, you want to Save it?')">
                                    <button type="sub" class="btn btn-primary" type="button">Save</button></a>
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Stock model end -->
            <!-- offer model start -->
            {{-- <div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Offers Edit </h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <form action="{{ route('offer.update') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div id="modal_body1">


                                    <div class="container">
                                        <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3">
                                          <div class="col">
                                            <div class="p-3">
                                                <input type="text" class="form-control" id="newitem" aria-describedby="emailHelp" placeholder="New arrival">
                                            </div>
                                          </div>
                                          <div class="col">
                                            <div class="p-3">
                                                <input type="text" class="form-control" id="offer" aria-describedby="offer" placeholder="Offer">
                                            </div>
                                          </div>
                                          <div class="col">
                                            <div class="p-3">
                                                
                                                <input type="date" class="form-control" id="startdate" aria-describedby="emailHelp" placeholder="start date"> 
                                            </div>
                                          </div>
                                          <div class="col">
                                            <div class="p-3">
                                            
                                            <input type="date" class="form-control" id="enddate" aria-describedby="emailHelp" placeholder="End date">
                                            
                                            </div>
                                          </div>
                                          
                                         
                                        </div>
                                    </div>
                                   
                                </div>
                        </div>

                        <div class="modal-footer">
                            <a href="category.php" onclick="return confirm('Are you sure, you want to Save it?')">
                                <button type="sub" class="btn btn-primary" type="button">Save</button></a>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        <!-- offer model end -->
        
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">Stock Edit</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 24px; color: #333; opacity: 0.8; padding: 0 10px; cursor: pointer; line-height: 1;"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('products.details.update') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div id="modal_body">
                            <!-- Dynamic content will be appended here -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script src="//code.jquery.com/jquery.min.js"></script>
    <!-- <script src="app/js/handleCounter.js"></script> -->
   
    
    <!-- Delete all Product -->



<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('click', '#checkboxesMain', function() {
            
            if ($(this).prop('checked')) {
                
                $(".checkbox").prop('checked', true);
            } else {
                $(".checkbox").prop('checked', false);
            }
        });
 
        $('.delete').on('click', function(e) {
            var allVals = [];  
            $(".checkbox:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  
            if(allVals.length <=0)  
            {  
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please select row.'
                });
            }  else {  
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete the selected rows?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var join_selected_values = allVals.join(","); 

                        $.ajax({
                            url: "{{ url('admin/productbulkdelete') }}", 
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ids": join_selected_values,
                                 "sts":"0"
                            },
                            dataType: "json",
                            success: function (data) {
                                 location.reload();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            }  
        });
    /*Delete End*/

        /*Active*/
        $(document).on('click', '#checkboxesMain', function() {
            
            if ($(this).prop('checked')) {
                
                $(".checkbox").prop('checked', true);
            } else {
                $(".checkbox").prop('checked', false);
            }
        });
   
          $('.active').on('click', function(e) {
              var allVals = [];  
              $(".checkbox:checked").each(function() {  
                  allVals.push($(this).attr('data-id'));
              });  
              if(allVals.length <=0)  
              {  
                  Swal.fire({
                      icon: 'warning',
                      title: 'Oops...',
                      text: 'Please select row.'
                  });
              }  else {  
                  Swal.fire({
                      title: 'Are you sure?',
                      text: "Are you sure you want to Active this row?",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, Active it!'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          var join_selected_values = allVals.join(","); 

                          $.ajax({
                              url: "{{ url('admin/productbulkactive') }}", 
                              type: "POST",
                              data: {
                                  "_token": "{{ csrf_token() }}",
                                  "ids": join_selected_values,
                                  "sts":"1"
                              },
                              dataType: "json",
                              success: function (data) {
                                   location.reload();
                              },
                              error: function (data) {
                                  console.log('Error:', data);
                              }
                          });
                      }
                  });
              }  
          });
        /*End*/
       /*De Active*/
       $(document).on('click', '#checkboxesMain', function() {
            
            if ($(this).prop('checked')) {
                
                $(".checkbox").prop('checked', true);
            } else {
                $(".checkbox").prop('checked', false);
            }
        });
   
          $('.deactive').on('click', function(e) {
              var allVals = [];  
              $(".checkbox:checked").each(function() {  
                  allVals.push($(this).attr('data-id'));
              });  
              if(allVals.length <=0)  
              {  
                  Swal.fire({
                      icon: 'warning',
                      title: 'Oops...',
                      text: 'Please select row.'
                  });
              }  else {  
                  Swal.fire({
                      title: 'Are you sure?',
                      text: "Are you sure you want to DeActive this row?",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, DeActive it!'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          var join_selected_values = allVals.join(","); 
                          $.ajax({
                              url: "{{ url('admin/productbulkdeactive') }}", 
                              type: "POST",
                              data: {
                                  "_token": "{{ csrf_token() }}",
                                  "ids": join_selected_values,
                                  "sts":"0"
                              },
                              dataType: "json",
                              success: function (data) {
                                   location.reload();
                              },
                              error: function (data) {
                                  console.log('Error:', data);
                              }
                          });
                      }
                  });
              }  
          });
        /*End*/

       $(document).on('change', '.status-toggle', function() {
           var productId = $(this).data('id');
           var nextStatus = $(this).is(':checked') ? '1' : '0';

           $.ajax({
               url: nextStatus === '1' ? "{{ url('admin/productbulkactive') }}" : "{{ url('admin/productbulkdeactive') }}",
               type: "POST",
               data: {
                   "_token": "{{ csrf_token() }}",
                   "ids": String(productId),
                   "sts": nextStatus
               },
               dataType: "json",
               error: function() {
                   $(this).prop('checked', !$(this).is(':checked'));
                   Swal.fire({
                       icon: 'error',
                       title: 'Error',
                       text: 'Status update failed.'
                   });
               }.bind(this)
           });
       });
    });
    function getAjaxValue(url, method, callback) {
    $.ajax({
        url: url,
        type: method,
        success: function(data) {
            callback(data);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            alert('An error occurred while fetching data.');
        }
    });
}

function getquantity(id, productName) {
    let product_id = id;
   // alert(product_id);

    let url = `{{ route('getProductDetails') }}?product_id=${product_id}`;
    let method = 'GET';

    getAjaxValue(url, method, function(data) {
        $('#modal_body').empty();
        $('#modal_body').append(
            `<input type="text" name="product_id" class="d-none" value="${product_id}">`
        );
        if (productName) {
            $('#modal_body').append(
                `<div class="mb-4 p-3" style="background-color: #f1f5f9; border-radius: 8px; border-left: 4px solid #3b82f6;">
                    <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Product Name</span>
                    <h5 class="mb-0 mt-1" style="font-weight: 700; color: #1e293b;">${productName}</h5>
                </div>`
            );
        }

        $.each(data, function(key, productDetails) {
            $('#modal_body').append(createProductRow(productDetails));
        });

        $('#exampleModal').modal('show');
    });
}

    function createProductRow(productDetails) {
        let attrArray = [];
        if (productDetails.attributename1 && productDetails.attributevalue1) {
            attrArray.push([productDetails.attributename1, productDetails.attributevalue1]);
        } else if (productDetails.color) {
            attrArray.push(['Color', productDetails.color]);
        }
        
        if (productDetails.attributename2 && productDetails.attributevalue2) {
            attrArray.push([productDetails.attributename2, productDetails.attributevalue2]);
        } else if (productDetails.size) {
            attrArray.push(['Size', productDetails.size]);
        }

        if (productDetails.attributename3 && productDetails.attributevalue3) {
            attrArray.push([productDetails.attributename3, productDetails.attributevalue3]);
        }

        const attributeRows = attrArray.map(function(item) {
            return `<div style="margin-bottom: 2px;"><strong>${item[0]}:</strong> <span class="text-dark">${item[1]}</span></div>`;
        }).join('');

        return `
            <div class="row mb-2 align-items-end">
            <div class="col-md-6 col-12 mb-3">
                <label class="fw-bold text-secondary" style="font-size: 13px;">Attributes</label>
                <div style="font-size: 13px; font-weight: 500; color: #1e293b; padding: 8px 12px; background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; min-height: 38px; height: auto;">${attributeRows || '<span class="text-muted">-</span>'}</div>
                <input type="hidden" name="prodt_id[]" class="form-control" value="${productDetails.id}">
                <input type="hidden" name="retail_price[]" value="${productDetails.retail_price}">
                <input type="hidden" name="selling_price[]" value="${productDetails.selling_price}">
            </div>
            
            <div class="col-md-3 col-6 mb-3">
                <label class="fw-bold text-secondary" style="font-size: 13px;">In stock</label> 
                <input type="text" name="quantity[]" class="form-control" value="${productDetails.quantity}" style="border-color: #3b82f6; font-weight: 700; max-width: 100%;">
            </div>
            <div class="col-md-3 col-6 mb-3">
                <label class="fw-bold text-secondary" style="font-size: 13px;">low stock limit</label>
                <input type="text" name="low_stock_limit[]" class="form-control" value="${productDetails.low_stock_limit}" style="border-color: #3b82f6; font-weight: 700; max-width: 100%;">
            </div>
        </div><hr>
        `;
    }

    // Delete SweetAlert
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete it?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .swal2-popup {
        font-size: 1.6rem !important;
        width: 500px !important;
        max-width: 90% !important;
    }
</style>
@endsection

