
//funcion para iframe
$(document).ready(function () {
    $(".iframe").colorbox({ iframe: true, width: "550", height: "300", transition: "fade", scrolling: false, opacity: 0.1 });
    $(".iframe2").colorbox({ iframe: true, width: "550", height: "680", transition: "fade", scrolling: true, opacity: 0.1 });
    $(".iframe3").colorbox({ iframe: true, width: "800", height: "600", transition: "fade", scrolling: true, opacity: 0.1 });
    $("#click").click(function () {
        $('#click').css({ "background-color": "#f00", "color": "#fff", "cursor": "inherit" }).text("Open this window again and this message will still be here.");
        return false;
    });
});
/*************************************************************** */

/**Cerrar iframe *************************************************/
function cerrarV() {
    $.colorbox.close();
}
/*************************************************************** */

/**Funcion para agregar productos a la tabla desde acceso rapido */
function insRow2(id) {
    var mayor=0;
    if ($('#mayoreo').prop('checked')) {
        
        var precio = parseInt(document.getElementById('m' + id).value);
        mayor = 1;
        
    }
    else {
        var precio = parseInt(document.getElementById('p' + id).value);
        mayor = 0;
    }
    //console.log(mayor);
    var des = document.getElementById('n' + id).value;
    var can2 = parseInt(document.getElementById('cantidad').value);
    var subt = can2 * precio;
    var monto = document.header.total.value;
    var x = document.getElementById('myTable').insertRow(0);
    var y = x.insertCell(0);
    var z = x.insertCell(1);
    var z1 = x.insertCell(2);
    var z2 = x.insertCell(3);
    var z3 = x.insertCell(4);

    document.header.total.value = monto;
    monto = monto * 1 + subt * 1;
    document.header.total.value = monto;
    x.id = "p" + id;
    y.innerHTML = "<center>" + can2 + "</center>";
    y.className = "style6 white-text";
    z.innerHTML = "<center>" + des + "</center>";
    z.className = "style6 white-text";
    z1.innerHTML = "$" + precio;
    z1.className = "style6 white-text";
    z2.innerHTML = "$" + subt;
    z2.className = "style6 white-text";
    z3.innerHTML = "<input name=\"mayoreo[]\"  type=\"hidden\" value=\"" + mayor + "\" /><input name=\"precio[]\"  type=\"hidden\" value=\"" + precio + "\" /><input name=\"mayoreo[]\"  type=\"hidden\" value=\"0\" /> <input name=\"idproducto[]\"  type=\"hidden\" value=\"" + id + "\" /><input name=\"cantidad_d[]\"  type=\"hidden\" value=\"" + can2 + "\" /><input name=\"monto[]\"  type=\"hidden\" value=\"" + subt + "\" /><input name=\"descripcion[]\"  type=\"hidden\" value=\"" + des + "\" /><img src=\"images/close.gif\" alt=\"Eliminar Producto\" name=\"Image50\"  border=\"0\"  id=\"Image50\" onclick=\"deleteRow(this," + subt + ")\"/>";
    document.header.cantidad.value = "1";
    $('#mayoreo').prop('checked', false);
    document.getElementById('cant').value = can2 - 1;
    $('#cuantos').val(parseInt($('#cuantos').val()) + 1);
}
/**************************************************************************************** */

/**Funcion para validar efectivo ingresado ************************************************/
function hacer_click() {
    var idtventa = document.getElementById('id_tventa');
    if (idtventa.value != "2") {
        var t = document.getElementById('total');
        
        if (t.value != "0") {
            var e = document.getElementById('efectivo');
            if (e.value != "0") {
                var t = document.getElementById('total');
                var e = document.getElementById('efectivo');
                var c = document.getElementById('cambio');
                //alert("total"+t.value+"efectivo"+e.value+"cambio"+(e.value-t.value));
                document.header.cambio.value = (e.value - t.value);
            } else {
                alert("Agrege el efectivo recibido");
                document.header.efectivo.focus();
                document.header.cambio.value = 0;
            }
        } else {
            alert("Seleccione almenos un producto");
            document.header.total.focus();
            document.header.cambio.value = 0;
        }
    } else {
        //el campo de cambio deve estar vacio
        document.header.cambio.value = 0;
    }
}
/********************************************************************************** */

