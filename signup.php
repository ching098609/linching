<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>註冊</title>
<style type="text/css">
body {
background-image: url(signup.jpg);
background-repeat:no-repeat;
background-position:center;
background-size: 1400px 800px;
margin:100px auto; 
font-size:18pt
}
table {
margin: 20px auto; 
border: 8px dotted royalblue; 
width:600px; 
padding:80px
}
td {
text-align:center; 
padding:5px 10px;
font-family:微軟正黑體;
font-weight:bold;
color: darkslateblue;
}
input {
font-size:18pt;
font-family:微軟正黑體;
font-weight:bold;
color: darkslateblue;
}

</style>
</head>
<body>

<table width="300" border="1">
  <form method="post" action="sssignup.php">
  <tr>
    <td colspan="2">帳號<input type="text" name="account" id="account" size="17" maxlength="12" style="border:none; background-color:lightsteelblue"/></td>
  </tr>
  <tr>
    <td colspan="2">密碼<input type="text" name="pwd" id="pwd" size="17" maxlength="12" style="border:none; background-color:lightsteelblue"/></td>
  </tr>
  <tr>
    <td colspan="2">名稱<input type="text" name="name" id="name" size="17" maxlength="12" style="border:none; background-color:lightsteelblue"/></td>
  </tr>
  <tr>
    <td><input type="submit" value="確定" style="border:5px outset lightslategray; background-color:silver"/></td>
  </form>  
    <td><input type="button" value="返回" style="border:5px outset lightslategray; background-color:silver" onclick="window.location='index.php'" /></td>
  <tr/>
</table>
</body>
</html>