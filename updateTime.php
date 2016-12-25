<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>進貨</title>
</head>
<body>
<form method="post" action="sellgoods.php" id="sell">
  <input type="hidden" name="iid" value="<?php echo $_POST['iid'];?>">
</form>
<?php
session_start();
require("dbconnect.php");
if(array_key_exists('HTTP_REFERER', $_SERVER))
  $fName = $_SERVER['HTTP_REFERER'];
else
  header("Location: index.php");

$pid = $_SESSION['Pid'];
$iid = $_POST['iid'];
$delay = $_POST['idelay'];
if(array_key_exists('irealcost', $_POST)){
  $index = $_POST['iindex'];
  $_SESSION['buffer'.$index] = $_POST['buffer'];
  $_SESSION['realcost'.$index] = $_POST['irealcost'];
  $_SESSION['isAdd'.$index] = 1;
}
if(isset($_POST['buffer']) && $_POST['buffer'] > 0){
  $sql = "update item set arriveTime=ADDTIME(CURRENT_TIMESTAMP, \"$delay\") where Iid=$iid;";
  mysqli_query($db_link,$sql) or die("延遲時間發生錯誤");
  $sql = "update item set isUpdate=0 where Iid='$iid';";
  mysqli_query($db_link,$sql) or die("更新狀態設定發生錯誤");
  if(array_key_exists('irealcost', $_POST)){
    header("Location: playnow.php");
  }
  else{
    echo
    "<script>
      document.getElementById('sell').submit();
    </script>";
  }
}
else{
  $_SESSION['isAdd'.$index] = -1;
  echo "<p>需輸入進貨數量且要大於零</p>";
}
?>

<p><a href="playnow.php">回遊戲主畫面</a> </p>
</body>
</html>