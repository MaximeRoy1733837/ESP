//$(document).ready(function(){
    //new get_NewInfo(); 
  //});

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
                }         

                $('#progression').html(percent + '%');
                $('#progression').attr('aria-valuenow', percent).css('width', percent + '%');
          }
        });
    },3000);
    });


  function get_NewInfo(){
    var feedback = $.ajax({
        type: "POST",
        url: "index.php?envent=GetNewInfo",
        async: false
    }).complete(function(){
        setTimeout(function(){get_NewInfo();}, 10000);
    }).responseText;

    $('#nom_commande').html(feedback);
}