<div id="fadeLayer"></div>

<nav id="sidebar">
    <div id="topSpacer" class="row no-margin" style="height: 85px; opacity: 0%;"></div>

    <div id="spacerLine" class="row no-margin"></div>

    <ul class="list-unstyled components">
        <li>
            <a href="/Frontend/MoviePage/homePage.php" class="row current-page no-marginR"><img id='navIcon' class="text-center no-pad col" src="/images/home-icon.png"></a>
        </li>
        <li>
            <a href="/Frontend/MoviePage/highlightsPage.php" class="row no-marginR"><img id='navIcon' class="text-center no-pad col" src="/images/highlights-icon.png"></a>
        </li>
    </ul>
</nav>

<script>
    $(document).ready(function () {

    $('#sidebarCollapseBtnNav').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#fadeLayer').toggleClass('active');
    });
    });
</script>