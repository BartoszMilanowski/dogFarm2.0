<?php

require_once 'configure/db_connect.php';

// $contactQuery = "SELECT contact_data FROM contact WHERE id = 1";

// $result = $db->query($contactQuery);
// if ($result) {
//     $row = $result->fetch();
//     if ($row) {
//         $contactData = json_decode($row["contact_data"], true);
//     }
// }

$contactQuery  =$db->prepare('SELECT * FROM contact WHERE Id = 1');
$contactQuery->execute();
$contact = $contactQuery->fetch(PDO::FETCH_ASSOC);

$link_tel = "tel:" . $contact["phone"];
$link_mail = "mailto:" . $contact["email"];
$link_fb = $contact['fb_link'];


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
        <span><a href="<?= $link_tel ?>">
                <?= "{$contact['phone']}" ?>,
            </a></span>
        <span>
            <?= "{$contact['address']}" ?>,
            <?= $_SESSION['lang'] == 'pl' ? '' : "Poland,"?>
        </span>
        <span><a href="<?= $link_mail ?>">
                <?= "{$contact['email']}" ?>
            </a></span>
        <span><a href="<?= $link_fb ?>" target="_blank"><img class="sm-icon" src="images/icons/facebook.png"></a></span>
    </div>
</section>