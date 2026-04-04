<!--<script src="jquery-3.6.3.min.js"></script>-->
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
    // alert(product_size);
    //  alert('test');

    $(".error-message").hide();
                                
    var product_id = $('#product_id').val();
    var product_name = $('#product_name').val();
    var product_size = $('#product_size').val();
    var product_color = $('#product_color').val();
    var product_qnty = $('#quantity').val();
    var product_price = $('#product_price').val();
    var fixeddiscount = $('#fixeddiscount').val();
    // alert(fixeddiscount);
    if(fixeddiscount != 'fixeddiscount')
    {
    var product_price = $('#product_price').val();
    
    }
    else
    {
        var product_price = $('#product_price1').val();
    }

    // $id = $request->input('product_id');
	// 	$name = $request->input('product_name');
	// 	$price = $request->input('product_price');
	// 	$qnty = $request->input('product_qnty');
	// 	$size = $request->input('product_size');
//   alert(product_color);


    $.ajax({
                    url: '{{route("ajaxAdd")}}',
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "product_id":product_id,"product_name":product_name,"product_size":product_size,"product_color":product_color,"product_qnty": product_qnty,"product_price":product_price
                    },

                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        getcart();
                        $('#cartEffect').text('ADDED TO CART');
                        
                        if (response.free_alert && response.free_alert !== '') {
                            showOfferProductsModal(response.offer_id, response.products_id, response.free_alert, response.buy, response.getoffer);
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr);
                        $(".error-message").show().text('Unable to add to cart. Please try again.');
                    }
                });

});





/*buynow start*/

$(document).on('click','#cartbook', function(e){

    e.preventDefault();
    // var product_size = $('#product_size' + id).val();
    //alert(product_size);
    //alert('test');

    $(".error-message").hide();
                            
    var product_id = $('#product_id').val();
    var product_name = $('#product_name').val();
    var product_size = $('#product_size').val();
    var product_color = $('#product_color').val();
    var product_qnty = $('#quantity').val();
    var product_price = $('#product_price').val();
    var fixeddiscount = $('#fixeddiscount').val();
    // alert(fixeddiscount);
    if(fixeddiscount != 'fixeddiscount')
    {
    var product_price = $('#product_price').val();
    
    }
    else
    {
        var product_price = $('#product_price1').val();
    }
    //  alert(product_color);


$.ajax({
              url: '{{route("ajaxAdd")}}',
              type: "POST",
              data: {
                  "_token": "{{ csrf_token() }}",
                  "product_id":product_id,"product_name":product_name,"product_size":product_size,"product_color":product_color,"product_qnty": product_qnty,"product_price":product_price
              },

              dataType: "json",
              success: function(response) {
                  console.log(response);
                  getcart();
                  
                  if (response.free_alert && response.free_alert !== '') {
                      showOfferProductsModal(response.offer_id, response.products_id, response.free_alert, response.buy, response.getoffer);
                      return; // don't redirect yet, let user pick free product
                  }
                  
                  window.location.href = "{{route('viewcart')}}";
                  //viewcart();
                  
              },
              error: function (xhr) {
                  console.log(xhr);
                  $(".error-message").show().text('Unable to process buy now. Please try again.');
              }
          });

});

/*buynow end*/
$(document).ready(function () {

getcart();

// start the loop
});
function getcart() {
    
    $('.shopping-cart').hide();
   // alert('1');
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
               // alert('2');
                $.each(data.cart, function (i, item) {
                    //console.log(item);
                    // $('#quantity' + item.pid).val(item.qty);
                    // $('#addcart2_' + item.pid).show();
                    // $('#addcart1_' + item.pid).hide();
                     var itemImage = item.image ? ('{{ asset('assets/images/products/detail') }}/' + item.image) : '{{ asset('frontend_assets/images/emptycart.png') }}';
                     cart_dt+='<li> <div class="media"> <a href="#"><img alt="" class="me-3" src="' + itemImage + '"></a><div class="media-body"><a href="#"><h4>' + item.name + '</h4></a> <h4><span> ' + item.qty + ' x Rs ' + item.price + '</span></h4> </div></div> <div class="close-circle"><a href="#" onclick=deletecart("' + item.pid + '")><i class="fa fa-times" aria-hidden="true"></i></a></div></li>';
                    //cart_id +='<li><div class="media"><div class="media-body"><a href="#"><h4>' + item.name + '</h4></a><h4><span>1 x Rs ' + item.price + '</span></h4></div></div><div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div></li>';
                     //cart_dt += '<li> <div class="media"><a href="#"><img alt="" class="me-3" src="../assets/img/product/top/1/'+item.image+'"></a><div class="media-body"><a href="#"><h4>' + item.name + '</h4></a><h4><span>1 x Rs ' + item.price + '</span></h4></div></div><div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div> <div class="qty"> <label for="cart[' + item.pid + '][qty]">Qty:</label> <input type="number" class="input-qty" name="cart[' + item.pid + '][qty]" id="cart[id123][qty]" value="' + item.qty + '" disabled> </div> </div> <div class="action"><a href="#"  onclick=deletecart("' + item.pid + '")> <img src="' + url + '/adminpanel/img/icon/delete.png" style="width:30px;"> </a> </div> </div> </li>';
                    //cart_dt += '<div class="products scrollable" data-id="' + item.pid + '">  <div class="product product-cart"> <figure class="product-media"> <img src="' + url + '/uploads/products/' + item.image + '" style="width:75px;height:75px;" class="img-responsive">     </figure> <div class="product-detail"> <a href="#" class="product-name">' + item.name + '</a> <div class="price-box"> <span class="product-quantity">' + item.qty + '</span> <span class="product-price">' + item.price + '</span> </div> </div>  </div>   </div>';
                  
                });
            }
           // alert('3');
            // $('.wishcount').html(data.wishcount);
            $('.cart-count').html(data.count);
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


