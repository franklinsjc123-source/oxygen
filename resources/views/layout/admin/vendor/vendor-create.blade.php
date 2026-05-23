@extends('layout.auth.master')
@section('contents')
    <style>
        .gothic{
            font-family:'Century Gothic',lucida grande, helvetica, verdana, arial, sans-serif;
        }
        .vendor-final-actions {
            /* padding-right removed to allow proper right alignment */
        }
        #ac_no,
        #ac_no1 {
            -webkit-text-security: disc;
            text-security: disc;
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
                                <h3>Vendor Creation
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i
                                            data-feather="home"></i></a></li>

                                <li class="breadcrumb-item active">Vendor Creation </li>
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

                                <form class="" method="post" action="{{ route('vendorcreate.store') }}"
                                    enctype="multipart/form-data">
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
                                                            <input class="form-control" readonly
                                                                value="{{ session()->get('username') }}"
                                                                id="validationCustom0" type="text" name="created_by">
                                                            {{-- <input class="form-control" readonly
                                                                value="SKAP"
                                                                id="validationCustom0" type="text" name="created_by"> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> User
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" name="username" required>
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
                                                            <input class="form-control" id="pass" type="text"
                                                                name="pass" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> Confirm
                                                            Password</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="confirm_pass" type="text"
                                                                name="pass1" onkeyup="validate_password()" required>
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
                                                                type="text" name="shop_name"
                                                                value="{{ old('shop_name', @$tracker->shop_name) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> Owner
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="" type="text"
                                                                name="owner_name"
                                                                value="{{ old('owner_name', @$tracker->owner_name) }}" required>
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
                                                                type="text" name="business_category"
                                                                value="{{ old('business_category', @$tracker->business_category) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2"
                                                            class="col-xl-4 col-md-4"><span>*</span> E.Mail</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="email" type="email"
                                                                name="email"
                                                                value="{{ old('email', @$tracker->email) }}" required>
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
                                                                name="mobile_number1"
                                                                value="{{ old('mobile_number1', @$tracker->mobile_number) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Alternate
                                                            Number</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="alter_no" type="text"
                                                                name="mobile_number2"
                                                                value="{{ old('mobile_number2', @$tracker->mobile_number1) }}">
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
                                                                type="text" name="address1"
                                                                value="{{ old('address1', @$tracker->address) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Address
                                                            II</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" name="address2"
                                                                value="{{ old('address2', @$tracker->address1) }}">
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
                                                                name="state" required="">
                                                                <option value="">--Select--</option>

                                                                @foreach ($State as $st)
                                                                    <option value="{{ $st->state_name }}"
                                                                        {{ @$tracker->state == $st->state_name ? 'selected' : '' }}>
                                                                        {{ $st->state_name }} </option>
                                                                @endforeach

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
                                                                name="city" required="">
                                                                <option value="">--Select--</option>

                                                                @foreach ($City as $ct)
                                                                    <option value="{{ $ct->city_name }}"
                                                                        {{ @$tracker->city == $ct->city_name ? 'selected' : '' }}>
                                                                        {{ $ct->city_name }} </option>
                                                                @endforeach

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
                                                                name="pincode" maxlength="6" minlength="6"
                                                                pattern="[0-9]{6}" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                                value="{{ old('pincode', @$tracker->pincode) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="validationCustom0" class="col-xl-4 col-md-4">Location Map</label>
                                                            <div class="col-xl-8 col-md-8">
                                                                <div class="input-group mb-2">
                                                                    <input class="form-control" id="location_map" type="text"
                                                                        name="location_map" value="{{ old('location_map') }}" placeholder="Select location on map" readonly>
                                                                    <button class="btn btn-primary" id="btn_open_map" type="button" data-bs-toggle="modal" data-bs-target="#vendorMapModal">
                                                                        <i class="fa fa-map-marker"></i> Pick on Map
                                                                    </button>
                                                                    <button class="btn btn-info ms-2" id="btn_current_location" type="button">
                                                                        <i class="fa fa-crosshairs"></i> Current Location
                                                                    </button>
                                                                </div>
                                                                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                                                                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                                                                <small class="text-muted">Stored Coordinates: <span id="coords_display">N/A</span></small>
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

                                                            <select class="form-control" name="zone" id="zone" required>

                                                                <option value=''>Select zone</option>

                                                                @foreach ($zone as $zo)
                                                                    <option value="{{ $zo->name }}"
                                                                        {{ @$tracker->zone == $zo->name ? 'selected' : '' }}>
                                                                        {{ $zo->name }} </option>
                                                                @endforeach
                                                            </select>

                                                            {{-- <input class="form-control" id="validationCustom0"
                                                                type="text" name="zone"> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2"
                                                            class="col-xl-4 col-md-4"><span>*</span> Area</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" type="text" id="route"
                                                                name="route"
                                                                value="{{ old('route', @$tracker->area) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"><span>*</span> Aadhar
                                                            Number</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control"
                                                                type="text" name="aadhar_no" id="aadharcard" required 
                                                                maxlength="16" minlength="16" pattern="[0-9]{16}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2" class="col-xl-4 col-md-4"><span>*</span> GST
                                                            number</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom2"
                                                                type="text" name="gst_number" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-xl-4 col-md-4"><span>*</span> Staff (RM)</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <select class="form-control" name="staff_id" required>
                                                                <option value="">Select Staff</option>
                                                                @foreach ($staffs as $staff)
                                                                    <option value="{{ $staff->id }}">{{ $staff->fullname ?? $staff->username }}</option>
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
                                                                                    $subIdsCsv = $subList
                                                                                        ->pluck('id')
                                                                                        ->implode(',');
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
                                                                                            data-sub-ids="{{ $subIdsCsv }}">
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
                                                        <div id="selected_subcategory_inputs">
                                                            <input type="hidden" name="sub_category_ids_csv"
                                                                id="sub_category_ids_csv" value="">
                                                        </div>
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
                                                        name="profile_image" multiple accept="image/*,.pdf" required />
                                                    <div id="image-holder"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2">GST</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file"
                                                        name="gst" multiple accept="image/*,.pdf" />
                                                    <div id="image-holder1"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2"><span></span>Other Documents</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file"
                                                        name="other_documents" multiple accept="image/*,.pdf" />
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
                                                                <option value="" disabled selected>Select Package</option>

                                                                @foreach ($pack as $pack)
                                                                    <option value="{{ $pack->id }}">
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
                                                            <input id="datePicker" type="date" class="form-control "
                                                                name="purchase_date" placeholder="dd/mm/yy" />
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
                                                                readonly name="validity">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">++
                                                            Days</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="grace_days" type="text"
                                                                readonly name="grace_days">
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
                                                                readonly name="wallet">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0"
                                                            class="col-xl-4 col-md-4">Commission %</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" readonly id="commission"
                                                                type="text" name="commission">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2">Description</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <textarea class="form-control" readonly rows="3" id="description" type="text" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade show " id="top-bank" role="tabpanel"
                                            aria-labelledby="top-bank-tab">
                                            <div class="row mt-4">
                                                <div class="col-md-12">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"><span>*</span> Account
                                                            Holder Name</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="bank_name" type="text"
                                                                name="bank_name" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"><span>*</span> Account
                                                            Number</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no" type="password"
                                                                name="ac_no" inputmode="numeric" pattern="[0-9]*"
                                                                required
                                                                autocomplete="off" spellcheck="false"
                                                                oncopy="return false" oncut="return false"
                                                                onpaste="return false" oncontextmenu="return false"
                                                                onselectstart="return false"
                                                                style="user-select: none;">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"><span>*</span> Confirm
                                                            Account Number</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no1" type="text"
                                                                name="ac_no1" onkeyup="validate_acno()"
                                                                inputmode="numeric" pattern="[0-9]*"
                                                                required
                                                                autocomplete="off" spellcheck="false"
                                                                oncopy="return false" oncut="return false"
                                                                onpaste="return false" oncontextmenu="return false"
                                                                onselectstart="return false"
                                                                style="user-select: none;">
                                                        </div>
                                                        <span id="wrong_ac_no_alert"></span>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"><span>*</span> IFSC
                                                            Code </label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ifsc" type="text"
                                                                name="ifsc" maxlength="11" minlength="11" required>
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
                                                            <span>*</span> <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/UPI-Logo-vector.svg"
                                                                width="80px">
                                                        </div>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="upi" type="text"
                                                                name="upi" maxlength="10" inputmode="numeric"
                                                                pattern="[0-9]{10}" autocomplete="off"
                                                                spellcheck="false" required>
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
                                                                id="check1" name="option1" value="mobile">
                                                            <label class="form-check-label fw-bold" for="check1">Mobile
                                                                support</label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="check2" name="option2" value="delivery">
                                                            <label class="form-check-label fw-bold"
                                                                for="check2">Delivery
                                                                support</label>
                                                        </div>

                                                        <div class="row mt-3">

                                                            <label for="validationCustom1"
                                                                class="col-xl-1 col-md-1">Comments:</label>
                                                            <div class="col-xl-5 col-md-5">
                                                                <textarea class="form-control" rows="3" id="validationCustom1" type="text" name="comments"></textarea>
                                                            </div>
                                                        </div><br>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="justify-content-end gap-2 mt-4 d-flex" id="vendor-wizard-controls">
                                        <button type="button" class="btn btn-secondary px-4"
                                            id="wizard-prev-btn">Previous</button>
                                        <button type="button" class="btn btn-primary px-4"
                                            id="wizard-next-btn">Next</button>
                                    </div>
                                    <div class="justify-content-end align-items-center gap-2 mt-4 vendor-final-actions d-none" id="final-wizard-controls">
                                        <button type="button" class="btn btn-secondary px-4"
                                            id="wizard-prev-last-btn">Previous</button>
                                        <button class="btn btn-primary px-4" id="create"
                                            type="submit" onclick="wrong_ac_no_alert()">Save</button>
                                        {{-- <button class="btn btn-secondary px-4"
                                            type="button" onclick="window.location.href='{{ url('admin/vendor/list') }}'">Close</button> --}}
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
    <div class="modal-dialog modal-lg">
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
            var defaultLat = 13.0827;
            var defaultLng = 80.2707;

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
@endpush

@push('scripts')
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
                        // Focus the first invalid element
                        $(this).focus();
                        return false;
                    }
                });

                if (!valid) return false;

                // Extra check for password match if in step 1 (Personal Information)
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

                // Extra check for step 2 (Product Category)
                if (currentTab.attr('id') === 'top-product') {
                    const checkedCategories = $('.category-cat:checked').length;
                    if (checkedCategories === 0) {
                        valid = false;
                        alert('Please select at least one Product Category');
                    }
                }

                // Extra check for step 4 (Bank Details)
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
                    // Only allow moving to the next tab if it's the immediate next one AND current tab is valid
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
                // alert(package);
                if (package) {
                    $.ajax({
                        // '{{ url('Ajaxpackage') }}'
                        // url:'/admin/Ajaxpackage',
                        //action: "{{ route('Ajaxpackage') }}",    {{ route('checkZonalnamePost') }}
                        url: "{{ route('Ajaxpackage') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": package
                        },

                        dataType: "json",
                        success: function(data) {
                            // alert(package);
                            if (data.msg == 'Success') {
                                $('#grace_days').val(data.days);
                                $('#price').val(data.price);
                                $('#validity').val(data.validity);
                                $('#wallet').val(data.wallet);
                                $('#commission').val(data.commission);
                                $('#description').text($(data.description).text());
                                // $('#price ').val(data.price);
                                ///$('#price ').val(data.price);
                                const expired_date = new Date();
                                expired_date.setDate(expired_date.getDate() + Number(data
                                    .validity));

                                const next_renewal_date = new Date();
                                next_renewal_date.setDate(next_renewal_date.getDate() + (Number(
                                    data
                                    .validity) + Number(data.days)));
                                $('#expired_date').val(expired_date.toISOString().split('T')[
                                    0]);
                                $('#next_renewal_date').val(next_renewal_date.toISOString()
                                    .split('T')[0]);
                            } else {
                                $('#totalwin').val('');
                                $('#totalloss').val('');

                                //	$('#name').val('');
                                //	$('#id').val('');
                                //	$('#roles').val('');
                                //swal("Warning!", "Shipping Not Available Your Area.", "error");
                            }
                        },
                        error: function(data) {
                            alert("fail");
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
            var confirm_pass = document.getElementById('confirm_pass').value;
            if (pass != confirm_pass) {
                document.getElementById('wrong_pass_alert').style.color = 'red';
                document.getElementById('wrong_pass_alert').innerHTML = '☒ Use same password';
                document.getElementById('create').disabled = true;
                document.getElementById('create').style.opacity = (0.4);
            } else {
                document.getElementById('wrong_pass_alert').style.color = 'green';
                document.getElementById('wrong_pass_alert').innerHTML =
                    '🗹 Password Matched';
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
                        // alert()
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
