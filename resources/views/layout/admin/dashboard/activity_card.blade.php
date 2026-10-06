@php
    $win = $act->win ?? '';
    $pctStart = 75;
    $pctEnd = 100;
    if ($win) {
        preg_match_all('/\d+/', $win, $allMatches);
        if (isset($allMatches[0]) && count($allMatches[0]) >= 2) {
            $pctStart = (int) $allMatches[0][0];
            $pctEnd = (int) $allMatches[0][1];
        } elseif (isset($allMatches[0]) && count($allMatches[0]) == 1) {
            $pctStart = (int) $allMatches[0][0];
            $pctEnd = min(100, $pctStart + 25);
        }
    }
    
    if ($pctStart < 40) {
        $color = '#f43f5e'; // Red
    } elseif ($pctStart < 70) {
        $color = '#f59e0b'; // Yellow
    } else {
        $color = '#10b981'; // Green
    }
    
    $pillBg = $color;
    $pillText = '#ffffff';
    
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
            {{ $pctStart }}% - {{ $pctEnd }}%
        </span>
    </div>
    
    <div class="activity-address text-truncate" title="{{ $fullAddress }}">
        {{ $fullAddress }}
    </div>
</div>
