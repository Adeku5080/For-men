<!Doctype html>
<html lang="">
<head>
    <title>Payment</title>
    <link rel="stylesheet" href={{asset('vendor/css/payment.css')}}>
</head>
<body>
<div class="payment-container">
    <section class="address-container">
        <h4 class="header-title">Shipping Address</h4>
        <div class="contact-details">
            <p>Ali Adeku</p>
            <p>n0 27 shehu hassan iyana era Lagos</p>
            <p>Nigeria</p>


        </div>
        <a  class="edit-btn" href="">EDIT</a>
    </section>

    <section class="card-section">
        <h4 class="header-title">Payment</h4>
        <div class="card">
            <form>
                <input id="card-number-form" type="text" name="card_number" placeholder="Card Number">
                <input type="text" name="expiration_month" placeholder="Expiration Month">
                <input type="text" name="expiration_year" placeholder="Expiration Year">
                <input type="text" name="security_number" placeholder="Security Code">
                <div>
                    <button class="payment-btn" type="button"> Place order</button>
                </div>

            </form>
        </div>


    </section>
</div>


</body>
</html>
