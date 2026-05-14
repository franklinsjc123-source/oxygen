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

							<li class="breadcrumb-item active">Edit Specification Group</li>
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
				
				
				<form action="{{ route('specification_groups.admin.update', $group->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="specification_group_name" class="form-label">Group Name</label>
            <input type="text" class="form-control" id="specification_group_name" name="specification_group_name" value="{{ $group->specification_group_name }}" required>
        </div>
        <div class="mb-3">
            <label for="specification_group_refname" class="form-label">Reference Name</label>
            <input type="text" class="form-control" id="specification_group_refname" name="specification_group_refname" value="{{ $group->specification_group_refname }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Select Category</label>
            <div class="border p-3 rounded" style="max-height: 400px; overflow-y: auto;">
                @php
                    $selectedSubIds = explode(',', (string)($group->sub_category_ids ?? ''));
                    $selectedSubIds = array_filter($selectedSubIds);
                @endphp
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
                                    @php
                                        $currentSubIds = $CategorySub->where('category_id', $cat->id)->pluck('id')->map(fn($id) => (string)$id)->toArray();
                                        $isChecked = !empty(array_intersect($currentSubIds, $selectedSubIds));
                                    @endphp
                                    <input type="checkbox" class="form-check-input category-cat" 
                                           id="category_{{ $cat->id }}" 
                                           data-main-id="{{ $main->id }}" 
                                           data-main-name="{{ $main->category_main_name }}"
                                           data-category-id="{{ $cat->id }}"
                                           data-category-name="{{ $cat->category_name }}"
                                           data-sub-ids="{{ implode(',', $currentSubIds) }}"
                                           {{ $isChecked ? 'checked' : '' }}>
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
                <input type="hidden" name="sub_category_ids_csv" id="sub_category_ids_csv" value="{{ $group->sub_category_ids }}">
            </div>
            <div id="selected_subcategory_tags" class="mt-2 d-flex flex-wrap gap-1"></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Vendors</label>
            <div class="d-flex mb-2 gap-2 align-items-center">
                <input type="text" id="vendorSearch" class="form-control form-control-sm" style="max-width: 250px;" placeholder="Search Vendor...">
                <div class="form-check ms-3">
                    <input type="checkbox" id="selectAllVendors" class="form-check-input">
                    <label class="form-check-label" for="selectAllVendors">Select All</label>
                </div>
            </div>
            <div class="border p-3 rounded" style="max-height: 200px; overflow-y: auto;">
                @php
                    $selectedVendorIds = explode(',', (string)($group->vendor_ids ?? ''));
                    $selectedVendorIds = array_filter($selectedVendorIds);
                @endphp
                @foreach ($Vendors as $vendor)
                    <div class="form-check vendor-item">
                        <input type="checkbox" class="form-check-input vendor-checkbox" 
                               name="vendor_ids[]" 
                               id="vendor_{{ $vendor->id }}" 
                               value="{{ $vendor->id }}"
                               {{ in_array($vendor->id, $selectedVendorIds) ? 'checked' : '' }}>
                        <label class="form-check-label vendor-name" for="vendor_{{ $vendor->id }}">
                            {{ $vendor->shop_name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="custom-select w-100 form-control"
                name="status"  id="status" required>
                <option value="1" {{ $group->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $group->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
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

                // Vendor Search and Select All
                $('#vendorSearch').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    $('.vendor-item').filter(function() {
                        $(this).toggle($(this).find('.vendor-name').text().toLowerCase().indexOf(value) > -1);
                    });
                });

                $('#selectAllVendors').on('change', function() {
                    var isChecked = $(this).is(':checked');
                    $('.vendor-checkbox:visible').prop('checked', isChecked);
                });

                syncParentStates();
                renderSelections();
            });
        </script>


@endsection
