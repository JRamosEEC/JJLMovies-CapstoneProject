<?php
    session_start();

    require (__DIR__ . "/../../Backend/dbQuery.php");

    $userData = getUser($_SESSION['user']);
    $userFollowers = getFollowerCount($_SESSION['user']);
    $userFollowing = getFollowingCount($_SESSION['user']);
    
    foreach($userData as $user){
        //getting the user information from the table and storing into session variables to display on pages
        $Username = $user['Username'];
        $fName = $user['FirstName'];
        $lName = $user['LastName'];
        $profileImg = $user['ProfileImg'];
        
    }
    $id = ($_SESSION['user']);
    echo $id;
    $movies=getUserMovie($id);
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
                <div class="row no-margin">
                    <div id="itemContainer" class="col-xl-3"> 
                        <div class="row"> 
                            <div id="profileIMG" class="col-12 d-flex justify-content-center profileItem">
                                <img src="<?php if($profileImg != NULL){ echo $profileImg; } else{echo "/images/profile-icon-logged-out.png";}?>" width="170px" height="170px"; >
                            </div>

                            <div class="col-12">
                                <div id="profileUsername" class="col-12 d-flex justify-content-center">
                                    <?php echo $Username ?>
                                </div>

                                <div id="profileName" class="col-12 d-flex justify-content-center">
                                    <?php echo $fName ?>
                                    <?php echo $lName ?>
                                </div>

                                <div id="profileFollowers" class="col-12 d-flex justify-content-center">
                                    <div class="row" style="width: 100%;">
                                        <div class="col-6">
                                            <div class="row d-flex justify-content-center">Followers</div>

                                            <div class="row d-flex justify-content-center"><?php echo $userFollowers ?></div>
                                        </div>
                                    
                                        <div class="col-6">
                                            <div class="row d-flex justify-content-center">Following</div>

                                            <div class="row d-flex justify-content-center"><?php echo $userFollowing ?></div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div id="profileaddMovie" class="col-12 d-flex justify-content-center">
                                    <a href="/Frontend/UserProfile/MoviePageCRUD.php" class="btn btn-primary">Create Movie</a>
                                </div>
                                <br>
                                <div id="profileLogout" class="col-12 d-flex justify-content-center">
                                    <a href="/Frontend/Login-Signup/logoutPage.php" class="btn btn-primary">Log Out</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7" id="itemContainer">
                        <div class="row">
                            <?php foreach($movies as $row) :?>
                                <div id="moveItem" class="col-4 row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <img src=<?php echo $row['CoverIMG'];?> id="trendImg" width="150px"; height="225px"; >
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-center">  
                                        <div class="row" id="itemContainer">  
                                            <div class="col">  
                                                Title: <?php echo $row['MovieTitle'];?>
                                            </div>

                                            <div class="col">  
                                                Rating: <?php echo $row['LikeCount'];?>
                                            </div>
                                        </div>
                                    </div>                
                                </div>             
                            <?php endforeach ?>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
</body>
</html>