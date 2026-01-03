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
    
         <div class="page-body fcolor">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                            <h3>Staff Role Creation 
								
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
							
							<li class="breadcrumb-item active">Staff Role  </li>
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
                               	{{-- @if($errors)
											@foreach ( $errors->all() as $errors)
											<li style=" color:red">
												{{$errors}}
											</li>
												
											@endforeach
											@endif --}}
											
									<form method="POST" action="{{ isset($role) ? route('staffrole.update', $role->id) : route('staffrole.store') }}">
    @csrf
    @isset($role)
        @method('PUT')
    @endisset
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label for="department" class="col-xl-4 col-md-4">Department:</label>
                <div class="col-xl-8 col-md-8">
                    <select class="custom-select w-100 form-control" id="department" name="department" required>
                        <option value="">--Select--</option>
                        @foreach ($departments as $item)
                            <option value="{{ $item->id }}" {{ (isset($role) && $role->department == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group row">
                <label for="designation" class="col-xl-4 col-md-4">Designation:</label>
                <div class="col-xl-8 col-md-8">
                    <select class="custom-select w-100 form-control" id="designation" name="designation" required>
                        <option value="">--Select--</option>
                        @foreach ($designations as $item)
                            <option value="{{ $item->id }}" {{ (isset($role) && $role->designation == $item->id) ? 'selected' : '' }}>{{ $item->designation }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label for="mainmenus" class="col-xl-2 col-md-2">Main & Sub Menus:</label>
                <div class="col-xl-10 col-md-10">
                    <div class="checkbox-group">
					
                        @foreach ($mainmenus as $mainmenu)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="mainmenu{{ $mainmenu->id }}" name="mainmenus[]" value="{{ $mainmenu->id }}" 
                                    {{ (isset($role) && in_array($mainmenu->id, explode(',', $role->mainmenus))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="mainmenu{{ $mainmenu->id }}"><u>{{ $mainmenu->title }}</u></label>
                            </div>
							 @foreach ($submenus as $submenu)
							 @if($mainmenu->id==$submenu->main_menu)
                            
                                <input type="checkbox" class="form-check-input" id="submenu{{ $submenu->id }}" name="submenus[]" value="{{ $submenu->id }}" 
                                    {{ (isset($role) && in_array($submenu->id, explode(',', $role->submenus))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="submenu{{ $submenu->id }}">{{ $submenu->title }}</label>
                         
							@endif
							@endforeach
							<hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
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

@endsection
@push('scripts')

{{-- <script>

function Validate() {
        var password = document.getElementById("Password").value;
		alert(password);
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
	</script> --}}

<script>
function save() {
	alert('vendor has been added successfully');
	window.location.href='{{route("vendor-list")}}'
}



function getAjaxValue(url, method, callback) {
                $.ajax({
                    url: url,
                    type: method,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: callback
                });
            }


            // Main Categoy Id
            $('#department').on('change', function() {
                let department = $(this).val();
                let url = '{{ route('getstaffdepartment') }}?department=' + department;
                let method = 'GET';
                getAjaxValue(url, method, function(data) {
                    $('#designation').empty();
					//alert(data);
                    $.each(data, function(key, category) {

                        $('#designation').append(
                            `<option value="${category.id}" selected>${category.designation}</option>`
                        );
                    });
                });
            });


</script>
@endpush