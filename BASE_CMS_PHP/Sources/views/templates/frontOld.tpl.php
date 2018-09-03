<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no,initial-scale=1.0">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="viewport" content="width=device-width">

    <title><?php echo $title; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=8" />

    <!-- Bootstrap core CSS -->
    <link href="<?php echo DS; ?>public/css/style_front.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo DS; ?>public/css/summernote-lite.css" />
    <!-- Custom styles for this template -->
    <link rel="icon" type="image/png" href="<?php echo DS; ?>public/img/logo/fav_icon.png" />
  </head>
  <body>
      <!-- LE HEADER : le logo + les liens de navigation(Page d'accueil,A propos de l'Organisateur, l'Identification du visiteur,..) -->
      <header>
          <!-- Balise sémantique pour la zone de navigation -->
          <nav class="container-nav">
              <ul class="row center">
                  <li class="col-2"><a href="<?php echo F_HOME; ?>"><i class="fas fa-ticket-alt"></i>&nbsp;&nbsp;&Eacute;vènements</a></li><!-- Lien vers cette page d'accueil -->
                  <li class="col-2"><a href="<?php echo F_OWNER; ?>"><i class="far fa-question-circle"></i>&nbsp;&nbsp;Organisateur</a></li><!-- .. vers les informations de l'organisateur -->
                  <img class="col-2" src="<?php echo DS; ?>public/img/logo/logo_B-W.PNG"/>
                  <li class="col-2"><a href="<?php echo F_CART; ?>"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;Panier</a></li>
                  <?php if (!empty($_SESSION["user"]) && !empty($_SESSION["user"]["id"]) && !empty($_SESSION["user"]["token"] && !empty($_SESSION["user"]["account"]))):
                      if (Auth::verify($_SESSION["user"]["id"], $_SESSION["user"]["token"])):?>
                          <li class="col-2"><a href="<?php echo $_SESSION["user"]["account"]; ?>"><i class="far fa-user"></i>Mon Compte</a></li>
                          <li class="col-2"><a href="<?php echo F_LOGOUT; ?>"><i class="far fa-user"></i>Déconexion</a></li>
                      <?php else: ?>
                          <li class="col-2"><a href="<?php echo F_SIGN_IN; ?>"><i class="far fa-user"></i>Connexion</a></li>
                      <?php endif; ?>
                  <?php else:?>
                      <li class="col-2"><a href="<?php echo F_SIGN_IN; ?>"><i class="far fa-user"></i>Connexion</a></li>
                  <?php endif; ?>
              </ul>
          </nav>

          <!-- FIN DU HEADER -->
      </header>

      <?php include "views/".$this->tpl."".$this->view;?>

      <!-- LE FOOTER -->
      <footer>
          <!-- container pour le système de grilles dans la zone de navigation -->
          <nav class="container-nav">
            <!-- Menu version bureau -->
              <div class="row">
                <div class="menu-bureau col-2 middle"> <!--Le logo en col-2  -->
                  <img src="<?php echo DS; ?>public/img/logo/logo_B-W.PNG" class="logo-sm" >
                </div>

                <div class="menu-bureau col-2">
                    <ul>
                      <li><a href="<?php echo F_OWNER; ?>">Organisateur</a></li>
                      <li><a href="<?php echo F_CONTACT; ?>">Nous contacter</a></li>
                      <li><a href="<?php echo F_HELP; ?>">Fonctionnement</a></li>
                    </ul>
                </div>

                <div class="menu-bureau col-2">
                    <ul class="border-left-right">
                      <li><a href="<?php echo F_LEGAL; ?>">Mentions Légales</a></li>
                      <li><a href="<?php echo F_SITE_MAP; ?>">Plan du site</a></li>
                      <li><a href="#">CGU</a></li>
                    </ul>
                </div>

                <div class="menu-bureau col-2">
                    <ul>
                        <li><a href="#">CGV</a></li>
                      <li><a href="<?php echo F_SIGN_IN; ?>">Connexion</a></li>
                    </ul>
                </div>
              </div>
              <!-- FIN DU Menu version bureau -->
              <!-- <hr> -->
              <!-- Menu mobile -->
              <div class="row nav-mobile"> <!-- Aligner l'ensemble des éléments du footer sur tout le système de grille via COL-12 -->
                  <div class="col-12">
                    <ul>
                      <li><a href="<?php echo F_OWNER; ?>">Organisateur</a></li>
                      <li><a href="<?php echo F_CONTACT; ?>">Nous contacter</a></li>
                      <li><a href="<?php echo F_HELP; ?>">Fonctionnement</a></li>
                      <hr class="hr-separateur-li">
                    </ul>
                    <ul>
                      <li><a href="<?php echo F_LEGAL; ?>">Mentions Légales</a></li>
                      <li><a href="<?php echo F_SITE_MAP; ?>">Plan du site</a></li>
                      <li><a href="#">CGU</a></li>
                      <hr class="hr-separateur-li">
                    </ul>
                    <ul>
                        <li><a href="#">CGV</a></li>
                        <li><a href="<?php echo F_SIGN_IN; ?>">Connexion</a></li>
                    </ul>
                    <ul>
                      <img src="<?php echo DS; ?>public/img/logo/logo_B-W.PNG" class="logo-sm center" >
                    </ul>
                    <br>
                  </div>
                  <!-- Fin du COL-12 -->
              </div>
              <!-- Fin du Menu mobile -->
          </nav>

      </footer>
      <!-- FIN DU FOOTER -->


      <script defer src="<?php echo DS; ?>public/js/fontawesome-all.js"></script>
      <script src="<?php echo DS; ?>public/js/jquery-3.3.1.min.js"></script>
      <script src="<?php echo DS; ?>public/js/summernote-lite.js"></script>
      <script src="<?php echo DS; ?>public/js/scriptViewEdit.js"></script>
  </body>
</html>
