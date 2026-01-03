<script>

function fixed(){
	
   document.getElementById('percentagediv').style.display ='none';
   document.getElementById('fixeddiv').style.display ='block';
   document.getElementById('discountdiv').style.display = 'block';
}
function percentage(){
  document.getElementById('fixeddiv').style.display = 'none';
  document.getElementById('percentagediv').style.display = 'block';
  document.getElementById('discountdiv').style.display = 'block';
}

function minimumnone(){
  document.getElementById('minimumquantity').style.display = 'none';
  document.getElementById('minimumpurchase').style.display = 'none';
  
}
function purchase(){
  document.getElementById('minimumquantity').style.display = 'none';
  document.getElementById('minimumpurchase').style.display = 'block';
}
function qty(){
  document.getElementById('minimumquantity').style.display = 'block';
  document.getElementById('minimumpurchase').style.display = 'none';
}
function cashback(){
  
  document.getElementById('discountdiv').style.display = 'none';
}

function freedelivery(){
  
  document.getElementById('discountdiv').style.display = 'none';
}
function rewards(){
  
  document.getElementById('discountdiv').style.display = 'none';
}


</script>
<script>
	$(window).load(function(){
		$('#general-tab').trigger('click');
	});
	function search(){
		
		
		
		
		document.getElementById("static").style.display="block";
		
	}
</script>
<script>
	
	function myFunction() {
		var a = document.getElementById("checkbox-primary-4");

  if (a.checked == true){
   document.getElementById("coupon").style.display="block";
		document.getElementById("coupon1").style.display="block";
		
  } else {
    document.getElementById("coupon").style.display="none";
		document.getElementById("coupon1").style.display="none";
			
  }
}
	
	function myFunction1() {
		var a = document.getElementById("checkbox-primary-3");

  if (a.checked == true){
   document.getElementById("minimum").style.display="block";

		
  } else {
    document.getElementById("minimum").style.display="none";

			
  }
}
	function discount(){
		
		var a = document.getElementById("percent").value;
		
		if (a =="percent"){
			
		
			document.getElementById("dispercentage").style.display="block";
			document.getElementById("disamount").style.display="none";
			}

		else if (a =="fixed"){
			
			document.getElementById("disamount").style.display="block";
			document.getElementById("dispercentage").style.display="none";
			}
	}
	
</script>

<script>
	 const myDatePicker1 = MCDatepicker.create({ 
      
	  el:'#example'
	  
})
	 const myDatePicker2 = MCDatepicker.create({ 
      
	  el:'#example1'
	  
})


</script>
<script>
function getDate() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  if(dd<10) {
      dd = '0'+dd
  } 

  if(mm<10) {
      mm = '0'+mm
  } 

  today = yyyy + '/' + mm + '/' + dd;
  console.log(today);
  document.getElementById("date").value = today;
}


window.onload = function() {
  getDate();
};
</script>