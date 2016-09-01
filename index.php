<?php
include('lib/nusoap.php');

require_once 'config.php';
include("conexion.php");
require_once 'include/dbHandler.php';
//Se carga la librería soap
        

//Deshabilita que se guarde en caché la info del wsdl
ini_set("soap.wsdl_cache_enabled", "0");
//$server = new soap_server(URL_WSDL, array());
$server = new soap_server(URL_WSDL, array('encoding' => 'ISO-8859-1'));
$Credenciales  = $server->requestHeader;

$WS_User = $Credenciales["Security"]["UsernameToken"]["SEPE"];  // Aqui viene el User

$WS_Pass = $Credenciales["Security"]["UsernameToken"]["password"]["!"];// Aqui viene el Pass*/



 

function crearCentro($centro) {
	
	
		
	
	$INSERT_CENTRO ="INSERT INTO sepe_centro (ORIGEN_CENTRO,CODIGO_CENTRO,NOMBRE_CENTRO,URL_PLATAFORMA,URL_SEGUIMIENTO,TELEFONO,EMAIL) VALUES ('".$centro["ID_CENTRO"]["ORIGEN_CENTRO"]."','".$centro["ID_CENTRO"]["CODIGO_CENTRO"]."','".$centro["NOMBRE_CENTRO"]."','".$centro["URL_PLATAFORMA"]."','".$centro["URL_SEGUIMIENTO"]."','".$centro["TELEFONO"]."','".$centro["EMAIL"]."')";
	
	
	$res = array();
	
	
	$resultado=mysql_query($INSERT_CENTRO);
	
		
	
  			$res["ORIGEN_CENTRO"] = $centro["ID_CENTRO"]["ORIGEN_CENTRO"];
            $res["CODIGO_CENTRO"] = $centro["ID_CENTRO"]["CODIGO_CENTRO"];
			$res["NOMBRE_CENTRO"] = $centro["NOMBRE_CENTRO"];
            $res["URL_PLATAFORMA"] = $centro["URL_PLATAFORMA"];
            $res["URL_SEGUIMIENTO"] = $centro["URL_SEGUIMIENTO"];
            $res["TELEFONO"] = $centro["TELEFONO"];
            $res["EMAIL"] = $centro["EMAIL"];
	
			
       $consulta= " SELECT * FROM accion_formativa";
	  $resultado=mysql_query($consulta);
	  $idcentro=mysql_fetch_array($resultado);
	  $idc=$idcentro['ID_CENTRO'];
	  if($idc == 1){
		  return array ('RESPUESTA_DATOS_CENTRO' => array(
            'CODIGO_RETORNO' => '1',
            'ETIQUETA_ERROR' => "Centro con Acciones", 
			'DATOS_IDENTIFICATIVOS' => null));
		  
		  } else{
	
    return array ('RESPUESTA_DATOS_CENTRO' => array(
            'CODIGO_RETORNO' => '0',
            'ETIQUETA_ERROR' => "Correcto", 
			'DATOS_IDENTIFICATIVOS' => array(
                'ID_CENTRO' =>  array('ORIGEN_CENTRO' => $res['ORIGEN_CENTRO'], 'CODIGO_CENTRO' => $res['CODIGO_CENTRO']),
                'NOMBRE_CENTRO' => $res['NOMBRE_CENTRO'],
                'URL_PLATAFORMA' => $res['URL_PLATAFORMA'],
                'URL_SEGUIMIENTO' => $res['URL_SEGUIMIENTO'],
                'TELEFONO' => $res['TELEFONO'],
                'EMAIL' => $res['EMAIL'])));
				

		  }
}




function obtenerDatosCentro() {
	 
	  $sql = " SELECT * FROM sepe_centro LIMIT 1";
    $list = array();
$results = mysql_query($sql);


while($row = mysql_fetch_assoc($results)) {
		  
			
    	$list= array('ID_CENTRO' => array('ORIGEN_CENTRO' => $row['ORIGEN_CENTRO'], 'CODIGO_CENTRO' => $row['CODIGO_CENTRO']),	
					'NOMBRE_CENTRO'=>$row['NOMBRE_CENTRO'],
                    'URL_PLATAFORMA'=>$row['URL_PLATAFORMA'],
                    'URL_SEGUIMIENTO'=>$row['URL_SEGUIMIENTO'],
                    'TELEFONO'=>$row['TELEFONO'],
					'EMAIL'=>$row['EMAIL']);
}


	
            		 
			
   			 
			return array('RESPUESTA_DATOS_CENTRO' => array(
           	 'CODIGO_RETORNO' => 0,
			 'ETIQUETA_ERROR' => "Correcto", 
			 'DATOS_IDENTIFICATIVOS' => $list));
			
	  
	  	  
	
    
	
	
	
		  
  } 
 
 











