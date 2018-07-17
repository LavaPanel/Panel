$(document).ready(function () {
    var template = "<div class='alert alert-[type]' role='alert' style='min-width: 100%'>" +
        "<span class='fa fa-warning' style='font-size:38px;color: [icon-color]'></span> <span class='align-content-center' style='font-size: 28px;'>[title]</span> <span class='float-right fa fa-times close' onclick=\"dismissAlert('[id]')\"></span>" +
        "<hr />" +
        "" +
        "<p>[message]</p>" +
        "</div>" +
        "</div>";
    window.setInterval(function () {
        $.ajax({
            url: '/util/alerts.php',
            success: function (results) {
                var json = JSON.parse(results);
                var obj = $("<div>");
                for (var key in json) {
                    if (json.hasOwnProperty(key)) {
                        var error = json[key];
                        var id = error['messageid'];
                        var title = error['title'];
                        var message = error['message'];
                        var typeRaw = error['type'];
                        var type = "secondary";
                        var color = "white";
                        if(typeRaw === "error") {
                            type = "danger";
                            color = "red";
                        } else if(typeRaw === "warn") {
                            type = "warning";
                            color = "yellow";
                        }
                        var alert = template;
                        alert = alert.replace("[title]", title);
                        alert = alert.replace("[type]", type);
                        alert = alert.replace("[id]", id);
                        alert = alert.replace("[message]", message);
                        alert = alert.replace("[icon-color]", color);
                        obj.append(alert);
                    }
                }
                $(".alerts").html(obj.html());
            }
        });
    }, 1000);
});

function dismissAlert(id) {

}