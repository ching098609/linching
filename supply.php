<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>補貨</title>
</head>
<body>
<?php
session_start();
require("dbconnect.php");
$iid = $_POST['iid'];
$hid = $_SESSION['Hid'];
$iName = $_POST['iName'];
$buffer = $_POST['buffer'];
$sql = "select * from item where Iid=$iid;";
$sqlResult = mysqli_query($db_link,$sql);
$itemRow = mysqli_fetch_array($sqlResult);
$iAmount = $itemRow['Amount'];
$iBound = $itemRow['Bound'];
if($iBound < $iAmount + $buffer){
  $buffer = $iBound - $iAmount;
}
$sql = "update item set Amount=Amount-$buffer where RefHid='$hid' and Name = '$iName';";
mysqli_query($db_link,$sql) or die("總公司庫存不足"); //執行SQL
$sql = "update item set Amount=Amount+$buffer where Iid=$iid;";
mysqli_query($db_link,$sql) or die("MySQL1 update data error"); //執行SQL
echo "補貨成功.";
header("Location: playnow.php");
?>
<p><a href="playnow.php">回分公司清單</a> </p>
</body>
</html>