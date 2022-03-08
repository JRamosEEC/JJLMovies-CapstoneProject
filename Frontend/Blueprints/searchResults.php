<?php
    require (__DIR__ . "/../../Backend/dbQuery.php");

    $searchTxt = $_GET['searchTxt'];

    $searchResults = searchMovie($searchTxt);

    $resultHtmlStr = "";

    foreach ($searchResults as $row):
    {
        $resultHtmlStr += '
        <div id="searchItem" class="row no-margin no-pad">
            <div class="col-sm">
                <div class="row">
                    <div id="searchComponentMovieImg" class="col-auto no-pad">
                        <img src="' . $row["CoverImg"] . '" width=75px;>
                    </div>

                    <div id="searchComponentMovieDetailsContainer" class="col-auto ml-4">
                        <div id="searchComponentDetails" class="row">
                            <div style="font-size: 20px;">"' . $row["MovieTitle"] . '"</div>
                        </div>
                    
                        <div id="searchComponentDetails" class="row">
                            <strong>Creator :</strong><div> &nbsp;"' . $row["CreatorName"] . '"</div>
                        </div>

                        <div id="searchComponentDetails" class="row">
                            <strong>Rating :</strong><div> &nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="spacerLine" class="row no-margin" style="margin-top: 10px !important; margin-bottom: 5px !important;"></div>
        ';
    }

    echo $resultHtmlStr;
?>