<?php
//Include Common Files @1-4B157B05
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ver_tomademuestra.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridpeticiones_pacientes_proc { //peticiones_pacientes_proc class @125-43F535CB

//Variables @125-6E51DF5A

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
//End Variables

//Class_Initialize Event @125-24B81B6A
    function clsGridpeticiones_pacientes_proc($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "peticiones_pacientes_proc";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid peticiones_pacientes_proc";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_pacientes_procDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->rut = new clsControl(ccsLabel, "rut", "rut", ccsText, "", CCGetRequestParam("rut", ccsGet, NULL), $this);
        $this->ficha = new clsControl(ccsLabel, "ficha", "ficha", ccsText, "", CCGetRequestParam("ficha", ccsGet, NULL), $this);
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->hora = new clsControl(ccsLabel, "hora", "hora", ccsDate, array("H", ":", "nn"), CCGetRequestParam("hora", ccsGet, NULL), $this);
        $this->nom_procedencia = new clsControl(ccsLabel, "nom_procedencia", "nom_procedencia", ccsText, "", CCGetRequestParam("nom_procedencia", ccsGet, NULL), $this);
        $this->fecha_nacimiento = new clsControl(ccsLabel, "fecha_nacimiento", "fecha_nacimiento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha_nacimiento", ccsGet, NULL), $this);
        $this->edad = new clsControl(ccsLabel, "edad", "edad", ccsText, "", CCGetRequestParam("edad", ccsGet, NULL), $this);
        $this->paciente_id = new clsControl(ccsHidden, "paciente_id", "paciente_id", ccsInteger, "", CCGetRequestParam("paciente_id", ccsGet, NULL), $this);
        $this->observaciones = new clsControl(ccsLabel, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @125-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @125-95F200CD
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["peticion_id"] = $this->peticion_id->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["rut"] = $this->rut->Visible;
            $this->ControlsVisible["ficha"] = $this->ficha->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["hora"] = $this->hora->Visible;
            $this->ControlsVisible["nom_procedencia"] = $this->nom_procedencia->Visible;
            $this->ControlsVisible["fecha_nacimiento"] = $this->fecha_nacimiento->Visible;
            $this->ControlsVisible["edad"] = $this->edad->Visible;
            $this->ControlsVisible["paciente_id"] = $this->paciente_id->Visible;
            $this->ControlsVisible["observaciones"] = $this->observaciones->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                $this->rut->SetValue($this->DataSource->rut->GetValue());
                $this->ficha->SetValue($this->DataSource->ficha->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->hora->SetValue($this->DataSource->hora->GetValue());
                $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                $this->fecha_nacimiento->SetValue($this->DataSource->fecha_nacimiento->GetValue());
                $this->paciente_id->SetValue($this->DataSource->paciente_id->GetValue());
                $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->peticion_id->Show();
                $this->nombres->Show();
                $this->apellidos->Show();
                $this->rut->Show();
                $this->ficha->Show();
                $this->fecha->Show();
                $this->hora->Show();
                $this->nom_procedencia->Show();
                $this->fecha_nacimiento->Show();
                $this->edad->Show();
                $this->paciente_id->Show();
                $this->observaciones->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @125-F1536F45
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->hora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_nacimiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->edad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->paciente_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->observaciones->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_pacientes_proc Class @125-FCB6E20C

class clspeticiones_pacientes_procDataSource extends clsDBDatos {  //peticiones_pacientes_procDataSource Class @125-33CC6345

//DataSource Variables @125-75A3E661
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $peticion_id;
    public $nombres;
    public $apellidos;
    public $rut;
    public $ficha;
    public $fecha;
    public $hora;
    public $nom_procedencia;
    public $fecha_nacimiento;
    public $paciente_id;
    public $observaciones;
//End DataSource Variables

//DataSourceClass_Initialize Event @125-F37E55E2
    function clspeticiones_pacientes_procDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_pacientes_proc";
        $this->Initialize();
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->ficha = new clsField("ficha", ccsText, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->hora = new clsField("hora", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->nom_procedencia = new clsField("nom_procedencia", ccsText, "");
        
        $this->fecha_nacimiento = new clsField("fecha_nacimiento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->paciente_id = new clsField("paciente_id", ccsInteger, "");
        
        $this->observaciones = new clsField("observaciones", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @125-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @125-22B7FB8C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
    }
//End Prepare Method

//Open Method @125-1AE87FD0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM ((peticiones LEFT JOIN pacientes ON\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN procedencias ON\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN estados ON\n" .
        "peticiones.estado_id = estados.estado_id\n" .
        "WHERE peticiones.peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "";
        $this->SQL = "SELECT peticion_id, peticiones.paciente_id AS peticiones_paciente_id, peticiones.procedencia_id AS peticiones_procedencia_id, peticiones.estado_id AS peticiones_estado_id,\n" .
        "fecha, hora, observaciones, pacientes.paciente_id, rut, fecha_nacimiento, ficha, nombres, apellidos, procedencias.procedencia_id AS procedencias_procedencia_id,\n" .
        "nom_procedencia, estados.estado_id AS estados_estado_id, nom_estado \n" .
        "FROM ((peticiones LEFT JOIN pacientes ON\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN procedencias ON\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN estados ON\n" .
        "peticiones.estado_id = estados.estado_id\n" .
        "WHERE peticiones.peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @125-F91084C4
    function SetValues()
    {
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->rut->SetDBValue($this->f("rut"));
        $this->ficha->SetDBValue($this->f("ficha"));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->hora->SetDBValue(trim($this->f("hora")));
        $this->nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->fecha_nacimiento->SetDBValue(trim($this->f("fecha_nacimiento")));
        $this->paciente_id->SetDBValue(trim($this->f("paciente_id")));
        $this->observaciones->SetDBValue($this->f("observaciones"));
    }
//End SetValues Method

} //End peticiones_pacientes_procDataSource Class @125-FCB6E20C

class clsGridpeticiones_peticiones_det { //peticiones_peticiones_det class @2-A02CD6FD

//Variables @2-07B6D840

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $AltRowControls;
    public $IsAltRow;
//End Variables

//Class_Initialize Event @2-1AAA6D6B
    function clsGridpeticiones_peticiones_det($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "peticiones_peticiones_det";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid peticiones_peticiones_det";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_peticiones_detDataSource($this);
        $this->ds = & $this->DataSource;

        $this->muestra_id = new clsControl(ccsLabel, "muestra_id", "muestra_id", ccsText, "", CCGetRequestParam("muestra_id", ccsGet, NULL), $this);
        $this->nom_tipo_muestra = new clsControl(ccsLabel, "nom_tipo_muestra", "nom_tipo_muestra", ccsText, "", CCGetRequestParam("nom_tipo_muestra", ccsGet, NULL), $this);
        $this->cuerpo_indicacion = new clsControl(ccsLabel, "cuerpo_indicacion", "cuerpo_indicacion", ccsMemo, "", CCGetRequestParam("cuerpo_indicacion", ccsGet, NULL), $this);
        $this->cuerpo_indicacion->HTML = true;
        $this->Alt_muestra_id = new clsControl(ccsLabel, "Alt_muestra_id", "Alt_muestra_id", ccsText, "", CCGetRequestParam("Alt_muestra_id", ccsGet, NULL), $this);
        $this->Alt_nom_tipo_muestra = new clsControl(ccsLabel, "Alt_nom_tipo_muestra", "Alt_nom_tipo_muestra", ccsText, "", CCGetRequestParam("Alt_nom_tipo_muestra", ccsGet, NULL), $this);
        $this->Alt_cuerpo_indicacion = new clsControl(ccsLabel, "Alt_cuerpo_indicacion", "Alt_cuerpo_indicacion", ccsMemo, "", CCGetRequestParam("Alt_cuerpo_indicacion", ccsGet, NULL), $this);
        $this->Alt_cuerpo_indicacion->HTML = true;
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->ImageLink1->Page = "ver_detalletomamuestra.php";
        $this->Cancelar = new clsButton("Cancelar", ccsGet, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-6872738C
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["muestra_id"] = $this->muestra_id->Visible;
            $this->ControlsVisible["nom_tipo_muestra"] = $this->nom_tipo_muestra->Visible;
            $this->ControlsVisible["cuerpo_indicacion"] = $this->cuerpo_indicacion->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->muestra_id->SetValue($this->DataSource->muestra_id->GetValue());
                    $this->nom_tipo_muestra->SetValue($this->DataSource->nom_tipo_muestra->GetValue());
                    $this->cuerpo_indicacion->SetValue($this->DataSource->cuerpo_indicacion->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->muestra_id->Show();
                    $this->nom_tipo_muestra->Show();
                    $this->cuerpo_indicacion->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_muestra_id->SetValue($this->DataSource->Alt_muestra_id->GetValue());
                    $this->Alt_nom_tipo_muestra->SetValue($this->DataSource->Alt_nom_tipo_muestra->GetValue());
                    $this->Alt_cuerpo_indicacion->SetValue($this->DataSource->Alt_cuerpo_indicacion->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Alt_muestra_id->Show();
                    $this->Alt_nom_tipo_muestra->Show();
                    $this->Alt_cuerpo_indicacion->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parseto("AltRow", true, "Row");
                }
                $this->IsAltRow = (!$this->IsAltRow);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->ImageLink1->Show();
        $this->Cancelar->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-4D28360B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->muestra_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_tipo_muestra->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cuerpo_indicacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_muestra_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_tipo_muestra->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_cuerpo_indicacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_peticiones_det Class @2-FCB6E20C

class clspeticiones_peticiones_detDataSource extends clsDBDatos {  //peticiones_peticiones_detDataSource Class @2-8CA8E700

//DataSource Variables @2-921CDE61
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $muestra_id;
    public $nom_tipo_muestra;
    public $cuerpo_indicacion;
    public $Alt_muestra_id;
    public $Alt_nom_tipo_muestra;
    public $Alt_cuerpo_indicacion;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-047C6972
    function clspeticiones_peticiones_detDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_peticiones_det";
        $this->Initialize();
        $this->muestra_id = new clsField("muestra_id", ccsText, "");
        
        $this->nom_tipo_muestra = new clsField("nom_tipo_muestra", ccsText, "");
        
        $this->cuerpo_indicacion = new clsField("cuerpo_indicacion", ccsMemo, "");
        
        $this->Alt_muestra_id = new clsField("Alt_muestra_id", ccsText, "");
        
        $this->Alt_nom_tipo_muestra = new clsField("Alt_nom_tipo_muestra", ccsText, "");
        
        $this->Alt_cuerpo_indicacion = new clsField("Alt_cuerpo_indicacion", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-22B7FB8C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-FEB84871
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT DISTINCTROW \n" .
        "  peticiones.peticion_id,\n" .
        "  peticiones_detalle.peticion_id,\n" .
        "  peticiones_detalle.muestra_id,\n" .
        "  tipos_muestra.nom_tipo_muestra,\n" .
        "  indicaciones_muestra.nom_indicacion,\n" .
        "  indicaciones_muestra.cuerpo_indicacion\n" .
        "FROM\n" .
        "  peticiones\n" .
        "  LEFT OUTER JOIN peticiones_detalle ON (peticiones.peticion_id = peticiones_detalle.peticion_id)\n" .
        "  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)\n" .
        "  LEFT OUTER JOIN tipos_muestra ON (test.tipo_muestra_id = tipos_muestra.tipo_muestra_id)\n" .
        "  LEFT OUTER JOIN indicaciones_muestra ON (tipos_muestra.indicacion_id = indicaciones_muestra.indicacion_muestra_id)\n" .
        "WHERE\n" .
        "  peticiones.peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-3B15BBA0
    function SetValues()
    {
        $this->muestra_id->SetDBValue($this->f("muestra_id"));
        $this->nom_tipo_muestra->SetDBValue($this->f("nom_tipo_muestra"));
        $this->cuerpo_indicacion->SetDBValue($this->f("cuerpo_indicacion"));
        $this->Alt_muestra_id->SetDBValue($this->f("muestra_id"));
        $this->Alt_nom_tipo_muestra->SetDBValue($this->f("nom_tipo_muestra"));
        $this->Alt_cuerpo_indicacion->SetDBValue($this->f("cuerpo_indicacion"));
    }
//End SetValues Method

} //End peticiones_peticiones_detDataSource Class @2-FCB6E20C

//Initialize Page @1-3D40D080
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";
$TemplateSource = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "ver_tomademuestra.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-CE0AE6A3
include_once("./ver_tomademuestra_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-42ADAF74
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$peticiones_pacientes_proc = new clsGridpeticiones_pacientes_proc("", $MainPage);
$peticiones_peticiones_det = new clsGridpeticiones_peticiones_det("", $MainPage);
$MainPage->peticiones_pacientes_proc = & $peticiones_pacientes_proc;
$MainPage->peticiones_peticiones_det = & $peticiones_peticiones_det;
$peticiones_pacientes_proc->Initialize();
$peticiones_peticiones_det->Initialize();
$ScriptIncludes = "";
$SList = explode("|", $Scripts);
foreach ($SList as $Script) {
    if ($Script != "") $ScriptIncludes = $ScriptIncludes . "<script src=\"" . $PathToRoot . $Script . "\" type=\"text/javascript\"></script>\n";
}
$Attributes->SetValue("scriptIncludes", $ScriptIncludes);

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-5D816F46
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
if (strlen($TemplateSource)) {
    $Tpl->LoadTemplateFromStr($TemplateSource, $BlockToParse, "ISO-8859-1", "replace");
} else {
    $Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "ISO-8859-1", "replace");
}
$Tpl->SetVar("CCS_PathToRoot", $PathToRoot);
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-95E6E2F6
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_pacientes_proc);
    unset($peticiones_peticiones_det);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0093E8D7
$peticiones_pacientes_proc->Show();
$peticiones_peticiones_det->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B8BC52EB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_pacientes_proc);
unset($peticiones_peticiones_det);
unset($Tpl);
//End Unload Page


?>
