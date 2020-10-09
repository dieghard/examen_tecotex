<?php
header('Content-type: application/json');




class  STOCK_CODIGOS{

    public function buscar_codigo (&$superArray){

        $coneccion = new Conexion();
        $dbConectado = $coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';

        $strSql = 'SELECT IFNULL(CODVALE,0) + 1 as CODVALE FROM stock_codigos';
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            if ($registro) {

                foreach ($registro  as $row) {
                    $superArray['codigo'] = $row['CODVALE'];
                }

            }


        } catch (Throwable $e) {
                $trace = $e->getTrace();
                $superArray['success'] = false;
                $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $coneccion = null;

        return $superArray;

    }

    public function __construct()
    {
        require_once 'conexion.php';
    }
}

$input = json_decode(file_get_contents("php://input"), true);
$verifica= $input['tabla'];
$dato = array();
$stockCodigo = new STOCK_CODIGOS();
$dato= $stockCodigo->buscar_codigo($dato);

echo json_encode($dato);
