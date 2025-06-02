<?php
include "DB_Functions.php";

$dbc=connectServer('localhost','root',$password,1);
$DB_name='R8PC_DATABASE';
deleteDB($dbc,$DB_name);
?>