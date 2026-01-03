@extends('layout.auth.master')
@section('contents')
    @include('paritials.auth.header');

    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu');
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.staffauth.sidemenu');
        <!-- Page Sidebar Ends-->

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
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>

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

                    <div class="col-xl-10">
                        <div class="card tab2-card">
                            <div class="card-body" style="font-family: Times New Roman, Times, serif;">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-profile-tab"
                                            data-bs-toggle="tab" href="#top-profile" role="tab"
                                            aria-controls="top-profile" aria-selected="true"><i data-feather="user"
                                                class="me-2"></i><span class="fw-bold">Personal Information</span></a>
                                    </li>

                                    <li class="nav-item"><a class="nav-link" id="upload-top-tab" data-bs-toggle="tab"
                                            href="#top-upload" role="tab" aria-controls="top-upload"
                                            aria-selected="false"><i data-feather="edit" class="me-2"></i><span
                                                class="fw-bold">Documents & Package</span> </a>
                                    </li>


                                    <li class="nav-item"><a class="nav-link" id="top-bank-upload" data-bs-toggle="tab"
                                            href="#top-bank" role="tab" aria-controls="top-upload"
                                            aria-selected="false"><i data-feather="bank" class="me-2"></i><span
                                                class="fa fa-bank "><span class="fw-bold mx-2">Bank
                                                    Details</span></span></a>
                                    </li>

                                    <li class="nav-item"><a class="nav-link" id="upload-setting-tab" data-bs-toggle="tab"
                                            href="#top-setting" role="tab" aria-controls="top-upload"
                                            aria-selected="false"><i data-feather="settings" class="me-2"></i><span
                                                class=" fa fa-solid fa-gear"><span
                                                    class="fw-bold mx-2">Support</span></span></a>
                                    </li>
                                </ul>
                                <form class="" method="post" action="{{ route('staffvendorcreate.update', $vendorcreate->id) }}"
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
                                                                <input class="form-control" readonly
                                                                value="SKAP"
                                                                id="validationCustom0" type="text" name="created_by">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> User
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0" value={{$vendorcreate->username}}
                                                                type="text" name="username">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Password
                                                            </label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0" value={{$vendorcreate->pass}}
                                                                type="text" name="pass">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Confirm
                                                            Password</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0" type="password" value={{$vendorcreate->pass1}}
                                                                name="pass1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Shop
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0" value={{$vendorcreate->shop_name}}
                                                                type="text" name="shop_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Owner
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="" type="text" value={{$vendorcreate->owner_name}}
                                                                name="owner_name">
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
                                                            <input class="form-control" id="business_category" value={{$vendorcreate->business_category}}
                                                                type="text" name="business_category">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2"
                                                            class="col-xl-4 col-md-4">E.Mail</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="email" type="email" value={{$vendorcreate->email}}
                                                                name="email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Mobile
                                                            Number</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="m_number" type="text" value={{$vendorcreate->mobile_number1}}
                                                                name="mobile_number1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Alternate
                                                            Number</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="alter_no" type="text" value={{$vendorcreate->mobile_number2}}
                                                                name="mobile_number2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Address
                                                            I</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0" value={{$vendorcreate->address}}
                                                                type="text" name="address1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Address
                                                            II</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0" value={{$vendorcreate->address1}}
                                                                type="text" name="address2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom01" class="col-xl-4 col-md-4">State
                                                            :</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <select class="custom-select w-100 form-control" 
                                                                name="state">
                                                                <option value="{{$vendorcreate->state}}" selected hidden>{{$vendorcreate->state}}</option>
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
                                                            class="col-xl-4 col-md-4">City:</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <select class="custom-select w-100 form-control" 
                                                                name="city">
                                                                <option value="{{$vendorcreate->city}}" selected hidden>{{$vendorcreate->city}}</option>
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
                                                            Pincode</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="pincode" type="text" value={{$vendorcreate->pincode}}
                                                                name="pincode">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Location
                                                            Map</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0" value={{$vendorcreate->location_map}}
                                                                type="text" name="location_map">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">
                                                            Zone</label>
                                                        <div class="col-xl-8 col-md-8">

                                                            <select class="form-control" name="zone" >

                                                                <option value="{{$vendorcreate->zone}}" selected hidden>{{$vendorcreate->zone}}</option>
                                                                <option >Select Item</option>
                                                              
                                                                 @foreach ($zone as $zo)
                                                                  <option value="{{ $zo->name }}" > {{ $zo->name }} </option>
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
                                                            class="col-xl-4 col-md-4">Area</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="validationCustom2" value={{$vendorcreate->route}}
                                                                type="text" name="route">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> AADHAR
                                                            NUMBER</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0" value={{$vendorcreate->aadhar_no}}
                                                                type="text" name="aadhar_no" id="aadharcard">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2" class="col-xl-4 col-md-4">GST
                                                            NUMBER</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="validationCustom2" value={{$vendorcreate->gst_number}}
                                                                type="text" name="gst_number">
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
                                                        <input type="hiden" id="oldprofile_image" name="oldprofile_image" value={{$vendorcreate->profile_image}}>

                                                    <div id="image-holder"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2"><span>*</span>GST</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file" 
                                                        name="gst" multiple accept="image/*,.pdf"/>
                                                        <input type="hiden" id="oldgst" name="oldgst" value={{$vendorcreate->gst}}>
                                                        
                                                    <div id="image-holder1"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2"><span>*</span>Other Documents</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file" 
                                                        name="other_documents" multiple accept="image/*,.pdf" />
                                                        <input type="hiden" id="oldother_documents" name="oldother_documents" value={{$vendorcreate->other_documents}}>
                                                    <div id="image-holder1"></div>
                                                </div>
                                            </div>
                                            <h5 class="f-w-600">Package Information</h5>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom01" class="col-xl-4 col-md-4">Pack
                                                            :</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            @php
                                                                $pack = App\Models\vendor\packages::where('status', '=', '1')->get();
                                                            @endphp

                                                            <select class="custom-select w-100 form-control"
                                                                name="package" id="package">
                                                                <option value="{{$vendorcreate->package_id}}" selected hidden>
                                                                    {{$vendorcreate->package_id}}
                                                                </option>
                                                                <option value=""  hidden>Select Package
                                                                </option>

                                                                @foreach ($pack as $pack)
                                                                    <option value="{{ $pack->id }}">{{ $pack->name }}
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
                                                            <input id="datePicker" type="date" value={{$vendorcreate->purchase_date}}
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
                                                            <input class="form-control" id="validity" type="text"  value={{$vendorcreate->validity}}
                                                                readonly name="validity">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">++
                                                            Days</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="grace_days" type="text" value={{$vendorcreate->grace_days}}
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
                                                            <input id="expired_date" type="date" class="form-control " value={{$vendorcreate->expired_date}}
                                                                name="expired_date" placeholder="dd/mm/yy" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Next
                                                            Renewal Date</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input id="next_renewal_date" type="date" value={{$vendorcreate->next_renewal_date}}
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
                                                            <input class="form-control" id="wallet" type="text" value={{$vendorcreate->wallet}}
                                                                readonly name="wallet">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0"
                                                            class="col-xl-4 col-md-4">Commission %</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" readonly id="commission" value={{$vendorcreate->commission}}
                                                                type="text" name="commission">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2">Description</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <textarea class="form-control" readonly rows="3" id="description" value={{$vendorcreate->description}}
                                                     type="text" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-lg btn-secondary px-5" type="button">Send
                                                    OTP</button>
                                            </div>

                                            <div class="row pt-2 mt-2 px-4">
                                                <div class="col-md-9">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0"
                                                            class="col-xl-6 col-md-6 text-right"><span
                                                                calss="text-right">Enter OTP (Mobile Number)</span></label>
                                                        <div class="col-xl-6 col-md-6">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" name="graceperiod">
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade show " id="top-bank" role="tabpanel"
                                            aria-labelledby="top-bank-tab">
                                            <div class="row mt-4">
                                                <div class="col-md-12">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"> Account
                                                            Holder Name</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="bank_name" type="text"  value={{$vendorcreate->bank_name}}
                                                                name="bank_name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"> Account
                                                            Number</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no" type="text" value={{$vendorcreate->ac_no}}
                                                                name="ac_no">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"> Confirm
                                                            Account Number</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no1" type="text" value={{$vendorcreate->ac_no1}}
                                                                name="ac_no1">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"> IFSC
                                                            Code </label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ifsc" type="text" value={{$vendorcreate->ifsc}}
                                                                name="ifsc">
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="form-group row">
                                                        <div class="col-xl-3 col-md-3">
                                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/UPI-Logo-vector.svg/1200px-UPI-Logo-vector.svg.png"
                                                                width="100px">
                                                        </div>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="upi" type="text" value={{$vendorcreate->upi}}
                                                                name="upi">
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
                                                                <textarea class="form-control" rows="3" id="validationCustom1" type="text" name="comments">{{$vendorcreate->comments}}</textarea>
                                                            </div>
                                                        </div><br>
                                                        
                                                        <div class="">

                                                            <button class="btn  px-5 btn-lg btn-primary" type="submit">Update</button>
                                                           <a href="{{ url('vendor/list') }}"> 
                                                            <button class="btn btn-lg btn-secondary px-5" type="button" id="close" name="close">Close</button>
                                                        </a>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                       
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
@push('scripts')
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

            $('#package').on('click', function() {
                var package = $(this).val();
                //alert(package);
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
                                $('#description').val(data.description);
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
                        }
                    });
                }
            });

        });


        $(document).ready( function() {
    var now = new Date();
 
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;


   $('#datePicker').val(today);
});
    </script>
@endpush
