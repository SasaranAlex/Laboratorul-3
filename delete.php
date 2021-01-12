<?php session_start();
include('config.php'); 
$mytable = $_SESSION["mytable"]; 

$id = (int) $_GET['id']; 
$dbi->query("DELETE FROM " . $mytable . " WHERE id = '$id'") ; 

echo '<script type="text/javascript">window.location="list.php";</script>';
?> 
