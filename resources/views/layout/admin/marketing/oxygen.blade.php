@extends('layout.auth.master')
@section('contents')

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.auth.sidemenu');
	<!-- Page Sidebar Ends-->
	
    <style>
        .nav-tabs .nav-link {
            font-weight: 600;
            font-size: 14px;
            color: #64748b;
            padding: 10px 18px;
            border-radius: 8px 8px 0 0;
        }
        .nav-tabs .nav-link.active {
            color: #183543;
            border-color: #cbd5e1 #cbd5e1 #fff;
            background-color: #fff;
        }
        .banner-thumb-admin {
            width: 110px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .banner-thumb-admin:hover {
            transform: scale(1.05);
        }
    </style>

    <div class="page-body">		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item">Promotion / Marketing</li>
							<li class="breadcrumb-item active">Trymenow Promo</li>
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
                            <ul class="nav nav-tabs mb-4" id="promoTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="seller-requests-tab" data-bs-toggle="tab" data-bs-target="#seller-requests" type="button" role="tab" aria-controls="seller-requests" aria-selected="true">
                                        <i class="fa fa-bullhorn me-1 text-primary"></i> Seller Banner Requests
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

                            <div class="tab-content" id="promoTabsContent">
                                
                                <!-- ================= TAB 1: SELLER BANNER REQUESTS ================= -->
                                <div class="tab-pane fade show active" id="seller-requests" role="tabpanel" aria-labelledby="seller-requests-tab">
                                    
                                    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                                        <div>
                                            <h6 class="mb-0 fw-bold" style="color: #183543;">Seller Home Page Banner Requests</h6>
                                            <small class="text-muted">Review seller-paid banner advertisements. When you click <strong>Accept & Publish</strong>, the banner will automatically appear on the Home Page.</small>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover align-middle">
                                            <thead style="background: #183543; color: #fff;">
                                                <tr>
                                                    <th>Seller / Shop</th>
                                                    <th>Banner Image</th>
                                                    <th>Ad Headline & Link</th>
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
                                                            @if(!empty($req->banner_image) && file_exists(public_path('assets/images/banners/advoxygen/' . $req->banner_image)))
                                                                <img src="{{ asset('assets/images/banners/advoxygen/' . $req->banner_image) }}" 
                                                                     alt="Banner" 
                                                                     class="banner-thumb-admin btn-preview-image" 
                                                                     data-img="{{ asset('assets/images/banners/advoxygen/' . $req->banner_image) }}"
                                                                     title="Click to view full image">
                                                            @else
                                                                <span class="badge bg-light text-muted border">No Image</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <strong class="d-block text-dark" style="font-size: 13px;">
                                                                {{ $req->title ?: 'Home Page Banner' }}
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
                                                                    <button type="button" class="btn btn-success btn-sm btn-approve-banner px-2 py-1" data-id="{{ $req->id }}" title="Accept and publish to home page">
                                                                        <i class="fa fa-check me-1"></i> Accept & Publish
                                                                    </button>
                                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-reject-banner px-2 py-1" data-id="{{ $req->id }}" title="Reject banner">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            @elseif($req->approval_status === 'Approved')
                                                                <button type="button" class="btn btn-outline-danger btn-sm btn-reject-banner px-2 py-1" data-id="{{ $req->id }}">
                                                                    <i class="fa fa-ban me-1"></i> Revoke / Reject
                                                                </button>
                                                            @elseif($req->approval_status === 'Rejected')
                                                                <button type="button" class="btn btn-outline-success btn-sm btn-approve-banner px-2 py-1" data-id="{{ $req->id }}">
                                                                    <i class="fa fa-check me-1"></i> Re-approve
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center py-4 text-muted">
                                                            <i class="fa fa-info-circle me-1"></i> No seller banner requests submitted yet.
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
                                        <button type="button" class="btn btn-success btn-export-excel" style="background-color: #73b400; border-color: #73b400; color: #fff;">
                                            <i class="fa fa-file-excel-o me-1"></i> EXPORT EXCEL
                                        </button>
                                        <button type="button" class="btn btn-primary text-uppercase ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa fa-plus me-1"></i> Create Types
                                        </button>
                                    </div>

                                    <div class="row">
                                        <div class="datatable-dashv1-list custom-datatable-overright">                            
                                            <table class="table" id="table" data-click-to-select="true" data-show-columns="true" data-sort-name="budget" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="100" data-search="true" data-show-refresh="false" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="false" data-toolbar="#toolbar">                                        
                                                <thead>
                                                    <tr>
                                                        <th data-field="budget" data-sortable="true">BUDGET</th>
                                                        <th data-field="impressions" data-sortable="true">ADD IMPRESSIONS</th>
                                                        <th data-field="clicks" data-sortable="true">CLICKS</th>
                                                        <th data-field="duration" data-sortable="true">DURATION</th>
                                                        <th data-field="status" data-sortable="true">STATUS</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($oxygen as $item)
                                                        <tr>
                                                            <td>
                                                                <strong style="color: #183543; font-size: 15px;">RM {{ $item->amount }}</strong>
                                                            </td>
                                                            <td>{{ $item->impressions }}</td>
                                                            <td>{{ $item->clicks }}</td>
                                                            <td>{{ $item->duration }} Days</td>
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
                                                                <div class="d-flex align-items-center gap-1">
                                                                    <button type="button" value="{{ $item->id }}" class="edit_facebook btn btn-secondary btn-sm"> 
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button> 
                                                                    @if (session()->get('log_type') == 'Admin')
                                                                        <form action="{{ route('oxygen.destroy', $item->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this package?');">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-warning btn-sm">
                                                                                <i class="fa fa-trash"></i>
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
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->		
	</div>

    <!-- CREATE MODAL -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel">ADD Trymenow Promo Package</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('oxygen.store') }}" method="post">
                        @csrf
                        <div class="row fw-bold">
                            <div class="col-sm-12">
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="amount" class="mb-1">Budget (RM) :</label>
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
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <div class="col-12 d-flex justify-content-end gap-2 text-end">
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

    <!-- EDIT MODAL -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel1">Edit Trymenow Promo Package</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('oxygen.update', 1) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row fw-bold">
                            <div class="col-sm-12">
                                <input type="hidden" id="edit_id" name="edit_id">
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editamount" class="mb-1">Budget (RM) :</label>
                                        <input class="form-control" id="editamount" name="editamount" type="number" min="0" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editimpressions" class="mb-1">Add Impressions :</label>
                                        <input class="form-control" id="editimpressions" name="editimpressions" type="number" min="0" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editclicks" class="mb-1">Clicks :</label>
                                        <input class="form-control" id="editclicks" name="editclicks" type="number" min="0" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editduration" class="mb-1">Duration (Days) :</label>
                                        <input class="form-control" id="editduration" name="editduration" type="number" min="0" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="editstatus" class="mb-1">Status :</label>
                                        <select class="custom-select w-100 form-control" required id="editstatus" name="editstatus">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <div class="col-12 d-flex justify-content-end gap-2 text-end">
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

    <!-- Image Lightbox Modal -->
    <div class="modal fade" id="imageLightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 12px; overflow: hidden; background: transparent; border: none;">
                <div class="modal-body p-0 text-center position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10;"></button>
                    <img id="lightboxImg" src="" alt="Full Banner Preview" style="max-width: 100%; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    const token = '{{ csrf_token() }}';

    // Image lightbox preview
    $(document).on('click', '.btn-preview-image', function() {
        const src = $(this).data('img');
        $('#lightboxImg').attr('src', src);
        const modal = new bootstrap.Modal(document.getElementById('imageLightboxModal'));
        modal.show();
    });

    // Accept / Approve Banner Request
    $(document).on('click', '.btn-approve-banner', function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        Swal.fire({
            title: 'Accept & Publish Banner?',
            text: 'This will approve the seller advertisement banner and immediately display it on the Home Page for the package duration.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-check me-1"></i> Accept & Publish',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('oxygen.approve') }}",
                    data: {
                        _token: token,
                        id: id
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Banner Approved!',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
                            Swal.fire('Error', res.message || 'Could not approve banner.', 'error');
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

    // Reject Banner Request
    $(document).on('click', '.btn-reject-banner', function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        Swal.fire({
            title: 'Reject Advertisement Banner?',
            input: 'textarea',
            inputLabel: 'Reason for rejection (will be shown to seller):',
            inputPlaceholder: 'e.g. Low image resolution, non-compliant content, etc.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Reject Banner',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                const notes = result.value || 'Rejected by Admin';
                $.ajax({
                    type: "POST",
                    url: "{{ route('oxygen.reject') }}",
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
                                title: 'Banner Rejected',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
                            Swal.fire('Error', res.message || 'Could not reject banner.', 'error');
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

    // Edit Master Package AJAX
    $(document).on('click', '.edit_facebook', function(e) {
        e.preventDefault();
        var ad_id = $(this).val();
        $('#exampleModal1').modal('show');
        var url = "{{ route('oxygen.edit', ':ad_id') }}".replace(":ad_id", ad_id);

        $.ajax({
            url: url,       
            type: "get",
            dataType: 'json',
            success: function (response) {
                if(response.status == 200) {
                    $('#edit_id').val(response.oxygen.id);
                    $('#editamount').val(response.oxygen.amount);
                    $('#editimpressions').val(response.oxygen.impressions);
                    $('#editclicks').val(response.oxygen.clicks);
                    $('#editduration').val(response.oxygen.duration);
                    $('#editstatus').val(response.oxygen.status);  
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
            url: "{{ route('oxygen.changestatus') }}",
            data: {'status': status, 'id': id, '_token': token},
            success: function(data) {
                console.log(data.success);
            }
        });
    });
});
</script>
@endpush