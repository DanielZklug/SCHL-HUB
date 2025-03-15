<?php $title = "Profil" ?>
<div class="main-content">
    <div class="container w-container">
        <h1 class="page-title">Your Profile</h1>
    </div>
    <div class="_1-2-5-grid">
        <div class="module center-align sticky">
            <div class="profile-image large">
                <img src="<?= SCRIPTS.'img'.DIRECTORY_SEPARATOR.'user.png'?>" loading="lazy" alt="" class="cover-image"/>
            </div>
            <h3 class="no-margin">Nikolai Bain</h3>
            <h5>Designer</h5>
            <div class="profile-buttons-div"></div>
        </div>
        <div class="module-group">
            <div id="Account-Infomraiton" class="module">
                <div class="module-header minimal">
                    <h3 class="module-heading">Informations sur le compte</h3>
                </div>
                <div class="module-main">
                    <div class="settings-label">Photo de profil</div>
                    <a href="#" class="button settings w-button">Télécharger une nouvelle photo</a>
                    <p class="paragraph-small no-margin">
                    Vous pouvez télécharger des images jusqu’à 400x400px<br/>
                    </p>
                    <div class="divider"></div>
                    <div class="w-form">
                        <form id="email-form" name="email-form" data-name="Email Form" class="form">
                            <div class="field-block">
                                <label for="name">Nom</label>
                                <input type="text" class="text-input filled w-input" maxlength="256" value="Nikolai Bain" required="" disabled/>
                            </div>
                            <div class="field-block">
                                <label for="profile-email">Email</label>
                                <input type="email" class="text-input filled w-input" maxlength="256" value="example@email.com" required="" disabled/>
                            </div>
                            <div class="field-block">
                                <label for="Role">Role</label>
                                <input type="text" class="text-input filled w-input" maxlength="256" value="Designer" id="Role" required="" disabled/>
                            </div>
                            <div class="field-block">
                                <label for="Username">Bio</label>
                                <textarea placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat." maxlength="5000" data-name="Field" name="field" class="text-area filled w-input"></textarea>
                            </div>
                            <input type="submit" value="Mettre à jour" data-wait="Please wait..." class="button settings w-button"/>
                        </form>
                    </div>
                </div>
            </div>
            <div id="Social-Profiles" class="module">
                <div class="module-header minimal">
                    <h3 class="module-heading">Profils sociaux</h3>
                </div>
                <div class="module-main">
                    <div class="w-form">
                        <form id="email-form" name="email-form" data-name="Email Form" class="form">
                            <div class="field-block">
                                <label for="name">Twitter</label>
                                <input type="text" class="text-input filled w-input" maxlength="256" name="name-3" data-name="Name 3" placeholder="@foxtrot44" required=""/>
                            </div>
                            <div class="field-block">
                                <label for="Facebook">Facebook</label>
                                <input type="text" maxlength="256" name="Facebook" data-name="Facebook" required="" class="text-input w-input"/>
                            </div>
                            <div class="field-block">
                                <label for="Facebook">Instagram</label>
                                <input type="text" class="text-input filled w-input" maxlength="256" name="Facebook-4" data-name="Facebook 4" placeholder="foxtrot-official" required=""/>
                            </div>
                            <div class="field-block">
                                <label for="Facebook">Google</label>
                                <input type="text" maxlength="256" name="Facebook-3" data-name="Facebook 3" required="" class="text-input w-input"/>
                            </div>
                            <div class="field-block">
                                <label for="Facebook">Github</label>
                                <input type="text" maxlength="256" name="Facebook-2" data-name="Facebook 2" required="" class="text-input w-input"/>
                            </div>
                            <input type="submit" value="Update" data-wait="Please wait..." class="button settings w-button"/>
                        </form>
                    </div>
                </div>
            </div>
            <div id="Social-Profiles" class="module">
                <div class="module-header minimal">
                    <h3 class="module-heading">Profile Stats</h3>
                </div>
                <div id="module-main" class="module-main">
                    <div class="_50-width">
                        <div class="field-label">Classes crées</div>
                        <p>5th April 2018</p>
                    </div>
                    <div class="_50-width">
                        <div class="field-label">Tâches attribuées</div>
                        <p>213</p>
                    </div>
                    <div class="_50-width">
                        <div class="field-label">Cours publiées</div>
                        <p>2,434</p>
                    </div>
                    <div class="_50-width">
                        <div class="field-label">Stagiaires enregistrés</div>
                        <p>412</p>
                    </div>
                </div>
            </div>
        </div>
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
</style>