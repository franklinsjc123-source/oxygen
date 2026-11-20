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

														<div class="tab-content flex-grow-1" id="studioTabContent" style="overflow-y: auto; max-height: 350px; padding-right: 4px;">
															<!-- TAB 1: CONTENT -->
															<div class="studio-tab-pane" id="tab-content" style="display: block;">
																<div class="row g-2 mb-2">
																	<div class="col-7">
																		<label class="studio-label">Shop Name / Header :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_shop_name" value="{{ $vendorName ?? 'My Shop' }}" placeholder="e.g. My Shop">
																	</div>
																	<div class="col-5">
																		<label class="studio-label"><i class="fa fa-text-height me-1 text-primary"></i> Shop Size :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_shop_size">
																			<option value="small">Small (18px)</option>
																			<option value="medium" selected>Medium (24px)</option>
																			<option value="large">Large (32px)</option>
																			<option value="xlarge">Extra Large (42px)</option>
																			<option value="huge">Huge (54px)</option>
																			<option value="none">-- Hide Shop Name --</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-paint-brush me-1 text-primary"></i> Shop Color :</label>
																		<div class="d-flex align-items-center gap-1">
																			<select class="form-select form-select-sm studio-input flex-grow-1" id="studio_shop_color_preset">
																				<option value="#FFD700" selected>Gold / Yellow</option>
																				<option value="#FFFFFF">White</option>
																				<option value="#000000">Black</option>
																				<option value="#EF4444">Crimson Red</option>
																				<option value="#2563EB">Royal Blue</option>
																				<option value="#10B981">Green</option>
																				<option value="#E2E8F0">Soft Silver</option>
																				<option value="custom">Custom...</option>
																			</select>
																			<input type="color" id="studio_shop_color_picker" class="form-control form-control-sm p-0" value="#FFD700" style="width: 34px; height: 31px; border-radius: 6px; cursor: pointer; border: 1px solid #ced4da;" title="Pick Shop Color">
																		</div>
																	</div>
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-star me-1 text-primary"></i> Shop Style :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_shop_style">
																			<option value="stars" selected>★ With Stars ★</option>
																			<option value="clean">Plain Text</option>
																			<option value="badge">Dark Pill Badge</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-7">
																		<label class="studio-label">Campaign Title :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_title" placeholder="e.g. MEGA FESTIVAL SALE">
																	</div>
																	<div class="col-5">
																		<label class="studio-label"><i class="fa fa-text-height me-1 text-primary"></i> Title Size :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_title_size">
																			<option value="small">Small (36px)</option>
																			<option value="medium" selected>Medium (48px)</option>
																			<option value="large">Large (64px)</option>
																			<option value="xlarge">Extra Large (80px)</option>
																			<option value="huge">Huge (96px)</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-7">
																		<label class="studio-label">Sub Title / Tagline :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_subtitle" placeholder="e.g. Flat 30% Off Everything">
																	</div>
																	<div class="col-5">
																		<label class="studio-label"><i class="fa fa-text-height me-1 text-primary"></i> Subtitle Size :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_subtitle_size">
																			<option value="auto" selected>Auto</option>
																			<option value="small">Small (24px)</option>
																			<option value="medium">Medium (34px)</option>
																			<option value="large">Large (48px)</option>
																			<option value="xlarge">Extra Large (62px)</option>
																			<option value="huge">Huge (76px)</option>
																		</select>
																	</div>
																</div>

																{{-- Text Position & Color Customization --}}
																<div class="row g-2 mb-2">
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-arrows me-1 text-primary"></i> Text Position :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_text_pos">
																			<option value="top-center" selected>Top Center</option>
																			<option value="top-left">Top Left</option>
																			<option value="top-right">Top Right</option>
																			<option value="middle-center">Center / Middle</option>
																			<option value="middle-left">Middle Left</option>
																			<option value="middle-right">Middle Right</option>
																			<option value="bottom-center">Bottom Center</option>
																		</select>
																	</div>
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-paint-brush me-1 text-primary"></i> Text / Title Color :</label>
																		<div class="d-flex align-items-center gap-1">
																			<select class="form-select form-select-sm studio-input flex-grow-1" id="studio_title_color_preset">
																				<option value="auto" selected>Auto (Theme)</option>
																				<option value="#FFFFFF">White</option>
																				<option value="#000000">Black</option>
																				<option value="#EF4444">Crimson Red</option>
																				<option value="#FACC15">Gold / Yellow</option>
																				<option value="#2563EB">Royal Blue</option>
																				<option value="#10B981">Green</option>
																				<option value="custom">Custom...</option>
																			</select>
																			<input type="color" id="studio_title_color_picker" class="form-control form-control-sm p-0" value="#FFFFFF" style="width: 34px; height: 31px; border-radius: 6px; cursor: pointer; border: 1px solid #ced4da;" title="Pick Color">
																		</div>
																	</div>
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-tint me-1 text-primary"></i> Subtitle Color :</label>
																		<div class="d-flex align-items-center gap-1">
																			<select class="form-select form-select-sm studio-input flex-grow-1" id="studio_subtitle_color_preset">
																				<option value="auto" selected>Auto (Match Text)</option>
																				<option value="#FFFFFF">White</option>
																				<option value="#000000">Black</option>
																				<option value="#EF4444">Crimson Red</option>
																				<option value="#FACC15">Gold / Yellow</option>
																				<option value="#38BDF8">Sky Blue</option>
																				<option value="#E2E8F0">Soft Silver</option>
																				<option value="custom">Custom...</option>
																			</select>
																			<input type="color" id="studio_subtitle_color_picker" class="form-control form-control-sm p-0" value="#FACC15" style="width: 34px; height: 31px; border-radius: 6px; cursor: pointer; border: 1px solid #ced4da;" title="Pick Subtitle Color">
																		</div>
																	</div>
																	<div class="col-6">
																		<label class="studio-label"><i class="fa fa-adjust me-1 text-primary"></i> Text Shadow :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_text_shadow">
																			<option value="auto" selected>Auto (Contrast)</option>
																			<option value="dark">Dark Shadow</option>
																			<option value="light">Light Glow</option>
																			<option value="none">No Shadow</option>
																		</select>
																	</div>
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-6">
																		<label class="studio-label">Footer Line 1 :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_line1" placeholder="e.g. Special Offer or Store Address">
																	</div>
																	<div class="col-6">
																		<label class="studio-label">Footer Line 2 :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_line2" placeholder="e.g. Valid This Week or Website">
																	</div>
																</div>

																<div class="mb-2">
																	<label class="studio-label">WhatsApp / Contact :</label>
																	<input type="number" min="0" class="form-control form-control-sm studio-input" id="studio_phone" placeholder="e.g. 9876543210">
																</div>
															</div>

															<!-- TAB 2: STYLE & OPTIONS -->
															<div class="studio-tab-pane" id="tab-design" style="display: none;">
																<div class="mb-2">
																	<label class="studio-label">Call-To-Action (CTA) Pill :</label>
																	<select class="form-select form-select-sm studio-input" id="studio_cta">
																		<option value="ORDER NOW" selected>⚡ ORDER NOW</option>
																		<option value="SHOP NOW">🛍️ SHOP NOW</option>
																		<option value="FREE HOME DELIVERY">🚚 FREE HOME DELIVERY</option>
																		<option value="LIMITED STOCK">⏳ LIMITED STOCK</option>
																		<option value="VISIT US TODAY">📍 VISIT US TODAY</option>
																		<option value="BOOK NOW">📅 BOOK NOW</option>
																		<option value="none">-- None --</option>
																	</select>
																</div>

																<div class="mb-2">
																	<label class="studio-label">Color Theme :</label>
																	<select class="form-select form-select-sm studio-input" id="studio_theme">
																		<option value="classic" selected>Classic Gold & White (Festive)</option>
																		<option value="crimson">Ruby Crimson & Gold (Hot Deal)</option>
																		<option value="vibrant">Emerald Green (WhatsApp Brand)</option>
																		<option value="modern">Modern Cyber Blue & White</option>
																		<option value="royal">Royal Purple & Gold</option>
																		<option value="minimal">Clean Minimal (Pure White Glow)</option>
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
													data-image="{{ asset('assets/images/Marketting/Wh_app_template/' . $item->image) }}"
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
                    var img = data.image ? "{{ asset('assets/images/Marketting/Wh_app_template') }}/" + data.image : dataImage;
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
        let baseFont = "'Nunito', 'Segoe UI', sans-serif";
        if (fontChoice === 'impact') {
            baseFont = "'Impact', 'Arial Black', sans-serif";
        } else if (fontChoice === 'serif') {
            baseFont = "'Georgia', 'Playfair Display', serif";
        }

        // Vignette / Photo Darkening
        const vignette = parseInt($('#studio_vignette').val() || '25', 10);
        $('#vignette_val').text(vignette + '%');
        if (vignette > 0) {
            ctx.fillStyle = `rgba(0, 0, 0, ${vignette / 100})`;
            ctx.fillRect(0, 0, W, H);
        }

        const shopName = cleanStudioText($('#studio_shop_name').val());
        const title = cleanStudioText($('#studio_title').val());
        const subtitle = cleanStudioText($('#studio_subtitle').val());
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

        // 2. Shop Name Watermark / Header
        const shopSize = $('#studio_shop_size').val() || 'medium';
        let shopPx = 24;
        const hasShop = shopName && shopSize !== 'none';

        if (hasShop) {
            ctx.save();
            if (shopSize === 'small') shopPx = 18;
            else if (shopSize === 'medium') shopPx = 24;
            else if (shopSize === 'large') shopPx = 32;
            else if (shopSize === 'xlarge') shopPx = 42;
            else if (shopSize === 'huge') shopPx = 54;

            // Shop Color
            const shopColorPreset = $('#studio_shop_color_preset').val() || '#FFD700';
            let finalShopColor = shopColorPreset;
            if (shopColorPreset === 'custom') {
                finalShopColor = $('#studio_shop_color_picker').val() || '#FFD700';
            }

            const shopStyle = $('#studio_shop_style').val() || 'stars';
            let displayText = shopName.toUpperCase();
            if (shopStyle === 'stars') {
                displayText = "★  " + displayText + "  ★";
            }

            const fontStyle = (shopStyle === 'badge') ? 'bold' : '800';
            ctx.font = `${fontStyle} ${Math.round(shopPx * scale)}px ${baseFont}`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'top';

            const shopY = 16 * scale;

            if (shopStyle === 'badge') {
                const textMetrics = ctx.measureText(displayText);
                const badgePadX = 18 * scale;
                const badgePadY = 6 * scale;
                const badgeW = textMetrics.width + (badgePadX * 2);
                const badgeH = (shopPx * 1.25 * scale) + (badgePadY * 2);
                const badgeX = (W - badgeW) / 2;
                const badgeY = shopY - (2 * scale);

                ctx.fillStyle = 'rgba(0, 0, 0, 0.65)';
                roundRect(ctx, badgeX, badgeY, badgeW, badgeH, 12 * scale, true, false);
                ctx.strokeStyle = finalShopColor;
                ctx.lineWidth = 1.5 * scale;
                roundRect(ctx, badgeX, badgeY, badgeW, badgeH, 12 * scale, false, true);

                ctx.fillStyle = finalShopColor;
                ctx.fillText(displayText, W / 2, shopY + badgePadY);
            } else {
                ctx.fillStyle = finalShopColor;
                ctx.shadowColor = 'rgba(0, 0, 0, 0.95)';
                ctx.shadowBlur = 10 * scale;
                ctx.fillText(displayText, W / 2, shopY);
            }
            ctx.restore();
        }

        // 3. Campaign Title / Subtitle with Custom Position, Alignment & Color
        if (title || subtitle) {
            ctx.save();

            const textPos = $('#studio_text_pos').val() || 'top-center';
            const titleColorPreset = $('#studio_title_color_preset').val() || 'auto';
            let finalTitleColor = titleColor;
            if (titleColorPreset === 'custom') {
                finalTitleColor = $('#studio_title_color_picker').val() || '#FFFFFF';
            } else if (titleColorPreset !== 'auto') {
                finalTitleColor = titleColorPreset;
            }

            const subColorPreset = $('#studio_subtitle_color_preset').val() || 'auto';
            let finalSubColor = subTitleColor;
            if (subColorPreset === 'custom') {
                finalSubColor = $('#studio_subtitle_color_picker').val() || '#FACC15';
            } else if (subColorPreset !== 'auto') {
                finalSubColor = subColorPreset;
            } else {
                // If subColorPreset is 'auto':
                // If title is empty, or user customized the main text color, match it!
                if (!title || titleColorPreset !== 'auto') {
                    finalSubColor = finalTitleColor;
                } else {
                    finalSubColor = subTitleColor;
                }
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

            // Notice: Top gradient scrim removed so picking text color NEVER modifies poster background brightness!

            // Determine horizontal alignment and X coordinate
            let textAlign = 'center';
            let textX = W / 2;
            let maxTextW = W - (pad * 2);

            if (textPos.endsWith('-left')) {
                textAlign = 'left';
                textX = pad * 1.1;
                maxTextW = Math.round(W * 0.68);
            } else if (textPos.endsWith('-right')) {
                textAlign = 'right';
                textX = W - (pad * 1.1);
                maxTextW = Math.round(W * 0.68);
            } else {
                textAlign = 'center';
                textX = W / 2;
                maxTextW = W - (pad * 2);
            }

            // Determine vertical start Y coordinate
            let currentY = 40 * scale;
            if (textPos.startsWith('top-')) {
                currentY = hasShop ? (Math.max(54, shopPx + 34) * scale) : (40 * scale);
            } else if (textPos.startsWith('middle-')) {
                currentY = Math.round(H * 0.38);
            } else if (textPos.startsWith('bottom-')) {
                currentY = H - (phone ? (360 * scale) : (270 * scale));
            }

            // Shadow / Glow styling
            const shadowMode = $('#studio_text_shadow').val() || 'auto';
            let shadowColor = 'rgba(0, 0, 0, 0.95)';
            let shadowBlur = 18 * scale;

            if (shadowMode === 'none') {
                shadowColor = 'transparent';
                shadowBlur = 0;
            } else if (shadowMode === 'light' || (shadowMode === 'auto' && isDarkColor(finalTitleColor))) {
                shadowColor = 'rgba(255, 255, 255, 0.88)';
                shadowBlur = 10 * scale;
            } else {
                shadowColor = 'rgba(0, 0, 0, 0.95)';
                shadowBlur = 18 * scale;
            }

            ctx.textAlign = textAlign;
            ctx.textBaseline = 'top';

            // Font size calculations for Title and Subtitle
            let titlePx = 48;
            const tSize = $('#studio_title_size').val() || 'medium';
            if (tSize === 'small') titlePx = 36;
            else if (tSize === 'medium') titlePx = 48;
            else if (tSize === 'large') titlePx = 64;
            else if (tSize === 'xlarge') titlePx = 80;
            else if (tSize === 'huge') titlePx = 96;

            let subPx = 34;
            const sSize = $('#studio_subtitle_size').val() || 'auto';
            if (sSize === 'small') subPx = 24;
            else if (sSize === 'medium') subPx = 34;
            else if (sSize === 'large') subPx = 48;
            else if (sSize === 'xlarge') subPx = 62;
            else if (sSize === 'huge') subPx = 76;
            else if (sSize === 'auto') {
                // If there's no main title, headline prominence (52px)
                subPx = (!title) ? 52 : 34;
            }

            if (title) {
                ctx.save();
                ctx.font = `bold ${Math.round(titlePx * scale)}px ${baseFont}`;
                ctx.shadowColor = shadowColor;
                ctx.shadowBlur = shadowBlur;
                ctx.fillStyle = finalTitleColor;
                const lineH = Math.round(titlePx * 1.2 * scale);
                currentY = wrapText(ctx, title.toUpperCase(), textX, currentY, maxTextW, lineH);
                ctx.restore();
            }

            if (subtitle) {
                ctx.save();
                const fontW = (!title) ? 'bold' : '700';
                ctx.font = `${fontW} ${Math.round(subPx * scale)}px ${baseFont}`;
                ctx.shadowColor = shadowColor;
                ctx.shadowBlur = Math.round(shadowBlur * 0.7);
                ctx.fillStyle = finalSubColor;
                const subY = title ? (currentY + (12 * scale)) : currentY;
                const subLineH = Math.round(subPx * 1.22 * scale);
                wrapText(ctx, subtitle, textX, subY, maxTextW, subLineH);
                ctx.restore();
            }
            ctx.restore();
        }

        // Bottom element vertical coordinate calculation (prevent any overlap)
        const cta = $('#studio_cta').val();
        const hasCta = cta && cta !== 'none';
        const ctaH = 44 * scale;
        const barH = phone ? (85 * scale) : 0;
        const barY = H - barH;

        // Position CTA pill above phone bar with breathing space
        const ctaY = hasCta ? (barY - ctaH - (14 * scale)) : barY;

        // 5. Promotional Card (Line 1 & Line 2) - Positioned cleanly ABOVE the CTA pill
        if (line1 || line2) {
            ctx.save();
            const cardW = W - (pad * 2);
            const cardH = (line1 && line2) ? (110 * scale) : (75 * scale);
            const cardX = pad;
            const cardY = (hasCta ? ctaY : barY) - cardH - (14 * scale);

            ctx.fillStyle = cardBg;
            roundRect(ctx, cardX, cardY, cardW, cardH, 16 * scale, true, false);
            ctx.strokeStyle = cardBorder;
            ctx.lineWidth = 2 * scale;
            roundRect(ctx, cardX, cardY, cardW, cardH, 16 * scale, false, true);

            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            const maxCardTextW = cardW - (32 * scale);
            if (line1 && line2) {
                let fs1 = 25;
                ctx.font = `bold ${Math.round(fs1 * scale)}px ${baseFont}`;
                while (ctx.measureText(line1).width > maxCardTextW && fs1 > 14) {
                    fs1 -= 1;
                    ctx.font = `bold ${Math.round(fs1 * scale)}px ${baseFont}`;
                }
                ctx.fillStyle = '#FFFFFF';
                ctx.fillText(line1, W / 2, cardY + (cardH * 0.35));

                let fs2 = 20;
                ctx.font = `600 ${Math.round(fs2 * scale)}px ${baseFont}`;
                while (ctx.measureText(line2).width > maxCardTextW && fs2 > 12) {
                    fs2 -= 1;
                    ctx.font = `600 ${Math.round(fs2 * scale)}px ${baseFont}`;
                }
                ctx.fillStyle = '#E2E8F0';
                ctx.fillText(line2, W / 2, cardY + (cardH * 0.72));
            } else {
                const single = line1 || line2;
                let fsSingle = 26;
                ctx.font = `bold ${Math.round(fsSingle * scale)}px ${baseFont}`;
                while (ctx.measureText(single).width > maxCardTextW && fsSingle > 14) {
                    fsSingle -= 1;
                    ctx.font = `bold ${Math.round(fsSingle * scale)}px ${baseFont}`;
                }
                ctx.fillStyle = '#FFFFFF';
                ctx.fillText(single, W / 2, cardY + (cardH / 2));
            }
            ctx.restore();
        }

        // 6. Call To Action (CTA) Pill
        if (hasCta) {
            ctx.save();
            const ctaW = 340 * scale;
            const ctaX = (W - ctaW) / 2;

            const ctaGrad = ctx.createLinearGradient(ctaX, 0, ctaX + ctaW, 0);
            ctaGrad.addColorStop(0, '#F59E0B');
            ctaGrad.addColorStop(1, '#EF4444');
            ctx.fillStyle = ctaGrad;
            ctx.shadowColor = 'rgba(0,0,0,0.55)';
            ctx.shadowBlur = 10 * scale;
            roundRect(ctx, ctaX, ctaY, ctaW, ctaH, 22 * scale, true, false);

            ctx.strokeStyle = '#FFFFFF';
            ctx.lineWidth = 2 * scale;
            roundRect(ctx, ctaX, ctaY, ctaW, ctaH, 22 * scale, false, true);

            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.font = `bold ${Math.round(20 * scale)}px ${baseFont}`;
            ctx.fillStyle = '#FFFFFF';
            ctx.fillText("⚡ " + cta.toUpperCase(), W / 2, ctaY + (ctaH / 2));
            ctx.restore();
        }

        // 7. Bottom WhatsApp Contact Bar
        if (phone) {
            ctx.save();
            ctx.fillStyle = barBg;
            ctx.fillRect(0, barY, W, barH);

            ctx.fillStyle = barAccent;
            ctx.fillRect(0, barY, W, 4 * scale);

            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.font = `bold ${Math.round(28 * scale)}px ${baseFont}`;
            ctx.fillStyle = '#FFFFFF';
            ctx.shadowColor = 'rgba(0,0,0,0.5)';
            ctx.shadowBlur = 6 * scale;
            ctx.fillText("WhatsApp / Order : " + phone, W / 2, barY + (barH / 2));
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

    $('#studio_shop_color_preset').on('change', function() {
        const val = $(this).val();
        if (val !== 'custom') {
            $('#studio_shop_color_picker').val(val);
        }
        renderStudioPoster();
    });
    $('#studio_shop_color_picker').on('input change', function() {
        $('#studio_shop_color_preset').val('custom');
        renderStudioPoster();
    });

    $('#studio_title_color_preset').on('change', function() {
        const val = $(this).val();
        if (val !== 'custom' && val !== 'auto') {
            $('#studio_title_color_picker').val(val);
        }
        renderStudioPoster();
    });
    $('#studio_title_color_picker').on('input change', function() {
        $('#studio_title_color_preset').val('custom');
        renderStudioPoster();
    });

    $('#studio_subtitle_color_preset').on('change', function() {
        const val = $(this).val();
        if (val !== 'custom' && val !== 'auto') {
            $('#studio_subtitle_color_picker').val(val);
        }
        renderStudioPoster();
    });
    $('#studio_subtitle_color_picker').on('input change', function() {
        $('#studio_subtitle_color_preset').val('custom');
        renderStudioPoster();
    });

    function openPosterStudio(id, imageSrc, title, subtitle, line1, line2, phone) {
        $('#studio_item_id').val(id);
        $('#studio_shop_size').val('medium');
        $('#studio_shop_color_preset').val('#FFD700');
        $('#studio_shop_color_picker').val('#FFD700');
        $('#studio_shop_style').val('stars');
        $('#studio_title').val(cleanStudioText(title));
        $('#studio_subtitle').val(cleanStudioText(subtitle));
        $('#studio_line1').val(cleanStudioText(line1));
        $('#studio_line2').val(cleanStudioText(line2));
        $('#studio_phone').val(cleanStudioText(phone));

        $('#studio_text_pos').val('top-center');
        $('#studio_title_size').val('medium');
        $('#studio_subtitle_size').val('auto');
        $('#studio_title_color_preset').val('auto');
        $('#studio_title_color_picker').val('#FFFFFF');
        $('#studio_subtitle_color_preset').val('auto');
        $('#studio_subtitle_color_picker').val('#FACC15');
        $('#studio_text_shadow').val('auto');

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

    // Instant High-Res PNG Download
    $('#btn_download_poster').on('click', function() {
        const canvas = document.getElementById('posterCanvas');
        if (!canvas) return;

        const title = ($('#studio_title').val() || '').trim() || 'poster';
        const cleanFilename = 'whatsapp-poster-' + title.toLowerCase().replace(/[^a-z0-9]+/g, '-') + '.png';

        if (canvas.toBlob) {
            canvas.toBlob(function(blob) {
                if (!blob) {
                    const link = document.createElement('a');
                    link.download = cleanFilename;
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                    return;
                }
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.download = cleanFilename;
                a.href = url;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);

                Swal.fire({
                    icon: 'success',
                    title: 'Poster Downloaded!',
                    text: 'Your customized poster was downloaded successfully (PNG).',
                    timer: 2500,
                    showConfirmButton: false
                });
            }, 'image/png');
        } else {
            const link = document.createElement('a');
            link.download = cleanFilename;
            link.href = canvas.toDataURL('image/png');
            link.click();
        }
    });

    // Instant High-Quality JPEG Download
    $('#btn_download_jpeg').on('click', function() {
        const canvas = document.getElementById('posterCanvas');
        if (!canvas) return;

        const title = ($('#studio_title').val() || '').trim() || 'poster';
        const cleanFilename = 'whatsapp-poster-' + title.toLowerCase().replace(/[^a-z0-9]+/g, '-') + '.jpg';

        if (canvas.toBlob) {
            canvas.toBlob(function(blob) {
                if (!blob) {
                    const link = document.createElement('a');
                    link.download = cleanFilename;
                    link.href = canvas.toDataURL('image/jpeg', 0.92);
                    link.click();
                    return;
                }
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.download = cleanFilename;
                a.href = url;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);

                Swal.fire({
                    icon: 'success',
                    title: 'Poster Downloaded!',
                    text: 'Your customized poster was saved as JPEG.',
                    timer: 2500,
                    showConfirmButton: false
                });
            }, 'image/jpeg', 0.92);
        } else {
            const link = document.createElement('a');
            link.download = cleanFilename;
            link.href = canvas.toDataURL('image/jpeg', 0.92);
            link.click();
        }
    });

    // Save Studio Customization back to shop database
    $('#btn_save_studio_data').on('click', function() {
        const id = $('#studio_item_id').val();
        if (!id) return;

        const title = $('#studio_title').val();
        const subtitle = $('#studio_subtitle').val();
        const line1 = $('#studio_line1').val();
        const line2 = $('#studio_line2').val();
        const phone = $('#studio_phone').val();
        const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

        const formData = new FormData();
        formData.append('_token', token);
        formData.append('_method', 'PUT');
        formData.append('edit_id', id);
        formData.append('edittitle', title);
        formData.append('editsub_title', subtitle);
        formData.append('editline1', line1);
        formData.append('editline2', line2);
        formData.append('editph_no', phone);
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

