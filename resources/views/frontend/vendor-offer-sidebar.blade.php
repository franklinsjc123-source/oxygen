                        <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                            <div class="sidebar-content scrollable">
                                <div class="sticky-sidebar">

                                    <div style="padding: 15px 0; border-bottom: 2px solid #222;">
                                        <h4 style="font-size: 16px; font-weight: 700; letter-spacing: 1px; margin: 0; color: #222;">FILTER:</h4>
                                    </div>

                                    {{-- Color Filter --}}
                                    <div class="filter-section" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Color</h5>
                                            <i class="fas fa-chevron-up" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 500px; overflow: hidden; transition: max-height 0.35s ease;">
                                            <ul style="list-style: none; padding: 10px 0 0 0; margin: 0;">
                                                @foreach ($colours ?? [] as $colorItem)
                                                    <li style="padding: 5px 0;">
                                                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 13px; color: #555;">
                                                            <input type="checkbox" name="colors[]" value="{{ $colorItem->color }}" class="filter-checkbox" style="accent-color: #222; width: 15px; height: 15px;">
                                                            @php
                                                                $colorMap = [
                                                                    'light slate blue' => '#8470FF',
                                                                    'multi' => 'conic-gradient(red, yellow, green, blue, purple)',
                                                                    'navy blue' => 'navy',
                                                                    'peach' => '#FFDAB9',
                                                                    'mustard' => '#FFDB58',
                                                                    'teal' => '#008080'
                                                                ];
                                                                $colorName = strtolower(trim($colorItem->color));
                                                                $bgColor = $colorMap[$colorName] ?? strtolower(str_replace(' ', '', $colorItem->color));
                                                            @endphp
                                                            <span style="display: inline-block; width: 16px; height: 16px; border-radius: 50%; background: {{ $bgColor }}; border: 1px solid #ccc; flex-shrink: 0;"></span>
                                                            {{ $colorItem->color }} ({{ $colorItem->count }})
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Size Filter --}}
                                    <div class="filter-section" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Size</h5>
                                            <i class="fas fa-chevron-down" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 0; overflow: hidden; transition: max-height 0.35s ease;">
                                            <div style="padding: 10px 0 0 0; display: flex; flex-wrap: wrap; gap: 8px;">
                                                @foreach ($sizes ?? [] as $size)
                                                    <label style="display: inline-flex; align-items: center; justify-content: center; min-width: 42px; height: 36px; padding: 0 10px; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; font-size: 13px; font-weight: 500; color: #555; transition: all 0.2s;">
                                                        <input type="checkbox" name="filter_size[]" value="{{ $size }}" class="filter-checkbox" style="display: none;">
                                                        {{ $size }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Price Filter --}}
                                    <div class="filter-section" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Price</h5>
                                            <i class="fas fa-chevron-up" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 500px; overflow: hidden; transition: max-height 0.35s ease;">
                                            <div class="range-container" style="padding: 15px 5px 10px 5px;">
                                                <div class="price-display" style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px; color: #444; font-weight: 600;">
                                                    <span id="minText"><span style="font-family: Arial, sans-serif;">₹</span>0</span>
                                                    <span id="maxText"><span style="font-family: Arial, sans-serif;">₹</span>5000+</span>
                                                </div>
                                                <div class="double-range" style="position: relative; width: 100%; height: 6px; background: #e5e5e5; border-radius: 4px;">
                                                    <div class="slider-track" style="position: absolute; height: 100%; background: #222; border-radius: 4px; z-index: 1;"></div>
                                                    <input class="price-filter" type="range" id="minPrice" min="0" max="5000" step="10" value="0" style="position: absolute; width: 100%; top: 0; height: 6px; z-index: 2; -webkit-appearance: none; appearance: none; background: transparent; pointer-events: none; outline: none; margin: 0;">
                                                    <input class="price-filter" type="range" id="maxPrice" min="0" max="5000" step="10" value="5000" style="position: absolute; width: 100%; top: 0; height: 6px; z-index: 2; -webkit-appearance: none; appearance: none; background: transparent; pointer-events: none; outline: none; margin: 0;">
                                                </div>
                                                <style>
                                                    .price-filter::-webkit-slider-thumb {
                                                        -webkit-appearance: none;
                                                        appearance: none;
                                                        width: 18px;
                                                        height: 18px;
                                                        border-radius: 50%;
                                                        background: #222;
                                                        cursor: pointer;
                                                        pointer-events: auto;
                                                        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                                                        transition: transform 0.1s;
                                                        margin-top: -6px;
                                                    }
                                                    .price-filter::-webkit-slider-thumb:hover {
                                                        transform: scale(1.15);
                                                    }
                                                    .price-filter::-moz-range-thumb {
                                                        width: 18px;
                                                        height: 18px;
                                                        border-radius: 50%;
                                                        background: #222;
                                                        cursor: pointer;
                                                        pointer-events: auto;
                                                        border: none;
                                                        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                                                        transition: transform 0.1s;
                                                    }
                                                    .price-filter::-moz-range-thumb:hover {
                                                        transform: scale(1.15);
                                                    }
                                                </style>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Review Filter --}}
                                    <div class="filter-section" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Ratings</h5>
                                            <i class="fas fa-chevron-down" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 0; overflow: hidden; transition: max-height 0.35s ease;">
                                            <ul style="list-style: none; padding: 10px 0 0 0; margin: 0;">
                                                @foreach ([5, 4, 3, 2, 1] as $rating)
                                                    <li style="padding: 4px 0;">
                                                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13px; color: #555;">
                                                            <input type="checkbox" name="filter_rating" value="{{ $rating }}" class="filter-checkbox rating-checkbox" style="accent-color: #222; width: 15px; height: 15px;" onchange="$('.rating-checkbox').not(this).prop('checked', false);">
                                                            <div style="color: #ffb800; font-size: 12px; margin-top: 2px;">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $rating)
                                                                        <i class="fas fa-star"></i>
                                                                    @else
                                                                        <i class="far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Discount Filter --}}
                                    <div class="filter-section" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Discount</h5>
                                            <i class="fas fa-chevron-down" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 0; overflow: hidden; transition: max-height 0.35s ease;">
                                            <ul style="list-style: none; padding: 10px 0 0 0; margin: 0;">
                                                @foreach ([10, 20, 30, 40, 50, 60, 70] as $disc)
                                                    <li style="padding: 4px 0;">
                                                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13px; color: #555;">
                                                            <input type="checkbox" name="filter_discount[]" value="{{ $disc }}" class="filter-checkbox" style="accent-color: #222; width: 15px; height: 15px;">
                                                            {{ $disc }}% and above
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Clear All Filters --}}
                                    <div style="padding: 15px 0; text-align: center;">
                                        <button onclick="clearAllFilters()" style="background: #222; color: #fff; border: none; padding: 8px 25px; border-radius: 4px; font-size: 13px; font-weight: 600; cursor: pointer; letter-spacing: 0.5px; transition: background 0.2s;">Clear All Filters</button>
                                    </div>

                                </div>
                            </div>
                        </aside>
