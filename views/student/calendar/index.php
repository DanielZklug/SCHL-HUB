<?php $title="Calendrier"?>
<div class="dashboard-main-content">
    <div class="dashboard-page-header">
        <h2>Calendrier</h2>
        <a href="#" class="button page w-button" id="add-event-btn">Ajouter un nouvel évènement</a>
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
            daysContainer.innerHTML += `<div class="calender-square">
                                            <div class="calender-number${isToday ? ' blue' : ''}">${day}</div>
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
