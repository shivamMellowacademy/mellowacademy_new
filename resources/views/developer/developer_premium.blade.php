@extends('developer.layout')
@section('content')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Premium Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>


    <div class="page-content" style="padding-top:30px;">
        <div class="main-wrapper container">   
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Why Go Premium Package?</h3>
                    <ul class="list-unstyled mx-3">
                        @foreach($premium as $val)
                            <li class="m-2"> 
                                <i class="fas fa-arrow-right"></i> &nbsp; {{$val->name}}
                            </li>
                        @endforeach
                        
                    </ul>
                </div>
                @if(isset($date))
                    @if($date->expired === null || $date->expired >= now())
                        {{-- Show "Thank you" for active or one-time subscriptions --}}
                        <div class="text-right m-4">
                            <button type="button" class="btn btn-outline-primary ml-3">Thank you</button>
                        </div>
                    @else
                        {{-- Show payment options only if subscription expired --}}
                        <div class="text-right m-4">
                            <label for="planPay" class="mr-2 font-weight-bold">Choose Your Plan:</label>
                            <select id="planPay" class="form-control d-inline w-auto">
                                @foreach($prices as $val)
                                    <option value="{{ $val->price }}" data-price="{{ $val->id }}">
                                        {{ ucfirst($val->name) }} - ₹{{ number_format($val->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" onclick="pay()" class="btn btn-outline-primary ml-3">Pay</button>
                        </div>
                    @endif
                @else
                    {{-- No subscription exists - show all payment options --}}
                    <div class="text-right m-4">
                        <label for="planPay" class="mr-2 font-weight-bold">Choose Your Plan:</label>
                        <select id="planPay" class="form-control d-inline w-auto">
                            @foreach($prices as $val)
                                <option value="{{ $val->price }}" data-price="{{ $val->id }}">
                                    {{ ucfirst($val->name) }} - ₹{{ number_format($val->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" onclick="pay()" class="btn btn-outline-primary ml-3">Pay</button>
                    </div>
                @endif
            </div>
        </div>
   	</div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    function pay() {
        let planSelect = document.getElementById('planPay');
        let plan = parseInt(planSelect.value);
        let priceId = planSelect.options[planSelect.selectedIndex].dataset.price;
        let taxRate = {{ $tax->tax }};
        let tax = plan * (taxRate / 100);
        let total = plan + tax;

        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": total*100,
            "currency": "INR",
            "name": "Mellow Academy",
            "description": "Test Transaction",
            "handler": function (response){
                fetch("{{ route('developer_premium_pay') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        razorpay_id: priceId,
                    })
                })
                .then(async res => {
                    try {
                        const data = await res.json();
                        if (!res.ok) {
                            throw new Error(data.message || 'Payment failed');
                        }
                        alert('Payment successful!');
                        window.location.reload();
                    } catch (error) {
                        alert(error.message);
                        console.error(error);
                    }
                })
                .catch(error => {
                    alert("Payment failed or couldn't be saved.");
                    console.error(error);
                });
            },
        };
        var rzp = new Razorpay(options);
        rzp.open();
    }
</script>
@endsection