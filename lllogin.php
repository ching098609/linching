<?php
  session_start();
  require("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Application Login</title>
<style type="text/css">
body {
background-image: url(25.jpg);
background-size:cover;
background-size:no-repeat;
margin:100px auto; 
font-size:20pt
}
input {
font-size: 14pt;
font-family: Times New Roman;
}
p {
text-align:center; 
padding:5px 10px;
font-family:微軟正黑體;
font-weight:bold;
color: maroon;
}
</style>
</head>
<body>
<?php
//addslashes類似mysqli_real_escape_string
  $account = addslashes($_POST["account"]);
  $pwd = addslashes($_POST["pwd"]);
  $playerSql = "SELECT * FROM player WHERE Account='".$account."' AND Pwd='".$pwd."';";
  $playerResult = mysqli_query($db_link, $playerSql) or die("Query Fail! ".mysqli_error($db_link));
  //查出資料庫有幾筆資料
  $playerNum = mysqli_num_rows($playerResult);
  if ($playerNum ==0) {
    $msg= "Login fail!";
    echo "<p>$msg</p>";
  } else {
    $playerRow=mysqli_fetch_assoc($playerResult);
    $msg = "Dear ".$playerRow['Name'].", You are welcome!";
    //$_SESSION記得現在的帳戶是123 但密碼..不會記得
    $_SESSION['Pid'] = $playerRow['Pid'];
    $hidSql = "select * from headquarters where RefPid=".$playerRow['Pid'].";";
    $hidResult = mysqli_query($db_link, $hidSql) or die("Query Fail! ".mysqli_error($db_link));
    $hidRow=mysqli_fetch_assoc($hidResult);
    $_SESSION['Hid'] = $hidRow['Hid'];
    $_SESSION['isAdd0'] = -1;
    $_SESSION['isAdd1'] = -1;
    $_SESSION['isAdd2'] = -1;
    echo "<p>$msg</p>";
    $bid = array();
    $sql = "select * from branch where RefHid=".$_SESSION['Hid'].";";
    $sqlResult = mysqli_query($db_link,$sql);
    while($branchRow = mysqli_fetch_array($sqlResult)){
      $bid[] = $branchRow['Bid'];
    } 
    for($i = 0; $i < count($bid); $i++){
      $sql = "select * from item where RefBid=".$bid[$i].";";
      $sqlResult = mysqli_query($db_link,$sql);
      for($j = 0; $j < 3; $j++){
        $bitemRow = mysqli_fetch_array($sqlResult);
        $biid[$j] = $bitemRow['Iid'];
      }
      $bidelay = $i * 5;
      if($bidelay + 5 < 59)
        $bidelay += 5;
      $sql = "update item set arriveTime=ADDTIME(CURRENT_TIMESTAMP, \"0:1:$bidelay\") where Iid=$biid[0];";
      mysqli_query($db_link,$sql) or die("延遲時間發生錯誤0");
      if($bidelay + 10 < 59)
        $bidelay += 10;
      $sql = "update item set arriveTime=ADDTIME(CURRENT_TIMESTAMP, \"0:2:$bidelay\") where Iid=$biid[1];";
      mysqli_query($db_link,$sql) or die("延遲時間發生錯誤1");
      if($bidelay + 15 < 59)
        $bidelay += 15;
      $sql = "update item set arriveTime=ADDTIME(CURRENT_TIMESTAMP, \"0:4:$bidelay\") where Iid=$biid[2];";
      mysqli_query($db_link,$sql) or die("延遲時間發生錯誤2");
    }
    //header("Location: playnow.php");
?>
<p><input type="button" value="進入遊戲" onclick="window.location='playnow.php'" style="border:5px outset Gold ; background-color:GreenYellow "/></p>

<?php
  }
?>
<p><input type="button" value="回登入頁面" onclick="window.location='index.php'" style="border:5px outset Gold ; background-color:GreenYellow "/></p>
<embed src="music/login.mp3" autostart="true" hidden="true" loop="true"> 
</body>
</html>