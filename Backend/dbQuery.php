<?php
    include (__DIR__ . "/dbConnection.php");



    // \/ \/ \/ Login/Signup \/ \/ \/
    //---------------------------------------------------------------
    //---------------------------------------------------------------
    
    /*LANCE - CREATING ADD ADMIN SO WE CAN ADD OURSELVES//
        function adminInsert($userName, $password, $email){

            global $db;

            $results = "Not addded"; //this will display if code doesnt work

            $stmt = $db->prepare("INSERT INTO adminaccounts SET UserName = :UserName, Password = :Password, Email = :Email");     //craeting my sql statement that will add data into the db

            $binds = array(
                ":UserName" => $UserName,

                ":Password" => $Password,

                ":Email" => $Email,
                //binding my information of array to my vars
            );


            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = "Person Added";     //if command works print out cars added
            }
         }
    --LANCE - CREATING ADD USERS NOT DONE*/

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
            $results = "Person Added";     //if command works print out person added
            //$results = "Person Added";     //if command works print out  added
        }
    }

    //--LANCE - CREATING CHECK LOGIN FOR ADMINS

    function validateAdminLogin ($userName, $password) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM adminaccounts WHERE Username =:username AND Password = :password");
        
        $stmt->bindValue(':username', $userName);
        $stmt->bindValue(':password', hash('sha256', $password. 'secret stuff'));
            
        $stmt->execute ();
           
        return( $stmt->rowCount() > 0);  
    }

    function validateLogin ($username, $password) {
        //Connecting to database
        global $db; 

        $results = [];

        $stmt = $db->prepare("SELECT * FROM `useraccounts` WHERE `Username` = LOWER(:Username) AND `Password` = :Password");

        $stmt->bindValue(':Username', $username);
        $stmt->bindValue(':Password', hash('sha256', $password. 'secret stuff')); 

        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);        
        }
         
        return ($results);
    }

    // /\ /\ /\ LogIn/Signup /\ /\ /\
    //---------------------------------------------------------------
    //---------------------------------------------------------------



    //-



    // \/ \/ \/ MovieCRUD \/ \/ \/
    //---------------------------------------------------------------
    //---------------------------------------------------------------

    //--LANCE - ADDING A ADD MOVIE FUNCTION

    function addMovie ($MovieTitle, $DatePosted, $MovieGenre, $MovieDescription, $CreatorName, $LikeCount, $IsApproved, $CoverIMG, $MovieTrailer, $UserAccountID)  {
    
        //craeting my add car function that will actually add to my db
    
    
        global $db;
    
        $results = "Not addded";        //this will display if code doesnt work
    
        $stmt = $db->prepare("INSERT INTO movietable SET MovieTitle = :MovieTitle, DatePosted = :DatePosted, MovieGenre = :MovieGenre, MovieDescription = :MovieDescription, CreatorName = :CreatorName, LikeCount = :LikeCount, IsApproved = :IsApproved, CoverIMG = :CoverIMG, MovieTrailer = :MovieTrailer, UserAccountID = :UserAccountID");     //craeting my sql statement that will add data into the db
    
        $binds = array(
            ":MovieTitle" => $MovieTitle,
            ":DatePosted" => $DatePosted,
            ":MovieGenre" => $MovieGenre,
            ":MovieDescription" => $MovieDescription, //binding my information of array to my vars       
            ":CreatorName" => $CreatorName,

            ":LikeCount" => $LikeCount,
            ":IsApproved" => $IsApproved,
            ":CoverIMG" => $CoverIMG,
            ":MovieTrailer" => $MovieTrailer,
            ":UserAccountID" => $UserAccountID,
        );
    
    
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {

            $results = "Movie Added";     //if command works print out car added
        }
    
        return $results;
    }
    //grabbing movies from db - jacob 
    function getMovies() {
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT MovieID, MovieTitle, DatePosted, MovieGenre, MovieDescription, CreatorName, CoverIMG, LikeCount, IsApproved, MovieTrailer, UserAccountID FROM movietable ORDER BY DatePosted DESC"); 


        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
        }
         
        return ($results);
    }

    //jacob - Edit Movie function 
    function editMovie($MovieTitle, $MovieGenre, $MovieDescription, $IsApproved, $CoverIMG, $MovieTrailer, $UserAccountID, $MovieID){
        global $db; 
        
        $results = [];

        $stmt = $db->prepare("UPDATE movietable SET MovieTitle = :MovieTitle, MovieGenre = :MovieGenre, MovieDescription = :MovieDescription, IsApproved = :IsApproved, CoverIMG = :CoverIMG, MovieTrailer = :MovieTrailer WHERE UserAccountID = :UserAccountID AND MovieID = :MovieID");
        $stmt->bindvalue(':MovieTitle', $MovieTitle);
        $stmt->bindvalue(':MovieGenre', $MovieGenre);
        $stmt->bindvalue(':MovieDescription', $MovieDescription); 
        $stmt->bindvalue(':IsApproved', $IsApproved);
        $stmt->bindvalue(':CoverIMG', $CoverIMG);
        $stmt->bindvalue(':MovieTrailer', $MovieTrailer);
        $stmt->bindvalue(':UserAccountID', $UserAccountID);
        $stmt->bindvalue(':MovieID', $MovieID); 

        

        if($stmt->execute() && $stmt->rowCount()> 0) {
            $results = "Your movie has been edited!"; 
        }

        return ($results); 
    }

    function getTrending() {
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT MovieID,MovieTitle, DatePosted, MovieGenre, MovieDescription,CreatorName,CoverIMG,LikeCount,IsApproved,UserAccountID FROM movietable ORDER BY LikeCount DESC LIMIT 8"); 

        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
        }
         
        return ($results);
    }

    function getUserMovie($id){
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT * FROM movietable WHERE UserAccountID = :UserAccountID"); 
        
        $stmt->bindvalue(':UserAccountID', $id);


        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
        }
         
        return ($results);
    }

    function getMovieRating($id){
        global $db;
        
        //Declare as default as statement to set result only runs if row count is greater than 0 this avoids the need for an else statement
        $results = 0;

        $stmt = $db->prepare("SELECT CAST(AVG(Rating) AS DECIMAL(10,1)) FROM reviewtable WHERE MovieID = :movieID"); 
        
        $binds = array(
            ":movieID" => $id,     
        );

        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchColumn();
                 
        }
        
        return ($results);
    }

    function getOneMovie($id){
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT *  FROM movietable WHERE MovieID = :MovieID"); 
        
        $stmt->bindvalue(':MovieID', $id);


        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
        }
         
        return ($results);
    }

    //delete movie function 
    function deleteMovie ($UserAccountID, $MovieID) {
        global $db;
        
        $results = "Data was not deleted";
    
        $stmt = $db->prepare("DELETE FROM movietable WHERE UserAccountID = :UserAccountID AND MovieID = :MovieID");
        
        $stmt->bindValue(':UserAccountID', $UserAccountID);
        $stmt->bindValue(':MovieID', $MovieID);
            
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = 'Data Deleted';
        }
        
        return ($results);
    }

    //justins search function
    function searchMovie($MovieTitle){
        global $db;
        $binds = array();
        $results = array();

        $sql = "SELECT * FROM movietable WHERE 0=0";

        if($MovieTitle != " "){
            $sql .= " AND MovieTitle LIKE :MovieTitle ORDER BY LikeCount DESC LIMIT 8";
            
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':MovieTitle', "%" . $MovieTitle . "%");
        }
        else{
            $sql .= " LIMIT 8";

            $stmt->bindValue(':MovieTitle', "ZZZZZZZZZZZ");
            $stmt = $db->prepare($sql);
        }
        

        if($stmt->execute() && $stmt-> rowCount() > 0){
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($results);
    }

    // /\ /\ /\ MovieCRUD /\ /\ /\
    //---------------------------------------------------------------
    //---------------------------------------------------------------




    //-------------------------------------------------------




    // \/ \/ \/ ReviewCRUD \/ \/ \/
    //---------------------------------------------------------------
    //---------------------------------------------------------------

    function addReview($userAccountID,$movieID,$ReviewDescription,$Rating){
        
        //creating my add car function that will actually add to my db
    
    
        global $db;
    
        $results = "Not addded";        //this will display if code doesnt work
    
        $stmt = $db->prepare("INSERT INTO reviewtable SET userAccountID = :userAccountID, movieID = :movieID, ReviewDescription = :ReviewDescription, Rating = :Rating, ReviewLikes = :ReviewLikes");     //craeting my sql statement that will add data into the db
    
        $binds = array(
            ":userAccountID" => $userAccountID,
            ":movieID" => $movieID,
            ":ReviewDescription" => $ReviewDescription,
            ":Rating" => $Rating, //binding my information of array to my vars   
            ":ReviewLikes" => 0,    
        );
    
    
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {

            $results = "Movie Added";     //if command works print out car added
        }
    }

    function getReviews($id){
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT * FROM reviewtable WHERE movieID = :movieID ORDER BY ReviewLikes"); 
        $binds = array(
            ":movieID" => $id,     
        );
    
    
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {

            $results = $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($results);
    }
    
    // /\ /\ /\ MovieCRUD /\ /\ /\
    //---------------------------------------------------------------
    //---------------------------------------------------------------



    //-



    // \/ \/ \/ UserAccounts/Followers \/ \/ \/
    //---------------------------------------------------------------
    //---------------------------------------------------------------

    function getUser($userAccountID){
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT * FROM useraccounts WHERE UserAccountID = :userAccountID"); 
        
        $binds = array(
            ":userAccountID" => $userAccountID,     
        );

        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
        }
         
        return ($results);
    }


    function checkUserName($userName){

        global $db;

        $stmt = $db->prepare("SELECT useraccountID FROM useraccounts WHERE username =:UserName");

        $stmt->bindValue(':UserName', $userName);

        //$stmt->bindValue(':email', $email);

        $stmt->execute ();

        return( $stmt->rowCount() > 0);
    }
    

    function checkEmail($email){

        global $db;

        $stmt = $db->prepare("SELECT useraccountID FROM useraccounts WHERE email =:email");

        $stmt->bindValue(':email', $email);

        //$stmt->bindValue(':email', $email);

        $stmt->execute ();

        return( $stmt->rowCount() > 0);
    }
    

    //Followers
    function getFollowerCount($userAccountID){
        global $db;
        
        //Declare as default as statement to set result only runs if row count is greater than 0 this avoids the need for an else statement
        $results = 0;

        $stmt = $db->prepare("SELECT COUNT(*) AS 'total' FROM userfollowers WHERE UserAccountID = :userAccountID"); 
        
        $binds = array(
            ":userAccountID" => $userAccountID,     
        );

        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchColumn();
                 
        }
        
        return ($results);
    }

    //justin should be able to get this done !!DO NOT DELETE!!
    function getFollowingCount($userAccountID){
        global $db;
        
        //Declare as default as statement to set result only runs if row count is greater than 0 this avoids the need for an else statement
        $results = 0;

        $stmt = $db->prepare("SELECT COUNT(*) AS 'total' FROM userfollowing WHERE UserAccountID = :userAccountID"); 
        
        $binds = array(
            ":userAccountID" => $userAccountID,     
        );

        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchColumn();
                 
        }
        
        return ($results);
    }


    function grabMovies ($id) {

        global $db;
    
       
       $result = [];        //creating empty array
       
       $stmt = $db->prepare("SELECT movieID, UserAccountID, MovieTitle, DatePosted, MovieGenre, MovieDescription, CreatorName, CoverIMG, LikeCount, IsApproved, movieTrailer FROM movieTable WHERE movieID=:movieID");
    
       $stmt->bindValue(':movieID', $id);
      
    
       if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                       
        }
        
        return ($result);
    }

    // /\ /\ /\ UserAccounts/Followers /\ /\ /\
    //---------------------------------------------------------------
    //---------------------------------------------------------------



    //-----------------------------------------------------------



    // \/ \/ \/ Misc Functions \/ \/ \/
    //---------------------------------------------------------------
    //---------------------------------------------------------------

    function isPostRequest() {
        return (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST');
    }

?>
