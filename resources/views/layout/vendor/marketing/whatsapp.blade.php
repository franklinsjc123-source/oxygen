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
								<div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 880px; width: 95%;">
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
												<!-- Left: Live Canvas Preview -->
												<div class="col-md-6 text-center">
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

												<!-- Right: Canva Studio Controls -->
												<div class="col-md-6">
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
																<i class="fa fa-magic me-1"></i> 2. Badges & Style
															</button>
														</div>

														<div class="tab-content flex-grow-1" id="studioTabContent" style="overflow-y: auto; max-height: 300px; padding-right: 4px;">
															<!-- TAB 1: CONTENT -->
															<div class="studio-tab-pane" id="tab-content" style="display: block;">
																<div class="mb-2">
																	<label class="studio-label">Shop Name / Header :</label>
																	<input type="text" class="form-control form-control-sm studio-input" id="studio_shop_name" value="{{ $vendorName ?? 'My Shop' }}" placeholder="e.g. Shop001">
																</div>

																<div class="mb-2">
																	<label class="studio-label">Campaign Title :</label>
																	<input type="text" class="form-control form-control-sm studio-input" id="studio_title" placeholder="e.g. MEGA FESTIVAL SALE">
																</div>

																<div class="mb-2">
																	<label class="studio-label">Sub Title / Tagline :</label>
																	<input type="text" class="form-control form-control-sm studio-input" id="studio_subtitle" placeholder="e.g. Flat 30% Off Everything">
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-6">
																		<label class="studio-label">Offer Detail (Line 1) :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_line1" placeholder="e.g. Special Offer">
																	</div>
																	<div class="col-6">
																		<label class="studio-label">Validity (Line 2) :</label>
																		<input type="text" class="form-control form-control-sm studio-input" id="studio_line2" placeholder="e.g. Valid This Week">
																	</div>
																</div>

																<div class="mb-2">
																	<label class="studio-label">WhatsApp / Contact :</label>
																	<input type="number" min="0" class="form-control form-control-sm studio-input" id="studio_phone" placeholder="e.g. 9876543210">
																</div>
															</div>

															<!-- TAB 2: BADGES & STYLE -->
															<div class="studio-tab-pane" id="tab-design" style="display: none;">
																<div class="row g-2 mb-2">
																	<div class="col-7">
																		<label class="studio-label">Offer Sticker / Badge :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_sticker">
																			<option value="none">-- No Sticker --</option>
																			<option value="FLAT 50% OFF" selected>⭐ FLAT 50% OFF</option>
																			<option value="BUY 1 GET 1">🎁 BUY 1 GET 1</option>
																			<option value="SPECIAL OFFER">🔥 SPECIAL OFFER</option>
																			<option value="FLAT 20% OFF">🏷️ FLAT 20% OFF</option>
																			<option value="FLAT 30% OFF">🏷️ FLAT 30% OFF</option>
																			<option value="FESTIVE SALE">✨ FESTIVE SALE</option>
																			<option value="MEGA DEAL">💥 MEGA DEAL</option>
																			<option value="NEW ARRIVAL">🛍️ NEW ARRIVAL</option>
																			<option value="LIMITED TIME">⏳ LIMITED TIME</option>
																			<option value="WEEKEND SALE">🎉 WEEKEND SALE</option>
																			<option value="custom">✏️ Custom Text...</option>
																		</select>
																	</div>
																	<div class="col-5">
																		<label class="studio-label">Position :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_sticker_pos">
																			<option value="right" selected>Top Right</option>
																			<option value="left">Top Left</option>
																		</select>
																	</div>
																</div>

																<div class="mb-2" id="custom_sticker_wrap" style="display: none;">
																	<label class="studio-label">Custom Sticker Text :</label>
																	<input type="text" class="form-control form-control-sm studio-input" id="studio_custom_sticker" placeholder="e.g. SAVE 40%">
																</div>

																<div class="row g-2 mb-2">
																	<div class="col-6">
																		<label class="studio-label">Sticker Color :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_sticker_color">
																			<option value="red" selected>Crimson Red</option>
																			<option value="gold">Gold & Dark</option>
																			<option value="green">Emerald Green</option>
																			<option value="blue">Electric Blue</option>
																			<option value="purple">Royal Violet</option>
																		</select>
																	</div>
																	<div class="col-6">
																		<label class="studio-label">Sticker Tilt :</label>
																		<select class="form-select form-select-sm studio-input" id="studio_sticker_tilt">
																			<option value="tilt" selected>Tilted (-12°)</option>
																			<option value="straight">Straight (0°)</option>
																		</select>
																	</div>
																</div>

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
        return currentY;
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

        const shopName = ($('#studio_shop_name').val() || '').trim();
        const title = ($('#studio_title').val() || '').trim();
        const subtitle = ($('#studio_subtitle').val() || '').trim();
        const line1 = ($('#studio_line1').val() || '').trim();
        const line2 = ($('#studio_line2').val() || '').trim();
        const phone = ($('#studio_phone').val() || '').trim();

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
        if (shopName) {
            ctx.save();
            ctx.textAlign = 'center';
            ctx.textBaseline = 'top';
            ctx.font = `bold ${Math.round(20 * scale)}px ${baseFont}`;
            ctx.fillStyle = '#FFD700';
            ctx.shadowColor = 'rgba(0, 0, 0, 0.9)';
            ctx.shadowBlur = 8 * scale;
            ctx.fillText("★  " + shopName.toUpperCase() + "  ★", W / 2, 18 * scale);
            ctx.restore();
        }

        // 3. Top Header Gradient Scrim & Title / Subtitle
        if (title || subtitle) {
            ctx.save();
            const headerH = Math.max(260 * scale, (title ? 220 * scale : 120 * scale));
            const gradTop = ctx.createLinearGradient(0, 0, 0, headerH);
            gradTop.addColorStop(0, 'rgba(0, 0, 0, 0.82)');
            gradTop.addColorStop(0.7, 'rgba(0, 0, 0, 0.45)');
            gradTop.addColorStop(1, 'rgba(0, 0, 0, 0)');
            ctx.fillStyle = gradTop;
            ctx.fillRect(0, 0, W, headerH);

            ctx.textAlign = 'center';
            ctx.textBaseline = 'top';

            const titleY = shopName ? (48 * scale) : (35 * scale);
            if (title) {
                ctx.save();
                ctx.font = `bold ${Math.round(48 * scale)}px ${baseFont}`;
                ctx.shadowColor = 'rgba(0, 0, 0, 0.95)';
                ctx.shadowBlur = 18 * scale;
                ctx.fillStyle = titleColor;
                wrapText(ctx, title.toUpperCase(), W / 2, titleY, W - (pad * 2), 58 * scale);
                ctx.restore();
            }

            if (subtitle) {
                ctx.save();
                ctx.font = `700 ${Math.round(26 * scale)}px ${baseFont}`;
                ctx.shadowColor = 'rgba(0, 0, 0, 0.95)';
                ctx.shadowBlur = 12 * scale;
                ctx.fillStyle = subTitleColor;
                const subY = title ? (titleY + 70 * scale) : titleY;
                ctx.fillText(subtitle, W / 2, subY);
                ctx.restore();
            }
            ctx.restore();
        }

        // 4. Offer Sticker / Ribbon Badge (Canva Sticker)
        let sticker = $('#studio_sticker').val();
        if (sticker === 'custom') {
            sticker = ($('#studio_custom_sticker').val() || '').trim();
        }
        const stickerPos = $('#studio_sticker_pos').val() || 'right';
        const stickerColor = $('#studio_sticker_color').val() || 'red';
        const stickerTilt = $('#studio_sticker_tilt').val() || 'tilt';

        if (sticker && sticker !== 'none') {
            ctx.save();
            const sRadius = 66 * scale;
            const sX = (stickerPos === 'left') ? (sRadius + 32 * scale) : (W - sRadius - 32 * scale);
            const sY = sRadius + 36 * scale;

            ctx.translate(sX, sY);
            if (stickerTilt === 'tilt') {
                ctx.rotate((stickerPos === 'left' ? 12 : -12) * Math.PI / 180);
            }

            // Drop shadow
            ctx.shadowColor = 'rgba(0, 0, 0, 0.65)';
            ctx.shadowBlur = 16 * scale;
            ctx.shadowOffsetX = 3 * scale;
            ctx.shadowOffsetY = 6 * scale;

            // Circular sticker gradient
            const sGrad = ctx.createRadialGradient(0, -10 * scale, 10 * scale, 0, 0, sRadius);
            let sBorderColor = '#FDE047';
            if (stickerColor === 'gold') {
                sGrad.addColorStop(0, '#F59E0B');
                sGrad.addColorStop(1, '#78350F');
                sBorderColor = '#FFFFFF';
            } else if (stickerColor === 'green') {
                sGrad.addColorStop(0, '#10B981');
                sGrad.addColorStop(1, '#064E3B');
                sBorderColor = '#FEF08A';
            } else if (stickerColor === 'blue') {
                sGrad.addColorStop(0, '#06B6D4');
                sGrad.addColorStop(1, '#1E3A8A');
                sBorderColor = '#E0F2FE';
            } else if (stickerColor === 'purple') {
                sGrad.addColorStop(0, '#C084FC');
                sGrad.addColorStop(1, '#581C87');
                sBorderColor = '#FDE047';
            } else {
                sGrad.addColorStop(0, '#EF4444');
                sGrad.addColorStop(1, '#991B1B');
                sBorderColor = '#FDE047';
            }

            ctx.fillStyle = sGrad;
            ctx.beginPath();
            ctx.arc(0, 0, sRadius, 0, Math.PI * 2);
            ctx.fill();

            // Dashed border ring
            ctx.strokeStyle = sBorderColor;
            ctx.lineWidth = 3 * scale;
            ctx.setLineDash([7 * scale, 4 * scale]);
            ctx.stroke();

            // Sticker text
            ctx.setLineDash([]);
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillStyle = '#FFFFFF';
            ctx.shadowColor = 'rgba(0,0,0,0.85)';
            ctx.shadowBlur = 4 * scale;

            const parts = sticker.split(' ');
            if (parts.length >= 2) {
                ctx.font = `bold ${Math.round(20 * scale)}px ${baseFont}`;
                ctx.fillText(parts[0], 0, -16 * scale);
                ctx.font = `900 ${Math.round(26 * scale)}px ${baseFont}`;
                ctx.fillStyle = '#FEF08A';
                ctx.fillText(parts.slice(1).join(' '), 0, 16 * scale);
            } else {
                ctx.font = `bold ${Math.round(24 * scale)}px ${baseFont}`;
                ctx.fillText(sticker, 0, 0);
            }
            ctx.restore();
        }

        // 5. Promotional Card (Line 1 & Line 2)
        if (line1 || line2) {
            ctx.save();
            const cardW = W - (pad * 2);
            const cardH = 135 * scale;
            const cardX = pad;
            const cardY = H - (phone ? (260 * scale) : (165 * scale));

            ctx.fillStyle = cardBg;
            roundRect(ctx, cardX, cardY, cardW, cardH, 20 * scale, true, false);
            ctx.strokeStyle = cardBorder;
            ctx.lineWidth = 2 * scale;
            roundRect(ctx, cardX, cardY, cardW, cardH, 20 * scale, false, true);

            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            if (line1 && line2) {
                ctx.font = `bold ${Math.round(28 * scale)}px ${baseFont}`;
                ctx.fillStyle = '#FFFFFF';
                ctx.fillText(line1, W / 2, cardY + (cardH * 0.35));

                ctx.font = `600 ${Math.round(23 * scale)}px ${baseFont}`;
                ctx.fillStyle = '#E2E8F0';
                ctx.fillText(line2, W / 2, cardY + (cardH * 0.72));
            } else {
                const single = line1 || line2;
                ctx.font = `bold ${Math.round(30 * scale)}px ${baseFont}`;
                ctx.fillStyle = '#FFFFFF';
                ctx.fillText(single, W / 2, cardY + (cardH / 2));
            }
            ctx.restore();
        }

        // 6. Call To Action (CTA) Pill
        const cta = $('#studio_cta').val();
        if (cta && cta !== 'none') {
            ctx.save();
            const ctaW = 340 * scale;
            const ctaH = 44 * scale;
            const ctaX = (W - ctaW) / 2;
            const ctaY = H - (phone ? (165 * scale) : (80 * scale));

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
            const barH = 100 * scale;
            const barY = H - barH;

            ctx.fillStyle = barBg;
            ctx.fillRect(0, barY, W, barH);

            ctx.fillStyle = barAccent;
            ctx.fillRect(0, barY, W, 5 * scale);

            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.font = `bold ${Math.round(32 * scale)}px ${baseFont}`;
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

            const lx = (stickerPos === 'left' && sticker && sticker !== 'none') ? (W - lw - 32 * scale) : (32 * scale);
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

    $('#studio_sticker').on('change', function() {
        if ($(this).val() === 'custom') {
            $('#custom_sticker_wrap').slideDown(150);
        } else {
            $('#custom_sticker_wrap').slideUp(150);
        }
        renderStudioPoster();
    });

    function openPosterStudio(id, imageSrc, title, subtitle, line1, line2, phone) {
        $('#studio_item_id').val(id);
        $('#studio_title').val(title || '');
        $('#studio_subtitle').val(subtitle || '');
        $('#studio_line1').val(line1 || '');
        $('#studio_line2').val(line2 || '');
        $('#studio_phone').val(phone || '');

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

