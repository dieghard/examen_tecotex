<?php


//Fecha:01/10/2020 - Hora:21.30hs
//Nombre: Diego Markiewicz
//Objetivo- Se creal al clase stock_vales para manejar todo lo referido a la tabla stock_vales en la bd.


header('Content-type: application/json');

class  STOCK_VALES{

    public function Ingresar_Dato (&$superArray){

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $coneccion = new Conexion();
        $dbConectado = $coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';


        $codgAci= $superArray['CODGACI'];
        $descripcion = $superArray['DESCRIPCION'];
        $legajo = $superArray['LEGAJO'];
        $nombre = $superArray['NOMBRE'];
        $vale = $superArray['VALE'];
        $fecha = date("Y-m-d");
        $hora = date("H:i");
        $strSql = "INSERT INTO stock_vales(CODGACI,DESCRIPCION,LEGAJO,NOMBRE,VALE,FECHA,HORA)VALUES(:CODGACI,:DESCRIPCION,:LEGAJO,:NOMBRE,:VALE,:FECHA,:HORA)" ;
        $superArray['sql'] =  $strSql;
        $superArray['$hora']= $hora;
        $superArray['$fecha']= $fecha;

        $stmt = $dbConectado->prepare($strSql);
        $stmt->bindParam(':CODGACI', $codgAci, PDO::PARAM_STR);
        $stmt->bindParam(':DESCRIPCION', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':LEGAJO', $legajo, PDO::PARAM_INT);
        $stmt->bindParam(':NOMBRE', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':VALE', $vale, PDO::PARAM_INT);
        $stmt->bindParam(':FECHA', $fecha);
        $stmt->bindParam(':HORA', $hora, PDO::PARAM_STR);

        $dbConectado->beginTransaction();

        try {

            $stmt->execute();
            $dbConectado->commit();
            $strSql = "INSERT INTO stock_codigos(CODVALE)VALUES(:CODVALE)" ;
            $stmt = $dbConectado->prepare($strSql);
            $stmt->bindParam(':CODVALE',  $vale, PDO::PARAM_INT);
            $dbConectado->beginTransaction();
            $stmt->execute();
            $dbConectado->commit();


        } catch (Throwable $e) {
                $trace = $e->getTrace();
                $superArray['success'] = false;
                $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
                $dbConectado->rollBack();
        }


        $coneccion = null;

        return $superArray;

    }

    public function __construct()
    {
        require_once 'conexion.php';
    }

}

// TRAEMOS BUSCAMOS LOS DATOS POR POST y LUEGO USAMOS LA CLASE INGRESAR LOS DATOS EN LA BD*/
$dato = array();

$dato['tabla']= htmlspecialchars($_POST['tabla'], ENT_QUOTES, 'UTF-8');
$dato['CODGACI']= htmlspecialchars($_POST['CODGACI'], ENT_QUOTES, 'UTF-8');
$dato['DESCRIPCION']= htmlspecialchars($_POST['DESCRIPCION'], ENT_QUOTES, 'UTF-8');
$dato['LEGAJO']= htmlspecialchars($_POST['LEGAJO'], ENT_QUOTES, 'UTF-8');
$dato['NOMBRE']= htmlspecialchars($_POST['NOMBRE'], ENT_QUOTES, 'UTF-8');
$dato['VALE']= htmlspecialchars($_POST['VALE'], ENT_QUOTES, 'UTF-8');

$dato['success']= true;


$stockVale = new STOCK_VALES();
$dato= $stockVale->Ingresar_Dato($dato);

echo json_encode($dato);
