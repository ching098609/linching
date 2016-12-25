<?php
session_start();
require("dbconnect.php");
//mysql_select_db($db, $conn); //選擇資料庫
$hid = $_SESSION['Hid'];
$pid=$_SESSION['Pid'];
$sql = "select * from player order by Pmoney desc;";
$playerResult=mysqli_query($db_link,$sql);
while($playerRow=mysqli_fetch_array($playerResult)){
  $paccount[] = $playerRow['Account'];
  $pmoney[] = $playerRow['Pmoney'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>排行榜</title>
<style type="text/css">
body {
background-image: url(12.jpg);
background-size:cover;
margin:10px auto; font-size:14pt}
th {
font-family:"標楷體";
color:Black ;
background-color:LavenderBlush ;
}
td {
font-family:"標楷體";
padding:5px;
color:Black ;
background-color:LavenderBlush ;
}
table{
font-family:"標楷體";
border:8px;
#FFD382 LemonChiffon ;
cellpadding="10";
border='0';
}

</style>
</head>
<body>
<h1 style="color:SaddleBrown; font-family:標楷體; text-align:center; background-color:LemonChiffon">
<img src="f/31.png" width="40" height="40"/>
<img src="f/31.png" width="60" height="60"/>
<font size="6">玩家資金排行榜</font>
<img src="f/30.png" width="60" height="60"/>
<img src="f/30.png" width="50" height="50"/>
<img src="f/30.png" width="40" height="40"/>
<input type="button" value="返回" onclick="window.location='playnow.php'" style="border:5px outset Gold ; background-color:GreenYellow "/>
</h1>
<table width="700" border="1" align="center">
  <tr>
    <th>名次</th>
    <th>玩家</th>
    <th>金錢數量</th>
  </tr>
<?php
for ($i=1; $i < count($paccount); $i++) { 
?>
  <tr>
  <?php if($i<=3){ ?>
    <td align="center" style="background-color:LightCyan"><img src="f/35.png" width="35" height="35"/><?php echo $i; ?></td>
    <td align="center" style="background-color:LightCyan"><?php echo $paccount[$i]; ?></td>
    <td align="center" style="background-color:LightCyan"><?php echo $pmoney[$i]; ?></td>
  <?php } ?>
  <?php if($i>3){ ?>
    <td align="center"><?php echo $i; ?></td>
    <td align="center"><?php echo $paccount[$i]; ?></td>
    <td align="center"><?php echo $pmoney[$i]; ?></td>
  <?php } ?>
  </tr>
<?php
}
?>
</table>
<embed src="music/play.mp3" autostart="true" hidden="true" loop="true">
</body>
</html>