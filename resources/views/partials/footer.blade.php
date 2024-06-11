<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">

<div class="footer">
    <div class="footer-left">
        <div class="contact">
            <p>聯絡我們</p>
            <a>Facebook: SuccMail Group</a>
            <a>Email: support@458.com.tw</a>
            <a>TEL: 886-4-2249-0141</a>
        </div>
        <div class="service">
            <p>客戶服務</p>
            <a href="{{ route('policies.return') }}">退貨說明</a>
            <a href="{{ route('policies.privacy') }}">隱私權政策</a>
        </div>
    </div>
    <div class="footer-right">
        <div class="logo-footer">
            <a href="{{ route('dashboard') }}">灃耘</a>
        </div>
        <div id="copyright">
            &copy; 2024 灃耘股份有限公司. All rights reserved.
        </div>
    </div>
</div>
