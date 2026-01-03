@extends('layout.auth.master')
@section('contents')
    @include('paritials.auth.header')
    @include('paritials.js.offer.offer-create-js')
    @include('paritials.js.time-js')
    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.vendorauth.sidemenu');
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
                                <h3>Offer Create

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>

                                <li class="breadcrumb-item active">Offer Create</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container">
                <div class="col-sm-9">

                    <div class="card">

                        <div class="card-body">


                            <form class="needs-validation" novalidate="">

                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="form-group row">

                                            <div class="col-md-12">
                                                <label class="form-group mb-3"><b>Offer Title</b></label>

                                                <input class="form-control" id="validationCustom1" type="text"
                                                    required="">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="mb-3"><b>Offer Type</b></label>
                                            <div class="col-md-12">
                                                <div class="checkbox-primary">


                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        <input class="radio_animated" onchange="buyxgety();" checked=""
                                                            type="radio" name="type">
                                                        Buy X Get Y Free
                                                    </label>

                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        <input class="radio_animated" onchange="buyxgety();" checked=""
                                                            type="radio" name="type">
                                                        Buy X @ Y
                                                    </label>

                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        <input class="radio_animated" onchange="cashbackoffer();"
                                                            type="radio" name="type">
                                                        Cashback Offer
                                                    </label>
                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        <input class="radio_animated" onchange="freedelivery();"
                                                            type="radio" name="type">
                                                        Free Delivery
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="card" id="buyxgetydiv" >

                        <div class="card-body">
                            <div class="form-group row ">

                                <div class="col-md-4">
                                    <label class="fw-bold">Buy</label>
                                    <input class="form-control" id="validationCustom1" type="text" required="">
                                </div>
                                <div class="col-md-1 text-center mt-3">
                                    <span class="h4 ">+</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold">Get</label>
                                    <input class="form-control" id="validationCustom1" type="text" required="">

                                </div>
                            </div>
                        </div>

                    </div>




                    <div class="card" id="cashbackdiv">

                        <div class="card-body">
                            <div class="col-md-8">
                                <label class="bold"><b>Cashback Value</b></label>
                                <div class="col-md-12">
                                    <div class="checkbox-primary">


                                        <label class="d-block" for="edo-ani12">
                                            <input class="radio_animated" type="radio" checked="" onchange="fixed();"
                                                name="cashback">
                                            Fixed (₹)
                                        </label>
                                        <div id="fixedcashback">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control px-5" type="text" value="">
                                            </div>
                                        </div>
                                        <label class="d-block" for="edo-ani12">
                                            <input class="radio_animated" type="radio" onchange="percentage();"
                                                name="cashback">
                                            Percentage (%)
                                        </label>
                                        <div id="percentagecashback">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" type="text" value="">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card">

                        <div class="card-body">
                            <div class="col-md-8">
                                <label class="bold"><b>Active Dates</b></label>
                                <div class="col-md-12">
                                    <div class="" id="dates">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label class="">Start Date</label>
                                                <input id="example" type="datetime-local" class="form-control"
                                                    placeholder="dd/mm/yy" />
                                            </div>
                                            <!-- <div class="col-md-3">
                                                <label class="">Start Time</label>
                                                <input type="time" value="00:00" class="form-control" />
                                            </div> -->
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label class="">End Date</label>
                                                <input id="example1" type="datetime-local" class="form-control"
                                                    placeholder="dd/mm/yy" />
                                            </div>
                                            <!-- <div class="col-md-3">
                                                <label class="">End Time</label>
                                                <input type="time" value="12:59" class="form-control" />
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="fw-bold">Add Below Sections In Offers As Well </label>
                                <div class="checkbox-primary">
                                    <label class="d-block mb-2" for="">
                                        <input class="radio_animated" checked="" type="radio" name="type">
                                        Fixed Discount
                                    </label>

                                    <label class="d-block mb-2" for="">
                                        <input class="radio_animated" type="radio" name="type">
                                        Percentage
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> -->





                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="validationCustom02" class="mb-1 fw-bold"> Background Image :</label>
                                <input class="form-control" require="" type="file">
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02" class="mb-1 fw-bold"> TEXT ALIGN :</label>
                                <input class="form-control" type="text" value="">
                            </div>

                        </div>

                    </div>

                    <div class="card">

                        <div class="card-body">
                            <div class="form-group">
                                <label class="d-block mb-2 fw-bold" for="">
                                    Value
                                </label>

                                <label class="d-block mb-2 " for="">
                                    Discount Amount
                                </label>
                                <input type="text" class="form-control" name="discount">
                            </div>
                        </div>

                    </div>

                    <div class="card">

                        <div class="card-body">
                            <div class="form-group">
                                <label class="d-block mb-2" for="">
                                    <input class="radio_animated" checked="" type="radio" name="type">
                                    None
                                </label>

                                <label class="d-block mb-2" for="">
                                    <input class="radio_animated" type="radio" name="type">
                                    Minimum Purchase Amount
                                </label>
                                <label class="d-block mb-2" for="">
                                    <input class="radio_animated" type="radio" name="type">
                                    Minimum Quantity Of Items
                                </label>
                            </div>
                        </div>

                    </div>

                </div>







                <div class="form-group row ">
                    <div class="text-center">
                        <div class="col-xl-8 col-md-8">
                            <button class="btn btn-primary  btn-sm pull-right" type="submit">Save</button>

                        </div>
                    </div>
                    </form>


                </div>
            </div>








        </div>
        <!-- Container-fluid Ends-->

    </div>
    </div>

    <!-- footer start-->

    <!-- footer end-->

    </div>

    </div>
@endsection
