<div>
    <header class="header">

        <a href="{{route('home')}}" class="brand-name">For-men</a>

        <div id="search-bar">
            <form action="{{route('search')}}" method="GET">
                <input type="search" name="search" placeholder="Search">
            </form>
        </div>

        <a href="#">
            <i class="far fa-user"></i>
        </a>
        <a href="{{route('cart.show')}}">
            <i class="fas fa-shopping-cart"></i><span class="cart-item-count"></span>
        </a>
    </header>

</div>
