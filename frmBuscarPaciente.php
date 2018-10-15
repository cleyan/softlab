<?php
//Include Common Files @1-A7B1DC8A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "frmBuscarPaciente.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpacientesSearch { //pacientesSearch Class @3-9F70EC2C

//Variables @3-9E315808

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

//Class_Initialize Event @3-44C3A38B
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
            $this->s_nombre = new clsControl(ccsTextBox, "s_nombre", "s_nombre", ccsText, "", CCGetRequestParam("s_nombre", $Method, NULL), $this);
            $this->s_apellido = new clsControl(ccsTextBox, "s_apellido", "s_apellido", ccsText, "", CCGetRequestParam("s_apellido", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-CB46B5C0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_rut_ficha->Validate() && $Validation);
        $Validation = ($this->s_nombre->Validate() && $Validation);
        $Validation = ($this->s_apellido->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_rut_ficha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombre->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_apellido->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-9C08BD28
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_rut_ficha->Errors->Count());
        $errors = ($errors || $this->s_nombre->Errors->Count());
        $errors = ($errors || $this->s_apellido->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-764E371C
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
        $Redirect = "frmBuscarPaciente.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "frmBuscarPaciente.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-E69B1909
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
            $Error = ComposeStrings($Error, $this->s_nombre->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_apellido->Errors->ToString());
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
        $this->s_nombre->Show();
        $this->s_apellido->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End pacientesSearch Class @3-FCB6E20C

class clsGridpacientes { //pacientes class @2-DD04FD36

//Variables @2-B3120B8E

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
    public $Sorter_rut;
    public $Sorter_ficha;
    public $Sorter_nombres;
    public $Sorter_apellidos;
//End Variables

//Class_Initialize Event @2-073B745D
    function clsGridpacientes($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "pacientes";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid pacientes";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspacientesDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 15;
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

        $this->Aceptar = new clsControl(ccsLabel, "Aceptar", "Aceptar", ccsText, "", CCGetRequestParam("Aceptar", ccsGet, NULL), $this);
        $this->Aceptar->HTML = true;
        $this->rut = new clsControl(ccsLabel, "rut", "rut", ccsText, "", CCGetRequestParam("rut", ccsGet, NULL), $this);
        $this->paciente_id = new clsControl(ccsHidden, "paciente_id", "paciente_id", ccsInteger, "", CCGetRequestParam("paciente_id", ccsGet, NULL), $this);
        $this->prevision_id = new clsControl(ccsHidden, "prevision_id", "prevision_id", ccsInteger, "", CCGetRequestParam("prevision_id", ccsGet, NULL), $this);
        $this->ficha = new clsControl(ccsLabel, "ficha", "ficha", ccsText, "", CCGetRequestParam("ficha", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->ImageLink2 = new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $this);
        $this->ImageLink2->Page = "win_add_paciente.php";
        $this->Alt_Aceptar = new clsControl(ccsLabel, "Alt_Aceptar", "Alt_Aceptar", ccsText, "", CCGetRequestParam("Alt_Aceptar", ccsGet, NULL), $this);
        $this->Alt_Aceptar->HTML = true;
        $this->Alt_rut = new clsControl(ccsLabel, "Alt_rut", "Alt_rut", ccsText, "", CCGetRequestParam("Alt_rut", ccsGet, NULL), $this);
        $this->Alt_paciente_id = new clsControl(ccsHidden, "Alt_paciente_id", "Alt_paciente_id", ccsInteger, "", CCGetRequestParam("Alt_paciente_id", ccsGet, NULL), $this);
        $this->Alt_prevision_id = new clsControl(ccsHidden, "Alt_prevision_id", "Alt_prevision_id", ccsInteger, "", CCGetRequestParam("Alt_prevision_id", ccsGet, NULL), $this);
        $this->Alt_ficha = new clsControl(ccsLabel, "Alt_ficha", "Alt_ficha", ccsText, "", CCGetRequestParam("Alt_ficha", ccsGet, NULL), $this);
        $this->Alt_nombres = new clsControl(ccsLabel, "Alt_nombres", "Alt_nombres", ccsText, "", CCGetRequestParam("Alt_nombres", ccsGet, NULL), $this);
        $this->Alt_apellidos = new clsControl(ccsLabel, "Alt_apellidos", "Alt_apellidos", ccsText, "", CCGetRequestParam("Alt_apellidos", ccsGet, NULL), $this);
        $this->ImageLink3 = new clsControl(ccsImageLink, "ImageLink3", "ImageLink3", ccsText, "", CCGetRequestParam("ImageLink3", ccsGet, NULL), $this);
        $this->ImageLink3->Page = "win_add_paciente.php";
        $this->pacientes_TotalRecords = new clsControl(ccsLabel, "pacientes_TotalRecords", "pacientes_TotalRecords", ccsText, "", CCGetRequestParam("pacientes_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_rut = new clsSorter($this->ComponentName, "Sorter_rut", $FileName, $this);
        $this->Sorter_ficha = new clsSorter($this->ComponentName, "Sorter_ficha", $FileName, $this);
        $this->Sorter_nombres = new clsSorter($this->ComponentName, "Sorter_nombres", $FileName, $this);
        $this->Sorter_apellidos = new clsSorter($this->ComponentName, "Sorter_apellidos", $FileName, $this);
        $this->Navigator1 = new clsNavigator($this->ComponentName, "Navigator1", $FileName, 10, tpSimple, $this);
        $this->Navigator1->PageSizes = array("1", "5", "10", "25", "50");
        $this->btn_agregar = new clsControl(ccsImageLink, "btn_agregar", "btn_agregar", ccsText, "", CCGetRequestParam("btn_agregar", ccsGet, NULL), $this);
        $this->btn_agregar->Page = "win_add_paciente.php";
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Page = "#";
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

//Show Method @2-5975643D
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_rut_ficha"] = CCGetFromGet("s_rut_ficha", NULL);
        $this->DataSource->Parameters["urls_nombre"] = CCGetFromGet("s_nombre", NULL);
        $this->DataSource->Parameters["urls_apellido"] = CCGetFromGet("s_apellido", NULL);

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
            $this->ControlsVisible["Aceptar"] = $this->Aceptar->Visible;
            $this->ControlsVisible["rut"] = $this->rut->Visible;
            $this->ControlsVisible["paciente_id"] = $this->paciente_id->Visible;
            $this->ControlsVisible["prevision_id"] = $this->prevision_id->Visible;
            $this->ControlsVisible["ficha"] = $this->ficha->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["ImageLink2"] = $this->ImageLink2->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->rut->SetValue($this->DataSource->rut->GetValue());
                    $this->paciente_id->SetValue($this->DataSource->paciente_id->GetValue());
                    $this->prevision_id->SetValue($this->DataSource->prevision_id->GetValue());
                    $this->ficha->SetValue($this->DataSource->ficha->GetValue());
                    $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                    $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                    $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "paciente_id", $this->DataSource->f("paciente_id"));
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Aceptar->Show();
                    $this->rut->Show();
                    $this->paciente_id->Show();
                    $this->prevision_id->Show();
                    $this->ficha->Show();
                    $this->nombres->Show();
                    $this->apellidos->Show();
                    $this->ImageLink2->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_rut->SetValue($this->DataSource->Alt_rut->GetValue());
                    $this->Alt_paciente_id->SetValue($this->DataSource->Alt_paciente_id->GetValue());
                    $this->Alt_prevision_id->SetValue($this->DataSource->Alt_prevision_id->GetValue());
                    $this->Alt_ficha->SetValue($this->DataSource->Alt_ficha->GetValue());
                    $this->Alt_nombres->SetValue($this->DataSource->Alt_nombres->GetValue());
                    $this->Alt_apellidos->SetValue($this->DataSource->Alt_apellidos->GetValue());
                    $this->ImageLink3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->ImageLink3->Parameters = CCAddParam($this->ImageLink3->Parameters, "paciente_id", $this->DataSource->f("paciente_id"));
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Alt_Aceptar->Show();
                    $this->Alt_rut->Show();
                    $this->Alt_paciente_id->Show();
                    $this->Alt_prevision_id->Show();
                    $this->Alt_ficha->Show();
                    $this->Alt_nombres->Show();
                    $this->Alt_apellidos->Show();
                    $this->ImageLink3->Show();
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
        $this->Navigator1->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator1->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator1->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator1->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator1->TotalPages <= 1 && $this->Navigator1->PageNumber == 1) || $this->Navigator1->PageSize == "") {
            $this->Navigator1->Visible = false;
        }
        $this->btn_agregar->Parameters = "";
        $this->btn_agregar->Parameters = CCAddParam($this->btn_agregar->Parameters, "origen", "desdeventana");
        $this->pacientes_TotalRecords->Show();
        $this->Sorter_rut->Show();
        $this->Sorter_ficha->Show();
        $this->Sorter_nombres->Show();
        $this->Sorter_apellidos->Show();
        $this->Navigator1->Show();
        $this->btn_agregar->Show();
        $this->ImageLink1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-3DD5A160
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Aceptar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->paciente_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prevision_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_Aceptar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_paciente_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_prevision_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_ficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End pacientes Class @2-FCB6E20C

class clspacientesDataSource extends clsDBDatos {  //pacientesDataSource Class @2-BFE569F0

//DataSource Variables @2-194517CD
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $rut;
    public $paciente_id;
    public $prevision_id;
    public $ficha;
    public $nombres;
    public $apellidos;
    public $Alt_rut;
    public $Alt_paciente_id;
    public $Alt_prevision_id;
    public $Alt_ficha;
    public $Alt_nombres;
    public $Alt_apellidos;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-E5BD0021
    function clspacientesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid pacientes";
        $this->Initialize();
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->paciente_id = new clsField("paciente_id", ccsInteger, "");
        
        $this->prevision_id = new clsField("prevision_id", ccsInteger, "");
        
        $this->ficha = new clsField("ficha", ccsText, "");
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->Alt_rut = new clsField("Alt_rut", ccsText, "");
        
        $this->Alt_paciente_id = new clsField("Alt_paciente_id", ccsInteger, "");
        
        $this->Alt_prevision_id = new clsField("Alt_prevision_id", ccsInteger, "");
        
        $this->Alt_ficha = new clsField("Alt_ficha", ccsText, "");
        
        $this->Alt_nombres = new clsField("Alt_nombres", ccsText, "");
        
        $this->Alt_apellidos = new clsField("Alt_apellidos", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-EC539695
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_rut" => array("rut", ""), 
            "Sorter_ficha" => array("ficha", ""), 
            "Sorter_nombres" => array("nombres", ""), 
            "Sorter_apellidos" => array("apellidos", "")));
    }
//End SetOrder Method

//Prepare Method @2-C6CCA47E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_rut_ficha", ccsText, "", "", $this->Parameters["urls_rut_ficha"], "", false);
        $this->wp->AddParameter("2", "urls_rut_ficha", ccsText, "", "", $this->Parameters["urls_rut_ficha"], "", false);
        $this->wp->AddParameter("3", "urls_nombre", ccsText, "", "", $this->Parameters["urls_nombre"], "", false);
        $this->wp->AddParameter("4", "urls_apellido", ccsText, "", "", $this->Parameters["urls_apellido"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opBeginsWith, "rut", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "ficha", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "nombres", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opBeginsWith, "apellidos", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opOR(
             true, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), $this->wp->opAND(
             true, 
             $this->wp->Criterion[3], 
             $this->wp->Criterion[4]));
    }
//End Prepare Method

//Open Method @2-7DF435BF
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

//SetValues Method @2-80B38C85
    function SetValues()
    {
        $this->rut->SetDBValue($this->f("rut"));
        $this->paciente_id->SetDBValue(trim($this->f("paciente_id")));
        $this->prevision_id->SetDBValue(trim($this->f("prevision_id")));
        $this->ficha->SetDBValue($this->f("ficha"));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->Alt_rut->SetDBValue($this->f("rut"));
        $this->Alt_paciente_id->SetDBValue(trim($this->f("paciente_id")));
        $this->Alt_prevision_id->SetDBValue(trim($this->f("prevision_id")));
        $this->Alt_ficha->SetDBValue($this->f("ficha"));
        $this->Alt_nombres->SetDBValue($this->f("nombres"));
        $this->Alt_apellidos->SetDBValue($this->f("apellidos"));
    }
//End SetValues Method

} //End pacientesDataSource Class @2-FCB6E20C

//Initialize Page @1-0AB6AD8C
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
$TemplateFileName = "frmBuscarPaciente.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-3BD8D198
include_once("./frmBuscarPaciente_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9589C849
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$fn_eligeAuto = new clsControl(ccsLabel, "fn_eligeAuto", "fn_eligeAuto", ccsText, "", CCGetRequestParam("fn_eligeAuto", ccsGet, NULL), $MainPage);
$fn_eligeAuto->HTML = true;
$pacientesSearch = new clsRecordpacientesSearch("", $MainPage);
$pacientes = new clsGridpacientes("", $MainPage);
$MainPage->fn_eligeAuto = & $fn_eligeAuto;
$MainPage->pacientesSearch = & $pacientesSearch;
$MainPage->pacientes = & $pacientes;
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

//Show Page @1-F1F313CA
$pacientesSearch->Show();
$pacientes->Show();
$fn_eligeAuto->Show();
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
