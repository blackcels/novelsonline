<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=8" />

    <meta name="viewport" content="width=device-width, shrink-to-fit=no,initial-scale=1.0"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <meta name="viewport" content="width=device-width"/>

    <link rel="stylesheet" href="<?php echo DS; ?>public/css/style.css" />
    <link rel="stylesheet" href="<?php echo DS; ?>public/css/summernote-lite.css" />
    <link rel="icon" type="image/png" href="<?php echo DS; ?>public/img/fav_icon.png" />

    <style media="screen">
    .container-md {
      flex-direction: column;
      justify-content: space-around;
      margin: 0 auto;
      max-width: 85%;
      color: #474750; }

      header > nav ul.without-margin{
        padding: 0%;
        color: #EEEEEE;
        display: inline-block;
        list-style-type: none;
        width: 100%;
        height: auto;
        margin: 5% 0% 0% 0%;
        font-size: 85%;
      }

    </style>

  </head>
  <body>
      <!-- LE HEADER : le logo + les liens de navigation(Page d'accueil,A propos de l'Organisateur, l'Identification du visiteur,..) -->
      <header>
          <!-- Balise sémantique pour la zone de navigation -->
          <nav class="container">
            <div class="row center">

              <div class="menu-bureau col-2"> <!--Le logo en col-2  -->
                <a href="<?php echo B_HOME;?>"><img src="<?php echo DS; ?>public/img/logo_B-W.PNG" class="logo-sm" ></a>
              </div>

              <div class="menu-bureau col-10"> <!--Les 2 premiers liens en col-5 ('évènements' & 'organisateur')  -->
                <ul class="without-margin">
                  <li><a href="<?php echo B_HOME;?>"><i class="fas fa-ticket-alt"></i>&nbsp;&nbsp;Evènements</a></li><!-- Lien vers cette page d'accueil -->
                  <li><a href="<?php echo B_SETTING;?>"><i class="fas fa-cogs"></i></i>&nbsp;&nbsp;Paramètres</a>
                    <ul style="display: none;">
                      <li><a href="<?php echo B_SETTING_DBB;?>"><i class="fas fa-database"></i>&nbsp;&nbsp;Base de donnée</a></li>
                      <li><a href="<?php echo B_SETTING_PAYPAL;?>"><i class="fab fa-paypal"></i>&nbsp;&nbsp;Paypal</a></li>
                      <li><a href="<?php echo B_SETTING_JURIDIC;?>"><i class="fas fa-gavel"></i>&nbsp;&nbsp;Domaine légale</a></li>
                      <li><a href="<?php echo B_SETTING_FO;?>">&nbsp;&nbsp;Détail Front Office</a></li>
                    </ul>
                  </li><!-- .. vers les informations de l'organisateur -->
                  <li><a href="<?php echo B_ANALYTIC;?>"><i class="fas fa-chart-line"></i>&nbsp;&nbsp;Analytics</a></li><!-- Lien vers cette page d'accueil -->
                  <li><a href="<?php echo B_USERS_LIST;?>" target="_blank"><i class="fas fa-globe"></i>&nbsp;&nbsp;Utilisateurs</a></li><!-- .. vers les informations de l'organisateur -->
                  <li><a href="<?php echo B_ACCOUNT;?>"><i class="far fa-user"></i>&nbsp;&nbsp;Mon compte</a></li><!-- Lien vers cette page d'accueil -->
                  <li><a href="<?php echo B_HELP_OWNER;?>"><i class="far fa-life-ring"></i>&nbsp;&nbsp;F.A.Q</a></li><!-- .. vers les informations de l'organisateur -->
                    <li><a href="<?php echo B_SIGN_OUT;?>">Deconnection</a></li>
                </ul>
                <!-- Le container menu burger qui appraît sur mobile + le menu sur mobile -->
              </div>

              <div class="nav-mobile col-2">
                  <div class="menu-burger">
                      <span>&nbsp;</span>
                      <span>&nbsp;</span>
                      <span>&nbsp;</span>
                  </div>
              </div>


                <div class="nav-mobile col-9">
                <a href="<?php echo B_HOME;?>"><img src="<?php echo DS; ?>public/img/logo_B-W.PNG" class="logo-sm" ></a>
                </div>

            </div>
          </nav>

          <!-- FIN DU HEADER -->
      </header>
      <?php

        /*---------------- /!\ PHP Include view /!\ -----------*/
        include "views/".$this->tpl."".$this->view;
        /*-----------------------------------------------------*/

      ?>
      <footer>
          <!-- container pour le système de grilles dans la zone de navigation -->
          <nav class="container">
            <!-- Menu version bureau -->
              <div class="row center"> <!-- Aligner en une ROW l'ensemble des éléments du footer -->

                <div class="menu-bureau col-2"> <!--Le logo en col-2  -->
                <a href="<?php echo B_HOME;?>"><img src="<?php echo DS; ?>public/img/logo_B-W.PNG" class="logo-sm" ></a>
                </div>

                <div class="menu-bureau col-3">
                    <ul>
                      <li><a href="<?php echo B_ABOUT_CMS;?>">A propos de GoOut</a></li>
                    </ul>
                </div>
                  <div class="menu-bureau col-3">
                      <ul>
                          <li><a href="<?php echo B_LEGAL;?>">Mentions légales</a></li>
                      </ul>
                  </div>
                <div class="menu-bureau col-3">
                    <ul>
                      <li><a href="<?php echo B_CGU;?>">CGU</a></li>
                    </ul>
                </div>

              </div>
              <!-- FIN DU Menu version bureau -->

              <!-- <hr> -->

              <!-- Menu mobile -->
              <div class="row nav-mobile"> <!-- Aligner l'ensemble des éléments du footer sur tout le système de grille via COL-12 -->
                  <div class="col-12">
                    <ul>
                      <li><a href="<?php echo B_ABOUT_CMS;?>">A propos de GoOut</a></li>
                      <li><a href="<?php echo B_LEGAL;?>">Mentions légales</a></li>
                      <hr class="hr-separateur-li">
                    </ul>
                    <ul>
                      <li><a href="<?php echo B_CGU;?>">CGU</a></li>
                    </ul>
                    <ul>
                      <a href="<?php echo B_HOME;?>"><img src="<?php echo DS; ?>public/img/logo_B-W.PNG" class="logo-sm center" ></a>
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
       <script src="<?php echo DS; ?>public/js/scriptViewEdit.js"></script>
       <script src="<?php echo DS; ?>public/js/googleApi.js"></script>
       <script src="<?php echo DS; ?>public/js/summernote-lite.js"></script>
  </body>
</html>
