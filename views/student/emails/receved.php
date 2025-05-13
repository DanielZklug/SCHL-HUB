<?php $title = "Boîte de réception"?>
<div class="dashboard-main-content">
    <div class="dashboard-page-header">
        <h2>Boîte de réception</h2>
        <a href="/schl-hub/student/emails" class="button page w-button">Messagerie</a>
    </div>
    <div class="dashboard-page-contents">
        <div class="module">
            <div class="module-main">
                <div class="email-section">
                    <h3 class="module-heading">Tous les messages</h3>
                    <?php foreach ($params["all"] as $limit): ?>
                        <a href="recever/<?=$limit['idMessage']?>" id="message" data-id="<?=$limit['idMessage']?>" class="email-element">
                            <div class="notification-top">
                                <div id="message" class="notification-dot"></div>
                                <div class="notificaiton-title"><?=$limit['objet']?></div>
                                <div class="email-time"><?=$limit['date_envoi']?></div>
                            </div>
                            <p class="notification-subtitle"><?=$limit['NomUemetteur']?></p>
                            <p class="notification-description"><?=$limit['contenu']?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
                <!-- <div class="email-section">
                    <h3 class="module-heading">Last Week</h3>
                    <div class="email-element seen">
                        <div class="notification-top">
                            <div class="notification-dot seen"></div>
                            <div class="notificaiton-title">AudioHunt</div>
                            <div class="email-time">7/02/2021</div>
                        </div>
                        <p class="notification-subtitle">New feature announcement</p>
                        <p class="notification-description">We added a new vending machine to the snack room</p>
                    </div>
                    <div class="email-element seen">
                        <div class="notification-top">
                            <div class="notification-dot seen"></div>
                            <div class="notificaiton-title">Domains R Us</div>
                            <div class="email-time">4/02/2021</div>
                        </div>
                        <p class="notification-subtitle">The ePhone 14</p>
                        <p class="notification-description">Check it out, it now has 8 cameras</p>
                    </div>
                    <div class="email-element seen">
                        <div class="notification-top">
                            <div class="notification-dot seen"></div>
                            <div class="notificaiton-title">Gooble Accounts</div>
                            <div class="email-time">2/02/2021</div>
                        </div>
                        <p class="notification-subtitle">Checking in</p>
                        <p class="notification-description">Hey, how are you? I &#x27;ve attached some photos from Christmas last year...</p>
                    </div>
                </div> -->
                <!-- <a href="#" class="module-button w-button">Load more emails</a> -->
            </div>
        </div>
    </div>
<div>
<script>
    // Fonction pour mettre à jour l'état des messages vus
    function updateSeenMessages() {
        let seenMessages = JSON.parse(localStorage.getItem('seenMessages')) || [];
        let messages = document.querySelectorAll('.email-element');

        messages.forEach(element => {
            let messageId = element.getAttribute('data-id'); // Utiliser un attribut pour identifier le message
            if (seenMessages.includes(messageId)) {
                element.classList.add('seen'); // Ajoute la classe 'seen' si le message est marqué
                let dot = element.querySelector('.notification-dot');
                if (dot) {
                    dot.classList.add('seen'); // Ajoute la classe 'seen' à 'notification-dot'
                }
            }

            element.addEventListener("click", () => {
                if (!seenMessages.includes(messageId)) {
                    seenMessages.push(messageId); // Ajoute l'ID du message aux vus
                    localStorage.setItem('seenMessages', JSON.stringify(seenMessages)); // Enregistre dans localStorage
                }
                element.classList.add('seen'); // Ajoute la classe 'seen' à l'élément cliqué
                let dot = element.querySelector('.notification-dot');
                if (dot) {
                    dot.classList.add('seen'); // Ajoute la classe 'seen' à 'notification-dot'
                }
            });
        });
    }

    // Appel de la fonction pour initialiser l'état des messages
    updateSeenMessages();
</script>
