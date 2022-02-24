<div id="fadeLayer"></div>

<nav id="sidebar">
    <div id="sidebarHeader" class="row no-margin">
        <div class="col no-margin no-pad">
            <a id="sidebarCollapseNav" class="btn btn-primary"><i class="fa-solid fa-bars"></i></a>
        </div>

        <a href="/Frontend/MoviePage/homePage.php" class="col no-margin"><img id='navIcon' class="text-center no-pad col" src="/images/logo-icon.png"></a>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="/Frontend/MoviePage/homePage.php" class="row current-page no-marginR"><img id='navIcon' class="text-center no-pad col" src="/images/home-icon.png"><img id='navArrow' class="text-center col" src="/images/right-arrow.png"></a>
        </li>
        <li>
            <a href="/Frontend/MoviePage/highlightsPage.php" class="row no-marginR"><img id='navIcon' class="text-center no-pad col" src="/images/highlights-icon.png"><img id='navArrow' class="text-center col" src="/images/right-arrow.png"></a>
        </li>
    </ul>
</nav>

<script>
    $(document).ready(function () {

    $('#sidebarCollapseNav').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#fadeLayer').toggleClass('active');
    });
    });
</script>