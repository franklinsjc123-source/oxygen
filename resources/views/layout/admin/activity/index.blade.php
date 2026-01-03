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
                            <h3>Activity Tracker
								
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							
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

        <h3>Activity Trackers <a href="{{ route('activity_trackers.create') }}" class="btn btn-primary"> New Vendor Tracker</a></h3>
        

        <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
        data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
            <thead>
                                    <tr>
                                    <th data-field="rmdetails" data-sortable="true">RM DETAILS</th>
                                    <th data-field="storedetails" data-sortable="true">STORE DETAILS</th>
                                   
                                    <th data-field="branch" data-sortable="true"> BRANCH</th>
                                   
                                   <th data-field="Pipeline" data-sortable="true">PIPELINE</th>
								   
								   <th data-field="reference" data-sortable="true">REFERENCE</th>
								   
								   <th data-field="cdate" data-sortable="true">CREATE DATE</th>
                                    
                                       
                                    <th data-field="fdate" data-sortable="true"> FOLLOW-UP DATE </th>
                                      
									 <th data-field="reason" data-sortable="true">Reason </th>
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
                                        {{ $tracker->reason }}
										</td>
											<td>
										<span class="badge border border-success text-success"> {{ $tracker->pipline }}</span>
										</td>
										
                                        
                                        <td>
                                        <a href="{{ route('activity_trackers.show', $tracker->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>
                            
                            <a href="{{ route('activity_trackers.edit', $tracker->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> </a>
                            <form action="{{ route('activity_trackers.destroy', $tracker->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                            </form>
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

@endsection