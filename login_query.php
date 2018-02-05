<?php
  session_start();
  $member = $_SESSION['session_auth_member'];

  $connect = mysqli_connect('localhost','root','applemac','macDB');
  if (!$connect) {
    die('Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
  }

  $id = mysqli_real_escape_string($connect, $_POST['form_id']);
  $password = mysqli_real_escape_string($connect, $_POST['form_password']);
  $passwords = mysqli_real_escape_string($connect, base64_encode($password));

  if (!empty($member[0])) {
    session_unset('session_auth_member');
    echo "Unauthorized(1)";
  } else {
    mysqli_select_db($connect, "macDB");
    $query_mysql="SELECT * FROM member WHERE studentId=BINARY('$id') and passwd='$password'";
    if ($result = mysqli_query($connect, $query_mysql)) {
      if (mysqli_num_rows($result) == 1) {
        $result_each = mysqli_fetch_assoc($result);
        $ip_addr = $_SERVER['REMOTE_ADDR'];
        $datetime = date("20y-m-d H:i:s");
        $datetime_today_s = date("20y-m-d 00:00:00");
        $datetime_today_e = date("20y-m-d 23:59:59");

        $_SESSION['session_auth_member'] = array($result_each["memKey"], $result_each["studentId"], $result_each["name"], $result_each["major"], $result_each["year"], $result_each["semester"], $result_each["mail"], $result_each["adminFlag"],  $result_each["adYear"], $result_each["majorId"], $result_each["engAuth"]);
        // $_SESSION[0] = member no
        // $_SESSION[1] = member id
        // $_SESSION[2] = member name
        // $_SESSION[3] = member major
        // $_SESSION[4] = member year
        // $_SESSION[5] = member semester
        // $_SESSION[6] = member email
        // $_SESSION[7] = member permission
        // $_SESSION[8] = member adyear
        // $_SESSION[9] = member majorid
        // S_SESSION[10] = member engauth

        if ($result_each["adminFlag"] == "1") {
          echo "Admin";
        } else {
          echo "Authorized";
        }
      } else {
        echo "Unauthorized(2)";
      }
    } else {
      echo "Unauthorized(3)";
    }
  }
  mysqli_close($connect);
?>
