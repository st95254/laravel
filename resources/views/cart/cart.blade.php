@include('layouts.head', ['title' => '灃耘 - 購物車', 'cssPath' => 'css/cart.css'])

<x-app-layout>
    <div class="content">
        <div class="item_header">
            <div class="item">商品</div>
            <div class="name">　　</div>
            <div class="price">單價</div>
            <div class="count">數量</div> 
            <div class="sum">小計</div>
            <div class="operate">　　</div>
        </div>
        @foreach ($cart_items as $item)
        <div class="item_body" data-item-id="{{ $item->id }}">
            <div class="item">
                <img src="{{ $item->product->image }}" alt="">
            </div>
            <div class="name">{{ $item->product->name }}</div>
            <div class="price">${{ $item->price }}</div>
            <div class="count">
                <button class="sub">-</button>
                <span>{{ $item->quantity }}</span>
                <button class="plus">+</button>
            </div>
            <div class="sum">${{ $item->price * $item->quantity }}</div>
            <div class="operate">
                <button class="delete">刪除</button>
            </div>
        </div>
        @endforeach

        <div class="title">訂單資料</div>
        <div class="lable">
            <p>▌請確實填寫以下資料</p>
        </div>

        <div class="content-wrapper">
            <div class="order_sec">
                <form id="order_form" action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="name">收件人 </label>
                        <input id="name" name="name" type="text" maxlength="100" autocomplete="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="input-group">
                        <label for="phone">聯絡電話 </label>
                        <input id="phone" name="phone" type="text" autocomplete="tel" pattern="^\d{8,15}$" value="{{ old('phone')}}" required>
                    </div>
                    <div class="input-group">
                        <label for="address">收貨地址 </label>
                        <input id="address" name="address" type="text" maxlength="100" autocomplete="street-address" value="{{ old('address')}}" required>
                    </div>
                    <div class="input-group">
                        <label for="account">匯款帳號末 5 碼 </label>
                        <input id="account" name="account" type="text" autocomplete="off" pattern="^\d{5}$" value="{{ old('remark')}}" required>
                    </div>
                    <div class="input-group">
                        <div>備註</div>
                        <input id="remark" name="remark" type="text" maxlength="100" autocomplete="off" value="{{ old('remark')}}">
                    </div>
                    <input type="hidden" id="totalInput" name="totalInput">
                    <input type="hidden" id="shippingFeeInput" name="shippingFeeInput">
                    <input type="hidden" id="orderStatusInput" name="orderStatusInput">
                </form>
            </div>

            <div class="money">
                <div class="line-item">
                    <span class="moneyTitle">商品金額：</span>
                    <span class="amount" id="product">$0</span>
                </div>
                <div class="line-item">
                    <span class="moneyTitle">運費金額：</span>
                    <span class="amount" id="delivery_fee">$60</span>
                </div>
                <div class="line-item total">
                    <span class="moneyTitle">總付款金額：</span>
                    <span class="amount" id="total">$0</span>
                </div>
                <button type="submit" id="submitBtn" form="order_form">提交訂單</button>
            </div>
        </div>

        <div class="note">
            <p>📣 訂單滿 $1000 免運費。</p>
            <p>📣 下單後請將款項匯至 (000) 00000000000000，商品將於確認付款後出貨。</p>
            <p>📣 訂單成立後無法變更配送地址，敬請見諒。 若收件人資訊不完整或配送不成功，商品退回後訂單將進行退款。</p>
        </div>
    </div>
    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1"><br>
</x-app-layout>

<script src="{{ asset('js/cart.js') }}"></script>

