$(document).ready(function () {

    var $pageContent = $('#pageContent');
    $pageContent.on("userLogin", function () {



        /*--------------------LOGGED IN AS USER--------------------*/
        if (UserTypeVar == "2") {
            postRequest({query: "serviciiCategorii", table: "serviciiCategorii"});
            postRequest({query: "angajatiMinuteLucrate", table: "angajatiMinuteLucrate"});
            postRequest({query: "listaAngajatiNumarServicii", table: "angajatiServicii"});
        }

        /*--------------------LOGGED IN AS ANGAJAT--------------------*/
        if (UserTypeVar == "1") {
            var dataStartProgramari = $('#dataStartProgramari');
            var dataEndProgramari = $('#dataEndProgramari');
            var programareData = $('#programareData');
            dataStartProgramari.datepicker();
            dataEndProgramari.datepicker();
            postRequest({query: "angajatiMinuteLucrate", table: "angajatiMinuteLucrate"});
            postRequest({query: "incasariUltimaLuna", table: "incasariUltimaLuna"});
            postRequest({query: "listaAngajatiNumarServicii", table: "angajatiTabel"});
            postRequest({query: "maxPretServiciuClient", table: "maxPretClient"});
            postRequest({query: "toateProgramarile", table: "programariAngajat", action: true});
            postRequest({query: "listaClienti", table: "listaClienti"});

            $.post('php/queries.php', {query: "programariPentruAngajat", angajatid: UserIDVar}, function (data) {
                var receivedData = JSON.parse(data);
                console.log(receivedData);
                var $table = $('#angajatCurentProgramari');
                generateTable($table, receivedData, false);
            });

            postRequest({
                query: "cheltuieliAnualeClienti", table: "cheltuieliAnualeClientiAngajat", callback: function () {
                    var date1 = $('#dataStartProgramari').datepicker({dateFormat: 'yy-mm-dd'});
                    var date2 = $('#dataEndProgramari').datepicker({dateFormat: 'yy-mm-dd'});
                    programareData.datepicker();


                    $('body').change(function () {
                        if (date1.val() && date2.val()) {


                            $.post('php/queries.php', {
                                query: "toateProgramarileIntreDouaDate",
                                date1: date1.val(),
                                date2: date2.val()
                            }, function (data) {
                                console.log(data);
                                var receivedData = JSON.parse(data);
                                //console.log(receivedData);
                                var $table = $("#programariAngajat");

                                $table.find('thead tr').empty();
                                $table.find('tbody').empty();
                                generateTable($table, receivedData, true);

                            });
                        }
                    })

                }
            });


        }

        /*--------------------LOGGED IN AS ADMINISTRATOR--------------------*/
        if (UserTypeVar == "0") {
            postRequest({query: "listaAngajati", table: "angajatiTabel"});
            postRequest({query: "angajatiMinuteLucrate", table: "angajatiMinuteLucrate"});
            postRequest({query: "toateProgramarile", table: "programariAngajat"});
            postRequest({query: "numarProgramariAngajati", table: "angajatiProgramariTabel"});
            postRequest({query: "listaClienti", table: "listaClienti", action: true});

        }

    });

    var $body = $('body');

    $body.on('click', '#programariAngajat a', function () {
        var idcons = $(this).closest('tr').children().eq(0).text();
        console.log(idcons);

        $.post('php/queries.php', {
            'query': "StergeProgramare",
            'idcons': idcons
        }, function (data) {
            console.log(data);
            $('#programariAngajat')
                .find('tr')
                .empty();
            postRequest({query: "toateProgramarile", table: "programariAngajat", action: true});
        });

        return false;
    });


    $body.on('click', '#listaClienti a', function () {
        var idClient = $(this).closest('tr').children().eq(0).text();
        console.log(idClient);


        $.post('php/queries.php', {
            'query': "StergeClient",
            'idClient': idClient
        }, function (data) {
            console.log(data);
            $('#listaClienti')
                .find('tr')
                .empty();
            postRequest({query: "listaClienti", table: "listaClienti", action: true});
        });


        return false;
    });


    $body.on('click', '#adaugaProgramare', function () {
        var idclient = $(('#idClientProgramare')).val();
        var data = $(('#programareData')).val();
        var ora = $(('#oraProgramare')).val();

        $.post('php/queries.php', {
            query: "adaugareProgramare",
            id: idclient,
            dataprogramare: data,
            oraprogramare: ora
        }, function (data) {
            console.log(data);
            $('#programariAngajat')
                .find('tr')
                .empty();
            postRequest({query: "toateProgramarile", table: "programariAngajat", action: true});
        });


        return false;
    });


    $body.on('click', '#EditeazaProgramare', function () {
        alert("editeaza");
        var idclient = $(('#idClientProgramare1')).val();
        var data = $(('#programareData1')).val();
        var ora = $(('#oraProgramare1')).val();

        $.post('php/queries.php', {
            query: "editeazaProgramare",
            id: idclient,
            dataprogramare: data,
            oraprogramare: ora
        }, function (data) {
            console.log(data);
            $('#programariAngajat')
                .find('tr')
                .empty();
            postRequest({query: "toateProgramarile", table: "programariAngajat", action: true});
        });


        return false;
    });

});


/*                    $.post('php/queries.php', {query: "servicii", catID: '1'}, function (data) {
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

 //$categorieProgramare.change(function () {
 //
 //    var categorieID = $categorieProgramare.val();
 //
 //
 //})

 });

 });*/

