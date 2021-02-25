
function onSubmit(form) {
    let valid = true;
    let i;
    let values = {};
    $('#error').hide().html('');
    $('#succes').hide().html('');

    for(i=0; i < form.length-2; ++i) {
        let field = form[i];
        values[field.id] = field.value;
        if (field.id === 'password') {
            if (field.value.length < 8) {
                $('#error').show();
                $('#error').html($('#error').html() + "<div> La password deve avere almeno 8 caratteri.</div>");
                valid = false;
            } else {
                values[field.id] = SHA1(field.value);
            }
        } else {
            if (field.value.length < 3) {
                $('#error').show();
                $('#error').html($('#error').html() + `<div> Il campo "${field.id}" deve contenere almeno 3 caratteri.</div>`);
                valid = false;
            }
        }
    }

    if (valid) {
        $.ajax({
            type: "POST",
            url: "registra.php",
            crossDomain: false,
            data: values,
            success: function(ris) {
                $('#info').html(ris).show();
                window.location = "index.html";
            },
            error: function (error) {
                $('#error').html(error).show();
            }
        });
    }
}