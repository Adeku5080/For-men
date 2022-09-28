<!Doctype html>
<html lang="">
<head>
    <title>Payment</title>
    <link rel="stylesheet" href={{asset('vendor/css/payment.css')}}>
</head>
<body>
<main class="main-container">
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
                    <input id="card-number-form" type="text" name="card_number" placeholder="Card Number" required>
                    <input type="text" name="expiration_month" placeholder="Expiration Month" required>
                    <input type="text" name="expiration_year" placeholder="Expiration Year" required>
                    <input type="text" name="security_number" placeholder="Security Code" required>
                    <div>
                        <button class="payment-btn" type="button"> Place order</button>
                    </div>

                </form>
            </div>


        </section>
    </div>

    <section class="cart-item-list-section">
        <div class="header">
            <span class="header-count">count</span><span class="count-span">ITEMS</span>
        </div>
        <section class="cartItems-list-sidebar">
            {{--              <div class="dropdown-image">--}}
            {{--                  <img src="" alt="image">--}}
            {{--              </div>--}}

            {{--                <div>--}}
            {{--                    <div>--}}
            {{--                    </div>--}}
            {{--                     <div>--}}
            {{--                         <span></span>--}}
            {{--                         <span> </span>--}}
            {{--                     </div>--}}
            {{--                </div>--}}

        </section>
        <div class="sub-total-section">
            <p>Total</p>
            <p class="total_value">value</p>

        </div>
    </section>
</main>


</body>
<script>
    fillSidebar();
    const sideBar = document.querySelector('.cartItems-list-sidebar');


    async function getCartItems() {
        const response = await fetch('api/cart-items');

        return response.json();
    }

//    Add items to sidebar
    async function fillSidebar() {
        const {data} = await getCartItems();

        let displayItems = data.map((item)=>{
            return `
            <div class="main-content">
              <div class="sidebar-image-container">
                  <img class="image" src="/images/productImgs/${item.item_file_path}" alt="image"/>
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
        sideBar.innerHTML = displayItems
    }
</script>

{{--get cartItem-count--}}
<script>
    destructureResponse();
    const headerCount = document.querySelector('.header-count')

    async function getCount() {
        const url = `{{route('api.cart-items-count')}}`

        const response = await fetch(url);

        return response.json();
    }

    /**
     * destructures response and pass data into html
     *
     * @returns {Promise<void>}
     */
    async function destructureResponse() {
        const {data} = await getCount()
        headerCount.innerText = data;
    }
</script>
</html>
