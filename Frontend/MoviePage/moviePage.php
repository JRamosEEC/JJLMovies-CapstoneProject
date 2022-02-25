<?php
    require (__DIR__ . "/../../Backend/dbQuery.php");
    $id=$_GET['id'] ?? -1;
    $details=getOneMovie($id);
    $userdetails=userPK();
?>
<?php 
    foreach($userdetails as $r){
        $userID=$r['userAccountID'];//getting the userAccount id from the accounts table
    }
    
    if(isPostRequest()){
        $userAccountID=$userID;//adding user id to the review tables 
        $movieID=$id;
        $ReviewDescription = filter_input(INPUT_POST, 'txtReview');
        $ReviewLikes=filter_input(INPUT_POST, 'txtRates');
        addReview($userAccountID,$movieID,$ReviewDescription,$ReviewLikes);
    };      //adds value to function when the page posts
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
    <script>
        document.getElementById("btnReview").addEventListener("click", function(){
             toggl
             });
    </script>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>

    <div class="wrapper">
        <!-- Sidebar -->
        <?php include(__DIR__ . "/../Blueprints/navDynamicBlueprint.php")?>

        <!-- Page Content -->
        <div id="content" method="POST">
            <?php include(__DIR__ . "/../Blueprints/headerBlueprint.php")?>
            
            <?php foreach($details as $row) :?>
                <div class="row">
                    <div class="col-xl-4">
                        <img src=<?php echo $row['CoverIMG'];?> id="trendImg" width=275px height="390px"; >
                    </div>
                    
                    <div class="col-xl-8">  
                        <div class="row" id="itemContainer2">  
                            <div class="col">  
                                    Title: <?php echo $row['MovieTitle'];?>
                            </div>

                            <div class="col">  
                                    Creator: <?php echo $row['CreatorName'];?>
                            </div>

                            <div class="col">  
                                    Rating: <?php echo $row['LikeCount'];?>
                            </div>
                        </div>

                        <div class="row" id="itemContainer2">
                                <h2 style="width:100%">Description</h2>

                                <p style="width:100%"><?php echo $row['MovieDescription']; ?></p>
                        </div>
                    </div>               
                         <!--- it's be width x height in html not length but for now to avoid stretching images let them size themselvs --->
                </div>
                
                    <div id="itemContainer2">
                        <h2>Reviews<h2>
                            
                            <form method="post" class="col-8">
                                <input id="btnReview" class="btn btn-primary" type="button" value="Write A Review" name="btnReview">

                                <input id="txtReview" type="text" style="width:100%;">

                                <input id="txtRates" type="text" style="
                                width:100%;"
                                >
                            </form>
                        
                    </div>
                

                <?php endforeach ?>
        </div>
    </div>  
</body>
</html>