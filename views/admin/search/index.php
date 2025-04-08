<?php $title="Recherches";?>
<div class="dashboard-main-content">
    <div class="w-container">
        <h1 class="page-title">Résutats de recherche</h1>
        <div class="container">
            <div class="module">
            <div class="module-main">
                <div class="grid-section">
                    <div class="customer-row head">
                        <div class="checkbox-grid w-form">
                            <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfa2">
                                <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfa3" class="w-checkbox checkbox-field-simple">
                                    <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                    <input  type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                    <!-- <span for="checkbox-8" class="hidden-checkbox-label w-form-label">Fix CSS styling on mobile</span> -->
                                </label>
                            </form>
                        </div>
                        <h4 class="grid-header">Noms</h4>
                        <h4 class="grid-header"></h4>
                        <h4 class="grid-header mob-hidden">Date</h4>
                        <h4 class="grid-header mob-hidden">Actions</h4>
                    </div>
                    <div class="w-dyn-list">
                        <div role="list" class="w-dyn-items">
                            <div class="w-dyn-list">
                                <div role="list" class="w-dyn-items">
                                    <div role="listitem" class="w-dyn-item">
                                        <div class="full-customer-row">
                                            <div class="checkbox-grid w-form">
                                                <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                                    <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
                                                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                                        <input checked type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                                        <!-- <span for="checkbox-8" class="hidden-checkbox-label w-form-label">Fix CSS styling on mobile</span> -->
                                                    </label>
                                                </form>
                                            </div>
                                            <?php
                                                if(count($params['results']) == 2){
                                                    ?>
                                                        <a href="/schl-hub/admin/classroom/<?=$params['results'][0]['idClasse']?>" class="customer-element w-inline-block">
                                                            <div class="grid-number-block">
                                                                <div><?=$params['results'][0]['class_name']?></div>
                                                            </div>
                                                            <div></div>
                                                            <div class="mob-hidden"><?=$params['results'][0]['class_creation_date']?></div>
                                                            <div>
                                                                <form hidden action="/schl-hub/admin/classroom/delete/<?=$params['results'][0]['idClasse']?>" style="display:inline" method="post">
                                                                    <button style="color:white; padding: 5px; border-radius: 5px; background:#3898ec;" type="submit">
                                                                        <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'trash.svg'?>" alt="">
                                                                        Supprimer
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </a>
                                                    <?php
                                                }else if (count($params['results']) == 1){
                                                    ?>
                                                        <a href="/schl-hub/admin/student/<?=$params['results'][0]['idUtilisateur']?>" class="customer-element w-inline-block">
                                                            <div class="grid-number-block">
                                                                <div><?=$params['results'][0]['stagiaire_name']?></div>
                                                            </div>
                                                            <div></div>
                                                            <div class="mob-hidden"><?=$params['results'][0]['date_inscription']?></div>
                                                            <div>
                                                                <form hidden action="/schl-hub/admin/classroom/delete/<?=$params['results'][0]['idUtilisateur']?>" style="display:inline" method="post">
                                                                    <button style="color:white; padding: 5px; border-radius: 5px; background:#3898ec;" type="submit">
                                                                        <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'trash.svg'?>" alt="">
                                                                        Supprimer
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </a>
                                                    <?php
                                                }else if(empty($params['results'])){
                                                    ?>
                                                        <h1 class="page-title">Aucun résultat trouvé</h1>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>