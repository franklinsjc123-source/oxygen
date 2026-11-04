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

        <!-- Right sidebar Start-->

        <!-- Right sidebar Ends-->

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Seller Requests</li>
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
                                    {{-- <a href="{{ url('seller/register') }}" target="_blank" class="btn btn-primary"><i class="fa fa-plus"></i> Add
                                        Seller Request</a> --}}
                                </div>


                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table class="table" id="table" data-click-to-select="true" data-sort-name="id"
                                        data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"
                                        data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="100" data-search="true"
                                        data-show-refresh="false" data-key-events="true" data-resizable="true"
                                        data-cookie="true" data-show-export="false" data-click-to-select="true"
                                        data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="id" data-sortable="true">Id</th>
                                                <th data-field="shop_name" data-sortable="true">Shop Name</th>
                                                <th data-field="owner_name" data-sortable="true">Owner Name</th>
                                                <th data-field="mobile_number" data-sortable="true">Mobile Number</th>
                                                <th data-field="pincode" data-sortable="true">Pincode</th>
                                                <th data-field="category" data-sortable="true">Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($leads as $lead)
                                                <tr>
                                                    <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}</td>
                                                    <td>
                                                        {{ $lead->shop_name }}
                                                    </td>
                                                    <td>
                                                        {{ $lead->owner_name }}
                                                    </td>
                                                    <td>
                                                        {{ $lead->mobile_number }}
                                                    </td>
                                                    <td>
                                                        {{ $lead->pincode ?? $lead->city ?? '-' }}
                                                    </td>
                                                    <td>
                                                        {{ $lead->business_category ?? '-' }}
                                                    </td>

                                                    <td>
                                                        <span class="d-flex align-items-center" style="gap: 5px;">
                                                            <button type="button" 
                                                                class="btn btn-sm btn-info view-lead-btn" 
                                                                title="View Full Details"
                                                                style="background-color: #0284c7; border-color: #0284c7; color: #fff; width: 32px; height: 32px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; padding: 0;"
                                                                data-id="{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}"
                                                                data-shop-name="{{ $lead->shop_name }}"
                                                                data-owner-name="{{ $lead->owner_name }}"
                                                                data-mobile="{{ $lead->mobile_number }}"
                                                                data-email="{{ $lead->email ?? '-' }}"
                                                                data-pincode="{{ $lead->pincode ?? $lead->city ?? '-' }}"
                                                                data-category="{{ $lead->business_category ?? '-' }}"
                                                                data-tax-id="{{ $lead->gstin ?? $lead->uin ?? '-' }}"
                                                                data-gstin="{{ $lead->gstin ?? '-' }}"
                                                                data-uin="{{ $lead->uin ?? '-' }}"
                                                                data-address="{{ $lead->address ?? '-' }}"
                                                                data-notes="{{ $lead->message ?? '-' }}"
                                                                data-created="{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y, h:i A') }}">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                            <a href="tel:{{ $lead->mobile_number }}" class="btn btn-sm btn-secondary" title="Call Seller" style="background-color: #10b981; border-color: #10b981; color: #fff; width: 32px; height: 32px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; padding: 0;">
                                                                <i class="fa fa-phone"></i>
                                                            </a>
                                                            <form action="{{ route('admin.seller_leads.destroy', $lead->id) }}" method="post" style="display:inline-block; margin: 0;">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-sm btn-warning delete-btn" title="Delete Request" style="background-color: #f59e0b; border-color: #f59e0b; color: #fff; width: 32px; height: 32px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; padding: 0;">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </span>
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
    </div>

    <!-- View Seller Request Details Modal -->
    <div class="modal fade" id="viewLeadModal" tabindex="-1" role="dialog" aria-labelledby="viewLeadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.25);">
                <!-- Modal Header -->
                <div class="modal-header d-flex align-items-center justify-content-between" style="background: #183543 !important; padding: 18px 24px; border-bottom: none;">
                    <div class="d-flex align-items-center" style="gap: 14px;">
                        <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 22px;">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center" style="gap: 8px;">
                                <h5 class="modal-title font-weight-bold text-white mb-0" id="modal-shop-name" style="font-size: 18px; line-height: 1.2;">-</h5>
                                <span class="badge" id="modal-req-badge" style="background: rgba(255,255,255,0.2); color: #fff; font-size: 11px; padding: 3px 8px; border-radius: 12px; font-weight: 600;">#0001</span>
                            </div>
                            <small class="text-white-50" style="font-size: 12px;">Submitted: <span id="modal-created" class="text-white">-</span></small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white text-white close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 26px; line-height: 1; color: #ffffff; opacity: 0.85; cursor: pointer;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4" style="background-color: #f8fafc; color: #333333;">
                    <!-- Row 1: Owner Name & Business Category -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div style="background: #ffffff; padding: 12px 16px; border-radius: 8px; border: 1px solid #e2e8f0; height: 100%;">
                                <div style="font-size: 11px; font-weight: 700; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                                    <i class="fa fa-user" style="color: #666666; margin-right: 5px;"></i> Owner Name
                                </div>
                                <div id="modal-owner-name" style="font-size: 15px; font-weight: 600; color: #333333;">-</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div style="background: #ffffff; padding: 12px 16px; border-radius: 8px; border: 1px solid #e2e8f0; height: 100%;">
                                <div style="font-size: 11px; font-weight: 700; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                                    <i class="fa fa-tag" style="color: #666666; margin-right: 5px;"></i> Business Category
                                </div>
                                <div id="modal-category" style="font-size: 15px; font-weight: 600; color: #333333;">-</div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Mobile Number & Email -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div style="background: #ffffff; padding: 12px 16px; border-radius: 8px; border: 1px solid #e2e8f0; height: 100%;">
                                <div style="font-size: 11px; font-weight: 700; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                                    <i class="fa fa-phone" style="color: #666666; margin-right: 5px;"></i> Mobile Number
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span id="modal-mobile" style="font-size: 15px; font-weight: 600; color: #333333;">-</span>
                                    <a id="modal-call-link" href="#" class="btn btn-sm btn-outline-success" style="font-size: 11px; padding: 2px 10px; border-radius: 5px; font-weight: 600;">
                                        <i class="fa fa-phone me-1"></i> Call
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div style="background: #ffffff; padding: 12px 16px; border-radius: 8px; border: 1px solid #e2e8f0; height: 100%;">
                                <div style="font-size: 11px; font-weight: 700; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                                    <i class="fa fa-envelope" style="color: #666666; margin-right: 5px;"></i> Email Address
                                </div>
                                <div id="modal-email" style="font-size: 14.5px; font-weight: 600; color: #333333; word-break: break-all;">-</div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Pincode, GSTIN / UIN -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div style="background: #ffffff; padding: 12px 16px; border-radius: 8px; border: 1px solid #e2e8f0; height: 100%;">
                                <div style="font-size: 11px; font-weight: 700; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                                    <i class="fa fa-map-marker" style="color: #666666; margin-right: 5px;"></i> Pincode
                                </div>
                                <div id="modal-pincode" style="font-size: 15px; font-weight: 600; color: #333333;">-</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div style="background: #ffffff; padding: 12px 16px; border-radius: 8px; border: 1px solid #e2e8f0; height: 100%;">
                                <div style="font-size: 11px; font-weight: 700; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                                    <i class="fa fa-file-text-o" style="color: #666666; margin-right: 5px;"></i> GSTIN / UIN
                                </div>
                                <div id="modal-tax-id" style="font-size: 13.5px; font-weight: 700; color: #0284c7; font-family: monospace; word-break: break-all;">-</div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 4: Business Address -->
                    <div class="mb-3">
                        <div style="background: #ffffff; padding: 14px 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <div style="font-size: 11px; font-weight: 700; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
                                <i class="fa fa-building-o" style="color: #666666; margin-right: 5px;"></i> Business Address
                            </div>
                            <div id="modal-address" style="font-size: 14px; color: #333333; line-height: 1.6; white-space: pre-wrap;">-</div>
                        </div>
                    </div>

                    <!-- Row 5: Additional Notes / Message -->
                    <div>
                        <div style="background: #ffffff; padding: 14px 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <div style="font-size: 11px; font-weight: 700; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
                                <i class="fa fa-comment-o" style="color: #666666; margin-right: 5px;"></i> Additional Notes / Requirements
                            </div>
                            <div id="modal-notes" style="font-size: 14px; color: #333333; line-height: 1.6; white-space: pre-wrap;">-</div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer d-flex align-items-center justify-content-between" style="padding: 14px 24px; background: #ffffff; border-top: 1px solid #e2e8f0;">
                    <a id="modal-call-footer-btn" href="#" class="btn btn-success" style="background-color: #10b981; border-color: #10b981; border-radius: 6px; padding: 7px 18px; font-weight: 600; font-size: 13px;">
                        <i class="fa fa-phone me-1"></i> Call Seller
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal" style="border-radius: 6px; padding: 7px 18px; font-size: 13px;">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swal2-popup {
            font-size: 1.6rem !important;
            width: 500px !important;
            max-width: 90% !important;
        }
    </style>
    <script>
    $(document).ready(function() {
        // View Details Modal
        $(document).on('click', '.view-lead-btn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var reqId = $btn.data('id') || '0001';
            $('#modal-req-badge').text('#' + reqId);
            $('#modal-shop-name').text($btn.data('shop-name') || '-');
            $('#modal-owner-name').text($btn.data('owner-name') || '-');
            $('#modal-mobile').text($btn.data('mobile') || '-');
            $('#modal-email').text($btn.data('email') || '-');
            $('#modal-pincode').text($btn.data('pincode') || $btn.data('city') || '-');
            $('#modal-category').text($btn.data('category') || '-');
            var taxId = $btn.data('tax-id');
            if (!taxId || taxId === '-') {
                taxId = ($btn.data('gstin') && $btn.data('gstin') !== '-') ? $btn.data('gstin') : ($btn.data('uin') || '-');
            }
            $('#modal-tax-id').text(taxId || '-');
            $('#modal-address').text($btn.data('address') || '-');
            $('#modal-notes').text($btn.data('notes') || '-');
            $('#modal-created').text($btn.data('created') || '-');

            var mobile = $btn.data('mobile');
            if (mobile && mobile !== '-') {
                $('#modal-call-link').attr('href', 'tel:' + mobile).show();
                $('#modal-call-footer-btn').attr('href', 'tel:' + mobile).show();
            } else {
                $('#modal-call-link').hide();
                $('#modal-call-footer-btn').hide();
            }

            $('#viewLeadModal').modal('show');
        });

        // Modal Close Handler
        $(document).on('click', '[data-dismiss="modal"], [data-bs-dismiss="modal"]', function() {
            $('#viewLeadModal').modal('hide');
        });

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
    });
    </script>
@endsection
