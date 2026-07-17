@extends('layout.auth.master')
@section('contents')

@include('paritials.auth.topmenu');

<style>
    .swal2-popup {
        font-size: 1.6rem !important;
    }
    .badge-pending {
        background-color: #f1c40f !important;
        color: #fff !important;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 4px;
    }
    .badge-approved {
        background-color: #2ecc71 !important;
        color: #fff !important;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 4px;
    }
    .badge-rejected {
        background-color: #e74c3c !important;
        color: #fff !important;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 4px;
    }
    .badge-type {
        background-color: #3498db !important;
        color: #fff !important;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 4px;
    }
    .product-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
</style>

<div class="page-body-wrapper">
    @include('paritials.staffauth.sidemenu');

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Returns & Replacements</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ route('staffdashboard', session()->get('login_id')) }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Returns & Replacements</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Return & Replacement Requests List</h5>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Customer Info</th>
                                            <th>Invoice ID</th>
                                            <th>Products</th>
                                            <th>Type</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($returns as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ Carbon\Carbon::parse($item->created_at)->timezone('Asia/Kolkata')->format('d-m-Y h:i A') }}</td>
                                                <td>
                                                    <strong>{{ $item->customer_firstname }} {{ $item->customer_lastname }}</strong><br>
                                                    <small class="text-muted"><i class="fa fa-envelope"></i> {{ $item->customer_email }}</small><br>
                                                    <small class="text-muted"><i class="fa fa-phone"></i> {{ $item->customer_mobileno }}</small>
                                                </td>
                                                <td><code>{{ $item->invoice_id }}</code></td>
                                                <td>
                                                    @foreach($item->products as $prod)
                                                        <div class="d-flex align-items-center mb-1">
                                                            <img src="{{ asset('assets/images/products/detail/' . $prod->product_image) }}" class="product-img me-2" alt="product">
                                                            <span>{{ $prod->product_name }}</span>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="badge-type">{{ $item->request_type }}</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0 text-wrap" style="max-width: 250px; font-style: italic;">"{{ $item->reason }}"</p>
                                                </td>
                                                <td>
                                                    @if(strtolower($item->status) === 'pending')
                                                        <span class="badge-pending">Pending</span>
                                                    @elseif(strtolower($item->status) === 'approved')
                                                        <span class="badge-approved">Approved</span>
                                                    @else
                                                        <span class="badge-rejected">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(strtolower($item->status) === 'pending')
                                                        <div class="d-flex gap-2">
                                                            <form action="{{ route('staffreturns.status', $item->id) }}" method="POST" id="approve-form-{{ $item->id }}">
                                                                @csrf
                                                                <input type="hidden" name="status" value="Approved">
                                                                <button type="button" class="btn btn-xs btn-success" onclick="confirmAction({{ $item->id }}, 'Approve')">
                                                                    <i class="fa fa-check"></i> Approve
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('staffreturns.status', $item->id) }}" method="POST" id="reject-form-{{ $item->id }}">
                                                                @csrf
                                                                <input type="hidden" name="status" value="Rejected">
                                                                <button type="button" class="btn btn-xs btn-danger" onclick="confirmAction({{ $item->id }}, 'Reject')">
                                                                    <i class="fa fa-times"></i> Reject
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <span class="text-muted"><small>Resolved</small></span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No return/replacement requests found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmAction(id, action) {
    const actionLower = action.toLowerCase();
    Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to ${actionLower} this return/replacement request?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: action === 'Approve' ? '#2ecc71' : '#e74c3c',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: `Yes, ${action}!`
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`${actionLower}-form-${id}`).submit();
        }
    });
}
</script>

@endsection
