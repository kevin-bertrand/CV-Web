<?php
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "http://cv.desyntic.com:2570/project");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
$projects = json_decode($output, true);
?>

<section id="projects-section">
    <div class="container">
        <div class="row">
            <div class="col-4 offset-md-2 section-header">
                <h2>Projets</h2>
                <div class="brown-divider"></div>
            </div>
        </div>

        <?php
            foreach(array_reverse($projects) as $project) {
                ?>
                <div class="row justify-content-between project-view align-items-center">
                    <div class="col-md-6 project_image">
                        <img src=<?= "public/img/" . $project["mediaPath"] ?> onclick=<?= "showModal('public/img/" . $project["mediaPath"] . "','" . htmlspecialchars($project["title"]) . "')" ?> />
                    </div>

                    <div class="col-md-5">
                        <h3><?= $project["title"] ?></h3>
                        <h4><?= $project["company"] ?></h4>
                        <p class="text-muted"><small><i class="bi bi-clock"></i> <?= date("F Y", $project["date"]) ?></small></p>
                        <p><?= $project["description"] ?></p>
                        <p><a href=<?= $project["github"] ?> target="_blank"><i class="bi bi-github"></i> Lien GitHub du projet</a></p>
                    </div>
                </div>
                <?php
            }
        ?>

        <div id="modalImage" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="projectImage">
            <div id="caption"></div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("modalImage");        
        var modalImg = document.getElementById("projectImage");
        var navigationBar = document.getElementById("navigation");
        var captionText = document.getElementById("caption");
        var imageLink = document.getElementById("newWindow");

        let newButton = document.createElement("a");
        newButton.setAttribute('class', 'btn btn-secondary');
        newButton.setAttribute('target', '_blank');
        newButton.setAttribute('id', 'newWindow');
        newButton.textContent = "Ouvrir dans une nouvelle fenêtre";
        modal.append(newButton);

        function showModal(src, object) {
            modal.style.display = "block";
            navigationBar.style.display = "none";
            modalImg.src = src;
            captionText.innerHTML = object;
            newButton.setAttribute('href', src);
        }

        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            navigationBar.style.display = "block";
            modal.style.display = "none";
        }
    </script>
</section>
