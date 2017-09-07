<?php
//データベースに接続
$db = mysqli_connect('localhost', 'root', 'password', 'mybbsdb') or
//エラー表示
die(mysqli_connect_error());
//文字セットの設定
mysqli_set_charset($db, 'utf8');

//reply_idが0の投稿内容を取得（降順）
//$recordSet = mysqli_query($db, 'SELECT * FROM mybbs_data ORDER BY id DESC');
$recordSet = mysqli_query($db, 'SELECT * FROM mybbs_data WHERE reply_id = 0 ORDER BY id DESC');
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <link rel="stylesheet" type="text/css" href="res.css"/>
  <title>一覧</title>
</head>
<body>
  <h2>一覧</h2>
  <ul style="list-style:none;">
<?php
//新規投稿
  while ($data = mysqli_fetch_assoc($recordSet))  {
//    if($data['reply_id'] == 0) {
      echo '<li>';
      echo '<p>' . htmlspecialchars($data['name']) . ' / ' . htmlspecialchars($data['created']) . '<br>';
      echo nl2br(htmlspecialchars($data['message'])) . '</p>';
?>
    <p>
      <a href="delete.php?id=<?php echo $data['id']; ?>">削除</a>
      <a href="res.php?res=<?php echo $data['id']; ?>">返信</a>
    </p>
<?php
      echo '<hr>';
//    }
?>
<!--  <div class="res">-->
<?php
    //返信
    $data_reply = mysqli_query($db, 'SELECT * FROM mybbs_data WHERE reply_id=' . $data['id'] . ' ORDER BY id ASC' );
    if ($data_reply->num_rows > 0) {
      echo '<ul style="list-style:none;">';
      while($same = mysqli_fetch_assoc($data_reply)) {
        echo '<li class="res">';
        echo '<p>' . htmlspecialchars($same['name']) . ' / ' . htmlspecialchars($same['created']) . '<br>';
        echo nl2br(htmlspecialchars($same['message'])) . '</p>';
?>
      <p>
        <a href="delete.php?id=<?php echo $same['id']; ?>">返信削除</a>
        <a href="res.php?res=<?php echo $same['id']; ?>">返信</a>
      </p>
<?php
        echo '<hr>';
        echo '</li>';
      }
      echo '</ul>';
    }
    echo '</li>';
  }
?>
</div>
</ul>
<p><a href="./cont.php">投稿する</a></p><br>

</body>
</html>
