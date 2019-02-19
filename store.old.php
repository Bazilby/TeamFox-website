<?php 

session_start();
    
   $product_IDs = array();

  

   //check if add to cart button submitted
   if (filter_input(INPUT_POST, 'addToCart')) {
       if (isset($_SESSION['shopping_cart'])) {
           
           //keep track of number of products in shopping cart
           $count = count($_SESSION['shopping_cart']);

           //create sequential array for matching array keys to product ids
           $product_IDs = array_column($_SESSION['shopping_cart'], 'id');

           if(!in_array(filter_input(INPUT_GET, 'id'), $product_IDs)){
               //check if product with id already exists
                $_SESSION['shopping_cart'][$count] = array(
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'pName'),
                'price' => filter_input(INPUT_POST, 'pPrice'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );
               
           } else { //if product already exists increase quantity
               //match array key to product added to cart
                foreach ($product_IDs as $value) {
                    if($value == filter_input(INPUT_GET, 'id')){
                       //add item quantity
                       $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
               
               }
           }

       } else { //if shopping cart doesn't create first product with array key 0
        $_SESSION['shopping_cart'][0] = array(
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'pName'),
            'price' => filter_input(INPUT_POST, 'pPrice'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
       }
   }
   pre_r($_SESSION);

   function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
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
                        <li><a href="myCart.php" class="action-button shadow animate">My Cart</a></li>
                        <li><a href="php/logout.php" class="action-button shadow animate">Logout</a> </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <hr class="separator">
        
        <br/><br/>
        
        
        
        
        
        
        
        <div id="home">
            
                <?php 
                include 'php/storeIn.php';
                
                function addItem($result){
    
   
    
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
