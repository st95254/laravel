<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>訂單接收通知</title>
</head>
<body>
    <p>系統已成功接收到一筆新訂單，請進行後續處理。</p>
    <p>訂單編號：{{ $history->trade_no }}</p>
    <p>訂單金額：${{ $history->total }}</p>
    <p>收件人姓名：{{ $history->name }}</p>
    <p>聯絡電話：{{ $history->phone }}</p>
    <p>配送地址：{{ $history->address }}</p>
    <p>匯款帳號末 5 碼 ：{{ $history->account }}</p>
    <p>備註資訊：{{ $history->remark }}</p>
</body>
</html>