<?php $title = "Moniteur"; ?>
<div class="dashboard-content">
    <div class="dashboard-main-content">
        <div class="dashboard-page-header">
            <h2>Moniteur</h2>
            <div class="action-group">
                <a id="start-button" href="#" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'camera.svg'?>" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Démarrer la caméra</h3>
                </a>
                <a href="#" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'projector.svg'?>" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Lancer un screen-sharing</h3>
                </a>
                <a id="add-screen-button" href="#" style="display:none" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'camera-plus.svg'?>" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Rajouter un écran</h3>
                </a>
            </div>
        </div>

        <div id="screen-container" style="display:none;" class="_2-grid">
            <!-- Écran 1 ajouté dynamiquement -->
        </div>
    </div>
</div>

<script>
    let screenCount = 0;
    let stream = null;

    const screenContainer = document.getElementById("screen-container");
    const startButton = document.getElementById("start-button");
    const addScreenButton = document.getElementById("add-screen-button");

    const createScreen = (id) => {
        const wrapper = document.createElement("div");
        wrapper.className = "module";
        wrapper.innerHTML = `
            <div class="module-header">
                <h3 class="module-heading">Écran ${id}</h3>
                <div class="module-filters">
                    <a href="#" class="stop-button module-button add w-button" data-screen="${id}">✖</a>
                </div>
            </div>
            <div class="module-main">
                <video id="video-${id}" autoplay playsinline></video>
            </div>
        `;
        screenContainer.appendChild(wrapper);
        const video = wrapper.querySelector("video");
        video.srcObject = stream;

        // Stop button pour cet écran
        const stopBtn = wrapper.querySelector(".stop-button");
        stopBtn.addEventListener("click", () => {
            const vid = wrapper.querySelector("video");
            if (vid && vid.srcObject) {
                vid.srcObject.getTracks().forEach(track => track.stop());
                vid.srcObject = null;
            }
            wrapper.remove();
            screenCount--;
            if (screenCount === 0) {
                screenContainer.style.display = "none";
                addScreenButton.style.display = "none";
                startButton.disabled = false;
                alert("Visio arrêtée.");
            } else {
                addScreenButton.style.display = "";
            }
        });
    };

    startButton.addEventListener("click", () => {
        navigator.mediaDevices.getUserMedia({ video: true }).then(mediaStream => {
            stream = mediaStream;
            screenCount = 1;
            screenContainer.innerHTML = "";
            screenContainer.style.display = "";
            addScreenButton.style.display = "";
            startButton.disabled = true;
            createScreen(screenCount);
            alert("Démarrage de la visio effectué avec succès");
        }).catch(error => {
            console.error("Erreur caméra :", error);
            alert("Erreur d'accès à la caméra !");
        });
    });

    addScreenButton.addEventListener("click", () => {
        if (screenCount < 4) {
            createScreen(++screenCount);
            if (screenCount === 4) {
                addScreenButton.style.display = "none";
            }
        }
    });
</script>

<style>
    video {
        width: 100%;
        max-width: 640px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .module {
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 12px;
        background: #fafafa;
    }
</style>
