<!Doctype html>
<html>
<head>
    <title>show-product</title>
    <link rel="stylesheet" href={{asset('vendor/css/show_product.css')}}>
</head>
<body>
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
                        <select name="size" id="size">
                            <option value="" selected>--choose a size--</option>
                            <option value="Uk-6">Uk 6</option>
                            <option value="Uk-7">Uk 7</option>
                            <option value="Uk-8">UK 8</option>
                            <option value="Uk-9">UK 9</option>
                            <option value="Uk-10">UK 10</option>
                        </select>
                    </div>

                    <div>
                        <label for="quantity">
                            quantity
                        </label>
                        <select name="quantity" id="quantity">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10+">10+</option>
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
                    quantity: document.querySelector("[name='quantity']").value,
                    productId: e.target.value,
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
                        },
                        body: JSON.stringify(data)
                    })

                    return response.text();
                } catch (error) {
                    console.log(error);
                }
            }
        </script>
</body>
</html>

