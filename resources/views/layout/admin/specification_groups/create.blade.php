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
							<h3> Specification Group
							
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>

							<li class="breadcrumb-item active">Add Specification Group</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

	
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="card tab2-card">
				
				<div class="card-body">
				
				
				<form action="{{ route('specification_groups.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="specification_group_name" class="form-label">Group Name</label>
            <input type="text" class="form-control" id="specification_group_name" name="specification_group_name" required>
        </div>
        <div class="mb-3">
            <label for="specification_group_refname" class="form-label">Reference Name</label>
            <input type="text" class="form-control" id="specification_group_refname" name="specification_group_refname" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="custom-select w-100 form-control"
                name="status"  id="status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
       
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
					
					
				</div>
			</div>
			
			
			
		
			
			
			</div></div>
			
		</div>
		<!-- Container-fluid Ends-->
		
	</div>
	
	<!-- footer start-->
	
	<!-- footer end-->
	
</div>

</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
    	<script>
    		function add()
    		{
    		
    			var startprice = $('#start_price').val();
    			
    			var slab = $('#slab').val();
    			
    		
    			var bid = parseInt(startprice)+parseInt(slab);
    			
    			$('#bid_price').val(bid);
    			
    		}
    
    	</script>


@endsection