// function viewcart() {
//     $.ajax({

//         url: '{{route("getcart")}}',
//         type: "GET",
//         data: {
//             "_token": "{{ csrf_token() }}",
//             "product_id": '1'

//         },

//         dataType: "json",
//         success: function (data) {
//             //console.log(data);
//             //alert(data.sum);
//             if (data.sum == 0) {
//                 var cart_dt = '<div class="minicartk-footer"> <p class="minicartk-empty-text">Your shopping cart is empty</p> </div>';
//             } else {
//                 var cart_dt = "<table class='table table-bordered'>";
//                 $.each(data.cart, function (i, item) {

//                     //alert(item.name);

//                     cart_dt += "<tr><td style='width:70%'> " + item.name + "</td><td><input class='minicartk-quantity1' style='width:30px;    border: 1px solid #ccc;    border-radius: 4px;    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);    font-size: 13px;'  data-minicartk-idx='0' name='quantity_1' type='text' pattern='[0-9]*' value='" + item.qty + " ' onblur='updatecart(" + item.pid + ",this.value)'  autocomplete='off'></td><td><button type='button' class=' btn btn-danger' onclick='deletecart(" + item.pid + ")'><i class='fa fa-trash'></i></button>            </td>  <td> Rs. " + item.total_price + "</td></tr> ";
//                 });
//                 cart_dt += "</tr> <tr><td colspan='4'><span style='float:right'>  Subtotal:  Rs. " + data.sum + " <br>  <a href='{{ url('Checkout') }}' class='btn btn-danger'  data-minicartk-alt='undefined'>Check Out </a>  </span> </td> </tr></table>";
//             }
//             //$('#cart_dt').html(cart_dt);
//             //$('#myModal').modal('show');

//             //$('#lblCartCount').html(data.count);
//             $('.cart-count').html(data.count);
//             $('.cart-price').html(data.sum + '.00');

//         },
//         error: function (data) {
//             console.log('Error:', data);
//         }
//     });
// }

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

