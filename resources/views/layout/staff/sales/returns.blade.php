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
                    <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('staffdashboard', session()->get('login_id')) }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Returns & Replacements</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .fixed-table-toolbar {
                display: flex !important;
                flex-wrap: wrap;
                align-items: center;
                margin-bottom: 15px;
            }
            .fixed-table-toolbar .search {
                order: 1;
                flex: 1;
                margin-bottom: 0 !important;
                float: none !important;
            }
            .fixed-table-toolbar .search input {
                width: 100% !important;
                max-width: 100% !important;
            }
            .fixed-table-toolbar .columns {
                order: 2;
                margin-left: 10px;
                margin-bottom: 0 !important;
                float: none !important;
            }
            .fixed-table-toolbar .bs-bars {
                order: 3;
                margin-left: 15px;
                margin-top: 0 !important;
                float: none !important;
                width: auto !important;
            }
        </style>

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

                            <div class="row">
                                <div id="toolbar" class="d-flex align-items-center">
                                    <button type="button" class="btn btn-success btn-export-excel" style="background-color: #73b400; border-color: #73b400; color: #fff;"><i class="fa fa-file-excel-o me-1"></i> EXPORT EXCEL</button>
                                </div>
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id" data-show-columns="true" data-sort-order="desc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="false" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="false" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="id" data-sortable="true">ID</th>
                                                <th data-field="date" data-sortable="true">Date</th>
                                                <th data-field="customer" data-sortable="true">Customer Info</th>
                                                <th data-field="invoice" data-sortable="true">Invoice ID</th>
                                                <th data-field="products" data-sortable="true">Products</th>
                                                <th data-field="type" data-sortable="true">Type</th>
                                                <th data-field="reason" data-sortable="true">Reason</th>
                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th data-field="action" data-sortable="true">Action</th>
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
