<?php

session_start();
require_once "../configure/db_connect.php";

$allPhotosQuery = $dbPl->prepare('SELECT * FROM photos');
$allPhotosQuery->execute();
$allPhotos = $allPhotosQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include "configure/head.php" ?>

    <title>
        Edytuj listę zdjęć.
    </title>
</head>

<body class="pb-5">
    <div class="container">
        <?php
        include "components/nav.php";

        if (isset($_SESSION['result'])) {
            echo $_SESSION['result'];
            unset($_SESSION['result']);
        }
        ?>
        <h1 class="py-3">Zdjęcia</h1>

        <button class="btn btn-primary showList" data-target='list1'>Dodaj zdjęcie</button>

        <form class="my-5 hidden" action="controllers/uploadPhoto.php" method="post"
            enctype="multipart/form-data" id='list1'>
            <label for="currentPhoto">Dodaj zdjęcie</label><br />
            <img class="currentPhoto my-2" name="currentPhoto" id="currentPhoto" src="<?= $currentPhoto ?>"><br />
            <input type="file" name="file" id="file">
            <div class="form-group">
                <label for="aboutMainEn" class="form-label">Opis zdjęcia</label>
                <textarea class="form-control" id="aboutPl" name="aboutPl" style="min-height: 200px"></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMainEn" class="form-label">Alt</label>
                <textarea class="form-control" id="altPl" name="altPl" style="min-height: 200px"></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMainEn" class="form-label">Opis zdjęcia [En]</label>
                <textarea class="form-control" id="aboutEn" name="aboutEn" style="min-height: 200px"></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMainEn" class="form-label">Alt [En]</label>
                <textarea class="form-control" id="altEn" name="altEn" style="min-height: 200px"></textarea>
            </div>
            <br /><button class="btn btn-primary my-2" type="submit" name="submit">Prześlij</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Zdjęcie</th>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Opis alternatywny</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allPhotos as $photo): ?>
                    <tr>
                        <th scope="row">
                            <?= $photo['id'] ?>
                        </th>
                        <td><img class="currentPhoto" src="<?= '../' . $photo['link'] ?>" alt="<?= $photo['alt'] ?>" /></td>
                        <td>
                            <?= $photo['about'] ?>
                        </td>
                        <td>
                            <?= $photo['alt'] ?>
                        </td>
                        <td>
                            <a target="_blank" class="btn btn-primary" href="<?= '../' . $photo['link'] ?>">Otwórz</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="<?= 'controllers/deletePhoto.php?id=' . $photo["id"] ?>"
                                onclick="return confirm('Czy na pewno chcesz usunąć ten element?')">
                                Usuń
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>

</html>