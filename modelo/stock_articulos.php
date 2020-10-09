<?php


//Fecha:01/10/2020 - Hora:18.40hs
//Nombre: Diego Markiewicz
//Objetivo- Se creal al clase stock_articulos para manejar todo lo referido a la tabla stock_articulos en la bd.


header('Content-type: application/json');

class  STOCK_ARTICULOS{

    public function lista_articulos (&$superArray){

        $coneccion = new Conexion();
        $dbConectado = $coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';

        $tabla="<table id ='articulos' >";
        $tabla.="    <caption>Seleccion de Articulos</caption>";
        $tabla.="       <tr>";
        $tabla.="           <th>elije</th>";
        $tabla.="           <th>Codigo</th>";
        $tabla.="           <th>CodGaci</th>";
        $tabla.="           <th>Descripcion</th>";
        $tabla.="       </tr>";

        $strSql = "SELECT CODIGO, CODGACI, DESCRIPCION  FROM stock_articulos where codigo='" .$superArray['codigo']."'" ;
        $superArray['sql'] =  $strSql;

       try {

            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();


            if ($registro) {

                foreach ($registro  as $row) {
                    $fila='<tr>';
                    $fila.='<td>';
                    $fila.='        <input type="radio" id="'. $row["CODGACI"].'" class="optionArticulo" name="optionArticulo" value="'.$row["CODGACI"].'***'.$row["CODIGO"].'***'.  $row["DESCRIPCION"].'" onclick="optionseleccionada"> ';
                    $fila.= '</td>';
                    $fila.='<td>'.$row["CODIGO"] .'</td>';
                    $fila.='<td>'.$row["CODGACI"] .'</td>';
                    $fila.='<td class="descripcionArticulo">'.$row["DESCRIPCION"] .'</td>';
                    $fila.='</tr>';
                    $tabla .=$fila;
                }
                $tabla .= '</table>';
            }else{
                $tabla='NO SE ENCONTRARON ARTICULOS';
            }


        } catch (Throwable $e) {
                $trace = $e->getTrace();
                $superArray['success'] = false;
                $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }

        $superArray['tabla'] = $tabla;
        $coneccion = null;

        return $superArray;

    }

    public function __construct()
    {
        require_once 'conexion.php';
    }

}

// TRAEMOS BUSCAMOS LOS DATOS POR POST y LUEGO USAMOS LA CLASE PARA TRAERNOS LOS DATOS*/

$dato = array();
$dato['codigo']= $_POST['codigo'];
$dato['tabla']= $_POST['tabla'];

$dato['success']= true;


$stockArticulos = new STOCK_ARTICULOS();
$dato= $stockArticulos->lista_articulos($dato);

echo json_encode($dato);
