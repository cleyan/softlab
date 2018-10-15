<?php
//Include Common Files @1-66C30BB9
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "edit_orden.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsEditableGridgrupos_detalle_test_grupo { //grupos_detalle_test_grupo Class @2-DFEE6F8C

//Variables @2-DE563441

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
    public $Sorter_cod_test;
    public $Sorter_nom_test;
    public $Sorter_orden_informe;
//End Variables

//Class_Initialize Event @2-FCF0EE50
    function clsEditableGridgrupos_detalle_test_grupo($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid grupos_detalle_test_grupo/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "grupos_detalle_test_grupo";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["test_test_id"][0] = "test_test_id";
        $this->DataSource = new clsgrupos_detalle_test_grupoDataSource($this);
        $this->ds = & $this->DataSource;

        $this->EmptyRows = 0;
        $this->UpdateAllowed = true;
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

        $this->SorterName = CCGetParam("grupos_detalle_test_grupoOrder", "");
        $this->SorterDirection = CCGetParam("grupos_detalle_test_grupoDir", "");

        $this->nom_grupo = new clsControl(ccsLabel, "nom_grupo", "nom_grupo", ccsText, "", NULL, $this);
        $this->grupos_detalle_test_grupo_TotalRecords = new clsControl(ccsLabel, "grupos_detalle_test_grupo_TotalRecords", "grupos_detalle_test_grupo_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_cod_test = new clsSorter($this->ComponentName, "Sorter_cod_test", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->Sorter_orden_informe = new clsSorter($this->ComponentName, "Sorter_orden_informe", $FileName, $this);
        $this->cod_test = new clsControl(ccsLabel, "cod_test", "Cod Test", ccsText, "", NULL, $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "Nom Test", ccsText, "", NULL, $this);
        $this->orden_informe = new clsControl(ccsTextBox, "orden_informe", "Orden Informe", ccsInteger, "", NULL, $this);
        $this->orden_ingreso = new clsControl(ccsHidden, "orden_ingreso", "orden_ingreso", ccsText, "", NULL, $this);
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancelar = new clsButton("Cancelar", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-2B4F9EEF
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlgrupo_id"] = CCGetFromGet("grupo_id", NULL);
    }
//End Initialize Method

//GetFormParameters Method @2-D462AFED
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["orden_informe"][$RowNumber] = CCGetFromPost("orden_informe_" . $RowNumber, NULL);
            $this->FormParameters["orden_ingreso"][$RowNumber] = CCGetFromPost("orden_ingreso_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-271E74D8
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["test_test_id"] = $this->CachedColumns["test_test_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->orden_informe->SetText($this->FormParameters["orden_informe"][$this->RowNumber], $this->RowNumber);
            $this->orden_ingreso->SetText($this->FormParameters["orden_ingreso"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                $Validation = ($this->ValidateRow($this->RowNumber) && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @2-8BB59234
    function ValidateRow()
    {
        global $CCSLocales;
        $this->orden_informe->Validate();
        $this->orden_ingreso->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->orden_informe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->orden_ingreso->Errors->ToString());
        $this->orden_informe->Errors->Clear();
        $this->orden_ingreso->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-7FDC8D88
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["orden_informe"][$this->RowNumber]) && count($this->FormParameters["orden_informe"][$this->RowNumber])) || strlen($this->FormParameters["orden_informe"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["orden_ingreso"][$this->RowNumber]) && count($this->FormParameters["orden_ingreso"][$this->RowNumber])) || strlen($this->FormParameters["orden_ingreso"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @2-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-50E5A552
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
        } else if($this->Cancelar->Pressed) {
            $this->PressedButton = "Cancelar";
        }

        $Redirect = "def_detalle_grupos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancelar") {
            if(!CCGetEvent($this->Cancelar->CCSEvents, "OnClick", $this->Cancelar)) {
                $Redirect = "";
            } else {
                $Redirect = "def_detalle_grupos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @2-C82C57FD
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["test_test_id"] = $this->CachedColumns["test_test_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->orden_informe->SetText($this->FormParameters["orden_informe"][$this->RowNumber], $this->RowNumber);
            $this->orden_ingreso->SetText($this->FormParameters["orden_ingreso"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->UpdateAllowed) { $Validation = ($this->UpdateRow() && $Validation); }
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

//UpdateRow Method @2-E57C46F1
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->orden_informe->SetValue($this->orden_informe->GetValue(true));
        $this->DataSource->orden_ingreso->SetValue($this->orden_ingreso->GetValue(true));
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

//FormScript Method @2-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-15B85AC1
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
                $this->CachedColumns["test_test_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["test_test_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-4FCAF5BD
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["test_test_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-C6E0527E
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


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
        $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
        $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
        $this->ControlsVisible["orden_informe"] = $this->orden_informe->Visible;
        $this->ControlsVisible["orden_ingreso"] = $this->orden_ingreso->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["test_test_id"][$this->RowNumber] = $this->DataSource->CachedColumns["test_test_id"];
                    $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->orden_informe->SetValue($this->DataSource->orden_informe->GetValue());
                    $this->orden_ingreso->SetValue($this->DataSource->orden_ingreso->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->cod_test->SetText("");
                    $this->nom_test->SetText("");
                    $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->orden_informe->SetText($this->FormParameters["orden_informe"][$this->RowNumber], $this->RowNumber);
                    $this->orden_ingreso->SetText($this->FormParameters["orden_ingreso"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["test_test_id"][$this->RowNumber] = "";
                    $this->cod_test->SetText("");
                    $this->nom_test->SetText("");
                    $this->orden_informe->SetText("");
                    $this->orden_ingreso->SetText("");
                } else {
                    $this->cod_test->SetText("");
                    $this->nom_test->SetText("");
                    $this->orden_informe->SetText($this->FormParameters["orden_informe"][$this->RowNumber], $this->RowNumber);
                    $this->orden_ingreso->SetText($this->FormParameters["orden_ingreso"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->cod_test->Show($this->RowNumber);
                $this->nom_test->Show($this->RowNumber);
                $this->orden_informe->Show($this->RowNumber);
                $this->orden_ingreso->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["test_test_id"] == $this->CachedColumns["test_test_id"][$this->RowNumber])) {
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
        $this->nom_grupo->Show();
        $this->grupos_detalle_test_grupo_TotalRecords->Show();
        $this->Sorter_cod_test->Show();
        $this->Sorter_nom_test->Show();
        $this->Sorter_orden_informe->Show();
        $this->Button_Submit->Show();
        $this->Cancelar->Show();

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

} //End grupos_detalle_test_grupo Class @2-FCB6E20C

class clsgrupos_detalle_test_grupoDataSource extends clsDBDatos {  //grupos_detalle_test_grupoDataSource Class @2-5CD85009

//DataSource Variables @2-B906F086
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $UpdateFields = array();

    // Datasource fields
    public $cod_test;
    public $nom_test;
    public $orden_informe;
    public $orden_ingreso;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A219C0AB
    function clsgrupos_detalle_test_grupoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid grupos_detalle_test_grupo/Error";
        $this->Initialize();
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->orden_informe = new clsField("orden_informe", ccsInteger, "");
        
        $this->orden_ingreso = new clsField("orden_ingreso", ccsText, "");
        

        $this->UpdateFields["orden_informe"] = array("Name" => "orden_informe", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["orden_ingreso"] = array("Name" => "orden_ingreso", "Value" => "", "DataType" => ccsInteger);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9267808F
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_cod_test" => array("cod_test", ""), 
            "Sorter_nom_test" => array("nom_test", ""), 
            "Sorter_orden_informe" => array("orden_informe", "")));
    }
//End SetOrder Method

//Prepare Method @2-CF048B50
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgrupo_id", ccsInteger, "", "", $this->Parameters["urlgrupo_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "grupos_detalle.grupo_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-FDAC11DB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM grupos_detalle INNER JOIN test ON\n\n" .
        "grupos_detalle.test_id = test.test_id";
        $this->SQL = "SELECT grupos_detalle.test_id AS grupos_detalle_test_id, test.test_id AS test_test_id, cod_test, nom_test, orden_informe, orden_ingreso \n\n" .
        "FROM grupos_detalle INNER JOIN test ON\n\n" .
        "grupos_detalle.test_id = test.test_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D52B373B
    function SetValues()
    {
        $this->CachedColumns["test_test_id"] = $this->f("test_test_id");
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->orden_informe->SetDBValue(trim($this->f("orden_informe")));
        $this->orden_ingreso->SetDBValue($this->f("orden_ingreso"));
    }
//End SetValues Method

//Update Method @2-FBAF5F35
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->cp["orden_informe"] = new clsSQLParameter("ctrlorden_informe", ccsInteger, "", "", $this->orden_informe->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["orden_ingreso"] = new clsSQLParameter("ctrlorden_ingreso", ccsInteger, "", "", $this->orden_ingreso->GetValue(true), 0, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dstest_test_id", ccsInteger, "", "", $this->CachedColumns["test_test_id"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["orden_informe"]->GetValue()) and !strlen($this->cp["orden_informe"]->GetText()) and !is_bool($this->cp["orden_informe"]->GetValue())) 
            $this->cp["orden_informe"]->SetValue($this->orden_informe->GetValue(true));
        if (!strlen($this->cp["orden_informe"]->GetText()) and !is_bool($this->cp["orden_informe"]->GetValue(true))) 
            $this->cp["orden_informe"]->SetText(0);
        if (!is_null($this->cp["orden_ingreso"]->GetValue()) and !strlen($this->cp["orden_ingreso"]->GetText()) and !is_bool($this->cp["orden_ingreso"]->GetValue())) 
            $this->cp["orden_ingreso"]->SetValue($this->orden_ingreso->GetValue(true));
        if (!strlen($this->cp["orden_ingreso"]->GetText()) and !is_bool($this->cp["orden_ingreso"]->GetValue(true))) 
            $this->cp["orden_ingreso"]->SetText(0);
        $wp->Criterion[1] = $wp->Operation(opEqual, "test_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["orden_informe"]["Value"] = $this->cp["orden_informe"]->GetDBValue(true);
        $this->UpdateFields["orden_ingreso"]["Value"] = $this->cp["orden_ingreso"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("test", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End grupos_detalle_test_grupoDataSource Class @2-FCB6E20C

//Initialize Page @1-3A2F39C7
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
$TemplateFileName = "edit_orden.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-2FE0D585
CCSecurityRedirect("14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-47B0F421
include_once("./edit_orden_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6F404F12
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$grupos_detalle_test_grupo = new clsEditableGridgrupos_detalle_test_grupo("", $MainPage);
$MainPage->grupos_detalle_test_grupo = & $grupos_detalle_test_grupo;
$grupos_detalle_test_grupo->Initialize();
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

//Execute Components @1-72AB1CE6
$grupos_detalle_test_grupo->Operation();
//End Execute Components

//Go to destination page @1-A41BF31F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($grupos_detalle_test_grupo);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-19877C78
$grupos_detalle_test_grupo->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-7E5BFC62
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($grupos_detalle_test_grupo);
unset($Tpl);
//End Unload Page


?>
