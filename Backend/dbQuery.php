<?php
    include (__DIR__ . "/dbConnection.php");
    
    //--LANCE - CREATING ADD ADMIN SO WE CAN ADD OURSELVES//

        // function adminInsert($userName, $password, $email){

        //     global $db;

        //     $results = "Not addded";        //this will display if code doesnt work

        //     $stmt = $db->prepare("INSERT INTO adminaccounts SET UserName = :UserName, Password = :Password, Email = :Email");     //craeting my sql statement that will add data into the db

        //     $binds = array(
        //         ":UserName" => $UserName,

        //         ":Password" => $Password,

        //         ":Email" => $Email,
        //                 //binding my information of array to my vars
        //     );


        //     if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        //         $results = "Person Added";     //if command works print out cars added
        //     }


        // }

    //--LANCE - CREATING ADD USERS NOT DONE

    function signUp($Username, $Password, $FirstName, $LastName, $Email){

        global $db;

        $results = "Not addded";        //this will display if code doesnt work

        $stmt = $db->prepare("INSERT INTO useraccounts SET Username = :Username, Password = :Password, FirstName = :FirstName, LastName = :LastName, Email = :Email");     //craeting my sql statement that will add data into the db

        $binds = array(
            ":Username" => $Username,

            ":Password" => $Password,

            ":FirstName" => $FirstName,

            ":LastName" => $LastName,

            ":Email" => $Email
                    //binding my information of array to my vars
        );


        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = "Person Added";     //if command works print out cars added
        }

        //$user1 = 'Lance';
        //$pw1 = 'Football';
        //$protectdPW = sha1($pw1)
    }


    //--Justin - Check Login for user logins

    function validateLogin ($userName, $password) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM useraccounts WHERE Username =:username AND Password = :password");
        
        $stmt->bindValue(':username', $userName);
        $stmt->bindValue(':password', sha1($password. "secret stuff"));
            
        $stmt->execute ();
           
        return( $stmt->rowCount() > 0);  
    }

    //--LANCE - CREATING CHECK LOGIN FOR ADMINS

    function validateAdminLogin ($userName, $password) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM adminaccounts WHERE Username =:username AND Password = :password");
        
        $stmt->bindValue(':username', $userName);
        $stmt->bindValue(':password', sha1($password. "secret stuff"));
            
        $stmt->execute ();
           
        return( $stmt->rowCount() > 0);  
    }

    //--LANCE - ADDING A ADD MOVIE FUNCTION

    function addMovie ($MovieTitle, $DatePosted, $MovieGenre, $MovieDescription, $CreatorName, $CoverIMG, $BannerIMG, $LikeCount, $IsApproved, $UserAccountID)  {
    
        //craeting my add car function that will actually add to my db
    
    
        global $db;
    
        $results = "Not addded";        //this will display if code doesnt work
    
        $stmt = $db->prepare("INSERT INTO movietable SET MovieTitle = :MovieTitle, DatePosted = :DatePosted, MovieGenre = :MovieGenre, MovieDescription = :MovieDescription, CreatorName = :CreatorName, CoverIMG = :CoverIMG, BannerIMG = :BannerIMG, LikeCount = :LikeCount, IsApproved = :IsApproved, UserAccountID = :UserAccountID ");     //craeting my sql statement that will add data into the db
    
        $binds = array(
            ":MovieTitle" => $MovieTitle,
            ":DatePosted" => $DatePosted,
            ":MovieGenre" => $MovieGenre,
            ":MovieDescription" => $MovieDescription, //binding my information of array to my vars       
            ":CreatorName" => $CreatorName,
            ":CoverIMG" => $CoverIMG,
            ":BannerIMG" => $BannerIMG,
            ":LikeCount" => $LikeCount,
            ":IsApproved" => $IsApproved,
            ":UserAccountID" => $UserAccountID,
        );
    
    
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {

            $results = "Movie Added";     //if command works print out car added
        }
    
    }

    function getMovies() {
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT MovieTitle, DatePosted, MovieGenre, MovieDescription,CreatorName,CoverIMG,BannerIMG,LikeCount,IsApproved,UserAccountID FROM movietable ORDER BY DatePosted"); 

        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
         }
         
         return ($results);
    }

    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    function editMovie($MovieTitle, $MovieGenre, $MovieDescription, $CoverIMG, $BannerIMG){
        global $db; 

        $results = [];

        $stmt = $db->prepare("UPDATE movietable SET movieTitle = :MovieTitle, MovieGenre = :MovieGenre, MovieDescription = :MovieDescription, CoverIMG = :CoverIMG, BannerIMG = :BannerIMG WHERE movieID = :MovieID");
        $stmt->bindvalue(':movieTitle', $MovieTitle);
        $stmt->bindvalue(':movieGenre', $MovieGenre);
        $stmt->bindvalue(':movieDescription', $MovieDescription); 
        $stmt->bindvalue(':CoverIMG', $CoverIMG);
        $stmt->bindvalue(':BannerIMG', $BannerIMG);
        

        if($stmt->execute() && $stmt->rowCount()> 0) {

            $results = "Your movie has been edited!"; 

        }

        return ($results); 
    }

    
    function getTrends() {
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT movieID,MovieTitle, DatePosted, MovieGenre, MovieDescription,CreatorName,CoverIMG,BannerIMG,LikeCount,IsApproved,UserAccountID FROM movietable ORDER BY LikeCount DESC"); 

        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
         }
         
         return ($results);
    }

    function getOneMovie($id){
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT *  FROM movietable WHERE movieID = :movieID"); 
        
        $stmt->bindvalue(':movieID', $id);


        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
        }
         
         return ($results);
    }

    function addReview($userAccounID,$movieID,$ReviewDescription,$ReviewLikes){
        
        //craeting my add car function that will actually add to my db
    
    
        global $db;
    
        $results = "Not addded";        //this will display if code doesnt work
    
        $stmt = $db->prepare("INSERT INTO reviewtable SET userAccountID = :userAccountID, movieID = :movieID, ReviewDescription = :ReviewDescription, ReviewLikes = :ReviewLikes");     //craeting my sql statement that will add data into the db
    
        $binds = array(
            ":userAccountID" => $userAccountID,
            ":movieID" => $movieID,
            ":ReviewDescription" => $ReviewDescription,
            ":ReviewLikes" => $ReviewLikes, //binding my information of array to my vars       
        );
    
    
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {

            $results = "Movie Added";     //if command works print out car added
        }
    }
    function userPK(){
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT userAccountID FROM useraccounts WHERE userAccountID= userAccountID"); 
        


        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
        }
         
         return ($results);
    }
?>
