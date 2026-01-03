    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
    
    // function myFunction() {
    //     var cartEffect = document.getElementById("cartEffect").value;
    //     alert('First of all you have to login before Order');
    // }

//     function addqnty(id, type) {
//     var product_size = $('#product_size' + id).val();
//    // alert(product_size);
//     var product_qnty = $('#quantity' + id).val();
//     //alert(product_qnty);
//     if (product_size == "") {
//         swal("Warning!", "Please select Size ", "error");
//     } else {
//         if (type == "Add") {
//             product_qnty = parseInt(product_qnty) + 1;
//           //  alert(product_qnty);

//         } else {
            
//             product_qnty = parseInt(product_qnty) - 1;

//         }

//         $('#quantity' + id).val(product_qnty);
//         if (product_qnty == 1) {

//             addproduct(id)
//         }
//         if (product_qnty > 1) {

//             updatecart(id, product_qnty)
//         }
//         if (product_qnty == 0) {
//             $('#addcart2_' + id).hide();
//             $('#addcart1_' + id).show();
//             deletecart(id);
//         }
//     }

// }
$(document).on('click','#cartEffect', function(e){

      e.preventDefault();
    // var product_size = $('#product_size' + id).val();
     //alert(product_size);
    //  alert('test');


                                
    var product_id = $('#product_id').val();
    var product_name = $('#product_name').val();
    var product_size = $('#product_size').val();
    var product_qnty = $('#quantity').val();
    var product_price = $('#product_price').val();

    // $id = $request->input('product_id');
	// 	$name = $request->input('product_name');
	// 	$price = $request->input('product_price');
	// 	$qnty = $request->input('product_qnty');
	// 	$size = $request->input('product_size');
    // alert(productprice);


    $.ajax({
                    url: '{{route("ajaxAdd")}}',
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "product_id":product_id,"product_name":product_name,"product_size":product_size,"product_qnty": product_qnty,"product_price":product_price
                    },

                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        getcart();
                        
                    }
                });

});
   
$(document).ready(function () {
  var url= "https://oxygen.ktonline.in/public/getcart";
getcart();
// start the loop
});
function getcart() {
    
    //$('.shopping-cart').hide();
    //alert('1');
  
    $.ajax({

        url: '{{route("getcart")}}',
        type: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "product_id": '1'

        },

        dataType: "json",
        success: function (data) {
            console.log(data);
            
            if (data.sum == 0) {
                var cart_dt = '<li> <div class="minicart-item"><img src="{{asset('frontend_assets/images/emptycart.png')}}" alt="Your Cart Is Empty"> </div></li>';
            } else {
                cart_dt = "";
                alert('2');
                $.each(data.cart, function (i, item) {
                    alert(item.pid);
                     $('#quantity' + item.pid).val(item.qty);
                     $('#addcart2_' + item.pid).show();
                 $('#addcart1_' + item.pid).hide();
                     cart_dt+='<li> <div class="media"> <a href="#"><img alt="" class="me-3" src=" ../assets/images/products/detail/'+item.image+' "></a><div class="media-body"><a href="#"><h4>' + item.name + '</h4></a> <h4><span>1 x Rs ' + item.price + '</span></h4> </div></div> <div class="close-circle"><a href="#" onclick=deletecart("' + item.pid + '")><i class="fa fa-times" aria-hidden="true"></i></a></div></li>';
                    //cart_id +='<li><div class="media"><div class="media-body"><a href="#"><h4>' + item.name + '</h4></a><h4><span>1 x Rs ' + item.price + '</span></h4></div></div><div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div></li>';
                     //cart_dt += '<li> <div class="media"><a href="#"><img alt="" class="me-3" src="../assets/img/product/top/1/'+item.image+'"></a><div class="media-body"><a href="#"><h4>' + item.name + '</h4></a><h4><span>1 x Rs ' + item.price + '</span></h4></div></div><div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div> <div class="qty"> <label for="cart[' + item.pid + '][qty]">Qty:</label> <input type="number" class="input-qty" name="cart[' + item.pid + '][qty]" id="cart[id123][qty]" value="' + item.qty + '" disabled> </div> </div> <div class="action"><a href="#"  onclick=deletecart("' + item.pid + '")> <img src="' + url + '/adminpanel/img/icon/delete.png" style="width:30px;"> </a> </div> </div> </li>';
                    //cart_dt += '<div class="products scrollable" data-id="' + item.pid + '">  <div class="product product-cart"> <figure class="product-media"> <img src="' + url + '/uploads/products/' + item.image + '" style="width:75px;height:75px;" class="img-responsive">     </figure> <div class="product-detail"> <a href="#" class="product-name">' + item.name + '</a> <div class="price-box"> <span class="product-quantity">' + item.qty + '</span> <span class="product-price">' + item.price + '</span> </div> </div>  </div>   </div>';
                  
                });
            }
           // alert('3');
            // $('.wishcount').html(data.wishcount);
            //$('.cart-count').html(data.count);
            // $('.cart-price').html('Rs.' + data.sum);
            
            cart_dt+='<li><div class="total"><h5>Total : <span class="total"> Rs ' + data.sum+'</span></h5></div></li><li><div class="buttons"><a href="{{ route('viewcart') }}" class="view-cart">view cart</a><a href="{{ route('checkout') }}" class="checkout">checkout</a></div></li>';
            $('#cart_dt').html(cart_dt);
            if (data.sum != 0) {
                $('.shopping-cart').show();
            }

        },
         error: function (data) {
             console.log('Error:', data);
         }
    });
}


function viewcart() {
    $.ajax({

        url: '{{route("getcart")}}',
        type: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "product_id": '1'

        },

        dataType: "json",
        success: function (data) {
            console.log(data);
            //alert(data.sum);
            if (data.sum == 0) {
                var cart_dt = '<div class="minicartk-footer"> <p class="minicartk-empty-text">Your shopping cart is empty</p> </div>';
            } else {
                var cart_dt = "<table class='table table-bordered'>";
                $.each(data.cart, function (i, item) {

                    //alert(item.name);

                    cart_dt += "<tr><td style='width:70%'> " + item.name + "</td><td><input class='minicartk-quantity1' style='width:30px;    border: 1px solid #ccc;    border-radius: 4px;    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);    font-size: 13px;'  data-minicartk-idx='0' name='quantity_1' type='text' pattern='[0-9]*' value='" + item.qty + " ' onblur='updatecart(" + item.pid + ",this.value)'  autocomplete='off'></td><td><button type='button' class=' btn btn-danger' onclick='deletecart(" + item.pid + ")'><i class='fa fa-trash'></i></button>            </td>  <td> Rs. " + item.total_price + "</td></tr> ";
                });
                cart_dt += "           </tr> <tr><td colspan='4'><span style='float:right'>  Subtotal:  Rs. " + data.sum + " <br>  <a href='{{ url('Checkout') }}' class='btn btn-danger'  data-minicartk-alt='undefined'>Check Out </a>  </span> </td> </tr></table>  ";
            }
            //$('#cart_dt').html(cart_dt);
            //$('#myModal').modal('show');

            //$('#lblCartCount').html(data.count);
            $('.cart-count').html(data.count);
            $('.cart-price').html(data.sum + '.00');

        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function deletecart(val) {

if (confirm("Are you sure to remove cart?")) {
    var product_id = val;
    //alert(val);
    if (product_id != '') {
        $.ajax({
            
            url: '{{route("cartdelete")}}',
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "product_id": product_id

            },

            dataType: "json",
            success: function (data) {
                console.log(data);
                location.reload();
                $('#loading').show();

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
}
return false;


}

</script>