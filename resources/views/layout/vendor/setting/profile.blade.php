@extends('layout.auth.master')
@section('contents')
    @include('paritials.js.profile.profile-js')
    @include('paritials.vendorauth.header')

<!-- page-wrapper Start-->
@include('paritials.vendorauth.topmenu');
<!-- Page Header Ends -->

@php
    $vendorObj  = $vendor ?? ($data['vendor'] ?? null);
    $userObj    = $data['user'] ?? null;
    $detailsObj = $data['details'] ?? null;

    $profileImgSrc = asset('assets/images/dashboard/logo/fav.png');
    if (!empty($vendorObj->profile_image) && file_exists(public_path('assets/images/vendor/profile/' . $vendorObj->profile_image))) {
        $profileImgSrc = asset('assets/images/vendor/profile/' . $vendorObj->profile_image);
    }

    $fbLink = !empty($vendorObj->facebook_link) ? $vendorObj->facebook_link : '';
    if ($fbLink && !preg_match('~^(?:f|ht)tps?://~i', $fbLink)) {
        $fbLink = 'https://' . ltrim($fbLink, '/');
    }

    $igLink = !empty($vendorObj->instagram_link) ? $vendorObj->instagram_link : '';
    if ($igLink && !preg_match('~^(?:f|ht)tps?://~i', $igLink)) {
        $igLink = 'https://' . ltrim($igLink, '/');
    }

    $waRaw = !empty($vendorObj->whatsapp_number) ? $vendorObj->whatsapp_number : '';
    $waClean = preg_replace('/[^0-9]/', '', $waRaw);
    $waLink = $waClean ? 'https://wa.me/' . $waClean : '';