/**Borrar fila de la tabla de productos *********************************************/
function deleteRow(r, quita) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('myTable').deleteRow(i);
    var m = document.getElementById('monto');
    var monto = document.header.total.value;

    var can = document.getElementById('cant').value;
    document.header.cant.value = parseInt(can) + 1;
    var can = document.getElementById('cant').value;

    monto = monto * 1 - quita * 1;
    document.header.total.value = monto;
    document.header.cuantos.value = document.header.cuantos.value - 1;
}
/************************************************************************************ */

//funcion inrow llena tabla
function insRow(cadena) {


    if (cadena != "") {
        document.getElementById('agregar').disabled = false;
        elementos = cadena.split("|");
        var descri = "";
        //if(can.value!=0){
        var can = parseInt(document.getElementById('cant').value);
        document.getElementById('cant').value = can;
        var can2 = parseInt(document.getElementById('cantidad').value);

        //if(can<can2){--------------------------------------------------------
        //alert('La cantidad que desea agregar no esta disponible en stock'); agregarlo despues
        //}--------------------------------------------------------------------

        var x = document.getElementById('myTable').insertRow(0);
        var y = x.insertCell(0);
        var z = x.insertCell(1);
        var z1 = x.insertCell(2);
        var z2 = x.insertCell(3);
        var z3 = x.insertCell(4);
        var m = document.getElementById('monto');
        //var monto=m.innerHTML;
        var monto = document.header.total.value;
        var cantidad = document.header.cantidad.value;
        var sub = 0;
        var precio = 0;

        if ($('#mayoreo').prop('checked')) {
            precio = elementos[8];
            sub = cantidad * 1 * elementos[8] * 1;
        }
        else {
            precio = elementos[2];
            sub = cantidad * 1 * elementos[2] * 1;
        }
        monto = monto * 1 + sub * 1;

        //m.innerHTML=monto;
        document.header.total.value = monto;
        x.id = "p" + elementos[0];
        y.innerHTML = "<center>" + document.header.cantidad.value + "</center>";
        y.className = "style6 white-text";
        z.innerHTML = "<center>" + elementos[1] + "</center>";
        z.className = "style6 white-text";
        z1.innerHTML = "$" + precio;
        z1.className = "style6 white-text";
        z2.innerHTML = "$" + sub;
        z2.className = "style6 white-text";
        z3.innerHTML = "<input name=\"precio[]\"  type=\"hidden\" value=\"" + precio + "\" /><input name=\"mayoreo[]\"  type=\"hidden\" value=\"0\" /> <input name=\"idproducto[]\"  type=\"hidden\" value=\"" + elementos[0] + "\" /><input name=\"cantidad_d[]\"  type=\"hidden\" value=\"" + document.header.cantidad.value + "\" /><input name=\"monto[]\"  type=\"hidden\" value=\"" + sub + "\" /><input name=\"descripcion[]\"  type=\"hidden\" value=\"" + descri + "\" /><img src=\"images/close.gif\" alt=\"Eliminar Producto\" name=\"Image50\"  border=\"0\"  id=\"Image50\" onclick=\"deleteRow(this," + sub + ")\"/>";

        //document.header.desc.value=""	;
        $('#mayoreo').prop('checked', false);
        var cad = document.header.lista_productos.value;
        showDes(cad);
        document.getElementById('cant').value = can - 1;
        document.header.cuantos.value = parseInt(document.header.cuantos.value) + 1;
        document.header.cantidad.value = 1;

    }
    else {
        document.getElementById('agregar').disabled = true;
        alert('Seleccione un producto');
    }
}
//fin funcion inrow**************************************************************************/

/*funcion para mostrar precio,descripcion y codigo******************************************/
function showDes(cadena) {
    if (cadena != "0") {
        elementos = cadena.split("|");
        if (elementos[0] != "") {
            document.getElementById('cant').value = elementos[4];
            var cant = parseInt(document.getElementById('cant').value);
            var ma = elementos[6];
            var mi = parseInt(elementos[7]);
            var precio = document.getElementById('precio');
            if ($('#mayoreo').prop('checked')) {
                precio.innerHTML = elementos[8];//muestra precio de mayoreo en label con id=precio
            }
            else {
                precio.innerHTML = elementos[2];//muestra precio en label con id=precio
            }
            var desc = document.getElementById('descripcion');
            desc.innerHTML = elementos[1];//muestra descripcion en label con id=descripcion
            document.getElementById('agregar').disabled = false;
        } else {

            document.header.precio.style.visibility = "visible";
        }
    }
    else {

        var desc = document.getElementById('descripcion');
        desc.innerHTML = "";
        var precio = document.getElementById('precio');
        precio.innerHTML = "";
        document.getElementById('agregar').disabled = true;
    }

}
/*fin funcion ShowDes *************************************************************************************************/

