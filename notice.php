<?php
    session_start();
    $member = $_SESSION['session_auth_member'];

    $connect = mysqli_connect('localhost', 'root', 'applemac', 'macDB');

    if (!$connect) {
      die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
    }


/*
  while($row = mysqli_fetch_array($result)){
    echo $row['noticeKey'] . ' ' . $row['title']. '<br>';
  }

  for($page=1; $page<=$number_of_page; $page++){
    echo "<a herf=\"notice.php?page=".$page.">".$page." </a>";
  }*/
?>
<!DOCTYPE html>
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
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/dialog-polyfill/0.4.2/dialog-polyfill.min.css'>
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

    .mdl-dialog {
  border: none;
  box-shadow: 0 9px 46px 8px rgba(0, 0, 0, 0.14), 0 11px 15px -7px rgba(0, 0, 0, 0.12), 0 24px 38px 3px rgba(0, 0, 0, 0.2);
  width: 400px; }
  .mdl-dialog__title {
    padding: 24px 24px 0;
    margin: 0;
    font-size: 2.5rem; }
  .mdl-dialog__actions {
    padding: 8px 8px 8px 24px;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: row-reverse;
        -ms-flex-direction: row-reverse;
            flex-direction: row-reverse;
    -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
            flex-wrap: wrap; }
    .mdl-dialog__actions > * {
      margin-right: 8px;
      height: 36px; }
      .mdl-dialog__actions > *:first-child {
        margin-right: 0; }
    .mdl-dialog__actions--full-width {
      padding: 0 0 8px 0; }
      .mdl-dialog__actions--full-width > * {
        height: 48px;
        -webkit-flex: 0 0 100%;
            -ms-flex: 0 0 100%;
                flex: 0 0 100%;
        padding-right: 16px;
        margin-right: 0;
        text-align: right; }
  .mdl-dialog__content {
    padding: 20px 24px 24px 24px;
    color: rgba(0,0,0, 0.54); }
    .pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
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
        <a class="mdl-navigation__link" href="main.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i> 졸업요건</a>
        <a class="mdl-navigation__link" href="engauth.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">build</i> 공학인증 요건</a>

        <a class="mdl-navigation__link" href="notice.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">announcement</i> 공지사항</a>
        <a class="mdl-navigation__link" href="document.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> 수강편람</a>
        <a class="mdl-navigation__link" href="simulation.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i> 시뮬레이션</a>
        <a class="mdl-navigation__link" href="subjects.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">list</i> 이수 현황</a>
        <a class="mdl-navigation__link" href="excel.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">get_app</i> 엑셀로 저장</a>
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
                  <?php
                    echo "졸업 이수에 관한 공지사항";
                  ?>
                </strong><!--?php echo $member[3] . " (" . $member[2] . ")"; ?--></span>
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
          </div>
        </div>
          <table class="mdl-data-table mdl-js-data-table mdl-data-table--unselectable mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop">
            <thead>
              <tr>
                <th style='text-align: center;'>번호</th>
                <th style='text-align: center;'>제목</th>
                <th style='text-align: center;'>작성자</th>
                <th style='text-align: center;'>등록일</th>
              </tr>
            </thead>
            <tbody>
              <?php

              mysqli_select_db($connect, "macDB");
              //pagination

                $result_per_page = 10;
                $sql = "SELECT * FROM notice";
                $result = mysqli_query($connect,  $sql);
                $number_of_notice = mysqli_num_rows($result);



                $number_of_page = ceil($number_of_notice/$result_per_page);

                if(!isset($_GET['page'])){
                  $page = 1;
                }else{
                  $page = $_GET['page'];
                }

                $this_page_first_result = ($page-1)*$result_per_page;
                $sql = "SELECT * FROM notice ORDER BY noticeKey desc LIMIT ". $this_page_first_result . "," . $result_per_page ;

                $result = mysqli_query($connect, $sql);

              while($result_each = mysqli_fetch_array($result)){
                echo "<tr><td style='text-align: center;'>" . $result_each["noticeKey"] . "</td><td style='text-align: left;'><a data-toggle=\"modal\" href=\"#modal\" onclick=\"ajax_notice_content(" . $result_each["noticeKey"] . ");\">" . $result_each["title"] . "</a></td><td style='text-align: center;'>관리자</td><td style='text-align: center;'>" . $result_each["date"] . "</td></tr>";

              }



              /*  $query_mysql="SELECT noticeKey, title, date  FROM notice  ORDER BY noticeKey DESC";


                if ($result = mysqli_query($connect, $query_mysql)) {

                  while ($result_each = mysqli_fetch_assoc($result)) {

                   echo "<tr><td style='text-align: center;'>" . $result_each["noticeKey"] . "</td><td style='text-align: center;'><a data-toggle=\"modal\" href=\"#modal\" onclick=\"ajax_notice_content(" . $result_each["noticeKey"] . ");\">" . $result_each["title"] . "</a></td><td style='text-align: center;'>라떼쉬폰</td><td style='text-align: center;'>" . $result_each["date"] . "</td></tr>";
                  }
                  if (mysqli_num_rows($result) == 0) {
                      echo "<tr><td style='text-align: center;'>-</td><td style='text-align: center;'>등록된 공지사항이 없습니다.</td><td style='text-align: center;'>-</td><td style='text-align: center;'>-</td><td style='text-align: center;'>-</td></tr>";
                  }
                }

                mysqli_close($connect);*/
              ?>
            </tbody>



          </table>

          <table class="mdl-data-table mdl-js-data-table mdl-data-table--unselectable mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
          <tr>
            <td>
        <?php
        $pagination = 8;

        if($page<$pagination/2){
          $i = 1;
          if($pagination <= $number_of_page){
            $total = $pagination;
          }else{
            $total = $number_of_page;
          }
        }else{
          $i = $page-($pagination/2) +1;
          if($page+($pagination/2) <= $number_of_page){
            $total = $page+($pagination/2);
          }else{
            $total = $number_of_page;
          }
        }

        echo "<div class = \"pagination\">";
        for(; $i<= $total; $i++){
          echo "<a href=\"notice.php?page=".$i."\">".$i." </a>";
        }
        echo "</div>";
         ?>
         </td>
        </tr>
        </table>
         <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop">

         <form name = "search_form" method = "post" action = "#" enctype="multipart/form-data">
           <table align="center">
             <tr>
               <td>
                 <input type = "hidden" name = "query" value = "search">
                 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input class="mdl-textfield__input" type="text" name = "search" id="search">
                   <label class="mdl-textfield__label" for="search">검색어를 입력하세요.</label>
                 </div>
               </td>
               <td>
                 <input type = "submit" name = "ok" value = "검색" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
               </td>
               <?php
                 if ($member[7] == 1) {
                   echo "<td><button type=\"button\" onclick=\"window.location='notice_write.php';\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-button--colored\">등록</button></td>";

                 }
               ?>
             </tr>
           </table>
         </form>

        </div>
        <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
          <strong>Copyright ⓒ 2017 세종대학교 컴퓨터공학과. All rights reserved.</strong>
          <br>이 시스템은 개발 중이므로, 정상 동작을 보장하지 않습니다.
        </div>
      </div>
    </main>
  </div>
  <dialog id="dialog" class="mdl-dialog">
  <h3 class="mdl-dialog__title" id="notice_title"> </h3>
  <div class="mdl-dialog__content" id="notice_content">

  </div>
  <div class="mdl-dialog__actions">
    <button type="button" class="mdl-button">닫기</button>
  </div>
  </dialog>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/dialog-polyfill/0.4.2/dialog-polyfill.min.js'></script>
  <script src='https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js'></script>

  <script>
    $(document).ready(function(){
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        alert("세종대학교 졸업이수확인시스템이 이 브라우저에서의 동작을 정상적으로 지원하지 않습니다.\\n브라우저를 최신 버전으로 업데이트하시거나, 다른 브라우저를 이용하여 주십시오.");
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
    });

    function ajax_notice_content(no) {
      dialog.showModal();

      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("notice_content").innerHTML = xmlhttp.responseText;
        } else {
          document.getElementById("notice_content").innerHTML = "<p style=\"font-size: 150%; font-weight: bold; text-align: center;\">글을 가져오고 있습니다.<br>잠시만 기다려 주십시오.</p>";
        }
      }
      xmlhttp.open("POST","ajax_notice_content.php",true);
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xmlhttp.send('no='+encodeURIComponent(no));
    }
  </script>

  <script>
      (function() {
    'use strict';
    var dialog = document.querySelector('#dialog');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
    dialog.querySelector('button:not([disabled])')
    .addEventListener('click', function() {
      dialog.close();
    });
  }());
  //# sourceURL=pen.js
  </script>
</body>
</html>
