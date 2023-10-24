<?php

session_start();
require_once 'configure/db_connect.php';

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $languages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $preferred_lang = substr($languages, 0, 2);

    $_SESSION['lang'] = $preferred_lang;


} else {
    $_SESSION['lang'] = 'pl';
}

$mainQuery = "SELECT * FROM About WHERE Id = 1";
$result = $db->query($mainQuery);
if ($result) {
    $row = $result->fetch();
    if ($row) {
        if ($_SESSION['lang'] == 'pl') {
            $motto = $row['motto'];
            $motto_author = $row['motto_author'];
            $about = $row['about_intro'];
        } else {
            $motto = $row['motto_en'];
            $motto_author = $row['motto_author'];
            $about = $row['about_intro_en'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <script async src="https://kit.fontawesome.com/6cc05e1e8e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Z Krainy Narwi demo</title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <!-- Slideshow -->
    <section id="slideshow">
        <div class="slide">
            <img src="images/labrador-main.jpg">
            <div class="capture-text"><a href="/labrador.html">Labrador Retriever</a></div>
        </div>
        <div class="slide">
            <img src="images/bichon-main.jpg">
            <div class="capture-text"><a href="#">Bichon Frise</a></div>
        </div>
        <div class="slide">
            <img src="images/lagotto-main.jpg">
            <div class="capture-text"><a href="#">Lagotto Romangolo</a></div>
        </div>
        <div class="slide">
            <img src="images/chiuahua-main.jpg">
            <div class="capture-text"><a href="#">Chiuahua</a></div>
        </div>
    </section>
    <!--Motto-->
    <section id="motto">
        <div class="motto-area">
            <div class="motto-text-area">
                <p class="motto-text">
                    <?= "{$motto}" ?>
                </p>
                <span class="author">
                    <?= "{$motto_author}"?>
                </span>
            </div>
            <div class="motto-img-area">
                <img class="motto-img" src="images/lagotto-main.jpg">
            </div>
        </div>
    </section>
    <!--About-->
    <section id="about">
        <div class="about-section">
            <div class="about-section-image">
                <img src="images/labrador-chocolate.jpg">
            </div>
            <div class="about-section-text">
                <p>
                    <?= "{$about}"?>
                </p>
                <a class="more-link" href="/about.html">Czytaj więcej &gt;&gt;</a>
            </div>
        </div>
    </section>
    <?php include 'components/contact.php' ?>
    <?php include 'components/footer.php' ?>
</body>
</html>