<?php 
   session_start();
  //資料庫主機設定
  $db_host = "localhost";
  $db_username = "stu103213015";
  $db_password = "stu103213";
  $db_name = "stu103213015";
  //連線伺服器
  $db_link = @mysqli_connect($db_host, $db_username, $db_password, $db_name);
  if (!$db_link) die("資料連結失敗！");
  //設定字元集與連線校對
  mysqli_set_charset($db_link, 'utf8');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<title>Form</title>
<style type="text/css">
body {
background-image: url(26.jpg);
background-size:cover;
margin:10px auto; font-size:14pt}
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

<?php


echo "<div>";
echo "<table>";
echo "<form method='post' action='hw93.php'>";
echo '<tr>
<tr>
    <th style="color:Red; font-family:標楷體"><font size="5.5">**歡迎加入會員**</font></th>
</tr>
<tr>
　  <td>帳號: <input type="text" id="id" name="id" size="17" maxlength="12" /></td>
</tr>
<tr>
　  <td>密碼:<input type="text" id="password" name="password" size="17"maxlength="12" /></td>
</tr>
<tr>
    <td><img src="hw6/4.png" width="15" height="15"/><input type="submit" value="會員登入"/></td>
</tr>
</tr>';
echo"</form>";
echo '<tr>
<form method="post" action="hw9.php"><input type="submit" value="申辦新會員"/></form>
</tr>';
echo "</table>";
echo "</div>";

?>


</body>
</html>