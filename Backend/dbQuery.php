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

    function addMovie ($MovieTitle, $DatePosted, $MovieGenre, $MovieDescription, $CreatorName, $LikeCount, $IsApproved, $CoverIMG, $BannerIMG, $UserAccountID,)  {
    
        //craeting my add car function that will actually add to my db
    
    
        global $db;
    
        $results = "Not addded";        //this will display if code doesnt work
    
        $stmt = $db->prepare("INSERT INTO movietable SET MovieTitle = :MovieTitle, DatePosted = :DatePosted, MovieGenre = :MovieGenre, MovieDescription = :MovieDescription, CreatorName = :CreatorName, LikeCount = :LikeCount, IsApproved = :IsApproved, CoverIMG = :CoverIMG, BannerIMG = :BannerIMG ,UserAccountID = :UserAccountID");     //craeting my sql statement that will add data into the db
    
        $binds = array(
            ":MovieTitle" => $MovieTitle,
            ":DatePosted" => $DatePosted,
            ":MovieGenre" => $MovieGenre,
            ":MovieDescription" => $MovieDescription, //binding my information of array to my vars       
            ":CreatorName" => $CreatorName,

            ":LikeCount" => $LikeCount,
            ":IsApproved" => $IsApproved,
            ":CoverIMG" => $CoverIMG,
            ":BannerIMG" => $BannerIMG,
            ":UserAccountID" => $UserAccountID,
        );
    
    
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {

            $results = "Movie Added";     //if command works print out car added
        }
    
    }

    function getMovies() {
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT MovieID,MovieTitle, DatePosted, MovieGenre, MovieDescription,CreatorName,CoverIMG,BannerIMG,LikeCount,IsApproved,UserAccountID FROM movietable ORDER BY DatePosted"); 


        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
        }
         
        return ($results);
    }

    function editMovie($MovieTitle, $MovieGenre, $MovieDescription, $CoverIMG, $BannerIMG){
        global $db; 

        $results = [];

        $stmt = $db->prepare("UPDATE movietable SET movieTitle = :MovieTitle, MovieGenre = :MovieGenre, MovieDescription = :MovieDescription, CoverIMG = :CoverIMG, BannerIMG = :BannerIMG WHERE ovieID = :MovieID");
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

    function getTrending() {
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT MovieID,MovieTitle, DatePosted, MovieGenre, MovieDescription,CreatorName,CoverIMG,BannerIMG,LikeCount,IsApproved,UserAccountID FROM movietable ORDER BY LikeCount DESC LIMIT 12"); 

        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
        }
         
        return ($results);
    }

    function getUserMovie($id){
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT *  FROM movietable WHERE UserAccountID = :UserAccountID"); 
        
        $stmt->bindvalue(':UserAccountID', $id);


        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
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

    function deleteMovie ($id) {
        global $db;
        
        $results = "Data was not deleted";
    
        $stmt = $db->prepare("DELETE FROM `movietable` WHERE `UserAccountID` = :id");
        
        $stmt->bindValue(':id', $id);
            
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = 'Data Deleted';
        }
        
        return ($results);
    }

    function searchMovie($MovieTitle){
        global $db;
        $binds=array();

        $sql = "SELECT * FROM movietable WHERE 0=0";

        if($movieTitle != " "){
            $sql .= "AND MovieTitle LIKE :MovieTitle";
            $binds['MovieTitle'] = '%' .$MovieTitle. '%';
        }
        $results =array();
        $stmt = $db->prepare($sql);

        if($stmt ->execute($binds) && $stmt -> rowCount() >0){
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return ($results);
    }

    // /\ /\ /\ MovieCRUD /\ /\ /\
    //---------------------------------------------------------------
    //---------------------------------------------------------------



    //-



    // \/ \/ \/ ReviewCRUD \/ \/ \/
    //---------------------------------------------------------------
    //---------------------------------------------------------------

    function addReview($userAccountID,$movieID,$ReviewDescription,$ReviewLikes){
        
        //creating my add car function that will actually add to my db
    
    
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

    // /\ /\ /\ UserAccounts/Followers /\ /\ /\
    //---------------------------------------------------------------
    //---------------------------------------------------------------



    //-



    // \/ \/ \/ Misc Functions \/ \/ \/
    //---------------------------------------------------------------
    //---------------------------------------------------------------

    function isPostRequest() {
        return (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST');
    }

?>
