<?php
  //include 'hw92.php';
  //資料庫主機設定
  $host = 'localhost';
  $user = 'tiger';
  $pass = 'a';
  $db = 'finaldone6';
  //連線伺服器
  $db_link = @mysqli_connect($host, $user, $pass, $db);
  if (!$db_link) die("資料連結失敗！");
  //設定字元集與連線校對
  mysqli_set_charset($db_link, 'utf8');
  date_default_timezone_set("Asia/Taipei");
?>