<?php

session_start();
require_once "../configure/db_connect.php";

$aboutQueryPl = $dbPl->prepare('SELECT * FROM about WHERE id = 1');
$aboutQueryPl->execute();
$aboutPl = $aboutQueryPl->fetch(PDO::FETCH_ASSOC);

$aboutQueryEn = $dbEn->prepare('SELECT * FROM about WHERE id = 1');
$aboutQueryEn->execute();
$aboutEn = $aboutQueryEn->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include "configure/head.php" ?>

    <title>
        Edytuj "o nas"
    </title>
    <style>
        .form-group {
            margin-top: 2em;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include "components/nav.php" ?>

        <h1 class="py-3">O nas</h1>

        <form>
            <div class="form-group">
                <label for="aboutIntro" class="form-label">O nas - wstęp</label>
                <textarea class="form-control" id="aboutIntro"
                    style="min-height: 200px"><?= "{$aboutPl['about_intro']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMain" class="form-label">O nas - tekst główny</label>
                <textarea class="form-control" id="aboutMain"
                    style="min-height: 200px"><?= "{$aboutPl['about_main']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutIntroEn" class="form-label">O nas - wstęp [wersja angielska]</label>
                <textarea class="form-control" id="aboutIntroEn"
                    style="min-height: 200px"><?= "{$aboutEn['about_intro']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMainEn" class="form-label">O nas - tekst główny [wersja angielska]</label>
                <textarea class="form-control" id="aboutMainEn"
                    style="min-height: 200px"><?= "{$aboutEn['about_main']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMotto" class="form-label">Motto (strona główna)</label>
                <textarea class="form-control" id="aboutMotto"
                    style="min-height: 200px"><?= "{$aboutPl['motto']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMottoEn" class="form-label">Motto (strona główna) [wersja angielska]</label>
                <textarea class="form-control" id="aboutMottoEn"
                    style="min-height: 200px"><?= "{$aboutEn['motto']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="mottoAuthor" class="form-label">Autor motto</label>
                <input type="text" class="form-control" id="mottoAuthor" value="<?= "{$aboutPl['motto_author']}"?>" />
            </div>                
        </form>
    </div>

</body>

</html>