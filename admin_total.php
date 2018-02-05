<?php
 session_start();
 $member = $_SESSION['session_auth_member'];
 echo "<meta charset=\"utf-8\">";

 $connect = mysqli_connect('localhost','root','applemac','macDB');
 if (!$connect) {
   die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
 }

mysqli_select_db($connect, "macDB");

$query_mysql3="SELECT *  FROM member, bookAuth, englishAuth
WHERE member.studentId = bookAuth.studentId and member.studentId = englishAuth.studentId";
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
         <a class="mdl-navigation__link" href="admin_main.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i> 시스템 설정</a>
         <a class="mdl-navigation__link" href="admin_notice.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">announcement</i> 공지사항</a>
         <a class="mdl-navigation__link" href="admin_total.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> 전체 학생 조회</a>
         <a class="mdl-navigation__link" href="admin_detail.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> 상세 학생 조회</a>
         <a class="mdl-navigation__link" href="admin_expectedgraduate.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> 졸업예정자 조회</a>
         <a class="mdl-navigation__link" href="admin_graduate.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> 졸업가능자 조회</a>
        <!--a class="mdl-navigation__link" href="simulation.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i> 시뮬레이션</a>
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
                 <span><strong>전체 학생 조회</strong><!--?php echo $member[3] . " (" . $member[2] . ")"; ?--></span>
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
                     <th style="text-align: center;">학번</th>
                     <th style="text-align: center;">이름</th>
                     <th style="text-align: center;">학년</th>
                     <th style="text-align: center;">학기</th>
                     <th style="text-align: center;">학점<br>이수</th>
                     <th style="text-align: center;" style="text-align: center;">독서<br>인증</th>
                     <th style="text-align: center;">영어<br>인증</th>
                   </tr>
                 </thead>
                 <tbody>
                     <?php

                     $result_per_page = 10;
                     $number_of_notice = mysqli_num_rows($result3);
                     $number_of_page = ceil($number_of_notice/$result_per_page);
                     if(!isset($_GET['page'])){
                       $page = 1;
                     }else{
                       $page = $_GET['page'];
                     }

                     $this_page_first_result = ($page-1)*$result_per_page;
                     $sql = "SELECT * FROM notice LIMIT ". $this_page_first_result . "," . $result_per_page;
                     $result = mysqli_query($connect, $sql);


                     $query_mysql3="SELECT *  FROM member, bookAuth, englishAuth
                     WHERE member.studentId = bookAuth.studentId and member.studentId = englishAuth.studentId
                     LIMIT ".$this_page_first_result.",".$result_per_page;
                     $result3 = mysqli_query($connect, $query_mysql3);

                     for($i=0; $i < mysqli_num_rows($result3); $i++ ){
                       $result_each3 = mysqli_fetch_assoc($result3);
                       echo "<tr onclick=\"SearchStudent(".$i.");return false;\">";
                          echo "<td id=sample".$i." style=\"text-align: center;\">".$result_each3["studentId"]."</td>";
                        echo "<td style=\"text-align: center;\">".$result_each3["name"]."</td>";
                        echo "<td style=\"text-align: center;\">".$result_each3["year"]."</td>";
                        if ($result_each3["semeseter"]%2 == 0)
                          echo "<td style=\"text-align: center;\">"."2"."</td>";
                        else {
                            echo "<td style=\"text-align: center;\">"."1"."</td>";
                        }
                        if ($result_each3["gradFlag"]) {
                          echo "<td style=\"text-align: center;\">"."O"."</td>";
                        }
                        else {
                          echo "<td style=\"text-align: center;\">"."X"."</td>";
                        }
                        if ($result_each3["west"]>3 && $result_each3["east"]>1 && $result_each3["east_west"]>2 && $result_each3["science"]>1)
                        echo "<td style=\"text-align: center;\">"."O"."</td>";
                        else {
                          echo "<td style=\"text-align: center;\">"."X"."</td>";
                        }
                        if ($result_each3["score"]>=800) {
                          echo "<td style=\"text-align: center;\">"."O"."</td>";
                        }
                        else {
                          echo "<td style=\"text-align: center;\">"."X"."</td>";
                        }
                        echo "</tr>";
                     }?>

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
         echo "<a href=\"admin_total.php?page=".$i."\">".$i." </a>";
       }
       echo "</div>";
        ?>
        </td>
       </tr>
       </table>

         <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
           <strong>Copyright ⓒ 2017 세종대학교 컴퓨터공학과. All rights reserved.</strong>
           <br>이 시스템은 개발 중이므로, 정상 동작을 보장하지 않습니다.
         </div>
       </div>
       <script>
       function SearchStudent(key){
         var tmp = 'sample'+key;
         var c = document.getElementById(tmp).innerHTML;
         location.href = 'admin_detail.php?id='+c;
       }
       </script>
     </main>
   </div>
 </body>
 </html>
