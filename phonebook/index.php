<html>
<head>
  <title>JMM TelephoneBook</title>
</head>
<body>
<?php
if(isset($_GET['sort']) && $_GET['sort'] == 'sn') {
     $sort = "sn";
}
else if(isset($_GET['sort']) && $_GET['sort'] == 'mail') {
     $sort = "mail";
}
else if(isset($_GET['sort']) && $_GET['sort'] == 'mobile') {
     $sort = "mobile";
}
else if(isset($_GET['sort']) && $_GET['sort'] == 'telephonenumber') {
     $sort = "telephonenumber";
}
else if(isset($_GET['sort']) && $_GET['sort'] == 'title') {
     $sort = "title";
}
else if(isset($_GET['sort']) && $_GET['sort'] == 'department') {
     $sort = "department";
}
else
{
     $sort = "";
}
set_time_limit(30);
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
$ldapserver = '192.168.106.21';
$ldapuser      = 'ahtest';
$ldappass     = 'Qwerty1+';
$ldaptree    = "OU=ЦО,OU=Сотрудники,DC=jetmoney,DC=local";
$filter = "(&(cn=*)(mail=*@jetmoney.ru)(objectClass=user)(!(cn=hr*))(!(cn=risk*))(!(cn=*КООРДИНАТОР*))(!(cn=*video*))(!(cn=*report*))(!(cn=*Бухгалте*))(!(cn=*поддержк*))(!(cn=*vremennai*))(!(cn=*otrs*))(!(cn=*Побужанский*))(!(cn=*симакин*))(!(cn=*салимов*))(!(cn=*воловик*))(!(cn=*пухов*))(!(cn=*Голубев Алексей*))(!(cn=*Светлана Макарова*))(!(cn=*Могильнер *))(!(mail=*time*))(!(mail=*kvsergantova*))(!(mail=*oprp*))(!(mail=*s.trubicyn*))(!(mail=*help*))(!(mail=*opscenter*)))";
$ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");
ldap_set_option( $ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3 );
if($ldapconn) {
    $ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass) or die ("Error trying to bind: ".ldap_error($ldapconn));
    if ($ldapbind) {
        $result = ldap_search($ldapconn,$ldaptree,$filter) or die ("Error in search query: ".ldap_error($ldapconn));
        @ldap_sort($ldapconn, $result, $sort) ;
        $data = ldap_get_entries($ldapconn, $result);
       echo '<a href=telreg.php class="button">Справочник Регионы</a>';
        echo '<h1></h1>';
        echo '<table  class="simple-little-table">';
        echo '<tr border="1px" ><td width="20%" align="center"><a href=index.php?sort=sn>Ф.И.О.</a></td><td width="15%" align="center"><a href=index.php?sort=mail>E-Mail</a></td><td width="10%" align="center"><a href=index.php?sort=mobile># Телефон</a></td><td width="8%" align="center"><a href=index.php?sort=telephonenumber># Внутрений</a></td><td width="25%" align="center"><a href=index.php?sort=title>Должность</a></td><td width="25%" align="center"><a href=index.php?sort=department>Отдел</a></td></tr>';
        for ($i=0; $i<$data["count"]; $i++) {
            echo '<tr border="2px">';
            echo "<td>". $data[$i]["cn"][0] ."</td>";
            if(isset($data[$i]["mail"][0])) {
                echo "<td>". $data[$i]["mail"][0] ."</td>";
            } else {
                echo "<td> </td>";
            }
            if(isset($data[$i]["mobile"][0])) {
                echo "<td>". $data[$i]["mobile"][0] ."</td>";
            } else {
                echo "<td> </td>";
            }

            if(isset($data[$i]["telephonenumber"][0])) {
                echo "<td>". $data[$i]["telephonenumber"][0] ."</td>";
            } else {
                echo "<td> <a style: color=#F0F0F0>[!Отсутствует]</a> </td>";
            }
            if(isset($data[$i]["title"][0])) {
                echo "<td>". $data[$i]["title"][0] ."</td>";
            } else {
                echo "<td> </td>";
            }
            if(isset($data[$i]["department"][0])) {
                echo "<td>". $data[$i]["department"][0] ."</td>";
            } else {
                echo "<td> </td>";
            }
            echo '</tr>';
        }
    } else {
        echo "LDAP bind failed...";
    }

}
echo '</table>';
ldap_close($ldapconn);
?>
