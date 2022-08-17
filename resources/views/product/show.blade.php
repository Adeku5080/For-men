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
<header class="header">

    <a href="#" class="brand-name">For-men</a>

    <div id="search-bar">
        <form action="{{route('search')}}" method="GET">
            <input type="search" name="search" placeholder="Search">
        </form>
    </div>

    <a href="#">
        <i class="far fa-user"></i>
    </a>
    <a href="#">
        <i class="fas fa-shopping-cart">Cart</i>
    </a>
</header>
<div class="container">
    <div class="product-detail_section">
        <div class="product-img">
            <img class="image" src="{{ asset('images/productImgs/'.$product->file_path)}}" alt="">
        </div>

        <div class="product-info">
            <p class="product-name">{{$product->name}}</p>
            <h2 class="product-price">${{$product->price}}</h2>

            <div class="form_section">
                @if ($errors->any())
                    <div class="error-msg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form>
                    @csrf

                    <div>
                        <select name="size" id="size" required>
                            <option value="" selected>--choose a size--</option>
                            <option value="Uk-6">Uk 6</option>
                            <option value="Uk-7">Uk 7</option>
                            <option value="Uk-8">UK 8</option>
                            <option value="Uk-9">UK 9</option>
                            <option value="Uk-10">UK 10</option>
                        </select>
                    </div>

                    <h2>quantity</h2>
                    <div class="quantity-bar">
                        <button type="button" class="decrement">
                            -
                        </button>

                        <button class="count">
                            0
                        </button>

                        <button type="button" class="increment">
                            +
                        </button>

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
                    quantity: document.querySelector('.count').innerText,
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

</body>
</html>

