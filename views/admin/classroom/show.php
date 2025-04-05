<?php $title = $params['class']['nom'];?>
<div class="dashboard-main-content">
    <div class="dashboard-page-header">
        <h2>Détails</h2>
    </div>
    <div class="container">
        <div class="_2-5-1-grid">
            <div class="module-group">
                <div class="module">
                    <div class="module-header">
                        <h3 class="module-heading">Informations de l'étudiant</h3>
                    </div>
                    <div class="module-main">
                        <div class="_50-width">
                            <div class="field-label">Nom</div>
                            <p><?=$params['class']['nom']?></p>
                        </div>
                        <div class="_50-width">
                            <div class="field-label">Date de création</div>
                            <p><?=$params['class']['dateCreation']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="w-node-_78978071-a043-772a-06ef-09b2a97f8681-43db2df1" class="action-group">
                <a href="#" onclick="showPopup()" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'files.svg'?>" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Publier Cours</h3>
                </a>
                <a href="#" onclick="showPopupAssignTask()" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'student.svg'?>" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Ajouter un stagiaire</h3>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Popup Form for Sending Letter -->
<div id="popupForm" class="popup-form" style="display: none;">
    <div class="popup-content">
        <button onclick="hidePopup()" class="close-button">X</button>
        <form action="/schl-hub/admin/classroom/:id" method="post">
            <label for="file" class="custum-file-upload">
                <div class="icon">
                    <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path> </g></svg>
                </div>
                <div class="text">
                    <span class="settings-label" >Charger un fichier</span>
                </div>
                <input name="file" id="file" type="file" accept=".pdf, .ppt, .pptx, .doc, .docx" required>
            </label>
            <div class="spacer _16"></div>
            <input type="submit" value="Envoyer" data-wait="Veuillez patienter..." class="button no-margin w-button"/>
        </form>
    </div>
</div>

<!-- Popup Form for Assign Task -->
<div id="popupAssignTask" class="popup-form" style="display: none;">
    <div class="popup-content">
        <button onclick="hidePopupAssignTask()" class="close-button">X</button>
        <form action="admin/classroom/<?=$params['class']['idClasse']?>" method="post">
            <label for="task-title" class="field-label">Email du stagiaire</label>
            <input type="email" class="simple-input no-margin w-input" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" 
            title="Veuillez entrer un email valide." name="email_stagiaire" data-name="Task Title" placeholder="Entrez l'email du  stagiaire" id="task-title" required/>
            <div class="spacer _16"></div>
            <input type="submit" value="Ajouter" data-wait="Veuillez patienter..." class="button no-margin w-button"/>
        </form>
    </div>
</div>

<style>
    .module-main {
        display: flex;
        flex-wrap: wrap;
    }

    ._50-width {
        width: 50%; /* 2 éléments par rangée */
        box-sizing: border-box; /* Pour inclure padding et border dans la largeur */
    }

    .field-label {
        font-weight: bold; /* Met en gras les étiquettes */
    }

    /* Styles pour les écrans plus petits */
    @media (max-width: 600px) {
        ._50-width {
            width: 100%; /* 1 élément par rangée sur les petits écrans */
        }
    }

    .popup-form {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000; /* Ensure the popup is on top */
    }

    .popup-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        width: 300px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .close-button {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>

<script>
    function showPopup() {
        document.getElementById('popupForm').style.display = 'flex';
    }

    function hidePopup() {
        document.getElementById('popupForm').style.display = 'none';
    }

    function showPopupAssignTask() {
        document.getElementById('popupAssignTask').style.display = 'flex';
    }

    function hidePopupAssignTask() {
        document.getElementById('popupAssignTask').style.display = 'none';
    }

    // Fermer le pop-up en cliquant en dehors de celui-ci
    window.onclick = function(event) {
        if (event.target === document.getElementById('popupForm')) {
            hidePopup();
        }
        if (event.target === document.getElementById('popupAssignTask')) {
            hidePopupAssignTask();
        }
    }
</script>