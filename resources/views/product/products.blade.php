<!Doctype html>
<html>
<head>
    <title>Products</title>
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
                    <a href={{route('product.show',$product->id)}}>
                        <img src="{{$product->file_path}}" alt="image"/>
                    </a>
                </div>
                <div class="name">
                    {{$product->name}}

                </div>
                <div class="price">
                    ${{$product->price}}
     
                </div>
                <div class="fav-icon">
                    <img src="/images/heart.svg" alt="heart" id="fav">
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
           let isFav = false;
        fav.addEventListener('click', () => {
            // Toggle the state
            isFav = !isFav;
            
            // Toggle the 'liked' class based on the state
            fav.classList.toggle('liked', isFav);
            
            // Log the current state
            console.log(isFav);
        });
    });
</script>
</html>
