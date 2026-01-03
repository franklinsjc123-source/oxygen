<?php
if (isset($records)) {

    foreach ($records as $row) {
        $image = $row['attributes']['image'];
        //print_r($row);

?>

        <tr>
            <td class="product-thumbnail">
                <div class="p-relative">
                    <a href="product-default.html">
                        <figure>
                            <img src="<?= asset('assets/images/products/detail/' . $image) ?>" alt="product"
                                width="300" height="338">
                        </figure>
                    </a>
                    <button type="button" class="btn btn-close" onclick="removeCart('<?= $row['id'] ?>')"><i
                            class="fas fa-times"></i></button>
                </div>
            </td>
            <td class="product-name">
                <a href="#">
                    {{ $row['name'] }}
                </a>
            </td>
            <td class="product-price"><span class="amount">Rs.{{ $row['price'] }}</span></td>
            <td class="product-quantity">
                <div class="input-group">
                    <input class="form-control" value="<?= $row['quantity'] ?>" type="number" min="1" max="100" id="quantity{{$row['id']}}" readonly>
                    <button class="w-icon-plus" onclick="updateQty('{{$row['id']}}','Add')"></button>
                    <button class=" w-icon-minus" onclick="updateQty('{{$row['id']}}','Minus')"></button>
                </div>
            </td>
            <td class="product-subtotal">
                <span class="amount">Rs.{{ $row['price'] * $row['quantity'] }}</span>
            </td>
        </tr>
    <?php }
} else { ?>
    <tr data-id="1">
        <td colspan="5">
            <center><i class="d-icon-bag"></i> Your Cart is Empty</center>
        </td>
    </tr>
<?php } ?>