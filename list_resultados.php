<?php
//Include Common Files @1-2D92630C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "list_resultados.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridequipos_estados_pacientes { //equipos_estados_pacientes class @2-F1B783E2

//Variables @2-03822E5A

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
    public $Sorter_signo_prioridad;
    public $Sorter_fecha;
    public $Sorter_rut;
    public $Sorter_nombres;
    public $Sorter_apellidos;
    public $Sorter_cod_test;
    public $Sorter_nom_test;
//End Variables

//Class_Initialize Event @2-3167D836
    function clsGridequipos_estados_pacientes($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "equipos_estados_pacientes";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid equipos_estados_pacientes";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsequipos_estados_pacientesDataSource($this);
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
        $this->SorterName = CCGetParam("equipos_estados_pacientesOrder", "");
        $this->SorterDirection = CCGetParam("equipos_estados_pacientesDir", "");

        $this->ingresar_resultado = new clsControl(ccsImageLink, "ingresar_resultado", "ingresar_resultado", ccsText, "", CCGetRequestParam("ingresar_resultado", ccsGet, NULL), $this);
        $this->ingresar_resultado->Page = "add_resultado.php";
        $this->signo_prioridad = new clsControl(ccsLabel, "signo_prioridad", "signo_prioridad", ccsText, "", CCGetRequestParam("signo_prioridad", ccsGet, NULL), $this);
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->rut = new clsControl(ccsLabel, "rut", "rut", ccsText, "", CCGetRequestParam("rut", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->cod_test = new clsControl(ccsLabel, "cod_test", "cod_test", ccsText, "", CCGetRequestParam("cod_test", ccsGet, NULL), $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $this);
        $this->alt_ingresar_resultado = new clsControl(ccsImageLink, "alt_ingresar_resultado", "alt_ingresar_resultado", ccsText, "", CCGetRequestParam("alt_ingresar_resultado", ccsGet, NULL), $this);
        $this->alt_ingresar_resultado->Page = "add_resultado.php";
        $this->Alt_signo_prioridad = new clsControl(ccsLabel, "Alt_signo_prioridad", "Alt_signo_prioridad", ccsText, "", CCGetRequestParam("Alt_signo_prioridad", ccsGet, NULL), $this);
        $this->Alt_fecha = new clsControl(ccsLabel, "Alt_fecha", "Alt_fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("Alt_fecha", ccsGet, NULL), $this);
        $this->Alt_rut = new clsControl(ccsLabel, "Alt_rut", "Alt_rut", ccsText, "", CCGetRequestParam("Alt_rut", ccsGet, NULL), $this);
        $this->Alt_nombres = new clsControl(ccsLabel, "Alt_nombres", "Alt_nombres", ccsText, "", CCGetRequestParam("Alt_nombres", ccsGet, NULL), $this);
        $this->Alt_apellidos = new clsControl(ccsLabel, "Alt_apellidos", "Alt_apellidos", ccsText, "", CCGetRequestParam("Alt_apellidos", ccsGet, NULL), $this);
        $this->Alt_cod_test = new clsControl(ccsLabel, "Alt_cod_test", "Alt_cod_test", ccsText, "", CCGetRequestParam("Alt_cod_test", ccsGet, NULL), $this);
        $this->Alt_nom_test = new clsControl(ccsLabel, "Alt_nom_test", "Alt_nom_test", ccsText, "", CCGetRequestParam("Alt_nom_test", ccsGet, NULL), $this);
        $this->op_filtro = new clsControl(ccsLabel, "op_filtro", "op_filtro", ccsText, "", CCGetRequestParam("op_filtro", ccsGet, NULL), $this);
        $this->op_filtro->HTML = true;
        $this->equipos_estados_pacientes_TotalRecords = new clsControl(ccsLabel, "equipos_estados_pacientes_TotalRecords", "equipos_estados_pacientes_TotalRecords", ccsText, "", CCGetRequestParam("equipos_estados_pacientes_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_signo_prioridad = new clsSorter($this->ComponentName, "Sorter_signo_prioridad", $FileName, $this);
        $this->Sorter_fecha = new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Sorter_rut = new clsSorter($this->ComponentName, "Sorter_rut", $FileName, $this);
        $this->Sorter_nombres = new clsSorter($this->ComponentName, "Sorter_nombres", $FileName, $this);
        $this->Sorter_apellidos = new clsSorter($this->ComponentName, "Sorter_apellidos", $FileName, $this);
        $this->Sorter_cod_test = new clsSorter($this->ComponentName, "Sorter_cod_test", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->volver = new clsControl(ccsImageLink, "volver", "volver", ccsText, "", CCGetRequestParam("volver", ccsGet, NULL), $this);
        $this->volver->Page = "filtrar_resultados.php";
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-542DB4AF
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_rut"] = CCGetFromGet("s_rut", NULL);
        $this->DataSource->Parameters["urls_ficha"] = CCGetFromGet("s_ficha", NULL);
        $this->DataSource->Parameters["urls_nombres"] = CCGetFromGet("s_nombres", NULL);
        $this->DataSource->Parameters["urls_apellidos"] = CCGetFromGet("s_apellidos", NULL);
        $this->DataSource->Parameters["urls_peticiones_procedencia_id"] = CCGetFromGet("s_peticiones_procedencia_id", NULL);
        $this->DataSource->Parameters["urls_peticiones_estado_id"] = CCGetFromGet("s_peticiones_estado_id", NULL);
        $this->DataSource->Parameters["urls_fecha"] = CCGetFromGet("s_fecha", NULL);
        $this->DataSource->Parameters["urls_muestra_id"] = CCGetFromGet("s_muestra_id", NULL);
        $this->DataSource->Parameters["urls_peticiones_detalle_prioridad_id"] = CCGetFromGet("s_peticiones_detalle_prioridad_id", NULL);
        $this->DataSource->Parameters["urls_test_equipo_id"] = CCGetFromGet("s_test_equipo_id", NULL);
        $this->DataSource->Parameters["urls_codigo_fonasa"] = CCGetFromGet("s_codigo_fonasa", NULL);
        $this->DataSource->Parameters["urls_cod_test"] = CCGetFromGet("s_cod_test", NULL);
        $this->DataSource->Parameters["urls_nom_test"] = CCGetFromGet("s_nom_test", NULL);
        $this->DataSource->Parameters["urls_seccion_id"] = CCGetFromGet("s_seccion_id", NULL);

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
            $this->ControlsVisible["ingresar_resultado"] = $this->ingresar_resultado->Visible;
            $this->ControlsVisible["signo_prioridad"] = $this->signo_prioridad->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["rut"] = $this->rut->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
            $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->ingresar_resultado->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->ingresar_resultado->Parameters = CCAddParam($this->ingresar_resultado->Parameters, "test_id", $this->DataSource->f("peticiones_detalle_test_id"));
                    $this->ingresar_resultado->Parameters = CCAddParam($this->ingresar_resultado->Parameters, "muestra_id", $this->DataSource->f("muestra_id"));
                    $this->ingresar_resultado->Parameters = CCAddParam($this->ingresar_resultado->Parameters, "fecha", $this->DataSource->f("fecha"));
                    $this->ingresar_resultado->Parameters = CCAddParam($this->ingresar_resultado->Parameters, "peticion_id", $this->DataSource->f("peticiones_peticion_id"));
                    $this->signo_prioridad->SetValue($this->DataSource->signo_prioridad->GetValue());
                    $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                    $this->rut->SetValue($this->DataSource->rut->GetValue());
                    $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                    $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                    $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->ingresar_resultado->Show();
                    $this->signo_prioridad->Show();
                    $this->fecha->Show();
                    $this->rut->Show();
                    $this->nombres->Show();
                    $this->apellidos->Show();
                    $this->cod_test->Show();
                    $this->nom_test->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->alt_ingresar_resultado->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->alt_ingresar_resultado->Parameters = CCAddParam($this->alt_ingresar_resultado->Parameters, "fecha", $this->DataSource->f("fecha"));
                    $this->alt_ingresar_resultado->Parameters = CCAddParam($this->alt_ingresar_resultado->Parameters, "test_id", $this->DataSource->f("peticiones_detalle_test_id"));
                    $this->alt_ingresar_resultado->Parameters = CCAddParam($this->alt_ingresar_resultado->Parameters, "muestra_id", $this->DataSource->f("muestra_id"));
                    $this->alt_ingresar_resultado->Parameters = CCAddParam($this->alt_ingresar_resultado->Parameters, "peticion_id", $this->DataSource->f("peticiones_peticion_id"));
                    $this->Alt_signo_prioridad->SetValue($this->DataSource->Alt_signo_prioridad->GetValue());
                    $this->Alt_fecha->SetValue($this->DataSource->Alt_fecha->GetValue());
                    $this->Alt_rut->SetValue($this->DataSource->Alt_rut->GetValue());
                    $this->Alt_nombres->SetValue($this->DataSource->Alt_nombres->GetValue());
                    $this->Alt_apellidos->SetValue($this->DataSource->Alt_apellidos->GetValue());
                    $this->Alt_cod_test->SetValue($this->DataSource->Alt_cod_test->GetValue());
                    $this->Alt_nom_test->SetValue($this->DataSource->Alt_nom_test->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->alt_ingresar_resultado->Show();
                    $this->Alt_signo_prioridad->Show();
                    $this->Alt_fecha->Show();
                    $this->Alt_rut->Show();
                    $this->Alt_nombres->Show();
                    $this->Alt_apellidos->Show();
                    $this->Alt_cod_test->Show();
                    $this->Alt_nom_test->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->op_filtro->Show();
        $this->equipos_estados_pacientes_TotalRecords->Show();
        $this->Sorter_signo_prioridad->Show();
        $this->Sorter_fecha->Show();
        $this->Sorter_rut->Show();
        $this->Sorter_nombres->Show();
        $this->Sorter_apellidos->Show();
        $this->Sorter_cod_test->Show();
        $this->Sorter_nom_test->Show();
        $this->volver->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-54026B57
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ingresar_resultado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->signo_prioridad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alt_ingresar_resultado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_signo_prioridad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End equipos_estados_pacientes Class @2-FCB6E20C

class clsequipos_estados_pacientesDataSource extends clsDBDatos {  //equipos_estados_pacientesDataSource Class @2-55C303DD

//DataSource Variables @2-5FC397BB
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $signo_prioridad;
    public $fecha;
    public $rut;
    public $nombres;
    public $apellidos;
    public $cod_test;
    public $nom_test;
    public $Alt_signo_prioridad;
    public $Alt_fecha;
    public $Alt_rut;
    public $Alt_nombres;
    public $Alt_apellidos;
    public $Alt_cod_test;
    public $Alt_nom_test;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-E6198934
    function clsequipos_estados_pacientesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid equipos_estados_pacientes";
        $this->Initialize();
        $this->signo_prioridad = new clsField("signo_prioridad", ccsText, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->Alt_signo_prioridad = new clsField("Alt_signo_prioridad", ccsText, "");
        
        $this->Alt_fecha = new clsField("Alt_fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->Alt_rut = new clsField("Alt_rut", ccsText, "");
        
        $this->Alt_nombres = new clsField("Alt_nombres", ccsText, "");
        
        $this->Alt_apellidos = new clsField("Alt_apellidos", ccsText, "");
        
        $this->Alt_cod_test = new clsField("Alt_cod_test", ccsText, "");
        
        $this->Alt_nom_test = new clsField("Alt_nom_test", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-6F636C71
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "fecha";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_signo_prioridad" => array("signo_prioridad", ""), 
            "Sorter_fecha" => array("fecha", ""), 
            "Sorter_rut" => array("rut", ""), 
            "Sorter_nombres" => array("nombres", ""), 
            "Sorter_apellidos" => array("apellidos", ""), 
            "Sorter_cod_test" => array("cod_test", ""), 
            "Sorter_nom_test" => array("nom_test", "")));
    }
//End SetOrder Method

//Prepare Method @2-579DCF4A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_rut", ccsText, "", "", $this->Parameters["urls_rut"], "", false);
        $this->wp->AddParameter("2", "urls_ficha", ccsText, "", "", $this->Parameters["urls_ficha"], "", false);
        $this->wp->AddParameter("3", "urls_nombres", ccsText, "", "", $this->Parameters["urls_nombres"], "", false);
        $this->wp->AddParameter("4", "urls_apellidos", ccsText, "", "", $this->Parameters["urls_apellidos"], "", false);
        $this->wp->AddParameter("5", "urls_peticiones_procedencia_id", ccsInteger, "", "", $this->Parameters["urls_peticiones_procedencia_id"], "", false);
        $this->wp->AddParameter("6", "urls_peticiones_estado_id", ccsInteger, "", "", $this->Parameters["urls_peticiones_estado_id"], "", false);
        $this->wp->AddParameter("7", "urls_fecha", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha"], "", false);
        $this->wp->AddParameter("8", "urls_muestra_id", ccsText, "", "", $this->Parameters["urls_muestra_id"], "", false);
        $this->wp->AddParameter("9", "urls_peticiones_detalle_prioridad_id", ccsInteger, "", "", $this->Parameters["urls_peticiones_detalle_prioridad_id"], "", false);
        $this->wp->AddParameter("10", "urls_test_equipo_id", ccsInteger, "", "", $this->Parameters["urls_test_equipo_id"], "", false);
        $this->wp->AddParameter("11", "urls_codigo_fonasa", ccsText, "", "", $this->Parameters["urls_codigo_fonasa"], "", false);
        $this->wp->AddParameter("12", "urls_cod_test", ccsText, "", "", $this->Parameters["urls_cod_test"], "", false);
        $this->wp->AddParameter("13", "urls_nom_test", ccsText, "", "", $this->Parameters["urls_nom_test"], "", false);
        $this->wp->AddParameter("14", "urls_seccion_id", ccsInteger, "", "", $this->Parameters["urls_seccion_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "rut", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "ficha", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "nombres", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "apellidos", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "peticiones.procedencia_id", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsInteger),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "peticiones.estado_id", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsInteger),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opEqual, "fecha", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsDate),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opContains, "muestra_id", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsText),false);
        $this->wp->Criterion[9] = $this->wp->Operation(opEqual, "peticiones_detalle.prioridad_id", $this->wp->GetDBValue("9"), $this->ToSQL($this->wp->GetDBValue("9"), ccsInteger),false);
        $this->wp->Criterion[10] = $this->wp->Operation(opEqual, "test.equipo_id", $this->wp->GetDBValue("10"), $this->ToSQL($this->wp->GetDBValue("10"), ccsInteger),false);
        $this->wp->Criterion[11] = $this->wp->Operation(opContains, "codigo_fonasa", $this->wp->GetDBValue("11"), $this->ToSQL($this->wp->GetDBValue("11"), ccsText),false);
        $this->wp->Criterion[12] = $this->wp->Operation(opContains, "cod_test", $this->wp->GetDBValue("12"), $this->ToSQL($this->wp->GetDBValue("12"), ccsText),false);
        $this->wp->Criterion[13] = $this->wp->Operation(opContains, "nom_test", $this->wp->GetDBValue("13"), $this->ToSQL($this->wp->GetDBValue("13"), ccsText),false);
        $this->wp->Criterion[14] = $this->wp->Operation(opEqual, "secciones.seccion_id", $this->wp->GetDBValue("14"), $this->ToSQL($this->wp->GetDBValue("14"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]), 
             $this->wp->Criterion[8]), 
             $this->wp->Criterion[9]), 
             $this->wp->Criterion[10]), 
             $this->wp->Criterion[11]), 
             $this->wp->Criterion[12]), 
             $this->wp->Criterion[13]), 
             $this->wp->Criterion[14]);
    }
//End Prepare Method

//Open Method @2-8B17A2DA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((((((test RIGHT JOIN peticiones ON\n\n" .
        "peticiones_detalle.test_id = test.test_id) LEFT JOIN secciones ON\n\n" .
        "test.secciones_id = secciones.seccion_id) INNER JOIN equipos ON\n\n" .
        "test.equipo_id = equipos.equipo_id) LEFT JOIN estados ON\n\n" .
        "peticiones.estado_id = estados.estado_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN peticiones_detalle ON\n\n" .
        "peticiones.peticion_id = peticiones_detalle.peticion_id) LEFT JOIN prioridades ON\n\n" .
        "peticiones_detalle.prioridad_id = prioridades.prioridad_id";
        $this->SQL = "SELECT nom_equipo, nom_estado, rut, ficha, nombres, apellidos, peticiones.peticion_id AS peticiones_peticion_id, peticiones.paciente_id AS peticiones_paciente_id,\n\n" .
        "peticiones.procedencia_id AS peticiones_procedencia_id, peticiones.estado_id AS peticiones_estado_id, fecha, hora, detalle_peticion_id,\n\n" .
        "muestra_id, peticiones_detalle.test_id AS peticiones_detalle_test_id, peticiones_detalle.prioridad_id AS peticiones_detalle_prioridad_id,\n\n" .
        "nom_prioridad, signo_prioridad, nom_procedencia, nom_seccion, secciones_id, test.equipo_id AS test_equipo_id, codigo_fonasa,\n\n" .
        "cod_test, nom_test, compuesto \n\n" .
        "FROM (((((((test RIGHT JOIN peticiones ON\n\n" .
        "peticiones_detalle.test_id = test.test_id) LEFT JOIN secciones ON\n\n" .
        "test.secciones_id = secciones.seccion_id) INNER JOIN equipos ON\n\n" .
        "test.equipo_id = equipos.equipo_id) LEFT JOIN estados ON\n\n" .
        "peticiones.estado_id = estados.estado_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN peticiones_detalle ON\n\n" .
        "peticiones.peticion_id = peticiones_detalle.peticion_id) LEFT JOIN prioridades ON\n\n" .
        "peticiones_detalle.prioridad_id = prioridades.prioridad_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-8FD94419
    function SetValues()
    {
        $this->signo_prioridad->SetDBValue($this->f("signo_prioridad"));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->rut->SetDBValue($this->f("rut"));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->Alt_signo_prioridad->SetDBValue($this->f("signo_prioridad"));
        $this->Alt_fecha->SetDBValue(trim($this->f("fecha")));
        $this->Alt_rut->SetDBValue($this->f("rut"));
        $this->Alt_nombres->SetDBValue($this->f("nombres"));
        $this->Alt_apellidos->SetDBValue($this->f("apellidos"));
        $this->Alt_cod_test->SetDBValue($this->f("cod_test"));
        $this->Alt_nom_test->SetDBValue($this->f("nom_test"));
    }
//End SetValues Method

} //End equipos_estados_pacientesDataSource Class @2-FCB6E20C

//Initialize Page @1-034820AB
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
$TemplateFileName = "list_resultados.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-AE2D2368
include_once("./list_resultados_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9A39B175
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$equipos_estados_pacientes = new clsGridequipos_estados_pacientes("", $MainPage);
$MainPage->equipos_estados_pacientes = & $equipos_estados_pacientes;
$equipos_estados_pacientes->Initialize();
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

//Go to destination page @1-5037AE47
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($equipos_estados_pacientes);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-40461559
$equipos_estados_pacientes->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-37814945
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($equipos_estados_pacientes);
unset($Tpl);
//End Unload Page

?>
