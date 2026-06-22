@extends('layout.auth.master')
@section('contents')

@include('paritials.js.offer.offer-list-js')



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
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
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
   <th data-field="id" data-sortable="true">Id</th> 
   <th data-field="shop_name" data-sortable="true">Shop Name</th> 
   <th data-field="created_by" data-sortable="true">Created By</th> 
   
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
                                                         $shop_name = 'Shop (Deleted)';
                                                     }
                                                     $created_by = 'Shop';
                                                 }
                                                 @endphp
                                                
                                                
                                                
                                                
                                                <td>{{ $zzone.'-'. str_pad($attribute->created_by_id, 4, '0', STR_PAD_LEFT).'-'.str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);  }}</td>
                                                <td>{{ $shop_name }}</td>
                                                <td>{{ $created_by }}</td>

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
                                                    <label class="switch">
                                                        {{-- $status = $pin->status --}}
                                                        
                                                         <input type="checkbox" class="toggle-status" data-id="{{ $attribute->id }}" {{ $attribute->status == 1 ? 'checked' : '' }}>
                                                         <div class="slider round">
                                                             <!--ADDED HTML -->
                                                             <span class="on">Active</span>
                                                             <span class="off">Inactive </span>                                                                
                                                             <!--END-->
                                                         </div>
                                                     </label>
                            
                                                </td>

                                                <td><span class="mt-3 d-flex">
                                                    
                                                      <a href="{{ route('offer.main.edit', $attribute->id) }}" class="btn btn-secondary px-2"  ><i class="fa fa-pencil"></i> </a>
													@if (session()->get('log_type') == 'Admin')
                                                	 <form action="{{ route('offer.main.destroy', $attribute->id) }}"
																method="post">
																@method('DELETE')
																@csrf
																<button type="submit" class="btn btn-warning mx-1"><i
																		class="fa fa-trash"></i>
																</button>

                        
													</form>
													@endif
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
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
.swal2-popup {
    font-size: 1.6rem !important;
}
</style>
<script>
$(document).ready(function() {
    // Status Toggle
    $(document).on('change', '.toggle-status', function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var id = $(this).data('id');
        var checkbox = $(this);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('offer.changestatus') }}",
            data: {'status': status, 'id': id, '_token': '{{ csrf_token() }}'},
            success: function(data) {
                // Instantly changed
            },
            error: function() {
                checkbox.prop('checked', !status);
                Swal.fire('Error!', 'Something went wrong.', 'error');
            }
        });
    });

    // Delete Confirmation
    $(document).on('submit', 'form', function(e) {
        if($(this).find('input[name="_method"][value="DELETE"]').length > 0) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this offer! This cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
</script>
@endpush
