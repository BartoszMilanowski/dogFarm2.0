<?php
session_start();
require_once "../../configure/db_connect.php";

if(isset($_POST['name']) && isset( $_POST['phone'])
    && isset($_POST['address']) && isset($_POST['email']) 
    && isset($_POST['fb-link'])){

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $linkFb = $_POST['fb-link'];

        $query = "UPDATE contact SET name = :name, phone = :phone, address = :address, email = :email, fb_link = :fbLink WHERE id = 1";
        
        $stmtPl = $dbPl->prepare($query);
        $stmtPl->bindParam(":name", $name, PDO::PARAM_STR);
        $stmtPl->bindParam(":phone", $phone);
        $stmtPl->bindParam(":address", $address);
        $stmtPl->bindParam(":email", $email);
        $stmtPl->bindParam(":fbLink", $linkFb);
        $stmtPl->execute();

        $stmtEn = $dbEn->prepare($query);
        $stmtEn->bindParam(":name", $name, PDO::PARAM_STR);
        $stmtEn->bindParam(":phone", $phone);
        $stmtEn->bindParam(":address", $address);
        $stmtEn->bindParam(":email", $email);
        $stmtEn->bindParam(":fbLink", $linkFb);
        $stmtEn->execute();

        $_SESSION['result'] = "Dane zaktualizowane";
        header('Location: ../contact.php');
    }