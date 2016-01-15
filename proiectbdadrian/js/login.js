var UserIDVar;
var UserTypeVar;
var NumeUserVar;
var AngajatIdVar;
$(document).ready(function () {

    $('#loginButton').click(function () {

        console.log("LOGIN");
        var angajatCheckbox = $('#isAngajat');
        console.log(angajatCheckbox.prop('checked'));
        $.post('php/login.php',
            {
                username: $('#usernameInput').val(),
                password: $('#passwordInput').val(),
                isAngajat: angajatCheckbox.prop('checked')
            },
            function (data) {

                var dataReceived = $.parseJSON(data);
                UserIDVar = dataReceived.UserID;
                UserTypeVar = dataReceived.usertype;
                console.log("UserType:" + dataReceived.usertype);
                console.log("UserID:" + UserIDVar);
                NumeUserVar = dataReceived.firstname + " " + dataReceived.lastname;

                if (dataReceived.success == true) {

                    $('#loginContainer').remove();
                    $('#loginHover').text("Logout").click(function () {
                        location.reload();
                    });
                    $('.news-section').remove();
                    $('.hair-section').remove();
                    if (UserTypeVar == "2") {
                        $('.banner-bottom-section').load("userPanel.html");
                    }
                    if (UserTypeVar == "1") {
                        $('.banner-bottom-section').load("angajatPanel.html");
                    }
                    if (UserTypeVar == "0") {
                        $('.banner-bottom-section').load("adminPanel.html");
                    }

                    $('#pageContent').trigger('userLogin');

                }

            });
        return false;
    });
});
