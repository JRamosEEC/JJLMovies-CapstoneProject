<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="/Frontend/MoviePage/homePage.php" class="row no-marginR"><img id='navIcon' class="text-center no-pad col" src="/images/logo-icon.png"></a>
            <h3 class="text-center">Navigation</h3>
            
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="/Frontend/MoviePage/homePage.php" class="row current-page no-marginR"><img id='navIcon' class="text-center no-pad col" src="/images/home-icon.png"><img id='navArrow' class="text-center col" src="/images/right-arrow.png"></a>
            </li>
            <li>
                <a href="/Frontend/MoviePage/highlightsPage.php" class="row no-marginR"><img id='navIcon' class="text-center no-pad col" src="/images/highlights-icon.png"><img id='navArrow' class="text-center col" src="/images/right-arrow.png"></a>
            </li>
            <li id='copyrights'>
                © Justin Ramos
            </li>
        </ul>
    </nav>

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

