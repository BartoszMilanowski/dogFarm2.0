<?php

session_start();
require_once "../configure/db_connect.php";

$breedListQuery = $dbPl->prepare("SELECT id, name, draft FROM breeds");
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

        <a href="breed.php?id=0" class="btn btn-primary mb-3">Dodaj rasę</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col"></th>
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
                            <?= $breed['draft'] ? '<span style="color: red; font-style: italic">Wersja robocza</span>' : '' ?>
                        </th>
                        <th>
                            <a href="breed.php?id=<?= $breed['id']?>" class='btn btn-primary'>Edytuj</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>

</html>