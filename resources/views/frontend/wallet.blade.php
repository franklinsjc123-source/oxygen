@extends('app_template')
@section('title','My Wishlist')
@section('content')

<main class="main wishlist-page">
    <nav class="breadcrumb-nav mb-4 mt-4">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Wallet</li>
            </ul>
        </div>
    </nav>

    <div class="container mb-10 mt-2">
        <h2 class="title title-center mb-5">My Wallet</h2>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="text-muted mb-2">Available Balance</div>
                        <h2 class="mb-0"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($walletBalance ?? 0, 2) }}</h2>
                    </div>
                </div>
                @if(($pendingCashback ?? 0) > 0)
                    <div class="card" style="background: #fffbeb; border: 1px solid #fef3c7;">
                        <div class="card-body">
                            <div class="text-warning mb-1" style="font-weight: 600;"><i class="fas fa-clock mr-1"></i> Pending Cashback</div>
                            <h3 class="mb-1" style="color: #b45309;"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($pendingCashback, 2) }}</h3>
                            <small class="text-muted">Credited after order delivery & return/replace period completes</small>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Wallet Transactions</h4>
                        @if (($transactions ?? collect())->isEmpty())
                            <p class="text-muted mb-0">No wallet transactions found.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Order ID</th>
                                            <th>Offer</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y H:i') }}</td>
                                                <td>{{ $transaction->order_id }}</td>
                                                <td>{{ $transaction->offer_title ?: 'Cashback' }}</td>
                                                <td>{{ ucfirst($transaction->status ?? 'credited') }}</td>
                                                <td><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format((float) $transaction->amount, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
        
@endsection
