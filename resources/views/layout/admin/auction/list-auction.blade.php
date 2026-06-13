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
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>List Auction
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
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
                                
                          <a href="{{route('auction.create')}}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Auction </a> 
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
                                        <form action="{{ route('import') }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file"
                                                   class="form-control">
                                            <br>
                                            <button class="btn btn-success">
                                                  Import Auction Data
                                               </button>
                                            <a href="{{ asset('assets/sample/auction_sample.csv') }}" class="btn btn-info ms-2" download>
                                                <i class="fa fa-download"></i> Download Sample Format
                                            </a>
                                            {{-- <a class="btn btn-warning"
                                               href="{{ url('export') }}">
                                                      Export Auction Data
                                              </a> --}}
                                        </form>
                                    </div>

                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
                    <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                         data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                    <thead>
                     <tr>
                        <th data-field="id" data-sortable="true">Id / Admin_Id</th>                     
                        <th data-field="sprice" data-sortable="true">Starting Price</th>
                        <th data-field="slab" data-sortable="true">SLAB</th> 
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
                        <td>{{ $item->start_date ? date('d-m-Y h:i A', strtotime($item->start_date)) : '' }}</td>
                		<td>{{ $item->end_date ? date('d-m-Y h:i A', strtotime($item->end_date)) : '' }}</td>
                    
                        <td>
                            <?php
                                $sd = $item->start_date;
                                $ed= $item->end_date;                                    
                            ?>
                        <label class="switch">                         
                        @if($item->status == 1)                                                            
                            <input type="checkbox"
                                class="status-toggle" data-id="{{ $item->id }}"
                                checked id="togBtn">                                                            
                            @else
                                <input type="checkbox"
                                class="status-toggle" data-id="{{ $item->id }}" 
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
                            
                          <a href="{{ route('auction.edit', $item->id) }}" class="btn btn-secondary px-2"  ><i class="fa fa-pencil"></i> </a>
                              @if (session()->get('log_type') == 'Admin')
								  <form action="{{ route('auction.destroy', $item->id) }}"
                                method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-warning mx-1"><i
                                        class="fa fa-trash"></i>                                        
                                </button>                        
                            </form>
							@endif
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
    $(document).on('change', '.status-toggle', function() {
        var id = $(this).data('id');
        var nextStatus = $(this).is(':checked') ? '1' : '0';
        var _token = "{{ csrf_token() }}";
        var checkbox = $(this);
        
        $.ajax({
            url: nextStatus === '1' ? "{{ url('admin/auctionbulkactive') }}" : "{{ url('admin/auctionbulkdeactive') }}",
            type: "POST",
            data: { ids: id, sts: nextStatus, _token: _token },
            success: function(response) {
                // Instantly changed
            },
            error: function(err) {
                checkbox.prop('checked', !nextStatus);
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
                text: "You want to delete this auction! This cannot be undone.",
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
@endpush
