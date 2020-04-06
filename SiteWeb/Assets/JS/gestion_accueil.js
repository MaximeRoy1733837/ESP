//$(document).ready(function(){
    //new get_NewInfo(); 
  //});

  $(document).ready(function(){
    setInterval(function(){
        $.ajax({
            url: "ajaxhandler.php?event=GetNewInfo",
            success: function(output) {
                var data = JSON.parse(output);
                $('#nom_commande').html(data["nom_commande"]);
          }
        });
    },5000);
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