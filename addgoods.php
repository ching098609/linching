<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>進貨</title>
<style type="text/css">
body {
background-image: url(25.jpg);
background-size:cover;
background-size:no-repeat;
}
p{
font-size:50px;
color:red;
font-weight: bold;
font-family:標楷體;
}
</style>
</head>
<body>
<?php
session_start();
require("dbconnect.php");
$pid = $_SESSION['Pid'];
$iid = $_POST['iid'];
$irealcost = $_POST['irealcost'];
$buffer = $_POST['buffer'];
$index = $_POST['iindex'];
$_SESSION['isAdd'.$index] = -1;
$irealcost = $irealcost * $buffer;
$sql = "update item set isUpdate=1 where Iid='$iid';";
mysqli_query($db_link,$sql) or die("<p><a href=\"playnow.php\">返回</a></p><p>更新狀態設定發生錯誤 </p>");
$sql = "update item set arriveTime=SUBTIME(CURRENT_TIMESTAMP, 1) where Iid='$iid';";
mysqli_query($db_link,$sql) or die("<p><a href=\"playnow.php\">返回</a></p><p>更新時間發生錯誤</p>");
$sql = "update player set Pmoney=Pmoney-$irealcost where Pid='$pid';";
mysqli_query($db_link,$sql) or die("<p><a href=\"playnow.php\">返回</a></p><p> 更新資金發生錯誤或玩家資金不足</p>");
$sql = "update item set Amount=Amount+$buffer where Iid='$iid';";
mysqli_query($db_link,$sql) or die("<p><a href=\"playnow.php\">返回</a></p><p>更新麵包數量有誤</p>");

header("Location: playnow.php");
?>
<p><a href="playnow.php">回遊戲主畫面</a> </p>
</body>
</html>