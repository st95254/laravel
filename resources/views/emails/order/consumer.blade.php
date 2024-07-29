<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>訂單確認</title>
</head>
<body>
    <p>感謝您的訂購！</p>
    <p>訂單編號：{{ $history->trade_no }}</p>
    <p>總計：${{ $history->total }}</p>
    <p>請於 30 分鐘內將款項匯至(000) 00000000000000，商品將於確認付款後出貨。</p>
    <br>
    <p>灃耘生醫股份有限公司</p>
</body>
</html>