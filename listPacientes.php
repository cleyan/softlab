<?php
//Include Common Files @1-4B99BB62
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "listPacientes.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpacientesSearch { //pacientesSearch Class @207-9F70EC2C

//Variables @207-9E315808

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

//Class_Initialize Event @207-3C47C9AD
    function clsRecordpacientesSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record pacientesSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "pacientesSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_rut_ficha = new clsControl(ccsTextBox, "s_rut_ficha", "s_rut_ficha", ccsText, "", CCGetRequestParam("s_rut_ficha", $Method, NULL), $this);
            $this->s_nombres = new clsControl(ccsTextBox, "s_nombres", "s_nombres", ccsText, "", CCGetRequestParam("s_nombres", $Method, NULL), $this);
            $this->s_apellidos = new clsControl(ccsTextBox, "s_apellidos", "s_apellidos", ccsText, "", CCGetRequestParam("s_apellidos", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @207-47E108CD
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_rut_ficha->Validate() && $Validation);
        $Validation = ($this->s_nombres->Validate() && $Validation);
        $Validation = ($this->s_apellidos->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_rut_ficha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombres->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_apellidos->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @207-8F90A71A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_rut_ficha->Errors->Count());
        $errors = ($errors || $this->s_nombres->Errors->Count());
        $errors = ($errors || $this->s_apellidos->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @207-5D9BC0E9
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
        $Redirect = "listPacientes.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "listPacientes.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @207-BD227AA8
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_rut_ficha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombres->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_apellidos->Errors->ToString());
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

        $this->s_rut_ficha->Show();
        $this->s_nombres->Show();
        $this->s_apellidos->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End pacientesSearch Class @207-FCB6E20C

class clsGridpacientes { //pacientes class @204-DD04FD36

//Variables @204-34593290

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
    public $Sorter_rut;
    public $Sorter_ficha;
    public $Sorter_nombres;
    public $Sorter_apellidos;
    public $Sorter_fono;
    public $Sorter_celular;
    public $Sorter_email;
//End Variables

//Class_Initialize Event @204-9889E921
    function clsGridpacientes($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "pacientes";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid pacientes";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspacientesDataSource($this);
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
        $this->SorterName = CCGetParam("pacientesOrder", "");
        $this->SorterDirection = CCGetParam("pacientesDir", "");

        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "add_pacientes.php";
        $this->ImageLink2 = new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $this);
        $this->ImageLink2->Page = "detalle_pago_peticiones.php";
        $this->ImageLink3 = new clsControl(ccsImageLink, "ImageLink3", "ImageLink3", ccsText, "", CCGetRequestParam("ImageLink3", ccsGet, NULL), $this);
        $this->ImageLink3->Page = "stat_historiapaciente.php";
        $this->rut = new clsControl(ccsLabel, "rut", "rut", ccsText, "", CCGetRequestParam("rut", ccsGet, NULL), $this);
        $this->ficha = new clsControl(ccsLabel, "ficha", "ficha", ccsText, "", CCGetRequestParam("ficha", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->fono = new clsControl(ccsLabel, "fono", "fono", ccsText, "", CCGetRequestParam("fono", ccsGet, NULL), $this);
        $this->celular = new clsControl(ccsLabel, "celular", "celular", ccsText, "", CCGetRequestParam("celular", ccsGet, NULL), $this);
        $this->email = new clsControl(ccsLabel, "email", "email", ccsText, "", CCGetRequestParam("email", ccsGet, NULL), $this);
        $this->pacientes_TotalRecords = new clsControl(ccsLabel, "pacientes_TotalRecords", "pacientes_TotalRecords", ccsText, "", CCGetRequestParam("pacientes_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_rut = new clsSorter($this->ComponentName, "Sorter_rut", $FileName, $this);
        $this->Sorter_ficha = new clsSorter($this->ComponentName, "Sorter_ficha", $FileName, $this);
        $this->Sorter_nombres = new clsSorter($this->ComponentName, "Sorter_nombres", $FileName, $this);
        $this->Sorter_apellidos = new clsSorter($this->ComponentName, "Sorter_apellidos", $FileName, $this);
        $this->Sorter_fono = new clsSorter($this->ComponentName, "Sorter_fono", $FileName, $this);
        $this->Sorter_celular = new clsSorter($this->ComponentName, "Sorter_celular", $FileName, $this);
        $this->Sorter_email = new clsSorter($this->ComponentName, "Sorter_email", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @204-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @204-CCDDE2F8
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_rut_ficha"] = CCGetFromGet("s_rut_ficha", NULL);
        $this->DataSource->Parameters["urls_nombres"] = CCGetFromGet("s_nombres", NULL);
        $this->DataSource->Parameters["urls_apellidos"] = CCGetFromGet("s_apellidos", NULL);

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
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            $this->ControlsVisible["ImageLink2"] = $this->ImageLink2->Visible;
            $this->ControlsVisible["ImageLink3"] = $this->ImageLink3->Visible;
            $this->ControlsVisible["rut"] = $this->rut->Visible;
            $this->ControlsVisible["ficha"] = $this->ficha->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["fono"] = $this->fono->Visible;
            $this->ControlsVisible["celular"] = $this->celular->Visible;
            $this->ControlsVisible["email"] = $this->email->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "paciente_id", $this->DataSource->f("paciente_id"));
                $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "paciente_id", $this->DataSource->f("paciente_id"));
                $this->ImageLink3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink3->Parameters = CCAddParam($this->ImageLink3->Parameters, "paciente_id", $this->DataSource->f("paciente_id"));
                $this->rut->SetValue($this->DataSource->rut->GetValue());
                $this->ficha->SetValue($this->DataSource->ficha->GetValue());
                $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                $this->fono->SetValue($this->DataSource->fono->GetValue());
                $this->celular->SetValue($this->DataSource->celular->GetValue());
                $this->email->SetValue($this->DataSource->email->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ImageLink1->Show();
                $this->ImageLink2->Show();
                $this->ImageLink3->Show();
                $this->rut->Show();
                $this->ficha->Show();
                $this->nombres->Show();
                $this->apellidos->Show();
                $this->fono->Show();
                $this->celular->Show();
                $this->email->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->pacientes_TotalRecords->Show();
        $this->Sorter_rut->Show();
        $this->Sorter_ficha->Show();
        $this->Sorter_nombres->Show();
        $this->Sorter_apellidos->Show();
        $this->Sorter_fono->Show();
        $this->Sorter_celular->Show();
        $this->Sorter_email->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @204-FE74E338
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->celular->Errors->ToString());
        $errors = ComposeStrings($errors, $this->email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End pacientes Class @204-FCB6E20C

class clspacientesDataSource extends clsDBDatos {  //pacientesDataSource Class @204-BFE569F0

//DataSource Variables @204-91F72717
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $rut;
    public $ficha;
    public $nombres;
    public $apellidos;
    public $fono;
    public $celular;
    public $email;
//End DataSource Variables

//DataSourceClass_Initialize Event @204-4D2A425F
    function clspacientesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid pacientes";
        $this->Initialize();
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->ficha = new clsField("ficha", ccsText, "");
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->fono = new clsField("fono", ccsText, "");
        
        $this->celular = new clsField("celular", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @204-7301F71A
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "nombres, apellidos, rut";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_rut" => array("rut", ""), 
            "Sorter_ficha" => array("ficha", ""), 
            "Sorter_nombres" => array("nombres", ""), 
            "Sorter_apellidos" => array("apellidos", ""), 
            "Sorter_fono" => array("fono", ""), 
            "Sorter_celular" => array("celular", ""), 
            "Sorter_email" => array("email", "")));
    }
//End SetOrder Method

//Prepare Method @204-3C4473C2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_rut_ficha", ccsText, "", "", $this->Parameters["urls_rut_ficha"], "", false);
        $this->wp->AddParameter("2", "urls_rut_ficha", ccsText, "", "", $this->Parameters["urls_rut_ficha"], "", false);
        $this->wp->AddParameter("3", "urls_nombres", ccsText, "", "", $this->Parameters["urls_nombres"], "", false);
        $this->wp->AddParameter("4", "urls_apellidos", ccsText, "", "", $this->Parameters["urls_apellidos"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "rut", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "ficha", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "nombres", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "apellidos", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opOR(
             true, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @204-7DF435BF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM pacientes";
        $this->SQL = "SELECT * \n\n" .
        "FROM pacientes {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @204-5EAF613B
    function SetValues()
    {
        $this->rut->SetDBValue($this->f("rut"));
        $this->ficha->SetDBValue($this->f("ficha"));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->fono->SetDBValue($this->f("fono"));
        $this->celular->SetDBValue($this->f("celular"));
        $this->email->SetDBValue($this->f("email"));
    }
//End SetValues Method

} //End pacientesDataSource Class @204-FCB6E20C

//Initialize Page @1-18BB6852
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
$TemplateFileName = "listPacientes.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-D9A13369
include_once("./listPacientes_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D23BAD7E
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$pacientesSearch = new clsRecordpacientesSearch("", $MainPage);
$pacientes = new clsGridpacientes("", $MainPage);
$addPaciente = new clsControl(ccsImageLink, "addPaciente", "addPaciente", ccsText, "", CCGetRequestParam("addPaciente", ccsGet, NULL), $MainPage);
$addPaciente->Page = "add_pacientes.php";
$ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $MainPage);
$ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$ImageLink1->Page = "menu_principal.php";
$MainPage->pacientesSearch = & $pacientesSearch;
$MainPage->pacientes = & $pacientes;
$MainPage->addPaciente = & $addPaciente;
$MainPage->ImageLink1 = & $ImageLink1;
$addPaciente->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$addPaciente->Parameters = CCAddParam($addPaciente->Parameters, "paciente_id", "");
$pacientes->Initialize();
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

//Execute Components @1-7B376482
$pacientesSearch->Operation();
//End Execute Components

//Go to destination page @1-397EEE9E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($pacientesSearch);
    unset($pacientes);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A849FEFD
$pacientesSearch->Show();
$pacientes->Show();
$addPaciente->Show();
$ImageLink1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-ECD441A2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($pacientesSearch);
unset($pacientes);
unset($Tpl);
//End Unload Page


?>
