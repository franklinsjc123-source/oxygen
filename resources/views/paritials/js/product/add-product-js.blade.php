<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#specify_show").click(function() {
            $("#display").slideDown(1000);
            document.getElementById("specify_length").innerHTML = "";
        });

        $("#specify_hide").click(function() {
            $("#display").slideUp(1000);
            var length = document.getElementsByClassName('spcify_row').length;
            let total = length + 1;
            document.getElementById("specify_length").innerHTML = length + " Out of " + total;
        });

    });
</script>
<script>
    $(document).ready(function() {
        $("#show").click(function() {
            $("#tab").slideDown(1000);
            document.getElementById("length").innerHTML = "";
        });

        $("#hide").click(function() {
            $("#tab").slideUp(1000);
            var length = document.getElementsByClassName('rl').length;
            let total = length + 1;
            document.getElementById("length").innerHTML = length + " Out of " + total;
        });

    });
</script>

<script>
    $(document).ready(function() {
        $("#select_product").change(function() {
            if ($("#select_product").val() == 'single') {
                $("p2").hide();

            } else if ($("#select_product").val() == 'multiple') {

                $("p1").hide();

            }

        });

    });
</script>

<script>
    $(document).ready(function() {
        $('#sub').click(function() {
            var x = document.getElementById("im1").src;
            //var y=document.getElementById("a1").src
            //var z=document.getElementById("a3").src
            //const g = [x,y];
            document.getElementById("uplfile").value = x;
            var onimg = document.getElementById("online_img");
            onimg.src = x;
            onimg.style.display = "block";

            alert(x);
        });
    });

    $(document).ready(function() {
        var max_fields = 100; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<tr><td>' + x +
                    '</td><td>  <select class="js-select2 form-control" onchange="colorn(this)" id="n' +
                    x + '" name="mycolor2[' + x +
                    ']" ><option value="red" data-badge="">Red</option><option value="white" data-badge="">White</option><option value="yellow" data-badge="">Yellow</option><option value="green" data-badge="">green</option></select><input type ="color" id ="mycolor2[' +
                    x +
                    ']" name="color[]" value="#ff0000" /></td>&nbsp &nbsp</td><select class="js-select2 form-control"><option value="O1" data-badge="">Red</option><option value="O2" data-badge="">White</option><option value="O3" data-badge="">Black</option><option value="O4" data-badge="">Yellow</option><option value="O5" data-badge="">Blue</option><option value="O6" data-badge="">Light Green</option></select></div></div></div></div></div></td><td><div class="form-group"><div class="row"><div class="col"><div class="row" name="size_type[]"><select class="js-select2 form-control"><option value="O1" data-badge="">S</option><option value="O2" data-badge="">M</option><option value="O3" data-badge="">L</option><option value="O4" data-badge="">XL</option><option value="O5" data-badge="">XXL</option><option value="O6" data-badge="">XXXL</option></select></div></div></div></div></div></td><td><input type="text" id="price' +
                    x +
                    '" name="price[]"  class="form-control" placeholder="Price"required/></td><td><input type="text" id="qty' +
                    x +
                    '" name="qty[]"  class="form-control" placeholder="Qty"required/></td><td> <input type="file" class="form-control " id="upload' +
                    x + '" name="file' + x + '" onchange="m_image(this)" /><br><img id="file' + x +
                    '" style="width:30%"></td><td class="r1" style="width:10px;" ><a href="#" class="remove_field " ><button type="button" class="btn btn-xs btn-" style="background-Color:red;" onclick="removeRow3(' +
                    x + ');">x</button></a></td><tr>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('tr').remove();;
            x--;
        })
    });
</script>



