<?php
 session_start();


 $connect = mysqli_connect('localhost','ubuntu','applemac','macDB');
 if (!$connect) {
   die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
 }

mysqli_select_db($connect, "auth");

//졸업 이수
$query_mysql="SELECT * FROM 졸업이수 WHERE 전공 = $member[3] ";
$result = mysqli_query($connect, $query_mysql);

//과목
$query_mysql="SELECT * FROM 과목 WHERE 입학년도 = $member[4] and 전공 = $member[3] ";
$result = mysqli_query($connect, $query_mysql);

//이수과목
$query_mysql="SELECT * FROM 이수과목 WHERE 학번 = $member[1] ";
$result = mysqli_query($connect, $query_mysql);

//인증
$query_mysql="SELECT * FROM 인증 WHERE 학번 = $member[1] ";
$result = mysqli_query($connect, $query_mysql);



 ?>
