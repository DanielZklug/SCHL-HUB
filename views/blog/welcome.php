<?php $title="E-learning"?>

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
                <a href="authentification" class="nav-link w-nav-link">Connexion</a>
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
    <div style="background: #fff;" id="encadrants" class="features">
        <div class="container">
            <div class="h2-container">
                <h2 class="h2">
                    <span class="text-span">Intégrez des classes pour profiter de l'expertise de nos encadrants : </span>
                    Leurs conseils enrichissent vos connaissances et vous aident à progresser. Ne manquez pas cette chance !<br/>
                </h2>
            </div>
            <div  class="collection-list-wrapper w-dyn-list">
                <div role="list" class="collection-list w-dyn-items">
                    <?php
                        if (!empty($params['posts'])) {
                            foreach ($params['posts'] as $post) {
                                ?>
                                    <div role="listitem" class="collection-item w-dyn-item">
                                        <div style="border: 1px solid #ccc; border-radius: 5px;" class="feature-item-container">
                                            <div class="feature-icon">
                                                <?php 
                                                if (empty($post->photo_utilisateur)) {
                                                    $post->photo_utilisateur = "user.png";
                                                }                                     
                                                ?>
                                                <img alt="" src="<?= SCRIPTS . "img" . DIRECTORY_SEPARATOR . $post->photo_utilisateur ?>"/>
                                            </div>
                                            <h3 style="text-transform: capitalize;" class="h3"><?= htmlspecialchars($post->nom_utilisateur . " " . $post->prenom_utilisateur) ?></h3>
                                            <p class="paragraph cc-gray"><?= htmlspecialchars($post->profession_encadrant) ?></p>
                                            <a href="encadrants/<?= htmlspecialchars($post->idEncadrant) ?>" id="btn-view-more">Voir plus</a>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <br>
            <a href="encadrants" class="link">Tous les Encadrants</a>
        </div>
    </div>
    <section class="w3l-products w3l-faq-block py-5" id="projects">
    <div class="container py-md-5 py-2">
        <div class="header-secw3 text-center mb-5">
            <h6 class="title-subhny mb-2 text-primary">FAQs</h6>
            <h3 class="title-w3l mb-4">Ask Your Questions</h3>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 mx-auto pe-lg-5 mb-lg-0 mb-5">
                <div class="w3hny-business-img">
                    <img src="<?=SCRIPTS."img".DIRECTORY_SEPARATOR."g8.jpg"?>" alt="" class="img-fluid rounded shadow-lg">
                </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-4">
                <div class="accordion">
                    <div class="accordion-item mb-3">
                        <button id="accordion-button-1" aria-expanded="true" class="accordion-button p-3 w-100 text-left bg-primary text-white rounded shadow-sm">
                            <span class="accordion-title">How much does a static website cost?</span>
                        </button>
                        <div class="accordion-content p-3 bg-light rounded">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor.</p>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <button id="accordion-button-2" aria-expanded="false" class="accordion-button p-3 w-100 text-left bg-primary text-white rounded shadow-sm">
                            <span class="accordion-title">How to choose the best web template?</span>
                        </button>
                        <div class="accordion-content p-3 bg-light rounded">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut pretium.</p>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <button id="accordion-button-3" aria-expanded="false" class="accordion-button p-3 w-100 text-left bg-primary text-white rounded shadow-sm">
                            <span class="accordion-title">How to download a template?</span>
                        </button>
                        <div class="accordion-content p-3 bg-light rounded">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor.</p>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <button id="accordion-button-4" aria-expanded="false" class="accordion-button p-3 w-100 text-left bg-primary text-white rounded shadow-sm">
                            <span class="accordion-title">Why should I choose a free website?</span>
                        </button>
                        <div class="accordion-content p-3 bg-light rounded">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut potenti.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                    <img style="border-radius: 10px;" src="<?=SCRIPTS."img".DIRECTORY_SEPARATOR."close-up-woman-class.jpg"?>" alt=""/>
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
                    <img style="border-radius: 10px;" src="<?=SCRIPTS."img".DIRECTORY_SEPARATOR."coup-moyen-fille-tenant-presse-papiers_23-2148888878.jpg"?>" alt=""/>
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
        <div style="display: none;" class="formulaire" id="formulaire-enc">
            <h2>S'inscrire</h2>
            <form action="accueil" method="post">
                <div class="champ-formulaire">
                    <input type="text" name="nom" placeholder="Nom" required pattern="[A-Za-zÀ-ÿ '-]{2,30}" title="2 à 30 caractères alphabétiques.">
                </div>
                <div class="champ-formulaire">
                    <input type="text" name="prenom" placeholder="Prénom" required pattern="[A-Za-zÀ-ÿ '-]{2,30}" title="2 à 30 caractères alphabétiques.">
                </div>
                <div class="champ-formulaire">
                    <input type="tel" name="numero" placeholder="Numéro" required pattern="\+?[0-9]{10,15}" title="10 à 15 chiffres (peut inclure un code pays).">
                </div>
                <div class="champ-formulaire">
                    <input type="password" name="mot_passe" placeholder="Mot de passe" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Minimum 8 caractères, au moins une lettre majuscule, une lettre minuscule et un chiffre.">
                </div>
                <div class="champ-formulaire">
                    <input type="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Format : email@example.com">
                </div>
                <div class="bouton-formulaire">
                    <button type="submit">S'inscrire</button>
                </div>
                <input type="text" name="role" value="encadrant" hidden>
            </form>
        </div>
        <div style="display: block;" class="formulaire" id="formulaire-stu">
            <h2>S'inscrire</h2>
            <form action="accueil" method="post">
                <div class="champ-formulaire">
                    <input type="text" name="nom" placeholder="Nom" required pattern="[A-Za-zÀ-ÿ '-]{2,30}" title="2 à 30 caractères alphabétiques.">
                </div>
                <div class="champ-formulaire">
                    <input type="text" name="prenom" placeholder="Prénom" required pattern="[A-Za-zÀ-ÿ '-]{2,30}" title="2 à 30 caractères alphabétiques.">
                </div>
                <div class="champ-formulaire">
                    <input type="tel" name="numero" placeholder="Numéro" required pattern="\+?[0-9]{10,15}" title="10 à 15 chiffres (peut inclure un code pays).">
                </div>
                <div class="champ-formulaire">
                    <input type="password" name="mot_passe" placeholder="Mot de passe" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Minimum 8 caractères, au moins une lettre majuscule, une lettre minuscule et un chiffre.">
                </div>
                <div class="champ-formulaire">
                    <input type="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Format : email@example.com">
                </div>
                <div class="bouton-formulaire">
                    <button type="submit">S'inscrire</button>
                </div>
                <input type="text" name="role" value="etudiant" hidden>
            </form>
        </div>
    </div>
</div>

<style>
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Header Section */
    .header-secw3 h6.title-subhny {
        font-size: 1.2rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #3498db;
    }

    .header-secw3 h3.title-w3l {
        font-size: 2.5rem;
        font-weight: 600;
        margin-top: 20px;
        color: #2c3e50;
    }

    /* Accordion Section */
    .accordion {
        margin-top: 30px;
    }

    .accordion-item {
        margin-bottom: 15px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .accordion-button {
        width: 100%;
        padding: 15px;
        font-size: 1rem;
        text-align: left;
        background-color: #3498db;
        color: #fff;
        border: none;
        cursor: pointer;
        outline: none;
        transition: all 0.3s ease;
    }

    .accordion-button:hover {
        background-color: #2980b9;
    }

    .accordion-title {
        font-weight: 600;
    }

    .accordion-button[aria-expanded="true"] {
        background-color: #2980b9;
    }

    .accordion-content {
        display: none;
        padding: 15px;
        background-color: #ecf0f1;
        font-size: 0.9rem;
        color: #333;
        border-top: 1px solid #ccc;
    }

    .accordion-content p {
        margin: 0;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .header-secw3 h3.title-w3l {
            font-size: 2rem;
        }

        .accordion-button {
            padding: 12px;
        }
    }

    @media (max-width: 576px) {
        .header-secw3 h3.title-w3l {
            font-size: 1.8rem;
        }

        .accordion-button {
            font-size: 0.95rem;
        }

        .accordion-item {
            margin-bottom: 10px;
        }
    }

    /* Image Styling */
    .w3hny-business-img img {
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Other Utility Classes */
    .rounded {
        border-radius: 10px;
    }

    .shadow-lg {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }

    .shadow-sm {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>
<script>
    const items = document.querySelectorAll(".accordion button");

    function toggleAccordion() {
        const itemToggle = this.getAttribute('aria-expanded');

        items.forEach(item => {
            item.setAttribute('aria-expanded', 'false');
            item.nextElementSibling.style.display = 'none'; // Hide content
        });

        if (itemToggle === 'false') {
            this.setAttribute('aria-expanded', 'true');
            this.nextElementSibling.style.display = 'block'; // Show content
        }
    }

    items.forEach(item => item.addEventListener('click', toggleAccordion));
</script>

