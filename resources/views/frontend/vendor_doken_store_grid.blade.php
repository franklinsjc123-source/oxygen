 @extends('app_template')
 @section('title','Shops')
 @section('content')
<style>
    .custom-split{
  display:flex;
  height:240px;
  border-radius:10px;
   color: white;
  overflow:hidden;
  background: rgba(37, 38, 42, 0.9);
}

/* Left Text Area */
.custom-split .store-left{
  width:40%;
  padding:20px;
  display:flex;
  flex-direction:column;
  justify-content:center;
}

/* Right Image */
.custom-split .store-right{
  width:60%;
}

.custom-split .store-right img{
  width:100%;
  height:100%;
  
  object-fit:cover;
  display:block;
}
  .store-address-grid {
    color: #fff5f5ff;
  }

  .vendor-search-form {
    position: relative;
  }


</style>

 <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb mb-6">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shops') }}">Shops</a></li>
                       
                    </ul>
                </div>
            </nav>

            <div class="page-content mb-8">
                <div class="container">
                    <div class="toolbox vendor-toolbox pb-0">
                    
                        <div class="toolbox-left mb-4 mb-md-0">
                            {{-- <a href="#" class="btn btn-primary btn-outline btn-rounded btn-icon-left "><i class="w-icon-category"></i>VENDORS</a> --}}
                            {{-- <label class="d-block">Total Store Showing 6</label> --}}
                            <h3><label class="d-block"></label></h3>
                        </div>
                        {{-- <div class="toolbox-right">
                            <div class="toolbox-item toolbox-sort select-box mb-0">
                                <label class="font-weight-normal">Sort by:</label>
                                <select name="orderby" class="form-control">
                                    <option value="default" selected="selected">Default</option>
                                    <option value="recent">Most Recent</option>
                                    <option value="popular">Most Popular</option>
                                </select>
                            </div>
                   
                        </div> --}}
                    </div>
                    <div class="vendor-search-wrapper">
                        <form class="vendor-search-form" method="get" action="{{ route('shops') }}">
                            <input type="text" class="form-control mr-4 bg-white" name="vendor" id="vendor"
                                placeholder="Search Vendors" autocomplete="off" value="{{ $keyword ?? '' }}" />
                            <div class="search-suggest-box" id="vendor_suggest_box"></div>
                            <button class="btn btn-primary btn-rounded" type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="row cols-lg-3 cols-md-2 cols-sm-2 cols-1 mt-4">

                @foreach($vendorcreate as $vendorcreate )

                        <div class="store-wrap mb-4">
                            <div class="store store-grid">
                               <div class="store-header custom-split">
                                    <div class="store-left">
                                        <h4 class="store-title">
                                            <a href="{{ url('/shop-details/'.$vendorcreate->id) }}">
                                                {{ $vendorcreate->shop_name }}
                                            </a>
                                        </h4>

                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width:100%;"></span>
                                            </div>
                                        </div>

                                        <div class="store-address-grid">
                                            
                                                {{ $vendorcreate->address }} , <br>
                                                {{ $vendorcreate->city }} - {{ $vendorcreate->pincode }} , <br>
                                                {{ $vendorcreate->state }} . <br>
                                                <i class="w-icon-phone"></i> {{ $vendorcreate->mobile_number1 }}
                                            
                                        </div>
                                    <!-- 
                                        <a href="{{ url('/shop-details/'.$vendorcreate->id) }}" class="btn btn-dark mt-3">
                                            VISIT STORE
                                        </a> -->
                                    </div>

                                    <div class="store-right">
                                        <img src="{{ asset('assets/images/vendor/profile/' . $vendorcreate->profile_image) }}" alt="">
                                    </div>
                                </div>

                                
                                <div class="store-footer">
                                    <figure class="seller-brand">
                                        <img src="{{ asset('assets/images/vendor/profile/' . $vendorcreate->profile_image) }}" alt="Brand" width="80" height="80" />
                                    </figure>
                                    <a href=" {{ url('/shop-details/'.$vendorcreate->id) }}" class="btn btn-dark btn-link btn-underline btn-icon-right btn-visit">
                                       <b>Visit Store</b> <i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                @endforeach
                    
                    </div>
                </div>
            </div>
        </main>
        <script>
            (function() {
                var input = document.getElementById('vendor');
                var box = document.getElementById('vendor_suggest_box');
                var form = input ? input.closest('form') : null;
                if (!input || !box || !form) return;

                var endpoint = "{{ route('ajax.vendor.search') }}";
                var defaultSuggestImage = "{{ asset('frontend/images/favicon.png') }}";
                var suggestions = [];
                var activeIndex = -1;
                var debounceTimer = null;
                var reqSeq = 0;

                function escapeHtml(value) {
                    return String(value || '').replace(/[<>&"]/g, function(ch) {
                        return ({
                            '<': '&lt;',
                            '>': '&gt;',
                            '&': '&amp;',
                            '"': '&quot;'
                        })[ch];
                    });
                }

                function hideBox() {
                    box.style.display = 'none';
                    box.innerHTML = '';
                    suggestions = [];
                    activeIndex = -1;
                }

                function setActive(idx) {
                    var items = box.querySelectorAll('.search-suggest-item');
                    items.forEach(function(el) {
                        el.classList.remove('active');
                    });
                    if (idx >= 0 && idx < items.length) {
                        items[idx].classList.add('active');
                        activeIndex = idx;
                    }
                }

                function navigate(item) {
                    if (item && item.url) {
                        window.location.href = item.url;
                        return;
                    }
                    form.submit();
                }

                function render(items) {
                    if (!items || !items.length) {
                        hideBox();
                        return;
                    }
                    suggestions = items;
                    activeIndex = -1;
                    box.innerHTML = items.map(function(item, idx) {
                        var safeValue = escapeHtml(item.value);
                        var safeType = escapeHtml(item.type || 'vendor');
                        var imgSrc = item.image ? item.image : defaultSuggestImage;
                        var imageHtml = '<img class="search-suggest-thumb" src="' + escapeHtml(imgSrc) + '" alt="' + safeValue + '">';
                        return '<div class="search-suggest-item" data-index="' + idx + '">' +
                            '<span class="search-suggest-left">' + imageHtml + '<span class="search-suggest-text">' + safeValue + '</span></span>' +
                            '<span class="search-suggest-type">' + safeType + '</span>' +
                            '</div>';
                    }).join('');
                    box.style.display = 'block';
                }

                function fetchSuggest(query) {
                    reqSeq += 1;
                    var currentReq = reqSeq;
                    fetch(endpoint + '?q=' + encodeURIComponent(query), {
                            method: 'GET'
                        })
                        .then(function(res) {
                            return res.ok ? res.json() : {
                                suggestions: []
                            };
                        })
                        .then(function(data) {
                            if (currentReq !== reqSeq) return;
                            render((data && data.suggestions) ? data.suggestions : []);
                        })
                        .catch(function() {
                            hideBox();
                        });
                }

                input.addEventListener('input', function() {
                    var value = input.value.trim();
                    if (debounceTimer) clearTimeout(debounceTimer);
                    if (value.length < 1) {
                        hideBox();
                        return;
                    }
                    debounceTimer = setTimeout(function() {
                        fetchSuggest(value);
                    }, 250);
                });

                input.addEventListener('keydown', function(e) {
                    if (box.style.display !== 'block') return;
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        setActive(Math.min(activeIndex + 1, suggestions.length - 1));
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        setActive(Math.max(activeIndex - 1, 0));
                    } else if (e.key === 'Enter' && activeIndex >= 0 && suggestions[activeIndex]) {
                        e.preventDefault();
                        hideBox();
                        navigate(suggestions[activeIndex]);
                    } else if (e.key === 'Escape') {
                        hideBox();
                    }
                });

                box.addEventListener('mousedown', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var item = e.target.closest('.search-suggest-item');
                    if (!item) return;
                    var idx = parseInt(item.getAttribute('data-index'), 10);
                    if (!isNaN(idx) && suggestions[idx]) {
                        var selected = suggestions[idx];
                        hideBox();
                        setTimeout(function() {
                            navigate(selected);
                        }, 0);
                    }
                });

                box.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var item = e.target.closest('.search-suggest-item');
                    if (!item) return;
                    var idx = parseInt(item.getAttribute('data-index'), 10);
                    if (!isNaN(idx) && suggestions[idx]) {
                        var selected = suggestions[idx];
                        hideBox();
                        setTimeout(function() {
                            navigate(selected);
                        }, 0);
                    }
                });

                document.addEventListener('click', function(e) {
                    if (!form.contains(e.target)) {
                        hideBox();
                    }
                });
            })();
        </script>
@endsection
