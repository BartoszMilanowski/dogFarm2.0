<?php

session_start();
require_once "../configure/db_connect.php";

$contactQuery = $dbPl->prepare('SELECT * FROM contact WHERE id = 1');
$contactQuery->execute();
$contact = $contactQuery->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include "configure/head.php" ?>

    <title>
        Edytuj "kontakt"
    </title>
</head>

<body class="pb-5">
    <div class="container">
        <?php
        include "components/nav.php"; ?>

        <h1 class="py-3">Kontakt</h1>

        <?php

        if (isset($_SESSION['result'])) {

            $resultClass = isset($_SESSION['error']) ? 'error-class' : 'success-class';
            if (isset($_SESSION['error'])) {
                unset($_SESSION['error']);
            }

            echo "<p class='$resultClass'>{$_SESSION['result']}</p>";
            unset($_SESSION['result']);
        }
        ?>

        <form action="controllers/editContact.php" method="post">
            <div class="form-group">
                <label for="name" class="form-label">Imię i nazwisko</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $contact['name'] ?>" />
            </div>
            <div class="form-group">
                <label for="phone" class="form-label">Numer telefonu</label>
                <input type="tel" class="form-control" id="phone" name="phone" pattern="\+\d{1,4} \d{3}-\d{3}-\d{3}"
                    value="<?= $contact['phone'] ?>" />
                <small>Format: +48 123-456-789</small>
            </div>
            <div class="form-group">
                <label for="address" class="form-label">Adres</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="<?= $contact['address'] ?>" />
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Adres e-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $contact['email'] ?>" />
            </div>
            <div class="form-group">
                <label for="fb-link" class="form-label">Link do profilu Facebook</label>
                <input type="text" class="form-control" id="fb-link" name="fb-link"
                    value="<?= $contact['fb_link'] ?>" />
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Zapisz" />
            </div>
        </form>

    </div>
</body>

</html>