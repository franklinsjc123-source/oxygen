<script>




function buyxgety(){
   
	document.getElementById('buyxaty').style.display = 'none';
	document.getElementById('buyxgetydiv').style.display = 'block';
	document.getElementById('cashbackdiv').style.display = 'none';
// 	document.getElementById('per_value').style.display = 'none';
//   document.getElementById('amt_value').style.display = 'none';
document.getElementById('fixed_discount').style.display = 'none';
}

function buyxaty(){
	
	document.getElementById('buyxaty').style.display = 'block';
	document.getElementById('buyxgetydiv').style.display = 'none';
	document.getElementById('cashbackdiv').style.display = 'none';
// 	document.getElementById('per_value').style.display = 'none';
//   document.getElementById('amt_value').style.display = 'none';
document.getElementById('fixed_discount').style.display = 'none';
	
 }

function fixed(){
	  document.getElementById('fixedcashback').style.display = 'block';
  document.getElementById('percentagecashback').style.display = 'none';
//   document.getElementById('per_value').style.display = 'none';
//   document.getElementById('amt_value').style.display = 'none';
document.getElementById('buyxaty').style.display = 'none';
document.getElementById('buyxgetydiv').style.display = 'none';
// document.getElementById('fixed_discount').style.display = 'none';
}
function percentage(){
  document.getElementById('percentagecashback').style.display = 'block';
  document.getElementById('fixedcashback').style.display = 'none';
//   document.getElementById('per_value').style.display = 'none';
//   document.getElementById('amt_value').style.display = 'none';
  document.getElementById('buyxaty').style.display = 'none';
  document.getElementById('buyxgetydiv').style.display = 'none';
//   document.getElementById('fixed_discount').style.display = 'none';
}

function freedelivery(){
  
   document.getElementById('buyxgetydiv').style.display = 'none';
   document.getElementById('cashbackdiv').style.display = 'none';
//    document.getElementById('per_value').style.display = 'none';
//   document.getElementById('amt_value').style.display = 'none';
document.getElementById('buyxaty').style.display = 'none';

document.getElementById('fixed_discount').style.display = 'none';
}

function cashbackoffer(){
  
  document.getElementById('buyxgetydiv').style.display = 'none';
document.getElementById('cashbackdiv').style.display = 'block';
// document.getElementById('per_value').style.display = 'none';
//   document.getElementById('amt_value').style.display = 'none';
document.getElementById('buyxaty').style.display = 'none';
document.getElementById('fixed_discount').style.display = 'none';

  
}

function fixeddiscount(){
	
	document.getElementById('percentagecashback').style.display = 'none';
  document.getElementById('fixedcashback').style.display = 'none';
  document.getElementById('fixed_discount').style.display = 'block';
//   document.getElementById('per_value').style.display = 'none';
  document.getElementById('buyxaty').style.display = 'none';
  document.getElementById('buyxgetydiv').style.display = 'none';
  document.getElementById('cashbackdiv').style.display = 'none';

}

function fixedamount(){
	  document.getElementById('amounttxtvalue').style.display = 'block';
  document.getElementById('percentagetxtvalue').style.display = 'none';
//   document.getElementById('per_value').style.display = 'none';
//   document.getElementById('amt_value').style.display = 'none';
document.getElementById('buyxaty').style.display = 'none';
document.getElementById('buyxgetydiv').style.display = 'none';
// document.getElementById('fixed_discount').style.display = 'none';
}
function fixedpercentage(){
  document.getElementById('percentagetxtvalue').style.display = 'block';
  document.getElementById('amounttxtvalue').style.display = 'none';
//   document.getElementById('per_value').style.display = 'none';
//   document.getElementById('amt_value').style.display = 'none';
  document.getElementById('buyxaty').style.display = 'none';
  document.getElementById('buyxgetydiv').style.display = 'none';
//   document.getElementById('fixed_discount').style.display = 'none';
}

// function percentagevalue(){
	
// 	document.getElementById('percentagecashback').style.display = 'none';
//   document.getElementById('fixedcashback').style.display = 'none';
//   document.getElementById('per_value').style.display = 'block';
//   document.getElementById('amt_value').style.display = 'none';
//   document.getElementById('buyxaty').style.display = 'none';
//   document.getElementById('buyxgetydiv').style.display = 'none';
//   document.getElementById('cashbackdiv').style.display = 'none';

// }


if(document.getElementById('type1').checked) {
	document.getElementById('buyxaty').style.display = 'none';
	document.getElementById('buyxgetydiv').style.display = 'block';
	document.getElementById('cashbackdiv').style.display = 'none';
// 	document.getElementById('per_value').style.display = 'none';
//   document.getElementById('amt_value').style.display = 'none';
document.getElementById('fixed_discount').style.display = 'none';
            }



function minimum_pusrchase_amt(){
	document.getElementById('m_p_a').style.display = 'block';
}

function nonetype(){
	document.getElementById('m_p_a').style.display = 'none';
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