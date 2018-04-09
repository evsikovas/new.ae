<!DOCTYPE html>
<html>
<head>
<title>Admin Console JMM HelpDesk</title>
<meta charset="utf-8">
<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php
	include('./conf/connect.php');
	ini_set("display_errors", 1);
	session_start();
	if (isset($_POST['login']) && isset($_POST['password'])){
		$login = (htmlspecialchars($_POST['login']));
		$password = $_POST['password'];
		$mdpass = md5($password);
		$query = "SELECT session, login FROM users WHERE login= '$login' AND pass = '$mdpass' LIMIT 1";
    $sql = mysqli_query($link, $query) or die(mysqli_connect_error());
    if (mysqli_num_rows($sql) == 1) {
        $row = mysqli_fetch_assoc($sql);
		$_SESSION['session'] = $row['session'];
		$_SESSION['login'] = $row['login'];
		setcookie("CookieMy", $row['login'], time()+60*60*24*10);
   } else {
		header("Location: enter.php");
    }
	}
	if (isset($_SESSION['session'])){
		echo htmlspecialchars($_SESSION['session']);
		header('Location: /index.php');
	} else {
		$login = '';
		if (isset($_COOKIE['CookieMy'])){
			$login = htmlspecialchars($_COOKIE['CookieMy']);
		}
?>
<?php
	echo "<form action='enter.php' method='POST'>";
	echo "<table style='margin-left:44%' class='simple-little-table'>";
	echo 	"<tr><th>";
	echo 		"Логин <input name='login' type='text'  value ='$login'><br/>";
	echo 		"</tr></th>";
	echo 		"<tr><th>";
	echo 		"Пароль <input name='password' type='password'><br/>";
	echo 		"</tr></th>";
	echo 		"<tr><td>";
	echo 		"<input name='submit' type='submit' value='Войти' class='button'>";
	echo 		"</tr></td>";
	echo 	"</table>";
	echo 	"</form>";
}
?>
</body>
</html>
