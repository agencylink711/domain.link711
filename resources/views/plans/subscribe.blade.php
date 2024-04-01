@extends('admin.layout.app')

@section('title', 'Subscribe Plan')

@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Subscribe Plan</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="sub-form">
                        @csrf
                        <div class="form-group">
                            <label>Name of Card</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Card Details</label>
                            <div id="card-ele"></div>
                            {{-- <input type="text" class="form-control" name="card" id="card" required> --}}
                        </div>
                        <div>
                            <button id="card-btn" class="btn btn-primary" type="submit"
                                data-secret="{{ $intent->client_secret }}">Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config('cashier.key') }}')
        const elements = stripe.elements();
        const cardElement = elements.create('card')
        cardElement.mount('#card-ele')

        const form = document.getElementById('sub-form')
        const cardBtn = document.getElementById('card-btn')
        const nameEle = document.getElementById('name')

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            cardBtn.disabled = true

            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: nameEle.value
                    }
                }
            })

            if (error) {
                cardBtn.disabled = false
                alert(error.message)
            } else {
                console.log(setupIntent);
                let token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit();
            }
        })
    </script>
@endsection
