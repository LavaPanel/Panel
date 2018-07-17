var login = null;
var create = null;
var forgot = null;

var btnLogin = null;
var btnCreate = null;

$(document).ready(function () {
    login = $("#login");
    create = $("#create");
    forgot = $("#forgot");

    btnLogin = $("#btn-login");
    btnCreate = $("#btn-create");

    create.hide();
    forgot.hide();

    if(findGetParameter('create') != null) {
        login.hide();
        create.show();

        offButtons();

        btnLogin.addClass("btn-secondary");

        btnCreate.removeClass("btn-secondary");
        btnCreate.addClass("btn-primary");
    }

    if(findGetParameter('forgot') != null) {
        login.hide();
        forgot.show();

        offButtons();

        btnLogin.addClass("btn-secondary");
        btnCreate.addClass("btn-secondary");
    }
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

function loginFun() {
    login.show();
    create.hide();
    forgot.hide();

    offButtons();

    btnCreate.addClass("btn-secondary");

    btnLogin.removeClass("btn-secondary");
    btnLogin.addClass("btn-primary");
}

function createFun() {
    login.hide();
    create.show();
    forgot.hide();

    offButtons();

    btnLogin.addClass("btn-secondary");

    btnCreate.removeClass("btn-secondary");
    btnCreate.addClass("btn-primary");
}

function forgotFun() {
    login.hide();
    create.hide();
    forgot.show();

    offButtons();

    btnLogin.addClass("btn-secondary");
    btnCreate.addClass("btn-secondary");
}

function offButtons() {
    btnLogin.removeClass("btn-primary");
    btnCreate.removeClass("btn-primary");
}