<script>
    function toggleFilter(header) {
        var body = header.nextElementSibling;
        var icon = header.querySelector('i');
        if (body.style.maxHeight === '0px' || body.style.maxHeight === '') {
            body.style.maxHeight = '500px';
            icon.className = 'fas fa-chevron-up';
        } else {
            body.style.maxHeight = '0px';
            icon.className = 'fas fa-chevron-down';
        }
    }

    document.querySelectorAll('input[name="filter_size[]"]').forEach(function(cb) {
        cb.addEventListener('change', function() {
            var lbl = this.parentElement;
            if (this.checked) {
                lbl.style.background = '#222';
                lbl.style.color = '#fff';
                lbl.style.borderColor = '#222';
            } else {
                lbl.style.background = '#fff';
                lbl.style.color = '#555';
                lbl.style.borderColor = '#ddd';
            }
        });
    });

    function clearAllFilters() {
        document.querySelectorAll('.filter-checkbox, .filter-radio, input[name="colors[]"]').forEach(function(el) {
            el.checked = false;
        });
        document.querySelectorAll('input[name="filter_size[]"]').forEach(function(cb) {
            var lbl = cb.parentElement;
            lbl.style.background = '#fff';
            lbl.style.color = '#555';
            lbl.style.borderColor = '#ddd';
        });
        if(document.getElementById('minPrice')){
            document.getElementById('minPrice').value = 0;
            document.getElementById('maxPrice').value = 5000;
            updateRange();
        }
    }

    const minSlider = document.getElementById("minPrice");
    const maxSlider = document.getElementById("maxPrice");
    const minText = document.getElementById("minText");
    const maxText = document.getElementById("maxText");
    const sliderTrack = document.querySelector(".slider-track");

    function updateRange() {
        if(!minSlider) return;
        var min = parseInt(minSlider.value);
        var max = parseInt(maxSlider.value);

        if (min > max - 100) minSlider.value = max - 100;
        if (max < min + 100) maxSlider.value = min + 100;

        minText.innerHTML = '<span style="font-family: Arial, sans-serif;">₹</span>' + minSlider.value;
        if (max >= 5000) {
            maxText.innerHTML = '<span style="font-family: Arial, sans-serif;">₹</span>' + maxSlider.value + '+';
        } else {
            maxText.innerHTML = '<span style="font-family: Arial, sans-serif;">₹</span>' + maxSlider.value;
        }

        var minPercent = (minSlider.value / minSlider.max) * 100;
        var maxPercent = (maxSlider.value / maxSlider.max) * 100;

        sliderTrack.style.left = minPercent + "%";
        sliderTrack.style.width = (maxPercent - minPercent) + "%";
    }

    if(minSlider) {
        minSlider.addEventListener("input", updateRange);
        maxSlider.addEventListener("input", updateRange);
        updateRange();
    }
</script>
