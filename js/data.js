$( document ).ready(function () {
    $.ajax({
        type: "POST",
        url: "data.php",
        crossDomain: false,
        data: { jwt: token.value },
        success: function(ris) {
            let risultato = JSON.parse(ris);
            $('#info').hide();
            if (!risultato.valid) {
                $('#error').show();
                $('#data').hide();
            } else {
                $('#error').hide();
                $('#data').show();
                fillTable(risultato.values);
            }
        }
    });
});

function fillTable(values) {
    for (let value of values) {
        let id = $( document.createElement('td') ).
                    addClass('col').
                    html(`<span>${value.id}</span>`);
        let descrizione = $( document.createElement('td') ).
                    addClass('col').
                    html(`<span>${value.descrizione}</span>`);
        let disponibilita = $( document.createElement('td') ).
                    addClass('col').
                    html(`<span>${value.disponibilita}</span>`);
        let ean = $( document.createElement('td') ).
                    addClass('col').
                    html(`<span>${value.ean}</span>`);
        let id_categoria = $( document.createElement('td') ).
                    addClass('col').
                    html(`<span>${value.id_categoria}</span>`);
        let prezzo = $( document.createElement('td') ).
                    addClass('col').
                    html(`<span>${value.prezzo}</span>`);
        let qtariordino = $( document.createElement('td') ).
                    addClass('col').
                    html(`<span>${value.qtariordino}</span>`);

        let row = $( document.createElement('tr')).addClass('row');
        row.append(id, descrizione, ean, id_categoria, disponibilita, prezzo, qtariordino);
        $('#data tbody').append(row);
    }
}