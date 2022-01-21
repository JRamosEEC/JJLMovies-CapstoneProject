<?php
    require (__DIR__ . "/dbQuery.php");

    $salesData = getSales();
    $entityData = getEntity();

    $companyName = $entityData[0]['name'];

    $sales = 0;

    if (count($salesData) > 0)
    {
        foreach ($salesData as $value)
        {
            $sales += $value['totalCost'];
        }
    }
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
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="text-center">Navigation</h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="" class="row current-page no-marginR"><img id='navIcon' class="text-center no-pad col" src="images/home-icon.png"><p class="text-center no-margin col">Home</p><img id='navArrow' class="text-center col" src="images/right-arrow.png"></a>
                </li>
                <li>
                    <a href="salesPage.php?id=None" class="row no-marginR"><img id='navIcon' class="text-center no-pad col" src="images/sales-icon.png"><p class="text-center no-margin col">Sales</p><img id='navArrow' class="text-center col" src="images/right-arrow.png"></a>
                </li>
                <li>
                    <a href="inventoryPage.php" class="row no-marginR"><img id='navIcon' class="text-center no-pad col" src="images/inventory-icon.png"><p class="text-center no-margin col">Inventory</p><img id='navArrow' class="text-center col" src="images/right-arrow.png"></a>
                </li>
                <li id='copyrights'>
                    © Justin Ramos
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <div id="title" class="row header centerV no-marginL">
                <nav class="transparent centerV no-padL navbar-expand-lg navbar-light bg-light col-4">
                    <button type="button" id="sidebarCollapse" class="btn btn-info centerV">
                        &#8249;
                    </button>
                </nav>

                <div class="header center col-4">
                    Home
                </div>

                <div id="spacer" class="col-4"></div>
            </div>

            <div class="row no-marginL">
                <div id="companyName" class="col-12 text-center">
                    <?php echo $companyName; ?>
                </div>
            </div>

            <div class="row no-marginL">
                <div id="salesFigures" class="col-6">
                    <div class="text-center"><?php echo count($salesData); ?></div>
                    <div class="text-center">Products Sold</div>
                </div>

                <div id="salesFigures" class="col-6">
                    <div class="text-center">$<?php echo $sales; ?></div>
                    <div class="text-center">Total Revenue</div>
                </div>
            </div>
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