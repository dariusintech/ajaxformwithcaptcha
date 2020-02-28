$(document).ready(function(){
    $("form.contactformajax").submit(function(event){
        event.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var message = $("#message").val();
        var submit = $("#submitcontactformajax").val();
        var gcaptcha = grecaptcha.getResponse()
        $("#form-message").load("contactformajax.php", {
            name: name,
            email: email,
            message: message,
            submit: submit,
            gcaptcha: gcaptcha
        });
    });
});