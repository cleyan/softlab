<?php
//Include Common Files @1-3AA4D77A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "stat_liquidacion.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpeticiones_previsiones_prSearch { //peticiones_previsiones_prSearch Class @11-55E76938

//Variables @11-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @11-83C93652
    function clsRecordpeticiones_previsiones_prSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record peticiones_previsiones_prSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "peticiones_previsiones_prSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_procedencia_id = new clsControl(ccsListBox, "s_procedencia_id", "s_procedencia_id", ccsInteger, "", CCGetRequestParam("s_procedencia_id", $Method, NULL), $this);
            $this->s_procedencia_id->DSType = dsTable;
            $this->s_procedencia_id->DataSource = new clsDBDatos();
            $this->s_procedencia_id->ds = & $this->s_procedencia_id->DataSource;
            $this->s_procedencia_id->DataSource->SQL = "SELECT * \n" .
"FROM procedencias {SQL_Where} {SQL_OrderBy}";
            $this->s_procedencia_id->DataSource->Order = "nom_procedencia";
            list($this->s_procedencia_id->BoundColumn, $this->s_procedencia_id->TextColumn, $this->s_procedencia_id->DBFormat) = array("procedencia_id", "nom_procedencia", "");
            $this->s_procedencia_id->DataSource->Parameters["expr149"] = GetUserProcedenciaID();
            $this->s_procedencia_id->DataSource->wp = new clsSQLParameters();
            $this->s_procedencia_id->DataSource->wp->AddParameter("1", "expr149", ccsInteger, "", "", $this->s_procedencia_id->DataSource->Parameters["expr149"], "", false);
            $this->s_procedencia_id->DataSource->wp->Criterion[1] = $this->s_procedencia_id->DataSource->wp->Operation(opEqual, "procedencia_id", $this->s_procedencia_id->DataSource->wp->GetDBValue("1"), $this->s_procedencia_id->DataSource->ToSQL($this->s_procedencia_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->s_procedencia_id->DataSource->wp->Criterion[2] = "( " . CCGetGroupID() . " > 4 )";
            $this->s_procedencia_id->DataSource->Where = $this->s_procedencia_id->DataSource->wp->opOR(
                 false, 
                 $this->s_procedencia_id->DataSource->wp->Criterion[1], 
                 $this->s_procedencia_id->DataSource->wp->Criterion[2]);
            $this->s_procedencia_id->DataSource->Order = "nom_procedencia";
            $this->s_prevision_id = new clsControl(ccsListBox, "s_prevision_id", "s_prevision_id", ccsInteger, "", CCGetRequestParam("s_prevision_id", $Method, NULL), $this);
            $this->s_prevision_id->DSType = dsTable;
            $this->s_prevision_id->DataSource = new clsDBDatos();
            $this->s_prevision_id->ds = & $this->s_prevision_id->DataSource;
            $this->s_prevision_id->DataSource->SQL = "SELECT * \n" .
"FROM previsiones {SQL_Where} {SQL_OrderBy}";
            list($this->s_prevision_id->BoundColumn, $this->s_prevision_id->TextColumn, $this->s_prevision_id->DBFormat) = array("prevision_id", "nom_prevision", "");
            $this->s_fecha_ini = new clsControl(ccsTextBox, "s_fecha_ini", "Fecha Inicial", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_ini", $Method, NULL), $this);
            $this->s_fecha_ini->Required = true;
            $this->s_fecha_fin = new clsControl(ccsTextBox, "s_fecha_fin", "Fecha Final", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_fin", $Method, NULL), $this);
            $this->s_fecha_fin->Required = true;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->s_procedencia_id->Value) && !strlen($this->s_procedencia_id->Value) && $this->s_procedencia_id->Value !== false)
                    $this->s_procedencia_id->SetText(GetUserProcedenciaID());
            }
        }
    }
//End Class_Initialize Event

