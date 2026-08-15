<?php

class Product
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function getAllProducts()
    {
        $query = "SELECT * FROM Products";

        $result = mysqli_query($this->conn, $query);

        return $result;
    }


    public function getLatestProducts()
    {
        $query = "SELECT * FROM Products LIMIT 4";

        $result = mysqli_query($this->conn, $query);

        return $result;
    }


    public function searchProducts($search)
    {
        $search = mysqli_real_escape_string(
            $this->conn,
            $search
        );

        $query = "SELECT * FROM Products
                  WHERE ProductName LIKE '%$search%'
                  OR Club LIKE '%$search%'
                  OR Edition LIKE '%$search%'";

        $result = mysqli_query($this->conn, $query);

        return $result;
    }


    public function getProductById($id)
    {
        $id = intval($id);

        $query = "SELECT * FROM Products
                  WHERE ProductID = $id";

        $result = mysqli_query($this->conn, $query);

        return $result;
    }


    public function reduceStock($id, $quantity)
    {
        $id = intval($id);
        $quantity = intval($quantity);

        $query = "UPDATE Products
                  SET Stock = Stock - $quantity
                  WHERE ProductID = $id";

        mysqli_query($this->conn, $query);
    }
}

?>