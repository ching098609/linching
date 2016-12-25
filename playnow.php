<script src="scrollfix.js" type="text/javascript"></script>
<?php
session_start();
require("dbconnect.php");
//mysql_select_db($db, $conn); //選擇資料庫
$hid = $_SESSION['Hid'];
$pid=$_SESSION['Pid'];
if(array_key_exists('HTTP_REFERER', $_SERVER))
  $fName = $_SERVER['HTTP_REFERER'];
else
  header("Location: index.php");
// while(strpos($fName, '/', 1) != 0 && strpos($fName, '/', 1) != strlen($fName) - 1){
//   $fName = substr($fName, strpos($fName, '/') + 1);
// }
// if($fName == "updateTime.php"){
// }

$sql = "select * from player where Pid='$pid';";
$sqlResult=mysqli_query($db_link,$sql);
$playerRow=mysqli_fetch_array($sqlResult);

$sql = "select * from player where Pid='$pid';";
$sqlResult=mysqli_query($db_link,$sql);
$playerRow=mysqli_fetch_array($sqlResult);

$bid = array();
$sql = "select * from branch where RefHid=".$hid.";";
$sqlResult = mysqli_query($db_link,$sql);
while($branchRow = mysqli_fetch_array($sqlResult)){
  $bid[] = $branchRow['Bid'];
}

$sql = "select * from item where RefHid=".$hid.";";
$sqlResult = mysqli_query($db_link,$sql);
while($hitemRow = mysqli_fetch_array($sqlResult)){
  $hiName[] = $hitemRow['Name'];
  $hiAmount[] = $hitemRow['Amount'];
  $hirealcost[] = rand($hitemRow['minCost'], $hitemRow['maxCost']);
  $hiid[] = $hitemRow['Iid'];
  $hiTime[] = $hitemRow['arriveTime'];
  $hiUpdate[] = $hitemRow['isUpdate'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" smartNavigation="True">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>麵包公司經營遊戲</title>
<style type="text/css">
th {
color:Black ;
background-color:LemonChiffon ;
}
td {
padding:5px;
color:Black ;
background-color:LemonChiffon ;
}
table{
Violet  groove;
cellpadding="10";
border='0';
background-size:cover;
background-size:no-repeat;
}
body {
background-attachment: fixed;
background-image: url(11.jpg);
background-repeat:no-repeat;
background-size:cover;
}
h2 {
background-image: url("2.jpg");
background-repeat: repeat-y;
padding: 5px 0px 5px 10px;
letter-spacing: 0.5em;
border-left: 20px double #CD853F;
border-radius: 30px 5px 5px 30px;<!--設定圓弧-->
}
#menu li {
position: relative;
display: inline;
}
#menu li a {
background-color:Bisque;
color:SaddleBrown ;
font-family:標楷體;
padding:5px;
margin:20px;
background-repeat:no-repeat;
text-decoration: none;
width: 110px;
height: 26px;
text-align:right;
}
</style>
</head>
<body onunload="unloadP('UniquePageNameHereScroll')" onload="loadP('UniquePageNameHereScroll')">
<div id="menu" >
<ul >
<li>
  <a><img src="f/13.png" width="35" height="35"/><font size="4.5"><?php echo $playerRow['Name']; ?></font></a></li>
<li>
  <a><img src="f/18.png" width="35" height="35"/><font size="4.5"><?php echo $playerRow['Pmoney']; ?></font></a></li>
