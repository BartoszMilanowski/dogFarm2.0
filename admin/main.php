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

<body class="px-3">
    <?php include "components/nav.php" ?>
    <h1 class="ps-2 py-5">Z Krainy Narwi - system zarządzania treścią</h1>

    <div class="col-5">
        <table class="table ms-2">
            <tbody>
                <tr>
                    <th scope="row">O nas</th>
                    <td class="col-1"><a href="#" class="btn btn-primary" role="button">Edytuj</td>
                    <td class="col-1"><a href="#" target="_blank" class="btn btn-primary" role="button">Podgląd</td>
                </tr>
                <tr>
                    <th scope="row">Kontakt</th>
                    <td class="col-1"><a href="#" class="btn btn-primary" role="button">Edytuj</td>
                    <td class="col-1"><a href="#" target="_blank" class="btn btn-primary" role="button">Podgląd</td>
                </tr>
                <tr>
                    <th scope="row">Rasy</th>
                    <td class="col-1"><a href="#" class="btn btn-primary" role="button">Wyświetl</td>
                    <td class="col-1"><a href="#" target="_blank" class="btn btn-primary" role="button">Podgląd</td>
                </tr>
                <tr>
                    <th scope="row">Psy</th>
                    <td class="col-1"><a href="#" class="btn btn-primary" role="button">Wyświetl</td>
                    <td class="col-1"><a href="#" target="_blank" class="btn btn-primary" role="button">Podgląd</td>
                </tr>
            </tbody>
        </table>
    </div>


</body>

</html>