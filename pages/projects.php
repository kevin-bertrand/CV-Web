<section id="projects-section">
    <div class="container">
        <div class="row">
            <div class="col-4 offset-md-2 section-header">
                <h2>Projets</h2>
                <div class="brown-divider"></div>
            </div>
        </div>

        <div class="container text-center projects-category-btns">
            <div class="col align-self-center">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check project-category-btn" name="btnradio" id="btnradio1" checked onclick="changeList('all')">
                    <label class="btn btn-outline-primary btn-lg" for="btnradio1">Tous</label>

                    <input type="radio" class="btn-check project-category-btn" name="btnradio" id="btnradio2" onclick="changeList('iOS')">
                    <label class="btn btn-outline-primary btn-lg" for="btnradio2">iOS</label>

                    <input type="radio" class="btn-check project-category-btn" name="btnradio" id="btnradio3" onclick="changeList('automation')">
                    <label class="btn btn-outline-primary btn-lg" for="btnradio3">Automatisation</label>
                </div>
            </div>
        </div>

        <div id="projects-list"></div>

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
            captionText.innerHTML = object.replace(/&ensp/g, " ");
            newButton.setAttribute('href', src);
        }

        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            navigationBar.style.display = "block";
            modal.style.display = "none";
        }

        var projectsList = document.getElementById("projects-list");
        var projects = {};
        const months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];

        function downloadProjects() {
            $.ajax({
                url: 'http://cv.desyntic.com:2570/project',
                "headers": {
                    "accept": "application/json",
                    "Access-Control-Allow-Origin":"*"
                }
            })
            .done(function (data) {
                data.sort(function(a, b){
                    return new Date(b.date) - new Date(a.date)
                });
                projects = data;
                changeList("all");
            })
            .fail(function (xhr, textStatus, errorThrown) {
                alert(xhr.responseText);
                alert(textStatus);
                console.log(errorThrown);
            });
        }

        window.onload = downloadProjects;

        function escapeHtml(text) {
            var map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            
            return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }

        function changeList(selection) {
            removeList();

            projects.forEach(project => {
                if (selection === "all" || selection === project["category"]) {
                    let projectDate = new Date(project.date * 1000);
                    projectsList.innerHTML += `<div class="row justify-content-between project-view align-items-center"> \n \
                        <div class="col-md-6 project_image"> \n \
                            <img src="public/img/` + project.mediaPath + `" onclick="showModal('public/img/` + project.mediaPath + `','` + escapeHtml(project.title) + `')"/> \n \
                        </div> \n \
                        <div class="col-md-5"> \n \
                        <h3>` + project.title + `</h3> \n \
                        <h4>` + project.company + `</h4> \n \
                        <p class="text-muted"><small><i class="bi bi-clock"></i> ` + months[projectDate.getMonth()] + ` ` + projectDate.getFullYear() + `</small></p> \n \
                        <p>` + project.description + `</p> \n \ `
                        + (("github" in project) ? (` <p><a href='` + project.github + `' target="_blank"><i class="bi bi-github"></i> Lien GitHub du projet</a></p>\n \ `) : ``) + `
                    </div>
                    `
                }
            });
        }

        function removeList() {
            projectsList.innerHTML = '';
        }
    </script>
</section>
