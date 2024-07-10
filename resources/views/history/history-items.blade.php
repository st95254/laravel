@include('layouts.head', ['title' => '灃耘 - 購物記錄', 'cssPath' => 'css/history-item.css'])

<x-app-layout>
    <div class="content">
        <div class="item_header">
            <div class="item">商品</div>
            <div class="name"></div>
            <div class="price">單價</div>
            <div class="count">數量</div>
            <div class="sum">合計</div>
        </div>

        <div class="item_container">
            @foreach ($history->historyItems as $item)
                <div class="item_body">
                    <div class="item">
                        <img src="{{ $item->product->image }}" alt="">
                    </div>
                    <div class="name">{{ $item->product->name }}</div>
                    <div class="price">{{ $item->price }}</div>
                    <div class="count">{{ $item->quantity }}</div>
                    <div class="sum">${{ $item->price * $item->quantity }}</div>
                </div>
            @endforeach
        </div>

        <div class="detail">
            <div class="info-group">
                <label for="name">收件人：</label>
                <span class="info" id="name">{{ $history->name }}</span>
            </div>
            <div class="info-group">
                <label for="phone">聯絡電話：</label>
                <span class="info" id="phone">{{ $history->phone }}</span>
            </div>
            <div class="info-group">
                <label for="address">收貨地址：</label>
                <span class="info" id="address">{{ $history->address }}</span>
            </div>
            <div class="info-group">
                <label for="account">匯款帳號末 5 碼：</label>
                <span class="info" id="account">{{ $history->account }}</span>
            </div>
            <div class="info-group">
                <label for="note">備註：</label>
                <span class="info" id="note">{{ $history->remark ? $history->remark : '無' }}</span>
            </div>
        </div>

        <div class="money">
            <div class="line-item">
                <span class="moneyTitle">商品金額：</span>
                <span class="amount" id="product">${{ $history->total }}</span>
            </div>
            <div class="line-item">
                <span class="moneyTitle">運費金額：</span>
                <span class="amount" id="delivery_fee">${{ $history->shipping_fee }}</span>
            </div>
            <div class="line-item total">
                <span class="moneyTitle">總付款金額：</span>
                <span class="amount" id="total">${{ $history->total + $history->shipping_fee }}</span>
            </div>
        </div>
    </div>

    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1"><br>
</x-app-layout>