<li><a id="time"></a></li>
<?php if($playerRow['Pmoney']<500000){ 
}else{ ?>
<li><input type="button" value="新增分公司" onclick="window.location='newBranch.php'" style="border:5px outset Gold ; background-color:GreenYellow "/></li>
<?php } ?>
<li><input type="button" value="查看排行榜" onclick="window.location='showTop.php'" style="border:5px outset Gold ; background-color:GreenYellow "/></li>
<li><input type="button" value="登出" onclick="window.location='index.php'" style="border:5px outset Gold ; background-color:GreenYellow "/></li>
</ul>
<h2 style="color:ForestGreen; font-family:標楷體">
<font size="5">總公司庫存</font><img src="f/21.png" width="35" height="35"/></h2>
<table width="600" border="1">
  <tr>
    <th>商品名稱</th>
    <th>數量</th>
    <th>成本</th>
    <th>進貨</th>
    <th>新貨抵達時間</th>
  </tr>
  <tr>
    <td><?php echo $hiName[0]; ?></td>
    <td><?php echo $hiAmount[0]; ?></td>
    <td><?php if($_SESSION['isAdd0'] == 1) echo $_SESSION['realcost0']; else echo $hirealcost[0]; ?></td>
    <form method="post" action="updateTime.php">
      <td>
      <input type="text" name="buffer" id="buffer" size="2" maxlength="5" />個
      <input type="submit" <?php if($_SESSION['isAdd0'] == 1) echo "disabled";?> value="確定">
      </td>
      <input type="hidden" name="irealcost" value="<?php echo $hirealcost[0];?>">
      <input type="hidden" name="iid" value="<?php echo $hiid[0];?>">
      <input type="hidden" name="idelay" value="<?php echo 5;?>">
      <input type="hidden" name="iindex" value="<?php echo 0;?>">
    </form>
    <form method="post" action="addgoods.php" id="ag0">
      <input type="hidden" name="buffer" value="<?php echo $_SESSION['buffer0'];?>">
      <input type="hidden" name="irealcost" value="<?php echo $_SESSION['realcost0'];?>">
      <input type="hidden" name="iid" value="<?php echo $hiid[0];?>">
      <input type="hidden" name="iindex" value="<?php echo 0;?>">
    </form>
    <td id="arriveTime0"></td>
  </tr>
  <tr>
    <td><?php echo $hiName[1]; ?></td>
    <td><?php echo $hiAmount[1]; ?></td>
    <td><?php if($_SESSION['isAdd1'] == 1) echo $_SESSION['realcost1']; else echo $hirealcost[1]; ?></td>
    <form method="post" action="updateTime.php">
      <td>
      <input type="text" name="buffer" id="buffer" size="2" maxlength="5" />個
      <input type="submit" <?php if($_SESSION['isAdd1'] == 1) echo "disabled";?> value="確定">
      </td>
      <input type="hidden" name="irealcost" value="<?php echo $hirealcost[1];?>">
      <input type="hidden" name="iid" value="<?php echo $hiid[1];?>">
      <input type="hidden" name="idelay" value="<?php echo 10;?>">
      <input type="hidden" name="iindex" value="<?php echo 1;?>">
    </form>
    <form method="post" action="addgoods.php" id="ag1">
      <input type="hidden" name="buffer" value="<?php echo $_SESSION['buffer1'];?>">
      <input type="hidden" name="irealcost" value="<?php echo $_SESSION['realcost1'];?>">
      <input type="hidden" name="iid" value="<?php echo $hiid[1];?>">
      <input type="hidden" name="iindex" value="<?php echo 1;?>">
    </form>
    <td id="arriveTime1"></td>
  </tr>
  <tr>
    <td><?php echo $hiName[2]; ?></td>
    <td><?php echo $hiAmount[2]; ?></td>
    <td><?php if($_SESSION['isAdd2'] == 1) echo $_SESSION['realcost2']; else echo $hirealcost[2]; ?></td>
    <form method="post" action="updateTime.php">
      <td>
      <input type="text" name="buffer" id="buffer" size="2" maxlength="5" />個
      <input type="submit" <?php if($_SESSION['isAdd2'] == 1) echo "disabled";?> value="確定">
      </td>
      <input type="hidden" name="irealcost" value="<?php echo $hirealcost[2];?>">
      <input type="hidden" name="iid" value="<?php echo $hiid[2];?>">
      <input type="hidden" name="idelay" value="<?php echo 15;?>">
      <input type="hidden" name="iindex" value="<?php echo 2;?>">
    </form>
    <form method="post" action="addgoods.php" id="ag2">
      <input type="hidden" name="buffer" value="<?php echo $_SESSION['buffer2'];?>">
      <input type="hidden" name="irealcost" value="<?php echo $_SESSION['realcost2'];?>">
      <input type="hidden" name="iid" value="<?php echo $hiid[2];?>">
      <input type="hidden" name="iindex" value="<?php echo 2;?>">
    </form>
    <td id="arriveTime2"></td>
  </tr>
