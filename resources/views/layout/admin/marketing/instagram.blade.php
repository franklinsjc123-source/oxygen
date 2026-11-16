@extends('layout.auth.master')
@section('contents')

    @include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.auth.sidemenu');
	<!-- Page Sidebar Ends-->
	<div class="page-body">
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-lg-6">
						<div class="page-header-left">
							<h3>Instagram Advertisement
								<small>Try Me Now Admin panel</small>
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item">Marketing</li>
							<li class="breadcrumb-item active">Instagram Advertisement</li>
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

                            @php
                                $pendingCount = isset($sellerRequests) ? $sellerRequests->where('approval_status', 'Pending')->count() : 0;
                            @endphp

                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs mb-4" id="instaTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="seller-requests-tab" data-bs-toggle="tab" data-bs-target="#seller-requests" type="button" role="tab" aria-controls="seller-requests" aria-selected="true">
                                        <i class="fa fa-instagram me-1 text-danger"></i> Seller Poster Requests
                                        @if($pendingCount > 0)
                                            <span class="badge bg-danger ms-1" style="font-size: 11px;">{{ $pendingCount }} Pending</span>
                                        @endif
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="master-packages-tab" data-bs-toggle="tab" data-bs-target="#master-packages" type="button" role="tab" aria-controls="master-packages" aria-selected="false">
                                        <i class="fa fa-cog me-1 text-secondary"></i> Master Advertisement Packages
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="instaTabsContent">
                                
                                <!-- ================= TAB 1: SELLER POSTER REQUESTS ================= -->
                                <div class="tab-pane fade show active" id="seller-requests" role="tabpanel" aria-labelledby="seller-requests-tab">
                                    
                                    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                                        <div>
                                            <h6 class="mb-0 fw-bold" style="color: #183543;">Seller Instagram Ad Poster Requests</h6>
                                            <small class="text-muted">Review seller-paid Instagram advertisement creatives. Click <strong>Accept & Activate</strong> to approve the campaign.</small>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover align-middle">
                                            <thead style="background: #183543; color: #fff;">
                                                <tr>
                                                    <th>Seller / Shop</th>
                                                    <th>Poster Creative</th>
                                                    <th>Headline & Link</th>
                                                    <th>Package & Price</th>
                                                    <th>Payment</th>
                                                    <th>Submitted</th>
                                                    <th>Status</th>
                                                    <th class="text-center" style="width: 170px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($sellerRequests as $req)
                                                    @php
                                                        $vendor = $req->vendor_detail;
                                                        $posterFile = $req->poster_image ?? ($req->image && $req->image !== '-' ? $req->image : null);
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <strong class="d-block text-dark" style="font-size: 14px;">
                                                                {{ $vendor->shop_name ?? ('Seller #' . $req->vendor_id) }}
                                                            </strong>
                                                            <small class="text-muted d-block">{{ $vendor->owner_name ?? '' }}</small>
                                                            <small class="text-muted">{{ $vendor->mobile_number1 ?? '' }}</small>
                                                        </td>
                                                        <td>
                                                            @if(!empty($posterFile) && file_exists(public_path('assets/images/Marketting/instagram/' . $posterFile)))
                                                                <img src="{{ asset('assets/images/Marketting/instagram/' . $posterFile) }}" 
                                                                     alt="Poster" 
                                                                     class="btn-preview-image" 
                                                                     data-img="{{ asset('assets/images/Marketting/instagram/' . $posterFile) }}"
                                                                     title="Click to view full image"
                                                                     style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px; cursor: pointer; border: 1px solid #cbd5e1;">
                                                            @else
                                                                <span class="badge bg-light text-muted border">No Image</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-danger text-white mb-1" style="font-size: 10.5px;"><i class="fa fa-instagram me-1"></i> Instagram Ad</span>
                                                            <strong class="d-block text-dark" style="font-size: 13px;">
                                                                {{ $req->title ?: 'Instagram Campaign' }}
                                                            </strong>
                                                            @if(!empty($req->sub_title))
                                                                <small class="text-muted d-block">{{ $req->sub_title }}</small>
                                                            @endif
                                                            @if(!empty($req->link))
                                                                <a href="{{ $req->link }}" target="_blank" class="small text-primary text-truncate d-block" style="max-width: 180px;">
                                                                    <i class="fa fa-external-link me-1"></i> {{ $req->link }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <strong style="color: #183543; font-size: 14px;">RM {{ $req->amount }}</strong>
                                                            <small class="d-block text-muted">{{ $req->duration }} Days</small>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-success px-2 py-1" style="font-size: 11px;">
                                                                <i class="fa fa-check-circle me-1"></i> Paid
                                                            </span>
                                                            @if(!empty($req->razorpay_payment_id))
                                                                <small class="d-block text-muted mt-1" style="font-size: 10px;">ID: {{ $req->razorpay_payment_id }}</small>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <small class="text-muted">
                                                                {{ $req->subscribed_at ? \Carbon\Carbon::parse($req->subscribed_at)->format('d M Y, h:i A') : $req->created_at->format('d M Y') }}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            @if($req->approval_status === 'Approved')
                                                                <span class="badge bg-success px-2 py-1" style="font-size: 11.5px;">
                                                                    <i class="fa fa-check-circle me-1"></i> Approved (Live)
                                                                </span>
                                                                @if($req->expires_at)
                                                                    <small class="d-block text-muted mt-1" style="font-size: 10.5px;">
                                                                        Expires: {{ \Carbon\Carbon::parse($req->expires_at)->format('d M Y') }}
                                                                    </small>
                                                                @endif
                                                            @elseif($req->approval_status === 'Pending')
                                                                <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 11.5px;">
                                                                    <i class="fa fa-hourglass-half me-1"></i> Pending Approval
                                                                </span>
                                                            @elseif($req->approval_status === 'Rejected')
                                                                <span class="badge bg-danger px-2 py-1" style="font-size: 11.5px;">
                                                                    <i class="fa fa-times-circle me-1"></i> Rejected
                                                                </span>
                                                                @if($req->admin_notes)
                                                                    <small class="d-block text-danger mt-1" style="font-size: 10px;">{{ $req->admin_notes }}</small>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if($req->approval_status === 'Pending')
                                                                <div class="d-flex justify-content-center gap-1">
                                                                    <button type="button" class="btn btn-success btn-sm btn-approve-insta px-2 py-1" data-id="{{ $req->id }}" title="Accept and activate campaign">
                                                                        <i class="fa fa-check me-1"></i> Accept & Activate
                                                                    </button>
                                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-reject-insta px-2 py-1" data-id="{{ $req->id }}" title="Reject poster">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            @elseif($req->approval_status === 'Approved')
                                                                <button type="button" class="btn btn-outline-danger btn-sm btn-reject-insta px-2 py-1" data-id="{{ $req->id }}">
                                                                    <i class="fa fa-ban me-1"></i> Revoke / Reject
                                                                </button>
                                                            @elseif($req->approval_status === 'Rejected')
                                                                <button type="button" class="btn btn-outline-success btn-sm btn-approve-insta px-2 py-1" data-id="{{ $req->id }}">
                                                                    <i class="fa fa-check me-1"></i> Re-approve
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center py-4 text-muted">
                                                            <i class="fa fa-info-circle me-1"></i> No seller Instagram ad requests submitted yet.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <!-- ================= TAB 2: MASTER PACKAGES ================= -->
                                <div class="tab-pane fade" id="master-packages" role="tabpanel" aria-labelledby="master-packages-tab">

                                    <div id="toolbar" class="d-flex align-items-center gap-2 mb-2">
                                        <button type="button" class="btn btn-success btn-export-excel" style="background-color: #73b400; border-color: #73b400; color: #fff;"><i class="fa fa-file-excel-o me-1"></i> EXPORT EXCEL</button>
                                        <button type="button" class="btn btn-primary text-uppercase ms-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Create Types</button>
                                    </div>

                                    <div class="row">
                                        <div class="datatable-dashv1-list custom-datatable-overright">                            
                                            <table class="table" id="table"  data-click-to-select="true" data-show-columns="true" data-sort-name="budget" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="100" data-search="true"  data-show-refresh="false" data-key-events="true"  data-resizable="true" data-cookie="true"
                                                     data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">                                        
                                            <thead>
                                             <tr>
                                                <th data-field="budget" data-sortable="true">Budget</th>
                                                <th data-field="impressions" data-sortable="true">Add Impressions</th>
                                                <th data-field="clicks" data-sortable="true">Clicks</th>
                                                <th data-field="duration" data-sortable="true">Duration</th>
                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                             </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($instagrame as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <strong style="color: #183543; font-size: 15px;">RM {{ $item->amount }}</strong>
                                                    </div>
                                                </td>
                                                    
                                                <td>{{$item->impressions}}</td>
                                                <td>{{$item->clicks}}</td>
                                                <td>{{$item->duration}}</td>
                                                <td>
                                                    <label class="switch">
                                                         <input type="checkbox" class="toggle-status" data-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                                         <div class="slider round">
                                                             <span class="on">Active</span>
                                                             <span class="off">Inactive</span>
                                                         </div>
                                                     </label>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-primary btn-xs edit_facebook" value="{{ $item->id }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <form action="{{ route('instagram.destroy', $item->id) }}" method="POST" class="delete-form d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-xs btn-delete">
                                                                <i class="fa fa-trash"></i>
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
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->		
	</div>

    <!-- Modal: Create Master Package -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel">ADD Instagram Budget</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('instagram.store')}}" method="post">
                        @csrf
                        <div class="row fw-bold">
                            <div class="col-sm-12">
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="amount" class="mb-1">Budget :</label>
                                        <input class="form-control" id="amount" name="amount" type="number" min="0" placeholder="Enter budget amount" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="impressions" class="mb-1">Add Impressions :</label>
                                        <input class="form-control" id="impressions" name="impressions" type="number" min="0" placeholder="Enter impressions count" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="clicks" class="mb-1">Clicks :</label>
                                        <input class="form-control" id="clicks" name="clicks" type="number" min="0" placeholder="Enter clicks count" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="duration" class="mb-1">Duration (Days) :</label>
                                        <input class="form-control" id="duration" name="duration" type="number" min="0" placeholder="Enter duration in days" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="status" class="mb-1">Status :</label>
                                        <select class="custom-select w-100 form-control" required id="status" name="status">
                                            <option value="">--Select--</option>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-12 d-flex justify-content-end gap-2 text-end" style="justify-content: flex-end !important; text-align: right;">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>							
    </div>

    <!-- Modal: Edit Master Package -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel1">Edit Instagram Budget</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('instagram.update', 1)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row fw-bold">
                            <div class="col-sm-12">
                                <input type="hidden" id="edit_id" name="edit_id">

                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editamount" class="mb-1">Budget :</label>
                                        <input class="form-control" id="editamount" name="editamount" type="number" min="0" placeholder="Enter budget amount" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editimpressions" class="mb-1">Add Impressions :</label>
                                        <input class="form-control" id="editimpressions" name="editimpressions" type="number" min="0" placeholder="Enter impressions count" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editclicks" class="mb-1">Clicks :</label>
                                        <input class="form-control" id="editclicks" name="editclicks" type="number" min="0" placeholder="Enter clicks count" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editduration" class="mb-1">Duration (Days) :</label>
                                        <input class="form-control" id="editduration" name="editduration" type="number" min="0" placeholder="Enter duration in days" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editstatus" class="mb-1">Status :</label>
                                        <select class="custom-select w-100 form-control" required id="editstatus" name="editstatus">
                                            <option value="">--Select--</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-12 d-flex justify-content-end gap-2 text-end" style="justify-content: flex-end !important; text-align: right;">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>							
    </div>

    <!-- Modal: Image Preview -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header py-2 px-3">
                    <h6 class="modal-title fw-bold">Instagram Poster Preview</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2 text-center bg-dark">
                    <img id="modalPreviewImg" src="" alt="Full Preview" style="max-height: 500px; max-width: 100%; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

    // Image preview modal click
    $(document).on('click', '.btn-preview-image', function() {
        const src = $(this).data('img');
        $('#modalPreviewImg').attr('src', src);
        const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
        modal.show();
    });

    // Accept & Activate Seller Instagram Poster
    $(document).on('click', '.btn-approve-insta', function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        Swal.fire({
            title: 'Accept Instagram Poster?',
            text: 'This will approve the seller\'s poster creative and activate their Instagram campaign!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Accept & Activate',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#10b981'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('instagram.approve') }}",
                    data: {
                        _token: token,
                        id: id
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Approved & Activated!',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
                            Swal.fire('Error', res.message || 'Could not approve request.', 'error');
                        }
                    },
                    error: function(err) {
                        console.error('Approval error:', err);
                        Swal.fire('Error', 'An error occurred while approving.', 'error');
                    }
                });
            }
        });
    });

    // Reject Seller Instagram Poster
    $(document).on('click', '.btn-reject-insta', function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        Swal.fire({
            title: 'Reject Instagram Poster',
            input: 'textarea',
            inputLabel: 'Rejection Reason / Notes for Seller',
            inputPlaceholder: 'e.g. Image resolution is blurry, text violates guidelines...',
            inputAttributes: {
                'aria-label': 'Type your reason here'
            },
            showCancelButton: true,
            confirmButtonText: 'Reject Poster',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#ef4444',
            inputValidator: (value) => {
                if (!value) {
                    return 'Please enter a reason for rejection so the seller can fix it.';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const notes = result.value || 'Rejected by Admin';
                $.ajax({
                    type: "POST",
                    url: "{{ route('instagram.reject') }}",
                    data: {
                        _token: token,
                        id: id,
                        admin_notes: notes
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Poster Rejected',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
                            Swal.fire('Error', res.message || 'Could not reject poster.', 'error');
                        }
                    },
                    error: function(err) {
                        console.error('Rejection error:', err);
                        Swal.fire('Error', 'An error occurred while rejecting.', 'error');
                    }
                });
            }
        });
    });

    // Delete Master Package Confirmation
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
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
    });

    // Edit Master Package AJAX
    $(document).on('click', '.edit_facebook', function(e){
        e.preventDefault();
        var ad_id = $(this).val();
        $('#exampleModal1').modal('show');
        var url = "{{route('instagram.edit', ':ad_id')}}".replace(":ad_id", ad_id);

        $.ajax({
            url: url,       
            type: "get",
            dataType: 'json',
            success: function (response) {
                if(response.status == 200) {
                    $('#edit_id').val(response.instagrame.id);
                    $('#editamount').val(response.instagrame.amount);
                    $('#editimpressions').val(response.instagrame.impressions);
                    $('#editclicks').val(response.instagrame.clicks);
                    $('#editduration').val(response.instagrame.duration);
                    $('#editstatus').val(response.instagrame.status);  
                }
            }
        });
    });

    // Status Toggle on Master Packages
    $(document).on('change', '.toggle-status', function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var id = $(this).data('id');

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('instagram.changestatus') }}",
            data: {'status': status, 'id': id, '_token': token},
            success: function(data) {
                console.log(data.success);
            }
        });
    });
});
</script>
@endpush
