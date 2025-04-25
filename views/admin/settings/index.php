<?php $title="Paramètres"?>
<div class="main-content">
    <div class="container w-container">
        <h1 class="page-title">Paramètres</h1>
    </div>
    <div class="_1-2-5-grid">
        <div class="module sticky">
            <div class="menu-list-section">
                <a href="#Edit-Profile" class="menu-link w-inline-block">
                    <div class="sidebar-link-text">Paramètres de compte</div>
                </a>
                <a href="#Password" class="menu-link w-inline-block">
                    <div class="sidebar-link-text">Mot de passe</div>
                </a>
                <!-- <a href="#Email-Notifications" class="menu-link w-inline-block">
                    <div class="sidebar-link-text">Notifications par e-mail</div>
                </a> -->
                <!-- <a href="#Desktop-Notifications" class="menu-link w-inline-block">
                    <div class="sidebar-link-text">Desktop Notifications</div>
                </a> -->
                <!-- <a href="#Integration-Access" class="menu-link w-inline-block">
                    <div class="sidebar-link-text">Accès à l'intégration</div>
                </a> -->
                <a href="#Close-Account" class="menu-link w-inline-block">
                    <div class="sidebar-link-text">Fermer le compte</div>
                </a>
            </div>
        </div>
        <div class="module-group">
            <div id="Edit-Profile" class="module">
                <div class="module-header minimal">
                    <h3 class="module-heading">Paramètres de compte</h3>
                </div>
                <div class="module-main">
                    <div class="settings-div">
                        <div class="settings-label">Langue</div>
                        <div data-hover="" data-delay="0" class="account-dropdown w-dropdown">
                            <div class="settings-dropdown-toggle w-dropdown-toggle" onclick="toggleLanguage()">
                                <div class="filter-dropdown-icon w-icon-dropdown-toggle"></div>
                                <div id="languageLabel">Anglais</div>
                            </div>
                            <!-- <nav class="filter-dropdown-3 w-dropdown-list" id="languageDropdown">
                                <a href="#" class="filter-option w-dropdown-link" onclick="changeLanguage('French')">French</a>
                            </nav> -->
                        </div>
                    </div>
                    <!-- <div class="settings-div">
                        <div class="settings-label">Country</div>
                        <div data-hover="" data-delay="0" class="account-dropdown w-dropdown">
                            <div class="settings-dropdown-toggle w-dropdown-toggle">
                                <div class="filter-dropdown-icon w-icon-dropdown-toggle"></div>
                                <div>New Zealand</div>
                            </div>
                            <nav class="filter-dropdown-3 w-dropdown-list">
                                <a href="#" class="filter-option w-dropdown-link">America</a>
                                <a href="#" class="filter-option w-dropdown-link">North Korea</a>
                                <a href="#" class="filter-option w-dropdown-link">Russia</a>
                                <a href="#" class="filter-option w-dropdown-link">Australia</a>
                                <a href="#" class="filter-option w-dropdown-link">New Zealand</a>
                                <a href="#" class="filter-option w-dropdown-link">South Africa</a>
                            </nav>
                        </div>
                    </div> -->
                    <!-- <div class="w-form">
                        <form data-name="Email Form" name="email-form" class="form">
                            <div class="divider"></div>
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                <input type="checkbox" data-name="Checkbox 6" name="checkbox-6" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox-6" class="w-form-label">Block mature content</span>
                            </label>
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox w--redirected-checked"></div>
                                <input type="checkbox" checked="" name="checkbox-4" data-name="Checkbox 4" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox-7" class="w-form-label">Opt out of recommendations based on your activity</span>
                            </label>
                        </form>
                        <div class="form-success w-form-done">
                            <div>Thank you! Your message has been received!</div>
                        </div>
                        <div class="form-error w-form-fail">
                            <div>Oops! Something went wrong. Please fill in the required fields and try again.</div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div id="Password" class="module">
                <div class="module-header minimal">
                    <h3 class="module-heading">Mot de passe</h3>
                </div>
                <div class="module-main">
                    <div class="w-form">
                        <form id="email-form" name="email-form" data-name="Email Form" class="form">
                            <div class="field-block">
                                <label for="name-2">Ancien Mot de passe</label>
                                <input type="password" maxlength="100" name="name-2" data-name="Name 2" class="text-input w-input" disabled/>
                            </div>
                            <div class="field-block">
                                <label for="profile-email-2">Nouveu Mot de passe</label>
                                <input type="password" maxlength="100" name="profile-email-2" data-name="Profile Email 2" class="text-input w-input"/>
                            </div>
                            <input type="submit" value="Changer" data-wait="Please wait..." class="button settings w-button"/>
                        </form>
                        <!-- <div class="form-success w-form-done">
                            <div>We &#x27;ve updated your account. Please refresh the page.</div>
                        </div>
                        <div class="form-error w-form-fail">
                            <div>Oops! Something went wrong. Please fill in the required fields and try again.</div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- <div id="Email-Notifications" class="module">
                <div class="module-header minimal">
                    <h3 class="module-heading">Email Notifications</h3>
                </div>
                <div class="module-main">
                    <div class="w-form">
                        <form data-name="Email Form" name="email-form" class="form">
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                <input type="checkbox" data-name="Checkbox 5" name="checkbox-5" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox-5" class="w-form-label">Receive emails about a new order</span>
                            </label>
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox w--redirected-checked"></div>
                                <input type="checkbox" checked="" name="checkbox-5" data-name="Checkbox 5" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox-6" class="w-form-label">Receive emails about a new customer</span>
                            </label>
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                <input type="checkbox" data-name="Checkbox 5" name="checkbox-5" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox-6" class="w-form-label">Receive emails when something in your account changes</span>
                            </label>
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                <input type="checkbox" data-name="Checkbox 5" name="checkbox-5" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox-6" class="w-form-label">Receive emails when there is a new computer sign-on</span>
                            </label>
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                <input type="checkbox" data-name="Checkbox 5" name="checkbox-5" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox-6" class="w-form-label">Receive emails from us about product updates</span>
                            </label>
                        </form>
                        <div class="form-success w-form-done">
                            <div>Thank you! Your message has been received!</div>
                        </div>
                        <div class="form-error w-form-fail">
                            <div>Oops! Something went wrong. Please fill in the required fields and try again.</div>
                        </div>
                    </div>
                    <div class="settings-div">
                        <div class="settings-label">Notification frequency</div>
                        <div data-hover="" data-delay="0" class="account-dropdown w-dropdown">
                            <div class="settings-dropdown-toggle w-dropdown-toggle">
                                <div class="filter-dropdown-icon w-icon-dropdown-toggle"></div>
                                <div>Weekly</div>
                            </div>
                            <nav class="filter-dropdown-3 w-dropdown-list">
                                <a href="#" class="filter-option w-dropdown-link">Daily</a>
                                <a href="#" class="filter-option w-dropdown-link">Weekly</a>
                                <a href="#" class="filter-option w-dropdown-link">Bi-Weekly</a>
                                <a href="#" class="filter-option w-dropdown-link">Monthly</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div id="Desktop-Notifications" class="module">
                <div class="module-header minimal">
                    <h3 class="module-heading">Desktop Notifications</h3>
                </div>
                <div class="module-main">
                    <div class="w-form">
                        <form data-name="Email Form" name="email-form" class="form">
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom toggle w--redirected-checked"></div>
                                <input type="checkbox" data-name="Checkbox 4" name="checkbox-4" checked="" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox" class="w-form-label">Enable desktop notifications</span>
                            </label>
                        </form>
                        <div class="form-success w-form-done">
                            <div>Thank you! Your message has been received!</div>
                        </div>
                        <div class="form-error w-form-fail">
                            <div>Oops! Something went wrong. Please fill in the required fields and try again.</div>
                        </div>
                    </div>
                    <div class="settings-div">
                        <div class="settings-label">Notification frequency</div>
                        <div data-hover="" data-delay="0" class="account-dropdown w-dropdown">
                            <div class="settings-dropdown-toggle w-dropdown-toggle">
                                <div class="filter-dropdown-icon w-icon-dropdown-toggle"></div>
                                <div>Daily</div>
                            </div>
                            <nav class="filter-dropdown-3 w-dropdown-list">
                                <a href="#" class="filter-option w-dropdown-link">Daily</a>
                                <a href="#" class="filter-option w-dropdown-link">Weekly</a>
                                <a href="#" class="filter-option w-dropdown-link">Bi-Weekly</a>
                                <a href="#" class="filter-option w-dropdown-link">Monthly</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div id="Integration-Access" class="module">
                <div class="module-header minimal">
                    <h3 class="module-heading">Integration Access</h3>
                </div>
                <div class="module-main">
                    <div class="w-form">
                        <form data-name="Email Form" name="email-form" class="form">
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom toggle"></div>
                                <input type="checkbox" data-name="Checkbox 4" name="checkbox-4" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox" class="w-form-label">Let third party softwares connect to Dawn</span>
                            </label>
                            <div class="field-block">
                                <label for="name">Zapier Token</label>
                                <input type="password" maxlength="256" name="name-2" data-name="Name 2" class="text-input w-input"/>
                            </div>
                            <div class="field-block">
                                <label for="name">Webflow Token</label>
                                <input type="password" maxlength="256" name="name-2" data-name="Name 2" class="text-input w-input"/>
                            </div>
                        </form>
                        <div class="form-success w-form-done">
                            <div>Thank you! Your message has been received!</div>
                        </div>
                        <div class="form-error w-form-fail">
                            <div>Oops! Something went wrong. Please fill in the required fields and try again.</div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div id="Close-Account" class="module red">
                <div class="module-header minimal">
                    <h3 class="module-heading red">Supprimer le compte</h3>
                </div>
                <div class="module-main">
                    <p>
                    Êtes-vous sûr de vouloir que votre compte soit supprimé ? <br/>Cette action ne peut pas être annulée.
                    </p>
                    <div class="w-form">
                        <form data-name="Email Form" name="email-form" class="form">
                            <label class="w-checkbox checkbox-element">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                <input type="checkbox" data-name="Checkbox 4" name="checkbox-4" style="opacity:0;position:absolute;z-index:-1"/>
                                <span for="checkbox-6" class="w-form-label">Je suis absolument sûr de vouloir que mon compte soit supprimé</span>
                            </label>
                            <input type="submit" value="Supprimer mon compte" data-wait="Please wait..." class="button delete w-button"/>
                        </form>
                        <!-- <div class="form-success w-form-done">
                            <div>We &#x27;re sorry to see you go.</div>
                        </div>
                        <div class="form-error w-form-fail">
                            <div>Oops! Something went wrong. Try again later.</div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleLanguage() {
        const languageLabel = document.getElementById('languageLabel');
        const currentLanguage = languageLabel.textContent;

        // Change le texte entre English et French
        if (currentLanguage === 'Anglais') {
            languageLabel.textContent = 'Français';
        } else {
            languageLabel.textContent = 'Anglais';
        }
    }

    function changeLanguage(language) {
        const languageLabel = document.getElementById('languageLabel');
        languageLabel.textContent = language; // Change le texte du sélecteur
    }
</script>