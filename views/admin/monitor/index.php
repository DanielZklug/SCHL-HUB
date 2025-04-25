<?php
$title = "Moniteur";
?>
<div class="dashboard-content">
    <div class="dashboard-main-content">
        <div class="dashboard-page-header">
            <h2>Moniteur</h2>
            <div id="w-node-_78978071-a043-772a-06ef-09b2a97f8681-43db2df1" class="action-group">
                <a id="start-button" href="#" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'files.svg'?>" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Démarrer la caméra</h3>
                </a>
                <a style="display : none" id="add-screen-button" href="#" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'student.svg'?>" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Rajouter un écran</h3>
                </a>
            </div>
        </div>
        <div style="display : none;" class="_2-grid">
            <div class="module">
                <div class="module-header">
                    <h3 class="module-heading">Ecran 1</h3>
                    <div class="module-filters">
                        <a href="#" id="stop-button" class="module-button add w-button">✖</a>
                    </div>
                </div>
                <div class="module-main">
                    <video id="video" autoplay></video>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let screenCount = 1;
    let stream;
    const screenContainer = document.querySelector("._2-grid");
    const video = document.getElementById("video");
    const startButton = document.getElementById("start-button");
    const stopButton = document.getElementById("stop-button");
    const addScreenButton = document.getElementById("add-screen-button");

    startButton.addEventListener("click",()=>{
        screenContainer.style.display = "";
        addScreenButton.style.display = "";
        navigator.mediaDevices.getUserMedia({video:true}).then(stream=>{
            video.srcObject=stream;
            startButton.disabled = true;
            stopButton.disabled = false;
            alert("Démarrage de la visio effectué avec succès");
        }).catch(error => {alert("Erreur lors de l\'accès à la caméra : ", error);});
    });

    addScreenButton.addEventListener("click",()=>{
        const screen = document.createElement("div");
        screen.innerHTML = `<div class="module-header"><h3 class="module-heading">Ecran ${++screenCount}</h3><div class="module-filters"><a href="#" id="stop-button" class="module-button add w-button">✖</a></div></div><div class="module-main"><video id="video" autoplay></video></div>`;
        screenContainer.appendChild(screen);
        const video = screen.querySelector('video');
        video.srcObject = stream;

        if(screenCount == 4){
            addScreenButton.style.display = "none";
        }
    });

    stopButton.addEventListener("click", ()=>{
        screenContainer.style.display = "none";
        addScreenButton.style.display = "none";
        const stream = video.srcObject;
        stream.getTracks().forEach(track => {track.stop()});
        video.srcObject = null;
        startButton.disabled = false;
        stopButton.disabled = true;
        alert("Arrêt de la visio effectué avec succès");
    });
</script>
<style>
    video{
        width: 100%;
        height: auto;
        max-width: 640px;
        border-radius: 5px;
    }
</style>