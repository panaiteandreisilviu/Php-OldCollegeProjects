$(document).ready(function () {
    $("#notRegistered").click(function () {
        setTimeout(function () {
            //$("#login-container").html(tmpl("registerTemplate", {}));
            $("#login-inner-container").hide();
            $('#register-inner-container').show();
        }, 100)


    });

    /*________________________UPDATE USER________________*/
    var $body = $('body');
    $body.on('click', '#usersAdminTable .edit_btn', function () {
        var user = $(this).closest('tr').children().eq(0).text();
        console.log(user);
        var editFirstName = $body.find('#editFirstName').val();
        var editLastName = $body.find('#editLastName').val();
        var editUsername = $body.find('#editUsername').val();
        var editPassword = $body.find('#editPassword').val();
        var editUserType = $body.find('#editUserType').val();

        $.post('php/queries.php', {
            'query': "UpdateUser",
            'username': user,
            'newUsername': editUsername,
            'firstName': editFirstName,
            'lastName': editLastName,
            'password': editPassword,
            'userType': editUserType

        }, function (data) {
            console.log(data);
            postRequest({query: "allUsers", table: "usersAdminTable", action: true});
        });

        return false;
    });

    $body.on('click', '#usersAdminTable tr', function () {
        var editFirstNameInput = $body.find('#editFirstName');
        var editLastNameInput = $body.find('#editLastName');
        var editUsernameInput = $body.find('#editUsername');
        var editPasswordInput = $body.find('#editPassword');
        var editUserType = $body.find('#editUserType');

        editUsernameInput.val($(this).children().eq(0).text());
        editFirstNameInput.val($(this).children().eq(1).text());
        editLastNameInput.val($(this).children().eq(2).text());
        usertype = $(this).children().eq(3).text();
        if (usertype == 'Admin') {
            editUserType.val(0);
        }
        if (usertype == 'Doctor') {
            editUserType.val(1);
        }
        if (usertype == 'User') {
            editUserType.val(2);
        }

        editPasswordInput.val("");


    });

    /*________________________REMOVE USER________________*/
    $body.on('click', '#usersAdminTable .remove_btn', function () {
        var user = $(this).closest('tr').children().eq(0).text();

        $.post('php/queries.php', {
            'query': "RemoveUser",
            'user': user
        }, function () {
            postRequest({query: "allUsers", table: "usersAdminTable", action: true});
        });
        console.log(user);
        return false;
    });


    /*________________________UPDATE APPOINTMENT________________*/
    $body.on('click', '#appointmentsUserTable .edit_btn', function () {
        var consid = $(this).closest('tr').children().eq(0).text();

        var Pet = $('#consultationPet').val();
        var Doctor = $('#consultationDoctor').val();
        var Date = $('#consultationDate').val();

        $.post('php/queries.php', {
            'query': "UpdateConsultation",
            'PetID': Pet,
            'DoctorID': Doctor,
            'Date': Date,
            'ID': consid
        }, function () {
            postRequest({query: "upcomingConsultationsForUser", table: "appointmentsUserTable", action: true});
            postRequest({query: "consultationHistoryForUser", table: "recordsUserTable"});
        });

        return false;
    });

    /*________________________REMOVE APPOINTMENT________________*/
    $body.on('click', '#appointmentsUserTable .remove_btn', function () {

        var consid = $(this).closest('tr').children().eq(0).text();

        $.post('php/queries.php', {
            'query': "RemoveAppointment",
            'id': consid

        }, function () {
            postRequest({query: "upcomingConsultationsForUser", table: "appointmentsUserTable", action: true});
            postRequest({query: "consultationHistoryForUser", table: "recordsUserTable"});
        });
        return false;
    });


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

    /*________________________ON ADMIN LOGIN________________*/
    loginSection.on("adminLogin", function () {

        postRequest({query: "allUsers", table: "usersAdminTable", action: true});
        postRequest({query: "allDoctors", table: "doctorsAdminTable"});
        postRequest({query: "allPetOwners", table: "petOwnersAdminTable"});
        postRequest({query: "allPets", table: "petsAdminTable"});
        postRequest({query: "allAppointments", table: "appointmentsAdminTable"});
    });
    /*________________________ON DOCTOR LOGIN________________*/

    loginSection.on("doctorLogin", function () {

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
                            ownerID: UserIDVar,
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


        postRequest({query: "upcomingConsultationsForUser", table: "appointmentsUserTable", action: true});
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


    var generateTable = function (table, tableData, isExtended) {
        var tableThRow = table.find('thead tr');
        var tableBody = table.find('tbody');
        tableThRow.empty();
        tableBody.empty();
        if (tableData != null) {
            tableData[0].forEach(function (item) {
                tableThRow.append($('<th>' + item + '</th>'))

            });
        }

        if (isExtended == true) {
            var $th = $('<th>' + "Actions" + '</th>');
            tableThRow.append($th);
        }
        tableData[1].forEach(function (item) {
            var $tableRow = $("<tr></tr>");
            for (var i = 0; i < tableData[0].length; i++) {
                var key = tableData[0][i];
                $tableRow.append($('<td>' + item[key] + '</td>'))
            }

            if (isExtended == true) {
                var $td = $('<td>' + tmpl("buttonsTemplate", {}) + '</td>');
                $td.css('width', "150px");
                $tableRow.append($td)
            }
            tableBody.append($tableRow);
        });
    };


});



