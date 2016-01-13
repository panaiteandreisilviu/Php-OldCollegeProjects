var generateTable = function (table, tableData, isExtended) {
    var tableThRow = table.find('thead tr');
    var tableBody = table.find('tbody');

    tableData[0].forEach(function (item) {
        tableThRow.append($('<th>' + item + '</th>'))

    });

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
            $tableRow.append($('<td>' + "Edit Delete" + '</td>'))
        }
        tableBody.append($tableRow);
    });
};


$(document).ready(function () {

    $('#loginButton').click(function () {
        $.post('php/login.php',
            {
                username: $('#usernameInput').val(),
                password: $('#passwordInput').val(),
                isAngajat: $('#isAngajat').val()
            },
            function (data) {

                var dataReceived = $.parseJSON(data);
                console.log(dataReceived);


                if (dataReceived.success == true) {

                    $('#loginContainer').remove();
                    $('#loginHover').text("Logout");
                    $('.news-section').remove();
                    $('.hair-section').remove();
                    $('.banner-bottom-section').load("userPanel.html");

                    var categ = $('#categorieProgramare').val().text();
                    $.post('php/queries.php', {query: "servicii" , catID: '1'}, function (data) {
                        console.log(data);
                        var receivedData = JSON.parse(data);
                        console.log(receivedData);
                        var $table = $('#serviciiTable');
                        console.log($table);
                        generateTable($table, receivedData, false);

                        var $categorieProgramare = $('#categorieProgramare');
                        $.post('php/queries.php', {query: "getCategorii"}, function (data) {
                            var receivedData = JSON.parse(data);
                            console.log($categorieProgramare);
                            $categorieProgramare.empty();

                            receivedData[1].forEach(function (item) {
                                console.log(item['DoctorID'] + ' ' + item['Name']);
                                var option = $('<option></option>');
                                option.attr('value', item['ID']);
                                option.text(item['Nume']);
                                $categorieProgramare.append(option);
                            });

                            $categorieProgramare.change(function(){

                                var categorieID = $categorieProgramare.val();


                            })

                        });


                    });

                }


            });
        return false;
    });
});


