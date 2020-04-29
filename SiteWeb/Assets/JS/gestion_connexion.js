$("#frm_connexion").validate({
    errorClass: "is-invalid",
    errorElement: "em",
    rules: {
        txt_utilisateur: {
            required: true,
            minlength: 3
		},
		txt_mdp: {
            required: true,
            minlength: 6
		}
	},
	messages: {
	    txt_utilisateur: {
            required: 'Le nom est obligatoire'
 		},
        txt_mdp: {
		    required: 'Le mot de passe est obligatoire',
            minlength: 'Le mot de passe doit être plus de 5 caractères'
		}
	},
    submitHandler: function () {
        $.ajax({
            url: "ajaxHandler.php?event=ValidateLogin",
            type: 'POST',
            data: {
                nom_utilisateur: $("#txt_utilisateur").val(),
                mdp: $("#txt_mdp").val()
            },
            success: function(output) {
                var data = JSON.parse(output);

                if (data['etatLogin'] === "good")
                {
                    window.location = 'index.php?action=Home'
                }
                else if (data['etatLogin'] === "bad")
                {
                    $("#etat_connexion").html("Le nom d'utilisateur ou le mot de passe est incorrect");
                    $("#txt_utilisateur").addClass("is-invalid");
                    $("#txt_mdp").addClass("is-invalid");
                }
                else
                {
                    $("#etat_connexion").html("Une erreur c'est produite veillez réessayer");
                }
            }
        });
    }
});