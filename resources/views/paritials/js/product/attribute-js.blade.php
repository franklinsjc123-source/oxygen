

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
<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
				<script>
$(document).ready(function(){
  $("#specify_show").click(function(){
    $("#display").slideDown(1000);
	document.getElementById("specify_length").innerHTML="";    
  });
  
   $("#specify_hide").click(function(){
    $("#display").slideUp(1000);
	var length =document.getElementsByClassName('attr_row').length;
	 var total=length+1;
      document.getElementById("specify_length").innerHTML=length+" Out of "+total;     
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
			
            x++; //text box increment
            $(wrapper).append('<tr class="attr_row"><td><input id ="input" name="value[]" class="form-control" type ="text" placeholder="Enter Value" /></td><td><a href="#" id="r'+x+'" class="remove_field " ><span class="text-danger fw-bold border p-2">X</span></a><a class="btn btn-primary mx-3 add" id="add'+x+'">+ Add More</a></td><tr>'); //add input box
        }
		var r = x-1;
		
		document.getElementById("add1").style.visibility="hidden";
		
    });
	$(wrapper).on("click",".add", function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<tr class="attr_row"><td><input id ="input" name="value[]" class="form-control" type ="text" placeholder="Enter Value" /></td><td><a href="#" id="r'+x+'" class="remove " ><span class="text-danger fw-bold border p-2">X</span></a><a class="btn btn-primary mx-3 add" id="add'+x+'">+ Add More</a></td><tr>'); //add input box
        }
		var r=x-1;
		document.getElementById("r"+r).style.visibility="hidden";
		document.getElementById("add"+r).style.visibility="hidden";
		}) 
				 $(wrapper).on("click",".remove", function(e){ //user click on remove text
        e.preventDefault(); $(this).closest('tr').remove(); x--;
		
		
		document.getElementById("r"+x).style.visibility="visible";
		document.getElementById("add"+x).style.visibility="visible";
		
		
    })
    

	

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).closest('tr').remove();; x--;
	
		if(x==1)
		{
		document.getElementById("add1").style.visibility="visible";
		}
	
		
		
    })
});
</script>