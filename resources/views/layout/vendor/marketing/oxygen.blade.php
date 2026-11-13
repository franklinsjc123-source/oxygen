@extends('layout.auth.master')
@section('contents')

    @include('paritials.vendorauth.header')?>

<!-- page-wrapper Start-->
@include('paritials.vendorauth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu');
	<!-- Page Sidebar Ends-->
	
    <style>
        @media (min-width: 992px) {
            .page-wrapper .page-body-wrapper .page-header {
                margin: 18px 0 10px 0 !important;
                padding: 0 !important;
                border-bottom: none !important;
            }
        }
        @media (max-width: 991px) {
            .page-wrapper .page-body-wrapper .page-header {
                margin: 12px 0 10px 0 !important;
                padding: 0 !important;
                border-bottom: none !important;
            }
        }

        /* Balanced Package Card Styling */
        .ad-pkg-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            transition: all 0.22s ease-in-out;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            max-width: 380px;
            width: 100%;
        }
        .ad-pkg-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 22px rgba(24, 53, 67, 0.12);
            border-color: #cbd5e1;
        }
        .ad-pkg-card.is-active {
            border-color: #10b981;
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.15);
        }
        .ad-pkg-card.is-active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #10b981;
        }
        .ad-pkg-card.is-pending {
            border-color: #f59e0b;
            box-shadow: 0 4px 16px rgba(245, 158, 11, 0.15);
        }
        .ad-pkg-card.is-pending::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #f59e0b;
        }
        .ad-pkg-card.is-expired {
            border-color: #fca5a5;
            box-shadow: 0 4px 16px rgba(239, 68, 68, 0.12);
        }
        .ad-pkg-card.is-expired::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #ef4444;
        }
        .ad-pkg-card:not(.is-active):not(.is-pending):not(.is-expired)::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #183543;
        }
        .pkg-badge-promo {
            background: rgba(24, 53, 67, 0.08);
            color: #183543;
            font-weight: 600;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 6px;
        }
        .stat-metric-cell {
            background: #f8fafc;
            border: 1px solid #eef2f6;
            border-radius: 9px;
            padding: 10px 6px;
            text-align: center;
            transition: background 0.2s;
        }
        .stat-metric-cell:hover {
            background: #f1f5f9;
        }
        .search-pkg-input {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 7px 14px;
            font-size: 13px;
            width: 240px;
            outline: none;
        }
        .search-pkg-input:focus {
            border-color: #183543;
            box-shadow: 0 0 0 3px rgba(24, 53, 67, 0.1);
        }
        .banner-preview-thumb {
            width: 100%;
            height: 90px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
    </style>

    <div class="page-body">		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('vendordashboard', session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1)) }}"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item">Marketing</li>
							<li class="breadcrumb-item active">Trymenow Promo Banner</li>
                        </ol>
                    </div>
                </div>
            </div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			
			<!-- Header Banner -->
			<div class="card mb-3" style="border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff;">
				<div class="card-body p-3 px-4">
					<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
						<div class="d-flex align-items-center gap-3">
							<div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(24, 53, 67, 0.1); display: flex; align-items: center; justify-content: center; font-size: 22px; color: #183543; flex-shrink: 0;">
								<i class="fa fa-television"></i>
							</div>
							<div>
								<h6 class="mb-0 fw-bold" style="color: #183543; font-size: 15px;">Trymenow Promo Home Page Banner</h6>
								<small class="text-muted" style="font-size: 12px;">
									Upload your advertisement banner and pay online. Once accepted by Admin, your banner will be published on the Home Page!
								</small>
							</div>
						</div>
						<div>
							<input type="text" id="packageSearch" class="search-pkg-input" placeholder="Search budget, days...">
						</div>
					</div>
				</div>
			</div>

			<!-- Packages Grid (Medium-Sized Cards) -->
			<div class="row g-3" id="packagesGrid">
				@forelse ($oxygen as $item)
					@php
						$isSubscribed = (!empty($item->is_subscribed) && $item->is_subscribed == 1);
						$isExpired = false;
						$remainingDays = 0;
						if ($isSubscribed && !empty($item->expires_at)) {
							$expiry = \Carbon\Carbon::parse($item->expires_at);
							$isExpired = $expiry->isPast();
							if (!$isExpired) {
								$remainingDays = max(0, (int) now()->diffInDays($expiry, false));
							}
						}
                        $cardClass = '';
                        if ($isSubscribed) {
                            if ($item->approval_status === 'Approved' && !$isExpired) {
                                $cardClass = 'is-active';
                            } elseif ($item->approval_status === 'Pending') {
                                $cardClass = 'is-pending';
                            } elseif ($isExpired) {
                                $cardClass = 'is-expired';
                            }
                        }
					@endphp
					<div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-12 package-col" style="max-width: 380px;" data-budget="{{ $item->amount }}" data-duration="{{ $item->duration }}" data-impressions="{{ $item->impressions }}">
						<div class="ad-pkg-card p-3 p-md-4 {{ $cardClass }}">
							
							<!-- Top Header: Platform & Status -->
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="pkg-badge-promo">
									<i class="fa fa-picture-o me-1 text-primary"></i> Home Page Banner
								</span>
								@if($isSubscribed)
									@if($item->approval_status === 'Approved')
                                        @if($isExpired)
                                            <span class="badge bg-danger text-white px-2 py-1" style="font-size: 11px; border-radius: 5px;">
                                                <i class="fa fa-exclamation-circle me-1"></i> Expired
                                            </span>
                                        @else
                                            <span class="badge bg-success text-white px-2 py-1" style="font-size: 11px; border-radius: 5px;">
                                                <i class="fa fa-check-circle me-1"></i> Live on Home
                                            </span>
                                        @endif
                                    @elseif($item->approval_status === 'Pending')
                                        <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 11px; border-radius: 5px;">
                                            <i class="fa fa-hourglass-half me-1"></i> Pending Approval
                                        </span>
                                    @elseif($item->approval_status === 'Rejected')
                                        <span class="badge bg-danger text-white px-2 py-1" style="font-size: 11px; border-radius: 5px;">
                                            <i class="fa fa-times-circle me-1"></i> Rejected
                                        </span>
									@endif
								@else
									<span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 11px; border-radius: 5px;">
										<i class="fa fa-circle-o me-1"></i> Available
									</span>
								@endif
							</div>

							<!-- Price Display -->
							<div class="mb-3">
								<div class="d-flex align-items-baseline gap-1">
									<span class="text-muted fw-bold" style="font-size: 15px;">RM</span>
									<span class="fw-bold" style="font-size: 28px; color: #183543; line-height: 1;">{{ $item->amount }}</span>
									<span class="text-muted ms-1" style="font-size: 13px;">/ {{ $item->duration }} Days</span>
								</div>
								<div class="text-muted mt-1" style="font-size: 12px;">
									Placement: <strong>Home Page (Trymenow / Adv Banner)</strong>
								</div>
							</div>

							<!-- 3-Column Metrics Row -->
							<div class="row g-2 my-2">
								<div class="col-4">
									<div class="stat-metric-cell">
										<i class="fa fa-eye text-primary d-block mb-1" style="font-size: 14px;"></i>
										<span class="d-block fw-bold text-dark" style="font-size: 14px; line-height: 1.2;">
											{{ is_numeric($item->impressions) ? number_format((int)$item->impressions) : $item->impressions }}
										</span>
										<span class="text-muted" style="font-size: 10.5px;">Impressions</span>
									</div>
								</div>
								<div class="col-4">
									<div class="stat-metric-cell">
										<i class="fa fa-mouse-pointer text-info d-block mb-1" style="font-size: 14px;"></i>
										<span class="d-block fw-bold text-dark" style="font-size: 14px; line-height: 1.2;">
											{{ is_numeric($item->clicks) ? number_format((int)$item->clicks) : $item->clicks }}
										</span>
										<span class="text-muted" style="font-size: 10.5px;">Clicks</span>
									</div>
								</div>
								<div class="col-4">
									<div class="stat-metric-cell">
										<i class="fa fa-calendar text-warning d-block mb-1" style="font-size: 14px;"></i>
										<span class="d-block fw-bold text-dark" style="font-size: 14px; line-height: 1.2;">
											{{ $item->duration }} Days
										</span>
										<span class="text-muted" style="font-size: 10.5px;">Duration</span>
									</div>
								</div>
							</div>

                            <!-- Banner Thumbnail Preview if uploaded -->
                            @if($isSubscribed && !empty($item->banner_image))
                            <div class="my-2 p-2 bg-light rounded border">
                                <small class="text-muted d-block mb-1" style="font-size: 11px;">
                                    <i class="fa fa-image me-1"></i> Uploaded Banner:
                                </small>
                                <img src="{{ asset('assets/images/banners/advoxygen/' . $item->banner_image) }}" alt="Banner Preview" class="banner-preview-thumb">
                                @if(!empty($item->title))
                                    <small class="d-block text-truncate fw-bold text-dark mt-1" style="font-size: 11.5px;">{{ $item->title }}</small>
                                @endif
                            </div>
                            @endif

							<!-- Action Section -->
							<div class="mt-3 pt-3 border-top">
								@if($isSubscribed)
                                    @if($item->approval_status === 'Approved')
                                        @if($isExpired)
                                            <!-- EXPIRED STATE -->
                                            <div class="p-2 mb-2 rounded" style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <strong style="font-size: 11.5px;">
                                                        <i class="fa fa-clock-o text-danger me-1"></i> Expired on {{ \Carbon\Carbon::parse($item->expires_at)->format('d M Y') }}
                                                    </strong>
                                                    <span class="badge bg-danger text-white" style="font-size: 10px;">Ended</span>
                                                </div>
                                                <div style="font-size: 11px; color: #7f1d1d; line-height: 1.3;">
                                                    Validity ended. Renew now to resubmit banner for Home Page placement.
                                                </div>
                                            </div>

                                            <button type="button" class="btn w-100 text-white fw-bold py-2 btn-open-ad-modal" 
                                                style="background: linear-gradient(135deg, #ea580c, #c2410c); border: none; border-radius: 8px; font-size: 13.5px;"
                                                data-id="{{ $item->id }}" 
                                                data-amount="{{ $item->amount }}" 
                                                data-duration="{{ $item->duration }}" 
                                                data-title="{{ $item->title ?? '' }}"
                                                data-subtitle="{{ $item->sub_title ?? '' }}"
                                                data-link="{{ $item->link ?? '' }}"
                                                data-action="renew">
                                                <i class="fa fa-refresh me-1"></i> Renew Banner (RM {{ $item->amount }})
                                            </button>
                                        @else
                                            <!-- APPROVED & LIVE STATE -->
                                            <div class="p-2 mb-2 rounded" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <small class="d-block text-muted" style="font-size: 10.5px;">HOME PAGE DISPLAY</small>
                                                        <strong class="{{ $item->status == 1 ? 'text-success' : 'text-danger' }}" style="font-size: 12px;">
                                                            {{ $item->status == 1 ? '● Live on Home Page' : '○ Paused by You' }}
                                                        </strong>
                                                    </div>
                                                    <label class="switch mb-0" title="Toggle active/pause">
                                                        <input type="checkbox" {{ $item->status == 1 ? 'checked' : '' }} class="status-toggle" data-id="{{ $item->id }}">
                                                        <div class="slider round">
                                                            <span class="on">Active</span>
                                                            <span class="off">Inactive</span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="text-muted mt-1 small d-flex justify-content-between align-items-center" style="font-size: 11px;">
                                                    <span>Valid until: <strong>{{ \Carbon\Carbon::parse($item->expires_at)->format('d M Y') }}</strong></span>
                                                    <span class="badge bg-success text-white">{{ $remainingDays }}d left</span>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-outline-success w-100 fw-bold py-2 btn-open-ad-modal" 
                                                style="border-radius: 8px; font-size: 13px;"
                                                data-id="{{ $item->id }}" 
                                                data-amount="{{ $item->amount }}" 
                                                data-duration="{{ $item->duration }}" 
                                                data-title="{{ $item->title ?? '' }}"
                                                data-subtitle="{{ $item->sub_title ?? '' }}"
                                                data-link="{{ $item->link ?? '' }}"
                                                data-action="extend">
                                                <i class="fa fa-calendar-plus-o me-1"></i> Extend / Update Banner
                                            </button>
                                        @endif
                                    @elseif($item->approval_status === 'Pending')
                                        <!-- PENDING APPROVAL STATE -->
                                        <div class="p-2 mb-2 rounded" style="background: #fffbeb; border: 1px solid #fde68a;">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <strong style="color: #b45309; font-size: 11.5px;">
                                                    <i class="fa fa-hourglass-half me-1"></i> Awaiting Admin Review
                                                </strong>
                                                <span class="badge bg-warning text-dark" style="font-size: 10px;">Pending</span>
                                            </div>
                                            <div style="font-size: 11px; color: #92400e; line-height: 1.3;">
                                                Payment of <strong>RM {{ $item->amount }}</strong> verified. Once Admin accepts your banner, it will immediately appear on the Home Page.
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-outline-secondary w-100 fw-bold py-2 btn-open-ad-modal" 
                                            style="border-radius: 8px; font-size: 12.5px;"
                                            data-id="{{ $item->id }}" 
                                            data-amount="{{ $item->amount }}" 
                                            data-duration="{{ $item->duration }}" 
                                            data-title="{{ $item->title ?? '' }}"
                                            data-subtitle="{{ $item->sub_title ?? '' }}"
                                            data-link="{{ $item->link ?? '' }}"
                                            data-action="update">
                                            <i class="fa fa-pencil me-1"></i> Update Banner Details
                                        </button>
                                    @elseif($item->approval_status === 'Rejected')
                                        <!-- REJECTED STATE -->
                                        <div class="p-2 mb-2 rounded" style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <strong style="font-size: 11.5px;">
                                                    <i class="fa fa-times-circle text-danger me-1"></i> Banner Rejected
                                                </strong>
                                                <span class="badge bg-danger text-white" style="font-size: 10px;">Rejected</span>
                                            </div>
                                            <div style="font-size: 11px; color: #7f1d1d; line-height: 1.3;">
                                                {{ $item->admin_notes ?: 'Your banner image was not accepted. Please re-upload a compliant banner.' }}
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-warning w-100 fw-bold py-2 btn-open-ad-modal" 
                                            style="border-radius: 8px; font-size: 13px;"
                                            data-id="{{ $item->id }}" 
                                            data-amount="{{ $item->amount }}" 
                                            data-duration="{{ $item->duration }}" 
                                            data-title="{{ $item->title ?? '' }}"
                                            data-subtitle="{{ $item->sub_title ?? '' }}"
                                            data-link="{{ $item->link ?? '' }}"
                                            data-action="reupload">
                                            <i class="fa fa-upload me-1"></i> Re-upload & Resubmit
                                        </button>
                                    @endif
								@else
									<!-- AVAILABLE STATE -->
									<div class="d-flex align-items-center justify-content-between text-muted mb-2 px-1" style="font-size: 12px;">
										<span><i class="fa fa-check-circle text-success me-1"></i> Slot Available</span>
										<span class="text-muted">Home Page Placement</span>
									</div>

									<button type="button" class="btn w-100 text-white fw-bold py-2 btn-open-ad-modal" 
										style="background-color: #183543; border-color: #183543; border-radius: 8px; font-size: 13.5px; box-shadow: 0 4px 10px rgba(24, 53, 67, 0.18);"
										data-id="{{ $item->id }}" 
										data-amount="{{ $item->amount }}" 
										data-duration="{{ $item->duration }}" 
										data-title=""
										data-subtitle=""
										data-link="{{ !empty($vendorDetails->slug) ? url('/shops/' . $vendorDetails->slug) : '' }}"
										data-action="buy">
										<i class="fa fa-upload me-1"></i> Buy & Upload Banner
									</button>
								@endif
							</div>

						</div>
					</div>
				@empty
					<div class="col-12">
						<div class="card p-4 text-center" style="border-radius: 12px; border: 1px dashed #cbd5e1; max-width: 500px;">
							<div style="font-size: 40px; color: #94a3b8;"><i class="fa fa-television"></i></div>
							<h6 class="mt-2 fw-bold text-dark">No Advertisement Packages Available</h6>
							<p class="text-muted small mb-0">Packages created by admin will appear here for you to buy and promote your store banner on the Home Page.</p>
						</div>
					</div>
				@endforelse
			</div>

		</div>
		<!-- Container-fluid Ends-->		
	</div>

    <!-- Modal for Uploading Banner & Razorpay Checkout -->
    <div class="modal fade" id="adBannerModal" tabindex="-1" aria-labelledby="adBannerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 520px;">
            <div class="modal-content" style="border-radius: 18px; border: none; box-shadow: 0 25px 60px -15px rgba(15, 23, 42, 0.3); overflow: hidden;">
                <div class="modal-header px-4 py-3 text-white" style="background: #183543; border: none;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 34px; height: 34px; border-radius: 8px; background: rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; font-size: 16px;">
                            <i class="fa fa-picture-o text-white"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white" id="adBannerModalLabel" style="font-size: 15px; letter-spacing: -0.2px;">
                                Home Page Advertisement Banner
                            </h5>
                            <small class="text-white-50" style="font-size: 11px;">Upload banner and activate campaign via Razorpay</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="adBannerForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="modal_package_id" name="id">
                    <input type="hidden" id="modal_action" name="action">
                    
                    <div class="modal-body p-4" style="background: #ffffff;">
                        <!-- Package Price Summary Callout -->
                        <div class="p-3 mb-3 rounded-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); border: 1px solid #e2e8f0;">
                            <div>
                                <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 10.5px; letter-spacing: 0.5px;">Payable Amount</small>
                                <span class="fw-bold" style="color: #183543; font-size: 22px; letter-spacing: -0.5px;" id="modal_display_price">RM 0.00</span>
                                <span class="text-muted small fw-medium" id="modal_display_duration">/ 0 Days</span>
                            </div>
                            <span class="badge px-3 py-2 rounded-pill" style="background: #183543; color: #fff; font-size: 11px; font-weight: 600;">
                                <i class="fa fa-television me-1"></i> Home Page Slot
                            </span>
                        </div>

                        <!-- Banner Placement Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark mb-1" style="font-size: 12.5px;">
                                Select Banner Placement Position <span class="text-danger">*</span>
                            </label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="banner-slot-card p-2 rounded-3 border d-block cursor-pointer text-center" id="slotCardTrymenow" style="border: 2px solid #183543 !important; background: #f0fdf4; cursor: pointer; transition: all 0.2s;">
                                        <input type="radio" name="banner_type" value="trymenow_adv" checked class="d-none slot-radio-input" onchange="updateSlotSelection(this)">
                                        <div class="fw-bold text-dark" style="font-size: 12.5px;"><i class="fa fa-th-large text-success me-1"></i> Trymenow Adv</div>
                                        <div class="text-muted" style="font-size: 10.5px;">Category Promo (600 × 300)</div>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label class="banner-slot-card p-2 rounded-3 border d-block cursor-pointer text-center" id="slotCardAdv" style="border: 1px solid #cbd5e1; background: #ffffff; cursor: pointer; transition: all 0.2s;">
                                        <input type="radio" name="banner_type" value="adv_banner" class="d-none slot-radio-input" onchange="updateSlotSelection(this)">
                                        <div class="fw-bold text-dark" style="font-size: 12.5px;"><i class="fa fa-television text-primary me-1"></i> Adv Banner</div>
                                        <div class="text-muted" style="font-size: 10.5px;">Middle Hero (1200 × 300)</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Banner Image Upload -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark mb-1" style="font-size: 12.5px;">
                                Advertisement Banner Image <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="banner_image_input" name="banner_image" accept="image/*" required style="border-radius: 8px; font-size: 12.5px;">
                            <div class="form-text" style="font-size: 11px; color: #64748b;">Supported formats: JPG, PNG, WebP (Max 2MB).</div>
                            
                            <!-- Image Preview Box -->
                            <div id="imagePreviewBox" class="mt-2 text-center p-2 border rounded-3" style="display: none; background: #fafafa;">
                                <img id="imagePreview" src="" alt="Preview" style="max-height: 110px; max-width: 100%; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                            </div>
                        </div>

                        <!-- Banner Title (Optional) -->
                        <div class="mb-2">
                            <label class="form-label fw-bold text-dark mb-1" style="font-size: 12.5px;">
                                Banner Headline / Title <small class="text-muted fw-normal">(Optional)</small>
                            </label>
                            <input type="text" class="form-control" id="modal_title" name="title" placeholder="e.g. MEGA SUMMER SALE 50% OFF" style="border-radius: 8px; font-size: 12.5px;">
                        </div>

                        <!-- Subtitle (Optional) -->
                        <div class="mb-2">
                            <label class="form-label fw-bold text-dark mb-1" style="font-size: 12.5px;">
                                Subtitle / Promo Tagline <small class="text-muted fw-normal">(Optional)</small>
                            </label>
                            <input type="text" class="form-control" id="modal_subtitle" name="sub_title" placeholder="e.g. Exclusive on our store this week" style="border-radius: 8px; font-size: 12.5px;">
                        </div>

                        <!-- Destination URL / Link -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark mb-1" style="font-size: 12.5px;">
                                Target Link <small class="text-muted fw-normal">(Defaults to your shop page)</small>
                            </label>
                            <input type="text" class="form-control" id="modal_link" name="link" placeholder="e.g. {{ url('/shops/' . ($vendorDetails->slug ?? '')) }}" style="border-radius: 8px; font-size: 12.5px;">
                        </div>

                        <div class="p-2 rounded-3 mb-0 d-flex align-items-center gap-2" style="background: #f0fdf4; border: 1px solid #bbf7d0; font-size: 11px; color: #166534;">
                            <i class="fa fa-shield text-success" style="font-size: 13px;"></i>
                            <div>Request submitted to Admin upon payment. Once accepted, it publishes automatically!</div>
                        </div>
                    </div>

                    <div class="modal-footer px-4 py-3 d-flex justify-content-between align-items-center" style="background: #f8fafc; border-top: 1px solid #eef2f6;">
                        <button type="button" class="btn btn-outline-secondary px-3 py-2 rounded-3" data-bs-dismiss="modal" style="font-size: 13px;">Cancel</button>
                        <button type="submit" id="btnProceedPayment" class="btn text-white fw-bold px-4 py-2 rounded-3" style="background: #183543; font-size: 13.5px; box-shadow: 0 4px 12px rgba(24,53,67,0.2);">
                            <i class="fa fa-credit-card me-1"></i> Proceed to Pay Online
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
    .neat-checkout-modal {
        border-radius: 20px !important;
        box-shadow: 0 25px 60px -15px rgba(15, 23, 42, 0.25) !important;
        padding: 24px 26px !important;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        max-width: 480px !important;
        width: 94% !important;
    }
    .neat-checkout-modal .swal2-html-container {
        margin: 0 !important;
        padding: 0 !important;
        overflow: visible !important;
    }
    .neat-checkout-modal .swal2-actions {
        margin-top: 18px !important;
        gap: 12px !important;
        width: 100% !important;
        display: flex !important;
    }
    .neat-checkout-confirm-btn {
        flex: 1 !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        padding: 12px 20px !important;
        border: none !important;
        box-shadow: 0 4px 14px rgba(24, 53, 67, 0.22) !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
    }
    .neat-checkout-cancel-btn {
        border-radius: 10px !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
        padding: 12px 18px !important;
        background: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
    }
