<?php
    include (__DIR__ . "/dbConnection.php");

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
?>