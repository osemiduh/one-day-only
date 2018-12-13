$(document).ready(function(){
    $('form').submit(function(event) {
        event.preventDefault();
        var firstname = $("#first-name").val();
        var lastname = $("#last-name").val();
        var email = $("#e-mail").val();
        var submit = $("#submit-form").val();
        $(".form-message").load("functions.php", {
            first_name: firstname,
            last_name: lastname,
            email: email,
            submit: submit
        });
    });
});