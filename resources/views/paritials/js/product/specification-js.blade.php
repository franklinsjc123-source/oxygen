


		
		


<script>

	function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "more";
	
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "less";
    moreText.style.display = "flex";
	
  }
}
</script>
				<script>
$(document).ready(function(){
  $("#specify_show").click(function(){
    $("#display").slideDown(1000);
	document.getElementById("specify_length").innerHTML="";    
  });
  
   $("#specify_hide").click(function(){
    $("#display").slideUp(1000);
	var length1 =$('#specify_row1').length;
	var length2 =document.getElementsByClassName('specify_row').length;
	var total=length1+length2;
      document.getElementById("specify_length").innerHTML= total+" Row Hide";     
  });
  
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper	
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
		
        if(x < max_fields){ //max input box allowed
		document.getElementById("btn1").style.visibility="hidden";
            x++; //text box increment
			
            $(wrapper).append('<tr class="specify_row" ><td><input type="text" id="n'+x+'" name="mycolor['+x+']" class="form-control" placeholder="Enter Value" onkeyup="color1(this)"/></td><td>&nbsp &nbsp<a href="#" class="remove_field " id="rem'+x+'" ><span class="text-danger fw-bold border p-2">X</span></a><button class="btn btn-primary mx-3 add" id="btn'+x+'">+ Add More</button></td><tr>'); //add input box
        }
		
	 $(wrapper).on("click",".add", function(e){ //user click on remove text
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
		
            x++; //text box increment
            $(wrapper).append('<tr class="specify_row" id="specify_row2"><td><input type="text" id="n'+x+'" name="mycolor['+x+']" class="form-control" placeholder="Enter Value" onkeyup="color1(this)"/></td><td>&nbsp &nbsp<a href="#" class="remove " id="rem'+x+'" ><span class="text-danger fw-bold border p-2">X</span></a><a class="btn btn-primary mx-3 add" id="btn'+x+'">+ Add More</a></td><tr>'); //add input box
		}
		var r=x-1;
		document.getElementById("rem"+r).style.visibility="hidden";
		document.getElementById("btn"+r).style.visibility="hidden";
    })	
		 $(wrapper).on("click",".remove", function(e){ //user click on remove text
        e.preventDefault(); $(this).closest('tr').remove(); x--;
		document.getElementById("rem"+x).style.visibility="visible";
		document.getElementById("btn"+x).style.visibility="visible";
		
		
    })
    });
	
	

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).closest('tr').remove(); x--;
		
		if(x==1)
		{
			document.getElementById("btn1").style.visibility="visible";
		}
	
    })
});
</script>