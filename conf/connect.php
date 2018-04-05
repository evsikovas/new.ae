#Подключение базы данных mariaDB
<?php
  $db_host='127.0.0.1';
  $db_name='new';
  $db_user='ae';
  $db_pass='123456';
  $link = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
  mysqli_query($link, "SET NAMES utf8");
?>
