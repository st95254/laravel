<link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}">

<header>
    <div class="header-container">
        <div class="header-left">
            <div class="logo">
                <a href="{{ route('dashboard') }}">灃耘</a>
            </div>
            <ul id="left-menu">
                <li><a href="{{ route('products.gold') }}">金箔</a></li>
                <li><a href="{{ route('products.tea') }}">茶葉</a></li>
            </ul>
        </div>
        <div class="@auth header-right-after @else header-right-before @endauth">
            @guest
                <div id="before-login">
                    <ul id="right-menu">
                        <li><a href="{{ route('login') }}" style="margin-right:28px;">登入</a></li>
                        <li><a href="{{ route('register') }}">註冊</a></li>
                    </ul>
                </div>
            @endguest
            @auth
                <div id="after-login">
                    <ul id="right-menu">
                        <li>
                            <a href="{{ route('cart') }}">
                                <img id="cart" src="{{ asset('images/header/cart.png') }}">
                                <span class="tooltip">前往購物車</span>
                            </a>
                        </li>
                        <li>
                            <img id="user" src="{{ asset('images/header/user.png') }}">
                            <ul>
                                <li><a href="">購買紀錄</a></li>
                                <li><a href="{{ route('profile.edit') }}">個人資料</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">登　　出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
        </div>
    </div>
</header>
