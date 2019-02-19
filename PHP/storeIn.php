<?php
 

$hostname ="localhost";
$DBName = "ecteamfox";
$tablename = "products";
$username = "root";
$password = "";

function printTableContent($conn, $tablename){
  
    $sql = "SELECT * FROM products";
    //echo $sql;
    
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        echo"<br> there are $result->num_rows Database contains info";
        
        addItem($result); 
          
        }else{
        echo "<br>no info found in database";

    }
}

$conn = new mysqli($hostname, $username, $password, $DBName);


if($conn->connect_error){
    "<br><br><br><br><br><br><br><br><br><br><br><br>";
    die ("Connection has failed".$conn->connect_error);
} else {
    printTableContent($conn, $tablename);
}

$conn->close();
?>