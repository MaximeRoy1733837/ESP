  var finCommande = false;
  var bloque = false;
  
  // var Diagramme = document.getElementById('DiagrammeTest').getContext('2d');
  // var PopDiagramme = new Chart(Diagramme, {
  //     type:'line',
  //     data:{
  //         labels:['2 avil 2020 17h02:51', '3 avril 2020 11h14:14', '4 Avril 2020 12h45:16'],          // nom des valeurs en axis X
  //         datasets:[{
  //           label:'Production',
  //           data:[                              // nombre sur axe Y
  //             50,
  //             64,
  //             2
  //           ]
  //         }]
          
  //     },
  //     options:{
  //       responsive: true,
  //       scales: {
  //         xAxes: [ {
  //           //type: 'time',
  //           display: true,
  //           scaleLabel: {
  //             display: true,
  //             labelString: 'Temps'
  //           }
  //         }],
  //         yAxes: [ {
  //           //type: 'number',
  //           display: true,
  //           scaleLabel: {
  //             display: true,
  //             labelString: 'Quantite par sec'
  //           }
  //         }]
  //       }
  //     }
  // });

  // $(document).ready(function(){
  //   setInterval(function(){
  //       $.ajax({
  //           url: "ajaxhandler.php?event=GetNewInfo",
  //           success: function(output) {
  //               var data = JSON.parse(output);
  //               var percent = 0;

  //               $('#nom_commande').html(data["nom_commande"]);
  //               $('#quantite_produire').html(data["quantite_produire"]);
  //               $('#quantite_bon').html(data["quantite_bon"]);
  //               $('#quantite_bad').html(data["quantite_bad"]);
  //               $('#temperature').html(data["temperature"]);
  //               $('#humidite').html(data["humidite"]);
  //               $('.lastUpdateDate').html('Dernière mise à jour: ' + data["date"]);

  //               if (parseInt(data["quantite_produire"]) > 0)
  //               {
  //                 percent = Math.round((parseInt(data["quantite_bon"]) / parseInt(data["quantite_produire"]) * 100));
                  
  //                 if(percent >= 100)
  //                 {
  //                   percent = 100;
  //                   $('#progression').addClass("bg-success");

  //                     if(window.finCommande === false)
  //                     {
  //                       Swal.fire(
  //                         'Succès',
  //                         'Commande terminé',
  //                         'success'
  //                       );
  //                       window.finCommande = true;
  //                     }       
  //                 }
  //                 else
  //                 {
  //                   $('#progression').removeClass("bg-success")
  //                   window.finCommande = false;
  //                   isItStuck(data["bloque"]);
  //                 }
  //               }         

  //               $('#progression').html(percent + '%');
  //               $('#progression').attr('aria-valuenow', percent).css('width', percent + '%');

  //           }
  //         });
  //     },1000);
  //   });

  $(document).ready(DrawBasicInfoOrder());

  function DrawBasicInfoOrder()
  {
    $.ajax({
      url:'ajaxHandler.php?event=GetBasicInfo',
      success: function(output) {
        var data = JSON.parse(output);
        $('#nom_commande').html(data["nom_commande"]);
        $('#quantite_produire').html(data["quantite_produire"]);
      }
    })
  }

  function isItStuck(_data)
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
        $('#mg_erreur').html("Bouchon coincé!")
      }
    }
    else{
      window.bloque = false;
      $('#progression').removeClass("bg-danger");
      $('#mg_erreur').removeClass("d-block");
    }
  }