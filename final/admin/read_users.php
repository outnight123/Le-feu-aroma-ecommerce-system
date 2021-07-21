<?php
    require('../functions.php');

    $sort = "ASC";
    $column = "id";

    if (isset($_GET['column']) && isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        $column = $_GET['column'];

        $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
    }

    $queryUsers = "SELECT * FROM users ORDER BY $column $sort";
    $sqlUsers = mysqli_query($db, $queryUsers);
?>