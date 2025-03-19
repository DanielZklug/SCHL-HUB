<?php $title = "Encadrants";?>
<a href="/schl-hub/accueil" class="link"><h3>Retour à l'accueil</h3></a>
<style>
    .link,h3{
        color: rgb(20, 107, 207);
    }
    .link:hover,h3:hover{
        color: #111728;
    }
</style>
<div id="features" class="features">
    <div class="container">
        <div class="h2-container">
            <h2 class="h2">
                <span class="text-span">Intégrez des classes pour profiter de l'expertise de nos encadrants : </span>
                Leurs conseils enrichissent vos connaissances et vous aident à progresser. Ne manquez pas cette chance !<br/>
            </h2>
        </div>
        <div class="collection-list-wrapper w-dyn-list">
            <div role="list" class="collection-list w-dyn-items">
            <?php foreach ($params['posts'] as $post): ?>
                <div role="listitem" class="collection-item w-dyn-item">
                    <div style="border: 1px solid #ccc; border-radius: 5px;" class="feature-item-container">
                        <div class="feature-icon">
                            <?php 
                                if (empty($post->photo_utilisateur)){
                                    $post->photo_utilisateur = "user.png";
                                }                                     
                            ?>
                            <img alt="" src="<?=SCRIPTS."img".DIRECTORY_SEPARATOR.$post->photo_utilisateur?>"/>
                        </div>
                        <h3 style="text-transform: capitalize;" class="h3"><?=$post->nom_utilisateur." ".$post->prenom_utilisateur?></h3>
                        <p class="paragraph cc-gray"><?=$post->profession_encadrant?></p>
                        <a href="encadrants/<?=$post->idEncadrant?>" id="btn-view-more">Voir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
