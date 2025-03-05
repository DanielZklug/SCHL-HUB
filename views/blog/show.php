<?php $title = $params['post']->nom." ".$params['post']->prenom; ?>
<div id="features" class="features">
    <div class="container">
        <div class="collection-list-wrapper w-dyn-list">
            <div role="list" class="collection-list w-dyn-items">
                <div role="listitem" class="collection-item w-dyn-item">
                    <div class="feature-item-container">
                        <div class="feature-icon">
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
        width: 320px;
        height: 500px;
    }
</style>