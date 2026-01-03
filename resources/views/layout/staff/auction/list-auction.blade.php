@extends('layout.auth.master')
@section('contents')

@include('paritials.css.auction.auction')?>

    @include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.staffauth.sidemenu');
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
                                <h3>List Auction
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">List Auction</li>
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
                                
                          <a href="{{route('staffauction.create')}}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Offers </a> 
                          @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                                    <div class="card-body">
                                        <form action="{{ route('staffimport') }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file"
                                                   class="form-control">
                                            <br>
                                            <button class="btn btn-success">
                                                  Import Auction Data
                                               </button>
                                            {{-- <a class="btn btn-warning"
                                               href="{{ url('export') }}">
                                                      Export Auction Data
                                              </a> --}}
                                        </form>
                                    </div>

                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
                    <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                         data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                    <thead>
                     <tr>
                        <th data-field="id" data-sortable="true">Id / Admin_Id</th>                     
                        <th data-field="sprice" data-sortable="true">Starting Price</th>
                        <th data-field="slab" data-sortable="true">SLAB</th> 
                        <th data-field="bid" data-sortable="true">BID Price</th>
                    	<th data-field="so" data-sortable="true">Stat Offer</th>                    
                    	<th data-field="eo" data-sortable="true">End Offer</th>
                       <th data-field="status" data-sortable="true">Status</th>
                       <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ( $auction as $item)
                    <tr>
                        <td>{{$loop->iteration }} / {{$item->admin_id}}</td>
                        <td>{{$item->start_price}}</td>
                        <td>{{$item->slab}}</td>
                        <td>{{$item->bid_price}}</td>
                        <td>{{$item->start_date}}</td>
                		<td>{{$item->end_date}}</td>
                    
                        <td>
                            <?php
                                $sd = $item->start_date;
                                $ed= $item->end_date;                                    
                            ?>
                        <label class="switch">                         
                        @if($ed >= $date && $sd <= $date)                                                            
                            <input type="checkbox"
                                onclick="return confirm('you want to Change it?  Please Click Edit Button')"
                                checked id="togBtn">                                                            
                            @else
                                <input type="checkbox"
                                onclick="return confirm('you want to Change it?  Please Click Edit Button')" 
                                 id="togBtn">                                                            
                            @endif
                        <div class="slider round">
                            <!--ADDED HTML -->
                            <span class="off">Inactive</span>
                            <span class="on">Active</span>
                            <!--END-->
                        </div>                        
                        </label>                    
                        </div>                    
                        </td>

                        <td><span class="mt-3 d-flex">
                            <form action="{{ route('staffauction.edit', $item->id) }}"
                                method="get">
                                @method('GET')
                                @csrf
                            <button class="btn btn-secondary mx-1"
                            onclick="return confirm('Are you sure, you want to Edit it?')"
                                    data-original-title="Edit"><i class="fa fa-pencil"></i> </button>
                            </form>
                            {{-- <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a> --}}
                            <form action="{{ route('staffauction.destroy', $item->id) }}"
                                method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-warning mx-1"
                                    onclick="return confirm('Are you sure, you want to delete it?')"><i
                                        class="fa fa-trash"></i>                                        
                                </button>                        
                            </form>
                            {{-- <a href="#" onclick="return confirm('Are you sure, you want to Edit it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>                         --}}
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
		
@endsection