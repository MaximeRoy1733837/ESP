  var finCommande = false;
  
  $(document).ready(function(){
    setInterval(function(){
        $.ajax({
            url: "ajaxhandler.php?event=GetNewInfo",
            success: function(output) {
                var data = JSON.parse(output);
                var percent = 0;

                $('#nom_commande').html(data["nom_commande"]);
                $('#quantite_produire').html(data["quantite_produire"]);
                $('#quantite_bon').html(data["quantite_bon"]);
                $('#quantite_bad').html(data["quantite_bad"]);
                $('#temperature').html(data["temperature"]);
                $('#humidite').html(data["humidite"]);
                $('.lastUpdateDate').html('Dernière mise à jour: ' + data["date"]);

                if (parseInt(data["quantite_produire"]) > 0)
                {
                  percent = Math.round((parseInt(data["quantite_bon"]) / parseInt(data["quantite_produire"]) * 100));
                  
                  if(percent >= 100)
                  {
                    percent = 100;
                    $('#progression').addClass("bg-success");

                      if(window.finCommande === false)
                      {
                        Swal.fire(
                          'Succès',
                          'Commande terminé',
                          'success'
                        );
                        window.finCommande = true;
                      }       
                  }
                  else
                  {
                    $('#progression').removeClass("bg-success")
                    window.finCommande = false;
                  }
                }         

                $('#progression').html(percent + '%');
                $('#progression').attr('aria-valuenow', percent).css('width', percent + '%');
          }
        });
    },1000);
    });