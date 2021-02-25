$('li.nav-item').each(function (index, opt) {
    let ref = $('a', opt).attr('href');

    if (window.location.href.includes(ref)) {
        $(opt).addClass('active disabled');
    } else {
        $(opt).removeClass('active disabled');
    }
});

let valid = false;
let token = {
    loggedIn: false,
    type: '',
    value: ''
};

$( document ).ready(function () {
    if (isCookieAccepted()) {
        let cookie = readCookie("tokenjwt5ai");
        if (cookie !== "") {
            token.loggedIn = true;
            token.type = 'cookie';
            token.value = cookie;
        }
    }
    let localStorage = window.localStorage.getItem("tokenjwt5ai");
    if (localStorage !== null) {
        token.loggedIn = true;
        token.type = "localStorage";
        token.value = localStorage;
    }

    if (token.loggedIn) {
        $.when(
            $.ajax({
                type: "POST",
                url: "valida.php",
                crossDomain: false,
                data: { jwt: token.value },
                success: function(ris) {
                    let risultato = JSON.parse(ris);
                    valid = risultato.valid;
                }
            })
        ).done(function () {
            if (valid) {
                $('#nav_login').hide();
                $('#nav_signin').hide();
                $('#nav_logout').show();
                token.decodedVal = readPayload(token.value);
                $('#nav_user').show().html( `<i class="fa fa-user"></i> ${token.decodedVal.nome}`);
            } else {
                $('#nav_login').show();
                $('#nav_signin').show();
                $('#nav_logout').hide();
                $('#nav_user').hide();
            }
        });
    } else {
        $('#nav_login').show();
        $('#nav_signin').show();
        $('#nav_logout').hide();
        $('#nav_user').hide();
    }
});