<?php $title="Rappels";
?>
<div class="dashboard-main-content">
    <div class="dashboard-page-header">
        <h2>Détails du rappel</h2>
        <a href="/schl-hub/admin/calendar" class="button page w-button">Retour au calendrier</a>
    </div>
    <div class="_2-5-1-grid">
        <div class="module">
            <div class="module-main large">
                <div class="email-time">CECI EST UN RAPPEL</div>
                <br>
                <h3 class="module-heading large"><?=$params['rappel'][0]['titre']?></h3>
                <div class="spacer _32"></div>
                <div class="rich-text w-richtext">
                    <p>
                        <strong><?=$params['rappel'][0]['description']?></strong>
                    </p>
                    <p>Vous serez alerter le :</p>
                    <p><?=$params['rappel'][0]['jour']." ".$params['rappel'][0]['date']?></p>
                </div>
            </div>
        </div>
        <div class="action-group">
            <form hidden action="admin/calendar/delete/<?=$params['rappel'][0]['id']?>" style="display:inline" method="post">
                <button class="action-card">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'trash.svg'?>" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Supprimer</h3>
                </button>
            </form>
            <!-- <div class="action-card">
                <img src="assets/img/60283f3ac741e1f2546c7250_ArrowFatLineRight.svg" loading="lazy" width="22" alt="" class="action-icon"/>
                <h3 class="module-heading">Forward</h3>
            </div>
            <a href="/emails" class="action-card w-inline-block">
                <img src="assets/img/60283f3ab4409ef426cbb94d_Archive.svg" loading="lazy" width="22" alt="" class="action-icon"/>
                <h3 class="module-heading">Archive</h3>
            </a> -->
        </div>
    </div>
</div>