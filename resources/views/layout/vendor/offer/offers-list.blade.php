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
	@include('paritials.vendorauth.sidemenu');
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
                                <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
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
                                
                            <a href="{{ route('vendoroffer.main.create') }}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Offers </a> 


                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
                        <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                             data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                            
                        <thead>
                         <tr>
                           <th data-field="id" data-sortable="true">Id / Admin_Id</th> 
                           {{-- <th data-field="title" data-sortable="true">Admin_Id</th> --}}
                           <th data-field="title" data-sortable="true">Offer Title</th>
                            <th data-field="otype" data-sortable="true">Offer Type</th>
                        	 
                        	 <th data-field="dtype" data-sortable="true">Discount Type</th>
                        	 <th data-field="value" data-sortable="true">Value</th>
                        	  <th data-field="shold" data-sortable="true">Threshold</th>
                           <th data-field="status" data-sortable="true">Status</th>
                           <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                        @foreach ($Offer as $attribute)
                                            <tr>
                                                 @php
                                                 
                                                 
                                                  $zoneid = App\Models\User::where('login_id', $attribute->created_by_id)
                                                       ->join('vendor_details', 'vendor_details.user_id',  '=', 'users.id')
                                                       ->select('vendor_details.zone')
                                                       ->first();


                                                

                                                if( $zoneid != null)
                                                {
                                                   
                                                    $zzone = $zoneid->zone;
                                                }
                                                else{
                                                   
                                                    $zzone='-';
                                                }
                                                @endphp



                                                    



                                                <td>{{ $zzone.'-'. str_pad($attribute->created_by_id, 4, '0', STR_PAD_LEFT).'-'.str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);  }}</td>


                                                <td>{{ $attribute->title }}</td>

                                                <td>{{ $attribute->type }}</td>

                                               
												<td> 
                                                    @if( $attribute->type == "Cashback Offer")                                         
                                                    {{ $attribute->cashbacktype }}
                                                    @elseif($attribute->type == "Fixed Discount")
                                                    {{ $attribute->discount_type }}
                                                    @elseif($attribute->type == "Buy X @ Y" or $attribute->type == "Buy X Get Y Free")
                                                    Buy ({{ $attribute->buy }})
                                                    @else 
                                                    null
                                                    @endif
                                                </td>
												<td>    
                                                    @if( $attribute->type == "Cashback Offer")                                        
                                                    {{ $attribute->cashbackvalue }}
                                                    @elseif($attribute->type == "Fixed Discount")
                                                    {{ $attribute->value}}
                                                    @elseif($attribute->type == "Buy X @ Y" or $attribute->type == "Buy X Get Y Free")
                                                    Get ({{ $attribute->getoffer}})
                                                    @else
                                                    null
                                                    @endif
                                                </td>
												<td>  
                                                    @if( $attribute->types == "Minimum Purchase Amount")                                         
                                                    {{ $attribute->types }} - ({{ $attribute->m_p_a }})
                                                    @else
                                                    {{ $attribute->types }}
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
                                                    <form action="{{ route('vendoroffer.main.edit', $attribute->id) }}"
                                                        method="get">
                                                        @method('GET')
                                                        @csrf
                                                    <button class="btn btn-secondary mx-1"
                                                    onclick="return confirm('Are you sure, you want to Edit it?')"
                                                            data-original-title="Edit"><i class="fa fa-pencil"></i> </button>
                                                    </form>
                                                        <!--a href="#" onclick="return delete_maincategory()"
                                                            class="badge badge-warning px-2" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Delete"><i
                                                                class="fa fa-trash"></i></a-->
                                                	 <form action="{{ route('vendoroffer.main.destroy', $attribute->id) }}"
																method="post">
																@method('DELETE')
																@csrf
																<button type="submit" class="btn btn-warning mx-1"
																	onclick="return confirm('Are you sure, you want to delete it?')"><i
																		class="fa fa-trash"></i>
																</button>                        
													</form>
                                                </span>
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