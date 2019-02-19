<?php 

session_start();

function pre_r($array){
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
   }


//add items to the shopping cart
function print_shop() {
    echo '<pre>';

    global $total;
    $total = 0;
    foreach ($_SESSION['shopping_cart'] as $key => $value) {

        $pricePerItem = $value['price'] * $value['quantity'];
        foreach ($value as $k => $e) {
            print(' ' . $e . '<br/>'); 
            echo 
            var_dump($e);

            if (isset($_POST['checkout'])) {

                $db = new mysqli("localhost", "root", "", "ecteamfox");
                $sql = "INSERT INTO orderdetails(prodName, price, ODQuantity, orderDate) VALUES
                ('".$value['name']."','".$value['price']."', '".$value['quantity']."', now())"; 

                $db->query($sql);
            }
        }
        

        
        $total = $total + $pricePerItem;
        
        
    }
    print('<br/>'.$total.'<br/>');
    echo '</pre>';
   }

$product_IDs = array();

   //check if add to cart button submitted
   if (filter_input(INPUT_POST, 'addToCart')) {

        $id = $_GET['id'];

       if (isset($_SESSION['shopping_cart'][$id])) {
           $_SESSION['shopping_cart'][$id]['quantity'] += 1;
       } else {
         $_SESSION['shopping_cart'][$id] = [
                'name' => $_POST['pName'],
                'price' => (float) $_POST['pPrice'],
                'quantity' => (int) $_POST['quantity']
           ];
       }
   }

   print_shop();

   pre_r($_SESSION);

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
            .product {
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
            }
            
            
            .product-price {
                float: right;
                font-weight: bold;
                font-size: 1.5em;
                color: red;
                
            }
            
            .btnAdd{
                background-color: #22425e;
                border-radius: 12px;
                color: #FFF;
                transition-property: background-color, color;
                transition-duration: 0.5s;
                transition-timing-function: ease;
            }
            
            .btnAdd:hover{
                color: #FFF;
                background-color: #D35400;
                text-decoration: none;
            
            }
            
            .amnt-select{
                 outline: none;
                border: 1px solid #cdcdcd;
                border-color: rgba(0,0,0,.15);
                background-color: white;
                font-size: 16px;
                width: 25%;
            }

            .checkout {
                background-color: #D35400;
                border-radius: 12px;
                color: #FFF;
                transition-property: background-color, color;
                transition-duration: 0.5s;
                transition-timing-function: ease;
                margin-top: 10px;
            }

            .checkout:hover{
                color: #FFF;
                background-color: #22425e;
                text-decoration: none; 
            }

            .priceDisplay{
                color: black;
                background-color: white;
                float: left;
                margin-left: 1%;
                bottom:400px;
                width: 140px;
                display:inline-block margin-left;
                position: fixed;
                border-radius: 12px;

            }
            .checkButton{
                margin-left: 27px;
            }
            
           
           
        
        </style>
        <!--main navbar-->
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
                        <li><div class="input group">
                </div>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <hr class="separator">
        
        <br/><br/>
        
        
        
        
        
        
        
        <div id="home">
            <div class="priceDisplay">
            <p style="text-indent: 1.7em;"><strong>Total of cart</strong></p>
            <p style="text-indent: 0.8em;"> R: <?php 
                echo $total; ?></p>
            <form class="checkButton" action="" method="post">
                <button class="checkout"  type="submit" name="checkout" class="btn">Checkout</button>
            </form>
            </div>
            
                <?php 
                include 'php/storeIn.php';
                
                function addItem($result){
    
   
   //display database entries on store page

    while($row = mysqli_fetch_object($result)) {
        
        
        
                   
                ?>
                <div class="product">
                <div class="col-sm-3">
                        <img src="img/logo2.png">
                    </div>
                <div class="col-sm-7 text-center">
                <div class="product-name" name="pName">
                    <strong><?php echo $row->productName; ?></strong>
                    <p>SKU: <?php echo $row->productID; ?></p>
                    <hr>
                </div>
                <div class="product-desc"><p><?php echo $row->productDesc; ?> </p>
                    </div>
                <div class="product-price" name="pPrice">
                    <p>R<?php echo $row->productPrice; ?></p>
                </div>
                </div>
                <div class="col-sm-2">
                    <form action="store.php?action=add&id=<?php echo $row->productID; ?>" method="post">
                        <input title="Click to add to cart" type="submit" value="add" class="btnAdd" name="addToCart" />
                        <input class="amnt-select" type="text" name="quantity" value="1" size="2"  />
                        <input type="hidden" value="<?php echo $row->productName; ?>" name="pName">
                        <input type="hidden" value="<?php echo $row->productPrice; ?>" name="pPrice">
                    </form>
                    
                    
                </div>
                
            </div>
            
            <?php
                    }
                }
        ?>
        </div>
        
        
        
        
        
        
        
        <!--Modal declaration-->
            
            <div class="bg-modal">
                <div class="modal-content">
                    <div class="close" id="close">+</div>
                    <form action="./php/login.php" method="post">
                        <img src="img/fire.png" style="width: 4em; height: 4em;">
                        <input name="email" id="logBox" type="text" placeholder="Email">
                        <input name="password" id="logBox" type="password" placeholder="Password">
                        <input type="submit" class="loginButton" value="Submit">
                        <br>
                        <p><strong>Don't have an account yet? </strong></p>
                        <p><strong>Your next great adventure is a <a href="regForm.php">Click</a> away </strong></p>
                    </form>
                </div>
            </div>
        <script src="JS/Script.js" type="text/javascript"></script>
      
    </body>
</html>
