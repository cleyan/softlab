<?php
//Include Common Files
define("RelativePath", ".");
include(RelativePath . "/Common.php");

//Inicialización del Motor CPAINT
require_once("cpaint2.inc.php");
   $cp = new cpaint();

//Registrar las funciones usadas
   $cp->register('ajax_add_lista');
   $cp->register('ajax_busca_test');
   $cp->register('ajax_busca_codigofonasa');
   $cp->register('ajax_buscapaciente');
   $cp->register('ajax_nuevorut');
   $cp->register('ajax_infopaciente');


   $cp->start('ISO-8859-1');
   $cp->return_data();



//Recupera el nombre de la función que viene en el parámetro
$funcion=CCGetParam('f','');
$parametro=CCGetParam('s','');
if ($funcion!='') {
     echo call_user_func($funcion, $parametro);
}

// genera un listbox
// recibe param
// $nombre: Nuevo valor agregado
// $tabla : Tabla donde agregar
// $clave : Nombre del Campo primary_key
// $valor : Nombre del Campo donde se agrega valor
function ajax_add_lista($nombre="", $tabla="", $clave="", $valor=""){
	global $cp;

        if ($nombre == "null" || $nombre=="undefined") {
                $ultimo=0;
                
        } else {
                //primero pregunta si el nombre ya esta en la base de Datos
                $db=new clsDBDatos();
                $sql="SELECT $clave FROM $tabla WHERE $valor='$nombre'";
                $db->query($sql);

                $ultimo=0;
                while ($db->next_record()) {
                        $ultimo=$db->f($clave);
                }

                if ($ultimo==0){
                        $sql="INSERT INTO $tabla (`$valor`) VALUES ('$nombre')";
                        $db->query($sql);
                        $ultimo=@mysql_insert_id();
                }
                unset($db);

        }

        $cp->set_data(ajax_get($ultimo, $tabla, $clave, $valor));

}

function ajax_get($predeterminado, $tabla, $clave, $valor){
	global $cp;

        $db=new clsDBDatos();
        $sql="SELECT $clave, $valor FROM $tabla ORDER BY $valor";
        $db->query($sql);

        $aux_sel="";
        $seleccionado="";
        $inicioselecc="selected";
        while ($db->next_record()){
                $id_key                =        $db->f($clave);
                $nom_valor        =        $db->f($valor);
                if ($id_key==$predeterminado){
                        $inicioselecc="";
                        $seleccionado="selected";
                }

                $aux_sel.="<option value=\"$id_key\" $seleccionado>$nom_valor</option>\n";
                $seleccionado="";
        }

        $tmp_sel ="<select name=\"$clave\" id=\"$clave\" style=\"WIDTH: 150px\">\n";
        $tmp_sel.="<option value=\"\" $inicioselecc>Elija un Valor</option>\n";
        $tmp_sel.=$aux_sel;
        $tmp_sel.='</option>';

        return $tmp_sel;
}

function ajax_busca_test($texto){
	global $cp;

        $sql = "SELECT test_id FROM test WHERE test_id = '$texto'";

        $db= new clsDBDatos();
        $db->query($sql);

        $nr=$db->num_rows();

        while($db->next_record()){
                $cod=$db->f("test_id");
        }

        unset($db);

        if ($nr==1) {
                $result= $cod;
        } elseif  ($nr==0) {
                $result= "__NINGUNO__";
        } elseif ($nr>1) {
                $result= "__MUCHOS__";
        }

		$cp->set_data($result);

		return;
}

function ajax_busca_codigofonasa($parametro){

	$limite=CCGetParam('l','15');

         $db=new clsDBDatos();
         $sql="SELECT codigo_fonasa, sub_codigo FROM test WHERE aislado='V' codigo_fonasa like '$parametro%' LIMIT $limite";
         $db->query($sql);
         $tmp="";
         while ($db->next_record()){
                  if ($tmp=="") {
                       $tmp=$db->f('codigo_fonasa') . $db->f('sub_codigo');
                  } else {
                    $tmp.="|".$db->f('codigo_fonasa') . $db->f('sub_codigo');
                  }
         }
         unset($db);
         return $tmp;
}
         
