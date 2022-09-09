<!Doctype html>
<html>
<head>
    <title>
        checkout
    </title>
    <link rel="stylesheet" href="{{ asset('vendor/css/checkout.css') }}">
</head>
<body>
<h3>Secure Checkout</h3>

<Section class="checkout-section">
    <h4 class="section-title">shipping address</h4>
    <div class="checkout-form-section">
        <form>
            <input name="firstname" type="text" placeholder="firstname"/>
            <input name="lastname" type="text" placeholder="lastname"/>
            <input name="email" type="email" placeholder="Email"/>
            <input name="address" placeholder="Address 1"/>
            <input name="phone" placeholder="Phone"/>

            <select name="country" id="country">


            </select>


            <button class="checkout-btn" type="button">continue checkout</button>
        </form>
    </div>

</Section>
</body>
</html>
