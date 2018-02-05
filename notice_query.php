<?php
session_start();
$member = $_SESSION['session_auth_member'];

$connect = mysqli_connect('localhost', 'root', 'applemac', 'macDB');

if (!$connect) {
  die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
}
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="라떼쉬폰 code:We">
    <meta name="author" content="라떼쉬폰">
    <link rel="icon" href="../../favicon.ico">
    <title>라떼쉬폰 code:We</title>

    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <style>
      @import url(http://fonts.googleapis.com/earlyaccess/nanumgothic.css);
      @import url(http://fonts.googleapis.com/earlyaccess/nanummyeongjo.css);

      body {
        font-family: 'Nanum Gothic', sans-serif;
        padding-top: 20%;
        padding-bottom: auto;
      }
    </style>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">글을 게시하고 있습니다.<br>잠시만 기다려 주세요.</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="text-center"><strong>∙ ∙ ∙</strong></p>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">요청하신 작업을 수행하고 있습니다.</div>
              </div>
            </div>
            <div class="col-md-2"></div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->

    <?php
        $title = strval($_POST['input_title']);
        $content = strval($_POST['ir1']);
        $date = date("y-m-d H:i:s");

        mysqli_select_db($connect,"notice");
        $query_mysql="INSERT INTO notice(title, writer, data, date) VALUES('$title', 'admin', '$content' , '$date')";
        if ($result = mysqli_query($connect, $query_mysql)) {
          echo "<script>setTimeout(function(){ window.location='admin_notice.php'; }, 0);</script>";
        } else {
          echo "<script>alert('서버사이드에 문제가 있어 요청하신 쿼리 처리를 실패하였습니다.\\n잠시 후 다시 시도하여 주십시오.'); setTimeout(function(){ window.location='notice.php'; }, 0);</script>";
        }

        mysqli_close($connect);
    ?>
  </body>
</html>
