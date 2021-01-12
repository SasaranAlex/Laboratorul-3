<?php
$my_database = "testwork";

$dbi = new mysqli('phpCRUD', 'vb', '123456', $my_database);
if($dbi->connect_errno) die("Connect failed: " . $dbi->connect_error); 

// echo $dbi->character_set_name();
$dbi->set_charset("utf8");
?> 
