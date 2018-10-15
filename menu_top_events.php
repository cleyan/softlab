<?php
//BindEvents Method @1-E8C6D8D5
function BindEvents()
{
    global $lblMenu;
    global $usuario;
    global $CCSEvents;
    $lblMenu->CCSEvents["BeforeShow"] = "lblMenu_BeforeShow";
    $usuario->CCSEvents["BeforeShow"] = "usuario_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//lblMenu_BeforeShow @4-5B3BD828
function lblMenu_BeforeShow(& $sender)
{
    $lblMenu_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lblMenu; //Compatibility
//End lblMenu_BeforeShow

//Custom Code @5-0DDE395A
// -------------------------
    global $lblMenu;

	//Escribe el Contenido del Menú
	$tmp='<applet height="28" archive="apPopupMenu.jar" width="800" code="apPopupMenu">
      <param name="font" value="Verdana,9,0">
      <param name="fontcolor" value="ffffff">
      <param name="menuitems" value="{   ,_,_}';  //"""

			//Inicio es Público
			$tmp.='
		         {Softlab,pix/gohome.png}
				 {|Inicio,menu_principal.php,mainFrame}
				 {|-}
			 ';

			//Ingreso a Configuración
			if (CCUserInGroups(CCGetGroupID(), "14;15;16;17;18;19;20")){
			 	$tmp.='
				 {|Configuración}
				 {||Panel de Control..., control.php,mainFrame}   
				 {||Tablas del Sistema  }   
				 {|||Equipos...                   ,add_equipos.php,mainFrame}   
				 {|||Secciones...                 ,add_secciones.php,mainFrame}   
				 {|||Procedencias...              ,add_procedencias.php,mainFrame}   
				 {|||Métodos...                   ,list_metodos.php,mainFrame}   
				 {|||Previsiones...               ,add_previsiones.php,mainFrame}   
				 {|||Indicaciones del Test...     ,add_indicaciones_test.php,mainFrame}   
				 {|||Indicaciones de la Muestra...,add_indicaciones_muestra.php,mainFrame}    
				 {|||Médico solicitante...        ,list_medicos.php,mainFrame}    
				 {|||Formas de pago...            ,add_formas_pago.php,mainFrame}   
				 {|||Sexos...                     ,add_sexos.php,mainFrame}   
				 {|||Tipos de muestra...          ,add_tipos_muestra.php,mainFrame}   
				 {|||Equivalencias con Equipos... ,add_equivalencias.php,mainFrame}   
				 {|||Traducción de Resultados...  ,def_traduciones.php,mainFrame}   
				 {|||Especialidades...            ,add_especialidad.php,mainFrame}   
				 {|||Usuarios del Sistema...      ,add_usuarios.php,mainFrame}    
				 {|||Prioridades...               ,add_prioridades.php,mainFrame}   
				 {|||Parámetros...                ,configuracion.php,mainFrame}    
				 {|||Barra de Botones...          ,cfg_toolbar.php,mainFrame}   
				 {||Permisos Especiales..., cfg_seguridad.php,mainFrame}   

				';
			}
			//Agrega el Menu Parámetros sólo si  es Nivel 20 - SuperUsuario
			if (CCUserInGroups(CCGetGroupID(), '20')){
				 $tmp.='
				 {||Parámetros}   
				 {|||Mensajes de ayuda o iconos,config_mensajes.php,mainFrame}   
				 {|||Tipos de formatos,add_formatos.php,mainFrame}   
				 {|||Tipos de estados,add_estados.php,mainFrame}   
				 {|||Niveles de acceso,add_niveles_acceso.php,mainFrame}   
				 {|||Agregar o Editar iconos del sistema,add_iconos.php,mainFrame}   
				 {|||Configuración Avanzada...,config_avanzada.php,mainFrame}    ';
			}

			//Verifica el Usuario para Utilidades
			if (CCUserInGroups(CCGetGroupID(), "14;15;16;17;18;19;20")){
			 $tmp.='
				 {|Utilidades}   
				 {||Actualizar Base de Datos...,actualizar_db.php,mainFrame}   
				 {||Cierre de día...,cierre_dia.php,mainFrame}       
				 {|-}
			 ';
			}

			//Verifica el Usuario para Mis Datos
			if (CCUserInGroups(CCGetGroupID(), "14;15;16;17;18;19;20")){
			 $tmp.='			       
			 {|Mis Datos... ,misdatos.php,mainFrame}       
			 ';
			}

			//Todos Pueden Cambiar su clave y Salir			
			$tmp.='
				 {|Cambiar mi clave... ,cambiarclave.php,mainFrame}   
				 {|-}       
				 {|Salir ,login.php?Logout=true,_top}
			 ';

			//Verifica el Usuario para Test
			if (CCUserInGroups(CCGetGroupID(), "14;15;16;17;18;19;20")){
				$tmp.='			
					 {Test, pix/folder_new.png}   
					 {|Listar test y sus opciones... ,list_test.php,mainFrame}   
					 {|Imprimir Lista de Test...,../cgi-bin/repwebexe/execute.pdf?reportname=listado_test_x_seccion.rep&aliasname=REPORTE&username=lab&password=lab,mainFrame}   
					 {|-}   
					 {|Precios }   
					 {||Ver Lista de Precios         ,list_precios.php,mainFrame}   
					 {||Crear precios...             ,add_precios_test.php,mainFrame}   
					 {||Editar Precios...            ,edit_precios_test.php,mainFrame}   
					 {||Importar Precios desde Archivo... ,importar_precios.php,mainFrame}   
					 {||-}   {||Crear precios por lote...    ,add_precios_test_insert.php,mainFrame}   
					 {||Modificar precios por lote...,add_precios_test_lote.php,mainFrame}  
					 {||-}   
					 {||Respaldar de precios...,crear_respaldo_precios.php,mainFrame}   
					 {||Modificar precios desde respaldos creados,modificar_precios_desde_respaldo.php,mainFrame}   
				';
			}

			//Verifica el Usuario para Pacientes
			if (CCUserInGroups(CCGetGroupID(), "14;15;16;17;18;19;20")){
				$tmp.='			
				 { Pacientes,pix/groupevent.png}       
				 {|Listar pacientes,listPacientes.php,mainFrame}   

				 ';
			}

			//Verifica el Usuario para Bodega
			if (CCUserInGroups(CCGetGroupID(), "14;15;16;17;18;19;20")){
				$tmp.='			
				 {Bodega,pix/db.png}   
				 {|Ingresar insumo a bodega,ingreso_insumo.php,mainFrame}   
				 {|-}   
				 {|Lista de insumos,list_insumos.php,mainFrame}   
				 {|Lista de ingreso de insumos,list_ingreso_insumos.php,mainFrame}   
				 {|-}   
				 {|Ver Stock de bodega,ver_stock_bodega.php,mainFrame}   
				 ';
			}

			//Verifica el Usuario para Peticiones
			if (CCUserInGroups(CCGetGroupID(), "4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20")){
				$tmp.='			
				 { Peticiones,pix/edit.png}   
				 {|Crear Nueva Petición,add_peticion.php,mainFrame}   
				 {|Editar Peticiones,ver_Peticiones.php,mainFrame}   
				 {|-}   
				 {|Hoja de trabajo...,ver_hojatrabajo.php,mainFrame}       
				';
			}

			//Verifica el Usuario para Resultados
			if (CCUserInGroups(CCGetGroupID(), "5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20")){
				$tmp.='
				 {Resultados,pix/editcopy.png}   
				 {|Ingresar resultados ...,add_resultados_peticion2.php,mainFrame}   
				 {|Validar Resultados...,validar_resultados_peticion.php,mainFrame}   
			 	';
			}

			//Verifica el Usuario para Informes
			if (CCUserInGroups(CCGetGroupID(), "5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20")){
				$tmp.='
				 {Informes,pix/editcopy.png}   
				 {|Ver / Imprimir...,list_informes.php,mainFrame}    
				 {||Definir }   
				 {|||Informe...         ,def_informe.php,mainFrame}   
				 {|||Grupos... ,def_grupos.php,mainFrame}   
				 ';
			}

			//Verifica el Usuario para Informes Avanzado...
			if (CCUserInGroups(CCGetGroupID(), "14;15;16;17;18;19;20")){
				$tmp.='
				 {|-}   
				 {|Eliminar...,del_Informes.php,mainFrame}         
			 	';
			}

			//Estadísticas
			if (CCUserInGroups(CCGetGroupID(), "5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20")){
				$tmp.='			
				 {Estadisticas, pix/oscilloscope.png}   
				 {|Liquidaciones...,stat_liquidacion.php,mainFrame}   
				 {|Test Realizados...,stat_numerotest.php,mainFrame}
				 {|Test Realizados Procedencia y paciente...,stat_reporte_test.php,mainFrame}   
				';
			}

			//Ayuda
			if (CCUserInGroups(CCGetGroupID(), "2;3;4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20")){
				$tmp.='			
				 {Ayuda, pix/help.png}       
				 {|Contacto... ,mailto:soporte@softlab.cl,_self}       
				 {|Solicitud de Soporte ,http://www.softlab.cl/soporte/,_blank}   
				 {|-}   
				 {|Acerca de SoftLab...,acercade.php,mainFrame}     
	  			{_,_,_}">';
			}

	$tmp.='
      <param name="backpic" value="pix/bkgr.gif">
      <param name="status" value="link">
      <param name="ishorizontal" value="true">
      <param name="copyright" value="Apycom Software - www.leytec.net">
      <param name="backcolor" value="0033CC">
      <param name="systemsubfont" value="true">
      <param name="buttontype" value="3">
    </applet>';


	$lblMenu->SetValue($tmp);


// -------------------------
//End Custom Code

//Close lblMenu_BeforeShow @4-6CADB428
    return $lblMenu_BeforeShow;
}
//End Close lblMenu_BeforeShow

//usuario_BeforeShow @2-162DF8CE
function usuario_BeforeShow(& $sender)
{
    $usuario_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $usuario; //Compatibility
//End usuario_BeforeShow

//Custom Code @3-D583D699
// -------------------------
    global $usuario;
    // Write your own code here.

	$usuario->SetValue(GetUserName());

// -------------------------
//End Custom Code

//Close usuario_BeforeShow @2-E93678F3
    return $usuario_BeforeShow;
}
//End Close usuario_BeforeShow

//Page_BeforeOutput @1-D62466B5
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $menu_top; //Compatibility
//End Page_BeforeOutput

//Custom Code @25-2A29BDB7
// -------------------------
    // Write your own code here.

	global $main_block;

	CorrigeCodigo($main_block);


// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput


?>