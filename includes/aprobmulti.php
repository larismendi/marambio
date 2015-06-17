<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1 && $tipo_usuario != 2){
	header ("Location: ../index.php");
	exit;
}

if($tipo_usuario == 1){
	require_once('../1/Connections/marambio.php');
}elseif($tipo_usuario == 2){
	require_once('../2/Connections/marambio.php');
}else{
	echo false;
	exit;
}

extract($_REQUEST);

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);

$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

if(isset($_POST['aproRep'])){
	if($_POST['aproRep']){
		$param = array();
		$i = $v = 0;
		foreach($_POST['aproRep'] as $id => $valor){
			$param[$valor['name']]=$valor['value'];
			if(preg_match("/A/i",$valor['name']))
				$v++;
			if(preg_match("/D/i",$valor['name']) && $valor['value'])
				$i++;
		}
		if($i || $v){
			$updateSQL = sprintf("UPDATE quincenasub SET ".
				(isset($param['D01'])?sprintf("D01=%s, ",GetSQLValueString($param['D01'], "double")):"").
				(isset($param['D02'])?sprintf("D02=%s, ",GetSQLValueString($param['D02'], "double")):"").
				(isset($param['D03'])?sprintf("D03=%s, ",GetSQLValueString($param['D03'], "double")):"").
				(isset($param['D04'])?sprintf("D04=%s, ",GetSQLValueString($param['D04'], "double")):"").
				(isset($param['D05'])?sprintf("D05=%s, ",GetSQLValueString($param['D05'], "double")):"").
				(isset($param['D06'])?sprintf("D06=%s, ",GetSQLValueString($param['D06'], "double")):"").
				(isset($param['D07'])?sprintf("D07=%s, ",GetSQLValueString($param['D07'], "double")):"").
				(isset($param['D08'])?sprintf("D08=%s, ",GetSQLValueString($param['D08'], "double")):"").
				(isset($param['D09'])?sprintf("D09=%s, ",GetSQLValueString($param['D09'], "double")):"").
				(isset($param['D10'])?sprintf("D10=%s, ",GetSQLValueString($param['D10'], "double")):"").
				(isset($param['D11'])?sprintf("D11=%s, ",GetSQLValueString($param['D11'], "double")):"").
				(isset($param['D12'])?sprintf("D12=%s, ",GetSQLValueString($param['D12'], "double")):"").
				(isset($param['D13'])?sprintf("D13=%s, ",GetSQLValueString($param['D13'], "double")):"").
				(isset($param['D14'])?sprintf("D14=%s, ",GetSQLValueString($param['D14'], "double")):"").
				(isset($param['D15'])?sprintf("D15=%s, ",GetSQLValueString($param['D15'], "double")):"").
				(isset($param['D16'])?sprintf("D16=%s, ",GetSQLValueString($param['D16'], "double")):"").
				(isset($param['D17'])?sprintf("D17=%s, ",GetSQLValueString($param['D17'], "double")):"").
				(isset($param['D18'])?sprintf("D18=%s, ",GetSQLValueString($param['D18'], "double")):"").
				(isset($param['D19'])?sprintf("D19=%s, ",GetSQLValueString($param['D19'], "double")):"").
				(isset($param['D20'])?sprintf("D20=%s, ",GetSQLValueString($param['D20'], "double")):"").
				(isset($param['D21'])?sprintf("D21=%s, ",GetSQLValueString($param['D21'], "double")):"").
				(isset($param['D22'])?sprintf("D22=%s, ",GetSQLValueString($param['D22'], "double")):"").
				(isset($param['D23'])?sprintf("D23=%s, ",GetSQLValueString($param['D23'], "double")):"").
				(isset($param['D24'])?sprintf("D24=%s, ",GetSQLValueString($param['D24'], "double")):"").
				(isset($param['D25'])?sprintf("D25=%s, ",GetSQLValueString($param['D25'], "double")):"").
				(isset($param['D26'])?sprintf("D26=%s, ",GetSQLValueString($param['D26'], "double")):"").
				(isset($param['D27'])?sprintf("D27=%s, ",GetSQLValueString($param['D27'], "double")):"").
				(isset($param['D28'])?sprintf("D28=%s, ",GetSQLValueString($param['D28'], "double")):"").
				(isset($param['D29'])?sprintf("D29=%s, ",GetSQLValueString($param['D29'], "double")):"").
				(isset($param['D30'])?sprintf("D30=%s, ",GetSQLValueString($param['D30'], "double")):"").
				(isset($param['D31'])?sprintf("D31=%s, ",GetSQLValueString($param['D31'], "double")):"").
				"A01=%s, A02=%s, A03=%s, A04=%s, A05=%s, A06=%s, A07=%s, A08=%s, A09=%s, A10=%s, A11=%s, A12=%s, A13=%s, A14=%s, A15=%s, A16=%s, A17=%s, A18=%s, A19=%s, A20=%s, A21=%s, A22=%s, A23=%s, A24=%s, A25=%s, A26=%s, A27=%s, A28=%s, A29=%s, A30=%s, A31=%s, ".
				(isset($idQuienEs2000)?sprintf("APROBADO=%s ",GetSQLValueString($idQuienEs2000, "int")):"")." WHERE IdQnaSub=%s",
					   GetSQLValueString(isset($param['A01']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A02']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A03']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A04']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A05']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A06']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A07']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A08']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A09']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A10']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A11']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A12']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A13']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A14']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A15']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A16']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A17']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A18']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A19']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A20']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A21']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A22']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A23']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A24']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A25']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A26']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A27']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A28']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A29']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A30']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($param['A31']) ? "true" : "", "defined","1","0"),
					   GetSQLValueString($param['IdQnaSub'], "int"));
			
			if(mysql_query($updateSQL, $marambio) or die(mysql_error())){
				
				$query_usu = "SELECT Nombre, IdUnidad, Cargo, Nivel FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
				$usuData = mysql_query($query_usu, $marambio) or die(mysql_error());
				$row_usu = mysql_fetch_assoc($usuData);
				
				if($row_usu['Nivel']>2){
					$query_qna = "SELECT t.*, q.Quincena FROM quincenasub qs, quincenas q, tareas t WHERE qs.IdQna = q.IdQna AND qs.CodificacionComp = t.IdTarea AND qs.IdQnaSub = '".$param['IdQnaSub']."'";
					$qnaData = mysql_query($query_qna, $marambio) or die(mysql_error());
					$row_qna = mysql_fetch_assoc($qnaData);
					
					$cuerpo = "El ".$row_usu['Cargo']." ".$row_usu['Nombre']." completo la tareas ".$row_qna['CodificacionComp']." ".$row_qna['MesEjecucion']."/".$row_qna['AnnoEjecucion']." Qna ".$row_qna['Quincena'].". <a href='http://201.211.173.69/2/verQnaPersonal.php?Id=".$row_qna['IdTarea']."'>http://201.211.173.69/2/verQnaPersonal.php?Id=".$row_qna['IdTarea']."</a>";
					
					$email_mg = "";
					if($row_usu['IdUnidad']==10 || $row_usu['IdUnidad']==11){
						$email_mg = "jpinero@mg.com.ve";
					}
					if($row_usu['IdUnidad']==12 || $row_usu['IdUnidad']==17){
						$email_mg = "esandia@mg.com.ve";
					}
					
					if($email_mg){
						require_once dirname(__FILE__) . 'lib/swift_required.php';
						
						$smtp = "secure.emailsrvr.com";
						$port = 587;
						$usr = "control-horas@mg.com.ve";
						$pass = "12fedcba";
						
						$conn = Swift_SmtpTransport::newInstance($smtp, $port);
						$conn->setUsername($usr);
						$conn->setPassword($pass);
						
						$mailer = Swift_Mailer::newInstance($conn);
						
						$message = Swift_Message::newInstance("Notificacion de reporte aprobado.");
						$type = $message->getHeaders()->get('Content-Type');
						$type->setValue('text/html');
						$type->setParameter('charset', 'utf-8');
						$message->setBody($cuerpo);
						$message->setFrom(array($email_mg => 'Sistema reporte de tiempo'));
						$message->setTo(array($email));
						
						$mailer->send($message);
					}
				}
				echo true;
				exit;
			}
		}
	}
	echo false;
}
exit;
?>