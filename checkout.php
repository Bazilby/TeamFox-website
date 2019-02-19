<?php
 session_start();


 function deleteRowAtName($oID){
 

     $db = new mysqli("localhost", "root", "", "ecteamfox");
     $sql = "DELETE from orderdetails WHERE orderDetailsID = $oID";
     $db->query($sql);
     var_dump($sql);
    
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>TeamFox</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="css/Style.css">
        <script src="JS/Script.js" type="text/javascript"></script>
        
        
    </head>
    <body>
        <style>
            .displayTotal{
                border-radius: 12px;
                border: 1px solid black;
                padding-top: 1px;
                margin-top: 15px;
                margin-right: 173px;
                margin-left: 1050px;
            }

            .btnPurchase {
                 background-color: #22425e;
                border-radius: 12px;
                color: #FFF;
                transition-property: background-color, color;
                transition-duration: 0.5s;
                transition-timing-function: ease;
                margin-left: 1058px;
                width: 110px;   
            }

            .btnPurchase:hover{
                  color: #FFF;
                background-color: #D35400;
                text-decoration: none;
            }
            .productCheckout {
                width: 1000px;
                background: #FFF;
                padding: 10px 20px;
                transform: translate(-50%, -50%);
                border-radius: 12px;
                border: 1px solid black;
                overflow: hidden;
                margin-top: 4%;
                margin-left: 50%;
                margin-bottom: -3.5%;
                transition-timing-function: ease;
                transition: 3s;
            }

            .productCheckout:hover{
                background: red;
                color: #fff;
            }



        </style>
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
                        
                        
                        <?php if( ! isset($_SESSION['TeamFox'])) { ?>
                        <li><a href="#" id= "logButton" class="action-button shadow animate">Login</a></li>
                        <?php } else { ?>
                        <li><a href="account.php" class="action-button shadow animate">Account</a></li>
                        <li><a href="checkout.php" class="action-button shadow animate">My Cart</a></li>
                        <li><a href="php/logout.php" class="action-button shadow animate">Logout</a> </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        
        
        
        <hr>




        <?php 
                include 'php/checkoutC.php';
                
                function addItemC($result){
                 global $sum;
                 $sum = 0;

    ?>
   
    <p><h3 style="text-indent: 7.5em;">Your Order</h3></p>
    <?php
    while($row = mysqli_fetch_object($result)) {
             
                ?>
         <form action="" method="post"> 
            <div class="productCheckout">
                <div class="col-sm-3 text-center">
                    <strong><?php echo $row->prodName; ?></strong>
                </div>
                <div class="col-sm-3 text-center">
                    <p>R<?php echo $row->price; ?></p>
                </div> 
                <div class="col-sm-3">     
                    <p><?php echo $row->ODQuantity; ?></p>
                </div>   
                <div class="col-sm-3">
                    <form action="checkout.php?action=delete&id=<?php echo $row->productID; ?>" method="post">
                    <input title="delete row" type="submit" name="deleteRow" class="deleteButton" value="X" style="background: red; color:#fff;
                    width: 30px; height: 30px; border-radius: 10px; float: right; ">
                    <input type="hidden" value="<?php global $oID; $oID = intval($row->orderDetailsID); ?>" name="odID">
                </div>
            </div> 
        </form>  
            
            <?php
        if(isset($_POST{'deleteRow'})){

            deleteRowAtName($oID);
        }

        $sum += floatval($row->price); 
        
        }?>
        <div class="displayTotal">
            <h3><strong>R<?php echo $sum;?></strong></h3>
        </div>

        

    <?php }?>
    <form class="checkButton" action="" method="post">
        <button type="submit" name="Purchase" class="btnPurchase">Purchase</button>
    </form>
    </body>
</html>

    