<?php
 $title="Cours";
?> 
<div class="dashboard-main-content">
    <div class="dashboard-page-header">
        <h2>Cours</h2>
    </div>
    <div class="_4-grid">
        <?php if (!empty($params['courses'])): ?>
            <?php foreach ($params['courses'] as $course): ?>
                <div class="module blue">
                    <div class="module-header minimal">
                        <h3 class="module-heading"><?= htmlspecialchars($course['extension']) ?></h3>
                    </div>
                    <div class="responsive-iframe">
                        <iframe src="<?=SCRIPTS .$course['extension'].DIRECTORY_SEPARATOR.$course['nomCours'].'.'.$course['extension']?>"></iframe>
                    </div>
                    <div class="module-main">
                        <div class="module-number blue">
                            <?= htmlspecialchars($course['nomCours']) ?>
                        </div>
                        <br>
                        <p>Publié le : <?= htmlspecialchars($course['jour'] . " " . $course['date']) ?></p>
                        <a href="<?=SCRIPTS .$course['extension'].DIRECTORY_SEPARATOR.$course['nomCours'].'.'.$course['extension']?>" class="profile-menu-link w-nav-link">Télécharger</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h2 style="display: flex;">Pas de fichier(s) publié(s)</h2>
        <?php endif; ?>
    </div>
</div>
<style>
    .module-main,.module-number{
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        word-wrap: break-word;
    }
    .responsive-iframe {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* Aspect ratio 16:9 */
    }
    .responsive-iframe iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none; /* Supprime la bordure de l'iframe */
    }
</style>