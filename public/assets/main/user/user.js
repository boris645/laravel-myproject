/**
 * Script pour la vérification de l'enregistrement des utilisateur
 */

$('#register-user').click(function(){
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var password_confirm  = $('#password-confirm').val();
    var passwordLength = password.length;
    var agreeTerms = $('#agreeTerms');

    

    if(firstname != "" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(firstname)){
        $('#firstname').removeClass('is-invalid');
        $('#firstname').addClass('is-valid');
        $('#error-register-firstname').text("");
        
        if(lastname != "" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(lastname)){
            $('#lastname').removeClass('is-invalide');
            $('#lastname').addClass('is-valid');
            $('#error-register-lastname').text("");

            if(email != "" && /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email)){
                //Supprimer les messages d'erreur l'orsque les données sont valide
                $('#email').removeClass('is-invalide');
                $('#email').addClass('is-valid');
                $('#error-register-email').text("");

                if(passwordLength >= 8){
                    $('#password').removeClass('is-invalide');
                    $('#password').addClass('is-valid');
                    $('#error-register-password').text("");
                    // verification de la confirmation du password
                    if(password == password_confirm){
                        $('#password-confirm').removeClass('is-invalide');
                        $('#password-confirm').addClass('is-valid');
                        $('#error-register-password-confirm').text("");
                        // on vérifie l'activation des conditions d'utilisations
                        if(agreeTerms.is(':checked')){
                            $('#agreeTerms').removeClass('is-invalid');
                            $('#error-register-agreeTerms').text("");

                           
                            // envoie du formulaire
                            //alert("data-ok");

                            var res = emailExistjs(email);

                            /*if(res != "exist"){
                                $('#form-register').submit()
                            }else{
                                $('#email').addClass('is-invalide');
                                $('#email').removeClass('is-valid');
                                $('#error-register-email').text("this email address is already used!");

                            }*/

                            
                                (res != "exist") ? $('#form-register').submit()  
                                    :   ($('#email').addClass('is-invalide'),
                                        $('#email').removeClass('is-valid'),
                                        $('#error-register-email').text("this email address is already used!"));

                            /*
                                condition ternaire 
                                (condition) ? vrai : false;
                                condition avec plusieurs instruction
                                (condition) ? vrai(inst1, inst2 ...) : fausse(inst1, inst2 ...);
                            */
                           

                        }else{

                            $('#agreeTerms').addClass('is-invalid');
                            $('#error-register-agreeTerms').text("you should agree to our terms and condition!");
                        }

                    }else{
                        $('#password-confirm').addClass('is-invalide');
                        $('#password-confirm').removeClass('is-valid');
                        $('#error-register-password-confirm').text("yor passwords must be identical !");
                    }
                }else{
                    $('#password').addClass('is-invalide');
                    $('#password').removeClass('is-valid');
                    $('#error-register-password').text("your password must be at last 8 characters!");
                }

            }else{
                 //ajouté les messages d'erreur l'orsque les données sont valide
                $('#email').addClass('is-invalide');
                $('#email').removeClass('is-valid');
                $('#error-register-email').text("email is not correct");
            }

        }else{
            $('#lastname').addClass('is-invalide');
            $('#lastname').removeClass('is-valid');
            $('#error-register-lastname').text("last name is not valid");
        }

    }else{
        $('#firstname').addClass('is-invalid');
        $('#firstname').removeClass('is-valid');
        $('#error-register-firstname').text("first name is not valid");
    }

});

// on va ajouter un événement pour que lorsqu'on active le checkbox qui était en rouge que ce rouge puisse disparaitre
$('#agreeTerms').change(function(){
    var agreeTerms = $('#agreeTerms');

    if(agreeTerms.is(':checked')){
        $('#agreeTerms').removeClass('is-invalid');
        $('#error-register-agreeTerms').text("");
    }else{
        $('#agreeTerms').addClass('is-invalid');
        $('#error-register-agreeTerms').text("you should agree to our terms and condition!");
    }
});

function emailExistjs(email){
   
    var url = $('#email').attr('url-emailExist');

    var token = $('#email').attr('token');

    var res = "";

    $.ajax({
       type: 'POST',
       url: url,
       
       data: {
          '_token': token,
          email: email
       },
       success:function(result){
         res = result.response;
       },
       async: false
    });
    return res;

}

