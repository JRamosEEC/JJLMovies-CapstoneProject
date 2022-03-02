<link rel="stylesheet" href="../CSS/pageHeader.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/18ddcc2bb6.js" crossorigin="anonymous"></script>

<div id="pageHeader" class="row header centerV no-marginL flex-nowrap">
    <nav id="logoContainer" class="col-auto transparent centerV no-padL navbar-expand-lg navbar-light bg-light">
        <div class="row flex-nowrap" style="align-items: center;">
            <div class="col-auto no-padR">
                <a class="btn btn-primary" id="sidebarCollapseBtnHead"><i id="sidebarCollapseBtnIcon" class="fa-solid fa-bars"></i></a>
            </div>

            <a id="headerLogo" href="/Frontend/MoviePage/homePage.php" class="col-9"><img id='navLogo' class="text-center no-pad" src="/images/logo-icon.png"></a>
        </div>
    </nav>

    <div id="headerSearchContainer" class="center headerBtn col-auto">
        <input id="headerSearch" type="text" placeholder="Search">
        
        <button type="submit"><i class="fa fa-search"></i></button>
    </div>

    <div id="loginContainer" class="centerV headerBtn col-auto justify-content-end no-pad">
        <a href="/Frontend/Login-Signup/loginPage.php"><img src="<?php if(isset($_SESSION['user'])){echo "/images/profile-icon-logged-in.png";}else{echo "/images/profile-icon-logged-out.png";} ?>" width="50px" height="50px"; ></a>
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