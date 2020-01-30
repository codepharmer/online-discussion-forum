<?php
define('DB_USER', 'weissman');
define('DB_PASSWORD','45Trip98');
define('DB_HOST', 'localhost');
define('DB_NAME', 'weissman_');
if(mysqli_init(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)){
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR 
    die('Could not connect to the database'.mysqli_connect_error());
//echo"<h1>Debug</h1>";
}
else echo"<h1>Could not connect</h1>"
?>