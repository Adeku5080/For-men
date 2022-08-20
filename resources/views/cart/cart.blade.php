<!Doctype html>
<html>
<head>
    <title>

    </title>
    <link rel="stylesheet" href={{asset('vendor/css/cart.css')}}>
</head>

<body>
<h2>Your Items</h2>
<main class="main-container">
    <div class="cart-items-details">
        @foreach($cartItems as $cartItem)
            <div class="container">

                <div class="image-container">
                    <img class="image" src="{{ asset('images/productImgs/'.$cartItem->item_file_path)}}" alt="">
                </div>
                <section class="name_size_quantity">
                    <p>{{$cartItem->item_name}}</p>
                    <div class="size_and_quantity">
                        <select name="size" id="size">
                            <option value="" selected>{{$cartItem->size}}</option>
                            <option value="Uk-6">Uk 6</option>
                            <option value="Uk-7">Uk 7</option>
                            <option value="Uk-8">UK 8</option>
                            <option value="Uk-9">UK 9</option>
                            <option value="Uk-10">UK 10</option>
                        </select>

                        <div class="quantity-bar">
                            <button type="button" class="decrement">
                                -
                            </button>

                            <button class="count">
                                {{$cartItem->quantity}}
                            </button>

                            <button type="button" class="increment">
                                +
                            </button>

                        </div>

                    </div>

                </section>

                <div class="price">
                    ${{$cartItem->item_price}}
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
            <p>$total</p>
        </div>
        <div class="button-div">
        <button class="checkout" type="button">CHECKOUT</button>
        </div>
    </div>
</main>

<script>
    const increase = document.querySelector('.increment');
    const decrease = document.querySelector('.decrement');

    decrease.addEventListener('click', function () {
        let value = document.querySelector('.count').innerText;

        if (value > 1) {
            value--;
            document.querySelector('.count').innerText = value;
        }
    });

    increase.addEventListener('click', function () {
        let value = document.querySelector('.count').innerText;
        value++
        document.querySelector('.count').innerText = value;
    })

</script>
</body>
</html>