<script>
    function m_image(im) {

        var total = im.files.length;
        var image = document.getElementById("file2");
        alert(total);
        alert(im.name);
        for (var i = 0; i < total; i++) {

            var img = URL.createObjectURL(event.target.files[i]);
            image.src = img;
            alert(img);
        }
    }


    function s() {
        var img = document.getElementsByName('multi_img[]');
        alert(img.length);
        for (var i = 0; i < img.length; i++) {
            var a = img[i].src;

            document.getElementById("par").src = a;
        }


    }


    function color() {
        var col = document.getElementById("color").value;
        var c = document.getElementById("col");
        //alert(color);
        var color = convert(col);

        if (color != false) {
            alert(color);

            c.value = color;
            //s.innerHTML="<p>red</p>";
        }

    }



    $(document).ready(function() {
        $('#sub').click(function() {
            var x = document.getElementById("im1").src;
            //var y=document.getElementById("a1").src
            //var z=document.getElementById("a3").src
            //const g = [x,y];
            document.getElementById("uplfile").value = x;
            var onimg = document.getElementById("online_img");
            onimg.src = x;
            onimg.style.display = "block";

            alert(x);
        });
    });


    function r1() {
        var c = document.getElementById("gst2").value;


        var i1 = document.getElementById("i1");
        var i2 = document.getElementById("i2").value;
        var i3 = document.getElementById("i3");
        var i4 = document.getElementById("i4");
        var i5 = document.getElementById("i5");

        var gst = document.querySelector('input[name = gst1]:checked').value;



        if (gst == "include") {
            if (c == "") {
                alert("select GST");
            }
            if (c == c) {

                var price = i2 * 1;
                var p = c / 100;
                var g = "0." + c;
                var p1 = i2 * g;
                var tot_price = price - (price * p);
                //v2.value=c;
                // alert(g);
                i4.value = p1;
                i5.value = tot_price;

            }


        } else if (gst == "exclude") {

            if (c == "") {
                alert("select GST");
            }
            if (c == c) {
                var price = i2 * 1;
                var g = "0." + c;
                var p = price * g;
                var tot_price = price + p;
                //v2.value=c;
                i4.value = p;
                i5.value = tot_price;

            }


        }

    }

    function r() {
        var c = document.getElementById("gst1").value;
        var gst = document.getElementById("gs").value;
        //alert(gst);				

        var i1 = document.getElementById("in1");
        var i2 = document.getElementById("in2").value;
        var i3 = document.getElementById("in3");
        var i4 = document.getElementById("in4");
        var i5 = document.getElementById("in5");

        // var gst = document.querySelector('input[name = gst]:checked').value;
        //alert(gst);		


        if (gst == "include") {
            if (c == "") {
                alert("select GST");
            }
            if (c == c) {

                var price = i2 * 1;
                var p = c / 100;
                var g = "0." + c;
                var p1 = i2 * g;
                var tot_price = price - (price * p);
                //v2.value=c;
                // alert(g);
                i4.value = p1;
                i5.value = tot_price + p1;

            }


        } else if (gst == "exclude") {

            if (c == "") {
                alert("select GST");
            }
            if (c == c) {
                var price = i2 * 1;
                var g = "0." + c;
                var p = price * g;
                var tot_price = price + p;
                //v2.value=c;
                i4.value = p;
                i5.value = tot_price;

            }


        }

    }
</script>
<script>
$(document).ready(function() {
    $(".add-more").click(function(){ 
        var html = $("#product_details").html();
        $(".more-products").append(html);        
    });
	});
	 $("body").on("click",".remove",function(){ 
        $(this).parents("#product_details").remove();
    });
</script>

<!-- latest jquery-->
<script>
    jQuery(function() {
        var counter = 1;
        var rowCount = 1;
        jQuery('button.addmore').click(function(event) {
            event.preventDefault();
            rowCount++;
            var newRow = jQuery('<tr id="prowCount' + rowCount + '"><td>' + rowCount +
                '</td><td><input type="text" id="" name="particulars[]"  class="form-control" placeholder=""required/></td><td><input type="text" id="quantity1" name="quantity[]" class="form-control" placeholder=""  value="1" required /></td><td><input type="text" id="size' +
                rowCount + '" name="size[]" onkeyup="calc_amount(' + rowCount +
                ')" class="form-control" placeholder="" required /></td><td><select style="font-size:14px;width: 100px;" name="size_type[]"><option value="feed">Feet</option><option value="Sqft">SquareFeet</option><option value="kg">KG</option><option value="No`s">No`s</option></select></td><td><input type="text" id="rate' +
                rowCount + '" name="rate[]"  onkeyup="calc_amount(' + rowCount +
                ')" class="form-control" placeholder=""required/></td><td><select style="font-size:14px;width: 100px;" name="rate_type[]"><option value="feed">Feet</option><option value="Sqft">SquareFeet</option><option value="kg">KG</option><option value="No`s">No`s</option></select></td><td><input type="text" id="amount' +
                rowCount +
                '" name="amount[]"  class="form-control" placeholder=""required/></td><td class="r1" style="width:10px;" ><button type="button" class="btn btn-xs btn-danger" onclick="removeRow3(' +
                rowCount + ');">x</button></td></tr>');
            counter++;
            jQuery('table.addproduct').append(newRow);
            $("#total_products").val(rowCount);

        });

    });
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

    $(".js-select2").select2({
        closeOnSelect: true,
        placeholder: '--Select--',
        allowHtml: false,
        allowClear: true,
        tags: false // создает новые опции на лет
    });
