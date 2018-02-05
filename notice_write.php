<?php
  session_start();
  $member = $_SESSION['session_auth_member'];
  echo "<meta charset=\"utf-8\">";

  $connect = mysqli_connect('localhost', 'root', 'applemac', 'macDB');

  if (!$connect) {
    die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
  }

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
                <span><strong>새글 쓰기</strong><!--?php echo $member[3] . " (" . $member[2] . ")"; ?--></span>
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
      <div class="cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop">
        <form name = "write_form" action="notice_query.php" method="post" enctype="multipart/form-data">
          <input type = "hidden" name = "query" value = "write">
          <br>
          <div>
            <label>제목</label>
            <div>
              <input type = "text" name = "input_title" class="form-control">
            </div>
          </div>
          <br>
          <div>
            <label>내용</label>
            <div>
              <textarea name="ir1" id="ir1" rows="10" cols="100" style="width:100%; height:412px; display:none;"></textarea>
            </div>
          </div>
          <br>
          <div>
            <label>첨부</label>
            <div>
              <input type = "file" name = "upload_file">
            </div>
          </div>
          <div>
            <div style="text-align: right;">
              <input type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="submitContents(this);" value="등록">
              <button type="button" onclick="window.location='admin_notice.php';" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">취소</button>
            </div>
          </div>
        </form>
      </div>
      <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
        <strong>Copyright ⓒ 2017 세종대학교 컴퓨터공학과. All rights reserved.</strong>
        <br>이 시스템은 개발 중이므로, 정상 동작을 보장하지 않습니다.
      </div>
    </div>
  </main>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- SmartEditor -->
  <script type="text/javascript" src="/SE2/js/HuskyEZCreator.js" charset="utf-8"></script>
  <script type="text/javascript">
    var oEditors = [];

    // 추가 글꼴 목록
    //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

    nhn.husky.EZCreator.createInIFrame({
      oAppRef: oEditors,
      elPlaceHolder: "ir1",
      sSkinURI: "SE2/SmartEditor2Skin.html",
      htParams : {
        bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
        bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
        bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
        //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
        fOnBeforeUnload : function(){
          //alert("완료!");
        }
      }, //boolean
      fOnAppLoad : function(){
        //예제 코드
        //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
      },
      fCreator: "createSEditor2"
    });

    function submitContents(elClickedObj) {
      oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

      // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

      try {
        elClickedObj.form.submit();
      } catch(e) {}
    }
  </script>
</body>
</html>
