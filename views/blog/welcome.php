<div class="navigation"></div>
        <div data-collapse="medium" data-animation="default" data-duration="400" data-easing="ease-out" data-easing2="ease-out" role="banner" class="navigation w-nav">
            <div class="navigation-container">
                <a style="color: white; text-decoration: none; " href="" aria-current="page" class="logo w-inline-block w--current">
                    <h1 class="logo" style="font-weight: 800;font-size: 3em;">SCHL<span style="font-size: .8em;background: rgb(20, 107, 207); border-radius: 5px;padding: 5px;">hub</span></h1>
                </a>
                <nav role="navigation" class="nav-menu w-nav-menu">
                    <a href="#encadrants" class="nav-link w-nav-link">Encadrants</a>
                    <a href="#objectifs" class="nav-link w-nav-link">Objectifs</a>
                    <a href="#contact" class="nav-link w-nav-link">Contact</a>
                    <a href="#propos" class="nav-link w-nav-link">A propos</a>
                    <div class="bullet"></div>
                    <a href="#" class="nav-link w-nav-link">Connexion</a>
                    <a href="#inscription" class="navigation-button w-button">Inscription</a>
                </nav>
                <div class="menu-button w-nav-button">
                    <div class="icon-2 w-icon-nav-menu"></div>
                </div>
            </div>
        </div>
        <div id="accueil" class="header">
            <div class="header-content">
                <h1 data-w-id="b777ef2d-ac03-cea3-ccc5-52beeee5222a" style="-webkit-transform:translate3d(0, 40PX, 0) scale3d(1, 1, 1) rotateX(-50DEG) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 40PX, 0) scale3d(1, 1, 1) rotateX(-50DEG) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 40PX, 0) scale3d(1, 1, 1) rotateX(-50DEG) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 40PX, 0) scale3d(1, 1, 1) rotateX(-50DEG) rotateY(0) rotateZ(0) skew(0, 0);transform-style:preserve-3d;opacity:0" class="h1">Apprendre après le stage, toujours à portée de main.</h1>
                <p data-w-id="cd085e48-08fc-46a5-a6c3-97346f451e6d" style="opacity:0;-webkit-transform:translate3d(0, 60PX, 0) scale3d(1, 1, 1) rotateX(-60DEG) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 60PX, 0) scale3d(1, 1, 1) rotateX(-60DEG) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 60PX, 0) scale3d(1, 1, 1) rotateX(-60DEG) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 60PX, 0) scale3d(1, 1, 1) rotateX(-60DEG) rotateY(0) rotateZ(0) skew(0, 0);transform-style:preserve-3d; font-size: 1.3em;" class="paragraph">Tout ce que votre encadrant vous a donné, à un clic de distance.</p>
                <a href="#inscription" class="button w-button">Explorez nos cours</a>
            </div>
        </div>
        <div id="encadrants" class="features">
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
                        <div class="feature-item-container">
                            <div class="feature-icon">
                                <img alt="" src="<?=SCRIPTS."img".DIRECTORY_SEPARATOR.$post->photo?>"/>
                            </div>
                            <h3 style="text-transform: capitalize;" class="h3"><?=$post->nom." ".$post->prenom?></h3>
                            <p class="paragraph cc-gray"><?=$post->profession?></p>
                            <a href="encadrants/<?=$post->utilisateur_id?>" style="background: rgb(20, 107, 207); color: white;height:30px;font-weight:600;border-radius:5px; position: relative; left: 200px;top:10px;padding:8px;text-decoration:none">Voir plus</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <br>
        <a href="encadrants" class="link">Tous les Encadrants</a>
    </div>
