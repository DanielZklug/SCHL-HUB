<?php $title = $params['posts']->Stagiaire_nom." ".$params['posts']->Stagiaire_prenom ;
var_dump($params['posts'])
?>
<div class="dashboard-main-content">
    <div class="dashboard-page-header">
        <h2>Détails</h2>
    </div>
    <div class="container">
        <div class="_2-5-1-grid">
            <div class="module-group">
                <div class="module">
                    <div class="module-header">
                        <h3 class="module-heading">Informations de l'étudiant</h3>
                    </div>
                    <div class="module-main">
                        <div class="_50-width">
                            <div class="field-label">Nom</div>
                            <p><?=$params['posts']->Stagiaire_nom?></p>
                        </div>
                        <div class="_50-width">
                            <div class="field-label">Prenom</div>
                            <p><?=$params['posts']->Stagiaire_prenom?></p>
                        </div>
                        <div class="_50-width">
                            <div class="field-label">Email</div>
                            <p><?=$params['posts']->Stagiaire_email?></p>
                        </div>
                        <div class="_50-width">
                            <div class="field-label">Email de l'institution</div>
                            <p><?=$params['posts']->emailUni?></p>
                        </div>
                        <div class="_50-width">
                            <div class="field-label">Numéro</div>
                            <p><?=$params['posts']->Stagiaire_numero?></p>
                        </div>
                        <div class="_50-width">
                            <div class="field-label">Genre</div>
                            <p><?=$params['posts']->Stagiaire_genre?></p>
                        </div>
                        <div class="_50-width">
                            <div class="field-label">Date d'inscription</div>
                            <p><?=$params['posts']->date_inscription?></p>
                        </div>
                    </div>
                </div>
                <div class="module">
                    <div class="module-header">
                        <h3 class="module-heading">Tâches assignées</h3>
                    </div>
                    <div class="module-main">
                        <div class="w-form">
                            <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="6025c4b7fb18b28643db2df1" data-wf-element-id="d309adb5-dbcd-dd05-b840-0f29e6dbe0fc">
                                <div class="checkbox-element">
                                    <label data-w-id="d309adb5-dbcd-dd05-b840-0f29e6dbe0fe" class="w-checkbox checkbox-top">
                                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                        <input type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                        <span for="checkbox-8" class="task-title w-form-label">Submit refund for latest order</span>
                                        <div class="tag task">Urgent</div>
                                    </label>
                                    <p class="task-description">Customer had issues with latest order and requires a refund to their account</p>
                                </div>
                                <div class="checkbox-element">
                                    <label data-w-id="d309adb5-dbcd-dd05-b840-0f29e6dbe115" class="w-checkbox checkbox-top">
                                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                        <input type="checkbox" id="checkbox-6" name="checkbox-6" data-name="Checkbox 6" style="opacity:0;position:absolute;z-index:-1"/>
                                        <span for="checkbox-6" class="task-title w-form-label">Update customer phone number</span>
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
            <div id="w-node-_78978071-a043-772a-06ef-09b2a97f8681-43db2df1" class="action-group">
                <!-- <a href="#" class="action-card w-inline-block">
                    <img src="https://cdn.prod.website-files.com/6022ffeab6f354c9aa1eb2a2/60262457c0826291e7096b15_Receipt.svg" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Add support ticket</h3>
                </a> -->
                <a href="#" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'60283f3a37c95faced8e4597_PaperPlaneRight.svg'?>" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Envoyer une lettre</h3>
                </a>
                <a href="#" class="action-card w-inline-block">
                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'602339a1038967373831278c_Note.svg'?>" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Attribuer une tâche</h3>
                </a>
                <!-- <a href="#" class="action-card w-inline-block">
                    <img src="https://cdn.prod.website-files.com/6022ffeab6f354c9aa1eb2a2/602339a1038967373831278c_Note.svg" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Add a note</h3>
                </a> -->
                <!-- <a href="#" class="action-card w-inline-block">
                    <img src="https://cdn.prod.website-files.com/6022ffeab6f354c9aa1eb2a2/60283f3ab4409ef426cbb94d_Archive.svg" loading="lazy" width="22" alt="" class="action-icon"/>
                    <h3 class="module-heading">Archive customer</h3>
                </a> -->
            </div>
        </div>
    </div>
</div>
<style>
    .module-main {
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
</style>
