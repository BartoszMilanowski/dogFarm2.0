<?php
session_start();
require_once 'configure/db_connect.php';


$breedId = $_GET['id'];

$breedQuery = $db->prepare("SELECT * FROM breeds WHERE Id = :breedId");
$breedQuery->bindParam(':breedId', $breedId);
$breedQuery->execute();

$breedResult = $breedQuery->fetch(PDO::FETCH_ASSOC);

$dogsQuery = $db->prepare("SELECT * FROM dog WHERE breed_id = :breedId");
$dogsQuery->bindParam(":breedId", $breedId);
$dogsQuery->execute();
$dogs = $dogsQuery->fetchAll();

$maleDogs = array();
$femaleDogs = array();
$retiredDogs = array();

foreach($dogs as $dog){
    $dogCat = $dog["category"];
    switch($dogCat){
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
            <img src="images/labrador-main.jpg" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
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
                    <img src="images/pawprint.png" />
                </div>
                <div>
                    <span>
                        <?= $_SESSION['lang'] == 'pl' ? "Kończyny tylne" : "Back legs" ?>
                    </span>
                    <p>
                        <?= $breedResult['hind limbs'] ?>
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
                        <?= $breedResult['tail'] ?>
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
                        <?= $breedResult['temperament'] ?>
                    </p>
                </div>
            </li>
        </ul>
    </section>
    <!--Dogs-->
    <section id="dogs">
        <?php 
        if(sizeof($maleDogs) > 0){
            if($_SESSION['lang'] == 'pl'){
                echo "<h2>Psy</h2>";
            } else {
                echo "<h2>Male dogs</h2>";
            }

            echo '<div class="dog-list">';
            foreach($maleDogs as $dog){
echo <<<EOT
                <div class="dog">
                <a href='dog.php?id={$dog["Id"]}'>
                    <img src="images/dog1.jpg" />
                    <span>{$dog['dog_name']}</span>
                </a>
            </div>
EOT;
            }
            echo '</div>';
        }

        if(sizeof($femaleDogs) > 0){
            if($_SESSION['lang'] == 'pl'){
                echo "<h2>Suki</h2>";
            } else {
                echo "<h2>Female dogs</h2>";
            }

            echo '<div class="dog-list">';
            foreach($maleDogs as $dog){
echo <<<EOT
                <div class="dog">
                <a href='dog.php?id={$dog["Id"]}'>
                    <img src="images/dog1.jpg" />
                    <span>{$dog['dog_name']}</span>
                </a>
            </div>
EOT;
            }
            echo '</div>';
        }
        if(sizeof($retiredDogs) > 0){
            if($_SESSION['lang'] == 'pl'){
                echo "<h2>Na emeryturze</h2>";
            } else {
                echo "<h2>Retired dogs</h2>";
            }

            echo '<div class="dog-list">';
            foreach($maleDogs as $dog){
echo <<<EOT
                <div class="dog">
                <a href='dog.php?id={$dog["Id"]}'>
                    <img src="images/dog1.jpg" />
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
    <section id="about-gallery">
        <h2>
        <?= $_SESSION['lang'] == 'pl' ? 'Galeria' : "Gallery" ?>
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