</div>
        <div class="slider-section">
            <div id="propos" data-delay="6000" data-animation="fade" class="slider w-slider" data-autoplay="true" data-easing="ease" data-hide-arrows="false" data-disable-swipe="true" data-autoplay-limit="0" data-nav-spacing="5" data-duration="500" data-infinite="true">
                <div class="w-slider-mask">
                    <div  class="slide w-slide">
                    </div>
                    <div class="slide-2 w-slide">
                    </div>
                    <div class="slide-3 w-slide">
                    </div>
                </div>
                <div class="slide-nav w-slider-nav w-round"></div>
            </div>
        </div>
        <div class="about">
            <div class="container cc-center">
                <div class="h2-container cc-center">
                    <h2 class="h2 cc-center">
                        <span class="text-span">Illud decore voluptaria has at.</span>
                        Hinc invenire atomorum no vel. Ut vis nullam blandit neglegentur, omittam perpetua voluptatum qui eu. Iusto laoreet suscipit vis ad, ad ferri tempor duo.
                    </h2>
                </div>
            </div>
        </div>
        <div class="separator cc-background-grey">
            <div class="container">
                <div class="line-color"></div>
            </div>
        </div>
        <div id="objectifs" class="premium">
            <div class="container">
                <div class="row">
                    <div class="_2-row-image cc-row-spacing">
                        <img src="<?=SCRIPTS."img".DIRECTORY_SEPARATOR."close-up-woman-class.jpg"?>" alt=""/>
                    </div>
                    <div class="_2-row-text">
                        <h2 class="h2 cc-2-rows">
                            <span class="text-span">La leçon à la maison</span>
                            Quand la distance entre vous et vos cours ne tient qu'à un CLIC.
                        </h2>
                        <p class="paragraph cc-gray">Avec SCHLhub vous avez la possibilité d'etre encadrer par votre enseignant, depuis chez vous</p>
                    </div>
                </div>
                <div class="row cc-bottom">
                    <div class="_2-row-image cc-bottom">
                        <img src="<?=SCRIPTS."img".DIRECTORY_SEPARATOR."coup-moyen-fille-tenant-presse-papiers_23-2148888878.jpg"?>" alt=""/>
                    </div>
                    <div class="_2-row-text cc-bottom">
                        <h2 class="h2 cc-2-rows">
                            <span class="text-span">Apprendre meme après le stage</span>
                            La fin d'un stage ne signifie pas la fin de l'apprentissage professionnel.
                        </h2>
                        <p class="paragraph cc-gray">Vous pouvez à tout moment retourner dans votre classe en ligne afin de lire ou télécharger votre leçon et celà meme des mois plutard.</p>
                    </div>
                </div>
                <!-- <div class="_2-row-action-text">
                    <h3 class="h3">SCHLhub? Comment çà marche ??</h3>
                    <a href="/premium" class="link">See the full range of Premium</a>
                </div> -->
            </div>
        </div>
        <div class="separator cc-background-grey">
            <div class="container">
                <div class="line-color"></div>
            </div>
        </div>
        <div id="inscription" class="cta">
            <div class="container cc-cta">
                <div class="cta-column">
                    <div class="cta-left-top">
                        <h3 style="color: rgb(20, 107, 207);" class="h3 cc-cta">N'hésitez pas</h3>
                        <div class="cta-line"></div>
                    </div>
                    <h2 class="h2">
                        <span style="font-size: 1.5em;" class="text-span">Inscrivez-vous maintenant sur SCHLhub. <br></span>
                    </h2>
                </div>
                <div class="cta-column">
                    <select name="" id="">
                        <option value="">Choisir un profil</option>
                        <option value="Etudiant">Etudiant</option>
                        <option value="Encadrant">Encadrant</option>
                    </select>
                </div>
            </div>
        </div>
        <div style="height: 380px; display: none;" id="cta" class="cta">
           <div style="display: none;"  class="formulaire" id="formulaire-enc">
                <h2>S'inscrire</h2>
                <form action="" method="post">
                   <div class="champ-formulaire">
                        <input type="text" placeholder="Nom" required>
                    </div>
                   <div class="champ-formulaire">
                        <input type="text" placeholder="Prénom" required>
                    </div>
                   <div class="champ-formulaire">
                        <input type="tel" placeholder="Numéro" required>
                    </div>
                   <div class="champ-formulaire">
                        <input type="email" placeholder="Email" required>
                    </div>
                    <div class="champ-formulaire">
                        <input type="email" placeholder="Email de l'entreprise" required>
                    </div>
                   <div class="champ-formulaire">
                        <input type="password" placeholder="mot de passe" required>
                    </div>
                   <div class="bouton-formulaire">
                        <button type="submit">S'inscrire</button>
                        <p>Vous avez déjà un compte ?<a href="#">Se connecter</a></p>
                   </div>
                </form>
           </div>
           <div style="display: block;" class="formulaire" id="formulaire-stu">
                <h2>S'inscrire</h2>
                <form action="" method="post">
                    <div class="champ-formulaire">
                        <input type="text" placeholder="Nom" required>
                    </div>
                    <div class="champ-formulaire">
                        <input type="text" placeholder="Prénom" required>
                    </div>
                    <div class="champ-formulaire">
                        <input type="tel" placeholder="Numéro" required>
                    </div>
                    <div class="champ-formulaire">
                        <input type="email" placeholder="Email" required>
                    </div>
                    <div class="champ-formulaire">
                        <input type="email" placeholder="Email de l'institut" required>
                    </div>
                    <div class="champ-formulaire">
                        <input type="password" placeholder="mot de passe" required>
                    </div>
                    <div class="bouton-formulaire">
                        <button type="submit">S'inscrire</button>
                        <p>Vous avez déjà un compte ?<a href="#">Se connecter</a></p>
                    </div>
                 </form>
       </div>
        </div>