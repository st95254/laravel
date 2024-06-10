<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}">
</head>
<body>
<header>
    <div class="header-container">
        <div class="header-left">
            <div class="logo">
                <a href="{{ url('/') }}">灃耘</a>
            </div>
            <ul id="left-menu">
                <li><a href="{{ url('/gold') }}">金箔</a></li>
                <li><a href="{{ url('/tea') }}">茶葉</a></li>
            </ul>
        </div>
        <div class="header-right-before">
            <!-- 登入前 -->
            @guest
            <div id="before-login">
                <ul id="right-menu">
                    <li><a href="{{ route('login') }}" style="margin-right:28px;">登入</a></li>
                    <li><a href="{{ route('register') }}">註冊</a></li>
                </ul>
            </div>
            @endguest

            <!-- 登入后 -->
            @auth
            <div id="after-login">
                <ul id="right-menu">
                    <li>
                        <a href="{{ url('/cart') }}">
                            <img id="cart" src="{{ asset('element/header_cart.png') }}">
                            <span class="tooltip">前往購物車</span>
                        </a>
                    </li>
                    <li>
                        <img id="user" src="{{ asset('element/header_user.png') }}">
                        <ul>
                            <li><a href="{{ url('/history') }}">購買紀錄</a></li>
                            <li><a href="{{ url('/logout') }}">登出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </div>
</header>
