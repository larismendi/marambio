<?php 
require_once('Connections/marambio.php');
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 5){
	header ("Location: ../index.php"); 
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);
$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_super = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$super = mysql_query($query_super, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($super);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE quincenasub SET D01=%s, D02=%s, D03=%s, D04=%s, D05=%s, D06=%s, D07=%s, D08=%s, D09=%s, D10=%s, D11=%s, D12=%s, D13=%s, D14=%s, D15=%s, D16=%s, D17=%s, D18=%s, D19=%s, D20=%s, D21=%s, D22=%s, D23=%s, D24=%s, D25=%s, D26=%s, D27=%s, D28=%s, D29=%s, D30=%s, D31=%s, A01=%s, A02=%s, A03=%s, A04=%s, A05=%s, A06=%s, A07=%s, A08=%s, A09=%s, A10=%s, A11=%s, A12=%s, A13=%s, A14=%s, A15=%s, A16=%s, A17=%s, A18=%s, A19=%s, A20=%s, A21=%s, A22=%s, A23=%s, A24=%s, A25=%s, A26=%s, A27=%s, A28=%s, A29=%s, A30=%s, A31=%s, APROBADO=%s WHERE IdQnaSub=%s",
                       GetSQLValueString($_POST['D01'], "double"),
                       GetSQLValueString($_POST['D02'], "double"),
                       GetSQLValueString($_POST['D03'], "double"),
                       GetSQLValueString($_POST['D04'], "double"),
                       GetSQLValueString($_POST['D05'], "double"),
                       GetSQLValueString($_POST['D06'], "double"),
                       GetSQLValueString($_POST['D07'], "double"),
                       GetSQLValueString($_POST['D08'], "double"),
                       GetSQLValueString($_POST['D09'], "double"),
                       GetSQLValueString($_POST['D10'], "double"),
                       GetSQLValueString($_POST['D11'], "double"),
                       GetSQLValueString($_POST['D12'], "double"),
                       GetSQLValueString($_POST['D13'], "double"),
                       GetSQLValueString($_POST['D14'], "double"),
                       GetSQLValueString($_POST['D15'], "double"),
                       GetSQLValueString($_POST['D16'], "double"),
                       GetSQLValueString($_POST['D17'], "double"),
                       GetSQLValueString($_POST['D18'], "double"),
                       GetSQLValueString($_POST['D19'], "double"),
                       GetSQLValueString($_POST['D20'], "double"),
                       GetSQLValueString($_POST['D21'], "double"),
                       GetSQLValueString($_POST['D22'], "double"),
                       GetSQLValueString($_POST['D23'], "double"),
                       GetSQLValueString($_POST['D24'], "double"),
                       GetSQLValueString($_POST['D25'], "double"),
                       GetSQLValueString($_POST['D26'], "double"),
                       GetSQLValueString($_POST['D27'], "double"),
                       GetSQLValueString($_POST['D28'], "double"),
                       GetSQLValueString($_POST['D29'], "double"),
                       GetSQLValueString($_POST['D30'], "double"),
                       GetSQLValueString($_POST['D31'], "double"),
                       GetSQLValueString(isset($_POST['A01']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A02']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A03']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A04']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A05']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A06']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A07']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A08']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A09']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A10']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A11']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A12']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A13']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A14']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A15']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A16']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A17']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A18']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A19']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A20']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A21']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A22']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A23']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A24']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A25']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A26']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A27']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A28']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A29']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A30']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A31']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($idQuienEs2000, "int"),
                       GetSQLValueString($_POST['IdQnaSub'], "int"));

  $Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());
  
  $todas=0;

  $updateGoTo = "verQnaPersonal.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
if($todas==1) {
	if($enviado!=1) {
		$sii=1;
		$updateSQL = sprintf("UPDATE quincenasub SET A01=%s, A02=%s, A03=%s, A04=%s, A05=%s, A06=%s, A07=%s, A08=%s, A09=%s, A10=%s, A11=%s, A12=%s, A13=%s, A14=%s, A15=%s, A16=%s, A17=%s, A18=%s, A19=%s, A20=%s, A21=%s, A22=%s, A23=%s, A24=%s, A25=%s, A26=%s, A27=%s, A28=%s, A29=%s, A30=%s, A31=%s, APROBADO=%s WHERE IdQnaSub=%s",
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($idQuienEs2000, "int"),
		       GetSQLValueString($IdQnaSub, "int"));

  		$Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());

		$updateGoTo = "verQnaPersonal.php";
		if (isset($_SERVER['QUERY_STRING'])) {
		  $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
		  $updateGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $updateGoTo));
                exit;
  } 
}