</script>
<script type="text/javascript">
    function ShowHideDiv() {
        var specify = document.getElementById("specify");

        var ddlPassport = document.getElementById("ddlPassport");
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = ddlPassport.value == "size" ? "block" : "none";
        dvPassport1.style.display = ddlPassport.value == "color" ? "block" : "none";
        dvPassport2.style.display = specify.value == "material" ? "block" : "none";
        dvPassport3.style.display = specify.value == "style" ? "block" : "none";


        /*	 document.getElementById('s').value="";
        	document.getElementById('c').value="";
        	document.getElementById('m').value="";
        	document.getElementById('s').value="";
        	
        	var inp = document.getElementById('att');
        			inp.value="";
        */
    }

    /*function appen(m)
    		{
    		
    			$('#append').append('<div id="d"><input type="text" id="'+m.id+'" class="form-control" name="'+m.id+'" placeholder="Add Value" onkeypress="appen(this)" /> <spanlass="h1 text-danger"  onclick="remove(this)"> x </span></div><br>');
    		}	*/
    function remove(e) {
        $(this).closest('div').remove();
    }

    function appen(a) {
        var max_fields = 100; //maximum input boxes allowed
        var wrapper = $("#append"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count



        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div><div class="row mt-2 "><div class="col-md-9"> <input type="text" id="att" class="form-control"  name="' +
                a.id +
                '" /></div><div class="col-md-3 	remove_field"><a href="#" class=" " ><button type="button" class="btn btn-danger" style="background-Color:red;" >x</button></a></div></div></div>'
            ); //add input box
        }


        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();;
            x--;
        });

    }

    let x = 0;

    function addProductDetails() {
        //document.getElementById('tab').innerHTML="";
        var max_fields = 100;

        if (x < max_fields) { //max input box allowed

            x++;

            let productDetails =
                `<div class="row rl" id="img${x}">
                    <div class="col-md-12">
                        <hr class="text-secondary p-0">
                    </div>
                <div class="col-md-1">
                    <label class="text-center border text-dark p-3">
                        <span class="">Add<br> Product <br>Image</span> 
                        <input type="file"  style="display:none" onchange="img(this)"  id="img${x}" name="product_detail_image[${x}]" multiple>
                    </label>
                    </div>

                    <div class="col-md-2">
                        <select class="form-select form-select-lg mt-2 text-secondary" name="color[${x}]"> 
                            <option value="">Select</option><option selected disabled>--Select Color--</option>
                            <option value="Red">Red</option><option value="Green">Green</option>
                            <option value="Blue">Blue</option>
                        </select><input type="text" name="sku[${x}]" placeholder="SKU" class="form-control mt-4">
                    </div>

                    <div class="col-md-2">
                        <select class="form-select form-select-lg mt-2 text-secondary" name="size[${x}]"> 
                            <option selected disabled class="">--Select Size--</option>
                            <option value="S">S</option><option value="M">M</option>
                            <option value="L">L</option><option value="XL">XL</option>
                            <option value="XXL">XXL</option><option value="3XL">3XL </option>
                            <option value="3XL">4XL </option><option value="3XL">5XL</option>
                        </select>
                        <select class="form-select form-select-lg mt-4 text-secondary" name="return_replace[${x}]"> 
                            <option selected hidden class="">Return / Replacement</option>
                            <option value="1">Return</option>
                            <option value="2">Replacement</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="number" class="form-control mt-1" placeholder="Qty" name="quantity[${x}]">
                        <input type="text" name="r_days[${x}]" placeholder="Days" class="form-control mt-4">
                    </div>
                    
                    <div class="col-md-2">
                        <input type="text" name="retail_price[${x}]" placeholder="Retail Price" class="form-control">
                        <input type="number" name="low_stock_limit[${x}]" placeholder="Low Stock Limit" class="form-control mt-4">
                    </div>

                    <div class="col-md-2"><input type="text" name="selling_price[${x}]" placeholder="Selling Price" class="form-control">
                        <input type="text" name="threshold[${x}]" placeholder="Threshold" class="form-control mt-4">
                    </div>
                    
                    <div class="col-md-1">
                        <button type="button" class="btn border fw-bold text-danger mt-4 remove" onclick="rm(this)" name="x${x}" id="rx${x}">x</button>
                    </div>
                    
                    <div class="p-2 "></div>
                    <div class="col-md-12">
                        <span id="img${x}"  width="20%" class="" /></span>
                        <button class="btn btn-sm btn-danger mx-2 border text-danger remove" onclick="rmimg(this)" id="rim${x}" name="img${x}">
                            remove
                        </button>
                    </div>
                </div>`;

            $('#tab').append(productDetails);
        };


        var r = x - 1;
        document.getElementById("rx" + r).style.display = "none";
    }


    /*else{
    	document.getElementById("err").innerHTML="<p class='alert alert-danger fw-bold text-center mb-2' >Please Enter Attribute Size and Color</p>";
    } */
    function rmimg(img) {
        document.getElementById(img.name).innerHTML = "";
        document.getElementById(img.id).style.visibility = "hidden";

    }

    function mainimg() {
        document.getElementById("rim").style.visibility = "hidden";
        document.getElementById("img").innerHTML = "";
    }

    function rm(a) {

        document.getElementById(a.name).remove();
        x--;

        document.getElementById("rx" + x).style.display = "block";
        if (x == 0) {
            document.getElementById("dis").style.display = "none";
        }
    }




    function patch(b) {
        var s = document.getElementById(b.id).value;
        if (b.id == "s") {
            document.getElementById("s1").innerHTML = s + '&nbsp';
            //$('#append').append('<span class="badge bg-secondary">'+s+'</span>');
            return;
        } else if (b.id == "c") {
            document.getElementById("s2").innerHTML = s + '&nbsp';
            return;
        }



    }

    /*function edit(e)
    	{
    			var d = document.getElementById(e.name).value ;
    	const v = d.split(",");

    		
    	} */

    function img(i) {


        var preview = document.getElementById(i.name);
        var f = document.getElementById(i.id).files;
        document.getElementById('r' + i.id).style.visibility = "visible";
        //alert(f);
        if (f) {
            [].forEach.call(f, readAndPreview);
        }

        function readAndPreview(file) {

            // Make sure `file.name` matches our extensions criteria
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " is not an image");
            } // else...

            var reader = new FileReader();

            reader.addEventListener("load", function() {
                var image = new Image();
                image.height = 60;
                image.title = file.name;
                image.src = this.result;
                preview.append(image);


            });

            reader.readAsDataURL(file);



        }

        //document.querySelector(i.id).addEventListener("change", previewImages);

    }

    function main() {

        var mn = document.getElementById("img");

        var main = document.getElementById("main").files;
        const [file] = main;

        if (file) {

            var im = URL.createObjectURL(file);
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " is not an image");
            } else {
                mn.innerHTML = '<img src="' + im + '" width="20%" class="border border-danger">';
                document.getElementById("rim").style.visibility = "visible";
            }


        }
    }

    function specify(d) {
        //	alert(d.id);
        var s = document.getElementById(d.id).value;
        var s1 = document.getElementById("style1");
        var r1 = document.getElementById("r1");
        var r2 = document.getElementById("r2");
        var s2 = document.getElementById("material1");
        //alert(s);
        if (d.id == "st") {
            s1.innerHTML = s;
            r1.style.display = "block";
            if (s == "") {
                r1.style.display = "none";
            }

        } else if (d.id == "mt") {
            s2.innerHTML = s;
            r2.style.display = "block";
            if (s == "") {
                r2.style.display = "none";
            }
        }

    }

    $(document).ready(function() {
        var max = 100; //maximum input boxes allowed
        var display = $("#display"); //Fields wrapper
        var add = $("#specAddMore"); //Add button ID

        let x = 0; //initlal text box count

        $(add).click(function() { //on add input button click
            //alert(x);
            if (x < max) { //max input box allowed
                x++; //text box increment

                let moreSpec =
                    `<div class="row mt-3" id="">
                        <div class="col-md-1">
                            <label class="fw-bold mt-2">Specification</label>
                        </div>	
                        <div class="col-md-3">  
                            <select class="specification form-control text-secondary" id="specification[${x}]" name="specification[]"> 
                                <option selected hidden class="text-primary">Select Specification</option>
                                @foreach ($specification as $specification)
                                    <option id="{{ $specification->id }}"
                                        value="{{ $specification->specification_name }}">
                                        {{ $specification->specification_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1 text-center">
                            <label class="fw-bold mt-2">Value</label>
                        </div>	

                        <div class="col-md-3">  
                            <select class=" form-control text-secondary" id="specify_value[${x}]" name="specify_value[]" disabled>
                                <option selected class="text-primary">Select value</option>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="remove" id="rem${x}">
                                <button type="button" class="btn btn-danger" style="background-Color:red;">X</button>
                            </a>
                        </div>
                    </div>
                    `;
                $(display).append(moreSpec); //add input box
            }
            let r = x - 1;
            document.getElementById("rem" + r).style.display = "none";
        });

        $(display).on("click", ".remove", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('.row').remove();
            x--;
            document.getElementById("rem" + x).style.display = "block";

        })
    });

    document.getElementById("offer").addEventListener("change", myFunction);

    function myFunction() {
        var x = document.getElementById("offer").value;
        var type = document.getElementById("offtype");
        if (x == "Available") {
            type.style.display = "block";
        } else {
            type.style.display = "none";
        }
    }
</script>
