<?php $title="Calendrier";
// On s'assure que $rappels est toujours un tableau
$rappels = is_array($params['rappels']) ? $params['rappels'] : [$params['rappels']];

// On transforme en tableau de dates au format 'Y-m-d'
$reminderDates = array_map(function($rappel) {
    return [
        'date' => date('Y-m-d', strtotime($rappel['date_heure'])),
        'id' => $rappel['id']
    ];
}, $rappels);

$translations = require LANGUAGE_DIR . $lang . '.php';
?>
<script>
    const reminderDates = <?= json_encode($reminderDates) ?>;
</script>

<div class="dashboard-main-content">
    <div class="dashboard-page-header">
        <h2><?= $translations['calendar'] ?></h2>
        <a onclick="showPopup()" href="#" class="button page w-button" id="add-event-btn"><?= $translations['add_event'] ?></a>
    </div>
    <div class="container">
        <div class="module">
            <div class="calender w-slider" data-autoplay="false">
                <div class="calender-mask w-slider-mask">
                    <div class="calender-month w-slide">
                        <div class="module-header minimal">
                            <h3 class="calender-title" id="calendar-title"></h3>
                        </div>
                        <div class="module-main">
                            <div class="calender-row head">
                                <h4 class="grid-header">Dim</h4>
                                <h4 class="grid-header">Lun</h4>
                                <h4 class="grid-header">Mar</h4>
                                <h4 class="grid-header">Mer</h4>
                                <h4 class="grid-header">Jeu</h4>
                                <h4 class="grid-header">Ven</h4>
                                <h4 class="grid-header">Sam</h4>
                            </div>
                            <div class="calender-row" id="calendar-days">
                                <!-- Days will be generated here -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="calender-left-arrow w-slider-arrow-left" onclick="changeMonth(-1)">
                    <div class="w-icon-slider-left"></div>
                </div>
                <div class="calender-right-arrow w-slider-arrow-right" onclick="changeMonth(1)">
                    <div class="w-icon-slider-right"></div>
                </div>
                <div class="slide-nav w-slider-nav w-round"></div>
            </div>
        </div>
    </div>
</div>
<!-- Popup Form for Sending Reminder -->
<div id="popupForm" class="popup-form" style="display: none;">
    <div class="popup-content">
        <form action="admin/calendar" method="post">
            <label for="reminder-title" class="field-label">Titre du Rappel</label>
            <input type="text" class="simple-input no-margin w-input" maxlength="50" name="reminder_title" placeholder="Titre du rappel" id="reminder-title" required/>
            <div class="spacer _16"></div>
            
            <label for="reminder-description" class="field-label">Description</label>
            <textarea name="reminder_description" maxlength="500" class="simple-input no-margin w-input" pattern=".{1,}" style="resize: vertical" rows="10" placeholder="Veuillez entrer une description. max 500 caractères" required></textarea>
            <div class="spacer _16"></div>
            
            <label for="reminder-date" class="field-label">Date et Heure</label>
            <input type="datetime-local" class="simple-input no-margin w-input" name="reminder_date" id="reminder-date" required/>
            <div class="spacer _16"></div>
            
            <label for="user-id" class="field-label">ID Utilisateur</label>
            <input readonly type="text" value="<?=$params['post']->idUtilisateur?>" class="simple-input no-margin w-input" name="user_id" placeholder="ID de l'utilisateur" id="user-id" required/>
            <div class="spacer _16"></div>
            
            <input type="submit" value="Envoyer" data-wait="Veuillez patienter..." class="button no-margin w-button"/>
        </form>
    </div>
</div>

<style>
    #module-main {
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
        z-index: 1000; /* Assurez-vous que le pop-up soit au-dessus */
    }

    .popup-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        width: 300px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    function showPopup() {
        document.getElementById('popupForm').style.display = 'flex';
    }

    function hidePopup() {
        document.getElementById('popupForm').style.display = 'none';
    }

    // Fermer le pop-up en cliquant en dehors de celui-ci
    window.onclick = function(event) {
        if (event.target === document.getElementById('popupForm')) {
            hidePopup();
        }
    }
</script>



<script>
    let currentMonth = new Date().getMonth() + 1; // Mois courant (1-12)
    let currentYear = new Date().getFullYear(); // Année courante
    const today = new Date().getDate(); // Jour courant

    function renderCalendar() {
        const title = document.querySelector(".calender-title");
        const daysContainer = document.querySelector(".calender-row:last-child");
        daysContainer.innerHTML = ""; // Réinitialiser le contenu

        title.innerText = new Date(currentYear, currentMonth - 1).toLocaleString('default', { month: 'long', year: 'numeric' });

        const firstDay = new Date(currentYear, currentMonth - 1, 1).getDay(); // Jour de la semaine du 1er jour du mois
        const daysInMonth = new Date(currentYear, currentMonth, 0).getDate(); // Nombre de jours dans le mois courant
        const daysInPrevMonth = new Date(currentYear, currentMonth - 1, 0).getDate(); // Nombre de jours dans le mois précédent

        // Ajouter des carrés pour les jours du mois précédent
        for (let i = firstDay - 1; i >= 0; i--) {
            daysContainer.innerHTML += `<div class="calender-square grey">
                                            <div class="calender-number">${daysInPrevMonth - i}</div>
                                         </div>`;
        }

        // Ajouter les jours du mois courant
        for (let day = 1; day <= daysInMonth; day++) {
            const isToday = (day === today && currentMonth === new Date().getMonth() + 1 && currentYear === new Date().getFullYear());
            const dateString = `${currentYear}-${String(currentMonth).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const reminder = reminderDates.find(r => r.date === dateString);
            const isReminder = !!reminder;


            daysContainer.innerHTML += `<div class="calender-square">
                ${isReminder ? `
                    <a href="calendar/${reminder.id}" class="calender-number${isToday ? ' blue' : ''} light" title="Voir le rappel">${day}</a>
                ` : `
                    <div class="calender-number${isToday ? ' blue' : ''}" title="${isToday ? " aujourd'hui" : ''}">${day}</div>
                `}
            </div>`;
        }

        // Ajouter des carrés vides pour compléter le mois à 42 jours
        const totalDays = firstDay + daysInMonth;
        const remainingDays = 42 - totalDays; // Pour un calendrier de 6 semaines

        for (let i = 0; i < remainingDays; i++) {
            daysContainer.innerHTML += '<div class="calender-square grey"></div>';
        }
    }

    function changeMonth(direction) {
        currentMonth += direction;
        if (currentMonth < 1) {
            currentMonth = 12;
            currentYear--;
        } else if (currentMonth > 12) {
            currentMonth = 1;
            currentYear++;
        }
        renderCalendar();
    }

    // Initialiser le calendrier
    renderCalendar();
</script>

<script>
        // Fonction pour définir la date et l'heure minimales
        function setMinDate() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            // Formater la date au format requis par l'input datetime-local
            const minDate = `${year}-${month}-${day}T${hours}:${minutes}`;
            document.getElementById('reminder-date').setAttribute('min', minDate);
        }

        // Appeler la fonction lors du chargement de la page
        window.onload = setMinDate;
    </script>
