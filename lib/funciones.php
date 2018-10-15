<?php
//Contine las funciones personalizadas
//**************************************************************************************

/*        Funcion GetFechaServer
         Devuelve la fecha del servidor en formato deseado, por omision
        usa el formato local
        puedes usar tambien
        server_hora: yyyy-mm-dd hh:mm:ss
        server          : yyyy-mm-dd
        local      : dd/mm/yyyy
        para otras configuraciones usa el formato de date

        a - "am" o "pm"
        A - "AM" o "PM"
        d - d�a del mes, dos d�gitos con cero a la izquierda; es decir, de "01" a "31"
        D - d�a de la semana, en texto, con tres letras; por ejemplo, "Fri"
        F - mes, en texto, completo; por ejemplo, "January"
        h - hora, de "01" a "12"
        H - hora, de "00" a "23"
        g - hour, sin ceros, de "1" a "12"
        G - hour, sin ceros; de "0" a "23"
        i - minutos; de "00" a "59"
        j - d�a del mes sin cero inicial; de "1" a "31"
        l ('L' min�scula) - d�a de la semana, en texto, completo; por ejemplo, "Friday"
        L - "1" or "0", seg�n si el a�o es bisiesto o no
        m - mes; de "01" a "12"
        n - mes sin cero inicial; de "1" a "12"
        M - mes, en texto, 3 letras; por ejemplo, "Jan"
        s - segundos; de "00" a "59"
        S - sufijo ordinal en ingl�s, en texto, 2 caracteres; por ejemplo, "th", "nd"
        t - n�mero de d�as del mes dado; de "28" a "31"
        U - segundos desde el valor de 'epoch'
        w - d�a de la semana, en n�mero, de "0" (domingo) a "6" (s�bado)
        Y - a�o, cuatro cifras; por ejemplo, "1999"
        y - a�o, dos cifras; por ejemplo, "99"
        z - d�a del a�o; de "0" a "365"
        Z - diferencia horaria en segundos (de "-43200" a "43200")
*/

function GetFechaServer($formato="local")
{
        $newFormat="";
        switch ($formato) {
        case "":
         $newFormat="d/m/Y";
         break;
        case "local":
         $newFormat="d/m/Y";
         break;
        case "server":
         $newFormat="Y-m-d 00:00:00";
         break;
        case "server_hora":
         $newFormat="Y-m-d H:i:s";
         break;
        case "hora":
         $newFormat="H:i:s";
         break;
        default:
         $newFormat="$formato";
        }

        $tmpFecha=date($newFormat);

        return $tmpFecha;

}

// Function GetFechaSistema()
// Devuelve la fecha del sistema en formato deseado, si
// no especifica usa el formato local (dd/mm/yyyy)

function GetFechaSistema($formato="")
{
        $fechagrabada=CCGetSession("FechaSistema");

        if ($fechagrabada=="") {
                $fechagrabada=time();
        }

        $newFormat="";
        switch ($formato) {
        case "":
         $newFormat="d/m/Y";
         break;
        case "local":
         $newFormat="d/m/Y";
                 break;
        case "local_hora":
                 $newFormat="d/m/Y H:i:s";
         break;
        case "server":
         $newFormat="Y-m-d 00:00:00";
         break;
        case "server_hora":
         $newFormat="Y-m-d H:i:s";
         break;
        default:
         $newFormat="$formato";
        }

        $tmpFecha=date($newFormat, $fechagrabada);

        return $tmpFecha;
}

// Funcion SetFechaSistema(nuevafecha)
// Fija la nueva fecha del sistema
// debe esfecificar la fecha en formato local (dd/mm/yyyy)
function SetFechaSistema($nuevafecha="")
{
        list( $dia, $mes, $year ) = split( '[/.-]', $nuevafecha );

        $fechatmp="$year-$mes-$dia 00:00:00";
        $fecha_ts=strtotime($fechatmp);

        CCSetSession("FechaSistema",$fecha_ts);

        //valida que la variable se haya grabado, si todo esta ok, devuelve true, sino .....

        if ($nuevafecha==GetFechaSistema()){
                return true;
        } else {
                return false;
        }
}

// Funcion GetNuevaID
// Obtiene un ID correlativo y unico
function GetNuevaID($formato="%0d")
{
        $hora=date("Y-m-d H:i:s");
        $d = new clsDBDatos();
        $d->query("INSERT INTO get_serie (hora, formato) values ('$hora', '$formato')");
        $ultimoID=mysql_insert_id();
        unset($d);

        return sprintf($formato,$ultimoID);
}
// Fin GetNuevaID()
//----------------------------------------------------------------------------------------------
// Funcion  GetEstadoPredet(
// devuelve el id del estado predetminado para la tabla entregada
// Usar En
function GetEstadoPredet($usar_en_value)
{
        if($usar_en_value=="") {
                return 0;
        } else {
                $sql="SELECT estado_id FROM estados WHERE predeterminado='V' and usar_en='$usar_en_value'";
                $db = new clsDBDatos();
                $db->query($sql);
            $dbvalue = $db->next_record() ? $db->f(0) : "";
                unset($db);
           return $dbvalue;
        }
}
// Fin GetEstadoPredet

// Funci�n que recupera la configuraci�n
// del sistema, crea un array con la forma array["clave"]=valor
// si se especifica una clave se trata de recuperar

Function GetConfig($clavesolicitada="")
{
        if ($clavesolicitada=="") {
                $sql="SELECT clave, valor FROM configuracion";
                $db = new clsDBDatos();
                $db->query($sql);

                $tmp=array();
            while ($db->next_record()){
                        $clave=strtoupper($db->f("clave"));
                        $tmp[$clave]=$db->f("valor");
                }
                unset($db);
                return $tmp;
        } else {
                $clavesolicitada=strtolower($clavesolicitada);
                $sql="SELECT valor from configuracion where lower(clave)='$clavesolicitada'";
                $db = new clsDBDatos();
                $db->query($sql);
            $dbvalue = $db->next_record() ? $db->f(0) : "";
                unset($db);
            return $dbvalue;
        }
}
//Fin GetConfig()

//-----------------------------------------------------------------------------------
// Funcion CrearListBox
function CrearListBox(&$obj_label, $sel_id="", $tabla, $campo_id, $campo_txt, $condicion="", $def_id="", $def_txt="Elija un Valor", $unico=false, $ancho='150px')
{
        $obj_label->HTML=true;

        if ($unico!='') $unico='DISTINCT';

        if ($condicion!="") $condicion=" WHERE $condicion ";
          $sSQL= "SELECT $unico $campo_id, $campo_txt FROM $tabla $condicion ORDER BY $campo_txt";

          $db2 = new clsDBDatos();
          $db2->query($sSQL);
          $valores = array();

          while ($db2->next_record())
          {
                  $valor = array();
                  $valor[$campo_id] = $db2->f($campo_id);
                  $valor[$campo_txt] = $db2->f($campo_txt);

                  $valores[] = $valor;
          }
          unset($db2);

        $sel=0;
        $itemOp = "";
          while (list ($clave, $val) = each ($valores)) {
              $seleccionado=($val[$campo_id]==$sel_id) ? "selected" :"";
                $itemOp.='<option value="'.$val[$campo_id].'" '.$seleccionado.'>'.$val[$campo_txt]."</option>\n";
                 if ($seleccionado!="") $sel++;
          }

        $seleccionado=($sel==0)?"selected":"";

        $itemOp="<option value=\"$def_id\" $seleccionado>$def_txt</option>\n" . $itemOp . "\n";
        //die($itemOp);

		//agrega las etiquetas de inicio y fin del select
		$itemOp="<select name=\"$campo_id\" id=\"$campo_id\" style=\"WIDTH: $ancho\"> \n". $itemOp . "</select>";

        $obj_label->SetValue($itemOp);

        return $itemOp;
}

// Fin CrearListBox

// Funcion CrearListBoxMenu
// Igual que crealistbox pero crea un lisbox menu
function CrearListBoxMenu(&$obj_label, $sel_id="", $tabla, $campo_id, $campo_txt, $condicion="", $destino="", $def_id="", $def_txt="Elija un valor")
{
        $obj_label->HTML=true;
        if ($condicion!="") $condicion=" WHERE $condicion ";
          $sSQL= "SELECT $campo_id, $campo_txt FROM $tabla $condicion ORDER BY $campo_txt";

          $db2 = new clsDBDatos();
          $db2->query($sSQL);
          $valores = array();

          while ($db2->next_record())
          {
                  $valor = array();
                  $valor[$campo_id] = $db2->f($campo_id);
                  $valor[$campo_txt] = $db2->f($campo_txt);

                  $valores[] = $valor;
          }
          unset($db2);

        $sel=0;
          while (list ($clave, $val) = each ($valores)) {
              $seleccionado=($val[$campo_id]==$sel_id) ? "selected" :"";
                $itemOp.='<option value="'.$destino.$val[$campo_id].'" '.$seleccionado.'>'.$val[$campo_txt]."</option>\n";
                 if ($seleccionado!="") $sel++;
          }

        $seleccionado=($sel==0)?"selected":"";

        $itemOp="<option value=\"$destino$def_id\" $seleccionado>$def_txt</option>\n".$itemOp."\n";
        //die($itemOp);
        $obj_label->SetValue($itemOp);

        return $itemOp;
}

// Fin CrearListBoxMenu

// -------------------------------------------------------------------------
// Funcion CrearBoton
function CrearBoton(&$obj_lbl, $nombre="", $tipo='', $valor='', $id='', $clase='', $script='', $enabled=true)
{
        //Todas las verificaciones
        $tipo=strtolower($tipo);
        if ($nombre=="") $nombre=$obj_lbl->Name;
        if ($tipo=="") $tipo="button";
        if ($id=="") $id=$nombre;
        if ($clase=="") $clase="InLineButton";
        if ($script!="") $script="onclick=\"javascript:$script;\"";

        //asegurarse que el label que contendra el objeto tenga html=true
        $obj_lbl->HTML=true;

        $activo=($enabled)? "" : "disabled";

        $temp="<input type=\"$tipo\" name=\"$nombre\" value=\"$valor\" id=\"$id\" class=\"$clase\" $script $activo>";

        $obj_lbl->SetValue($temp);
}
// Fin CrearBoton

//-----------------------------------------------------------------------------------
// Funcion RespaldarPrecios (Adivinen pa que es :) )
function RespaldarPrecios()
{
        $fecha = GetFechaServer("server_hora");
        $db = new clsDBDatos();
        $insert = new clsDBDatos();
        $db->query("SELECT test_id, prevision_id, procedencia_id, precio FROM precios_test");
        $result = $db->next_record();
        if($result){
                do{
                        $test_id = $db->f("test_id");
                        $prevision_id = $db->f("prevision_id");
                        $procedencia_id = $db->f("procedencia_id");
                        $precio = $db->f("precio");
                        $sql_insert="INSERT INTO respaldos_precios_test ".
                                                "(test_id,prevision_id,procedencia_id,precio,fecha) ".
                                                "VALUES ('$test_id','$prevision_id','$procedencia_id','$precio','$fecha')";
                        $insert->query($sql_insert);
                }
                while($db->next_record());
        }
        unset($db);
        unset($insert);
        return true;
}
// Fin RespaldarPrecios

// Funcion GetPrecioTest()
// Obtiene el precio de un test para una procedencia y previsi�n
function GetPrecioTest($test_id, $prevision_id, $procedencia_id)
{
        $sSQL="SELECT precios_test.precio FROM precios_test WHERE test_id = $test_id AND prevision_id = $prevision_id AND procedencia_id = $procedencia_id";
        $db = new clsDBDatos;
        $db->query($sSQL);

        $tmpprecio=($db->next_record()) ? $db->f(0): "0";

        unset($db);
        return $tmpprecio;

}

//Funcion que calcula el/los valor(es)) fde campos calculados (formula))
//en una peticion especifica
// C�digos de Error
// ERR1!  =  No viene ni peticion ni test
// ERR2!  =
// ERR3!
// ERR4!

