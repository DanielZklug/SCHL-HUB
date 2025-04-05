<?php $title = "Tableau de bord";?>

<div class="dashboard-content">
    <div class="dashboard-main-content">
        <div class="dashboard-page-header">
            <h2>Tableau de bord</h2>
        </div>
        <div class="_4-grid">
            <div class="module blue">
                <div class="module-header minimal">
                    <h3 class="module-heading">Classe(s)</h3>
                </div>
                <div class="module-main">
                    <div class="module-number blue"><?= htmlspecialchars($params['statistics']['Nombre_de_classes']) ?></div>
                </div>
            </div>
            <div class="module blue">
                <div class="module-header minimal">
                    <h3 class="module-heading">Etudiant(s)</h3>
                </div>
                <div class="module-main">
                    <div class="module-number blue"><?= htmlspecialchars($params['statistics']['Nombre_total_etudiants']) ?></div>
                </div>
            </div>
            <div class="module blue">
                <div class="module-header minimal">
                    <h3 class="module-heading">Fille(s)</h3>
                </div>
                <div class="module-main">
                    <div class="module-number blue"><?= htmlspecialchars($params['statistics']['Nombre_de_filles']) ?></div>
                </div>
            </div>
            <div class="module blue">
                <div class="module-header minimal">
                    <h3 class="module-heading">Garçon(s)</h3>
                </div>
                <div class="module-main">
                    <div class="module-number blue"><?= htmlspecialchars($params['statistics']['Nombre_de_garcons']) ?></div>
                </div>
            </div>
        </div>
        <div class="_2-grid">
            <div class="module">
                <div class="module-header">
                    <h3 class="module-heading">Cours</h3>
                    <div class="module-filters">
                        <div data-hover="" data-delay="0" class="module-dropdown w-dropdown">
                            <div class="dropdown-toggle w-dropdown-toggle">
                                <div class="filter-dropdown-icon w-icon-dropdown-toggle"></div>
                                <div>Today</div>
                            </div>
                            <nav class="filter-dropdown-3 w-dropdown-list">
                                <a href="#" class="filter-option w-dropdown-link">Last Week</a>
                                <a href="#" class="filter-option w-dropdown-link">This Month</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="module-main">
                    <div class="w-layout-grid schedule-grid">
                        <div class="schedue-time">
                            <div>9 AM</div>
                        </div>
                        <div class="schedule-div current">
                            <div>Cours de python</div>
                        </div>
                        <div id="w-node-_106a5750-9e07-9a9c-ad64-eca7a9e20770-20776f55" class="schedule-div blank"></div>
                    </div>
                </div>
            </div>
            <div class="module">
                <div class="module-header">
                    <h3 class="module-heading">Tâches</h3>
                    <div class="module-filters">
                        <a href="/tasks" class="module-button add w-button">+</a>
                    </div>
                </div>
                <div class="module-main">
                    <div class="w-form">
                        <form id="email-form" name="email-form" data-name="Email Form">
                            <div class="checkbox-element">
                                <label data-w-id="953af5b6-cd7a-0cdd-12a0-be3615090821" class="w-checkbox checkbox-top">
                                    <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                    <input type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                    <span for="checkbox-8" class="task-title w-form-label">Fix CSS styling on mobile</span>
                                    <div class="tag task">Urgent</div>
                                </label>
                                <p class="task-description">Link styles have the wrong colours on mobile, titles…</p>
                            </div>
                            <div class="checkbox-element">
                                <label data-w-id="ea3363cf-433d-b3b0-7650-247ef7019623" class="w-checkbox checkbox-top">
                                    <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                    <input type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                    <span for="checkbox-9" class="task-title w-form-label">Fix javascript filtering issue</span>
                                </label>
                                <p class="task-description">there is a filtering issue on the customers page</p>
                            </div>
                            <div class="checkbox-element">
                                <label data-w-id="953af5b6-cd7a-0cdd-12a0-be3615090828" class="w-checkbox checkbox-top">
                                    <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                    <input type="checkbox" id="checkbox-7" name="checkbox-7" data-name="Checkbox 7" style="opacity:0;position:absolute;z-index:-1"/>
                                    <span for="checkbox-9" class="task-title w-form-label">Change homepage  illustration</span>
                                    <div class="tag task">Urgent</div>
                                </label>
                            </div>
                            <div class="checkbox-element">
                                <label data-w-id="953af5b6-cd7a-0cdd-12a0-be361509082d" class="w-checkbox checkbox-top">
                                    <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                    <input type="checkbox" id="checkbox-6" name="checkbox-6" data-name="Checkbox 6" style="opacity:0;position:absolute;z-index:-1"/>
                                    <span for="checkbox-9" class="task-title w-form-label">Send monthly invoices</span>
                                </label>
                            </div>
                            <div class="checkbox-element">
                                <label data-w-id="132dc47b-d923-0534-5419-e5cd1653286f" class="w-checkbox checkbox-top">
                                    <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                    <input type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                    <span for="checkbox-9" class="task-title w-form-label">Help support with tickets</span>
                                </label>
                                <p class="task-description">Ask Jamie which ones are most urgent</p>
                            </div>
                            <div class="checkbox-element">
                                <label data-w-id="953af5b6-cd7a-0cdd-12a0-be3615090832" class="w-checkbox checkbox-top">
                                    <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                    <input type="checkbox" id="checkbox-5" name="checkbox-5" data-name="Checkbox 5" style="opacity:0;position:absolute;z-index:-1"/>
                                    <span for="checkbox-9" class="task-title w-form-label">Recalculate MRR</span>
                                </label>
                            </div>
                        </form>
                        <div class="w-form-done">
                            <div>Thank you! Your submission has been received!</div>
                        </div>
                        <div class="w-form-fail">
                            <div>Oops! Something went wrong while submitting the form.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_2-1-grid">
            <div class="module">
                <div class="module-header">
                    <h3 class="module-heading">Derniers Email</h3>
                    <a href="emails" class="module-button w-button">Voir tout</a>
                </div>
                <div class="module-main">
                    <div>
                        <!-- <a href="/email-view" class="email-element simple w-inline-block">
                            <div class="notification-top">
                                <div class="notification-dot"></div>
                                <div class="notificaiton-title">AudioHunt</div>
                                <div class="email-time">1:34pm</div>
                            </div>
                            <p class="notification-subtitle">New music is out!</p>
                            <p class="notification-description">The playlist made just for you, every Friday</p>
                        </a> -->
                        <div class="email-element simple w-inline-block">
                            <div class="notification-top">
                                <div class="notification-dot"></div>
                                <div class="notificaiton-title">Objet</div>
                                <div class="email-time">Date et heure</div>
                            </div>
                            <p class="notification-subtitle">Destinataire</p>
                            <p class="notification-description">Message</p>
                        </div>
                        <?php foreach ($params["limit"] as $limit): ?>
                            <a href="emails/<?=$limit['idMessage']?>" data-id="<?=$limit['idMessage']?>" class="email-element">
                                <div class="notification-top">
                                    <div class="notification-dot"></div>
                                    <div class="notificaiton-title"><?=$limit['objet']?></div>
                                    <div class="email-time"><?=$limit['date_envoi']?></div>
                                </div>
                                <p class="notification-subtitle"><?=$limit['NomUrecepteur']?></p>
                                <p class="notification-description"><?=$limit['contenu']?></p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="module">
                <div class="module-header">
                    <h3 class="module-heading">New Tickets</h3>
                </div>
                <div class="module-main">
                    <div class="empty-module-insert">
                        <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'60244fb15bbcaab0b00a05d4_Check.svg'?>" loading="lazy" width="27" alt="" class="empty-icon"/>
                        <div>
                            No new <br/>tickets
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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