@extends('app_template')
@section('title', 'My Wallet')
@section('content')

<style>
    /* ─── WALLET MODERN STYLES ─── */
    .wallet-page-wrapper {
        background-color: #f8fafc;
        min-height: 75vh;
        padding-bottom: 60px;
    }
    .wallet-container {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }
    .wallet-header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .wallet-header-title h3 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        letter-spacing: -0.3px;
    }
    .wallet-header-title p {
        font-size: 1.3rem;
        color: #64748b;
        margin: 2px 0 0;
    }
    .wallet-top-card {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border-radius: 16px;
        padding: 26px 30px;
        color: #ffffff;
        box-shadow: 0 10px 25px rgba(2, 132, 199, 0.22);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        position: relative;
        overflow: hidden;
    }
    .wallet-top-card::after {
        content: "\f555";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: 20px;
        bottom: -20px;
        font-size: 130px;
        color: rgba(255, 255, 255, 0.08);
        pointer-events: none;
    }
    .wallet-balance-wrap {
        display: flex;
        flex-direction: column;
        gap: 6px;
        position: relative;
        z-index: 1;
    }
    .wallet-balance-label {
        font-size: 12.5px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.85);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .wallet-badge-active {
        background: rgba(255, 255, 255, 0.22);
        color: #ffffff;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.3px;
    }
    .wallet-balance-amount {
        font-size: 3.4rem;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.5px;
        color: #ffffff;
    }
    .wallet-balance-subtext {
        font-size: 12.5px;
        color: rgba(255, 255, 255, 0.85);
        margin: 2px 0 0;
    }
    .wallet-quick-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }
    .wallet-btn-light {
        background: #ffffff;
        color: #0369a1 !important;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 18px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        text-decoration: none !important;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .wallet-btn-light:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* How Wallet Works Card */
    .wallet-how-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 22px 24px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
    }
    .wallet-how-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 16px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .wallet-steps-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
    }
    .wallet-step-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px;
        display: flex;
        gap: 14px;
        align-items: flex-start;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }
    .wallet-step-num {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #e0f2fe;
        color: #0284c7;
        font-weight: 800;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .wallet-step-content h5 {
        font-size: 13.5px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 4px 0;
    }
    .wallet-step-content p {
        font-size: 12px;
        color: #64748b;
        margin: 0;
        line-height: 1.45;
    }

    /* Transactions Section */
    .wallet-tx-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }
    .wallet-tx-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 18px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    .wallet-tx-header h4 {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .wallet-tx-table {
        width: 100%;
        border-collapse: collapse;
    }
    .wallet-tx-table th {
        background: #f8fafc;
        padding: 12px 20px;
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
    }
    .wallet-tx-table td {
        padding: 16px 20px;
        font-size: 13.5px;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .wallet-tx-table tr:last-child td {
        border-bottom: none;
    }
    .tx-badge-credit {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
        padding: 3px 10px;
        border-radius: 9999px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .tx-badge-debit {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: 3px 10px;
        border-radius: 9999px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .tx-badge-pending {
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid #fed7aa;
        padding: 3px 10px;
        border-radius: 9999px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .tx-amount-plus {
        font-weight: 800;
        color: #16a34a;
        font-size: 15px;
    }
    .tx-amount-minus {
        font-weight: 800;
        color: #dc2626;
        font-size: 15px;
    }
    .wallet-empty-state {
        text-align: center;
        padding: 48px 20px;
        color: #64748b;
    }
    .wallet-empty-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin: 0 auto 16px;
    }
    .wallet-breadcrumb-wrap {
        padding: 10px 0;
        margin-bottom: 12px;
    }
    .wallet-breadcrumb-wrap .breadcrumb {
        padding: 5px 0;
        margin-bottom: 0;
    }
</style>

<div class="wallet-page-wrapper">
    <nav class="breadcrumb-nav wallet-breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Wallet</li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="wallet-container">

            {{-- Header Bar with Title --}}
            <div class="wallet-header-bar">
                <div class="wallet-header-title">
                    <h3><i class="w-icon-wallet2 text-primary mr-1"></i> My Wallet</h3>
                    <p>Manage your wallet balance and review your cashback earnings</p>
                </div>
            </div>

            {{-- Main Wallet Balance Card --}}
            <div class="wallet-top-card">
                <div class="wallet-balance-wrap">
                    <span class="wallet-balance-label">
                        <span>Available Balance</span>
                        <span class="wallet-badge-active"><i class="fas fa-check-circle mr-1"></i> Active</span>
                    </span>
                    <div class="wallet-balance-amount">
                        <span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($walletBalance ?? 0, 2) }}
                    </div>
                    @if(($pendingCashback ?? 0) > 0)
                        <div style="font-size: 1.3rem; color: #fef08a; margin-top: 4px; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                            <i class="fas fa-clock"></i>
                            <span><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($pendingCashback, 2) }} Pending (credited after return/replace date)</span>
                        </div>
                    @endif
                    <p class="wallet-balance-subtext">
                        <i class="fas fa-shield-alt mr-1"></i> 100% secure • Redeemable on all future purchases
                    </p>
                </div>
                <div class="wallet-quick-actions">
                    <a href="{{ url('offers') }}" class="wallet-btn-light">
                        <i class="fas fa-tag"></i> Explore Cashback Offers
                    </a>
                    <a href="{{ url('home') }}" class="wallet-btn-light" style="background: rgba(255, 255, 255, 0.15); color: #ffffff !important; border: 1px solid rgba(255,255,255,0.4);">
                        <i class="fas fa-shopping-bag"></i> Start Shopping
                    </a>
                </div>
            </div>

            {{-- How Wallet Works / How Amount is Added Section --}}
            <div class="wallet-how-card">
                <div class="wallet-how-title">
                    <i class="fas fa-info-circle text-primary"></i> How Wallet & Cashback Work
                </div>
                <div class="wallet-steps-grid">
                    <div class="wallet-step-item">
                        <div class="wallet-step-num">1</div>
                        <div class="wallet-step-content">
                            <h5>Shop with Offers</h5>
                            <p>Buy products tagged with exclusive cashback offers (e.g. Cashback ₹50 Off).</p>
                        </div>
                    </div>
                    <div class="wallet-step-item">
                        <div class="wallet-step-num">2</div>
                        <div class="wallet-step-content">
                            <h5>Cashback Credit</h5>
                            <p>After your order is successfully delivered and the return or replace date has completed, cashback is automatically credited into your wallet.</p>
                        </div>
                    </div>
                    <div class="wallet-step-item">
                        <div class="wallet-step-num">3</div>
                        <div class="wallet-step-content">
                            <h5>Redeem & Save</h5>
                            <p>Use your wallet balance to get instant deductions during checkout on subsequent orders.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Transactions History Card --}}
            <div class="wallet-tx-card">
                <div class="wallet-tx-header">
                    <h4>
                        <i class="fas fa-history text-primary"></i> Transaction History
                    </h4>
                    <span class="text-muted" style="font-size: 1.25rem;">
                        {{ isset($walletTransactions) ? $walletTransactions->count() : (isset($transactions) ? $transactions->count() : 0) }} records
                    </span>
                </div>

                @php
                    $txList = $walletTransactions ?? $transactions ?? collect();
                @endphp

                @if($txList->count() > 0)
                    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%;">
                        <table class="wallet-tx-table">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Order ID</th>
                                    <th>Details / Offer</th>
                                    <th>Status</th>
                                    <th style="text-align: right;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($txList as $tx)
                                    @php
                                        $txType = strtolower((string) ($tx->type ?? 'credit'));
                                        $isCredit = in_array($txType, ['cashback_credit', 'credit'], true);
                                        $status = strtolower((string) ($tx->status ?? 'credited'));
                                    @endphp
                                    <tr>
                                        <td style="font-size: 1.25rem; color: #64748b; white-space: nowrap;">
                                            {{ \Carbon\Carbon::parse($tx->created_at)->format('d M Y, h:i A') }}
                                        </td>
                                        <td>
                                            @if(!empty($tx->order_id))
                                                <span style="font-weight: 700; color: #0284c7;">#{{ $tx->order_id }}</span>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="font-weight: 600; color: #1e293b;">
                                                {{ $tx->offer_title ?: ($isCredit ? 'Cashback Reward' : 'Wallet Deduction') }}
                                            </div>
                                            @if(!empty($tx->remarks) && $tx->remarks !== $tx->offer_title)
                                                <small class="text-muted" style="font-size: 1.15rem;">{{ $tx->remarks }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($status === 'credited' || $status === 'completed' || $status === 'success')
                                                <span class="tx-badge-credit"><i class="fas fa-check-circle mr-1"></i> Credited</span>
                                            @elseif($status === 'pending')
                                                <span class="tx-badge-pending"><i class="fas fa-clock mr-1"></i> Pending</span>
                                            @elseif($status === 'debited')
                                                <span class="tx-badge-debit"><i class="fas fa-minus-circle mr-1"></i> Debited</span>
                                            @else
                                                <span class="tx-badge-pending">{{ ucfirst($status) }}</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right; white-space: nowrap;">
                                            @if($isCredit)
                                                <span class="tx-amount-plus">+<span style="font-family: Arial, sans-serif;">₹</span>{{ number_format((float) $tx->amount, 2) }}</span>
                                            @else
                                                <span class="tx-amount-minus">-<span style="font-family: Arial, sans-serif;">₹</span>{{ number_format((float) $tx->amount, 2) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="wallet-empty-state">
                        <div class="wallet-empty-icon">
                            <i class="w-icon-wallet2"></i>
                        </div>
                        <h4 style="font-size: 1.6rem; font-weight: 700; color: #1e293b; margin-bottom: 6px;">No Wallet Transactions Yet</h4>
                        <p style="font-size: 1.3rem; color: #64748b; max-width: 440px; margin: 0 auto 18px;">
                            When you purchase products with cashback offers or receive refunds, your wallet transactions and earnings will appear right here.
                        </p>
                        <a href="{{ url('offers') }}" class="btn btn-primary btn-sm btn-rounded" style="padding: 9px 22px; font-weight: 700;">
                            <i class="fas fa-gift mr-1"></i> View Cashback Deals
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection
