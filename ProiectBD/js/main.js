$(document).ready(function () {
    $("#notRegistered").click(function () {
        setTimeout(function () {
            //$("#login-container").html(tmpl("registerTemplate", {}));
            $("#login-inner-container").hide();
            $('#register-inner-container').show();
        }, 100)
    });


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

    var generateTable = function (table, tableData, isExtended) {
        var tableThRow = table.find('thead tr');
        var tableBody = table.find('tbody');
        tableThRow.empty();
        tableBody.empty();
        if(tableData != null){
            tableData[0].forEach(function (item) {
                tableThRow.append($('<th>' + item + '</th>'))

            });
        }

        if (isExtended == true) {
            tableThRow.append($('<th>' + "Actions" + '</th>'))
        }
        tableData[1].forEach(function (item) {
            var $tableRow = $("<tr></tr>");
            for (var i = 0; i < tableData[0].length; i++) {
                var key = tableData[0][i];
                $tableRow.append($('<td>' + item[key] + '</td>'))
            }

            if (isExtended == true) {
                $tableRow.append($('<td>' + tmpl("buttonsTemplate",{}) + '</td>'))
            }
            tableBody.append($tableRow);
        });
    };


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

    /*________________________ON ADMIN LOGIN________________*/


    var postRequest = function (options) {

        var defaultOptions = {
            action: false,
            callback: function () {
            }

        };

        $.extend(defaultOptions, options);

        $.post('php/queries.php', {query: defaultOptions.query, ownerID: UserIDVar}, function (data) {
            console.log(data);
            var receivedData = JSON.parse(data);
            //console.log(receivedData);
            var $table = $("#" + defaultOptions.table);
            generateTable($table, receivedData, defaultOptions.action);
            //console.log(defaultOptions);
            defaultOptions.callback();

        });
    };


    loginSection.on("adminLogin", function () {

        postRequest({query: "allUsers", table: "usersAdminTable", action: true});
        postRequest({query: "allDoctors", table: "doctorsAdminTable"});
        postRequest({query: "allPetOwners", table: "petOwnersAdminTable"});
        postRequest({query: "allPets", table: "petsAdminTable"});
        postRequest({query: "allAppointments", table: "appointmentsAdminTable"});
    });

    /*________________________ON DOCTOR LOGIN________________*/

    loginSection.on("doctorLogin", function () {

        //has to be changed!!
        postRequest({query: "consultationHistoryForDoctor", table: "recordsDoctorTable"});

        postRequest({
            query: "consultationsUpcomingForDoctor", table: "appointmentsDoctor", callback: function () {
                var date1 = $('#doctorAppointmentDate1').datepicker({dateFormat: 'yy-mm-dd'});
                var date2 = $('#doctorAppointmentDate2').datepicker({dateFormat: 'yy-mm-dd'});

                $('#appointmentsDoctor').change(function () {
                    if (date1.val() && date2.val()) {

                        $('#futureConsultationsTitle').text("Consultations in interval");
                        $.post('php/queries.php', {
                            query: "consultationsInInterval",
                            ownerID : UserIDVar,
                            date1: date1.val(),
                            date2: date2.val()
                        }, function (data) {
                            console.log(data);
                            var receivedData = JSON.parse(data);
                            //console.log(receivedData);
                            var $table = $("#appointmentsDoctor");
                            generateTable($table, receivedData, false);

                        });
                    }
                })

            }
        });
        postRequest({query: "allPets", table: "petsDoctorTable"});
        postRequest({query: "allPetOwners", table: "petOwnersDoctorTable"});
    });


    /*________________________ON USER LOGIN________________*/

    loginSection.on("userLogin", function () {

        //Building add consultations doctors select
        $.post('php/queries.php', {query: "allDoctorsForSelect"}, function (data) {
            var receivedData = JSON.parse(data);
            var $doctorsSelect = $('#consultationDoctor');
            $doctorsSelect.empty();

            receivedData[1].forEach(function (item) {
                console.log(item['DoctorID'] + ' ' + item['Name']);
                var option = $('<option></option>');
                option.attr('value', item['DoctorID']);
                option.text("Dr. " + item['Name']);
                $doctorsSelect.append(option);
            });

        });


        postRequest({query: "upcomingConsultationsForUser", table: "appointmentsUserTable" , action: true});
        postRequest({query: "consultationHistoryForUser", table: "recordsUserTable"});


        $.post('php/queries.php', {query: "allPetsForOwner", ownerID: UserIDVar}, function (data) {
            var receivedData = JSON.parse(data);
            console.log(receivedData);

            var $petSelect = $('#consultationPet');
            $petSelect.empty();
            receivedData[1].forEach(function (item) {
                console.log(item['DoctorID'] + ' ' + item['Name']);
                var option = $('<option></option>');
                option.text(item['Pet Name']);
                $petSelect.append(option);
            });
            var $table = $('#petsUserTable');
            generateTable($table, receivedData, true);
        });


        $.post('php/queries.php', {query: "allPetsForSelect", ownerID: UserIDVar}, function (data) {
            var receivedData = JSON.parse(data);
            console.log(receivedData);

            var $petSelect = $('#consultationPet');
            $petSelect.empty();
            receivedData[1].forEach(function (item) {
                console.log(item['DoctorID'] + ' ' + item['Name']);
                var option = $('<option></option>');
                option.text(item['PetName']);
                option.attr('value', item['PetID']);
                $petSelect.append(option);
            });
        });

        $('#login').submit('consultationForm', function () {

            var Pet = $('#consultationPet').val();
            var Doctor = $('#consultationDoctor').val();
            var Date = $('#consultationDate').val();

            $.post('php/queries.php', {
                'query': "AddConsultation",
                'PetID': Pet,
                'DoctorID': Doctor,
                'Date': Date
            }, function () {
                postRequest({query: "upcomingConsultationsForUser", table: "appointmentsUserTable"});
                postRequest({query: "consultationHistoryForUser", table: "recordsUserTable"});
            });

            return false;

        });


    });


});



