<?php

require 'Database.php';

$serverName = $_SERVER['SERVER_NAME'];
$query = rtrim($_SERVER['QUERY_STRING'], '/');
if (isset($query) and !empty($query)){

    $conn = local\Database::instance();
    $sql = "SELECT * FROM Links WHERE short = ?";
    $param = [
        $query
    ];
    $row = $conn->query($sql, $param);
    if (!empty($row[0]['full'])){
        $link = str_replace('%', '', $row[0]['full']);
        header("Location: $link");
    } else {
        require __DIR__. '/templates/404.php';
    }
}else {
    require __DIR__ . '/templates/main.php';
}
