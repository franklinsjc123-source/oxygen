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
	
	<!-- Right sidebar Start-->
	
	<!-- Right sidebar Ends-->
	
    <style>
        @media (min-width: 992px) {
            .page-wrapper .page-body-wrapper .page-header {
                margin: 20px 0 10px 0 !important;
                padding: 0 !important;
                border-bottom: none !important;
            }
        }
        @media (max-width: 991px) {
            .page-wrapper .page-body-wrapper .page-header {
                margin: 15px 0 10px 0 !important;
                padding: 0 !important;
                border-bottom: none !important;
            }
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
							<li class="breadcrumb-item active">Whatsapp Campaign</li>
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
							<div id="toolbar" class="d-flex align-items-center gap-2">
								<button type="button" class="btn btn-success btn-export-excel" style="background-color: #73b400; border-color: #73b400; color: #fff;">EXPORT EXCEL</button>
							</div>



							{{-- Canva-Style Poster Studio Modal --}}
							
							<!-- Canva-Style Poster Studio Modal -->
							<div class="modal fade" id="posterStudioModal" tabindex="-1" role="dialog" aria-labelledby="posterStudioModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 980px; width: 95%;">
									<div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
										<div class="modal-header text-white py-2 px-3 d-flex justify-content-between align-items-center" style="background-color: #183543 !important;">
											<div class="d-flex align-items-center gap-2">
												<i class="fa fa-paint-brush text-warning fa-lg"></i>
												<h5 class="modal-title text-white fw-bold mb-0" id="posterStudioModalLabel" style="font-size: 16px;">Poster Studio</h5>
											</div>
											<!-- Close Button -->
											<button type="button" class="btn btn-sm text-white fw-bold px-3 py-1 shadow-sm close-studio-modal-btn" data-dismiss="modal" data-bs-dismiss="modal" style="background-color: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 20px; font-size: 12px; line-height: 1.4; letter-spacing: 0.5px;">
												<i class="fa fa-times me-1"></i> CLOSE
											</button>
										</div>
										<div class="modal-body p-3" style="background-color: #f8fafc; max-height: calc(88vh - 80px); overflow-y: auto;">
											<div class="row g-3 align-items-stretch">
												<!-- Left: Live Canvas Preview (Decreased width) -->
												<div class="col-lg-4 col-md-5 text-center">
													<div class="card shadow-sm border-0 p-3 bg-white h-100 d-flex flex-column" style="border-radius: 12px;">
														<div class="d-flex justify-content-between align-items-center mb-2 px-1">
															<span class="studio-label text-muted mb-0"><i class="fa fa-eye me-1 text-primary"></i> LIVE POSTER PREVIEW</span>
															<span id="canvas_dimensions_badge" class="badge bg-light text-dark border" style="font-size: 10px;">1080 &times; 1920</span>
														</div>
														<div class="poster-canvas-wrapper d-flex align-items-center justify-content-center p-2 rounded flex-grow-1" style="background: repeating-conic-gradient(#f1f5f9 0% 25%, #ffffff 0% 50%) 50% / 20px 20px; min-height: 360px;">
															<canvas id="posterCanvas" style="max-height: 380px; max-width: 100%; border-radius: 6px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3);"></canvas>
														</div>
														<small class="text-muted mt-2 d-block" style="font-size: 10.5px;">
															<i class="fa fa-info-circle me-1"></i> Real-time preview. Click <strong>Download Poster</strong> for full-res image.
														</small>
													</div>
												</div>

												<!-- Right: Canva Studio Controls (Increased width) -->
												<div class="col-lg-8 col-md-7">
													<div class="card shadow-sm border-0 p-3 bg-white h-100 d-flex flex-column" style="border-radius: 12px;">
														<div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
															<h6 class="fw-bold mb-0 text-dark" style="font-size: 13.5px;">
																<i class="fa fa-sliders me-1 text-primary"></i> Customize Poster
															</h6>
														</div>
														<input type="hidden" id="studio_item_id">

														<!-- 2 Sleek Segmented Tabs (Never wrap, perfect 50/50 balance) -->
														<div class="studio-tab-bar mb-2">
															<button type="button" class="studio-tab-btn active" data-target="#tab-content">
																<i class="fa fa-font me-1"></i> 1. Content & Text
															</button>
															<button type="button" class="studio-tab-btn" data-target="#tab-design">
																<i class="fa fa-paint-brush me-1"></i> 2. Theme & Style
															</button>
														</div>

														<div class="tab-content flex-grow-1" id="studioTabContent" style="overflow-y: auto; max-height: 400px; padding-right: 4px;">
															<!-- TAB 1: CONTENT -->
															<div class="studio-tab-pane" id="tab-content" style="display: block;">

																{{-- Common Alignment, Color & Shadow for all 6 Lines --}}
																<div class="row g-2 mb-2 p-2 rounded border bg-light align-items-center">
																	<div class="col-12 col-md-4">
																		<label class="studio-label"><i class="fa fa-arrows me-1 text-primary"></i> Position & Align :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_text_pos">
																			<option value="top-right" selected>Top Right (Fashion Style)</option>
																			<option value="top-center">Top Center</option>
																			<option value="top-left">Top Left</option>
																			<option value="middle-right">Middle Right</option>
																			<option value="middle-center">Center / Middle</option>
																			<option value="middle-left">Middle Left</option>
																			<option value="bottom-right">Bottom Right</option>
																			<option value="bottom-center">Bottom Center</option>
																			<option value="bottom-left">Bottom Left</option>
																		</select>
																	</div>
																	<div class="col-6 col-md-4">
																		<label class="studio-label"><i class="fa fa-paint-brush me-1 text-primary"></i> Text Color :</label>
																		<div class="d-flex align-items-center gap-1">
																			<select class="form-select form-select-sm studio-input" id="studio_text_color_preset" style="flex: 1 1 auto; width: calc(100% - 42px) !important;">
																				<option value="#FFFFFF" selected>White</option>
																				<option value="#000000">Black</option>
																				<option value="#FFD700">Gold / Yellow</option>
																				<option value="#EF4444">Crimson Red</option>
																				<option value="#2563EB">Royal Blue</option>
																				<option value="#10B981">Green</option>
																				<option value="#E2E8F0">Soft Silver</option>
																				<option value="custom">Custom...</option>
																			</select>
																			<input type="color" id="studio_text_color_picker" class="studio-color-picker studio-input" value="#FFFFFF" style="width: 36px !important; min-width: 36px !important; max-width: 36px !important; height: 34px !important; flex: 0 0 36px !important; border-radius: 6px; cursor: pointer; border: 1px solid #cbd5e1; padding: 2px !important;" title="Pick Color">
																		</div>
																	</div>
																	<div class="col-6 col-md-4">
																		<label class="studio-label"><i class="fa fa-adjust me-1 text-primary"></i> Text Shadow :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_text_shadow">
																			<option value="auto" selected>Auto (Contrast)</option>
																			<option value="dark">Dark Shadow</option>
																			<option value="light">Light Glow</option>
																			<option value="none">No Shadow</option>
																		</select>
																	</div>
																</div>

																{{-- 6 Individual Poster Text Lines with Individual Sizes --}}
																<div class="row g-2 mb-1">
																	<div class="col-12 col-md-6">
																		<label class="studio-label py-0 mb-1">Line 1 :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_txt_1" placeholder="e.g. SPECIAL OFFER">
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-text-height me-1 text-primary"></i> Size 1 :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_1_size">
																			<option value="xs">XS (22px)</option>
																			<option value="small" selected>Small (28px)</option>
																			<option value="medium">Medium (38px)</option>
																			<option value="large">Large (54px)</option>
																			<option value="xlarge">XL (70px)</option>
																			<option value="huge">Huge (88px)</option>
																			<option value="giant">Giant (108px)</option>
																		</select>
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-arrows-v me-1 text-primary"></i> Margin Top :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_1_margin_top">
																			<option value="0" selected>0px</option>
																			<option value="6">6px (Slight)</option>
																			<option value="12">12px</option>
																			<option value="20">20px</option>
																			<option value="35">35px</option>
																			<option value="50">50px</option>
																			<option value="70">70px</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-1">
																	<div class="col-12 col-md-6">
																		<label class="studio-label py-0 mb-1">Line 2 :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_txt_2" placeholder="e.g. FASHION">
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-text-height me-1 text-primary"></i> Size 2 :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_2_size">
																			<option value="xs">XS (22px)</option>
																			<option value="small">Small (28px)</option>
																			<option value="medium">Medium (38px)</option>
																			<option value="large">Large (54px)</option>
																			<option value="xlarge">XL (70px)</option>
																			<option value="huge" selected>Huge (88px)</option>
																			<option value="giant">Giant (108px)</option>
																		</select>
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-arrows-v me-1 text-primary"></i> Margin Top :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_2_margin_top">
																			<option value="0" selected>0px</option>
																			<option value="6">6px (Slight)</option>
																			<option value="12">12px</option>
																			<option value="18">18px</option>
																			<option value="26">26px</option>
																			<option value="36">36px</option>
																			<option value="50">50px</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-1">
																	<div class="col-12 col-md-6">
																		<label class="studio-label py-0 mb-1">Line 3 :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_txt_3" placeholder="e.g. SALE">
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-text-height me-1 text-primary"></i> Size 3 :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_3_size">
																			<option value="xs">XS (22px)</option>
																			<option value="small">Small (28px)</option>
																			<option value="medium">Medium (38px)</option>
																			<option value="large">Large (54px)</option>
																			<option value="xlarge">XL (70px)</option>
																			<option value="huge" selected>Huge (88px)</option>
																			<option value="giant">Giant (108px)</option>
																		</select>
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-arrows-v me-1 text-primary"></i> Margin Top :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_3_margin_top">
																			<option value="0" selected>0px</option>
																			<option value="6">6px (Slight)</option>
																			<option value="12">12px</option>
																			<option value="18">18px</option>
																			<option value="26">26px</option>
																			<option value="36">36px</option>
																			<option value="50">50px</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-1">
																	<div class="col-12 col-md-6">
																		<label class="studio-label py-0 mb-1">Line 4 :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_txt_4" placeholder="e.g. UP TO">
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-text-height me-1 text-primary"></i> Size 4 :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_4_size">
																			<option value="xs">XS (22px)</option>
																			<option value="small">Small (28px)</option>
																			<option value="medium" selected>Medium (38px)</option>
																			<option value="large">Large (54px)</option>
																			<option value="xlarge">XL (70px)</option>
																			<option value="huge">Huge (88px)</option>
																			<option value="giant">Giant (108px)</option>
																		</select>
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-arrows-v me-1 text-primary"></i> Margin Top :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_4_margin_top">
																			<option value="0">0px</option>
																			<option value="6">6px (Slight)</option>
																			<option value="12">12px</option>
																			<option value="18" selected>18px</option>
																			<option value="26">26px</option>
																			<option value="36">36px</option>
																			<option value="50">50px</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-1">
																	<div class="col-12 col-md-6">
																		<label class="studio-label py-0 mb-1">Line 5 :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_txt_5" placeholder="e.g. 50%">
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-text-height me-1 text-primary"></i> Size 5 :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_5_size">
																			<option value="xs">XS (22px)</option>
																			<option value="small">Small (28px)</option>
																			<option value="medium">Medium (38px)</option>
																			<option value="large">Large (54px)</option>
																			<option value="xlarge">XL (70px)</option>
																			<option value="huge">Huge (88px)</option>
																			<option value="giant" selected>Giant (108px)</option>
																		</select>
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-arrows-v me-1 text-primary"></i> Margin Top :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_5_margin_top">
																			<option value="0" selected>0px</option>
																			<option value="6">6px (Slight)</option>
																			<option value="12">12px</option>
																			<option value="18">18px</option>
																			<option value="26">26px</option>
																			<option value="36">36px</option>
																			<option value="50">50px</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-12 col-md-6">
																		<label class="studio-label py-0 mb-1">Line 6 :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_txt_6" placeholder="e.g. OFF">
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-text-height me-1 text-primary"></i> Size 6 :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_6_size">
																			<option value="xs">XS (22px)</option>
																			<option value="small">Small (28px)</option>
																			<option value="medium" selected>Medium (38px)</option>
																			<option value="large">Large (54px)</option>
																			<option value="xlarge">XL (70px)</option>
																			<option value="huge">Huge (88px)</option>
																			<option value="giant">Giant (108px)</option>
																		</select>
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label py-0 mb-1"><i class="fa fa-arrows-v me-1 text-primary"></i> Margin Top :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_txt_6_margin_top">
																			<option value="0" selected>0px</option>
																			<option value="6">6px (Slight)</option>
																			<option value="12">12px</option>
																			<option value="18">18px</option>
																			<option value="26">26px</option>
																			<option value="36">36px</option>
																			<option value="50">50px</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-2 pt-2 border-top">
																	<div class="col-12 col-md-6">
																		<label class="studio-label"><i class="fa fa-map-marker text-danger"></i> Store Address / Location :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_line1" placeholder="e.g. FASHION 600, T.NAGAR">
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label"><i class="fa fa-text-height text-primary"></i> Size :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_addr_size">
																			<option value="xs">XS (18px)</option>
																			<option value="small">Small (20px)</option>
																			<option value="normal" selected>Normal (24px)</option>
																			<option value="medium">Medium (28px)</option>
																			<option value="large">Large (32px)</option>
																			<option value="xlarge">XL (38px)</option>
																			<option value="huge">Huge (44px)</option>
																		</select>
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label"><i class="fa fa-arrows-v text-primary"></i> Margin Top :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_addr_margin_top">
																			<option value="0">0px</option>
																			<option value="4" selected>4px (Slight)</option>
																			<option value="8">8px</option>
																			<option value="12">12px</option>
																			<option value="18">18px</option>
																			<option value="24">24px</option>
																			<option value="32">32px</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-12 col-md-6">
																		<label class="studio-label"><i class="fa fa-lock text-muted"></i> Website (Fixed) :</label>
																		<input type="text" class="form-control form-control-sm text-dark bg-light fw-bold" id="studio_fixed_domain" value="@trymenow.in" readonly style="cursor: not-allowed; background-color: #f1f5f9 !important;">
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label"><i class="fa fa-text-height text-primary"></i> Website Size :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_domain_size">
																			<option value="xs">XS (15px)</option>
																			<option value="small">Small (17px)</option>
																			<option value="normal" selected>Normal (19px)</option>
																			<option value="medium">Medium (22px)</option>
																			<option value="large">Large (26px)</option>
																			<option value="xlarge">XL (30px)</option>
																		</select>
																	</div>
																	<div class="col-6 col-md-3">
																		<label class="studio-label"><i class="fa fa-phone text-success"></i> WhatsApp / Mobile :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_phone" placeholder="e.g. 9876543210">
																	</div>
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-paint-brush text-primary"></i> Bar Background Color :</label>
																		<div class="d-flex align-items-center gap-2">
																			<input type="color" class="studio-color-picker studio-input" id="studio_bar_bg_picker" value="#121212" title="Choose Bar Background Color">
																			<span class="small text-muted fw-bold" id="studio_bar_bg_hex">#121212</span>
																		</div>
																	</div>
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-font text-info"></i> Bar Text Color :</label>
																		<div class="d-flex align-items-center gap-2">
																			<input type="color" class="studio-color-picker studio-input" id="studio_bar_text_picker" value="#ffffff" title="Choose Bar Text Color">
																			<span class="small text-muted fw-bold" id="studio_bar_text_hex">#FFFFFF</span>
																		</div>
																	</div>
																</div>
															</div>

															<!-- TAB 2: STYLE & OPTIONS -->
															<div class="studio-tab-pane" id="tab-design" style="display: none;">
																<div class="mb-2">
																	<label class="studio-label"><i class="fa fa-tag text-warning"></i> Offer Badge Pill (Bottom) :</label>
																	<select class="form-select form-select-sm studio-input" id="studio_cta">
																		<option value="✨ Free Delivery" selected>✨ Free Delivery</option>
																		<option value="🔥 SPECIAL OFFER">🔥 SPECIAL OFFER</option>
																		<option value="⚡ ORDER NOW">⚡ ORDER NOW</option>
																		<option value="🛍️ SHOP NOW">🛍️ SHOP NOW</option>
																		<option value="⏳ LIMITED STOCK">⏳ LIMITED STOCK</option>
																		<option value="📍 VISIT US TODAY">📍 VISIT US TODAY</option>
																		<option value="📅 BOOK NOW">📅 BOOK NOW</option>
																		<option value="⭐ BEST SELLER">⭐ BEST SELLER</option>
																		<option value="🆕 NEW ARRIVAL">🆕 NEW ARRIVAL</option>
																		<option value="💥 MEGA DISCOUNT">💥 MEGA DISCOUNT</option>
																		<option value="FLAT 50% OFF">🏷️ FLAT 50% OFF</option>
																		<option value="BUY 1 GET 1">🎁 BUY 1 GET 1</option>
																		<option value="🪔 FESTIVE SPECIAL">🪔 FESTIVE SPECIAL</option>
																		<option value="WEEKEND SALE">🎉 WEEKEND SALE</option>
																		<option value="EXCLUSIVE">💎 EXCLUSIVE</option>
																		<option value="none">❌ Hide Pill</option>
																		<option value="custom">✏️ Custom Text...</option>
																	</select>
																	<input type="text" class="form-control form-control-sm studio-input mt-1" id="studio_line2" placeholder="e.g. Free Delivery" value="Free Delivery" style="display: none;">
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-align-center text-primary"></i> Pill Alignment :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_pill_align">
																			<option value="center" selected>Center (Default)</option>
																			<option value="left">Left</option>
																			<option value="right">Right</option>
																		</select>
																	</div>
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-text-height text-primary"></i> Pill Font Size :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_pill_size">
																			<option value="xs">XS (16px)</option>
																			<option value="small">Small (18px)</option>
																			<option value="normal" selected>Normal (21px)</option>
																			<option value="medium">Medium (25px)</option>
																			<option value="large">Large (30px)</option>
																			<option value="xlarge">XL (36px)</option>
																		</select>
																	</div>
																</div>
																<div class="mb-2">
																	<label class="studio-label"><i class="fa fa-paint-brush text-primary"></i> Pill Color Gradient :</label>
																	<select class="form-select form-select-sm studio-input" id="studio_theme">
																		<option value="fashion_pink_gold" selected>Fashion Sunrise (Rose Pink & Golden Yellow)</option>
																		<option value="sunset">Sunset Glow (Crimson Red & Warm Orange)</option>
																		<option value="luxury_gold">Luxury Gold (Amber & Champagne)</option>
																		<option value="emerald">Emerald WhatsApp (Green Gradient)</option>
																		<option value="cyber">Cyber Neon (Sky Blue & Royal Purple)</option>
																		<option value="minimal">Minimal Dark (Charcoal & Slate)</option>
																	</select>
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-6">
																		<label class="studio-label">Font :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_font">
																			<option value="sans" selected>Modern Sans</option>
																			<option value="impact">Heavy Impact</option>
																			<option value="serif">Classic Serif</option>
																		</select>
																	</div>
																	<div class="col-6">
																		<label class="studio-label">Photo Filter :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_filter">
																			<option value="none" selected>Original</option>
																			<option value="vivid">Vivid Contrast</option>
																			<option value="warm">Warm Glow</option>
																			<option value="cool">Cool Tone</option>
																			<option value="vintage">Vintage</option>
																			<option value="bw">Black & White</option>
																		</select>
																	</div>
																</div>

																<div class="mb-2">
																	<div class="d-flex justify-content-between align-items-center mb-1">
																		<label class="studio-label mb-0">Photo Vignette / Darken :</label>
																		<span id="vignette_val" class="small text-muted fw-bold">25%</span>
																	</div>
																	<input type="range" class="form-range studio-input" id="studio_vignette" min="0" max="65" value="25" step="5">
																</div>

																<div class="mb-2 pt-2 border-top">
																	<label class="studio-label">Shop Logo (Optional) :</label>
																	<input type="file" class="form-control form-control-sm studio-input" id="studio_logo_file" accept="image/*">
																	<div class="d-flex justify-content-between align-items-center mt-1" id="logo_options_wrap" style="display: none !important;">
																		<small class="text-success" id="logo_filename_display"><i class="fa fa-check"></i> Logo attached</small>
																		<button type="button" class="btn btn-link btn-sm text-danger p-0" id="btn_remove_logo" style="font-size: 11px;">Remove Logo</button>
																	</div>
																</div>
															</div>
														</div>

														<!-- Action Buttons (Always Visible at Bottom) -->
														<div class="pt-2 border-top mt-auto">
															<button type="button" class="btn btn-lg w-100 fw-bold shadow-sm" id="btn_download_poster" style="background-color: #183543 !important; border-color: #183543 !important; color: #ffffff !important; padding: 10px 16px; font-size: 13.5px; border-radius: 8px;">
																<i class="fa fa-download me-2"></i> DOWNLOAD POSTER (PNG)
															</button>

															{{-- Commented out as requested:
															<div class="d-flex gap-2 mt-2">
																<button type="button" class="btn btn-outline-secondary btn-sm flex-fill" id="btn_download_jpeg">
																	<i class="fa fa-file-image-o me-1"></i> Save as JPEG
																</button>
																<button type="button" class="btn btn-outline-primary btn-sm flex-fill" id="btn_save_studio_data">
																	<i class="fa fa-save me-1"></i> Save to Shop
																</button>
															</div>
															--}}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Mobile / WebView Image Save Modal -->
							<div class="modal fade" id="posterMobileSaveModal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1070;">
								<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 420px; width: 92%; margin: 12px auto;">
									<div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
										<div class="modal-header py-2 px-3 text-white d-flex justify-content-between align-items-center" style="background-color: #183543 !important;">
											<div class="d-flex align-items-center gap-2">
												<i class="fa fa-check-circle text-success fa-lg"></i>
												<h6 class="modal-title fw-bold mb-0 text-white" style="font-size: 14px;">Poster Ready</h6>
											</div>
											<button type="button" class="btn btn-sm text-white fw-bold px-2 py-0" data-bs-dismiss="modal" data-dismiss="modal" style="background: rgba(255,255,255,0.2); border-radius: 50%;">
												<i class="fa fa-times"></i>
											</button>
										</div>
										<div class="modal-body p-3 text-center" style="background-color: #f8fafc;">
											<div class="p-2 bg-white rounded shadow-sm border mb-2 d-inline-block" style="max-width: 100%;">
												<img id="mobile_preview_poster_img" src="" alt="Custom Poster" class="img-fluid rounded" style="max-height: 48vh; object-fit: contain; display: block; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.12);" />
											</div>
											<div class="alert alert-info py-2 px-2 text-start mb-2" style="font-size: 11.5px; border-radius: 8px;">
												<i class="fa fa-hand-pointer-o text-primary me-1"></i> <strong>Save to Phone:</strong> If automatic download didn't start, <strong>tap & hold (long press)</strong> the image above and tap <strong>"Save Image"</strong> or <strong>"Download Image"</strong>.
											</div>
											<div class="d-flex gap-2">
												<a id="btn_mobile_direct_download" href="#" download="poster.png" class="btn btn-primary btn-sm flex-fill fw-bold py-2" style="background-color: #183543 !important; border-color: #183543 !important;">
													<i class="fa fa-download me-1"></i> Download File
												</a>
												<button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal" data-dismiss="modal">
													Done
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
<div class="row">
								<div class="datatable-dashv1-list custom-datatable-overright">                            
									<table class="table" id="table"  data-click-to-select="true" data-show-columns="true" data-sort-name="title" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="100" data-search="true"  data-show-refresh="false" data-key-events="true"  data-resizable="true" data-cookie="true"
											 data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">                                        
                                    <thead>
                                     <tr>
										<th data-field="image" data-sortable="true">Image</th> 
                                        <th data-field="title" data-sortable="true">Title</th>
                                        <th data-field="sub_title" data-sortable="true">Sub Title</th>
                                        <th data-field="line1" data-sortable="true">Line 1</th>
                                        <th data-field="line2" data-sortable="true">Line 2</th>
                                        <th data-field="mobile" data-sortable="true">Mobile</th>
										<th data-field="status" data-sortable="true">Status</th>										
									    <th>Action</th>
                                     </tr>
                                    </thead>
                                    <tbody>
										@foreach ($whapp as $item)
									<tr>
										<td>
											<div class="d-flex align-items-center">
												<img src="{{asset('assets/images/Marketting/Wh_app_template/' . $item->image)}}" alt="Template" class="img-fluid rounded border" style="max-height: 60px; max-width: 90px; object-fit: contain;"> 
											</div>
										</td>
										<td>
											<div class="d-flex">
												{{ !empty($item->title) && $item->title != '-' ? $item->title : '-' }}
											</div>
										</td>
											
										<td>{{ !empty($item->sub_title) && $item->sub_title != '-' ? $item->sub_title : '-' }}</td>
										<td>{{ !empty($item->line1) && $item->line1 != '-' ? $item->line1 : '-' }}</td>
										<td>{{ !empty($item->line2) && $item->line2 != '-' ? $item->line2 : '-' }}</td>
										<td>{{ !empty($item->ph_no) && $item->ph_no != '-' ? $item->ph_no : '-' }}</td>
										<td>
											<label class="switch">
												 @if($item->status == 1)
												 <input type="checkbox" checked id="togBtn_{{$item->id}}" class="status-toggle" data-id="{{$item->id}}">
												 @else
												 <input type="checkbox" id="togBtn_{{$item->id}}" class="status-toggle" data-id="{{$item->id}}">
												 @endif
												 <div class="slider round">
													 <span class="on">Active</span>
													 <span class="off">Inactive </span>                                                                
												 </div>
											 </label>										
                            			</td>
										<td>
											<div class="d-flex align-items-center gap-1">
												<button type="button" value="{{$item->id}}" class="edit_facebook btn btn-primary btn-sm" 
													data-id="{{ $item->id }}"
													data-image="/assets/images/Marketting/Wh_app_template/{{ $item->image }}"
													data-title="{{ !empty($item->title) && $item->title != '-' ? $item->title : '' }}"
													data-subtitle="{{ !empty($item->sub_title) && $item->sub_title != '-' ? $item->sub_title : '' }}"
													data-line1="{{ !empty($item->line1) && $item->line1 != '-' ? $item->line1 : '' }}"
													data-line2="{{ !empty($item->line2) && $item->line2 != '-' ? $item->line2 : '' }}"
													data-phone="{{ !empty($item->ph_no) && $item->ph_no != '-' ? $item->ph_no : '' }}"
													title="Edit & Customize Poster"> 
													<i class="fa fa-pencil me-1"></i> Edit
												</button>
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
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .swal2-popup {
        font-size: 1.4rem !important;
    }
    .poster-canvas-wrapper {
        overflow: hidden;
    }
    /* Sleek Canva Segmented Tabs */
    .studio-tab-bar {
        display: flex !important;
        background: #f1f5f9 !important;
        border-radius: 8px !important;
        padding: 3px !important;
        gap: 4px !important;
        border: 1px solid #e2e8f0 !important;
    }
    .studio-tab-btn {
        flex: 1 1 50% !important;
        padding: 6px 10px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        text-align: center !important;
        border: 0 !important;
        outline: none !important;
        box-shadow: none !important;
        background: transparent !important;
        color: #64748b !important;
        border-radius: 6px !important;
        cursor: pointer !important;
        transition: all 0.15s ease-in-out !important;
    }
    .studio-tab-btn.active {
        background: #183543 !important;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(24, 53, 67, 0.35) !important;
    }
    #btn_download_poster:hover {
        background-color: #24495c !important;
        border-color: #24495c !important;
        color: #ffffff !important;
    }
    .studio-tab-pane {
        animation: studioFadeIn 0.15s ease-in-out;
    }
    @keyframes studioFadeIn {
        from { opacity: 0; transform: translateY(2px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* UNIFORM INPUT & SELECT BOX SIZING & DESIGNS */
    #posterStudioModal .studio-label {
        font-size: 11px !important;
        font-weight: 700 !important;
        color: #475569 !important;
        margin-bottom: 2px !important;
        display: flex !important;
        align-items: center !important;
        gap: 4px !important;
        letter-spacing: 0.2px;
    }
    #posterStudioModal .studio-input,
    #posterStudioModal input.form-control,
    #posterStudioModal select.form-select {
        height: 34px !important;
        min-height: 34px !important;
        max-height: 34px !important;
        font-size: 12px !important;
        line-height: 1.4 !important;
        padding: 5px 9px !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        background-color: #ffffff !important;
        color: #1e293b !important;
        box-shadow: none !important;
        box-sizing: border-box !important;
        width: 100% !important;
        transition: all 0.15s ease-in-out !important;
    }
    #posterStudioModal .studio-input:focus,
    #posterStudioModal input.form-control:focus,
    #posterStudioModal select.form-select:focus {
        border-color: #183543 !important;
        box-shadow: 0 0 0 3px rgba(24, 53, 67, 0.15) !important;
        outline: none !important;
    }
    #posterStudioModal .studio-input-group {
        height: 34px !important;
    }
    #posterStudioModal .studio-input-group .input-group-text {
        height: 34px !important;
        min-height: 34px !important;
        padding: 5px 10px !important;
        font-size: 12px !important;
        border-radius: 6px 0 0 6px !important;
        border: 1px solid #cbd5e1 !important;
        border-right: none !important;
    }
    #posterStudioModal .studio-input-group .form-control {
        border-radius: 0 6px 6px 0 !important;
    }
    #posterStudioModal input[type="file"].studio-input {
        padding: 3px 6px !important;
        font-size: 11px !important;
        line-height: 24px !important;
    }
    #posterStudioModal input[type="range"].form-range {
        height: 20px !important;
        padding: 0 !important;
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
    }
    #posterStudioModal input[type="color"],
    #posterStudioModal .studio-color-picker {
        width: 36px !important;
        min-width: 36px !important;
        max-width: 36px !important;
        height: 34px !important;
        flex: 0 0 36px !important;
        padding: 2px !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        cursor: pointer !important;
        box-sizing: border-box !important;
        background-color: #ffffff !important;
    }
    /* Elegant Subtle Scrollbar */
    #studioTabContent::-webkit-scrollbar {
        width: 4px;
    }
    #studioTabContent::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 4px;
    }
    #studioTabContent::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    #studioTabContent::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Mobile Responsive Optimizations for Poster Studio */
    @media (max-width: 767.98px) {
        #posterStudioModal .modal-dialog {
            width: 98% !important;
            max-width: 98% !important;
            margin: 8px auto !important;
        }
        #posterStudioModal .modal-content {
            border-radius: 10px !important;
        }
        #posterStudioModal .modal-body {
            padding: 8px !important;
            max-height: calc(90vh - 55px) !important;
        }
        #posterStudioModal .poster-canvas-wrapper {
            min-height: 200px !important;
            max-height: 240px !important;
            padding: 6px !important;
        }
        #posterCanvas {
            max-height: 225px !important;
        }
        #studioTabContent {
            max-height: 380px !important;
            padding-right: 2px !important;
        }
        #posterStudioModal .studio-label {
            font-size: 11px !important;
            margin-bottom: 2px !important;
        }
        #posterStudioModal .studio-input,
        #posterStudioModal input.form-control,
        #posterStudioModal select.form-select {
            height: 33px !important;
            min-height: 33px !important;
            max-height: 33px !important;
            font-size: 11.5px !important;
            padding: 4px 6px !important;
        }
        #posterStudioModal .studio-tab-btn {
            font-size: 11px !important;
            padding: 5px 6px !important;
        }
        #posterStudioModal .card {
            padding: 10px !important;
        }
    }

    #posterMobileSaveModal {
        z-index: 1070 !important;
    }
    #posterMobileSaveModal .modal-dialog {
        z-index: 1075 !important;
    }
    .modal-backdrop.show ~ .modal-backdrop.show {
        z-index: 1065 !important;
    }
