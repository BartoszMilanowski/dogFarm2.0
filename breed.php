<?php
session_start();
require_once 'configure/db_connect.php';

if ($_SESSION['lang'] == 'pl') {
    $db = $dbPl;
} else {
    $db = $dbEn;
}

$breedId = $_GET['id'];

$breedQuery = $db->prepare("SELECT * FROM breeds WHERE id = :breedId");
$breedQuery->bindParam(':breedId', $breedId);
$breedQuery->execute();
$breedResult = $breedQuery->fetch(PDO::FETCH_ASSOC);

$mainPhotoQuery = $db->prepare('SELECT * FROM photos WHERE id = :imageId');
$mainPhotoQuery->bindParam('imageId', $breedResult['photo_id']);
$mainPhotoQuery->execute();
$mainPhoto = $mainPhotoQuery->fetch(PDO::FETCH_ASSOC);

$galleryQuery = $db->prepare("SELECT p.link
                                FROM photo_gallery pg
                                INNER JOIN photos p ON pg.image_id = p.id
                                WHERE pg.gallery_type = 1 AND pg.gallery_id = :galleryId");
$galleryQuery->bindParam(":galleryId", $breedId);
$galleryQuery->execute();
$gallery = $galleryQuery->fetchAll(PDO::FETCH_ASSOC);

if ($breedResult['show_dogs']) {

    $dogsQuery = $db->prepare("SELECT * FROM dog WHERE breed_id = :breedId");
    $dogsQuery->bindParam(":breedId", $breedId);
    $dogsQuery->execute();
    $dogs = $dogsQuery->fetchAll(PDO::FETCH_ASSOC);

    $maleDogs = array();
    $femaleDogs = array();
    $retiredDogs = array();

    foreach ($dogs as $dog) {
        $dogCat = $dog["category"];
        switch ($dogCat) {
            case 1:
                $maleDogs[] = $dog;
                break;
            case 2:
                $femaleDogs[] = $dog;
                break;
            case 3:
                $retiredDogs[] = $dog;
                break;
            default:
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include 'configure/head.php' ?>

    <title>
        <?php
        if ($_SESSION['lang'] == 'pl') {
            echo $breedResult['name'] . ' - Z Krainy Narwi';
        } else {
            echo $breedResult['name'] . ' - From the Land of the Narew';
        }
        ?>
    </title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <!--Breed basics-->
    <section id="breed-top">
        <div class="breed-top-img">
            <img src=<?= "{$mainPhoto['link']}" ?> />
        </div>
        <div class="breed-top-text">
            <div class="breed-name">
                <?= $breedResult['name'] ?>
            </div>
            <div class="breed-basic-info">
                <span>
                    <?= $breedResult['basic_info'] ?>
                </span>
            </div>
        </div>
    </section>
    <!--Breed info-->
    <section id="breed-info">
        <ul class="breed-info-list">
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Cechy charakteryzujące" : "Characteristic features" ?>
                    </span>
                    <p>
                        <?= $breedResult['dog_character'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Wygląd" : "Appearance" ?>
                    </span>
                    <p>
                        <?= $breedResult['appearance'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Wielkość" : "Size" ?>
                    </span>
                    <p>
                        <?= $breedResult['size'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Szata" : "Coat" ?>
                    </span>
                    <p>
                        <?= $breedResult['coat'] ?>

                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Maść" : "Color" ?>
                    </span>
                    <p>
                        <?= $breedResult['ointment'] ?>

                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Głowa" : "Head" ?>
                    </span>
                    <p>
                        <?= $breedResult['head'] ?>

                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Szyja" : "Neck" ?>
                    </span>
                    <p>
                        <?= $breedResult['neck'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Oczy" : "Eyes" ?>
                    </span>
                    <p>
                        <?= $breedResult['eyes'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Uszy" : "Ears" ?>
                    </span>
                    <p>
                        <?= $breedResult['ears'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Tułów" : "Body" ?>
                    </span>
                    <p>
                        <?= $breedResult['torso'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Kończyny przednie" : "Front legs" ?>
                    </span>
                    <p>
                        <?= $breedResult['forelimbs'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Kończyny tylne" : "Back legs" ?>
                    </span>
                    <p>
                        <?= $breedResult['hind_limbs'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Ogon" : "Tail" ?>
                    </span>
                    <p>
                        <?= $breedResult['tail'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/icons/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Temperament" : "Temperament" ?>
                    </span>
                    <p>
                        <?= $breedResult['temperament'] ?>
                    </p>
                </div>
            </li>
        </ul>
    </section>
    <!--Dogs-->
    <section id="dogs">
        <?php
        if (sizeof($maleDogs) > 0) {
            if ($_SESSION['lang'] == 'pl') {
                echo "<h2>Psy</h2>";
            } else {
                echo "<h2>Male dogs</h2>";
            }

            echo '<div class="dog-list">';
            foreach ($maleDogs as $dog) {
                echo <<<EOT
                <div class="dog">
                    <a href='dog.php?id={$dog["id"]}'>
                        <img src="{$dog['main_photo']}" />
                        <span>{$dog['dog_name']}</span>
                    </a>
                </div>
                EOT;
            }
            echo '</div>';
        }

        if (sizeof($femaleDogs) > 0) {
            if ($_SESSION['lang'] == 'pl') {
                echo "<h2>Suki</h2>";
            } else {
                echo "<h2>Female dogs</h2>";
            }

            echo '<div class="dog-list">';
            foreach ($femaleDogs as $dog) {
                echo <<<EOT
                <div class="dog">
                    <a href='dog.php?id={$dog["id"]}'>
                        <img src="{$dog['main_photo']}" />
                        <span>{$dog['dog_name']}</span>
                    </a>
                </div>
                EOT;
            }
            echo '</div>';
        }
        if (sizeof($retiredDogs) > 0) {
            if ($_SESSION['lang'] == 'pl') {
                echo "<h2>Na emeryturze</h2>";
            } else {
                echo "<h2>Retired dogs</h2>";
            }

            echo '<div class="dog-list">';
            foreach ($retiredDogs as $dog) {
                echo <<<EOT
                <div class="dog">
                    <a href='dog.php?id={$dog["id"]}'>
                        <img src="{$dog['main_photo']}" />
                        <span>{$dog['dog_name']}</span>
                    </a>
                </div>
                EOT;
            }
            echo '</div>';
        }
        ?>
    </section>
    <!--Gallery-->
    <?php
    if (sizeof($gallery) > 0) {
        echo '<section id="about-gallery">';
        if ($_SESSION['lang'] == 'pl') {
            echo '<h2>Galeria</h2>';
        } else {
            echo '<h2>Gallery</h2>';
        }

        echo '<div class="gallery">';
        foreach ($gallery as $item) {
            echo <<<EOT
            <div class="gallery-item">
                <img src="{$item['link']}" />
            </div>
            EOT;
        }
        echo <<<EOT
        </div>
        </section>
        EOT;
    }
    ?>
    <?php include 'components/contact.php' ?>
    <?php include 'components/footer.php' ?>
</body>

</html>