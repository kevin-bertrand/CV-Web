<?php
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "http://localhost:2584/experience");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
$experiences = json_decode($output, true);
?>

<section id="experiences">
    <div class="container">
        <div class="row">
            <div class="col-4 offset-md-2 section-header">
                <h2>Experiences professionelles</h2>
                <div class="brown-divider"></div>
            </div>

            <ul class="timeline">
                <?php
                foreach(array_reverse($experiences) as $key=>$experience) {
                    $date = $experience["endDate"];
                    if($date == 0) {
                        $endDate = "en cours";
                    } else {
                        $endDate = date("F Y", $date);
                    }
                    ?>
                    <li>
                        <div class="timeline-badge"><i class="bi bi-briefcase-fill"></i></div>

                        <div class=<?= $key%2 == 0 ? "timeline-panel-container" : "timeline-panel-container-inverted" ?> id="xp-realdev">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3><img src=<?= "public/img/" . $experience["icon"] ?>> <?= $experience["company"] ?></h3>
                                <h4><?= $experience["title"] ?></h4>
                                <h5><?= $experience["location"] ?></h5>
                                <p class="text-muted"><small><i class="bi bi-clock"></i> <?= date("F Y", $experience["startDate"]) ?> - <?= $endDate ?></small></p>
                            </div>
                            <div class="timeline-body">
                                <?php
                                foreach($experience["missions"] as &$mission) {
                                    ?>
                                    <p>
                                        <?= $mission["title"] ?>
                                        <ul>
                                            <?php
                                            foreach(explode("|", $mission["tasks"]) as &$task) {
                                                echo "<li>" . $task . "</li>";
                                            }
                                            ?>
                                        </ul>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</section>