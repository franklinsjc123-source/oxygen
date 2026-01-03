@extends('layout.auth.master')
@section('contents')

@include('paritials.js.product.attribute-js')
    @include('paritials.css.product.attribute-css')

    @include('paritials.auth.header')?>

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
                                <h3>List Attribute Group
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">List Attribute Group </li>
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
                                
                          <a href="{{route('attribute_groups.create')}}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Attribute Group </a> 
                         

                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
                    <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
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
        <tbody>
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
                        <input type="hidden" id="attributes_val{{ $group->id }}" value="{{ $val}}">
                    <button type="button" class="edit_attribute btn btn-secondary mx-1" data-bs-toggle="modal" data-original-title="Edit" value="{{$group->id}}" id="edit_attribute"> 
                    <i class="fa fa-plus"></i> Attributes </button>
                    <a href="{{ route('attribute_groups.edit', $group->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        
                        <form action="{{ route('attribute_groups.destroy', $group->id) }}" onsubmit="return confirm('Are you sure, you want to delete it?')"method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">X</button>
                        </form>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Update Attributes</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form class="" method="post"   action="{{ route('update_attributevalues') }}"             
                        enctype="multipart/form-data">
                        @csrf
                       

                            <div class="form">
                                <input type="hidden" name="id" id="edit_id"> 
                                
                            <div class="col-md-12">
                                <table class="table addproduct">
                                    <tbody class="input_fields_wrap" id="display">
                                        <thead class="bordered-darkorange">
                                            <tr role="row">
                                                <th style="width:150px;">Value</th>
                                                <th style="width:150px;"></th>
                                            </tr>
                                        </thead>

                                        
                                        <tr>
                                            <td class="tbl1">
                                                {{-- <input id="editvalue" name="editvalue[]" class="form-control" type="text"
                                                    placeholder="Enter Value" /> --}}
                                            </td>
                                            <td>
                                                <button type="button" class="add_field_button btn btn-xs btn-primary"
                                                    id="add1">Add More</button>
                                            </td>
                                        </tr>
                                    </tbody>
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
             $(document).on('click','.edit_attribute', function(e){
        var editroute1='';
        var htmlPlan='';
    e.preventDefault();
    var id = $(this).val();
    $('#edit_id').val(id);
    //    console.log(pin_id);
    //  alert(id);
    
    $('#exampleModal1').modal('show');
        
    
                     //alert(response.subcategory[0].attribute_name);
                    //  $k = response.subcategory[0].value;
                    //  alert($k);
                    var wrapper         = $(".input_fields_wrap"); //Fields wrapper	
                     result = $('#attributes_val'+id).val();
                     var splitResult = result.split(',');
                     cache: false;
                     var x=1;
                     $(wrapper).html('');
                     splitResult.forEach(function(item) {
                       
                        max_fields = result.length;
                        if(x <= max_fields){ //max input box allowed
                            x++; //text box increment
                            $(wrapper).append('<tr class="attr_row"><td><input id ="value" name="value[]" class="form-control" value ='+item+' type ="text" placeholder="Enter Value" /></td><td><a href="#" id="r'+x+'" class="remove " ><span class="text-danger fw-bold border p-2">X</span></a></td><tr>'); //add input box
                        }

                        });

                    
    
    });
        </script>
@endsection