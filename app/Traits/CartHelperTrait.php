<?php

namespace App\Traits;

use App\Models\Products\ProductsDetails;
use Illuminate\Support\Facades\DB;

trait CartHelperTrait
{
    protected function calculateDeliveryCharge(float $amount): float
    {
        return $amount >= 500 ? 0.0 : 40.0;
    }

    protected function parseCartProductId($cartItem): int
    {
        $productId = (int) ($cartItem->attributes->product_id ?? 0);
        if ($productId > 0) {
            return $productId;
        }

        return is_numeric($cartItem->id) ? (int) $cartItem->id : 0;
    }

    protected function getOfferForProduct(int $productId): ?object
    {
        if ($productId <= 0) {
            return null;
        }

        $offerColumns = [
            'o.id',
            'o.title',
            'o.type',
            'o.buy',
            'o.getoffer',
            'o.buyproduct',
            'o.getamt',
            'o.cashbacktype',
            'o.cashbackvalue',
            'o.discount_type',
            'o.value',
            'o.types',
            'o.m_p_a',
        ];

        if (DB::getSchemaBuilder()->hasColumn('master_offers', 'ActiveStartDate')) {
            $offerColumns[] = 'o.ActiveStartDate';
        }

        if (DB::getSchemaBuilder()->hasColumn('master_offers', 'ActiveEndDate')) {
            $offerColumns[] = 'o.ActiveEndDate';
        }

        $offer = DB::table('products as p')
            ->join('master_offers as o', 'o.id', '=', 'p.offers')
            ->where('p.id', $productId)
            ->where('o.status', 1)
            ->select($offerColumns)
            ->first();

        if (!$offer) {
            return null;
        }

        $today = now()->toDateString();
        $startDate = !empty($offer->ActiveStartDate) ? (string) $offer->ActiveStartDate : null;
        $endDate = !empty($offer->ActiveEndDate) ? (string) $offer->ActiveEndDate : null;

        if ($startDate && $today < $startDate) {
            return null;
        }

        if ($endDate && $today > $endDate) {
            return null;
        }

        return $offer;
    }

    protected function meetsOfferMinimum(?object $offer, int $qty, float $baseAmount): bool
    {
        if (!$offer) {
            return false;
        }

        $minimumType = trim((string) ($offer->types ?? 'None'));
        $minimumValue = (float) ($offer->m_p_a ?? 0);

        if ($minimumType === 'Minimum Purchase Amount') {
            return $baseAmount >= $minimumValue;
        }

        if ($minimumType === 'Minimum Quantity Of Items') {
            return $qty >= (int) $minimumValue;
        }

        return true;
    }