function crearAccion($accion) {
		
		$list = array();		
		$res = array();
		$list3 = array();
	/////////////////////////////	 //INSERTAR LOS VALORES DE LA ACCION FORMATIVA ESTE ESTA OK  /////////////////////////////////////////////////
   $consultaAccion = "SELECT * from accion_formativa WHERE CODIGO_ACCION = '".$accion["ID_ACCION"]["CODIGO_ACCION"]."'";
	$resultadoComprobacion = mysql_query($consultaAccion);
	$numAccion = mysql_num_rows($resultadoComprobacion);
	if ($numAccion == 0) {
	
	$INSERT ="INSERT INTO accion_formativa (ORIGEN_ACCION,CODIGO_ACCION,SITUACION,ORIGEN_ESPECIALIDAD,AREA_PROFESIONAL,CODIGO_ESPECIALIDAD,DURACION,FECHA_INICIO,FECHA_FIN,IND_ITINERARIO_COMPLETO,TIPO_FINANCIACION,NUMERO_ASISTENTES,DENOMINACION_ACCION,INFORMACION_GENERAL,HORARIOS,REQUISITOS,CONTACTO_ACCION) VALUES ('".$accion["ID_ACCION"]["ORIGEN_ACCION"]."','".$accion["ID_ACCION"]["CODIGO_ACCION"]."','".$accion["SITUACION"]."','".$accion["ID_ESPECIALIDAD_PRINCIPAL"]["ORIGEN_ESPECIALIDAD"]."','".$accion["ID_ESPECIALIDAD_PRINCIPAL"]["AREA_PROFESIONAL"]."','".$accion["ID_ESPECIALIDAD_PRINCIPAL"]["CODIGO_ESPECIALIDAD"]."','".$accion["DURACION"]."','".$accion["FECHA_INICIO"]."','".$accion["FECHA_FIN"]."','".$accion["IND_ITINERARIO_COMPLETO"]."','".$accion["TIPO_FINANCIACION"]."','".$accion["NUMERO_ASISTENTES"]."','".$accion["DESCRIPCION_ACCION"]["DENOMINACION_ACCION"]."','".$accion["DESCRIPCION_ACCION"]["INFORMACION_GENERAL"]."','".$accion["DESCRIPCION_ACCION"]["HORARIOS"]."','".$accion["DESCRIPCION_ACCION"]["REQUISITOS"]."','".$accion["DESCRIPCION_ACCION"]["CONTACTO_ACCION"]."')";
	
	
	$resultado=mysql_query($INSERT);
	
		
			
  			$res["ORIGEN_ACCION"] = $accion["ID_ACCION"]["ORIGEN_ACCION"];
            $res["CODIGO_ACCION"] = $accion["ID_ACCION"]["CODIGO_ACCION"];
            $res["SITUACION"] = $accion["SITUACION"];
			$res["ORIGEN_ESPECIALIDAD"] = $accion["ID_ESPECIALIDAD_PRINCIPAL"]["ORIGEN_ESPECIALIDAD"];
			$res["AREA_PROFESIONAL"] = $accion["ID_ESPECIALIDAD_PRINCIPAL"]["AREA_PROFESIONAL"];
			$res["CODIGO_ESPECIALIDAD"] = $accion["ID_ESPECIALIDAD_PRINCIPAL"]["CODIGO_ESPECIALIDAD"];
            $res["DURACION"] = $accion["DURACION"];
            $res["FECHA_INICIO"] = $accion["FECHA_INICIO"];
            $res["FECHA_FIN"] = $accion["FECHA_FIN"];
			$res["IND_ITINERARIO_COMPLETO"] = $accion["IND_ITINERARIO_COMPLETO"];
			$res["TIPO_FINANCIACION"] = $accion["TIPO_FINANCIACION"];
			$res["NUMERO_ASISTENTES"] = $accion["NUMERO_ASISTENTES"];
			$res["DENOMINACION_ACCION"] = $accion["DESCRIPCION_ACCION"]["DENOMINACION_ACCION"];
			$res["INFORMACION_GENERAL"] = $accion["DESCRIPCION_ACCION"]["INFORMACION_GENERAL"];
			$res["HORARIOS"] = $accion["DESCRIPCION_ACCION"]["HORARIOS"];
			$res["REQUISITOS"] = $accion["DESCRIPCION_ACCION"]["REQUISITOS"];
			$res["CONTACTO_ACCION"] =$accion["DESCRIPCION_ACCION"]["CONTACTO_ACCION"];
			
			
	//////////////////////////		 //INSERTAR LOS VALORES DE LAS ESPECIALIDADES YA ESTAN OK OK OK //////////////////////////////////////////////
	
		$consultaAccion = "SELECT * from accion_formativa WHERE CODIGO_ACCION = '".$accion["ID_ACCION"]["CODIGO_ACCION"]."'";
		$resultadoNuevaAccion = mysql_query($consultaAccion);
		$naccion = mysql_fetch_array($resultadoNuevaAccion);
		$id = $naccion["id"];
		$s=$accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"];
		$count = count($s);
 	
 // Aqui va a insertar un insert por cada uno de los elementos contados anteriormente
 for( $j = 0; $j < $count; $j++){


 
//traigo los elementos de la lista y se los asigno a la variable idtienda
 $idaccion = $accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["ID_ESPECIALIDAD"];
 $idcentro = $accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["CENTRO_IMPARTICION"];
 $idesp = $accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j];
 $iduracion = $accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["DATOS_DURACION"];
if ($iduso=$accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["USO"]) { 
  
} else {
$iduso= null; 
} 


		
			$consulta ="INSERT INTO especialidad (ORIGEN_ESPECIALIDAD,AREA_PROFESIONAL,CODIGO_ESPECIALIDAD,ORIGEN_CENTRO,CODIGO_CENTRO,FECHA_INICIO,FECHA_FIN,MODALIDAD_IMPARTICION,HORAS_PRESENCIAL,HORAS_TELEFORMACION,NUM_PARTICIPANTES_M,NUMERO_ACCESOS_M,DURACION_TOTAL_M,NUM_PARTICIPANTES_T,NUMERO_ACCESOS_T,DURACION_TOTAL_T,NUM_PARTICIPANTES_N,NUMERO_ACCESOS_N,DURACION_TOTAL_N,NUM_PARTICIPANTES_S,NUMERO_ACTIVIDADES_APRENDIZAJE_S,NUMERO_INTENTOS_S,NUMERO_ACTIVIDADES_EVALUACION_S,REF_ACCION) VALUES ('".$idaccion["ORIGEN_ESPECIALIDAD"]."','".$idaccion["AREA_PROFESIONAL"]."','".$idaccion["CODIGO_ESPECIALIDAD"]."','".$idcentro["ORIGEN_CENTRO"]."','".$idcentro["CODIGO_CENTRO"]."','".$idesp["FECHA_INICIO"]."','".$idesp["FECHA_FIN"]."','".$idesp["MODALIDAD_IMPARTICION"]."','".$iduracion["HORAS_PRESENCIAL"]."','".$iduracion["HORAS_TELEFORMACION"]."','".$iduso["HORARIO_MANANA"]["NUM_PARTICIPANTES"]."','".$iduso["HORARIO_MANANA"]["NUMERO_ACCESOS"]."','".$iduso["HORARIO_MANANA"]["DURACION_TOTAL"]."','".$iduso["HORARIO_TARDE"]["NUM_PARTICIPANTES"]."','".$iduso["HORARIO_TARDE"]["NUMERO_ACCESOS"]."','".$iduso["HORARIO_TARDE"]["DURACION_TOTAL"]."','".$iduso["HORARIO_NOCHE"]["NUM_PARTICIPANTES"]."','".$iduso["HORARIO_NOCHE"]["NUMERO_ACCESOS"]."','".$iduso["HORARIO_NOCHE"]["DURACION_TOTAL"]."','".$iduso["SEGUIMIENTO_EVALUACION"]["NUM_PARTICIPANTES"]."','".$iduso["SEGUIMIENTO_EVALUACION"]["NUMERO_ACTIVIDADES_APRENDIZAJE"]."','".$iduso["SEGUIMIENTO_EVALUACION"]["NUMERO_INTENTOS"]."','".$iduso["SEGUIMIENTO_EVALUACION"]["NUMERO_ACTIVIDADES_EVALUACION"]."','".$id."')";
		$resultadoEspe=mysql_query($consulta);
		
		
		
			
        
	  //////////////  //INSERTAR LOS VALORES DE LOS CENTROS PRESENCIALES ESTE ESTA OK OK OK /////////////////////////////////////////////////////////////
	   
	    
	    $consultaEspeCentro = "SELECT * from especialidad WHERE CODIGO_ESPECIALIDAD = '".$idaccion["CODIGO_ESPECIALIDAD"]."'";
		$resultadoNuevoCentro = mysql_query($consultaEspeCentro);
		$ncentro = mysql_fetch_array($resultadoNuevoCentro);
		$id_espeCentro = $ncentro["ID_ESPECIALIDAD"];
		
		
		$c=$accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["CENTROS_SESIONES_PRESENCIALES"]["CENTRO_PRESENCIAL"];
		$countc = count($c);
 	
 // Aqui va a insertar un insert por cada uno de los elementos contados anteriormente
 for( $i = 0; $i < $countc; $i++){
 $idcentrop = $accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["CENTROS_SESIONES_PRESENCIALES"]["CENTRO_PRESENCIAL"][$i];
		
	
	
	$insertarCentro ="INSERT INTO centro_presencial (ORIGEN_CENTRO,CODIGO_CENTRO,REF_ESPECIALIDAD,REF_ACCION) VALUES ('".$idcentrop["ORIGEN_CENTRO"]."','".$idcentrop["CODIGO_CENTRO"]."','".$id_espeCentro."','".$id."')";
		$resultadoEspe=mysql_query($insertarCentro);
	
	
	
	
		}
		
	
			
	 //INSERTAR LOS VALORES DE LOS TUTORES esta todo ok 
	$consultaEspeCentro2 = "SELECT * from especialidad WHERE CODIGO_ESPECIALIDAD = '".$idaccion["CODIGO_ESPECIALIDAD"]."'";
		$resultadoNuevoCentro2 = mysql_query($consultaEspeCentro2);
		$ncentro2 = mysql_fetch_array($resultadoNuevoCentro2);
		$id_espeCentro2 = $ncentro2["ID_ESPECIALIDAD"];
		
 
		
		if (isset($accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["TUTORES_FORMADORES"]["TUTOR_FORMADOR"])) {
		$f=$accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["TUTORES_FORMADORES"]["TUTOR_FORMADOR"];
		
				$countt =count($f);
				
 // Aqui va a insertar un insert por cada uno de los elementos contados anteriormente
 for( $tu = 0; $tu < $countt; $tu++){
	 

if ($idtutor = $accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["TUTORES_FORMADORES"]["TUTOR_FORMADOR"][$tu]["ID_TUTOR"]){
	
	}else{
		$idtutor = null;
	}
if ($idtutorias = $accion["ESPECIALIDADES_ACCION"]["ESPECIALIDAD"][$j]["TUTORES_FORMADORES"]["TUTOR_FORMADOR"][$tu]){
}else {
	$idtutorias = null;
}
 
		
	$insertarTutor ="INSERT INTO tutor_formador (TIPO_DOCUMENTO,NUM_DOCUMENTO,LETRA_NIF,ACREDITACION_TUTOR,EXPERIENCIA_PROFESIONAL,COMPETENCIA_DOCENTE,EXPERIENCIA_MODALIDAD_TELEFORMACION,FORMACION_MODALIDAD_TELEFORMACION,REF_ESPECIALIDAD,REF_ACCION) VALUES ('".$idtutor["TIPO_DOCUMENTO"]."','".$idtutor["NUM_DOCUMENTO"]."','".$idtutor["LETRA_NIF"]."','".$idtutorias["ACREDITACION_TUTOR"]."','".$idtutorias["EXPERIENCIA_PROFESIONAL"]."','".$idtutorias["COMPETENCIA_DOCENTE"]."','".$idtutorias["EXPERIENCIA_MODALIDAD_TELEFORMACION"]."','".$idtutorias["FORMACION_MODALIDAD_TELEFORMACION"]."','".$id_espeCentro2."','".$id."')";
		$resultadoTutor=mysql_query($insertarTutor);	
		
		
		
		}
		}
		
		 /////////////////////////////////////////////////////////////////////////////*///////////////////////////////////////////////////////
		
		$list1= array();
		
		
		
						
		$consulta3 = "SELECT * FROM centro_presencial WHERE REF_ESPECIALIDAD = '".$id_espeCentro."' AND REF_ACCION = '".$id."'";
		$resultado3=mysql_query($consulta3);
		
			while($row1 = mysql_fetch_assoc($resultado3)) {
						
				array_push($list1, array( 
				
												'ORIGEN_CENTRO' => $row1['ORIGEN_CENTRO'], 
												'CODIGO_CENTRO' => $row1['CODIGO_CENTRO']));
						
		
		}
		
		$list2= array();
						
		$consultaTutor1 = "SELECT * from tutor_formador WHERE REF_ESPECIALIDAD = '".$id_espeCentro2."' AND REF_ACCION = '".$id."'";
		$resultadoTutor1 = mysql_query($consultaTutor1);
		
		while($row2 = mysql_fetch_assoc($resultadoTutor1)) {
						
						array_push($list2, array(
						
				'ID_TUTOR' => array(
					'TIPO_DOCUMENTO' => $row2['TIPO_DOCUMENTO'], 
					'NUM_DOCUMENTO' => $row2['NUM_DOCUMENTO'], 
					'LETRA_NIF' => $row2['LETRA_NIF']),
			'ACREDITACION_TUTOR' => $row2['ACREDITACION_TUTOR'],
			'EXPERIENCIA_PROFESIONAL' => $row2['EXPERIENCIA_PROFESIONAL'],
			'COMPETENCIA_DOCENTE' => $row2['COMPETENCIA_DOCENTE'],
			'EXPERIENCIA_MODALIDAD_TELEFORMACION' => $row2['EXPERIENCIA_MODALIDAD_TELEFORMACION'],
			'FORMACION_MODALIDAD_TELEFORMACION' => $row2['FORMACION_MODALIDAD_TELEFORMACION']));
						
						
							
		
		}
							
		
					
		$consultaEspecialidad1 = "SELECT * from especialidad WHERE CODIGO_ESPECIALIDAD = '".$idaccion["CODIGO_ESPECIALIDAD"]."' AND REF_ACCION = '".$id."'";
		$resultadoEspecialidad1 = mysql_query($consultaEspecialidad1);
			
		
		while($row = mysql_fetch_assoc($resultadoEspecialidad1)) {
		  
			
    	array_push($list, array(
		
		'ID_ESPECIALIDAD' => array ( 
			'ORIGEN_ESPECIALIDAD' => $row['ORIGEN_ESPECIALIDAD'], 
			'AREA_PROFESIONAL' => $row['AREA_PROFESIONAL'], 
			'CODIGO_ESPECIALIDAD' => $row['CODIGO_ESPECIALIDAD']),
		'CENTRO_IMPARTICION' => array(
			'ORIGEN_CENTRO' => $row['ORIGEN_CENTRO'], 
			'CODIGO_CENTRO' => $row['CODIGO_CENTRO']),
		'FECHA_INICIO' => $row['FECHA_INICIO'],
		'FECHA_FIN' => $row['FECHA_FIN'],
		'MODALIDAD_IMPARTICION' => $row['MODALIDAD_IMPARTICION'],
		'DATOS_DURACION' => array(
			'HORAS_PRESENCIAL' => $row['HORAS_PRESENCIAL'], 'HORAS_TELEFORMACION' => $row['HORAS_TELEFORMACION']),
		
		//HAY QUE GENERAR CONSULTAS
		'CENTROS_SESIONES_PRESENCIALES' => array( 
			'CENTRO_PRESENCIAL' => $list1),
		// HAY QUE GENERAR LAS CONSULTAS PARA LOS TUTORES
		'TUTORES_FORMADORES' => array(
			'TUTOR_FORMADOR' => $list2),
			
		'USO' => array(
			'HORARIO_MANANA' => array(
				'NUM_PARTICIPANTES' => $row['NUM_PARTICIPANTES_M'], 
				'NUMERO_ACCESOS' => $row['NUMERO_ACCESOS_M'], 
				'DURACION_TOTAL' => $row['DURACION_TOTAL_M']),
			'HORARIO_TARDE' => array(
				'NUM_PARTICIPANTES' => $row['NUM_PARTICIPANTES_T'], 
				'NUMERO_ACCESOS' => $row['NUMERO_ACCESOS_T'], 
				'DURACION_TOTAL' => $row['DURACION_TOTAL_T']),
			'HORARIO_NOCHE' => array(
				'NUM_PARTICIPANTES' => $row['NUM_PARTICIPANTES_N'], 
				'NUMERO_ACCESOS' => $row['NUMERO_ACCESOS_N'], 
				'DURACION_TOTAL' => $row['DURACION_TOTAL_N']),
			'SEGUIMIENTO_EVALUACION' => array(
				'NUM_PARTICIPANTES' => $row['NUM_PARTICIPANTES_S'], 
				'NUMERO_ACTIVIDADES_APRENDIZAJE' => $row['NUMERO_ACTIVIDADES_APRENDIZAJE_S'], 
				'NUMERO_INTENTOS' => $row['NUMERO_INTENTOS_S'], 
				'NUMERO_ACTIVIDADES_EVALUACION' => $row['NUMERO_ACTIVIDADES_EVALUACION_S'])),
		
		));
					
		
			}			
		}
		
		
		////////////////////////////////////////////////////////////
		
			
				
		
		
		
						
						
		
			
	//////////////////////////////////	//INSERTAR LOS VALORES DE LOS PARTICIPANTES EN PRINCIPIO ESTA TODO OK///////////////////////////////////////////////////////////////
		$consultaAccion = "SELECT * from accion_formativa WHERE CODIGO_ACCION = '".$accion["ID_ACCION"]["CODIGO_ACCION"]."'";
		$resultadoNuevaAccion = mysql_query($consultaAccion);
		$naccion = mysql_fetch_array($resultadoNuevaAccion);
		$id = $naccion["id"];
		
		if (isset($accion["PARTICIPANTES"]["PARTICIPANTE"])) {
		$p=$accion["PARTICIPANTES"]["PARTICIPANTE"];
		$countp = count($p);
 	
 // Aqui va a insertar un insert por cada uno de los elementos contados anteriormente
 for( $pa = 0; $pa < $countp; $pa++){

if ($idcontrato=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["CONTRATO_FORMACION"]) { 
  
} else {
$idcontrato= null; 
} 
  
//traigo los elementos de la lista y se los asigno a la variable idtienda
 $idparti = $accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ID_PARTICIPANTE"];
 $idindi = $accion["PARTICIPANTES"]["PARTICIPANTE"][$pa];
 
 

   
		
	$insertar_participante ="INSERT INTO participante (TIPO_DOCUMENTO,NUM_DOCUMENTO,LETRA_NIF,INDICADOR_COMPETENCIAS_CLAVE,ID_CONTRATO_CFA,CIF_EMPRESA,TIPO_DOCUMENTO_TE,NUM_DOCUMENTO_TE,LETRA_NIF_TE,TIPO_DOCUMENTO_TF,NUM_DOCUMENTO_TF,LETRA_NIF_TF,REF_ACCION) VALUES ('".$idparti["TIPO_DOCUMENTO"]."','".$idparti["NUM_DOCUMENTO"]."','".$idparti["LETRA_NIF"]."','".$idindi["INDICADOR_COMPETENCIAS_CLAVE"]."','".$idcontrato["ID_CONTRATO_CFA"]."','".$idcontrato["CIF_EMPRESA"]."','".$idcontrato["ID_TUTOR_EMPRESA"]["TIPO_DOCUMENTO"]."','".$idcontrato["ID_TUTOR_EMPRESA"]["NUM_DOCUMENTO"]."','".$idcontrato["ID_TUTOR_EMPRESA"]["LETRA_NIF"]."','".$idcontrato["ID_TUTOR_FORMACION"]["TIPO_DOCUMENTO"]."','".$idcontrato["ID_TUTOR_FORMACION"]["NUM_DOCUMENTO"]."','".$idcontrato["ID_TUTOR_FORMACION"]["LETRA_NIF"]."','".$id."')";
		$resultadoEspe1=mysql_query($insertar_participante);
		
		
						
		
	////////////////////////////INSERTAR LOS VALORES DE LAS ESPECIALIDADES PARTICIPANTE////////////////////////////////////////////////////////////////////
	
		$consulta_esp_part = "SELECT * from participante WHERE NUM_DOCUMENTO = '".$idparti["NUM_DOCUMENTO"]."'";
		$resultado_esp_part = mysql_query($consulta_esp_part);
		$esp_part = mysql_fetch_array($resultado_esp_part);
		$id_esp_part = $esp_part["ID_PARTICIPANTE"];
		if (isset($accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"])) {
	$sp=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"];
		$countsp = count($sp);
 	
 // Aqui va a insertar un insert por cada uno de los elementos contados anteriormente
 for( $spa = 0; $spa < $countsp; $spa++){

if ($idspa1=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["EVALUACION_FINAL"]) { 
  
} else {
$idspa1= null; 
} 
 if ($idspa2=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["RESULTADOS"]){
	
	
	 } else {
$idspa2= null;
} 

if(empty ($accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["RESULTADOS"]["CALIFICACION_FINAL"])){
	
	$idspa21= null;
	
}else{
	$idspa21=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["RESULTADOS"]["CALIFICACION_FINAL"];
}
if(empty ($accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["RESULTADOS"]["PUNTUACION_FINAL"])){
	
	$idspa22= null;
	
}else{
	$idspa22=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["RESULTADOS"]["PUNTUACION_FINAL"];
}

if ($idspa=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]){
}else {
	$idspa= null;
	}
	
if (empty ($accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["TUTORIAS_PRESENCIALES"]["TUTORIA_PRESENCIAL"])){
$idspaTut= null;
}else {
	
	$idspaTut=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["TUTORIAS_PRESENCIALES"]["TUTORIA_PRESENCIAL"];
	}
	
	if(empty ($accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["FECHA_ALTA"])){
	
	$idspa31= null;
	
}else{
	$idspa31=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["FECHA_ALTA"];
}
if(empty ($accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["FECHA_BAJA"])){
	
	$idspa32= null;
	
}else{
	$idspa32=$accion["PARTICIPANTES"]["PARTICIPANTE"][$pa]["ESPECIALIDADES_PARTICIPANTE"]["ESPECIALIDAD"][$spa]["FECHA_BAJA"];
}
		
	$insertar_esp_part ="INSERT INTO especialidad_participante (ORIGEN_ESPECIALIDAD,AREA_PROFESIONAL,CODIGO_ESPECIALIDAD,FECHA_ALTA,FECHA_BAJA,ORIGEN_CENTRO,CODIGO_CENTRO,FECHA_INICIO_T,FECHA_FIN_T,ORIGEN_CENTRO_EX,CODIGO_CENTRO_EX,FECHA_INICIO_EX,FECHA_FIN_EX,RESULTADO_FINAL,CALIFICACION_FINAL,PUNTUACION_FINAL,REF_PARTICIPANTE,REF_ACCION) VALUES ('".$idspa["ID_ESPECIALIDAD"]["ORIGEN_ESPECIALIDAD"]."','".$idspa["ID_ESPECIALIDAD"]["AREA_PROFESIONAL"]."','".$idspa["ID_ESPECIALIDAD"]["CODIGO_ESPECIALIDAD"]."','".$idspa31."','".$idspa32."','".$idspaTut["CENTRO_PRESENCIAL_TUTORIA"]["ORIGEN_CENTRO"]."','".$idspaTut["CENTRO_PRESENCIAL_TUTORIA"]["CODIGO_CENTRO"]."','".$idspaTut["FECHA_INICIO"]."','".$idspaTut["FECHA_FIN"]."','".$idspa1["CENTRO_PRESENCIAL_EVALUACION"]["ORIGEN_CENTRO"]."','".$idspa1["CENTRO_PRESENCIAL_EVALUACION"]["CODIGO_CENTRO"]."','".$idspa1["FECHA_INICIO"]."','".$idspa1["FECHA_FIN"]."','".$idspa2["RESULTADO_FINAL"]."','".$idspa21."','".$idspa22."','".$id_esp_part."','".$id."')";
		$resultadoEspePart=mysql_query($insertar_esp_part)or die(mysql_error());
		
		
		
		
												
		
		////////////////////////////////////////////INSERTAR LOS VALORES DE LAS ESPECIALIDADES PARTICIPANTE TUTORIAS PRESENCIALES////////////////////////////////////////////////
		
		
	/*	$consulta_tutoria_presencial = "SELECT * from especialidad_participante WHERE CODIGO_ESPECIALIDAD = '".$idspa["ID_ESPECIALIDAD"]["CODIGO_ESPECIALIDAD"]."' AND REF_PARTICIPANTE = '".$id_esp_part."'";
		$resultado_tutoria_presencial = mysql_query($consulta_tutoria_presencial);
		$tutoria_presencial = mysql_fetch_array($resultado_tutoria_presencial);
		$id_variable = $tutoria_presencial["ID_ESP_PART"];
		
		if (isset($idspa["TUTORIAS_PRESENCIALES"]["TUTORIA_PRESENCIAL"])) {
		$tp1=$idspa["TUTORIAS_PRESENCIALES"]["TUTORIA_PRESENCIAL"];
				
		$tp21 = count($tp1);
		for( $tpa1 = 0; $tpa1 < $tp21; $tpa1++){
		
		
		
if (!empty ($idspa["TUTORIAS_PRESENCIALES"]["TUTORIA_PRESENCIAL"][$tpa1]["CENTRO_PRESENCIAL_TUTORIA"]["ORIGEN_CENTRO"])){		
$id_tut_centro1= NULL;
} else {
	$id_tut_centro1=$idspa["TUTORIAS_PRESENCIALES"]["TUTORIA_PRESENCIAL"][$tpa1]["CENTRO_PRESENCIAL_TUTORIA"]["ORIGEN_CENTRO"];
}


if ($id_tut_centro2=$idspa["TUTORIAS_PRESENCIALES"]["TUTORIA_PRESENCIAL"][$tpa1]["CENTRO_PRESENCIAL_TUTORIA"]["CODIGO_CENTRO"]){		
} else {
	$id_tut_centro2= NULL;
}
if ($id_tut1=$idspa["TUTORIAS_PRESENCIALES"]["TUTORIA_PRESENCIAL"][$tpa1]["FECHA_INICIO"]){
} else {
	$id_tut1= NULL;
}

if ($id_tut2=$idspa["TUTORIAS_PRESENCIALES"]["TUTORIA_PRESENCIAL"][$tpa1]["FECHA_FIN"]){
} else {
$id_tut2= NULL;	
}
		
			$insertar_tut_pres ="INSERT INTO tutorias_presenciales (ORIGEN_CENTRO,CODIGO_CENTRO,FECHA_INICIO,FECHA_FIN) VALUES ('".$id_tut_centro1."','".$id_tut_centro2."','".$id_tut1."','".$id_tut2."')";
		$resultadotutpres=mysql_query($insertar_tut_pres);
		
		
		}
		}*/
  }
   }
		
		///////////////////////////////////// LA BUSQUEDA DE LOS PARTICIPANTES Y SUS HIJOS //////////////////////
		 				
					$list31 = array();	
		
		$c31= "SELECT * FROM especialidad_participante WHERE REF_PARTICIPANTE='".$id_esp_part."' AND REF_ACCION = '".$id."'";
		
		$r31=mysql_query($c31) or die(mysql_error());
		
		
		while($row31 = mysql_fetch_assoc($r31)){ 
		
		array_push($list31, array(
		
		
		
		
							
								'ID_ESPECIALIDAD' => array('ORIGEN_ESPECIALIDAD'  => $row31['ORIGEN_ESPECIALIDAD'], 'AREA_PROFESIONAL' => $row31['AREA_PROFESIONAL'], 'CODIGO_ESPECIALIDAD' => $row31['CODIGO_ESPECIALIDAD']),
									'FECHA_ALTA'  => $row31['FECHA_ALTA'], 
									'FECHA_BAJA' => $row31['FECHA_BAJA'],
									'TUTORIAS_PRESENCIALES' => array(
										'TUTORIA_PRESENCIAL' => array (
										'CENTRO_PRESENCIAL_TUTORIA' => array('ORIGEN_CENTRO'  => $row31['ORIGEN_CENTRO'], 'CODIGO_CENTRO' => $row31['CODIGO_CENTRO']),
		  								'FECHA_INICIO'  => $row31['FECHA_INICIO_T'], 
		 							    'FECHA_FIN' => $row31['FECHA_FIN_T'])),											
									'EVALUACION_FINAL' => array(
											'CENTRO_PRESENCIAL_EVALUACION' => array('ORIGEN_CENTRO'  => $row31['ORIGEN_CENTRO_EX'], 'CODIGO_CENTRO' => $row31['CODIGO_CENTRO_EX']),
											'FECHA_INICIO'  => $row31['FECHA_INICIO_EX'], 
											'FECHA_FIN' => $row31['FECHA_FIN_EX']),
									'RESULTADOS' => array(
											'RESULTADO_FINAL' => $row31['RESULTADO_FINAL'],
											'CALIFICACION_FINAL'  => $row31['CALIFICACION_FINAL'], 
											'PUNTUACION_FINAL' => $row31['PUNTUACION_FINAL']))			
									
							);	
							
							
				
		
		}							
							
								
						
	
							
		
		$consultaParticipante = "SELECT * from participante WHERE NUM_DOCUMENTO = '".$idparti["NUM_DOCUMENTO"]."' AND REF_ACCION = '".$id."'";
		$resultadoParticipante = mysql_query($consultaParticipante);
		
		
		while($row3 = mysql_fetch_assoc($resultadoParticipante)) {
		  
			
    	array_push($list3, array(
		
		 			
							'ID_PARTICIPANTE' => array('TIPO_DOCUMENTO'  => $row3['TIPO_DOCUMENTO'], 'NUM_DOCUMENTO' => $row3['NUM_DOCUMENTO'], 'LETRA_NIF' => $row3['LETRA_NIF']),
							'INDICADOR_COMPETENCIAS_CLAVE'  => $row3['INDICADOR_COMPETENCIAS_CLAVE'],
							'CONTRATO_FORMACION' => array(
								'ID_CONTRATO_CFA' => $row3['ID_CONTRATO_CFA'],
								'CIF_EMPRESA' => $row3['CIF_EMPRESA'],
								'ID_TUTOR_EMPRESA' => array('TIPO_DOCUMENTO'  => $row3['TIPO_DOCUMENTO_TE'], 'NUM_DOCUMENTO' => $row3['NUM_DOCUMENTO_TE'], 'LETRA_NIF' => $row3['LETRA_NIF_TE']),
								'ID_TUTOR_FORMACION' => array('TIPO_DOCUMENTO'  => $row3['TIPO_DOCUMENTO_TF'], 'NUM_DOCUMENTO' => $row3['NUM_DOCUMENTO_TF'], 'LETRA_NIF' => $row3['LETRA_NIF_TF'])),
							'ESPECIALIDADES_PARTICIPANTE' => array('ESPECIALIDAD' => $list31)								
								
								
								
								));  
		
		
		
		 }
  }
		///////////////////////////////////// LA BUSQUEDA DE LOS PARTICIPANTES Y SUS HIJOS //////////////////////
		}
	 return array('RESPUESTA_OBT_ACCION' => array( 
            'CODIGO_RETORNO' => 0,
            'ETIQUETA_ERROR' => "Correcto", 
			'ACCION_FORMATIVA' => array(
                'ID_ACCION' => array('ORIGEN_ACCION' => $res['ORIGEN_ACCION'], 'CODIGO_ACCION' => $res['CODIGO_ACCION']),
                'SITUACION' => $res['SITUACION'],
                'ID_ESPECIALIDAD_PRINCIPAL' => array('ORIGEN_ESPECIALIDAD' => $res['ORIGEN_ESPECIALIDAD'], 'AREA_PROFESIONAL' => $res['AREA_PROFESIONAL'], 'CODIGO_ESPECIALIDAD' => $res['CODIGO_ESPECIALIDAD']),
                'DURACION' => $res['DURACION'],
                'FECHA_INICIO' => $res['FECHA_INICIO'],
				'FECHA_FIN' => $res['FECHA_FIN'],
				'IND_ITINERARIO_COMPLETO' => $res['IND_ITINERARIO_COMPLETO'],
				'TIPO_FINANCIACION' => $res['TIPO_FINANCIACION'],
				'NUMERO_ASISTENTES' => $res['NUMERO_ASISTENTES'],
				'DESCRIPCION_ACCION' => array('DENOMINACION_ACCION' => $res['DENOMINACION_ACCION'], 'INFORMACION_GENERAL' => $res['INFORMACION_GENERAL'], 'HORARIOS' => $res['HORARIOS'], 'REQUISITOS' => $res['REQUISITOS'], 'CONTACTO_ACCION' => $res['CONTACTO_ACCION']),
				'ESPECIALIDADES_ACCION' => array('ESPECIALIDAD' => $list),
				'PARTICIPANTES' => array ('PARTICIPANTE' => $list3)
									
							)));	
				
	}else {
	return array('RESPUESTA_OBT_ACCION' => array( 
            'CODIGO_RETORNO' => 1,
            'ETIQUETA_ERROR' => false 
			/*'ACCION_FORMATIVA' => null*/));	
	}					

  }

 function obtenerAccion($accion) {
	$res = array();
	
    $consultaAccion = "SELECT * from accion_formativa WHERE ORIGEN_ACCION = '".$accion['ORIGEN_ACCION']."' AND CODIGO_ACCION = '".$accion['CODIGO_ACCION']."'";
		$resultadoNuevaAccion = mysql_query($consultaAccion);
		$naccion = mysql_fetch_array($resultadoNuevaAccion);
		$id = $naccion['id'];
		
		$num = mysql_num_rows($resultadoNuevaAccion);
		if ($num != '1') {
			return array('RESPUESTA_OBT_ACCION' => array( 
            'CODIGO_RETORNO' => 1,
            'ETIQUETA_ERROR' => false 
			));
			
			
		}else{
		
		
           $res["ORIGEN_ACCION"] = $naccion["ORIGEN_ACCION"];
		   $res["CODIGO_ACCION"] = $naccion["CODIGO_ACCION"];
			$res["SITUACION"] = $naccion["SITUACION"];
			$res["ORIGEN_ESPECIALIDAD"] = $naccion["ORIGEN_ESPECIALIDAD"];
			$res["AREA_PROFESIONAL"] = $naccion["AREA_PROFESIONAL"];
			$res["CODIGO_ESPECIALIDAD"] = $naccion["CODIGO_ESPECIALIDAD"];
			$res["DURACION"] = $naccion["DURACION"];
			$res["FECHA_INICIO"] = $naccion["FECHA_INICIO"];
			$res["FECHA_FIN"] = $naccion["FECHA_FIN"];
			$res["IND_ITINERARIO_COMPLETO"] = $naccion["IND_ITINERARIO_COMPLETO"];
			$res["TIPO_FINANCIACION"] = $naccion["TIPO_FINANCIACION"];
			$res["NUMERO_ASISTENTES"] = $naccion["NUMERO_ASISTENTES"];
			$res["DENOMINACION_ACCION"] = $naccion["DENOMINACION_ACCION"];
			$res["INFORMACION_GENERAL"] = $naccion["INFORMACION_GENERAL"];
			$res["HORARIOS"] = $naccion["HORARIOS"];
			$res["REQUISITOS"] = $naccion["REQUISITOS"];
			$res["CONTACTO_ACCION"] =$naccion["CONTACTO_ACCION"];
		
		
		
				
		
		
		
		
		
		$list1= array();
			
       
		$list= array();
		$list2= array();
		
					
       //////////////////////////		 //INSERTAR LOS VALORES DE LAS ESPECIALIDADES YA ESTAN OK OK OK //////////////////////////////////////////////
	 
	 $c4 = "SELECT * from especialidad WHERE REF_ACCION = '".$id."'";
			$r4 = mysql_query($c4);
				 
	 
			
			$row0 = mysql_fetch_array($r4);	
			
				$c2 = "SELECT * from centro_presencial WHERE REF_ESPECIALIDAD = '".$row0['ID_ESPECIALIDAD']."' AND REF_ACCION = '".$id."'";
				$r2 = mysql_query($c2);
			
			while ($row1 = mysql_fetch_array($r2)){  	     
				array_push ($list1, array ('ORIGEN_CENTRO' => 20, 'CODIGO_CENTRO' => $row1['CODIGO_CENTRO'])) ;
							
			
			}
			
				
								
		$consultaTutor = "SELECT * from tutor_formador WHERE REF_ESPECIALIDAD = '".$row0['ID_ESPECIALIDAD']."' AND REF_ACCION = '".$id."'";
		$resultadoTutor = mysql_query($consultaTutor);
		
	while	($row2 = mysql_fetch_assoc($resultadoTutor)){
						
						array_push($list2, array(
						
				'ID_TUTOR' => array(
					'TIPO_DOCUMENTO' => $row2['TIPO_DOCUMENTO'], 
					'NUM_DOCUMENTO' => $row2['NUM_DOCUMENTO'], 
					'LETRA_NIF' => $row2['LETRA_NIF']),
			'ACREDITACION_TUTOR' => $row2['ACREDITACION_TUTOR'],
			'EXPERIENCIA_PROFESIONAL' => $row2['EXPERIENCIA_PROFESIONAL'],
			'COMPETENCIA_DOCENTE' => $row2['COMPETENCIA_DOCENTE'],
			'EXPERIENCIA_MODALIDAD_TELEFORMACION' => $row2['EXPERIENCIA_MODALIDAD_TELEFORMACION'],
			'FORMACION_MODALIDAD_TELEFORMACION' => $row2['FORMACION_MODALIDAD_TELEFORMACION']));
						
							
			
	
	}
			
		

    	
				
		
			 while ($row = mysql_fetch_array($r4)){	
		
		
		$list[]= array(
		
		'ID_ESPECIALIDAD' => array ( 
			'ORIGEN_ESPECIALIDAD' => $row['ORIGEN_ESPECIALIDAD'], 
			'AREA_PROFESIONAL' => $row['AREA_PROFESIONAL'], 
			'CODIGO_ESPECIALIDAD' => $row['CODIGO_ESPECIALIDAD']),
		'CENTRO_IMPARTICION' => array(
			'ORIGEN_CENTRO' => $row['ORIGEN_CENTRO'], 
			'CODIGO_CENTRO' => $row['CODIGO_CENTRO']),
		'FECHA_INICIO' => $row['FECHA_INICIO'],
		'FECHA_FIN' => $row['FECHA_FIN'],
		'MODALIDAD_IMPARTICION' => $row['MODALIDAD_IMPARTICION'],
		'DATOS_DURACION' => array(
			'HORAS_PRESENCIAL' => $row['HORAS_PRESENCIAL'], 'HORAS_TELEFORMACION' => $row['HORAS_TELEFORMACION']),
		
		//HAY QUE GENERAR CONSULTAS
		'CENTROS_SESIONES_PRESENCIALES' => array( 
			'CENTRO_PRESENCIAL'=> $list1),
		// HAY QUE GENERAR LAS CONSULTAS PARA LOS TUTORES
		'TUTORES_FORMADORES' => array(
			'TUTOR_FORMADOR' => $list2),
			
		'USO' => array(
			'HORARIO_MANANA' => array(
				'NUM_PARTICIPANTES' => $row['NUM_PARTICIPANTES_M'], 
				'NUMERO_ACCESOS' => $row['NUMERO_ACCESOS_M'], 
				'DURACION_TOTAL' => $row['DURACION_TOTAL_M']),
			'HORARIO_TARDE' => array(
				'NUM_PARTICIPANTES' => $row['NUM_PARTICIPANTES_T'], 
				'NUMERO_ACCESOS' => $row['NUMERO_ACCESOS_T'], 
				'DURACION_TOTAL' => $row['DURACION_TOTAL_T']),
			'HORARIO_NOCHE' => array(
				'NUM_PARTICIPANTES' => $row['NUM_PARTICIPANTES_N'], 
				'NUMERO_ACCESOS' => $row['NUMERO_ACCESOS_N'], 
				'DURACION_TOTAL' => $row['DURACION_TOTAL_N']),
			'SEGUIMIENTO_EVALUACION' => array(
				'NUM_PARTICIPANTES' => $row['NUM_PARTICIPANTES_S'], 
				'NUMERO_ACTIVIDADES_APRENDIZAJE' => $row['NUMERO_ACTIVIDADES_APRENDIZAJE_S'], 
				'NUMERO_INTENTOS' => $row['NUMERO_INTENTOS_S'], 
				'NUMERO_ACTIVIDADES_EVALUACION' => $row['NUMERO_ACTIVIDADES_EVALUACION_S']))
		
		);
		
			 
				
	  }
	    
				
	
			
		  
			
	
	
	
		
	
			
				

		
				////////////////////////////////////////////////////////////////////////////////		
						
						
					$list31 = array();	
		$consultaParticipante2 = "SELECT * from participante WHERE REF_ACCION = '".$id."'";
		$resultadoParticipante2 = mysql_query($consultaParticipante2);
		$espe_part2=mysql_fetch_array($resultadoParticipante2);
		$c31= "SELECT * FROM especialidad_participante WHERE REF_PARTICIPANTE='".$espe_part2["ID_PARTICIPANTE"]."'";
		
		$r31=mysql_query($c31) or die(mysql_error());
		
		
		while($row31 = mysql_fetch_assoc($r31)){ 
		
		array_push($list31, array(
		
			
							
								'ID_ESPECIALIDAD' => array('ORIGEN_ESPECIALIDAD'  => $row31['ORIGEN_ESPECIALIDAD'], 'AREA_PROFESIONAL' => $row31['AREA_PROFESIONAL'], 'CODIGO_ESPECIALIDAD' => $row31['CODIGO_ESPECIALIDAD']),
									'FECHA_ALTA'  => $row31['FECHA_ALTA'], 
									'FECHA_BAJA' => $row31['FECHA_BAJA'],
									'TUTORIAS_PRESENCIALES' => array(
										'TUTORIA_PRESENCIAL' => array (
										'CENTRO_PRESENCIAL_TUTORIA' => array('ORIGEN_CENTRO'  => $row31['ORIGEN_CENTRO'], 'CODIGO_CENTRO' => $row31['CODIGO_CENTRO']),
		  								'FECHA_INICIO'  => $row31['FECHA_INICIO_T'], 
		 							    'FECHA_FIN' => $row31['FECHA_FIN_T'])),											
									'EVALUACION_FINAL' => array(
											'CENTRO_PRESENCIAL_EVALUACION' => array('ORIGEN_CENTRO'  => $row31['ORIGEN_CENTRO_EX'], 'CODIGO_CENTRO' => $row31['CODIGO_CENTRO_EX']),
											'FECHA_INICIO'  => $row31['FECHA_INICIO_EX'], 
											'FECHA_FIN' => $row31['FECHA_FIN_EX']),
									'RESULTADOS' => array(
											'RESULTADO_FINAL' => $row31['RESULTADO_FINAL'],
											'CALIFICACION_FINAL'  => $row31['CALIFICACION_FINAL'], 
											'PUNTUACION_FINAL' => $row31['PUNTUACION_FINAL'])			
									
							));	
							
					}
		 
		$list3 = array();
		$consultaParticipante = "SELECT * from participante WHERE REF_ACCION = '".$id."'";
		$resultadoParticipante = mysql_query($consultaParticipante);
		
		
		while($row3 = mysql_fetch_assoc($resultadoParticipante)) {
		  
			
    	array_push($list3, array(
		
		 			
							'ID_PARTICIPANTE' => array('TIPO_DOCUMENTO'  => $row3['TIPO_DOCUMENTO'], 'NUM_DOCUMENTO' => $row3['NUM_DOCUMENTO'], 'LETRA_NIF' => $row3['LETRA_NIF']),
							'INDICADOR_COMPETENCIAS_CLAVE'  => $row3['INDICADOR_COMPETENCIAS_CLAVE'],
							'CONTRATO_FORMACION' => array(
								'ID_CONTRATO_CFA' => $row3['ID_CONTRATO_CFA'],
								'CIF_EMPRESA' => $row3['CIF_EMPRESA'],
								'ID_TUTOR_EMPRESA' => array('TIPO_DOCUMENTO'  => $row3['TIPO_DOCUMENTO_TE'], 'NUM_DOCUMENTO' => $row3['NUM_DOCUMENTO_TE'], 'LETRA_NIF' => $row3['LETRA_NIF_TE']),
								'ID_TUTOR_FORMACION' => array('TIPO_DOCUMENTO'  => $row3['TIPO_DOCUMENTO_TF'], 'NUM_DOCUMENTO' => $row3['NUM_DOCUMENTO_TF'], 'LETRA_NIF' => $row3['LETRA_NIF_TF'])),
							'ESPECIALIDADES_PARTICIPANTE' => array('ESPECIALIDAD' => $list31)								
								
								
								
								));  
		}
		
		
					
		

         return array('RESPUESTA_OBT_ACCION' => array( 
            'CODIGO_RETORNO' => 0,
            'ETIQUETA_ERROR' => "Correcto", 
			'ACCION_FORMATIVA' => array(
               'ID_ACCION' => array('ORIGEN_ACCION' => $res['ORIGEN_ACCION'], 'CODIGO_ACCION' => $res['CODIGO_ACCION']),
                'SITUACION' => $res['SITUACION'],
                'ID_ESPECIALIDAD_PRINCIPAL' => array('ORIGEN_ESPECIALIDAD' => $res['ORIGEN_ESPECIALIDAD'], 'AREA_PROFESIONAL' => $res['AREA_PROFESIONAL'], 'CODIGO_ESPECIALIDAD' => $res['CODIGO_ESPECIALIDAD']),
                'DURACION' => $res['DURACION'],
                'FECHA_INICIO' => $res['FECHA_INICIO'],
				'FECHA_FIN' => $res['FECHA_FIN'],
				'IND_ITINERARIO_COMPLETO' => $res['IND_ITINERARIO_COMPLETO'],
				'TIPO_FINANCIACION' => $res['TIPO_FINANCIACION'],
				'NUMERO_ASISTENTES' => $res['NUMERO_ASISTENTES'],
				'DESCRIPCION_ACCION' => array('DENOMINACION_ACCION' => $res['DENOMINACION_ACCION'], 'INFORMACION_GENERAL' => $res['INFORMACION_GENERAL'], 'HORARIOS' => $res['HORARIOS'], 'REQUISITOS' => $res['REQUISITOS'], 'CONTACTO_ACCION' => $res['CONTACTO_ACCION']),
				'ESPECIALIDADES_ACCION' => array('ESPECIALIDAD' => $list),
				'PARTICIPANTES' => array ('PARTICIPANTE' => $list3)					
							)));
				
			 }	
		  }
		

