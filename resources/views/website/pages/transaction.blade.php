{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
<!-- page-wrapper Start-->

@include('website.pages.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	
    
    @include('website.pages.sidemenu')
@section('content')
	<div class="page-body">
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col">
						<div class="page-header-left">
							<h3> Transaction Details
							
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
							
							<li class="breadcrumb-item active"> Transaction</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
                <div class="card">
                  
                    <div class="card-body order-datatable">
                        <table class="display" id="basic-5">
                            <thead>
                            <tr>
                                <th>Order id</th>
                                <th>Transaction Id</th>
                               <th>Date</th>
                                <th>Payment Method</th>
                                <th>Delivery Status</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    005
                                </td>
                                <td>#1605470</td>
                                <td>28-04-2022</td>
                                
                                <td>UPI</td>
                                <td>Process</td>
								<td>Rs 1500</td>
                               
                            </tr>
							<tr>
                                <td>
                                    008
                                </td>
                                <td>#1605570</td>
                                <td>27-04-2022</td>
                               
                                <td>UPI</td>
                                <td>Completed</td>
								<td>Rs 5800</td>
                               
                            </tr>
                            
                           
                           
                          

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		<!-- Container-fluid Ends-->
		
	</div>
	
	<!-- footer start-->

	<!-- footer end-->
	
</div>

</div>
  <script src="../assets/js/jquery-3.3.1.min.js"></script>

<!-- Bootstrap js-->
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>

<!-- Datatable js-->
<script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/datatables/custom-basic.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>
@endsection