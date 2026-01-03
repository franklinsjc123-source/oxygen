@extends('layout.auth.master')
@section('contents')

    @include('paritials.auth.header')

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
                                <h3>Staff Listings
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">User Listings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          
            <!-- Container-fluid starts-->
            <div class="container-fluid">
           
                <div class="row">
                        
                    <div class="col-sm-12">
                        
                        <div class="card">
                       
                                <div class="card-body">
                                <a href="{{url('admin/staff/create')}}" class="btn  btn-primary"><i class="fa fa-plus"></i> Add Staff</a>

                                </br>
                                <a href="{{ route('staff.export') }}" class="btn btn-success px-2 " data-toggle="tooltip" data-placement="top" title="Report" data-original-title="Report"><i
                                    class="fa fa-list"></i>Download Report</a>
                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
                                    <thead>
                                    <tr>
                                        <th data-field="id"> ID</th>
                                        <th data-field="image"> Photo</th>
                                        <th data-field="empdetails" data-sortable="true"> Employee Details</th>
                                        <th data-field="contactdetail" data-sortable="true"> User Details</th>
                                        <th data-field="curriculam" data-sortable="true">Curriculam Details </th>
                                        <th data-field="personal" data-sortable="true">Personal Details </th>
                                        <th data-field="address" data-sortable="true">Current Address </th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                        @foreach($staff as $stf)

                                    <tr>
                                        <td>{{ str_pad($loop->iteration,4,'0',STR_PAD_LEFT); }}</td>
                                        
                                        <td><div class="d-flex">
                                            <img src="{{ asset('assets/images/staffcreate') . '/' . $stf->profileimage }}"
                                                alt="" class="img-fluid img-40 me-2 blur-up lazyloaded">
                                        </div></td>
                                        @php
                                            $dept = DB::table('departments')
                                                    ->join('designation', 'departments.id', '=', 'designation.department')
                                                    ->where('departments.id', $stf->department)
                                                    ->where('designation.id', $stf->designation)
                                                    ->select('departments.*','designation.*')
                                                    ->first();
                                                    
                                         @endphp
                                         <td>{{ $stf->fullname }}</br>{{ $dept ? $dept->name : 'N/A' }}</br>{{ $dept ? $dept->designation : 'N/A' }}</td>
                                         <td>{{ $stf->username }}</br>{{$stf->email}}</br>{{$stf->mobileno}}</td>
                                         <td> Education:{{ $stf->qualification }}</br>Experience:{{$stf->exprience}}</br>DOJ:{{$stf->doj}}</td>
                                         <td>DOB:{{ $stf->dob }}</br>Blood Group:{{$stf->bloodgroup}}</td>
                                         <td>{{ $stf->curr_addr }}</td>
                                    
                                   
                                       
                                        <td>
                                            
                                        <span class="mt-3 d-flex">
                                        

                                            <form action="{{ route('staff.edit',$stf->id) }}" method="get">
                                                @method('EDIT')
                                                @csrf
                                                <button type="submit" class="btn btn-secondary mx-1" title="Edit"
                                                    onclick="return confirm('Are you sure, you want to Edit it?')"><i
                                                        class="fa fa-pencil"></i>
                                                </button>
                                            </form> 
                                        {{-- <a href="#" class="btn btn-secondary px-2" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"><i class="fa fa-pencil"></i> </a> --}}
                                        {{-- <form action="admin/staff/destroy{{$stf->id}}" method="POST"> --}}


                                        <form action="{{ route('staff.destroy',$stf->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-warning mx-1" title="Delete"
                                                onclick="return confirm('Are you sure, you want to delete it?')"><i
                                                    class="fa fa-trash"></i>
                                            </button>
                                        </form>    
                                        {{-- <a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a> --}}
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
            </div></div>
            <!-- Container-fluid Ends-->

        </div>

@endsection