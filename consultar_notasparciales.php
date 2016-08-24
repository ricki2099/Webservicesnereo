<?php
require("conexion_servidor_bd.php");
session_start();
$cod=$_SESSION['codigo'];
$consultar_registros=" SELECT DISTINCT
  INS_ASI_COD COD_ESPACIO,
  ASI_NOMBRE NOMBRE_ESPACIO,
  CUR_CRA_COD CODIGOCRA,CUR_GRUPO GRUPO,
  INS_EST_COD COD_EST,
  EST_NOMBRE NOMBRE_ESTUDIANTE,
  ELT (NOB_NOMBRE,'SIN OBSERVACION','',NOB_NOMBRE) OBS,
  INS_ANO ANO,
  INS_PER PERIODO,
  CUR_PAR1 PPAR,
  INS_NOTA_PAR1 NOTA_PAR1,
  CUR_PAR2 PPAR2,
  INS_NOTA_PAR2 NOTA_PAR2,
  CUR_PAR3 PPAR3,
  INS_NOTA_PAR3 NOTA_PAR3,
  CUR_PAR4 PPAR4,
  INS_NOTA_PAR4 NOTA_PAR4,
  CUR_PAR5 PPAR5,
  INS_NOTA_PAR5 NOTA_PAR5,
  CUR_PAR6 PPAR6,
  INS_NOTA_PAR6 NOTA_PAR6,
  CUR_LAB PLAB,
  INS_NOTA_LAB NOTA_LAB,
  CUR_EXA PEXA,
  INS_NOTA_EXA NOTA_EXA,
  CUR_HAB PHAB,
  INS_NOTA_HAB NOTA_HAB,
  INS_NOTA_ACU NOTA_ACUM,
  INS_NOTA NOTA_DEF,  
  INS_TOT_FALLAS FALLAS,
  DOC_NOMBRE DOCNOMBRE ,DOC_APELLIDO DOCENTEAPE
  FROM acins
INNER JOIN accursos ON CUR_ID=INS_GR
INNER JOIN achorarios ON HOR_ID_CURSO=CUR_ID
INNER JOIN accest ON EST_COD=INS_EST_COD
INNER JOIN acasi ON ASI_COD=INS_ASI_COD
INNER JOIN acasperi ON APE_ANO=INS_ANO AND APE_PER=INS_PER
LEFT OUTER JOIN acnotobs ON NOB_COD=INS_OBS
LEFT OUTER JOIN accargas ON CAR_HOR_ID=HOR_ID
LEFT OUTER JOIN acdocente ON DOC_NRO_IDEN=CAR_DOC_NRO
WHERE HOR_ESTADO='A'
AND APE_ESTADO='A'
AND EST_COD IN (20122078098)
ORDER BY INS_ANO,INS_PER,INS_EST_COD,INS_ASI_COD,CUR_CRA_COD||'-'||CUR_GRUPO;";
$registros=mysql_db_query("l6000018_nereo",$consultar_registros,$conectado) or die(" No se puede ejecutar la consulta:". mysql_error());

while ($tabla=mysql_fetch_array($registros)){
	$datos[]=$tabla;
	}

echo json_encode($datos);

?>