</table>
<h2 style="color:ForestGreen; font-family:標楷體">
<font size="5">分公司商品狀況</font><img src="f/21.png" width="35" height="35"/></h2>
<?php
if($bid)
  for($i = 0; $i < count($bid); $i++){
    $sql = "select * from item where RefBid=".$bid[$i].";";
    $sqlResult = mysqli_query($db_link,$sql);
    while($bitemRow = mysqli_fetch_array($sqlResult)){
      $biid[$i][] = $bitemRow['Iid'];
      $biName[$i][] = $bitemRow['Name'];
      $biPrice[$i][] = $bitemRow['Price'];
      $biAmount[$i][] = $bitemRow['Amount'];
      $biBound[$i][] = $bitemRow['Bound'];
      $biTime[$i][] = $bitemRow['arriveTime'];
      $biUpdate[$i][] = $bitemRow['isUpdate'];
    }
    $bidelay = $i * 5;
?>
<table width="700" border="1">
  <tr>
    <th><?php echo "分公司".($i+1); ?></th>
    <th>商品名稱</th>
    <th>售價</th>
    <th>數量</th>
    <th>庫存上限</th>
    <th>補貨數量</th>
    <th>距離售出時間</th>
  </tr>
  <tr>
    <td></td>
    <td><?php echo $biName[$i][0]; ?></td>
    <td><?php echo $biPrice[$i][0]; ?></td>
    <td><?php echo $biAmount[$i][0]; ?></td>
    <td><?php echo $biBound[$i][0]; ?></td>
    <form method="post" action="supply.php">
      <td>
      <input type="text" name="buffer" id="buffer" size="2" maxlength="5" />個
      <input type="submit" value="確定">
      </td>
      <input type="hidden" name="iid" value="<?php echo $biid[$i][0];?>">
      <input type="hidden" name="iName" value="<?php echo $biName[$i][0]; ?>">
    </form>
    <form method="post" action="updateTime.php" id="<?php echo 'bud'.$i.'0'; ?>">
      <input type="hidden" name="iid" value="<?php echo $biid[$i][0];?>">
      <input type="hidden" name="idelay" value="<?php if($bidelay + 5 < 59) $bidelay+=5; echo "0:1:$bidelay";?>">
      <input type="hidden" name="buffer" value="<?php echo 1;?>">
    </form>
    <form method="post" action="sellgoods.php" id="<?php echo 'bsg'.$i.'0'; ?>">
      <input type="hidden" name="iid" value="<?php echo $biid[$i][0];?>">
    </form>
    <td id="<?php echo 'sellTime'.$i.'0';?>"></td>
  </tr>
  <tr>
    <td></td>
    <td><?php echo $biName[$i][1]; ?></td>
    <td><?php echo $biPrice[$i][1]; ?></td>
    <td><?php echo $biAmount[$i][1]; ?></td>
    <td><?php echo $biBound[$i][1]; ?></td>
    <form method="post" action="supply.php">
      <td>
      <input type="text" name="buffer" id="buffer" size="2" maxlength="5" />個
      <input type="submit" value="確定">
      </td>
      <input type="hidden" name="iid" value="<?php echo $biid[$i][1];?>">
      <input type="hidden" name="iName" value="<?php echo $biName[$i][1]; ?>">
    </form>
    <form method="post" action="updateTime.php" id="<?php echo 'bud'.$i.'1'; ?>">
      <input type="hidden" name="iid" value="<?php echo $biid[$i][1];?>">
      <input type="hidden" name="idelay" value="<?php if($bidelay + 10 < 59) $bidelay+=10; echo "0:2:$bidelay";?>">
      <input type="hidden" name="buffer" value="<?php echo 2;?>">
    </form>
    <form method="post" action="sellgoods.php" id="<?php echo 'bsg'.$i.'1'; ?>">
      <input type="hidden" name="iid" value="<?php echo $biid[$i][1];?>">
    </form>
    <td id="<?php echo 'sellTime'.$i.'1';?>"></td>
  </tr>
  <tr>
    <td></td>
    <td><?php echo $biName[$i][2]; ?></td>
    <td><?php echo $biPrice[$i][2]; ?></td>
    <td><?php echo $biAmount[$i][2]; ?></td>
    <td><?php echo $biBound[$i][2]; ?></td>
    <form method="post" action="supply.php">
      <td>
      <input type="text" name="buffer" id="buffer" size="2" maxlength="5" />個
      <input type="submit" value="確定">
      </td>
      <input type="hidden" name="iid" value="<?php echo $biid[$i][2];?>">
      <input type="hidden" name="iName" value="<?php echo $biName[$i][2]; ?>">
    </form>
    <form method="post" action="updateTime.php" id="<?php echo 'bud'.$i.'2'; ?>">
      <input type="hidden" name="iid" value="<?php echo $biid[$i][2];?>">
      <input type="hidden" name="idelay" value="<?php if($bidelay + 15 < 59) $bidelay+=15; echo "0:4:$bidelay";?>">
      <input type="hidden" name="buffer" value="<?php echo 3;?>">
    </form>
    <form method="post" action="sellgoods.php" id="<?php echo 'bsg'.$i.'2'; ?>">
      <input type="hidden" name="iid" value="<?php echo $biid[$i][2];?>">
    </form>
    <td id="<?php echo 'sellTime'.$i.'2';?>"></td>
  </tr>
</table>
<p></p>
<?php
  }
  for ($i = 0; $i < count($bid); $i++) { 
    $bitimeToJs[] = join("\", \"", $biTime[$i]);
    $biupdateToJs[] = join("\", \"", $biUpdate[$i]);
  }
?>
<embed src="music/play.mp3" autostart="true" hidden="true" loop="true">
</body>
</html>
<script type="text/javascript">
var hnow = [];
var hendTime = [];

