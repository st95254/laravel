@include('layouts.head', ['title' => '灃耘 - 購物記錄', 'cssPath' => 'css/history.css'])

<x-app-layout>
    <div class="content">
        <div class="item_header">
            <div class="trade_no">訂單編號</div>
            <div class="date">購買日期</div>
            <div class="amount">合計</div>
            <div class="state">訂單狀態</div>
            <div class="btn">　　</div>
        </div>
        @foreach($histories as $history)
        <div class="item_body">
            <div class="trade_no">{{ $history->trade_no }}</div>
            <div class="date">{{ $history->date->format('Y-m-d') }}</div>
            <div class="amount">${{ $history->total }}</div>
            <div class="state">{{ $history->status }}</div>
            <button onclick="window.location.href='{{ route('history.items', ['history_id' => $history->id]) }}'" id="btn">查看訂單</button>
        </div>
        @endforeach
        <div class="pagination">
            {{ $histories->links('pagination::default') }}
        </div>
    </div>
    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1"><br>
</x-app-layout>

<script src="{{ asset('js/history.js') }}"></script>
