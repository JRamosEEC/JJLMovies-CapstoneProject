<script src="https://kit.fontawesome.com/18ddcc2bb6.js" crossorigin="anonymous"></script>

<div id="pageHeader" class="row header centerV no-marginL">
    <nav class="col-4 transparent centerV no-padL navbar-expand-lg navbar-light bg-light">
        <div class="row flex-nowrap" style="align-items: center;">
            <div class="col-auto no-padR">
                <a class="btn btn-primary" id="sidebarCollapseBtnHead"><i id="sidebarCollapseBtnIcon" class="fa-solid fa-bars"></i></a>
            </div>

            <a id="headerLogo" href="/Frontend/MoviePage/homePage.php" class="col-9"><img id='navLogo' class="text-center no-pad" src="/images/logo-icon.png"></a>
        </div>
    </nav>

    <div id="search" class="center headerBtn col-6">
        <input type="button" class="btn btn-primary" value="Search">
    </div>

    <div id="login" class="center headerBtn col-2">
        <a href="/Frontend/Login-Signup/loginPage.php" class="btn btn-primary">Login</a>
    </div>
</div>

<script>
    $(document).ready(function () {

    $('#sidebarCollapseBtnHead').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#fadeLayer').toggleClass('active');
    });
    });
</script>