@extends('layout.auth.master')
@section('contents')

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
                            <h3>Edit Activity Tracker</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Edit Activity Tracker</li>
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
                        <div class="card-body">
                            <div class="tab-content" id="top-tabContent">
                                <form action="{{ route('activity_trackers.update', $tracker->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="shopname" class="col-xl-4 col-md-4">Shop Name</label>
                                                <div class="col-xl-8 col-md-8">
                                                    <input class="form-control" id="shopname" type="text" required name="shopname" value="{{ old('shopname', $tracker->shop_name) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="ownername" class="col-xl-4 col-md-4">Owner Name</label>
                                                <div class="col-xl-8 col-md-8">
                                                    <input class="form-control" id="ownername" type="text" required name="ownername" value="{{ old('owner_name', $tracker->owner_name) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="businesscategory" class="col-xl-4 col-md-4">Business Category</label>
                                                <div class="col-xl-8 col-md-8">
                                                    <input class="form-control" id="businesscategory" type="text" required name="businesscategory" value="{{ old('business_category', $tracker->business_category) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="email" class="col-xl-4 col-md-4">E-Mail</label>
                                                <div class="col-xl-8 col-md-7">
                                                    <input class="form-control" id="email" type="email" required name="email" value="{{ old('email', $tracker->email) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="moble" class="col-xl-4 col-md-4">Mobile Number</label>
                                                <div class="col-xl-8 col-md-8">
                                                    <input class="form-control" id="moble" type="text" required name="moble" value="{{ old('moble', $tracker->mobile_number) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="alternatemobile" class="col-xl-4 col-md-4">Alternate Number</label>
                                                <div class="col-xl-8 col-md-8">
                                                    <input class="form-control" id="alternatemobile" type="text" required name="alternatemobile" value="{{ old('alternatemobile', $tracker->mobile_number1) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="address1" class="col-xl-4 col-md-4">Address Line 1</label>
                                                <div class="col-xl-8 col-md-8">
                                                    <input class="form-control" id="address1" type="text" required name="address1" value="{{ old('address1', $tracker->address1) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="address2" class="col-xl-4 col-md-4">Address Line 2</label>
                                                <div class="col-xl-8 col-md-8">
                                                    <input class="form-control" id="address2" type="text" required name="address2" value="{{ old('address2', $tracker->address2) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- More fields follow, similar to above -->

                                    <div class="form-group row">
                                        <label for="reason" class="col-xl-2 col-md-2">Reason</label>
                                        <div class="col-xl-10 col-md-10">
                                            <textarea class="form-control" rows="3" id="reason" type="text" required name="reason">{{ old('reason', $tracker->reason) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-lg btn-secondary px-5" type="button">Close</button>
                                        <button class="btn px-5 btn-lg btn-primary" type="submit">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </div>
</div>

@endsection
