<?php
session_start();
require("dbconnect.php");
//mysql_select_db($db, $conn); //選擇資料庫
$hid = $_SESSION['Hid'];
$headSql = "select * from headquarters where Hid=".$hid.";";
$headResult = mysqli_query($db_link,$headSql);
$headRow = mysqli_fetch_array($headResult);
for($i = 0; $i < 3; $i++){
  $iName[] = $headRow["item".($i+1)];
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
<title>新增分公司</title>
<style type="text/css">
body {
background-image: url(12.jpg);
background-size:cover;
margin:10px auto; font-size:14pt}
th {
color:Black ;
background-color:#E0FFFF ;
}
td {
padding:5px;
color:Black ;
background-color:#E0FFFF ;
}
table{
border:8px;
LightCyan ;
cellpadding="10";
border='0';
}

</style>
</head>
<body>
<p style="color:SaddleBrown; font-family:標楷體; text-align:center; background-color:LemonChiffon"><font size="6">請設定此分公司庫存上限</font></p>
<p style="color:MidnightBlue ; font-family:標楷體; text-align:center;"><font size="6">目前擁有的資金:
<?php echo $playerRow['Pmoney']; ?>元
</font></p>
<p style="color:DarkGreen ; font-family:標楷體; text-align:center;"><font size="5">(設立一家分公司需花費500,000元)
</font></p>
<form method="post" action="nnnewBranch.php">
<table width="700" border="1" align="center" bgcolor="#E0FFFF">
  <tr>
    <th>商品名稱</th>
    <th>售價</th>
    <th>庫存上限</th>
  </tr>
  <tr>
    <td><?php echo $iName[0]; ?></td>
    <td align="center">30元</td>
    <td align="center"><input type="text" name="limit1" id="limit1" size="2" maxlength="3" ></td>
    <input type="hidden" name="name1" value="<?php echo $iName[0];?>">
  </tr>
  <tr>
    <td><?php echo $iName[1]; ?></td>
    <td align="center">25元</td>
    <td align="center"><input type="text" name="limit2" id="limit2" size="2" maxlength="3" ></td>
    <input type="hidden" name="name2" value="<?php echo $iName[1];?>">
  <tr/>
  <tr>
    <td><?php echo $iName[2]; ?></td>
    <td align="center">15元</td>
    <td align="center"><input type="text" name="limit3" id="limit3" size="2" maxlength="3" ></td>
    <input type="hidden" name="name3" value="<?php echo $iName[2];?>">
  <tr/>
  </form>
  <p align="center"><input type="submit" value="確定" style="border:5px outset lightslategray; background-color:GreenYellow " onclick="window.location='nnnewbranch.php'"/>
  <input type="button" value="返回" onclick="window.location='playnow.php'" style="border:5px outset lightslategray; background-color:GreenYellow " onclick="window.location='playnow.php'"/></p>
</table>
<embed src="music/play.mp3" autostart="true" hidden="true" loop="true">
</body>
</html>