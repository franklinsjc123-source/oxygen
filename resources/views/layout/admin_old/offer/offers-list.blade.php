@extends('layout.auth.master')
@section('contents')

@include('paritials.js.offer.offer-list-js')

@include('paritials.auth.header')?>

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
                                <h3>List Offers
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">List Offers</li>
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
                                
                          <a href="{{ route('offer.main.create') }}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Offers </a> 


                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
<thead>
 <tr>
   <th data-field="id" data-sortable="true" style="white-space: nowrap !important; min-width: 140px !important;">Id</th> 
   <th data-field="shop_name" data-sortable="true">Shop Name</th> 
   
   <th data-field="title" data-sortable="true">Offer Title</th>
    <th data-field="otype" data-sortable="true">Offer Type</th>
	
    
    
	 
	 <th data-field="dtype" data-sortable="true">Discount Type</th>
	 <th data-field="value" data-sortable="true">Value</th>
	 <th data-field="shold" data-sortable="true">Threshold</th>
   <th data-field="created_by" data-sortable="true">Created By</th> 
	 
   <th data-field="status" data-sortable="true">Status</th>
   <th>Action</th>
</tr>
</thead>
<tbody>
                                        @foreach ($Offer as $attribute)
                                            <tr>
                                                
                                                @php
                                                 if ($attribute->created_by_id == 'admin' || $attribute->created_by_id == 1) {
                                                     $zzone = '-';
                                                     $shop_name = 'Admin';
                                                     $created_by = 'Admin';
                                                 } else {
                                                     $vendor = \DB::table('vendor_details')
                                                         ->where('vendor_details.user_id', $attribute->created_by_id)
                                                         ->leftJoin('zonals', 'zonals.id', '=', 'vendor_details.zone')
                                                         ->select('zonals.name as zone_name', 'vendor_details.shop_name')
                                                         ->first();

                                                     if ($vendor != null) {
                                                         $zzone = $vendor->zone_name ?? '-';
                                                         $shop_name = $vendor->shop_name ?? '-';
                                                     } else {
                                                         $zzone = '-';
                                                         $shop_name = 'N/A';
                                                     }
                                                     $created_by = 'Shop';
                                                 }
                                                 if (!empty($attribute->added_by)) {
                                                     $created_by = $attribute->added_by;
                                                 }
                                                 @endphp
                                                
                                                
                                                
                                                
                                                <td style="white-space: nowrap !important; word-break: normal !important; min-width: 140px !important;">{{ $zzone.'-'. str_pad($attribute->created_by_id, 4, '0', STR_PAD_LEFT).'-'.str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);  }}</td>
                                                <td>{{ $shop_name }}</td>

                                                <td>{{ $attribute->title }}</td>

                                                <td>{{ $attribute->type }}</td>

                                                
												<td>                                          
                                                    {{ $attribute->cashbacktype }}
                                                </td>
												<td>                                          
                                                    {{ $attribute->value }}
                                                </td>
												<td>                                          
                                                    {{ $attribute->types }}
                                                </td>
                                                <td>
                                                    @if($created_by == 'Admin')
                                                        <span class="badge badge-primary px-2" style="color: #fff;">{{ $created_by }}</span>
                                                    @elseif($created_by == 'Shop')
                                                        <span class="badge badge-success px-2" style="color: #fff;">{{ $created_by }}</span>
                                                    @else
                                                        <span class="badge badge-info px-2" style="color: #fff;">{{ $created_by }}</span>
                                                    @endif
                                                </td>
                                                 <td>
                                                    <label class="switch">
                                                        {{-- $status = $pin->status --}}
                                                        
                                                         @if($attribute->status  == 1){
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

                                                <td><span class="mt-3 d-flex">
                                                    <form action="{{ route('offer.main.edit', $attribute->id) }}"
                                                        method="get">
                                                        @method('GET')
                                                        @csrf
                                                    <button class="btn btn-secondary mx-1"
                                                    onclick="return confirm('Are you sure, you want to delete it?')"
                                                            data-original-title="Edit"><i class="fa fa-pencil"></i> </button>
                                                    </form>
                                                        <!--a href="#" onclick="return delete_maincategory()"
                                                            class="badge badge-warning px-2" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Delete"><i
                                                                class="fa fa-trash"></i></a-->
                                                	 <form action="{{ route('offer.main.destroy', $attribute->id) }}"
																method="post">
																@method('DELETE')
																@csrf
																<button type="submit" class="btn btn-warning mx-1"
																	onclick="return confirm('Are you sure, you want to delete it?')"><i
																		class="fa fa-trash"></i>
																</button>

                        
													</form></span>
												</td>						

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
