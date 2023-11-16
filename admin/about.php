<?php

session_start();
require_once "../configure/db_connect.php";

$aboutQueryPl = $dbPl->prepare('SELECT * FROM about WHERE id = 1');
$aboutQueryPl->execute();
$aboutPl = $aboutQueryPl->fetch(PDO::FETCH_ASSOC);

$aboutQueryEn = $dbEn->prepare('SELECT * FROM about WHERE id = 1');
$aboutQueryEn->execute();
$aboutEn = $aboutQueryEn->fetch(PDO::FETCH_ASSOC);

$currentPhoto = "../" . $aboutPl['about_image'];
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
        <?php
        include "components/nav.php";

        if (isset($_SESSION['result'])) {
            echo $_SESSION['result'];
            unset($_SESSION['result']);
        }
        ?>

        <h1 class="py-3">O nas</h1>

        <form action="controllers/editAbout.php" method="post">
            <div class="form-group">
                <label for="aboutIntro" class="form-label">O nas - wstęp</label>
                <textarea class="form-control" id="aboutIntro" name="aboutIntro"
                    style="min-height: 200px"><?= "{$aboutPl['about_intro']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMain" class="form-label">O nas - tekst główny</label>
                <textarea class="form-control" id="aboutMain" name="aboutMain"
                    style="min-height: 200px"><?= "{$aboutPl['about_main']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutIntroEn" class="form-label">O nas - wstęp [wersja angielska]</label>
                <textarea class="form-control" id="aboutIntroEn" name="aboutIntroEn"
                    style="min-height: 200px"><?= "{$aboutEn['about_intro']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMainEn" class="form-label">O nas - tekst główny [wersja angielska]</label>
                <textarea class="form-control" id="aboutMainEn" name="aboutMainEn"
                    style="min-height: 200px"><?= "{$aboutEn['about_main']}" ?></textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Zapisz" />
            </div>
        </form>

        <form class="my-5" action="controllers/uploadPhoto.php" method="post" enctype="multipart/form-data">
            <label for="currentPhoto">Zdjęcie główne</label><br/>
            <img class="currentPhoto my-2" name="currentPhoto" id="currentPhoto" src="<?=$currentPhoto?>"><br/>
            <input type="file" name="file" id="file">
            <br/><button class="btn btn-primary my-2" type="submit" name="submit">Prześlij</button>
        </form>
    </div>
</body>
</html>