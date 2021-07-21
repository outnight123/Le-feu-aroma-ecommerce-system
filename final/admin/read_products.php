<?php
    require('../functions.php');

    $sort = "ASC";
    $column = "id";

    if (isset($_GET['column']) && isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        $column = $_GET['column'];

        $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
    }

    $queryProducts = "SELECT * FROM products ORDER BY $column $sort";
    $sqlProducts = mysqli_query($db, $queryProducts);
?>