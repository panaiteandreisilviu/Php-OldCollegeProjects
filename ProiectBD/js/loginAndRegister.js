/*__________________________LOGIN__________________________*/
var loginSection = $('.login-section');
var usernameVar;
var UserIDVar;
$('#loginForm').on('submit', function () {
    var loginFormValid = true;
    var usernameInput = $('#usernameInput');
    var passwordInput = $('#passwordInput');

    $('.errorMessage').remove();

    if (usernameInput.val().length < 3) {
        usernameInput.after($("<span class='errorMessage' >Username too short!</span>"));
        loginFormValid = false;
    }

    if (passwordInput.val().length < 3) {
        passwordInput.after($("<span class='errorMessage' >Password too short!</span>"));
        loginFormValid = false;
    }

    if (loginFormValid == true) {
        $.post('php/checkLogin.php',
            {
                username: usernameInput.val(),
                password: passwordInput.val()
            },
            function (data) {
                var dataReceived = $.parseJSON(data);
                //$('#postOutput').html(dataReceived.success);
                if (dataReceived.success == true) {

                    usernameVar = dataReceived.user;
                    UserIDVar = dataReceived.UserID;
                    console.log('UserID : ' + UserIDVar);
                    console.log("USERNAME : " + usernameVar);
                    if (dataReceived.usertype == '2') {
                        loginSection.load('userAccount.html', function () {
                            console.log($('#consultationDate').datepicker({dateFormat: 'yy-mm-dd'}));
                        });
                        loginSection.before($('<h4 class="welcome">Welcome ' + dataReceived.firstname + ' ' + dataReceived.lastname + '</h4>'));
                        loginSection.trigger("userLogin");

                    }

                    else if (dataReceived.usertype == '1') {
                        loginSection.load('doctorAccount.html');
                        loginSection.before($('<h4 class="welcome">Welcome Dr. ' + dataReceived.firstname + ' ' + dataReceived.lastname + '</h4>'));
                        loginSection.trigger("doctorLogin");
                    }

                    else if (dataReceived.usertype == '0') {

                        loginSection.before($('<h4 class="welcome">Admin Controls</h4>'));
                        loginSection.load('adminControls.html');
                        loginSection.trigger("adminLogin");

                    }
                    loginSection.css({'padding-top': 0, 'padding-bottom': '250px'});
                    $('#login-page-scroll').text('My Account');
                    var $logout = $('#logout-page-scroll');
                    $logout.removeClass('hidden');
                    $logout.on('click', function (event) {
                        event.preventDefault();
                        event.stopPropagation();
                        return false;
                    });
                }

                else {

                    $('#passwordInput').after($("<span class='errorMessage' >Invalid login credentials!</span>"));
                }


            });


    }

    return false;
});
/*__________________________REGISTER__________________________*/

$('#registerForm').on('submit', function () {
    var registerFormValid = true;
    var firstname = $('#firstNameInputRegister');
    var lastname = $('#lastNameInputRegister');
    var user = $('#userInputRegister');
    var password = $('#passwordInputRegister1');
    var password2 = $('#passwordInputRegister2');

    $('.errorMessage').remove();

    if (firstname.val().length < 3) {
        firstname.after($("<span class='errorMessage' >First Name too short!</span>"));
        registerFormValid = false;
    }

    if (lastname.val().length < 3) {
        lastname.after($("<span class='errorMessage' >Last Name too short!</span>"));
        registerFormValid = false;
    }

    if (user.val().length < 3) {
        user.after($("<span class='errorMessage' >Username too short!</span>"));
        registerFormValid = false;
    }

    if (password.val().length < 3) {
        password.after($("<span class='errorMessage' >Password too short!</span>"));
        registerFormValid = false;
    }

    if (password.val() != password2.val()) {
        password.after($("<span class='errorMessage' >Password do not match!</span>"));
        registerFormValid = false;
    }

    if (registerFormValid == true) {
        $.post('php/register.php',
            {
                username: user.val(),
                password: password.val(),
                firstname: firstname.val(),
                lastname: lastname.val()
            },
            function (data) {
                var dataReceived = $.parseJSON(data);
                console.log(data);
                //$('#postOutput').html(dataReceived.success);
                if (dataReceived.success == false) {
                    $('.errorMessage').remove();
                    $('#registerForm').find('button').after($("<span class='errorMessage clearLeft pull-left' >User already exists!</span>"))
                }

                else if (dataReceived.success == true) {
                    setTimeout(function () {
                        $("#login-inner-container").show();
                        $('#register-inner-container').hide();
                        $("#notRegistered").hide();
                        $("#usernameInput").val($("#userInputRegister").val());
                        $("#passwordInput").val($("#passwordInputRegister1").val());

                    }, 100)
                }
            });
    }

    return false;
});
