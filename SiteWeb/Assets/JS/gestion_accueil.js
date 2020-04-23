  var endOrder = false;
  var bloque = false;
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
    updateMesure = setInterval(DrawMesure, 6000);
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
            if(window.updateQuantities == 0)
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

        if (parseInt(data[1]) > 0)
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
      $('#progression').addClass("bg-success");   

        if(window.endOrder === false)
        {
          Swal.fire(
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
      
      //IsItStuck(data["bloque"]);
    }         

    $('#progression').html(percent + '%');
    $('#progression').attr('aria-valuenow', percent).css('width', percent + '%');
  }

  function DrawMesure()
  {
    $.ajax({
      url:'ajaxHandler.php?event=GetMesure',
      success: function(output) {
        var data = JSON.parse(output);
        $('#temperature').html(data[2]);
        $('#humidite').html(data[0]);
        //$('#lastUpdateMesure').html('Dernière mise à jour: ' + data[3]);

        if(document.readyState == "complete")
        {
          UpdateMesureChart(data[2], data[0], data[3]);
        }
      }
    })
  }

  function IsItStuck(_data)
  {
    if(_data === "1")
    {
      if(window.bloque === false)
      {
        Swal.fire(
          'Erreur',
          'Bouchon coincé',
          'error'
        );
        window.bloque = true;
        $('#progression').addClass("bg-danger");
        $('#mg_erreur').addClass("d-block");
        $('#mg_erreur').html("Bouchon coincé!");
      }
    }
    else{
      window.bloque = false;
      $('#progression').removeClass("bg-danger");
      $('#mg_erreur').removeClass("d-block");
    }
  }