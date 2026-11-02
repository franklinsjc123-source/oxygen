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
                        <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
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
                                    @if(session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

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
                    <select class="custom-select w-100 form-control" id="department" name="department" required {{ isset($role) ? 'style=pointer-events:none;background-color:#e9ecef; readonly tabindex=-1' : '' }}>
                        <option value="">--Select--</option>
                        @foreach ($departments as $item)
                            <option value="{{ $item->id }}" {{ (isset($role) && $role->department == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if(isset($role))
                        <input type="hidden" name="department" value="{{ $role->department }}">
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group row">
                <label for="designation" class="col-xl-4 col-md-4">Designation:</label>
                <div class="col-xl-8 col-md-8">
                    <select class="custom-select w-100 form-control" id="designation" name="designation" required {{ isset($role) ? 'style=pointer-events:none;background-color:#e9ecef; readonly tabindex=-1' : '' }}>
                        <option value="">--Select--</option>
                        @foreach ($designations as $item)
                            <option value="{{ $item->id }}" {{ (isset($role) && $role->designation == $item->id) ? 'selected' : '' }}>{{ $item->designation }}</option>
                        @endforeach
                    </select>
                    @if(isset($role))
                        <input type="hidden" name="designation" value="{{ $role->designation }}">
                    @endif
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
                            <div class="menu-section-card mb-3 p-3" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
                                <div class="d-flex align-items-center pb-2 mb-2" style="border-bottom: 1px solid #edf2f7;">
                                    <input type="checkbox" class="form-check-input main-menu-checkbox m-0" id="mainmenu{{ $mainmenu->id }}" name="mainmenus[]" value="{{ $mainmenu->id }}" 
                                        data-mainmenu-id="{{ $mainmenu->id }}"
                                        {{ (isset($role) && in_array($mainmenu->id, explode(',', $role->mainmenus))) ? 'checked' : '' }}
                                        style="cursor: pointer; margin-right: 8px !important;">
                                    <label class="form-check-label m-0" for="mainmenu{{ $mainmenu->id }}" style="cursor: pointer; font-weight: 700; font-size: 15px; color: #1e293b;">
                                        {{ $mainmenu->title }}
                                    </label>
                                </div>
                                <div class="submenus-wrapper d-flex flex-wrap align-items-center pt-1" style="padding-left: 2px;">
                                    @foreach ($submenus as $submenu)
                                        @if($mainmenu->id == $submenu->main_menu)
                                            <div class="d-inline-flex align-items-center" style="margin-right: 14px; margin-bottom: 6px;">
                                                <input type="checkbox" class="form-check-input sub-menu-checkbox m-0" id="submenu{{ $submenu->id }}" name="submenus[]" value="{{ $submenu->id }}" 
                                                    data-parent-mainmenu="{{ $mainmenu->id }}"
                                                    {{ (isset($role) && in_array($submenu->id, explode(',', $role->submenus))) ? 'checked' : '' }}
                                                    style="cursor: pointer; margin-right: 5px !important;">
                                                <label class="form-check-label m-0" for="submenu{{ $submenu->id }}" style="cursor: pointer;">{{ $submenu->title }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
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
                let url = '{{ route('getalldesignations') }}?department=' + department;
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


            // Select/Deselect all sub-menus when a main menu header checkbox is toggled
            $(document).on('change', '.main-menu-checkbox', function() {
                var mainMenuId = $(this).data('mainmenu-id');
                var isChecked = $(this).is(':checked');
                $('.sub-menu-checkbox[data-parent-mainmenu="' + mainMenuId + '"]').prop('checked', isChecked);
            });

            // If a sub-menu is unchecked, uncheck its parent header;
            // If all sub-menus are checked, re-check the parent header
            $(document).on('change', '.sub-menu-checkbox', function() {
                var mainMenuId = $(this).data('parent-mainmenu');
                var allSubs = $('.sub-menu-checkbox[data-parent-mainmenu="' + mainMenuId + '"]');
                var allChecked = allSubs.length === allSubs.filter(':checked').length;
                $('.main-menu-checkbox[data-mainmenu-id="' + mainMenuId + '"]').prop('checked', allChecked);
            });

</script>
@endpush