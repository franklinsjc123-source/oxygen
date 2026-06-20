@extends('layout.auth.master')
@section('contents')

    @include('paritials.css.product.attribute-css')



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
                                <h3>List Specification 
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">List Specification  </li>
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
                                
                          <a href="{{ route('specification_groups.admin.create') }}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Specification  </a> 
                         

                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
                    <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                         data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                         <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Reference Name</th>
               
                
                <th>Specifications</th> 
                <th>Created By</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @php $spc=0; @endphp
            @foreach ($groups as $group)
            @php
            $attr_val = json_decode($group->specification_values);
            $val=($attr_val!='')?implode(',', $attr_val):'';
            $spc++; 
            @endphp
                <tr>
                    <td>{{str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);  }}</td>
                    <td>{{ $group->specification_group_name }}</td>
                    <td>{{ $group->specification_group_refname }}</td>
                    <td>
                    @php
                        $attr_val = json_decode($group->specification_values) ?? [];
                    @endphp
                    @if(!empty($attr_val))
                        @php
                            $display_vals = array_slice($attr_val, 0, 3);
                        @endphp
                        @foreach($display_vals as $val)
                            <span class="p-1 border border-dark px-3 mx-1 rounded">{{ $val }}</span>
                        @endforeach
                        @if(count($attr_val) > 3)
                            <span>...</span>
                            <button type="button" class="btn btn-xs btn-secondary show-all-values-btn" 
                                    data-name="{{ $group->specification_group_name }}" 
                                    data-values="{{ json_encode($attr_val) }}" 
                                    style="padding: 2px 6px; font-size: 11px; margin-left: 5px; background-color: #13c9ca; border-color: #13c9ca; color: white; font-weight: bold;">
                                + MORE
                            </button>
                        @endif
                    @endif
                    </td>
                    <td>
                        @if ($group->created_by == 'Vendor')
                            <span class="badge badge-warning" style="background-color: #ff9f43 !important; color: white;">{{ $group->vendor_name ?? 'Vendor' }}</span>
                        @else
                            <span class="badge badge-success">Admin</span>
                        @endif
                    </td>
                    <td>
                        <label class="switch">
                            @if($group->status == 'Active' || $group->status == '1' || $group->status == 1)
                                <input type="checkbox" class="status-toggle" data-id="{{ $group->id }}" checked>
                            @else
                                <input type="checkbox" class="status-toggle" data-id="{{ $group->id }}">
                            @endif
                            <div class="slider round">
                                <span class="on">Active</span>
                                <span class="off">Inactive</span>
                            </div>
                        </label>
                    </td>
                   
                    <td style="white-space: nowrap; width: 1%;">
                        <div style="display: flex; gap: 5px; align-items: center;">
                            <input type="hidden" id="attributes_val{{ $group->id }}" value="{{ $val}}">
                            <button type="button" class="edit_attribute btn btn-secondary" data-bs-toggle="modal" data-original-title="Edit" value="{{$group->id}}" id="edit_attribute" style="margin: 0;"> 
                            <i class="fa fa-plus"></i> Specifications </button>
                            <a href="{{ route('specification_groups.admin.edit', $group->id) }}" class="btn btn-warning btn-sm" title="Edit" style="margin: 0;"><i class="fa fa-edit"></i></a>
                             @if (session()->get('log_type') == 'Admin')
                            {{-- <form action="{{ route('specification_groups.admin.destroy', $group->id) }}" onsubmit="return confirm('Are you sure, you want to delete it?')"method="POST" style="display:inline; margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" style="margin: 0;">X</button>
                            </form> --}}
                            @endif
                        </div>
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
            <!-- Container-fluid Ends-->

        </div>
		{{-- Edit Attribute --}}
        <div class="modal fade fcolor" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Update Specification</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form class="" method="post"   action="{{ url('admin/update_specification') }}"             
                        enctype="multipart/form-data">
                        @csrf
                       

                            <div class="form">
                                <input type="hidden" name="id" id="edit_id"> 
                                
                            <div class="col-md-12">
                                <table class="table addproduct">
                                    <thead class="bordered-darkorange">
                                        <tr role="row">
                                            <th style="width:150px;">Value</th>
                                            <th style="width:150px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="input_fields_wrap" id="display"></tbody>
                                </table>
                            </div>
                            
                    </div>


                    <div class="modal-footer">
                        <button  class="btn btn-primary" type="submit">Update</button></a>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
        {{-- end --}}
        <!-- Modal for viewing all values -->
        <div class="modal fade" id="viewValuesModal" tabindex="-1" role="dialog" aria-labelledby="viewValuesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="viewValuesModalLabel">View Values</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="modalValuesContainer" style="display: flex; flex-wrap: wrap; gap: 8px;"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        $(document).on('click', '.show-all-values-btn', function(e) {
            e.preventDefault();
            var name = $(this).data('name');
            var values = $(this).data('values');
            
            $('#viewValuesModalLabel').text(name + ' Values');
            
            var container = $('#modalValuesContainer');
            container.empty();
            
            if (Array.isArray(values)) {
                values.forEach(function(val) {
                    container.append('<span class="p-1 border border-dark px-3 mx-1 rounded" style="font-size: 14px; background-color: #f8f9fa; display: inline-block; margin-bottom: 5px;">' + $('<div/>').text(val).html() + '</span>');
                });
            }
            
            var modalEl = $('#viewValuesModal');
            if (!modalEl.parent().is('body')) {
                modalEl.appendTo('body');
            }
            modalEl.modal('show');
        });
        </script>

        <script>
             (function () {
                var maxFields = 100;
                var wrapper = $(".input_fields_wrap");

                function getValues() {
                    var values = [];
                    wrapper.find('input[name="value[]"]').each(function () {
                        values.push($(this).val());
                    });
                    return values;
                }

                function renderRows(values) {
                    wrapper.empty();
                    values.forEach(function (item, idx) {
                        var safeValue = $('<div/>').text(item || '').html();
                        var actionHtml = '<a href="#" class="remove"><span class="text-danger fw-bold border p-2">X</span></a>';
                        if (idx === values.length - 1) {
                            actionHtml += '<a href="#" class="btn btn-primary mx-3 add">+ Add More</a>';
                        }
                        wrapper.append('<tr class="attr_row"><td><input name="value[]" class="form-control" value="' + safeValue + '" type="text" placeholder="Enter Value" /></td><td>' + actionHtml + '</td></tr>');
                    });
                }

                $(document).on('click', '.edit_attribute', function (e) {
                    e.preventDefault();
                    var id = $(this).val();
                    $('#edit_id').val(id);
                    $('#exampleModal1').modal('show');

                    var result = ($('#attributes_val' + id).val() || '').trim();
                    var splitResult = result ? result.split(',').filter(function (v) { return v.trim() !== ''; }) : [];
                    if (splitResult.length === 0) {
                        splitResult = [''];
                    }
                    renderRows(splitResult.slice(0, maxFields));
                });

                wrapper.on('click', '.add', function (e) {
                    e.preventDefault();
                    var values = getValues();
                    if (values.length < maxFields) {
                        values.push('');
                        renderRows(values);
                    }
                });

                wrapper.on('click', '.remove', function (e) {
                    e.preventDefault();
                    var rowIndex = $(this).closest('tr').index();
                    var values = getValues();
                    values.splice(rowIndex, 1);
                    if (values.length === 0) {
                        values = [''];
                    }
                    renderRows(values);
                });

                // Status toggle AJAX
                $(document).on('change', '.status-toggle', function() {
                    var groupId = $(this).data('id');
                    var nextStatus = $(this).is(':checked') ? 'Active' : 'De-Active';

                    $.ajax({
                        url: "{{ route('specification_groups.status') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": groupId,
                            "status": nextStatus
                        },
                        dataType: "json",
                        success: function(response) {
                            if (!response.success) {
                                alert('Status update failed.');
                                $(this).prop('checked', !$(this).is(':checked'));
                            }
                        }.bind(this),
                        error: function() {
                            alert('Status update failed.');
                            $(this).prop('checked', !$(this).is(':checked'));
                        }.bind(this)
                    });
                });

             })();
        </script>
@endsection
