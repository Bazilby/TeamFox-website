<?php
 session_start();
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
            .sendForm{
                width: 550px;
            background: #FFF;
            padding: 10px 20px;
            position: static;
            left: 50%;
            top: 50%;
            border-radius: 12px;
            border: solid black;
            }
            
            input[type = text]{
                border: 1px solid #000;
                width: 200px;
                padding: 1px;
                font-size: 20px;    
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
                        <li><a href="myCart.php" class="action-button shadow animate">My Cart</a></li>
                        <li><a href="php/logout.php" class="action-button shadow animate">Logout</a> </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div id="home">
            
            <div class="landing-text">
              
                <h1>SHOP</h1>
                <h3>Let's go camping!</h3>
                <br>
                <a href="regForm.php" class="btn btn-default btn-lg">Get Started</a>
                
            </div>
        </div>
        <hr>
        <div class="padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img src="img/Camp.png">
                </div>
                <div class="col-sm-6 text-center">
                    <h3><strong>We're here to supply your next great adventure.</strong></h3>
                    <hr>
                    <!--<p class="lead"><?php print($_SESSION["TeamFox"]);?></p>-->
                    <p><strong>Whether you're escaping the city for a weekend getaway, or planning a transcontinental expedition, we can
                            help you find the right gear for your journey.<br><br> We are dedicated to supplying high quality gear and exceptional service, so that you never feel </strong></p>
                    <br>
                    <p>Visit our store and browse a wide range of quality gear for the right adventure.</p>
                </div>
            </div>    
        </div>
        </div>
        <hr style="margin: 0px;">
        <div class="padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-center" style="margin-top: 0px;">
                    <h2><strong>The right service</strong></h2>
                    <p>If you require service on any of your vehicles, including the manufacturing of bespoke solutions, fill out our form with work required and we'll get back to you with a quotation</p>
                    <form action="7h6sv1m77@educationgroup.co.za" method="post" enctype="text/plain">
                       <div class="sendForm"> 
                           Name:<br>
                            <input type="text" name="name"><br>
                            E-mail:<br>
                            <input type="text" name="mail"><br>
                            Vehicle Make and Model:<br>
                            <input type="text" name="type"><br>
                            Description of work needed:<br>
                            <input type="text" name="comment" size="50"><br><br>
                            <input type="submit" value="Send">
                            <input type="reset" value="Reset">
                       </div>
                </form>
                </div>
               
                <div class="col-sm-6">
                    <img src="img/work.png" style="padding-top: 110px;" >
                </div>
            </div>    
        </div>
        </div>
        
        <footer class="container-fluid text-center">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Contact Us</h3>
                    <br>
                    <h4>Have a question? <a href="mailto:7h6vs1m77@educationgroup.co.za">Email Us</a></h4>
                </div>
                <div class="col-sm-6">
                    <h3>Find Us</h3>
                    <br>
                    <a href="https://goo.gl/maps/6FMh7coE6MC2" target="_blank">See you soon</a>
                </div>
            </div>

        
        </footer>
        <!--Modal declaration-->
            
            <div class="bg-modal">
                <div class="modal-content">
                    <div class="close" id="close">+</div>
                    <form action="php/login.php" method="post">
                        <img src="img/fire.png" style="width: 4em; height: 4em;">
                        <input name="email" id="logBox" type="text" placeholder="Email">
                        <input name="password" id="logBox" type="password" placeholder="Password">
                        <input type="submit" name ="submit" class="loginButton" value="Submit">
                        <br>
                        <p><strong>Don't have an account yet? </strong></p>
                        <p><strong>Your next great adventure is a <a href="regForm.php">Click</a> away </strong></p>
                    </form>
                </div>
            </div>
        <script src="JS/Script.js" type="text/javascript"></script>
      
    </body>
</html>
    