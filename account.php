<?php

    session_start();

    $db = new mysqli("localhost", "root", "", "ecteamfox");
    
    //update name and surname
     if(isset($_POST{'update1'})){
         if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['number'])){ 
             $name = $_POST['name'];
             $surname = $_POST['surname'];
            $num = $_POST['number'];
             
             $sql =  "UPDATE users SET firstName='".$_POST['name']."', lastName ='".$_POST['surname']."' ,cellNum='".$_POST['number']."' WHERE email = '".$_SESSION["TeamFox"]."'";
         }
        mysqli_query($db, $sql) or die(mysqli_error());
    }


    //update email
    if(isset($_POST{'update2'})){
         if(isset($_POST['email1']) && isset($_POST['email2'])){ 
             $email1 = $_POST['email1'];
             $email2 = $_POST['email2'];
             if($email1 == $_SESSION["TeamFox"]){
                 $sql =  "UPDATE users SET email='".$_POST['email2']."' WHERE email = '".$_SESSION["TeamFox"]."'";
                 $db->query($sql);
             }else{
                 print_r("Naughty");
                 die();
             } 
                  
         }
        mysqli_query($db, $sql) or die(mysqli_error());
    }


    //update shipping details
     if(isset($_POST{'update4'})){
         if(isset($_POST['rName'], $_POST['rContact'], $_POST['aComp'], $_POST['add1'], $_POST['add2'],
            $_POST['aSub'], $_POST['aCT'], $_POST['aCountry'], $_POST['aPC'])){ 
            $rName = $_POST['rName'];
            $rContact = $_POST['rContact'];
            $aSub = $_POST['aComp'];
            $add2 = $_POST['add1'];
            $add3 = $_POST['add2'];
            $aSub = $_POST['aSub'];
            $aCT = $_POST['aCT'];
            $aPC = $_POST['aPC'];
             
             $sql =  "UPDATE users SET rName='".$_POST['rName']."', rNumber ='".$_POST['rContact']."', buildName='".$_POST['aComp']."', address1='".$_POST['add1']."', address2='".$_POST['add2']."', suburb='".$_POST['aSub']."', city='".$_POST['aCT']."',  country='".$_POST['aCountry']."', postcode='".$_POST['aPC']."' WHERE email = '".$_SESSION["TeamFox"]."'";
                  
         }
        mysqli_query($db, $sql) or die(mysqli_error());
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>TeamFox</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/Style.css">
        <script src="JS/Script.js" type="text/javascript"></script>
        
        
    </head>
    
    <style>
        *{
            margin: 0, padding: 40px;
        }
        body{
            background-color: #FFF;
            background-position: center;
            background-size: cover;
        }
        
        .account-div{
            background:#FFF;
            border-radius: 12px;
            float: left;
            
            
        }
        
        .updateButton{
            background-color: #23415C;
            border: none;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            border-radius: 12px;
            width: 30%;
            margin-left: 35%;
            margin-right: 35%;
            transition-property: background-color, color; 
            transition-duration: 0.5s; 
            transition-timing-function: ease;
        }
        
        .updateButton:hover{
             color: #FFF;
            background-color: #D35400;
            text-decoration: none;
        }
        
        
    </style>
    
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
                        <span class="sr-only">Toggle Nav</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="img/logo2.png"></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse-main">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="store.php" class="action-button shadow animate">Store</a></li>
                         <li><a href="#" class="action-button shadow animate">Account</a></li>
                        <li><a href="checkout.php" class="action-button shadow animate">My Cart</a></li>
                        <li><a href="php/logout.php" class="action-button shadow animate">Logout</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div>
            <h4>Account Information</h4>
            <div class="padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 account-div" style="width: 45%; float:left; margin: 1%;">
                       <form method="post" action="account.php">
                            <h3>Personal Details</h3>
                            <hr>
                            <h5>Change your personal information</h5>
                            <input type="text" placeholder="name" name="name">
                            <input type="text" placeholder="surname" name="surname">
                            <input type="tel" placeholder="contact number" name="number">
                            <input type="submit" class="updateButton" name="update1" value="Update">
                        </form>
                            <hr>
                        <form>
                            <h5>Change your email</h5>
                            <input type="email" value="" placeholder="original email" name="email1">
                            <input type="email" placeholder="new email" name="email2">
                            <input type="submit" class="updateButton" name="update2" value="Update">
                        </form>
                            <hr>
                        <form>
                            <h5>Change your password</h5>
                            <input type="password" placeholder="original password">
                            <input type="password" placeholder="new password">
                            <input type="password" placeholder="confirm new password">
                            <input type="button" class="updateButton" name="update3" value="Update">
                            <hr>
                            
                        </form>
                    </div>
                    <div class="col-sm-6 text-center account-div" style="width: 45%; float:right; margin: 1%;">
                        <form>
                            <h3>Shipping Details</h3>
                            <hr>
                            <input type="text" placeholder="Recipient name*" name="rName">
                            <input type="tel" placeholder="Recipient contact number*" name="rContact">
                            <hr>
                            <input type="text" placeholder="Complex/Building details" name="aComp">
                            <input type="text" placeholder="Street Address 1*" name="add1" required>
                            <input type="text" placeholder="Street Address 2" name="add2">
                            <hr>
                            <input type="text" placeholder="Suburb*" name="aSub" required>
                            <input type="text" placeholder="City/Town*" name="aCT" required>
                            <input type="text" placeholder="Country" name="aCountry" required>
                            <input type="text" placeholder="Postal Code*" name="aPC" required>
                            <br/>
                          
                            <input type="submit" class="updateButton" name="update4" value="Update">
                            <hr>
                        </form>
                    </div>
                </div>    
            </div>
            </div>
        </div>
         
        <footer class="container-fluid text-center">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Contact Us</h3>
                    <br>
                    <h4>Fill in info here</h4>
                </div>
                <div class="col-sm-6">
                    <h3>Connect</h3>
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-google"></a>
                </div>
            </div>

        
        </footer>
    
    </body>
</html>