function CalculaFormula($peticion_id=0, $test_id=0)
{
     //Array que contiene los resultados
     $tmp=array();
     $tmp['valor']="";
     $tmp['mensaje']='';

     //Si la peticion o el test son cero, devuelve ERR!
     if ($peticion_id==0 or $test_id==0) {
        $tmp['valor']="* Peticion o test es CERO *";
        $tmp['mensaje']='';
        return $tmp;
     }

    //Primero Recupera la formula
    $db= new clsDBDatos();
    $sSQL="SELECT * from formulas where test_id=$test_id ";
    $a= 0;
    $b= 0;
    $c= 0;
    $d= 0;
    $e= 0;
    $f= 0;
    $g= 0;
    $h= 0;
    $i= 0;
    $j= 0;
    $k= 0;
    $l= 0;
    $formula= 0;

    $decimales=0;
        $etiqueta="";

    $permitir_falta="F";
    $valor_falta="";
        $cambia_cero="";
    $alarma="F";
    $operador="=";
    $target="100";
    $mensaje="";

    $db->query($sSQL);

    if ($db->next_record()){
        $a= $db->f("a");
        $b= $db->f("b");
        $c= $db->f("c");
        $d= $db->f("d");
        $e= $db->f("e");
        $f= $db->f("f");
        $g= $db->f("g");
        $h= $db->f("h");
        $i= $db->f("i");
        $j= $db->f("j");
        $k= $db->f("k");
        $l= $db->f("l");
        $formula= $db->f("formula");
        $decimales=$db->f("decimales");
                $etiqueta=$db->f("etiqueta");
        $permitir_falta=$db->f("permitir_falta");
        $valor_falta=$db->f("valor_falta");
                $cambia_cero=$db->f("cambia_cero");
        $alarma=$db->f("alarma");
        $operador=$db->f("operador");
        $target=$db->f("target");
        $mensaje=$db->f("mensaje");

    }

    unset($db);

    //Verifica que al menos haya un test en el listado de campos
    $hay =false;
    if ($a!=0) $hay=true;
    if ($b!=0) $hay=true;
    if ($c!=0) $hay=true;
    if ($d!=0) $hay=true;
    if ($e!=0) $hay=true;
    if ($f!=0) $hay=true;
    if ($g!=0) $hay=true;
    if ($h!=0) $hay=true;
    if ($i!=0) $hay=true;
    if ($j!=0) $hay=true;
    if ($k!=0) $hay=true;
    if ($l!=0) $hay=true;

        //Si no se encontro un campo con test_id
    if ($hay!=true) {
        $tmp['valor']="* Ningun Test *";
        $tmp['mensaje']='';
        return $tmp;
     }

    //Si no viene una formula
    if ($formula=="") {
        $tmp['valor']="* Ningun Test *";
        $tmp['mensaje']='';
        return $tmp;
     }

    //Busca a ver si los test involucrados en la formula
    //Traen valor en esta peticion
    $db=new clsDBDatos();

    if ($a>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$a");
    $a=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($b>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$b");
    $b=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($c>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$c");
    $c=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($d>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$d");
    $d=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($e>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$e");
    $e=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($f>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$f");
    $f=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($g>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$g");
    $g=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($h>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$h");
    $h=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($i>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$i");
    $i=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($j>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$j");
    $j=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($k>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$k");
    $k=($db->next_record()) ? floatval($db->f(0)) : "ERR99";

    if ($l>0) $db->query("select valor from resultados where peticion_id=$peticion_id and test_id=$l");
    $l=($db->next_record()) ? floatval($db->f(0)) : "ERR99";


    $arr_variables=array('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l');
    $arr_valores  =array($a  ,$b  ,$c  ,$d  ,$e  ,$f  ,$g  ,$h  ,$i  ,$j  ,$k  ,$l  );

    $new_formula=str_replace($arr_variables,$arr_valores,$formula);

    //si la formula permite que falten valores, reemplazo los valores por el c�digo que incique la formula
    if ($permitir_falta=='V'){
        $new_formula=str_replace("ERR99",$valor_falta,$new_formula);
    }

    //echo "<pre>". print_r($arr_valores,true) . "</pre>";

    // Busca si hay algun campo que no traia valor
    $pos = strpos ($new_formula, "ERR99");
    if ($pos === false) { // nota: tres signos igual  verifica si venia un test vacio
        //Manejador personalizado de errores
        error_reporting(0);
        $gestor_de_errores_anterior = set_error_handler("gestorDeErroresDeUsuario");

//	echo "Formula: $new_formula<br>";

        $evaluacion=matheval($new_formula);
                $tmp_eval=$evaluacion;

                $pos = strpos ($tmp_eval, "*");

                if (!($pos===false)){
                        $tmp['valor']=$tmp_eval;
                        $tmp['mensaje']='';
                        return $tmp;
                }

//	echo "Evaluaci�n: $evaluacion<br>";

        $evaluacion=number_format($evaluacion, $decimales, '.', '');

//	echo "Formateado (dec=$decimales): $evaluacion<br> ";

        //Devolver gestor de errores
        restore_error_handler();

                if ($cambia_cero!=""){
                        if ($tmp_eval==0) $evaluacion = $cambia_cero;
                }

        $tmp['valor']=$evaluacion.$etiqueta;

//                echo "Cambia_cero=$cambia_cero<br/>tmp_val=$tmp_val<br/>evaluacion=$evaluacion<br/>etiqueta=$etiqueta";


        //si el test es una alarma
        if ($alarma=='V') {
            if ($operador=='='){
                if ($evaluacion==$target) $tmp['mensaje'] =$mensaje;
            } elseif ($operador=='<') {
                if ($evaluacion < $target) $tmp['mensaje'] =$mensaje;
            } elseif ($operador=='>') {
                if ($evaluacion>$target) $tmp['mensaje'] =$mensaje;
            } elseif ($operador=='!=') {
                if ($evaluacion!=$target) $tmp['mensaje'] =$mensaje;
            }
        }

//		echo "<pre> ". print_r($tmp, true) . "</pre>";

        return $tmp;

    } else {
        $tmp['valor']='*Falta Valor*';
        $tmp['mensaje']='';
        return $tmp;
    }
}





//Funcion que hace evaluaciones matem�ticas
function matheval($equation){

                //echo "0- Ecuacion: $equation<br/>";

       $equation = preg_replace("/[^0-9+\-.,*\/()%a-z]/","",$equation);

                //echo "1- Ecuacion: $equation<br/>";

       $equation = preg_replace("/([+-])([0-9]+)(%)/","*(1\$1.\$2)",$equation);

                   //echo "2- Ecuacion: $equation<br/>";


           // you could use str_replace on this next line
       // if you really, really want to fine-tune this equation


           $equation = preg_replace("/([0-9]+)(%)/",".\$1",$equation);

                //echo "3- Ecuacion: $equation<br/>";

       if ( $equation === "" ) {
               $return = 0;
       } else {
               eval("\$return=floatval(" . $equation . ");");

                //echo "return pre: $return<br/>";

                                if ($return==="")
                                        $return="* Error en formula *";

                //echo "return post: $return<br/>";

       }

       return $return;
}



// funci&oacute;n de gesti&oacute;n de errores definida por el usuario
function gestorDeErroresDeUsuario($num_err, $mens_err, $nombre_archivo,
                                  $num_linea, $vars) {
    //Devuelve a gestor de errores del sistema
        restore_error_handler();

    // marca de fecha/hora para el registro de error
    $dt = date("Y-m-d H:i:s");

    // definir una matriz asociativa de cadenas de error
    // en realidad las &uacute;nicas entradas que deber&iacute;amos
    // considerar son 2, 8, 256, 512 y 1024
    $tipo_error = array (
                1    =>  "Error",
                2    =>  "Advertencia",
                4    =>  "Error de Interprete",
                8    =>  "Anotacion",
                16   =>  "Error de Nucleo",
                32   =>  "Advertencia de Nucleo",
                64   =>  "Error de Compilacion",
                128  =>  "Advertencia de Compilacion",
                256  =>  "Error de Usuario",
                512  =>  "Advertencia de Usuario",
                1024 =>  "Anotacion de Usuario"
                );
    // conjunto de errores de los cuales se almacenar&aacute; un rastreo
    $errores_de_usuario = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);

    $err = "<tr>\r\n";
    $err .= "\t<td>" . $dt . "</td>\r\n";
    $err .= "\t<td>" . $num_err . "</td>\r\n";
    $err .= "\t<td>" . $tipo_error[$num_err] . "</td>\r\n";
    $err .= "\t<td>" . $mens_err . "</td>\r\n";
    $err .= "\t<td>" . $nombre_archivo . "</td>\r\n";
    $err .= "\t<td>" . $num_linea . "</td>\r\n";

    if (in_array($num_err, $errores_de_usuario))
        $err .= "\t<td>" . wddx_serialize_value($vars, "Variables") . "</td>\r\n";
    $err .= "</tr>\r\n\r\n";

    // para efectos de debug
    // echo $err;

    // guardar en el registro de errores, y enviar un correo
    // electr&oacute;nico si hay un error cr&iacute;tico de usuario
    error_log($err, 3, "c:/error.htm");
//    die($err);

        if ($num_err == E_USER_ERROR){
          echo "<h1>Error: $err </h1>";
          exit -1;
          }
    //    if ($num_err == E_USER_ERROR)
//        mail("phpdev@example.com", "Error Cr&iacute;tico de Usuario", $err);
}



//--------------------------------------- Inicio de bater�a de funciones MACK. -----------------------------------------------
//------------------------------------------------- FUNCI�N ( 01 )------------------------------------------------------------
//Genera la tabla con el detalle de la petic�n solicitada.
//Inicio funci�n "generar_inf_Peticion"
function generar_inf_Peticion($peticion_id){
        $db = new clsDBDatos();
        $sSQL=        "SELECT pac.rut, pac.nombres, pac.apellidos, pet.fecha, pet.hora, pet.observaciones ".
                        "FROM pacientes AS pac, peticiones AS pet ".
                        "WHERE pac.paciente_id = pet.paciente_id ".
                        "AND pet.peticion_id = '$peticion_id'";
        $db->query($sSQL);
        $html_inf="";
        if($db->next_record()){
                $html_inf = "<table class='InLineFormTABLE' cellspacing='0' cellpadding='3' border='0' width='100%'>\n".
                                        "<tr>\n".
                                                "<td class='InLineFormHeaderFont' colspan='3' align='left'>Detalle de petici�n</td>\n".
                                                "<td bgcolor='#ffcc00' align='center'><b>PETICI�N ID: $peticion_id</b></td>\n".
                                        "</tr>\n".
                                        "<tr>\n".
                                                "<td class='InLineFormHeaderFont'>Rut:</td>\n".
                                                "<td colspan='3' class='InLineDataTD'>".$db->f("rut")."</td>\n".
                                        "</tr>\n".
                                        "<tr>\n".
                                                "<td class='InLineFormHeaderFont'>Nombre:</td>\n".
                                                "<td colspan='3' class='InLineDataTD'>".$db->f("nombres")." ".$db->f("apellidos")."</td>\n".
                                        "</tr>\n".
                                        "<tr>\n".
                                                "<td class='InLineFormHeaderFont'>Fecha:</td>\n".
                                                "<td class='InLineDataTD'>".date("d/m/Y",strtotime($db->f("fecha")))."</td>\n".
                                                "<td class='InLineFormHeaderFont'>Hora:</td>\n".
                                                "<td class='InLineDataTD'>".date("H:i",strtotime($db->f("hora")))."</td>\n".
                                        "</tr>\n".
                                        "<tr>\n".
                                                "<td class='InLineFormHeaderFont'>Observaciones:</td>\n".
                                                "<td colspan='3' class='InLineDataTD'>".$db->f("observaciones")."</td>\n".
                                        "</tr>\n".
                                        "</table>\n";
        }
        unset($db);
        return $html_inf;
}
//Fin funci�n "generar_inf_Peticion"
//------------------------------------------------- FUNCI�N ( 02 )------------------------------------------------------------
//Genera la grilla para el ingreso de resultados seg�n el array que reciva que debe contener los parametros
//peticion_id, muestra_id, test_id, estado_id.
//Inicio funci�n "generar_grila_peticiones"
function generar_grila_resultados($peticiones,$col_mostrar,$pagina){

        if(sizeof($peticiones) > 0){ //petici�n valida

                $grilla .= genera_encabezado_grilla($col_mostrar);//FUNCI�N 04

                while(list($clave, $valor) = each($peticiones)){ //por cada detalle de petici�n genero una fila

                        $grilla .= generar_fila_grilla($valor["peticion_id"], $valor["muestra_id"],$valor["test_id"],$valor["estado_id"],$valor["decompuesto"],$col_mostrar,$pagina, $valor ); //FUNCTI�N 05

                }

                $grilla .= genera_pie_grilla($col_mostrar);                                                                                                                                                         //FUNCI�N 06

                return $grilla;
        }
}
//Fin funci�n "generar_grila_resultados"
//------------------------------------------------- FUNCI�N ( 03 )------------------------------------------------------------
//Entrega un array con los campos "peticion_id, muestra_id, test_id, estado_id, decompuesto" de la tabla "peticion_detalle"
//Inicio funci�n "peticion_detalle"
function peticion_detalle($peticion_id){
        $db = new clsDBDatos();
/*        $sSQL ="SELECT
  peticiones_detalle.peticion_id,
  peticiones_detalle.muestra_id,
  peticiones_detalle.test_id,
  peticiones_detalle.estado_id,
  peticiones_detalle.decompuesto,
  test.compuesto,
  test.aislado,
  test.formula,
  grupos_detalle.grupo_id,
  test.orden_informe,
  test.cod_test,
  peticiones_detalle.test_main_id
FROM
  peticiones_detalle
  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)
  LEFT OUTER JOIN grupos_detalle ON (test.test_id = grupos_detalle.test_id)
WHERE
  (peticion_id = '$peticion_id')
ORDER BY
  peticiones_detalle.test_main_id,
  peticiones_detalle.decompuesto DESC,
  grupos_detalle.grupo_id,
  test.orden_informe";
*/
$sSQL="SELECT
  peticiones_detalle.peticion_id,
  peticiones_detalle.muestra_id,
  peticiones_detalle.test_id,
  peticiones_detalle.estado_id,
  peticiones_detalle.decompuesto,
  test.compuesto,
  test.aislado,
  test.formula,
  test.orden_informe,
  test.cod_test,
  peticiones_detalle.test_main_id
FROM
  peticiones_detalle
  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)
WHERE
  (peticion_id = '$peticion_id')
ORDER BY
  peticiones_detalle.test_main_id,
  peticiones_detalle.decompuesto DESC,
  test.orden_ingreso";

  //die($sSQL);
          //SELECT peticion_id, muestra_id, test_id, estado_id, decompuesto
                //        FROM peticiones_detalle WHERE peticion_id='$peticion_id' ORDER BY detalle_peticion_id";
        $db->query($sSQL);
        $lista_peticiones = array();
        while($db->next_record()){
                $p= array();
                $p["peticion_id"] = $db->f("peticion_id");
                $p["muestra_id"] = $db->f("muestra_id");
                  $p["test_id"] = $db->f("test_id");
                $p["estado_id"] = $db->f("estado_id");
                $p["decompuesto"] = $db->f("decompuesto");
        //Agregado por CLB
        $p['compuesto'] =$db->f('compuesto');
        $p['aislado'] =$db->f('aislado');
        $p['formula'] =$db->f('formula');
                $lista_peticiones[] = $p;
        }
        unset($db);
        return $lista_peticiones;
}
//Fin funci�n "peticion_detalle"
//------------------------------------------------- FUNCI�N ( 04 )------------------------------------------------------------
//Crea el encabezado de la grilla de resultados de peticiones
function genera_encabezado_grilla($col_mostrar){

        $clase_theme = "InLineFormHeaderFont";
        $alinear = "center";
        $colspan= 0;
        if($col_mostrar[0]["col_peticion"])         $colspan++;
        if($col_mostrar[0]["col_muestraID"])        $colspan++;
        if($col_mostrar[0]["col_paciente"])         $colspan++;
        if($col_mostrar[0]["col_test"])                 $colspan++;
        if($col_mostrar[0]["col_seccion"])                 $colspan++;
        if($col_mostrar[0]["col_equipo"])                 $colspan++;
        if($col_mostrar[0]["col_resultado"])         $colspan++;
        if($col_mostrar[0]["col_estado"])                 $colspan++;
        if($col_mostrar[0]["col_archivo"])                 $colspan++;
        if($col_mostrar[0]["col_mult_resultado"]) $colspan++;

        $encabezado = "<table class='InLineFormTABLE' cellspacing='0' cellpadding='3' border='0' width='100%'>
                                        <tr>";
                                                if($col_mostrar[0]["col_peticion"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear'>Petici�n ID</td>";
                                                if($col_mostrar[0]["col_muestraID"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear' nowrap>Muestra ID</td>";
                                                if($col_mostrar[0]["col_paciente"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear'>Paciente</td>";
                                                if($col_mostrar[0]["col_test"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear' nowrap>Test</td>";
                                                if($col_mostrar[0]["col_seccion"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear'>Secci�n</td>";
                                                if($col_mostrar[0]["col_equipo"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear'>Equipo</td>";
                                                if($col_mostrar[0]["col_resultado"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear' width=\"100%\">Resultado(s)</td>";
                                                if($col_mostrar[0]["col_estado"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear'>Estado</td>";
                                                if($col_mostrar[0]["col_archivo"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear'>Imagen</td>";
                                                if($col_mostrar[0]["col_mult_resultado"])
                                                        $encabezado.="<td class='$clase_theme' align='$alinear'>+</td>";
        $encabezado.="</tr>";
        return $encabezado;
}
//Fin funci�n "genera_encabezado_grilla"
//------------------------------------------------- FUNCI�N ( 05 )------------------------------------------------------------
//Crea cada fila de la grilla de resultados de petici�n
function generar_fila_grilla($peticion, $muestra_id, $test_id, $estado_id, $decompuesto, $col_mostrar, $pagina, $todalapeticion){
        global $grilla;
        $theme = "InLineDataTD";
        $numFila = $grilla->filas->GetValue();
        if($numFila=="") $numFila=1;
        //echo("$numFila<br/>");
        $valores_encontrados = buscar_resultados($test_id, $peticion);                                                                                                  //FUNCI�N 07
        $valores_validos = valores_resultados($test_id);                                                                                                                                 //FUNCI�N 08
        $cantidad_valores_encontrados = sizeof($valores_encontrados);
        $cantidad_valores_validos = sizeof($valores_validos);
        $colspan= -1;
        if($col_mostrar[0]["col_peticion"])         $colspan++;
        if($col_mostrar[0]["col_muestraID"])        $colspan++;
        if($col_mostrar[0]["col_paciente"])         $colspan++;
        if($col_mostrar[0]["col_test"])                 $colspan++;
        if($col_mostrar[0]["col_seccion"])                 $colspan++;
        if($col_mostrar[0]["col_equipo"])                 $colspan++;
        if($col_mostrar[0]["col_resultado"])         $colspan++;
        if($col_mostrar[0]["col_estado"])                 $colspan++;
        if($col_mostrar[0]["col_archivo"])                 $colspan++;
        if($col_mostrar[0]["col_mult_resultado"]) $colspan++;

    //Si es una formula NO permite edici�n
    $sololectura  = ($todalapeticion['formula']=='V') ? 'readonly' : '' ;

        if($cantidad_valores_encontrados > 0 && $cantidad_valores_validos > 1){ //Se genera un listbox

                $contResult=1;
                while(list($clave, $valor) = each($valores_encontrados)){ //por cada resultado encontrado genero una fila

                        if(!compuesto($test_id)){
                                $fila.= "<tr>";
                                if($col_mostrar[0]["col_peticion"])        $fila.= "<td class='$theme'>&nbsp;".$peticion."</td>";
                                if($col_mostrar[0]["col_muestraID"])$fila.= "<td class='$theme'>&nbsp;".$muestra_id."</td>";
                                if($col_mostrar[0]["col_paciente"])        $fila.= "<td class='$theme'>&nbsp;".nom_paciente($peticion)."</td>";//FUNCI�N 20
                                if($cantidad_valores_encontrados > 1){
                                        if($col_mostrar[0]["col_test"])        $fila.=        "<td class='$theme' nowrap>".nombre_test($test_id, $decompuesto)."&nbsp;($contResult)</td>";//FUNCI�N 10
                                }
                                else{
                                        if($col_mostrar[0]["col_test"])        $fila.=        "<td class='$theme' nowrap>".nombre_test($test_id, $decompuesto)."&nbsp;</td>";//FUNCI�N 10
                                }
                                if($col_mostrar[0]["col_seccion"])        $fila.= "<td class='$theme'>&nbsp;".nom_seccion($test_id)."</td>";                        //FUNCI�N 21
                                if($col_mostrar[0]["col_equipo"])        $fila.= "<td class='$theme'>&nbsp;".nom_equipo($test_id)."</td>";                        //FUNCI�N 22
                                if($col_mostrar[0]["col_resultado"]){
                                        if(!con_text_area($test_id)){
                                                $fila.= "<td class='$theme' width=\"100%\">";
                                                $fila.= generar_listbox_1($valor["resultado_id"], $valor["valor"], $valores_validos, $numFila, $sololectura);                                //FUNCI�N 09
                                                $fila.= generar_valores_hidden($peticion, $test_id, $valor["muestra_id"], $valor["estado_id"], $numFila,$valor["fecha_creacion"],$valor["hora_creacion"]);        //FUNCI�N 16
                                        }else{
                                                $fila.= "<td class='$theme' width=\"100%\">";
                                                $fila.= generar_text_area($valor["resultado_id"], $valor["valor"], $numFila, $sololectura);
                                                $fila.= generar_valores_hidden($peticion, $test_id, $valor["muestra_id"], $valor["estado_id"], $numFila,$valor["fecha_creacion"],$valor["hora_creacion"]);//FUNCI�N 16
                                                $fila.="</td>";
                                        }
                                }
                                if($col_mostrar[0]["col_estado"])        $fila.= "<td class='$theme'>&nbsp;".nom_estado($valor["estado_id"])."</td>";//FUNCI�N 23
                                if($col_mostrar[0]["col_archivo"])        $fila.= "<td class='$theme' align='center'>".link_imagen($peticion,$test_id,$muestra_id,$valor["estado_id"],$numFila,$pagina,$valor["fecha_creacion"],$valor["hora_creacion"])."</td>"; //FUNCI�N 27
                                if($col_mostrar[0]["col_mult_resultado"]) $fila.= "<td class='$theme' align='center'>".link_add_resultado($peticion,$test_id,$muestra_id,$pagina)."</td>";
                                $fila.="</tr>";
                                $numFila++;
                        }
                        else{ // aqu� entra si el test es compuesto
                                $fila.= "<tr>";
                                if($col_mostrar[0]["col_test"])        {
                                        if($col_mostrar[0]["col_peticion"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                        if($col_mostrar[0]["col_muestraID"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                        if($col_mostrar[0]["col_paciente"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                        $fila.=        "<td class='$theme' colspan=''>".
                                                                generar_resultado_id($valor["resultado_id"],$numFila).
                                                                nombre_test($test_id, $decompuesto).
                                                                generar_valores_hidden($peticion, $test_id, $valor["muestra_id"], $valor["estado_id"], $numFila,$valor["fecha_creacion"],$valor["hora_creacion"]).
                                                        "</td>";
                                        if($col_mostrar[0]["col_seccion"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_equipo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_resultado"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_estado"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_archivo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_mult_resultado"]) { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                }
                                $fila.="</tr>";
                                $numFila++;
                        }
                        $contResult++;
                }
        }
        elseif($cantidad_valores_encontrados == 0 && $cantidad_valores_validos > 1){ //Se genera un listbox

                if(!compuesto($test_id)){                                                                                                                                                                                        //FUNCI�N 11
                        $fila.= "<tr>";
                        if($col_mostrar[0]["col_peticion"])        $fila.= "<td class='$theme'>&nbsp;".$peticion."</td>";
                        if($col_mostrar[0]["col_muestraID"])$fila.= "<td class='$theme'>&nbsp;".$muestra_id."</td>";
                        if($col_mostrar[0]["col_paciente"])        $fila.= "<td class='$theme'>&nbsp;".nom_paciente($peticion)."</td>";                //FUNCI�N 20
                        if($col_mostrar[0]["col_test"])                $fila.=        "<td class='$theme' nowrap>".nombre_test($test_id, $decompuesto)."</td>";        //FUNCI�N 10
                        if($col_mostrar[0]["col_seccion"])        $fila.= "<td class='$theme'>&nbsp;".nom_seccion($test_id)."</td>";                        //FUNCI�N 21
                        if($col_mostrar[0]["col_equipo"])        $fila.= "<td class='$theme'>&nbsp;".nom_equipo($test_id)."</td>";                        //FUNCI�N 22
                        if($col_mostrar[0]["col_resultado"]){
                                if(!con_text_area($test_id)){
                                        $fila.= "<td class='$theme'>";
                                        $fila.= generar_listbox_2($valores_validos, $numFila, $sololectura);                                                                                                                //FUNCI�N 12
                                        $fila.= generar_valores_hidden($peticion, $test_id, $muestra_id, $estado_id=5, $numFila,$fecha_creacion="",$hora_creacion="");                                        //FUNCI�N 16
                                }
                                else{
                                        $fila.= "<td class='$theme'>";
                                        $fila.= generar_text_area($resultado_id="", $valor="", $numFila, $sololectura);
                                        $fila.= generar_valores_hidden($peticion, $test_id, $muestra_id, $estado_id=5, $numFila,$fecha_creacion="",$hora_creacion="");        //FUNCI�N 16
                                        $fila.="</td>";
                                }
                        }
                        if($col_mostrar[0]["col_estado"])        $fila.= "<td class='$theme'>&nbsp;".nom_estado($valor["estado_id"])."</td>";//FUNCI�N 23
                        if($col_mostrar[0]["col_archivo"])        $fila.= "<td class='$theme' align='center'>".link_imagen($peticion,$test_id,$muestra_id,5,$numFila,$pagina,$fecha_creacion="",$hora_creacion="")."</td>"; //FUNCI�N 27
                        if($col_mostrar[0]["col_mult_resultado"]) $fila.= "<td class='$theme' align='center'>".link_add_resultado($peticion,$test_id,$muestra_id,$pagina)."</td>";
                        $fila.="</tr>";
                        $numFila++;
                }
                else{ // aqu� entra si el test es compuesto
                        $fila.= "<tr>";
                        if($col_mostrar[0]["col_test"])        {
                                if($col_mostrar[0]["col_peticion"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                if($col_mostrar[0]["col_muestraID"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                if($col_mostrar[0]["col_paciente"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                        $fila.=        "<td class='$theme' colspan=''>".
                                                                generar_resultado_id($valor["resultado_id"],$numFila).
                                                                nombre_test($test_id, $decompuesto).
                                                                generar_valores_hidden($peticion, $test_id, $valor["muestra_id"], $valor["estado_id"], $numFila,$fecha_creacion="",$hora_creacion="").
                                                        "</td>";
                                        if($col_mostrar[0]["col_seccion"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_equipo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_resultado"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_estado"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_archivo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_mult_resultado"]) { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                        }
                        $fila.="</tr>";
                        $numFila++;
                }

        }
        elseif($cantidad_valores_encontrados == 0 && $cantidad_valores_validos <= 1){ //Se genera un textbox

                $estado_id =0;

                if(!compuesto($test_id)){                                                                                                                                                                                        //FUNCI�N 11
                        $fila.= "<tr>";
                        if($col_mostrar[0]["col_peticion"])        $fila.= "<td class='$theme'>&nbsp;".$peticion."</td>";
                        if($col_mostrar[0]["col_muestraID"])$fila.= "<td class='$theme'>&nbsp;".$muestra_id."</td>";
                        if($col_mostrar[0]["col_paciente"])        $fila.= "<td class='$theme'>&nbsp;".nom_paciente($peticion)."</td>";                //FUNCI�N 20
                        if($col_mostrar[0]["col_test"])                $fila.=        "<td class='$theme' nowrap>".nombre_test($test_id, $decompuesto)."</td>";        //FUNCI�N 10
                        if($col_mostrar[0]["col_seccion"])        $fila.= "<td class='$theme'>&nbsp;".nom_seccion($test_id)."</td>";                        //FUNCI�N 21
                        if($col_mostrar[0]["col_equipo"])        $fila.= "<td class='$theme'>&nbsp;".nom_equipo($test_id)."</td>";                        //FUNCI�N 22
                        if($col_mostrar[0]["col_resultado"]){
                                if(!con_text_area($test_id)){
                                        $fila.= "<td class='$theme'>";
                                        $fila.= generar_textbox_1($numFila, $sololectura);                                                                                                                                                //FUNCI�N 13
                                        $fila.= generar_valores_hidden($peticion, $test_id, $muestra_id, $estado_id, $numFila,$fecha_creacion="",$hora_creacion="");                                                //FUNCI�N 16
                                }
                                else{
                                        $fila.= "<td class='$theme'>";
                                        $fila.= generar_text_area($resultado_id="", $valor="", $numFila, $sololectura);
                                        $fila.= generar_valores_hidden($peticion, $test_id, $muestra_id, $estado_id, $numFila,$fecha_creacion="",$hora_creacion="");                //FUNCI�N 16
                                        $fila.="</td>";
                                }
                        }
                        if($col_mostrar[0]["col_estado"])        $fila.= "<td class='$theme'>&nbsp;".nom_estado($estado_id)."</td>";                        //FUNCI�N 23
                        if($col_mostrar[0]["col_archivo"])        $fila.= "<td class='$theme' align='center'>".link_imagen($peticion,$test_id,$muestra_id,$estado_id,$numFila,$pagina,$fecha_creacion="",$hora_creacion="")."</td>"; //FUNCI�N 27
                        if($col_mostrar[0]["col_mult_resultado"]) $fila.= "<td class='$theme' align='center'>".link_add_resultado($peticion,$test_id,$muestra_id,$pagina)."</td>";
                        $fila.="</tr>";
                        $numFila++;
                }
                else{ // aqu� entra si el test es compuesto
                        $fila.= "<tr>";
                        if($col_mostrar[0]["col_test"])        {
                                if($col_mostrar[0]["col_peticion"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                if($col_mostrar[0]["col_muestraID"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                if($col_mostrar[0]["col_paciente"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                        $fila.=        "<td class='$theme' colspan=''>".
                                                                generar_resultado_id($valor["resultado_id"],$numFila).
                                                                nombre_test($test_id, $decompuesto).
                                                                generar_valores_hidden($peticion, $test_id, $valor["muestra_id"], $valor["estado_id"], $numFila,$fecha_creacion="",$hora_creacion="").
                                                        "</td>";
                                if($col_mostrar[0]["col_seccion"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                if($col_mostrar[0]["col_equipo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                if($col_mostrar[0]["col_resultado"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                if($col_mostrar[0]["col_estado"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                if($col_mostrar[0]["col_archivo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                if($col_mostrar[0]["col_mult_resultado"]) { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                        }
                        $fila.="</tr>";
                        $numFila++;
                }
        }
        elseif($cantidad_valores_encontrados == 1 && $cantidad_valores_validos <= 1){ //Se genera un textbox

                $estado_id = $valores_encontrados[0]["estado_id"];
                $muestra_id= $valores_encontrados[0]["muestra_id"];
                $resultado_id= $valores_encontrados[0]["resultado_id"];
                $fecha_creacion= $valores_encontrados[0]["fecha_creacion"];
                $hora_creacion= $valores_encontrados[0]["hora_creacion"];


                if(!compuesto($test_id)){                                                                                                                                                                                        //FUNCI�N 11
                        $fila.= "<tr>";
                        if($col_mostrar[0]["col_peticion"])        $fila.= "<td class='$theme'>&nbsp;".$peticion."</td>";
                        if($col_mostrar[0]["col_muestraID"])$fila.= "<td class='$theme'>&nbsp;".$muestra_id."</td>";
                        if($col_mostrar[0]["col_paciente"])        $fila.= "<td class='$theme'>&nbsp;".nom_paciente($peticion)."</td>";                //FUNCI�N 20
                        if($col_mostrar[0]["col_test"])                $fila.=        "<td class='$theme' nowrap>".nombre_test($test_id, $decompuesto)."</td>";        //FUNCI�N 10
                        if($col_mostrar[0]["col_seccion"])        $fila.= "<td class='$theme'>&nbsp;".nom_seccion($test_id)."</td>";                        //FUNCI�N 21
                        if($col_mostrar[0]["col_equipo"])        $fila.= "<td class='$theme'>&nbsp;".nom_equipo($test_id)."</td>";                        //FUNCI�N 22
                        if($col_mostrar[0]["col_resultado"]){
                                if(!con_text_area($test_id)){
                                        $fila.= "<td class='$theme'>";
                                        $fila.= generar_textbox_2($valores_encontrados, $numFila, $sololectura);                                                                                                        //FUNCI�N 14
                                        $fila.= generar_valores_hidden($peticion, $test_id, $muestra_id, $estado_id, $numFila,$fecha_creacion,$hora_creacion);                                                //FUNCI�N 16
                                }
                                else{
                                        $fila.= "<td class='$theme'>";
                                        $fila.= generar_text_area($resultado_id,$valores_encontrados[0]["valor"], $numFila, $sololectura);
                                        $fila.= generar_valores_hidden($peticion, $test_id, $muestra_id, $estado_id, $numFila,$fecha_creacion,$hora_creacion);        //FUNCI�N 16
                                        $fila.="</td>";
                                }
                        }
                        if($col_mostrar[0]["col_estado"])        $fila.= "<td class='$theme'>&nbsp;".nom_estado($estado_id)."</td>";                        //FUNCI�N 23
                        if($col_mostrar[0]["col_archivo"])        $fila.= "<td class='$theme' align='center'>".link_imagen($peticion,$test_id,$muestra_id,$estado_id,$numFila,$pagina,$fecha_creacion,$hora_creacion)."</td>"; //FUNCI�N 27
                        if($col_mostrar[0]["col_mult_resultado"]) $fila.= "<td class='$theme' align='center'>".link_add_resultado($peticion,$test_id,$muestra_id,$pagina)."</td>";
                        $fila.="</tr>";
                        $numFila++;
                }
                else{ // aqu� entra si el test es compuesto
                        $fila.= "<tr>";
                        if($col_mostrar[0]["col_test"])        {
                                if($col_mostrar[0]["col_peticion"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                if($col_mostrar[0]["col_muestraID"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                if($col_mostrar[0]["col_paciente"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                        $fila.=        "<td class='$theme' colspan=''>".
                                                                generar_resultado_id($resultado_id,$numFila).
                                                                nombre_test($test_id, $decompuesto).
                                                                generar_valores_hidden($peticion, $test_id, $valor["muestra_id"], $valor["estado_id"], $numFila,$fecha_creacion,$hora_creacion).
                                                        "</td>";
                                        if($col_mostrar[0]["col_seccion"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_equipo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_resultado"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_estado"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_archivo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_mult_resultado"]) $fila.= "<td class='$theme'>&nbsp;</td>";
                        }
                        $fila.="</tr>";
                        $numFila++;
                }
        }
        elseif($cantidad_valores_encontrados > 0 && $cantidad_valores_validos <= 1){ //Se genera un textbox

                $contResult=1;
                while(list($clave, $valor) = each($valores_encontrados)){ //por cada resultado encontrado genero una fila

                        if(!compuesto($test_id)){                                                                                                                                                                        //FUNCI�N 11
                                $fila.= "<tr>";
                                if($col_mostrar[0]["col_peticion"])        $fila.= "<td class='$theme'>&nbsp;".$peticion."</td>";
                                if($col_mostrar[0]["col_muestraID"])$fila.= "<td class='$theme'>&nbsp;".$muestra_id."</td>";
                                if($col_mostrar[0]["col_paciente"])        $fila.= "<td class='$theme'>&nbsp;".nom_paciente($peticion)."</td>";//FUNCI�N 20
                                if($cantidad_valores_encontrados > 1){
                                        if($col_mostrar[0]["col_test"])        $fila.=        "<td class='$theme' nowrap>".nombre_test($test_id, $decompuesto)."&nbsp;($contResult)</td>";//FUNCI�N 10
                                }
                                else{
                                        if($col_mostrar[0]["col_test"])        $fila.=        "<td class='$theme' nowrap>".nombre_test($test_id, $decompuesto)."&nbsp;</td>";//FUNCI�N 10
                                }
                                if($col_mostrar[0]["col_seccion"])        $fila.= "<td class='$theme'>&nbsp;".nom_seccion($test_id)."</td>";                        //FUNCI�N 21
                                if($col_mostrar[0]["col_equipo"])        $fila.= "<td class='$theme'>&nbsp;".nom_equipo($test_id)."</td>";                        //FUNCI�N 22
                                if($col_mostrar[0]["col_resultado"]){
                                        if(!con_text_area($test_id)){
                                                $fila.= "<td class='$theme'>";
                                                $fila.= generar_textbox_3($valor["resultado_id"], $valor["valor"], $valores_validos, $numFila, $sololectura);                                //FUNCI�N 15
                                                $fila.= generar_valores_hidden($peticion, $test_id, $valor["muestra_id"], $valor["estado_id"], $numFila,$valor["fecha_creacion"],$valor["hora_creacion"]);        //FUNCI�N 16
                                        }
                                        else{
                                                $fila.= "<td class='$theme'>";
                                                $fila.= generar_text_area($valor["resultado_id"],$valores_encontrados[0]["valor"], $numFila, $sololectura);
                                                $fila.= generar_valores_hidden($peticion, $test_id, $valor["muestra_id"], $valor["estado_id"], $numFila,$valor["fecha_creacion"],$valor["hora_creacion"]);                //FUNCI�N 16
                                                $fila.="</td>";
                                        }
                                }
                                if($col_mostrar[0]["col_estado"])        $fila.= "<td class='$theme'>&nbsp;".nom_estado($valor["estado_id"])."</td>";//FUNCI�N 23
                                if($col_mostrar[0]["col_archivo"])        $fila.= "<td class='$theme' align='center'>".link_imagen($peticion,$test_id,$muestra_id,$valor["estado_id"],$numFila,$pagina,$valor["fecha_creacion"],$valor["hora_creacion"])."</td>"; //FUNCI�N 27
                                if($col_mostrar[0]["col_mult_resultado"]) $fila.= "<td class='$theme' align='center'>".link_add_resultado($peticion,$test_id,$muestra_id,$pagina)."</td>";
                                $fila.="</tr>";
                                $numFila++;
                        }
                        else{// aqu� entra si el test es compuesto
                                $fila.= "<tr>";
                                if($col_mostrar[0]["col_test"])        {
                                        if($col_mostrar[0]["col_peticion"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                        if($col_mostrar[0]["col_muestraID"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                        if($col_mostrar[0]["col_paciente"])        { $fila.= "<td class='$theme'>&nbsp;</td>"; $colspan--; }
                                        $fila.=        "<td class='$theme' colspan=''>".
                                                                generar_resultado_id($valor["resultado_id"],$numFila).
                                                                nombre_test($test_id, $decompuesto).
                                                                generar_valores_hidden($peticion, $test_id, $valor["muestra_id"], $valor["estado_id"], $numFila,$valor["fecha_creacion"],$valor["hora_creacion"]).
                                                        "</td>";
                                        if($col_mostrar[0]["col_seccion"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_equipo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_resultado"]){ $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_estado"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_archivo"])         { $fila.= "<td class='$theme'>&nbsp;</td>"; }
                                        if($col_mostrar[0]["col_mult_resultado"]) $fila.= "<td class='$theme'>&nbsp;</td>";
                                }
                                $fila.="</tr>";
                                $numFila++;
                        }
                        $contResult++;
                }
        }
        $grilla->filas->SetValue($numFila);
        return $fila;
}
//Fin funci�n "generar_fila_grilla"
//------------------------------------------------- FUNCI�N ( 06 )------------------------------------------------------------
//Crea el pie de la grilla de resultados de petici�n
function genera_pie_grilla($col_mostrar){
        $colspan= 0;
        if($col_mostrar[0]["col_peticion"])         $colspan++;
        if($col_mostrar[0]["col_muestraID"])         $colspan++;
        if($col_mostrar[0]["col_paciente"])         $colspan++;
        if($col_mostrar[0]["col_test"])                 $colspan++;
        if($col_mostrar[0]["col_seccion"])                 $colspan++;
        if($col_mostrar[0]["col_equipo"])                 $colspan++;
        if($col_mostrar[0]["col_resultado"])         $colspan++;
        if($col_mostrar[0]["col_estado"])                 $colspan++;
        if($col_mostrar[0]["col_archivo"])                 $colspan++;
        if($col_mostrar[0]["col_mult_resultado"]) $colspan++;

        $pie = "<tr>
                                <td align='center' colspan='$colspan' class='InLineFooterTD'>
                                <!-- BEGIN Button Button_Submit -->
                                        <input class='InLineButton' type='submit' name='Guardar' value='Guardar'>
                                <!-- END Button Button_Submit -->
                                        <input class='InLineButton' type='button' name='Cancelar' value='Cancelar' onclick='javascript: cancelar();'>
                                </td>
                        </tr>
                        </table>";
        return $pie;
}
//Fin funci�n "genera_pie_grilla"
//------------------------------------------------- FUNCI�N ( 07 )------------------------------------------------------------
//Entrega un array con los campos "resultado_id, muestra_id y valor" de la tabla "resultados" seg�n la petici�n_id y test_id.
function buscar_resultados($test, $peticion){
        $db = new clsDBDatos();
        $sSQL="SELECT resultado_id, muestra_id, estado_id, valor, fecha_creacion, hora_creacion FROM resultados WHERE test_id='$test' AND peticion_id='$peticion' ORDER BY resultado_id";
        $db->query($sSQL);
        $valores = array();
        while($db->next_record()){
                $v = array();
                $v["resultado_id"] = $db->f("resultado_id");
                $v["muestra_id"] = $db->f("muestra_id");
                $v["estado_id"] = $db->f("estado_id");
                $v["valor"] = $db->f("valor");
                $v["fecha_creacion"] = $db->f("fecha_creacion");
                $v["hora_creacion"] = $db->f("hora_creacion");
                $valores[] = $v;
        }
        unset($db);
        return $valores;
}
//Fin funci�n "buscar_resultados"
//------------------------------------------------- FUNCI�N ( 08 )------------------------------------------------------------
//Entrega un array con los campos "nom_resultado y predeterminado" de la tabla "valores_resultado" para un test espec�fico
function  valores_resultados($test){
        $db = new clsDBDatos();
        $db->query("SELECT nom_resultado, predeterminado FROM valores_resultado WHERE test_id='$test'");
        $valores_validos= array();
        while($db->next_record()){
                $v = array();
                $v["nom_resultado"] = $db->f("nom_resultado");
                $v["predeterminado"] = $db->f("predeterminado");
                $valores_validos[] = $v;
        }
        unset($db);
        return $valores_validos;
}
//Fin funci�n "valores_resultados"
//------------------------------------------------- FUNCI�N ( 09 )------------------------------------------------------------
//Genera un listbox con los valores encontrados en la tabla "valores_resultados" y "resultados"
function generar_listbox_1($resultado_id, $valor_encontrado, $valores_validos, $numFila, $sololectura){

if ($sololectura!="") $sololectura="disable";

        if(estado_validacion_aceptado($resultado_id)){
                $textbox = "<b>$valor_encontrado</b>";
                $textbox .= "<input type='hidden' value='$valor_encontrado' name='valor_enviar_$numFila' id='valor_enviar_$numFila'  style='width:100%' $disable>
                                <input type='hidden' value='$resultado_id' name='id_resultado_$numFila' id='id_resultado_$numFila' style='width:100%'>";
                return        $textbox;
        }
        else{
                $listbox = "<select name='lista_$numFila' id='lista_$numFila' style='width:100%' onchange=\"javascript: pasar_valor('lista_$numFila','valor_enviar_$numFila','id_resultado_$numFila');\" $sololectura>
                                        <option value='$resultado_id'></option>\n";

                while(list($clave, $valor) = each($valores_validos)){
                        if($valor_encontrado == $valor["nom_resultado"]){
                                $listbox.="<option value='$resultado_id' selected>".$valor["nom_resultado"]."</option>\n";
                        }
                        else{
                                $listbox.="<option value='$resultado_id'>".$valor["nom_resultado"]."</option>\n";
                        }
                }
                $listbox.="</select>\n";
                $listbox.="<input type='hidden' value='$valor_encontrado' name='valor_enviar_$numFila' id='valor_enviar_$numFila' style='width:100%'>
                                   <input type='hidden' value='$resultado_id' name='id_resultado_$numFila' id='id_resultado_$numFila' style='width:100%'>";

                return $listbox;
        }

}
//Fin funci�n "generar_listbox_1"
//------------------------------------------------- FUNCI�N ( 10 )------------------------------------------------------------
//Recive el ID de un test y entrega su nombre
function nombre_test($test_id, $decompuesto){
        $db = new clsDBDatos();
        $db->query("SELECT nom_test FROM test WHERE test_id='$test_id'");
        if($db->next_record())
                if($decompuesto=="V") $nom_test .= "<b>--></b> ";

                if(!compuesto($test_id))//FUNCI�N 11
                        $nom_test .= $db->f("nom_test");
                else
                        $nom_test .= "<b>".$db->f("nom_test")."</b>";

        unset($db);
        return $nom_test;
}
//Fin funci�n "nombre_test"
//------------------------------------------------- FUNCI�N ( 11 )------------------------------------------------------------
//Verifica si un test es compuesto o no.
function compuesto($test){
        $db = new clsDBDatos();
        //$db->query("SELECT count(*) AS esta FROM compuesto_detalle WHERE comp_test_id='$test'");
        $db->query("SELECT compuesto FROM test WHERE test_id='$test'");
        if($db->next_record()){
                if($db->f("compuesto")=="V")
                        return true;
                else
                        return false;
        }
        else{
                return false;
        }
        unset($db);
}
//Fin funci�n "compuesto"
//------------------------------------------------- FUNCI�N ( 12 )------------------------------------------------------------
//Genera un listbox con los valores encontrados en la tabla "valores_resultados"
function generar_listbox_2($valores_validos, $numFila, $sololectura)
{
    if ($sololectura !="") $sololectura='disable';

        $listbox = "<select name='lista_$numFila' id='lista_$numFila' style='width:100%' onchange=\"javascript: pasar_valor('lista_$numFila','valor_enviar_$numFila','id_resultado_$numFila');\" $sololectura>
                                        <option value=''></option>\n";

        while(list($clave, $valor) = each($valores_validos)){
                if($valor["predeterminado"] == "V"){
                        $listbox.="<option value='' selected>".$valor["nom_resultado"]."</option>\n";
                }
                else{
                        $listbox.="<option value=''>".$valor["nom_resultado"]."</option>\n";
                }
        }
        $listbox.="</select>\n";
        $listbox.="<input type='hidden' value='' name='valor_enviar_$numFila' id='valor_enviar_$numFila' style='width:100%'>
                           <input type='hidden' value='' name='id_resultado_$numFila' id='id_resultado_$numFila' style='width:100%'>";
        return $listbox;
}
//Fin funci�n "generar_listbox_2"
//------------------------------------------------- FUNCI�N ( 13 )------------------------------------------------------------
//Genera un textbox
function generar_textbox_1($numFila, $sololectura){

        $textbox = "<input type='text' value='' name='valor_enviar_$numFila' id='valor_enviar_$numFila' style='width:100%' $sololectura>
                                <input type='hidden' value='' name='id_resultado_$numFila' id='id_resultado_$numFila' style='width:100%'>";
        return        $textbox;
}
//Fin funci�n "generar_textbox_1"
//------------------------------------------------- FUNCI�N ( 14 )------------------------------------------------------------
//Genera un textbox
function generar_textbox_2($valores_encontrados, $numFila, $sololectura){

        $resultado_id = $valores_encontrados[0]["resultado_id"];
        $valor = $valores_encontrados[0]["valor"];

        if(estado_validacion_aceptado($resultado_id)){
                $textbox = "<b>$valor</b>";
                $type = "hidden";
        }
        else{
                $textbox = "";
                $type = "text";
        }

        $textbox .= "<input type='$type' value='$valor' name='valor_enviar_$numFila' id='valor_enviar_$numFila' style='width:100%' $disable $sololectura>
                                <input type='hidden' value='$resultado_id' name='id_resultado_$numFila' id='id_resultado_$numFila' style='width:100%'>";
        return        $textbox;
}
//Fin funci�n "generar_textbox_2"
//------------------------------------------------- FUNCI�N ( 15 )------------------------------------------------------------
//Genera un textbox
function generar_textbox_3($resultado_id, $valor, $valores_validos, $numFila, $sololectura){

        if(estado_validacion_aceptado($resultado_id)){
                $textbox = "<b>$valor</b>";
                $type = "hidden";
        }
        else{
                $textbox = "";
                $type = "text";
        }

        $textbox .= "<input type='$type' value='$valor' name='valor_enviar_$numFila' id='valor_enviar_$numFila' style='width:100%' $disable $sololectura>
                                <input type='hidden' value='$resultado_id' name='id_resultado_$numFila' id='id_resultado_$numFila' style='width:100%'>";

        return        $textbox;
}
//Fin funci�n "generar_textbox_3"
//------------------------------------------------- FUNCI�N ( 16 )------------------------------------------------------------
//Guardar todos los cambios en tabla "resultados"
function guardar_resultados($pet)
{
    //Nueva instancia de la base de Datos
        $db = new clsDBDatos();

    //recupera el n�mero de l�neas
        $total_registros = CCGetParam("filas","");
        //echo "total: $total_registros ";
        for($i=1;$i<intval($total_registros);$i++)
        {
        //recupera los datos desde los paramateros
                $peticion_id = CCGetParam("peticion_id_$i","");
                $test_id = CCGetParam("test_id_$i","");
                $muestra_id = CCGetParam("muestra_id_$i","");
                $fecha_creacion = CCGetParam("fecha_creacion_$i","");
                $hora_creacion = CCGetParam("hora_creacion_$i","");
                $fecha_modificacion = CCGetParam("fecha_modificacion_$i","");
                $hora_modificacion = CCGetParam("hora_modificacion_$i","");
                $estado_id = CCGetParam("estado_id_$i","");
                $ingresado_por = CCGetParam("ingresado_por_$i","");

                $resultado_id = CCGetParam("id_resultado_$i","");
                $valor_enviar = CCGetParam("valor_enviar_$i","");

                if($fecha_creacion=="" || $fecha_creacion=="0000-00-00 00:00:00")
                        $fecha_creacion = asigna_fecha($test_id,$muestra_id, $peticion_id, $fecha_creacion="0000-00-00 00:00:00");

                if($hora_creacion=="" || $hora_creacion=="0000-00-00 00:00:00")
                        $hora_creacion = asigna_hora($test_id,$muestra_id, $peticion_id, $hora_creacion="0000-00-00 00:00:00");

                //die("Fecha: $fecha_creacion<br/>Hora: $hora_creacion<br/>Entro a: $entro<br/>(test_id:$test_id,Muestra:$muestra_id,Peticion:$peticion_id)");

        $sSQL ="";
        //si resultado_id no es vacio (ya existe) y valor-enviar no es vacio (hay un resultado)
        //prepara actualizacion  del ersultado_id con el valor_enviado
                if($resultado_id!="" && $valor_enviar!="") //update
                {
                        $sSQL = "UPDATE resultados SET
                                                fecha_modificacion='$fecha_modificacion',
                                                hora_modificacion='$hora_modificacion',
                                                estado_id='$estado_id',
                                                ingresado_por='$ingresado_por',
                                                valor='$valor_enviar'
                                                WHERE resultado_id='$resultado_id'";
                        //echo "$update<br/>";
                        //$db->query($update);
                }

        //Si hay resultado y viene vacio, no es compuesto pero trae un archivo adjunto
                elseif($resultado_id!="" && $valor_enviar=="" && !compuesto($test_id) && con_archivo_adjunto($resultado_id)) //Update
                {
                        $sSQL = "UPDATE resultados SET
                                                fecha_modificacion='$fecha_modificacion',
                                                hora_modificacion='$hora_modificacion',
                                                estado_id='$estado_id',
                                                ingresado_por='$ingresado_por',
                                                valor='$valor_enviar'
                                                WHERE resultado_id='$resultado_id'";
                        //echo "$update<br/>";
                        //$db->query($update);
                }

        //no hay resultado, no hay valor_enviar, no es compuesto ni trae adjunto
        //Hay que eliminarlo
                elseif($resultado_id!="" && $valor_enviar=="" && !compuesto($test_id) && !con_archivo_adjunto($resultado_id)) //delete
                {
                        $sSQL = "DELETE FROM resultados WHERE resultado_id='$resultado_id'";
                        //echo "$delete<br/>";
                        //$db->query($delete);
                }

        //No hay resultado y viene un valor, es nuevo
        //Hay que insertarlo
                elseif($resultado_id=="" && $valor_enviar!="") //insert
                {
                        $estado_id = estado_x_defecto("resultados"); //FUNCI�N 24

                        $sSQL = "INSERT INTO resultados
                                        (peticion_id,test_id,muestra_id,fecha_creacion,hora_creacion,fecha_modificacion,hora_modificacion,estado_id,
                                        ingresado_por,valor)
                                        VALUES
                                        ('$peticion_id','$test_id','$muestra_id','$fecha_creacion','$hora_creacion','$fecha_modificacion',
                                        '$hora_modificacion','$estado_id','$ingresado_por','$valor_enviar')";
                        //echo "$insert<br/>";
                        //$db->query($insert);
                }
/*
        Agregado: 14-04-05
        No se almacena nada en los compuestos
        //Es un compuesto nuevo
        //Hay quie insertarlo
                elseif(compuesto($test_id) && $resultado_id=="") //insert COMPUESTO
                {
                        //$estado_id = estado_x_defecto("resultados"); //FUNCI�N 24

                        $sSQL = "INSERT INTO resultados
                                        (peticion_id,test_id,muestra_id,fecha_creacion,hora_creacion,fecha_modificacion,hora_modificacion,estado_id,
                                        ingresado_por,valor)
                                        VALUES
                                        ('$peticion_id','$test_id','$muestra_id','$fecha_creacion','$hora_creacion','$fecha_modificacion',
                                        '$hora_modificacion','$estado_id','$ingresado_por','')";
                        //echo "$insert<br/>";
                        //$db->query($insert);
                }

        //Es un compuesto que ya existe
        //Hay que actualizarlo
                if(compuesto($test_id) && $resultado_id!="") //update COMPUESTO
                {
                        $sSQL = "UPDATE resultados SET
                                                fecha_modificacion='$fecha_modificacion',
                                                hora_modificacion='$hora_modificacion',
                                                estado_id='$estado_id',
                                                ingresado_por='$ingresado_por',
                                                valor=''
                                                WHERE resultado_id='$resultado_id'";
                        //echo "$update<br/>";
                        //$db->query($update);
                }
*/

                //Me aseguro de que si es compuesto no tenga resultado
                if (compuesto($test_id)){
                        $sSQL="DELETE FROM resultados WHERE test_id=$test_id AND peticion_id=$peticion_id";
                        $db->query($sSQL);
        //Luego inserto uno vac�o si es compuesto

                        $sSQL = "INSERT INTO resultados
                                        (peticion_id,test_id,muestra_id,fecha_creacion,hora_creacion,fecha_modificacion,hora_modificacion,estado_id,
                                        ingresado_por,valor)
                                        VALUES
                                        ('$peticion_id','$test_id','$muestra_id','$fecha_creacion','$hora_creacion','$fecha_modificacion',
                                        '$hora_modificacion','$estado_id','$ingresado_por','')";
        }






        //Ejecutar la consulta si hay  algo que ejecutrar
        if ($sSQL!="") $db->query($sSQL);
        //Solo en etapa de depuraci�n
        //echo "Resultado_id=$resultado_id<br/>Valor=$valor_enviar<br/>";
        //echo "--> $sSQL<br/><br/>";
        }
        unset($db);
//        die(header("Location:add_resultados_peticion2.php?s_test_id=$pet"));
}
//Fin funci�n "guardar_resultados"
//------------------------------------------------- FUNCI�N ( 17 )------------------------------------------------------------
//Genera los hidden con los valores de los campos peticion_id, test_id, muestra_id, estado_id, fecha_creacion, fecha_modificacion
//hora_creacion, hora_mpdificacion, ingresado_por.
function generar_valores_hidden($peticion_id, $test_id, $muestra_id, $estado_id, $numFila,$fecha_creacion, $hora_creacion){
        $type="hidden";
        $text_hidden="<input type='$type' value='".$peticion_id."' name='peticion_id_$numFila'>\n".
                                "<input type='$type' value='".$test_id."' name='test_id_$numFila'>\n".
                                "<input type='$type' value='".$muestra_id."' name='muestra_id_$numFila'>\n".
                                "<input type='$type' value='".$estado_id."' name='estado_id_$numFila'>\n".
                                "<input type='$type' value='".asigna_fecha($test_id,$muestra_id, $peticion_id, $fecha_creacion)."' name='fecha_creacion_$numFila'>\n".         //FUNCI�N 17
                                "<input type='$type' value='".asigna_hora($test_id,$muestra_id, $peticion_id, $hora_creacion)."' name='hora_creacion_$numFila'>\n".        //FUNCI�N 18
                                "<input type='$type' value='".GetFechaServer("server")."' name='fecha_modificacion_$numFila'>\n".
                                "<input type='$type' value='".GetFechaServer("server_hora")."' name='hora_modificacion_$numFila'>\n".
                                "<input type='$type' value='".CCGetUserID()."' name='ingresado_por_$numFila'>\n";

        return $text_hidden;
}
//Fin funci�n "generar_valores_hidden"
//------------------------------------------------- FUNCI�N ( 18 )------------------------------------------------------------
//Asigna Fecha
function asigna_fecha($test,$muestra,$peticion,$fecha_creacion){
        if($fecha_creacion == "" || $fecha_creacion == "0000-00-00 00:00:00"){
                $db = new clsDBDatos();
                $db->query("SELECT fecha_creacion FROM resultados WHERE test_id='$test' AND muestra_id='$muestra' AND peticion_id='$peticion'");
                if($db->next_record()){
                        if($db->f("fecha_creacion")!="0000-00-00 00:00:00")
                                return $db->f("fecha_creacion");
                        else
                                return GetFechaServer("server");
                }
                else
                        return GetFechaServer("server");
        }
        else
                return $fecha_creacion;
}
//Fin funci�n "asigna_fecha"
//------------------------------------------------- FUNCI�N ( 19 )------------------------------------------------------------
//Asigna hora
function asigna_hora($test,$muestra,$peticion, $hora_creacion){
        if($hora_creacion=="" || $hora_creacion=="0000-00-00 00:00:00"){
                $db = new clsDBDatos();
                $db->query("SELECT hora_creacion FROM resultados WHERE test_id='$test' AND muestra_id='$muestra' AND peticion_id='$peticion'");
                if($db->next_record()){
                        if($db->f("hora_creacion")!="0000-00-00 00:00:00")
                                return $db->f("hora_creacion");
                        else
                                return GetFechaServer("server_hora");
                }
                else
                        return GetFechaServer("server_hora");
        }
        else
                return $hora_creacion;
}
//Fin funci�n "asigna_hora"
//------------------------------------------------- FUNCI�N ( 20 )------------------------------------------------------------
//Verifica si un petici�n especifica existe en la base de datos
function existe_peticion($peticion_id){
        $db = new clsDBDatos;
        $db->query("SELECT count(*) as cantidad FROM peticiones WHERE peticion_id='$peticion_id'");
        if($db->next_record()){
                if(intval($db->f("cantidad")) != 0) return true;
                else return false;
        }
        unset($db);
}
//Fin funci�n "existe_peticion"
//------------------------------------------------- FUNCI�N ( 21 )------------------------------------------------------------
//Entrega el nombre completo de un paciente a traves del n� de petici�n.
function nom_paciente($peticion){
        $db = new clsDBDatos();
        $db->query("SELECT nombres, apellidos FROM pacientes AS pac, peticiones as pet WHERE pac.paciente_id = pet.paciente_id AND pet.peticion_id='$peticion'");
        if($db->next_record()){
                $nombres = $db->f("nombres");
                $apellidos = $db->f("apellidos");
        }
        unset($db);
        return "$nombres $apellidos";
}
//Fin funci�n "nom_paciente"
//------------------------------------------------- FUNCI�N ( 22 )------------------------------------------------------------
//Entrega el nombre de una secci�n al cual pertenece un test en particular a traves del campo test_id
function nom_seccion($test_id){
        $db = new clsDBDatos();
        $db->query("SELECT nom_seccion FROM secciones AS s, test as t WHERE t.secciones_id = s.seccion_id AND t.test_id='$test_id'");
        if($db->next_record()) $seccion = $db->f("nom_seccion");
        unset($db);
        return $seccion;
}
//Fin funci�n "nom_seccion"
//------------------------------------------------- FUNCI�N ( 23 )------------------------------------------------------------
//Entrega el nombre de un equipo al cual pertenece un test en particular a traves del campo test_id
function nom_equipo($test_id){
        $db = new clsDBDatos();
        $db->query("SELECT nom_equipo FROM equipos AS e, test as t WHERE e.equipo_id = t.equipo_id AND t.test_id='$test_id'");
        if($db->next_record()) $equipo = $db->f("nom_equipo");
        unset($db);
        return $equipo;
}
//Fin funci�n "nom_equipo"
//------------------------------------------------- FUNCI�N ( 24 )------------------------------------------------------------
//Entrega el nombre del estado el cual se encuentra un test en particular
function nom_estado($estado_id){
        $db = new clsDBDatos();
        $db->query("SELECT nom_estado FROM estados WHERE estado_id='$estado_id'");
        if($db->next_record()) $estado = $db->f("nom_estado");
        else $estado = "";
        unset($db);
        return $estado;
}
//Fin funci�n "nom_estado"
//------------------------------------------------- FUNCI�N ( 25 )------------------------------------------------------------
//Entrega el nombre del estado por defecto o predeterminado que debe tener los resultados
function estado_x_defecto($tabla){
        $db = new clsDBDatos();
        $db->query("SELECT estado_id FROM estados WHERE usar_en='$tabla' AND predeterminado='V' AND activo='V'");
        if($db->next_record()) $estado = intval($db->f("estado_id"));
        else $estado = 0;
        unset($db);
        return $estado;
}
//Fin funci�n "estado_x_defecto"
//------------------------------------------------- FUNCI�N ( 26 )------------------------------------------------------------
//genera un hidden con el resultado_id
function generar_resultado_id($resultado_id,$numFila){
        return "<input type='hidden' value='".$resultado_id."' name='id_resultado_$numFila' id='id_resultado_$numFila' >\n
                         <input type='hidden' value='SIN VALOR' name='valor_enviar_$numFila' id='valor_enviar_$numFila' style='width:100%'>";
}
//Fin funci�n "generar_resultado_id"
//------------------------------------------------- FUNCI�N ( 27 )------------------------------------------------------------
//genera un link al archivo de imagen si existe
function link_imagen($peticion,$test_id,$muestra_id,$estado_id,$numFila,$pagina,$fecha_creacion,$hora_creacion)
{
    //    $estado_id=10;
    if(con_archivo($test_id))
    {
            $db = new clsDBDatos();
            $db->query("SELECT secciones_id, equipo_id FROM test WHERE test_id='$test_id'");
            if($db->next_record()) {
                $seccion_id = $db->f("secciones_id");
                $equipo_id = $db->f("equipo_id");
                $parametros = "&s_secciones_id=$seccion_id&s_equipo_id=$equipo_id&s_test_id=$test_id";
            }
            $db->query("SELECT paciente_id FROM peticiones WHERE peticion_id='$peticion'");
            if($db->next_record()) {
                $paciente_id = $db->f("paciente_id");
                $parametros .= "&paciente_id=$paciente_id";
            }
            
            $db->query("SELECT resultado_id, archivo FROM resultados WHERE peticion_id='$peticion' AND test_id='$test_id' AND fecha_creacion='$fecha_creacion' AND hora_creacion='$hora_creacion'");
            if ($db->next_record())
            {
                $resultado_id = $db->f("resultado_id");
                
                $link = "";
                if ($estado_id==20)
                {
                    $link = '<a href="#" onclick="alert('."'Resultado Validado, No se puede editar'" . ');"><img src="images/attach.png" border="0"></a>';
                }
        } else {
            $link="<a href=\"#\"
                       onclick=\"javascript:popAdd_Imagen_2($peticion,$test_id,$muestra_id,$estado_id,'valor_enviar_$numFila','$pagina','$parametros');\">
                       <img src='images/drivemount-applet.png' border='0' alt='Adjuntar imagen'>
                       </a>";
            if ($estado_id==20) $link="<a href=\"#\" onclick=\"alert('Resultado Validado, No se puede editar');\"><img src='images/drivemount-applet.png' border='0' alt='Adjuntar imagen'></a>  ";
        }
        unset($db);
    } else {
        $link = "&nbsp;";
    }
    return $link;
}

//Fin funci�n "link_imagen"
//------------------------------------------------- FUNCI�N ( 28 )------------------------------------------------------------
//genera un link al archivo de imagen si existe
function con_archivo($test_id){
        $db = new clsDBDatos();
        $db->query("SELECT con_archivo FROM test WHERE test_id='$test_id'");
        if($db->next_record()){
                if($db->f("con_archivo")=="V")
                        return true;
                else
                        return false;
        }
        unset($db);
}
//Fin funci�n "con_archivo"
//------------------------------------------------- FUNCI�N ( 29 )------------------------------------------------------------
//genera una cadena con todos los parametros Get obtenidos
function obtener_parametros_get(){
        $cadena = "?";
        while(list($clave, $val)= each($_GET)){
                $cadena.= "$clave=$val&";
        }
        return($cadena);
}
//Fin funci�n "obtener_parametros_get"
//------------------------------------------------- FUNCI�N ( 30 )------------------------------------------------------------
//Verifica que un test en la tabla tesultado tenga un archivo adjunto o no.
function con_archivo_adjunto($resultado_id){
        $sSQL="SELECT archivo FROM resultados WHERE resultado_id = $resultado_id";
        $db = new clsDBDatos;
        $db->query($sSQL);
        if($db->next_record()){
                if(intval($db->f("archivo")) != "") return true;
                else return false;
        }
        unset($db);
}
//Fin funci�n "con_archivo"
//------------------------------------------------- FUNCI�N ( 31 )------------------------------------------------------------
//Verifica si un test tiene la propiedada de que el campo de resultado sea un text �rea
function con_text_area($test_id){
        $sSQL="SELECT con_text_area FROM test WHERE test_id = $test_id";
        $db = new clsDBDatos;
        $db->query($sSQL);
        if($db->next_record()){
                if($db->f("con_text_area") == "V") return true;
                else return false;
        }
        unset($db);
}
//Fin funci�n "con_text_area"
//------------------------------------------------- FUNCI�N ( 32 )------------------------------------------------------------
//Genera un campo de texr �rea para el ingreso de resultaods de los test
function generar_text_area($resultado_id, $valor, $numFila, $sololectura){
        if(estado_validacion_aceptado($resultado_id)){
                $textbox = "<b>$valor</b>";
                $textbox .= "<input type='hidden' value='$valor' name='valor_enviar_$numFila' id='valor_enviar_$numFila' style='width:100%' $disable>
                                <input type='hidden' value='$resultado_id' name='id_resultado_$numFila' id='id_resultado_$numFila' style='width:100%'>";
                return        $textbox;
        }
        else{
                return "<textarea name='valor_enviar_$numFila' id='valor_enviar_$numFila' rows='3' $sololectura style='width:100%'>$valor</textarea>
                                <input type='hidden' value='$resultado_id' name='id_resultado_$numFila' id='id_resultado_$numFila' style='width:100%'>";
        }

}
//Fin funci�n "generar_text_area"
//------------------------------------------------- FUNCI�N ( 33 )------------------------------------------------------------
//verificar si uno de los test_id pasados en el array tiene la propiedad de con_archivo
function usar_columna_archivo($peticiones){
        reset($peticiones);
        $db = new clsDBDatos();
        //$i=1;
        while(list($clave, $valor) = each($peticiones)){
                $db->query("SELECT con_archivo FROM test WHERE test_id=".$valor["test_id"]);
                if($db->next_record()){
                        //echo ("test: ".$valor["test_id"]." archivo-$i: ".$db->f("con_archivo")."<br/>");
                        if($db->f("con_archivo") == "V"){
                                unset($db);
                                return true;
                                break;
                        }
                        else
                                $r= false;
                }
                //$i++;
        }
        unset($db);
        return $r;
}
//------------------------------------------------- FUNCI�N ( 34 )------------------------------------------------------------
//verificar si uno de los test_id pasados en el array tiene la propiedad de con_multiple_resultado
function usar_col_mult_resultado($peticiones){
        reset($peticiones);
        $db = new clsDBDatos();
        //$i=1;
        while(list($clave, $valor) = each($peticiones)){
                $db->query("SELECT con_multiple_resultado FROM test WHERE test_id=".$valor["test_id"]);
                if($db->next_record()){
                        //echo ("test: ".$valor["test_id"]." result-$i: ".$db->f("con_multiple_resultado")."<br/>");
                        if($db->f("con_multiple_resultado") == "V"){
                                unset($db);
                                return true;
                                break;
                        }
                        else
                                $r= false;
                }
                //$i++;
        }
        unset($db);
        return $r;
}
//Fin funci�n "generar_text_area"
//------------------------------------------------- FUNCI�N ( 35 )------------------------------------------------------------
//genera un link para agregar m�ltiples resultados a un test
function link_add_resultado($peticion,$test_id,$muestra_id,$pagina){
        if(con_multipe_resultado($test_id)){
                $estado_id=10;
                $db = new clsDBDatos();
                $db->query("SELECT secciones_id, equipo_id FROM test WHERE test_id='$test_id'");
                if($db->next_record()) {
                        $seccion_id = $db->f("secciones_id");
                        $equipo_id = $db->f("equipo_id");
                        $parametros = "&s_secciones_id=$seccion_id&s_equipo_id=$equipo_id&s_test_id=$test_id&s_peticion_id=$peticion";
                }
                $link = "<a href='javascript:popAdd_Resultado($peticion,$test_id,$muestra_id,\"$parametros\",\"$pagina\");'>
                                        <img src='images/gnome-fs-desktop.png' border='0' alt='Nuevo resultado'>
                                </a>";
                unset($db);
        }
        else
                $link="&nbsp;";

        return $link;
}
//Fin funci�n "link_add_resultado"
//------------------------------------------------- FUNCI�N ( 36 )------------------------------------------------------------
//Verifica si un test tiene la propiedada de que el campo de multiple resultado este activo
function con_multipe_resultado($test_id){
        $sSQL="SELECT con_multiple_resultado FROM test WHERE test_id = $test_id";
        $db = new clsDBDatos;
        $db->query($sSQL);
        if($db->next_record()){
                if($db->f("con_multiple_resultado") == "V") return true;
                else return false;
        }
        unset($db);
}
//Fin funci�n "con_text_area"
//------------------------------------------------- FUNCI�N ( 37 )------------------------------------------------------------
//Verifica si la validaci�n del resultado de un test esta en estado aceptado o no
function estado_validacion_aceptado($resultado_id){
        if($resultado_id!=""){
                $db = new clsDBDatos();
                $db->query("SELECT estado_id FROM resultados WHERE resultado_id=$resultado_id");
                if($db->next_record()){
                        if($db->f("estado_id")==20)
                                return true;
                        else
                                return false;
                }
        }
        else
                return false;
}
//Fin funci�n "estado_validacion_aceptado"
//------------------------------------------------- FUNCI�N ( 37 )------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------------------------
//--------------------------------------- FIN de bater�a de funciones MACK. --------------------------------------------------

//Funcion para obtener la edad de un paciente
function GetEdad($paciente_id=0)
{
        $sSQL="SELECT `fecha_nacimiento` FROM pacientes WHERE paciente_id = $paciente_id";
        $db = new clsDBDatos;
        $db->query($sSQL);

        $tmpfecha=($db->next_record()) ? $db->f(0): "";
        unset($db);

        $edad=array();
        $edad['anos']='';
        $edad['meses']='';
        $edad['dias']='';

        //Si no viene la edad
        if ($tmpfecha==""){
                $edad['anos']='0';
                $edad['meses']='0';
                $edad['dias']='0';

                return $edad;
        }

        $tmpfecha=str_replace ( " ", "-", $tmpfecha);

        list($year, $mes, $dia, $hora)= split( '[/.-]', $tmpfecha );

        //Los Datos de Hoy
        $year_hoy=date("Y");
        $mes_hoy=date("m");
        $dia_hoy=date("d");

    //Verifica que sea una fecha v�lida
    if (checkdate( $mes, $dia, $year)===false) {
                $edad['anos']='0';
                $edad['meses']='0';
                $edad['dias']='0';

        //die("VERIFI1: <pre>" . print_r($edad,true)  . "<pre>");


                return $edad;
    }

        //primero verifica que no haya nacido hoy o ma�ana
        if ($year.$mes.$dia >= $year_hoy.$mes_hoy.$dia_hoy) {
                $edad['anos']='0';
                $edad['meses']='0';
                $edad['dias']='0';

        //die("VERFI2: <pre>" . print_r($edad,true)  . "<pre>");


                return $edad;
        }

    //Obtiene los datos
    $edad['anos'] = $year;
    $edad['meses'] = $mes;
    $edad['dias'] = $dia;

    $edad['anos'] = $year_hoy - $edad['anos'];
    $edad['meses'] = $mes_hoy - $edad['meses'];
    $edad['dias'] = $dia_hoy - $edad['dias'];

    //Si sali� un d�a negativo
    if ($edad['dias'] < 0) {
        $edad['dias'] = 30 - abs($edad['dias']);
        $edad['meses'] = $edad['meses'] - 1;
    }

    //Si sali� un mes negativo
    if ($edad['meses'] < 0) {
        $edad['meses'] = 12 - abs($edad['meses']);
        $edad['anos'] = $edad['anos'] - 1;
    }

//        die("FINAL: <pre>" . print_r($edad,true)  . "<pre>");

        return $edad;

}


//Obtiene la fecha en formato extendido
function GetEdadEx($paciente_id=0){

        $paciente_id=intval($paciente_id);

        $tmp_edad=GetEdad($paciente_id);

    if ($tmp_edad['anos']==0 && $tmp_edad['meses']==0 && $tmp_dias['dias']==0){
            $edad="--";

        return $edad;

    } elseif ($tmp_edad['anos']<1 && $tmp_edad['meses']<3){
            $edad=$tmp_edad['meses']. ' meses, '. $tmp_edad['dias'] . ' dias';

        return $edad;

    } elseif ($tmp_edad['anos']<1 && $tmp_edad['meses']>=1) {
            $edad=$tmp_edad['meses'] . ' meses';

        return $edad;

    } elseif ($tmp_edad['anos']<1 && $tmp_edad['meses']<1){
            $edad=$tmp_edad['dias'] . ' dias';

        return $edad;

    } elseif ($tmp_edad['anos']<2) {
            $edad=$tmp_edad['anos'] . ' a�o, '. $tmp_edad['meses'] . ' meses';

        return $edad;

    } else {
            $edad=$tmp_edad['anos'].' A�os ';

                return $edad;
    }

}


//Funcion para obtener el tipo de muestra para un test dado
function GetTipoMuestra($test_id)
{
        if($test_id=="") {
                return 0;
        } else {
                $sql="SELECT tipo_muestra_id FROM test WHERE test_id=$test_id";
                $db = new clsDBDatos();
                $db->query($sql);
            $dbvalue = $db->next_record() ? $db->f(0) : "";
                unset($db);
           return $dbvalue;
        }

}

//Encuentra el nombre del usuario
function GetUserName($usuario_id=0)
{

		if ($usuario_id==0) $usuario_id=CCGetUserID();

        $db= new clsDBDatos();
        $db->query("SELECT nom_usuario from usuarios WHERE usuario_id=$usuario_id");
        $nom_usuario=($db->next_record()) ? $db->f(0) : "";
        unset($db);

        return $nom_usuario;

}

//Encuentra la prodecencia Predeterminada del Usuario
function GetUserProcedenciaID($usuario_id=0)
{
		if ($usuario_id==0) $usuario_id=CCGetUserID();

        $db= new clsDBDatos();
        $db->query("SELECT Procedencia_id from usuarios WHERE usuario_id=$usuario_id");
        $procedencia_id=($db->next_record()) ? $db->f(0) : 0;
        unset($db);

        return intval($procedencia_id);
}

//Fabrica condici�n avanzada de procedencia Basada en el Usuario
function GetCondicion($tipo="",$tabla=""){
	if ($tipo=="") return "";

	if ($tipo=="procedencia") {
		$procedencia_id=GetUserProcedenciaID();
		if ($procedencia_id>0) {
			//Cuando se ha especificado la Procedencia en el Usuario
			$tmp=$tabla."(procedencia_id=$procedencia_id OR " . CCGetGroupID() . " > 4)";
		} else {
			//No se ha especificado la Procedencia
			$tmp="";
		}
		return $tmp;
	}

	return "";

}


//Desviaci�n est�ndar de un array de numeros
function stat_sd($array) {

    //Get sum of array values
    while(list($key,$val) = each($array)) {
        $total += $val;
    }

    reset($array);
    $mean = $total/count($array);

    while(list($key,$val) = each($array)) {
        $sum += pow(($val-$mean),2);
    }
    $var = sqrt($sum/(count($array)-1));

    return $var;
}

//Funci�n que actualiza las f�rmulas de una petici�n
//las calcula, si no esta creado el resultado, lo agrega
//tambien crea resultados para test que son compuestos
//para prevenir que no existan al provenir desde equipos
//automatizados.
function ActualizaPeticion($peticion_id=0){

    //Verifica que viene un numero de peticion mayor a cero, sino devuelve vacio
    if (intval($peticion_id) <= 0) return "";

    //Cadena para uso en deputari�n
    $depurar="";
    //Cadena que contiene el resultado de la funci�n
    $mensaje="";

	$valores="";

    //conecciones usadas
    $db = new clsDBDatos();
    $db2= new clsDBDatos();

    //Primero Busca los test de formula en los resultados
    $sSQL="SELECT
              resultados.test_id
            FROM
              resultados
              LEFT OUTER JOIN test ON (resultados.test_id = test.test_id)
            WHERE
              (test.formula = 'V') AND
              (resultados.peticion_id = $peticion_id)";

    //info para depurar
    $depurar.="<b>1-Busca los test de formula en los resultados:</b><br>---$sSQL<br>";

    $db->query($sSQL);
    while ($db->next_record()){
            $cadena.=$db->f(0)." ";
    }
    $cadena=trim($cadena);


	$depurar.= "Cadena de Test Formula en Resultados: $cadena<br>";

    //Crea una lista separada por comas de los test que son una formula
    //en la petici�n

    $valores=str_replace(' ',',',$cadena);
    if ($valores=="") $valores="''";

    //Buscar los test pedidos que son formula pero no estan el los resultados
    $sSQL="SELECT peticiones_detalle.test_id, muestra_id
                    FROM
                      peticiones_detalle
                    LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)
                    WHERE
                      (peticiones_detalle.peticion_id = $peticion_id)
                    AND
                      (test.formula = 'V')
                    AND
                      peticiones_detalle.test_id NOT IN ($valores)";

    $depurar.="<b>2-Buscar los test pedidos que son formula pero no estan el los resultados:</b><br>---$sSQL<br>";

        $db->query($sSQL);

    while ($db->next_record()){
            $test_id=$db->f('test_id');
            $muestra_id=$db->f('muestra_id');

			$debug.="Encontrado: $test_id - $muestra_id<br>";

            $sSQL="INSERT INTO resultados (peticion_id, test_id, muestra_id) VALUES ('$peticion_id','$test_id','$muestra_id')";

			$depurar.="<b>Inserta los Test Faltantes:</b><br>------$sSQL<br>";

            $depurar.="3(INS): $sSQL<br>";

            $db2->query($sSQL);
    }

    //Ahora recalculo los test
    $sSQL="SELECT
              resultados.test_id
            FROM
              resultados
              LEFT OUTER JOIN test ON (resultados.test_id = test.test_id)
            WHERE
              (test.formula = 'V') AND
              (resultados.peticion_id = $peticion_id)";

    $depurar.="<b>4-Ahora Busco las Formulas y recalculo los Valores:</b><br>---$sSQL<br>";

    $db->query($sSQL);
    while ($db->next_record()){
            $test_id=$db->f(0);
  
  			$debug.="Encontrado: $test_id <br>";


			$tmp_calc=array();
            $tmp_calc=CalculaFormula($peticion_id, $test_id);
            $valor_calculado="";
            $valor_calculado=$tmp_calc['valor'];

            $tmp_msg=$tmp_calc['mensaje'];

            if ($tmp_msg!='') {
                    if ($mensaje!=''){
                            $mensaje="$mensaje\\n$tmp_msg";
                    } else {
                            $mensaje=$tmp_msg;
                    }
            }

            if ($valor_calculado=="") $valor_calculado="* Error de C�lculo *";
			
            $sSQL="Update resultados set valor='$valor_calculado' Where peticion_id=$peticion_id and test_id=$test_id";

            $depurar.="<b>5-Asigno los valores calculados:</b><br>------$sSQL<br>";

            $db2=new clsDBDatos();
            $db2->query($sSQL);
    }

    //Busca los test que ya estan en la tabla de resultados
    $sSQL="SELECT
          resultados.test_id
            FROM
          resultados
            WHERE
          (resultados.peticion_id = $peticion_id)";

    //info para depurar
    $depurar.="<b>Busca los test que ya estan en la tabla de resultados:</b><br>---$sSQL<br>";

	$cadena="";

    $db->query($sSQL);
    while ($db->next_record()){
            $cadena.=$db->f(0)." ";
    }
    $cadena=trim($cadena);

	$depurar.= "Cadena de Test en Resultados: $cadena<br>";


    //Crea una lista separada por comas de los test en la petici�n

    $valores=str_replace(' ',',',$cadena);
    if ($valores=="") $valores="''";

	$depurar.= "Lista de Test en Resultados: $valores<br>";

    //Ahora busca los test compuestos que estan en la
    //tabla de peticiones_detalle pero no estan en los
    //resultados

    $sSQL="SELECT DISTINCT
            peticiones_detalle.test_id,
            peticiones_detalle.muestra_id
            FROM
              peticiones_detalle
              INNER JOIN test ON (peticiones_detalle.test_id = test.test_id)
            WHERE
              (peticiones_detalle.peticion_id = $peticion_id)
            AND
              (test.compuesto = 'V')
                    AND
                      peticiones_detalle.test_id NOT IN ($valores)";

    $depurar.="<b>Busca Compuestos que No estan en resultados:</b><br>---$sSQL<br>";

        $db->query($sSQL);
	$veces=0;
	$fecha=date("Y/m/d");
	$hora=date("Y/m/d H:i:s");
    while ($db->next_record()){
			$veces++;
            $test_id=$db->f('test_id');
            $muestra_id=$db->f('muestra_id');
            $sSQL="INSERT INTO resultados ".
					"(peticion_id, test_id, muestra_id, fecha_creacion, hora_creacion) ".
				  "VALUES ".
					"('$peticion_id', '$test_id', '$muestra_id', '$fecha', '$hora')";

            $depurar.="<b>Lo Inserta ($veces):</b> $sSQL<br>";

            $db2->query($sSQL);
    }

//	$sql="INSERT INTO auditoria (descripcion) VALUES ('" .str_replace("'", "\'", $depurar) . "')";
//	$sql=str_replace("-","�",$sql);

//	print("<br>SQL Audit: $sql<br>");
//	$db->query($sql);

    unset($db);
    unset($db2);


    //Si hay un mensaje que mostrar lo devuelve al llamado
        if ($mensaje!='') {
        return  "<table width=\"100%\" bgcolor=\"#FF9999\">\n".
                "<tr>\n".
                "   <td>\n".
                "       <img src=\"images/menu/emblem-important.gif\">\n".
                "   </td>\n".
                "   <td width=\"100%\">\n".
                str_replace('\n','<br>',$mensaje).
                "   </td>\n".
                "</tr>\n".
                "</table>\n".
                "<script>alert('$mensaje');</script>";
    } else {
        return "";
    }

}

function estado_pago($peticion_id){
	if($peticion_id!=""){
		$db = new clsDBDatos();
		$db->query("SELECT SUM(precio) AS cobrado FROM peticiones_detalle WHERE peticion_id=$peticion_id");
		if($db->next_record())
			$cobrado= $db->f("cobrado");
		$db->query("SELECT SUM(valor) AS pagado FROM detalle_pago WHERE peticion_id=$peticion_id");
		if($db->next_record())
			$pagado= $db->f("pagado");
		unset($db);
		
		if($cobrado == $pagado) $estado=1;//PAgado
		elseif($pagado > 0) $estado=2;//Abonado
		elseif($pagado == 0) $estado=3;//No Cancelado
	}
	else
		return 0;

	return $estado;
}

//ACTUALIZA EL ESTADO DE PAGO DE UNA PETICI�N
function update_estado_pago($peticion_id){

	$estado_pago=estado_pago($peticion_id);

	$db = new clsDBDatos();
	$sSQL="UPDATE peticiones SET estado_pago_id='$estado_pago' WHERE peticion_id=$peticion_id";
	$db->query($sSQL);
	unset($db);
}

//Obtiene el d�gito verificador de un rut
function dvRut($r) {
    $s = 1;
    for($m = 0; $r != 0; $r/= 10)$s = ($s+$r%10 * (9-$m++%6))%11;
    return chr($s?$s+47:75);
}

//Valida un Rut
//Devuelve True si el digito verificador rut es v�lido
//Formato: 11222333-4   sin puntos
function ValidaRut($sRUT) {

	//Verifica la estructura del RUT
	if (!preg_match("/(\d{7,8})-([\dK])/", strtoupper($sRUT), $aMatch)) {
 	   return false;
   	}

	//Obtiene el d�gito verificador
	$Verificador = $aMatch[2];

	//Vaerigua si el digito ingresado corresponde al calculado
	if (strtoupper($Verificador)==dvRut($sRUT)) {
		return true;
	} else {
		return false;
	}
   
}


function mysql_FormatDate($fecha_mysql, $formato="d/m/Y"){
/* Recibe una fecha con formato aaaa-mm-dd hh:mm:ss ====
   Devuelve una fecha con formato especifico, si no
   se espefica formato de salida, se usa d/m/Y
   la funci�n no toma en cuenta la hora
*/
	$year=substr($fecha_mysql,0,4);
	$month=substr($fecha_mysql,5,2);
	$day=substr($fecha_mysql,8,2);

//	$fecha = mktime(0, 0, 0, $month, $day, $year);

	$result_fecha= "$day/$month/$year"; //date($formato, $fecha);

	return ($result_fecha);
}

function fecha_de_mysql($fecha){

	//recibe una fecha dd/mm/yyyy y la devuelve como yyyy-mm-dd 00:00:00

	$year=substr($fecha,6,4);
	$month=substr($fecha,3,2);
	$day=substr($fecha,0,2);

	$result_fecha="$year/$month/$day 00:00:00";

	return ($result_fecha);
}

function CorrigeCodigo(& $main_block) {
	//$main_block= preg_replace('/&#(\d+);/me',"chr(\\1)",$main_block);
	//$main_block= preg_replace('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",$main_block);


	$main_block=str_replace("<!-- CCS -->","",$main_block);
	$main_block=str_replace("<!-- SCC -->","",$main_block);
	$main_block=str_replace("Generated with CodeCharge Studio.","",$main_block);
}

function CorrigeCodigoEx() {

	global $main_block;

	//$main_block= preg_replace('/&#(\d+);/me',"chr(\\1)",$main_block);
	//$main_block= preg_replace('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",$main_block);


	$main_block=str_replace("<!-- CCS -->","",$main_block);
	$main_block=str_replace("<!-- SCC -->","",$main_block);
	$main_block=str_replace("Generated with CodeCharge Studio.","",$main_block);
}

function nom_informe($informe_id){
	$db = new clsDBDatos();
	$sql="SELECT nom_informe FROM informes WHERE informe_id=$informe_id LIMIT 1";
	$db->query($sql);
//	die("<pre>". print_r($db, true) . "<hr>$sql</pre>");
	$nn=($db->next_record())?$db->f(0):"";
	unset($db);
	return $nn;
}

//Funcion que anota en la bitacora de las peticiones
// Parametros
// $peticion_id=numero de peticion
// $texto=Contenido de la anotacion
// $tipo=tipo de anotacion
// 		 1- Pendientes
//       2- Rechazos
//		*3- Anotaciones
//		 4- Pagos
//		 5- Impresiones
// $estado=Estado de la nueva anotaci�n
//		1000 
//		2000
//		3000
//	   *4000
// $nivel_id=Nivel Minimo para poder ver la observaci�n
//		*14
function Registro($peticion_id=0, $texto="", $tipo=3, $estado=4000, $nivel_id=14){

	$usuario_id=CCGetUserID();
	$fecha=date("Y/m/d H:i:s");
	$sql="INSERT INTO bitacora";

	$sql="INSERT INTO `bitacora` (`peticion_id` , `fecha` , `descripcion` , `tipo_bitacora_id` , `usuario_id` , `estado_id` , `nivel_id` ) " .
				 "VALUES (".
						"'$peticion_id', '$fecha', ".
						CCToSQL($texto, ccsText) .", ".
						"'$tipo', '$usuario_id', '$estado', '$nivel_id')";	


	$db= new clsDBDatos();
	$db->query($sql);
	unset($db);

}

function msgbox($texto="",$icono="information"){

	if ($icono=="information"){
		$ico="images/emblem-info.png";
	}

	$etq='<table width="100%" align="center" border="0" cellspacing="0" cellpadding="2" bgcolor="#FF9900">'.
	  	  '	<tr>'.
	      ' 	<td><img id="Image1" src="'.$ico.'" align="left" name="Image1">'.$texto.'</td> '.
	  	  '	</tr>'.
		  '	</table>';

	return $etq;
}

function CrearETQ($peticion_id=0){

	$db = new clsDBDatos();
	$sql="insert into etiquetas (peticion_id, hora, usuario, muestra_id, tipo_muestra, impreso, nom_paciente ) 
			(SELECT DISTINCT 
			  peticiones.peticion_id, 
			  peticiones.hora,
			  usuarios.nom_usuario,
			  peticiones_detalle.muestra_id,
			  tipos_muestra.nom_tipo_muestra,
			  'F',
			  CONCAT(pacientes.nombres, ' ', pacientes.apellidos) AS nom_paciente
			FROM
			  peticiones
			  INNER JOIN peticiones_detalle ON (peticiones.peticion_id = peticiones_detalle.peticion_id)
			  LEFT OUTER JOIN pacientes ON (peticiones.paciente_id = pacientes.paciente_id)
			  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)
			  LEFT OUTER JOIN tipos_muestra ON (test.tipo_muestra_id = tipos_muestra.tipo_muestra_id)
			  LEFT OUTER JOIN usuarios ON (peticiones.usuario_id = usuarios.usuario_id)
			WHERE
			  peticiones.peticion_id = $peticion_id
			  AND
			  test.imprime_ot='V')";

	$db->query($sql);

}
