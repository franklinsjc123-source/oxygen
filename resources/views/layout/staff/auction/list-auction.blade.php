@extends('layout.auth.master')
@section('contents')

<style>
.pulse-indicator {
    display: inline-flex;
    align-items: center;
    background: rgba(16, 185, 129, 0.15);
    color: #10b981;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: 1px solid rgba(16, 185, 129, 0.3);
}
.pulse-dot {
    width: 8px;
    height: 8px;
    background-color: #10b981;
    border-radius: 50%;
    margin-right: 6px;
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    animation: pulse 1.2s infinite;
}
@keyframes pulse {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    }
    70% {
        transform: scale(1);
        box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
    }
    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
    }
}
</style>

@include('paritials.css.auction.auction')?>

    @include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.staffauth.sidemenu');
	<!-- Page Sidebar Ends-->
	
	<!-- Right sidebar Start-->
	
	<!-- Right sidebar Ends-->
	
         <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>{{ $title ?? 'List Auction' }}
                                    @if(isset($title) && $title === 'Live Auction')
                                        <span class="pulse-indicator" style="margin-left: 10px; vertical-align: middle;">
                                            <span class="pulse-dot"></span>Live Performance
                                        </span>
                                    @endif
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">{{ $title ?? 'List Auction' }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                           
                            <div class="card-body">
                                
                          @if(!isset($title) || $title !== 'Live Auction')
                          <a href="{{route('staffauction.create')}}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Offers </a> 
                          @endif
                                    @if(!isset($title) || $title !== 'Live Auction')
                                    <div class="card-body">
                                        <form action="{{ route('staffimport') }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file"
                                                   class="form-control">
                                             @error('file')
                                                 <div class="invalid-feedback-custom" style="display: block; color: #dc3545; font-size: 1.05rem; margin-top: 0.25rem;">Please upload file</div>
                                             @enderror
                                            <br>
                                            <button class="btn btn-success">
                                                  Import Auction Data
                                               </button>
                                            {{-- <a class="btn btn-warning"
                                               href="{{ url('export') }}">
                                                      Export Auction Data
                                              </a> --}}
                                        </form>
                                    </div>
                                    @endif

                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
                    <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                         data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                    <thead>
                     <tr>
                        <th data-field="product_name" data-sortable="true">Product Name</th>
                        <th data-field="sprice" data-sortable="true">Starting Price</th>
                        <th data-field="slab" data-sortable="true">SLAB</th> 
                        @if(isset($title) && $title === 'Live Auction')
                        <th data-field="current_bid" data-sortable="true">Current Bid</th>
                        <th data-field="time_remaining" data-sortable="true">Time Remaining</th>
                        @else
                        <th data-field="bid" data-sortable="true">BID Price</th>
                    	<th data-field="so" data-sortable="true">Stat Offer</th>                    
                    	<th data-field="eo" data-sortable="true">End Offer</th>
                        <th data-field="status" data-sortable="true">Status</th>
                        @endif
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ( $auction as $item)
                    <tr>
                        <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                        <td>{{$item->start_price}}</td>
                        <td>{{$item->slab}}</td>
                        @if(isset($title) && $title === 'Live Auction')
                        <td>
                           <div style="font-weight: 700; color: #10b981; font-size: 1.3rem;">
                               ₹{{ number_format($item->highestBid->bid_amount ?? $item->start_price, 2) }}
                           </div>
                           <div style="font-size: 0.9rem; color: #64748b; font-weight: 600; margin-top: 2px;">
                               <i class="fa fa-gavel"></i> {{ $item->bids->count() }} bids
                           </div>
                        </td>
                        <td>
                           <span class="countdown-timer" data-endtime="{{ $item->end_date }}" style="font-weight: 700; font-family: monospace; font-size: 1.1rem; background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); padding: 4px 8px; border-radius: 4px; display: inline-block; letter-spacing: 0.05em; text-transform: uppercase;"></span>
                        </td>
                        @else
                        <td>{{$item->bid_price}}</td>
                        <td>{{ $item->start_date ? date('d-m-Y h:i A', strtotime($item->start_date)) : '' }}</td>
                		<td>{{ $item->end_date ? date('d-m-Y h:i A', strtotime($item->end_date)) : '' }}</td>
                        <td>
                            <?php
                                $sd = $item->start_date;
                                $ed= $item->end_date;                                    
                            ?>
                        <label class="switch">                         
                        @if($ed >= $date && $sd <= $date)                                                            
                            <input type="checkbox"
                                onclick="return confirm('you want to Change it?  Please Click Edit Button')"
                                checked id="togBtn">                                                            
                            @else
                                <input type="checkbox"
                                onclick="return confirm('you want to Change it?  Please Click Edit Button')" 
                                 id="togBtn">                                                            
                            @endif
                        <div class="slider round">
                            <!--ADDED HTML -->
                            <span class="off">Inactive</span>
                            <span class="on">Active</span>
                            <!--END-->
                        </div>                        
                        </label>                    
                        </div>                    
                        </td>
                        @endif

                        <td><span class="mt-3 d-flex">
                          @if(!isset($title) || $title !== 'Live Auction')
                            <form action="{{ route('staffauction.edit', $item->id) }}"
                                method="get">
                                @method('GET')
                                @csrf
                            <button class="btn btn-secondary mx-1"
                            onclick="return confirm('Are you sure, you want to Edit it?')"
                                    data-original-title="Edit"><i class="fa fa-pencil"></i> </button>
                            </form>
                          @endif

                          @if(isset($title) && $title === 'Live Auction')
                            <button type="button" class="btn btn-info mx-1 px-3" onclick="openBidsModal({{ $item->id }}, '{{ addslashes($item->product->product_name ?? 'N/A') }}')"><i class="fa fa-eye"></i> View Bids</button>
                          @endif
                            {{-- <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a> --}}
                          
                          @if(!isset($title) || $title !== 'Live Auction')
                            <form action="{{ route('staffauction.destroy', $item->id) }}"
                                method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-warning mx-1"
                                    onclick="return confirm('Are you sure, you want to delete it?')"><i
                                        class="fa fa-trash"></i>                                        
                                </button>                        
                            </form>
                          @endif
                            {{-- <a href="#" onclick="return confirm('Are you sure, you want to Edit it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>--}}</span></td>                        
                    </tr>
                    @endforeach 
                </tbody>
                </table>
            </div>
        </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>

        <!-- Bid History Modal -->
        <div id="bid-history-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 9999; justify-content: center; align-items: center; transition: opacity 0.3s ease; opacity: 0;">
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); width: 95%; max-width: 550px; border-radius: 24px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15); overflow: hidden; transform: scale(0.9); transition: transform 0.3s ease; padding: 24px; position: relative;">
                <!-- Close Button -->
                <button onclick="closeBidsModal()" style="position: absolute; top: 20px; right: 20px; background: #f1f5f9; border: none; border-radius: 50%; width: 36px; height: 36px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: bold; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#0f172a';" onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b';">
                    <i class="fas fa-times"></i>
                </button>

                <!-- Header -->
                <h4 style="margin: 0 0 4px 0; font-weight: 800; color: #0f172a; font-size: 20px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-history" style="color: #2563eb;"></i> Bid History
                </h4>
                <div id="bid-modal-product-title" style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 420px;">
                    <!-- Product title injected here -->
                </div>

                <!-- Content Area -->
                <div style="max-height: 400px; overflow-y: auto; padding-right: 4px; margin-top: 10px;">
                    <!-- Summary Cards -->
                    <div id="bid-history-summary" style="display: none; background: #f8fafc; border-radius: 16px; padding: 16px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <div style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Current High Bid</div>
                                <div id="summary-highest-bid" style="font-size: 20px; font-weight: 800; color: #10b981; margin-top: 2px;">₹0.00</div>
                            </div>
                            <div style="text-align: right;">
                                <div style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Total Bids</div>
                                <div id="summary-total-bids" style="font-size: 20px; font-weight: 800; color: #0f172a; margin-top: 2px;">0</div>
                            </div>
                        </div>
                    </div>

                    <div id="bid-history-loading" style="text-align: center; padding: 30px; color: #64748b;">
                        <i class="fas fa-circle-notch fa-spin" style="font-size: 28px; color: #2563eb; margin-bottom: 12px; display: block;"></i>
                        Loading bid history...
                    </div>

                    <!-- Bids Feed List -->
                    <div id="bid-history-list" style="display: none; flex-direction: column; gap: 12px; margin-top: 5px;">
                        <!-- Bids injected here -->
                    </div>

                    <div id="no-bids-message" style="display: none; text-align: center; padding: 30px; color: #64748b;">
                        <i class="fas fa-gavel" style="font-size: 36px; color: #cbd5e1; margin-bottom: 12px; display: block;"></i>
                        No bids have been placed yet.
                    </div>
                </div>
            </div>
        </div>
		
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    function updateCountdowns() {
        const now = new Date().getTime();
        document.querySelectorAll(".countdown-timer").forEach(timer => {
            const endTimeStr = timer.getAttribute("data-endtime");
            if (!endTimeStr) return;
            
            const parsedTime = endTimeStr.replace('T', ' ').replace(/-/g, '/');
            const endTime = new Date(parsedTime).getTime();
            const distance = endTime - now;

            if (distance < 0) {
                timer.innerHTML = "EXPIRED";
                timer.style.background = "rgba(100, 116, 139, 0.15)";
                timer.style.color = "#64748b";
                timer.style.borderColor = "rgba(100, 116, 139, 0.3)";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            let timeString = "";
            if (days > 0) timeString += days + "d ";
            if (hours > 0 || days > 0) timeString += hours + "h ";
            timeString += minutes + "m " + seconds + "s";

            timer.innerHTML = timeString;
        });
    }
    updateCountdowns();
    setInterval(updateCountdowns, 1000);
});
</script>
<script>
// ===================== BID HISTORY MODAL FUNCTIONS =====================
function openBidsModal(auctionId, productName) {
    var modal = document.getElementById('bid-history-modal');
    var loading = document.getElementById('bid-history-loading');
    var summary = document.getElementById('bid-history-summary');
    var list = document.getElementById('bid-history-list');
    var noBids = document.getElementById('no-bids-message');
    
    // Set product title
    document.getElementById('bid-modal-product-title').textContent = productName ? 'Product: ' + productName : '';
    
    // Show modal & loading
    modal.style.display = 'flex';
    setTimeout(function() {
        modal.style.opacity = '1';
        modal.firstElementChild.style.transform = 'scale(1)';
    }, 10);
    
    loading.style.display = 'block';
    summary.style.display = 'none';
    list.style.display = 'none';
    noBids.style.display = 'none';
    list.innerHTML = '';
    
    var url = "{{ url('auction') }}/" + auctionId + "/bids";
    fetch(url)
    .then(function(res) { return res.json(); })
    .then(function(data) {
        loading.style.display = 'none';
        if (data.bids && data.bids.length > 0) {
            // Show and populate summary
            summary.style.display = 'block';
            var highestBidVal = parseFloat(data.bids[0].bid_amount);
            document.getElementById('summary-highest-bid').textContent = '₹' + highestBidVal.toLocaleString('en-IN', {minimumFractionDigits: 2});
            document.getElementById('summary-total-bids').textContent = data.bids.length;
            
            // Build modern feed list
            list.style.display = 'flex';
            data.bids.forEach(function(bid, index) {
                var itemDiv = document.createElement('div');
                itemDiv.style.display = 'flex';
                itemDiv.style.alignItems = 'center';
                itemDiv.style.justifyContent = 'space-between';
                itemDiv.style.padding = '12px 16px';
                itemDiv.style.background = index === 0 ? 'rgba(16, 185, 129, 0.04)' : '#ffffff';
                itemDiv.style.border = index === 0 ? '1px solid rgba(16, 185, 129, 0.2)' : '1px solid #f1f5f9';
                itemDiv.style.borderRadius = '16px';
                itemDiv.style.transition = 'all 0.2s';
                
                // Left section: Avatar + Info
                var leftSec = document.createElement('div');
                leftSec.style.display = 'flex';
                leftSec.style.alignItems = 'center';
                leftSec.style.gap = '12px';
                
                // Initials avatar
                var avatar = document.createElement('div');
                avatar.style.width = '36px';
                avatar.style.height = '36px';
                avatar.style.borderRadius = '50%';
                avatar.style.background = index === 0 ? '#10b981' : '#f1f5f9';
                avatar.style.color = index === 0 ? '#ffffff' : '#475569';
                avatar.style.display = 'flex';
                avatar.style.alignItems = 'center';
                avatar.style.justifyContent = 'center';
                avatar.style.fontWeight = '700';
                avatar.style.fontSize = '14px';
                avatar.textContent = bid.customer_name ? bid.customer_name.charAt(0).toUpperCase() : 'U';
                leftSec.appendChild(avatar);
                
                // Name and details
                var details = document.createElement('div');
                
                var nameContainer = document.createElement('div');
                nameContainer.style.display = 'flex';
                nameContainer.style.alignItems = 'center';
                nameContainer.style.gap = '6px';
                
                var nameSpan = document.createElement('span');
                nameSpan.style.fontWeight = '700';
                nameSpan.style.color = '#0f172a';
                nameSpan.style.fontSize = '14px';
                nameSpan.textContent = bid.customer_name;
                nameContainer.appendChild(nameSpan);
                
                if (index === 0) {
                    var leaderBadge = document.createElement('span');
                    leaderBadge.style.background = 'rgba(16, 185, 129, 0.15)';
                    leaderBadge.style.color = '#10b981';
                    leaderBadge.style.fontSize = '10px';
                    leaderBadge.style.fontWeight = '800';
                    leaderBadge.style.padding = '2px 8px';
                    leaderBadge.style.borderRadius = '9999px';
                    leaderBadge.style.letterSpacing = '0.05em';
                    leaderBadge.textContent = 'LEADING';
                    nameContainer.appendChild(leaderBadge);
                }
                details.appendChild(nameContainer);
                
                var subtext = document.createElement('div');
                subtext.style.fontSize = '12px';
                subtext.style.color = '#64748b';
                subtext.style.marginTop = '2px';
                subtext.textContent = (bid.location || 'Unknown Location') + ' • ' + bid.time;
                details.appendChild(subtext);
                
                leftSec.appendChild(details);
                
                // Right section: Price
                var priceSec = document.createElement('div');
                priceSec.style.textAlign = 'right';
                
                var priceSpan = document.createElement('span');
                priceSpan.style.fontWeight = '800';
                priceSpan.style.fontSize = index === 0 ? '16px' : '14px';
                priceSpan.style.color = index === 0 ? '#10b981' : '#1e293b';
                priceSpan.innerHTML = '₹' + parseFloat(bid.bid_amount).toLocaleString('en-IN', {minimumFractionDigits: 2});
                priceSec.appendChild(priceSpan);
                
                itemDiv.appendChild(leftSec);
                itemDiv.appendChild(priceSec);
                list.appendChild(itemDiv);
            });
        } else {
            noBids.style.display = 'block';
        }
    })
    .catch(function() {
        loading.style.display = 'none';
        noBids.style.display = 'block';
        noBids.textContent = 'Failed to load bid history.';
    });
}

function closeBidsModal() {
    var modal = document.getElementById('bid-history-modal');
    modal.style.opacity = '0';
    modal.firstElementChild.style.transform = 'scale(0.9)';
    setTimeout(function() { modal.style.display = 'none'; }, 300);
}

// Close modal when clicking outside of modal content
window.addEventListener('click', function(event) {
    var modal = document.getElementById('bid-history-modal');
    if (event.target === modal) {
        closeBidsModal();
    }
});
</script>
@endpush
