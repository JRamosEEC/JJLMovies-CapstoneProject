<?php
    require (__DIR__ . "/../../Backend/dbQuery.php");

    $action = $_GET['action'] ?? '';
    $btnString = "test";

    if ($action == "add") {
        $btnString = "Create";
    } 
    
    else if ($action == "edit"){
        $btnString = "Update";
    }

    else{
        $btnString = "Delete";
    }

    $movieTitle = filter_input(INPUT_POST, 'movieTitle');
    $movieIMG = filter_input(INPUT_POST, 'movieIMG');
    $movieBanner = filter_input(INPUT_POST, 'movieBanner');
    $movieDescripton = filter_input(INPUT_POST, 'movieDescripton');
    $movieGenre = filter_input(INPUT_POST, 'movieGenre');
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
                <div id="AddEditMovie" class="row center no-margin no-padL">
                    <div id="spacer" class="col-3"></div>

                    <div id="signupContainer" class="col-6">
                        <form action='MoviePageCRUD.php' method='post'>
                            <div class="form-group">
                                <label  for="exampleFormControlInput1">Movie Title</label>
                                <input name="movieTitle" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" value="<?php echo $movieTitle; ?>">
                            </div>

                            <label class="form-label" for="customFile">Upload Movie Image</label>
                            <input name='movieIMG' type="file" class="form-control" id="customFile" value="<?php echo $movieIMG; ?>" />

                            <label class="form-label" for="customFile">Upload Banner Image</label>
                            <input name='movieBanner' type="file" class="form-control" id="customFile" value="<?php echo $movieBanner; ?>" />

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Movie Description</label>
                                <textarea name='movieDescripton' class="form-control" id="exampleFormControlTextarea1" rows="3" value="<?php echo $movieDescripton; ?>"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Genre Select</label>
                                <select name='movieGenre' class="form-control" id="exampleFormControlSelect1" value="<?php echo $movieGenre; ?>">
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

                            <div class="row">
                                <button name='submitBtn' type="submit" class="btn btn-primary"><?php echo $btnString?> </buton>
                            </div>
                        </form>
                    </div>

                    <div id="spacer" class="col-3"></div>


                    <?php

                        if(isset($_POST['submitBtn'])){


                        
                            // $status = $statusMsg = ''; 

                            // if(isset($_POST["submit"])){ 


                            //     $status = 'error'; 
                                
                            //     if(!empty($_FILES["movieIMG"]["name"])) { 

                                    
                            //         $fileName = basename($_FILES["movieIMG"]["name"]); 

                            //         $fileType = pathinfo($fileName, PATHINFO_EXTENSION
                            //     ); 
                                    
                            //         // Allow certain file formats 
                            //         $allowTypes = array('jpg','png','jpeg','gif'); 
                            //         if(in_array($fileType, $allowTypes)){ 
                            //             $image = $_FILES['movieIMG']['tmp_name']; 
                            //             $imgContent = addslashes(file_get_contents($image)); 
                                    
                            //             // Insert image content into database 
                            //             //  $insert = $db->query("INSERT into images (image, created) VALUES ('$imgContent', NOW())"); 
                                        
                            //             if($insert){ 
                            //                 $status = 'success'; 
                            //                 $statusMsg = "File uploaded successfully."; 
                            //             }else{ 
                            //                 $statusMsg = "File upload failed, please try again."; 
                            //             }  
                            //         }else{ 
                            //             $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                            //         } 
                            //     }else{ 
                            //         $statusMsg = 'Please select an image file to upload.'; 
                            //     } 
                            // } 
                            
                            // // Display status message 
                            // echo $statusMsg; 






                            $error = 0;


                            $movieTitle = filter_input(INPUT_POST, 'movieTitle');

                            if(strlen($movieTitle) <= 5)
                            {

                                echo"<br>Please make the title at least 5 characters!";
                                $error = 1;
                            }
                            else{

                                $error = 0;
                            }

                            if($error = 0)
                            {
                                $likeCount = 0;
                                $DatePosted = NOW();

                                $useraccountId = 1;
                                $isApproved = 0;
                                
                                $results = addMovie($movieTitle, $DatePosted, $movieGenre, $movieDescripton, $creatorName, $movieIMG, $movieBanner, $likeCount, $isApproved, $useraccountId);
                                

                                if(isPostRequest()){
                                    echo "Movie added";
                                }



                            }
                            else{

                                echo '<br>please fix errors';
                                
                            }

                        }


                    ?>
                </div>

                
                <div id="DeleteMovie" class="row center no-margin no-padL">
                    <div id="spacer" class="col-3"></div>

                    <div id="signupContainer" class="col-6">
                        <form action='MoviePageCRUD
                        .php' method="post">
                            <div>movie title</div>

                            <div>movie img</div>

                            <div class="col-sm-6">
                                <button name='deletebtn'type="submit" class="btn btn-primary">Delete Movie</button>
                            </div>
                        </form>
                    </div>

                    <div id="spacer" class="col-3"></div>

                    <?php

                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Something posted 
                            echo "This is a test" ; 
                        
                            if (isset($_POST['btnDelete'])) {
                                echo "Your movie has been deleted " ;
                            } else {
                                // Assume btnSubmit
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>
