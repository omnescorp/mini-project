jQuery(document).ready(function ($) {


    $("body").popover({selector: "[rel*=popover]", placement: "right", trigger: 'hover'});
    //$("body").popover({selector: "[rel*=popover]",placement: "right",trigger:'click',html:true});

//    $("#form_login").on("submit", function (event) {
//        event.preventDefault();
//        jsonCall($("#form_login").attr('action'), $("#form_login"), function (data) {
//            if (data.success) {
//                location.reload();
//            } else {
//                alert(data.message);
//            }
//
//        });
//    });

// NOT required:
// for this demo disable all links that point to "#"
    $('a[href="#"]').click(function (event) {
        event.preventDefault();
    });

    /*ancla del pie*/
    $('.goTop').click(
            function ()
            {
                $('html,body').animate({scrollTop: '0'}, 500);
                return false;
            }
    );

});

function Cargar(url, destino, form, reemplazar) {
    $.ajax({
        url: url,
        async: true,
        dataType: "html",
        type: "POST",
        data: $(form).serialize() + '&target=' + destino + '&json=1',
        contentType: "application/x-www-form-urlencoded",
        beforeSend: function (data) {
            $("#" + destino).html("<img src='/image/loader.gif'>");
        },
        success: function (data) {
            if (reemplazar != undefined) {
                $("#" + destino).replaceWith(data);
            } else {
                $("#" + destino).html(data);
            }
        }
    });
    return false;
}

/**
 ** Función que hace una llamada json
 ** url:        Ruta a llamar
 ** form:       Objeto formulario
 ** callback:   Funcion de retorno, se le pasa el resultado de la llamada JSon
 ** precall:    Funcion de llamada antes de realizar la petición JSon
 ** postcall:   Función a ser llamada una vez culminada toda la petición.
 **/
function jsonCall(url, form, callback, precall, postcall) {
    $.ajax({
        url: url,
        dataType: "json",
        type: "post",
        data: $(form).serialize() + '&json=1',
        contentType: "application/x-www-form-urlencoded",
        beforeSend: function (data) {
            if (precall != undefined) {
                window[precall](data);
            }
        },
        success: function (data) {
            if (typeof callback == "function") {
                callback(data);
            } else if (typeof callback == "string") {
                window[callback](data);
            }
        },
        complete: function (jqXHR, textStatus) {
            if (typeof postcall == "function") {
                postcall(textStatus);
            } else if (typeof postcall == "string") {
                window[postcall](textStatus);
            }
        }
    });
    return false;
}

function Popup(url, form, modal) {
    if (url == "") {
        return false;
    }
    if (modal == undefined) {
        modal = "myModal";
    }

    $.ajax({
        url: url,
        async: true,
        dataType: "html",
        type: "POST",
        data: $('#' + form).serialize() + '&popup=true&json=1',
        contentType: "application/x-www-form-urlencoded",
        beforeSend: function (data) {
            $("#" + modal).html("<img src='/image/loader.gif' style='display: block;margin-left: auto;margin-right: auto;'>");
        },
        success: function (data) {
            $("#" + modal).html(data);
        }
    });
    $('#' + modal).modal('show');
    return false;
}
