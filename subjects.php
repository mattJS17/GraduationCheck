<?php
 session_start();
 $member = $_SESSION['session_auth_member'];
 echo "<meta charset=\"utf-8\">";

 $connect = mysqli_connect('localhost','root','applemac','macDB');
 if (!$connect) {
   die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
 }

mysqli_select_db($connect, "macDB");
$query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY field asc, year asc, semester asc ";

$sort = $_GET['sort'];
$asc = $_GET['asc'];

  switch($sort){
    case 1:
      if($asc==1){
        $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY field asc, year asc, semester asc ";
      }else{
        $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY field desc, year asc, semester asc ";
      }
    break;
    case 2:
    if($asc==1){
      $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY subName asc, year asc, semester asc ";
    }else{
      $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY subName desc, year asc, semester asc ";
    }
    break;
    case 3:
    if($asc==1){
      $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY year asc, semester asc, field asc ";
    }else{
      $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY year desc, semester asc, field asc ";
    }
    break;
    case 4:
    if($asc==1){
      $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY semester asc, year asc, field asc ";
    }else{
      $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY semester desc, year asc, field asc ";
    }
    break;
    case 5:
    if($asc==1){
      $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY credit asc, year asc, semester asc ";
    }else{
      $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY credit desc, year asc, semester asc ";
    }
    break;
    default :
    $query_mysql3="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY year asc, semester asc, credit asc ";

    break;
  }
  $result3 = mysqli_query($connect, $query_mysql3);

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
                 <span><strong>나의 이수 현황</strong> :<!--?php echo $member[3] . " (" . $member[2] . ")"; ?--></span>
               </span>
               <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons"></i></a>
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

         <table class="mdl-data-table mdl-js-data-table mdl-data-table--unselectable mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
                 <thead>
                 <tr>
                   <?php
                    if($asc==1){
                      $asc = 2;
                    }else{
                      $asc = 1;
                    }
                   ?>
                     <th style="text-align: center;">전 공</th>
                     <th style="text-align: center;" onclick="location.href='subjects.php?sort=1&asc=<?php echo $asc; ?>' ">이수 구분</th>
                     <th style="text-align: center;" onclick="location.href='subjects.php?sort=2&asc=<?php echo $asc; ?>' ">수업 이름</th>
                     <th style="text-align: center;" onclick="location.href='subjects.php?sort=3&asc=<?php echo $asc; ?>' ">학년</th>
                     <th style="text-align: center;" onclick="location.href='subjects.php?sort=4&asc=<?php echo $asc; ?>' ">학기</th>
                     <th style="text-align: center;" onclick="location.href='subjects.php?sort=5&asc=<?php echo $asc; ?>' ">전공 학점</th>
                   </tr>
                 </thead>
                 <tbody>
                     <?php
                     for($i=0; $i < mysqli_num_rows($result3); $i++ ){
                       $result_each3 = mysqli_fetch_assoc($result3);
                       echo " <tr> <td style=\"text-align: center;\"> ";

                          echo $member[3] ;

                        echo "</td>";
                        if($result_each3["field"]==1){
                          echo "<td style=\"text-align: center;\">중핵 필수</td>";
                        }else if($result_each3["field"]==2){
                          echo "<td style=\"text-align: center;\">중핵 선택</td>";
                        }else if($result_each3["field"]==3){
                          echo "<td style=\"text-align: center;\">기초 교양</td>";
                        }else if($result_each3["field"]==4){
                          echo "<td style=\"text-align: center;\">전공 필수</td>";
                        }else if($result_each3["field"]==5){
                          echo "<td style=\"text-align: center;\">전공 선택</td>";
                        }
                        echo "<td style=\"text-align: center;\">".$result_each3["subName"]."</td>";
                        echo "<td style=\"text-align: center;\">".$result_each3["year"]."</td>";
                        echo "<td style=\"text-align: center;\">".$result_each3["semester"]."</td>";
                        echo "<td style=\"text-align: center;\">".$result_each3["credit"]."</td>";
                          echo "</tr>";
                     }?>

                 </tbody>
         </table>


         <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
           <strong>Copyright ⓒ 2017 세종대학교 컴퓨터공학과. All rights reserved.</strong>
           <br>이 시스템은 개발 중이므로, 정상 동작을 보장하지 않습니다.
         </div>
       </div>

     </main>
   </div>
 </body>
 </html>
