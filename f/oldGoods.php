<?php
session_start();
require("dbconnect.php");
//mysql_select_db($db, $conn); //選擇資料庫
$hid = $_SESSION['Hid'];
$itemSql = "select * from item where RefHid=".$hid.";";
$itemResult = mysqli_query($db_link,$itemSql);
while($itemRow = mysqli_fetch_array($itemResult)){
  $iName[] = $itemRow['Name'];
  $iAmount[] = $itemRow['Amount'];
  $iMinCost[] = $itemRow['minCost'];
  $iMaxCost[] = $itemRow['maxCost'];
}
$pid=$_SESSION['Pid'];
$sql = "select * from player where Pid='$pid';";
$playerResult=mysqli_query($db_link,$sql);
$playerRow=mysqli_fetch_array($playerResult);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>總公司庫存</title>
<style type="text/css">
th {
color:Black ;
background-color:RosyBrown ;
}
td {
padding:5px;
color:Black ;
background-color:RosyBrown ;
}
table{
#FFD382 groove;
cellpadding="10";
border='0';
}
</style>
</head>
<body>
<p>總公司庫存</p>
<table width="500" border="1">
  <tr>
    <th>商品名稱</th>
    <th>數量</th>
    <th>成本</th>
    <th>進貨</th>
    <th>新貨抵達時間</th>
  </tr>
  <tr>
    <td><?php echo $iName[0]; ?></td>
    <td><?php echo $iAmount[0]; ?></td>
    <td><?php echo "$iMinCost[0]~$iMaxCost[0] 元"; ?></td>
    <td><input type="submit" value="是"></td>
    <td>無新貨</td>
  </tr>
  <tr>
    <td><?php echo $iName[1]; ?></td>
    <td><?php echo $iAmount[1]; ?></td>
    <td><?php echo "$iMinCost[1]~$iMaxCost[1] 元"; ?></td>
    <td><input type="submit" value="是"></td>
    <td>無新貨</td>
  </tr>
  <tr>
    <td><?php echo $iName[2]; ?></td>
    <td><?php echo $iAmount[2]; ?></td>
    <td><?php echo "$iMinCost[2]~$iMaxCost[2] 元"; ?></td>
    <td><input type="submit" value="是"></td>
    <td>無新貨</td>
  </tr>
</table>
<p>目前擁有的資金: <?php echo $playerRow['Pmoney']; ?>元</p>
<p><input type="button" value="查看分公司" onclick="window.location='branch.php'" /></p>
<p><input type="button" value="返回主畫面" onclick="window.location='playnow.php'" /></p>
</body>
</html>