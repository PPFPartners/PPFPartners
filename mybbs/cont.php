<?php
//データベースに接続
$db = mysqli_connect('localhost', 'root', 'password', 'mybbsdb') or
die(mysqli_connect_error());
mysqli_set_charset($db, 'utf8');

//投稿を記録する
if(!empty($_POST)) {
  if($_POST['name'] != '' && $_POST['comment'] !='') {
    $sql = sprintf('INSERT INTO mybbs_data SET name="%s", message="%s", created=NOW()',
      mysqli_real_escape_string($db, $_POST['name']),
      mysqli_real_escape_string($db, $_POST['comment'])
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
  <title>掲示板</title>
</head>
<body>
  <form method="post" action="">
    投稿者<input type="text" name="name" value=""/>
    <br>
    本文<br>
    <textarea name="comment" rows="4" cols="26"></textarea><br>
    <input type="submit" name="send" value="投稿">
  </form>
</body>
</html>