$colname_Qna = "1";
if (isset($Id)) {
  $colname_tar = (get_magic_quotes_gpc()) ? $Id : addslashes($Id);
}
$query_Tar = sprintf("SELECT * FROM tareas WHERE IdTarea = %s", $colname_tar);
$Tar = mysql_query($query_Tar, $marambio) or die(mysql_error());
$row_Tar = mysql_fetch_assoc($Tar);

$query_QnaSub = "SELECT q.IdQna, q.Quincena, q.Mes, q.Anno, u.Nombre AS User, t.CodificacionComp AS codigo, s.Servicio, e.Nombre AS Empresa, qs.* FROM quincenasub AS qs LEFT JOIN quincenas AS q ON qs.IdQna = q.IdQna LEFT JOIN usuarios AS u ON qs.IdUsuario = u.IdUsuario LEFT JOIN tareas AS t ON t.IdTarea = qs.CodificacionComp LEFT JOIN servicios AS s ON s.IdServicio = t.IdServicio LEFT JOIN empresas AS e ON e.CodEmp = t.IdEmpresa WHERE qs.CodificacionComp = '".$colname_tar."' AND qs.TipoTarea='1'";
$QnaSub = mysql_query($query_QnaSub, $marambio) or die(mysql_error());
$row_QnaSub = mysql_fetch_assoc($QnaSub);

$NQda=$row_QnaSub['Quincena'];
$MesQna=$row_QnaSub['Mes'];
$AnnoQna=$row_QnaSub['Anno'];

?>
<?php
function ultimoDia($mes,$ano){ 
    $ultimo_dia=28; 
    while (checkdate($mes,$ultimo_dia + 1,$ano)){ 
       $ultimo_dia++; 
    } 
    return $ultimo_dia; 
} 
//calculo el ?ltimo dia del mes 
$mesX=$row_QnaSub['Mes'];
$annoX=$row_QnaSub['Anno'];

$ultimo_dia = ultimoDia("$mesX","$annoX");

?>
<?php include("includes/head.php"); ?>
<script src="../includes/facebox/lib/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('#actionAprobReport').click(function(){
		if(confirm('Desea aprobar las horas seleccionadas?')){
            var pass=0;
            var fields = $(".aproRep").serializeArray();
            jQuery.each(fields, function(i, field){
				var opc = $('form[name=form'+$('input[name="'+field.name+'"]').attr('id')+']').serializeArray();
				$.post("../includes/aprobmulti.php", { aproRep: opc },
				function(data) {
							if(data){
					pass=pass+1;
							}
				});
            });
            if(pass==0){
                alert('Se aprobo la tarea satisfactoriamente.');
                location.reload();
            }else
                alert('No se puedo aprobar la tarea, intente nuevamente en un momento.');
		}
	});	
});
</script>
<script language="JavaScript" src="mm_menu.js">
function valida(form)
{
	for (i =0 ; form.elements.length > i ; i++)
	{
		cadena = form.elements[i].name.substring(0,1);
		if(cadena == 'D')
		{
			form.elements[i].style.backgroundColor='#ffffff';
		}
	}
	for (i =0 ; form.elements.length > i ; i++)
	{
		cadena = form.elements[i].name.substring(0,1);
		if(form.elements[i].value == "" && cadena == 'D')
		{
			form.elements[i].style.backgroundColor='Pink';			
		}
	}
	return false;	
}
</script>
<script language="JavaScript1.2">mmLoadMenus();</script>
<script type="text/javascript">
$(function(){
   $('.ApruebaTarea').click(function(){
	   if(confirm('Desea aprobar las horas seleccionadas?')){
		   var parametros = $(this).attr('href').split('?');       
		   $.ajax({
			   type: "GET",
			   url: parametros[0],
			   data: parametros[1],
			   success: function(msg){
				   $('#status_aprobo').attr('value',1);
				   alert("Se Aprobaron las horas de la tarea.");
				   location.reload();
			   }
		   });
	   }
       return false;
   });
   $('#btnclose').click(function(){
	  $('#suggestions').fadeOut('slow');
	  $.ajax({
           type: "POST",
           url: "administracion.php",
           data: "closeTooltip=1"
       });
  });  
  $('#orden').change(function(){
	  if($('#orden').val()==1)
		$('[name*="aprobaReport["]').attr('checked', true);
	  if($('#orden').val()==2)
		$('[name*="aprobaReport["]').attr('checked', false);
	  if($('#orden').val()==3){
	    $('[name*="A"]').attr('checked', true);
		$('[name*="aprobaReport["]').attr('checked', true);
	  }
  });
});
</script>
<style type="text/css">
    .colU div{
        width: 130px;
    }
    .col1 div{
        width: 77px;
    }
    .colP div{
        width: 80px;
    }
    .col2 div{
        width: 45px;
    }
    .col3 div{
        width: 30px;
    }
    .col4 div{
        width: 20px;
    }
    .col5{
        width: 34px;
    }
    form{
        margin-top:0;
        margin-bottom:0;
    }
    tr.filaverde{
        background:green;        
    }
    tr.filaverde div.texto_btgris{
        color:#FFF !important;
    }
    td.col4 div input{
        width: 22px;
    }
    .tablainfo{
        width: 890px;
        float: right;
        margin-right: 160px;
    }
    input.texto_btgris{
        width: 20px;
    }
