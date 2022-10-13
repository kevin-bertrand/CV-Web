<?php
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "http://cv.desyntic.com:2570/training");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
$trainings = json_decode($output, true);
?>

<section id="formations">
    <div class="container">
        <div class="row">
            <div class="col-4 offset-md-2 section-header">
                <h2>Formations</h2>
                <div class="brown-divider"></div>
            </div>
        </div>

        <div class="row justify-content-center">
        	<?php
            foreach (array_reverse($trainings) as $training) {
                ?>
                <div class="col-md-6 col-lg-4">
                    <a href=<?= "public/docs/" . $training["documentPath"] ?> target="_blank">
                        <div class="formation-info img-thumbnail">
                            <h3><?= $training["title"] ?></h3>
                            <h4><img src=<?= "public/img/" . $training["icon"] ?>> <?= $training["organization"] ?></h4>
                            <h5><?= date("F Y", $training["date"]) ?></h5>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
