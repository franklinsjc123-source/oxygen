@php
    $colors = ['#10b981', '#f43f5e', '#f59e0b', '#8b5cf6'];
    $color = $colors[$index % count($colors)];
    
    $pct = $act->pipline ?? 75;
    $pctEnd = min(100, $pct + 25);
    
    $pillBg = '#d1fae5';
    $pillText = '#065f46';
    
    if ($pct < 40) {
        $pillBg = '#fee2e2';
        $pillText = '#991b1b';
    } elseif ($pct < 70) {
        $pillBg = '#fef3c7';
        $pillText = '#92400e';
    }
    
    $timeStr = 'Today, 2:00 PM';
    if ($act->next_follow_date) {
        $dt = new \DateTime($act->next_follow_date);
        $timeStr = $dt->format('d M, h:i A');
        if ($dt->format('Y-m-d') === date('Y-m-d')) {
            $timeStr = 'Today, ' . $dt->format('h:i A');
        }
    }
    
    // Fallbacks for details
    $staffName = $act->staff_name ?? 'Staff Member';
    $shopName = $act->shop_name ?? 'Shop Name';
    $statusText = $act->status ?? 'Follow Up';
    $areaText = $act->area ?? 'General Area';
    
    $fullAddress = '';
    if (!empty($act->address1)) $fullAddress .= $act->address1;
    if (!empty($act->address)) {
        if ($fullAddress) $fullAddress .= ', ';
        $fullAddress .= $act->address;
    }
    if (!empty($act->city)) {
        if ($fullAddress) $fullAddress .= ', ';
        $fullAddress .= $act->city;
    }
    if (!empty($act->pincode)) {
        if ($fullAddress) $fullAddress .= ' - ';
        $fullAddress .= $act->pincode;
    }
    if (empty($fullAddress)) {
        $fullAddress = 'Address not specified';
    }
@endphp

<div class="activity-card" style="--indicator-color: {{ $color }};">
    <div class="activity-card-row1">
        <span class="activity-staff-name">{{ $staffName }}</span>
        <span class="activity-time" style="color: {{ $color }};">{{ $timeStr }}</span>
    </div>
    
    <div class="activity-card-row2">
        <span class="activity-shop-name">{{ $shopName }}</span>
        <span class="activity-status-label">{{ $statusText }}</span>
    </div>
    
    <div class="activity-card-row3">
        <span class="activity-area">
            <i class="fa fa-map-marker-alt me-1"></i> {{ $areaText }}
        </span>
        <span class="activity-percentage-pill" style="background-color: {{ $pillBg }}; color: {{ $pillText }};">
            {{ $pct }}% - {{ $pctEnd }}%
        </span>
    </div>
    
    <div class="activity-address text-truncate" title="{{ $fullAddress }}">
        {{ $fullAddress }}
    </div>
</div>
