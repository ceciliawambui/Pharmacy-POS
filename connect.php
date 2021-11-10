<?php
/* Database config */
$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= '';
$db_database	= 'pharmacy'; 

/* End config */

$link = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
