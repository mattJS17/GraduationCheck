<?php
  session_start();
  $member = $_SESSION['session_auth_member'];
  echo "<meta charset=\"utf-8\">";

  $connect = mysqli_connect('localhost', 'root', 'applemac', 'macDB');

  if (!$connect) {
    die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
  }

  mysqli_select_db($connect, "macDB");

  $query_mysql="SELECT * FROM graduation ORDER BY major asc, adYear asc";
  $result = mysqli_query($connect, $query_mysql);
  $totalGraduation = mysqli_num_rows($result);
 ?>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
  <meta name="description" content="해커톤">
  <meta name="author" content="해커톤">
  <title>세종대학교 졸업이수확인시스템</title>

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
                    시스템 설정
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
                  </span>
              </span-->
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
          </div>
        </div>
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--unselectable mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop">
                <thead>
                <tr>
                    <th style="text-align: center;">전 공</th>
                    <th style="text-align: center;">학 년</th>
                    <th style="text-align: center;">중핵<br>필수</th>
                    <th style="text-align: center;">중핵<br>선택</th>
                    <th style="text-align: center;">전공<br>기초</th>
                    <th style="text-align: center;">전공<br>필수</th>
                    <th style="text-align: center;">전공<br>선택</th>
                    <th style="text-align: center;">졸업<br>학점</th>
                    <th style="text-align: center;">데이터 변경</style>
                  </tr>
                </thead>
                <tbody>
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
                    <?php
                      for($i = 0; $i < $totalGraduation; $i++){
                        $result_each = mysqli_fetch_assoc($result);
                        $major = $result_each["gradKey"];
                        echo "<tr id=" . $major . ">";
                        echo "<td style = \"text-align: center;\">" . $result_each["major"] . "</td>";
                        echo "<td style = \"text-align: center;\">" . $result_each["adYear"] . "</td>";
                        echo "<td style = \"text-align: center;\">";
                        echo "<input text id=\"coreEs" . $major . "\" size = \"2\" value = " . $result_each["coreEs"];
                        echo "></td>";
                        echo "<td style = \"text-align: center;\">";
                        echo "<input text id=\"coreSe" . $major . "\" size = \"2\" value = " . $result_each["coreSe"];
                        echo "></td>";
                        echo "<td style = \"text-align: center;\">";
                        echo "<input text id=\"majorBasic" . $major . "\" size = \"2\" value = " . $result_each["majorBasic"];
                        echo "></td>";
                        echo "<td style = \"text-align: center;\">";
                        echo "<input text id=\"majorEs" . $major . "\" size = \"2\" value = " . $result_each["majorEs"];
                        echo "></td>";
                        echo "<td style = \"text-align: center;\">";
                        echo "<input text id=\"majorSe" . $major . "\" size = \"2\" value = " . $result_each["majorSe"];
                        echo "></td>";
                        echo "<td style = \"text-align: center;\">";
                        echo "<input text id=\"gradTotal" . $major."\" size = \"3\" value =" . $result_each["gradTotal"];
                        echo "><td style = \"text-align: center;\">";
                        echo "<button id=\"button_" . $major . "\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-button--colored\" ";
                        echo "onclick = \"setValue(" . $major . "); return false;\"/>적용하기";
                        echo "</tr>";
                      }

                    ?>
                </tbody>
        </table>
        <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
          <strong>Copyright ⓒ 2017 세종대학교 컴퓨터공학과. All rights reserved.</strong>
          <br>이 시스템은 개발 중이므로, 정상 동작을 보장하지 않습니다.
        </div>
      </div>
    </main>
  </div>
  <script>
    function setValue(no) {
      var coreEs = document.getElementById("coreEs" + no).value;
      var coreSe = document.getElementById("coreSe" + no).value;
      var majorBasic = document.getElementById("majorBasic" + no).value;
      var majorEs = document.getElementById("majorEs" + no).value;
      var majorSe = document.getElementById("majorSe" + no).value;
      var gradTotal = document.getElementById("gradTotal" + no).value;

      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.onreadystatechange = function() {

        document.getElementById("coreEs" + no).readOnly = true;
        document.getElementById("coreSe" + no).readOnly = true;
        document.getElementById("majorBasic" + no).readOnly = true;
        document.getElementById("majorEs" + no).readOnly = true;
        document.getElementById("majorSe" + no).readOnly = true;
        document.getElementById("gradTotal" + no).readOnly = true;
        document.getElementById("button_" + no).disabled = true;
        document.getElementById("button_" + no).style.visibility = false;

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          result = xmlhttp.responseText;

          if (result == "Ok") {
            alert("성공적으로 수정하였습니다.");
          } else {
            alert(result);
          }

          document.getElementById("coreEs" + no).readOnly = false;
          document.getElementById("coreSe" + no).readOnly = false;
          document.getElementById("majorBasic" + no).readOnly = false;
          document.getElementById("majorEs" + no).readOnly = false;
          document.getElementById("majorSe" + no).readOnly = false;
          document.getElementById("gradTotal" + no).readOnly = false;
          document.getElementById("button_" + no).disabled = false;
          document.getElementById("button_" + no).style.visibility = true;
        }
      }
      xmlhttp.open("POST", "sql_insert.php", true);
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xmlhttp.send('coreEs='+encodeURIComponent(coreEs)+'&coreSe='+encodeURIComponent(coreSe)+'&majorBasic='+encodeURIComponent(majorBasic)+'&majorEs='+encodeURIComponent(majorEs)+'&majorSe='+encodeURIComponent(majorSe)+'&gradTotal='+encodeURIComponent(gradTotal)+'&gradKey='+encodeURIComponent(no));
    }
  </script>
</body>
</html>
