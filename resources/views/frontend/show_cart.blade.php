<?php
if (isset($records) && count($records) > 0) {
    foreach ($records as $row) {
        $image = $row['attributes']['image'] ?? '';
?>
<tr>
    <td class="product-thumbnail align-middle">
        <div class="p-relative">
            <a href="javascript:void(0)">
                <figure>
                    <img src="<?= asset('assets/images/products/' . $image) ?>" alt="product" width="90" height="100">
                </figure>
            </a>
            <button type="button" class="btn btn-close" onclick="removeCart('<?= $row['id'] ?>')"><i class="fas fa-times"></i></button>
        </div>
    </td>
    <td class="product-name align-middle">
        <a href="#">
            {{ $row['name'] }}
        </a>
        @php
            $size = $row['attributes']['size'] ?? '';
            $color = $row['attributes']['color'] ?? '';
        @endphp
        @if($size || $color)
            <div class="text-muted" style="font-size: 12px;">
                @if($size)
                    <span>Size: {{ $size }}</span>
                @endif
                @if($size && $color)
                    <span> | </span>
                @endif
                @if($color)
                    <span>Color: {{ $color }}</span>
                @endif
            </div>
        @endif
    </td>
    <td class="product-price text-center align-middle"><span class="amount">Rs.{{ $row['price'] }}</span></td>
    <td class="product-quantity text-center align-middle">
        <div class="input-group justify-content-center">
            <input class="form-control" value="<?= $row['quantity'] ?>" type="number" min="1" max="100" id="quantity{{$row['id']}}" readonly>
            <button class="w-icon-plus" onclick="updateQty('{{$row['id']}}','Add')"></button>
            <button class="w-icon-minus" onclick="updateQty('{{$row['id']}}','Minus')"></button>
        </div>
    </td>
    <td class="product-subtotal text-center align-middle">
        <span class="amount">Rs.{{ $row['price'] * $row['quantity'] }}</span>
    </td>
</tr>
<?php
    }
} else {
?>
<tr data-id="1">
    <td colspan="5">
        <center><i class="d-icon-bag"></i> Your Cart is Empty</center>
    </td>
</tr>
<?php
}
?>
