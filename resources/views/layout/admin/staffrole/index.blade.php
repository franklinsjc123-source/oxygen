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
            <div class="container-fluid" >
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Role Create
                                    <small>oxygen Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Role Create</li>
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
                
                        <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                           
                            <div class="card-body">
							 
<a href="{{ route('staffrole.create') }}"  class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"><i class="fa fa-plus"></i> Add Role</a> 
                                             



								
								<div class="datatable-dashv1-list custom-datatable-overright">

                            
                                <table class="table fcolor" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                                    data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">  
                                    <thead>
                                     <tr>
                                       <th data-field="id" data-sortable="true">Id</th> 
                                        
                                        <th data-field="role" data-sortable="true">Department</th>

                                        <th data-field="description" data-sortable="true">Designation</th>
                                       
									   <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                   
                                            @foreach ($role as $item)
                                            <tr>
                                                <td>{{str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);  }}</td>
                                            
                                            
                                            <td>{{$item->department_name}}</td>

                                            <td>{{$item->designation_name}}</td>
                                            
                                           

                                            <td> 
                                                <span class="mt-3 d-flex">
												<a href="{{ route('staffrole.edit', $item->id) }}" onclick="return confirm('Are you sure, you want to Edit it?')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-edit"></i></a> 
                                             @if (session()->get('log_type') == 'Admin')
                                                 <form
                                                action="{{ route('staffrole.destroy', $item->id) }}"
                                                method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger mx-1"
                                                    onclick="return confirm('Are you sure, you want to delete it?')" title="" data-original-title="Delete"><i
                                                        class="fa fa-trash"></i>
                                                </button>
                                            </form>
											@endif
                                                </span>
                                            </td>                                              
                                            </tr>

                                            @endforeach  
                                    </tbody>
                                </table> </div>
                            </div>
                        </div>
                    </div>
	
			</div>
			</div>
			
		</div>
		</div></div>
		
		</div>
		</div>	

    @endsection

    @push('scripts')
    <script>

           
    $(document).on('click','#editroll', function(e){
        var editroute1='';
        var htmlPlan='';
    e.preventDefault();
    var id = $(this).val();
        console.log( id);
    $('#exampleModal1').modal('show');

    var url ="{{route('roll.edit', ":id")}}";

    url = url.replace(":id", id);
    //console.log (url);
    $.ajax({
        //   data: $('').serialize(),  {{ url('admin/pincode1') }}/"+pin_id+"/edit"
          url: url,          
          type: "get",
          dataType: 'json',
          success: function (response) {
              // console.log(response);
             //alert('response');
                if(response.status == 404)
                {
                // alert('test');
                $('successmessage').html('');
                $('successmessage').addClass('alert alert-danger');
                $('successmessage').text(response.message);
                }
                else{
                    
                    console.log(response);
                    //alert(response);
                    $('#role_id').val(response.roll.id);
                    $('#editrole').val(response.roll.roll);
                    $('#editdescription').val(response.roll.description);
                    //$("#editpermission[1]").prop("checked", "1");
                    var permission        =   (response.roll.permission_id);
                     let per     =  JSON.parse(permission);                   
                    
                         //$("#editpermission1").prop("checked", true);

                   // $('#editpermission[3]').val(3).prop("checked", true);
                    //const test = {a: 1, b: 2, c: 3};
                    $('.permissionselect').prop('checked', false);

                    for (const [key, value] of Object.entries(per)) {                 
                   let chech = $('#editpermission'+key+'').prop('checked', true);
                   }
                    // $('#editstatus').val(response.editdepartment.status);
                }  
            }
        
      });
    });


    $(document).on('click','#update_btn', function(e){
       //alert('test');

         e.preventDefault(e);
    var id = $('#role_id').val();
     //alert(id);


    
     var roll = $('#editrole').val();
     var description = $('#editdescription').val();  
     var permission_id = $('#editpermission').val();   
    
    var url ="{{route('roll.update', ":id")}}";

        url = url.replace(":id", id);
   

    $.ajax({
        //   data: $('').serialize(),    {{ url('admin/zonalupdate') }}/"+id+"/update"
             // url: "{{ url('admin/zonalupdate') }}/"+updateid,
              //console.log(id);
            url: url,          
          type: "put",   
          data: {
            _token: "scrf",
            roll:roll,
            description:description,
            permission_id:permission_id

          },     
         dataType: "json",
          success: function (response) {
               console.log(response);
                alert(response);
               $('#exampleModal1').modal('hide');
               //location.reload();   
                
         
            }
        
      });
    });
    $('#role').on('change', function() {
        //alert(1);
                let department = $(this).val();
             
                let url = `{{ route('getstaffdepartment') }}?department=`+ department;
                let method = 'GET';
                getAjaxValue(url, method, function(data) {
                    $('#designation').empty();
					//alert(data);
                    $.each(data, function(key, category) {

                        $('#designation').append(
                            `<option value="${category.id}" selected>${category.designation}</option>`
                        );
                    });
                });
            });

</script>
    @endpush