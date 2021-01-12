<?php session_start();
require('config.php');

$mytable = $_SESSION["mytable"]; 

if (isset($_GET['id'])) { 
    $id = (int) $_GET['id'];
    if (isset($_POST['submitted'])) { 
        $key_val = array();
        foreach($_POST as $key => $val) {
            if($key != "submitted") {
                $key_val[] = $key . "='" . $dbi->real_escape_string($val) . "'";
            }
        }
        $sql = "UPDATE " . $mytable . "  SET " . implode(',', $key_val) .
                         "  WHERE id='".$id."'";
        $dbi->query($sql); 
        echo "<a href='list.php'><b>To Listing</b></a>"; 
    } 

    $row = $dbi->query("SELECT * FROM ".$mytable." WHERE id='".$id."'")->fetch_assoc();
    $form = array("<form action='' method='POST'>");
    foreach( $row as $key => $val) {
        if($key != 'id') {
            $form[] = "<p>" . $key . ": <input type='text' name='" . $key . "' value='" . 
                      stripslashes($val) . "' /></p>";
        }
    }
    $form[] = "<p><input type='submit' value='Edit Row' />" .
                  "<input type='hidden' value='1' name='submitted' /></p></form>";
    echo implode('', $form);
}
?>
