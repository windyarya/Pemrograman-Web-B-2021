<?php 
    include "config/connection.php";

    $queryTable = "SELECT name, club, games, save, ROUND(save/games, 2) as spg FROM gk";

    $queryTD = mysqli_query($conn, $queryTable);
    $resultTD = mysqli_fetch_all($queryTD, MYSQLI_ASSOC);

    foreach ($resultTD as $result) {
        $itemData[] = array(
            "Name" => $result["name"],
            "Club" => $result["club"],
            "Games" => $result["games"],
            "Save" => $result["save"],
            "savespergame" => $result["spg"]
        );
    }

    $response = array (
        "status" => 1,
        "message" => "Getting Data from Database Succesfully",
        "data" => array (
            "gk" => $itemData
        )
    );

    echo json_encode($response);
?>