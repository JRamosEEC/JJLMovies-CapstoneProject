<?php
    require (__DIR__ . "/dbQuery.php");

    $inventoryData = getInventory();
    $invCategories = getCategories();

    $id = $_GET['id'] ?? '';
    $name = $_GET['name'] ?? '';
    $qty = $_GET['qty'] ?? '';
    $category = $_GET['category'] ?? '';
    $price = $_GET['price'] ?? '';
    $action = $_GET['action'] ?? '';

    $nameChecked = '';
    $qtyChecked = '';
    $categoryChecked = '';
    $priceChecked = '';

    if($action == 'update')
    {
        if(!is_numeric($name) || $name == ''){
            $nameChecked = $name;
        }
        else{
            $nameChecked = "Must be a string";
        }

        if(is_numeric($qty) || $qty == ''){
            $qtyChecked = $qty;
        }
        else{
            $qtyChecked = "Must be a number";
        }

        if(!is_numeric($category) || $category == ''){
            $categoryChecked = $category;            
        }
        else{
            $categoryChecked = "Must be a string";
        }

        if(is_numeric($price) || $price == ''){
            $priceChecked = $price;
        }
        else{
            $priceChecked = "Must be a number";
        }

        if(!is_numeric($name) && is_numeric($qty) && !is_numeric($category) && is_numeric($price) && $category != '' && $name != '')
        {
            updateInventory($id, $name, $qty, $category, $price);
            header("Location: inventoryPage.php");
            exit();
        }
    }
    elseif($action == 'add')
    {
        if(!is_numeric($name) || $name == ''){
            $nameChecked = $name;
        }
        else{
            $nameChecked = "Must be a string";
        }

        if(is_numeric($qty) || $qty == ''){
            $qtyChecked = $qty;
        }
        else{
            $qtyChecked = "Must be a number";
        }

        if(!is_numeric($category) || $category == ''){
            $categoryChecked = $category;            
        }
        else{
            $categoryChecked = "Must be a string";
        }

        if(is_numeric($price) || $price == ''){
            $priceChecked = $price;
        }
        else{
            $priceChecked = "Must be a number";
        }

        if(!is_numeric($name) && is_numeric($qty) && !is_numeric($category) && is_numeric($price) && $category != '' && $name != '')
        {
            addInventory($name, $qty, $category, $price);
            header("Location: inventoryPage.php");
            exit();
        }
    }
    elseif($action == 'delete' && $id != '')
    {
        delInventory($id);
        header("Location: inventoryPage.php");
        exit();
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
                    <a href="salesPage.php?id=None" class="row no-marginR"><img id='navIcon' class="text-center no-pad col" src="images/sales-icon.png"><p class="text-center no-margin col">Sales</p><img id='navArrow' class="text-center col" src="images/right-arrow.png"></a>
                </li>
                <li>
                    <a href="inventoryPage.php" class="row current-page no-marginR"><img id='navIcon' class="text-center no-pad col" src="images/inventory-icon.png"><p class="text-center no-margin col">Inventory</p><img id='navArrow' class="text-center col" src="images/right-arrow.png"></a>
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
                    Inventory
                </div>

                <div id="spacer" class="col-4"></div>
            </div>

            <div id="invFieldsContainer" class="row no-marginL">
                <div class="row col-6 no-marginL">
                    <div id="fieldDesc" class="col-6">Category: </div>
                    <div id="fieldInvCat">
                        <select>
                            <option value="" disabled selected hidden>Select Category</option>
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

            <div id="invContainer" class="row no-marginL">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($inventoryData as $key => $value): ?>
                            <?php if($id == $value['productId'] && $qtyChecked == '') {$qtyChecked = $value['quantity'];} ?>
                            <?php if($id == $value['productId'] && $priceChecked == '') {$priceChecked = $value['price'];} ?>
                            <?php if($id == $value['productId'] && $nameChecked == '') {$nameChecked = $value['name'];} ?>
                            <?php if($id == $value['productId'] && $categoryChecked == '') {$categoryChecked = $value['category'];} ?>
                            <?php if($id != $value['productId']){echo '<tr><td>' . $value['productId'] . '</td><td>' . $value['quantity'] . '</td><td>$' . $value['price'] . '</td><td>' . $value['name'] . '</td><td>' . $value['category'] . '</td><td class="center"><a href="inventoryPage.php?id=' . $value['productId'] . '" style="text-decoration: none;"><i class="icon-pencil fa-w-10 fa-2x"></i></a></td></tr>';}else{echo '<tr><td name="idtxt">' . $value['productId'] . '</td><td><input type="text" name="qtytxt" value="' . $qtyChecked . '"></td><td><input type="text" name="pricetxt" value="' . $priceChecked . '"></td><td><input type="text" name="nametxt" value="' . $nameChecked . '"></td><td><input type="text" name="categorytxt" value="' . $categoryChecked . '"></td><td class="center"><a id="updateSubmit" href="inventoryPage.php" onclick="return updateSubmit();" style="text-decoration: none;"><i class="fas fa-check-square fa-w-10 fa-2x"></i></a></td></tr>';} ?>
                        <?php endforeach; ?>

                        <?php if($action == 'add'){echo '<tr><td name="idtxt">N/A</td><td><input type="text" name="qtytxt" value="' . $qtyChecked . '"></td><td><input type="text" name="pricetxt" value="' . $priceChecked . '"></td><td><input type="text" name="nametxt" value="' . $nameChecked . '"></td><td><input type="text" name="categorytxt" value="' . $categoryChecked . '"></td><td class="center"><a id="updateSubmit" href="inventoryPage.php" onclick="return addSubmit();" style="text-decoration: none;"><i class="fas fa-check-square fa-w-10 fa-2x"></i></a></td></tr>';} ?>
                    </tbody>
                </table>
            </div>

            <div id="invContainerButtons" class="row no-marginL">
                <div id="spacer" class="col-9"></div>
                <div id="invButtonAdd" class="col-1"><a href="inventoryPage.php?action=add" ><i class="fas fa-plus-square fa-3x"></i></a></div>
                <div id="<?php if($id == ''){echo 'invButtonDelete';}else{echo 'invButtonDeleteActive';} ?>" class="col-1"><a href="<?php if($id == ''){echo '';}else{echo 'inventoryPage.php?action=delete&amp;id=' . $id;} ?>"><i class="fas fa-trash-alt fa-3x"></i></a></div>
                <div id="spacer" class="col-1"></div>
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

        function updateSubmit() {
            var link = document.getElementById("updateSubmit");

            var id = document.getElementsByName("idtxt")[0].innerHTML;
            var qty = document.getElementsByName("qtytxt")[0].value;
            var name = document.getElementsByName("nametxt")[0].value;
            var price = document.getElementsByName("pricetxt")[0].value;
            var category = document.getElementsByName("categorytxt")[0].value;

            link.setAttribute('href', 'inventoryPage.php?id=' + id + '&qty=' + qty + '&price=' + price + '&name=' + name + '&category=' + category + '&action=update');
        }

        function addSubmit() {
            var link = document.getElementById("updateSubmit");

            var qty = document.getElementsByName("qtytxt")[0].value;
            var name = document.getElementsByName("nametxt")[0].value;
            var price = document.getElementsByName("pricetxt")[0].value;
            var category = document.getElementsByName("categorytxt")[0].value;

            link.setAttribute('href', 'inventoryPage.php?qty=' + qty + '&price=' + price + '&name=' + name + '&category=' + category + '&action=add');
        }
    </script>
</body>

</html>