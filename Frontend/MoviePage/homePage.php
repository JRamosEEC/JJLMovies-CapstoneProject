<?php
    session_start(); 

    require (__DIR__ . "/../../Backend/dbQuery.php");
    $movies = getMovies();
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

    <!--- Elvis - Completed most of the php as of now 2/17/22 and did a large part of the frontend --->

    <!--- Justin I just reworked a lot of the design to more match our impression of the webpage, however it's not finished --->
        <!-- made the inside feed container scrollable while the rest of the page is not --- The nav will stay still and the background image will pop behind the now transparent feed items --->

    <div class="wrapper">
        <!-- Sidebar -->
        <?php include(__DIR__ . "/../Blueprints/navDynamicBlueprint.php")?>
        <?php include(__DIR__ . "/../Blueprints/headerBlueprint.php")?>
        <?php 
                if(isset($_POST['submit'])){
                    $MovieTitle=filter_input(INPUT_POST,'headerSearch');
                    $movieSearch=searchMovie($MovieTitle);
                }
        
        ?>

        <div id="bodyContainer">
            <!-- Static Sidebar -->
            <?php include(__DIR__ . "/../Blueprints/navStaticBlueprint.php")?>

            <!-- Page Content -->
            <div id="content">    
                <div id="pageContainer">
                    <?php foreach ($movies as $row): ?>
                        <div id="feedItem" class="row no-margin no-pad">
                            <div class="col-sm">
                                <div class="row">
                                    <div id="feedComponentMovieImg" class="col-auto no-pad">
                                        <img src=<?php echo $row['CoverIMG']; ?> width=145px;> <!--- it's be width x height in html not length but for now to avoid stretching images let them size themselvs --->
                                    </div>

                                    <div id="feedComponentMovieDetailsContainer" class="col-auto ml-4">
                                        <div id="feedComponentDetails" class="row">
                                            <strong>Creator :</strong><div> &nbsp;<?php echo $row['CreatorName']?></div>
                                        </div>

                                        <div id="feedComponentDetails" class="row">
                                            <strong>Movie :</strong><div> &nbsp;<?php echo $row['MovieTitle'];?></div>
                                        </div>

                                        <div id="feedComponentDetails" class="row">
                                            <strong>Rating :</strong><div> &nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="detail" class="col-sm no-pad p-3">
                                <h2><strong>Description</strong></h2>
                                <br>
                                <p><?php echo $row['MovieDescription'];?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>           
                </div>
            </div>
        </div>
    </div>
</body>
</html>