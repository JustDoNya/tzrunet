$(function () {
    $("#updateGrid").on('click', function () {
        $("table.usersGrid tr.users").remove();
        $("table.usersGrid tr.load").remove();
        $("table.usersGrid").append("<tr class='load' style='background-color: #2a2a2a'><td colspan='3' class='load'><img src='img/ajax-loader.gif'></td></tr>");
        var msg = {
            qualification : $('#qualificationSelect').val(),
            city : $('#citySelect').val()
        }
        Send(msg, function (result) {
            if(result.error) {
                $("table.usersGrid td.load").html(result.error);
            } else {
                var q = "";
                $("table.usersGrid tr.load").remove();
                for (var key in result)
                {
                    q += "<tr class='users' id='user"+key+"'>";
                    q += "<td>"+result[key]['fio']+"</td>";
                    q += "<td>"+result[key]['qualification_name']+"</td>";
                    q += "<td>";
                    for (var x in result[key]['city']) q += result[key]['city'][x] + ","
                    q = q.substr(0, q.length - 1);
                    q += "</td>";
                    q += "</tr>";
                }
                $("table.usersGrid").append(q);
            }
        });
    });
});

function Send(msg, success) {
    $.ajax({
        type: "POST",
        url: "/",
        data : msg,
        success: success
    });
}
