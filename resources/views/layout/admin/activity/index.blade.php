@extends('layout.auth.master')
@section('contents')
@include('paritials.css.activity.activity-css')
@include('paritials.js.activity.activity-add-js')
   

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@if(request()->is('staff/*') || (session()->get('log_type') != 'Admin'))
		@include('paritials.staffauth.sidemenu');
	@else
		@include('paritials.auth.sidemenu');
	@endif
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
                            <li class="breadcrumb-item"><a href="{{ (request()->is('staff/*') || (session()->get('log_type') != 'Admin')) ? route('staffdashboard', session()->get('login_id')) : url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							
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

                                    <style>
                                        .activity-toolbar {
                                            padding: 0;
                                            width: 100% !important;
                                        }
                                        .fixed-table-toolbar,
                                        .fixed-table-toolbar .bs-bars,
                                        .fixed-table-toolbar .pull-left,
                                        .fixed-table-toolbar .float-left {
                                            float: none !important;
                                            width: 100% !important;
                                            clear: both;
                                        }
                                        .activity-toolbar .toolbar-row {
                                            display: flex;
                                            align-items: center;
                                            justify-content: space-between;
                                            gap: 12px;
                                            padding: 8px 0;
                                            width: 100%;
                                        }
                                        .activity-toolbar .toolbar-row .btn {
                                            white-space: nowrap;
                                            font-size: 13px;
                                            padding: 6px 14px;
                                            border-radius: 4px;
                                        }
                                        .activity-toolbar .search-box {
                                            flex: 1;
                                            max-width: 500px;
                                        }
                                        .activity-toolbar .search-box .form-control {
                                            border-left: none;
                                            font-size: 13px;
                                        }
                                        .activity-toolbar .search-box .input-group-text {
                                            background: #fff;
                                            border-right: none;
                                        }
                                        .fixed-table-toolbar .columns,
                                        .fixed-table-toolbar .search {
                                            display: none !important;
                                        }
                                    </style>

                                    <div id="toolbar" class="activity-toolbar">
                                        <div class="toolbar-row">
                                            <div class="input-group search-box">
                                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                <input type="text" class="form-control" id="customActivitySearch" placeholder="Search For ID, Name, Status, or Something..">
                                            </div>
                                            <div class="d-flex align-items-center gap-2 ms-auto">
                                                <button type="button" class="btn btn-success btn-export-excel" style="background-color: #28a745; border-color: #28a745; color: #fff;">
                                                    <i class="fa fa-file-excel-o me-1"></i> Export Excel
                                                </button>
                                                <a href="{{ route(request()->is('staff/*') ? 'staffactivity_trackers.create' : 'activity_trackers.create') }}">
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="fa fa-plus me-1"></i> New Vendor Tracker
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="false" data-sort="true" data-pagination="true" data-page-size="25" data-search="false" data-show-refresh="false" data-key-events="true" data-resizable="true" data-cookie="true"
                                    data-show-export="false" data-toolbar="#toolbar">
            <thead>
                                    <tr>
                                    <th data-field="rmdetails" data-sortable="true">RM DETAILS</th>
                                    <th data-field="storedetails" data-sortable="true">STORE DETAILS</th>
                                   
                                    <th data-field="branch" data-sortable="true"> BRANCH</th>
                                   
                                    <th data-field="Pipeline" data-sortable="true">PIPELINE</th>
								   
								   <th data-field="reference" data-sortable="true">REFERENCE</th>
								   
								   <th data-field="cdate" data-sortable="true">CREATE DATE</th>
                                    
                                       
                                    <th data-field="fdate" data-sortable="true"> FOLLOW-UP DATE </th>
                                      
                                     <th data-field="status" data-sortable="true">STATUS</th>
                                         <th>Action</th>
                                    </tr>
            </thead>
            <tbody>
                @foreach($trackers as $tracker)
                
                                   <tr>
                                        <td>{{ $tracker->empname }}
										<br>Emp.id:{{ $tracker->empid }}</td>
                                    <td>
                                        <span>{{ $tracker->shop_name }}<br>{{ $tracker->owner_name }}</span>   
                                        </td>
                                    
                                    <td>
                                        <span>{{ $tracker->zone }}</span> / <span>{{ $tracker->area }}</span>
                                            
                                        </td>
										
                                        <td>
                                        <span>{{ $tracker->win }}</span>   
                                        </td>
										
                                        <td>
                                        <span class="font-secondary">{{ $tracker->reference }} </span>   
                                        </td>
										
                                         <td>
                                         {{ date('d-M-Y',strtotime($tracker->created_at)) }}
                                        </td>
										
                                        <td>
                                         {{ date('d-M-Y',strtotime($tracker->next_follow_date)) }}
										</td>
											<td>
										<span class="badge border border-success text-success"> {{ $tracker->pipline }}</span>
										</td>
										
                                        
                                        <td>
                                            <div class="d-flex" style="gap: 5px; white-space: nowrap;">
                                                <a href="{{ route(request()->is('staff/*') ? 'staffactivity_trackers.show' : 'activity_trackers.show', $tracker->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>
                                                <a href="{{ route(request()->is('staff/*') ? 'staffactivity_trackers.edit' : 'activity_trackers.edit', $tracker->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> </a>
                                                <form action="{{ route(request()->is('staff/*') ? 'staffactivity_trackers.destroy' : 'activity_trackers.destroy', $tracker->id) }}" method="POST" style="margin: 0;" onsubmit="return confirmDelete(event, this);">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
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
            </div>
            <!-- Container-fluid Ends-->

        </div>

        <!-- footer start-->
     
        <!-- footer end-->

    </div>

</div>

<style>
    /* SweetAlert2 font size adjustment for visual consistency */
    .swal2-popup {
        font-size: 1.6rem !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
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
        return false;
    }

    $(document).ready(function() {
        $('#customActivitySearch').on('keyup', function() {
            var searchText = $(this).val();
            $('#table').bootstrapTable('resetSearch', searchText);
        });
    });
</script>

@endsection
