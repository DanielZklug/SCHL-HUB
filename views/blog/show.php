<?php $title = $params['post']->nom_utilisateur." ".$params['post']->prenom_utilisateur;?>
<a href="/schl-hub/accueil" class="link"><h3>Retour à l'accueil</h3></a>
<style>
    .link,h3 {
        color: rgb(20, 107, 207);
    }
    .link:hover,h3:hover {
        color: #111728;
    }
</style>
<div id="features" class="features">
    <div class="container">
        <div class="collection-list-wrapper w-dyn-list">
            <div role="list" class="collection-list w-dyn-items">
                <div role="listitem" class="collection-item w-dyn-item">
                    <div class="feature-item-container">
                        <div class="feature-icon">
                            <?php 
                                if (empty($params['post']->photo_utilisateur)){
                                    $params['post']->photo_utilisateur = "user.png";
                                }                                     
                            ?>
                            <img alt="" src="<?=SCRIPTS."uploads".DIRECTORY_SEPARATOR.$params['post']->photo_utilisateur?>"/>
                        </div>
                        <h2 style="text-transform: capitalize;" class="h3"><?=$params['post']->nom_utilisateur." ".$params['post']->prenom_utilisateur?></h2>
                        <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->profession_encadrant?></p>
                        <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->bio_encadrant?></p>
                        <hr>
                        <div class="info-container">
                            <div>
                                <label class="info-label">Numéro :</label>
                                <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->numero_utilisateur?></p>
                            </div>
                            <div>
                                <label class="info-label">Email Organisationnel :</label>
                                <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->email_organisationnel?></p>
                            </div>
                            <div>
                                <label class="info-label">Email Personnel :</label>
                                <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->email_utilisateur?></p>
                            </div>
                            <div>
                                <label class="info-label">GitLab :</label>
                                <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->gitlab?></p>
                            </div>
                            <div>
                                <label class="info-label">GitHub :</label>
                                <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->github?></p>
                            </div>
                            <div>
                                <label class="info-label">Google :</label>
                                <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->google?></p>
                            </div>
                            <div>
                                <label class="info-label">Facebook :</label>
                                <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->facebook?></p>
                            </div>
                            <div>
                                <label class="info-label">Instagram :</label>
                                <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->instagram?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .feature-item-container {
        width: 90%; /* Utilisation d'une largeur relative */
        max-width: 900px; /* Largeur maximale */
        height: auto; /* Hauteur automatique pour la réactivité */
        margin: 0 auto; /* Centrer le conteneur */
        border: 1px solid #ccc; 
        border-radius: 5px;
        padding: 40px; /* Ajout de padding pour l'espacement intérieur */
    }

    .info-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Trois colonnes */
        gap: 20px; /* Espacement entre les éléments */
    }

    .info-label {
        font-weight: bold; /* Mettre en gras les labels */
        margin-bottom: 5px; /* Espacement entre le label et le texte */
        display: block; /* Afficher le label en bloc */
    }

    /* Media Query pour les petits écrans */
    @media (max-width: 600px) {
        .info-container {
            grid-template-columns: 1fr; /* Une seule colonne */
        }
        .feature-item-container {
            width: 95%; /* Légèrement plus large sur petits écrans */
        }
    }
</style>
