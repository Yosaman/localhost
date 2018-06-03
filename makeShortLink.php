<?php

require 'Database.php';

function randomLink ($length = 5) {
    $abc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $link = '';
    for ($i = 0; $i <$length; $i++) {
        $link .= $abc[rand(0, strlen($abc))];
    }
    return $link;
}

if (isset($_POST['full']) && !empty($_POST['full'])) {
    $full = $_POST['full'];
    $short = randomLink();

    $db = [
        'dsn' => 'mysql:host=localhost;dbname=shortLink;charset=utf8',
        'user' => 'root',
        'pass' => '',
    ];
    try {
//        $conn = new \PDO($db['dsn'], $db['user'], $db['pass']);
//        $checkShort = "SELECT * FROM Links WHERE short = '$short'";
//        $sqlRequest = $conn->query($checkShort);

//        echo $short;

        $conn = local\Database::instance();
        $checkShort = "SELECT * FROM Links WHERE short = '$short'";
        $sqlRequest = $conn->query($checkShort);

//        echo gettype($sqlRequest);
//        foreach ($sqlRequest as $row) {
//            echo $row;
//        }

        if(count($sqlRequest) < 1) {
            $sql = "INSERT INTO Links (short, full) VALUES ('$short', ?)";
            $param = [
                '%' . $_POST['full'] . '%'
            ];
//            $request = $conn->prepare($sql);
//            echo $request;
//
//            $request->execute(array($_POST['full']));

            $conn->execute($sql, $param);
        }
    }
    catch(PDOException $e) {
//            echo $sql . "<br>" . $e->getMessage();
        echo 'Ошибка при подключении к базе данных'."<br>";
    }



    test_function($short);
}


function test_function($short){
    $result = $short;

    echo json_encode($result)."<br>";
}
?>
