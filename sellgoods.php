<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>進貨</title>
</head>
<body>
<?php
session_start();
require("dbconnect.php");
$pid = $_SESSION['Pid'];
$iid = $_POST['iid'];
$sql = "update item set isUpdate=1 where Iid='$iid';";
mysqli_query($db_link,$sql) or die("<p><a href=\"playnow.php\">回分公司清單</a> </p>更新狀態設定發生錯誤");
$sql = "select * from item where Iid='$iid';";
$sqlResult = mysqli_query($db_link,$sql);
$itemRow = mysqli_fetch_array($sqlResult);
$debuffer = rand(1, 5);
$amount = $itemRow['Amount'];
if($debuffer > $amount)
  $debuffer = $amount;
$price = $itemRow['Price'];
$profit = $debuffer*$price;
$sql = "update item set Amount=Amount-$debuffer where Iid='$iid';";
mysqli_query($db_link,$sql) or die("<p><a href=\"playnow.php\">回分公司清單</a> </p>更新麵包數量有誤");
$sql = "update player set Pmoney=Pmoney+$profit where Pid='$pid';";
mysqli_query($db_link,$sql) or die("<p><a href=\"playnow.php\">回分公司清單</a> </p>更新玩家資金不夠");
header("Location: playnow.php");
?>
<p><a href="playnow.php">回遊戲主畫面</a> </p>
</body>
</html>