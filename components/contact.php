<?php

require_once 'configure/db_connect.php';

$contactQuery = "SELECT contact_data FROM contact WHERE id = 1";

$result = $db->query($contactQuery);
if ($result) {
    $row = $result->fetch();
    if ($row) {
        $contactData = json_decode($row["contact_data"], true);
    }
}

$link_tel = "tel:" . $contactData["phone"];
$link_mail = "mailto:" . $contactData["email"];
$link_fb = $contactData['fb_link'];


?>

<!-- Contact -->
<section id="contact">
    <h2>
        <?= $_SESSION['lang'] == 'pl' ? "Kontakt" : "Contact" ?>
    </h2>
    <div class="contact-data">
        <span>
            <?= "{$contactData['name']}" ?>,
        </span>
        <span><a href="<?= $link_tel ?>">
                <?= "{$contactData['phone']}" ?>,
            </a></span>
        <span>
            <?= "{$contactData['address']}" ?>,
            <?= $_SESSION['lang'] == 'pl' ? '' : "Poland,"?>
        </span>
        <span><a href="<?= $link_mail ?>">
                <?= "{$contactData['email']}" ?>
            </a></span>
        <span><a href="<?= $link_fb ?>" target="_blank"><img class="sm-icon" src="images/facebook.png"></a></span>
    </div>
</section>