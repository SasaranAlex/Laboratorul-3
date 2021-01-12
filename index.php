<?php session_start();
require('config.php');

if(isset($_SESSION["mytable"])) $mytable = $_SESSION["mytable"];
else {
    if(isset($_POST["submitmytable"])) {
        $mytable = $_POST["mytable"];
        $_SESSION["mytable"] = $mytable;
    }
    else {
        $res = $dbi->query("SHOW TABLES");
        echo "Select a work-table from the database <b>" . $my_database . "</b>: ";
        echo "<form action='' method='post'><select name='mytable'>";
        while($row = $res->fetch_assoc()) {
            foreach($row as $k => $v) {
                echo "<option value='" . $v . "'>" . $v . "</option>";
            }
        }
        echo "</select> <input type='submit' value='Select Table' />";
        echo "<input type='hidden' value='1' name='submitmytable' /></form>";
    }
}

if(isset($mytable)) {
    $thead = array("<table border='1'><tr>");
    $field_names = $dbi->query("DESCRIBE " . $mytable);
    while($row = $field_names->fetch_assoc()) { 
        $thead[] = "<th>" . $row['Field'] . "</th>";
    }
    $thead[] = "</tr>";
    $tbody = array();
    $result = $dbi->query("SELECT * FROM " . $mytable);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tbody[] = "<tr>"; 
            foreach($row as $key => $val) {
                $tbody[] = "<td>" . stripslashes($val) . "</td>";
            }
            $tbody[] = "<td><a href=edit.php?id={$row['id']}>Edit</a>" . 
                       " | <a href=delete.php?id={$row['id']}>Delete</a></td></tr>";
        }
    } 
    $tbody[] = "</table>";
    echo implode('', $thead) . implode('', $tbody);
    echo "<a href='new.php'><b>New Row</b></a>" .
         " | <a href='worktable.php'><b>AnotherTable</b></a>"; 
}
?>
