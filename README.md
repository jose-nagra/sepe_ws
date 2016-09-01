# sepe_ws
El servicio web soap que establece el SEPE para la acreditación de los Centros de Formación, para mis escasos conocimientos en programacion, he intentado crear el web service en PHP y NUSOAP, con una base de datos en mysql, pero no consigo terminarlo, por tanto he creado este proyecto para todo el que quiera colaborar en el perfeccionamiento, modificación, aportación al mismo bienvenido sea. 

#Por tanto he subido lo que he sido capaz de hacer, el test del KIT de pruebas me da el siguiente resultado:

#obtenerDatosCentro     -     password incorrecto 'EPESSEPECESEPE'     -      KO
#obtenerDatosCentro     -     datos identificativos correctos     -     OK
#crearCentro     -     ORIGEN_CENTRO='20' y CODIGO_CENTRO='9999999999'    -     OK
#obtenerDatosCentro     -     referencia con '20' y '9999999999'    -     OK
#obtenerListaAcciones     -     vacía     -     OK
#crearAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280010     -      KO
#crearAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280012     -      KO
#crearAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280013     -      KO
#crearAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280014     -     OK
#crearAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280011     -     OK
#obtenerListaAcciones     -     coincide     -     OK
#crearAccion     -     ya creada     -     OK
#obtenerAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280010     -      KO
#obtenerAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280012     -      KO
#obtenerAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280013     -      KO
#obtenerAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280014     -      KO
#obtenerAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280011     -      KO
#eliminarAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280010     -     OK
#eliminarAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280012     -     OK
#eliminarAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280013     -     OK
#eliminarAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280014     -     OK
#eliminarAccion     -     ORIGEN_ACCION=20 CODIGO_ACCION=2014280011     -     OK
#Finalización programa de ProveedorCentroTFValidador...

Muchas gracias 
