@extends('layout.auth.master')
@section('title', 'Seller Requests - Admin')
@section('contents')
<style>
    .seller-lead-card {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
        background: #fff;
        padding: 20px;
        margin-bottom: 20px;
    }
    .stat-badge {
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1.2;
    }
    .table td, .table th {
        vertical-align: middle !important;
    }
</style>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">

    <!-- Page Sidebar Start-->
    @include('paritials.auth.sidemenu')
    <!-- Page Sidebar Ends-->

    <div class="page-body">

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Sellers</li>
                            <li class="breadcrumb-item active">Seller Requests & Enquiries</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
                    <i class="fa fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Summary KPI Cards -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="seller-lead-card" style="border-left: 5px solid #4361ee;">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">Total Requests</span>
                        <div class="stat-badge text-primary mt-1">{{ $totalCount }}</div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="seller-lead-card" style="border-left: 5px solid #f77f00;">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">Pending Review</span>
                        <div class="stat-badge text-warning mt-1" style="color: #f77f00 !important;">{{ $pendingCount }}</div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="seller-lead-card" style="border-left: 5px solid #06d6a0;">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">Contacted</span>
                        <div class="stat-badge mt-1" style="color: #06d6a0 !important;">{{ $contactedCount }}</div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="seller-lead-card" style="border-left: 5px solid #2ec4b6;">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">Approved</span>
                        <div class="stat-badge mt-1" style="color: #2ec4b6 !important;">{{ $approvedCount }}</div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Form -->
            <div class="card mb-4" style="border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
                <div class="card-body p-3">
                    <form method="GET" action="{{ route('admin.seller_leads.index') }}" class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa fa-search text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="keyword" value="{{ request('keyword') }}" placeholder="Search by Shop, Name, Phone, Email, City...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">-- All Statuses --</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Contacted" {{ request('status') == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-3">
                                <i class="fa fa-filter me-1"></i> Filter
                            </button>
                            <a href="{{ route('admin.seller_leads.index') }}" class="btn btn-outline-secondary px-3">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Requests Table -->
            <div class="card" style="border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #e2e8f0;">
                    <h5 class="mb-0 fw-bold" style="color: #1e293b;">
                        <i class="fa fa-users text-primary me-2"></i> New Seller Registrations ({{ $leads->total() }})
                    </h5>
                    <div>
                        <a href="{{ url('seller/register') }}" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                            <i class="fa fa-external-link me-1"></i> Open Public Registration Page
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size: 0.92rem;">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                                <tr>
                                    <th style="width: 60px;" class="ps-3">ID</th>
                                    <th>Date</th>
                                    <th>Shop / Business</th>
                                    <th>Contact Details</th>
                                    <th>Location</th>
                                    <th>Message / Notes</th>
                                    <th>Status</th>
                                    <th style="width: 140px;" class="text-end pe-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leads as $lead)
                                    <tr>
                                        <td class="ps-3 fw-bold text-muted">#{{ $lead->id }}</td>
                                        <td>
                                            <span class="fw-semibold text-dark">{{ $lead->created_at ? $lead->created_at->format('d M, Y') : '-' }}</span><br>
                                            <small class="text-muted">{{ $lead->created_at ? $lead->created_at->format('h:i A') : '' }}</small>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark" style="font-size: 1rem;">{{ $lead->shop_name }}</span><br>
                                            @if($lead->business_category)
                                                <span class="badge bg-light text-dark border mt-1">{{ $lead->business_category }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark"><i class="fa fa-user me-1 text-muted"></i> {{ $lead->owner_name }}</span><br>
                                            <a href="tel:{{ $lead->mobile_number }}" class="text-primary text-decoration-none fw-semibold">
                                                <i class="fa fa-phone me-1"></i> +91 {{ $lead->mobile_number }}
                                            </a>
                                            @if($lead->email)
                                                <br><small class="text-muted"><i class="fa fa-envelope me-1"></i> {{ $lead->email }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-semibold"><i class="fa fa-map-marker me-1 text-danger"></i> {{ $lead->city ?? 'N/A' }}</span>
                                            @if($lead->address)
                                                <br><small class="text-muted" title="{{ $lead->address }}">{{ \Illuminate\Support\Str::limit($lead->address, 35) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($lead->message)
                                                <span title="{{ $lead->message }}" style="color: #475569;">
                                                    {{ \Illuminate\Support\Str::limit($lead->message, 45) }}
                                                </span>
                                            @else
                                                <span class="text-muted fst-italic">None</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $badgeClass = match($lead->status) {
                                                    'Approved'  => 'bg-success',
                                                    'Contacted' => 'bg-info text-dark',
                                                    'Rejected'  => 'bg-danger',
                                                    default     => 'bg-warning text-dark',
                                                };
                                            @endphp
                                            <!-- Status Dropdown Form -->
                                            <form method="POST" action="{{ route('admin.seller_leads.update_status', $lead->id) }}" class="d-inline">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm {{ $badgeClass }} fw-semibold" style="width: auto; display: inline-block; cursor: pointer; border-radius: 6px;">
                                                    <option value="Pending" {{ $lead->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Contacted" {{ $lead->status == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                                    <option value="Approved" {{ $lead->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="Rejected" {{ $lead->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="text-end pe-3">
                                            <div class="d-flex justify-content-end gap-1">
                                                <!-- WhatsApp Contact Button -->
                                                <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $lead->mobile_number) }}?text=Hello%20{{ urlencode($lead->owner_name) }},%20thank%20you%20for%20registering%20to%20become%20a%20seller%20on%20TrymeNow!" target="_blank" class="btn btn-sm btn-success" title="Chat on WhatsApp" style="background-color: #25d366; border-color: #25d366; border-radius: 6px;">
                                                    <i class="fa fa-whatsapp"></i>
                                                </a>

                                                <!-- Call Button -->
                                                <a href="tel:{{ $lead->mobile_number }}" class="btn btn-sm btn-outline-primary" title="Call Seller" style="border-radius: 6px;">
                                                    <i class="fa fa-phone"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <form method="POST" action="{{ route('admin.seller_leads.destroy', $lead->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this seller request?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" style="border-radius: 6px;">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-muted">
                                            <i class="fa fa-inbox fa-3x mb-3 text-secondary" style="opacity: 0.5;"></i>
                                            <p class="mb-0 fw-semibold" style="font-size: 1.1rem;">No seller requests found</p>
                                            <small>New applications submitted from the seller portal will appear here.</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($leads->hasPages())
                        <div class="p-3 d-flex justify-content-between align-items-center" style="border-top: 1px solid #e2e8f0;">
                            <div class="text-muted" style="font-size: 0.85rem;">
                                Showing {{ $leads->firstItem() }} to {{ $leads->lastItem() }} of {{ $leads->total() }} results
                            </div>
                            <div>
                                {{ $leads->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <!-- Container-fluid Ends-->
    </div>
</div>
@endsection

