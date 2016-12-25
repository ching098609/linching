<?php
  session_start();
  require("dbconnect.php");
//mysql_select_db($db, $conn); //選擇資料庫
  $pid=$_SESSION['Pid'];
  $sql = "select * from player where Pid='$pid';";
  $countresult=mysqli_query($db_link,$sql);
  $row=mysqli_fetch_array($countresult);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>總公司</title>
<style type="text/css">
th {
color:Black ;
background-color:LavenderBlush ;
}
td {
padding:5px;
color:Black ;
background-color:LavenderBlush ;
}
table{
border:8px;
#FFD382 groove;
cellpadding="10";
border='0';
}
</style>
</head>
<body>
<p>歡迎來到麵包遊戲</p>
<p>玩家名稱: <?php echo $row['Name']; ?></p>
<p>目前擁有的資金: <?php echo $row['Pmoney']; ?>元</p> 
<p><input type="button" value="查看分公司" onclick="window.location='branch.php'" /></p>
<p><input type="button" value="登出" onclick="window.location='index.php'" /></p>
</body>
</html>