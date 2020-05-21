  var endOrder = false;
  var quantitiesWhenEvent = -1;
  var orderName = "";
  var updateNameOrder = 0;
  var updateQuantities = 0;
  var breakUpdate = false;


  $(document).ready(DrawOrderInfo());

  function StartUpdatingQuantities()
  {
    window.updateQuantities = setInterval(DrawQuantities, 1000);
  }

  function StopUpdatingOrderName()
  {
    clearInterval(updateNameOrder);
    window.updateNameOrder = 0;
  }

  function StopUpdatingQuantities()
  {
    clearInterval(updateQuantities);
    window.updateQuantities = 0;
  }

  function StartUpdatingOrderName()
  {
    window.updateNameOrder = setInterval(DrawBasicInfo, 1000);
  }

  function DrawOrderInfo()
  {
    DrawQuantities();
    DrawBasicInfo();
    DrawMesure();

    StartUpdatingQuantities();
    updateMesure = setInterval(DrawMesure, 6000);   // Ne s'arrêt jamais
  }

  function DrawBasicInfo()
  {
    $.ajax({
      url:'ajaxHandler.php?event=GetBasicInfo',
      success: function(output) {
        var data = JSON.parse(output);
        $('#nom_commande').html(data["nom_commande"]);
        $('#quantite_produire').html(data["quantite_a_produire"]);

        if(window.breakUpdate == true)
        {
          window.orderName = data["nom_commande"];
          window.breakUpdate = false;
        }

        if(window.endOrder === true)
        {
          if((window.orderName != data["nom_commande"]) && (window.orderName != ""))
          {
            window.orderName = data["nom_commande"];
            if(window.updateQuantities == 0)    //Empêche de set deux fois le même interval (updateQuantities) si la commande est terminé avant l'ouverture de la page
            {
              StopUpdatingOrderName();
              StartUpdatingQuantities();
            }   
          }
        }  
        
      }
    })
  }

  function DrawQuantities()
  {
    $.ajax({
      url:'ajaxHandler.php?event=GetQuantities',
      success: function(output) {
        var data = JSON.parse(output);
        $('#quantite_bon').html(data[3]);
        $('#quantite_bad').html(data[0]);
        $('#lastUpdateQuantities').html('Dernière mise à jour: ' + data[5]);


        if(window.quantitiesWhenEvent != -1 && window.quantitiesWhenEvent != parseInt(data[3]))   // Si la quantite a augmenter depuis l'arrêt = marchine en marche = erreur corriger
        {
          ChangeEventStateToTrue();
        }

        if (parseInt(data[1]) > 0)    // Si la quantite a produire est plus grande que 0, évite la division par 0 par la fonction UpdateProgressBar
        {
          UpdateProgressBar(parseInt(data[3]),parseInt(data[1]));
        }

      }
    })
  }

  function UpdateProgressBar(_quantiteBon,_quantite_produire)
  {
    var percent = Math.round((_quantiteBon / _quantite_produire) * 100);
                  
    if(percent >= 100)
    {
      percent = 100;
      $('#progression').addClass("bg-success");   // Change la couleur de la progress bar en vert

        if(window.endOrder === false)
        {
          Swal.fire(    // Lance une un pop-up sweetAlert
            'Succès',
            'Commande terminé',
            'success'
          );

          window.endOrder = true;
        }   
        
        if(window.breakUpdate == false)
        {
          StopUpdatingQuantities();
          StartUpdatingOrderName();
          window.breakUpdate = true;
        }    
    }
    else
    {  
      $('#progression').removeClass("bg-success");
      window.endOrder = false;
      
      CheckForEvent(_quantiteBon);
    }         

    $('#progression').html(percent + '%');    // Change le texte
    $('#progression').attr('aria-valuenow', percent).css('width', percent + '%');   // Avance la progression
  }

  function DrawMesure()
  {
    $.ajax({
      url:'ajaxHandler.php?event=GetMesure',
      success: function(output) {
        var data = JSON.parse(output);
        $('#temperature').html(data[2]);
        $('#humidite').html(data[0]);

        if(document.readyState == "complete" && endOrder === false)   // Permet d'attendre que le graphique soit affiché (PopMesureChart) avant d'être mis à jours
        {
          UpdateMesureChart(data[2], data[0], data[3]);
        }
      }
    })
  }

  function CheckForEvent(_data)
  {
    $.ajax({
      url:'ajaxHandler.php?event=GetLatestEvent',
      success: function(output) {
        var data = JSON.parse(output);

        if(data["notifier"] === false)
        {
          var eventMessage = ""; 

          switch(data["nom_evenement"]){
            case "manque_bouchon":
              eventMessage = "Récipent à bouchons vide";
              break;
            case "machine_bloque":
              eventMessage = "Convoyeur bloqué";
              break;
            default:
              eventMessage = "La machine à explosé";
              break;
          }

          ShowEvent(eventMessage, _data);
        }    
      }
    })
  }

  function ShowEvent(eventMessage, quantiteLorsDeArret)
  {
    if(window.quantitiesWhenEvent === -1)   // Permet d'afficher une seule fois l'alerte
      {
        Swal.fire(    // Lance une un pop-up sweetAlert
          'Machine Arrêté',
          eventMessage,
          'error'
        );
        window.quantitiesWhenEvent = quantiteLorsDeArret;
        $('#progression').addClass("bg-danger");    // Change la couleur de la progress bar en rouge
        $('#mg_erreur').addClass("d-block");
        $('#mg_erreur').html(eventMessage);
      }
  }

  function ChangeEventStateToTrue()   // Change le champ "Notifier" à 1 au lieu de 0 dans la tbl_evenement
  {
    $.ajax({
      url:'ajaxHandler.php?event=SetNotifierToTrue',
      success: function() { 
        
        window.quantitiesWhenEvent = -1;
        $('#progression').removeClass("bg-danger");
        $('#mg_erreur').removeClass("d-block");
      }
    })
  }