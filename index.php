<?php

session_start();
require_once 'configure/db_connect.php';

if (!isset($_SESSION['lang_by_user'])) {
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $languages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $preferred_lang = substr($languages, 0, 2);

        $_SESSION['lang'] = $preferred_lang;


    } else {
        $_SESSION['lang'] = 'pl';
    }
}

$mainQuery = $db->prepare('SELECT * FROM about WHERE id = 1');
$mainQuery->execute();
$main = $mainQuery->fetch(PDO::FETCH_ASSOC);

$breedQuery = $db->prepare('SELECT id, name, main_photo  FROM breeds');
$breedQuery->execute();
$breedList = $breedQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include 'configure/head.php'?>

    <title>
        <?php
        if ($_SESSION['lang'] == 'pl') {
            echo 'Z Krainy Narwi - hodowla psów rasowych';
        } else {
            echo 'From the Land of the Narew - purebred dog breeding';
        }
        ?>
    </title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <!-- Slideshow -->
    <?php
    if (sizeof($breedList) > 0) {
        echo '<section id="slideshow">';
        foreach ($breedList as $breed) {
            echo <<<EOT
            <div class="slide">
                <img src="{$breed['main_photo']}"/>
                <div class="capture-text">
                    <a href="breed.php?id={$breed['id']}">{$breed['name']}</a>
                </div>
            </div>
            EOT;
        }
        echo '</section>';
    }

    ?>
    <!--Motto-->
    <section id="motto">
        <div class="motto-area">
            <div class="motto-text-area">
                <p class="motto-text">
                    <?= "{$main['motto']}" ?>
                </p>
                <span class="author">
                    <?= "{$main['motto_author']}" ?>
                </span>
            </div>
            <div class="motto-img-area">
                <img class="motto-img" src=<?= "{$main['motto_image']}"?> />
            </div>
        </div>
    </section>
    <!--About-->
    <section id="about">
        <div class="about-section">
            <div class="about-section-image">
                <img src=<?= "{$main['about_image']}"?> />
            </div>
            <div class="about-section-text">
                <p>
                    <?= "{$main['about_intro']}" ?>
                </p>
                <a class="more-link" href="about.php">
                    <?php
                    if ($_SESSION['lang'] == 'pl') {
                        echo 'Czytaj więcej &gt;&gt;';
                    } else {
                        echo 'Read more &gt;&gt;';
                    }
                    ?>
                </a>
            </div>
        </div>
    </section>
    <?php include 'components/contact.php' ?>
    <?php include 'components/footer.php' ?>
</body>

</html>