$(document).ready(function() {
    $("#common-html").load("/includes/html/common.php", function() {
        if (sessionStorage.getItem('email')) {
            $('#sign-out').css({"display": "inline"});
            $('#sign-in').css({"display": "none"});
            $('#sign-up').css({"display": "none"});

            let message = "שלום " + sessionStorage.getItem("first_name") + " " + sessionStorage.getItem("last_name");
            if ( sessionStorage.getItem("admin") == "1") {message += "את/ה אדמין ";}
            $('#message').html(message);
            $('#calendar').show();
        } else {
            $('#sign-in').css({"display": "inline"});
            $('#sign-up').css({"display": "inline"});
            $('#sign-out').css({"display": "none"});
            $('#calendar').hide();

        }
    });
});

