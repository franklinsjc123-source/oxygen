@extends('layout.auth.master')
@section('contents')
<style>
.track_tbl td.track_dot {
    width: 50px;
    position: relative;
    padding: 0;
    text-align: center;
}
.track_tbl td.track_dot:after {
    content: "\f111";
    font-family: FontAwesome;
    position: absolute;
    margin-left: -5px;
    top: 11px;
}
.track_tbl td.track_dot span.track_line {
    background: #000;
    width: 3px;
    min-height: 50px;
    position: absolute;
    height: 101%;
}
.track_tbl tbody tr:first-child td.track_dot span.track_line {
    top: 30px;
    min-height: 25px;
}
.track_tbl tbody tr:last-child td.track_dot span.track_line {
    top: 0;
    min-height: 25px;
    height: 10%;
}
</style>
   

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
								
                                 @if($page=='Edit')  
                                <form action="{{ route('activity_trackers.status', $tracker->id) }}" method="POST">
                                    @csrf
									
										

									<div class="row">
										<div class="col-md-4">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Pipeline</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="pipe" required="">
																<option value="">--Select--</option>
																
																<option value="Appoinment Fixed" {{($tracker->pipline=='Appoinment Fixed')?'selected':''}}>Appoinment Fixed</option>
																<option value="Package Explained" {{($tracker->pipline=='Package Explained')?'selected':''}}>Package Explained</option>
																<option value="Negotiating" {{($tracker->pipline=='Negotiating')?'selected':''}}>Negotiating</option>
																<option value="Pending Decision" {{($tracker->pipline=='Pending Decision')?'selected':''}}>Pending Decision</option>
																<option value="Not Interested" {{($tracker->pipline=='Not Interested')?'selected':''}}>Not Interested</option>
																<option value="Interested" {{($tracker->pipline=='Interested')?'selected':''}}>Interested</option>
															</select>
											</div>
										</div>
									</div>

									<div class="col-md-4">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Win %</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="win" required="">
																<option value="">--Select--</option>
																
																<option value="10%-25%" {{($tracker->win=='10%-25%')?'selected':''}}>10%-25%</option>
																<option value="25%-50%" {{($tracker->win=='25%-50%')?'selected':''}}>25%-50%</option>
																<option value="50%-75%" {{($tracker->win=='50%-75%')?'selected':''}}>50%-75%</option>
																<option value="75%-100%" {{($tracker->win=='75%-100%')?'selected':''}}>75%-100%</option>
																
															</select>
											</div>
										</div>
									</div>

									


									<div class="col-md-4">
									<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Next Follow-up Date</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="next_follow_date"  type="date" required="" name="next_follow_date" value="{{ old('next_follow_date', $tracker->next_follow_date) }}">
											</div>
										</div>
									</div>
									
									</div>
										
									
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-1 col-md-1">Reason</label>
											<div class="col-xl-9 col-md-9">
												<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="reason">{{ old('reason', $tracker->reason) }}</textarea>
											</div>
											<div class="col-xl-2 col-md-2">
												<button class="btn  px-5 btn-lg btn-primary" type="submit">Update </button>
											</div>    
										</div>
										

										<input class="form-control" id="id"  type="hidden"  name="id" value="{{ old('id', $tracker->id) }}">
																
											<div class="modal-footer">  
                                                   
                                                </div>
                                    </form>
									@else
									<form action="{{ route('activity_trackers.status', $tracker->id) }}" method="POST">
                                    @csrf
									
										

									<div class="row">
										<div class="col-md-4">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Pipeline</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="pipe" required="">
																<option value="">--Select--</option>
																
																<option value="Appoinment Fixed">Appoinment Fixed</option>
																<option value="Package Explained">Package Explained</option>
																<option value="Negotiating" >Negotiating</option>
																<option value="Pending Decision" >Pending Decision</option>
																<option value="Not Interested" >Not Interested</option>
																<option value="Interested" >Interested</option>
															</select>
											</div>
										</div>
									</div>

									<div class="col-md-4">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Win %</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="win" required="">
																<option value="">--Select--</option>
																
																<option value="10%-25%" >10%-25%</option>
																<option value="25%-50%" >25%-50%</option>
																<option value="50%-75%" >50%-75%</option>
																<option value="75%-100%" >75%-100%</option>
																
															</select>
											</div>
										</div>
									</div>

									


									<div class="col-md-4">
									<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Next Follow-up Date</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="next_follow_date"  type="date" required="" name="next_follow_date" value="">
											</div>
										</div>
									</div>
									
									</div>
										
									
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-1 col-md-1">Reason</label>
											<div class="col-xl-9 col-md-9">
												<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="reason"></textarea>
											</div>
											<div class="col-xl-2 col-md-2">
												<button class="btn  px-5 btn-lg btn-primary" type="submit">Save </button>
											</div>    
										</div>
										

										<input class="form-control" id="id"  type="hidden"  name="id" value="">
																
											<div class="modal-footer">  
                                                   
                                                </div>
                                    </form>
									@endif
									</div>
                                    
									<h3>Activity Tracking <a href="{{ route('vendorcreate.show', $vid) }}" class="btn btn-warning"><i class="fa fa-plus"></i> Add Vendor </a></h3>
    <table class="table table-bordered track_tbl">
        <thead>
            <tr>
                <th></th>
				<th>Date/Time</th>
                <th>Status</th>
                <th>Win</th>
                <th>Next follow Date</th>
                <th>Reason</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
		@foreach($activity  as $act)
		<tr class="active">
                <td class="track_dot">
                    <span class="track_line"></span>
                </td>
                <td>{{date('d-M-Y H:i',strtotime($act->created_at))}}</td>
                <td>{{$act->pipline}}</td>
                <td>{{$act->win}}</td>
				<td>{{date('d-M-Y',strtotime($act->next_follow_date))}}</td>
                <td>{{$act->reason}}</td>
				<td><a href="{{ route('activity.edit', $act->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> </a>
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

        <!-- footer start-->
     
        <!-- footer end-->

    </div>

</div>

@endsection