@extends('layout.auth.master')
@section('contents')

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu');
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
							<li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i data-feather="home"></i></a></li>

							<li class="breadcrumb-item active">Add Attribute Group</li>
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
				
				
				<form action="{{ route('vendorattribute.master.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="attribute_group_name" class="form-label">Group Name</label>
            <input type="text" class="form-control" id="attribute_group_name" name="attribute_group_name" required>
        </div>
        <div class="mb-3">
            <label for="attribute_group_refname" class="form-label">Reference Name</label>
            <input type="text" class="form-control" id="attribute_group_refname" name="attribute_group_refname" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Select Category</label>
            <div class="border p-3 rounded" style="max-height: 400px; overflow-y: auto;">
                @foreach ($CategoryMain as $main)
                    <div class="main-category-item mb-2">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input main-cat" 
                                   id="main_{{ $main->id }}" 
                                   data-main-id="{{ $main->id }}">
                            <label class="form-check-label fw-bold" for="main_{{ $main->id }}">
                                {{ $main->category_main_name }}
                            </label>
                        </div>
                        <div class="sub-categories ms-4">
                            @php
                                $categories = $Category->where('main_category_id', $main->id);
                            @endphp
                            @foreach ($categories as $cat)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input category-cat" 
                                           id="category_{{ $cat->id }}" 
                                           data-main-id="{{ $main->id }}" 
                                           data-main-name="{{ $main->category_main_name }}"
                                           data-category-id="{{ $cat->id }}"
                                           data-category-name="{{ $cat->category_name }}"
                                           @php
                                               $subIds = $CategorySub->where('category_id', $cat->id)->pluck('id')->toArray();
                                           @endphp
                                           data-sub-ids="{{ implode(',', $subIds) }}">
                                    <label class="form-check-label" for="category_{{ $cat->id }}">
                                        {{ $cat->category_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="selected_subcategory_inputs">
                <input type="hidden" name="sub_category_ids_csv" id="sub_category_ids_csv" value="">
            </div>
            <div id="selected_subcategory_tags" class="mt-2 d-flex flex-wrap gap-1"></div>
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

        <script>
            $(function() {
                function syncParentStates() {
                    $('.main-cat').each(function() {
                        const mainId = $(this).data('main-id');
                        const allCategories = $(`.category-cat[data-main-id="${mainId}"]`);
                        const checkedCategories = allCategories.filter(':checked');
                        $(this).prop('checked', allCategories.length > 0 && checkedCategories.length === allCategories.length);
                    });
                }

                function renderSelections() {
                    const $inputs = $('#selected_subcategory_inputs');
                    const $tags = $('#selected_subcategory_tags');
                    $inputs.empty();
                    $tags.empty();
                    $inputs.append('<input type="hidden" name="sub_category_ids_csv" id="sub_category_ids_csv" value="">');

                    const subIds = new Set();
                    $('.category-cat:checked').each(function() {
                        const mainName = $(this).data('main-name');
                        const categoryName = $(this).data('category-name');
                        const rawSubIds = ($(this).data('sub-ids') || '').toString();
                        if (rawSubIds.length > 0) {
                            rawSubIds.split(',').forEach(id => {
                                if (id) subIds.add(id);
                            });
                        }
                        $tags.append(`<span class="badge bg-light text-dark border">${mainName} | ${categoryName}</span>`);
                    });

                    $('#sub_category_ids_csv').val(Array.from(subIds).join(','));
                }

                $(document).on('change', '.main-cat', function() {
                    const mainId = $(this).data('main-id');
                    const checked = $(this).is(':checked');
                    $(`.category-cat[data-main-id="${mainId}"]`).prop('checked', checked);
                    syncParentStates();
                    renderSelections();
                });

                $(document).on('change', '.category-cat', function() {
                    syncParentStates();
                    renderSelections();
                });

                syncParentStates();
                renderSelections();
            });
        </script>


@endsection