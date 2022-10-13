<?php
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "http://localhost:8080/profile");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
$profile = json_decode($output, true)
?>

<section id="presentation">
    <div class="container">
        <h1>Bienvenue !</h1>
        <p id="main-presentation"><?= $profile["title"] ?></p>
        <p id="description-presentation"><?= $profile["description"] ?></p>

        <div class="row">
            <div class="col-3 offset-lg-2" id="presentation-picture">
                <img src="public/img/me.jpeg" alt="Kevin" class="rounded-circle">
            </div>
            <div class="col-9 col-lg-4 offset-lg-1" id="contact-presentation">
                <h6><a href="tel:+33778840190"><span class="bi bi-telephone-fill"></span> <?= $profile["phone"] ?></a></h6>
                <h6><a href=<?= "mailto:" . $profile["email"] ?>><i class="bi bi-envelope-open-fill"></i> <?= $profile["email"] ?></a></h6>
                <h6><a href=<?= $profile["linkedin"] ?> target="_blank"><i class="bi bi-linkedin"></i> /kevin-bertrand</a></h6>
                <h6><a href=<?= $profile["github"] ?> target="_blank"><i class="bi bi-github"></i>/kevin-bertrand</a></h6>
            </div>
        </div>
    </div>
</section>