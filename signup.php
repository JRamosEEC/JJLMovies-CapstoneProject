<?php
    require (__DIR__ . "/dbQuery.php");
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
    <link rel="stylesheet" href="style.css">
    
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
        <?php include(__DIR__ . "/nav.php")?>

        <!-- Page Content -->
        <div id="content" class="row">
            <?php include(__DIR__ . "/header.php")?>

            <div id="spacer" class="col-4"></div>

            <div id="signupContainer" class="col-4 center">
                <h1>SIGN UP</h1>

                <div>
                    <input type="text" placeholder="Create Username">
                </div>
                <div>
                    <input type="text" placeholder="Create Password">
                </div>
                
                <div>
                    <input type="text" placeholder="Email">
                </div>

                <div>
                    <input type="text" placeholder="Birthday">
                </div>

                <div>
                    <input type="text" placeholder="First Name">
                </div>

                <div>
                    <input type="text" placeholder="Last Name">
                </div>
                <div>
                    <input type="button" value="Create Account">
                </div>
            </div>

            <div id="spacer" class="col-4"></div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');

            var element = document.getElementById('sidebarCollapse');
            var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;

            if (width > 768){
                if($('#sidebar').attr("class")){
                    element.innerHTML = '&#8250;';
                }
                else{
                    element.innerHTML = '&#8249;';
                }
            }
            else{
                if($('#sidebar').attr("class")){
                    element.innerHTML = '&#8249;';
                }
                else{
                    element.innerHTML = '&#8250;';
                }
            }
        });

        var width = $(window).width();
        $(window).on('resize', function() {
            if ($(this).width() !== width) {
                width = $(this).width();

                var element = document.getElementById('sidebarCollapse');

                if (width < 768){
                    if($('#sidebar').attr("class")){
                        element.innerHTML = '&#8249;';
                    }
                    else{
                        element.innerHTML = '&#8250;';
                    }
                }
                else{
                    if($('#sidebar').attr("class")){
                        element.innerHTML = '&#8250;';
                    }
                    else{
                        element.innerHTML = '&#8249;';
                    }
                }
        }
        });

        });
    </script>
</body>
</html>