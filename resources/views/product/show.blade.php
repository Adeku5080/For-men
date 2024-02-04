<!Doctype html>
<html>
<head>
    <title>show-product</title>
    <link rel="stylesheet" href={{asset('vendor/css/show_product.css')}}>
    <link rel="stylesheet" href="{{ asset('vendor/css/header.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous"/>
</head>
<body>
<x-header/>
<div class="container">
    <div class="product-detail_section">
        <div class="product-img">
            <img src="{{$product->file_path}}" alt="image"/>

        </div>

        <div class="product-info">
            <p class="product-name">{{$product->name}}</p>
            <h2 class="product-price">${{$product->price}}</h2>

            <div class="form_section">


                <form>
                    @csrf

                    <div>
{{--                        @if ($errors->any())--}}
{{--                            <div class="error-msg">--}}
{{--                                <ul>--}}
{{--                                    @foreach ($errors->all() as $error)--}}
{{--                                        <li class="error-msg">{{ $error }}</li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        <select name="size" id="size" required>
                            <option value="" selected>--choose a size--</option>
                            <option value="Uk-6">Uk 6</option>
                            <option value="Uk-7">Uk 7</option>
                            <option value="Uk-8">UK 8</option>
                            <option value="Uk-9">UK 9</option>
                            <option value="Uk-10">UK 10</option>
                        </select>
                    </div>

                    <button type="submit" id="btn" value="{{ $product->id }}" class="button"> ADD ITEM TO CART</button>
                </form>
            </div>
        </div>

        <script>
            let addToCart = document.querySelector('#btn');

            addToCart.addEventListener('click', async function (e) {
                e.preventDefault();

                const data = {
                    size: document.querySelector("[name='size']").value,
                    // quantity: document.querySelector('.count').innerText,
                    productId: e.target.value,
                    _token: '{{ csrf_token() }}',
                };

                await addProductToCart(data);
            })


            /**
             * add product to cart
             *
             * @returns {Promise<any>}
             */
            async function addProductToCart(data) {
                try {
                    const url = `{{route('api.add-to-cart')}}`
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(data)
                    });

                    if (!response.ok) {
                        const error = new Error();
                        error.body = response;
                        throw error;
                    }

                    return response.text();
                } catch (error) {
                    if (error.body && error.body.status === 401) {
                        window.location.href = '{{ route('login') }}';
                    }
                }
            }
        </script>

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

        <script>

            fillCartCount();

            const cartItemCount = document.querySelector(".cart-item-count")
            addToCart.addEventListener('click',async function(){
                await fillCartCount();
            })

            /**
             * get all cartItems
             *
             */

            async function getCount(){
                    const url = `{{route('api.cart-items-count')}}`

                    const response = await fetch(url);

                    return response.json();
            }

            /**
             * destructures response and pass data into html
             *
             * @returns {Promise<void>}
             */
            async function fillCartCount () {
                const {data} = await getCount()
                cartItemCount.innerText = data;
            }
        </script>

</body>
</html>

