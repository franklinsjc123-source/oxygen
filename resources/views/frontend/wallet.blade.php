@extends('app_template')
@section('title','My Wishlist')
@section('content')

<main class="main wishlist-page">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Wallet</h1>
        </div>
    </div>

    <nav class="breadcrumb-nav mb-10">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Wallet</li>
            </ul>
        </div>
    </nav>

  

</main>
        
@endsection