@endphp

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu');
	<!-- Page Sidebar Ends-->
	
       <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                                <li class="breadcrumb-item"><a href="{{ route('vendordashboard', session()->get('login_id')) }}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Settings</li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-1"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-triangle me-1"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-details text-center">
                                    <img src="{{ $profileImgSrc }}" alt="{{ $vendorObj->shop_name ?? 'Seller' }}" class="img-fluid img-90 rounded-circle blur-up lazyloaded" style="width: 90px; height: 90px; object-fit: cover; border: 3px solid #e9ecef;">
                                    <h5 class="f-w-600 mb-0 mt-2">{{ $vendorObj->shop_name ?? ($userObj->firstName ?? $userObj->name ?? 'Seller') }}</h5>
                                    <span class="text-muted d-block">{{ $vendorObj->email ?? ($userObj->email ?? '') }}</span>
                                    @if(!empty($vendorObj->owner_name))
                                        <small class="text-secondary d-block">Owner: {{ $vendorObj->owner_name }}</small>
                                    @endif

                                    <!-- Social Icons: Facebook, Instagram, WhatsApp -->
                                    <div class="social mt-3">
                                        <div class="form-group btn-showcase" style="display: flex; justify-content: center; gap: 12px; align-items: center; margin-bottom: 0;">
                                            <!-- Facebook -->
                                            @if(!empty($fbLink))
                                                <a href="{{ $fbLink }}" target="_blank" rel="noopener noreferrer" class="btn social-btn btn-fb d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px; border-radius: 50%; background-color: #3b5998; color: #fff; text-decoration: none; font-size: 16px; box-shadow: 0 2px 6px rgba(59,89,152,0.3); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.15)';" onmouseout="this.style.transform='scale(1)';" title="Visit Facebook Profile">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" onclick="openEditTab('facebook_link')" class="btn social-btn btn-fb d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px; border-radius: 50%; background-color: #6b7692; color: #fff; text-decoration: none; font-size: 16px; opacity: 0.6;" title="Add Facebook Link">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            @endif

                                            <!-- Instagram -->
                                            @if(!empty($igLink))
                                                <a href="{{ $igLink }}" target="_blank" rel="noopener noreferrer" class="btn social-btn d-inline-flex align-items-center justify-content-center text-white" style="width: 42px; height: 42px; border-radius: 50%; background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%); color: #fff; text-decoration: none; font-size: 16px; box-shadow: 0 2px 6px rgba(220,39,67,0.3); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.15)';" onmouseout="this.style.transform='scale(1)';" title="Visit Instagram Profile">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" onclick="openEditTab('instagram_link')" class="btn social-btn d-inline-flex align-items-center justify-content-center text-white" style="width: 42px; height: 42px; border-radius: 50%; background: #999; color: #fff; text-decoration: none; font-size: 16px; opacity: 0.6;" title="Add Instagram Link">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            @endif

                                            <!-- WhatsApp -->
                                            @if(!empty($waLink))
                                                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn social-btn d-inline-flex align-items-center justify-content-center text-white" style="width: 42px; height: 42px; border-radius: 50%; background-color: #25D366; color: #fff; text-decoration: none; font-size: 18px; box-shadow: 0 2px 6px rgba(37,211,102,0.3); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.15)';" onmouseout="this.style.transform='scale(1)';" title="Chat on WhatsApp ({{ $vendorObj->whatsapp_number }})">
                                                    <i class="fa fa-whatsapp"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" onclick="openEditTab('whatsapp_number')" class="btn social-btn d-inline-flex align-items-center justify-content-center text-white" style="width: 42px; height: 42px; border-radius: 50%; background-color: #709a7b; color: #fff; text-decoration: none; font-size: 18px; opacity: 0.6;" title="Add WhatsApp Number">
                                                    <i class="fa fa-whatsapp"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card tab2-card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true">
                                            <i data-feather="user" class="me-2"></i>Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="upload-top-tab" data-bs-toggle="tab" href="#top-upload" role="tab" aria-controls="top-upload" aria-selected="false">
                                            <i data-feather="settings" class="me-2"></i>Edit Profile & Social Links
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="top-tabContent">
                                    <!-- TAB 1: Profile View -->
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="f-w-600 mb-0">Seller Information</h5>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openEditTab()">
                                                <i class="fa fa-edit me-1"></i> Edit Profile
                                            </button>
                                        </div>
                                        <div class="table-responsive profile-table">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 30%;">Shop Name:</td>
                                                        <td><strong>{{ $vendorObj->shop_name ?? ($detailsObj->firstName ?? $userObj->firstName ?? '—') }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Owner Name:</td>
                                                        <td>{{ $vendorObj->owner_name ?? ($userObj->name ?? '—') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email:</td>
                                                        <td>{{ $vendorObj->email ?? ($userObj->email ?? '—') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile Number:</td>
                                                        <td>{{ $vendorObj->mobile_number1 ?? ($detailsObj->mobile ?? '—') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>WhatsApp Number:</td>
                                                        <td>
                                                            @if(!empty($vendorObj->whatsapp_number))
                                                                <a href="{{ $waLink ?: '#' }}" target="{{ $waLink ? '_blank' : '_self' }}" class="text-success fw-bold" style="text-decoration: none;">
                                                                    <i class="fa fa-whatsapp me-1"></i> {{ $vendorObj->whatsapp_number }}
                                                                </a>
                                                            @else
                                                                <span class="text-muted fst-italic">Not added (<a href="javascript:void(0)" onclick="openEditTab('whatsapp_number')">Add now</a>)</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Facebook Profile:</td>
                                                        <td>
                                                            @if(!empty($fbLink))
                                                                <a href="{{ $fbLink }}" target="_blank" rel="noopener noreferrer" class="text-primary fw-bold" style="text-decoration: none; word-break: break-all;">
                                                                    <i class="fa fa-facebook-square me-1"></i> {{ $vendorObj->facebook_link }}
                                                                </a>
                                                            @else
                                                                <span class="text-muted fst-italic">Not added (<a href="javascript:void(0)" onclick="openEditTab('facebook_link')">Add now</a>)</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Instagram Profile:</td>
                                                        <td>
                                                            @if(!empty($igLink))
                                                                <a href="{{ $igLink }}" target="_blank" rel="noopener noreferrer" style="color: #d6249f; font-weight: bold; text-decoration: none; word-break: break-all;">
                                                                    <i class="fa fa-instagram me-1"></i> {{ $vendorObj->instagram_link }}
                                                                </a>
                                                            @else
                                                                <span class="text-muted fst-italic">Not added (<a href="javascript:void(0)" onclick="openEditTab('instagram_link')">Add now</a>)</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if(!empty($vendorObj->address) || !empty($detailsObj->address))
                                                    <tr>
                                                        <td>Address:</td>
                                                        <td>{{ $vendorObj->address ?? ($detailsObj->address ?? '—') }}</td>
                                                    </tr>
                                                    @endif
                                                    @if(!empty($vendorObj->aadhar_no) || !empty($detailsObj->adharcard))
                                                    <tr>
                                                        <td>Aadhar Card:</td>
                                                        <td>{{ $vendorObj->aadhar_no ?? ($detailsObj->adharcard ?? '—') }}</td>
                                                    </tr>
                                                    @endif
                                                    @if(!empty($vendorObj->gst_number) || !empty($detailsObj->pancard))
                                                    <tr>
                                                        <td>GST / Pan:</td>
                                                        <td>{{ $vendorObj->gst_number ?? ($detailsObj->pancard ?? '—') }}</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- TAB 2: Edit Profile & Social Links -->
                                    <div class="tab-pane fade" id="top-upload" role="tabpanel" aria-labelledby="upload-top-tab">
                                        <h5 class="f-w-600 mb-3">Edit Profile & Social Links</h5>
                                        <form class="needs-validation user-add" method="POST" action="{{ route('vendor.profile.update') }}" enctype="multipart/form-data">
                                            @csrf

                                            <!-- Social Media Section -->
                                            <div class="card mb-3 border">
                                                <div class="card-header bg-light py-2">
                                                    <strong class="text-dark"><i class="fa fa-share-alt me-1 text-primary"></i> Social Media & WhatsApp Links</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-xl-3 col-md-4 col-form-label">
                                                            <i class="fa fa-whatsapp text-success me-1" style="font-size: 18px;"></i> WhatsApp Number
                                                        </label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="whatsapp_number_input" type="text" name="whatsapp_number" placeholder="e.g. 919876543210" value="{{ $vendorObj->whatsapp_number ?? '' }}">
                                                            <small class="text-muted">Enter mobile number with country code (e.g. 919876543210) for direct WhatsApp chat.</small>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-xl-3 col-md-4 col-form-label">
                                                            <i class="fa fa-facebook text-primary me-1" style="font-size: 18px;"></i> Facebook Link
                                                        </label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="facebook_link_input" type="text" name="facebook_link" placeholder="https://facebook.com/yourprofile" value="{{ $vendorObj->facebook_link ?? '' }}">
                                                            <small class="text-muted">Full Facebook page/profile link (e.g. https://facebook.com/yourprofile) or username.</small>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-xl-3 col-md-4 col-form-label">
                                                            <i class="fa fa-instagram text-danger me-1" style="font-size: 18px;"></i> Instagram Link
                                                        </label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="instagram_link_input" type="text" name="instagram_link" placeholder="https://instagram.com/yourprofile" value="{{ $vendorObj->instagram_link ?? '' }}">
                                                            <small class="text-muted">Full Instagram profile link (e.g. https://instagram.com/yourprofile) or @handle.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Shop & Personal Info -->
                                            <div class="card mb-3 border">
                                                <div class="card-header bg-light py-2">
                                                    <strong class="text-dark"><i class="fa fa-user me-1 text-primary"></i> Shop & Personal Details</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-xl-3 col-md-4 col-form-label">Shop Name</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" type="text" name="shop_name" value="{{ $vendorObj->shop_name ?? ($userObj->firstName ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-xl-3 col-md-4 col-form-label">Owner Name</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" type="text" name="owner_name" value="{{ $vendorObj->owner_name ?? ($userObj->name ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-xl-3 col-md-4 col-form-label">Mobile Number</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" type="text" name="mobile_number1" value="{{ $vendorObj->mobile_number1 ?? ($detailsObj->mobile ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-xl-3 col-md-4 col-form-label">Address</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <textarea class="form-control" name="address" rows="2">{{ $vendorObj->address ?? ($detailsObj->address ?? '') }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-xl-3 col-md-4 col-form-label">Profile / Logo Image</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" type="file" name="profile_image" accept="image/*">
                                                            @if(!empty($vendorObj->profile_image))
                                                                <small class="text-muted d-block mt-1">Current file: {{ $vendorObj->profile_image }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pull-right text-end mt-3 mb-2">
                                                <button type="submit" class="btn btn-primary px-4">
                                                    <i class="fa fa-save me-1"></i> Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>

    </div>

</div>

<script>
function openEditTab(focusField) {
    var tabLink = document.getElementById('upload-top-tab');
    if (tabLink) {
        if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
            var tab = new bootstrap.Tab(tabLink);
            tab.show();
        } else if (typeof $ !== 'undefined') {
            $('#upload-top-tab').tab('show');
        } else {
            tabLink.click();
        }
    }
    if (focusField) {
        setTimeout(function () {
            var el = document.getElementById(focusField + '_input');
            if (el) {
                el.focus();
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 250);
    }
}
</script>

@endsection