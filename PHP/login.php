<?php
session_start();

    $hostname ="localhost";
    $DBName = "ecteamfox";
    $tablename = "users";
    $username = "root";
    $password = "";

    $DB_Connection = new mysqli($hostname, $username, $password,$DBName);



	
	if($DB_Connection->connect_error){
		die ("Connection failed: ".$DB_Connection->connect_error);
	}else{
		//$sql = "SELECT * FROM ".$tablename." where email ='".$_POST['username']."' and password='".md5($_POST['password'])."'";
		//echo $sql;
		$result =$DB_Connection->query("SELECT * FROM ".$tablename." where email ='".$_POST['email']."' and password='".md5($_POST['password'])."'");
        
    	
        
        $user = $result->fetch_object();
        
        
        
        
		if($result->num_rows == 1){
			$_SESSION["TeamFox"] = $user->email;
            
            print("Session: " . $_SESSION["TeamFox"]);
			
		}else{
			echo '<script type="text/javascript">
                    window.onload = function () { alert("Incorrect"); }
            </script>';
		}
		
		
        
        $DB_Connection->close();
	
	
	}
header('Location: ../store.php');

?>

<a href="../store.php">Redirect</a>