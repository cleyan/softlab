<?php
//Include Common Files @1-3881D318
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "cfg_seguridad.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsEditableGridusuarios { //usuarios Class @3-7F48A57B

//Variables @3-87DE9CC1

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
    public $Sorter_nom_usuario;
    public $Sorter_log_usuario;
    public $Sorter_p_validar;
    public $Sorter_p_firmar;
//End Variables

//Class_Initialize Event @3-75E75768
    function clsEditableGridusuarios($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid usuarios/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "usuarios";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["usuario_id"][0] = "usuario_id";
        $this->DataSource = new clsusuariosDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

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

        $this->SorterName = CCGetParam("usuariosOrder", "");
        $this->SorterDirection = CCGetParam("usuariosDir", "");

        $this->usuarios_TotalRecords = new clsControl(ccsLabel, "usuarios_TotalRecords", "usuarios_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_nom_usuario = new clsSorter($this->ComponentName, "Sorter_nom_usuario", $FileName, $this);
        $this->Sorter_log_usuario = new clsSorter($this->ComponentName, "Sorter_log_usuario", $FileName, $this);
        $this->Sorter_p_validar = new clsSorter($this->ComponentName, "Sorter_p_validar", $FileName, $this);
        $this->Sorter_p_firmar = new clsSorter($this->ComponentName, "Sorter_p_firmar", $FileName, $this);
        $this->nom_usuario = new clsControl(ccsLabel, "nom_usuario", "Nom Usuario", ccsText, "", NULL, $this);
        $this->log_usuario = new clsControl(ccsLabel, "log_usuario", "Log Usuario", ccsText, "", NULL, $this);
        $this->p_validar = new clsControl(ccsCheckBox, "p_validar", "P Validar", ccsText, "", NULL, $this);
        $this->p_validar->CheckedValue = $this->p_validar->GetParsedValue('V');
        $this->p_validar->UncheckedValue = $this->p_validar->GetParsedValue('F');
        $this->p_firmar = new clsControl(ccsCheckBox, "p_firmar", "P Firmar", ccsText, "", NULL, $this);
        $this->p_firmar->CheckedValue = $this->p_firmar->GetParsedValue('V');
        $this->p_firmar->UncheckedValue = $this->p_firmar->GetParsedValue('F');
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @3-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

    }
//End Initialize Method

//GetFormParameters Method @3-CB231AD4
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["p_validar"][$RowNumber] = CCGetFromPost("p_validar_" . $RowNumber, NULL);
            $this->FormParameters["p_firmar"][$RowNumber] = CCGetFromPost("p_firmar_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @3-11EF7C6F
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["usuario_id"] = $this->CachedColumns["usuario_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->p_validar->SetText($this->FormParameters["p_validar"][$this->RowNumber], $this->RowNumber);
            $this->p_firmar->SetText($this->FormParameters["p_firmar"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @3-EDD14BEB
    function ValidateRow()
    {
        global $CCSLocales;
        $this->p_validar->Validate();
        $this->p_firmar->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->p_validar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_firmar->Errors->ToString());
        $this->p_validar->Errors->Clear();
        $this->p_firmar->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @3-52AD99B1
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["p_validar"][$this->RowNumber]) && count($this->FormParameters["p_validar"][$this->RowNumber])) || strlen($this->FormParameters["p_validar"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["p_firmar"][$this->RowNumber]) && count($this->FormParameters["p_firmar"][$this->RowNumber])) || strlen($this->FormParameters["p_firmar"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @3-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-5566944D
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            } else {
                $Redirect = "menu_principal.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @3-EC9D40FE
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["usuario_id"] = $this->CachedColumns["usuario_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->p_validar->SetText($this->FormParameters["p_validar"][$this->RowNumber], $this->RowNumber);
            $this->p_firmar->SetText($this->FormParameters["p_firmar"][$this->RowNumber], $this->RowNumber);
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

//UpdateRow Method @3-9BCDB14D
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->nom_usuario->SetValue($this->nom_usuario->GetValue(true));
        $this->DataSource->log_usuario->SetValue($this->log_usuario->GetValue(true));
        $this->DataSource->p_validar->SetValue($this->p_validar->GetValue(true));
        $this->DataSource->p_firmar->SetValue($this->p_firmar->GetValue(true));
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

//FormScript Method @3-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @3-57209705
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
                $this->CachedColumns["usuario_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["usuario_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @3-229AAFF7
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["usuario_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @3-3F9AB7FC
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
        $this->ControlsVisible["nom_usuario"] = $this->nom_usuario->Visible;
        $this->ControlsVisible["log_usuario"] = $this->log_usuario->Visible;
        $this->ControlsVisible["p_validar"] = $this->p_validar->Visible;
        $this->ControlsVisible["p_firmar"] = $this->p_firmar->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["usuario_id"][$this->RowNumber] = $this->DataSource->CachedColumns["usuario_id"];
                    $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                    $this->log_usuario->SetValue($this->DataSource->log_usuario->GetValue());
                    $this->p_validar->SetValue($this->DataSource->p_validar->GetValue());
                    $this->p_firmar->SetValue($this->DataSource->p_firmar->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->nom_usuario->SetText("");
                    $this->log_usuario->SetText("");
                    $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                    $this->log_usuario->SetValue($this->DataSource->log_usuario->GetValue());
                    $this->p_validar->SetText($this->FormParameters["p_validar"][$this->RowNumber], $this->RowNumber);
                    $this->p_firmar->SetText($this->FormParameters["p_firmar"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["usuario_id"][$this->RowNumber] = "";
                    $this->nom_usuario->SetText("");
                    $this->log_usuario->SetText("");
                    $this->p_validar->SetValue(false);
                    $this->p_firmar->SetValue(false);
                } else {
                    $this->nom_usuario->SetText("");
                    $this->log_usuario->SetText("");
                    $this->p_validar->SetText($this->FormParameters["p_validar"][$this->RowNumber], $this->RowNumber);
                    $this->p_firmar->SetText($this->FormParameters["p_firmar"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->nom_usuario->Show($this->RowNumber);
                $this->log_usuario->Show($this->RowNumber);
                $this->p_validar->Show($this->RowNumber);
                $this->p_firmar->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["usuario_id"] == $this->CachedColumns["usuario_id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->usuarios_TotalRecords->Show();
        $this->Sorter_nom_usuario->Show();
        $this->Sorter_log_usuario->Show();
        $this->Sorter_p_validar->Show();
        $this->Sorter_p_firmar->Show();
        $this->Navigator->Show();
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

} //End usuarios Class @3-FCB6E20C

class clsusuariosDataSource extends clsDBDatos {  //usuariosDataSource Class @3-A570ED29

//DataSource Variables @3-A23667BE
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
    public $nom_usuario;
    public $log_usuario;
    public $p_validar;
    public $p_firmar;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-47DBD8EB
    function clsusuariosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid usuarios/Error";
        $this->Initialize();
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        
        $this->log_usuario = new clsField("log_usuario", ccsText, "");
        
        $this->p_validar = new clsField("p_validar", ccsText, "");
        
        $this->p_firmar = new clsField("p_firmar", ccsText, "");
        

        $this->UpdateFields["p_validar"] = array("Name" => "p_validar", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["p_firmar"] = array("Name" => "p_firmar", "Value" => "", "DataType" => ccsText);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @3-A1E5F64C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_nom_usuario" => array("nom_usuario", ""), 
            "Sorter_log_usuario" => array("log_usuario", ""), 
            "Sorter_p_validar" => array("p_validar", ""), 
            "Sorter_p_firmar" => array("p_firmar", "")));
    }
//End SetOrder Method

//Prepare Method @3-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @3-0C45F8BC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM usuarios";
        $this->SQL = "SELECT * \n\n" .
        "FROM usuarios {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-FB471E37
    function SetValues()
    {
        $this->CachedColumns["usuario_id"] = $this->f("usuario_id");
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
        $this->log_usuario->SetDBValue($this->f("log_usuario"));
        $this->p_validar->SetDBValue($this->f("p_validar"));
        $this->p_firmar->SetDBValue($this->f("p_firmar"));
    }
//End SetValues Method

//Update Method @3-85A022DB
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "usuario_id=" . $this->ToSQL($this->CachedColumns["usuario_id"], ccsInteger);
        $this->UpdateFields["p_validar"]["Value"] = $this->p_validar->GetDBValue(true);
        $this->UpdateFields["p_firmar"]["Value"] = $this->p_firmar->GetDBValue(true);
        $this->SQL = CCBuildUpdate("usuarios", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

} //End usuariosDataSource Class @3-FCB6E20C

//Initialize Page @1-A2EE45C1
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
$TemplateFileName = "cfg_seguridad.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-7D3674CD
CCSecurityRedirect("18;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-3E8A38DC
include_once("./cfg_seguridad_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B09B70F1
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$usuarios = new clsEditableGridusuarios("", $MainPage);
$MainPage->usuarios = & $usuarios;
$usuarios->Initialize();
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

//Execute Components @1-5F7C2662
$usuarios->Operation();
//End Execute Components

//Go to destination page @1-7F48EDF9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($usuarios);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A1A27AB6
$usuarios->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-DF24DB00
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($usuarios);
unset($Tpl);
//End Unload Page


?>
