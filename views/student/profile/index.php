<?php 
$title = "Profil" ;
$_SESSION['idEncadrant'] = $params['post']->idStagiaire;
?>
<div class="main-content">
    <div class="container w-container">
        <h1 class="page-title">Votre profil</h1>
    </div>
    <div class="_1-2-5-grid">
        <div class="module center-align sticky">
            <div class="profile-image large">
                <?php 
                    if (empty($params['post']->Stagiaire_photo)) {
                        $params['post']->Stagiaire_photo = "user.png";
                    }                                     
                ?>
                <img src="<?= SCRIPTS.'uploads'.DIRECTORY_SEPARATOR.$params['post']->Stagiaire_photo?>" loading="lazy" alt="" class="cover-image"/>
            </div>
            <h3 class="no-margin"><?=$params['post']->Stagiaire_nom." ".$params['post']->Stagiaire_prenom?></h3>
            <h5></h5>
            <div class="profile-buttons-div"></div>
        </div>
        <div class="module-group">
            <div id="Account-Infomraiton" class="module">
                <div class="module-header minimal">
                    <h3 class="module-heading">Informations sur le compte</h3>
                </div>
                <div class="module-main">
                    <div class="settings-label">Photo de profil</div>
                    <div class="w-form">
                        <form id="email-form" name="email-form" data-name="Email Form" class="form" action="student/profile" method="post" enctype="multipart/form-data">
                            <div class="field-block">
                                <label for="file" class="custum-file-upload">
                                    <div class="icon">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path> </g></svg>
                                    </div>
                                    <div class="text">
                                        <span class="settings-label" >Charger une image</span>
                                    </div>
                                    <input name="file" id="file" type="file" accept="image/*" required>
                                </label>
                                <img onclick="window.location.reload()" id="image-preview" src="#" alt="Image Preview" style="display: none; max-width: 30%; height: auto; margin-top: 10px;border-radius: 10px">
                            </div>
                            <br>
                            <input type="submit" value="Mettre à jour" class="button settings w-button"/>
                        </form>
                    </div>
                    <style>
                        .custum-file-upload {
                            height: 140px;
                            width: 200px;
                            display: flex;
                            flex-direction: column;
                            align-items: space-between;
                            gap: 1px;
                            cursor: pointer;
                            align-items: center;
                            justify-content: center;
                            border: 2px dashed #cacaca;
                            background-color: rgba(255, 255, 255, 1);
                            padding: 1.5rem;
                            border-radius: 10px;
                            box-shadow: 0px 48px 35px -48px rgba(0,0,0,0.1);
                        }

                        .custum-file-upload .icon {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        .custum-file-upload .icon svg {
                            height: 40px;
                            fill: rgba(75, 85, 99, 1);
                        }

                        .custum-file-upload .text {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        .custum-file-upload input {
                            display: none;
                        }
                    </style>
                    <script>
                        document.getElementById('file').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                const imgElement = document.getElementById('image-preview');
                                imgElement.src = e.target.result;
                                imgElement.style.display = 'block';
                            };

                            if (file) {
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                    <p class="paragraph-small no-margin">
                    Vous pouvez télécharger des images jusqu’à 400x400px<br/>
                    </p>
                    <div class="divider"></div>
                    <div class="w-form">
                        <form action="student/profile" method="post">
                            <div class="field-block">
                                <label for="name">Nom</label>
                                <input type="text" class="text-input filled w-input" 
                                    maxlength="100" 
                                    value="<?=$params['post']->Stagiaire_nom." ".$params['post']->Stagiaire_prenom?>" 
                                    required 
                                    disabled 
                                    pattern="[A-Za-zÀ-ÿ\s]+" 
                                    title="Veuillez entrer uniquement des lettres et des espaces."/>
                            </div>
                            <div class="field-block">
                                <label for="profile-email">Email Personnel</label>
                                <input type="email" class="text-input filled w-input" 
                                    maxlength="100" 
                                    value="<?=$params['post']->Stagiaire_email?>" 
                                    required 
                                    disabled 
                                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" 
                                    title="Veuillez entrer un email valide."/>
                            </div>
                            <div class="field-block">
                                <label for="profile-email">Email Organisationnel</label>
                                <input type="email" name="email_organisationnel" class="text-input filled w-input" 
                                    maxlength="100" 
                                    value="<?=$params['post']->emailUni?>" 
                                    required 
                                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" 
                                    title="Veuillez entrer un email valide."/>
                            </div>
                            <div class="field-block">
                                <label for="Role">genre</label>
                                <input type="text" name="profession_encadrant" class="text-input filled w-input" 
                                    maxlength="100" 
                                    value="<?=$params['post']->Stagiaire_genre?>" 
                                    id="Role" 
                                    required 
                                    pattern="[A-Za-zÀ-ÿ\s]+" 
                                    title="Veuillez entrer uniquement des lettres et des espaces."/>
                            </div>
                            <div class="field-block">
                                <label for="Role">Numero</label>
                                <input type="text" name="profession_encadrant" class="text-input filled w-input" 
                                    maxlength="100" 
                                    value="<?=$params['post']->Stagiaire_numero?>" 
                                    id="Role" 
                                    required 
                                    pattern="[A-Za-zÀ-ÿ\s]+" 
                                    title="Veuillez entrer uniquement des lettres et des espaces."/>
                            </div>
                            <button type="submit" class="button settings w-button">Mettre à jour</button>
                        </form>
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