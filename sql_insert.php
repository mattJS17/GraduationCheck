<?php
 session_start();
 $member = $_SESSION['session_auth_member'];

 $connect = mysqli_connect('localhost','root','applemac','macDB');
 if (!$connect) {
   die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
 }

 mysqli_select_db($connect, "macDB");

 $coreEs = mysqli_real_escape_string($connect, $_POST['coreEs']);
 $coreSe = mysqli_real_escape_string($connect, $_POST['coreSe']);
 $majorBasic = mysqli_real_escape_string($connect, $_POST['majorBasic']);
 $majorEs = mysqli_real_escape_string($connect, $_POST['majorEs']);
 $majorSe = mysqli_real_escape_string($connect, $_POST['majorSe']);
 $gradTotal = mysqli_real_escape_string($connect, $_POST['gradTotal']);
 $gradKey = mysqli_real_escape_string($connect, $_POST['gradKey']);

 $query_mysql="UPDATE graduation SET coreEs = $coreEs, coreSe = $coreSe, majorBasic = $majorBasic, majorEs = $majorEs, majorSe = $majorSe, gradTotal = $gradTotal WHERE gradKey = $gradKey";

 $result = mysqli_query($connect, $query_mysql);
 if ($result) {
   echo "Ok";
 } else {
   echo "Failed";
 }
?>
