<?php

session_start();
require_once "../configure/db_connect.php";

$breedListQuery = $dbPl->prepare("SELECT id, name FROM breeds");
$breedListQuery->execute();
$breedList = $breedListQuery->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include "configure/head.php" ?>

    <title>
        Edytuj "o nas"
    </title>
</head>

<body class="pb-5">
    <div class="container">
        <?php include "components/nav.php"; ?>

        <h1 class="py-3">Lista ras</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($breedList as $breed): ?>
                    <tr>
                        <th scope="row">
                            <?= $breed['id'] ?>
                        </th>
                        <th>
                            <?= $breed['name'] ?>
                        </th>
                        <th>
                            <a href="#" class='btn btn-primary'>Edytuj</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>

</html>