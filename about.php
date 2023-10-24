<?php
session_start();

require_once 'configure/db_connect.php';

$aboutQuery = "SELECT * FROM about WHERE Id = 1";
$result = $db->query($aboutQuery);
if ($result) {
    $row = $result->fetch();
    if ($row) {
        $intro = $row['about_intro'];
        $main = $row ['about_main'];
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

    <title>
        <?php
        if($_SESSION['lang'] == 'pl'){
            echo 'O nas - Z Krainy Narwi';
        } else {
            echo 'About us - From the Land of the Narew';
        }
        ?>
    </title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <!--About-->
    <section id="about-page">
        <div class="about-page-first">
            <div class="about-page-image">
                <img src="images/labrador-chocolate.jpg">
            </div>
            <div class="about-page-text-first">
                <p>
                    <?= "{$intro}"?>
                </p>
            </div>
        </div>
        <div class="about-page-content">
            <?= "{$main}"?>
           
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