</style>
<script>
    function updateSlotSelection(radio) {
        const cardTry = document.getElementById('slotCardTrymenow');
        const cardAdv = document.getElementById('slotCardAdv');
        if (radio.value === 'trymenow_adv') {
            cardTry.style.border = '2px solid #183543';
            cardTry.style.background = '#f0fdf4';
            cardAdv.style.border = '1px solid #cbd5e1';
            cardAdv.style.background = '#ffffff';
        } else {
            cardAdv.style.border = '2px solid #183543';
            cardAdv.style.background = '#eff6ff';
            cardTry.style.border = '1px solid #cbd5e1';
            cardTry.style.background = '#ffffff';
        }
    }
</script>
<script>
    const razorpayKey = "{{ $razorpayKey ?? config('services.razorpay.key') }}";
    const vendorName = "{{ $vendorDetails->shop_name ?? ($vendorDetails->owner_name ?? 'Trymenow Vendor') }}";
    const vendorEmail = "{{ $vendorDetails->email ?? '' }}";
    const vendorPhone = "{{ $vendorDetails->mobile_number1 ?? '' }}";

    let currentPkgAmount = 0;
    let currentPkgDuration = 0;

    // Live Search Filter for Packages
    document.getElementById('packageSearch')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.package-col');
        
        cards.forEach(card => {
            const budget = (card.getAttribute('data-budget') || '').toLowerCase();
            const duration = (card.getAttribute('data-duration') || '').toLowerCase();
            const impressions = (card.getAttribute('data-impressions') || '').toLowerCase();
            const text = card.innerText.toLowerCase();

            if (text.includes(query) || budget.includes(query) || duration.includes(query) || impressions.includes(query)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Image preview on file selection
    document.getElementById('banner_image_input')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                document.getElementById('imagePreview').src = evt.target.result;
                document.getElementById('imagePreviewBox').style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreviewBox').style.display = 'none';
        }
    });

    // Open Modal when clicking "Buy & Upload Banner", "Renew", or "Resubmit"
    $(document).on('click', '.btn-open-ad-modal', function(e) {
        e.preventDefault();
        const btn = $(this);
        const id = btn.data('id');
        const amount = btn.data('amount');
        const duration = btn.data('duration');
        const action = btn.data('action') || 'buy';
        const title = btn.data('title') || '';
        const subtitle = btn.data('subtitle') || '';
        const link = btn.data('link') || '';

        currentPkgAmount = amount;
        currentPkgDuration = duration;

        $('#modal_package_id').val(id);
        $('#modal_action').val(action);
        $('#modal_display_price').text('RM ' + amount);
        $('#modal_display_duration').text('/ ' + duration + ' Days');
        $('#modal_title').val(title);
        $('#modal_subtitle').val(subtitle);
        $('#modal_link').val(link);

        $('#banner_image_input').val('');
        $('#imagePreviewBox').hide();

        if (action === 'renew') {
            $('#btnProceedPayment').html('<i class="fa fa-refresh me-1"></i> Pay & Renew Online (RM ' + amount + ')');
        } else if (action === 'extend') {
            $('#btnProceedPayment').html('<i class="fa fa-calendar-plus-o me-1"></i> Pay & Extend Online (RM ' + amount + ')');
        } else {
            $('#btnProceedPayment').html('<i class="fa fa-credit-card me-1"></i> Proceed to Pay Online (RM ' + amount + ')');
        }

        const modal = new bootstrap.Modal(document.getElementById('adBannerModal'));
        modal.show();
    });

    // Handle Form Submit: Validate & Trigger Razorpay Checkout
    $('#adBannerForm').on('submit', function(e) {
        e.preventDefault();

        const form = document.getElementById('adBannerForm');
        const formData = new FormData(form);
        const bannerFile = document.getElementById('banner_image_input').files[0];
        const action = $('#modal_action').val();

        if (!bannerFile && action !== 'update') {
            Swal.fire('Banner Required', 'Please select an advertisement banner image to proceed.', 'warning');
            return;
        }

        // Hide upload modal before showing Razorpay
        const adModalEl = document.getElementById('adBannerModal');
        const modalInstance = bootstrap.Modal.getInstance(adModalEl);
        if (modalInstance) modalInstance.hide();

        const amountInPaise = Math.round(parseFloat(currentPkgAmount) * 100);

        const rzpOptions = {
            key: razorpayKey,
            amount: amountInPaise,
            currency: "INR",
            name: vendorName,
            description: "Trymenow Promo Banner (RM " + currentPkgAmount + " - " + currentPkgDuration + " Days)",
            webview_intent: /iPhone|iPad|iPod|Android/i.test(navigator.userAgent),
            handler: function (response) {
                // Payment verified! Append Razorpay payment tokens to formData
                formData.append('razorpay_payment_id', response.razorpay_payment_id);
                formData.append('razorpay_order_id', response.razorpay_order_id || '');
                formData.append('razorpay_signature', response.razorpay_signature || '');

                Swal.fire({
                    title: 'Submitting Banner Request...',
                    html: 'Verifying payment and transferring your banner to Admin for approval.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "{{ route('vendoroxygen.subscribe') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Request Submitted to Admin!',
                                html: `
                                    <p class="mb-2">${res.message}</p>
                                    <div class="p-2 bg-light rounded text-muted small">
                                        Payment ID: <strong class="text-dark">${response.razorpay_payment_id}</strong>
                                    </div>
                                `,
                                confirmButtonText: 'Understood, Continue',
                                confirmButtonColor: '#183543'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error', res.message || 'Payment received but failed to process banner.', 'error');
                        }
                    },
                    error: function(err) {
                        console.error('Submission error:', err);
                        Swal.fire({
                            title: 'Submission Notice',
                            html: 'Payment was captured (ID: <strong>' + response.razorpay_payment_id + '</strong>), but banner upload failed. Please contact support.',
                            icon: 'warning',
                            confirmButtonColor: '#183543'
                        });
                    }
                });
            },
            prefill: {
                name: "{{ $vendorDetails->owner_name ?? '' }}",
                email: vendorEmail,
                contact: vendorPhone
            },
            theme: {
                color: "#183543"
            },
            modal: {
                ondismiss: function() {
                    Swal.fire({
                        title: 'Payment Cancelled',
                        text: 'You cancelled the payment. No charges were made.',
                        icon: 'info',
                        confirmButtonColor: '#183543'
                    });
                }
            }
        };

        try {
            const rzp = new Razorpay(rzpOptions);
            rzp.on('payment.failed', function (resp) {
                Swal.fire({
                    title: 'Payment Failed',
                    html: 'Reason: ' + (resp.error.description || 'Transaction failed') + '<br><small class="text-muted">Code: ' + (resp.error.code || '') + '</small>',
                    icon: 'error',
                    confirmButtonColor: '#183543'
                });
            });
            rzp.open();
        } catch (err) {
            console.error('Razorpay load error:', err);
            Swal.fire('Payment Gateway Error', 'Could not open Razorpay checkout.', 'error');
        }
    });

    // Toggle status (Active / Inactive) for approved banner
    document.body.addEventListener('change', function(e) {
        if (e.target.classList.contains('status-toggle')) {
            const status = e.target.checked ? 1 : 0;
            const item_id = e.target.getAttribute('data-id');
            const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

            fetch("{{ route('vendoroxygen.changestatus') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    id: item_id,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    Swal.fire('Notice', data.error, 'warning');
                    e.target.checked = !status;
                } else {
                    const container = e.target.closest('.ad-pkg-card');
                    if (container) {
                        const statusText = container.querySelector('strong.text-success, strong.text-danger');
                        if (statusText) {
                            if (status == 1) {
                                statusText.className = 'text-success';
                                statusText.textContent = '● Live on Home Page';
                            } else {
                                statusText.className = 'text-danger';
                                statusText.textContent = '○ Paused by You';
                            }
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error updating status:', error);
                e.target.checked = !status;
            });
        }
    });
</script>
@endpush