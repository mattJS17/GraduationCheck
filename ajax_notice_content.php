<?php
session_start();
$member = $_SESSION['session_auth_member'];
echo "<meta charset=\"utf-8\">";

$connect = mysqli_connect('localhost', 'root', 'applemac', 'macDB');

if (!$connect) {
  die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
}

  mysqli_select_db($connect, "macDB");

    $no = mysqli_real_escape_string($connect, $_POST['no']);
    //$no = $_GET['no'];
    $query_mysql="SELECT title, data FROM notice WHERE noticeKey='$no' ";
    if ($result = mysqli_query($connect, $query_mysql)) {
      if (mysqli_num_rows($result) == 1) {
        $result_each = mysqli_fetch_assoc($result);
        echo "<p style=\"font-size: 150%; font-weight: bold; text-align: center;\">" . $result_each['title'] . "</p><br><p>" . $result_each['data'] . "</p>";
      } else {
        echo "<p style=\"font-size: 150%; font-weight: bold; text-align: center;\">해당 글을 찾을 수 없습니다.<br>게시자가 글을 삭제하였거나 관리자에 의해 접근이 차단되었습니다.</p>";
      }
    }
?>
