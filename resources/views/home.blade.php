<!Doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('vendor/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/home_body.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/footer.css') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous"/>
</head>
<body>
<x-header/>
<nav>
    <ul class="second-nav">
        @foreach($categories as $category)
            <li class="second-nav_links">
                        <a href="#" class="drop-down_header" data-id="{{$category->id}}">{{$category->name}}</a>
                        <div class="drop-down">
                        </div>
                  </li>

        @endforeach

    </ul>
</nav>

<section class="New-in_section">
    <div class="New-in_container">
        <div class="New-in_header">
            <h2 class="New-in_header_text">Fresh finds</h2>
        </div>
        <div class="New-in_link">
            <a href="#">SHOP NEW IN</a>
        </div>
    </div>

</section>

<section class="brand-edit_section">
    <div class="statement-shirt">
        <img src="{{url('/images/homePageImgs/statementShirt.jpg')}}" class="statementShirt-img brand-edit_image"
             alt="">
        <h4 class="brand-edit_heading">STATEMENT SHIRTS</h4>
        <p class="brand-edit_paragraph">Dancefloor classics</p>
    </div>

    <div class="puma">
        <img src="{{url('/images/homePageImgs/homePuma.webp')}}" class="puma-img brand-edit_image" alt="">
        <h4 class="brand-edit_heading">PUMA</h4>
        <p class="brand-edit_paragraph">Cop'em fast</p>
    </div>

    <div class="swim-short">
        <img src="{{url('/images/homePageImgs/homeSwimWins.webp')}}" class="swimWins-img brand-edit_image" alt="">
        <h4 class="brand-edit_heading">SWIM WINS</h4>
        <p class="brand-edit_paragraph">Heat wavey,baby</p>
    </div>

    <div class="accessory">
        <img src="{{url('/images/homePageImgs/acessoryFind.jpg')}}" class="accessory-img brand-edit_image" alt="">
        <h4 class="brand-edit_heading">ACCESSORIES</h4>
        <p class="brand-edit_paragraph">Accesory find</p>
    </div>
</section>

<section class="trending-brands-header">
    <h4>TRENDING BRANDS</h4>
</section>

<section class="trending-brands">
    <div class="trending-brands_imgs">
        <img src="{{url('/images/trendingBrands/tommyhilfiger.webp')}}" class="trending-brand_img" alt="">
    </div>

    <div class="trending-brands_imgs">
        <img src="{{url('/images/trendingBrands/nike.webp')}}" class="trending-brand_img" alt="">
    </div>

    <div class="trending-brands_imgs">
        <img src="{{url('/images/trendingBrands/collusion.png')}}" class="trending-brand_img" alt="">
    </div>

    <div class="trending-brands_imgs">
        <img src="{{url('/images/trendingBrands/addidas.jpg')}}" class="trending-brand_img" alt="">
    </div>
</section>

<footer class="footer">
    <section class="contacts-and-payment">
        <div class="contact-container">
            <div>
                <i class="fab fa-facebook contact-img"></i>
            </div>

            <div>
                <i class="fab fa-snapchat contact-img"></i>
            </div>

            <div>
                <i class="fab fa-instagram contact-img"></i>
            </div>
        </div>
        <div class="divider">
            |
        </div>
        <div class="payment-container">
            <img src="{{url('/images/paymentOptions/visa.webp')}}" class="payment-img" alt="">
        </div>

        <div class="payment-container">
            <img src="{{url('/images/paymentOptions/mastercard.webp')}}" class="payment-img" alt="">
        </div>

        <div class="payment-container">
            <img src="{{url('/images/paymentOptions/payPal.webp')}}" class="payment-img" alt="">
        </div>
    </section>

    <section class="help-and-abt-section">
        <div class="extra-info">
            <h4>HELP & INFORMATION</h4>
            <p>Help</p>
            <p>Track order</p>
            <p>Delivery & returns</p>
            <p>Privacy Policy</p>
        </div>

        <div class="extra-info">
            <h4>ABOUT FOR-MEN</h4>
            <p>About us</p>
            <p>Careers at FOR-MEN</p>
            <p>Corporate Responsibility</p>
            <p>Investors' site</p>
        </div>

        <div class="extra-info">
            <h4>BUYING FROM FOR-MEN</h4>
            <p>Buyer Safety Centre</p>
            <p>FAQS</p>
            <p>Digital Services</p>
            <p>Bulk Purchase</p>
        </div>

        <div class="extra-info">
            <h4>MAKE MONEY ON FOR-MEN</h4>
            <p>Become a For-men Affiliate</p>
        </div>

    </section>

</footer>
</body>
<script>


   window.addEventListener('scroll', function () {
       const scrollPos = window.pageYOffset;

       toggleSticky(scrollY > 90);
   });

   function toggleSticky(activate = true) {
       for (const dropDown of document.querySelectorAll('.drop-down')) {
           if (activate) {
               dropDown.classList.add('stick-dropDown')
           } else {
               dropDown.classList.remove('stick-dropDown')
           }
       }

       for (const overlay of document.querySelectorAll('.second-nav_links .overlay')) {
           if (activate) {
               overlay.classList.add('stick-dropDown')
           } else {
               overlay.classList.remove('stick-dropDown')
           }
       }
   }

</script>

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

{{--toggle cart dropdown--}}
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
        const response = await fetch('api/cart-items');

        return response.json()
    }

    //    add cartItems to cartDropdown

    async function fillCartDropDown() {
        const {data} = await getCartItems();

        let displayItems = data.map((item) => {
            return `
            <div class="main-content">
              <div class="dropdown-image">
                  <img class="image" src="/images/productImgs/${item.item_file_path}" alt="image"/>
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

{{--Get total price of cart items--}}<script>
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


{{--fetch all subCategories on hover on a category--}}

<script>
    const categories = document.querySelectorAll(".drop-down_header")
    // const dropDown = document.querySelector(".drop-down")
    for(let i = 0 ; i < categories.length ; i++){
        categories[i].addEventListener('mouseover' ,async function(){
                const categoryId = categories[i].getAttribute('data-id')
                const {data} = await fetchSubCategories(categoryId)

                //fill overlay
                let overlayItems = data.map((datum)=>{
                    return `
                 <a  class=drop-down_item href='/subcategories/${datum.id}/products'>
                  ${datum.name}
                 </a>
                `
                })
            const dropDown = categories[i].parentNode.querySelector('.drop-down')
            dropDown.innerHTML = overlayItems.join("")
        })
    }

     async function fetchSubCategories(id){
      console.log(id)
         const response = await fetch(`/api/categories/${id}/subcategories`)
         return response.json()
     }



</script>
</html>