    protected function applyProductOffer(float $unitPrice, int $qty, ?object $offer): array
    {
        $baseAmount = round($unitPrice * $qty, 2);
        $result = [
            'offer_id' => null,
            'offer_title' => null,
            'offer_type' => null,
            'discount_amount' => 0.0,
            'payable_amount' => $baseAmount,
            'free_qty' => 0,
            'cashback_amount' => 0.0,
            'offer_applied' => false,
        ];

        if (!$offer || !$this->meetsOfferMinimum($offer, $qty, $baseAmount)) {
            return $result;
        }

        $result['offer_id'] = (int) $offer->id;
        $result['offer_title'] = (string) ($offer->title ?? '');
        $result['offer_type'] = (string) ($offer->type ?? '');

        switch ((string) $offer->type) {
            case 'Buy X Get Y Free':
                $buyQty = max(1, (int) ($offer->buy ?? 0));
                $freeQty = max(0, (int) ($offer->getoffer ?? 0));
                if ($buyQty > 0) {
                    $groupSize = $buyQty + $freeQty;
                    $bundleCount = intdiv($qty, $groupSize);
                    $result['free_qty'] = $bundleCount * $freeQty;
                    $result['offer_applied'] = $result['free_qty'] > 0;
                }
                break;

            case 'Buy X @ Y':
                $bundleQty = max(1, (int) ($offer->buyproduct ?? $offer->buy ?? 0));
                $bundlePrice = max(0, (float) ($offer->getamt ?? 0));
                if ($bundleQty > 0) {
                    $bundleCount = intdiv($qty, $bundleQty);
                    if ($bundleCount > 0) {
                        $normalAmount = $baseAmount;
                        $offerAmount = ($bundleCount * $bundlePrice) + (($qty % $bundleQty) * $unitPrice);
                        $result['payable_amount'] = round(max(0, $offerAmount), 2);
                        $result['discount_amount'] = round(max(0, $normalAmount - $result['payable_amount']), 2);
                        $result['offer_applied'] = $result['discount_amount'] > 0;
                    }
                }
                break;

            case 'Fixed Discount':
                $discountAmount = 0.0;
                if ((string) ($offer->discount_type ?? '') === 'Percentage') {
                    $discountAmount = ($baseAmount * max(0, (float) ($offer->value ?? 0))) / 100;
                } else {
                    $discountAmount = max(0, (float) ($offer->value ?? 0)) * $qty;
                }

                $discountAmount = min($baseAmount, $discountAmount);
                $result['discount_amount'] = round($discountAmount, 2);
                $result['payable_amount'] = round(max(0, $baseAmount - $discountAmount), 2);
                $result['offer_applied'] = $result['discount_amount'] > 0;
                break;

            case 'Cashback Offer':
                $cashbackAmount = 0.0;
                if ((string) ($offer->cashbacktype ?? '') === 'Percentage') {
                    $cashbackAmount = ($baseAmount * max(0, (float) ($offer->cashbackvalue ?? 0))) / 100;
                } else {
                    $cashbackAmount = max(0, (float) ($offer->cashbackvalue ?? 0));
                }

                $result['cashback_amount'] = round($cashbackAmount, 2);
                $result['offer_applied'] = $result['cashback_amount'] > 0;
                break;
        }

        return $result;
    }

    protected function resolveProductDetailId(int $productId, $size = null, $color = null): ?int
    {
        $query = ProductsDetails::where('products_id', $productId);

        if (!empty($size)) {
            $query->where('attributevalue2', $size);
        }

        if (!empty($color)) {
            $query->where('attributevalue1', $color);
        }

        $detail = $query->orderBy('id')->first();
        if (!$detail && (!empty($size) || !empty($color))) {
            $detail = ProductsDetails::where('products_id', $productId)->orderBy('id')->first();
        }

        return $detail ? (int) $detail->id : null;
    }

