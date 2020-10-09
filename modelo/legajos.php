<?php
header('Content-type: application/json');

class LEGAJOS{

    public function llenarCombo (&$superArray){

        $coneccion = new Conexion();
        $dbConectado = $coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';

        $strSql = 'SELECT LEGAJO,NOMBRE  FROM  stock_legajos';
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            $combo = '<label for="cmbLegajo">Legajo: </label><select class="form-control" id="cmbLegajo" style="width:100%;" tabindex=1  require><option value=0>Seleccione Legajo</option>';

            if ($registro) {

                foreach ($registro  as $row) {
                    $combo .= '<option value='.$row['LEGAJO'].'>'.$row['NOMBRE'].'</option>';
                }

            }
            $combo .= '</select>';
            $superArray['combo'] = $combo;

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
$legajos = new LEGAJOS();

$dato= $legajos->llenarCombo($dato);

echo json_encode($dato);
