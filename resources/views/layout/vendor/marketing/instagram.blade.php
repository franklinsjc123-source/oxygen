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
        .ad-pkg-card:not(.is-active):not(.is-expired)::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        }
        .pkg-badge-insta {
            background: rgba(225, 48, 108, 0.1);
            color: #e1306c;
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
							<li class="breadcrumb-item active">Instagram Advertisement Packages</li>
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
							<div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(45deg, rgba(240, 148, 51, 0.15), rgba(225, 48, 108, 0.15)); display: flex; align-items: center; justify-content: center; font-size: 22px; color: #e1306c; flex-shrink: 0;">
								<i class="fa fa-instagram"></i>
							</div>
							<div>
								<h6 class="mb-0 fw-bold" style="color: #183543; font-size: 15px;">Instagram Advertisement Packages</h6>
								<small class="text-muted" style="font-size: 12px;">
									Choose a sponsored plan to boost products and gain buyer reach on Instagram.
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
				@forelse ($instagrame as $item)
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
					@endphp
					<div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-12 package-col" style="max-width: 380px;" data-budget="{{ $item->amount }}" data-duration="{{ $item->duration }}" data-impressions="{{ $item->impressions }}">
						<div class="ad-pkg-card p-3 p-md-4 {{ $isSubscribed ? ($isExpired ? 'is-expired' : 'is-active') : '' }}">
							
							<!-- Top Header: Platform & Status -->
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="pkg-badge-insta">
									<i class="fa fa-instagram me-1"></i> Instagram Ad
								</span>
								@if($isSubscribed)
									@if($isExpired)
										<span class="badge bg-danger text-white px-2 py-1" style="font-size: 11.5px; border-radius: 5px;">
											<i class="fa fa-exclamation-circle me-1"></i> Plan Expired
										</span>
									@else
										<span class="badge bg-success text-white px-2 py-1" style="font-size: 11.5px; border-radius: 5px;">
											<i class="fa fa-check-circle me-1"></i> Subscribed
										</span>
									@endif
								@else
									<span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 11.5px; border-radius: 5px;">
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
									Daily Cost: <strong>RM {{ $item->duration > 0 ? number_format($item->amount / $item->duration, 2) : $item->amount }}</strong>
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

							<!-- Action Section -->
							<div class="mt-3 pt-3 border-top">
								@if($isSubscribed)
									@if($isExpired)
										<!-- EXPIRED STATE: Prominent Renewal Required -->
										<div class="p-2 mb-2 rounded" style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
											<div class="d-flex justify-content-between align-items-center mb-1">
												<strong style="font-size: 11.5px;">
													<i class="fa fa-clock-o text-danger me-1"></i> Expired on {{ \Carbon\Carbon::parse($item->expires_at)->format('d M Y') }}
												</strong>
												<span class="badge bg-danger text-white" style="font-size: 10px;">Paused</span>
											</div>
											<div style="font-size: 11px; color: #7f1d1d; line-height: 1.3;">
												Plan validity has ended. Renew now to reactivate ad reach & impressions.
											</div>
										</div>

										<button type="button" class="btn w-100 text-white fw-bold py-2 btn-subscribe-pkg" 
											style="background: linear-gradient(135deg, #ea580c, #c2410c); border: none; border-radius: 8px; font-size: 13.5px; box-shadow: 0 4px 10px rgba(194, 65, 12, 0.25);"
											data-id="{{ $item->id }}" 
											data-amount="{{ $item->amount }}" 
											data-impressions="{{ $item->impressions }}" 
											data-clicks="{{ $item->clicks }}" 
											data-duration="{{ $item->duration }}" 
											data-action="renew"
											data-platform="Instagram">
											<i class="fa fa-refresh me-1"></i> Renew Package (RM {{ $item->amount }})
										</button>
									@else
										<!-- ACTIVE SUBSCRIBED STATE -->
										<div class="p-2 mb-2 rounded" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
											<div class="d-flex justify-content-between align-items-center">
												<div>
													<small class="d-block text-muted" style="font-size: 10.5px;">CAMPAIGN STATUS</small>
													<strong class="{{ $item->status == 1 ? 'text-success' : 'text-danger' }}" style="font-size: 12px;">
														{{ $item->status == 1 ? '● Active & Running' : '○ Inactive / Paused' }}
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
												<span class="badge bg-success-subtle text-success border border-success-subtle">{{ $remainingDays }} days left</span>
											</div>
										</div>

										<button type="button" class="btn btn-outline-success w-100 fw-bold py-2 btn-subscribe-pkg" 
											style="border-radius: 8px; font-size: 13px;"
											data-id="{{ $item->id }}" 
											data-amount="{{ $item->amount }}" 
											data-impressions="{{ $item->impressions }}" 
											data-clicks="{{ $item->clicks }}" 
											data-duration="{{ $item->duration }}" 
											data-action="extend"
											data-platform="Instagram">
											<i class="fa fa-calendar-plus-o me-1"></i> Extend Package (+{{ $item->duration }}d)
										</button>
									@endif
								@else
									<!-- AVAILABLE STATE -->
									<div class="d-flex align-items-center justify-content-between text-muted mb-2 px-1" style="font-size: 12px;">
										<span><i class="fa fa-lock text-secondary me-1"></i> Campaign Inactive</span>
										<span class="text-muted">Instant activation</span>
									</div>

									<button type="button" class="btn w-100 text-white fw-bold py-2 btn-subscribe-pkg" 
										style="background-color: #183543; border-color: #183543; border-radius: 8px; font-size: 13.5px; box-shadow: 0 4px 10px rgba(24, 53, 67, 0.18);"
										data-id="{{ $item->id }}" 
										data-amount="{{ $item->amount }}" 
										data-impressions="{{ $item->impressions }}" 
										data-clicks="{{ $item->clicks }}" 
										data-duration="{{ $item->duration }}" 
										data-action="buy"
										data-platform="Instagram">
										<i class="fa fa-shopping-cart me-1"></i> Buy & Activate Package
									</button>
								@endif
							</div>

						</div>
					</div>
				@empty
					<div class="col-12">
						<div class="card p-4 text-center" style="border-radius: 12px; border: 1px dashed #cbd5e1; max-width: 500px;">
							<div style="font-size: 40px; color: #94a3b8;"><i class="fa fa-bullhorn"></i></div>
							<h6 class="mt-2 fw-bold text-dark">No Advertisement Packages Available</h6>
							<p class="text-muted small mb-0">Packages created by the admin will appear here for you to subscribe and promote products.</p>
						</div>
					</div>
				@endforelse
			</div>

		</div>
		<!-- Container-fluid Ends-->		
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
    .neat-checkout-confirm-btn:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 18px rgba(24, 53, 67, 0.3) !important;
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
    .neat-checkout-cancel-btn:hover {
        background: #e2e8f0 !important;
        color: #1e293b !important;
    }
</style>
<script>
    const razorpayKey = "{{ $razorpayKey ?? config('services.razorpay.key') }}";
    const vendorName = "{{ $vendorDetails->shop_name ?? ($vendorDetails->owner_name ?? 'Oxygen Store') }}";
    const vendorEmail = "{{ $vendorDetails->email ?? '' }}";
    const vendorPhone = "{{ $vendorDetails->mobile_number1 ?? '' }}";

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

    // Buy / Renew / Extend Instagram Advertisement Package with Razorpay
    $(document).on('click', '.btn-subscribe-pkg', function(e) {
        e.preventDefault();
        const btn = $(this);
        const id = btn.data('id');
        const amount = btn.data('amount');
        const impressions = btn.data('impressions');
        const clicks = btn.data('clicks');
        const duration = btn.data('duration');
        const action = btn.data('action') || 'buy';
        const platform = btn.data('platform') || 'Instagram';
        const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

        let titleText = 'Subscribe to ' + platform + ' Package';
        let subText = 'Activate sponsored ad reach on ' + platform + ' for your shop.';
        let confirmBtnText = '<i class="fa fa-credit-card me-1"></i> Proceed to Pay Online (RM ' + amount + ')';
        let confirmBtnColor = '#183543';

        if (action === 'renew') {
            titleText = 'Renew ' + platform + ' Package';
            subText = 'Plan expired. Renew now to reactivate ad impressions for ' + duration + ' days.';
            confirmBtnText = '<i class="fa fa-refresh me-1"></i> Pay & Renew Online (RM ' + amount + ')';
            confirmBtnColor = '#ea580c';
        } else if (action === 'extend') {
            titleText = 'Extend ' + platform + ' Package';
            subText = 'Add ' + duration + ' more days to extend your active campaign validity.';
            confirmBtnText = '<i class="fa fa-calendar-plus-o me-1"></i> Pay & Extend Online (RM ' + amount + ')';
            confirmBtnColor = '#10b981';
        }

        Swal.fire({
            html: `
                <div style="text-align: left; font-family: inherit;">
                    <!-- Modal Header with Brand Icon -->
                    <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 18px; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; box-shadow: 0 4px 12px rgba(220, 39, 67, 0.25);">
                            <i class="fa fa-instagram"></i>
                        </div>
                        <div>
                            <div style="font-size: 17px; font-weight: 700; color: #0f172a; line-height: 1.25;">${titleText}</div>
                            <div style="font-size: 12.5px; color: #64748b; margin-top: 3px; line-height: 1.4;">${subText}</div>
                        </div>
                    </div>

                    <!-- Pricing Summary Card -->
                    <div style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px; margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px dashed #cbd5e1;">
                            <div>
                                <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; letter-spacing: 0.5px;">Total Payable</span>
                                <div style="font-size: 11px; color: #94a3b8;">Includes all taxes & delivery reach</div>
                            </div>
                            <div style="text-align: right;">
                                <span style="font-size: 24px; font-weight: 800; color: #183543; letter-spacing: -0.5px;">RM ${amount}</span>
                            </div>
                        </div>
                        
                        <!-- 3 Feature Metrics -->
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; text-align: center;">
                            <div style="background: #ffffff; border-radius: 8px; padding: 9px 4px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                                <div style="font-size: 10.5px; color: #64748b; text-transform: uppercase; font-weight: 600; letter-spacing: 0.4px;">
                                    <i class="fa fa-calendar-o text-primary" style="margin-right: 2px;"></i> Duration
                                </div>
                                <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-top: 3px;">${duration} Days</div>
                            </div>
                            <div style="background: #ffffff; border-radius: 8px; padding: 9px 4px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                                <div style="font-size: 10.5px; color: #64748b; text-transform: uppercase; font-weight: 600; letter-spacing: 0.4px;">
                                    <i class="fa fa-eye text-info" style="margin-right: 2px;"></i> Impressions
                                </div>
                                <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-top: 3px;">${impressions}</div>
                            </div>
                            <div style="background: #ffffff; border-radius: 8px; padding: 9px 4px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                                <div style="font-size: 10.5px; color: #64748b; text-transform: uppercase; font-weight: 600; letter-spacing: 0.4px;">
                                    <i class="fa fa-mouse-pointer text-success" style="margin-right: 2px;"></i> Est. Clicks
                                </div>
                                <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-top: 3px;">${clicks}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Trust Bar -->
                    <div style="display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 11.5px; color: #334155; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 8px; padding: 9px 12px;">
                        <i class="fa fa-lock text-success" style="font-size: 14px;"></i>
                        <span>Encrypted 256-bit instant checkout powered by <strong>Razorpay</strong></span>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: confirmBtnText,
            cancelButtonText: 'Cancel',
            confirmButtonColor: confirmBtnColor,
            customClass: {
                popup: 'neat-checkout-modal',
                confirmButton: 'neat-checkout-confirm-btn',
                cancelButton: 'neat-checkout-cancel-btn'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Open Razorpay Checkout Modal
                const amountInPaise = Math.round(parseFloat(amount) * 100);

                const rzpOptions = {
                    key: razorpayKey,
                    amount: amountInPaise,
                    currency: "INR",
                    name: vendorName,
                    description: platform + " Ad Package (RM " + amount + " - " + duration + " Days)",
                    webview_intent: /iPhone|iPad|iPod|Android/i.test(navigator.userAgent),
                    handler: function (response) {
                        // Payment successful - send to backend for verification & plan activation
                        Swal.fire({
                            title: 'Verifying Payment...',
                            html: 'Please wait while we activate your advertisement package.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: "{{ route('vendorinstagram.subscribe') }}",
                            type: "POST",
                            data: {
                                _token: token,
                                id: id,
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id || '',
                                razorpay_signature: response.razorpay_signature || ''
                            },
                            dataType: "json",
                            success: function(res) {
                                if (res.status == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Payment Successful!',
                                        html: '<p class="mb-2">' + res.message + '</p><div class="p-2 bg-light rounded text-muted small">Payment ID: <strong class="text-dark">' + response.razorpay_payment_id + '</strong></div>',
                                        confirmButtonText: 'Great, Continue',
                                        confirmButtonColor: '#183543'
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Error', res.message || 'Payment received but failed to activate.', 'error');
                                }
                            },
                            error: function(err) {
                                console.error('Subscription error:', err);
                                Swal.fire({
                                    title: 'Activation Error',
                                    html: 'Payment was captured (Payment ID: <strong>' + response.razorpay_payment_id + '</strong>), but package activation failed. Please contact support.',
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
                } catch (e) {
                    console.error('Razorpay load error:', e);
                    Swal.fire('Payment Gateway Error', 'Could not open Razorpay checkout. Please check internet connection or API keys.', 'error');
                }
            }
        });
    });

    // Use event delegation for status toggle
    document.body.addEventListener('change', function(e) {
        if (e.target.classList.contains('status-toggle')) {
            const status = e.target.checked ? 1 : 0;
            const item_id = e.target.getAttribute('data-id');
            const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

            fetch("{{ route('vendorinstagram.changestatus') }}", {
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
                                statusText.textContent = '● Active & Running';
                            } else {
                                statusText.className = 'text-danger';
                                statusText.textContent = '○ Inactive / Paused';
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