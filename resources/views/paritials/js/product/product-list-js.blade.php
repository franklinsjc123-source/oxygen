<script>
    
	
    function inc(m) {
		var r =document.getElementById(m.name).innerHTML;
		//alert(r);
        r++;
        document.getElementById(m.name).innerHTML = r;
    }
	function d(n) {
		var v =document.getElementById(n.name).innerHTML;
        
		if(v==0){
			document.getElementById(n.name).innerHTML = 0;
			r++;
			}
			else{
				v--;
        document.getElementById(n.name).innerHTML = v;
				}
    }
</script>
<script>

//var today = new Date();

//var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dt = new Date();

document.getElementById("d").innerHTML=dt;
document.getElementById("d1").innerHTML=dt;
//document.getElementById("t").innerHTML=time;
</script>
<script>

//var today = new Date();

//var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

const d = new Date();
let name = month[d.getMonth()];

let date = d.getDate();
let year = d.getFullYear();

document.getElementById("d").innerHTML =date+"/"+name+"/"+year;
document.getElementById("d1").innerHTML =date+"/"+name+"/"+year;


//document.getElementById("t").innerHTML=time;

function esd(e)
	{
		alert(e.id);
	}

</script>