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

$sql = "SELECT * FROM author";
$result = mysqli_query($conn, $sql);
$select_form = '<select name="author_id">';
while ($row = mysqli_fetch_array($result)) {
  $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
  // 원하는 옵션을 선택해서 서버쪽으로 input하는 태그
}
$select_form .= '</select>';
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
      <!-- <?php echo $list; ?> 랑 같은거!! -->
    </ol></div>
    <div id="grid_topic_right">
    <h2>Create new post</h2>
    <form action="process_create.php" method="POST">
      <p><input type="text" name="title" placeholder="Title"></p>
      <p><textarea name="description" placeholder="Description"></textarea></p>
      <?=$select_form?>
      <p><input type="submit" value="Submit"></a>
      <a href="index.php"><input type="button" name="cancel_button" value="Cancel"></a></p>
    </form></div>
    </div>
    <h3 style="padding:10px"><a href="index.php">Go to Comment page(새로운 내용을 작성해 보세요!)</a></h3>
    <input type="button" value="night" onclick="
    nightDayHandler(this);
    ">
  </body>
</html>
