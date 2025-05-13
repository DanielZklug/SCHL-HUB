<?php $title="Cours";

$header = '<div class="support-row head">
                <div class="checkbox-grid w-form">
                    <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="6025b7699e16628a0e7b8945" data-wf-element-id="8c729c5f-ac1a-3f63-a1e7-2970bfc8a7f8">
                        <label data-w-id="8c729c5f-ac1a-3f63-a1e7-2970bfc8a7f9" class="w-checkbox checkbox-field-simple">
                            <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                            <input type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                            <span for="checkbox-8" class="hidden-checkbox-label w-form-label">Fix CSS styling on mobile</span>
                        </label>
                    </form>
                    <div class="w-form-done">
                        <div>Thank you! Your submission has been received!</div>
                    </div>
                    <div class="w-form-fail">
                        <div>Oops! Something went wrong while submitting the form.</div>
                    </div>
                </div>
                <h4 class="grid-header">Nom</h4>
                <h4 class="grid-header mob-hidden">Classe</h4>
                <h4 class="grid-header">Date de publication</h4>
                <h4 class="grid-header">Action</h4>
            </div>';

?>

<div class="dashboard-main-content">
<div class="dashboard-page-header">
    <h2>Cours</h2>
</div>
<div class="container">
    <div class="module">
        <div data-duration-in="300" data-duration-out="100" data-current="Tab 1" data-easing="ease" class="w-tabs">
            <div class="module-tabs w-tab-menu">
                <a data-w-tab="Tab 1" class="tab w-inline-block w-tab-link w--current">
                    <div>Tout</div>
                </a>
                <a data-w-tab="Tab 5" class="tab w-inline-block w-tab-link">
                    <div>PDF</div>
                </a>
                <a data-w-tab="Tab 2" class="tab w-inline-block w-tab-link">
                    <div>PowerPoint</div>
                </a>
                <a data-w-tab="Tab 4" class="tab w-inline-block w-tab-link">
                    <div>Word</div>
                </a>
            </div>
            <div class="module-main w-tab-content">
                <div data-w-tab="Tab 1" class="w-tab-pane w--tab-active">
                    <div class="grid-section">
                        <?=$header?>
                        <div class="w-dyn-list">
                            <div role="list" class="w-dyn-items">
                                <div role="listitem" class="w-dyn-item">
                                    <?php foreach($params['support'] as $support) :?>
                                        <div class="support-row">
                                            <div class="checkbox-grid w-form">
                                                <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="6025b7699e16628a0e7b8945" data-wf-element-id="53836506-e398-2c07-dd83-94de7447ccf2">
                                                    <label data-w-id="2603dc5a-7a75-7d77-b566-d9d286540ac1" class="w-checkbox checkbox-field-simple">
                                                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                                        <input type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                                        <span for="checkbox-8" class="hidden-checkbox-label w-form-label">Fix CSS styling on mobile</span>
                                                    </label>
                                                </form>
                                                <!-- <div class="w-form-done">
                                                    <div>Thank you! Your submission has been received!</div>
                                                </div>
                                                <div class="w-form-fail">
                                                    <div>Oops! Something went wrong while submitting the form.</div>
                                                </div> -->
                                            </div>
                                            <div class="grid-number-block">
                                                <div></div>
                                                <div><?=$support['nom']?></div>
                                            </div>
                                            <div class="grid-block mob-hidden">
                                                <div><?=$support['class_name']?></div>
                                            </div>
                                            <div><?=$support['datePub']?></div>
                                            <div>
                                                <form hidden action="admin/support/delete/<?=$support['idCours']?>" style="display:inline" method="post">
                                                    <button style="color:white; padding: 5px; border-radius: 5px; background:#3898ec;" type="submit">
                                                        <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'trash.svg'?>" alt="">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-w-tab="Tab 5" class="w-tab-pane">
                    <div class="grid-section">
                        <?=$header?>
                        <div class="w-dyn-list">
                            <div role="list" class="w-dyn-items">
                                <?php foreach($params['supportPdf'] as $supportPdf) :?>
                                    <div class="support-row">
                                        <div class="checkbox-grid w-form">
                                            <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="6025b7699e16628a0e7b8945" data-wf-element-id="53836506-e398-2c07-dd83-94de7447ccf2">
                                                <label data-w-id="2603dc5a-7a75-7d77-b566-d9d286540ac1" class="w-checkbox checkbox-field-simple">
                                                    <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                                    <input type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                                    <span for="checkbox-8" class="hidden-checkbox-label w-form-label">Fix CSS styling on mobile</span>
                                                </label>
                                            </form>
                                            <!-- <div class="w-form-done">
                                                <div>Thank you! Your submission has been received!</div>
                                            </div>
                                            <div class="w-form-fail">
                                                <div>Oops! Something went wrong while submitting the form.</div>
                                            </div> -->
                                        </div>
                                        <div class="grid-number-block">
                                            <div></div>
                                            <div><?=$supportPdf['nom']?></div>
                                        </div>
                                        <div class="grid-block mob-hidden">
                                            <div><?=$supportPdf['class_name']?></div>
                                        </div>
                                        <div><?=$supportPdf['datePub']?></div>
                                        <div>
                                            <form hidden action="admin/support/delete/<?=$supportPdf['idCours']?>" style="display:inline" method="post">
                                                <button style="color:white; padding: 5px; border-radius: 5px; background:#3898ec;" type="submit">
                                                    <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'trash.svg'?>" alt="">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-w-tab="Tab 2" class="w-tab-pane">
                    <div class="grid-section">
                        <?=$header?>
                        <div class="w-dyn-list">
                            <div role="list" class="w-dyn-items">
                                <div role="listitem" class="w-dyn-item">
                                <?php foreach($params['supportPptx'] as $supportPptx) :?>
                                        <div class="support-row">
                                            <div class="checkbox-grid w-form">
                                                <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="6025b7699e16628a0e7b8945" data-wf-element-id="53836506-e398-2c07-dd83-94de7447ccf2">
                                                    <label data-w-id="2603dc5a-7a75-7d77-b566-d9d286540ac1" class="w-checkbox checkbox-field-simple">
                                                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                                        <input type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                                        <span for="checkbox-8" class="hidden-checkbox-label w-form-label">Fix CSS styling on mobile</span>
                                                    </label>
                                                </form>
                                                <!-- <div class="w-form-done">
                                                    <div>Thank you! Your submission has been received!</div>
                                                </div>
                                                <div class="w-form-fail">
                                                    <div>Oops! Something went wrong while submitting the form.</div>
                                                </div> -->
                                            </div>
                                            <div class="grid-number-block">
                                                <div></div>
                                                <div><?=$supportPptx['nom']?></div>
                                            </div>
                                            <div class="grid-block mob-hidden">
                                                <div><?=$supportPptx['class_name']?></div>
                                            </div>
                                            <div><?=$supportPptx['datePub']?></div>
                                            <div>
                                                <form hidden action="admin/support/delete/<?=$supportPptx['idCours']?>" style="display:inline" method="post">
                                                    <button style="color:white; padding: 5px; border-radius: 5px; background:#3898ec;" type="submit">
                                                        <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'trash.svg'?>" alt="">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-w-tab="Tab 4" class="w-tab-pane">
                    <div class="grid-section">
                        <?=$header?>
                        <div class="w-dyn-list">
                            <div role="list" class="w-dyn-items">
                                <div role="listitem" class="w-dyn-item">
                                    <?php foreach($params['supportDocx'] as $supportDocx) :?>
                                        <div class="support-row">
                                            <div class="checkbox-grid w-form">
                                                <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="6025b7699e16628a0e7b8945" data-wf-element-id="53836506-e398-2c07-dd83-94de7447ccf2">
                                                    <label data-w-id="2603dc5a-7a75-7d77-b566-d9d286540ac1" class="w-checkbox checkbox-field-simple">
                                                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                                        <input type="checkbox" id="checkbox-8" name="checkbox-8" data-name="Checkbox 8" style="opacity:0;position:absolute;z-index:-1"/>
                                                        <span for="checkbox-8" class="hidden-checkbox-label w-form-label">Fix CSS styling on mobile</span>
                                                    </label>
                                                </form>
                                                <!-- <div class="w-form-done">
                                                    <div>Thank you! Your submission has been received!</div>
                                                </div>
                                                <div class="w-form-fail">
                                                    <div>Oops! Something went wrong while submitting the form.</div>
                                                </div> -->
                                            </div>
                                            <div class="grid-number-block">
                                                <div></div>
                                                <div><?=$supportDocx['nom']?></div>
                                            </div>
                                            <div class="grid-block mob-hidden">
                                                <div><?=$supportDocx['class_name']?></div>
                                            </div>
                                            <div><?=$supportDocx['datePub']?></div>
                                            <div>
                                                <form hidden action="admin/support/delete/<?=$supportDocx['idCours']?>" style="display:inline" method="post">
                                                    <button style="color:white; padding: 5px; border-radius: 5px; background:#3898ec;" type="submit">
                                                        <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'trash.svg'?>" alt="">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
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