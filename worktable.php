<?php session_start();
unset($_SESSION["mytable"]);

echo '<script type="text/javascript">window.location="list.php";</script>';
?>