</style>
<link href="autoComplete/estilo_auto_relativo.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" align="left">
   <tr>
     <td width="33%"><span class="texto_btgris">
     Codigo: <?php echo $row_QnaSub['codigo']; ?><br>
     Servicio: <?php echo $row_QnaSub['Servicio']; ?><br>
     Empresa: <?php echo $row_QnaSub['Empresa']; ?><br></span>
     </td>
     <td width="44%" valign="bottom"><div align="center"></div></td>
     <td width="23%" valign="top"><div align="right"></div></td>
   </tr>
</table>
<br/>
<table><tr><td><a href="tiempoxProyecto.php?buscarPro=1" class="texto_gris">&lt;&lt; Volver </a></strong></td></tr></table>
<p class="textoazul">
    <span class="titulo">HORAS CLIENTE</span>
</p>
<?php //TABLA DE TAREAS CLIENTES ?>
<?php if($row_QnaSub>=1) { ?>
<div style="">
<table height="52" border="1" class="tablainfo">
   <tr bgcolor="#E5E5E5" class="texto_btgris">
       <td class="col1"><div align="center">Empleado</div></td>
       <td class="col2"><div align="center">Aprobar</div></td>
       <td class="col3"><div align="center">Total<br>
       Horas</div></td>
	 <?php
            $FerArray = array();
            $query_feriado = "SELECT * FROM feriados";
            $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
            while($row_Feriado = mysql_fetch_assoc($feriado)){
                $FerArray[] = $row_Feriado["ORDEN"];
            }
            
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("01"), date("$AnnoQna")) , 1 ); 						
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '01', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">01</div></td>
	 <?php 
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("02"), date("$AnnoQna")) , 1 );		
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '02', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">02</div></td>
	 <?php 			  
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("03"), date("$AnnoQna")) , 1 );				
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '03', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">03</div></td>
	 <?php 
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("04"), date("$AnnoQna")) , 1 ); 						
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '04', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">04</div></td>
	 <?php 			
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("05"), date("$AnnoQna")) , 1 ); 				
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '05', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">05</div></td>
	 <?php 				  
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("06"), date("$AnnoQna")) , 1 );				  
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '06', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">06</div></td>
	 <?php 			  
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("07"), date("$AnnoQna")) , 1 );						
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '07', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">07</div></td>
	 <?php 			
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("08"), date("$AnnoQna")) , 1 );				
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '08', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">08</div></td>
	 <?php				  
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("09"), date("$AnnoQna")) , 1 ); 						
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '09', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">09</div></td>
	 <?php
            $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("10"), date("$AnnoQna")) , 1 );						
            if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '10', $FerArray))) {
                    $ColorCelda="#B2C3DF";
            } else {
                    $ColorCelda="#FFFFFF";
            }
            @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">10</div></td>
	 <?php
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("11"), date("$AnnoQna")) , 1 );				  
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '11', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">11</div></td>
	 <?php
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("12"), date("$AnnoQna")) , 1 );				  
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '12', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">12</div></td>
	 <?php			  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("13"), date("$AnnoQna")) , 1 ); 						
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '13', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">13</div></td>
	 <?php			  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("14"), date("$AnnoQna")) , 1 );				  
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '14', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">14</div></td>
	 <?php		  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("15"), date("$AnnoQna")) , 1 );				  
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '15', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">15</div></td>
	 <?php 			  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("16"), date("$AnnoQna")) , 1 );				  
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '16', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">16</div></td>
	 <?php	  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("17"), date("$AnnoQna")) , 1 );				  
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '17', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">17</div></td>
	 <?php			  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("18"), date("$AnnoQna")) , 1 );				  
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '18', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">18</div></td>
	 <?php 				  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("19"), date("$AnnoQna")) , 1 ); 						
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '19', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">19</div></td>
	 <?php 			  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("20"), date("$AnnoQna")) , 1 );				  
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '20', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">20</div></td>
	 <?php 			  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("21"), date("$AnnoQna")) , 1 );				  
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '21', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">21</div></td>
	 <?php 
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("22"), date("$AnnoQna")) , 1 ); 
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '22', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">22</div></td>
	 <?php 
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("23"), date("$AnnoQna")) , 1 ); 						
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '23', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">23</div></td>
	 <?php 
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("24"), date("$AnnoQna")) , 1 ); 
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '24', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">24</div></td>
	 <?php 				  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("25"), date("$AnnoQna")) , 1 ); 			
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '25', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">25</div></td>
	 <?php 
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("26"), date("$AnnoQna")) , 1 ); 
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '26', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">26</div></td>
	 <?php 				  
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("27"), date("$AnnoQna")) , 1 ); 
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '27', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">27</div></td>
	 <?php 
			  $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("28"), date("$AnnoQna")) , 1 ); 						
			  if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '28', $FerArray))) {
				  $ColorCelda="#B2C3DF";
			  } else {
				  $ColorCelda="#FFFFFF";
			  }
			  @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">28</div></td>
	 
	 	<?php if($ultimo_dia>=29) { 				
                        $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("29"), date("$AnnoQna")) , 1 ); 
                        if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '29', $FerArray))) {
                                $ColorCelda="#B2C3DF";
                        } else {
                                $ColorCelda="#FFFFFF";
                        }
                        @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">29</div></td>
	 	<?php } ?>
	 	<?php if($ultimo_dia>=30) { 
                        $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("30"), date("$AnnoQna")) , 1 ); 						
                        if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '30', $FerArray))) {
                                $ColorCelda="#B2C3DF";
                        } else {
                                $ColorCelda="#FFFFFF";
                        }
                        @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">30</div></td>
	 	<?php } ?>
	 	<?php if($ultimo_dia>=31) {
				
                        $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("31"), date("$AnnoQna")) , 1 );					
                        if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR (in_array($MesQna . '31', $FerArray))) {
                                $ColorCelda="#B2C3DF";
                        } else {
                                $ColorCelda="#FFFFFF";
                        }
                        @mysql_free_result($feriado);
	?>
       <td class="col4" bgcolor="#FFFFFF"><div align="center">31</div></td>
	 	<?php } ?>
       <td class="col5" bgcolor="#FFFFFF"><div align="center">
       <select name="orden" id="orden" style="width:42px">
        <option value="0">Seleccione</option>
       	<option value="1">Todos los reportes</option>
        <option value="2">Ninguno de los reportes</option>
        <option value="3">Todas las checkbox</option>
       </select>
       </div></td>
       <td class="col5" bgcolor="#FFFFFF"><div align="center"></div></td>
   </tr>
