<?php
  session_start();
  $member = $_SESSION['session_auth_member'];
  echo "<meta charset=\"utf-8\">";

  $connect = mysqli_connect('localhost', 'root', 'applemac', 'macDB');

  if (!$connect) {
    die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
  }

  mysqli_select_db($connect, "macDB");

if(!isset($_GET['id'])){
  //출력안함
}else{
  $studentId = $_GET['id'];
}
 ?>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
  <meta name="description" content="해커톤">
  <meta name="author" content="해커톤">
  <title>세종대학교 졸업인증</title>

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="images/android-desktop.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Material Design Lite">
  <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
  <meta name="msapplication-TileColor" content="#3372DF">

  <link rel="shortcut icon" href="images/favicon.png">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <style>
    @import url(http://fonts.googleapis.com/earlyaccess/nanumgothic.css);
    @import url(http://fonts.googleapis.com/earlyaccess/nanummyeongjo.css);

    body {
      font-family: 'Nanum Gothic', sans-serif;
    }

    .layout-auth .mdl-layout__content {
      background: #fafafa;
    }
  </style>
</head>
<body>
  <div class="layout-auth mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">졸업이수확인시스템</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation mdl-layout--large-screen-only">
          <?php
            if (!empty($member[0])) {
              echo "<a class=\"mdl-navigation__link\" href=\"logout.php\">" . $member[2] . " 님</a>";
            } else {
              echo "<a class=\"mdl-navigation__link\" href=\"login.html\">로그인</a>";
            }

            if ($member[5] == 2) {
              echo "<script>alert('환영합니다.\\n안전한 서비스 이용을 위해 임시로 지정된 아이디와 비밀번호를 변경하여 주시기 바랍니다.'); location.href='welcome';</script>";
            }
          ?>
        </nav>
        <nav class="mdl-navigation mdl-layout--small-screen-only">
          <button id="menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-lower-right">
            <!--?php
              if (!empty($member[0])) {
                echo "<li class=\"mdl-menu__item\">" . $member[3] . " 님</li><li class=\"mdl-menu__item\" onclick=\"location.href='logout.php?page=friends';\">로그아웃</li>";
              } else {
                echo "<li class=\"mdl-menu__item\" onclick=\"location.href='login?page=friends';\">로그인</li>";
              }
            ?-->
          </ul>
        </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">세종대학교</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="admin_main.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i> 시스템 설정</a>
        <a class="mdl-navigation__link" href="admin_notice.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">announcement</i> 공지사항</a>
        <a class="mdl-navigation__link" href="admin_total.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> 전체 학생 조회</a>
        <a class="mdl-navigation__link" href="admin_detail.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> 상세 학생 조회</a>
        <a class="mdl-navigation__link" href="admin_expectedgraduate.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> 졸업예정자 조회</a>
        <a class="mdl-navigation__link" href="admin_graduate.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> 졸업가능자 조회</a>
         <!--a class="mdl-navigation__link" href="reports"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">school</i> <span class="mdl-badge" data-badge="0">성적 조회</span></a>
        <a class="mdl-navigation__link" href="archive"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">archive</i> 시험 아카이브</a>
        <a class="mdl-navigation__link" href="friends"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">contacts</i> 소속 친구</a-->
      </nav>
    </div>
    <main class="mdl-layout__content">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop">
          <div class="mdl-list mdl-shadow--2dp mdl-color--white">
            <div class="mdl-list__item">
              <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-avatar">person</i>
                <span><strong>
                  상세 학생 조회
                </strong><!--?php echo $member[3] . " (" . $member[2] . ")"; ?--></span>
              </span>
              <!--span class="mdl-list__item-secondary-content">
                  <span class="mdl-list__item-secondary-info">
                    <span><strong>
                      <?php
                      echo "영어인증: ";
                      if($englishScore>=800){
                        echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                      }
                      else{
                        echo $englishScore ."/800";
                      }
                      ?></strong>
                    </span>
                  </span-->
              </span>
            </div>
            <!--?php
              if ($result) {
                while ($result_each = mysqli_fetch_assoc($result)) {

                  echo "<div class=\"mdl-list__item\">";
                  echo "<span class=\"mdl-list__item-primary-content\">";
                  echo "<i class=\"material-icons mdl-list__item-avatar\">person</i>";
                  echo "<span>" . $result_each["name"] . " (" . $result_each["id"] . ")</span>";
                  echo "</span>";
                  echo "<a class=\"mdl-list__item-secondary-action\" href=\"#!\"><i class=\"material-icons\">email</i></a>";
                  echo "</div>";
                }
              }
              mysqli_close($connect);
            ?-->

        <!-- Simple Textfield -->
<form action="#">
<div class="mdl-textfield mdl-js-textfield">
  <input class="mdl-textfield__input" type="text" id="sample1">
  <label class="mdl-textfield__label" for="sample1">Text...</label>
</div><!-- Colored raised button -->
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
onclick="SearchStudent();return false;">
  Button
</button>
</form>
        <?php
            if(!isset($_GET['id'])){
              //학생정보 없음
            }
            else{
              $studentID = $_GET['id'];
            }
            echo "학번:. $studentID";
            $query = "SELECT * FROM member WHERE studentId = '$studentID'";
            $result1 = mysqli_query($connect, $query);

            $member = mysqli_fetch_assoc($result1);

            //졸업 이수
            $query_mysql="SELECT * FROM graduation WHERE major = ".$member['major']."";
            $result = mysqli_query($connect, $query_mysql);
            if (mysqli_num_rows($result) != 1) {
              echo "Error";
            }

            $result_each = mysqli_fetch_assoc($result);
            $majorSearchStudentTotal = $result_each["majorEs"] + $result_each["majorSe"];

            $query_subject_1_1 = "SELECT * FROM subject WHERE adYear = ".$member['adYear']." and majorId = ".$member['majorId']." and year = '1' and semester = '1' ";
            $result_subject[0][0] = mysqli_query($connect, $query_subject_1_1);
            $num[0] = mysqli_num_rows($result_subject[0][0]);
            $query_subject_1_2 = "SELECT * FROM subject WHERE adYear = ".$member['adYear']." and majorId = ".$member['majorId']." and year = '1' and semester = '2' ";
            $result_subject[0][1] = mysqli_query($connect, $query_subject_1_2);
            $num[1] = mysqli_num_rows($result_subject[0][1]);
            $query_subject_2_1 = "SELECT * FROM subject WHERE adYear = ".$member['adYear']." and majorId = ".$member['majorId']." and year = '2' and semester = '1' ";
            $result_subject[1][0] = mysqli_query($connect, $query_subject_2_1);
            $num[2] = mysqli_num_rows($result_subject[1][0]);
            $query_subject_2_2 = "SELECT * FROM subject WHERE adYear = ".$member['adYear']." and majorId = ".$member['majorId']." and year = '2' and semester = '2' ";
            $result_subject[1][1] = mysqli_query($connect, $query_subject_2_2);
            $num[3] = mysqli_num_rows($result_subject[1][1]);
            $query_subject_3_1 = "SELECT * FROM subject WHERE adYear = ".$member['adYear']." and majorId = ".$member['majorId']." and year = '3' and semester = '1' ";
            $result_subject[2][0] = mysqli_query($connect, $query_subject_3_1);
            $num[4] = mysqli_num_rows($result_subject[2][0]);
            $query_subject_3_2 = "SELECT * FROM subject WHERE adYear = ".$member['adYear']." and majorId = ".$member['majorId']." and year = '3' and semester = '2' ";
            $result_subject[2][1] = mysqli_query($connect, $query_subject_3_2);
            $num[5] = mysqli_num_rows($result_subject[2][1]);
            $query_subject_4_1 = "SELECT * FROM subject WHERE adYear = ".$member['adYear']." and majorId = ".$member['majorId']." and year = '4' and semester = '1' ";
            $result_subject[3][0] = mysqli_query($connect, $query_subject_4_1);
            $num[6] = mysqli_num_rows($result_subject[3][0]);
            $query_subject_4_2 = "SELECT * FROM subject WHERE adYear = ".$member['adYear']." and majorId = ".$member['majorId']." and year = '4' and semester = '2' ";
            $result_subject[3][1] = mysqli_query($connect, $query_subject_4_2);
            $num[7] = mysqli_num_rows($result_subject[3][1]);

            $val_total = max($num);

            $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = ".$member['studentId']." and subject.adYear = ".$member['adYear']." ";
            $result3 = mysqli_query($connect, $query_mysql3);
            $mySubjectTotal = mysqli_num_rows($result3);
            //중핵 필수
            $coreEs = 0;
            $coreSe = 0; //중핵 선택
            $majorBasic = 0; //기초 교양
            $majorTotal = 0 ; // 전공
            $majorEs = 0; //전공 필수
            $majorSe = 0;// 전공 선택
            $gradTotal = 0; // 총이수 학점

            for($i = 0; $i < $mySubjectTotal; $i++){
              $result_each3 = mysqli_fetch_assoc($result3);
              $mySubjectId[$i] = $result_each3["subKey"];

              if($result_each3["field"] == 1 ) { //중핵 필수
                $coreEs += $result_each3["credit"];
                $gradTotal += $result_each3["credit"];
              } else if($result_each3["field"] == 2) { //중핵 선택
                $coreSe += $result_each3["credit"];
                $gradTotal += $result_each3["credit"];
              } else if($result_each3["field"] == 3){ //기초 교양
                $majorBasic += $result_each3["credit"];
                $gradTotal += $result_each3["credit"];
              } else if($result_each3["field"] == 4){ //전공 필수
                $majorEs += $result_each3["credit"];
                $gradTotal += $result_each3["credit"];
              } else if($result_each3["field"] == 5){ //전공 선택
                $majorSe += $result_each3["credit"];
                $gradTotal += $result_each3["credit"];
              }
            }

            $majorEs2 = $majorEs;

            if($majorEs >= $result_each["majorEs"]) {
              $tmp = $majorEs - $result_each["majorEs"];
              $majorEs2 = $majorEs - $tmp;
              $majorSe += $tmp;
            }

            $majorTotal = $majorEs + $majorSe;

            $query_mysql2 = "SELECT * FROM englishAuth WHERE studentId = ".$member['studentId']." ";
            $result2 = mysqli_query($connect, $query_mysql2);

            if(mysqli_num_rows($result2) != 1) {
              echo "english Auth Error";
            }

            $result_each2 = mysqli_fetch_assoc($result2);
            $englishScore = $result_each2["score"];
            $English = "None pass";

            if($result_each2["score"]>800) {
              $English = "Pass";
            }

          $query_mysql2 ="SELECT * FROM bookAuth WHERE studentId = ".$member['studentId']." ";
          $result2 = mysqli_query($connect, $query_mysql2);

          if (mysqli_num_rows($result2) != 1) {
            echo "bookAuth Error";
          }
            $result_each2 = mysqli_fetch_assoc($result2);
            $Books = "None pass";
            if($result_each2["west"]>5 && $result_each2["east"]>5 &&$result_each2["east_west"]>5 &&$result_each2["science"]>5  ){
              $Books = "Pass";
            }
        ?>
          </div>
        </div>

        <!-- Expandable Textfield -->
        <!--?php
            $stId;
            echo "<form action=\"#\">";
            echo "<div class=\"mdl-textfield mdl-js-textfield mdl-textfield--expandable\">";
            echo "<label class=\"mdl-button mdl-js-button mdl-button--icon\" for=\"sample6\">";
            echo "<i class=\"material-icons\">search</i>";
            echo "</label>";
            echo "<div class=\"mdl-textfield__expandable-holder\">";
                echo "<input class=\"mdl-textfield__input\" type=\"text\" id=\"sample6\">";
                echo "<label class=\"mdl-textfield__label\" for=\"sample-expandable\">Expandable Input</label>";
                echo "</div>";
            echo "</div>";
            $stId =
        ?-->
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--unselectable mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop">
                <thead>
                <tr>
                    <th style="text-align: center;">전 공</th>
                    <th style="text-align: center;">중핵<br>필수</th>
                    <th style="text-align: center;">중핵<br>선택</th>
                    <th style="text-align: center;">전공<br>기초</th>
                    <th style="text-align: center;">전공<br>필수</th>
                    <th style="text-align: center;">전공<br>선택</th>
                    <th style="text-align: center;">졸업<br>학점</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                        <td style="text-align: center;"><?php
                        $query_mysql="SELECT * FROM graduation WHERE major = 컴퓨터공학과 ";
                        echo $query_mysql;
                        $result = mysqli_query($connect, $query_mysql);
                        echo mysqli_num_rows($result);
                        if (mysqli_num_rows($result) != 1) {
                          echo "Error";
                          echo mysqli_num_rows($result);
                          echo "end";
                        }

                      $result_each = mysqli_fetch_assoc($result);
                        echo $result_each["major"]; ?></td>
                        <td style="text-align: center;"><?php echo $result_each["coreEs"]; ?></td>
                        <td style="text-align: center;"><?php echo $result_each["coreSe"]; ?></td>
                        <td style="text-align: center;"><?php echo $result_each["majorBasic"]; ?></td>
                        <td style="text-align: center;"><?php echo $result_each["majorEs"]; ?></td>
                        <td style="text-align: center;"><?php echo $result_each["majorSe"]; ?></td>
                        <td style="text-align: center;"><?php echo $result_each["gradTotal"]; ?></td>
                  </tr>
                  <tr>
                        <td style="text-align: center;">이수 학점</td>
                        <td style="text-align: center; font-size: 130%; font-weight: bold;"><?php echo $coreEs; ?></td>
                        <td style="text-align: center; font-size: 130%; font-weight: bold;"><?php echo $coreSe; ?></td>
                        <td style="text-align: center; font-size: 130%; font-weight: bold;"><?php echo $majorBasic; ?></td>
                        <td style="text-align: center; font-size: 130%; font-weight: bold;"><?php echo $majorEs2; ?></td>
                        <td style="text-align: center; font-size: 130%; font-weight: bold;"><?php echo $majorSe; ?></td>
                        <td style="text-align: center; font-size: 130%; font-weight: bold;"><?php echo $gradTotal; ?></td>
                  </tr>
                  <?php
                  $mycoreEs = $result_each["coreEs"] - $coreEs;
                  $mycoreSe = $result_each["coreSe"] - $coreSe;
                  $mymajorBasic = $result_each["majorBasic"] - $majorBasic;
                  $mymajorEs = $result_each["majorEs"] - $majorEs2;
                  $mymajorSe = $result_each["majorSe"] - $majorSe;
                  $mygradTotal = $result_each["gradTotal"] -$gradTotal;
                  ?>
                  <tr>
                  <td style="text-align: center;">필요 학점</td>
                  <td style="text-align: center;"><?php
                    if($mycoreEs<=0) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                    else echo $mycoreEs; ?>
                  </td>
                  <td style="text-align: center;"><?php
                    if($mycoreSe<=0) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                    else echo $mycoreSe; ?>
                  </td>
                  <td style="text-align: center;"><?php
                    if($mymajorBasic<=0) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                    else echo $mymajorBasic; ?>
                  </td>
                  <td style="text-align: center;"><?php
                    if($mymajorEs<=0) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                    else echo $mymajorEs; ?>
                  </td>
                  <td style="text-align: center;"><?php
                    if($mymajorSe<=0) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                    else echo $mymajorSe; ?>
                  </td>
                  <td style="text-align: center;"><?php
                    if($mygradTotal<=0) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                    else echo $mygradTotal; ?>
                  </td>
            </tr>
                </tbody>
        </table>
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--unselectable mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
          <thead>
            <tr>
              <th style="text-align: center;">독서 인증 현황</th>
                <th style="text-align: center;">서양</th>
                <th style="text-align: center;">동양</th>
                <th style="text-align: center;">동서양</th>
                <th style="text-align: center;">과학</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td style="text-align: center;">나의 독서 인증</td>
                <td style="text-align: center;"><?php
                      if($result_each2["west"]>=4) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                      else echo $result_each2["west"]; ?>
                    </td>
                    <td style="text-align: center;"><?php
                      if($result_each2["east"]>=2) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                      else echo $result_each2["east"]; ?>
                    </td>
                    <td style="text-align: center;"><?php
                      if($result_each2["east_west"]>=3) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                      else echo $result_each2["east_west"]; ?>
                    </td>
                      <td style="text-align: center;"><?php
                      if($result_each2["science"]>=1) echo "<i class=\"material-icons style=\"font-size: 10px\">done</i>";
                      else echo $result_each2["science"]; ?>
                    </td>
              </tr>
          </tbody>
        </table>
        <div class="cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop mdl-shadow--2dp mdl-color--white">
        <table style="font-size: 90%;" class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">1-1</th>
      <th scope="col">1-2</th>
      <th scope="col">2-1</th>
      <th scope="col">2-2</th>
      <th scope="col">3-1</th>
      <th scope="col">3-2</th>
      <th scope="col">4-1</th>
      <th scope="col">4-2</th>
    </tr>
  </thead>
  <tbody>
    <?php
      for($i = 0; $i < $val_total; $i++) {
        echo "<tr>";
        for($j = 0; $j < 8; $j++) {
          if (!($result_each = mysqli_fetch_assoc($result_subject[($j/2)%4][$j%2]))) {
            echo "<td></td>";
            continue;
          }
          $isCheck = 0;

          for($p = 0; $p < $mySubjectTotal ; $p++) {
            if($mySubjectId[$p] == $result_each["subKey"]) {
              $isCheck = 1;
            }
          }

          if($isCheck != 0) {
            echo "<td bgcolor=\"darkgrey\">";
          } else {
            echo "<td>";
          }

          if($result_each["field"] == 1){
            echo "<font color=\"red\" style=\"font-weight: bold;\" >";
          }else if($result_each["field"] == 2){
            echo "<font color=\"orange\" style=\"font-weight: bold;\" >";
          }else if($result_each["field"] == 3){
            echo "<font color=\"green\" style=\"font-weight: bold;\" >";
          }else if($result_each["field"] == 4){
            echo "<font color=\"blue\" style=\"font-weight: bold;\" >";
          }else if($result_each["field"] == 5){
            echo "<font color=\"purple\" style=\"font-weight: bold;\" >";
          }

          if($result_each != null){
            echo $result_each["subName"];
          } else{
            echo " ";
          }
          echo "</font>";
          echo "</td>";
        }
        echo "</tr>";
      }
    ?>

  </tbody>
</table>
<p style="text-align: center;"><font color="red" style="font-weight: bold;">중핵 필수</font> | <font color="orange" style="font-weight: bold;">중핵 선택</font> | <font color="green" style="font-weight: bold;">전공 기초</font> | <font color="blue" style="font-weight: bold;">전공 필수</font> | <font color="purple" style="font-weight: bold;">전공 선택</font></p>
</div>
        <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
          <strong>Copyright ⓒ 2017 세종대학교 컴퓨터공학과. All rights reserved.</strong>
          <br>이 시스템은 개발 중이므로, 정상 동작을 보장하지 않습니다.
        </div>
      </div>

    </main>
  </div>
  <script type="text/javascript">
  function SearchStudent(){
    var c = document.getElementById("sample1").value;
    var address = 'admin_detail.php?id='+c;

    goReplace(address);
  }
  function goReplace(str) { location.replace(str); }
  </script>
</body>
</html>
