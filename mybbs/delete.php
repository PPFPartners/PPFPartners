<?php

$id = $_GET["id"];

//データベースに接続
$db = mysqli_connect('localhost', 'root', 'password', 'mybbsdb') or
die(mysqli_connect_error());
mysqli_set_charset($db, 'utf8');

//投稿を削除する
$sql = sprintf('DELETE FROM mybbs_data WHERE id =%d',
mysqli_real_escape_string($db, $id));
mysqli_query($db, $sql) or die(mysqli_error($db));

header('Location: index.php');
exit();
?>
