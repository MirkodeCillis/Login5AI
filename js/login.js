
function login(form) {
    let valid = true;
    let i;
    let values = {};
    $('#error').hide().html('');
    $('#succes').hide().html('');

    for(i=0; i < form.length-1; ++i) {
        let field = form[i];
        if (field.id === 'password') {
            values[field.id] = SHA1(field.value);
        } else if (field.type === "checkbox")
            values[field.id] = field.checked;
        else
            values[field.id] = field.value;
    }

    if (valid) {
        $.ajax({
            type: "POST",
            url: "login.php",
            crossDomain: false,
            data: values,
            success: function(ris) {
                let risultato = JSON.parse(ris);
                $('#info').html(risultato.messaggio).show();
                if (risultato.id === 1) {
                    if (values.restaconnesso) window.localStorage.setItem("tokenjwt5ai", risultato.value)
                    else writeCookie("tokenjwt5ai", risultato.value, 30);
                    window.location = "index.html";
                }
            },
            error: function (error) {
                $('#error').html(error).show();
            }
        });
    }
}