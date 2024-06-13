@include('layouts.head', ['title' => '灃耘 - 下單成功', 'cssPath' => 'css/checkout.css'])

<x-app-layout>
    <div class="content">
        <div class="detail">
            <p>感謝您的訂購！<p>
            <p>📣 下單後請將款項匯至 (000) 00000000000000，商品將於確認付款後出貨。</p>
            <p>📣 訂單成立後無法變更配送地址，敬請見諒。 若收件人資訊不完整或配送不成功，商品退回後訂單將進行退款。</p>
        </div>
        <button onclick="window.location.href='{{ route('dashboard') }}'" id="btn">回首頁</button>
    </div>

    <br><br><br>
    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1">
    <br>
</x-app-layout>
