<!DOCTYPE html>
<html lang="en">
@include('layouts.head', ['title' => '灃耘', 'cssPath' => 'css/dashboard.css'])

<body>
{{--<x-app-layout>--}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- 內容開始 --}}
                <div class="p-6 text-gray-900">
                    {{-- 這裡放置你的自訂首頁內容 --}}
                    <div class="banner">
                        <div class="welcome">
                            <span><i>Welcome</i></span>
                            <span><i>to</i></span>
                            <span><i>Feng</i></span>
                            <span><i>Yun.</i></span>
                        </div>
                        <div class="slogan">
                            <span><i>最高品質是不變的堅持</i></span>
                        </div>
                    </div>

                    <div class="showcase">
                        <a href="products/gold">
                            <img src="{{ asset('images/home_gold.jpeg') }}" alt="前往金箔商品頁">
                            <div class="description">金箔</div>
                        </a>
                        <a href="products/tea">
                            <img src="{{ asset('images/home_tea.jpg') }}" alt="前往茶葉商品頁">
                            <div class="description">茶葉</div>
                        </a>
                    </div>

                    <hr align=center width=80% color=#e6e6e6 SIZE=1>
                    <br>
                </div>
                {{-- 內容結束 --}}
            </div>
        </div>
    </div>
{{--</x-app-layout>--}}
@include('partials.footer')
</body>
</html>

