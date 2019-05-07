<?php
$conn = mysqli_connect("happycat.ce5hlqvqeotl.ap-northeast-2.rds.amazonaws.com", "jjung", "slhs75$&75##", "happycat");
//mysql 접속 함수
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
    <link rel="stylesheet" href="style_author.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="colors.js"></script>
  </head>
  <body>
    <h1><a href="index.php">WEB</a></h1>
    <div id="grid_author_left">
    <div><p><h2 style="text-align:center; margin-bottom:5px">User table</h2></p>
    <table>
      <tr id="attri">
        <td>Id</td> <td>Name</td> <td>Profile</td> <td>Update</td> <td>Delete</td>
        <?php
        $sql = "SELECT * FROM author";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
          $filtered = array(
            'id' => htmlspecialchars($row['id']),
            'name' => htmlspecialchars($row['name']),
            'profile' => htmlspecialchars($row['profile']),
          );
          ?>
          <tr>
            <td><?=$filtered['id']?></td>
            <td><?=$filtered['name']?></td>
            <td><?=$filtered['profile']?></td>
            <td><a href="author.php?id=<?=$filtered['id']?>"><input type="button" value="Update"></a></td>
            <td>
              <?php if ($filtered['id'] !== '1'): ?>
                <form action="process_delete_author.php" method="post" onsubmit="if(!confirm('Sure?')){return false;}">
                  <input type="hidden" name="id" value="<?=$filtered['id']?>">
                  <input type="submit" value="Delete">
                </form>
              <?php endif; ?>

            </td>
          </tr>
          <?php
        }
        ?>
      </tr>
    </table>
    </div>
    <?php
    $escape = array(
      'name' =>'',
      'profile' =>''
    );
    $lable_submit = 'Create author';
    $form_action = 'process_create_author.php';
    $form_id = '';
    $explain = '<h3>Put a new Author name(자신의 정보를 등록해 보세요!)<h3>';
    $cancel_button = '';
    if(isset($_GET['id'])) {
      $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
      settype($filtered_id, 'integer');
      $sql = "SELECT * FROM author WHERE id={$filtered_id}";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      $escape['name'] = htmlspecialchars($row['name']);
      $escape['profile'] = htmlspecialchars($row['profile']);
      $lable_submit = 'Update author';
      $form_action = 'process_update_author.php';
      $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
      $explain = '<h3>How do you want to cahnge?<h3>';
      $cancel_button = '<a href="author.php"><input type="button" name="cancel_button" value="Cancel"></a>';
    }
    ?>

    <div id="grid_author_right">
    <form action="<?=$form_action?>" method="post">
      <?=$form_id?>
      <?=$explain?>
      <p><input type="text" name="name" placeholder="Name" value="<?=$escape['name']?>"></p>
      <p><textarea name="profile" placeholder="Profile"><?=$escape['profile']?></textarea></p>
      <p><input type="submit" value="<?=$lable_submit?>">  <?=$cancel_button?></p>
    </form></div>
    </div>
    <h3 style="padding:10px"><a href="index.php">Go to Comment page(새로운 내용을 작성해 보세요!)</a></h3>
    <input type="button" value="night" onclick="
      nightDayHandler(this);
    ">
  </body>
</html>