//Validate Method @11-46137A4D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_procedencia_id->Validate() && $Validation);
        $Validation = ($this->s_prevision_id->Validate() && $Validation);
        $Validation = ($this->s_fecha_ini->Validate() && $Validation);
        $Validation = ($this->s_fecha_fin->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_prevision_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_ini->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_fin->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @11-EAEEE232
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_procedencia_id->Errors->Count());
        $errors = ($errors || $this->s_prevision_id->Errors->Count());
        $errors = ($errors || $this->s_fecha_ini->Errors->Count());
        $errors = ($errors || $this->s_fecha_fin->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @11-2C11EFD9
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "stat_liquidacion.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "stat_liquidacion.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @11-6F27BB82
    function Show()
    {
        global $CCSUseAmp;
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->s_procedencia_id->Prepare();
        $this->s_prevision_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_prevision_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_ini->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_fin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->s_procedencia_id->Show();
        $this->s_prevision_id->Show();
        $this->s_fecha_ini->Show();
        $this->s_fecha_fin->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End peticiones_previsiones_prSearch Class @11-FCB6E20C

class clsGridpeticiones_previsiones_pr { //peticiones_previsiones_pr class @2-61F9B3F6

//Variables @2-28FE0133

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
    public $Sorter_fecha;
    public $Sorter_peticion_id;
    public $Paciente;
    public $Sorter_nom_procedencia;
    public $Sorter_nom_prevision;
//End Variables

//Class_Initialize Event @2-83003CC3
    function clsGridpeticiones_previsiones_pr($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "peticiones_previsiones_pr";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid peticiones_previsiones_pr";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_previsiones_prDataSource($this);
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
        $this->SorterName = CCGetParam("peticiones_previsiones_prOrder", "");
        $this->SorterDirection = CCGetParam("peticiones_previsiones_prDir", "");

        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->s_peticion_id = new clsControl(ccsHidden, "s_peticion_id", "s_peticion_id", ccsInteger, "", CCGetRequestParam("s_peticion_id", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->nom_procedencia = new clsControl(ccsLabel, "nom_procedencia", "nom_procedencia", ccsText, "", CCGetRequestParam("nom_procedencia", ccsGet, NULL), $this);
        $this->nom_prevision = new clsControl(ccsLabel, "nom_prevision", "nom_prevision", ccsText, "", CCGetRequestParam("nom_prevision", ccsGet, NULL), $this);
        $this->lbl_total = new clsControl(ccsLabel, "lbl_total", "lbl_total", ccsInteger, array(False, 0, Null, "", False, "\$", "", 1, True, ""), CCGetRequestParam("lbl_total", ccsGet, NULL), $this);
        $this->peticiones_previsiones_pr_TotalRecords = new clsControl(ccsLabel, "peticiones_previsiones_pr_TotalRecords", "peticiones_previsiones_pr_TotalRecords", ccsText, "", CCGetRequestParam("peticiones_previsiones_pr_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_fecha = new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Sorter_peticion_id = new clsSorter($this->ComponentName, "Sorter_peticion_id", $FileName, $this);
        $this->Paciente = new clsSorter($this->ComponentName, "Paciente", $FileName, $this);
        $this->Sorter_nom_procedencia = new clsSorter($this->ComponentName, "Sorter_nom_procedencia", $FileName, $this);
        $this->Sorter_nom_prevision = new clsSorter($this->ComponentName, "Sorter_nom_prevision", $FileName, $this);
        $this->Navigator1 = new clsNavigator($this->ComponentName, "Navigator1", $FileName, 10, tpSimple, $this);
        $this->Navigator1->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-C0354FDB
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_procedencia_id"] = CCGetFromGet("s_procedencia_id", NULL);
        $this->DataSource->Parameters["urls_prevision_id"] = CCGetFromGet("s_prevision_id", NULL);
        $this->DataSource->Parameters["urls_fecha_ini"] = CCGetFromGet("s_fecha_ini", NULL);
        $this->DataSource->Parameters["urls_fecha_fin"] = CCGetFromGet("s_fecha_fin", NULL);

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
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["peticion_id"] = $this->peticion_id->Visible;
            $this->ControlsVisible["s_peticion_id"] = $this->s_peticion_id->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["nom_procedencia"] = $this->nom_procedencia->Visible;
            $this->ControlsVisible["nom_prevision"] = $this->nom_prevision->Visible;
            $this->ControlsVisible["lbl_total"] = $this->lbl_total->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                $this->s_peticion_id->SetValue($this->DataSource->s_peticion_id->GetValue());
                $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                $this->nom_prevision->SetValue($this->DataSource->nom_prevision->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->fecha->Show();
                $this->peticion_id->Show();
                $this->s_peticion_id->Show();
                $this->nombres->Show();
                $this->apellidos->Show();
                $this->nom_procedencia->Show();
                $this->nom_prevision->Show();
                $this->lbl_total->Show();
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
        $this->Navigator1->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator1->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator1->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator1->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator1->TotalPages <= 1 && $this->Navigator1->PageNumber == 1) || $this->Navigator1->PageSize == "") {
            $this->Navigator1->Visible = false;
        }
        $this->peticiones_previsiones_pr_TotalRecords->Show();
        $this->Sorter_fecha->Show();
        $this->Sorter_peticion_id->Show();
        $this->Paciente->Show();
        $this->Sorter_nom_procedencia->Show();
        $this->Sorter_nom_prevision->Show();
        $this->Navigator1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-9AEE8D1B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->s_peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_prevision->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_total->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_previsiones_pr Class @2-FCB6E20C

class clspeticiones_previsiones_prDataSource extends clsDBDatos {  //peticiones_previsiones_prDataSource Class @2-815EC6BB

//DataSource Variables @2-37F274D3
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $fecha;
    public $peticion_id;
    public $s_peticion_id;
    public $nombres;
    public $apellidos;
    public $nom_procedencia;
    public $nom_prevision;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-624FE7E0
    function clspeticiones_previsiones_prDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_previsiones_pr";
        $this->Initialize();
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->s_peticion_id = new clsField("s_peticion_id", ccsInteger, "");
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->nom_procedencia = new clsField("nom_procedencia", ccsText, "");
        
        $this->nom_prevision = new clsField("nom_prevision", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-3873025C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "peticion_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_fecha" => array("fecha", ""), 
            "Sorter_peticion_id" => array("peticion_id", ""), 
            "Paciente" => array("nombres", ""), 
            "Sorter_nom_procedencia" => array("nom_procedencia", ""), 
            "Sorter_nom_prevision" => array("nom_prevision", "")));
    }
//End SetOrder Method

//Prepare Method @2-8AEAA25F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_procedencia_id", ccsInteger, "", "", $this->Parameters["urls_procedencia_id"], "", false);
        $this->wp->AddParameter("2", "urls_prevision_id", ccsInteger, "", "", $this->Parameters["urls_prevision_id"], "", false);
        $this->wp->AddParameter("3", "urls_fecha_ini", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha_ini"], "", false);
        $this->wp->AddParameter("4", "urls_fecha_fin", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha_fin"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "peticiones.procedencia_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "peticiones.prevision_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opGreaterThanOrEqual, "peticiones.fecha", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opLessThanOrEqual, "peticiones.fecha", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsDate),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), $this->wp->opAND(
             true, 
             $this->wp->Criterion[3], 
             $this->wp->Criterion[4]));
    }
//End Prepare Method

//Open Method @2-D3E9DE39
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((peticiones LEFT JOIN previsiones ON\n\n" .
        "peticiones.prevision_id = previsiones.prevision_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id";
        $this->SQL = "SELECT peticion_id, peticiones.prevision_id AS peticiones_prevision_id, fecha, nom_prevision, nom_procedencia, nombres, apellidos \n\n" .
        "FROM ((peticiones LEFT JOIN previsiones ON\n\n" .
        "peticiones.prevision_id = previsiones.prevision_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-23D3957F
    function SetValues()
    {
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->s_peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->nom_prevision->SetDBValue($this->f("nom_prevision"));
    }
//End SetValues Method

} //End peticiones_previsiones_prDataSource Class @2-FCB6E20C

class clsRecordImpresion { //Impresion Class @73-4EF81E21

//Variables @73-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @73-A8D43AC3
    function clsRecordImpresion($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Impresion/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Impresion";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_detallado = new clsControl(ccsRadioButton, "s_detallado", "Tipo de Informe", ccsInteger, "", CCGetRequestParam("s_detallado", $Method, NULL), $this);
            $this->s_detallado->DSType = dsListOfValues;
            $this->s_detallado->Values = array(array("0", "Informe Detallado"), array("1", "Informe Resumido"));
            $this->s_detallado->HTML = true;
            $this->s_detallado->Required = true;
            $this->s_fecha_ini = new clsControl(ccsHidden, "s_fecha_ini", "Fecha Inicial", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_ini", $Method, NULL), $this);
            $this->s_fecha_ini->Required = true;
            $this->s_fecha_fin = new clsControl(ccsHidden, "s_fecha_fin", "Fecha Final", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_fin", $Method, NULL), $this);
            $this->s_fecha_fin->Required = true;
            $this->s_procedencia_id = new clsControl(ccsHidden, "s_procedencia_id", "Procedencia", ccsInteger, "", CCGetRequestParam("s_procedencia_id", $Method, NULL), $this);
            $this->s_prevision_id = new clsControl(ccsHidden, "s_prevision_id", "Procedencia", ccsInteger, "", CCGetRequestParam("s_prevision_id", $Method, NULL), $this);
            $this->Imprimir = new clsButton("Imprimir", $Method, $this);
            $this->Cancelar = new clsButton("Cancelar", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @73-4159E201
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_detallado->Validate() && $Validation);
        $Validation = ($this->s_fecha_ini->Validate() && $Validation);
        $Validation = ($this->s_fecha_fin->Validate() && $Validation);
        $Validation = ($this->s_procedencia_id->Validate() && $Validation);
        $Validation = ($this->s_prevision_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_detallado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_ini->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_fin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_prevision_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @73-EBF07EA0
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_detallado->Errors->Count());
        $errors = ($errors || $this->s_fecha_ini->Errors->Count());
        $errors = ($errors || $this->s_fecha_fin->Errors->Count());
        $errors = ($errors || $this->s_procedencia_id->Errors->Count());
        $errors = ($errors || $this->s_prevision_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @73-472527F7
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Imprimir";
            if($this->Imprimir->Pressed) {
                $this->PressedButton = "Imprimir";
            } else if($this->Cancelar->Pressed) {
                $this->PressedButton = "Cancelar";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Cancelar") {
            $Redirect = "menu_principal.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            if(!CCGetEvent($this->Cancelar->CCSEvents, "OnClick", $this->Cancelar)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Imprimir") {
                $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Imprimir", "Imprimir_x", "Imprimir_y", "Cancelar", "Cancelar_x", "Cancelar_y")), CCGetQueryString("QueryString", array("s_detallado", "s_fecha_ini", "s_fecha_fin", "s_procedencia_id", "s_prevision_id", "ccsForm")));
                if(!CCGetEvent($this->Imprimir->CCSEvents, "OnClick", $this->Imprimir)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @73-B0C58C28
    function Show()
    {
        global $CCSUseAmp;
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->s_detallado->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_detallado->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_ini->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_fin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_prevision_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->s_detallado->Show();
        $this->s_fecha_ini->Show();
        $this->s_fecha_fin->Show();
        $this->s_procedencia_id->Show();
        $this->s_prevision_id->Show();
        $this->Imprimir->Show();
        $this->Cancelar->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Impresion Class @73-FCB6E20C

//Include Page implementation @70-3294FEB1
include_once(RelativePath . "/calendar_tag.php");
//End Include Page implementation

//Initialize Page @1-61220FE1
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
$TemplateFileName = "stat_liquidacion.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-04C0FC68
CCSecurityRedirect("4;5;6;7;8;13;14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-E4DCDEDF
include_once("./stat_liquidacion_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0B0CB686
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$peticiones_previsiones_prSearch = new clsRecordpeticiones_previsiones_prSearch("", $MainPage);
$peticiones_previsiones_pr = new clsGridpeticiones_previsiones_pr("", $MainPage);
$Impresion = new clsRecordImpresion("", $MainPage);
$calendar_tag = new clscalendar_tag("", "calendar_tag", $MainPage);
$calendar_tag->Initialize();
$MainPage->peticiones_previsiones_prSearch = & $peticiones_previsiones_prSearch;
$MainPage->peticiones_previsiones_pr = & $peticiones_previsiones_pr;
$MainPage->Impresion = & $Impresion;
$MainPage->calendar_tag = & $calendar_tag;
$peticiones_previsiones_pr->Initialize();
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

//Execute Components @1-664421FD
$calendar_tag->Operations();
$Impresion->Operation();
$peticiones_previsiones_prSearch->Operation();
//End Execute Components

//Go to destination page @1-37B40BF3
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_previsiones_prSearch);
    unset($peticiones_previsiones_pr);
    unset($Impresion);
    $calendar_tag->Class_Terminate();
    unset($calendar_tag);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-40568077
$peticiones_previsiones_prSearch->Show();
$peticiones_previsiones_pr->Show();
$Impresion->Show();
$calendar_tag->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-81F72A31
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_previsiones_prSearch);
unset($peticiones_previsiones_pr);
unset($Impresion);
$calendar_tag->Class_Terminate();
unset($calendar_tag);
unset($Tpl);
//End Unload Page


?>
