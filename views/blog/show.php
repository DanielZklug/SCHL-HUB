<?php $title = $params['post']->nom." ".$params['post']->prenom;?>
<a href="accueil" class="link"><h3>Retour à l'accueil</h3></a>
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
        <div class="collection-list-wrapper w-dyn-list">
            <div role="list" class="collection-list w-dyn-items">
                <div role="listitem" class="collection-item w-dyn-item">
                    <div style=" border: 1px solid #ccc; border-radius: 5px" class="feature-item-container">
                        <div class="feature-icon">
                            <?php 
                                if (empty($params['post']->photo)){
                                    $params['post']->photo = "user.png";
                                }                                     
                            ?>
                            <img alt="" src="<?=SCRIPTS."img".DIRECTORY_SEPARATOR.$params['post']->photo?>"/>
                        </div>
                        <h2 style="text-transform: capitalize;" class="h3"><?=$params['post']->nom." ".$params['post']->prenom?></h2>
                        <p style="font-size: 1.2em;"  class="paragraph cc-gray"><?=$params['post']->profession?></p>
                        <p style="font-size: 1.2em;" class="paragraph cc-gray"><?=$params['post']->description?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .feature-item-container{
        width: 300px;
        height: 400px;
    }
</style>