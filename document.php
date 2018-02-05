<?php
$file = "./Document.pdf"; // 파일 저장위치
$filename = "Document.pdf"; // 파일 이름

if ( file_exists($file) )
{
header("Content-Type: doesn/matter");
header("Content-length: ".filesize("$file"));
header("Content-Disposition: attachment; filename=$filename");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");

if ( is_file("$file") )
{
$fp = fopen("$file", "r");

if ( !fpassthru($fp) )
{
fclose($fp);
}
}
} else
{
echo "<script>alert('첨부파일이 존재하지 않습니다.'); history.go(-1);</script>";
}
?>
