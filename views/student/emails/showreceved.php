<?php $title="Lettre"?>
<div class="dashboard-main-content">
    <div class="dashboard-page-header">
        <h2>Envoyé par</h2>
        <a href="/schl-hub/student/recever" class="button page w-button">Retour à la boîte de réception</a>
    </div>
    <div class="_2-5-1-grid">
        <div class="module">
            <div class="module-main large">
                <h3 class="module-heading large"><?=$params['message'][0]['NomUemetteur']?></h3>
                <div class="email-time"><?=$params['message'][0]['date_envoi']?></div>
                <div class="spacer _32"></div>
                <div class="rich-text w-richtext">
                    <p>
                        <strong><?=$params['message'][0]['objet']?></strong>
                    </p>
                    <p><?=$params['message'][0]['contenu']?></p>
                    <p>___</p>
                    <p><?=$params['message'][0]['NomUemetteur']?> Encadrant</p>
                </div>
            </div>
        </div>
        <div class="action-group">
            <form hidden action="student/emails/delete/<?=$params['message'][0]['idMessage']?>" style="display:inline" method="post">
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