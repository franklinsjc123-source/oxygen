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
        @include('paritials.auth.sidemenu');
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
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i
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
                                            aria-controls="top-profile" aria-selected="true"><i class="fa fa-user me-2"></i><span class="fw-bold">Personal Information</span></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link " id="top-product-tab"
                                            href="#top-product" role="tab" aria-controls="top-product"
                                            aria-selected="true"><i class="fa fa-list me-2"></i><span
                                                class="fw-bold">Product Category</span></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="upload-top-tab" 
                                            href="#top-upload" role="tab" aria-controls="top-upload"
                                            aria-selected="false"><i class="fa fa-file-text me-2"></i><span
                                                class="fw-bold">Documents & Package</span> </a>
                                    </li>


                                    <li class="nav-item"><a class="nav-link" id="top-bank-upload" 
                                            href="#top-bank" role="tab" aria-controls="top-upload"
                                            aria-selected="false"><i class="fa fa-bank me-2"></i><span class="fw-bold gothic">Bank Details</span></a>
                                    </li>

                                    <li class="nav-item"><a class="nav-link" id="upload-setting-tab" 
                                            href="#top-setting" role="tab" aria-controls="top-upload"
                                            aria-selected="false"><i class="fa fa-cog me-2"></i><span class="fw-bold gothic">Support</span></a>
                                    </li>
                                </ul>
                                <form class="needs-validation" novalidate method="post"
                                    action="{{ route('vendorcreate.update', $vendorcreate->id) }}"
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
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">User Name <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                value="{{ $vendorcreate->username }}" type="text"
                                                                name="username" required>
                                                            <div class="invalid-feedback-custom">Please enter user name</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Password <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <div class="position-relative">
                                                                <input class="form-control pe-5" id="pass"
                                                                    value="{{ $vendorcreate->pass }}" type="password"
                                                                    name="pass" required>
                                                                <span class="position-absolute toggle-password" style="right: 15px; top: 19px; transform: translateY(-50%); cursor: pointer;">
                                                                    <i class="fa fa-eye"></i>
                                                                </span>
                                                                <div class="invalid-feedback-custom">Please enter password</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Confirm Password <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <div class="position-relative">
                                                                <input class="form-control pe-5" id="confirm_pass" type="password"
                                                                    value="{{ $vendorcreate->pass1 }}" name="pass1"
                                                                    onkeyup="validate_password()" required>
                                                                <span class="position-absolute toggle-password" style="right: 15px; top: 19px; transform: translateY(-50%); cursor: pointer;">
                                                                    <i class="fa fa-eye"></i>
                                                                </span>
                                                                <div class="invalid-feedback-custom" id="confirm_pass_feedback">Please enter confirm password</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Shop Name <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                value="{{ $vendorcreate->shop_name }}" type="text"
                                                                name="shop_name" required>
                                                            <div class="invalid-feedback-custom">Please enter shop name</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Owner Name <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="" type="text"
                                                                value="{{ $vendorcreate->owner_name }}" name="owner_name" required>
                                                            <div class="invalid-feedback-custom">Please enter owner name</div>
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
                                                            class="col-xl-4 col-md-4">E-Mail <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="email" type="email"
                                                                value="{{ $vendorcreate->email }}" name="email" required>
                                                            <div class="invalid-feedback-custom">Please enter e-mail</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Mobile Number <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="m_number" type="text"
                                                                value="{{ $vendorcreate->mobile_number1 }}"
                                                                name="mobile_number1" maxlength="10" pattern="[0-9]{10}" required>
                                                            <div class="invalid-feedback-custom">Please enter mobile number</div>
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
                                                                name="mobile_number2" maxlength="10" pattern="[0-9]{10}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Address I <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                value="{{ $vendorcreate->address }}" type="text"
                                                                name="address1" required>
                                                            <div class="invalid-feedback-custom">Please enter address</div>
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
                                                        <label for="validationCustom01" class="col-xl-4 col-md-4">State <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <select class="custom-select w-100 form-control"
                                                                name="state" required>
                                                                <option value="{{ $vendorcreate->state }}" selected
                                                                    hidden>{{ $vendorcreate->state }}</option>
                                                                <option value="">--Select--</option>
                                                                <option value="tamilnadu">TamilNadu</option>
                                                                <option value="kerala">Kerala</option>
                                                            </select>
                                                            <div class="invalid-feedback-custom">Please select state</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-4 col-md-4">City <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <select class="custom-select w-100 form-control"
                                                                name="city" required>
                                                                <option value="{{ $vendorcreate->city }}" selected hidden>
                                                                    {{ $vendorcreate->city }}</option>
                                                                <option value="">--Select--</option>
                                                                <option value="chennai">Chennai</option>
                                                                <option value="trichy">Trichy</option>
                                                            </select>
                                                            <div class="invalid-feedback-custom">Please select city</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">
                                                            Pincode <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                             <input class="form-control" id="pincode" type="text"
                                                                value="{{ $vendorcreate->pincode }}" name="pincode"
                                                                maxlength="6" minlength="6" pattern="[0-9]{6}" required>
                                                            <div class="invalid-feedback-custom">Please enter pincode</div>
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
                                                            Zone <span class="text-danger">*</span></label>
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
                                                            <div class="invalid-feedback-custom">Please select zone</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2"
                                                            class="col-xl-4 col-md-4">Area <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="route"
                                                                value="{{ $vendorcreate->route }}" type="text"
                                                                name="route" required>
                                                            <div class="invalid-feedback-custom">Please enter area</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Aadhar Number <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="aadharcard"
                                                                value="{{ $vendorcreate->aadhar_no }}" type="text"
                                                                name="aadhar_no" maxlength="16" minlength="16" pattern="[0-9]{16}" required>
                                                            <div class="invalid-feedback-custom">Please enter Aadhar number</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2" class="col-xl-4 col-md-4">GST number <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom2"
                                                                value="{{ $vendorcreate->gst_number }}" type="text"
                                                                name="gst_number" required>
                                                            <div class="invalid-feedback-custom">Please enter GST number</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-xl-4 col-md-4">Staff (RM) <span class="text-danger">*</span></label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <select class="form-control" name="staff_id" required>
                                                                <option value="">Select Staff</option>
                                                                @foreach ($staffs as $staff)
                                                                    <option value="{{ $staff->id }}" {{ $vendorcreate->staff_id == $staff->id ? 'selected' : '' }}>
                                                                        {{ $staff->fullname ?? $staff->username }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback-custom">Please select staff</div>
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
                                                        <label for="validationCustom01" class="col-xl-4 col-md-4">Pack <span class="text-danger">*</span></label>
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
                                                            <div class="invalid-feedback-custom">Please select package</div>
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


                                                     @php
                                                         $displayDescription = $vendorcreate->description;
                                                         if (empty($displayDescription) && !empty($vendorcreate->package_id)) {
                                                             $matchedPackage = $package->firstWhere('id', $vendorcreate->package_id);
                                                             if ($matchedPackage) {
                                                                 $displayDescription = $matchedPackage->description;
                                                             }
                                                         }
                                                     @endphp
                                                     <textarea class="form-control" rows="5" id="description" name="description" type="text">{{ strip_tags(str_replace(['</li>', '<br>', '<br/>'], "\n", $displayDescription)) }}</textarea>
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
                                                        <label for="bank_name" class="col-xl-3 col-md-3">Account Holder Name <span class="text-danger">*</span></label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="bank_name" name="bank_name"
                                                                type="text" value="{{ $vendorcreate->bank_name }}">
                                                            <div class="invalid-feedback-custom">Please enter account holder name</div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="ac_no" class="col-xl-3 col-md-3">Account Number <span class="text-danger">*</span></label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no" name="ac_no"
                                                                type="password" value="{{ $vendorcreate->ac_no }}"
                                                                inputmode="numeric" pattern="[0-9]*"
                                                                autocomplete="off" spellcheck="false"
                                                                oncopy="return false" oncut="return false"
                                                                onpaste="return false" oncontextmenu="return false"
                                                                onselectstart="return false"
                                                                style="user-select: none;">
                                                            <div class="invalid-feedback-custom">Please enter account number</div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="ac_no1" class="col-xl-3 col-md-3">Confirm Account Number <span class="text-danger">*</span></label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no1" name="ac_no1"
                                                                type="text" value="{{ $vendorcreate->ac_no1 }}"
                                                                onkeyup="validate_acno()"
                                                                inputmode="numeric" pattern="[0-9]*"
                                                                autocomplete="off" spellcheck="false"
                                                                oncopy="return false" oncut="return false"
                                                                onpaste="return false" oncontextmenu="return false"
                                                                onselectstart="return false"
                                                                style="user-select: none;">
                                                            <div class="invalid-feedback-custom" id="confirm_ac_no_feedback">Please enter confirm account number</div>
                                                        </div>
                                                        <span id="wrong_ac_no_alert"></span>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="ifsc" class="col-xl-3 col-md-3">IFSC Code <span class="text-danger">*</span></label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ifsc" name="ifsc"
                                                                type="text" value="{{ $vendorcreate->ifsc }}" 
                                                                maxlength="11" minlength="11">
                                                            <div class="invalid-feedback-custom">Please enter IFSC code</div>
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
                                                            <label>UPI <span class="text-danger">*</span> <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/UPI-Logo-vector.svg"
                                                                width="80px" alt="UPI Logo"></label>
                                                        </div>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="upi" name="upi"
                                                                type="text" value="{{ $vendorcreate->upi }}"
                                                                maxlength="10" inputmode="numeric"
                                                                autocomplete="off" spellcheck="false">
                                                            <div class="invalid-feedback-custom">Please enter UPI number</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade show " id="top-setting" role="tabpanel"
                                            aria-labelledby="top-setting-tab">

                                            <div class="row mt-4">
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
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label class="fw-bold">Comments</label>
                                                    <textarea class="form-control" rows="3" id="validationCustom1" name="comments" placeholder="Enter comments here...">{{ $vendorcreate->comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label class="fw-bold">Instagram Link</label>
                                                    <input class="form-control" type="text" name="instagram_link" value="{{ $vendorcreate->instagram_link }}">
                                                    <div class="invalid-feedback-custom">Please enter a valid Instagram URL (e.g. https://instagram.com/username).</div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="fw-bold">Facebook Link</label>
                                                    <input class="form-control" type="text" name="facebook_link" value="{{ $vendorcreate->facebook_link }}">
                                                    <div class="invalid-feedback-custom">Please enter a valid Facebook URL (e.g. https://facebook.com/username).</div>
                                                </div>
                                                <div class="col-md-4">
                                                     <label class="fw-bold">WhatsApp Number <span style="color: red;">*</span></label>
                                                     <input class="form-control" type="text" name="whatsapp_number" value="{{ $vendorcreate->whatsapp_number }}" required>
                                                    <div class="invalid-feedback-custom">Please enter WhatsApp number</div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <div style="border-left: 4px solid #ff5e14; padding-left: 10px; margin-bottom: 20px;">
                                                        <h5 class="fw-bold" style="color: #333; margin: 0; font-size: 16px;">Store Operating Hours</h5>
                                                        <small class="text-muted">Specify the timing for each day (e.g., "9:00 AM - 9:00 PM" or "Closed")</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <style>
                                                @media (max-width: 575px) {
                                                    .day-time-card {
                                                        flex-direction: column;
                                                        align-items: flex-start !important;
                                                        gap: 10px !important;
                                                        padding: 12px !important;
                                                    }
                                                    .time-selectors-container {
                                                        width: 100%;
                                                        justify-content: flex-start !important;
                                                    }
                                                    .closed-badge {
                                                        padding-left: 0 !important;
                                                    }
                                                }
                                            </style>
                                            <div class="row">
                                                @php
                                                    $days = [
                                                        'sunday' => 'Sunday',
                                                        'monday' => 'Monday',
                                                        'tuesday' => 'Tuesday',
                                                        'wednesday' => 'Wednesday',
                                                        'thursday' => 'Thursday',
                                                        'friday' => 'Friday',
                                                        'saturday' => 'Saturday'
                                                    ];
                                                @endphp
                                                @foreach($days as $key => $day)
                                                    <div class="col-md-6 mb-3">
                                                        <div class="p-3 day-time-card" style="background: #ffffff; border: 1px solid #eef2f5; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); display: flex; align-items: center; justify-content: space-between; gap: 15px;">
                                                            <!-- Checkbox and Day name -->
                                                            <div style="display: flex; align-items: center; gap: 10px; min-width: 120px;">
                                                                <input type="checkbox" class="form-check-input store-time-checkbox" id="open_{{ $key }}" data-day="{{ $key }}" style="width: 18px; height: 18px; cursor: pointer;">
                                                                <label class="fw-bold mb-0" for="open_{{ $key }}" style="font-size: 14px; cursor: pointer; color: #4a5568;">{{ $day }}</label>
                                                            </div>
                                                            <!-- Time selectors (shown when open) -->
                                                            <div class="time-selectors-container" id="time_container_{{ $key }}" style="display: flex; align-items: center; gap: 8px; flex-grow: 1; justify-content: flex-end;">
                                                                <input type="time" class="form-control store-time-input start-time" id="start_{{ $key }}" data-day="{{ $key }}" style="max-width: 115px; font-size: 13px; padding: 5px 8px; border-radius: 6px;">
                                                                <span class="text-muted" style="font-size: 12px;">to</span>
                                                                <input type="time" class="form-control store-time-input end-time" id="end_{{ $key }}" data-day="{{ $key }}" style="max-width: 115px; font-size: 13px; padding: 5px 8px; border-radius: 6px;">
                                                            </div>
                                                            <!-- Closed text (shown when closed) -->
                                                            <div class="closed-badge" id="closed_badge_{{ $key }}" style="display: none; color: #94a3b8; font-size: 13px; font-weight: 500; flex-grow: 1; text-align: left; padding-left: 10px;">
                                                                Unavailable / Closed
                                                            </div>
                                                            <!-- Hidden input that actually gets submitted -->
                                                            <input type="hidden" name="store_time_{{ $key }}" id="hidden_time_{{ $key }}" value="{{ $vendorcreate->{'store_time_' . $key} ?? '' }}">
                                                        </div>
                                                    </div>
                                                @endforeach
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
    <script>
        $(function() {
            function formatTime12Hour(time24) {
                if (!time24) return "";
                let [hours, minutes] = time24.split(':');
                hours = parseInt(hours);
                let ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12;
                hours = hours ? hours : 12;
                return `${hours}:${minutes} ${ampm}`;
            }

            function parseTime12HourTo24(time12) {
                if (!time12 || time12.toLowerCase() === 'closed') return "";
                let match = time12.match(/(\d+):(\d+)\s*(am|pm)/i);
                if (!match) return "";
                let hours = parseInt(match[1]);
                let minutes = match[2];
                let ampm = match[3].toLowerCase();
                if (ampm === 'pm' && hours < 12) hours += 12;
                if (ampm === 'am' && hours === 12) hours = 0;
                return `${hours.toString().padStart(2, '0')}:${minutes}`;
            }

            function parseStoreTime(timeStr) {
                if (!timeStr) {
                    return { open: true, start: "09:00", end: "21:00" };
                }
                if (timeStr.toLowerCase().trim() === 'closed') {
                    return { open: false, start: "09:00", end: "21:00" };
                }
                let parts = timeStr.split(/to|-/i);
                if (parts.length < 2) {
                    return { open: true, start: "09:00", end: "21:00" };
                }
                let start24 = parseTime12HourTo24(parts[0].trim());
                let end24 = parseTime12HourTo24(parts[1].trim());
                return {
                    open: true,
                    start: start24 || "09:00",
                    end: end24 || "21:00"
                };
            }

            function updateDayValue(day) {
                let isOpen = $(`#open_${day}`).is(':checked');
                if (isOpen) {
                    let start = $(`#start_${day}`).val();
                    let end = $(`#end_${day}`).val();
                    let start12 = formatTime12Hour(start);
                    let end12 = formatTime12Hour(end);
                    $(`#hidden_time_${day}`).val(`${start12} to ${end12}`);
                    $(`#time_container_${day}`).show();
                    $(`#closed_badge_${day}`).hide();
                } else {
                    $(`#hidden_time_${day}`).val('Closed');
                    $(`#time_container_${day}`).hide();
                    $(`#closed_badge_${day}`).show();
                }
            }

            let days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            days.forEach(day => {
                let initialVal = $(`#hidden_time_${day}`).val();
                let parsed = parseStoreTime(initialVal);
                
                $(`#open_${day}`).prop('checked', parsed.open);
                $(`#start_${day}`).val(parsed.start);
                $(`#end_${day}`).val(parsed.end);
                
                updateDayValue(day);
            });

            $('.store-time-checkbox').on('change', function() {
                let day = $(this).data('day');
                updateDayValue(day);
            });

            $('.store-time-input').on('change', function() {
                let day = $(this).data('day');
                updateDayValue(day);
            });
        });
    </script>
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

                // Add validation-attempted to show validation errors
                $('form.needs-validation').addClass('validation-attempted');

                inputs.each(function() {
                    if (!this.checkValidity()) {
                        valid = false;
                        this.reportValidity();
                        $(this).focus();
                        return false;
                    }
                });

                if (!valid) return false;

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
                    var url = "{{ route('saveZonals') }}";
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
                        url: "{{ route('Ajaxpackage') }}",
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
                                 var tempDiv = document.createElement('div');
                                 tempDiv.innerHTML = data.description.replace(/<\/li>|<br\s*\/?>/gi, '\n');
                                 var plainDescription = tempDiv.textContent || tempDiv.innerText || "";
                                 $('#description').val(plainDescription.trim());

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
            var feedback = document.getElementById('confirm_pass_feedback');
            var submitBtn = document.getElementById('create');

            if (confirm_pass === '') {
                confirmInput.setCustomValidity("Please enter confirm password");
                if (feedback) feedback.innerHTML = "Please enter confirm password";
                if (submitBtn) { submitBtn.disabled = true; submitBtn.style.opacity = 0.4; }
            } else if (pass !== confirm_pass) {
                confirmInput.setCustomValidity("Passwords do not match");
                if (feedback) feedback.innerHTML = "Passwords do not match";
                if (submitBtn) { submitBtn.disabled = true; submitBtn.style.opacity = 0.4; }
            } else {
                confirmInput.setCustomValidity("");
                if (feedback) feedback.innerHTML = "";
                if (submitBtn) { submitBtn.disabled = false; submitBtn.style.opacity = 1; }
            }
        }
        /*Account no valitation*/

        function validate_acno() {
            var ac_no = document.getElementById('ac_no').value;
            var confirmAcInput = document.getElementById('ac_no1');
            var ac_no1 = confirmAcInput.value;
            var feedback = document.getElementById('confirm_ac_no_feedback');
            var submitBtn = document.getElementById('create');
            var upiVal = document.getElementById('upi').value.trim();

            if (ac_no === '' && ac_no1 === '' && upiVal !== '') {
                confirmAcInput.setCustomValidity("");
                if (feedback) feedback.innerHTML = "";
                if (submitBtn) { submitBtn.disabled = false; submitBtn.style.opacity = 1; }
                return;
            }

            if (ac_no1 === '') {
                confirmAcInput.setCustomValidity("Please enter confirm account number");
                if (feedback) feedback.innerHTML = "Please enter confirm account number";
                if (submitBtn) { submitBtn.disabled = true; submitBtn.style.opacity = 0.4; }
            } else if (ac_no !== ac_no1) {
                confirmAcInput.setCustomValidity("Account numbers do not match");
                if (feedback) feedback.innerHTML = "Account numbers do not match";
                if (submitBtn) { submitBtn.disabled = true; submitBtn.style.opacity = 0.4; }
            } else {
                confirmAcInput.setCustomValidity("");
                if (feedback) feedback.innerHTML = "";
                if (submitBtn) { submitBtn.disabled = false; submitBtn.style.opacity = 1; }
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
            $('#pincode').on('change', function() {
                var pincode = $(this).val();
                // alert(pincode);

                $.ajax({
                    url: "{{ route('picodedetailsreceived') }}",
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

            $('#m_number, #alter_no').on('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
            });

            $('[name="whatsapp_number"]').on('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
            });

            function initBankUpiValidation() {
                var bank_name = $('#bank_name').val().trim();
                var ac_no = $('#ac_no').val().trim();
                var ac_no1 = $('#ac_no1').val().trim();
                var ifsc = $('#ifsc').val().trim();
                var upi = $('#upi').val().trim();

                var has_bank_any = (bank_name !== '' || ac_no !== '' || ac_no1 !== '' || ifsc !== '');
                var has_upi = (upi !== '');

                if (has_upi) {
                    $('#bank_name, #ac_no, #ac_no1, #ifsc').prop('required', false);
                    $('#upi').prop('required', true);
                } else if (has_bank_any) {
                    $('#bank_name, #ac_no, #ac_no1, #ifsc').prop('required', true);
                    $('#upi').prop('required', false);
                } else {
                    $('#bank_name, #ac_no, #ac_no1, #ifsc').prop('required', false);
                    $('#upi').prop('required', false);
                }
            }

            $('#bank_name, #ac_no, #ac_no1, #ifsc, #upi').on('input change', function() {
                initBankUpiValidation();
                validate_acno();
            });

            initBankUpiValidation();

            $('input[type="file"]').on('change', function() {
                const files = this.files;
                if (files && files.length > 0) {
                    const maxLimit = 4 * 1024 * 1024; // 4MB
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].size > maxLimit) {
                            alert('File "' + files[i].name + '" exceeds the maximum limit of 4MB.');
                            this.value = ''; // Reset input
                            return;
                        }
                    }
                }
            });

            function validateSocialLinks() {
                var instagram = $('[name="instagram_link"]').val().trim();
                var facebook = $('[name="facebook_link"]').val().trim();
                var urlRegex = /^(https?:\/\/)?(www\.)?([a-zA-Z0-9-]{2,}\.)+[a-zA-Z]{2,}(\/.*)?$/;
                var isInstagramVal = true;
                var isFacebookVal = true;

                if (instagram !== '') {
                    if (!urlRegex.test(instagram) || !instagram.toLowerCase().includes('instagram.com')) {
                        $('[name="instagram_link"]').addClass('invalid-field');
                        isInstagramVal = false;
                    } else {
                        $('[name="instagram_link"]').removeClass('invalid-field');
                    }
                } else {
                    $('[name="instagram_link"]').removeClass('invalid-field');
                }

                if (facebook !== '') {
                    if (!urlRegex.test(facebook) || (!facebook.toLowerCase().includes('facebook.com') && !facebook.toLowerCase().includes('fb.com') && !facebook.toLowerCase().includes('fb.me'))) {
                        $('[name="facebook_link"]').addClass('invalid-field');
                        isFacebookVal = false;
                    } else {
                        $('[name="facebook_link"]').removeClass('invalid-field');
                    }
                } else {
                    $('[name="facebook_link"]').removeClass('invalid-field');
                }

                return { isInstagramVal: isInstagramVal, isFacebookVal: isFacebookVal };
            }

            function validateMobileNumbers() {
                var m_number = $('#m_number').val().trim();
                var alter_no = $('#alter_no').val().trim();
                var isMValid = true;
                var isAlterValid = true;

                if (m_number === '') {
                    $('#m_number').addClass('invalid-field');
                    $('#m_number').siblings('.invalid-feedback-custom').text('Please enter mobile number');
                    isMValid = false;
                } else if (m_number.length !== 10) {
                    $('#m_number').addClass('invalid-field');
                    if ($('#m_number').siblings('.invalid-feedback-custom').length === 0) {
                        $('#m_number').after('<div class="invalid-feedback-custom">Mobile number must be exactly 10 digits</div>');
                    } else {
                        $('#m_number').siblings('.invalid-feedback-custom').text('Mobile number must be exactly 10 digits');
                    }
                    isMValid = false;
                } else {
                    $('#m_number').removeClass('invalid-field');
                }

                if (alter_no !== '') {
                    if (alter_no.length !== 10) {
                        $('#alter_no').addClass('invalid-field');
                        if ($('#alter_no').siblings('.invalid-feedback-custom').length === 0) {
                            $('#alter_no').after('<div class="invalid-feedback-custom">Alternate number must be exactly 10 digits</div>');
                        } else {
                            $('#alter_no').siblings('.invalid-feedback-custom').text('Alternate number must be exactly 10 digits');
                        }
                        isAlterValid = false;
                    } else {
                        $('#alter_no').removeClass('invalid-field');
                    }
                } else {
                    $('#alter_no').removeClass('invalid-field');
                }

                return { isMValid: isMValid, isAlterValid: isAlterValid };
            }

            $('[name="instagram_link"], [name="facebook_link"]').on('input change', function() {
                validateSocialLinks();
            });

            $('#m_number, #alter_no').on('input change', function() {
                validateMobileNumbers();
            });

             $('form.needs-validation').on('submit', function(e) {
                $(this).addClass('validation-attempted');

                let formValid = true;
                $(this).find('input[required], select[required], textarea[required], [required]').each(function() {
                    if (!this.checkValidity()) {
                        formValid = false;
                        const tabPane = $(this).closest('.tab-pane');
                        if (tabPane.length) {
                            const tabId = tabPane.attr('id');
                            $(`#top-tab a[href="#${tabId}"]`).tab('show');
                        }
                        this.reportValidity();
                        $(this).focus();
                        return false;
                    }
                });

                if (!formValid) {
                    e.preventDefault();
                    return false;
                }

                var valResult = validateSocialLinks();
                if (!valResult.isInstagramVal) {
                    e.preventDefault();
                    $('[name="instagram_link"]').focus();
                    return false;
                }
                if (!valResult.isFacebookVal) {
                    e.preventDefault();
                    $('[name="facebook_link"]').focus();
                    return false;
                }

                var mobResult = validateMobileNumbers();
                if (!mobResult.isMValid) {
                    e.preventDefault();
                    $('#m_number').focus();
                    return false;
                }
                if (!mobResult.isAlterValid) {
                    e.preventDefault();
                    $('#alter_no').focus();
                    return false;
                }

                var bank_name = $('#bank_name').val().trim();
                var ac_no = $('#ac_no').val().trim();
                var ac_no1 = $('#ac_no1').val().trim();
                var ifsc = $('#ifsc').val().trim();
                var upi = $('#upi').val().trim();

                var has_bank_any = (bank_name !== '' || ac_no !== '' || ac_no1 !== '' || ifsc !== '');
                var has_bank_all = (bank_name !== '' && ac_no !== '' && ac_no1 !== '' && ifsc !== '');
                var has_upi = (upi !== '');

                if (!has_upi && !has_bank_any) {
                    e.preventDefault();
                    alert('Please fill out either Bank Details or UPI details.');
                    $('#bank_name').focus();
                    return false;
                } else if (has_bank_any && !has_bank_all) {
                    e.preventDefault();
                    $('#bank_name, #ac_no, #ac_no1, #ifsc').each(function() {
                        if (this.value.trim() === '') {
                            this.setCustomValidity('Please fill out this field.');
                            this.reportValidity();
                            $(this).focus();
                            return false;
                        } else {
                            this.setCustomValidity('');
                        }
                    });
                    return false;
                } else if (has_bank_all && ac_no !== ac_no1) {
                    e.preventDefault();
                    $('#ac_no1').focus();
                    alert('Account numbers do not match.');
                    return false;
                }

                var totalSize = 0;
                var maxPostSize = 20 * 1024 * 1024; // 20MB
                var maxFileSize = 4 * 1024 * 1024; // 4MB
                var fileTooLarge = false;
                var offendingFileName = '';
                
                $(this).find('input[type="file"]').each(function() {
                    var files = this.files;
                    if (files) {
                        for (var i = 0; i < files.length; i++) {
                            totalSize += files[i].size;
                            if (files[i].size > maxFileSize) {
                                fileTooLarge = true;
                                offendingFileName = files[i].name;
                            }
                        }
                    }
                });

                if (fileTooLarge) {
                    e.preventDefault();
                    alert('The file "' + offendingFileName + '" exceeds the 4MB size limit. Please upload smaller files.');
                    return false;
                }

                if (totalSize > maxPostSize) {
                    e.preventDefault();
                    alert('The total size of the uploaded files exceeds the 20MB limit. Please upload smaller files.');
                    return false;
                }
            });
        });
    </script>
@endpush
