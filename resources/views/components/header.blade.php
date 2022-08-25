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
            <i class="fas fa-shopping-cart cart-icon"></i><span class="cart-item-count"></span>
        </a>

        <div class="cart-dropdown">
            <div class="cart-dropdown-header">
                <div>
                    <span class="dropdown-header-title">My cart,</span><span>1 item</span>
                </div>

                <p>X</p>
            </div>
        </div>
    </header>



</div>
