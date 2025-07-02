<?php $title = "Moniteur"; ?>
<div class="dashboard-content">
    <div class="dashboard-main-content">
        <div class="dashboard-page-header">
            <h2>Moniteur</h2>
            <div class="action-group">
                <a id="start-jitsi-button" href="#" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'camera.svg'?>" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Démarrer une visio</h3>
                </a>
                <a id="share-link-button" href="#" style="display:none" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'share.svg'?>" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Partager le lien</h3>
                </a>
            </div>
        </div>

        <div id="jitsi-container" style="display:none;" class="_2-grid">
            <!-- Conteneur pour l'iframe Jitsi -->
        </div>
    </div>
</div>

<script>
    let currentRoomName = "";
    const jitsiContainer = document.getElementById("jitsi-container");
    const startButton = document.getElementById("start-jitsi-button");
    const shareLinkButton = document.getElementById("share-link-button");

    // Génère un nom de salle aléatoire
    const generateRoomName = () => `room-${Math.random().toString(36).substr(2, 9)}`;

    // Crée l'iframe Jitsi
    const createJitsiFrame = (roomName) => {
        currentRoomName = roomName;
        jitsiContainer.innerHTML = `
            <div class="jitsi-module">
                <div class="module-header">
                    <h3 class="module-heading">Salle de visio</h3>
                </div>
                <iframe 
                    src="https://meet.jit.si/${roomName}?config.disableAP=true"
                    allow="camera; microphone; fullscreen"
                    style="width: 100%; height: 500px; border: 0; border-radius: 8px;">
                </iframe>
            </div>
        `;
    };

    // Démarrer Jitsi
    startButton.addEventListener("click", (e) => {
        e.preventDefault();
        jitsiContainer.style.display = "";
        shareLinkButton.style.display = "";
        createJitsiFrame(generateRoomName());
    });

    // Partager le lien
    shareLinkButton.addEventListener("click", (e) => {
        e.preventDefault();
        const roomLink = `https://meet.jit.si/${currentRoomName}`;
        
        // Méthode 1 : Copier dans le presse-papier
        navigator.clipboard.writeText(roomLink).then(() => {
            alert("Lien copié ! Envoyez-le aux participants.");
        });
        
        // Méthode 2 : Ouvrir un modal avec le lien
        // alert(`Lien à partager : ${roomLink}`);
    });
</script>