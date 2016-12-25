<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登入</title>
<style type="text/css">
body {
background-image: url(cover.jpg);
background-size:cover;
background-size:no-repeat;
margin:100px auto; 
font-size:20pt
}
table {
margin: 20px auto; 
border: 12px double indianred; 
border-radius: 50px 50px 50px 50px;
width:600px; 
padding:80px
}
td {
text-align:center; 
padding:5px 10px;
font-family:微軟正黑體;
font-weight:bold;
color: maroon;
}
input {
font-size:18pt;
font-family:微軟正黑體;
font-weight:bold;
color: maroon;
}
</style>
</head>
<body>

<table width="200" border="1" valign="center">
<form method='post' action='lllogin.php'>
  <tr>
    <td colspan="3">帳號<input type="text" id="account" name="account" size="17" maxlength="12" /></td>
  </tr>
  <tr>
    <td colspan="3">密碼<input type="password" id="pwd" name="pwd" size="17"maxlength="12" /></td>
  </tr>
  <tr>
    <td><input type="submit" value="登入" style="border:5px darksalmon ridge; background-color:lightsalmon"/>
    </td>
</form>
    <td><input type="button" value="註冊" style="border:5px darksalmon ridge; background-color:lightsalmon" onclick="window.location='signup.php'" /></td>
  </tr>
</table>
<embed src="music/login.mp3" autostart="true" hidden="true" loop="true"> 
</body>
</html>