    protected function buildCheckoutSummary($cartItems): array
    {
        $lines = [];
        $subtotal = 0.0;
        $taxTotal = 0.0;
        $grandWithoutDelivery = 0.0;
        $discountTotal = 0.0;
        $cashbackTotal = 0.0;

        // 1. Pre-process items and group for global offers (Specifically Buy X Get Y Free)
        $offerGroups = [];
        $tempLines = [];
        
        foreach ($cartItems as $item) {
            $productId = $this->parseCartProductId($item);
            if ($productId <= 0) continue;
            
            $qty = max(1, (int) $item->quantity);
            $unitPrice = (float) $item->price;
            $size = $item->attributes->size ?? null;
            $color = $item->attributes->color ?? null;
            $detailId = $this->resolveProductDetailId($productId, $size, $color);
            if (empty($detailId)) continue;
            
            $offer = $this->getOfferForProduct($productId);
            
            $lineIdx = count($tempLines);
            $tempLines[] = [
                'item' => $item,
                'productId' => $productId,
                'detailId' => $detailId,
                'qty' => $qty,
                'unitPrice' => $unitPrice,
                'offer' => $offer,
                'size' => $size,
                'color' => $color
            ];
            
            if ($offer && in_array((string)$offer->type, ['Buy X Get Y Free', 'Buy X @ Y'])) {
                $oid = $offer->id;
                if (!isset($offerGroups[$oid])) {
                    $offerGroups[$oid] = ['offer' => $offer, 'indices' => [], 'totalQty' => 0];
                }
                $offerGroups[$oid]['indices'][] = $lineIdx;
                $offerGroups[$oid]['totalQty'] += $qty;
            }
        }

        // 2. Map for global offer adjustments
        $adjustments = [];
        foreach ($tempLines as $idx => $l) {
            $adjustments[$idx] = [
                'discount_amount' => 0.0,
                'payable_override' => null,
                'free_qty' => 0,
                'offer_applied' => false
            ];
        }

        foreach ($offerGroups as $oid => $group) {
            $offer = $group['offer'];
            $offerType = (string)($offer->type ?? '');
            
            if ($offerType === 'Buy X Get Y Free') {
                $buy = max(1, (int)($offer->buy ?? 0));
                $get = max(0, (int)($offer->getoffer ?? 0));
                $groupSize = $buy + $get;
                $bundleCount = intdiv($group['totalQty'], $groupSize);
                $totalToMakeFree = $bundleCount * $get;
                
                if ($totalToMakeFree > 0) {
                    $units = [];
                    foreach ($group['indices'] as $idx) {
                        for ($i = 0; $i < $tempLines[$idx]['qty']; $i++) {
                            $units[] = ['idx' => $idx, 'price' => $tempLines[$idx]['unitPrice']];
                        }
                    }
                    usort($units, function($a, $b) { return $a['price'] <=> $b['price']; });
                    
                    for ($i = 0; $i < min($totalToMakeFree, count($units)); $i++) {
                        $lIdx = $units[$i]['idx'];
                        if ($units[$i]['price'] > 0) {
                            $adjustments[$lIdx]['discount_amount'] += (float)$units[$i]['price'];
                            $adjustments[$lIdx]['offer_applied'] = true;
                        }
                        $adjustments[$lIdx]['free_qty']++;
                    }
                }
            } elseif ($offerType === 'Buy X @ Y') {
                $bundleQty = max(1, (int)($offer->buyproduct ?? $offer->buy ?? 0));
                $bundlePriceTotal = max(0, (float)($offer->getamt ?? 0));
                $bundleCount = intdiv($group['totalQty'], $bundleQty);
                
                if ($bundleCount > 0) {
                    $units = [];
                    foreach ($group['indices'] as $idx) {
                        for ($i = 0; $i < $tempLines[$idx]['qty']; $i++) {
                            $units[] = ['idx' => $idx, 'price' => $tempLines[$idx]['unitPrice']];
                        }
                    }
                    // Sort descending: bundle most expensive items to give best discount
                    usort($units, function($a, $b) { return $b['price'] <=> $a['price']; });
                    
                    $totalDiscount = 0.0;
                    for ($b = 0; $b < $bundleCount; $b++) {
                        $start = $b * $bundleQty;
                        $bundleCurrentOriginalTotal = 0.0;
                        for ($i = 0; $i < $bundleQty; $i++) {
                            $uIdx = $start + $i;
                            if (isset($units[$uIdx])) {
                                $bundleCurrentOriginalTotal += (float)$units[$uIdx]['price'];
                            }
                        }
                        
                        $bundleDiscount = max(0, $bundleCurrentOriginalTotal - $bundlePriceTotal);
                        if ($bundleDiscount > 0) {
                            // Assign discount proportionally to each item in bundle
                            for ($i = 0; $i < $bundleQty; $i++) {
                                $uIdx = $start + $i;
                                if (isset($units[$uIdx]) && $bundleCurrentOriginalTotal > 0) {
                                    $lIdx = $units[$uIdx]['idx'];
                                    $itemPortion = $units[$uIdx]['price'] / $bundleCurrentOriginalTotal;
                                    $itemDiscount = round($bundleDiscount * $itemPortion, 4);
                                    $adjustments[$lIdx]['discount_amount'] += $itemDiscount;
                                    $adjustments[$lIdx]['offer_applied'] = true;
                                }
                            }
                        }
                    }
                }
            }
            
            // Common finish for the group: final override
            foreach ($group['indices'] as $idx) {
                $lineBase = round($tempLines[$idx]['unitPrice'] * $tempLines[$idx]['qty'], 2);
                $adjustments[$idx]['payable_override'] = round(max(0, $lineBase - $adjustments[$idx]['discount_amount']), 2);
            }
        }

        // 3. Final calculations and line construction
        foreach ($tempLines as $idx => $line) {
            $item = $line['item'];
            $productId = $line['productId'];
            $qty = $line['qty'];
            $unitPrice = $line['unitPrice'];
            $offer = $line['offer'];
            $detailId = $line['detailId'];
            $size = $line['size'];
            $color = $line['color'];

            // Use adjustments if Buy X Get Y Free was applied globally
            if (isset($adjustments[$idx]) && $adjustments[$idx]['offer_applied']) {
                $offerMeta = [
                    'offer_id' => $offer->id,
                    'offer_title' => $offer->title,
                    'offer_type' => $offer->type,
                    'discount_amount' => $adjustments[$idx]['discount_amount'],
                    'payable_amount' => $adjustments[$idx]['payable_override'],
                    'free_qty' => $adjustments[$idx]['free_qty'],
                    'cashback_amount' => 0.0,
                    'offer_applied' => true,
                ];
            } else {
                $offerMeta = $this->applyProductOffer($unitPrice, $qty, $offer);
            }
            
            $effectiveUnitPrice = $qty > 0 ? ($offerMeta['payable_amount'] / $qty) : $unitPrice;
            $lineRaw = (float) $offerMeta['payable_amount'];

            $taxMeta = DB::table('products')->where('id', $productId)->select('tax_id', 'gst_id')->first();
            $taxRate = (float) ($taxMeta->gst_id ?? 0);
            $isTaxIncluded = ((int) ($taxMeta->tax_id ?? 1) === 1);

            if ($isTaxIncluded) {
                $lineTax = $taxRate > 0 ? ($lineRaw * $taxRate) / (100 + $taxRate) : 0.0;
                $lineSubtotal = $lineRaw - $lineTax;
                $lineTotal = $lineRaw;
                $taxType = 'Included';
            } else {
                $lineTax = $taxRate > 0 ? ($lineRaw * $taxRate) / 100 : 0.0;
                $lineSubtotal = $lineRaw;
                $lineTotal = $lineRaw + $lineTax;
                $taxType = 'Excluded';
            }

            $subtotal += $lineSubtotal;
            $taxTotal += $lineTax;
            $grandWithoutDelivery += $lineTotal;
            $discountTotal += (float) ($offerMeta['discount_amount'] ?? 0);
            $cashbackTotal += (float) ($offerMeta['cashback_amount'] ?? 0);

            $lines[] = [
                'id' => $item->id,
                'product_id' => $productId,
                'detail_id' => (int) $detailId,
                'name' => (string) ($item->name ?? 'Product'),
                'image' => $item->attributes->image ?? null,
                'size' => $size,
                'color' => $color,
                'qty' => $qty,
                'unit_price' => $unitPrice,
                'effective_unit_price' => $effectiveUnitPrice,
                'base_amount' => round($unitPrice * $qty, 2),
                'discount_amount' => round((float) ($offerMeta['discount_amount'] ?? 0), 2),
                'payable_amount' => round($offerMeta['payable_amount'], 2),
                'offer_id' => $offerMeta['offer_id'],
                'offer_title' => $offerMeta['offer_title'],
                'offer_type' => $offerMeta['offer_type'],
                'offer_applied' => (bool) $offerMeta['offer_applied'],
                'free_qty' => (int) ($offerMeta['free_qty'] ?? 0),
                'cashback_amount' => round((float) ($offerMeta['cashback_amount'] ?? 0), 2),
                'stock_reduction_qty' => $qty + (int) ($offerMeta['free_qty'] ?? 0),
                'line_subtotal' => round($lineSubtotal, 2),
                'tax_rate' => round($taxRate, 2),
                'tax_type' => $taxType,
                'tax_amount' => round($lineTax, 2),
                'line_total' => round($lineTotal, 2),
            ];
        }

        $deliveryCharge = $this->calculateDeliveryCharge($grandWithoutDelivery);

        return [
            'lines' => $lines,
            'subtotal' => round($subtotal, 2),
            'discount_total' => round($discountTotal, 2),
            'tax_total' => round($taxTotal, 2),
            'cashback_total' => round($cashbackTotal, 2),
            'delivery_charge' => round($deliveryCharge, 2),
            'grand_total' => round($grandWithoutDelivery + $deliveryCharge, 2),
        ];
    }
}
