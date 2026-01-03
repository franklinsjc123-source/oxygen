@extends('layout.auth.master')
@section('contents')    
    @include('paritials.auth.header');

    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu');
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.auth.sidemenu');
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
                                <h3>Vendor Creation

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>

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
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                        aria-labelledby="top-profile-tab">


                                        <form id="form">

                                            <div class="row mt-4">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Created
                                                            By</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" readonly
                                                                value="{{ session()->get('username') }}"
                                                                id="validationCustom0" type="text" required=""
                                                                name="createdby">
                                                            <input type="hidden" name="createdBy"
                                                                value="{{ session()->get('userId') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> User
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="username">
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
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="shopname">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4"> Owner
                                                            Name</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="ownername">
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
                                                            <input class="form-control" id="businesscategory"
                                                                type="text" required="" name="businesscategory">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2"
                                                            class="col-xl-4 col-md-4">E.Mail</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="email" type="email"
                                                                required="" name="email">
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
                                                            <input class="form-control" id="m_number" type="text"
                                                                required="" name="moble">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Alternate
                                                            Number</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="alter_no" type="text"
                                                                required="" name="alternatemobile">
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
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="address1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Address
                                                            II</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="address2">
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
                                                                name="state" required="">
                                                                <option value="">--Select--</option>

                                                                <option value="2">TamilNadu</option>
                                                                <option value="2">Kerala</option>


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
                                                                name="city" required="">
                                                                <option value="">--Select--</option>

                                                                <option value="2">Chennai</option>
                                                                <option value="2">Trichy</option>


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
                                                            <input class="form-control" id="pincode" type="text"
                                                                required="" name="pincode">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Location
                                                            Map</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="locationmap">
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
                                                            <input class="form-control" id="validationCustom0" readonly
                                                                type="text" required="" name="zone">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2"
                                                            class="col-xl-4 col-md-4">Area</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="validationCustom2" readonly
                                                                type="text" required="" name="route">
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
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="aadharcard"
                                                                id="aadharcard">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom2" class="col-xl-4 col-md-4">GST
                                                            NUMBER</label>
                                                        <div class="col-xl-8 col-md-7">
                                                            <input class="form-control" id="validationCustom2"
                                                                type="text" required="" name="pancard">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                            <input type="hidden" name="zonalId" value="-1" />
                                            <div class="modal-footer"> <button class="btn btn-lg btn-secondary px-5"
                                                    type="button">Close</button>
                                                <button class="btn  px-5 btn-lg btn-primary" type="submit"
                                                    id="btnSave">Save</button>

                                            </div>
                                        </form>
                                    </div>



                                    <div class="tab-pane fade" id="top-upload" role="tabpanel"
                                        aria-labelledby="top-upload-tab">


                                        <form class="needs-validation user-add" novalidate="">



                                            <div class="form-group mt-4 row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2"><span>*</span>Profile Image</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload" type="file"
                                                        required="" name="profileimage" multiple />
                                                    <div id="image-holder"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2"><span>*</span>GST</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file"
                                                        required="" name="gst" multiple />
                                                    <div id="image-holder1"></div>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2"><span>*</span>Other Documents</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file"
                                                        required="" name="otherdoument" multiple />
                                                    <div id="image-holder1"></div>
                                                </div>
                                            </div>
                                        </form>


                                        <h5 class="f-w-600">Package Information</h5>
                                        <form class="needs-validation user-add" novalidate="">


                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom01" class="col-xl-4 col-md-4">Pack
                                                            :</label>
                                                        <div class="col-xl-8 col-md-8">


                                                            <select class="custom-select w-100 form-control"
                                                                name="state" required="">


                                                                <option value="2">Trail Pack</option>
                                                                <option value="2">Gold </option>


                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Purchase
                                                            Date</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input id="example1" type="text" class="form-control "
                                                                name="purchasedate" placeholder="dd/mm/yy" />

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
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="validaity">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">++
                                                            Days</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="graceperiod">
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
                                                            <input id="example2" type="text" class="form-control "
                                                                name="expiry_date" placeholder="dd/mm/yy" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">Next
                                                            Renewal Date</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input id="example3" type="text" class="form-control "
                                                                name="renewal_date" placeholder="dd/mm/yy" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-4 col-md-4">ADD
                                                            Wallets</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="validaity">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0"
                                                            class="col-xl-4 col-md-4">Commission %</label>
                                                        <div class="col-xl-8 col-md-8">
                                                            <input class="form-control" id="validationCustom0"
                                                                type="text" required="" name="validaity">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="validationCustom1"
                                                    class="col-xl-2 col-md-2">Description</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="address"></textarea>
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
                                                                type="text" required="" name="graceperiod">
                                                        </div>
                                                    </div>
                                                    <br>

                                                </div>

                                                <div class="col-md-3">




                                                    <div class="form-group row pull-right">

                                                        <button class="btn  px-5 btn-lg btn-primary"
                                                            type="submit">Save</button>

                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>

                                    <div class="tab-pane fade show " id="top-bank" role="tabpanel"
                                        aria-labelledby="top-bank-tab">

                                        <form>
                                            <div class="row mt-4">
                                                <div class="col-md-12">

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"> Account
                                                            Holder Name</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="bank_name" type="text"
                                                                required="" name="bank_name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"> Account
                                                            Number</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no" type="text"
                                                                required="" name="ac_no">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"> Confirm
                                                            Account Number</label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ac_no1" type="text"
                                                                required="" name="ac_no1">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom0" class="col-xl-3 col-md-3"> IFSC
                                                            Code </label>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ifsc" type="text"
                                                                required="" name="ifsc">
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="form-group row">
                                                        <div class="col-xl-3 col-md-3">
                                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/UPI-Logo-vector.svg/1200px-UPI-Logo-vector.svg.png"
                                                                width="100px">
                                                        </div>
                                                        <div class="col-xl-9 col-md-9">
                                                            <input class="form-control" id="ifsc" type="text"
                                                                required="" name="ifsc">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-end">
                                                <button class="btn  px-5 btn-lg btn-primary " type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade show " id="top-setting" role="tabpanel"
                                        aria-labelledby="top-setting-tab">

                                        <div class="container ">
                                            <div class=" mt-5">
                                                <div class="row">
                                                    <div class="col-md-3">

                                                        <input type="checkbox" class="form-check-input" id="check1"
                                                            name="option1" value="something">
                                                        <label class="form-check-label fw-bold" for="check1">mobile
                                                            support</label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <input type="checkbox" class="form-check-input" id="check2"
                                                            name="option2" value="something">
                                                        <label class="form-check-label fw-bold" for="check2">Delivery
                                                            support</label>
                                                    </div>

                                                    <div class="row mt-3">

                                                        <label for="validationCustom1"
                                                            class="col-xl-1 col-md-1">Comments:</label>
                                                        <div class="col-xl-5 col-md-5">
                                                            <textarea class="form-control" rows="3" id="validationCustom1" type="text" required=""
                                                                name="comments"></textarea>
                                                        </div>

                                                    </div>


                                                </div>



                                                <div class="col-md-3 mt-3">
                                                    <button type="submit" onclick="save()"
                                                        class="btn btn-primary mt-3">Submit</button>
                                                    <div>


                                                    </div>
                                                </div>

                                            </div>





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
@endpush
