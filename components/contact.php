<?php

require_once 'configure/db_connect.php';

if($_SESSION['lang'] == 'pl'){
    $db = $dbPl;
} else{
    $db = $dbEn;
}


$contactQuery  =$db->prepare('SELECT * FROM contact WHERE id = 1');
$contactQuery->execute();
$contact = $contactQuery->fetch(PDO::FETCH_ASSOC);

$linkTel = "tel:" . $contact["phone"];
$linkMail = "mailto:" . $contact["email"];
$linkFb = $contact['fb_link'];

?>

<!-- Contact -->
<section id="contact">
    <h2>
        <?= $_SESSION['lang'] == 'pl' ? "Kontakt" : "Contact" ?>
    </h2>
    <div class="contact-data">
        <span>
            <?= "{$contact['name']}" ?>,
        </span>
        <span><a href="<?= $linkTel ?>">
                <?= "{$contact['phone']}" ?>,
            </a></span>
        <span>
            <?= "{$contact['address']}" ?>,
            <?= $_SESSION['lang'] == 'pl' ? '' : "Poland,"?>
        </span>
        <span><a href="<?= $linkMail ?>">
                <?= "{$contact['email']}" ?>
            </a></span>
        <span><a href="<?= $linkFb ?>" target="_blank"><img class="sm-icon" src="images/icons/facebook.png"></a></span>
    </div>
</section>