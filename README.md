# examen_tecotex
Examen para empresa tecotex - opcion 1
1.- Desarrollar en JavaScript y PHP la siguiente consigna.
Tenemos una Tabla en Mysql llamada Stock_Vales donde se almacenan los vales diarios de los usuario para los requerimientos de repuestos mecanicos.
La conformación del dicho vale proviene de ciertos datos que se encuentran en otras tablas.
La estructura de la tabla Stock_Vales es la siguiente:
CODIGO (INT)
CODGACI (VARCHAR)
DESCRIPCION (VARCHAR)
LEGAJO (INT)
NOMBRE (VARCHAR)
VALE (INT)
FECHA (DATE)
HORA (VARCHAR)

TABLAS ANEXAS 
STOCK_CODIGOS (TABLA EN LA QUE GENERA EL NUMERO DE VALE AUTOMATICAMENTE)
CODVALE (INT)
STOCK_LEGAJOS (TABLA DE LOS LEGAJOS DE LOS USUARIOS QUE INTERVIENEN EN EL VALE)
LEGAJO (INT)
NOMBRE (VARCHAR)
STOCK_ARTICULOS (TABLA DE LOS ARTICULOS QUE SE ENCUENTRAN EN EL STOCK, LOS CODIGOS DE LOS ARTICULOS SE PUEDEN REPETIR PERO HAY UN CAMPO QUE NO SE REPITE QUE ES EL CAMPO CODGACI)
CODIGO (INT)
CODGACI (VARCHAR)
DESCRIPCION (VARCHAR)

SE SOLICITA LO SIGUIENTE
REALIZAR UN FORM PARA CARGAR UN VALE QUE MUESTRE EL NUMERO DE VALE QUE CORRESPONDE 
CUANDO SE INGRESE EL CODIGO DE ARTICULO Y SEGUIDAMENTE SE PULSE EL ENTER
TENDRA QUE MOSTRAR UNA TABLA CON TODOS LOS ARTICULOS QUE TIENEN EL MISMO CODIGO PERO DISTINTOS CODGACI. Y QUE APAREZCA AL PRINCIPIO DE CADA REGISTRO UN RADIOBUTTON  QUE AL HACER CLICK EN EL , PASEN LOS DATOS A SUS RESPECTIVOS CAMPOS INPUT QUE TENGAN MAS ABAJO.
SEGUIDAMENTE, AL INGRESAR EN EL SIGUIENTE INPUT EL LEGAJO, EN CASO DE NO ENCONTRAR EL MISMO, DEBERA MOSTRAR UN SELECT CON LOS NOMBRES DE LOS USUARIOS PARA SELECCIONAR Y LUEGO DE SELECCIONAR DEBERA PASAR LOS DATOS A SUS CAMPOS INPUT RESPECTIVOS.
UNA VEZ COLOCADOS LOS DATOS CORRECTOS, LA APLICACIÓN TENDRA QUE PEDIR LA CANTIDAD QUE SE REQUIERE Y SEGUIDAMENTE AL PULSAR ENTER, GRABARA LOS DATOS EN LA TABLA STOCK_VALE.


