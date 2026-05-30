@extends('layout.auth.master')
@section('contents')
@include('paritials.js.auction.create-auction-js')
@include('paritials.js.time-js')
@include('paritials.css.auction.auction')

    @include('paritials.vendorauth.header')

<!-- page-wrapper Start-->
@include('paritials.vendorauth.topmenu');
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
							<h3> Specification Group
							
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>

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
				
				
				<form action="{{ route('specification_groups.update', $group->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="specification_group_name" class="form-label">Group Name</label>
            <input type="text" class="form-control" id="specification_group_name" name="specification_group_name" value="{{ $group->specification_group_name }}" {{ $group->created_by === 'Admin' ? 'readonly' : '' }} required>
        </div>
        <div class="mb-3">
            <label for="specification_group_refname" class="form-label">Reference Name</label>
            <input type="text" class="form-control" id="specification_group_refname" name="specification_group_refname" value="{{ $group->specification_group_refname }}" {{ $group->created_by === 'Admin' ? 'readonly' : '' }} required>
        </div>
        <div class="mb-3">
            <label class="form-label">Select Category</label>
            <div class="form-check mb-2">
                <input type="checkbox" id="selectAllCategories" class="form-check-input">
                <label class="form-check-label fw-bold" for="selectAllCategories">Select All Categories</label>
            </div>
            <div class="border p-3 rounded" style="max-height: 400px; overflow-y: auto;">
                @php
                    $selectedSubIds = isset($vendorSelectedSubIds) ? $vendorSelectedSubIds : array_filter(explode(',', (string)($group->sub_category_ids ?? '')));
                @endphp
                @foreach ($CategoryMain as $main)
                    @php
                        $categories = $Category->where('main_category_id', $main->id);
                    @endphp
                    @foreach ($categories as $cat)
                        @php
                            $subs = $CategorySub->where('category_id', $cat->id);
                            if ($subs->isEmpty()) continue;
                        @endphp
                        <div class="category-group-item mb-3">
                            <div class="form-check border-bottom pb-1 mb-2">
                                <input type="checkbox" class="form-check-input group-cat mt-1" 
                                       id="group_{{ $cat->id }}" 
                                       data-category-id="{{ $cat->id }}">
                                <label class="form-check-label fw-bold text-dark ms-2" for="group_{{ $cat->id }}">
                                    {{ $main->category_main_name }} &rarr; {{ $cat->category_name }}
                                </label>
                            </div>
                            <div class="sub-categories ms-4">
                                @foreach ($subs as $sub)
                                    <div class="form-check mb-1">
                                        @php
                                            $isChecked = in_array((string)$sub->id, $selectedSubIds);
                                        @endphp
                                        <input type="checkbox" class="form-check-input sub-cat mt-1" 
                                               id="sub_{{ $sub->id }}" 
                                               data-category-id="{{ $cat->id }}"
                                               data-sub-id="{{ $sub->id }}"
                                               data-sub-name="{{ $sub->category_sub_name }}"
                                               data-main-name="{{ $main->category_main_name }}"
                                               data-category-name="{{ $cat->category_name }}"
                                               {{ $isChecked ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary ms-2" for="sub_{{ $sub->id }}">
                                            {{ $sub->category_sub_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div id="selected_subcategory_inputs">
                <input type="hidden" name="sub_category_ids_csv" id="sub_category_ids_csv" value="{{ $group->sub_category_ids }}">
            </div>
            <div id="selected_subcategory_tags" class="mt-2 d-flex flex-wrap gap-1"></div>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            @if ($group->created_by === 'Admin')
                <input type="hidden" name="status" value="{{ $group->status }}">
                <select class="custom-select w-100 form-control" disabled>
                    <option value="1" {{ $group->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $group->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            @else
                <select class="custom-select w-100 form-control" name="status" id="status" required>
                    <option value="1" {{ $group->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $group->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            @endif
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
                    $('.group-cat').each(function() {
                        const catId = $(this).data('category-id');
                        const allSubs = $(`.sub-cat[data-category-id="${catId}"]`);
                        const checkedSubs = allSubs.filter(':checked');
                        $(this).prop('checked', allSubs.length > 0 && checkedSubs.length === allSubs.length);
                    });
                }

                function renderSelections() {
                    const $inputs = $('#selected_subcategory_inputs');
                    const $tags = $('#selected_subcategory_tags');
                    $inputs.empty();
                    $tags.empty();
                    $inputs.append('<input type="hidden" name="sub_category_ids_csv" id="sub_category_ids_csv" value="">');

                    const subIds = new Set();
                    $('.sub-cat:checked').each(function() {
                        const mainName = $(this).data('main-name');
                        const categoryName = $(this).data('category-name');
                        const subName = $(this).data('sub-name');
                        const subId = $(this).data('sub-id');
                        
                        subIds.add(subId);
                        $tags.append(`<span class="badge bg-light text-dark border">${mainName} &rarr; ${categoryName} &rarr; ${subName}</span>`);
                    });

                    $('#sub_category_ids_csv').val(Array.from(subIds).join(','));
                }

                $(document).on('change', '.group-cat', function() {
                    const catId = $(this).data('category-id');
                    const checked = $(this).is(':checked');
                    $(`.sub-cat[data-category-id="${catId}"]`).prop('checked', checked);
                    syncParentStates();
                    renderSelections();
                    updateSelectAllState();
                });

                $(document).on('change', '.sub-cat', function() {
                    syncParentStates();
                    renderSelections();
                    updateSelectAllState();
                });

                $('#selectAllCategories').on('change', function() {
                    const isChecked = $(this).is(':checked');
                    $('.group-cat').prop('checked', isChecked);
                    $('.sub-cat').prop('checked', isChecked);
                    syncParentStates();
                    renderSelections();
                });

                function updateSelectAllState() {
                    const totalSubs = $('.sub-cat').length;
                    const checkedSubs = $('.sub-cat:checked').length;
                    $('#selectAllCategories').prop('checked', totalSubs > 0 && totalSubs === checkedSubs);
                }

                syncParentStates();
                renderSelections();
                updateSelectAllState();
            });
        </script>


@endsection