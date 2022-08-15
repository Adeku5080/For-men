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
<header class="header">
    <a href="#" class="brand-name">For-men</a>

    <div id="search-bar">
        <form action="{{route('search')}}" method="GET">
                <input type="search" name="search" placeholder="Search" >
        </form>
    </div>

    <a href="#">
        <i class="far fa-user"></i>
    </a>
    <a href="#">
        <i class="fas fa-shopping-cart">Cart</i>
    </a>
</header>
<nav>
    <ul class="second-nav">
        <li class="second-nav_links"><a href="#" class="drop-down_header">New in</a>
            <ul class="drop-down">
                <li>NEW PRODUCTS</li>
                <li><a href="{{ route('newin') }}">View all</a></li>
                <li><a href="{{route('newCloths')}}">Clothing</a></li>
                <li><a href="{{route('newAccessories')}}">Accessories</a></li>
                <li><a href="{{route('newShoes')}}">Shoes</a></li>
                <li><a href="#">Gadgets</a></li>
            </ul>

            <div class="overlay"></div>
        </li>

        <li class="second-nav_links">
            <a href="#" class="drop-down_header">Clothing</a>
            <ul class="drop-down">
                <li><a href="{{route('newCloths')}}">New in</a></li>
                <li><a href="{{route('joggers')}}">Joggers</a></li>
                <li><a href="{{route('tshirts')}}">T-shirts</a></li>
                <li><a href="{{route('shorts')}}">Shorts</a></li>
                <li><a href="{{route('shirts')}}">Shirts</a></li>
            </ul>

            <div class="overlay"></div>
        </li>

        <li class="second-nav_links"><a href="#" class="drop-down_header">Shoes</a>
            <ul class="drop-down ">
                <li><a href="#">View all</a></li>
                <li><a href="{{route('newShoes')}}">New in</a></li>
                <li><a href="{{route('trainers')}}"> Trainers</a></li>
                <li><a href="{{route('boots')}}">Boots</a></li>
                <li><a href="{{route('shoes')}}">Shoes</a></li>
            </ul>

            <div class="overlay"></div>
        </li>
        <li class="second-nav_links"><a href="#" class="drop-down_header">Accessories</a>
            <ul class="drop-down">
                <li><a href="#">View all</a></li>
                <li><a href="{{route('newAccessories')}}">New in</a></li>
                <li><a href="#">Wallets</a></li>
                <li><a href="#">Watches</a></li>
            </ul>

            <div class="overlay"></div>
        </li>
        <li class="second-nav_links"><a href="#" class="drop-down_header">Gadgets</a>
            <ul class="drop-down">
                <li><a href="#">View all</a></li>
                <li><a href="#">Phones</a></li>
                <li><a href="#">Laptops</a></li>
            </ul>

            <div class="overlay"></div>
        </li>
        <li class="second-nav_links"><a href="#">Brands</a></li>
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
    // const dropDownHeader = document.querySelectorAll('.drop-down_header');
    // const overlay = document.querySelector('.overlay');

    // for (let i = 0; i < dropDownHeader.length; i++) {
    //     dropDownHeader[i].addEventListener('mouseover', function () {
    //         overlay.classList.remove('hidden');
    //     });
    // }

    // for(const dropDown of document.querySelectorAll('.drop-down')) {
    //     dropDown.addEventListener('', function () {
    //
    //     });
    // }

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
</html>


