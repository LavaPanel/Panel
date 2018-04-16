var step;
var finish = false;
var enabled = [];
$(document).ready(function () {
    enabled = [];
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
    $(".bad-pdo").popover({
        title: 'Bad!',
        content: 'Their are no available drivers for PDO, or none of your drivers are supported!',
        trigger: 'hover'
    });

    step = findGetParameter("step");
    if (step == null) {
        step = 1;
    } else {
        step = parseInt(step);
    }
    doSteps();

    typeChange();

    $("#type").change(function () {
        typeChange();
    });

    $("#test-conn").click(function () {
        testConn();
    });

    $(".prev").click(function () {
        prev();
    });

    $(".next").click(function () {
        next();
    });
});

function testConn() {
    var formArray = {};
    var text = $("#type option:selected").text();
    var form = $("#" + text).serialize();
    formArray['type'] = text;
    console.debug("form data: " + form);
    var keyAndValueGroups = form.split("&");
    for (var i = 0; i < keyAndValueGroups.length; i++) {
        var keyAndValue = keyAndValueGroups[i];
        var keyValueGroup = keyAndValue.split("=");
        var key = keyValueGroup[0];
        var value = keyValueGroup[1];
        //console.debug("form key: " + key + " form value: " + value);
        formArray[key] = value;
    }
    var json = JSON.stringify(formArray);
    //console.debug("form json: " + json);
    $.ajax({
        url: "util/test-conn.php",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: json,
        success: function (data, status, jqXHR) {
            console.debug("Sent conn successfully with response: " + JSON.stringify(data));
        },
        error: function (jqXHR, status, error) {
            console.debug("Error in testing connection: " + error);
        }
    });
}

function typeChange() {
    var text = $("#type option:selected").text();
    $("#forms").children().hide();
    $("#" + text).show();
}

function findGetParameter(parameterName) {
    var url = new URL(window.location);
    return url.searchParams.get(parameterName);
}

function next() {
    step++;
    window.history.pushState({step: step}, "", "?step=" + step);
    console.debug("moving to step: " + step);
    doSteps();
}

function prev() {
    step--;
    window.history.pushState({step: step}, "", "?step=" + step);
    console.debug("moving to step: " + step);
    doSteps();
}

function doSteps() {
    var lastItem;
    for (var i = 1; i <= 30; i++) {
        var item = $("#step" + i);
        if (item.length > 0) {
            item.hide();
        } else {
            lastItem = i - 1;
            break;
        }
    }
    if (step === 1) {
        $(".prev").prop("disabled", true);
    } else {
        $(".prev").prop("disabled", false);
    }
    if (step === lastItem) {
        finish = true;
        $(".next").hide();
        $(".finish").show();
    } else {
        finish = false;
        $(".finish").hide();
        $(".next").show();
    }
    if(enabled.includes(step)) {
        $(".finish").prop("disabled", false);
        $(".next").prop("disabled", false);
    } else {
        $(".finish").prop("disabled", true);
        $(".next").prop("disabled", true);
    }
    var stepHeader = $("#steps-header");
    stepHeader.empty();
    for (var i2 = 1; i2 <= step; i2++) {
        if(i2 !== 1) {
            stepHeader.append("<li class=\"nav-item\"><a class=\"nav-link disabled\" href=\"\">>></a></li>");
        }
        stepHeader.append("<li class=\"nav-item active\"><a class=\"nav-link\" href=\"?step=" + i2 + "\">Step " + i2 + "</a></li>");
    }
    $("#step" + step).show();
}

//Maybe not needed.
function disableButtons(step) {
    if (this.step = step) {
        if (finish) {
            $(".finish").prop("disabled", true);
        } else {
            $(".next").prop("disabled", true);
        }
    }
    if (enabled.includes(step)) {
        enabled = enabled.filter(function (value) {
            return value !== step;
        });
    }
}

function enableButtons(step) {
    if (this.step === step) {
        if (finish) {
            $(".finish").prop("disabled", false);
        } else {
            $(".next").prop("disabled", false);
        }
    }
    if (!enabled.includes(step)) {
        enabled.push(step);
    }
}

window.onpopstate = function () {
    step = findGetParameter("step");
    if (step == null) {
        step = 1;
    } else {
        step = parseInt(step);
    }
    console.debug("pop state step: " + step);
    doSteps();
};