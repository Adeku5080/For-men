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
            <img id="product-image" src="{{$variant->file_path}}" alt="image"/>

        </div>

        <div class="product-info">
            <p id="product-name" class="product-name">{{$variant->variant_name}}</p>
            <h2 id="product-price" class="product-price">${{$variant->price}}</h2>
            <div class="form_section">


                <form>
                    @csrf

                   
                    <div class="color-circle">
                        <div> 
                         {{count($color)}} colors available
                        </div>
                         @foreach($color as $c)
                             <div class='variant_color' style="width: 20px; height: 20px; background-color: {{ $c }}; border-radius: 50%; display:inline-block; margin-right: 5px;" 
                             title="{{ ($c) }}"   data-color="{{ $c }}" data-product_id="{{$variant->product->id}}"></div>

                         @endforeach
                      <p> Select your size</p>
                        @php
                          sort($size); 
                        @endphp
                         @foreach($size as $size)
                               <p>{{$size}}</p>
                         @endforeach
                    </div>

                    <button type="submit" id="btn" value="{{ $variant->id }}" class="button"> ADD ITEM TO CART</button>
                </form>
            </div>
        </div>

        <script>
            let addToCart = document.querySelector('#btn');

            addToCart.addEventListener('click', async function (e) {
                e.preventDefault();
          
                const data = {
                    size: 22,
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
                    if (error.body && error.body.status === 403) {
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

            // fillCartCount();
            // const cartItemCount = document.querySelector(".cart-item-count")
            // addToCart.addEventListener('click',async function(){
            //     await fillCartCount();
            // })

            /**
             * get all cartItems count
             *
             */

            async function getCount(){
                    const url = `{{route('api.cart-items-count')}}`

                    
                    const response = await fetch(url);
                    console.log(response);
                 

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
        
        {{-- fetch product variant --}}
        <script>
        const variantColors = document.querySelectorAll('.variant_color');

     variantColors.forEach((variantColor) => {
    variantColor.addEventListener('click', async function(e) {
      e.preventDefault();
            let colorValue = e.target.getAttribute('data-color');
                        const product = e.target.getAttribute('data-product_id');

      await fetchProdVariantBasedOnColorValue(colorValue,product);
    });
  });

  async function fetchProdVariantBasedOnColorValue(colorValue,product) {
    try {
    const response = await fetch(`/api/products/variant/fetchVariant/${colorValue}/${product}`);
    const data = await response.json();
    console.log(data,'variant');
    // Update HTML elements with data
    document.getElementById('product-name').textContent = data.product[0].variant_name;
    // document.getElementById('product-description').textContent = data.product_details;
    document.getElementById('product-price').textContent = `$${data.product[0].price}`;
    document.getElementById('product-image').src = data.product[0].file_path;
    // document.getElementById('product-quantity').textContent = `In stock: ${data.quantity}`;
        const newUrl = `/products/${data.product[0].slug}`;
      window.history.pushState({}, '', newUrl);
  } catch (error) {
    console.error('Error fetching product variant:', error);
  }
  }

  
window.addEventListener('DOMContentLoaded', async () => {
  const slugFromUrl = window.location.pathname.split('/').pop();

  if (slugFromUrl) {
    const response = await fetch(`/api/products/variant/bySlug/${slugFromUrl}`);
    const data = await response.json();

    const variant = data.product[0];
    document.getElementById('product-name').textContent = variant.variant_name;
    document.getElementById('product-price').textContent = `$${variant.price}`;
    document.getElementById('product-image').src = variant.file_path;
  }
});        
</script>

</body>
</html>

