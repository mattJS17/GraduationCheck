<?php
 session_start();
 $member = $_SESSION['session_auth_member'];

 $connect = mysqli_connect('localhost','root','applemac','macDB');
 if (!$connect) {
   die(' Mac 데이터베이스 접근에 문제가 있습니다.' . mysqli_error($connect));
 }

mysqli_select_db($connect, "macDB");
// excel 변환

$query_mysql="SELECT *  FROM subject JOIN complete ON subject.subKey = complete.subjectKey  WHERE complete.studentId = '$member[1]' and subject.adYear = '$member[8]' ORDER BY year asc, semester asc, field asc ";
$result = mysqli_query($connect, $query_mysql);

/** PHPExcel */
require_once("./Classes/PHPExcel.php");
/* PHPExcel.php 파일의 경로를 정확하게 지정해준다. */

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
// Excel 문서 속성을 지정해주는 부분이다. 적당히 수정하면 된다.
$objPHPExcel->getProperties()->setCreator("MattShim")
                             ->setLastModifiedBy("최종수정자")
                             ->setTitle("이수과목리스트")
                             ->setSubject("이수과목리스트")
                             ->setDescription("이수과목리스트")
                             ->setCategory("Complete");

// Add some data
// Excel 파일의 각 셀의 타이틀을 정해준다.
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "학년");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B1", "학기");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C1", "과목명");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", "이수구분");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", "학점");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", "평점");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", "이름");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", "학번");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", "학과");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K1", "학년");



// for 문을 이용해 DB에서 가져온 데이터를 순차적으로 입력한다.
// 변수 i의 값은 2부터 시작하도록 해야한다.

$j = 2;
for($i = 0; $i < mysqli_num_rows($result) ; $i++) {
  $result_each = mysqli_fetch_assoc($result);
    // Add some data
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A$j", "$result_each[year]");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B$j", "$result_each[semester]");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C$j", "$result_each[subName]");
    if ($result_each["field"] == 1)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D$j", "중핵필수");
    else if ($result_each["field"] == 2)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D$j", "중핵선택");
    else if ($result_each["field"] == 3)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D$j", "전공기초교양");
    else if ($result_each["field"] == 4)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D$j", "전공필수");
    else if ($result_each["field"] == 5)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D$j", "전공선택");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E$j", "$result_each[credit]");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F$j", "$result_each[grade]");
    $j++;
}

$query_mysql2="SELECT * FROM member WHERE member.studentId = '$member[1]'";
$result2 = mysqli_query($connect, $query_mysql2);

$result_each2 = mysqli_fetch_assoc($result2);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "$result_each2[name]");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I2", "$result_each2[studentId]");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "$result_each2[major]");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K2", "$result_each2[year]");

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle("이수과목리스트");
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

$memname = $member[2]+"_이수과목리스트";

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", "이수과목리스트");

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>
