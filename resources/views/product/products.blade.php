<!Doctype html>
<html>
<head>
    <title>Products</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('vendor/css/products.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous"/>

</head>
<body>
<Main class="container">
    <h2>All products under ......</h2>
    <div class="products_container">
        @foreach($products as $product)
    
            <div class="product">
                <div class="image-container">
                    <a href={{route('product.show',$product->slug)}}>
                        <img src="{{$product->file_path}}" alt="image"/>
                    </a>
                </div>
                <div class="name">
                    {{$product->variant_name}}

                </div>
                <div class="price">
                    {{-- ${{$product->price}} --}}

                </div>
                <div class="fav-icon">
                    <img src="/images/heart.svg" alt="heart" id="fav"  data-id={{$product->id}}>
                </div>
            </div>

        @endforeach
    </div>

</Main>

</body>

{{--
toggle like items --}}
<script>

    // Select all elements with the id 'fav'
    const favElements = document.querySelectorAll("#fav");

    // Add click event listeners to each element
    favElements.forEach((fav) => {
       console.log(fav,'fav')
           let isFav = false;
           const productId = fav.getAttribute('data-id');
        fav.addEventListener('click', async() => {
            // Toggle the state
            isFav = !isFav;

            // Toggle the 'liked' class based on the state
            fav.classList.toggle('liked', isFav)

             if(isFav){
                 const {data} = await addToFav(productId)
                 console.log(data,'response')
             }else{
                 await removeFav(productId)
             }
            // Log the current state
            console.log(isFav);
        });
    });


    // Add product to Favourites
    const addToFav = async(data)=>{
       await fetch('/api/add-to-favourites',{
        method:"POST",
            mode: "cors",
    cache: "no-cache",
    credentials: "same-origin",
      headers: {
      "Content-Type": "application/json",
      'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')


    },
        body: JSON.stringify({productId :data}),

       })
       return response.json()
    }

    // remove product from favourites
    const removeFav = async(data)=>{
        await fetch(`/api/removeFav/${data}`,{
            method:'DELETE',
            headers: {
                "Content-Type": "application/json",
            },

        })
    }
</script>
</html>
