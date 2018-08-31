jQuery(document).ready(function(){

          /*  --------------------------
            LE HOVER DU FLYER DANS LA PAGE D'ACCUEIL du FRONT-OFFICE
            ------------------------  */
          //Au survol du col-12 qui contient l'image,
          $(".col-12").hover(function() {
              //On déplace le lien 'En savoir plus' vers la droite
              //et on met sa couleur de police en blanc
              $(".col-12 .card-box-lg h2.about-event-link").css("color","white");
              $(".col-12 .card-box-lg h2.about-event-link").css("margin","20% 0% 5% 20%");
              /*
                Un objet qui contient l'état d'un élément CSS à DISPARAÎTRE via le "display:none"
                et gérer la durée de transition.
                Cet objet sera utilisé comme état CSS pour la élément "h2.font-size-h1-1"
                afin de gérer sa disparition.
              */
              var stylesnone = {
                "display" : "none",
                "transition-duration": "1s"
              };
              $(".col-12 .card-box-lg h2.font-size-h1-1").css(stylesnone);
              $(".col-12 .card-box-lg h2.font-size-h1-2").css(stylesnone);

              /*Au survol du lien 'En savoir plus' , on modifie les proprités de l'image afin qu'elle
               s'assombrisse. */
              $(".col-12 .card-box-lg h2.about-event-link").hover(function () {
                $(".col-12 .img-cover").css("filter","brightness(50%)");
              });

          },function() { //Lorsque l'on ne survole plus col-12,
              /* La lien 'En savoir plus' redevient transparent et s'aligne vers la gauche. */
              $(".col-12 .card-box-lg h2.about-event-link").css("color","transparent");
              $(".col-12 .card-box-lg h2.about-event-link").css("margin","20% 0% 5%");
              /*
                Un objet qui contient l'état d'un élément CSS à APPARAÎTRE via le "display:block"
                et gérer la durée de transition.
                Cet objet sera utilisé comme état CSS pour la élément "h2.font-size-h1-1"
                afin de gérer son apparition.
              */
              var stylesblock = {
                "display" : "block",
                "transition-duration": "0.4s"
              };
              $(".col-12 .card-box-lg h2.font-size-h1-1").css(stylesblock);
              $(".col-12 .card-box-lg h2.font-size-h1-2").css(stylesblock);
              //Et puis l'image s'assombrit durant le survol de l'image.
              $(".col-12 .img-cover").css("filter","brightness(100%)");
          }
      );


      /*  --------------------------
        LE HOVER DES CARD BOX DANS LA SECTION 'Évènements à venir' de LA PAGE D'ACCUEIL DU FRONT OFFICE
        ------------------------  */
      $(".col-4 a").hover(function(){
        $("img",this).css("filter","brightness(50%)");
        //$(this).find(".col-4 img").addClass("img-cover");
        //console.log("hover");
      },function(){
        $("img",this).css("filter","brightness(100%)");
      });

    var mailcontent = $('#mailContent')
    mailcontent.summernote({
        focus: true,
        height: 200,
        lang: 'fr-FR',
        placeholder: "Votre message."
    });

});
