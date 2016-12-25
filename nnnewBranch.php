<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增分公司</title>
</head>

<body>
<?php
session_start();
require("dbconnect.php");
$hid = $_SESSION['Hid'];
$pid=$_SESSION['Pid'];
$price = array(30, 25, 15);
$limit = array();
for($i = 1; $i < 4; $i++){
  if($_POST["limit".$i] == 0)
    continue;
  $limit[] = $_POST["limit".$i];
  $name[] = $_POST["name".$i];
}
//insert into ""   ""裡面為資料表名稱
//insert into user...後面的為資料庫裡取的名稱
if (count($limit) == 3) {
  $sql = "update player set Pmoney=Pmoney-500000 where Pid=$pid;";
  mysqli_query($db_link,$sql) or die("MySQL update Pmoney error"); //執行SQL
  $sql = "insert into branch (item1,item2,item3,RefHid) values ('$name[0]','$name[1]','$name[2]','$hid');";
  mysqli_query($db_link,$sql) or die("MySQL insert branch error"); //執行SQL
  $sql = "select * from branch order by Bid desc;";
  $bidResult = mysqli_query($db_link,$sql);
  $bidRow = mysqli_fetch_array($bidResult);
  $bid = $bidRow['Bid'];
  for($i = 0; $i < 3; $i++){
    $sql = "insert into item (Name, Price, Amount, Bound, RefBid) 
                      values ('$name[$i]', '$price[$i]', '0', '$limit[$i]', '$bid');";
    mysqli_query($db_link,$sql) or die("MySQL insert item error"); //執行SQL
  }
  echo "成功新增.";
  header("Location: playnow.php");
} else {
  echo "資料數不對.";
}
?>
<p><a href="newBranch.php">回分公司清單</a> </p>
</body>
</html>