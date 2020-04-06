$("#frm_connexion").validate({
    errorClass: "is-invalid",
    errorElement: "em",
    rules: {
        txt_username: {
            required: true,
            minlength: 3
		},
		txt_mdp: {
            required: true,
            minlength: 3
		}
	},
	messages: {
	    txt_username: {
            required: 'Le nom est obligatoire'
 		},
        txt_mdp: {
		    required: 'Le mot de passe est obligatoire',
            minlength: 'Le mot de passe doit être plus de 3 caractères'
		}
	},
    submitHandler: function () {
        $.ajax({
            url: "ajaxHandler.php?event=Login",
            type: 'POST',
            data: {
                pseudo: $("#txt_username").val(),
                mdp: $("#txt_mdp").val()
            },
            success: function(output) {
                var data = JSON.parse(output);

                if (data['etat'] === "good")
                {
                    window.location = 'index.php?action=Home'
                    //$("#etat_connexion").html("NICE")
                }
                else if (data['etat'] === "bad")
                {
                    $("#etat_connexion").html("Le nom d'utilisateur ou le mot de passe est incorrect")
                }
                else
                {
                    $("#etat_connexion").html("Une Erreur c'est produite veillez réessayer")
                }
            }
        });
    }
});