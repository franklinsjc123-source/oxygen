@extends('layout.auth.master')
@section('contents')
    @include('paritials.js.product.attribute-js')
    @include('paritials.css.product.attribute-css')
    @include('paritials.auth.header')

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
        <style type="text/css">
            .read-more-show{
              cursor:pointer;
              color: #ed8323;
            }
            .read-more-hide{
              cursor:pointer;
              color: #ed8323;
            }
        
            .hide_content{
              display: none;
            }
            .more{
              display: none;
            }
        </style>

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Attributes Listings

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i data-feather="home"></i></a>
                                </li>
                                <li class="breadcrumb-item active">Attributes Listings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid ">

                <div class="row">

                    <div class="col-sm-12">

                        <div class="card">


                            <div class="card-body">

                                <div class="datatable-dashv1-list custom-datatable-overright">

                                    <table class="table" id="table" data-click-to-select="true" data-sort-name="id"
                                        data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true"
                                        data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="true"
                                        data-key-events="true" data-show-columns="true" data-resizable="true" data-cookie="true"
                                        data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                                         <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Reference Name</th>
                                            <th>Attributes</th> 
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id ="tbody">
                                    @php $spc=0; @endphp
                                        @foreach ($groups as $group)
                                        @php
                                        $attr_val = json_decode($group->attribute_values);
                                        $val=($attr_val!='')?implode(',', $attr_val):'';
                                        $spc++; 
                                        @endphp
                                            <tr>
                                                <td>{{str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);  }}</td>
                                                <td>{{ $group->attribute_group_name }}</td>
                                                <td>{{ $group->attribute_group_refname }}</td>
                                                <td>
                                                @php
                                                    $attr_val = json_decode($group->attribute_values);
                                                    if($attr_val!='')
                                                    {
                                                        $i=1;
                                                        $nspc=count($attr_val);
                                                        echo '<p>';
                                                        foreach ($attr_val as $key => $value) {
                                                            if($i==4) 
                                                            {
                                                                echo '<span id="dots'.$spc.'">...</span><span id="more'.$spc.'" class="more">';
                                                            } 
                                                            echo "<span class='p-1 border border-dark px-3 mx-1 rounded'>$value</span>";
                                                            
                                                            $i++;
                                                        }
                                                        
                                                        if($nspc>3)
                                                        {
                                                            echo '</span></p><button onclick="readmore('.$spc.')" id="myBtn'.$spc.'">+ more</button> '; 
                                                        }
                                                        else {
                                                            echo '</p>';
                                                        }
                                                    }
                                                @endphp
                                                </td>
                                                <td>{{ $group->status }}</td>
                                                <td>
                                                    <input type="hidden" id="attributes_val{{ $group->id }}" value="{{ $val }}">

                                                    <a href="{{ route('vendorattribute.master.edit', $group->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>

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

    {{-- Edit Attribute Values Modal --}}
    <div class="modal fade fcolor" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Update Attributes</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <form class="" method="post" action="{{ route('vendor_update_attributevalues') }}"             
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
                            <button class="btn btn-primary" type="submit">Update</button>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    <script>
    function readmore(id) {
      var dots = document.getElementById("dots"+id);
      var moreText = document.getElementById("more"+id);
      var btnText = document.getElementById("myBtn"+id);
    
      if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "+ more"; 
        moreText.style.display = "none";
      } else {
        dots.style.display = "none";
        btnText.innerHTML = "+ less"; 
        moreText.style.display = "inline";
      }
    }
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
                splitResult = ['', '', ''];
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
    })();
    </script>
@endsection