function showOfferProductsModal(offer_id, exclude_products_id, alertMsg, buyQty, getQty) {
    buyQty = buyQty || 1;
    getQty = getQty || 1;
    
    $.ajax({
        url: '{{route("getOfferProducts")}}',
        type: 'GET',
        data: {
            offer_id: offer_id,
            exclude_products_id: exclude_products_id
        },
        dataType: 'json',
        success: function(data) {
            var offer = data.offer;
            var products = data.products;
            var modalBody = '';
            
            // Premium Alert banner
            modalBody += '<div class="alert alert-warning text-center shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #fff3cd 0%, #ffe8a1 100%); margin-bottom: 25px; border: none;">';
            modalBody += '  <h4 style="color: #856404; font-weight: 700; margin-bottom: 5px;">🔥 EXCLUSIVE OFFER!</h4>';
            modalBody += '  <p style="font-size: 16px; margin: 0; color: #533f03;">This product is in a <b>Buy ' + buyQty + ' Get ' + getQty + ' Free</b> deal! Enjoy selecting your free gift below.</p>';
            modalBody += '</div>';
            
            if (products.length === 0) {
                modalBody += '<p class="text-center">No other offer products available.</p>';
            } else {
                modalBody += '<div class="row">';
                $.each(products, function(i, prod) {
                    modalBody += '<div class="col-md-4 col-sm-6 col-12 mb-4">';
                    modalBody += '<div class="card h-100 shadow-sm">';
                    modalBody += '<img src="{{ asset("assets/images/products") }}/' + prod.product_image + '" class="card-img-top" style="height:200px; object-fit:contain; padding:10px;" alt="' + prod.product_name + '">';
                    modalBody += '<div class="card-body text-center">';
                    modalBody += '<h6 class="card-title">' + prod.product_name + '</h6>';
                    
                    // Color dropdown
                    if (prod.colors.length > 0) {
                        modalBody += '<div class="form-group mt-2"><label class="small">Color:</label>';
                        modalBody += '<select class="form-control form-control-sm offer-color-select" data-product-index="' + i + '" id="offer_color_' + i + '">';
                        $.each(prod.colors, function(ci, clr) {
                            modalBody += '<option value="' + clr + '">' + clr + '</option>';
                        });
                        modalBody += '</select></div>';
                    }
                    
                    // Size dropdown
                    if (prod.sizes.length > 0) {
                        modalBody += '<div class="form-group mt-2"><label class="small">Size:</label>';
                        modalBody += '<select class="form-control form-control-sm offer-size-select" data-product-index="' + i + '" id="offer_size_' + i + '">';
                        $.each(prod.sizes, function(si, sz) {
                            modalBody += '<option value="' + sz + '">' + sz + '</option>';
                        });
                        modalBody += '</select></div>';
                    }
                    
                    // Hidden data
                    modalBody += '<input type="hidden" id="offer_variants_' + i + '" value=\'' + JSON.stringify(prod.variants) + '\'>';
                    modalBody += '<input type="hidden" id="offer_prodname_' + i + '" value="' + prod.product_name.replace(/"/g, '&quot;') + '">';
                    
                    modalBody += '<button type="button" class="btn btn-solid btn-sm mt-3" onclick="addFreeOfferProduct(' + i + ')">Add Free Product</button>';
                    modalBody += '</div></div></div>';
                });
                modalBody += '</div>';
            }
            
            // Build the modal
            var existingModal = document.getElementById('dynamicOfferModal');
            if (existingModal) existingModal.remove();
            
            var modalHtml = '<div class="modal fade" id="dynamicOfferModal" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.4);">';
            modalHtml += '<div class="modal-dialog modal-lg modal-dialog-centered" role="document">';
            modalHtml += '<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden; box-shadow: 0 15px 50px rgba(0,0,0,0.2);">';
            modalHtml += '<div class="modal-header" style="background: #f87d11; color: white; padding: 20px 30px;">';
            modalHtml += '  <h4 class="modal-title" style="font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">🎁 Choose Your FREE Gift</h4>';
            modalHtml += '  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1; text-shadow: none;" onclick="$(\x27#dynamicOfferModal\x27).modal(\x27hide\x27)"><span>&times;</span></button></div>';
            modalHtml += '<div class="modal-body" style="padding: 30px; background: #fafafa;">' + modalBody + '</div>';
            modalHtml += '</div></div></div>';
            
            $('body').append(modalHtml);
            $('#dynamicOfferModal').modal('show');
        },
        error: function() {
            swal("Error", "Unable to load offer products.", "error");
        }
    });
}

function addFreeOfferProduct(index) {
    var variants = JSON.parse($('#offer_variants_' + index).val());
    var selectedColor = $('#offer_color_' + index).val() || '';
    var selectedSize = $('#offer_size_' + index).val() || '';
    var prodName = $('#offer_prodname_' + index).val();
    
    // Find the matching variant based on selected color + size
    var matchedVariant = null;
    $.each(variants, function(vi, v) {
        var colorMatch = (selectedColor === '' || v.color === selectedColor);
        var sizeMatch = (selectedSize === '' || v.size === selectedSize);
        if (colorMatch && sizeMatch) {
            matchedVariant = v;
            return false;
        }
    });
    
    // Fallback to first variant if no exact match
    if (!matchedVariant && variants.length > 0) {
        matchedVariant = variants[0];
    }
    
    if (!matchedVariant) {
        swal("Error", "No variant found for the selected size/color.", "error");
        return;
    }
    
    $.ajax({
        url: '{{route("ajaxAdd")}}',
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "product_id": matchedVariant.detail_id,
            "product_name": prodName,
            "product_size": selectedSize,
            "product_color": selectedColor,
            "product_qnty": 1,
            "product_price": matchedVariant.selling_price,
            "is_free_offer": 1
        },
        dataType: "json",
        success: function(response) {
            swal("Success!", "Free offer product added to cart!", "success");
            getcart();
            $('#dynamicOfferModal').modal('hide');
        },
        error: function(xhr) {
            swal("Error", "Unable to add product to cart.", "error");
        }
    });
}

</script>
