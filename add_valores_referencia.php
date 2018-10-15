<?php
//Include Common Files @1-5ECC8194
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_valores_referencia.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtest { //test Class @50-823F7E18

//Variables @50-9E315808

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

//Class_Initialize Event @50-76027BBC
    function clsRecordtest($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record test/Error";
        $this->DataSource = new clstestDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "test";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->cod_test = new clsControl(ccsLabel, "cod_test", "Cod Test", ccsText, "", CCGetRequestParam("cod_test", $Method, NULL), $this);
            $this->nom_test = new clsControl(ccsLabel, "nom_test", "Nom Test", ccsText, "", CCGetRequestParam("nom_test", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @50-DFD3A45F
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urltest_id"] = CCGetFromGet("test_id", NULL);
    }
//End Initialize Method

//Validate Method @50-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @50-F71DAC23
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->cod_test->Errors->Count());
        $errors = ($errors || $this->nom_test->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @50-C175C2A1
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        $Redirect = "add_valores_referencia.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @50-A8B54339
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
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->cod_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
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

        $this->cod_test->Show();
        $this->nom_test->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End test Class @50-FCB6E20C

class clstestDataSource extends clsDBDatos {  //testDataSource Class @50-EDACDDB4

//DataSource Variables @50-5E2BD3D0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $cod_test;
    public $nom_test;
//End DataSource Variables

//DataSourceClass_Initialize Event @50-09799A38
    function clstestDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record test/Error";
        $this->Initialize();
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @50-D26ADDE2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltest_id", ccsInteger, "", "", $this->Parameters["urltest_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "test_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @50-F1A82630
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM test {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @50-A1440AA0
    function SetValues()
    {
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
    }
//End SetValues Method

} //End testDataSource Class @50-FCB6E20C

class clsRecordvalores_referencia1Search { //valores_referencia1Search Class @43-7C2F6F44

//Variables @43-9E315808

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

//Class_Initialize Event @43-CDDFAD13
    function clsRecordvalores_referencia1Search($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record valores_referencia1Search/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "valores_referencia1Search";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_sexo_id = new clsControl(ccsListBox, "s_sexo_id", "s_sexo_id", ccsInteger, "", CCGetRequestParam("s_sexo_id", $Method, NULL), $this);
            $this->s_sexo_id->DSType = dsTable;
            $this->s_sexo_id->DataSource = new clsDBDatos();
            $this->s_sexo_id->ds = & $this->s_sexo_id->DataSource;
            $this->s_sexo_id->DataSource->SQL = "SELECT * \n" .
"FROM sexos {SQL_Where} {SQL_OrderBy}";
            list($this->s_sexo_id->BoundColumn, $this->s_sexo_id->TextColumn, $this->s_sexo_id->DBFormat) = array("sexo_id", "nom_sexo", "");
            $this->s_valor_generico = new clsControl(ccsTextBox, "s_valor_generico", "s_valor_generico", ccsMemo, "", CCGetRequestParam("s_valor_generico", $Method, NULL), $this);
            $this->valores_referencia1PageSize = new clsControl(ccsListBox, "valores_referencia1PageSize", "valores_referencia1PageSize", ccsText, "", CCGetRequestParam("valores_referencia1PageSize", $Method, NULL), $this);
            $this->valores_referencia1PageSize->DSType = dsListOfValues;
            $this->valores_referencia1PageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @43-4815B00D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_sexo_id->Validate() && $Validation);
        $Validation = ($this->s_valor_generico->Validate() && $Validation);
        $Validation = ($this->valores_referencia1PageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_sexo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_valor_generico->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valores_referencia1PageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @43-3E13C689
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_sexo_id->Errors->Count());
        $errors = ($errors || $this->s_valor_generico->Errors->Count());
        $errors = ($errors || $this->valores_referencia1PageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @43-B72E0947
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
        $Redirect = "add_valores_referencia.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "add_valores_referencia.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_sexo_id", "s_valor_generico", "valores_referencia1PageSize", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @43-10E3F7B1
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

        $this->s_sexo_id->Prepare();
        $this->valores_referencia1PageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_sexo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_valor_generico->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valores_referencia1PageSize->Errors->ToString());
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

        $this->s_sexo_id->Show();
        $this->s_valor_generico->Show();
        $this->valores_referencia1PageSize->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End valores_referencia1Search Class @43-FCB6E20C

class clsEditableGridvalores_referencia1 { //valores_referencia1 Class @15-35632DA3

//Variables @15-0AADA924

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @15-0ACD4F9B
    function clsEditableGridvalores_referencia1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid valores_referencia1/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "valores_referencia1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["valor_referencia_id"][0] = "valor_referencia_id";
        $this->DataSource = new clsvalores_referencia1DataSource($this);
        $this->ds = & $this->DataSource;

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->Component = new clsControl(ccsLabel, "Component", "Component", ccsText, "", NULL, $this);
        $this->Component->HTML = true;
        $this->valores_referencia1_TotalRecords = new clsControl(ccsLabel, "valores_referencia1_TotalRecords", "valores_referencia1_TotalRecords", ccsText, "", NULL, $this);
        $this->sexo_id = new clsControl(ccsListBox, "sexo_id", "Sexo Id", ccsInteger, "", NULL, $this);
        $this->sexo_id->DSType = dsTable;
        $this->sexo_id->DataSource = new clsDBDatos();
        $this->sexo_id->ds = & $this->sexo_id->DataSource;
        $this->sexo_id->DataSource->SQL = "SELECT * \n" .
"FROM sexos {SQL_Where} {SQL_OrderBy}";
        list($this->sexo_id->BoundColumn, $this->sexo_id->TextColumn, $this->sexo_id->DBFormat) = array("sexo_id", "nom_sexo", "");
        $this->sexo_id->Required = true;
        $this->edad_desde = new clsControl(ccsTextBox, "edad_desde", "Edad Desde", ccsInteger, "", NULL, $this);
        $this->edad_desde->Required = true;
        $this->edad_hasta = new clsControl(ccsTextBox, "edad_hasta", "Edad Hasta", ccsInteger, "", NULL, $this);
        $this->edad_hasta->Required = true;
        $this->valor_desde = new clsControl(ccsTextBox, "valor_desde", "Valor Desde", ccsText, "", NULL, $this);
        $this->valor_hasta = new clsControl(ccsTextBox, "valor_hasta", "Valor Hasta", ccsText, "", NULL, $this);
        $this->valor_generico = new clsControl(ccsTextArea, "valor_generico", "Valor Generico", ccsMemo, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @15-DC6C1DE3
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urltest_id"] = CCGetFromGet("test_id", NULL);
        $this->DataSource->Parameters["urls_sexo_id"] = CCGetFromGet("s_sexo_id", NULL);
        $this->DataSource->Parameters["urls_valor_generico"] = CCGetFromGet("s_valor_generico", NULL);
    }
//End Initialize Method

//GetFormParameters Method @15-FA972F0C
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["sexo_id"][$RowNumber] = CCGetFromPost("sexo_id_" . $RowNumber, NULL);
            $this->FormParameters["edad_desde"][$RowNumber] = CCGetFromPost("edad_desde_" . $RowNumber, NULL);
            $this->FormParameters["edad_hasta"][$RowNumber] = CCGetFromPost("edad_hasta_" . $RowNumber, NULL);
            $this->FormParameters["valor_desde"][$RowNumber] = CCGetFromPost("valor_desde_" . $RowNumber, NULL);
            $this->FormParameters["valor_hasta"][$RowNumber] = CCGetFromPost("valor_hasta_" . $RowNumber, NULL);
            $this->FormParameters["valor_generico"][$RowNumber] = CCGetFromPost("valor_generico_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @15-0F85F9A5
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["valor_referencia_id"] = $this->CachedColumns["valor_referencia_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->sexo_id->SetText($this->FormParameters["sexo_id"][$this->RowNumber], $this->RowNumber);
            $this->edad_desde->SetText($this->FormParameters["edad_desde"][$this->RowNumber], $this->RowNumber);
            $this->edad_hasta->SetText($this->FormParameters["edad_hasta"][$this->RowNumber], $this->RowNumber);
            $this->valor_desde->SetText($this->FormParameters["valor_desde"][$this->RowNumber], $this->RowNumber);
            $this->valor_hasta->SetText($this->FormParameters["valor_hasta"][$this->RowNumber], $this->RowNumber);
            $this->valor_generico->SetText($this->FormParameters["valor_generico"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @15-4B191951
    function ValidateRow()
    {
        global $CCSLocales;
        $this->sexo_id->Validate();
        $this->edad_desde->Validate();
        $this->edad_hasta->Validate();
        $this->valor_desde->Validate();
        $this->valor_hasta->Validate();
        $this->valor_generico->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->sexo_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->edad_desde->Errors->ToString());
        $errors = ComposeStrings($errors, $this->edad_hasta->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valor_desde->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valor_hasta->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valor_generico->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->sexo_id->Errors->Clear();
        $this->edad_desde->Errors->Clear();
        $this->edad_hasta->Errors->Clear();
        $this->valor_desde->Errors->Clear();
        $this->valor_hasta->Errors->Clear();
        $this->valor_generico->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @15-BF1D3F22
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["sexo_id"][$this->RowNumber]) && count($this->FormParameters["sexo_id"][$this->RowNumber])) || strlen($this->FormParameters["sexo_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["edad_desde"][$this->RowNumber]) && count($this->FormParameters["edad_desde"][$this->RowNumber])) || strlen($this->FormParameters["edad_desde"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["edad_hasta"][$this->RowNumber]) && count($this->FormParameters["edad_hasta"][$this->RowNumber])) || strlen($this->FormParameters["edad_hasta"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["valor_desde"][$this->RowNumber]) && count($this->FormParameters["valor_desde"][$this->RowNumber])) || strlen($this->FormParameters["valor_desde"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["valor_hasta"][$this->RowNumber]) && count($this->FormParameters["valor_hasta"][$this->RowNumber])) || strlen($this->FormParameters["valor_hasta"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["valor_generico"][$this->RowNumber]) && count($this->FormParameters["valor_generico"][$this->RowNumber])) || strlen($this->FormParameters["valor_generico"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @15-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @15-4CE05319
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "mensaje"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            } else {
                $Redirect = "list_test.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "mensaje"));
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @15-4AB10D5E
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["valor_referencia_id"] = $this->CachedColumns["valor_referencia_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->sexo_id->SetText($this->FormParameters["sexo_id"][$this->RowNumber], $this->RowNumber);
            $this->edad_desde->SetText($this->FormParameters["edad_desde"][$this->RowNumber], $this->RowNumber);
            $this->edad_hasta->SetText($this->FormParameters["edad_hasta"][$this->RowNumber], $this->RowNumber);
            $this->valor_desde->SetText($this->FormParameters["valor_desde"][$this->RowNumber], $this->RowNumber);
            $this->valor_hasta->SetText($this->FormParameters["valor_hasta"][$this->RowNumber], $this->RowNumber);
            $this->valor_generico->SetText($this->FormParameters["valor_generico"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @15-A3961975
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->sexo_id->SetValue($this->sexo_id->GetValue(true));
        $this->DataSource->valor_desde->SetValue($this->valor_desde->GetValue(true));
        $this->DataSource->valor_generico->SetValue($this->valor_generico->GetValue(true));
        $this->DataSource->edad_desde->SetValue($this->edad_desde->GetValue(true));
        $this->DataSource->edad_hasta->SetValue($this->edad_hasta->GetValue(true));
        $this->DataSource->valor_hasta->SetValue($this->valor_hasta->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @15-7E983BBC
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->sexo_id->SetValue($this->sexo_id->GetValue(true));
        $this->DataSource->edad_desde->SetValue($this->edad_desde->GetValue(true));
        $this->DataSource->edad_hasta->SetValue($this->edad_hasta->GetValue(true));
        $this->DataSource->valor_desde->SetValue($this->valor_desde->GetValue(true));
        $this->DataSource->valor_hasta->SetValue($this->valor_hasta->GetValue(true));
        $this->DataSource->valor_generico->SetValue($this->valor_generico->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @15-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @15-75183993
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var valores_referencia1Elements;\n";
        $script .= "var valores_referencia1EmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "sexo_idID = 0;\n";
        $script .= "var " . $this->ComponentName . "edad_desdeID = 1;\n";
        $script .= "var " . $this->ComponentName . "edad_hastaID = 2;\n";
        $script .= "var " . $this->ComponentName . "valor_desdeID = 3;\n";
        $script .= "var " . $this->ComponentName . "valor_hastaID = 4;\n";
        $script .= "var " . $this->ComponentName . "valor_genericoID = 5;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 6;\n";
        $script .= "\nfunction initvalores_referencia1Elements() {\n";
        $script .= "\tvar ED = document.forms[\"valores_referencia1\"];\n";
        $script .= "\tvalores_referencia1Elements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.sexo_id_" . $i . ", " . "ED.edad_desde_" . $i . ", " . "ED.edad_hasta_" . $i . ", " . "ED.valor_desde_" . $i . ", " . "ED.valor_hasta_" . $i . ", " . "ED.valor_generico_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @15-2349E1A6
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["valor_referencia_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["valor_referencia_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @15-AF6E0384
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["valor_referencia_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @15-265FCD53
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->sexo_id->Prepare();

        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["sexo_id"] = $this->sexo_id->Visible;
        $this->ControlsVisible["edad_desde"] = $this->edad_desde->Visible;
        $this->ControlsVisible["edad_hasta"] = $this->edad_hasta->Visible;
        $this->ControlsVisible["valor_desde"] = $this->valor_desde->Visible;
        $this->ControlsVisible["valor_hasta"] = $this->valor_hasta->Visible;
        $this->ControlsVisible["valor_generico"] = $this->valor_generico->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["valor_referencia_id"][$this->RowNumber] = $this->DataSource->CachedColumns["valor_referencia_id"];
                    $this->CheckBox_Delete->SetValue(false);
                    $this->sexo_id->SetValue($this->DataSource->sexo_id->GetValue());
                    $this->edad_desde->SetValue($this->DataSource->edad_desde->GetValue());
                    $this->edad_hasta->SetValue($this->DataSource->edad_hasta->GetValue());
                    $this->valor_desde->SetValue($this->DataSource->valor_desde->GetValue());
                    $this->valor_hasta->SetValue($this->DataSource->valor_hasta->GetValue());
                    $this->valor_generico->SetValue($this->DataSource->valor_generico->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->sexo_id->SetText($this->FormParameters["sexo_id"][$this->RowNumber], $this->RowNumber);
                    $this->edad_desde->SetText($this->FormParameters["edad_desde"][$this->RowNumber], $this->RowNumber);
                    $this->edad_hasta->SetText($this->FormParameters["edad_hasta"][$this->RowNumber], $this->RowNumber);
                    $this->valor_desde->SetText($this->FormParameters["valor_desde"][$this->RowNumber], $this->RowNumber);
                    $this->valor_hasta->SetText($this->FormParameters["valor_hasta"][$this->RowNumber], $this->RowNumber);
                    $this->valor_generico->SetText($this->FormParameters["valor_generico"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["valor_referencia_id"][$this->RowNumber] = "";
                    $this->sexo_id->SetText("");
                    $this->edad_desde->SetText("");
                    $this->edad_hasta->SetText("");
                    $this->valor_desde->SetText("");
                    $this->valor_hasta->SetText("");
                    $this->valor_generico->SetText("");
                } else {
                    $this->sexo_id->SetText($this->FormParameters["sexo_id"][$this->RowNumber], $this->RowNumber);
                    $this->edad_desde->SetText($this->FormParameters["edad_desde"][$this->RowNumber], $this->RowNumber);
                    $this->edad_hasta->SetText($this->FormParameters["edad_hasta"][$this->RowNumber], $this->RowNumber);
                    $this->valor_desde->SetText($this->FormParameters["valor_desde"][$this->RowNumber], $this->RowNumber);
                    $this->valor_hasta->SetText($this->FormParameters["valor_hasta"][$this->RowNumber], $this->RowNumber);
                    $this->valor_generico->SetText($this->FormParameters["valor_generico"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->sexo_id->Show($this->RowNumber);
                $this->edad_desde->Show($this->RowNumber);
                $this->edad_hasta->Show($this->RowNumber);
                $this->valor_desde->Show($this->RowNumber);
                $this->valor_hasta->Show($this->RowNumber);
                $this->valor_generico->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["valor_referencia_id"] == $this->CachedColumns["valor_referencia_id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Component->Show();
        $this->valores_referencia1_TotalRecords->Show();
        $this->Button_Submit->Show();
        $this->Cancel->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End valores_referencia1 Class @15-FCB6E20C

class clsvalores_referencia1DataSource extends clsDBDatos {  //valores_referencia1DataSource Class @15-A879B8F7

//DataSource Variables @15-1AB28EBC
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $sexo_id;
    public $edad_desde;
    public $edad_hasta;
    public $valor_desde;
    public $valor_hasta;
    public $valor_generico;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @15-DE41CF7A
    function clsvalores_referencia1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid valores_referencia1/Error";
        $this->Initialize();
        $this->sexo_id = new clsField("sexo_id", ccsInteger, "");
        
        $this->edad_desde = new clsField("edad_desde", ccsInteger, "");
        
        $this->edad_hasta = new clsField("edad_hasta", ccsInteger, "");
        
        $this->valor_desde = new clsField("valor_desde", ccsText, "");
        
        $this->valor_hasta = new clsField("valor_hasta", ccsText, "");
        
        $this->valor_generico = new clsField("valor_generico", ccsMemo, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["sexo_id"] = array("Name" => "sexo_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["valor_desde"] = array("Name" => "valor_desde", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["valor_generico"] = array("Name" => "valor_generico", "Value" => "", "DataType" => ccsMemo);
        $this->InsertFields["edad_desde"] = array("Name" => "edad_desde", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["edad_hasta"] = array("Name" => "edad_hasta", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["valor_hasta"] = array("Name" => "valor_hasta", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["sexo_id"] = array("Name" => "sexo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["edad_desde"] = array("Name" => "edad_desde", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["edad_hasta"] = array("Name" => "edad_hasta", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["valor_desde"] = array("Name" => "valor_desde", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["valor_hasta"] = array("Name" => "valor_hasta", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["valor_generico"] = array("Name" => "valor_generico", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @15-4762C4CA
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "sexo_id, edad_desde, edad_hasta";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @15-1197E569
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltest_id", ccsInteger, "", "", $this->Parameters["urltest_id"], 0, false);
        $this->wp->AddParameter("2", "urls_sexo_id", ccsInteger, "", "", $this->Parameters["urls_sexo_id"], "", false);
        $this->wp->AddParameter("3", "urls_valor_generico", ccsMemo, "", "", $this->Parameters["urls_valor_generico"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "test_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "sexo_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "valor_generico", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsMemo),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @15-A0A35423
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM valores_referencia";
        $this->SQL = "SELECT * \n\n" .
        "FROM valores_referencia {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @15-0DF873F3
    function SetValues()
    {
        $this->CachedColumns["valor_referencia_id"] = $this->f("valor_referencia_id");
        $this->sexo_id->SetDBValue(trim($this->f("sexo_id")));
        $this->edad_desde->SetDBValue(trim($this->f("edad_desde")));
        $this->edad_hasta->SetDBValue(trim($this->f("edad_hasta")));
        $this->valor_desde->SetDBValue($this->f("valor_desde"));
        $this->valor_hasta->SetDBValue($this->f("valor_hasta"));
        $this->valor_generico->SetDBValue($this->f("valor_generico"));
    }
//End SetValues Method

//Insert Method @15-62C56EC7
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["sexo_id"] = new clsSQLParameter("ctrlsexo_id", ccsInteger, "", "", $this->sexo_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valor_desde"] = new clsSQLParameter("ctrlvalor_desde", ccsText, "", "", $this->valor_desde->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valor_generico"] = new clsSQLParameter("ctrlvalor_generico", ccsMemo, "", "", $this->valor_generico->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["edad_desde"] = new clsSQLParameter("ctrledad_desde", ccsInteger, "", "", $this->edad_desde->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["edad_hasta"] = new clsSQLParameter("ctrledad_hasta", ccsInteger, "", "", $this->edad_hasta->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valor_hasta"] = new clsSQLParameter("ctrlvalor_hasta", ccsText, "", "", $this->valor_hasta->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["test_id"] = new clsSQLParameter("urltest_id", ccsInteger, "", "", CCGetFromGet("test_id", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["sexo_id"]->GetValue()) and !strlen($this->cp["sexo_id"]->GetText()) and !is_bool($this->cp["sexo_id"]->GetValue())) 
            $this->cp["sexo_id"]->SetValue($this->sexo_id->GetValue(true));
        if (!is_null($this->cp["valor_desde"]->GetValue()) and !strlen($this->cp["valor_desde"]->GetText()) and !is_bool($this->cp["valor_desde"]->GetValue())) 
            $this->cp["valor_desde"]->SetValue($this->valor_desde->GetValue(true));
        if (!is_null($this->cp["valor_generico"]->GetValue()) and !strlen($this->cp["valor_generico"]->GetText()) and !is_bool($this->cp["valor_generico"]->GetValue())) 
            $this->cp["valor_generico"]->SetValue($this->valor_generico->GetValue(true));
        if (!is_null($this->cp["edad_desde"]->GetValue()) and !strlen($this->cp["edad_desde"]->GetText()) and !is_bool($this->cp["edad_desde"]->GetValue())) 
            $this->cp["edad_desde"]->SetValue($this->edad_desde->GetValue(true));
        if (!is_null($this->cp["edad_hasta"]->GetValue()) and !strlen($this->cp["edad_hasta"]->GetText()) and !is_bool($this->cp["edad_hasta"]->GetValue())) 
            $this->cp["edad_hasta"]->SetValue($this->edad_hasta->GetValue(true));
        if (!is_null($this->cp["valor_hasta"]->GetValue()) and !strlen($this->cp["valor_hasta"]->GetText()) and !is_bool($this->cp["valor_hasta"]->GetValue())) 
            $this->cp["valor_hasta"]->SetValue($this->valor_hasta->GetValue(true));
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetText(CCGetFromGet("test_id", NULL));
        $this->InsertFields["sexo_id"]["Value"] = $this->cp["sexo_id"]->GetDBValue(true);
        $this->InsertFields["valor_desde"]["Value"] = $this->cp["valor_desde"]->GetDBValue(true);
        $this->InsertFields["valor_generico"]["Value"] = $this->cp["valor_generico"]->GetDBValue(true);
        $this->InsertFields["edad_desde"]["Value"] = $this->cp["edad_desde"]->GetDBValue(true);
        $this->InsertFields["edad_hasta"]["Value"] = $this->cp["edad_hasta"]->GetDBValue(true);
        $this->InsertFields["valor_hasta"]["Value"] = $this->cp["valor_hasta"]->GetDBValue(true);
        $this->InsertFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("valores_referencia", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @15-CFA06F59
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "valor_referencia_id=" . $this->ToSQL($this->CachedColumns["valor_referencia_id"], ccsInteger);
        $this->UpdateFields["sexo_id"]["Value"] = $this->sexo_id->GetDBValue(true);
        $this->UpdateFields["edad_desde"]["Value"] = $this->edad_desde->GetDBValue(true);
        $this->UpdateFields["edad_hasta"]["Value"] = $this->edad_hasta->GetDBValue(true);
        $this->UpdateFields["valor_desde"]["Value"] = $this->valor_desde->GetDBValue(true);
        $this->UpdateFields["valor_hasta"]["Value"] = $this->valor_hasta->GetDBValue(true);
        $this->UpdateFields["valor_generico"]["Value"] = $this->valor_generico->GetDBValue(true);
        $this->SQL = CCBuildUpdate("valores_referencia", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @15-2AA70E40
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "valor_referencia_id=" . $this->ToSQL($this->CachedColumns["valor_referencia_id"], ccsInteger);
        $this->SQL = "DELETE FROM valores_referencia";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End valores_referencia1DataSource Class @15-FCB6E20C

//Initialize Page @1-E26FC812
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
$TemplateFileName = "add_valores_referencia.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-957F87BA
include_once("./add_valores_referencia_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-78200868
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$test = new clsRecordtest("", $MainPage);
$valores_referencia1Search = new clsRecordvalores_referencia1Search("", $MainPage);
$valores_referencia1 = new clsEditableGridvalores_referencia1("", $MainPage);
$MainPage->test = & $test;
$MainPage->valores_referencia1Search = & $valores_referencia1Search;
$MainPage->valores_referencia1 = & $valores_referencia1;
$test->Initialize();
$valores_referencia1->Initialize();
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

//Execute Components @1-90C0282E
$valores_referencia1->Operation();
$valores_referencia1Search->Operation();
$test->Operation();
//End Execute Components

//Go to destination page @1-A9A20DAE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($test);
    unset($valores_referencia1Search);
    unset($valores_referencia1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3BB42474
$test->Show();
$valores_referencia1Search->Show();
$valores_referencia1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-AED9DC03
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($test);
unset($valores_referencia1Search);
unset($valores_referencia1);
unset($Tpl);
//End Unload Page


?>
