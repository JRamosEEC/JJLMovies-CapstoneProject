<?php
    include (__DIR__ . "/dbConnection.php");

    function getAdmin() {
        global $db;

        $results = [];

        $stmt = $db->prepare("SELECT * FROM adminaccounts");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($results);
    }

    // --- Entity Table --- //
    function getEntity () {
        global $db;

        $results = [];

        $stmt = $db->prepare("SELECT storeId, name, region, country, state, city, address, zip FROM entity ORDER BY name");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($results);
    }

    // --- Invntory Table --- //
    function addInventory ($name, $qty, $category, $price) {
        global $db;

        $results = [];

        $stmt = $db->prepare("INSERT INTO inventory (name, quantity, category, price) VALUES (:name, :qty, :category, :price)");

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':qty', $qty);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':price', $price);


        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = "Data Added";
        }

        return ($results);
    }

    function updateInventory ($productId, $name, $qty, $category, $price) {
        global $db;

        $results = [];

        $stmt = $db->prepare("UPDATE inventory SET name = :name, quantity = :qty, category = :category, price = :price WHERE productId = :productId");

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':qty', $qty);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':productId', $productId);

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = "Data Updated";
        }

        return ($results);
    }

    function delInventory ($id) {
        global $db;

        $results = [];

        $stmt = $db->prepare("DELETE FROM inventory WHERE productId = :id");

        $stmt->bindValue(':id', $id);

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = "Data Removed";
        }

        return ($results);
    }

    function getInventory () {
        global $db;

        $results = [];

        $stmt = $db->prepare("SELECT productId, name, quantity, category, price FROM inventory ORDER BY name");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($results);
    }

    function getCategories () {
        global $db;

        $results = [];

        $stmt = $db->prepare("SELECT DISTINCT category FROM inventory");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($results);
    }


    // --- Sale Table --- //
    function getSales () {
        global $db;

        $results = [];

        $stmt = $db->prepare("SELECT salesId, productId, storeId, discountId, tax, totalCost FROM sales ORDER BY salesId");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($results);
    }

    function addSales ($productId, $storeId, $discountId, $tax, $totalCost) {
        global $db;

        $results = [];

        $stmt = $db->prepare("INSERT INTO sales (productId, storeId, discountId, tax, totalCost) VALUES (:productId, :storeId, :discountId, :tax, :totalCost)");

        $stmt->bindValue(':productId', $productId);
        $stmt->bindValue(':storeId', $storeId);
        $stmt->bindValue(':discountId', $discountId);
        $stmt->bindValue(':tax', $tax);
        $stmt->bindValue(':totalCost', $totalCost);

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = "Data Added";
        }

        $stmt2 = $db->prepare("UPDATE inventory SET quantity = quantity - 1 WHERE productId = :productId");

        $stmt2->bindValue(':productId', $productId);

        if ($stmt2->execute() && $stmt2->rowCount() > 0) {
            $results = "Data Updated";
        }

        return ($results);
    }
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
    function signUp($Username, $Password, $Birthdate, $FirstName, $LastName, $Email){

        global $db;

        $results = "Not addded";        //this will display if code doesnt work

        $stmt = $db->prepare("INSERT INTO useraccounts SET Username = :Username, Password = :Password, Birthdate = :Birthdate, FirstName = :FirstName, LastName = :LastName, Email = :Email");     //craeting my sql statement that will add data into the db

        $binds = array(
            ":Username" => $Username,

            ":Password" => $Password,

            ":Birthdate" => $Birthdate,

            ":FirstName" => $FirstName,

            ":LastName" => $LastName,

            ":Email" => $Email,
                    //binding my information of array to my vars
        );


        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = "Person Added";     //if command works print out cars added
        }

        //$user1 = 'Lance';
        //$pw1 = 'Football';
        //$protectdPW = sha1($pw1)
    }

    //--LANCE - CREATING CHECK LOGIN FOR ADMINS

    function checkLoginAdmin ($userName, $password) {
        global $db;
        $stmt = $db->prepare("SELECT admins FROM usercars WHERE username =:username AND userPassword = :password");
        
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

        $stmt = $db->prepare("SELECT MovieTitle, DatePosted, MovieGenre, MovieDescription,CreatorName,CoverIMG,BannerIMG,LikeCount,IsApproved,UserAccountID FROM movietable ORDER BY  DatePosted"); 
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
         }
         
         return ($results);
    }
?>
