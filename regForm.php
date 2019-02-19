<?php
    session_start();


    $db = new mysqli("localhost", "root", "", "ecteamfox");



    //check if the email already exists
    function checkDB($db, $email, $password_1, $password_2){
        $result = $db->query("select * from users where email='".$email."'");
        
        //Get the objects contained in the table if any
        $user = $result->fetch_object();
        
        //does the email address exist?
        if ($result->num_rows == 0){
            //if doesn't exist call addUser function
            addUser($db, $email, $password_1, $password_2);
        } else {
            echo '<script type="text/javascript">
                    window.onload = function () { alert("An account with that email already exists"); }
            </script>';
        }

    }


    function addUser($db, $email, $password_1, $password_2){
        //add user to DB
        if ($password_1 == $password_2){
            //create user
            $password_1 = md5($password_1);
            $sql = "INSERT INTO USERS (email, password) VALUES ('".$email."', '".$password_1."')";
            mysqli_query($db, $sql) or die(mysqli_error());
            //$_SESSION['message'] = "Logged in";
            echo '<script type="text/javascript">
                    window.onload = function () { alert("Registered successfully"); }
            </script>';


        } else {
            //failed
            //$_SESSION['message'] = "The two passwords do not match";
            echo '<script type="text/javascript">
                    window.onload = function () { alert("Passwords do not match"); }
            </script>';
        }
    }

    if(isset($_POST{'register'})){
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
        //pass to check db function
        checkDB($db, $email,$password_1, $password_2);


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
        *{
            margin: 0
            padding: 40px;
        }
        body{
            background: url(img/camping.png);
            background-position: center;
            background-size: cover;
        }

        .form-wrap{
            width: 320px;
            background: #FFF;
            padding: 10px 20px;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border-radius: 12px;

        }

        .btn{
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

        .btn:hover{
            color: #FFF;
            background-color: #D35400;
            text-decoration: none;
        }

        footer {
            width: 100%;
            background-color: #23415C;
            padding: 5% 5% 6% 5%;
            color: #FFF;
        }
        .alert-error {
            color: #f00;
            background-color: #360e10;
            box-shadow: 0 0 0 1px #551e21 inset, 0 5px 10px rgba(0, 0, 0, 0.75);
        }
        .alert:empty{
            display: none;
        }
        .alert-success {
            color: #21ec0c;
            background-color: #15360e;
            box-shadow: 0 0 0 1px #2a551e inset, 0 5px 10px rgba(0, 0, 0, 0.75);
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
                        
                        <li><a href="#" class="action-button shadow animate" >About</a> </li>
                        <?php if( ! isset($_SESSION['TeamFox'])) { ?>
                        <li><a href="#" id= "logButton" class="action-button shadow animate">Login</a></li>
                        <?php } else { ?>
                        <li><a href="account.html" class="action-button shadow animate">Account</a></li>
                        <li><a href="php/logout.php" class="action-button shadow animate">Logout</a> </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <p><?php $_SESSION['message'] ?></p>
        <div class="form-wrap">
            <form method="post" action="regForm.php">

                <div class="input group">
                    <label>Email</label>
                    <input type="text" name="email" required>
                </div>
                <div class="input group">
                    <label>Password</label>
                    <input type="password" name="password_1" required>
                </div>
                <div class="input group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_2" required>
                </div>
                <div class="input group">
                    <button type="submit" name="register" class="btn">Register</button>
                </div>
                <p>Already a member?<a href"#" id="logButton">Login</a></p>
            </form>
        </div>

    <!--modal-->
    <div class="bg-modal">
        <div class="modal-content">
            <div class="close" id="close">+</div>
            <form action="./php/login.php" method="post">
                <img src="img/fire.png" style="width: 4em; height: 4em;">
                <input name="username" id="logBox" type="text" placeholder="Email">
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