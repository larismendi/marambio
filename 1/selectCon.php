<?php  
session_start();
require_once('Connections/marambio.php'); 
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1){
	header ("Location: ../index.php"); 
}

mysql_select_db($database_marambio, $marambio);

$query_empresaList = sprintf("SELECT * FROM empresas WHERE CodGrupo = '".$_GET['id']."' ", $colname_empresaList);
$empresaList = mysql_query($query_empresaList, $marambio) or die(mysql_error());
$row_empresaList = mysql_fetch_assoc($empresaList);

  	if ($row_empresaList > 0){
		
		$con=0;
?>
			<select name="IdEmpresax" id="IdEmpresax" onchange="javascript:cargarTabla(this)" >    
			<option value="">Seleccione</option>
			<?php
  			do{ 
			?>
                  <option value="<?php echo $row_empresaList['CodEmp']; ?>"><?php echo utf8_encode($row_empresaList['Nombre']); ?></option>
            <?php 
			}while ( $row_empresaList = mysql_fetch_assoc($empresaList) ); 
			?>
           </select> 
              <?php
			
		}
	else
		{
?>
No hay Empresas asociadas al grupo
<?php	 
		}
?>