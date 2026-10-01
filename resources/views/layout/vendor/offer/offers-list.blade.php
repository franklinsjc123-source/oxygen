@extends('layout.auth.master')
@section('contents')

@include('paritials.js.offer.offer-list-js')

@include('paritials.vendorauth.header')?>

<!-- page-wrapper Start-->
@include('paritials.vendorauth.topmenu');
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
                        <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
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
                <style>
                    .fixed-table-toolbar {
                        display: flex !important;
                        flex-wrap: wrap;
                        align-items: center;
                        margin-bottom: 15px;
                    }
                    .fixed-table-toolbar .search {
                        order: 1;
                        flex: 1;
                        margin-bottom: 0 !important;
                        float: none !important;
                    }
                    .fixed-table-toolbar .search input {
                        width: 100% !important;
                        max-width: 100% !important;
                    }
                    .fixed-table-toolbar .columns {
                        order: 2;
                        margin-left: 10px;
                        margin-bottom: 0 !important;
                        float: none !important;
                    }
                    .fixed-table-toolbar .bs-bars {
                        order: 3;
                        margin-left: 15px;
                        margin-top: 0 !important;
                        float: none !important;
                        width: auto !important;
                    }
                </style>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                           
                            <div class="card-body">
                                
                                <div id="toolbar" class="mt-2">
                                    <div class="d-inline-block">
                                        <button type="button" class="btn btn-success btn-export-excel me-2" style="background-color: #28a745; border-color: #28a745; color: #fff;"><i class="fa fa-file-excel-o me-1"></i> Export Excel</button> 
                                        <a href="{{ route('vendoroffer.main.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Offers </a>
                                    </div>
                                </div>
                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
                        <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-columns="true"  data-show-refresh="false" data-key-events="true"  data-resizable="true" data-cookie="true"
                             data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                            
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
                                                 $zoneid = \DB::table('vendor_details')
                                                     ->where('vendor_details.user_id', $attribute->created_by_id)
                                                     ->leftJoin('zonals', 'zonals.id', '=', 'vendor_details.zone')
                                                     ->select('zonals.name')
                                                     ->first();

                                                 if ($zoneid != null && !empty($zoneid->name)) {
                                                     $zzone = $zoneid->name;
                                                 } else {
                                                     $zzone = '-';
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
                                                        
                                                         @if($attribute->status  == 1)
                                                         <input type="checkbox" checked id="togBtn_{{$attribute->id}}" class="status-toggle" data-id="{{$attribute->id}}">
                                                         @else
                                                             <input type="checkbox" id="togBtn_{{$attribute->id}}" class="status-toggle" data-id="{{$attribute->id}}">
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
                                                            data-original-title="Edit"><i class="fa fa-pencil"></i> </button>
                                                    </form>
                                                        <!--a href="#" onclick="return delete_maincategory()"
                                                            class="badge badge-warning px-2" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Delete"><i
                                                                class="fa fa-trash"></i></a-->
                                                	 <form action="{{ route('vendoroffer.main.destroy', $attribute->id) }}"
																method="post" class="delete-form">
																@method('DELETE')
																@csrf
																<button type="button" class="btn btn-warning mx-1 delete-btn"><i
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

<style>
    .swal2-popup {
        font-size: 1.6rem !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Use event delegation for delete buttons because bootstrap-table recreates DOM elements
    document.body.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            e.preventDefault();
            const button = e.target.closest('.delete-btn');
            const form = button.closest('.delete-form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
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
        }
    });

    // Use event delegation for status toggle
    document.body.addEventListener('change', function(e) {
        if (e.target.classList.contains('status-toggle')) {
            const status = e.target.checked ? 1 : 0;
            const offer_id = e.target.getAttribute('data-id');
            const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

            fetch("{{ route('vendoroffer.changestatus') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    id: offer_id,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                // Silently succeed, no alert needed
            })
            .catch(error => {
                console.error('Error updating status:', error);
                // Revert toggle if failed
                e.target.checked = !status;
            });
        }
    });
});
</script>

@endsection
