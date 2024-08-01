@include('layouts.head', ['title' => '灃耘 - 訂單記錄', 'cssPath' => 'css/admin/history.css'])

<x-app-layout>
    <div class="content">
        <form id="searchForm" method="POST" action="{{ route('history.user') }}">
            @csrf
            <input type="text" name="email" placeholder="使用者電子信箱">
            <button type="submit">搜尋</button>
        </form>

        <form id="searchForm" method="POST" action="{{ route('history.search') }}">
            @csrf
            <input type="text" name="trade_no" placeholder="訂單編號">
            <button type="submit">搜尋</button>
        </form>

        <form id="updateStatusForm" method="POST" action="{{ route('history.updateStatus') }}">
            @csrf
            <input type="text" name="trade_no" placeholder="訂單編號" required>
            <select name="new_status" required>
                <option value="">選擇狀態</option>
                <option value="處理中">處理中</option>
                <option value="取消">取消</option>
                <option value="完成">完成</option>
                <option value="退貨退款">退貨退款</option>
            </select>
            <button type="submit">更新狀態</button>
        </form>

        <div class="item_header">
            <div class="trade_no">訂單編號</div>
            <div class="date">購買日期</div>
            <div class="amount">合計</div>
            <div class="state">訂單狀態</div>
            <div class="btn">　　</div>
        </div>

        @foreach($histories as $history)
        <div class="item_body">
            <div class="trade_no"  data-label="訂單編號：">{{ $history->trade_no }}</div>
            <div class="date" data-label="購買日期：">{{ $history->date->format('Y-m-d') }}</div>
            <div class="amount" data-label="合計：">${{ $history->total }}</div>
            <div class="state" data-label="訂單狀態：">{{ $history->status }}</div>
            <button onclick="window.location.href='{{ route('history.items', ['history_id' => $history->id]) }}'" id="btn">查看訂單</button>
        </div>
        @endforeach
        <div class="pagination">
            {{ $histories->links('pagination::default') }}
        </div>
    </div>
    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1"><br>
</x-app-layout>

<script>
    @if (session('error'))
        alert('{{ session('error') }}');
    @endif
</script>