</table>
   <?php
   	 $totalD01=''; $totalD02=''; $totalD03=''; $totalD04=''; $totalD05=''; $totalD06=''; $totalD07=''; $totalD08='';
	 $totalD09=''; $totalD10=''; $totalD11=''; $totalD12=''; $totalD13=''; $totalD14=''; $totalD15=''; $totalD16='';
	 $totalD17=''; $totalD18=''; $totalD19=''; $totalD20=''; $totalD21=''; $totalD22=''; $totalD23=''; $totalD24='';
	 $totalD25=''; $totalD26=''; $totalD27=''; $totalD28=''; $totalD29=''; $totalD30=''; $totalD31=''; $totalHorasTotal='';
   ?>
     <?php 
	    $xx = 4;
	    do { ?>
	 <?php
	 $totalD01=$totalD01+$row_QnaSub['D01'];
	 $totalD02=$totalD02+$row_QnaSub['D02'];
	 $totalD03=$totalD03+$row_QnaSub['D03'];
	 $totalD04=$totalD04+$row_QnaSub['D04'];
	 $totalD05=$totalD05+$row_QnaSub['D05'];
	 $totalD06=$totalD06+$row_QnaSub['D06'];
	 $totalD07=$totalD07+$row_QnaSub['D07'];
	 $totalD08=$totalD08+$row_QnaSub['D08'];
	 $totalD09=$totalD09+$row_QnaSub['D09'];
	 $totalD10=$totalD10+$row_QnaSub['D10'];
	 $totalD11=$totalD11+$row_QnaSub['D11'];
	 $totalD12=$totalD12+$row_QnaSub['D12'];
	 $totalD13=$totalD13+$row_QnaSub['D13'];
	 $totalD14=$totalD14+$row_QnaSub['D14'];
	 $totalD15=$totalD15+$row_QnaSub['D15'];
	 $totalD16=$totalD16+$row_QnaSub['D16'];
	 $totalD17=$totalD17+$row_QnaSub['D17'];
	 $totalD18=$totalD18+$row_QnaSub['D18'];
	 $totalD19=$totalD19+$row_QnaSub['D19'];
	 $totalD20=$totalD20+$row_QnaSub['D20'];
	 $totalD21=$totalD21+$row_QnaSub['D21'];
	 $totalD22=$totalD22+$row_QnaSub['D22'];
	 $totalD23=$totalD23+$row_QnaSub['D23'];
	 $totalD24=$totalD24+$row_QnaSub['D24'];
	 $totalD25=$totalD25+$row_QnaSub['D25'];
	 $totalD26=$totalD26+$row_QnaSub['D26'];
	 $totalD27=$totalD27+$row_QnaSub['D27'];
	 $totalD28=$totalD28+$row_QnaSub['D28'];
	 $totalD29=$totalD29+$row_QnaSub['D29'];
	 $totalD30=$totalD30+$row_QnaSub['D30'];
	 $totalD31=$totalD31+$row_QnaSub['D31'];	 
	 ?>
	 <?php  $TotalHorasXX=$row_QnaSub['D01']+$row_QnaSub['D02']+$row_QnaSub['D03']+$row_QnaSub['D04']+$row_QnaSub['D05']+$row_QnaSub['D06']+$row_QnaSub['D07']+$row_QnaSub['D08']+$row_QnaSub['D09']+$row_QnaSub['D10']+$row_QnaSub['D11']+$row_QnaSub['D12']+$row_QnaSub['D13']+$row_QnaSub['D14']+$row_QnaSub['D15']+$row_QnaSub['D16']+$row_QnaSub['D17']+$row_QnaSub['D18']+$row_QnaSub['D19']+$row_QnaSub['D20']+$row_QnaSub['D21']+$row_QnaSub['D22']+$row_QnaSub['D23']+$row_QnaSub['D24']+$row_QnaSub['D25']+$row_QnaSub['D26']+$row_QnaSub['D27']+$row_QnaSub['D28']+$row_QnaSub['D29']+$row_QnaSub['D30']+$row_QnaSub['D31'];
	 ?>
	 <?php //if ($TotalHorasXX != '0')  { ?>
	      <?php  $xx++; ?>
<form name="form<?=$xx ?>" id="form<?=$xx ?>" method="POST" action="<?=$editFormAction; ?>">
<table border="1" class="tablainfo">
    <tr class="texto_gris <?php if($row_QnaSub['APROBADO']){echo 'filaverde';}?>">
       <td class="colP"><div align="center" class="texto_btgris">
        <?php echo $row_QnaSub['User']; ?>
       </div></td>
       <td class="col2">
       	<div align="center"><a class="ApruebaTarea" href="verQnaPersonalSinHead.php?IdQnaSub=<?php echo $row_QnaSub['IdQnaSub']; ?>&IdQna=<?php echo $row_QnaSub['IdQna']; ?>&todas=1&IdUsuario=<?php echo $row_QnaSub['IdUsuario']; ?>"><img src="images/CheckCerrado.gif" width="22" height="17" border="0"></a><br>
       </div></td>
       <td class="col3">
           <div align="center" class="texto_btgris">
           <?php echo $TotalHorasXX;
	          $totalHorasTotal=$totalHorasTotal+$TotalHorasXX; ?>
           </div>
       </td>
       
       <td class="col4" align="center">
            <?php if($row_QnaSub['D01']!='') { ?>
            <input <?php if (!(strcmp($row_QnaSub['A01'],1))) {echo "checked";} ?> name="A01" type="checkbox" id="A01" value="<?php echo $row_QnaSub['A01']; ?>">
            <?php } ?>
            <br>
            <input name="D01" type="text" class="texto_btgris" id="D01" value="<?php echo $row_QnaSub['D01']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
            <?php if($row_QnaSub['D02']!='') { ?>
            <input <?php if (!(strcmp($row_QnaSub['A02'],1))) {echo "checked";} ?> name="A02" type="checkbox" id="A02" value="<?php echo $row_QnaSub['A02']; ?>">          
            <?php } ?>
            <br>
            <input name="D02" type="text" class="texto_btgris" id="D02" value="<?php echo $row_QnaSub['D02']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
	   <?php if($row_QnaSub['D03']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A03'],1))) {echo "checked";} ?> name="A03" type="checkbox" id="A03" value="<?php echo $row_QnaSub['A03']; ?>">
           <?php } ?>
	   <br>
           <input name="D03" type="text" class="texto_btgris" id="D03" value="<?php echo $row_QnaSub['D03']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D04']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A04'],1))) {echo "checked";} ?> name="A04" type="checkbox" id="A04" value="<?php echo $row_QnaSub['A04']; ?>">
           <?php } ?>
	   <br>
           <input name="D04" type="text" class="texto_btgris" id="D04" value="<?php echo $row_QnaSub['D04']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
	   <?php if($row_QnaSub['D05']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A05'],1))) {echo "checked";} ?> name="A05" type="checkbox" id="A05" value="<?php echo $row_QnaSub['A05']; ?>">
           <?php } ?>
	   <br>
           <input name="D05" type="text" class="texto_btgris" id="D05" value="<?php echo $row_QnaSub['D05']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
	   <?php if($row_QnaSub['D06']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A06'],1))) {echo "checked";} ?> name="A06" type="checkbox" id="A06">
           <?php } ?>
	   <br>
           <input name="D06" type="text" class="texto_btgris" id="D06" value="<?php echo $row_QnaSub['D06']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D07']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A07'],1))) {echo "checked";} ?> name="A07" type="checkbox" id="A07">
           <?php } ?>
	   <br>
           <input name="D07" type="text" class="texto_btgris" id="D07" value="<?php echo $row_QnaSub['D07']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
	   <?php if($row_QnaSub['D08']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A08'],1))) {echo "checked";} ?> name="A08" type="checkbox" id="A08">
            <?php } ?>    
	   <br>
           <input name="D08" type="text" class="texto_btgris" id="D08" value="<?php echo $row_QnaSub['D08']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
	   <?php if($row_QnaSub['D09']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A09'],1))) {echo "checked";} ?> name="A09" type="checkbox" id="A09">
           <?php } ?>   
	   <br>
           <input name="D09" type="text" class="texto_btgris" id="D09" value="<?php echo $row_QnaSub['D09']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D10']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A10'],1))) {echo "checked";} ?> name="A10" type="checkbox" id="A10">
           <?php } ?> 
	   <br>
           <input name="D10" type="text" class="texto_btgris" id="D10" value="<?php echo $row_QnaSub['D10']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
         <?php if($row_QnaSub['D11']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A11'],1))) {echo "checked";} ?> name="A11" type="checkbox" id="A11">
           <?php } ?>
	   <br>
           <input name="D11" type="text" class="texto_btgris" id="D11" value="<?php echo $row_QnaSub['D11']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D12']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A12'],1))) {echo "checked";} ?> name="A12" type="checkbox" id="A12">
           <?php } ?> 
	   <br>
           <input name="D12" type="text" class="texto_btgris" id="D12" value="<?php echo $row_QnaSub['D12']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D13']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A13'],1))) {echo "checked";} ?> name="A13" type="checkbox" id="A13">
           <?php } ?>  
	   <br>
           <input name="D13" type="text" class="texto_btgris" id="D13" value="<?php echo $row_QnaSub['D13']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D14']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A14'],1))) {echo "checked";} ?> name="A14" type="checkbox" id="A14">
           <?php } ?>  
	   <br>
           <input name="D14" type="text" class="texto_btgris" id="D14" value="<?php echo $row_QnaSub['D14']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D15']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A15'],1))) {echo "checked";} ?> name="A15" type="checkbox" id="A15">
           <?php } ?>
	   <br>
           <input name="D15" type="text" class="texto_btgris" id="D15" value="<?php echo $row_QnaSub['D15']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D16']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A16'],1))) {echo "checked";} ?> name="A16" type="checkbox" id="A16">
           <?php } ?>
	   <br>
           <input name="D16" type="text" class="texto_btgris" id="D16" value="<?php echo $row_QnaSub['D16']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D17']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A17'],1))) {echo "checked";} ?> name="A17" type="checkbox" id="A17">
           <?php } ?>  
	   <br>
           <input name="D17" type="text" class="texto_btgris" id="D17" value="<?php echo $row_QnaSub['D17']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D18']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A18'],1))) {echo "checked";} ?> name="A18" type="checkbox" id="A18">
           <?php } ?>
	   <br>
           <input name="D18" type="text" class="texto_btgris" id="D18" value="<?php echo $row_QnaSub['D18']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D19']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A19'],1))) {echo "checked";} ?> name="A19" type="checkbox" id="A19">
           <?php } ?>
	   <br>
           <input name="D19" type="text" class="texto_btgris" id="D19" value="<?php echo $row_QnaSub['D19']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D20']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A20'],1))) {echo "checked";} ?> name="A20" type="checkbox" id="A20">
           <?php } ?> 
	   <br>
           <input name="D20" type="text" class="texto_btgris" id="D20" value="<?php echo $row_QnaSub['D20']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D21']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A21'],1))) {echo "checked";} ?> name="A21" type="checkbox" id="A21">
           <?php } ?>  
	   <br>
           <input name="D21" type="text" class="texto_btgris" id="D21" value="<?php echo $row_QnaSub['D21']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D22']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A22'],1))) {echo "checked";} ?> name="A22" type="checkbox" id="A22">
           <?php } ?> 
	   <br>
           <input name="D22" type="text" class="texto_btgris" id="D22" value="<?php echo $row_QnaSub['D22']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D23']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A23'],1))) {echo "checked";} ?> name="A23" type="checkbox" id="A23">
           <?php } ?> 
	   <br>
           <input name="D23" type="text" class="texto_btgris" id="D23" value="<?php echo $row_QnaSub['D23']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D24']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A24'],1))) {echo "checked";} ?> name="A24" type="checkbox" id="A24">
           <?php } ?>
	   <br>
           <input name="D24" type="text" class="texto_btgris" id="D24" value="<?php echo $row_QnaSub['D24']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D25']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A25'],1))) {echo "checked";} ?> name="A25" type="checkbox" id="A25">
           <?php } ?>
	   <br>
           <input name="D25" type="text" class="texto_btgris" id="D25" value="<?php echo $row_QnaSub['D25']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D26']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A26'],1))) {echo "checked";} ?> name="A26" type="checkbox" id="A26">
           <?php } ?> 
	   <br>
           <input name="D26" type="text" class="texto_btgris" id="D26" value="<?php echo $row_QnaSub['D26']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D27']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A27'],1))) {echo "checked";} ?> name="A27" type="checkbox" id="A27">
           <?php } ?> 
	   <br>
           <input name="D27" type="text" class="texto_btgris" id="D27" value="<?php echo $row_QnaSub['D27']; ?>" size="1"/>
       </td>
       
       <td class="col4" align="center">
           <?php if($row_QnaSub['D28']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A28'],1))) {echo "checked";} ?> name="A28" type="checkbox" id="A28">
           <?php } ?>
	   <br>
           <input name="D28" type="text" class="texto_btgris" id="D28" value="<?php echo $row_QnaSub['D28']; ?>" size="1"/>
       </td>
       
       <?php if($ultimo_dia>=29) { ?>
       <td class="col4" align="center">
           <?php if($row_QnaSub['D29']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A29'],1))) {echo "checked";} ?> name="A29" type="checkbox" id="A29">
           <?php } ?>
	   <br>
           <input name="D29" type="text" class="texto_btgris" id="D29" value="<?php echo $row_QnaSub['D29']; ?>" size="1"/>
       </td>
       <?php } ?>
       
       <?php if($ultimo_dia>=30) { ?>
       <td class="col4" align="center">
           <?php if($row_QnaSub['D30']!='') { ?>
	   <input <?php if (!(strcmp($row_QnaSub['A30'],1))) {echo "checked";} ?> name="A30" type="checkbox" id="A30">
           <?php } ?>
	   <br>
           <input name="D30" type="text" class="texto_btgris" id="D30" value="<?php echo $row_QnaSub['D30']; ?>" size="1"/>
       </td>
       <?php } ?>
       
       <?php if($ultimo_dia>=31) { ?>
       <td class="col4" align="center">
           <?php if($row_QnaSub['D31']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A31'],1))) {echo "checked";} ?> name="A31" type="checkbox" id="A31">
           <?php } ?>  
	   <br>
           <input name="D31" type="text" class="texto_btgris" id="D31" value="<?php echo $row_QnaSub['D31']; ?>" size="1"/>
       </td>
       <?php } ?>
       <td class="col5" align="center"><input type="checkbox" name="aprobaReport[<?php echo $xx; ?>]" id="<?php echo $xx; ?>" value="<?php echo $row_QnaSub['IdQnaSub']; ?>" class="aproRep" title="Active para aprobaci?n masiva" /></td>
       <td class="col5"><div align="center">
           <input name="IdQnaSub" type="hidden" id="IdQnaSub" value="<?php echo $row_QnaSub['IdQnaSub']; ?>">
           <input name="enviado" type="hidden" id="enviado" value="1">
           <input name="Submit4" type="submit" class="texto_btgris" value="&gt;&gt;">
           <input type="hidden" name="MM_update" value="form1">
       </div></td>
     </tr>
