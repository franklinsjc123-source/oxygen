<?php
if (isset($records) && count($records) > 0) {
    foreach ($records as $row) {
        $image = $row['image'] ?? '';
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
            $size = $row['size'] ?? '';
            $color = $row['color'] ?? '';
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
        @if($row['offer_applied'])
            <div class="text-success mt-1" style="font-size: 12px; font-weight: bold;">
                <i class="fas fa-tags"></i> {{ $row['offer_title'] }} Applied
            </div>
        @endif
    </td>
    <td class="product-price text-center align-middle">
        @php
            $displayPrice = $row['effective_unit_price'];
            if (($row['offer_type'] ?? '') === 'Buy X Get Y Free') {
                $displayPrice = $row['unit_price'];
            }
        @endphp
        @if($row['offer_applied'] && $row['discount_amount'] > 0 && ($row['offer_type'] ?? '') !== 'Buy X Get Y Free')
            <span class="amount text-muted" style="text-decoration: line-through; font-size: 0.9em;">Rs.{{ number_format($row['unit_price'], 2) }}</span><br>
        @endif
        <span class="amount">Rs.{{ number_format($displayPrice, 2) }}</span>
    </td>
    @php
        $domId = 'quantity' . preg_replace('/[^A-Za-z0-9_:-]/', '_', $row['id']);
    @endphp
    <td class="product-quantity text-center align-middle">
        <div class="input-group justify-content-center">
            <input class="form-control" value="<?= $row['qty'] ?>" type="number" min="1" max="100" id="{{ $domId }}" data-item-id="{{ $row['id'] }}" readonly>
            <button type="button" class="w-icon-plus" onclick="updateQty('{{ $row['id'] }}','Add','{{ $domId }}')"></button>
            <button type="button" class="w-icon-minus" onclick="updateQty('{{ $row['id'] }}','Minus','{{ $domId }}')"></button>
        </div>
    </td>
    <td class="product-subtotal text-center align-middle">
        <span class="amount">Rs.{{ number_format($row['payable_amount'], 2) }}</span>
    </td>
</tr>

<?php /* if (!empty($row['free_qty'])) { ?>
<tr style="background-color: #f9fdfa;">
    <td class="product-thumbnail align-middle text-center">
        <i class="fas fa-gift text-success" style="font-size: 24px;"></i>
    </td>
    <td class="product-name align-middle">
        <span class="text-success" style="font-weight: bold;">FREE: {{ $row['name'] }}</span>
        @if($size || $color)
            <div class="text-muted" style="font-size: 12px;">
                @if($size) <span>Size: {{ $size }}</span> @endif
                @if($size && $color) <span> | </span> @endif
                @if($color) <span>Color: {{ $color }}</span> @endif
            </div>
        @endif
    </td>
    <td class="product-price text-center align-middle">
        <span class="amount" style="text-decoration: line-through;">Rs.{{ number_format($row['unit_price'], 2) }}</span><br>
        <span class="amount text-success">Rs.0.00</span>
    </td>
    <td class="product-quantity text-center align-middle">
        <div class="justify-content-center">
            <span class="form-control text-center" style="background:transparent; border:none;">{{ $row['free_qty'] }}</span>
        </div>
    </td>
    <td class="product-subtotal text-center align-middle">
        <span class="amount text-success">Rs.0.00</span>
    </td>
</tr>
<?php } */ ?>

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
