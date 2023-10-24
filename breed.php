<?php
session_start();
require_once 'configure/db_connect.php';

// $_SESSION['lang'] = 'en';

$breedId = $_GET['id'];

$query = $db->prepare("SELECT * FROM breeds WHERE Id = :breedId");
$query->bindParam(':breedId', $breedId);
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


    <title>
        <?php
        if ($_SESSION['lang'] == 'pl') {
            echo $result['name'] . ' - Z Krainy Narwi';
        } else {
            echo $result['name'] . ' - From the Land of the Narew';
        }
        ?>
    </title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <!--Breed basics-->
    <section id="breed-top">
        <div class="breed-top-img">
            <img src="images/labrador-main.jpg" />
        </div>
        <div class="breed-top-text">
            <div class="breed-name">
                <?= $result['name'] ?>
            </div>
            <div class="breed-basic-info">
                <span>
                    <?= $result['basic_info'] ?>
                </span>
            </div>
        </div>
    </section>
    <!--Breed info-->
    <section id="breed-info">
        <ul class="breed-info-list">
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Cechy charakteryzujące" : "Characteristic features" ?>
                    </span>
                    <p>
                        <?= $result['dog_character'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Wygląd" : "Appearance" ?>
                    </span>
                    <p>
                        <?= $result['appearance'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Wielkość" : "Size" ?>
                    </span>
                    <p>
                        <?= $result['size'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Szata" : "Coat" ?>
                    </span>
                    <p>
                        <?= $result['coat'] ?>

                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Maść" : "Color" ?>
                    </span>
                    <p>
                        <?= $result['ointment'] ?>

                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Głowa" : "Head" ?>
                    </span>
                    <p>
                        <?= $result['head'] ?>

                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Szyja" : "Neck" ?>
                    </span>
                    <p>
                        <?= $result['neck'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Oczy" : "Eyes" ?>
                    </span>
                    <p>
                        <?= $result['eyes'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Uszy" : "Ears" ?>
                    </span>
                    <p>
                        <?= $result['ears'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Tułów" : "Body" ?>
                    </span>
                    <p>
                        <?= $result['torso'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Kończyny przednie" : "Front legs" ?>
                    </span>
                    <p>
                        <?= $result['forelimbs'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Kończyny tylne" : "Back legs" ?>
                    </span>
                    <p>
                        <?= $result['hind limbs'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Ogon" : "Tail" ?>
                    </span>
                    <p>
                        <?= $result['tail'] ?>
                    </p>
                </div>
            </li>
            <li class="breed-info-list-item">
                <div>
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Temperament" : "Temperament" ?>
                    </span>
                    <p>
                        <?= $result['temperament'] ?>
                    </p>
                </div>
            </li>
        </ul>
    </section>
    <!--Dogs-->
    <section id="dogs">
        <h2>
            <?= $_SESSION['lang'] == 'pl' ? "Psy" : "Male dogs" ?>
        </h2>
        <div class="dog-list">
            <div class="dog">
                <a href="dog.html">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>
            <div class="dog">
                <a href="#">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>
            <div class="dog">
                <a href="#">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>
        </div>
        <h2>
            <?= $_SESSION['lang'] == 'pl' ? "Suki" : "Female dogs" ?>
        </h2>
        <div class="dog-list">
            <div class="dog">
                <a href="#">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>
            <div class="dog">
                <a href="#">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>
            <div class="dog">
                <a href="#">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>
        </div>
        <h2>
            <?= $_SESSION['lang'] == 'pl' ? "Na emeryturze" : "Retired" ?>
        </h2>
        <div class="dog-list">
            <div class="dog">
                <a href="#">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>
            <div class="dog">
                <a href="#">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>
            <div class="dog">
                <a href="#">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>
            <div class="dog">
                <a href="#">
                    <img src="images/dog1.jpg" />
                    <span>Hiro-Haruko Zandalle</span>
                </a>
            </div>

        </div>

    </section>
    <!--Gallery-->
    <section id="about-gallery">
        <h2>
            <?= $_SESSION['lang'] == 'pl' ? "Galeria" : "Gallery" ?>
        </h2>
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