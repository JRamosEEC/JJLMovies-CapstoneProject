<?php
    require (__DIR__ . "/dbQuery.php");

    $inventoryData = getInventory();
    $invCategories = getCategories();

    $action = $_GET["action"] ?? '';
    $id = $_GET["id"] ?? '';

    if($action == 'bought')
    {
        foreach($inventoryData as $key => $value)
        {
            if($value['productId'] == $id)
            {
                $price  = $value['price'];
                $tax = $value['price']*0.0625;

                $qty = $value['quantity'];
            }
        }

        if($qty >0)
        {
            addSales($id, '3', '0', $tax, $price);
            header("Location: salesPage.php?id=None");
            exit();
        }
        else
        {
            header("Location: salesPage.php?id=None");
            exit();
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
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
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
                    <a href="homePage.php" class="row no-marginR"><img id='navIcon' class="text-center no-pad col" src="images/home-icon.png"><p class="text-center no-margin col">Home</p><img id='navArrow' class="text-center col" src="images/right-arrow.png"></a>
                </li>
                <li>
                    <a href="salesPage.php?id=None" class="row current-page no-marginR"><img id='navIcon' class="text-center no-pad col" src="images/sales-icon.png"><p class="text-center no-margin col">Sales</p><img id='navArrow' class="text-center col" src="images/right-arrow.png"></a>
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
                    Sales
                </div>

                <div id="spacer" class="col-4"></div>
            </div>

            <div class="row no-marginL">
                <div id="salesContainerL" class="row col-6 no-marginL">
                    <div class="row col-6">
                        <div id="fieldDesc" class="col-6">Category: </div>
                        <div id="fieldInvCat">
                            <select>
                                <option value='id'>ID</option>
                                <option value='qty'>Quantity</option>
                                <option value='name'>Name</option>
                                <option value='category'>Category</option>
                            </select>
                        </div>
                    </div>

                    <div class="row col-6 no-margin no-pad">
                        <div id="fieldDesc" class="col-6">Search: </div>
                        <textarea id="invSearch" rows="1" cols="17" wrap="off" placeholder="Input Search"></textarea>
                    </div>
                </div>

                <div id="salesContainerIcon" class="row col-6 no-marginL align-items-end bottomLine">
                    <img id='salesIcon' class="text-center no-pad col" src="images/cart-icon.png">
                </div>
            </div>

            <div class="row no-marginL">
                <div id="invContainerSales" class="row col-6 no-marginL">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Quantity</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?PHP foreach($inventoryData as $key => $value): ?>
                                <?php echo '<tr><td>' . $value['productId'] . '</td><td>' . $value['quantity'] . '</td><td>' . $value['name'] . '</td><td>' . $value['category'] . '</td><td class="centerIcon"><a href="salesPage.php?id=' . $value['productId'] . '" style="text-decoration: none;"><i class="fas fa-shopping-basket fa-w-10 fa-2x"></i></a></td></tr>'; ?>
                            <?PHP endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div id="salesContainerR" class="row col-6 no-marginL">
                    <div id="salesHeader" class="row no-marginL">
                        <div class="col-6 text-center">Product ID : <?php foreach($inventoryData as $key => $value){if($value['productId'] == $_GET['id']){echo $value['productId'];}}?></div>
                        <div class="col-6 text-center">Name : <?php foreach($inventoryData as $key => $value){if($value['productId'] == $_GET['id']){echo $value['name'];}}?></div>
                    </div>

                    <div id="salesPrice" class="row no-marginL">
                        <div class="col-12 text-center">Price: $<?php foreach($inventoryData as $key => $value){if($value['productId'] == $_GET['id']){echo $value['price'];}}?></div>
                    </div>

                    <div id="salesDiscount" class="row no-marginL">
                        <div id="salesDiscountName" class="col-5">Discount : </div>
                        <div id="salesDiscountField" class="col-7">
                            <select>
                                <option value="" disabled selected hidden>Select Discount</option>
                                <option value="0">None</option>
                                <option value="1">None</option>
                                <option value="2">None</option>
                            </select>
                        </div>
                    </div>

                    <div id="salesTotals" class="row no-marginL">
                        <div class="col-6 text-center">Tax : $<?php foreach($inventoryData as $key => $value){if($value['productId'] == $_GET['id']){echo $value['price']*0.0625;}}?></div>
                        <div class="col-6 text-center">Total : $<?php foreach($inventoryData as $key => $value){if($value['productId'] == $_GET['id']){echo $value['price']+$value['price']*0.0625;}}?></div>
                    </div>

                    <div id="salesBuyButtonContainer" class="row no-marginL">
                        <div id="buyButton" class="col-12"><a href=<?php if ($_GET["id"] != 'None'){echo '"salesPage.php?action=bought&amp;id=' . $_GET["id"] . '"';} ?>><img id='buyButtonImg' class="text-center" src="images/buy-button.png"></a></div>
                    </div>
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