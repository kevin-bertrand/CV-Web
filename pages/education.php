<?php
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "http://cv.desyntic.com:2570/education");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
$educations = json_decode($output, true)
?>

<section id="education">
    <div class="container">
        <div class="row">
            <div class="col-4 offset-md-2 section-header">
                <h2>Éducation</h2>
                <div class="brown-divider"></div>
            </div>
        </div>


        <div class="row justify-content-center">
            <?php
            foreach (array_reverse($educations) as &$education) {
                ?>
                <div class="col-md-6">
                    <div class="education-block">
                        <h5><?= date("Y", $education["endingDate"]) ?></h5>
                        <i class="bi bi-book-half"></i>
                        <?php
                            if (isset($education["document"])) {
                                echo "<a href='" . $education["document"] . "' target='_blank'><h3>" . $education["school"] . "</h3></a>";
                            } else {
                                echo "<h3>" . $education["school"] . "</h3>";
                            }
                        ?>
                        <h4><?= $education["title"] ?></h4>
                        <h5><?= $education["location"] ?></h5>
                        <div class="red-divider"></div>
                        <?php
                        foreach ($education["subjects"] as &$subject) {
                            ?>
                            <p><?= $subject ?></p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>