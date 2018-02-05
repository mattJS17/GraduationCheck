<?php
  session_start();
  $member = $_SESSION['session_auth_member'];

  echo "<meta charset=\"utf-8\">";

  $connect = mysqli_connect('localhost','root','applemac','macDB');
  if (!$connect) {
    die('Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
  }

  $page = mysqli_real_escape_string($connect, $_GET['page']);

  if (!empty($member[0])) {
    session_destroy();
  }

  //echo "<script>alert(\"로그아웃 처리되었습니다.\");";
  echo "<script>location.replace(\"login.php\");</script>";
?>
