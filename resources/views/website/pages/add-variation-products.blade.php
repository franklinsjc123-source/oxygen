{{-- <?php include('header.php') ?> --}}
@extends('website.layouts.master')
<style>
    .dropdown {
        /*container for custom dropdown arrow*/
        -webkit-appearance: none;
        -moz-appearance: window;

        background-image: url("https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png");
        background-repeat: no-repeat;
        background-position: right center;
    }
</style>
<!-- page-wrapper Start-->

@include('website.pages.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">

    <!-- Page Sidebar Start-->
    
    @include('website.pages.sidemenu')
    <!-- Page Sidebar Ends-->

    <!-- Right sidebar Start-->

    <!-- Right sidebar Ends-->
@section('coontent')
    <div class="page-body">

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Add Product

                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">


            <form action="">
                @csrf
                <div class="row product-adding">
                    <div class="row">
                        <div class="col-md-9">


                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>General</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5> Primary Categories</h5>

                                                        <div class="form-group">

                                                            <select class="js-select2 form-control">
                                                                <option selected disabled>Select Here</option>
                                                                <option value="Clothing & Accessories" data-badge="">Clothing & Accessories</option>
                                                                <option value="Beauty" data-badge="">Beauty</option>
                                                                <option value="Fashion" data-badge="">Fashion</option>
                                                                <option value="Electronics" data-badge="">Electronics</option>


                                                            </select>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5> Categories</h5>
                                                        <select class="js-select2 form-control">
                                                            <option selected disabled>Select Here</option>
                                                            <option value="Clothing & Accessories" data-badge="">Clothing & Accessories</option>
                                                            <option value="Beauty" data-badge="">Beauty</option>
                                                            <option value="Fashion" data-badge="">Fashion</option>
                                                            <option value="Electronics" data-badge="">Electronics</option>


                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5> Sub Categories</h5>
                                                        <select class="js-select2 form-control">
                                                            <option selected disabled>Select Here</option>
                                                            <option value="men" data-badge="">MEN</option>
                                                            <option value="women" data-badge="">WOMEN</option>



                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="digital-add needs-validation">


                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Item Name</label>
                                                <input class="form-control" id="validationCustom01" type="text" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Brand Name</label>
                                                <input class="form-control" id="validationCustom01" type="text" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0">Manufacture Part Number</label>
                                                <input class="form-control" id="validationCustom01" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustomtitle" class="col-form-label pt-0"> SKU</label>
                                                <input class="form-control" id="validationCustomtitle" type="text">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Short Description</label>
                                                <textarea rows="2" cols="5"></textarea>
                                            </div>

                                            <div class="col-xl-12">
                                            <label class="col-form-label col-md-3"><span>*</span>GST</label>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <form id="mainForm" name="mainForm" class="d-flex justify-content-around">
                                                            @csrf
                                                            <input type="radio" name="gst" value="include" onchange="return dis1()" checked />Include
                                                            <input type="radio" name="gst" value="exclude" onchange="return dis2()" />Exclude

                                                        </form>
                                                    </div>
                                                    <div class="col-md-7">

                                                        <select class="custom-select form-control dropdown" id="gst1" onchange="return r()" required>
                                                            <option value="">--Select Gst--</option>
                                                            <option value="5">5%</option>
                                                            <option value="12">12%</option>
                                                            <option value="18">18%</option>
                                                            <option value="24">24%</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                            <div class="col-md-12">

                                                <div class="row">


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <h5> Procut Variation</h5>
                                            <table class="table addproduct">
                                                <thead class="bordered-darkorange">
                                                    <tr role="row">
                                                        <th style="width:30px;">S.NO</th>
                                                        <th style="width:150px; text-align:center;"> Color </th>
                                                        <th style="width:300px; text-align:center;"> Size </th>
                                                        <th style=" width:80px; text-align:center;">Price(₹)</th>
                                                        <th style=" width:30px; text-align:center;">Quantity</th>
                                                        <th style=" width:100px; text-align:center;">Image</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <td>1</td>

                                                    </td>
                                                    <td>

                                                    <div class="row" name="color[]">
                                                    <select class="js-select2 form-control">
                                               <option value="O1" data-badge="">Red</option>
                                               <option value="O2" data-badge="">White</option>
                                               <option value="O3" data-badge="">Yellow</option>
                                               <option value="O4" data-badge="">Muticolor</option>
                                           </select>
                                        </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="row" name="size_type[]">
                                                            <select class="js-select2 form-control">
                                                                <option value="O1" data-badge="">S</option>
                                                                <option value="O2" data-badge="">M</option>
                                                                <option value="O3" data-badge="">L</option>
                                                                <option value="O4" data-badge="">XL</option>
                                                                <option value="O5" data-badge="">XXL</option>
                                                                <option value="O6" data-badge="">XXXL</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    <td><input type="text" id="price" name="price[]" class="form-control" placeholder="" required /></td>
                                    <td><input type="text" id="qty" name="qty[]" class="form-control" placeholder="" required /></td>

                                    <td>
                                        <input type="file" id="myfile" name="myfile">


                                    </td>


                                    </tr>
                                    </table>
</br>
<div class="col-md-3">
    <button type="button" class='addmore btn btn-xs btn-primary '>+ Add More</button>
</div>
</br></br>


</div>
</div>
</div>
</div>

<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h5>Add Description</h5>
        </div>
        <div class="card-body">
            <div class="digital-add needs-validation">
                <div class="form-group mb-0">
                    <div class="description-sm">
                        <textarea id="editor1" name="editor1" cols="10" rows="4"></textarea>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<div class="col-md-3">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <h5> status</h5>
                    <select class="custom-select form-control" required>

                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                        <option value="2">Pending</option>

                    </select>
                </div>
            </div>
        </div>

    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>Meta Data</h5>
            </div>
            <div class="card-body">
                <div class="digital-add needs-validation">
                    <div class="form-group">
                        <label for="validationCustom05" class="col-form-label pt-0"> Meta Title</label>
                        <input class="form-control" id="validationCustom05" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Meta Description</label>
                        <textarea rows="2" cols="12"></textarea>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Shipping</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <h5> Shipping</h5>

                                        <div class="col-md-12 col-md-12">

                                            <div class="form-group mb-3">
                                                <label>Weight (g)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="weight" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Length (cm)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="length" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Wide (cm)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="wide" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Height (cm)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="height" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                                        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <h5> Product Collection</h5>
                        <div class="row">
                            <div class="col">
                                <label class="d-block" for="chk-ani">
                                    <input class="checkbox_animated" id="chk-ani" type="checkbox">
                                    New Arrival
                                </label>
                                <label class="d-block" for="chk-ani1">
                                    <input class="checkbox_animated" id="chk-ani1" type="checkbox">
                                    Best Seller
                                </label>
                                <label class="d-block" for="chk-ani2">
                                    <input class="checkbox_animated" id="chk-ani2" type="checkbox">
                                    Special Offer
                                </label>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <a href="product_listing.php" onclick="return confirm('Are you sure, you want to Save it?')"> <button class="btn btn-primary" type="button">Save</button></a>
                        <button class="btn btn-secondary" type="button">Close</button>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
</div>
</div>
</form>

<!-- Container-fluid Ends-->

</div>


<!-- latest jquery-->
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script>
    jQuery(function() {
        var counter = 1;
        var rowCount = 1;
        jQuery('button.addmore').click(function(event) {
            event.preventDefault();
            rowCount++;
            var newRow = jQuery('<tr id="prowCount' + rowCount + '"><td>' + rowCount + '</td><td><div class="form-group"><div class="row"><div class="col"><div class="row" name="color_type[]"><select class="js-select2 form-control"><option value="O1" data-badge="">Red</option><option value="O2" data-badge="">White</option><option value="O3" data-badge="">Black</option><option value="O4" data-badge="">Yellow</option><option value="O5" data-badge="">Blue</option><option value="O6" data-badge="">Light Green</option></select></div></div></div></div></div></td><td><div class="form-group"><div class="row"><div class="col"><div class="row" name="size_type[]"><select class="js-select2 form-control"><option value="O1" data-badge="">S</option><option value="O2" data-badge="">M</option><option value="O3" data-badge="">L</option><option value="O4" data-badge="">XL</option><option value="O5" data-badge="">XXL</option><option value="O6" data-badge="">XXXL</option></select></div></div></div></div></div></td><td><input type="text" id="price' + rowCount + '" name="price[]"  class="form-control" placeholder="Price"required/></td><td><input type="text" id="qty' + rowCount + '" name="qty[]"  class="form-control" placeholder="Qty"required/></td><td> <input type="file" id="myfile" name="myfile"></td><td class="r1" style="width:10px;" ><button type="button" class="btn btn-xs btn-warning" onclick="removeRow3(' + rowCount + ');">x</button></td></tr>');
            counter++;
            jQuery('table.addproduct').append(newRow);
            $("#total_products").val(rowCount);

        });

    });

    function b(id) {
        //var b= document.getElementById("id").value;
        alert(id);


        alert(c);
        var c = document.getElementById("id");

        if (b == "Red") {
            c.style.backgroundColor = "#ff0000";
        } else if (b == "Blue") {
            c.style.backgroundColor = "#0000ff";
            c.style.color = "white";
        }
        /*else if(a == "Marron")
        {
        	b.style.backgroundColor = "#800000";
        	b.style.color="white";
        }
        else if(a == "White")
        {
        	b.style.backgroundColor = "#FFFFFF";
        	b.style.color="#000000";
        }
        else if(a == "Black")
        {
        	b.style.backgroundColor = "#000000";
        	b.style.color="white";
        }
        
        else if(a == "Pink")
        {
        	b.style.backgroundColor = "#ffc0cb";
        	b.style.color="#000000";
        }
        else if(a == "Purple")
        {
        	b.style.backgroundColor = "#800080";
        	b.style.color="white";
        }
        else if(a == "Violet")
        {
        	b.style.backgroundColor = "#ee82ee";
        	b.style.color="white";
        }
        else if(a == "Gold")
        {
        	b.style.backgroundColor = "#ffd700";
        	b.style.color="white";
        }
        
        else if(a == "Grey")
        {
        	b.style.backgroundColor = "#808080";
        	b.style.color="white";
        }
        
        else if(a == "Orange")
        {
        	b.style.backgroundColor = "#ffa500";
        	b.style.color="white";
        }
        else if(a == "Yellow")
        {
        	b.style.backgroundColor = "#ffff00";
        	b.style.color="white";
        }
        else if(a == "Brown")
        {
        	b.style.backgroundColor = "#a52a2a";
        	b.style.color="white";
        }
        else if(a == "Aqua")
        {
        	b.style.backgroundColor = "#00ffff";
        	b.style.color="white";
        }
        else if(a == "Lavender")
        {
        	b.style.backgroundColor = "#e6e6fa";
        	b.style.color="white";
        }
        else if(a == "Sandal")
        {
        	b.style.backgroundColor = "#A89166";
        	b.style.color="white";
        }
        else if(a == "Megenta")
        {
        	b.style.backgroundColor = "#FF00FF";
        	b.style.color="white";
        }
        else if(a == "Green")
        {
        	b.style.backgroundColor = "#008000";
        	b.style.color="white";
        }
        else if(a == "Chocolate")
        {
        	b.style.backgroundColor = "#D2691E";
        	b.style.color="white";
        }
        else if(a == "DarkGray")
        {
        	b.style.backgroundColor = "#A9A9A9";
        	b.style.color="white";
        } */
    }
</script>

<script type="text/javascript">
    var rowCount = 1;

    function removeRow3(removeNum) {
        jQuery('#prowCount' + removeNum).remove();
        var tot_product = $("#total_products").val();

        var tot_amt = 0;
        for (var i = 1; i <= tot_product; i++) {
            var pamt = parseFloat($("#amount" + i).val());
            if (parseFloat(pamt) < 0 || isNaN(parseFloat(pamt)))
                pamt = 0;
            tot_amt += pamt;
        }
        //alert(tot_amt);
        $("#tot_amount").val(tot_amt.toFixed(2));
        var discount = $("#discount").val();
        var grand_total = parseFloat(tot_amt) - parseFloat(discount);

        $("#grand_total").val(grand_total.toFixed(2));
        $("#invoice_paidamount").val(grand_total.toFixed(2));

    }
</script>
<!-- Bootstrap js-->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/touchspin/touchspin.js"></script>
<script src="../assets/js/touchspin/input-groups.min.js"></script>

<!-- form validation js-->
<script src="../assets/js/dashboard/form-validation-custom.js"></script>

<!-- ckeditor js-->
<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>

<!--dropzone js-->
<script src="../assets/js/dropzone/dropzone.js"></script>
<script src="../assets/js/dropzone/dropzone-script.js"></script>

<!--ckeditor js-->
<script src="../assets/js/editor/ckeditor/ckeditor.js"></script>
<script src="../assets/js/editor/ckeditor/styles.js"></script>
<script src="../assets/js/editor/ckeditor/adapters/jquery.js"></script>
<script src="../assets/js/editor/ckeditor/ckeditor.custom.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>
<script src="../assets/js/admin-script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script>
    $(".js-select2").select2({
        closeOnSelect: true,
        placeholder: '--Select--',
        allowHtml: false,
        allowClear: true,
        tags: false // создает новые опции на лету
    });
</script>
@endsection