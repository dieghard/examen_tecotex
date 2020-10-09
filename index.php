<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EXAMEN-EVALUACION PRINCIPAL</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link type="text/css" rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>

    <header class="principal">
        <h1>EXAMEN TECOTEX S.A.</h1>
        <h3>EVALUACION PRINCIPAL</h3>
    </header>

    <section class="principal">
        <form id="myform" onsubmit="return enviar();">
            <label for="vale">Vale:</label><span id='vale'>NºVale</span>
            <div id="comboLegajo"></div>
            <label for="codigoArticulo">Codigo Articulo:</label>
            <input id="codigoArticulo" name="codigoArticulo" type="number" placeholder="ingrese el codigo del articulo y presione ENTER" onkeypress="buscarCodigo(event)" required>

            <div id="tablaArticulos"></div>

        </form>
    </section>
    <section id='ingreso_de_articulo'>
        <label for="codigoArticuloaIngresar">Codigo Articulo Seleccionado:</label>

        <input id="codigoArticuloaIngresar" name="codigoArticuloSeleccionado" type="text" disabled  required>

        <label for="codGaciIngresar">Codigo Gaci Seleccionado:</label>
        <input id="codGaciaIngresar" name="codGaciSeleccionado" type="text" disabled  required>

        <label for="descripcionSeleccionado">Descripcion Articulo:</label>
        <input id="descripcionSeleccionado" name="descripcionSeleccionado" type="text" disabled required>

        <label for="cantidadSeleccionado">Cantidad:</label>
        <input id="cantidadSeleccionado" name="cantidadSeleccionado" type="number" min=1 value=1   onkeypress="enviar(event)" required >


    </section>

        <script src="./js/index.js"></script>
    </body>
</html>