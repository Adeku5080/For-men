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
        <form method="Post" action="{{route('checkout.store')}}">
            @csrf
            <input name="firstname" type="text" placeholder="firstname"/>
            <input name="lastname" type="text" placeholder="lastname"/>
            <input name="email" type="email" placeholder="Email"/>
            <input name="address" placeholder="Address 1"/>
            <input name="phone" placeholder="Phone"/>

            <select name="country" id="country">
              <option value="nigeria">
                  Nigeria
              </option>
                <option value="ghana">
                    Ghana
                </option>
                <option value="togo">
                    Togo
                </option>
                <option value="cameroon">
                    Cameroon
                </option>
            </select>

            <button class="checkout-btn" type="submit">continue checkout</button>

        </form>
    </div>

</Section>
</body>

<script>
    //get countries list
    getCountries();

    async function getCountries() {
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': '62d08bd2ddmsh5bfb8d4d2b25300p151d32jsna5a89e927061',
                'X-RapidAPI-Host': 'countries-cities.p.rapidapi.com'
            }
        };

        const response = await fetch('https://countries-cities.p.rapidapi.com/location/country/list', options)
        return response.json()
    }

</script>
</html>
