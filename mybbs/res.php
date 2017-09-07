<?php
$res = $_GET["res"];
//データベースに接続
$db = mysqli_connect('localhost', 'root', 'password', 'mybbsdb') or
die(mysqli_connect_error());
mysqli_set_charset($db, 'utf8');

//投稿に返信する
$sql = sprintf('SELECT name, message FROM mybbs_data WHERE id =%d',
mysqli_real_escape_string($db, $res));
$record = mysqli_query($db, $sql) or die(mysqli_error($db));
$data = mysqli_fetch_assoc($record);
$message = $data['name'] . ' / ' .  $data['created'] . $data['message'];

//投稿を記録する
if(!empty($_POST)) {
  if($_POST['name'] != '' && $_POST['comment'] !='') {
    $sql = sprintf('INSERT INTO mybbs_data SET name="%s", message="%s", reply_id=%d, created=NOW()',
      mysqli_real_escape_string($db, $_POST['name']),
      mysqli_real_escape_string($db, $_POST['comment']),
      mysqli_real_escape_string($db, $_GET['res'])
    );
    mysqli_query($db, $sql) or die(mysqli_error($db));
    header('Location:index.php');
    exit();
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

  <title>返信画面</title>
</head>
<body>
  <form method="post" action="">
    投稿者<input type="text" name="name" value=""/>
    <br>
    本文<br>
    <textarea name="comment" rows="4" cols="26">
      </textarea>
      <br>
    <input type="submit" name="reply" value="返信">
  </form>
</body>
</html>
