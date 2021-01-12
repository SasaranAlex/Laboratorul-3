<?php session_start(); 
$mytable = $_SESSION["mytable"]; 
require('config.php'); 

if (isset($_POST['submitted'])) { 
    $field_list = array();
    $values_list = array();
    foreach($_POST as $key => $value) {
        if($key != "submitted") {
            $field_list[] = $key;
            $values_list[] = "'" . $dbi->real_escape_string($value) . "'";
        }
    }
    $sql = "INSERT INTO " . $mytable . " (" . implode(',', $field_list) . 
                               ") VALUES(" . implode(',', $values_list) . ")"; 
    $dbi->query($sql); 
    echo "<a href='list.php'><b>To Listing</b></a>"; 
} 

$result = $dbi->query("DESCRIBE " . $mytable);
$form = array("<form action='' method='POST'>");
while($row = $result->fetch_assoc()) { 
    $field = $row['Field'];
    if($field != 'id') {
        $form[] = "<p>" . $field . ": <input type='text' name='".$field."' /></p>";
    }
}
$form[] = "<p><input type='submit' value='Add Row' />" .
          "<input type='hidden' value='1' name='submitted' /></p>";
$form[] = "</form>";
echo implode('', $form);
?>
