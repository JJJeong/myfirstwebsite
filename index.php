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
  'description'=>'Hello, This page is made of PHP & AWS MySQL!'
);
$update_link = '';
$delete_link = '';
$author = '';

if (isset($_GET['id'])) {
  $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id=author.id
  WHERE topic.id={$filtered_id}";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $article['title'] = htmlspecialchars($row['title']);
  $article['description'] = htmlspecialchars($row['description']);
  $article['name'] = htmlspecialchars($row['name']);

  $update_link = '<a href="update.php?id='.$_GET['id'].'"><input type="button", value="Update"></a>';
  $delete_link = '
      <form action="process_delete.php" method="post" onsubmit="if(!confirm(\'Sure?\')){return false;}">
        <input type="hidden" name="id" value="'.$_GET['id'].'">
        <input type="submit" value="Delete">
      </form>
    ';
  $author = "<p>- by {$article['name']} -</p>";
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
      <!-- <?php echo $list; ?> 랑 같은거!! -->
    </ol>
    <a href="create.php"><input type='button', value='Create new post'></a>
      <?=$update_link?>
      <?=$delete_link?>
    </div>
    <div id="grid_topic_right">
      <h2><?=$article['title']?></h2>
      <?=$article['description']?>
      <?=$author?>
    </div>
    </div>
    <h3 style="padding:10px"><a href="author.php">Go to Author page(먼저 작성자 정보를 등록해 보세요!)</a></h3>
    <input type="button" value="night" onclick="
      nightDayHandler(this);
    ">
  </body>
</html>
