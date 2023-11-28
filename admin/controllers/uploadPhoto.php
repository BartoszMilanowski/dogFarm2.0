<?php

session_start();

require_once "../../configure/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK
        && isset($_POST['aboutPl']) && isset($_POST['altPl'])
        && isset($_POST['aboutEn']) && isset($_POST['altEn'])
    ) {

        $fileName = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];

        $aboutPl = $_POST['aboutPl'];
        $aboutEn = $_POST['aboutEn'];
        $altPl = $_POST['altPl'];
        $altEn = $_POST['altEn'];

        $query = 'INSERT INTO photos (link, about, alt) VALUES (:link, :about, :alt)';

        $uploadDir = realpath('../../images/photos/') . '/';
        $filePath = $uploadDir . $fileName;

        if (file_exists($filePath)) {
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $filePath = $uploadDir . $fileName;

            $_SESSION['result'] = "Plik o podanej nazwie już istniał.";
            header('Location: ../photos.php');
            exit;
        }

        $newFilePath = $uploadDir . $fileName;
        if (copy($tmpName, $newFilePath)) {
            unlink($tmpName);

            $link = 'images/photos/' . $fileName;

            $stmtPl = $dbPl->prepare($query);
            $stmtPl->bindParam(':link', $link, PDO::PARAM_STR);
            $stmtPl->bindParam(':about', $aboutPl, PDO::PARAM_STR);
            $stmtPl->bindParam(':alt', $altPl, PDO::PARAM_STR);
            $stmtPl->execute();

            $stmtEn = $dbEn->prepare($query);
            $stmtEn->bindParam(':link', $link, PDO::PARAM_STR);
            $stmtEn->bindParam(':about', $aboutEn, PDO::PARAM_STR);
            $stmtEn->bindParam(':alt', $altEn, PDO::PARAM_STR);
            $stmtEn->execute();


            $_SESSION['result'] = "Zdjęcie dodane";
            header('Location: ../photos.php');

        } else {
            $_SESSION['error'] = 'Błąd podczas kopiowania pliku.';
            header('Location: ../photos.php');

            echo 'Błąd: ' . error_get_last()['message'];
        }

    } else {
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $_SESSION['error'] = 'Przesłany plik przekracza rozmiar określony w pliku konfiguracyjnym PHP.';
                header('Location: ../photos.php');
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $_SESSION['error'] = 'Przesłany plik przekracza rozmiar określony w formularzu HTML.';
                header('Location: ../photos.php');
                break;
            case UPLOAD_ERR_PARTIAL:
                $_SESSION['error'] = 'Plik został przesłany tylko częściowo.';
                header('Location: ../photos.php');
                break;
            case UPLOAD_ERR_NO_FILE:
                $_SESSION['error'] = 'Plik nie został przesłany.';
                header('Location: ../photos.php');
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $_SESSION['error'] = 'Brak folderu tymczasowego.';
                header('Location: ../photos.php');
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $_SESSION['error'] = 'Błąd zapisu na dysk.';
                header('Location: ../photos.php');
                break;
            case UPLOAD_ERR_EXTENSION:
                $_SESSION['error'] = 'Rozszerzenie PHP zatrzymało przesyłanie pliku.';
                header('Location: ../photos.php');
                break;
            default:
                $_SESSION['error'] = 'Nieznany błąd.';
                header('Location: ../photos.php');
                break;
        }
    }
}