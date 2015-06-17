<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<STYLE type=text/css>
A:hover {
	COLOR: #AFC4DF
}
BODY {
	SCROLLBAR-FACE-COLOR: #FFFFFF; SCROLLBAR-HIGHLIGHT-COLOR: #AFC4DF; SCROLLBAR-SHADOW-COLOR: #FCEA9A; SCROLLBAR-ARROW-COLOR: #AFC4DF; SCROLLBAR-BASE-COLOR: #FCEA9A; scrollbar-3d-light-color: #AFC4DF; scrollbar-dark-shadow-color: #FFFFFF
}
</STYLE>
<title>Reporte del Tiempo Versi&oacute;n 3.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="stylos.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function mmLoadMenus() {
  if (window.mm_menu_0704161327_0) return;
  window.mm_menu_0704161327_0 = new Menu("root",102,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704161327_0.addMenuItem("Grupos","location='grupos.php'");
  mm_menu_0704161327_0.addMenuItem("Empresas","location='empresas.php'");
   mm_menu_0704161327_0.hideOnMouseOut=true;
   mm_menu_0704161327_0.bgColor='#555555';
   mm_menu_0704161327_0.menuBorder=0;
   mm_menu_0704161327_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704161327_0.menuBorderBgColor='#777777';

  window.mm_menu_0704161423_0 = new Menu("root",102,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704161423_0.addMenuItem("Unidades","location='unidades.php'");
  <?php //if($row_supervisor['Usuario']=='mvaldez'||$row_supervisor['Usuario']=='mperez'){?>mm_menu_0704161423_0.addMenuItem("Servicios","location='servicios.php'");<?php //}?>
  mm_menu_0704161423_0.addMenuItem("Administrativas","location='administrativas.php'");
  mm_menu_0704161423_0.addMenuItem("Tasas","location='tasas.php'");
  mm_menu_0704161423_0.addMenuItem("RRHH","location='rrhh.php'");
  mm_menu_0704161423_0.addMenuItem("Feriados","location='feriados.php'");
  mm_menu_0704161423_0.addMenuItem("Quincenas","location='quincenas.php'");
  mm_menu_0704161423_0.addMenuItem("Tareas","location='tareas.php'");
mm_menu_0704161423_0.addMenuItem("Orden de Fact","location='o_fact.php'");
mm_menu_0704161423_0.addMenuItem("Estad&iacute;sticas","location='estadisticas.php'");
   mm_menu_0704161423_0.hideOnMouseOut=true;
   mm_menu_0704161423_0.bgColor='#555555';
   mm_menu_0704161423_0.menuBorder=0;
   mm_menu_0704161423_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704161423_0.menuBorderBgColor='#777777';

  window.mm_menu_0704162558_0 = new Menu("root",102,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704162558_0.addMenuItem("Hoja&nbsp;de&nbsp;Tiempo","location='hojadeTiempo.php'");
   mm_menu_0704162558_0.hideOnMouseOut=true;
   mm_menu_0704162558_0.bgColor='#555555';
   mm_menu_0704162558_0.menuBorder=0;
   mm_menu_0704162558_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704162558_0.menuBorderBgColor='#777777';

  window.mm_menu_0704163337_0 = new Menu("root",112,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704163337_0.addMenuItem("Ver&nbsp;Tiempo","location='hojadeTiempoOtros.php'");
  mm_menu_0704163337_0.addMenuItem("Tiempo&nbsp;por&nbsp;Empleado","location='verQnaPersonalB.php'");
   mm_menu_0704163337_0.hideOnMouseOut=true;
   mm_menu_0704163337_0.bgColor='#555555';
   mm_menu_0704163337_0.menuBorder=0;
   mm_menu_0704163337_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704163337_0.menuBorderBgColor='#777777';

  window.mm_menu_0704163728_0 = new Menu("root",125,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704163728_0.addMenuItem("Tiempo&nbsp;por&nbsp;Proyecto","location='tiempoxProyecto.php'");
  mm_menu_0704163728_0.addMenuItem("Tiempo&nbsp;por&nbsp;Empleado","location='tiempoxQnaxEmpleado.php'");
  mm_menu_0704163728_0.addMenuItem("Asistente&nbsp;de&nbsp;Proyectos","location='aistentedeProyectos.php'");
  mm_menu_0704163728_0.addMenuItem("Proyectos L&iacute;der","location='ProyectosLider.php'");
  mm_menu_0704163728_0.addMenuItem("Listado por L&iacute;der","location='ListadoLider.php'");
  mm_menu_0704163728_0.addMenuItem("Listado por Divisi&oacute;n","location='ListadoUnidades.php'");
  mm_menu_0704163728_0.addMenuItem("Listado por Clientes","location='ListadoEmpresas.php'");
   mm_menu_0704163728_0.hideOnMouseOut=true;
   mm_menu_0704163728_0.bgColor='#555555';
   mm_menu_0704163728_0.menuBorder=0;
   mm_menu_0704163728_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704163728_0.menuBorderBgColor='#777777';
   
   window.mm_menu_0704163729_0 = new Menu("root",125,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
   mm_menu_0704163729_0.addMenuItem("Proyectos","location='ProyectosHistorico.php'");
   mm_menu_0704163729_0.hideOnMouseOut=true;
   mm_menu_0704163729_0.bgColor='#555555';
   mm_menu_0704163729_0.menuBorder=0;
   mm_menu_0704163729_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704163729_0.menuBorderBgColor='#777777';

   mm_menu_0704163728_0.writeMenus();
}
</script>
<script language="JavaScript" src="mm_menu.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" height="128"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="128" valign="top" class="textoazul Estilo1"><table width="103%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
              <tr>
                <td width="760" height="49" background="imagenes/pixel_azul.jpg" bgcolor="#ADC3DB"><table border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="right" class="texto_blanco">Reporte del Tiempo Versi&oacute;n 3.0 </td>
                      <td align="right" class="texto_blanco">&nbsp;</td>
                    </tr>
                </table></td>
                <td width="132" bgcolor="#F0F0F0"><div align="center"><a href="administracion.php"><img src="imagenes/logo.jpg" width="48" height="39" border="0" /></a></div></td>
              </tr>
              <tr valign="top">
                <td height="32" colspan="2" class="titulo">
                  <table width="100%" height="30" border="0" align="left" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5" bgcolor="#E5E5E5">
                    <tr>
                      <td width="946" align="right" bgcolor="#FFFFFF" class="texto_gris"><div align="left">&nbsp;Bienvenido: <span class="texto_btgris"><?php echo $row_supervisor['Nombre']; ?></span> &nbsp;<br>
&nbsp;Cargo:&nbsp;&nbsp;<span class="texto_btgris"><?php echo $row_supervisor['Cargo']; ?></span> - &nbsp;Nivel:&nbsp;&nbsp;&nbsp; <span class="texto_btgris"><?php echo $row_supervisor['Nivel']; ?></span></div></td>
                      <td width="164" align="right" bgcolor="#F0F0F0" class="texto_gris">
                      <div align="left">
                      <a href="deslogear.php" class="texto_gris"> Salir &gt;&gt;</a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="administracion.php">Inicio&gt;&gt;</a><br> 
	              	  <a href="../manual/completa.php" target="_blank" class="texto_gris">Ayuda &gt;&gt;</a><br>
                      </div></td>
                    </tr>
                </table></td>
              </tr>
              <tr bgcolor="#E5E5E5">
                <td height="28" colspan="2" valign="middle" class="titulo"><table width="631" height="26"  border="0">
                    <tr>
                      <td width="16%" bgcolor="#FFFFFF"><img src="images/cliente.gif" name="cliente" width="100" height="20" border="0" usemap="#cliente" id="cliente" onMouseOver="MM_showMenu(window.mm_menu_0704161327_0,0,22,null,'cliente')" onMouseOut="MM_startTimeout();"></td>
                      <td width="16%" bgcolor="#FFFFFF"><img src="images/marambio.gif" name="marambio" width="100" height="20" id="marambio" onMouseOver="MM_showMenu(window.mm_menu_0704161423_0,0,22,null,'marambio')" onMouseOut="MM_startTimeout();"></td>
                      <td width="16%" bgcolor="#FFFFFF"><img src="images/misProcesos.gif" name="misprocesos" width="100" height="20" id="misprocesos" onMouseOver="MM_showMenu(window.mm_menu_0704162558_0,0,20,null,'misprocesos')" onMouseOut="MM_startTimeout();"></td>
                      <td width="19%" bgcolor="#FFFFFF"><img src="images/aprobarTiempo.gif" name="tiempo" width="100" height="20" id="tiempo" onMouseOver="MM_showMenu(window.mm_menu_0704163337_0,0,20,null,'tiempo')" onMouseOut="MM_startTimeout();"></td>
                      <td width="17%" bgcolor="#FFFFFF"><img src="images/reportes.gif" name="reportes" width="100" height="20" id="reportes" onMouseOver="MM_showMenu(window.mm_menu_0704163728_0,0,20,null,'reportes')" onMouseOut="MM_startTimeout();"></td>
                      <td width="16%" bgcolor="#FFFFFF"><img src="images/historico.gif" name="historico" width="100" height="20" id="historico" onMouseOver="MM_showMenu(window.mm_menu_0704163729_0,103,20,null,'reportes')" onMouseOut="MM_startTimeout();"></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="1094" valign="top" ><div align="center">