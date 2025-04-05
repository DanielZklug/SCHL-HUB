<?php $title = "Classes";?>
<div class="dashboard-main-content">
    <div class="dashboard-page-header">
        <h2>Classes</h2>
        <a href="#" onclick="showPopup()" class="button page w-button">Ajouter une nouvelle classe</a>
    </div>
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
                        <h4 class="grid-header">Stagiaires</h4>
                        <h4 class="grid-header mob-hidden">Date de création</h4>
                        <h4 class="grid-header mob-hidden">Actions</h4>
                    </div>
                    <div class="w-dyn-list">
                        <div role="list" class="w-dyn-items">
                                <div class="w-dyn-list">
                                    <div role="list" class="w-dyn-items">
                                        <div role="listitem" class="w-dyn-item">
                                        <?php foreach ($params['classes'] as $classe): ?>
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
                                                <a href="/schl-hub/admin/classroom/<?=$classe['idClasse']?>" class="customer-element w-inline-block">
                                                    <div class="grid-number-block">
                                                        <div><?=$classe['Classe_nom']?></div>
                                                    </div>
                                                    <div><?=$classe['Nombre_Stagiaires']?></div>
                                                    <div class="mob-hidden"><?=$classe['Classe_dateCreation']?></div>
                                                    <div>
                                                    <form hidden action="'admin/classroom/delete/<?=$classe['idClasse']?>" style="display:inline" method="post">
                                                        <button style="color:white; padding: 5px; border-radius: 5px; background:#3898ec;" type="submit">
                                                            <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'trash.svg'?>" alt="">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <!-- <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/veniam-eum" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>200</div>
                                        </div>
                                        <div>Veniam Eum</div>
                                        <div class="mob-hidden">Bobbie77@hotmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 133 776 097</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/alias-reiciend" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>292</div>
                                        </div>
                                        <div>Alias Reiciend</div>
                                        <div class="mob-hidden">Noelia83@hotmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 104 161 327</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/alias-laudantium" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>36</div>
                                        </div>
                                        <div>Alias Laudantium</div>
                                        <div class="mob-hidden">Mauricio.Lynch@gmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 145 237 350</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/corrupti" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>187</div>
                                        </div>
                                        <div>Corrupti</div>
                                        <div class="mob-hidden">Isaias_Crona83@hotmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 111 571 958</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/unde-aspernatur-earum-dolorem" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>44</div>
                                        </div>
                                        <div>Unde Asperna</div>
                                        <div class="mob-hidden">Isabella.Mertz@hotmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 107 795 910</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/eaque" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>243</div>
                                        </div>
                                        <div>Eaque</div>
                                        <div class="mob-hidden">Ephraim.Hansen@hotmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 121 129 929</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/aut-ipsa-excepturi-rerum" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>53</div>
                                        </div>
                                        <div>Aut Ipsa Except</div>
                                        <div class="mob-hidden">Jakayla46@yahoo.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 113 587 930</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/perspici-volupt" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>39</div>
                                        </div>
                                        <div>Perspici Volupt</div>
                                        <div class="mob-hidden">Darrion58@yahoo.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 108 176 026</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/hic-rem" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>219</div>
                                        </div>
                                        <div>Hic Rem</div>
                                        <div class="mob-hidden">Miller11@gmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 138 450 978</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/et-amet-repudiandae-quibusdam" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>71</div>
                                        </div>
                                        <div>Et Amet Repu</div>
                                        <div class="mob-hidden">Derek55@gmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 142 450 698</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/voluptatem-conse" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>173</div>
                                        </div>
                                        <div>Voluptatem Conse</div>
                                        <div class="mob-hidden">Devon.Carroll@hotmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 185 856 076</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/quod" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>156</div>
                                        </div>
                                        <div>Quod</div>
                                        <div class="mob-hidden">Alysha.Streich42@yahoo.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 160 398 747</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/aut-dignissimos" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>242</div>
                                        </div>
                                        <div>Aut Dignissimos</div>
                                        <div class="mob-hidden">Lucas.McGlynn@hotmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 158 355 637</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/inventore-unde" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>172</div>
                                        </div>
                                        <div>Inventore Unde</div>
                                        <div class="mob-hidden">Charlene88@yahoo.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 138 817 677</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="full-customer-row">
                                    <div class="checkbox-grid w-form">
                                        <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="60259d093669095e053196cc" data-wf-element-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfba">
                                            <label data-w-id="8c95eb69-e008-2e41-a0e9-8b0b9d02bfbb" class="w-checkbox checkbox-field-simple">
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
                                    <a href="/customer/sequi" class="customer-element w-inline-block">
                                        <div class="grid-number-block">
                                            <div>#</div>
                                            <div>25</div>
                                        </div>
                                        <div>Sequi</div>
                                        <div class="mob-hidden">Hillary_Runte@hotmail.com</div>
                                        <div class="grid-block mob-hidden">
                                            <div>+1 152 473 071</div>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Popup Form -->
<div id="popupForm" class="popup-form" style="display: none;">
    <div class="popup-content">
        <form action="admin/classroom" method="post">
            <label for="Subscriber-Email-3" class="field-label">Nom de la classe</label>
            <input type="text" class="simple-input no-margin w-input" maxlength="10" name="nom_classe" data-name="Subscriber Email" placeholder="Terminale A4" id="Subscriber-Email" required/>
            <div class="spacer _16"></div>
            <label for="Subscriber-Email-3" class="field-label">Email du stagiaire</label>
            <input type="email" class="simple-input no-margin w-input" maxlength="50" name="stagiaire_email" data-name="Subscriber Email" placeholder="email@example.com" id="Subscriber-Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  required/>
            <div class="spacer _16"></div>
            <input type="submit" value="Créer" data-wait="Please wait..." class="button no-margin w-button"/>
        </form>
    </div>
</div>

<style>
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
        z-index: 1000; /* Ensure the popup is on top */
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

    window.onclick = function(event) {
        if (event.target === document.getElementById('popupForm')) {
            hidePopup();
        }
    }
</script>