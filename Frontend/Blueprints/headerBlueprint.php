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
        <input id="headerSearch" name="headerSearch" type="text" placeholder="Search">
        <button type="submit" name="submit" href="/Frontend/MoviePage/moviePage.php" method="post"><i class="fa fa-search"></i></button>

        <div id="headerSearchBox">
                    <?php foreach ($movies as $row): ?>
                        <div id="searchItem" class="row no-margin no-pad">
                            <div class="col-sm">
                                <div class="row">
                                    <div id="searchComponentMovieImg" class="col-auto no-pad">
                                        <img src=<?php echo $row['CoverIMG']; ?> width=75px;> <!--- it's be width x height in html not length but for now to avoid stretching images let them size themselvs --->
                                    </div>

                                    <div id="searchComponentMovieDetailsContainer" class="col-auto ml-4">
                                        <div id="searchComponentDetails" class="row">
                                            <div style="font-size: 20px;"><?php echo $row['MovieTitle'];?></div>
                                        </div>
                                    
                                        <div id="searchComponentDetails" class="row">
                                            <strong>Creator :</strong><div> &nbsp;<?php echo $row['CreatorName']?></div>
                                        </div>

                                        <div id="searchComponentDetails" class="row">
                                            <strong>Rating :</strong><div> &nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="spacerLine" class="row no-margin" style="margin-top: 10px !important; margin-bottom: 5px !important;"></div>
                    <?php endforeach; ?>
        </div>
    </div>

    <div id="loginContainer" class="centerV headerBtn col-auto justify-content-end no-pad">
        <a href="<?php if(isset($_SESSION['user'])){echo "/Frontend/UserProfile/profilePage.php";}else{echo "/Frontend/Login-Signup/loginPage.php";} ?>"><img src="<?php if(isset($_SESSION['user'])){echo "/images/profile-icon-logged-in.png";}else{echo "/images/profile-icon-logged-out.png";} ?>" width="50px" height="50px"; ></a>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#sidebarCollapseBtnHead').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('#fadeLayer').toggleClass('active');
        });
    });

    $(document).ready(function () {
        $('#headerSearch').on('focus', function () {
            $('#headerSearchBox').toggleClass('active');
        });
    });
</script>