function obtenerListaAcciones() {

    $sql = " SELECT * FROM accion_formativa WHERE id>0";
    $list = array();
$results = mysql_query($sql);



while($row = mysql_fetch_assoc($results)) {
		 
			
    	array_push($list, array('ORIGEN_ACCION' => $row['ORIGEN_ACCION'], 'CODIGO_ACCION' => $row['CODIGO_ACCION']));

}


            		 
			
   			 
			return array('RESPUESTA_OBT_LISTA_ACCIONES' => array(
			'CODIGO_RETORNO' => 0,
           'ETIQUETA_ERROR' => "Correcto",
			'ID_ACCION' => $list));
			
				
			         
		       
			
		
			
		
          

			

       
		  
		  
		  
		  }
		  
function eliminarAccion($accion) {
	
    $consultaAccion = "SELECT * from accion_formativa WHERE ORIGEN_ACCION = '".$accion["ORIGEN_ACCION"]."' AND CODIGO_ACCION = '".$accion["CODIGO_ACCION"]."'";
		$resultadoNuevaAccion = mysql_query($consultaAccion);
		$naccion = mysql_fetch_array($resultadoNuevaAccion);
		$id = $naccion["id"];
				
		
		
		$consultaBorrado="DELETE FROM accion_formativa WHERE accion_formativa.id = '".$id."'";	         
		   $borradoAccion=mysql_query($consultaBorrado);   
		
		$consultaBorrado1="DELETE FROM especialidad WHERE REF_ACCION = '".$id."'";	         
		   $borradoAccion1=mysql_query($consultaBorrado1); 
		
		$consultaBorrado12="DELETE FROM centro_presencial WHERE REF_ACCION = '".$id."'";	         
		   $borradoAccion12=mysql_query($consultaBorrado12); 
		
		$consultaBorrado121="DELETE FROM esp_centro_presencial WHERE REF_ACCION = '".$id."'";	         
		   $borradoAccion121=mysql_query($consultaBorrado121); 
		   
		$consultaBorrado13="DELETE FROM tutor_formador WHERE REF_ACCION = '".$id."'";	         
		   $borradoAccion13=mysql_query($consultaBorrado13);    
		 
		 $consultaBorrado2="DELETE FROM participante WHERE REF_ACCION = '".$id."'";	         
		   $borradoAccion2=mysql_query($consultaBorrado2);  
		   
		 $consultaBorrado2="DELETE FROM especialidad_participante WHERE REF_ACCION = '".$id."'";	         
		   $borradoAccion2=mysql_query($consultaBorrado2);  
		   
		 
			
			return array('RESPUESTA_ELIMINAR_ACCION' => array(
			'CODIGO_RETORNO' => '0',
          //  'ETIQUETA_ERROR' => "Correcto",
			));
			
		
          

			

       
		  
		  
		  
		  }
			 




$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$server->service($HTTP_RAW_POST_DATA);





?> 