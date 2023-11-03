<?php
session_start();
require_once 'configure/db_connect.php';

if ($_SESSION['lang'] == 'pl') {
    $db = $dbPl;
} else {
    $db = $dbEn;
}

$breedsQuery = $db->query('SELECT * FROM breeds');
$breeds = $breedsQuery->fetchAll();

?>

<!-- Navbar -->
<nav class="navbar">
    <a href="index.php">
        <img class="navbar-logo" src="images/logo.png" />
    </a>
    <ul class="menu-list">
        <i class="fas fa-times close-menu"></i>
        <li><a class="menu-link" href="about.php">
                <?= $_SESSION['lang'] == 'pl' ? 'O nas' : "About" ?>
            </a></li>
        <?php
        foreach ($breeds as $breed) {
            echo "<li><a
                class='menu-link'
                href='breed.php?id={$breed["id"]}'>
                {$breed['name']}
                </a></li>";
        }
        ?>
        <li><a class="menu-link" href="index.php#contact">
                <?= $_SESSION['lang'] == 'pl' ? 'Kontakt' : "Contact" ?>
            </a></li>
        <li>
            <a href="configure/change-lang.php">
                <img class="lang-icon" src=<?= $_SESSION['lang'] == 'en' ? 'images/icons/poland.png' : "images/icons/united-kingdom.png" ?> />
            </a>
        </li>
    </ul>
    <i class="fas fa-bars burger-icon"></i>
</nav>