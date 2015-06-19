<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_marambio = "localhost";
$database_marambio = "marambio2";
$username_marambio = "root";
$password_marambio = "";
$marambio = mysql_connect($hostname_marambio, $username_marambio, $password_marambio) or trigger_error(mysql_error(),E_USER_ERROR);

$numero = count($_REQUEST);
$tags = array_keys($_REQUEST);// obtiene los nombres de las varibles
$valores = array_values($_REQUEST);// obtiene los valores de las varibles
// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
	$$tags[$i]=$valores[$i];
}
?>