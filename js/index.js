window.onload = function() {
    primerPaso();

    guardar.addEventListener("click", enviar);

};
function primerPaso(){
    document.getElementById('ingreso_de_articulo').style.display = 'none';
    document.getElementById('tablaArticulos').style.display = 'none';
    document.getElementById('codigoArticulo').value ='';
    buscarNumeroVale();
    llenarComboUsuarios();

}
function llenarComboUsuarios(){

    var strUrl="modelo/legajos.php";
    let data= {'tabla':'legajos'};

    var requestOptions = {
        redirect: 'follow',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }

    };

    fetch(strUrl, {
            method: 'POST',
            body: JSON.stringify(data)

        })
        .then(response => response.json())
        .then(function(data_devolucion) {
            if (data_devolucion.success){
                document.getElementById('comboLegajo').innerHTML  =data_devolucion.combo ;

            }
        })
        .catch(function(err) {
            console.log(err);
        });
}
function buscarNumeroVale(){


    var strUrl="modelo/stock_codigos.php";
    let data= {'tabla':'stockCodigo'};

    var requestOptions = {
        redirect: 'follow',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }

    };

    fetch(strUrl, {
            method: 'POST',
            body: JSON.stringify(data)

        })
        .then(response => response.json())
        .then(function(data_devolucion) {
            if (data_devolucion.success){
                document.getElementById('vale').innerHTML  =data_devolucion.codigo ;

            }
        })
        .catch(function(err) {
            console.log(err);
        });


}
function buscarCodigo(e){


    if (e.keyCode === 13) {
        e.preventDefault();
        buscarProductoxCodigo();
    }

}
function enviar(e) {
    if (e.keyCode != 13) {
        return
    }

    var codigo=document.getElementById('codigoArticulo').value ;
    var legajo = document.getElementById("cmbLegajo").value;

    var comboLegajo = document.getElementById('cmbLegajo');
    var opt = comboLegajo.options[comboLegajo.selectedIndex];
    var vale = document.getElementById('vale').innerHTML;

    var  codigoLegajo= opt.value;
    var legajo =opt.text;

    if (!codigo.length >0) {

        alert('Debe escribir un numero');
        return;

    }

    if (codigoLegajo ==0) {
        alert('Debe seleccionar un legajo');
        return;

    }

    var strUrl="modelo/stock_vales.php";
    var datos = new FormData();



    datos.append("tabla","stock_vales");
    datos.append("CODGACI",document.getElementById('codGaciaIngresar').value );
    datos.append("DESCRIPCION",document.getElementById('descripcionSeleccionado').value);
    datos.append("LEGAJO",codigoLegajo);
    datos.append("NOMBRE",legajo);
    datos.append("VALE",vale);

    var requestOptions = {
        redirect: 'follow',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch(strUrl, {
            method: 'POST',
            body: datos

        })
        .then(response => response.json())
        .then(function(data_devolucion) {

            if (data_devolucion.success){
                primerPaso();

            }
        })
        .catch(function(err) {
            console.log(err);
        });

}

function buscarProductoxCodigo(){

    var codigo=document.getElementById('codigoArticulo').value ;

    if (!codigo.length >0) {

        alert('Debe escribir un numero');
        return;

    }

    var strUrl="modelo/stock_articulos.php";
    var datos = new FormData();

    datos.append("tabla","stock_articulos");
    datos.append("codigo",codigo );


    var requestOptions = {
        redirect: 'follow',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch(strUrl, {
            method: 'POST',
            body: datos

        })
        .then(response => response.json())
        .then(function(data_devolucion) {
            if (data_devolucion.success){
                document.getElementById('tablaArticulos').style.display = 'block';
                 document.getElementById('tablaArticulos').innerHTML  =data_devolucion.tabla ;
                 var optionEnTabla = document.forms['myform'].elements['optionArticulo'];
                // recorrlo la tabla y le asigno el evento Click
                for (var i=0, len=optionEnTabla.length; i<len; i++) {
                    optionEnTabla[i].onclick = function() { // assign onclick handler function to each

                        Pasar_dato_a_Input();

                    };
                }

            }
        })
        .catch(function(err) {
            console.log(err);
        });

}

function Pasar_dato_a_Input (){
    var optionEnTabla = document.forms['myform'].elements['optionArticulo'];
        for (var i = 0; i < optionEnTabla.length; i++) {

            if (optionEnTabla[i].checked) {

                var data=  optionEnTabla[i].value;
                var producto = data.split('***')
                document.getElementById('ingreso_de_articulo').style.display = 'block';

                var  codigo = producto[0];
                document.getElementById('codigoArticuloaIngresar').value =  producto[1];
                document.getElementById('codGaciaIngresar').value=  codigo;
                document.getElementById('descripcionSeleccionado').value=producto[2];



            }
        }
}