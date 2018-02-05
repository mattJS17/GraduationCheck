<?php
  session_start();
  $member = $_SESSION['session_auth_member'];

  $connect = mysqli_connect('localhost','root','applemac','macDB');
  if (!$connect) {
    die('DB Connection is Failed.' . mysqli_error($connect));
  }
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mac Team">
    <title>졸업이수확인시스템</title>

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

      .layout-lattechiffon .mdl-layout__content {
        background: #fafafa;
      }
    </style>
  </head>
  <body>
    <div class="layout-lattechiffon mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">졸업이수확인시스템</span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="mdl-layout-spacer"></div>
          <!-- Navigation -->
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" name="sample" id="fixed-header-drawer-exp">
            </div>
          </div>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">세종대학교</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i> 로그인</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop">
            <h5>서비스를 이용하시려면 로그인이 필요합니다.</h5>
            <form class="mdl-shadow--2dp mdl-color--white" name="login_form" method="post" action="#!" enctype="multipart/form-data" onsubmit="checkLoginForm(); return false;" style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
              <h6 id="form_info">세종대학교 학사정보시스템</h6>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="form_id" id="form_id">
                <label class="mdl-textfield__label" for="form_id">학번</label>
              </div>
              <br>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="password" name="form_password" id="form_password">
                <label class="mdl-textfield__label" for="form_password">비밀번호</label>
              </div>
              <br>
              <input class="mdl-button mdl-js-button mdl-button--raised" type="submit" name="form_submit" id="form_submit" value="로그인">
                  <div class="mdl-spinner mdl-js-spinner is-active" style="display: none;" id="form_spinner"></div>
            </form>
          </div>
          <div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--1-offset-desktop" style="text-align: center;">
            <strong>Copyright ⓒ 2017 세종대학교 컴퓨터공학과. All rights reserved.</strong>
            <br>이 시스템은 개발 중이므로, 정상 동작을 보장하지 않습니다.
          </div>
        </div>
      </main>
    </div>
    <div aria-live="assertive" aria-atomic="true" aria-relevant="text" class="mdl-snackbar mdl-js-snackbar">
      <div class="mdl-snackbar__text"></div>
      <button type="button" class="mdl-snackbar__action"></button>
    </div>
    <script>
      var notification = document.querySelector('.mdl-js-snackbar');
      var charset = /[^A-Za-z0-9_]/;
      var number = /[0-9]/;
      var session_state = "<?php echo $state; ?>";
      function checkLoginForm() {
        alert("test");
        var id = document.getElementById("form_id").value;
        var password = document.getElementById("form_password").value;
        if (id == "") {
          notification.MaterialSnackbar.showSnackbar({
            message: '올바른 아이디 형식이 아닙니다.'
          });
          document.getElementById("form_info").innerHTML = "올바른 아이디 형식이 아닙니다.";
        } else if (password == "") {
          notification.MaterialSnackbar.showSnackbar({
            message: '올바른 비밀번호 형식이 아닙니다.'
          });
          document.getElementById("form_info").innerHTML = "올바른 비밀번호 형식이 아닙니다.";
        } else {
          if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
          } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            document.getElementById("form_id").readOnly = true;
            document.getElementById("form_password").readOnly = true;
            document.getElementById("form_submit").style.display = "none";
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              result = xmlhttp.responseText;
              if (result == "Authorized") {
                location.replace("main.php");
              } else {
                if (result == "Unauthorized(0)") {
                  notification.MaterialSnackbar.showSnackbar({
                    message: '유효하지 않은 로그인 세션입니다. 페이지를 새로 로드한 후에 다시 시도하여 주십시오.'
                  });
                  document.getElementById("form_info").innerHTML = "유효하지 않은 로그인 세션입니다.<br>페이지를 새로 로드한 후에 다시 시도하여 주십시오.";
                } else if (result == "Unauthorized(1)") {
                  notification.MaterialSnackbar.showSnackbar({
                    message: '이전 로그인 계정이 로그아웃 처리 되었습니다. 다른 계정으로 로그인하시려면 다시 시도하여 주십시오.'
                  });
                  document.getElementById("form_info").innerHTML = "이전 로그인 계정이 로그아웃 처리 되었습니다.<br>다른 계정으로 로그인하시려면 다시 시도하여 주십시오.";
                } else if (result == "Unauthorized(2)") {
                  notification.MaterialSnackbar.showSnackbar({
                    message: '로그인에 실패하였습니다. 등록된 계정이 아니거나 비밀번호가 다릅니다.'
                  });
                  document.getElementById("form_info").innerHTML = "로그인에 실패하였습니다.<br>등록된 계정이 아니거나 비밀번호가 다릅니다.";
                } else if (result == "Unauthorized(3)") {
                  notification.MaterialSnackbar.showSnackbar({
                    message: '로그인에 실패하였습니다. 서버에 문제가 있어 쿼리를 처리할 수 없습니다.'
                  });
                  document.getElementById("form_info").innerHTML = "로그인에 실패하였습니다.<br>서버에 문제가 있어 쿼리를 처리할 수 없습니다.";
                }
                document.getElementById("form_id").readOnly = false;
                document.getElementById("form_password").readOnly = false;
                document.getElementById("form_spinner").style.display = "none";
                document.getElementById("form_submit").style.display = "";
              }
            } else {
              document.getElementById("form_spinner").style.display = "";
            }
          }
          xmlhttp.open("POST", "login_query.php", true);
          xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xmlhttp.send('form_id='+encodeURIComponent(id)+'&form_password='+encodeURIComponent(password));
        }
      }
    </script>
  </body>
</html>
