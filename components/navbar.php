<?php
session_start();
require_once 'configure/db_connect.php';

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
                echo "<li><a class='menu-link' href='/breed.html'>{$breed['name']}</a></li>";
            }
            ?>
        <li><a class="menu-link" href="index.php#contact">
                <?= $_SESSION['lang'] == 'pl' ? 'Kontakt' : "Contact" ?>
            </a></li>
    </ul>
    <i class="fas fa-bars burger-icon"></i>
</nav>