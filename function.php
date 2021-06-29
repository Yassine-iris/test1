<?php

function getTask($database, $limit): array
    {
    // récupère un article pour le contenu selon l'id de l'url
    if (isset($_GET["id"])){
        $User_id = intval(htmlspecialchars($_GET["id"]));
        $query = $database->query("SELECT * FROM task WHERE User_id = $User_id");
    }
    // recupère tout les article selon la limite fixer
    else {
        $query = $database->query("SELECT * FROM task");
    }
    $news = array();
    while ($data = $query->fetch())
    {
        $news[] = array(
        "IdT" => intval($data["IdT"]),
        "User_id" => htmlspecialchars($data["User_id"]),
        "Title" => htmlspecialchars_decode($data["Title"]),
        "Description" => ($data["Description"]),
        "Date" => date("Y-m-d h:i:s", strtotime($data["Date"])),
        "Status" => htmlspecialchars($data["Status"]),
    );
    }
    return $news;
}

function getUser($database, $limit): array
    {

    $query = $database->query("SELECT * FROM user ORDER BY Id DESC LIMIT 0, $limit");  
    $news = array();
    while ($data = $query->fetch())
    {
    $news[] = array(
    "Id" => intval($data["id"]),
    "Name" => htmlspecialchars($data["name"]),
    "Email" => htmlspecialchars_decode($data["email"]),

    );
    }
    return $news;
}

