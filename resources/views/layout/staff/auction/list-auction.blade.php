@extends('layout.auth.master')
@section('contents')

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
                                <h3>List Auction
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">List Auction</li>
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
                                
                          <a href="{{route('staffauction.create')}}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Offers </a> 
                          @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                                    <div class="card-body">
                                        <form action="{{ route('staffimport') }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file"
                                                   class="form-control">
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

                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
                    <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                         data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                    <thead>
                     <tr>
                        <th data-field="id" data-sortable="true">Id / Admin_Id</th>                     
                        <th data-field="sprice" data-sortable="true">Starting Price</th>
                        <th data-field="slab" data-sortable="true">SLAB</th> 
                        <th data-field="bid" data-sortable="true">BID Price</th>
                    	<th data-field="so" data-sortable="true">Stat Offer</th>                    
                    	<th data-field="eo" data-sortable="true">End Offer</th>
                       <th data-field="status" data-sortable="true">Status</th>
                       <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ( $auction as $item)
                    <tr>
                        <td>{{$loop->iteration }} / {{$item->admin_id}}</td>
                        <td>{{$item->start_price}}</td>
                        <td>{{$item->slab}}</td>
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

                        <td><span class="mt-3 d-flex">
                            <form action="{{ route('staffauction.edit', $item->id) }}"
                                method="get">
                                @method('GET')
                                @csrf
                            <button class="btn btn-secondary mx-1"
                            onclick="return confirm('Are you sure, you want to Edit it?')"
                                    data-original-title="Edit"><i class="fa fa-pencil"></i> </button>
                            </form>
                            <button type="button" class="btn btn-info mx-1" onclick="openBidsModal({{ $item->id }})"><i class="fa fa-eye"></i></button>
                            {{-- <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a> --}}
                            <form action="{{ route('staffauction.destroy', $item->id) }}"
                                method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-warning mx-1"
                                    onclick="return confirm('Are you sure, you want to delete it?')"><i
                                        class="fa fa-trash"></i>                                        
                                </button>                        
                            </form>
                            {{-- <a href="#" onclick="return confirm('Are you sure, you want to Edit it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>                         --}}
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
                <h4 style="margin: 0 0 16px 0; font-weight: 800; color: #0f172a; font-size: 20px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-history" style="color: #2563eb;"></i> Bid History
                </h4>

                <!-- Content Area -->
                <div style="max-height: 350px; overflow-y: auto; padding-right: 4px; margin-top: 10px;">
                    <div id="bid-history-loading" style="text-align: center; padding: 30px; color: #64748b;">
                        <i class="fas fa-circle-notch fa-spin" style="font-size: 28px; color: #2563eb; margin-bottom: 12px; display: block;"></i>
                        Loading bid history...
                    </div>
                    <table class="table" id="bid-history-table" style="display: none; width: 100%; border-collapse: collapse; margin-top: 5px;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e2e8f0; text-align: left;">
                                <th style="padding: 12px 8px; color: #475569; font-weight: 700;">Bidder</th>
                                <th style="padding: 12px 8px; color: #475569; font-weight: 700; text-align: right;">Amount</th>
                                <th style="padding: 12px 8px; color: #475569; font-weight: 700; text-align: right;">Time</th>
                            </tr>
                        </thead>
                        <tbody id="bid-history-tbody">
                            <!-- Bids injected here -->
                        </tbody>
                    </table>
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
// ===================== BID HISTORY MODAL FUNCTIONS =====================
function openBidsModal(auctionId) {
    var modal = document.getElementById('bid-history-modal');
    var loading = document.getElementById('bid-history-loading');
    var table = document.getElementById('bid-history-table');
    var noBids = document.getElementById('no-bids-message');
    var tbody = document.getElementById('bid-history-tbody');
    
    // Show modal & loading
    modal.style.display = 'flex';
    setTimeout(function() {
        modal.style.opacity = '1';
        modal.firstElementChild.style.transform = 'scale(1)';
    }, 10);
    
    loading.style.display = 'block';
    table.style.display = 'none';
    noBids.style.display = 'none';
    tbody.innerHTML = '';
    
    var url = "{{ url('auction') }}/" + auctionId + "/bids";
    fetch(url)
    .then(function(res) { return res.json(); })
    .then(function(data) {
        loading.style.display = 'none';
        if (data.bids && data.bids.length > 0) {
            table.style.display = 'table';
            data.bids.forEach(function(bid) {
                var tr = document.createElement('tr');
                tr.style.borderBottom = '1px solid #f1f5f9';
                
                var tdName = document.createElement('td');
                tdName.style.padding = '12px 8px';
                tdName.style.color = '#1e293b';
                
                var nameDiv = document.createElement('div');
                nameDiv.style.fontWeight = '600';
                nameDiv.textContent = bid.customer_name;
                tdName.appendChild(nameDiv);
                
                if (bid.location) {
                    var locDiv = document.createElement('div');
                    locDiv.style.fontSize = '12px';
                    locDiv.style.color = '#64748b';
                    locDiv.style.fontWeight = '400';
                    locDiv.style.marginTop = '2px';
                    locDiv.textContent = bid.location;
                    tdName.appendChild(locDiv);
                }
                
                var tdAmount = document.createElement('td');
                tdAmount.style.padding = '12px 8px';
                tdAmount.style.textAlign = 'right';
                tdAmount.style.fontWeight = '700';
                tdAmount.style.color = '#2563eb';
                tdAmount.innerHTML = '<span style="font-family: Arial, sans-serif;">₹</span>' + parseFloat(bid.bid_amount).toLocaleString('en-IN', {minimumFractionDigits: 2});
                
                var tdTime = document.createElement('td');
                tdTime.style.padding = '12px 8px';
                tdTime.style.textAlign = 'right';
                tdTime.style.color = '#64748b';
                tdTime.style.fontSize = '13px';
                tdTime.textContent = bid.time;
                
                tr.appendChild(tdName);
                tr.appendChild(tdAmount);
                tr.appendChild(tdTime);
                tbody.appendChild(tr);
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
