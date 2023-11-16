<?php

session_start();

require_once "../../configure/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

        $fileName = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];

        $uploadDir = realpath('../../images/photos/') . '/';
        $filePath = $uploadDir . $fileName;
        move_uploaded_file($tmpName, $filePath);

        

    } else {
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo 'Przesłany plik przekracza rozmiar określony w pliku konfiguracyjnym PHP.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo 'Przesłany plik przekracza rozmiar określony w formularzu HTML.';
                break;
            case UPLOAD_ERR_PARTIAL:
                echo 'Plik został przesłany tylko częściowo.';
                break;
            case UPLOAD_ERR_NO_FILE:
                echo 'Plik nie został przesłany.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo 'Brak folderu tymczasowego.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo 'Błąd zapisu na dysk.';
                break;
            case UPLOAD_ERR_EXTENSION:
                echo 'Rozszerzenie PHP zatrzymało przesyłanie pliku.';
                break;
            default:
                echo 'Nieznany błąd.';
                break;
        }
    }
}