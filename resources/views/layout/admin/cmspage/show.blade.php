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
							<h3> Attribute Group
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							
							<li class="breadcrumb-item active">Add CMS PAGE</li>
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
				<div class="container">
        <h1>{{ $page->page_title }}</h1>

        <div class="mb-3">
            <strong>Page Name:</strong> {{ $page->page_name }}
        </div>

        <div class="mb-3">
            <strong>Status:</strong> {{ $page->status }}
        </div>

        <div class="mb-3">
            <strong>Content:</strong>
            <div class="card">
                <div class="card-body">
                    {!! $page->page_content !!}
                </div>
            </div>

        </div>

        <a href="{{ route('cmspages.index') }}" class="btn btn-secondary">Back to Pages</a>
        <a href="{{ route('cmspages.edit', $page->id) }}" class="btn btn-primary">Edit Page</a>
    </div>
	
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
	
	

	
	@endsection	