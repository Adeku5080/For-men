<!Doctype html>
<html>
<head>
    <title>

    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href={{asset('vendor/css/cart.css')}}>
</head>

<body>
<h2>Your Items</h2>
<main class="main-container">
    <div class="cart-items-details">
        @foreach($cartItems as $cartItem)
            <div class="container">

                <div class="image-container">
                    <img class="image" src="{{$cartItem->item_file_path}}" alt="product_img">
                </div>
                <section class="name_size_quantity">
                    <p>{{$cartItem->item_name}}</p>
                    <div class="size_and_quantity">
                        <select name="size" id="size">
                            <option value="" selected>{{$cartItem->size}}</option>
                            
                        </select>

                        <div class="quantity-bar">

                            Qty
                            <select name="quantity" id="quantity"  data-cart_id="{{$cartItem->id}}">
                                <option value=" " selected>{{ $cartItem->quantity }}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                        </div>

                    </div>

                </section>

                <div class="price">
                    ${{$cartItem->item_price}}
                    <button type="button" value=" {{ $cartItem->id }} " id="delete-btn">delete</button>
                </div>


            </div>
        @endforeach

    </div>

    <div class="total-section">
        <div class="header">
            <h3>Total</h3>
        </div>
        <div class="subtotal">
            <p>sub-total</p>
            <p class="total"></p>
        </div>
        <div class="button-div">
            <a href={{route('checkout')}}>
                <button class="checkout" type="button">CHECKOUT</button>
            </a>

        </div>
    </div>
</main>

{{--update cart-item quantity on-change--}}
<script>
    const selectQuantity = document.querySelector('#quantity');
    selectQuantity.addEventListener('change', async function (e) {
        const cartItemId = e.target.getAttribute('data-cart_id');

        const data = {
            quantity: document.querySelector("[name = 'quantity']").value
        }
        console.log(cartItemId,'id of item');


        await updateProduct(data, cartItemId)
    })

    async function updateProduct(data, cartItemId) {
        try {
            const response = await fetch(`api/update-cart-item/${cartItemId}`, {
                method: "PATCH",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            if (response.ok) {
                window.location.href = '{{route('cart.show')}}'
            }
            return response.text()
        } catch (e) {
            console.log(e);
        }
    }

</script>

{{--delete cartItem --}}
<script>
    const deleteBtn = document.querySelector("#delete-btn")
    deleteBtn.addEventListener('click', async function (e) {
        e.preventDefault();

        const cartItemId = e.target.value
        await deleteProduct(cartItemId)

    });

    async function deleteProduct(cartItemId) {
        try {
            const response = await fetch(`api/delete-cart-item/${cartItemId}`, {
                method: "DELETE",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                },
            });
            if (response.ok) {
                window.location.href = '{{route('cart.show')}}'
            }
            return response.text()
        } catch (error) {
            console.log(error)
        }
    }
</script>


{{--Get total price of cart items--}}
<script>
    addTotalToHtml();

    const totalValue = document.querySelector('.total');

    //get cartItems
    async function getCartItems() {
        const response = await fetch('api/cart-items');

        return response.json()
    }

    //calculate total price for cart items
    async function total() {
        const {data} = await getCartItems();
        console.log(data);


        let sum = 0;

        if(Array.isArray(data)) {
            for (let i = 0; i < data.length; i++) {
            let item_total = data[i].item_price * data[i].quantity
            sum += item_total;
        }
        return sum;
        }else{
            let dataArray = Object.values(data)
            for (let i = 0; i < dataArray.length; i++) {
            let item_total = dataArray[i].item_price * dataArray[i].quantity
            sum += item_total;
        }
        return sum;

        }
      
    }

    async function addTotalToHtml() {
        const value = await total()
        totalValue.innerText = value;
    }


</script>


</body>
</html>
