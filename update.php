<?php
$conn = mysqli_connect("happycat.ce5hlqvqeotl.ap-northeast-2.rds.amazonaws.com", "jjung", "slhs75$&75##", "happycat");
//mysql 접속 함수
$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
$list = '';
while($row = mysqli_fetch_array($result)) {
  $escaped_title = htmlspecialchars($row['title']);
  $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
}

$article = array(
  'title'=>'Welcome!',
  'description'=>'Hello, PHP & MySQL!'
);
$update_link = '';
$cancel_button = '';
if (isset($_GET['id'])) {
  $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM topic WHERE id={$_GET['id']}";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $article['title'] = htmlspecialchars($row['title']);
  $article['description'] = htmlspecialchars($row['description']);
  $update_link = '<a href="update.php?id='.$_GET['id'].'">Update</a>';
  $cancel_button = '<a href="index.php?id='.$_GET['id'].'"><input type="button" name="cancel_button" value="Cancel"></a>';
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
    <link rel="stylesheet" href="style_topic.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="colors.js"></script>
  </head>
  <body>
    <h1><a href="index.php">WEB</a></h1>
  <div id="grid_topic_left">
    <div><ol>
    <?= $list?>
  </ol></div>
  <div id="grid_topic_right">
  <h3>How do you want to cahnge?<h3>
    <form action="process_update.php" method="POST">
      <input type="hidden" name="id" value="<?=$_GET['id']?>">
      <p><input type="text" name="title" placeholder="Title" value="<?=$article['title']?>"></p>
      <p><textarea name="description" placeholder="Description"><?=$article['description']?></textarea></p>
      <p><input type="submit" value="Update">  <?=$cancel_button?></p>
    </form></div>
  </div>
  <h3 style="padding:10px"><a href="index.php">Go to Comment page(새로운 내용을 작성해 보세요!)</a></h3>
  <input type="button" value="night" onclick="
    nightDayHandler(this);
  ">
  </body>
</html>
