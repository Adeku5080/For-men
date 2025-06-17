<!Doctype html>
<html>
<head>
    <title>
        checkout
    </title>
    <link rel="stylesheet" href="{{ asset('vendor/css/checkout.css') }}">
</head>
<body>
    <div class="main-container">




<div class = "checkout-container">


<Section class="checkout-section">

    <h4 class="section-title">shipping address</h4>
    <div class="checkout-form-section">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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

            <button class="checkout-btn" type="submit">Deliver to this Address</button>
            {{-- onlick on deliver to this address ,api call to create address and change ui to show saved address --}}

        </form>
    </div>

    <div class="delivery-options_section">
      <p> Delivery Options</p>
    </div>
        <div class="delivery_price">
            <p> $27.63</p>    
        </div>

        <div class="delivery_type">
            <p>Standard Delivery: </p>
            <p> </p>

            <p> No delivery on Public Holidays. All orders are subject to Customs and Duty charges, payable by the recipient of the order.</p>

        </div>
    <div>
    </div>


    <div>
        <h4>Payment</h4>

        <div>
            <div class="address-details">


            </div>
        
        
            <div class="billing_change">
              Change
            </div>    
        </div>  

        <div> 

            <p> PAYMENT TYPE</p>

            
        </div>
    </div>


</Section>

<div class="total-section">
    
    
</div>

</div>
</div>
</body>

{{--get cartItems and fill cart-dropdown--}}

<script>
    fillCheckoutPreview();
    const itemsSection = document.querySelector(".total-section");


    async function getCartItems() {
        const response = await fetch('/api/cart-items');

        return response.json()
    }

    //    add cartItems to cartDropdown

    async function fillCheckoutPreview() {
        const {data} = await getCartItems();

        const itemsArray = Array.isArray(data) ? data : Object.values(data);

        let displayItems = itemsArray.map((item) => {
            return `
            <div class="main-content">
              <div class="dropdown-image">
                  <img class="image" src=${item.item_file_path} alt="image"/>
              </div>

                <div class="item-description">
                    <div>

                       $ ${item.item_price}
                    </div>
                    <div>
                        ${item.item_name}
                    </div>
                     <div>
                         <span>${item.size}</span>

                         <span> qty: ${item.quantity} </span>

                  </div>
                </div>
          </div>

            `
        })
        displayItems = displayItems.join("");
        itemsSection.innerHTML = displayItems
    }
</script>
</html>