</style>
<script>
    // Canva segmented tab switching
    $(document).on('click', '.studio-tab-btn', function(e) {
        e.preventDefault();
        $('.studio-tab-btn').removeClass('active');
        $(this).addClass('active');
        const target = $(this).data('target');
        $('.studio-tab-pane').hide();
        $(target).fadeIn(150);
    });

    // Reliable modal close button handlers
    $(document).on('click', '.close-studio-modal-btn', function(e) {
        e.preventDefault();
        $('#posterStudioModal').modal('hide');
    });

    // When clicking Edit on the table row, directly open the Canva-style Poster Studio
    $(document).on('click', '.edit_facebook', function(e){
        e.preventDefault();
        const btn = $(this);
        const ad_id = btn.data('id') || btn.val() || btn.closest('button').val();
        const dataImage = btn.data('image');

        var url = "{{route('vendorwhatsapp.edit', ':ad_id')}}".replace(":ad_id", ad_id);

        $.ajax({
             url: url,       
             type: "get",
             dataType: 'json',
             success: function (response) {
                if(response.status == 200 && response.whapp) {
                    var data = response.whapp;
                    var img = data.image ? "/assets/images/Marketting/Wh_app_template/" + data.image : getSameOriginImageUrl(dataImage);
                    var title = (data.title && data.title !== '-') ? data.title : '';
                    var subtitle = (data.sub_title && data.sub_title !== '-') ? data.sub_title : '';
                    var line1 = (data.line1 && data.line1 !== '-') ? data.line1 : '';
                    var line2 = (data.line2 && data.line2 !== '-') ? data.line2 : '';
                    var phone = (data.ph_no && data.ph_no !== '-') ? data.ph_no : '';
                    openPosterStudio(data.id, img, title, subtitle, line1, line2, phone);
                }
                else {
                    openPosterStudio(
                        btn.data('id'),
                        btn.data('image'),
                        btn.data('title'),
                        btn.data('subtitle'),
                        btn.data('line1'),
                        btn.data('line2'),
                        btn.data('phone')
                    );
                }
            },
            error: function() {
                openPosterStudio(
                    btn.data('id'),
                    btn.data('image'),
                    btn.data('title'),
                    btn.data('subtitle'),
                    btn.data('line1'),
                    btn.data('line2'),
                    btn.data('phone')
                );
            }
        });
    });

    // ==========================================
    // CANVA-STYLE POSTER STUDIO & LIVE DOWNLOAD
    // ==========================================
    let studioImage = new Image();

    function wrapText(ctx, text, x, y, maxWidth, lineHeight) {
        const words = text.split(' ');
        let line = '';
        let currentY = y;
        for (let n = 0; n < words.length; n++) {
            const testLine = line + words[n] + ' ';
            const metrics = ctx.measureText(testLine);
            if (metrics.width > maxWidth && n > 0) {
                ctx.fillText(line.trim(), x, currentY);
                line = words[n] + ' ';
                currentY += lineHeight;
            } else {
                line = testLine;
            }
        }
        ctx.fillText(line.trim(), x, currentY);
        return currentY + lineHeight;
    }

    function getWrappedLines(ctx, text, maxWidth) {
        if (!text) return [];
        const words = text.split(' ');
        let line = '';
        const lines = [];
        for (let n = 0; n < words.length; n++) {
            const testLine = line + words[n] + ' ';
            const metrics = ctx.measureText(testLine);
            if (metrics.width > maxWidth && n > 0) {
                lines.push(line.trim());
                line = words[n] + ' ';
            } else {
                line = testLine;
            }
        }
        if (line.trim().length > 0) {
            lines.push(line.trim());
        }
        return lines;
    }

    function roundRect(ctx, x, y, width, height, radius, fill, stroke) {
        if (typeof radius === 'number') {
            radius = {tl: radius, tr: radius, br: radius, bl: radius};
        }
        ctx.beginPath();
        ctx.moveTo(x + radius.tl, y);
        ctx.lineTo(x + width - radius.tr, y);
        ctx.quadraticCurveTo(x + width, y, x + width, y + radius.tr);
        ctx.lineTo(x + width, y + height - radius.br);
        ctx.quadraticCurveTo(x + width, y + height, x + width - radius.br, y + height);
        ctx.lineTo(x + radius.bl, y + height);
        ctx.quadraticCurveTo(x, y + height, x, y + height - radius.bl);
        ctx.lineTo(x, y + radius.tl);
        ctx.quadraticCurveTo(x, y, x + radius.tl, y);
        ctx.closePath();
        if (fill) ctx.fill();
        if (stroke) ctx.stroke();
    }

    function cleanStudioText(str) {
        if (str === null || str === undefined) return '';
        const trimmed = String(str).trim();
        if (trimmed === '-' || trimmed === 'null' || trimmed === 'undefined') return '';
        return trimmed;
    }

    function getStudioLineSizePx(code, defaultPx) {
        if (code === 'xs') return 22;
        if (code === 'small') return 28;
        if (code === 'medium') return 38;
        if (code === 'large') return 54;
        if (code === 'xlarge') return 70;
        if (code === 'huge') return 88;
        if (code === 'giant') return 108;
        return defaultPx || 38;
    }

    function getStudioPillFontSizePx(code) {
        if (code === 'xs') return 16;
        if (code === 'small') return 18;
        if (code === 'normal') return 21;
        if (code === 'medium') return 25;
        if (code === 'large') return 30;
        if (code === 'xlarge') return 36;
        return 21;
    }

    function getStudioAddrFontSizePx(code) {
        if (code === 'xs') return 18;
        if (code === 'small') return 20;
        if (code === 'normal') return 24;
        if (code === 'medium') return 28;
        if (code === 'large') return 32;
        if (code === 'xlarge') return 38;
        if (code === 'huge') return 44;
        return 24;
    }

    function getStudioDomainFontSizePx(code) {
        if (code === 'xs') return 15;
        if (code === 'small') return 17;
        if (code === 'normal') return 19;
        if (code === 'medium') return 22;
        if (code === 'large') return 26;
        if (code === 'xlarge') return 30;
        return 19;
    }

    function renderStudioPoster() {
        const canvas = document.getElementById('posterCanvas');
        if (!canvas || !studioImage.complete || studioImage.naturalWidth === 0) return;
        const ctx = canvas.getContext('2d');

        const W = studioImage.naturalWidth;
        const H = studioImage.naturalHeight;
        canvas.width = W;
        canvas.height = H;

        // 1. Photo Filter / Mood
        const filterMood = $('#studio_filter').val() || 'none';
        ctx.save();
        if (filterMood === 'vivid') {
            ctx.filter = 'contrast(1.18) saturate(1.3) brightness(1.02)';
        } else if (filterMood === 'warm') {
            ctx.filter = 'sepia(0.25) saturate(1.2) brightness(1.02)';
        } else if (filterMood === 'cool') {
            ctx.filter = 'hue-rotate(15deg) contrast(1.1) saturate(1.1)';
        } else if (filterMood === 'vintage') {
            ctx.filter = 'sepia(0.4) contrast(0.95) brightness(0.95)';
        } else if (filterMood === 'bw') {
            ctx.filter = 'grayscale(1) contrast(1.25)';
        } else {
            ctx.filter = 'none';
        }

        // Draw base template image
        ctx.drawImage(studioImage, 0, 0, W, H);
        ctx.restore();

        const scale = W / 1080;
        const pad = 48 * scale;
        const theme = $('#studio_theme').val() || 'classic';
        const fontChoice = $('#studio_font').val() || 'sans';
        let baseFont = "'Nunito', 'Segoe UI', 'Apple Color Emoji', 'Segoe UI Emoji', 'Noto Color Emoji', sans-serif";
        if (fontChoice === 'impact') {
            baseFont = "'Impact', 'Arial Black', 'Apple Color Emoji', 'Segoe UI Emoji', 'Noto Color Emoji', sans-serif";
        } else if (fontChoice === 'serif') {
            baseFont = "'Georgia', 'Playfair Display', 'Apple Color Emoji', 'Segoe UI Emoji', 'Noto Color Emoji', serif";
        }

        // Vignette / Photo Darkening
        const vignette = parseInt($('#studio_vignette').val() || '25', 10);
        $('#vignette_val').text(vignette + '%');
        if (vignette > 0) {
            ctx.fillStyle = `rgba(0, 0, 0, ${vignette / 100})`;
            ctx.fillRect(0, 0, W, H);
        }

        const line1 = cleanStudioText($('#studio_line1').val());
        const line2 = cleanStudioText($('#studio_line2').val());
        const phone = cleanStudioText($('#studio_phone').val());

        // Theme configurations
        let titleColor = '#FFFFFF';
        let subTitleColor = '#FFD700'; // Gold
        let cardBg = 'rgba(15, 23, 42, 0.78)';
        let cardBorder = 'rgba(255, 255, 255, 0.25)';
        let barBg = '#075E54'; // WhatsApp dark green
        let barAccent = '#25D366';

        if (theme === 'crimson') {
            titleColor = '#FEF08A';
            subTitleColor = '#FFFFFF';
            cardBg = 'rgba(153, 27, 27, 0.85)'; // Crimson
            barBg = '#7F1D1D';
            barAccent = '#FBBF24';
        } else if (theme === 'modern') {
            titleColor = '#FFFFFF';
            subTitleColor = '#38BDF8';
            cardBg = 'rgba(17, 24, 39, 0.85)';
            barBg = '#0F172A';
            barAccent = '#38BDF8';
        } else if (theme === 'vibrant') {
            titleColor = '#FFFFFF';
            subTitleColor = '#FACC15';
            cardBg = 'rgba(6, 78, 59, 0.85)';
            barBg = '#15803D';
            barAccent = '#4ADE80';
        } else if (theme === 'royal') {
            titleColor = '#FEF08A';
            subTitleColor = '#FFFFFF';
            cardBg = 'rgba(88, 28, 135, 0.85)';
            barBg = '#4C1D95';
            barAccent = '#FBBF24';
        } else if (theme === 'minimal') {
            titleColor = '#FFFFFF';
            subTitleColor = '#FFFFFF';
            cardBg = 'rgba(0, 0, 0, 0.45)';
            cardBorder = 'rgba(255, 255, 255, 0.15)';
            barBg = 'rgba(0, 0, 0, 0.85)';
            barAccent = '#E2E8F0';
        }

        const isDarkColor = function(hex) {
            if (!hex) return false;
            const clean = hex.replace('#', '').toLowerCase();
            if (clean === 'black' || clean === '000000' || clean === '111111') return true;
            if (clean.length === 6) {
                const r = parseInt(clean.substring(0, 2), 16) || 0;
                const g = parseInt(clean.substring(2, 4), 16) || 0;
                const b = parseInt(clean.substring(4, 6), 16) || 0;
                return (r * 0.299 + g * 0.587 + b * 0.114) < 120;
            }
            return false;
        };

        // ----------------------------------------------------
        // 2. BOTTOM FASHION BANNER & OFFER PILL (COORDINATE CALCULATION)
        // ----------------------------------------------------
        const addressRaw = cleanStudioText($('#studio_line1').val());
        const phoneRaw = cleanStudioText($('#studio_phone').val());
        const pillTextRaw = cleanStudioText($('#studio_line2').val());
        const fixedDomain = '@trymenow.in';

        // Compose top line of address bar with icons
        let addressLine = '';
        if (addressRaw && phoneRaw) {
            addressLine = '📍 ' + addressRaw + '   •   📞 ' + phoneRaw;
        } else if (addressRaw) {
            addressLine = '📍 ' + addressRaw;
        } else if (phoneRaw) {
            addressLine = '📞 ' + phoneRaw;
        } else {
            addressLine = '📍 FASHION 600, T.NAGAR';
        }

        const pillText = pillTextRaw;
        const hasPill = pillText && pillText !== 'none' && pillText !== '';

        const pillFs = getStudioPillFontSizePx($('#studio_pill_size').val());
        const pillH = Math.round((pillFs + 23) * scale);
        const pillBottomMargin = Math.round(20 * scale);
        const pillY = H - pillH - pillBottomMargin;

        const addrFsSetting = getStudioAddrFontSizePx($('#studio_addr_size').val());
        const domainFsSetting = getStudioDomainFontSizePx($('#studio_domain_size').val());
        const addrMarginTop = parseInt($('#studio_addr_margin_top').val() || '4', 10);
        const gapBetweenBarAndPill = Math.round(14 * scale);

        // Structured bar padding & height
        const barPadTop = Math.round((8 + addrMarginTop) * scale);
        const barLineGap = Math.round(16 * scale);
        const barPadBottom = Math.round(18 * scale);
        const barH = Math.round(barPadTop + (addrFsSetting * scale) + barLineGap + (domainFsSetting * scale) + barPadBottom);
        const barY = hasPill ? (pillY - gapBetweenBarAndPill - barH) : (H - barH - (18 * scale));

        // 3. Main 6 Lines of Poster Text (Custom Sizes, Common Position/Alignment & Unified Color)
        const posterLines = [
            { lineNum: 1, text: cleanStudioText($('#studio_txt_1').val()), size: getStudioLineSizePx($('#studio_txt_1_size').val(), 28), mTop: parseInt($('#studio_txt_1_margin_top').val() || '0', 10) },
            { lineNum: 2, text: cleanStudioText($('#studio_txt_2').val()), size: getStudioLineSizePx($('#studio_txt_2_size').val(), 88), mTop: parseInt($('#studio_txt_2_margin_top').val() || '0', 10) },
            { lineNum: 3, text: cleanStudioText($('#studio_txt_3').val()), size: getStudioLineSizePx($('#studio_txt_3_size').val(), 88), mTop: parseInt($('#studio_txt_3_margin_top').val() || '0', 10) },
            { lineNum: 4, text: cleanStudioText($('#studio_txt_4').val()), size: getStudioLineSizePx($('#studio_txt_4_size').val(), 38), mTop: parseInt($('#studio_txt_4_margin_top').val() || '18', 10) },
            { lineNum: 5, text: cleanStudioText($('#studio_txt_5').val()), size: getStudioLineSizePx($('#studio_txt_5_size').val(), 108), mTop: parseInt($('#studio_txt_5_margin_top').val() || '0', 10) },
            { lineNum: 6, text: cleanStudioText($('#studio_txt_6').val()), size: getStudioLineSizePx($('#studio_txt_6_size').val(), 38), mTop: parseInt($('#studio_txt_6_margin_top').val() || '0', 10) }
        ].filter(l => l.text !== '');

        if (posterLines.length > 0) {
            ctx.save();
            const textPos = $('#studio_text_pos').val() || 'top-right';

            // Common Color for all 6 lines
            const colorPreset = $('#studio_text_color_preset').val() || '#FFFFFF';
            let finalTextColor = colorPreset;
            if (colorPreset === 'custom') {
                finalTextColor = $('#studio_text_color_picker').val() || '#FFFFFF';
            }

            // Alignment & X coordinate
            let textAlign = 'right';
            let textX = W - pad;
            let maxTextW = Math.round(W * 0.70);

            if (textPos.endsWith('-left')) {
                textAlign = 'left';
                textX = pad;
                maxTextW = Math.round(W * 0.70);
            } else if (textPos.endsWith('-center')) {
                textAlign = 'center';
                textX = W / 2;
                maxTextW = W - (pad * 2);
            } else {
                textAlign = 'right';
                textX = W - pad;
                maxTextW = Math.round(W * 0.70);
            }

            // Pre-calculate exact wrapped lines and heights for each item
            const preparedBlocks = [];
            let totalLinesH = 0;

            posterLines.forEach(l => {
                ctx.font = `bold ${Math.round(l.size * scale)}px ${baseFont}`;
                const wrapped = getWrappedLines(ctx, l.text.toUpperCase(), maxTextW);
                const lineH = Math.round(l.size * 1.15 * scale);
                const extraMarginTop = (l.lineNum === 1) ? 0 : Math.round(l.mTop * scale);
                const blockH = (Math.max(1, wrapped.length) * lineH) + extraMarginTop;
                totalLinesH += blockH;
                preparedBlocks.push({
                    lineNum: l.lineNum,
                    size: l.size,
                    lineH: lineH,
                    extraMarginTop: extraMarginTop,
                    wrappedLines: wrapped.length > 0 ? wrapped : [l.text.toUpperCase()]
                });
            });

            // Start Y coordinate
            const line1MarginTop = Math.round(parseInt($('#studio_txt_1_margin_top').val() || '0', 10) * scale);
            let currentY = (54 * scale) + line1MarginTop;
            if (textPos.startsWith('top-')) {
                currentY = (60 * scale) + line1MarginTop;
            } else if (textPos.startsWith('middle-')) {
                currentY = Math.max(60 * scale, Math.round((H * 0.40) - (totalLinesH / 2))) + line1MarginTop;
            } else if (textPos.startsWith('bottom-')) {
                const bottomBoundary = barY - (30 * scale);
                currentY = Math.max(50 * scale, bottomBoundary - totalLinesH);
            }

            // Shadow / Glow styling
            const shadowMode = $('#studio_text_shadow').val() || 'auto';
            let shadowColor = 'rgba(0, 0, 0, 0.95)';
            let shadowBlur = 18 * scale;

            if (shadowMode === 'none') {
                shadowColor = 'transparent';
                shadowBlur = 0;
            } else if (shadowMode === 'light' || (shadowMode === 'auto' && isDarkColor(finalTextColor))) {
                shadowColor = 'rgba(255, 255, 255, 0.88)';
                shadowBlur = 10 * scale;
            } else {
                shadowColor = 'rgba(0, 0, 0, 0.95)';
                shadowBlur = 18 * scale;
            }

            ctx.textAlign = textAlign;
            ctx.textBaseline = 'top';
            ctx.fillStyle = finalTextColor;
            ctx.shadowColor = shadowColor;
            ctx.shadowBlur = shadowBlur;

            // Render each wrapped line cleanly without overlapping bottom bar
            preparedBlocks.forEach(block => {
                if (block.extraMarginTop > 0) {
                    currentY += block.extraMarginTop;
                }
                ctx.save();
                ctx.font = `bold ${Math.round(block.size * scale)}px ${baseFont}`;
                block.wrappedLines.forEach(wl => {
                    ctx.fillText(wl, textX, currentY);
                    currentY += block.lineH;
                });
                ctx.restore();
            });

            ctx.restore();
        }

        // ----------------------------------------------------
        // 4. DRAW ADDRESS & FIXED DOMAIN BAR (Customizable Background & Text Color)
        // ----------------------------------------------------
        const finalBarBg = $('#studio_bar_bg_picker').val() || '#121212';
        const finalBarTextColor = $('#studio_bar_text_picker').val() || '#FFFFFF';

        ctx.save();
        ctx.fillStyle = finalBarBg;
        ctx.fillRect(0, barY, W, barH);

        // Top line: Store Address / Location
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillStyle = finalBarTextColor;
        ctx.shadowColor = isDarkColor(finalBarTextColor) ? 'rgba(255, 255, 255, 0.5)' : 'rgba(0, 0, 0, 0.6)';
        ctx.shadowBlur = 4 * scale;

        let addrFs = addrFsSetting;
        ctx.font = `700 ${Math.round(addrFs * scale)}px ${baseFont}`;
        const maxBarTextW = W - (40 * scale);
        while (ctx.measureText(addressLine).width > maxBarTextW && addrFs > 12) {
            addrFs -= 1;
            ctx.font = `700 ${Math.round(addrFs * scale)}px ${baseFont}`;
        }
        const addrY = barY + barPadTop + Math.round((addrFs * 0.5) * scale);
        ctx.fillText(addressLine, W / 2, addrY);

        // Bottom line: 🌐 @trymenow.in (FIXED with configurable font size)
        ctx.fillStyle = finalBarTextColor;
        ctx.shadowBlur = 0;
        let domainFs = domainFsSetting;
        ctx.font = `600 ${Math.round(domainFs * scale)}px ${baseFont}`;
        const maxDomainW = W - (40 * scale);
        while (ctx.measureText('🌐 ' + fixedDomain).width > maxDomainW && domainFs > 10) {
            domainFs -= 1;
            ctx.font = `600 ${Math.round(domainFs * scale)}px ${baseFont}`;
        }
        const domainY = addrY + Math.round((addrFs * 0.5) * scale) + barLineGap + Math.round((domainFs * 0.5) * scale);
        ctx.fillText('🌐 ' + fixedDomain, W / 2, domainY);
        ctx.restore();

        // ----------------------------------------------------
        // 5. DRAW OFFER BADGE PILL (Capsule with Gradient below Address Bar)
        // ----------------------------------------------------
        if (hasPill) {
            ctx.save();
            ctx.font = `700 ${Math.round(pillFs * scale)}px ${baseFont}`;
            const textMetrics = ctx.measureText(pillText);
            const pillW = Math.max(Math.round((pillFs * 11) * scale), Math.round(textMetrics.width + (48 * scale)));

            const pillAlign = $('#studio_pill_align').val() || 'center';
            const pillMargin = Math.round(36 * scale);
            let pillX = Math.round((W - pillW) / 2);
            if (pillAlign === 'left') {
                pillX = pillMargin;
            } else if (pillAlign === 'right') {
                pillX = Math.round(W - pillW - pillMargin);
            }

            // Radiant Gradient
            const pillGrad = ctx.createLinearGradient(pillX, 0, pillX + pillW, 0);
            const pillTheme = $('#studio_theme').val() || 'fashion_pink_gold';

            if (pillTheme === 'emerald') {
                pillGrad.addColorStop(0, '#10B981');
                pillGrad.addColorStop(1, '#059669');
            } else if (pillTheme === 'cyber') {
                pillGrad.addColorStop(0, '#38BDF8');
                pillGrad.addColorStop(1, '#6366F1');
            } else if (pillTheme === 'sunset') {
                pillGrad.addColorStop(0, '#EF4444');
                pillGrad.addColorStop(1, '#F97316');
            } else if (pillTheme === 'luxury_gold') {
                pillGrad.addColorStop(0, '#F59E0B');
                pillGrad.addColorStop(1, '#FBBF24');
            } else if (pillTheme === 'minimal') {
                pillGrad.addColorStop(0, '#334155');
                pillGrad.addColorStop(1, '#1E293B');
            } else {
                // Default Reference Style: Fashion Sunrise (Rose Pink to Golden Yellow)
                pillGrad.addColorStop(0, '#F43F5E');
                pillGrad.addColorStop(0.5, '#FB7185');
                pillGrad.addColorStop(1, '#FBBF24');
            }

            ctx.fillStyle = pillGrad;
            ctx.shadowColor = 'rgba(0, 0, 0, 0.35)';
            ctx.shadowBlur = 10 * scale;
            roundRect(ctx, pillX, pillY, pillW, pillH, pillH / 2, true, false);

            // Subtle border highlight
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.45)';
            ctx.lineWidth = 1.5 * scale;
            roundRect(ctx, pillX, pillY, pillW, pillH, pillH / 2, false, true);

            // Pill Text
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillStyle = pillTheme === 'minimal' ? '#FFFFFF' : '#1E293B';
            ctx.shadowColor = 'transparent';
            ctx.shadowBlur = 0;
            ctx.fillText(pillText, pillX + (pillW / 2), pillY + (pillH / 2));
            ctx.restore();
        }

        // 8. Shop Logo / Watermark Stamp (if uploaded)
        if (studioLogoImage && studioLogoImage.complete && studioLogoImage.naturalWidth > 0) {
            ctx.save();
            const maxLogoW = 150 * scale;
            const maxLogoH = 80 * scale;
            let lw = studioLogoImage.naturalWidth;
            let lh = studioLogoImage.naturalHeight;
            const ratio = Math.min(maxLogoW / lw, maxLogoH / lh);
            lw = lw * ratio;
            lh = lh * ratio;

            const lx = 32 * scale;
            const ly = 28 * scale;

            ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
            ctx.shadowColor = 'rgba(0,0,0,0.45)';
            ctx.shadowBlur = 10 * scale;
            roundRect(ctx, lx - 8 * scale, ly - 6 * scale, lw + 16 * scale, lh + 12 * scale, 10 * scale, true, false);

            ctx.drawImage(studioLogoImage, lx, ly, lw, lh);
            ctx.restore();
        }
    }

    let studioLogoImage = null;

    $('#studio_logo_file').on('change', function(e) {
        const file = e.target.files && e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                studioLogoImage = new Image();
                studioLogoImage.onload = function() {
                    $('#logo_options_wrap').removeAttr('style').show();
                    $('#logo_filename_display').text(file.name);
                    renderStudioPoster();
                };
                studioLogoImage.src = evt.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    $('#btn_remove_logo').on('click', function() {
        studioLogoImage = null;
        $('#studio_logo_file').val('');
        $('#logo_options_wrap').attr('style', 'display: none !important;');
        renderStudioPoster();
    });

    $('#studio_text_color_preset').on('change', function() {
        const val = $(this).val();
        if (val !== 'custom') {
            $('#studio_text_color_picker').val(val);
        }
        renderStudioPoster();
    });
    $('#studio_text_color_picker').on('input change', function() {
        $('#studio_text_color_preset').val('custom');
        renderStudioPoster();
    });

    $('#studio_bar_bg_picker').on('input change', function() {
        $('#studio_bar_bg_hex').text($(this).val().toUpperCase());
        renderStudioPoster();
    });

    $('#studio_bar_text_picker').on('input change', function() {
        $('#studio_bar_text_hex').text($(this).val().toUpperCase());
        renderStudioPoster();
    });

    // Offer Badge Pill Presets (in Tab 2)
    $('#studio_cta').on('change', function() {
        const val = $(this).val();
        if (val === 'none') {
            $('#studio_line2').hide().val('');
        } else if (val === 'custom') {
            $('#studio_line2').show().focus();
        } else {
            $('#studio_line2').hide().val(val);
        }
        renderStudioPoster();
    });

    $('#studio_line2').on('input', function() {
        renderStudioPoster();
    });

    function getSameOriginImageUrl(url) {
        if (!url) return '';
        if (url.startsWith('data:') || url.startsWith('blob:')) return url;
        try {
            const u = new URL(url, window.location.href);
            const idx = u.pathname.indexOf('/assets/');
            if (idx !== -1) {
                return window.location.origin + u.pathname.substring(idx);
            }
            return u.pathname;
        } catch (e) {
            return url;
        }
    }

    function downloadCanvasImage(canvas, filename, mimeType) {
        if (!canvas) return;
        mimeType = mimeType || 'image/png';
        const isJpeg = mimeType === 'image/jpeg' || mimeType === 'image/jpg';
        const ext = isJpeg ? '.jpg' : '.png';

        // Guarantee filename ends with correct image extension
        let baseName = (filename || 'poster').replace(/\.[a-zA-Z0-9]+$/, '').replace(/[^a-zA-Z0-9_\-]/g, '-').replace(/-+/g, '-').replace(/^-+|-+$/g, '');
        if (!baseName) baseName = 'poster';
        filename = baseName + ext;

        let dataUrl = '';
        try {
            dataUrl = canvas.toDataURL(mimeType, isJpeg ? 0.92 : undefined);
        } catch (e) {
            console.error('Canvas export error:', e);
            Swal.fire({
                icon: 'error',
                title: 'Export Failed',
                text: 'Canvas could not be exported: ' + e.message
            });
            return;
        }

        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth < 768;

        const $btn = $('#btn_download_poster');
        const originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-2"></i> Downloading Poster...');

        function restoreBtn() {
            $btn.prop('disabled', false).html(originalHtml);
        }

        function fallbackDirect(doc, safeFilename, type) {
            type = type || mimeType;
            var $form = $('<form></form>').attr({
                method: 'POST',
                action: '/export-table-direct',
                style: 'display:none;'
            });
            $form.append($('<textarea name="content"></textarea>').val(doc));
            $form.append($('<input type="hidden" name="filename">').val(safeFilename));
            $form.append($('<input type="hidden" name="is_base64">').val('1'));
            $form.append($('<input type="hidden" name="mime_type">').val(type));
            var token = $('meta[name="csrf-token"]').attr('content') || '';
            if (token) $form.append($('<input type="hidden" name="_token">').val(token));
            $('body').append($form);
            $form.submit();
            setTimeout(function() {
                $form.remove();
                restoreBtn();
            }, 3000);
        }

        // On mobile / webview: also prepare preview modal as long-press fallback
        if (isMobile) {
            $('#mobile_preview_poster_img').attr('src', dataUrl);
            $('#btn_mobile_direct_download').attr('href', dataUrl).attr('download', filename);
        }

        var csrfToken = $('meta[name="csrf-token"]').attr('content') || '';

        // Use the exact same server-assisted download method as Export Excel (100% WebView / Mobile compatible)
        $.ajax({
            url: '/export-table-data',
            type: 'POST',
            data: {
                content: dataUrl,
                filename: filename,
                mime_type: mimeType,
                is_base64: 1,
                _token: csrfToken
            },
            dataType: 'json',
            timeout: 10000,
            success: function(resp) {
                if (resp && resp.download_url) {
                    window.location.href = resp.download_url;
                    Swal.fire({
                        icon: 'success',
                        title: 'Poster Downloaded!',
                        text: 'Your customized poster was saved to your Downloads folder (' + (isJpeg ? 'JPG' : 'PNG') + ').',
                        timer: 2500,
                        showConfirmButton: false
                    });
                } else {
                    fallbackDirect(dataUrl, filename, mimeType);
                }
            },
            error: function() {
                fallbackDirect(dataUrl, filename, mimeType);
            },
            complete: function() {
                setTimeout(function() {
                    restoreBtn();
                }, 2000);
            }
        });
    }

    function openPosterStudio(id, imageSrc, title, subtitle, line1, line2, phone) {
        $('#studio_item_id').val(id);
        imageSrc = getSameOriginImageUrl(imageSrc);

        const cleanTitle = cleanStudioText(title);
        const cleanSub = cleanStudioText(subtitle);

        if (cleanTitle || cleanSub) {
            $('#studio_txt_1').val(cleanTitle || '');
            $('#studio_txt_2').val(cleanSub || '');
            $('#studio_txt_3').val('');
            $('#studio_txt_4').val('');
            $('#studio_txt_5').val('');
            $('#studio_txt_6').val('');
        } else {
            // Default 6 lines matching fashion sale style
            $('#studio_txt_1').val('SPECIAL OFFER');
            $('#studio_txt_2').val('FASHION');
            $('#studio_txt_3').val('SALE');
            $('#studio_txt_4').val('UP TO');
            $('#studio_txt_5').val('50%');
            $('#studio_txt_6').val('OFF');
        }

        $('#studio_txt_1_size').val('small');
        $('#studio_txt_2_size').val('huge');
        $('#studio_txt_3_size').val('huge');
        $('#studio_txt_4_size').val('medium');
        $('#studio_txt_5_size').val('giant');
        $('#studio_txt_6_size').val('medium');

        const cleanL1 = cleanStudioText(line1);
        const cleanL2 = cleanStudioText(line2);
        $('#studio_line1').val(cleanL1 || 'FASHION 600, T.NAGAR');
        let initialPill = (cleanL2 !== undefined && cleanL2 !== null && cleanL2 !== '') ? cleanL2 : '✨ Free Delivery';

        let foundPreset = false;
        let matchedVal = '';
        if (initialPill) {
            $('#studio_cta option').each(function() {
                const optVal = $(this).val();
                if (optVal !== 'custom' && optVal !== 'none') {
                    const cleanOpt = optVal.replace(/^[^\w\s]+/u, '').trim().toLowerCase();
                    const cleanInit = initialPill.replace(/^[^\w\s]+/u, '').trim().toLowerCase();
                    if (optVal.toLowerCase() === initialPill.toLowerCase() || (cleanOpt && cleanOpt === cleanInit)) {
                        $('#studio_cta').val(optVal);
                        matchedVal = optVal;
                        foundPreset = true;
                        return false;
                    }
                }
            });
        } else {
            $('#studio_cta').val('none');
            foundPreset = true;
        }
        if (foundPreset && matchedVal) {
            $('#studio_line2').val(matchedVal).hide();
        } else if (!foundPreset) {
            $('#studio_cta').val('custom');
            $('#studio_line2').val(initialPill).show();
        } else {
            $('#studio_line2').val('').hide();
        }
        $('#studio_phone').val(cleanStudioText(phone));

        $('#studio_bar_bg_picker').val('#121212');
        $('#studio_bar_bg_hex').text('#121212');
        $('#studio_bar_text_picker').val('#FFFFFF');
        $('#studio_bar_text_hex').text('#FFFFFF');

        $('#studio_addr_size').val('normal');
        $('#studio_addr_margin_top').val('4');
        $('#studio_domain_size').val('normal');
        $('#studio_txt_1_margin_top').val('0');
        $('#studio_txt_2_margin_top').val('0');
        $('#studio_txt_3_margin_top').val('0');
        $('#studio_txt_4_margin_top').val('18');
        $('#studio_txt_5_margin_top').val('0');
        $('#studio_txt_6_margin_top').val('0');
        $('#studio_pill_align').val('center');
        $('#studio_pill_size').val('normal');
        $('#studio_text_pos').val('top-right');
        $('#studio_text_color_preset').val('#FFFFFF');
        $('#studio_text_color_picker').val('#FFFFFF');
        $('#studio_text_shadow').val('auto');
        $('#studio_theme').val('fashion_pink_gold');

        // Reset to Tab 1
        $('.studio-tab-btn').removeClass('active');
        $('.studio-tab-btn[data-target="#tab-content"]').addClass('active');
        $('.studio-tab-pane').hide();
        $('#tab-content').show();

        studioImage = new Image();
        studioImage.crossOrigin = 'anonymous';
        studioImage.onload = function() {
            $('#canvas_dimensions_badge').text(studioImage.naturalWidth + ' × ' + studioImage.naturalHeight);
            renderStudioPoster();
            $('#posterStudioModal').modal('show');
        };
        studioImage.onerror = function() {
            studioImage = new Image();
            studioImage.onload = function() {
                $('#canvas_dimensions_badge').text(studioImage.naturalWidth + ' × ' + studioImage.naturalHeight);
                renderStudioPoster();
                $('#posterStudioModal').modal('show');
            };
            studioImage.src = imageSrc;
        };
        studioImage.src = imageSrc;
    }

    // Click "Download Poster" button in table row
    $(document).on('click', '.open-studio-btn', function(e) {
        e.preventDefault();
        const btn = $(this);
        openPosterStudio(
            btn.data('id'),
            btn.data('image'),
            btn.data('title'),
            btn.data('subtitle'),
            btn.data('line1'),
            btn.data('line2'),
            btn.data('phone')
        );
    });

    // Real-time live Canva typing preview
    $('.studio-input').on('input change', function() {
        renderStudioPoster();
    });

    // Instant High-Res PNG Download (Mobile & Desktop Compatible)
    $(document).on('click', '#btn_download_poster, #btn_mobile_direct_download', function(e) {
        e.preventDefault();
        const canvas = document.getElementById('posterCanvas');
        if (!canvas) return;

        const title = cleanStudioText($('#studio_txt_1').val()) || cleanStudioText($('#studio_txt_2').val()) || 'poster';
        const cleanTitle = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '') || 'poster';
        const cleanFilename = 'whatsapp-poster-' + cleanTitle + '.png';

        downloadCanvasImage(canvas, cleanFilename, 'image/png');
    });

    // Instant High-Quality JPEG Download (Mobile & Desktop Compatible)
    $('#btn_download_jpeg').on('click', function(e) {
        e.preventDefault();
        const canvas = document.getElementById('posterCanvas');
        if (!canvas) return;

        const title = cleanStudioText($('#studio_txt_1').val()) || cleanStudioText($('#studio_txt_2').val()) || 'poster';
        const cleanTitle = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '') || 'poster';
        const cleanFilename = 'whatsapp-poster-' + cleanTitle + '.jpg';

        downloadCanvasImage(canvas, cleanFilename, 'image/jpeg');
    });

    // Save Studio Customization back to shop database
    $('#btn_save_studio_data').on('click', function() {
        const id = $('#studio_item_id').val();
        if (!id) return;

        const title = cleanStudioText($('#studio_txt_1').val());
        const txt2 = cleanStudioText($('#studio_txt_2').val());
        const otherLines = [
            cleanStudioText($('#studio_txt_3').val()),
            cleanStudioText($('#studio_txt_4').val()),
            cleanStudioText($('#studio_txt_5').val()),
            cleanStudioText($('#studio_txt_6').val())
        ].filter(Boolean).join(' ');

        const subtitle = [txt2, otherLines].filter(Boolean).join(' ');
        const line1 = $('#studio_line1').val();
        const line2 = $('#studio_line2').val();
        const phone = $('#studio_phone').val();
        const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

        const formData = new FormData();
        formData.append('_token', token);
        formData.append('_method', 'PUT');
        formData.append('edit_id', id);
        formData.append('edittitle', title || txt2 || '-');
        formData.append('editsub_title', subtitle || '-');
        formData.append('editline1', line1 || '-');
        formData.append('editline2', line2 || '-');
        formData.append('editph_no', phone || '-');
        formData.append('editstatus', 1);

        const updateUrl = "{{ route('vendorwhatsapp.update', 1) }}";

        $.ajax({
            url: updateUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Saved!',
                    text: 'Customizations have been saved to your shop.',
                    timer: 1800,
                    showConfirmButton: false
                });
                setTimeout(function() {
                    window.location.reload();
                }, 1200);
            },
            error: function(err) {
                console.error('Error saving:', err);
                Swal.fire('Error', 'Could not save customization.', 'error');
            }
        });
    });

    // Status toggle event delegation
    document.body.addEventListener('change', function(e) {
        if (e.target.classList.contains('status-toggle')) {
            const status = e.target.checked ? 1 : 0;
            const item_id = e.target.getAttribute('data-id');
            const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

            fetch("{{ route('vendorwhatsapp.changestatus') }}", {
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
                // Silently succeed
            })
            .catch(error => {
                console.error('Error updating status:', error);
                e.target.checked = !status;
            });
        }
    });
</script>
@endpush

