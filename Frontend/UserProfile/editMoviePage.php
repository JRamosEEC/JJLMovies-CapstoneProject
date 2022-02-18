<?php
    require (__DIR__ . "/../../Backend/dbQuery.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramos Inventory Management</title>

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
        <?php include(__DIR__ . "/../Blueprints/navBlueprint.php")?>

        <!-- Page Content -->
        <div id="content">
            <?php include(__DIR__ . "/../Blueprints/headerBlueprint.php")?>

            <div class="row center no-margin no-padL">
                <div id="spacer" class="col-3"></div>

                <div id="signupContainer" class="col-6">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Movie Title</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
                        </div>
                        <label class="form-label" for="customFile">Edit Movie Image</label>
                        <input type="file" class="form-control" id="customFile" />
                        <label class="form-label" for="customFile">Edit Banner Image</label>
                        <input type="file" class="form-control" id="customFile" />
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Edit Movie Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Genre Select</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                            <option>Action</option>
                            <option>Adventure</option>
                            <option>Horror</option>
                            <option>Comedy</option>
                            <option>Family</option>
                            <option>Thriller</option>
                            <option>Drama</option>
                            <option>Science Fiction</option>
                            <option>Romance</option>
                            <option>Western</option>
                            <option>Crime</option>
                            <option>Musical</option>
                            <option>Fantasty</option>
                            </select>
                        </div>



                        <div class="col-6">
                        <button type="submit" class="btn btn-primary">Edit Movie</button>
                        </div>
                    </form>
                </div>

                <div id="spacer" class="col-3"></div>
            </div>
        </div>
    </div>  


</body>
</html>