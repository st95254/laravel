@include('layouts.head', ['title' => '灃耘', 'cssPath' => 'css/dashboard.css'])

<x-app-layout>
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
            <img src="{{ asset('images/home/gold.jpeg') }}" alt="前往金箔商品頁">
            <div class="description">金箔</div>
        </a>
        <a href="products/tea">
            <img src="{{ asset('images/home/tea.jpg') }}" alt="前往茶葉商品頁">
            <div class="description">茶葉</div>
        </a>
    </div>

    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1">
    <br><br>
    
</x-app-layout>

 <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>