var micro_oneday = 24 * 60 * 60 * 1000;
var micro_onehour = 60 * 60 * 1000;
var micro_oneminute = 60 * 1000;
var micro_second = 1000;

var hiTime = ["<?php echo $hiTime[0];?>", "<?php echo $hiTime[1];?>", "<?php echo $hiTime[2];?>"];
var hiUpdate = ["<?php echo $hiUpdate[0];?>", "<?php echo $hiUpdate[1];?>", "<?php echo $hiUpdate[2];?>"];

function hclock(index, runTime){
  var day;
  var hour;
  var minut;
  var second;
  index = Number(index);
  if( runTime == 0 ){
    hendTime[index] = new Date(hiTime[index]);
    hnow[index] = <?php echo time()*1000;?>;
    //php傳進來的是一秒！要改成微秒。 
  }
  else if(runTime > 0){ 
    hnow[index] += 1000;
  }
  micro_clockvalue = hendTime[index].getTime() - hnow[index]; //前面的時間是微秒！
  day = Math.floor(micro_clockvalue / micro_oneday);

  micro_clockvalue -= day * micro_oneday;
  hour = Math.floor(micro_clockvalue / micro_onehour);

  micro_clockvalue -= hour * micro_onehour;
  minute = Math.floor(micro_clockvalue / micro_oneminute);

  micro_clockvalue -= minute * micro_oneminute;
  second = Math.floor(micro_clockvalue / micro_second);

  //輸出處理用innerHTML直接寫在div內！！

  if(day == 0 && hour == 0 && minute == 0 && second == 0){
    document.getElementById('ag'+index).submit();
  }
  else if(day >= 0 && hour >= 0 && minute >= 0 && second >= 0){
    document.getElementById('arriveTime'+index).innerHTML='<b>還有</b> '+
    day+' <b>天</b> '+hour+' <b>時</b> '+
    minute+' <b>分</b> '+second+' <b>秒</b>'; 
    setTimeout("hclock("+index+", 1)", 1000);
  }
  else if(hiUpdate[index] == 0){
    document.getElementById('ag'+index).submit();
  }
  else{
    document.getElementById('arriveTime'+index).innerHTML = "無新貨";
  }
}
function showTime(){
  document.getElementById('time').innerHTML = new Date().toLocaleString('zh-TW', {hour12:false});
  setTimeout("showTime()", 1000);
}
var branchNum = <?php echo count($bid); ?>;
var bnow = [];
var bendTime = [];
var bitime = ["<?php if(isset($bitimeToJs)) echo join('", "', $bitimeToJs); ?>"];
var biupdate = ["<?php if(isset($biupdateToJs)) echo join('", "', $biupdateToJs); ?>"];

function bclock(flag1, flag2, runTime){
  var day;
  var hour;
  var minut;
  var second;
  flag1 = Number(flag1);
  flag2 = Number(flag2);
  var index = flag1*3 + flag2;
  if( runTime == 0 ){
    bendTime[index] = new Date(bitime[index]);
    bnow[index] = <?php echo time()*1000;?>;
    //php傳進來的是一秒！要改成微秒。
  }
  else if(runTime > 0){ 
    bnow[index] += 1000;
  }
  micro_clockvalue = bendTime[index].getTime() - bnow[index]; //前面的時間是微秒！
  day = Math.floor(micro_clockvalue / micro_oneday);

  micro_clockvalue -= day * micro_oneday;
  hour = Math.floor(micro_clockvalue / micro_onehour);

  micro_clockvalue -= hour * micro_onehour;
  minute = Math.floor(micro_clockvalue / micro_oneminute);

  micro_clockvalue -= minute * micro_oneminute;
  second = Math.floor(micro_clockvalue / micro_second);

  //輸出處理用innerHTML直接寫在div內！！

  if(day >= 0 && hour >= 0 && minute >= 0 && second >= 0){
    document.getElementById('sellTime'+flag1+flag2).innerHTML='<b>還有</b> '+
    day+' <b>天</b> '+hour+' <b>時</b> '+
    minute+' <b>分</b> '+second+' <b>秒</b>'; 
    setTimeout("bclock("+flag1+", "+flag2+", 1)", 1000);
  }
  else if(biupdate[index] == 0){
    document.getElementById('bsg'+flag1+flag2).submit();
  }
  else{
    document.getElementById('bud'+flag1+flag2).submit();
  }
}
showTime();
hclock(0, 0);
hclock(1, 0);
hclock(2, 0);
for (var i = 0; i < branchNum; i++) {
  bclock(i, 0, 0);
  bclock(i, 1, 0);
  bclock(i, 2, 0);
}

</script>