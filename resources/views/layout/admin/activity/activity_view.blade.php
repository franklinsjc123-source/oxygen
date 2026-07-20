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
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-left" style="margin-bottom: 0;">
                                <li class="breadcrumb-item"><a href="{{ (request()->is('staff/*') || (session()->get('log_type') != 'Admin')) ? route('staffdashboard', session()->get('login_id')) : url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Activity Tracker</li>
                            </ol>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route(request()->is('staff/*') ? 'staffactivity_trackers.index' : 'activity_trackers.index') }}" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i> Back</a>
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
								
                                 <div class="card p-3 mb-4 shadow-sm" style="border-radius: 8px; border: 1px solid #e2e8f0; background: #fff;">
                                  @if($page=='Edit')  
                                    <form action="{{ route(request()->is('staff/*') ? 'staffactivity_trackers.status' : 'activity_trackers.status', $tracker->vendor_id) }}" method="POST">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label font-weight-bold">Pipeline <span class="text-danger">*</span></label>
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

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label font-weight-bold">Win % <span class="text-danger">*</span></label>
                                                    <select class="custom-select w-100 form-control" name="win" required="">
                                                        <option value="">--Select--</option>
                                                        <option value="10%-25%" {{($tracker->win=='10%-25%')?'selected':''}}>10%-25%</option>
                                                        <option value="25%-50%" {{($tracker->win=='25%-50%')?'selected':''}}>25%-50%</option>
                                                        <option value="50%-75%" {{($tracker->win=='50%-75%')?'selected':''}}>50%-75%</option>
                                                        <option value="75%-100%" {{($tracker->win=='75%-100%')?'selected':''}}>75%-100%</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label font-weight-bold">Next Follow-up Date <span class="text-danger">*</span></label>
                                                    <input class="form-control" id="next_follow_date" type="date" required="" name="next_follow_date" value="{{ old('next_follow_date', $tracker->next_follow_date) }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label class="form-label font-weight-bold">Reason <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="reason" placeholder="Enter reason or notes...">{{ old('reason', $tracker->reason) }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-end mt-3 d-flex justify-content-end">
                                                <button class="btn btn-primary px-4 py-2" type="submit">
                                                    <i class="fa fa-save me-1"></i> Update Status
                                                </button>
                                            </div>
                                        </div>
                                        <input class="form-control" id="id" type="hidden" name="id" value="{{ old('id', $tracker->id) }}">
                                    </form>
                                  @else
                                    <form action="{{ route(request()->is('staff/*') ? 'staffactivity_trackers.status' : 'activity_trackers.status', $tracker->id) }}" method="POST">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label font-weight-bold">Pipeline <span class="text-danger">*</span></label>
                                                    <select class="custom-select w-100 form-control" name="pipe" required="">
                                                        <option value="">--Select--</option>
                                                        <option value="Appoinment Fixed">Appoinment Fixed</option>
                                                        <option value="Package Explained">Package Explained</option>
                                                        <option value="Negotiating">Negotiating</option>
                                                        <option value="Pending Decision">Pending Decision</option>
                                                        <option value="Not Interested">Not Interested</option>
                                                        <option value="Interested">Interested</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label font-weight-bold">Win % <span class="text-danger">*</span></label>
                                                    <select class="custom-select w-100 form-control" name="win" required="">
                                                        <option value="">--Select--</option>
                                                        <option value="10%-25%">10%-25%</option>
                                                        <option value="25%-50%">25%-50%</option>
                                                        <option value="50%-75%">50%-75%</option>
                                                        <option value="75%-100%">75%-100%</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label font-weight-bold">Next Follow-up Date <span class="text-danger">*</span></label>
                                                    <input class="form-control" id="next_follow_date" type="date" required="" name="next_follow_date" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label class="form-label font-weight-bold">Reason <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="reason" placeholder="Enter reason or notes..."></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-end mt-3 d-flex justify-content-end">
                                                <button class="btn btn-primary px-4 py-2" type="submit">
                                                    <i class="fa fa-save me-1"></i> Save Status
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                  @endif
                                </div>
									</div>
                                    
									<h3 class="d-flex justify-content-between align-items-center mb-3"><span>Activity Tracking</span> <a href="{{ route(request()->is('staff/*') ? 'staffvendorcreate.show' : 'vendorcreate.show', $vid) }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Vendor </a></h3>
    <div class="table-responsive">
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
                    <td>{{\Carbon\Carbon::parse($act->updated_at)->timezone('Asia/Kolkata')->format('d-M-Y h:i A')}}</td>
                    <td>{{$act->pipline}}</td>
                    <td>{{$act->win}}</td>
                    <td>{{date('d-M-Y',strtotime($act->next_follow_date))}}</td>
                    <td>{{$act->reason}}</td>
                    <td><a href="{{ route(request()->is('staff/*') ? 'staffactivity.edit' : 'activity.edit', $act->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> </a>
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