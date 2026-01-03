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
       
       @include('website.pages.topmenu')
       @section('content')
       	   <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                            <h3>User Creation 
								
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
							
							<li class="breadcrumb-item active">User Creation </li>
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
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><i data-feather="user" class="me-2"></i>Personal Information</a>
                                    </li>
                                  
									<li class="nav-item"><a class="nav-link" id="upload-top-tab" data-bs-toggle="tab" href="#top-upload" role="tab" aria-controls="top-upload" aria-selected="false"><i data-feather="settings" class="me-2"></i>Documents & Other Information</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab">
                                      
                                        <div class="tab-pane fade active show" id="account" role="tabpanel" aria-labelledby="account-tab">
									<form class="needs-validation user-add" novalidate="">
                                        @csrf
										<div class="row mt-4">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Employee Id</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                    </div>
                                    <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> User Name</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                    </div>
                                    </div>

                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Fullname</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Date Of Birth</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="example" type="date" required="" name="dob">
											</div>
										</div>
                                        </div>
                                        </div>

										
											
									

										<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">Department :</label>
											<div class="col-xl-8 col-md-8">


											<select class="custom-select w-100 form-control" required="">
																<option value="">--Select--</option>
																
																<option value="2">Manager</option>
																<option value="2">Sales Executive</option>
																
																
															</select>
											
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">Desgination:</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" required="">
																<option value="">--Select--</option>
																
																<option value="2">Manager</option>
																<option value="2">Sales Executive</option>
																
																
															</select>
											</div>
										</div>
                                    </div>
                                    </div>

                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Mobile Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Alternate Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">E.Mail</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="email" required="" name="firstname">
											</div>
										</div>
                                        </div>
                                        </div>
                                        <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Qualification</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="qualification">
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Experience</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="experience">
											</div>
										</div>
                                    </div>
                                    </div>

                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Blood Group</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Date of Joining</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="example" type="date" required="" name="dob">
											</div>
										</div>
                                        </div>
                                        </div>
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Permanent Address</label>
											<div class="col-xl-10 col-md-10">
												<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="address"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Current Address</label>
											<div class="col-xl-10 col-md-10">
												<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="address"></textarea>
											</div>
										</div>

										<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom3" class="col-xl-4 col-md-4"><span>*</span> Password</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom3" type="password" required=""name="password">
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group row">
											<label for="validationCustom4" class="col-xl-4 col-md-4"><span>*</span> Confirm Password</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom4" type="password" required="" name="confirm_password">
											</div>
										</div>
                                        </div>
                                        </div>
										
<div class="modal-footer">   <button class="btn btn-lg btn-secondary px-5" type="button">Close</button>
                                                   <button class="btn  px-5 btn-lg btn-primary" type="submit">Save</button>
                                                  
                                                </div>
                                    </form>
									</div>
                                    
                                    </div>
                                    
									<div class="tab-pane fade" id="top-upload" role="tabpanel" aria-labelledby="top-upload-tab">
									
                                        <h5 class="f-w-600">Upload</h5>
                                        <form class="needs-validation user-add" novalidate="">
                                            @csrf
										<div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-2 col-md-2">Profile Image</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file"  name="image1" multiple />
													<div id="image-holder1"></div>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-2 col-md-2"><span>*</span>Aadhar Card</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload" type="file"  name="image" multiple />
													<div id="image-holder"></div>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-2 col-md-2"><span>*</span>Pan Card</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file"  name="image1" multiple />
													<div id="image-holder1"></div>
                                                </div>
                                            </div>
											
                                           
                                            <div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-2 col-md-2">Other Documents</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="fileUpload1" type="file"  name="image1" multiple />
													<div id="image-holder1"></div>
                                                </div>
                                            </div>
                                            </form>


                                            <h5 class="f-w-600">Other Information</h5>
                                        <form class="needs-validation user-add" novalidate="">
                                            @csrf
                                         <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Monthly Salary</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">CTC</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                    </div>
                                    </div>
                                    <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Daily Target</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Monthly Target</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
											</div>
										</div>
                                        </div>
                                        </div>
                                        <div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">Zone:</label>
											<div class="col-xl-8 col-md-8">


											<select class="custom-select w-100 form-control" required="">
																<option value="">--Select--</option>
																
																
																
															</select>
											
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">Route:</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" required="">
																<option value="">--Select--</option>
																
															
																
															</select>
											</div>
										</div>
                                        </div>
                                        </div>

				
<div class="modal-footer">   <button class="btn btn-lg btn-secondary px-5" type="button">Close</button>
                                                   <button class="btn  px-5 btn-lg btn-primary" type="submit">Save</button>
                                                  
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

<script>

const myDatePicker = MCDatepicker.create({ 
      el: '#example' 
	  
})
	const myDatePicker1 = MCDatepicker.create({ 
      
	  el:'#example1'
})
	
</script>
@endsection