</table>
</form>
	 <?php //} ?>
     <?php } while ($row_QnaSub = mysql_fetch_assoc($QnaSub)); ?>
<table class="tablainfo" border="1">
   <tr bgcolor="#EEEEEE">
       <td class="colU"><div align="right" class="titulo"><strong>Total Clientes</strong></div></td>
       <td class="col3"><div align="center" class="texto_btgris"><strong><?php echo $totalHorasTotal; ?>
       </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD01; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD02; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD03; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD04; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD05; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD06; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD07; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD08; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD09; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD10; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD11; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD12; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD13; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD14; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD15; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD16; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD17; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD18; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD19; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD20; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD21; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD22; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD23; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD24; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD25; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD26; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD27; ?>
          </strong></div></td>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD28; ?>
          </strong></div></td>
       <?php if($ultimo_dia>=29) { ?>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD29; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($ultimo_dia>=30) { ?>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD30; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($ultimo_dia>=31) { ?>
       <td class="col4"><div align="center" class="texto_btgris"><strong><?php echo $totalD31; ?>
          </strong></div></td>
       <?php } ?>
       <td class="col5"><div align="center" class="texto_btgris"><?/*<input type="button" name="actionAprobReport" id="actionAprobReport" value="&gt;&gt;" />*/?><img src="images/CheckCerrado.gif" style="cursor:pointer" name="actionAprobReport" id="actionAprobReport" width="22" height="17" border="0"><div class="suggestionsBox" id="suggestions" <?php if(isset($_SESSION['closeTooltip'])){echo 'style="display: none;"';}else{echo 'style="display: block;"';} ?>>
                  <img src="autoComplete/upArrow.png" style="position: relative; top: -12px; left: -80px;" alt="upArrow"/><img id="btnclose" src="../includes/facebox/src/close_icon.png" style="position: relative; top: -10px; left: 98px;cursor:pointer;" title="close" class="close_image"/>
                  <div class="suggestionList" id="autoSuggestionsList">Aprobaci&oacute;n de horas seleccionadas en reporte.<br/>
                  (Seleccione las horas a aprobar marcando el ckeckbox de la fila respectiva)</div></div></div></td>
       <td class="col5"><div align="center" class="texto_btgris" style="width:20px"></div></td>
   </tr>
</table>
</div>
<?php } ?>
</body>
</html>
<?php
@mysql_free_result($quienEs);
@mysql_free_result($QnaSub);
mysql_close($marambio);
?>