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
                        <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Adv Banner</li>
                        </ol>
                    </div>
                </div>
            </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
            @endif
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">                           
                            <div class="card-body">
@if(isset($sellerRequests) && $sellerRequests->isNotEmpty())
							 <div class="alert alert-primary d-flex align-items-center justify-content-between p-3 mb-3 rounded-3" style="border: 1px solid #bfdbfe; background: #eff6ff;">
							    <div class="d-flex align-items-center gap-2">
							        <i class="fa fa-bullhorn text-primary fa-lg"></i>
							        <div>
							            <strong class="text-dark">{{ $sellerRequests->count() }} Seller Adv Banner Submission(s)</strong>
							            <div class="small text-muted">Sellers have submitted and paid for Home Page Adv Banner placements.</div>
							        </div>
							    </div>
							    <a href="{{ route('oxygen.index') }}" class="btn btn-sm btn-primary text-white fw-bold px-3 py-2 rounded-2" style="white-space: nowrap;">
							        <i class="fa fa-external-link me-1"></i> Review & Publish ({{ $sellerRequests->where('approval_status', 'Pending')->count() }} Pending)
							    </a>
							 </div>
@endif
							 <div id="toolbar" class="d-flex align-items-center">
								<button type="button" class="btn btn-success btn-export-excel me-2" style="background-color: #28a745; border-color: #28a745; color: #fff;"><i class="fa fa-file-excel-o me-1"></i> Export Excel</button>
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add Banner</button>
							 </div>                                   
                                <div class="btn-popup pull-right">								
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Adv Banner</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                             
                                                <div class="modal-body">												
                                                    <form class="" id="addAdvBannerForm" action="{{route('advbanner.store')}}" method="post" enctype="multipart/form-data" >
                                                        @csrf
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1"> Title :</label>
                                                                <input class="form-control" type="text" name="title" id="title" placeholder="e.g. Summer Season's Sale">
                                                            </div>
															 <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Sub Title :</label>
                                                                <input class="form-control" type="text" name="sub_title" id="sub_title" placeholder="e.g. For Men's Sneakers">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1"> Image (1300x200 or 1920x300 HD) <span class="text-danger">*</span> :</label>
                                                                <input class="form-control" required name="mainImage" id="mainImage" type="file" accept="image/*">
                                                                <div class="invalid-feedback d-none" id="advMainImageError">Please select a banner image.</div>
                                                            </div>
                                                             <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Link <span class="text-danger">*</span> :</label>
                                                                <input class="form-control" id="link" name="link" type="text" placeholder="e.g. https://example.com/shop or /shops/slug" required>
                                                                <div class="invalid-feedback d-none" id="advLinkError">Please provide a valid destination link URL.</div>
                                                            </div>
                                                             <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Sort :</label>
                                                                <input class="form-control" id="sort" name="sort" type="number" value="1">
                                                            </div>                                                            
                                                            <div class="col-md-12">
							                    			<div class="" id="dates">
							                    			<div class="form-group row">
							                    			    <div class="form-group mt-2">
                                                                    <label for="validationCustom01" class="mb-1 fw-bold">Status</label>
                                                                    <select name="status" class="custom-select w-100 form-control">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Deactive</option>
                                    
                                                                    </select>
                                    
                                                                </div>
							                    				<!--<div class="col-md-6">-->
							                    				<!--<label class="">Start Date / Time</label>-->
							                    				<!--	 <input id="example" type="date" value="" name="start_date" id="start_date" class="form-control" placeholder="dd/mm/yy"  />-->
							                    				<!--	 </div>-->
							                    					 
							                    				<!--</div>-->
							                    		  <!--  <div class="form-group row">-->
							                    				<!--<div class="col-md-6">-->
							                    				<!--<label class="">End Date / Time</label>-->
							                    				<!--	 <input id="example1" type="date" class="form-control" name="end_date" id="end_date" placeholder="dd/mm/yy"  />-->
							                    				<!--	 </div>-->
							                    					 
							                    		  <!--  </div>											-->
							                    			</div>												
							                    		    </div>
                                                        </div>                                                   
                                                    												
                                                        <div class="modal-footer">
                                                           <button class="btn btn-primary" type="submit">Save</button>
                                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                        </div>												
												    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								  </div>

                                {{-- Edit Popup --}}

                                <div class="btn-popup pull-right">								
                                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Banner</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">												
                                                    <form class="" action="{{route('advbanner.update', 0)}}" method="post" enctype="multipart/form-data" >
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form">
                                                            <input class="form-control" id="editid" name="editid" type="hidden" >
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1"> Title :</label>
                                                                
                                                                <input class="form-control" type="text" name="edittitle" id="edittitle">
                                                            </div>
															 <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Sub Title :</label>
                                                                
                                                                <input class="form-control" type="text" name="editsub_title" id="editsub_title">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1"> Image (1300x200 or 1920x300 HD) :</label>
                                                                <input class="form-control"  name="editmainImage" id="editmainImage" type="file" accept="image/*">
                                                                <input class="form-control"  name="editoldImage" id="editoldImage" type="hidden" accept="image/*">
                                                            </div>
                                                             <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Link <span class="text-danger">*</span> :</label>
                                                                <input class="form-control" id="editlink" name="editlink" type="text" placeholder="e.g. https://example.com/shop or /shops/slug" required>
                                                                <div class="invalid-feedback d-none" id="editAdvLinkError">Please provide a valid destination link URL.</div>
                                                            </div>
                                                             <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Sort :</label>
                                                                <input class="form-control" id="editsort" name="editsort" type="number">
                                                            </div>                                                            
                                                            <div class="col-md-12">
							                    			<div class="" id="dates">
							                    			<div class="form-group row">
							                    			    <div class="form-group mt-2">
                                                                    <label for="validationCustom01" class="mb-1 fw-bold">Status</label>
                                                                    <select name="editstatus" class="custom-select w-100 form-control">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Deactive</option>
                                    
                                                                    </select>
                                    
                                                                </div>
							                    				<!--<div class="col-md-6">-->
							                    				<!--<label class="">Start Date / Time</label>-->
							                    				<!--	 <input id="editstart_date" type="date" value="" name="editstart_date" id="editstart_date" class="form-control" placeholder="dd/mm/yy"  />-->
							                    				<!--	 </div>-->
							                    					
							                    				<!--</div>-->
							                    		  <!--  <div class="form-group row">-->
							                    				<!--<div class="col-md-6">-->
							                    				<!--<label class="">End Date / Time</label>-->
							                    				<!--	 <input id="editend_date" type="date" class="form-control" name="editend_date" id="editend_date" placeholder="dd/mm/yy"  />							                    					 </div>-->
							                    					
							                    		  <!--  </div>											-->
							                    			</div>												
							                    		    </div>
                                                        </div>                                                   
                                                    												
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit" id="edit_save">Save</button>
                                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                        </div>												
												    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
 </div>

                                





							<div class="datatable-dashv1-list custom-datatable-overright">                            
                                <table class="table" id="table"  data-click-to-select="true"  data-sort-name="title" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="100" data-search="true"  data-show-refresh="false" data-key-events="true"  data-resizable="true" data-cookie="true"
                                    data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">  
                                    <thead>
                                     <tr>
                                       <th data-field="image" data-sortable="true" >Image</th>
                                       <th data-field="title" data-sortable="true">Title</th>
                                       <th data-field="subtitle" data-sortable="true">Sub Title</th>
                                       <th data-field="link" data-sortable="true">Link</th>
                                       <th data-field="sort" data-sortable="true">Sort</th>
                                       
                                       <th data-field="status" data-sortable="true">Status</th>
									   <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($adbanner as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <img src="{{asset('assets/images/banners/adv-baner') . '/' .$item->image}}" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                </div>
                                            </td>
                                            <td style="width:100%;">
                                             {{$item->title}}
                                            </td>
                                            <td style="width:100%;">
                                                {{$item->sub_title}}
                                            </td>
                                            <td style="width:100%;">
                                                {{$item->link}}
                                            </td>
                                            <td style="width:100%;">
                                                {{$item->sort}}
                                            </td>
                                           
                                            <td>
                                                <label class="switch">
                                                    {{-- $status = $pin->status --}}
                                                    
                                                     <input type="checkbox" class="toggle-status" data-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                                     <div class="slider round">
                                                         <!--ADDED HTML -->
                                                         <span class="on">Active</span>
                                                         <span class="off">Inactive </span>                                                                
                                                         <!--END-->
                                                     </div>
                                                 </label>

                                            </td>
                                            <td>
                                                <span class="d-flex">
                                                    <button type="button" class="edit_advbaner btn btn-secondary mx-1" value="{{ $item->id }}">
                                                    <i class="fa fa-pencil"></i></button>
                                                     {{-- <a href="#" class="btn btn-secondary mx-1"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal1"data-original-title="Edit"><i class="fa fa-pencil"></i> </a> --}}
                                                  @if (session()->get('log_type') == 'Admin')
													  <form
                                                     action="{{ route('advbanner.destroy', $item->id) }}"
                                                     method="post">
                                                     @method('DELETE')
                                                     @csrf
                                                     <button type="submit" class="btn btn-warning mx-1"><i
                                                         class="fa fa-trash"></i>
                                                     </button>
                                                 </form> 
												 @endif
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
.swal2-popup {
    font-size: 1.6rem !important;
}
</style>
<script>
$(document).ready(function() {
    // Status Toggle
    $(document).on('change', '.toggle-status', function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var id = $(this).data('id');
        var checkbox = $(this);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('advbanner.changestatus') }}",
            data: {'status': status, 'id': id, '_token': '{{ csrf_token() }}'},
            success: function(data) {
                // Instantly changed
            },
            error: function() {
                checkbox.prop('checked', !status);
                Swal.fire('Error!', 'Something went wrong.', 'error');
            }
        });
    });

    // Delete Confirmation
    $(document).on('submit', 'form', function(e) {
        if($(this).find('input[name="_method"][value="DELETE"]').length > 0) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this banner! This cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
</script>
<script>
    $(document).on('click', '.edit_advbaner', function(e){

        e.preventDefault();

        //alert('cate_id');
        var ad_id = $(this).val();
        $('#exampleModal1').modal('show');

        var url = "{{route('editadvbanner', ":ad_id")}}";
        url = url.replace(":ad_id", ad_id);

            $.ajax({
            
             url:url,       
             type: "get",
             _token: "csrf",
             dataType: 'json',
             success: function (response) {
                  console.log(response);
                //alert(response);
               if(response.status == 404)
               {
               //  alert('test');
               $('successmessage').html('');
               $('successmessage').addClass('alert alert-danger');
               $('successmessage').text(response.message);
               }

                else{
                   // alert(response);

                $('#editid').val(response.adbanner.id);
                $('#edittitle').val(response.adbanner.title);
                $('#editsub_title').val(response.adbanner.sub_title);
                $('#editoldImage').val(response.adbanner.image);
                $('#editlink').val(response.adbanner.link);
                $('#editsort').val(response.adbanner.sort);
                $('#editstart_date').val(response.adbanner.start_date);
                $('#editend_date').val(response.adbanner.end_date);

                }
            }

            //alert('dfhdgfjftg');
            // error: function (response){

            // }

        });
        
    });

    
// $(document).on('click','.edit_adthfhfgvbaner', function(e){
      
//       e.preventDefault();
//       var cate_id = $(this).val();
//     //  alert(cate_id);
//       //    console.log(pin_id);
//       $('#exampleModal1').modal('show');
//       var url ="{{route('editadvbanner', ":cate_id")}}";
//           url = url.replace(":cate_id", cate_id);
//       $.ajax({
       
//             url:url,       
//             type: "get",
//             dataType: 'json',
//             success: function (response) {
//                  console.log(response);
//                //alert(response);
//                   if(response.status == 404)
//                   {
//                   //  alert('test');
//                   $('successmessage').html('');
//                   $('successmessage').addClass('alert alert-danger');
//                   $('successmessage').text(response.message);
//                   }
//                   else{
//                     alert('gfjgf');
//                       $('#editmain_category_name').val(response.category_main.category_main_name);
//                     //alert(response.category_main.category_main_name);
//                     $('#cate_id').val(cate_id);
//                       var sts = response.category_main.status;
//                        //alert(sts);
//                       if(sts == 49)
//                       {
//                           $('#editstatus').val(1);
  
//                       }
//                       else{
//                           $('#editstatus').val(0);
//                       }
//                       $('#editmain_category_image').val();		
//                        $('#oldeditmain_category_image').val(response.category_main.category_main_image);
                     
                    
//                       // alert(response.category_main.category_main_image);
//                   }
       
                  
           
//               }
          
//         });
  
//       });
</script>
<script>
    // Frontend validation for Add Banner form
    $('#addAdvBannerForm').on('submit', function(e) {
        let valid = true;
        const linkInput = $('#link');
        const imgInput = $('#mainImage');
        const linkVal = linkInput.val() ? linkInput.val().trim() : '';

        // Validate Link
        if (!linkVal) {
            valid = false;
            linkInput.addClass('is-invalid');
            $('#advLinkError').removeClass('d-none').addClass('d-block');
        } else {
            linkInput.removeClass('is-invalid');
            $('#advLinkError').addClass('d-none').removeClass('d-block');
        }

        // Validate Image
        if (!imgInput[0].files || !imgInput[0].files.length) {
            valid = false;
            imgInput.addClass('is-invalid');
            $('#advMainImageError').removeClass('d-none').addClass('d-block');
        } else {
            imgInput.removeClass('is-invalid');
            $('#advMainImageError').addClass('d-none').removeClass('d-block');
        }

        if (!valid) {
            e.preventDefault();
            e.stopPropagation();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Required Information Missing',
                    text: 'Please provide both the Banner Image and Link URL before saving.',
                    confirmButtonColor: '#183543'
                });
            } else {
                alert('Please provide both the Banner Image and Link URL.');
            }
            return false;
        }
    });

    // Real-time input clearing
    $('#link').on('input', function() {
        if ($(this).val().trim()) {
            $(this).removeClass('is-invalid');
            $('#advLinkError').addClass('d-none').removeClass('d-block');
        }
    });

    $('#mainImage').on('change', function() {
        if (this.files && this.files.length) {
            $(this).removeClass('is-invalid');
            $('#advMainImageError').addClass('d-none').removeClass('d-block');
        }
    });

    // Frontend validation for Edit Banner form
    $('#exampleModal1 form').on('submit', function(e) {
        const linkInput = $('#editlink');
        const linkVal = linkInput.val() ? linkInput.val().trim() : '';

        if (!linkVal) {
            e.preventDefault();
            e.stopPropagation();
            linkInput.addClass('is-invalid');
            $('#editAdvLinkError').removeClass('d-none').addClass('d-block');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Link URL Required',
                    text: 'Please enter a target Link URL.',
                    confirmButtonColor: '#183543'
                });
            } else {
                alert('Please enter a target Link URL.');
            }
            return false;
        } else {
            linkInput.removeClass('is-invalid');
            $('#editAdvLinkError').addClass('d-none').removeClass('d-block');
        }
    });

    $('#editlink').on('input', function() {
        if ($(this).val().trim()) {
            $(this).removeClass('is-invalid');
            $('#editAdvLinkError').addClass('d-none').removeClass('d-block');
        }
    });
</script>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
    <script>
        // CKEDITOR.replace('title');
        // CKEDITOR.replace('sub_title');
        // CKEDITOR.replace('edittitle');
        // CKEDITOR.replace('editsub_title');
        
    </script>

@endpush
@endsection
