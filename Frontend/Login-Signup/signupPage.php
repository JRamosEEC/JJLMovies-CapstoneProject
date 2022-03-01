<?php
    session_start(); 

    require (__DIR__ . "/../../Backend/dbQuery.php");

    $email = filter_input(INPUT_POST, 'email');

    $username = filter_input(INPUT_POST, 'username');

    $password = filter_input(INPUT_POST, 'password');

    $firstName = filter_input(INPUT_POST, 'firstName');

    $lastName = filter_input(INPUT_POST, 'lastName');

    if(isset($_POST['submitBtn'])){

        $error = 1;

        $error1 = 0;

        $error2 = 0;

        $error3 = 0;

        $error4= 0;

        $email = filter_input(INPUT_POST, 'email');

        $username = filter_input(INPUT_POST, 'username');

        $password = filter_input(INPUT_POST, 'password');

        $firstName = filter_input(INPUT_POST, 'firstName');

        $lastName = filter_input(INPUT_POST, 'lastName');


        if(strlen($username) < 7) {

            echo '<br>Please make sure your username is at least 7 characters long.';
            $error1 = 1;
        }
        else{
            $error1 = 0;

            echo strlen($username);
        }



        if(strlen($password) < 6){

            echo '<br>Please make sure your Password is at least 6 characters long.';
            $error2 = 1;
        }
        else{
            $error2 = 0;
        }


        if($firstName == '' && $lastName == ''){

            echo '<br>Please make sure you enter a First and Last name.';


            $error3 = 1;
        }
        else{
            $error3 = 0;
        }

        if($username == 'Fuck' || $username == 'Die' || $username == 'Bitch' || $username == 'Retard' ){


            echo '<br>Please use a family friendly username.';


            $error4 = 1;
        }
        else{
            $error4 = 0;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) && $error1 == 0 && $error2 == 0 && $error3 == 0 && $error4 == 0) 
        {

            $error = 0;

            $protectedPW = hash('sha256', $password . 'secret stuff');

            $results = signUp($username, $protectedPW, $firstName, $lastName, $email);

            header('Location: ../login-signup/loginPage.php');
        
        }
        else{

            echo "<br>Email address '$email' is considered invalid.\n";
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JJL Movie Reviews</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../CSS/style.css">
    
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <style>

    </style>
</head>

<body>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    

    <div class="wrapper">
        <!-- Sidebar -->
        <?php include(__DIR__ . "/../Blueprints/navDynamicBlueprint.php")?>
        <?php include(__DIR__ . "/../Blueprints/headerBlueprint.php")?>

        <div id="bodyContainer">
            <!-- Static Sidebar -->
            <?php include(__DIR__ . "/../Blueprints/navStaticBlueprint.php")?>

            <!-- Page Content -->
            <div id="content">
                <div id="formContainer" class="row center no-margin no-padL">
                    <h1 class="col-12 center">SIGN UP</h1>

                    <div id="spacer" class="col-3"></div>
                    
                    <form action="signupPage.php" method="post" class="col-6">
                        <div class="row">
                            <div id="formField" class="col-xl-6">
                                <div class="row">
                                    <div class="col-12 center">First Name</div>

                                    <div class="col-12 center">
                                        <input type="text" name="firstName" value="<?php echo $firstName; ?>" />
                                    </div>
                                </div>
                            </div>

                            <div id="formField" class="col-xl-6">
                                <div class="row">
                                    <div class="col-12 center">Last Name</div>

                                    <div class="col-12 center">
                                        <input type="text" name="lastName" value="<?php echo $lastName; ?>" />
                                    </div>
                                </div>
                            </div>

                            <div id="formField" class="col-xl-6">
                                <div class="row">
                                    <div class="col-12 center">Username</div>

                                    <div class="col-12 center">
                                        <input type="text" name="username" value="<?php echo $username; ?>" />
                                    </div>
                                </div>
                            </div>

                            <div id="formField" class="col-xl-6">
                                <div class="row">
                                    <div class="col-12 center">Password</div>

                                    <div class="col-12 center">
                                        <input type="password" name="password">
                                    </div>
                                </div>
                            </div>  

                            <div id="formField" class="col-md-12">
                                <div class="row">
                                    <div class="col-12 center">Email</div>

                                    <div class="col-12 center">
                                        <input type="text" name="email"  value="<?php echo $email; ?>" />
                                    </div>
                                </div>
                            </div>  
                            
                            <div id="formField" class="col-md-12 center">
                                <div id="createAcnt" class="center headerBtn col-6">
                                    <!--<a href="/Frontend/Login-Signup/signupPage.php" class="btn btn-primary">Create Account</a>---->

                                    <button name='submitBtn' type="submit" class="btn btn-primary">Create Account</buton>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="spacer" class="col-3"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>