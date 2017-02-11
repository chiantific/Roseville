<?php
session_start();
$defaultLang = 'fr';

if (!empty($_GET["language"])) {
    switch (strtolower($_GET["language"])) {
        case "en":
            $_SESSION['lang'] = 'en';
            break;
        case "tr":
            $_SESSION['lang'] = 'tr';
            break;
        default:
            $_SESSION['lang'] = $defaultLang;
            break;
    }
}

if (empty($_SESSION["lang"])) {
    $_SESSION["lang"] = $defaultLang;
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Roseville Escape Room</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
              content="Roseville Escape est un jeu d'évasion situé à deux pas de Vevy. Une activité originale dans un décor insolite faisant appel à l'esprit d'équipe pour s'amuser en famille, entre amis ou collègues.">
        <meta name="keywords"
              content="escape, Lavaux, jeu, enigme, vevey, riviera, corseaux">
        <!--[if IE]><link rel="shortcut icon" href="img/favicon.ico"><![endif]-->
        <link href="img/favicon.ico" rel="icon" type="image/x-icon" />
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet" />
        <link rel="stylesheet" type="text/css"  href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css' />
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <div id="preloader">
            <div id="preloader-img">
                <img src="img/preloader.gif" height="64" width="64" alt="preloader animation">
            </div>
        </div>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle"
                                          data-toggle="collapse"
                                          data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span>
                            <i class="fa fa-bars"></i>
                        </span>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">
                        <img src="img/logo_escape.png" alt="logo" id="logo">
                        <span>Roseville Escape</span>
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#section1">
                                Concept
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#section2">
                                Quel public
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#section3">
                                Notre lieu
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"
                                        data-toggle="dropdown">
                                Réservations<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="page-scroll" href="booking">
                                        Réservez maintenant
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#gcard">
                                        Bon cadeau
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#price">
                                        Nos tarifs
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                À propos<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="page-scroll" href="#section5">
                                        FAQ
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#where">
                                        Situation
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#contact">
                                        Contact
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Intro -->
        <div id="intro">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3
                    col-xs-6 col-xs-offset-3">
                        <img alt="Logo" class="img-responsive" src="img/logo_escape.png"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-xs-12">
                        <h1>Bienvenue à <span class="brand-heading">Roseville</span></h1>
                        <p class="intro-text">Trouverez-vous la sortie ?</p>
                        <a href="#section1" class="btn btn-default page-scroll">Entrée</a>
                        <a href="booking" class="btn btn-default page-scroll">Réservations</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 1 -->
        <div id="section1">
            <div class="container">
                <div class="col-md-10 col-md-offset-1 jumbotron">
                    <h3>L'aventure dont vous êtes les héros</h3>
                    <p>Une aventure inoubliable grandeur nature dans des décors insolites. Le jeu d'évasion consiste à s’échapper d’une pièce en moins de 60 minutes.
                    Enfermés dans un environnement immersif, les joueurs, par groupes de 2 à 5 participants,
                    cherchent des indices disséminés dans la pièce. Ils les combinent afin de résoudre les casse-tête qui
                    permettent d'avancer dans l'énigme et sortir de la salle
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 sub-section">
                        <img src="img/ancientdoorlock.jpg" alt="cadenas pour illustrer le jeu" class="img-rounded" class="img-responsive">
                    </div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-lock"></i>
                        <h4>L'univers du jeu</h4>
                        <p>Plongez dans une aventure exaltante. Laissez vous enfermer dans un univers fantastique avec des décors saisissants</p>
                    </div>
                    <div class="clearfix visible-sm"></div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-cogs"></i>
                        <h4>Trouvez la solution</h4>
                        <p>En faisant preuve de curiosité, d'un peu de logique et d'ingéniosité, récoltez les indices, déjouez les pièges et résolvez les énigmes</p>
                    </div>

                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-trophy"></i>
                        <h4>Le temps est compté</h4>
                        <p>Travaillez en équipe pour mener à bien votre mission. Si vous y arrivez en moins de 60 minutes vous serez récompensés</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2 -->
        <div id="section2" class="text-center">
            <div class="container">
                <div class="jumbotron">
                    <h3>Quel public</h3>
                    <p>Le jeu d'évasion à Roseville s'adresse à un public de plus de 14 ans. 
                    Nos énigmes ne comportent aucun élément physique ou effrayant.
                    Le scénario a été conçu pour satisfaire l'intérêt des novices comme celui des initiés de jeu d'évasion
                    </p>
                </div>
                <div class="space"></div>

                <div class="row">

                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-users"></i>
                        <h4>Groupe d'amis et famille</h4>
                        <p>Une activité qui sort de l’ordinaire à faire en famille ou entre amis</p>
                    </div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-black-tie"></i>
                        <h4>Collègues</h4>
                        <p>Pour renforcer l'esprit d'équipe ou tout simplement passer un bon moment avec le gang du boulot</p>
                    </div>
                    <div class="clearfix visible-sm"></div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-camera"></i>
                        <h4>Touristes</h4>
                        <p>De passage dans la région avec une envie de vivre une expérience exaltante conçue sur des thèmes régionaux ?</p>
                    </div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-briefcase"></i>
                        <h4>Entreprises</h4>
                        <p>Une occasion nouvelle pour favoriser la cohésion de groupe ou organiser des entretiens d'embauche</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3 -->
        <div id="section3">
            <div class="container">
                <div class="jumbotron text-center">
                    <h2>Notre lieu</h2>
                    <p>Venez découvrir notre jeu d'évasion "Chocolat" et notre "R" de fête</p>
                    <a href="booking" class="btn btn-default">réservations</a>
                    <a href="#contact" class="btn btn-default page-scroll">contactez-nous</a>
                </div>
                <div class="row">
                    <div class="col-sm-4 sub-section">
                        <img src="img/chocolat.jpg" alt="chocolat fondant pour illustrer la salle chocolat" class="img-thumbnail" width="100%"/>
                        <h3>"Chocolat"</h3>
                        <p>Un bug informatique a détruit tout le savoir stocké sur internet, dont une fameuse recette de chocolat. 
                        Vous êtes engagés pour retourner dans le passé pour la retrouver. Mais attention rester trop longtemps dans l'espace temps peut s'avérer dangereux</p>
                        <div class="grouped-buttons">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">plus d'info</button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Introduction pour la salle "Chocolat"</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Dans un monde alternatif, en 2016, un bug à échelle planétaire a détruit toutes les informations contenues sur le net.
                                            Or, la plupart du savoir de l’humanité s’y trouvait. Une association d’aventuriers appelée Roseville, qui possède le pouvoir de voyager dans le temps,
                                            se propose de retrouver ces secrets en retournant dans le passé contre rémunération, bien entendu. Le Capitaine, l’aventurier le plus expérimenté de Roseville,
                                            est élu pour aider la jeune héritière d’une richissime famille de chocolatiers souhaitant retrouver la recette du chocolat
                                            qui a fait la fortune de la famille depuis des générations. Hors, ce dernier est introuvable. Il appartient donc à vous de partir à la recherche de la recette 
                                            et d’essayer de découvrir ce qui est arrivé au Capitaine. Mais attention! Les voyages dans le temps sont instables et rester trop longtemps 
                                            dans le passé pourrait être fatal!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End modal -->
                            <a href="https://www.youtube.com/watch?v=GyssJMtZRaM&rel=0" rel="prettyPhoto">
                                <button type="button" class="btn btn-default">
                                    teaser
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 sub-section">
                        <img class="img-thumbnail" src="img/raisin.jpg" alt="grappe de raisin" width="100%"/>
                        <h3>Prochainement ...</h3>
                        <p>Nous créons une nouvelle salle de jeu pour vous sur un thème local typiquement approprié pour le Lavaux.
                        In Vino Veritas ... Ouverture avril 2017</p>
                        <a data-html="true" type="button" class="btn btn-default bottom" data-toggle="popover" data-content="petit curieux !<br />Il faudra encore patienter" href="#">plus d'info</a>

                    </div>
                    <div class="col-sm-4 sub-section">
                        <img class="img-thumbnail" src="img/aire_de_fete2.jpg" alt="espace R de fête" width="100%"/>
                        <h3>"R" de fête</h3>
                        <p>Nous vous accueillons dans un espace insolite où les consignes du jeu vous
                        seront expliquées par notre coach. Profitez aussi de l'ambiance magique et relaxante de cet espace pour 
                        débriefer à la fin du jeu en buvant un verre. Il est possible de louer cette salle pour y organiser anniversaires, fêtes ou soirées privées</p>
                        <a type="button" href="http://espace.roseville.ch" target="_blank" class="btn btn-default bottom">plus d'info</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section bon cadeau -->
        <div id="gcard">
            <div class="container">
                <div class="section-title text-center center">
                    <h2>Bon cadeau</h2>
                </div>
                <div id="row">
                    <div class="col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-1 sub-section">
                        <i class="fa fa-gift"></i>
                        <h4>Bon cadeau pour un jeu d’évasion à Roseville Escape de 2 à 5 personnes d’une valeur de CHF 140.- </h4>
                        <p>Pour commander un bon cadeau veuillez nous contacter via le <a class="page-scroll" href="#contact">formulaire</a></p>
                        <p>Les informations pour le paiement vous seront envoyées immédiatement par courriel puis le bon cadeau vous 
                        parviendra par la poste après confirmation du paiement.</p>
                        <p>Pour utiliser le bon, <a class="page-scroll" href="#contact">contactez-nous</a> par mail en indiquant la date et l’heure choisie.</p>
                        <p>Le bon cadeau est valable 1 an à compter de la date d'achat</p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2 carton">
                        <img src="img/bon_cadeau.jpg" alt="bon cadeau" class="img-responsive img-rounded" height="450px" width="300px">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section tarifs -->
        <div id="price">
            <div class="container atelier_view">
                <div class="jumbotron">
                    <h2>Nos tarifs</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 ">
                        <h3>Formule</h3>
                        <i class="fa fa_big fa-users" aria-hidden="true"></i>
                        <p>Vous réservez pour une session de 2 à 5 participants. Nous limitons la taille des groupes à 5 personnes pour que vous
                        puissiez vous sentir à l'aise et profiter un maximum de votre expérience</p>
                    </div>
                    <div class="col-md-4 ">
                        <h3>Tarifs</h3>
                        <i class="fa fa_big fa-shopping-cart" aria-hidden="true"></i>
                        <ul>
                            <li>CHF 120 pour les sessions du mercredi et du jeudi</li>
                            <li>CHF 140 pour celles du vendredi, samedi, dimanche et jours fériés</li>
                            <li>CHF 140 pour un bon cadeau</li>
                        </ul>
                    </div>
                    <div class="col-md-4 ">
                        <h3>Moyens de paiements</h3>
                        <img class="fc" src="img/money_bag.png" alt="money bag icon">
                        <p>Cartes de crédit, PostFinance, virement bancaire ou en espèces (si vous passez nous voir à Roseville pour faire la réservation)</p>
                        <ul>
                            <li><img class="ic" src="img/cc.png" alt="transfer icon"</li>
                            <li><img class="ic" src="img/transfer.png" alt="transfer icon"></li>
                            <li><img class="ic" src="img/cash.png" alt="cash icon"></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="booking" class="btn btn-default page-scroll">réservez maintenant</a>
                        <a href="#contact" class="btn btn-default page-scroll">contactez-nous</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 5 -->
        <div id="section5">
            <div class="container">
                <div class="section-title text-center center">
                    <h2>La foire aux questions</h2>
                    <h4>N'hésitez pas à nous <a class="page-scroll" href="#contact">contacter</a> si vous ne trouvez pas les réponses à vos questions</h4>
                </div>
                <div id="section-question" class="text-left">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Quel est le niveau de difficulté du jeu ?</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">Le niveau de difficulté de notre salle est considéré de moyen à difficile. Une version allégée est proposée aux débutants. 
                                    Afin de maintenir un intérêt optimal tout au long du jeu, notre coach peut envoyer des indices sur un écran de contrôle
                                    lorsqu'une énigme vous pose problème. Pour les équipes expérimentées et compétitives cette option peut être supprimée.
                                    Nous nous adaptons à tous les niveaux pour que chacun s'amuse
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Type de paiement</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">Le paiement se fait au moment de la réservation sur internet, par carte bancaire: Visa, Mastercard et American Express. 
                                    La possibilité d'effectuer un virement bancaire est également proposée. Vous pouvez aussi passer nous voir à Roseville 
                                    pour une réservation en personne et un paiement en espèce. Prière de nous contacter pour s'assurer de notre présence sur place
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3">Nos horaires</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>lundi/mardi: fermé</p>
                                    <p>mercredi/jeudi: 16h-22h</p>
                                    <p>vendredi: 16h-23h</p>
                                    <p>samedi: 10h-23h</p>
                                    <p>dimanche: 10h-22h</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">Où nous trouver ?</a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">Nous sommes situés à la route de Lavaux 44, 1802 Corseaux à 2 minutes de Vevey en direction de Lausanne.
                                    Voir <a class="page-scroll" href="#where">plan</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">Le prix</a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">CHF 120 pour les sessions du mercredi et du jeudi, CHF 140 pour celles du vendredi, samedi, dimanche et jours fériés
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6">Nombre de personnes par groupe</a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">Pour une expérience optimale nous limitons le nombre de personnes à 5 participants par groupe
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse7">Compétences et connaissances nécessaires</a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse">
                                <div class="panel-body">A part une envie de passer un bon moment, aucune compétence particulière n'est nécessaire. 
                                    Toutes les informations dont vous aurez besoin seront fournies ... ou cachées ... à vous de les découvrir
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse8">Est-ce que je peux annuler une réservation ?</a>
                                </h4>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse">
                                <div class="panel-body">Non, malheureusement pas
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse9">Combien de temps faut-il prévoir à Roseville ?</a>
                                </h4>
                            </div>
                            <div id="collapse9" class="panel-collapse collapse">
                                <div class="panel-body">Il faut compter environ 90 minutes, un quart d'heure pour les explications, 60 minutes pour le jeu et un quart d'heure 
                                    supplémentaire pour le débriefing. Vous pourrez également vous relaxer et vous désaltérer avant ou après le jeu
                                    dans notre salle d'accueil au décor peu banal.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse10">Age minimum</a>
                                </h4>
                            </div>
                            <div id="collapse10" class="panel-collapse collapse">
                                <div class="panel-body">L'âge minimum pour participer à notre jeu est de 14 ans. Nous acceptons cependant les enfants plus jeunes
                                    s'ils sont accompagnés par deux adultes. Nous déconseillons le jeu au moins de 9 ans.
                                    Les enfants ne s’amuseraient pas, les parents encore moins ... 
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse11">Accessibilité</a>
                                </h4>
                            </div>
                            <div id="collapse11" class="panel-collapse collapse">
                                <div class="panel-body">Malheureusement, pour l'instant nous ne pouvons pas assurer l'accès aux personnes en fauteuil roulant.
                                    Nous cherchons une solution 
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed"data-toggle="collapse" data-parent="#accordion" href="#collapse12">Sécurité et santé</a>
                                </h4>
                            </div>
                            <div id="collapse12" class="panel-collapse collapse">
                                <div class="panel-body">Un système de vidéo surveillance nous permet de veiller à votre sécurité pendant toute la durée du jeu. En cas de problème,
                                    vous pourrez sortir du jeu à tout moment en quelques secondes. Notre scénario et notre environnement n’ont rien d’effrayant ou d’oppressant. 
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed"data-toggle="collapse" data-parent="#accordion" href="#collapse13">Besoin d'une réservation ?</a>
                                </h4>
                            </div>
                            <div id="collapse13" class="panel-collapse collapse">
                                <div class="panel-body">Oui, les réservations sont obligatoires. Cela permet d’organiser le jeu à l’avance et vous recevoir dans les meilleures
                                    conditions. Si vous avez reçu un bon cadeau, prière de nous <a class="page-scroll" href="#contact">contacter</a> par courriel ou téléphone pour réserver.</div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <!-- où nous trouver -->
        <div id="where">
            <div class="container">
                <div class="jumbotron">
                    <h2>Où nous trouver ?</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div id="mapid" style="width:100%;height:500px"></div>
                    </div>
                    <div class="col-md-6">
                        <h4>Adresse</h4>
                        <p>Roseville Escape est situé au 44 route de Lavaux à Corseaux, à deux pas de Vevey. Le bâtiment se trouve proche 
                        du bord du lac et à l'orée des vignes dans le paysage du Lavaux, patrimoine mondial du l'UNESCO.</p>
                        <div class="atelier_view">
                            <img src="img/atelier.jpg" class="img-responsive img-thumbnail" alt="Facade du bâtiment où se situe Roseville Escape Room" style="width:70%"/>
                        </div>
                        <h4>Transport public</h4>
                        <p>Roseville Escape est desservi par les bus VMCV de la ligne 211 à partir de la gare de Vevey. L'arrêt le plus proche
                        "Gonelles" est situé à environ 100 m. Vous pouvez consulter les horaires <a class="page-scroll"  href="http://www.vmcv.ch/ligne211?d=A&a=COXGONEA"
                                                                                                                           target="_blank">ici</a>.
                        </p>
                        <h4>Parking</h4>
                        <p>Il y a quelques places devant la porte d'entrée. Sinon, si vous arrivez de Vevey, merci de vous garer sur l'herbe
                        le long du trottoir en arrivant au n°44. En provenance de Lausanne, le plus simple est de vous stationner
                        aux abords du camping de la Pichette.
                        </p>   
                    </div>

                </div>
            </div>
        </div>


        </div>
        <!-- Contact Section -->
        <div id="contact">
            <div class="container">
                <div class="jumbotron">
                    <h2>Contactez-nous</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="atelier_view">
                            <i class="fa fa-envelope-o"></i>
                            <p>info@roseville.ch</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="atelier_view">
                            <i class="fa fa-phone"></i>
                            <p>078 638 80 79<br>
                            <p>079 623 04 11</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="atelier_view">
                            <i class="fa fa-clock-o"></i>
                            <div class="schedule">
                                <p>lundi/mardi: fermé</p>
                                <p>mercredi/jeudi: 16h-22h</p>
                                <p>vendredi: 16h-23h</p>
                                <p>samedi: 10h-23h</p>
                                <p>dimanche: 10h-22h</p>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3>Laissez-nous un message</h3>
                        <form name="sentMessage" id="contactForm" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="name" class="form-control" placeholder="Nom" required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control" placeholder="Email" required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-default">Envoyer</button>
                                </div>
                            </div>
                        </form>
                        <div class="row social">
                            <h3>Suivez-nous sur les réseaux sociaux</h3>
                            <div class="col-md-3">
                                <a href="https://www.facebook.com/rosevilleescape/" target="_blank"><i class="fa fa-facebook"></i></a>
                            </div>
                            <div class="col-md-3">
                                <a href="https://www.twitter.com/RosevilleEscape" target="_blank"><i class="fa fa-twitter"></i></a>
                            </div>
                            <div class="col-md-3">
                                <a href="https://www.instagram.com/roseville_escape/" target="_blank"><i class="fa fa-instagram"></i></a>
                            </div>
                            <div class="col-md-3">
                                <a href="https://www.youtube.com/channel/UCNq0gAc1oAZnBeBmyZQBaMw" target="_blank"><i class="fa fa-youtube-square"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="container">
                <p>Copyright &copy; Roseville Escape</p>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
        <script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
        <!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script type="text/javascript" src="js/bootstrap.js"></script> 
        <script type="text/javascript" src="js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script> 
        <script type="text/javascript" src="js/jquery.isotope.js"></script> 
        <script type="text/javascript" src="js/jquery.parallax.js"></script> 
        <script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 
        <script type="text/javascript" src="js/contact_me.js"></script> 
        <script type="text/javascript" src="js/main.js"></script> 
        <!-- Accodion  -->
        <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}
        </script>
        <!-- Open StreetMap -->
        <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
        <script>
            var mymap = L.map('mapid').setView([46.470892, 6.813895], 16);
            L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZHVuYXRvdGF0b3MiLCJhIjoiY2l5aGI4ODRtMDAyejMybW1wb2gzZHZuMCJ9.9keE9dHEowti3VanahXsRA', {
                    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
                    maxZoom: 18,
            }).addTo(mymap);
            var marker = L.marker([46.470892, 6.813895]).addTo(mymap);
            var contentString = '<div class="markerWindow">'+
                '<h4 id="firstHeading" class="firstHeading">Roseville Escape</h4>'+
                '<div id="bodyContent">'+
                '<p>Route du Lavaux 44'+'<br />'+
                'CH-1802 Corseaux</p>'+
                '</div>'+
                '</div>';
            marker.bindPopup(contentString).openPopup();
        </script>
        <!-- Piwik -->
        <script type="text/javascript">
var _paq = _paq || [];
_paq.push(["setDomains", ["*.escape.roseville.ch"]]);
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function() {
    var u="//roseville.ch/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
})();
        </script>
        <noscript><p><img src="//roseville.ch/piwik/piwik.php?idsite=2" style="border:0;" alt="Piwik" /></p></noscript>
        <!-- End Piwik Code -->
    </body>
</html>
