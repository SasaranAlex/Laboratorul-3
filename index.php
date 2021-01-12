<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;

}
.x{
    text-align:center;
     
}


label {
color: GREEN;
font-weight: bold;
display: block;
width: 150px;
float: center;
}
</style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php






  

$host="remotemysql.com";
$dbname="VScR8wUR0F";
$user="VScR8wUR0F";
// $pass="";
//   $pass="";
  $pass="wTsM9bI6oJ";
try{
    $DHB= new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
}
catch(PDOException $e){
    echo $e->getMessage();
}
$exista=0;
if(isset($_POST['inserare']))
{
    $stmt = $DHB->query('SELECT * FROM Pisica');
    while ($row = $stmt->fetch())
    {
        $aux=$row['id_pisica'];
        if($_POST['id_pisica']==$aux)
        $exista=1;
    }

if($exista==0)
{
   $statement="INSERT INTO Pisica (id_pisica,Nume,Varsta) values (?,?,?)";
   $stmt = $DHB->prepare($statement);
$stmt->execute([$_POST['id_pisica'],$_POST['Nume'],$_POST['Varsta']]);   


}
else
 {
    // $statement="UPDATE Pisica  SET id_pisica=$_POST[id_pisica],Nume=$_POST[Nume],Varsta=$_POST[Varsta],
    //  WHERE id_pisica=$_POST[id_pisica]";
    // $stmt = $DHB->prepare($statement);

    $sql = "UPDATE Pisica SET  Nume = :Nume, Varsta=:Varsta,  WHERE id_pisica= :id_pisica";
$query = $DHB->prepare($sql);
$result = $query->execute(array(':Nume' => $_POST['Nume'],
 ':Varsta' => $_POST['Varsta'])); 
 
}
  
 }

for($i=0;$i<9999;$i++)
if(isset($_POST[$i]))
 if($_POST[$i]=='Stergere')

   {
        $sql="DELETE FROM Pisica WHERE id_pisica=$i"; 
    $q = $DHB->prepare($sql);
         $q->execute(['id_pisica' => $i]);
      
   }



$stmt = $DHB->query('SELECT * FROM Pisica');

echo "<table class='table table-hover' style='width:60%; margin-right: auto;
margin-left: auto; '>";
echo "<tr>";
echo  " <th> id_pisica     </th>";
echo  "<th> Nume    </th>";
echo   "<th> Varsta      </th>";
echo   "<th> STERGERE    </th></tr>";

while ($row = $stmt->fetch())
{ echo "<tr>";
    $aux=$row['id_pisica'];
    echo "<td>".$row['id_pisica']."</td>" ;
    echo "<td>".$row['Nume']."</td>";
    echo "<td>".$row['Varsta']."</td>";
  
    echo "<td>"."<form method='post'><input type='submit' name=$aux class='btn btn-danger' value='Stergere'"."</tr>";
    

}

?>
</table>
<br><br><br>
<div class="x">
    
<form method="post"> 
        <label> id_pisisca </label>
        <input type="text" name="id_pisica">
        <br>
        <label> Nume </label>
        <input type="text" name="Nume">
        <br>
        <label> Varsta </label>
        <input type="text" name="Varsta">
        <br>
        
     
 <br><br>
        <input type="submit" name="inserare"
        class="btn btn-success" value="inserare" /> 
    </form>
</div>
