<?php
	error_reporting(E_ERROR);

 //Classes Personalizadas
class Exportar{
	var $SQL;
	var $Titulo;
	var $nomArchivo;
	var $SubTitulo;
	var $Error;
	var $Errno;
	var $Encabezado;

	function Exportar($sql="", $archivo="", $titulo="", $subtitulo="", $encabezado=""){
		$this->SQL=$sql;
		$this->nomArchivo=$archivo;
		$this->Titulo=$titulo;
		$this->SubTitulo=$subtitulo;
		$this->Encabezado=$encabezado;
		
		$this->Error="";
		$this->Errno=0;
	}

	function xlsBOF() {
	    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);  
	    return;
	}

	function xlsEOF() {
	    echo pack("ss", 0x0A, 0x00);
	    return;
	}

	function xlsWriteNumber($Row, $Col, $Value) {
	    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
	    echo pack("d", $Value);
	    return;
	}

	function xlsWriteLabel($Row, $Col, $Value ) {
	    $L = strlen($Value);
	    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
	    echo $Value;
		return;
	}

	function SetArchivo($nombre){
		$this->nomArchivo=$nombre;
	}

	function GetArchivo(){
		return $this->nomArchivo;
	}

	function Generar(){

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");;
		header("Content-Disposition: attachment;filename=" . $this->nomArchivo ); 
		header("Content-Transfer-Encoding: binary ");
		
		//print($this->SQL);
        $this->xlsBOF();
        $this->xlsWriteLabel(0,0,$this->Titulo);
        $this->xlsWriteLabel(1,0,$this->SubTitulo);
		
		$lin=3;
		$col=0;
	
		$encabezado=array();
		
		if ($this->Encabezado != '') {
		
			//echo "prueba de ingreso: " . ($this->Encabezado != '');
		
			$encabezado=explode("|",$this->Encabezado);
			
			//echo "Prueba de contendido: <pre>" . print_r($encabezado, true) . "</pre>";
				
			foreach ($encabezado as $contenido) {
				//echo $contenido;
				$this->xlsWriteLabel($lin,$col,$contenido);
				$col++;
			}
		}
		
		$lin++;	
		$contenido="";
		
		$db=new clsDBDatos();
		
		$db->query($this->SQL);
		$total=$db->num_fields();
		while ($db->next_record()){
		    for ($i=0; $i<$total; $i++) {
			  $col=$i;
			  $contenido=$db->f($i);
			  //print("contenido $contenido");
			  if (is_numeric($contenido)){
					
			  	 $this->xlsWriteNumber($lin, $col, $contenido);
				 
			  } else {
				 $this->xlsWriteLabel($lin,$col,$contenido);
			  }
			}
			$lin++;
		}
		
        $this->xlsEOF();
		$db->close();
		unset($db);
		exit();

	}
}
// ******************** FIN CLASE EXPORTAR ********************************
?>