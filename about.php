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
        $mainPhoto = $row['about_image'];
    }
}

$galleryQuery = $db->prepare("SELECT i.*
FROM images AS i
INNER JOIN photo_gallery AS pg ON i.Id = pg.photo_id
WHERE pg.gallery_type = 3 AND pg.gallery_id = 1");
$galleryQuery->execute();
$gallery = $galleryQuery->fetchAll();

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
                <img src= <?= "{$mainPhoto}" ?> />
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

    <?php

    if(sizeof($gallery) > 0){
        echo<<<EOT
            <section id="about-gallery">
                <div class="gallery">
        EOT;
        foreach($gallery as $item){
            echo<<<EOT
                <div class="gallery-item">
                    <img src="{$item['link']}" />
                </div>
            EOT;
        }
        echo<<<EOT
                </div>
            </section>
        EOT;
    }
    ?>

    <?php include 'components/contact.php' ?>
    <?php include 'components/footer.php' ?>
</body>
</html>