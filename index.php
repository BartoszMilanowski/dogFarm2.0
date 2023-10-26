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

$mainQuery = "SELECT * FROM about WHERE Id = 1";
$result = $db->query($mainQuery);
if ($result) {
    $row = $result->fetch();
    if ($row) {
        $motto = $row['motto'];
        $motto_author = $row['motto_author'];
        $about = $row['about_intro'];
        $motto_image = $row['motto_image'];
        $about_image = $row['about_image'];

    }
}

$breedQuery = $db->prepare('SELECT Id, name, main_photo_link  FROM breeds');
$breedQuery->execute();
$breedList = $breedQuery->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <script async src="https://kit.fontawesome.com/6cc05e1e8e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



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
                <img src="{$breed['main_photo_link']}"/>
                <div class="capture-text">
                    <a href="breed.php?id={$breed['Id']}">{$breed['name']}</a>
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
                    <?= "{$motto}" ?>
                </p>
                <span class="author">
                    <?= "{$motto_author}" ?>
                </span>
            </div>
            <div class="motto-img-area">
                <img class="motto-img" src=<?= "{$motto_image}"?> />
            </div>
        </div>
    </section>
    <!--About-->
    <section id="about">
        <div class="about-section">
            <div class="about-section-image">
                <img src=<?= "{$about_image}"?> />
            </div>
            <div class="about-section-text">
                <p>
                    <?= "{$about}" ?>
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