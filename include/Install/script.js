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
        next("button");
    });

    $(".finish").click(function () {
        $.ajax({
            url: "util/lock-install.php",
            success: function () {
                window.location = "index.php";
            }
        });
    });

    typeChange();

    $("#step2-forms").children().each(function (index, value) {
        getInputsForChange($(value));
    });
});

function getInputsForChange(form) {
    form.children().each(function (index, value) {
        if($(value).is("div")) {
            getInputsForChange($(value));
        } else if($(value).is("input") || $(value).is("select")) {
            console.log("input found " + $(value).attr("id"));
            $(value).on("change paste keyup", function () {
                var sucess = $("#success");
                sucess.hide();
                var fail = $("#fail");
                fail.hide();
                disableButtons(2);
            });
        }
    });
}

function testConn() {
    var sucess = $("#success");
    sucess.hide();
    var fail = $("#fail");
    fail.hide();
    var formArray = {};
    var text = $("#type option:selected").text();
    var formObj = $("#" + text);
    if(formObj.valid()) {
        var form = formObj.serialize();
        formArray['type'] = text;
        var keyAndValueGroups = form.split("&");
        for (var i = 0; i < keyAndValueGroups.length; i++) {
            var keyAndValue = keyAndValueGroups[i];
            var keyValueGroup = keyAndValue.split("=");
            var key = keyValueGroup[0];
            var value = keyValueGroup[1];
            formArray[key] = value;
        }
        var json = JSON.stringify(formArray);
        $.ajax({
            url: "util/database/test-conn.php",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: json,
            success: function (data, status, jqXHR) {
                console.debug("Sent conn successfully with response: " + JSON.stringify(data));
                var json = data;
                if (json['status'] === "good") {
                    sucess.show();
                    enableButtons(2);
                } else {
                    fail.html(json['message']);
                    fail.show();
                    disableButtons(2);
                }
            },
            error: function (jqXHR, status, error) {
                console.debug("Error in testing connection: " + error);
            }
        });
    } else {
        fail.html("Please fill out form");
        fail.show();
    }
}

function typeChange() {
    var sucess = $("#success");
    sucess.hide();
    var fail = $("#fail");
    fail.hide();
    disableButtons(2);
    var text = $("#type option:selected").text();
    $("#step2-forms").children().hide();
    $("#" + text).show();
}

function findGetParameter(parameterName) {
    var url = new URL(window.location);
    return url.searchParams.get(parameterName);
}

function next(location) {
    console.log("next called from loc " + location + " With step value of " + step);
    if(location !== "button") {
        return;
    }
    saveStep(step);
    step++;
    window.history.pushState({step: step}, "", "?step=" + step);
    console.debug("moving to step: " + step);
    doSteps();
}

function prev() {
    saveStep(step);
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

function saveStep(step) {
    if(step === 2) {
        var formArray = {};
        var text = $("#type option:selected").text();
        var formObj = $("#" + text);
        var form = formObj.serialize();
        formArray['type'] = text;
        var keyAndValueGroups = form.split("&");
        for (var i = 0; i < keyAndValueGroups.length; i++) {
            var keyAndValue = keyAndValueGroups[i];
            var keyValueGroup = keyAndValue.split("=");
            var key = keyValueGroup[0];
            formArray[key] = keyValueGroup[1];
        }
        var json = JSON.stringify(formArray);
        $.ajax({
            url: "util/database/save-db.php",
            type: "POST",
            contentType: "application/json",
            data: json,
            success: function (data, status, jqXHR) {
                console.debug("saved conn successfully");
            },
            error: function (jqXHR, status, error) {
                console.debug("Error in saving db: " + error);
            }
        });
    }
}

function disableButtons(stepValue) {
    if (step === stepValue) {
        if (finish) {
            $(".finish").prop("disabled", true);
        } else {
            $(".next").prop("disabled", true);
        }
    }
    if (enabled.includes(stepValue)) {
        enabled = enabled.filter(function (value) {
            return value !== stepValue;
        });
    }
}

function enableButtons(stepValue) {
    if (step === stepValue) {
        if (finish) {
            $(".finish").prop("disabled", false);
        } else {
            $(".next").prop("disabled", false);
        }
    }
    if (!enabled.includes(stepValue)) {
        enabled.push(stepValue);
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