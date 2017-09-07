
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>関数</title>
</head>
<body>
  <h2>関数</h2>

<?php
//自動販売機関数
echo vending_machine (120, "オレンジジュース");
$price=90;
$juice_name= 'アップルジュース';
echo vending_machine ($price, $juice_name);
function vending_machine ($price, $juice_name) {
  if ($price >= 120) {
    return $juice_name . "のお買い上げありがとうございます<br>";
  } else {
    return $juice_name . "の購入金額が不足しています<br>";
  }
}
?>
</body>
</html>
