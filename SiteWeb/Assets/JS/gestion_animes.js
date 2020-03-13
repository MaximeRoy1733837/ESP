
$("#frm_ajoutAnime").validate({  // initialize plugin on the form
    errorClass: "is-invalid",
    errorElement: "em",
    rules: {
        txt_name: {
            required: true,
            minlength: 5,
            maxlength: 40
        },
        txt_genre: {
            required: true,
            minlength: 4,
            maxlength: 40
        },
        txt_score: {
            required: true,
            maxlength: 3,
            number: true,
        }
    },
    messages: {
        txt_name: {
            required: 'Le nom est obligatoire'
            },
        txt_genre: {
            required: 'Le genre est obligatoire',
        },
        txt_score: {
            required: 'Le score est obligatoire',
            maxlength: 'Le score doit avoir maximum de 3 chiffre'
        }
},
submitHandler: function () {
    $.ajax({
        url: 'ajaxHandler.php?event=AjoutAnime',
        type: 'POST',
        data: {
            txt_name: $("#txt_name").val(),
            txt_genre: $("#txt_genre").val(),
            txt_score: $("#txt_score").val(),
        },
        success: function(output) {

            var data = JSON.parse(output);

            
            $("#futureRowName").replaceWith(
                data['name']
            )

            $("#futureRowGenre").replaceWith(
                data['genre']
            )


            $("#futureRowScore").replaceWith(
                data['score']
            )

            $("#animeTableContent").append(
                    '<tr class="">' +
                        '<td scope="row">' +
                            '<div class="input-group mb-3"  id="futureRowName">' +
                                '<input type="text" id="txt_name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">' +
                            '</div>' +
                        '</td>' +
                        '<td scope="row">' +
                            '<div class="input-group mb-3"  id="futureRowGenre">' +
                                '<input type="text" id="txt_genre" class="form-control" placeholder="Genre" aria-label="Genre" aria-describedby="basic-addon1">' +
                            '</div>' +
                        '</td>' +
                        '<td scope="row">' +
                            '<div class="input-group mb-3"  id="futureRowScore">' +
                                '<input type="text" id="txt_score" class="form-control" placeholder="Score" aria-label="Score" aria-describedby="basic-addon1">' +
                            '</div>' +
                        '</td>' +             
                    '</tr>'
            )
        }
    });
}
});

$("#frm_connexion").validate({
    errorClass: "is-invalid",
    errorElement: "em",
    rules: {
        txt_username: {
            required: true,
            minlength: 5
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