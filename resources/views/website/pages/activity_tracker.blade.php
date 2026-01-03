{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
<style>
.thumb-image{
	width:100px;
}
</style>
<!-- page-wrapper Start-->

@include('website.pages.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
       <?php include('sidemenu.php')?>    
       @include('website.pages.sidemenu')
       @section('content')
	   <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                            <h3>Activity Tracker
								
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
							
							<li class="breadcrumb-item active">Activity Tracker</li>
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
                                   
                                      <form class="needs-validation user-add">
                                        @csrf
									
										<div class="row mt-4">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Shop Name</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="shopname">
											</div>
										</div>
                                    </div>
                                    <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Owner Name</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="ownername">
											</div>
										</div>
                                    </div>
                                    </div>

                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Business Category</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="businesscategory">
											</div>
										</div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">E.Mail</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom2" type="email" required="" name="email">
											</div>
										</div>
                                    </div>
                                    </div>

                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Mobile Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="moble">
											</div>
										</div>
                                    </div>
                                    <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Alternate Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="alternatemobile">
											</div>
										</div>
                                    </div>
                                    </div>
                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Address I</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="address1">
											</div>
										</div>
                                    </div>
                                    <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Address II</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="address2">
											</div>
										</div>
                                    </div>
                                    </div>
                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">State :</label>
											<div class="col-xl-8 col-md-8">


											<select class="custom-select w-100 form-control" name="state" required="">
																<option value="">--Select--</option>
																
																<option value="2">TamilNadu</option>
																<option value="2">Kerala</option>
																
																
															</select>
											
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">City:</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="city" required="">
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
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Pincode</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="pincode">
											</div>
										</div>
                                    </div>
                                    <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Location Map</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="locationmap">
											</div>
										</div>
                                    </div>
                                    </div>

                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Zone</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" readonly type="text" required="" name="zone">
											</div>
										</div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Area</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom2" readonly type="text" required="" name="route">
											</div>
										</div>
                                    </div>
                                    </div>

                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Enqury Status</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0"  type="text" required="" name="zone">
											</div>
										</div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Next Follow-up Date</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom2"  type="date" required="" name="follow-up-date">
											</div>
										</div>
                                        </div>
                                        </div>
										
									
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Reason</label>
											<div class="col-xl-10 col-md-10">
												<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="address"></textarea>
											</div>
										</div>
										

																
                                            <div class="modal-footer">   <button class="btn btn-lg btn-secondary px-5" type="button">Close</button>
                                                   <button class="btn  px-5 btn-lg btn-primary" type="submit">Save & Reopen</button>
                                                  
                                                </div>
                                    </form>
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
{{-- <?php include('footer.php')?> --}}
<script>$("#fileUpload").on('change', function () {
 
     //Get count of selected files
     var countFiles = $(this)[0].files.length;
 
     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#image-holder");
     image_holder.empty();
 
     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {
 
             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {
 
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumb-image"
							 
							 
							
							 
                     }).appendTo(image_holder);
                 }
 
                 image_holder.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }
 
         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         alert("Pls select only images");
     }
 });
 
 $("#fileUpload1").on('change', function () {
 
     //Get count of selected files
     var countFiles = $(this)[0].files.length;
 
     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder1 = $("#image-holder1");
     image_holder1.empty();
 
     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {
 
             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {
 
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumb-image"
							 
							 
							
							 
                     }).appendTo(image_holder1);
                 }
 
                 image_holder1.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }
 
         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         alert("Pls select only images");
     }
 });
 
 </script>

@endsection