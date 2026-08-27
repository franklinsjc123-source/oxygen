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

         <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Category Banners</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Category Banners</li>
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
							 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add Category Banner</button>                                   
                                <div class="btn-popup pull-right">								
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Category Banner</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                             
                                                <div class="modal-body">												
                                                    <form class="" action="{{route('staffcategory-banners.store')}}" method="post" onsubmit="return confirm('Are you sure, you want to Save it?')" enctype="multipart/form-data" >
                                                        @csrf
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="title" class="mb-1"> Title :</label>
                                                                <input class="form-control" type="text" name="title" id="title" required="">
                                                            </div>
															 <div class="form-group">
                                                                <label for="sub_title" class="mb-1">Sub Title :</label>
                                                                <input class="form-control" type="text" name="sub_title" id="sub_title" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mainImage" class="mb-1"> Image (447x230) :</label>
                                                                <input class="form-control" required="" name="mainImage" id="mainImage" type="file" accept="image/*">
                                                            </div>
                                                             <div class="form-group">
                                                                <label for="link" class="mb-1">Link :</label>
                                                                <input class="form-control" id="link" name="link" type="text" required="true">
                                                             </div>
                                                             <div class="form-group">
                                                                <label for="sort" class="mb-1">Sort :</label>
                                                                <input class="form-control" id="sort" name="sort" type="number" required="true">
                                                             </div>                                                            
                                                             <div class="col-md-12">
							                    			<div class="" id="dates">
							                    			<div class="form-group row">
							                    			    <div class="form-group mt-2">
                                                                    <label class="mb-1 fw-bold">Status</label>
                                                                    <select name="status" class="custom-select w-100 form-control" required="">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Deactive</option>
                                                                    </select>
                                                                </div>
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
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Category Banner</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">												
                                                    <form class="" action="{{route('staffcategory-banners.update', 0)}}" method="post" onsubmit="return confirm('Are you sure, you want to Update it?')" enctype="multipart/form-data" >
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form">
                                                            <input class="form-control" id="editid" name="editid" type="hidden" >
                                                            <div class="form-group">
                                                                <label for="edittitle" class="mb-1"> Title :</label>
                                                                <input class="form-control" type="text" name="edittitle" id="edittitle" required="">
                                                            </div>
															 <div class="form-group">
                                                                <label for="editsub_title" class="mb-1">Sub Title :</label>
                                                                <input class="form-control" type="text" name="editsub_title" id="editsub_title" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editmainImage" class="mb-1"> Image (447x230) :</label>
                                                                <input class="form-control"  name="editmainImage" id="editmainImage" type="file" accept="image/*">
                                                                <input class="form-control"  name="editoldImage" id="editoldImage" type="hidden">
                                                            </div>
                                                             <div class="form-group">
                                                                <label for="editlink" class="mb-1">Link :</label>
                                                                <input class="form-control" id="editlink" name="editlink" type="text" required="true">
                                                             </div>
                                                             <div class="form-group">
                                                                <label for="editsort" class="mb-1">Sort :</label>
                                                                <input class="form-control" id="editsort" name="editsort" type="number" required="true">
                                                             </div>                                                            
                                                             <div class="col-md-12">
							                    			<div class="" id="dates">
							                    			<div class="form-group row">
							                    			    <div class="form-group mt-2">
                                                                    <label class="mb-1 fw-bold">Status</label>
                                                                    <select name="editstatus" id="editstatus" class="custom-select w-100 form-control" required="">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Deactive</option>
                                                                    </select>
                                                                </div>
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
                                <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                                    data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">  
                                    <thead>
                                     <tr>
                                       <th data-field="id" data-sortable="true">Id</th> 
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
                                        @foreach ($categoryBanners as $item)
                                        <tr>
                                             <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);}}</td>
                                             <td>
                                                <div class="d-flex">
                                                    <img src="{{asset('assets/images/banners/category-banner') . '/' .$item->image}}" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                </div>
                                            </td>
                                            <td style="width:100%;">{{$item->title}}</td>
                                            <td style="width:100%;">{{$item->sub_title}}</td>
                                            <td style="width:100%;">{{$item->link}}</td>
                                            <td style="width:100%;">{{$item->sort}}</td>
                                            <td>
                                                <label class="switch">
                                                     <input type="checkbox" class="toggle-status" data-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                                     <div class="slider round">
                                                         <span class="on">Active</span>
                                                         <span class="off">Inactive </span>                                                                
                                                     </div>
                                                 </label>
                                            </td>
                                            <td>
                                                <span class="d-flex">
                                                    <button type="button" class="edit_categorybanner btn btn-secondary mx-1" value="{{ $item->id }}">
                                                    <i class="fa fa-pencil"></i></button>
                                                  @if (session()->get('log_type') == 'Admin')
													  <form action="{{ route('staffcategory-banners.destroy', $item->id) }}" method="post">
                                                     @method('DELETE')
                                                     @csrf
                                                     <button type="submit" class="btn btn-warning mx-1"><i class="fa fa-trash"></i></button>
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
            url: "{{ route('staffcategory-banners.changestatus') }}",
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
    $(document).on('click', '.edit_categorybanner', function(e){
        e.preventDefault();
        var ad_id = $(this).val();
        $('#exampleModal1').modal('show');

        var url = "{{route('staffeditcategory-banners', ':ad_id')}}";
        url = url.replace(":ad_id", ad_id);

        $.ajax({
             url:url,       
             type: "get",
             dataType: 'json',
             success: function (response) {
                if(response.status == 404) {
                    Swal.fire('Error!', response.message, 'error');
                } else {
                    $('#editid').val(response.banner.id);
                    $('#edittitle').val(response.banner.title);
                    $('#editsub_title').val(response.banner.sub_title);
                    $('#editoldImage').val(response.banner.image);
                    $('#editlink').val(response.banner.link);
                    $('#editsort').val(response.banner.sort);
                    $('#editstatus').val(response.banner.status);
                }
            }
        });
    });
</script>
@endpush
@endsection
