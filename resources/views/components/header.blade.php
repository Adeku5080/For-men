<div>
    <header class="header">

        <a href="{{route('home')}}" class="brand-name">For-men</a>

        <div id="search-bar">
            <form action="{{route('search')}}" method="GET">
                <input type="search" name="search" placeholder="Search">
            </form>
        </div>

        <div class="user-icon-container">
            <i class="far fa-user"></i>
        </div>

        {{-- authentication dropdown       --}}
        <div class="auth-dropdown">
            <div class="auth-dropdown-header">
                <div class="auth-links">Sign In | Join</div>
                <div class="close-dropdown-icon">X</div>
            </div>

            <div class="account-info">
                <li>My Account</li>
                <li>My Orders</li>
                <li> Returns Information</li>
                <li>Contact Preferences</li>

            </div>
        </div>


        <div class="cartIcon_div">
            <a href="#">
                <i class="fas fa-shopping-cart cart-icon"></i><span class="cart-item-count"></span>
            </a>
        </div>

        {{--   cart-dropdown-section  --}}
        <div class="cart-dropdown">
            <div class="cart-dropdown-header">
                <div class="drop-down-header-title-container">
                    <span class="dropdown-header-title">My Cart,</span><span>1 item</span>
                </div>

                <p>X</p>
            </div>

            <section class="dropdown-cartItems">
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
                <p class="total_value"></p>

            </div>
            <div class="cart-and-checkout-section">

                <a href="{{route('cart.show')}}" id="view-cart">VIEW CART</a>
                <a href="{{route('checkout')}}" id="check-out">CHECKOUT</a>

            </div>
            <div class="delivery">
                <p>Free Delivery Worldwide</p>
            </div>

        </div>
    </header>

</div>

@push('scripts')

{{--get cartCount--}}
<script>

    destructureResponse();

    const cartItemCount = document.querySelector(".cart-item-count")
    addToCart.addEventListener('click', async function () {
        await destructureResponse();
    })

    /**
     * get all cartItems
     *
     */

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
        cartItemCount.innerText = data;
    }
</script>

<script>
    const dropdown = document.querySelector('.cart-dropdown');
    const cartIcon = document.querySelector('.cart-icon')
    const cartIconDiv = document.querySelector('.cartIcon_div')
    cartIconDiv.addEventListener('mouseout', function () {
        dropdown.style.display = "none";
    });

    dropdown.addEventListener('mouseover', function () {
        dropdown.style.display = 'block';
    })

    dropdown.addEventListener('mouseout', function () {
        dropdown.style.display = 'none';
    })

    cartIconDiv.addEventListener('mouseover', async function () {
        const {data} = await getCartItems()


        if (data.length === 0) {
            dropdown.style.display = "none";
            return;
        }

        dropdown.style.display = 'block';
    })


</script>

{{--get cartItems and fill cart-dropdown--}}

<script>
    fillCartDropDown();
    const itemsSection = document.querySelector(".dropdown-cartItems");


    async function getCartItems() {
        console.log('this api fetches cart items')
        const response = await fetch('/api/cart-items');

        return response.json()
    }

    //    add cartItems to cartDropdown

    async function fillCartDropDown() {
        const {data} = await getCartItems();
        console.log(data,'data from fetch')

        let displayItems = data.map((item) => {
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

{{--Get total price of cart items--}}
<script>
    addTotalToHtml();

    const totalValue = document.querySelector('.total_value');

    //calculate total price for cart items
   async function total() {
        const {data} = await getCartItems();

        let sum = 0;

        for (let i = 0; i < data.length; i++) {
            let item_total = data[i].item_price * data[i].quantity
            sum += item_total;
        }
        return sum;
    }

    //Add the total value to html
    async function addTotalToHtml() {
        const value = await total()
        totalValue.innerText = value;
    }


</script>

{{--toggle authentication dropdown--}}

<script>
    const authDropdownDiv = document.querySelector('.auth-dropdown');
    const userIconDiv = document.querySelector('.user-icon-container');
    const close = document.querySelector('.close-dropdown-icon');

    userIconDiv.addEventListener('mouseover', function () {
        authDropdownDiv.style.display = 'block';
    });
    userIconDiv.addEventListener('mouseout', function () {
        authDropdownDiv.style.display = 'none';
    });

    authDropdownDiv.addEventListener('mouseover', function () {
        authDropdownDiv.style.display = 'block';
    })

    authDropdownDiv.addEventListener('mouseout', function () {
        authDropdownDiv.style.display = 'none';
    })

    close.addEventListener('click', function () {
        authDropdownDiv.style.display = 'none';
    })

</script> 
@endpush
