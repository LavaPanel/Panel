$(document).ready(function () {
    $(".good").popover({
        title: 'Good!',
        content: 'Extension loaded and working!',
        trigger: 'hover'
    });
    $(".bad").popover({
        title: 'Bad!',
        content: 'Extension not loaded! Please load it before continuing to the next step.',
        trigger: 'hover'
    });
    for(var i = 0; i <= 30; i++) {
        $("#step" + i).hide();
    }
    var step = findGetParameter("step");
    if(step == null) {
        step = '1';
    }
    $("#step" + step).show();
});

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}