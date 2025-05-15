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
                    <div id="product-size">
                        @foreach($size as $size)
                               <p class="size-option" data-size="{{$size}}">{{$size}}</p>
                         @endforeach
                    </div>
                     
                    </div>

                    <button type="submit" id="btn" value="{{ $variant->id }}" class="button"> ADD ITEM TO CART</button>
                </form>
            </div>
        </div>


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
    // Update HTML elements with data
    document.getElementById('product-name').textContent = data.product[0].variant_name;
    document.getElementById('product-price').textContent = `$${data.product[0].price}`;
    document.getElementById('product-image').src = data.product[0].file_path;

        // Handle sizes
       const sizeContainer = document.getElementById('product-size');
      sizeContainer.innerHTML = ''; // Clear previous sizes

const sizes = data.product[0].sizes.split(',').map(s => s.trim());

sizes.sort((a,b)=>a-b);
sizes.forEach(size => {
    const p = document.createElement('p');
    p.classList.add('size-option'); 
    p.textContent = size;

     p.addEventListener('click', function(e) {
        e.preventDefault();
        
        document.querySelectorAll('.size-option').forEach(el => {
            el.classList.remove('selected');
        });

        p.classList.add('selected');
    });
    sizeContainer.appendChild(p);
});

        const newUrl = `/products/${data.product[0].slug}`;
      window.history.pushState({}, '', newUrl);
  } catch (error) {
    console.error('Error fetching product variant:', error);
  }
  }

  
//  window.addEventListener('DOMContentLoaded', async () => {
//   const slugFromUrl = window.location.pathname.split('/').pop();

//    if (slugFromUrl) {
//      const response = await fetch(`/api/products/variant/bySlug/${slugFromUrl}`);
//      const data = await response.json();

//      const variant = data.product;
//      document.getElementById('product-name').textContent = variant.variant_name;
//      document.getElementById('product-price').textContent = `$${variant.price}`;
//      document.getElementById('product-image').src = variant.file_path;

//        // Handle sizes
//         const sizeContainer = document.getElementById('product-size');

//  const sizes = data.product[0].sizes.split(',').map(s => s.trim());

//  sizes.sort(); 

//  sizes.forEach(size => {
//      const p = document.createElement('p');
//      p.classList.add('size-option'); 
//      p.textContent = size;
//      sizeContainer.appendChild(p);
//  });
//    }
//  });        
</script>

<script>
 let sizeOptions = document.querySelectorAll('.size-option');

sizeOptions.forEach((sizeOption) => {
  sizeOption.addEventListener('click', function(e) {
    e.preventDefault();

    sizeOptions.forEach((el) => el.classList.remove('selected'));

    sizeOption.classList.add('selected');
  });
});
</script>


        <script>
            let addToCart = document.querySelector('#btn');


            addToCart.addEventListener('click', async function (e) {
                e.preventDefault();

    const selectedSizeEl = document.querySelector('.size-option.selected');

    const size = selectedSizeEl ? selectedSizeEl.getAttribute('data-size') : null;


    if (!size) {
        alert('Please select a size before adding to cart.');
        return;
    }

                const data = {
                    size:size,
                    variant: e.target.value,
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


                fillCartCount();
            const cartItemCount = document.querySelector(".cart-item-count")
            addToCart.addEventListener('click',async function(){
                await fillCartCount();
            })
        </script>

</body>
</html>

