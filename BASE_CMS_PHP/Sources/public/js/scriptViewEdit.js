$(document).ready(function(){
    

    $(document).keypress(function(touche){
        if(touche.key == "Enter"){
            //TODO call ajax method to save informations 
            return false;
        }
        return true;
    });

    // auto nomination du titre event
    var title = "";
    var titleEvent = $("#titleEvent");
    $("#titleE").keypress(function(touche){
        var car = touche.key;
        var toto = title;
        switch(car){
            case "Backspace":
                toto = "";
                title = "";
                titleEvent.text("Titre Event");  
                break;
            case "Enter":
                break;
            default:
                title = toto += touche.key;
                titleEvent.text(title);
        }
    });

    // button reset titre event
    $("#btnReset").click(function(){
        titleEvent.text("Titre Event");
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        
            reader.onload = function(e) {
            $('#imgPrev').attr('src', e.target.result);
            }
        
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#image_uploads").change(function() {
        readURL(this);
    });

    $("#changeEtat").click(function(){
        disableElementEdit();
    });

    $("#Etat").click(function(){
        enableElementEdit();
    });

    function disableElement(pInput){
        $(pInput).attr('disabled','disabled');
    }

    function enableElement(pInput){
        $(pInput).removeAttr('disabled');
    }

    function disableElementEdit(){
        $("#titleE").attr('disabled','disabled');
        $("#date").attr('disabled','disabled');
        $("#time").attr('disabled','disabled');
        $("#image_uploads").attr('disabled','disabled');
        $("#description").attr('disabled','disabled');
        $("#btnSave").attr('disabled','disabled');
        $("#btnReset").attr('disabled','disabled');
    }

    function enableElementEdit(){
        $('#titleE').removeAttr('disabled');
        $("#date").removeAttr('disabled');
        $("#time").removeAttr('disabled');
        $("#image_uploads").removeAttr('disabled');
        $("#description").removeAttr('disabled');
        $("#btnSave").removeAttr('disabled');
        $("#btnReset").removeAttr('disabled');
    }

    //texterea with wisiwyg
    // https://summernote.org/getting-started/
    var descriptif = $('#description');
    descriptif.summernote({
        focus: true,
        height: 200,
        lang: 'fr-FR',
        placeholder: "Ecriver votre description ici!"
    });
    var mailcontent = $('#mailContent')
    mailcontent.summernote({
        focus: true,
        height: 200,
        lang: 'fr-FR',
        placeholder: "Votre message."
    });


    
    $("#btnSendMail").click(function(){
        //TODO call ajax method to save informations
        
    });

    $("#btnSaveEvent").click(function(){
        //TODO call ajax method to save informations
        var eventName = $("#titleE").val();
        var startDate = $("#dateStart").val();
        var startTime = $("#timeStart").val();
        var endDate = $("#dateEnd").val();
        var endTime = $("#timeEnd").val();
        var flyer = $("#image_uploads").val();
        var desc = descriptif.summernote('code');
        var tabElement = {
            "TitleEvent" : eventName,
            "DateStart" : new Date(startDate+"T"+startTime).toString(),
            "DateEnd" : new Date(endDate+"T"+endTime).toString(),
            "Flyer" : flyer,
            "Description" : desc 
             };
         console.log(JSON.stringify(tabElement));
         //ajaxMethodeGeneric(JSON.stringify(tabElement), "#", "POST");
    });

    $("#btnSaveSettingFront").click(function(){
        var cmsTitle = $("#titleCMS").val();
        var logocms = $("#image_uploads").val();
    });

    $("#checkSelectAll").on("change",function(){
        if ($("#checkSelectAll").is(":checked")) {
            $(".check").attr('disabled','disabled');
            $(".check").attr("checked", "checked")
        } else {
            $(".check").removeAttr('disabled');
            $(".check").removeAttr('checked');
        }
    });

    /**
     * au clic du bouton supprimer 
     * suprime du DOM l'élement selectionner par une checkbox
     * 
     * TODO appel ajax pour actualiser le tableau pour les index
     */
    $("#btnDelFont").click(function(){ 
        if ($("#checkSelectAll").is(":checked")) {
            $("tr").detach();
            alert("ajax refresh table");
            $("tbody").html("aucune police active");
            $("#checkSelectAll").attr('disabled','disabled');
        }else{
            var inputArray = new Array();
            $(".check").each(function(i){
                inputArray.push($(this));
                var idz = inputArray[i].attr('id');
                if($("#"+idz).is(':checked')){
                    var tr = "#ln"+idz.substring(5);
                    $(tr).detach();
                    alert("ajax refresh table");
                }
            })
        }
    });



    /////////////////////////////////////////////////////////////
    //                                                         //
    //          Partie call to ajax                            //
    //                                                         //
    /////////////////////////////////////////////////////////////

    var successSendAjax = function(reponse, statut){
        alert("Send Ajax ok!");
    }

    var errorSendAjax = function(reponse, statut, erreur){
        alert("Send Ajax failed!");
    }

    var ajaxMethodeGeneric = function( jsonContent, urlp, httpType ){
        $.ajax({
           method: httpType,
           url: urlp,
           data: jsonContent,
           dataType:"json",
           timeout: 5000,
           success: successSendAjax(reponse, statut),
           error: errorSendAjax(reponse, statut, erreur),
           complete: function(resultat, statut){
                //TODO execute after success ajax request
                alert("Send Ajax Complete !");
           },
        });
    } 

}); 