function ajax_buscapaciente($cadena="", $tipo="rut"){
global $cp;

	$direccion='';

	if ($cadena==""){
		$paciente_id=0;
		$nom_paciente="";
		$prevision_id=0;
		$direccion="";
		$fono="";
		$ulimapeticion="";
		$fecha_nacimiento="";
		$rut="";

	} else {
		if ($tipo=='rut'){
			if (strstr('0123456789', substr ($cadena, 0 ,1))){

				$db=new clsDBDatos();
				$sql="SELECT * FROM pacientes WHERE rut='$cadena' LIMIT 1";

				$db->query($sql);

				$paciente_id=0;
				$nom_paciente=$cadena;
				$prevision_id="";
				$direccion="";
				$fono="";
				$ulimapeticion="";
				$fecha_nacimiento="";
				$rut="";

				if ($db->next_record()){
					$paciente_id=$db->f("paciente_id");
					$nom_paciente=$db->f("nombres") . " ". $db->f("apellidos");
					$prevision_id=$db->f("prevision_id");
					$direccion=$db->f("direccion");
					$fono=$db->f("fono");
					$fecha_nacimiento=$db->f("fecha_nacimiento");
					$rut=$db->f("rut");
					
					$db2= new clsDBDatos();
					$sql2="SELECT max(peticion_id) as peticion_id, fecha FROM peticiones WHERE paciente_id=$paciente_id GROUP BY fecha";
					$db2->query($sql2);
					if ($db2->next_record()) {
						$ultimapeticion=$db2->f("peticion_id") . " - " . mysql_FormatDate($db2->f("fecha"));
					}
					unset($db2);
				}
				unset($db);
			} else {
				$paciente_id=0;
				$nom_paciente=$cadena;
				$prevision_id="";
				$direccion="";
				$fono="";
				$ulimapeticion="";
				$fecha_nacimiento="";
				$rut="";
			}
		} else {
			//tipo=pid
			$cadena=intval($cadena);
			$db=new clsDBDatos();
			$sql="SELECT * FROM pacientes WHERE paciente_id=$cadena LIMIT 1";

			$db->query($sql);

			$paciente_id=0;
			$nom_paciente=$cadena;
			$prevision_id="";
			$direccion="";

			if ($db->next_record()){
				$paciente_id=$db->f("paciente_id");
				$nom_paciente=$db->f("nombres") . " ". $db->f("apellidos");
				$prevision_id=$db->f("prevision_id");
				$direccion=$db->f("direccion");
				$fono=$db->f("fono");
				$fecha_nacimiento=$db->f("fecha_nacimiento");
				$rut=$db->f("rut");
				
				$db2= new clsDBDatos();
				$sql2="SELECT max(peticion_id) as peticion_id, fecha FROM peticiones WHERE paciente_id=$paciente_id  GROUP BY fecha";
				$db2->query($sql2);
				if ($db2->next_record()) {
					$ultimapeticion=$db2->f("peticion_id") . " - " . mysql_FormatDate($db2->f("fecha"));
				}
				unset($db2);
			}
			unset($db);
		}
	}

	if ($direccion=='') $direccion="Sin dirección registrada.";
	if ($fono=='') $fono="Sin teléfono";
	$fecha_nacimiento= ($fecha_nacimiento=="") ? "Sin Fecha de nacimiento" : mysql_FormatDate($fecha_nacimiento);
	if ($rut=="") $rut="<b>Sin R.U.T. !</b>";
	if ($ultimapeticion=="") $ultimapeticion="Sin peticiones (Nuevo Paciente?)";

	$datos ="<small>
			 Dirección: $direccion<br>
			 Fono: $fono <br>
			 R.U.T.: $rut <br>
			 Fecha Nacimiento: $fecha_nacimiento <br>
			 Ultima Petición: $ultimapeticion
			 </small>";



	//Nodos con los resultados de la búsqueda
	$nodo_paciente_id  =& $cp->add_node("pacienteid");
	$nodo_nom_paciente =& $cp->add_node("nompaciente");
	$nodo_prevision_id =& $cp->add_node("previsionid");
	$nodo_direccion= & $cp->add_node("direccion");
	
	$nodo_paciente_id->set_data($paciente_id);
	$nodo_nom_paciente->set_data($nom_paciente);
	$nodo_prevision_id->set_data($prevision_id);

	$nodo_direccion->set_data($datos);

	return;

}

function ajax_nuevorut($rut=""){
		
}

function ajax_infopaciente($paciente_id=0){
	
}
?>