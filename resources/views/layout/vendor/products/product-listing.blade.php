@extends('layout.auth.master')
@section('contents')
    @include('paritials.css.product.productlist-css')
    @include('paritials.js.product.product-list-js')
    @include('paritials.css.display-css')

    @include('paritials.auth.header')

    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu');
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.vendorauth.sidemenu');
        <!-- Page Sidebar Ends-->

        <!-- Right sidebar Start-->

        <!-- Right sidebar Ends-->
        <style>
                    icon-shape {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            vertical-align: middle;
        }

            .icon-sm {
                width: 2rem;
                height: 2rem;
                
            }


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

                .btn {
                padding: 6px 12px;
                border: 1px solid transparent;
                color: #fff;
                }

                .btn:disabled, .btn:disabled:hover {
                background-color: darkgrey;
                cursor: not-allowed;
                }

                .btn-primary { background-color: #009dda; }

                .btn-primary:hover, .btn-primary:focus { background-color: #0486b9; }
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
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i data-feather="home"></i></a>
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
                            <div class="mt-3">
                                <a href="{{ route('vendorproducts.crud.index') }}">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add
                                        Product
                                    </button>
                                </a>

                                <button class="btn border-warning text-warning delete">Delete</button>
                                <button class="btn border-success text-success active">Active</button>
                                <button class="btn border-danger text-danger deactive">De-Active</button>
                            </div>

                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id"
                                    data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"
                                    data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"
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
                                            <th style="width: 20%" data-field="action" data-sortable="true">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       {{-- @dd($offers); --}}
                                        @foreach ($products_list as $products)
                                                <?php
   
                                        // $tt = App\Models\vendor\vendorcreate::where('user_id', '=', $products->login_id)
                                        // ->get
                                                $login_id = str_pad($products->login_id, 4, '0', STR_PAD_LEFT);
                                                $pro_id = str_pad($products->id, 5, '0', STR_PAD_LEFT);
                                                
                                                
                                                // $user = App\Models\User::where('login_id',$products->login_id)->get();
                                                // $produ = App\Models\vendor\vendorcreate::where('user_id',$user->id)->get();
                                                
                                                // $produ = App\Models\User::where('login_id', $products->login_id)
                                                //       ->join('vendor_details', 'vendor_details.user_id',  '=', 'users.id')
                                                //       ->select('vendor_details.zone')
                                                //       ->get();

                                                //  dd($produ[0]->zone);
                                               
                                                // if(count($produ) > 0)
                                                //     {
                                                        
                                                //          $zone = $produ[0]->zone;
                                                //     }else{
                                                //         $zone = '--';
                                                //     }

                                               ?>

                                            <tr>
                                                <td><input type="checkbox" class="checkbox" data-id="{{ $products->id }}"></td>
                                                 <?php
                                                   $login_id = str_pad($products->login_id, 4, '0', STR_PAD_LEFT);
                                                   $pro_id = str_pad($products->id, 5, '0', STR_PAD_LEFT);
                                                     $produ = App\Models\User::where('login_id', $products->login_id)
                                                       ->join('vendor_details', 'vendor_details.user_id',  '=', 'users.id')
                                                       ->select('vendor_details.zone')
                                                       ->get();

                                                
                                               
                                                if(count($produ) > 0)
                                                    {
                                                        
                                                         $zone = $produ[0]->zone;
                                                    }else{
                                                        $zone = '--';
                                                    }
                                                                                               
                                                if(count($produ) > 0)
                                                    {
                                                        
                                                         $zone = $produ[0]->zone;
                                                    }else{
                                                        $zone = '--';
                                                    }
                                                   ?>
                                                <td>{{ $zone.'-'.$login_id.'-'.$pro_id}}</td>
                                               
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="{{ asset('assets/images/products') . '/' . $products->product_image }}"
                                                            alt="" class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                    </div>
                                                </td>
                                                <td> 
                                                    
                                                    {{ $products->product_name }}</td>

                                                    <td class="text-center">
                                                    <?php
                                                     
                                                      $produ1 = App\Models\Products\ProductsDetails::where('products_id', $products->product_id)
                                                          ->sum('quantity');
                                                      
                                                    ?>
                                                    <span class="fw-bold">
                                                        <a href="#" data-id={{ $products->id }} title="Stock Quantity"
                                                            class="text-danger " onclick="getquantity('{{ $products->id }}')">{{ $produ1 }}</a>
                                                    </span>
                                                </td>
                                                {{-- @dd($product_price->selling_price); --}}
                                                  {{-- <td>{{ $product_price->selling_price}} </td> --}}
                                                {{-- <td>{{ $products->category_sub}} </td> --}}
                                                <?php
                                                $categorysubcount = count($categorysub);
                                               
                                                for($i=0; $i< $categorysubcount; $i++){
                                                 ?>
                                                @if($categorysub[$i]->id == $products->category_sub)
                                                <td>{{ $categorysub[$i]->category_sub_name}} </td>
                                                @endif
                                                <?php
                                                    }
                                                ?>
                                                <td>{{$products->collection}}</td>
                                                
                                                <td> <?php
                                                $off = count($offers);
                                               
                                                for($i=0; $i< $off; $i++){
                                                   // dd($offers[$i]->id);
                                                    if($offers[$i]->id == $products->offers)
                                                    {
                                                ?>
                                                <a href="#" class="text-danger" data-bs-toggle="modal"
                                                        data-original-title="test1" data-bs-target="#offerModal">
                                                         {{-- {{$products->offers}} --}}
                                                        {{$offers[$i]->type}}
                                                        {{-- Buy 3
                                                        Get 1 Free --}}
                                                    </a>
                                                 <?php
                                                   }
                                                }
                                                ?></td>
                                                    {{-- <td>{{ $products->selling_price }}</td> --}}
                                                  
                                               

                                                <td>
                                                    <label class="switch">
                                                        {{-- $status = $pin->status --}}
                                                        
                                                         @if($products->status  == 1){
                                                         <input type="checkbox"
                                                             onclick="return confirm('you want to Change it?  Please Click Edit Button')"
                                                             checked id="togBtn">
                                                         }@else{
                                                             <input type="checkbox"
                                                             onclick="return confirm('you want to Change it?  Please Click Edit Button')" 
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
                                                    <div class="mt-2 d-flex">
                                                         {{-- <a href="{{ route('products.crud.view', $products->id) }}"
                                                            class="btn btn-secondary mx-1"><i class="fab fa-mdb"></i>
                                                        </a>  --}}

                                                         <a href="{{ route('vendorproducts.crud.edit', ['id'=>$products->product_id, 'sub_id'=>$products->category_sub]) }}"
                                                            class="btn btn-secondary mx-1"><i class="fa fa-pencil"></i>
                                                        </a> 
                                                        <form action="{{ route('vendorproducts.crud.destroy', $products->id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning mx-1"
                                                                onclick="return confirm('Are you sure, you want to delete it?')"><i
                                                                    class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
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

              
            <!-- offer model start -->
            {{-- <div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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
                                <div id="modal_body">


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
            <div class="modal fade" id="exampleModaloffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Stock Edit </h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <form action="{{ route('offer.update') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div id="modal_bodyoffer">

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
            </div>
        </div>
    </div>
  <!-- Stock model start-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">Stock Edit</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('vendorproducts.details.update') }}" method="post">
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
            <!-- Stock model end -->

    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="app/js/handleCounter.js"></script>
    <script type="text/javascript">
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

       function getquantity(id) {
    let product_id = id;
   // alert(product_id);

    let url = `{{ route('getProductDetails') }}?product_id=${product_id}`;
    let method = 'GET';

    getAjaxValue(url, method, function(data) {
        $('#modal_body').empty();
        $('#modal_body').append(
            `<input type="text" name="product_id" class="d-none" value="${product_id}">`
        );

        $.each(data, function(key, productDetails) {
            $('#modal_body').append(createProductRow(productDetails));
        });

        $('#exampleModal').modal('show');
    });
}

function createProductRow(productDetails) {
    return `
        <div class="row mb-2">
                               
        <div class="col-md-2">
            <label>${productDetails.attributename1} : ${productDetails.attributevalue1} </label>
            <label>${productDetails.attributename2} : ${productDetails.attributevalue2} </label>
            <label>${productDetails.attributename3} : ${productDetails.attributevalue3} </label>
             <input type="hidden" name="prodt_id[]" class="form-control" value=${productDetails.id}>
        </div>
        
        <div class="col-md-2">
            <label> Quantity</label> 
            <input type="text" name="quantity[]" class="form-control" value=${productDetails.quantity}>
        </div>
            <div class="col-md-2">
            <label>low stock limit</label>
            <input type="text" name="low_stock_limit[]" class="form-control" value=${productDetails.low_stock_limit}>
        </div>
            <div class="col-md-2">
            <label> MRP</label> 
            <input type="text" name="retail_price[]" class="form-control" value=${productDetails.retail_price}>
        </div>
        <div class="col-md-2">
            <label> Selling Price</label> 
            <input type="text" name="selling_price[]" class="form-control" value=${productDetails.selling_price}>
        </div>
        

        
    </div><hr>
    `;
}
        $('#handleCounter').handleCounter({
        minimum: 1,
        maximize: null,
        })
        $('#handleCounter').handleCounter({
        onChange: function(){},
        onMinimum: function(){},
        onMaximize: function(){}
        })

    </script>
    
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
                alert("Please select row.");  
            }  else {  

               // alert("Accept.");  
                var check = confirm("Are you sure you want to Delete this row?");  
                if(check == true){  
                    var join_selected_values = allVals.join(","); 





                    $.ajax({

                        url: "{{route('productbulkdelete')}}", 
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "ids": join_selected_values,
                             "sts":"0"

                        },

                        dataType: "json",
                        success: function (data) {
                        // alert(data);
                          
                             location.reload();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                        });


                   
                }  
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
                  alert("Please select row.");  
              }  else {  
  
                 // alert("Accept.");  
                  var check = confirm("Are you sure you want to Active this row?");  
                  if(check == true){  
                      var join_selected_values = allVals.join(","); 
  
  
  
  
  
                      $.ajax({
  
                          url: "{{route('productbulkactive')}}", 
                          type: "POST",
                          data: {
                              "_token": "{{ csrf_token() }}",
                              "ids": join_selected_values,
                               "sts":"1"
  
                          },
  
                          dataType: "json",
                          success: function (data) {
                          // alert(data);
                            
                               location.reload();
                          },
                          error: function (data) {
                              console.log('Error:', data);
                          }
                          });
  
  
                     
                  }  
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
                  alert("Please select row.");  
              }  else {  
  
                 // alert("Accept.");  
                  var check = confirm("Are you sure you want to DeActive this row?");  
                  if(check == true){  
                      var join_selected_values = allVals.join(","); 
                      $.ajax({
                          url: "{{route('productbulkdeactive')}}", 
                          type: "POST",
                          data: {
                              "_token": "{{ csrf_token() }}",
                              "ids": join_selected_values,
                               "sts":"0"
                          },
  
                          dataType: "json",
                          success: function (data) {
                          // alert(data);
                            
                               location.reload();
                          },
                          error: function (data) {
                              console.log('Error:', data);
                          }
                          });
  
                  }  
              }  
          });
       /*End*/
    });
</script>
@endsection
