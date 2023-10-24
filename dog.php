<?php
session_start();
require_once 'configure/db_connect.php';

$dogId = $_GET['id'];

$query = $db->prepare("SELECT * FROM dogs WHERE Id = :dogId");
$query->bindParam(':dogId', $dogId);
$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <script async src="https://kit.fontawesome.com/6cc05e1e8e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> Labrador Retriever - Z Krainy Narwi demo</title>
</head>

<body>
    <!-- Navbar -->
    <?php include 'components/navbar.php' ?>
    <section id="about-dog">
        <div class="about-dog">
            <div class="about-dog-img">
                <img src="images/dog1.jpg" />
            </div>
            <div class="about-dog-text">
                <span class="dog-name">Hiro-Haruko Zandalle</span>
                <span class="by-judges-title">W oczach sędziów</span>
                <p class="by-judges">Głowa doskonała, o szlachetnym wyrazie, proporcjonalnie zbudowany, prawidłowe
                    kątowanie kończyn,
                    dobra pigmentacja oka, dobrze osadzony ogon, doskonały w ruchu.</p>
            </div>
        </div>
    </section>
    <!--Gallery-->
    <section id="about-gallery">
        <div class="gallery">
            <div class="gallery-item">
                <img src="images/labrador-main.jpg" />
            </div>
            <div class="gallery-item">
                <img src="images/lagotto-main.jpg" />
            </div>
            <div class="gallery-item">
                <img src="images/labrador-chocolate.jpg" />
            </div>
            <div class="gallery-item">
                <img src="images/labrador2.jpg" />
            </div>
            <div class="gallery-item">
                <img src="images/bichon-main.jpg" />
            </div>
            <div class="gallery-item">
                <img src="images/chiuahua-main.jpg" />
            </div>
        </div>
    </section>
    <?php include 'components/contact.php' ?>
    <?php include 'components/footer.php' ?>
</body>

</html>