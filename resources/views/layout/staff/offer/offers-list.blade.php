@extends('layout.auth.master')
@section('contents')

@include('paritials.js.offer.offer-list-js')

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.staffauth.sidemenu');
	<!-- Page Sidebar Ends-->
	
	<!-- Right sidebar Start-->
	
	<!-- Right sidebar Ends-->

          <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header" style="margin-top: 45px !important; padding-top: 15px !important;">
                    <div class="row">
                        <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ url('staff/dashboard/' . session()->get('login_id')) }}"><i data-feather="home"></i></a></li>
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
                                
                                <div id="toolbar" class="d-flex align-items-center">
                                    <a href="{{ route('staffoffer.export') }}" class="btn btn-success me-2" style="background-color: #28a745; border-color: #28a745; color: #fff;"><i class="fa fa-file-excel-o me-1"></i> Export Excel</a>
                                    <a href="{{ route('staffoffer.main.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Offers </a>
                                </div>
                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="shop_name" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="100" data-search="true" data-show-columns="true"  data-show-refresh="false" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
    
<thead>
 <tr>
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
                                                 if ($attribute->created_by_id == 'admin' || $attribute->created_by_id === '1' || $attribute->created_by_id === 1) {
                                                     $zzone = '-';
                                                     $shop_name = 'Admin';
                                                     $created_by = 'Admin';
                                                 } else {
                                                     $vendor = \DB::table('vendor_details')
                                                         ->where(function($q) use ($attribute) {
                                                             $q->where('vendor_details.user_id', $attribute->created_by_id)
                                                               ->orWhere('vendor_details.id', $attribute->created_by_id)
                                                               ->orWhere('vendor_details.vendor_id', $attribute->created_by_id);
                                                         })
                                                         ->leftJoin('zonals', 'zonals.id', '=', 'vendor_details.zone')
                                                         ->select('zonals.name as zone_name', 'vendor_details.shop_name')
                                                         ->first();

                                                     if (!$vendor) {
                                                         $u = \DB::table('users')->where('id', $attribute->created_by_id)->first();
                                                         if ($u && !empty($u->login_id)) {
                                                             $vendor = \DB::table('vendor_details')
                                                                 ->where(function($q) use ($u) {
                                                                     $q->where('vendor_details.user_id', $u->login_id)
                                                                       ->orWhere('vendor_details.id', $u->login_id)
                                                                       ->orWhere('vendor_details.vendor_id', $u->login_id);
                                                                 })
                                                                 ->leftJoin('zonals', 'zonals.id', '=', 'vendor_details.zone')
                                                                 ->select('zonals.name as zone_name', 'vendor_details.shop_name')
                                                                 ->first();
                                                         }
                                                     }

                                                     if ($vendor != null && !empty($vendor->shop_name)) {
                                                         $zzone = $vendor->zone_name ?? '-';
                                                         $shop_name = $vendor->shop_name;
                                                     } elseif (str_contains($attribute->title, ' - ')) {
                                                         $parts = explode(' - ', $attribute->title);
                                                         if (!empty($parts[0]) && strlen($parts[0]) < 30) {
                                                             $shop_name = trim($parts[0]);
                                                         }
                                                     } else {
                                                         $zzone = '-';
                                                         $shop_name = 'N/A';
                                                     }
                                                 }

                                                 $added_by = trim((string) ($attribute->added_by ?? ''));
                                                 if ($added_by === 'Admin' || $attribute->created_by_id === 'Admin') {
                                                     $created_by = 'Admin';
                                                     $created_by_type = 'admin';
                                                 } elseif (!empty($added_by) && $added_by !== 'Shop') {
                                                     $created_by = $added_by;
                                                     $created_by_type = 'staff';
                                                 } else {
                                                     if ($shop_name !== 'N/A' && $shop_name !== '-') {
                                                         $created_by = $shop_name;
                                                     } else {
                                                         $created_by = 'Shop';
                                                     }
                                                     $created_by_type = 'shop';
                                                 }
                                                 @endphp
                                                
                                                
                                                
                                                
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
                                                    @if($created_by_type == 'admin')
                                                        <span class="badge badge-primary px-2" style="color: #fff;">{{ $created_by }}</span>
                                                    @elseif($created_by_type == 'staff')
                                                        <span class="badge badge-info px-2" style="color: #fff;">{{ $created_by }}</span>
                                                    @else
                                                        <span class="badge badge-success px-2" style="color: #fff;">{{ $created_by }}</span>
                                                    @endif
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
                                                    
                                                      <a href="{{ route('staffoffer.main.edit', $attribute->id) }}" class="btn btn-secondary px-2"  ><i class="fa fa-pencil"></i> </a>
                                                      {{-- Commented out to respect read-only deletion policy
													@if (session()->get('log_type') == 'Admin')
                                                 	 <form action="{{ route('staffoffer.main.destroy', $attribute->id) }}"
																method="post">
																@method('DELETE')
																@csrf
																<button type="submit" class="btn btn-warning mx-1"><i
																		class="fa fa-trash"></i>
																</button>

                        
													</form>
													@endif
                                                      --}}
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
.id-column {
    white-space: nowrap !important;
    word-break: keep-all !important;
    min-width: 150px !important;
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
            url: "{{ route('staffoffer.changestatus') }}",
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
