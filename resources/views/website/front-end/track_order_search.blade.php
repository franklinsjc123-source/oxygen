 @extends('app_template')
 @section('title','Track Order')
 @section('content')

<style>
    .track-order-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f4f8 0%, #e2ecf3 50%, #d5e3ee 100%);
        padding: 40px 15px;
    }

    .track-order-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
        max-width: 520px;
        width: 100%;
        padding: 45px 40px;
        position: relative;
        overflow: hidden;
    }

    .track-order-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #183543, #1a6b8a, #22a7d0);
    }

    .track-order-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #183543, #1a6b8a);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        box-shadow: 0 8px 25px rgba(24, 53, 67, 0.3);
        animation: pulse-icon 2s ease-in-out infinite;
    }

    @keyframes pulse-icon {
        0%, 100% { transform: scale(1); box-shadow: 0 8px 25px rgba(24, 53, 67, 0.3); }
        50% { transform: scale(1.05); box-shadow: 0 12px 35px rgba(24, 53, 67, 0.4); }
    }

    .track-order-icon i {
        font-size: 32px;
        color: #fff;
    }

    .track-order-card h2 {
        font-size: 26px;
        font-weight: 700;
        color: #183543;
        text-align: center;
        margin-bottom: 8px;
    }

    .track-order-card .subtitle {
        font-size: 14px;
        color: #7a8f9c;
        text-align: center;
        margin-bottom: 30px;
    }

    .track-form-group {
        margin-bottom: 20px;
    }

    .track-form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #183543;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .track-form-group .input-wrap {
        position: relative;
    }

    .track-form-group .input-wrap i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0b4c0;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .track-form-group input {
        width: 100%;
        padding: 14px 15px 14px 45px;
        border: 2px solid #e0e8ed;
        border-radius: 12px;
        font-size: 15px;
        color: #333;
        background: #f8fafb;
        transition: all 0.3s ease;
        outline: none;
    }

    .track-form-group input:focus {
        border-color: #1a6b8a;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(26, 107, 138, 0.1);
    }

    .track-form-group .input-wrap:focus-within i {
        color: #1a6b8a;
    }

    .track-form-group input::placeholder {
        color: #b0c0ca;
    }

    .track-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #183543, #1a6b8a);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .track-btn:hover {
        background: linear-gradient(135deg, #1a6b8a, #22a7d0);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(24, 53, 67, 0.35);
    }

    .track-btn:active {
        transform: translateY(0);
    }

    .track-btn i {
        font-size: 18px;
    }

    .track-error-alert {
        background: #fff5f5;
        border: 1px solid #fecaca;
        border-left: 4px solid #ef4444;
        color: #991b1b;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: shake 0.4s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-6px); }
        75% { transform: translateX(6px); }
    }

    .track-error-alert i {
        font-size: 18px;
        color: #ef4444;
    }

    .track-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .track-divider .line {
        flex: 1;
        height: 1px;
        background: #e0e8ed;
    }

    .track-divider span {
        font-size: 12px;
        color: #a0b4c0;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .track-help {
        text-align: center;
        margin-top: 25px;
        font-size: 13px;
        color: #7a8f9c;
    }

    .track-help a {
        color: #1a6b8a;
        text-decoration: none;
        font-weight: 600;
    }

    .track-help a:hover {
        text-decoration: underline;
    }

    @media (max-width: 576px) {
        .track-order-card {
            padding: 30px 22px;
            border-radius: 14px;
        }
        .track-order-card h2 {
            font-size: 22px;
        }
        .track-order-icon {
            width: 65px;
            height: 65px;
        }
        .track-order-icon i {
            font-size: 26px;
        }
    }
</style>

   <section class="track-order-section">
       <div class="track-order-card">
           <div class="track-order-icon">
               <i class="fas fa-shipping-fast"></i>
           </div>
           <h2>Track Your Order</h2>
           <p class="subtitle">Enter your order ID to get real-time tracking updates</p>

           @if(session('error'))
               <div class="track-error-alert">
                   <i class="fas fa-exclamation-circle"></i>
                   <span>{{ session('error') }}</span>
               </div>
           @endif

           @if($errors->any())
               <div class="track-error-alert">
                   <i class="fas fa-exclamation-circle"></i>
                   <span>{{ $errors->first() }}</span>
               </div>
           @endif

           <form action="{{ route('track_order_search') }}" method="POST">
               @csrf

               <div class="track-form-group">
                   <label for="orders_id">Order ID <span style="color:#ef4444;">*</span></label>
                   <div class="input-wrap">
                       <input type="text" id="orders_id" name="orders_id"
                              placeholder="e.g. ORD-20250724-001"
                              value="{{ old('orders_id') }}" required>
                       <i class="fas fa-receipt"></i>
                   </div>
               </div>

               <div class="track-divider">
                   <div class="line"></div>
                   <span>Optional</span>
                   <div class="line"></div>
               </div>

               <div class="track-form-group">
                   <label for="phone">Phone Number</label>
                   <div class="input-wrap">
                       <input type="tel" id="phone" name="phone"
                              placeholder="Enter registered phone number"
                              value="{{ old('phone') }}"
                              inputmode="numeric"
                              pattern="[0-9]*"
                              maxlength="15"
                              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                       <i class="fas fa-phone-alt"></i>
                   </div>
               </div>

               <button type="submit" class="track-btn">
                   <i class="fas fa-search"></i>
                   Track Order
               </button>
           </form>


       </div>
   </section>

@endsection
