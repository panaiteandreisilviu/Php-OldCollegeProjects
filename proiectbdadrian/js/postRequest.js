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