/**Obtiene el id del tipo de venta y tipo de venta *******************************8*/
function showtv(cadena) {
    if (cadena != "0") {
        elementos = cadena.split("|");
        document.header.id_tventa.value = elementos[0];
        document.header.pago.value = elementos[1];
    }
}
/********************************************************************************** */

//funcion select cliente
function showVen(cadena) {
    if (cadena != "0") {
        elementos = cadena.split("|");



        var cliente = document.getElementById('cliente');
        var cli = document.getElementById('cli');
        cliente.innerHTML = elementos[1];
        document.header.cli.value = elementos[1];
        //n.innerHTML=elementos[2];
        //i.innerHTML=elementos[3];
        //o.innerHTML=elementos[4];
        document.header.idcliente.value = elementos[0];
    }
}
//fin funcion select cliente

function abrir2() {
    var ir = document.header.idcliente.value;
    var ven = document.header.vendedor.value;
    var su = document.header.sucur.value;
    $.colorbox({ iframe: true, href: "producto_apartado.php?id=" + ir + "&ve=" + ven + "&su=" + su, width: "800", height: "650", transition: "fade", scrolling: true, opacity: 0.7 });

}

$('#header').one('submit', function () {
    $(this).find('input[type="submit"]').attr('disabled', 'disabled');
});

function imprim() {
    $("#header").attr('action', 'imprimir_venta.php');
    $("#header").submit();
}

function precio_mayoreo() {
    var cadena = document.header.lista_productos.value;

    showDes(cadena);
}

window.onload = function () {
    var cadena = document.header.lista_productos.value;

    showDes(cadena);
}




jQuery(function ($) {
    // /////
    // MAD-SELECT
    var madSelectHover = 0;
    $(".mad-select").each(function () {
        var $input = $(this).find("input"),
            $ul = $(this).find("> ul"),
            $ulDrop = $ul.clone().addClass("mad-select-drop");
        $(this)
            .append('<i class="material-icons">arrow_drop_down</i>', $ulDrop)
            .on({
                hover: function () { madSelectHover ^= 1; },
                click: function () { $ulDrop.toggleClass("show"); }
            });
        // PRESELECT
        $ul.add($ulDrop).find("li[data-value='" + $input.val() + "']").addClass("selected");
        // MAKE SELECTED
        $ulDrop.on("click", "li", function (evt) {
            evt.stopPropagation();
            $input.val($(this).data("value")); // Update hidden input value
            $ul.find("li").eq($(this).index()).add(this).addClass("selected")
                .siblings("li").removeClass("selected");
        });
        // UPDATE LIST SCROLL POSITION
        $ul.on("click", function () {
            var liTop = $ulDrop.find("li.selected").position().top;
            $ulDrop.scrollTop(liTop + $ulDrop[0].scrollTop);
        });
    });
    // CLOSE ALL OPNED
    $(document).on("mouseup", function () {
        if (!madSelectHover) $(".mad-select-drop").removeClass("show");
    });
});

function Estilo() {
    $('#efectivo').val('');
}

/**Calcular total despues de dar click en enter *****************************************/
function PresionaEnter(e) {
    if (e.keyCode === 13) {
        e.preventDefault();
        //console.log('presiono enter');
        var cambio = parseFloat($('#efectivo').val()) - parseFloat($('#total').val());
        $('#cambio').val(cambio);
        $('#venta').focus();
        return false;
    }
}
/*************************************************************************************** */

//funcion valida en botor cobrar
function valida() {

    var ss = document.header.lista_cliente.value.split("|");
    document.header.idcliente.value = ss[0];
    var idtventa = document.getElementById('id_tventa');

    if (idtventa.value != "2") {
        if ($('#efectivo').val() == "0") {
            alert("Capture efectivo");
            document.header.efectivo.focus();
            return false;
        } else { }
    } else {
        //el efectivo deve ser 0
        if (document.header.idcliente.value == "1") {
            alert("seleccione un cliente");
            return false;
        } else {
            document.header.efectivo.value = 0;
        }
    }

    //alert(document.header.idcliente.value+document.header.efectivo.value+document.header.cuantos.value)
    if (document.header.cuantos.value == 0) {
        alert("Seleccione al menos un producto");
        e.preventDefault();
        return false;
    }

}
//fin funcion valida