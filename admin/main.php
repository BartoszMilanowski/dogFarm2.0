<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include "configure/head.php" ?>
    <title>
        Z Krainy Narwi - CMS
    </title>
</head>

<body>
    <div class="container">
        <?php include "components/nav.php" ?>
        <h1 class="py-3">Z Krainy Narwi - system zarządzania treścią</h1>

        <div>
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">O nas</th>
                        <td class="col-1"><a href="about.php" class="btn btn-primary" role="button">Edytuj</td>
                        <!-- <td class="col-1"><a href="#" target="_blank" class="btn btn-primary" role="button">Podgląd</td> -->
                    </tr>
                    <tr>
                        <th scope="row">Motto</th>
                        <td class="col-1"><a href="motto.php" class="btn btn-primary" role="button">Edytuj</td>
                        <!-- <td class="col-1"><a href="#" target="_blank" class="btn btn-primary" role="button">Podgląd</td> -->
                    </tr>
                    <tr>
                        <th scope="row">Kontakt</th>
                        <td class="col-1"><a href="contact.php" class="btn btn-primary" role="button">Edytuj</td>
                        <!-- <td class="col-1"><a href="#" target="_blank" class="btn btn-primary" role="button">Podgląd</td> -->
                    </tr>
                    <tr>
                        <th scope="row">Rasy</th>
                        <td class="col-1"><a href="breedList.php" class="btn btn-primary" role="button">Wyświetl</td>
                        <!-- <td class="col-1"><a href="#" target="_blank" class="btn btn-primary" role="button">Podgląd</td> -->
                    </tr>
                    <tr>
                        <th scope="row">Psy</th>
                        <td class="col-1"><a href="#" class="btn btn-primary" role="button">Wyświetl</td>
                        <!-- <td class="col-1"><a href="#" target="_blank" class="btn btn-primary" role="button">Podgląd</td> -->
                    </tr>
                    <tr>
                        <th scope="row">Zdjęcia</th>
                        <td class="col-1"><a href="photos.php" class="btn btn-primary" role="button">Wyświetl</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



</body>

</html>