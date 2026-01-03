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
          
       @include('website.pages.sidemenu')
       @section('content')
	   <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Profile
                                    <small>oxegen Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
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
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-details text-center">
                                    <img src="../assets/images/dashboard/logo/fav.png" alt="" class="img-fluid img-90 rounded-circle blur-up lazyloaded">
                                    <h5 class="f-w-600 mb-0">rameshrajan</h5>
                                    <span>rameshrajan@gmail.com</span>
                                    <div class="social">
                                        <div class="form-group btn-showcase">
                                            <button class="btn social-btn btn-fb d-inline-block"> <i class="fa fa-facebook"></i></button>
                                            <button class="btn social-btn btn-twitter d-inline-block"><i class="fa fa-google"></i></button>
                                            <button class="btn social-btn btn-google d-inline-block me-0"><i class="fa fa-twitter"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="project-status d-none">
                                    <h5 class="f-w-600">Employee Status</h5>
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Performance<span class="pull-right">80%</span></h6>
                                            <div class="progress sm-progress-bar">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Overtime <span class="pull-right">60%</span></h6>
                                            <div class="progress sm-progress-bar">
                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Leaves taken<span class="pull-right">70%</span></h6>
                                            <div class="progress sm-progress-bar">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
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
                                    <li class="nav-item"><a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><i data-feather="user" class="me-2"></i>Profile</a>
                                    </li>
                                  
									<li class="nav-item"><a class="nav-link" id="upload-top-tab" data-bs-toggle="tab" href="#top-upload" role="tab" aria-controls="top-upload" aria-selected="false"><i data-feather="settings" class="me-2"></i>Upload</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab">
                                        <h5 class="f-w-600">Profile</h5>
                                        <div class="table-responsive profile-table">
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <td>First Name:</td>
                                                    <td>rameshrajan</td>
                                                </tr>
                                                <tr>
                                                    <td>Vendor / Admin</td>
                                                    <td>SKAP GARMENTS</td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td>rajan@gmail.com</td>
                                                </tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td>Male</td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile Number:</td>
                                                    <td>9876543210</td>
                                                </tr>
                                               
                                                <tr>
                                                    <td>Location:</td>
                                                    <td>chennai</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                        <div class="account-setting">
                                            <h5 class="f-w-600">Notifications</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="d-block" for="chk-ani">
                                                        <input class="checkbox_animated" id="chk-ani" type="checkbox">
                                                        Allow Desktop Notifications
                                                    </label>
                                                    <label class="d-block" for="chk-ani1">
                                                        <input class="checkbox_animated" id="chk-ani1" type="checkbox">
                                                        Enable Notifications
                                                    </label>
                                                    <label class="d-block" for="chk-ani2">
                                                        <input class="checkbox_animated" id="chk-ani2" type="checkbox">
                                                        Get notification for my own activity
                                                    </label>
                                                    <label class="d-block mb-0" for="chk-ani3">
                                                        <input class="checkbox_animated" id="chk-ani3" type="checkbox" checked="">
                                                        DND
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="account-setting deactivate-account">
                                            <h5 class="f-w-600">Deactivate Account</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="d-block" for="edo-ani">
                                                        <input class="radio_animated" id="edo-ani" type="radio" name="rdo-ani" checked="">
                                                        I have a privacy concern
                                                    </label>
                                                    <label class="d-block" for="edo-ani1">
                                                        <input class="radio_animated" id="edo-ani1" type="radio" name="rdo-ani">
                                                        This is temporary
                                                    </label>
                                                    <label class="d-block mb-0" for="edo-ani2">
                                                        <input class="radio_animated" id="edo-ani2" type="radio" name="rdo-ani" checked="">
                                                        Other
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary">Deactivate Account</button>
                                        </div>
                                        <div class="account-setting deactivate-account">
                                            <h5 class="f-w-600">Delete Account</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="d-block" for="edo-ani3">
                                                        <input class="radio_animated" id="edo-ani3" type="radio" name="rdo-ani1" checked="">
                                                        No longer usable
                                                    </label>
                                                    <label class="d-block" for="edo-ani4">
                                                        <input class="radio_animated" id="edo-ani4" type="radio" name="rdo-ani1">
                                                        Want to switch on other account
                                                    </label>
                                                    <label class="d-block mb-0" for="edo-ani5">
                                                        <input class="radio_animated" id="edo-ani5" type="radio" name="rdo-ani1" checked="">
                                                        Other
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary">Delete Account</button>
                                        </div>
                                    </div>
									<div class="tab-pane fade" id="top-upload" role="tabpanel" aria-labelledby="top-upload-tab">
									
                                        <h5 class="f-w-600">Upload</h5>
                                        <form class="needs-validation user-add" novalidate="">
                                            @csrf
                                           	<div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>Aadhar Image</label>
                                                <div class="col-xl-8 col-md-7">
                                                    <input class="form-control" id="fileUpload" type="file" required="" name="image" multiple />
													<div id="image-holder"></div>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>Pan Card Image</label>
                                                <div class="col-xl-8 col-md-7">
                                                    <input class="form-control" id="fileUpload1" type="file" required="" name="image1" multiple />
													<div id="image-holder1"></div>
                                                </div>
                                            </div>
											
                                            

                                        
                                    </div>
                                    
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
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