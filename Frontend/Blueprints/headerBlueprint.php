<script src="https://kit.fontawesome.com/18ddcc2bb6.js" crossorigin="anonymous"></script>

<div id="PageHeader" class="row header centerV no-marginL">
    <nav class="col transparent centerV no-padL navbar-expand-lg navbar-light bg-light col-4">
        <a class="btn btn-primary" id="sidebarCollapseHead"><i class="fa-solid fa-bars"></i></a>
    </nav>

    <div id="head1" class="header center col-4">

    <?php $header="";
    echo $header?>

    </div>

    <div id="search" class="center headerBtn col-2">
        <input type="button" class="btn btn-primary" value="Search">
    </div>

    <div id="login" class="center headerBtn col-2">
        <a href="/Frontend/Login-Signup/loginPage.php" class="btn btn-primary">Login</a>
    </div>
</div>

<script>
    $(document).ready(function () {

    $('#sidebarCollapseHead').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#fadeLayer').toggleClass('active');
    });
    });
</script>