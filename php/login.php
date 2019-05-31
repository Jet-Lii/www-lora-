<?php
// 开启session
session_start();

// 获取用户名和密码
$name = $_POST["name"];
$password = $_POST["password"];

// 将用户名和密码保存到session中
$_SESSION['name'] = $name;
$_SESSION['password'] = $password;
//将用户名和密码发送到数据库进行比较，如果存在就跳转到主页面，如果不存在就不跳转
// 链接数据库
$link = mysql_connect('127.0.0.1', 'root', '123');
if (!$link) {
die('Not connected : ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('mytest', $link);
if (!$db_selected) {
die ('Can\'t use foo : ' . mysql_error());
}
$result = mysql_query("SELECT * FROM admin where user_name = '$name' and passwd = '$password'");
if (!$result) {
	die('Invalid query: ' . mysql_error());
}

if($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "1";
}
else{
	// 用户名或密码不正确，请重新登录!
	echo "0";
}
mysql_free_result($result);
mysql_close($link);
?>
