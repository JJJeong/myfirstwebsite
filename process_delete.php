<?php
$conn = mysqli_connect("happycat.ce5hlqvqeotl.ap-northeast-2.rds.amazonaws.com", "jjung", "slhs75$&75##", "happycat");
//mysql 접속 함수
settype($_POST['id'], 'integer');
$filtered = array(
  'id'=>mysqli_real_escape_string($conn, $_POST['id']),
);

$sql = "
  DELETE FROM topic
    WHERE id = {$filtered['id']}
";

$result = mysqli_query($conn, $sql);
if ($result === false) {
  echo "삭제하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요";
  error_log(mysqli_error($conn));
  //error_log(내용) : '내용'의 에러가 아파치 에러로그에 기록되게  하는 함수
} else {
  echo '삭제했습니다. <a href="index.php"><input type="button" value="돌아가기"></a>';
}
?>
