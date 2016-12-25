<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>註冊</title>
<style type="text/css">
body {
background-image: url(24.png);
background-size:cover;
background-size:no-repeat;
margin:100px auto; 
font-size:20pt
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
<p>
<?php
	require("dbconnect.php");
	//mysql_select_db($db, $conn); //選擇資料庫
	$account=mysqli_real_escape_string($db_link,$_POST["account"]);
	$pwd=mysqli_real_escape_string($db_link,$_POST["pwd"]);
	$name=mysqli_real_escape_string($db_link,$_POST["name"]);
	//insert into ""   ""裡面為資料表名稱
	//insert into user...後面的為資料庫裡取的名稱
	if ($account && $pwd && $name) {
		$sql = "select * from player where Account='$account';";
		$sqlResult = mysqli_query($db_link,$sql);
		$accountRow = mysqli_fetch_array($sqlResult); //執行SQL
		if($accountRow != null)
			die("The account is exist.");
	  $sql = "insert into player (Account, Pwd, Name, Pmoney) values ('$account','$pwd','$name',1000000);";
		mysqli_query($db_link,$sql) or die("MySQL insert data error"); //執行SQL
		$sql = "select * from player order by Pid desc;";
		$sqlResult = mysqli_query($db_link,$sql);
	  $pidRow = mysqli_fetch_array($sqlResult); //執行SQL
	  $pid = $pidRow['Pid'];
	  $sql = "insert into headquarters (item1, item2, item3, RefPid) 
	                    				values ('Pineapple bun', 'Croissant', 'Baguette', '$pid');";
	  mysqli_query($db_link,$sql) or die("MySQL insert data error"); //執行SQL
	  $sql = "select * from headquarters order by Hid desc;";
		$hidResult = mysqli_query($db_link,$sql);
	  $hidRow = mysqli_fetch_array($hidResult); //執行SQL
	  $hid = $hidRow['Hid'];
	  $sql = "insert into item (Name, Amount, minCost, maxCost, RefHid) values ('Pineapple bun', '200','23','25', '$hid');";
		mysqli_query($db_link,$sql) or die("MySQL insert data error"); //執行SQL
		$sql = "insert into item (Name, Amount, minCost, maxCost, RefHid) values ('Croissant', '200','13','20', '$hid');";
		mysqli_query($db_link,$sql) or die("MySQL insert data error"); //執行SQL
		$sql = "insert into item (Name, Amount, minCost, maxCost, RefHid) values ('Baguette', '200','8','12', '$hid');";
		mysqli_query($db_link,$sql) or die("MySQL insert data error"); //執行SQL
		echo "成功註冊.";
	} else {
		echo "Please enter account, password and name.";
	}
?>
<p><a href="index.php">回登入畫面</a> </p>
<p><a href="signup.php">回註冊畫面</a> </p>
</body>
</html>