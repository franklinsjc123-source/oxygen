@extends('layout.auth.master')
@section('contents')
    <style>
        .gothic {
            font-family: 'Century Gothic', lucida grande, helvetica, verdana, arial, sans-serif;
        }

        .vendor-final-actions {
            padding-right: 102px;
        }
        #ac_no,
        #ac_no1 {
            -webkit-text-security: disc;
            text-security: disc;
        }
        .invalid-feedback-custom {
            display: none;
            color: #dc3545;
            font-size: 1.05rem;
            margin-top: 0.25rem;
        }
        form.validation-attempted :invalid ~ .invalid-feedback-custom,
        form.validation-attempted .invalid-field ~ .invalid-feedback-custom {
            display: block !important;
        }
        form.validation-attempted :invalid {
            border-color: #ced4da !important;
            box-shadow: none !important;
        }
    </style>

    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu');
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.staffauth.sidemenu');
        <!-- Page Sidebar Ends-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        <!-- Right sidebar Start-->

        <!-- Right sidebar Ends-->

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Vendor Edition
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i
                                            data-feather="home"></i></a></li>

                                <li class="breadcrumb-item active">Vendor Edition </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xl-12">
                        <div class="card tab2-card">
                            <div class="card-body"
                                style="font-family: 'Century Gothic',lucida grande, helvetica, verdana, arial, sans-serif;">
                                <ul class="nav nav-tabs nav-material pb-5" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-profile-tab"
                                            href="#top-profile" role="tab"
                                            aria-controls="top-profile" aria-selected="true"><i data-feather="user"
                                                class="me-2"></i><span class="fw-bold">Personal Information</span></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link " id="top-product-tab"
                                            href="#top-product" role="tab" aria-controls="top-product"
                                            aria-selected="true"><i data-feather="user" class="me-2"></i><span
                                                class="fw-bold">Product Category </span></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="upload-top-tab" 
                                            href="#top-upload" role="tab" aria-controls="top-upload"
                                            aria-selected="false"><i data-feather="edit" class="me-2"></i><span
                                                class="fw-bold">Documents & Package</span> </a>
                                    </li>


                                    <li class="nav-item"><a class="nav-link" id="top-bank-upload" 
                                            href="#top-bank" role="tab" aria-controls="top-upload"
                                            aria-selected="false"><i data-feather="bank" class="me-2"></i><span
                                                class="fa fa-bank "><span class="fw-bold mx-2 gothic">Bank
                                                    Details</span></span></a>
                                    </li>

                                    <li class="nav-item"><a class="nav-link" id="upload-setting-tab" 
                                            href="#top-setting" role="tab" aria-controls="top-upload"
                                            aria-selected="false"><i data-feather="settings" class="me-2"></i><span
                                                class=" fa fa-solid fa-gear"><span
                                                    class="fw-bold mx-2 gothic">Support</span></span></a>
                                    </li>
                                </ul>
                                <form class="needs-validation" id="vendor-edit-form" novalidate method="post"
                                    action="{{ route('staffvendorcreate.update', $vendorcreate->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="tab-content" id="top-tabContent">
                                        <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                            aria-labelledby="top-profile-tab">
                                            <div class="row mt-4">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Created
                                                            By</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            {{-- <input class="form-control" readonly
                                                                value="{{ session()->get('username') }}"
                                                                id="validationCustom0" type="text" name="created_by"> --}}
                                                            <input class="form-control" readonly value="SKAP"
                                                                id="validationCustom0" type="text" name="created_by">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> User
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                value="{{ $vendorcreate->username }}" type="text"
                                                                name="username" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> Password
                                                        </label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <div class="position-relative">
                                                                <input class="form-control pe-5" id="pass"
                                                                    value="{{ $vendorcreate->pass }}" type="password"
                                                                    name="pass" onkeyup="validate_password()" required>
                                                                <span class="position-absolute toggle-password" style="right: 15px; top: 19px; transform: translateY(-50%); cursor: pointer;">
                                                                    <i class="fa fa-eye"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> Confirm
                                                            Password</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <div class="position-relative">
                                                                <input class="form-control pe-5" id="confirm_pass" type="password"
                                                                    value="{{ $vendorcreate->pass1 }}" name="pass1"
                                                                    onkeyup="validate_password()" required>
                                                                <span class="position-absolute toggle-password" style="right: 15px; top: 19px; transform: translateY(-50%); cursor: pointer;">
                                                                    <i class="fa fa-eye"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span id="wrong_pass_alert"></span>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> Shop
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                value="{{ $vendorcreate->shop_name }}" type="text"
                                                                name="shop_name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> Owner
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="" type="text"
                                                                value="{{ $vendorcreate->owner_name }}" name="owner_name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Business
                                                            Category</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="business_category"
                                                                value="{{ $vendorcreate->business_category }}" type="text"
                                                                name="business_category">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2"
                                                            class="col-xl-4 col-md-4"><span>*</span> E.Mail</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="email" type="email"
                                                                value="{{ $vendorcreate->email }}" name="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> Mobile
                                                            Number</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="m_number" type="text"
                                                                value="{{ $vendorcreate->mobile_number1 }}"
                                                                name="mobile_number1" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Alternate
                                                            Number</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="alter_no" type="text"
                                                                value="{{ $vendorcreate->mobile_number2 }}"
                                                                name="mobile_number2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> Address
                                                            I</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                value="{{ $vendorcreate->address }}" type="text"
                                                                name="address1" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Address
                                                            II</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                value="{{ $vendorcreate->address1 }}" type="text"
                                                                name="address2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom01" class="col-xl-4 col-md-4"><span>*</span> State
                                                            :</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <select class="custom-select w-100 form-control"
                                                                name="state" required>
                                                                <option value="{{ $vendorcreate->state }}" selected
                                                                    hidden>{{ $vendorcreate->state }}</option>
                                                                <option value="">--Select--</option>
                                                                <option value="tamilnadu">TamilNadu</option>
                                                                <option value="kerala">Kerala</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-4 col-md-4"><span>*</span> City:</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <select class="custom-select w-100 form-control"
                                                                name="city" required>
                                                                <option value="{{ $vendorcreate->city }}" selected hidden>
                                                                    {{ $vendorcreate->city }}</option>
                                                                <option value="">--Select--</option>
                                                                <option value="chennai">Chennai</option>
                                                                <option value="trichy">Trichy</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">
                                                            <span>*</span> Pincode</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="pincode" type="text"
                                                                value="{{ $vendorcreate->pincode }}" name="pincode"
                                                                maxlength="6" minlength="6" pattern="[0-9]{6}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="validationCustom0" class="col-xl-4 col-md-4">Location Map</label>
                                                            <div class="col-xl-8 col-md-8">
                                                                <div class="input-group mb-2">
                                                                    <input class="form-control" id="location_map"
                                                                        value="{{ $vendorcreate->location_map }}" type="text"
                                                                        name="location_map" placeholder="Select location on map" readonly>
                                                                    <button class="btn btn-primary" id="btn_open_map" type="button" data-bs-toggle="modal" data-bs-target="#vendorMapModal">
                                                                         <i class="fa fa-map-marker"></i> Pick on Map
                                                                    </button>
                                                                    <button class="btn btn-info ms-2" id="btn_current_location" type="button">
                                                                        <i class="fa fa-crosshairs"></i> Current Location
                                                                    </button>
                                                                </div>
                                                                <input type="hidden" name="latitude" id="latitude" value="{{ $vendorcreate->latitude }}">
                                                                <input type="hidden" name="longitude" id="longitude" value="{{ $vendorcreate->longitude }}">
                                                                <small class="text-muted">Stored Coordinates: <span id="coords_display">{{ $vendorcreate->latitude ?? 'N/A' }}, {{ $vendorcreate->longitude ?? 'N/A' }}</span></small>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">
                                                            <span>*</span> Zone</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            @php
                                                                $currentZoneLabel = $vendorcreate->zone;
                                                                if (is_numeric($vendorcreate->zone ?? null)) {
                                                                    $matchedZone = collect($zone)->firstWhere('id', (int) $vendorcreate->zone);
                                                                    $currentZoneLabel = $matchedZone->name ?? $vendorcreate->zone;
                                                                }
                                                            @endphp
                                                            <select class="form-control" name="zone" id="zone" required>

                                                                <option value="{{ $vendorcreate->zone }}" selected hidden>
                                                                    {{ $currentZoneLabel }}</option>
                                                                <option value="">Select Item</option>

                                                                @foreach ($zone as $zo)
                                                                    <option value="{{ $zo->id }}">
                                                                        {{ $zo->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2"
                                                            class="col-xl-4 col-md-4"><span>*</span> Area</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="route"
                                                                value="{{ $vendorcreate->route }}" type="text"
                                                                name="route" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> <span>*</span> AADHAR
                                                            NUMBER</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="aadharcard"
                                                                value="{{ $vendorcreate->aadhar_no }}" type="text"
                                                                name="aadhar_no" maxlength="16" minlength="16" pattern="[0-9]{16}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2" class="col-xl-4 col-md-4"><span>*</span> GST
                                                            NUMBER</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="validationCustom2"
                                                                value="{{ $vendorcreate->gst_number }}" type="text"
                                                                name="gst_number" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-xl-4 col-md-4"><span>*</span> Staff (RM)</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <select class="form-control" name="staff_id" required readonly style="pointer-events: none;">
                                                                <option value="">Select Staff</option>
                                                                @foreach ($staffs as $staff)
                                                                    <option value="{{ $staff->id }}" {{ $vendorcreate->staff_id == $staff->id ? 'selected' : '' }}>
                                                                        {{ $staff->fullname ?? $staff->username }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="top-product" role="tabpanel"
                                            aria-labelledby="top-product-tab">
                                            <div class="row mt-4">
                                                @php
                                                    $subcategoryarray = array_filter(
                                                        explode(',', (string) $vendorcreate->sub_category_ids),
                                                    );
                                                @endphp
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="mb-2">Select Category</label>
                                                        <div class="border rounded p-3"
                                                            style="max-height: 360px; overflow-y: auto;">
                                                            @foreach ($CategoryMain as $main)
                                                                @php
                                                                    $mainCategories = $Category
                                                                        ->where('main_category_id', $main->id)
                                                                        ->values();
                                                                @endphp
                                                                @if ($mainCategories->count() > 0)
                                                                    <div class="mb-2">
                                                                        <div>
                                                                            <input type="checkbox"
                                                                                class="form-check-input me-1 main-cat"
                                                                                id="main_{{ $main->id }}"
                                                                                data-main-id="{{ $main->id }}">
                                                                            <label class="fw-bold mb-0"
                                                                                for="main_{{ $main->id }}">{{ $main->category_main_name }}</label>
                                                                        </div>
                                                                        <div class="ms-4 mt-1">
                                                                            @foreach ($mainCategories as $cat)
                                                                                @php
                                                                                    $subList = $CategorySub
                                                                                        ->where('category_id', $cat->id)
                                                                                        ->values();
                                                                                    $subIds = $subList
                                                                                        ->pluck('id')
                                                                                        ->map(fn($v) => (string) $v)
                                                                                        ->toArray();
                                                                                    $selectedCount = count(
                                                                                        array_intersect(
                                                                                            $subIds,
                                                                                            array_map(
                                                                                                'strval',
                                                                                                $subcategoryarray,
                                                                                            ),
                                                                                        ),
                                                                                    );
                                                                                    $isCategoryChecked =
                                                                                        $selectedCount > 0
                                                                                            ? 'checked'
                                                                                            : '';
                                                                                    $subIdsCsv = implode(',', $subIds);
                                                                                @endphp
                                                                                <div class="mb-1">
                                                                                    <div>
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input me-1 category-cat"
                                                                                            id="category_{{ $cat->id }}"
                                                                                            data-main-id="{{ $main->id }}"
                                                                                            data-main-name="{{ $main->category_main_name }}"
                                                                                            data-category-id="{{ $cat->id }}"
                                                                                            data-category-name="{{ $cat->category_name }}"
                                                                                            data-sub-ids="{{ $subIdsCsv }}"
                                                                                            {{ $isCategoryChecked }}>
                                                                                        <label class="mb-0 fw-semibold"
                                                                                            for="category_{{ $cat->id }}">{{ $cat->category_name }}</label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div id="selected_subcategory_inputs"></div>
                                                        <div class="mt-3">
                                                            <label class="mb-1">Product Categories</label>
                                                            <div id="selected_subcategory_tags"
                                                                class="d-flex flex-wrap gap-2"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="top-upload" role="tabpanel"
                                            aria-labelledby="top-upload-tab">
                                            <div class="form-group mt-4 row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2"><span>*</span>Profile Image</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload" type="file"
                                                        name="profile_image" multiple accept="image/*,.pdf" />
                                                    <input type="hidden" id="oldprofile_image" name="oldprofile_image"
                                                        value="{{ $vendorcreate->profile_image }}">
                                                    
                                                    @if($vendorcreate->profile_image)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('assets/images/vendor/profile/' . $vendorcreate->profile_image) }}" 
                                                                 alt="Profile" class="img-fluid img-60 blur-up lazyloaded border p-1" style="max-height: 100px;">
                                                        </div>
                                                    @endif

                                                    <div id="image-holder"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2">GST</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file"
                                                        name="gst" multiple accept="image/*,.pdf" />
                                                    <input type="hidden" id="oldgst" name="oldgst"
                                                        value="{{ $vendorcreate->gst }}">
                                                    
                                                    @if($vendorcreate->gst)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('assets/images/vendor/gst/' . $vendorcreate->gst) }}" 
                                                                 alt="GST" class="img-fluid img-60 blur-up lazyloaded border p-1" style="max-height: 100px;">
                                                        </div>
                                                    @endif

                                                    <div id="image-holder1"></div>
                                                </div>
                                            </div>

                                             <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2">Other Documents</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file"
                                                        name="other_documents" multiple accept="image/*,.pdf" />
                                                    <input type="hidden" id="oldother_documents"
                                                        name="oldother_documents"
                                                        value="{{ $vendorcreate->other_documents }}">
                                                    
                                                    @if($vendorcreate->other_documents)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('assets/images/vendor/other/' . $vendorcreate->other_documents) }}" 
                                                                 alt="Other" class="img-fluid img-60 blur-up lazyloaded border p-1" style="max-height: 100px;">
                                                        </div>
                                                    @endif

                                                    <div id="image-holder1"></div>
                                                </div>
                                            </div>

                                            <h5 class="f-w-600">Package Information</h5>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom01" class="col-xl-4 col-md-4"><span>*</span> Pack
                                                            :</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            @php
                                                                $pack = App\Models\vendor\packages::where(
                                                                    'status',
                                                                    '=',
                                                                    '1',
                                                                )->get();

                                                            @endphp

                                                            <select class="custom-select w-100 form-control"
                                                                name="package" id="package" required>
                                                                <option value="" disabled {{ is_null($vendorcreate->package_id) ? 'selected' : '' }}>Select Package</option>

                                                                @foreach ($pack as $pack)
                                                                    <option value="{{ $pack->id }}"
                                                                        {{ $pack->id == $vendorcreate->package_id ? 'selected' : '' }}>
                                                                        {{ $pack->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Purchase
                                                            Date</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input id="datePicker" type="date"
                                                                value="{{ $vendorcreate->purchase_date }}"
                                                                class="form-control " name="purchase_date"
                                                                placeholder="dd/mm/yy" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Days
                                                            Validity</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validity" type="text"
                                                                value="{{ $vendorcreate->validity }}" readonly
                                                                name="validity">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">++
                                                            Days</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="grace_days" type="text"
                                                                value="{{ $vendorcreate->grace_days }}" name="grace_days">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Expired
                                                            Date</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input id="expired_date" type="date" class="form-control "
                                                                value="{{ $vendorcreate->expired_date }}"
                                                                name="expired_date" placeholder="dd/mm/yy" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Next
                                                            Renewal Date</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input id="next_renewal_date" type="date"
                                                                value="{{ $vendorcreate->next_renewal_date }}"
                                                                class="form-control " name="next_renewal_date"
                                                                placeholder="dd/mm/yy" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">ADD
                                                            Wallets</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="wallet" type="text"
                                                                value="{{ $vendorcreate->wallet }}" name="wallet">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0"
                                                            class="col-xl-4 col-md-4">Commission %</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="commission"
                                                                value="{{ $vendorcreate->commission }}" type="text"
                                                                name="commission">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2">Description</label>
                                                <div class="col-xl-10 col-md-10">


                                                    <textarea class="form-control" rows="3" id="description" name="description" type="text"
                                                        name="description">{{ $vendorcreate->description }}</textarea>
                                                    {{-- @php
                                                        $pack1 = App\Models\vendor\packages::where('status', '=', '1')->get();
                                                        
                                                        @endphp --}}
                                                    {{-- @foreach ($pack1 as $packs)
                                                            @if ($packs->id == $vendorcreate->package_id)
                                                            <textarea class="form-control"  rows="3" id="description" name="description"  type="text" name="description" value="{{ $packs->description }}">{{ $packs->description }}</textarea>
                                                            @endif
                                                     @endforeach --}}
                                                    {{-- @if ($pack1->id == $vendorcreate->package_id)

                                                        <textarea class="form-control"  rows="3" id="description" name="description"  type="text" name="description">{{ $pack1->description }}</textarea>
                                                    @endif --}}
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade show " id="top-bank" role="tabpanel"
                                            aria-labelledby="top-bank-tab">
                                            <div class="row mt-4">
                                                <div class="col-md-12">

                                                    <div class="form-group row">
                                                        <label for="bank_name" class="col-xl-3 col-md-3"><span>*</span>Account
                                                            Holder Name</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="bank_name" name="bank_name"
                                                                type="text" value="{{ $vendorcreate->bank_name }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="ac_no" class="col-xl-3 col-md-3"><span>*</span>Account
                                                            Number</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no" name="ac_no"
                                                                type="password" value="{{ $vendorcreate->ac_no }}"
                                                                required inputmode="numeric" pattern="[0-9]*"
                                                                autocomplete="off" spellcheck="false"
                                                                oncopy="return false" oncut="return false"
                                                                onpaste="return false" oncontextmenu="return false"
                                                                onselectstart="return false"
                                                                style="user-select: none;">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="ac_no1" class="col-xl-3 col-md-3"><span>*</span>Confirm
                                                            Account Number</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no1" name="ac_no1"
                                                                type="text" value="{{ $vendorcreate->ac_no1 }}"
                                                                required onkeyup="validate_acno()"
                                                                inputmode="numeric" pattern="[0-9]*"
                                                                autocomplete="off" spellcheck="false"
                                                                oncopy="return false" oncut="return false"
                                                                onpaste="return false" oncontextmenu="return false"
                                                                onselectstart="return false"
                                                                style="user-select: none;">
                                                        </div>
                                                        <span id="wrong_ac_no_alert"></span>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="ifsc" class="col-xl-3 col-md-3"><span>*</span>IFSC Code</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ifsc" name="ifsc"
                                                                type="text" value="{{ $vendorcreate->ifsc }}" 
                                                                required maxlength="11" minlength="11">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="vendor_otp" class="col-xl-3 col-md-3">Enter OTP (Mobile Number)</label>
                                                        <div class="col-xl-6 col-md-6">
                                                            <input class="form-control" id="vendor_otp"
                                                                type="text" name="graceperiod">
                                                        </div>
                                                        <div class="col-xl-3 col-md-3">
                                                            <button class="btn btn-secondary w-100" type="button">Send
                                                                OTP</button>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="form-group row">
                                                        <div class="col-xl-3 col-md-3">
                                                            <label><span>*</span><img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/UPI-Logo-vector.svg"
                                                                width="80px" alt="UPI Logo"></label>
                                                        </div>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="upi" name="upi"
                                                                type="text" value="{{ $vendorcreate->upi }}"
                                                                required maxlength="10" inputmode="numeric"
                                                                autocomplete="off" spellcheck="false">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade show " id="top-setting" role="tabpanel"
                                            aria-labelledby="top-setting-tab">

                                            <div class="container ">
                                                <div class=" mt-5">
                                                    <div class="row">
                                                        <div class="col-md-3">

                                                            <input type="checkbox" class="form-check-input"
                                                                id="check1" name="option1"
                                                                {{ $vendorcreate->option1 == 'mobile' ? 'checked' : '' }}
                                                                value="mobile">
                                                            <label class="form-check-label fw-bold" for="check1">Mobile
                                                                support</label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="check2" name="option2"
                                                                {{ $vendorcreate->option2 == 'delivery' ? 'checked' : '' }}
                                                                value="delivery">
                                                            <label class="form-check-label fw-bold"
                                                                for="check2">Delivery
                                                                support</label>
                                                        </div>

                                                        <div class="row mt-3">

                                                            <label for="validationCustom1"
                                                                class="col-xl-1 col-md-1">Comments:</label>
                                                            <div class="col-xl-5 col-md-5">
                                                                <textarea class="form-control" rows="3" id="validationCustom1" type="text" name="comments">{{ $vendorcreate->comments }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-4">
                                                                <label class="fw-bold">Instagram Link</label>
                                                                <input class="form-control" type="text" name="instagram_link" value="{{ $vendorcreate->instagram_link }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="fw-bold">Facebook Link</label>
                                                                <input class="form-control" type="text" name="facebook_link" value="{{ $vendorcreate->facebook_link }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="fw-bold">WhatsApp Number</label>
                                                                <input class="form-control" type="text" name="whatsapp_number" value="{{ $vendorcreate->whatsapp_number }}">
                                                            </div>
                                                        </div><br>

                                                        <div class="justify-content-end align-items-center gap-2 mt-4 vendor-final-actions d-none"
                                                            id="final-wizard-controls">
                                                            <button type="button" class="btn btn-secondary px-4"
                                                                id="wizard-prev-last-btn">Previous</button>
                                                            <button class="btn btn-primary px-4"
                                                                type="submit">Update</button>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-4" id="vendor-wizard-controls">
                                        <button type="button" class="btn btn-secondary px-4"
                                            id="wizard-prev-btn">Previous</button>
                                        <button type="button" class="btn btn-primary px-4"
                                            id="wizard-next-btn">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>

        <!-- footer start-->

        <!-- footer end-->

    </div>

    </div>
@endsection



<!-- Location Map Modal -->
<div class="modal fade" id="vendorMapModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="vendorMapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vendorMapModalLabel">Select Location on Map</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 450px; width: 100%; border-radius: 8px;"></div>
                <p class="mt-2 text-muted">Click on the map or drag the blue marker to set the vendor's precise location.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Confirm & Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        $(document).ready(function() {
            var mapInitialized = false;
            var map, marker;
            var defaultLat = {{ $vendorcreate->latitude ?? 13.0827 }};
            var defaultLng = {{ $vendorcreate->longitude ?? 80.2707 }};

            function updateInputs(lat, lng) {
                $('#latitude').val(lat.toFixed(8));
                $('#longitude').val(lng.toFixed(8));
                $('#location_map').val(lat.toFixed(8) + ', ' + lng.toFixed(8));
                $('#coords_display').text(lat.toFixed(8) + ', ' + lng.toFixed(8));
            }

            function initMap() {
                if (mapInitialized) return;
                
                map = L.map('map').setView([defaultLat, defaultLng], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                marker = L.marker([defaultLat, defaultLng], {
                    draggable: true
                }).addTo(map);

                marker.on('dragend', function(event) {
                    var position = marker.getLatLng();
                    updateInputs(position.lat, position.lng);
                });

                map.on('click', function(e) {
                    marker.setLatLng(e.latlng);
                    updateInputs(e.latlng.lat, e.latlng.lng);
                });

                mapInitialized = true;
            }

            // Current Location Logic
            $('#btn_current_location').on('click', function() {
                if (navigator.geolocation) {
                    var $btn = $(this);
                    var originalHtml = $btn.html();
                    $btn.html('<i class="fa fa-spinner fa-spin"></i> Getting Location...').prop('disabled', true);

                    navigator.geolocation.getCurrentPosition(function(position) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        
                        updateInputs(lat, lng);
                        
                        // If map is initialized, update it
                        if (map && marker) {
                            marker.setLatLng([lat, lng]);
                            map.setView([lat, lng], 15);
                        } else {
                            // Pre-set defaults for when map is eventually opened
                            defaultLat = lat;
                            defaultLng = lng;
                        }
                        
                        $btn.html(originalHtml).prop('disabled', false);
                        alert('Location updated successfully!');
                    }, function(error) {
                        $btn.html(originalHtml).prop('disabled', false);
                        let msg = 'Error getting location: ';
                        switch(error.code) {
                            case error.PERMISSION_DENIED: msg += "User denied Geolocation."; break;
                            case error.POSITION_UNAVAILABLE: msg += "Location information is unavailable."; break;
                            case error.TIMEOUT: msg += "The request to get user location timed out."; break;
                            case error.UNKNOWN_ERROR: msg += "An unknown error occurred."; break;
                        }
                        alert(msg);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    });
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            });

            // Initialize map when modal is opened
            $('#vendorMapModal').on('shown.bs.modal', function() {
                initMap();
                setTimeout(function(){ map.invalidateSize(); }, 200);
            });

            /* Redundant manual trigger removed to prevent double-triggering BS5 modals */
            /* $('#btn_open_map').on('click', function() {
                var myModal = new bootstrap.Modal(document.getElementById('vendorMapModal'));
                myModal.show();
            }); */
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $('.select2').select2();
    </script>
    <script>
        $(function() {
            function syncParentStates() {
                $('.main-cat').each(function() {
                    const mainId = $(this).data('main-id');
                    const allCategories = $(`.category-cat[data-main-id="${mainId}"]`);
                    const checkedCategories = allCategories.filter(':checked');
                    $(this).prop('checked', allCategories.length > 0 && checkedCategories.length ===
                        allCategories.length);
                });
            }

            function renderSelections() {
                const $inputs = $('#selected_subcategory_inputs');
                const $tags = $('#selected_subcategory_tags');
                $inputs.empty();
                $tags.empty();
                $inputs.append(
                    '<input type="hidden" name="sub_category_ids_csv" id="sub_category_ids_csv" value="">');

                const subIds = new Set();
                $('.category-cat:checked').each(function() {
                    const mainName = $(this).data('main-name');
                    const categoryName = $(this).data('category-name');
                    const rawSubIds = ($(this).data('sub-ids') || '').toString();
                    if (rawSubIds.length > 0) {
                        rawSubIds.split(',').forEach(id => {
                            if (id) subIds.add(id);
                        });
                    }
                    $tags.append(
                        `<span class="badge bg-light text-dark border">${mainName} | ${categoryName}</span>`
                        );
                });

                $('#sub_category_ids_csv').val(Array.from(subIds).join(','));
            }

            $(document).on('change', '.main-cat', function() {
                const mainId = $(this).data('main-id');
                const checked = $(this).is(':checked');
                $(`.category-cat[data-main-id="${mainId}"]`).prop('checked', checked);
                syncParentStates();
                renderSelections();
            });

            $(document).on('change', '.category-cat', function() {
                syncParentStates();
                renderSelections();
            });

            syncParentStates();
            renderSelections();
        });
    </script>
    <script>
        $(function() {
            const $tabLinks = $('#top-tab .nav-link');
            const $tabPanes = $('#top-tabContent .tab-pane');
            const tabCount = $tabLinks.length;

            function getActiveIndex() {
                const idx = $tabLinks.index($('#top-tab .nav-link.active'));
                return idx >= 0 ? idx : 0;
            }

            function isCurrentTabValid() {
                const currentTab = $('#top-tabContent .tab-pane.active');
                const inputs = currentTab.find('input[required], select[required], textarea[required], [required]');
                let valid = true;

                inputs.each(function() {
                    if (!this.checkValidity()) {
                        valid = false;
                        this.reportValidity();
                        $(this).focus();
                        return false;
                    }
                });

                if (!valid) {
                    $('#vendor-edit-form').addClass('validation-attempted');
                    return false;
                }

                // Password match check
                if (currentTab.attr('id') === 'top-profile') {
                    var pass = $('#pass').val();
                    var confirm_pass = $('#confirm_pass').val();
                    if (pass !== confirm_pass) {
                        valid = false;
                        $('#confirm_pass').focus();
                        document.getElementById('wrong_pass_alert').style.color = 'red';
                        document.getElementById('wrong_pass_alert').innerHTML = '☒ Use same password';
                    }
                }

                // Step 2 (Product Category) check
                if (currentTab.attr('id') === 'top-product') {
                    const checkedCategories = $('.category-cat:checked').length;
                    if (checkedCategories === 0) {
                        valid = false;
                        alert('Please select at least one Product Category');
                    }
                }

                // Step 4 (Bank Details) check
                if (currentTab.attr('id') === 'top-bank') {
                    var ac_no = $('#ac_no').val();
                    var ac_no1 = $('#ac_no1').val();
                    if (ac_no !== ac_no1) {
                        valid = false;
                        $('#ac_no1').focus();
                        document.getElementById('wrong_ac_no_alert').style.color = 'red';
                        document.getElementById('wrong_ac_no_alert').innerHTML = '☒ Use same account number';
                    }
                }

                return valid;
            }

            function showTab(index) {
                if (index < 0 || index >= tabCount) return;
                $tabLinks.removeClass('active').attr('aria-selected', 'false');
                $($tabLinks.get(index)).addClass('active').attr('aria-selected', 'true');
                $tabPanes.removeClass('show active');
                const targetSelector = $($tabLinks.get(index)).attr('href');
                $(targetSelector).addClass('show active');
                syncWizardButtons();
                window.scrollTo(0, 0);
            }

            function syncWizardButtons() {
                const index = getActiveIndex();
                const isLastTab = index === tabCount - 1;

                if (isLastTab) {
                    $('#vendor-wizard-controls').removeClass('d-flex').addClass('d-none');
                    $('.vendor-final-actions').removeClass('d-none').addClass('d-flex');
                } else {
                    $('#vendor-wizard-controls').removeClass('d-none').addClass('d-flex');
                    $('.vendor-final-actions').removeClass('d-flex').addClass('d-none');
                }

                $('#wizard-prev-btn').toggle(index > 0);
                $('#wizard-next-btn').toggle(index < tabCount - 1);
            }

            $('#wizard-next-btn').on('click', function() {
                if (isCurrentTabValid()) {
                    showTab(getActiveIndex() + 1);
                }
            });

            $('#wizard-prev-btn').on('click', function() {
                showTab(getActiveIndex() - 1);
            });

            $('#wizard-prev-last-btn').on('click', function() {
                showTab(getActiveIndex() - 1);
            });

            $tabLinks.on('click', function(e) {
                e.preventDefault();
                const targetIdx = $tabLinks.index(this);
                const currentIdx = getActiveIndex();

                if (targetIdx > currentIdx) {
                    if (targetIdx !== currentIdx + 1 || !isCurrentTabValid()) {
                        return;
                    }
                }
                showTab(targetIdx);
            });

            showTab(getActiveIndex());
            syncWizardButtons();
        });
    </script>
    <script>
        $(function() {

            var validation_option = getValidationOptions({
                rules: {
                    username: {
                        required: true,
                    }
                },
                messages: {
                    username: {
                        required: "Requirer User Name"
                    }
                }
            });

            $('#form').validate(validation_option);

            $('#btnSave').click(function(event) {
                event.preventDefault();
                save(null);
            });

            function save(callBack) {
                if ($('#form').valid()) {
                    var disabled = $('#form').find(':input:disabled').removeAttr('disabled');
                    var formData = $('#form').serializeFormJSON();
                    disabled.attr('disabled', 'disabled');
                    var url = "{{ route('staffsaveZonals') }}";
                    var successCallBack = function successCallBack(data) {
                        loadJsonToHtml(data);
                    }
                    ajaxPost(formData, url, successCallBack, null);
                }
            }
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {

            $('#package').on('change', function() {
                var package = $(this).val();
                if (package) {
                    $.ajax({
                        url: "{{ route('staffAjaxpackage') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": package
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.msg == 'Success') {
                                $('#grace_days').val(data.days);
                                $('#price').val(data.price);
                                $('#validity').val(data.validity);
                                $('#wallet').val(data.wallet);
                                $('#commission').val(data.commission);
                                $('#description').text($(data.description).text());

                                const expired_date = new Date();
                                expired_date.setDate(expired_date.getDate() + Number(data.validity));

                                const next_renewal_date = new Date();
                                next_renewal_date.setDate(next_renewal_date.getDate() + (Number(data.validity) + Number(data.days)));
                                
                                $('#expired_date').val(expired_date.toISOString().split('T')[0]);
                                $('#next_renewal_date').val(next_renewal_date.toISOString().split('T')[0]);
                            }
                        },
                        error: function() {
                            alert("error");
                        }
                    });
                }
            });

        });


        $(document).ready(function() {
            var now = new Date();

            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);

            var today = now.getFullYear() + "-" + (month) + "-" + (day);


            $('#datePicker').val(today);
        });

        $(document).ready(function() {
            const accountFields = $('#ac_no, #ac_no1');
            const maskedAccountField = $('#ac_no');
            const ifscField = $('#ifsc');

            accountFields.on('copy cut paste contextmenu selectstart', function(e) {
                e.preventDefault();
            });
            accountFields.on('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && (e.key === 'c' || e.key === 'x' || e.key === 'v' || e.key === 'a')) {
                    e.preventDefault();
                }
            });
            accountFields.on('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
            maskedAccountField.on('focus blur', function() {
                this.type = 'password';
            });

            $(document).on('copy cut paste contextmenu selectstart', function(e) {
                const el = document.activeElement;
                if (el && (el.id === 'ac_no' || el.id === 'ac_no1')) {
                    e.preventDefault();
                }
            });
            $(document).on('keydown', function(e) {
                const el = document.activeElement;
                if (el && (el.id === 'ac_no' || el.id === 'ac_no1')) {
                    if ((e.ctrlKey || e.metaKey) && (e.key === 'c' || e.key === 'x' || e.key === 'v' || e.key === 'a')) {
                        e.preventDefault();
                    }
                }
            });

            const upiField = $('#upi');
            upiField.on('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
            });

            ifscField.on('input', function() {
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 11);
            });

            $('#aadharcard').on('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 16);
            });

            $('#pincode').on('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 6);
            });
        });




        /*Password valitation*/
        function validate_password() {
            var pass = document.getElementById('pass').value;
            var confirmInput = document.getElementById('confirm_pass');
            var confirm_pass = confirmInput.value;
            var feedback = $(confirmInput).siblings('.invalid-feedback-custom')[0];

            if (confirm_pass === '') {
                confirmInput.setCustomValidity("Please enter confirm password");
                if (feedback) feedback.innerHTML = "Please enter confirm password";
                document.getElementById('create').disabled = true;
                document.getElementById('create').style.opacity = (0.4);
            } else if (pass !== confirm_pass) {
                confirmInput.setCustomValidity("Passwords do not match");
                if (feedback) feedback.innerHTML = "Passwords do not match";
                document.getElementById('create').disabled = true;
                document.getElementById('create').style.opacity = (0.4);
            } else {
                confirmInput.setCustomValidity("");
                if (feedback) feedback.innerHTML = "";
                document.getElementById('create').disabled = false;
                document.getElementById('create').style.opacity = (1);
            }
        }
        /*Account no valitation*/

        function validate_acno() {


            var ac_no = document.getElementById('ac_no').value;
            var ac_no1 = document.getElementById('ac_no1').value;
            if (ac_no != ac_no1) {
                document.getElementById('wrong_ac_no_alert').style.color = 'red';
                document.getElementById('wrong_ac_no_alert').innerHTML = '☒ Use same account number';
                document.getElementById('create').disabled = true;
                document.getElementById('create').style.opacity = (0.4);
            } else {
                document.getElementById('wrong_ac_no_alert').style.color = 'green';
                document.getElementById('wrong_ac_no_alert').innerHTML =
                    '🗹 Acount number Matched';
                document.getElementById('create').disabled = false;
                document.getElementById('create').style.opacity = (1);
            }
        }

        function wrong_ac_no_alert() {
            if (document.getElementById('ac_no').value != "" &&
                document.getElementById('ac_no1').value != "") {
                alert("Your response is submitted");
            } else {
                alert("Please fill all the fields");
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.toggle-password', function() {
                const input = $(this).siblings('input');
                const icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Dynamically move mandatory star after the label and color it red
            $('span:contains("*")').each(function() {
                var parent = $(this).parent();
                if (parent.is('label') || parent.hasClass('col-xl-3') || parent.hasClass('col-md-3')) {
                    $(this).addClass('text-danger ms-1').appendTo(parent);
                }
            });

            // Dynamically inject validation feedback divs under required inputs
            $('input[required], select[required], textarea[required], [required]').each(function() {
                if ($(this).siblings('.invalid-feedback-custom').length === 0) {
                    var labelText = $(this).closest('.form-group').find('label').text().trim().replace(/[*:]/g, '').trim();
                    if (!labelText) {
                        labelText = $(this).attr('placeholder') || $(this).attr('name') || 'field';
                    }
                    var action = "enter";
                    if ($(this).is('select')) {
                        action = "select";
                    } else if ($(this).attr('type') === 'file') {
                        action = "upload";
                    }
                    var msg = "Please " + action + " " + labelText.toLowerCase();
                    
                    if ($(this).attr('id') === 'pass') {
                        msg = "Please enter password";
                    } else if ($(this).attr('id') === 'confirm_pass') {
                        msg = "Please enter confirm password";
                    }
                    
                    if ($(this).parent().hasClass('position-relative')) {
                        $(this).parent().append('<div class="invalid-feedback-custom">' + msg + '</div>');
                    } else {
                        $(this).after('<div class="invalid-feedback-custom">' + msg + '</div>');
                    }
                }
            });

            $('#vendor-edit-form').on('submit', function(e) {
                $(this).addClass('validation-attempted');
            });

            $('#pincode').on('change', function() {
                var pincode = $(this).val();
                // alert(pincode);

                $.ajax({
                    url: "{{ route('staffpicodedetailsreceived') }}",
                    method: 'POST',
                    data: {
                        pincode: pincode
                    },
                    success: function(response) {

                        // Handle the response from the server
                        // $('#result').html(response);
                        $('#zone').html('<option value="' + response[0].id + '">' + response[0]
                            .name + '</option>');
                        $('#route').val(response[0].area);
                    },
                    error: function() {
                        // Handle errors if any
                        alert('Error sending pincode');
                    }
                });

            });
        });
    </script>
@endpush
