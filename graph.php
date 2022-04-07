<?php
    include "config/connection.php";

    $sql = "SELECT name, (save/games) as spg FROM gk";

    $query = mysqli_query($conn, $sql);
    $resultData = mysqli_fetch_all($query, MYSQLI_ASSOC);

    foreach ($resultData as $result) {
        $itemData[] = array (
            "spg" => $result["spg"],
            "name" => $result["name"]
        );
    }

    $response = array (
        "status" => 1,
        "message" => "Getting Data from Database Success",
        "data" => $itemData
    );

    echo json_encode($response);
?>