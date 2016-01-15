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
            $tableRow.append($('<td>' + "<a href='#'>Delete</a>" + '</td>'))
        }
        tableBody.append($tableRow);
    });
};