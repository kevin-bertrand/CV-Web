<?php
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "http://cv.desyntic.com:2570/skill");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
$skills = json_decode($output, true);


function getList($title, $skills, $section) {
    echo "<div class=\"row justify-content-center\">";
    echo "<h3>" . $title . "</h3>";
    echo "<div class=\"brown-divider\"></div>";
    echo "</div>";
    echo "<div class=\"row justify-content-evenly\">";

    foreach ($skills as $skill) {
        if ($skill["category"] == $section) {
            echo "<div class=\"col-md-1 justify-content-center\">";
            echo "<img src=\"public/img/" . $skill["image"] . "\"><br>";
            echo "<p class=\"skill-title\">" . $skill["title"] . "</p>";
            echo "</div>";
        }
    }
    echo "</div>";
}
?>

<section id="skills">
    <div class="container">
        <div class="row">
            <div class="col-4 offset-md-2 section-header">
                <h2>Compétences</h2>
                <div class="brown-divider"></div>
            </div>
        </div>

        <?php
            getList("Frontend", $skills, "frontend");
            getList("Backend", $skills, "backend");
            getList("Management", $skills, "management");
            getList("Autre", $skills, "other");
        ?>
    </div>
</section>
