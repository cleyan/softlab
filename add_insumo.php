<?php
//Include Common Files @1-E5687790
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_insumo.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordinsumos { //insumos Class @3-C74B0D72

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

//Class_Initialize Event @3-7B395C9C
    function clsRecordinsumos($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record insumos/Error";
        $this->DataSource = new clsinsumosDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "insumos";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->insumo_id = new clsControl(ccsHidden, "insumo_id", "Id", ccsInteger, "", CCGetRequestParam("insumo_id", $Method, NULL), $this);
            $this->id_nom_insumo = new clsControl(ccsHidden, "id_nom_insumo", "id_nom_insumo", ccsText, "", CCGetRequestParam("id_nom_insumo", $Method, NULL), $this);
            $this->id_insumo_id = new clsControl(ccsHidden, "id_insumo_id", "id_insumo_id", ccsText, "", CCGetRequestParam("id_insumo_id", $Method, NULL), $this);
            $this->last_insert_id = new clsControl(ccsHidden, "last_insert_id", "last_insert_id", ccsText, "", CCGetRequestParam("last_insert_id", $Method, NULL), $this);
            $this->last_nom_insumo = new clsControl(ccsHidden, "last_nom_insumo", "last_nom_insumo", ccsText, "", CCGetRequestParam("last_nom_insumo", $Method, NULL), $this);
            $this->cod_insumo = new clsControl(ccsTextBox, "cod_insumo", "Código Insumo", ccsText, "", CCGetRequestParam("cod_insumo", $Method, NULL), $this);
            $this->cod_insumo->Required = true;
            $this->nom_insumo = new clsControl(ccsTextBox, "nom_insumo", "Nombre Insumo", ccsText, "", CCGetRequestParam("nom_insumo", $Method, NULL), $this);
            $this->nom_insumo->Required = true;
            $this->stock_min = new clsControl(ccsTextBox, "stock_min", "Stock Mínimo", ccsInteger, "", CCGetRequestParam("stock_min", $Method, NULL), $this);
            $this->stock_max = new clsControl(ccsTextBox, "stock_max", "Stock Máximo", ccsInteger, "", CCGetRequestParam("stock_max", $Method, NULL), $this);
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-0E863553
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlinsumo_id"] = CCGetFromGet("insumo_id", NULL);
    }
//End Initialize Method

//Validate Method @3-C6DF10D5
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if($this->EditMode && strlen($this->DataSource->Where))
            $Where = " AND NOT (" . $this->DataSource->Where . ")";
        $this->DataSource->cod_insumo->SetValue($this->cod_insumo->GetValue());
        if(CCDLookUp("COUNT(*)", "insumos", "cod_insumo=" . $this->DataSource->ToSQL($this->DataSource->cod_insumo->GetDBValue(), $this->DataSource->cod_insumo->DataType) . $Where, $this->DataSource) > 0)
            $this->cod_insumo->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Código Insumo"));
        $Validation = ($this->insumo_id->Validate() && $Validation);
        $Validation = ($this->id_nom_insumo->Validate() && $Validation);
        $Validation = ($this->id_insumo_id->Validate() && $Validation);
        $Validation = ($this->last_insert_id->Validate() && $Validation);
        $Validation = ($this->last_nom_insumo->Validate() && $Validation);
        $Validation = ($this->cod_insumo->Validate() && $Validation);
        $Validation = ($this->nom_insumo->Validate() && $Validation);
        $Validation = ($this->stock_min->Validate() && $Validation);
        $Validation = ($this->stock_max->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->insumo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->id_nom_insumo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->id_insumo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->last_insert_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->last_nom_insumo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cod_insumo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_insumo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->stock_min->Errors->Count() == 0);
        $Validation =  $Validation && ($this->stock_max->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-0DF33F17
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->insumo_id->Errors->Count());
        $errors = ($errors || $this->id_nom_insumo->Errors->Count());
        $errors = ($errors || $this->id_insumo_id->Errors->Count());
        $errors = ($errors || $this->last_insert_id->Errors->Count());
        $errors = ($errors || $this->last_nom_insumo->Errors->Count());
        $errors = ($errors || $this->cod_insumo->Errors->Count());
        $errors = ($errors || $this->nom_insumo->Errors->Count());
        $errors = ($errors || $this->stock_min->Errors->Count());
        $errors = ($errors || $this->stock_max->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-4FF08FB5
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

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Cancel" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = "add_insumo.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @3-BAE53A2A
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->insumo_id->SetValue($this->insumo_id->GetValue(true));
        $this->DataSource->id_nom_insumo->SetValue($this->id_nom_insumo->GetValue(true));
        $this->DataSource->id_insumo_id->SetValue($this->id_insumo_id->GetValue(true));
        $this->DataSource->last_insert_id->SetValue($this->last_insert_id->GetValue(true));
        $this->DataSource->last_nom_insumo->SetValue($this->last_nom_insumo->GetValue(true));
        $this->DataSource->cod_insumo->SetValue($this->cod_insumo->GetValue(true));
        $this->DataSource->nom_insumo->SetValue($this->nom_insumo->GetValue(true));
        $this->DataSource->stock_min->SetValue($this->stock_min->GetValue(true));
        $this->DataSource->stock_max->SetValue($this->stock_max->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @3-5425E9DE
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->insumo_id->SetValue($this->insumo_id->GetValue(true));
        $this->DataSource->id_nom_insumo->SetValue($this->id_nom_insumo->GetValue(true));
        $this->DataSource->id_insumo_id->SetValue($this->id_insumo_id->GetValue(true));
        $this->DataSource->last_insert_id->SetValue($this->last_insert_id->GetValue(true));
        $this->DataSource->last_nom_insumo->SetValue($this->last_nom_insumo->GetValue(true));
        $this->DataSource->cod_insumo->SetValue($this->cod_insumo->GetValue(true));
        $this->DataSource->nom_insumo->SetValue($this->nom_insumo->GetValue(true));
        $this->DataSource->stock_min->SetValue($this->stock_min->GetValue(true));
        $this->DataSource->stock_max->SetValue($this->stock_max->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @3-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @3-872EFA0E
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
                if(!$this->FormSubmitted){
                    $this->insumo_id->SetValue($this->DataSource->insumo_id->GetValue());
                    $this->cod_insumo->SetValue($this->DataSource->cod_insumo->GetValue());
                    $this->nom_insumo->SetValue($this->DataSource->nom_insumo->GetValue());
                    $this->stock_min->SetValue($this->DataSource->stock_min->GetValue());
                    $this->stock_max->SetValue($this->DataSource->stock_max->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->insumo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->id_nom_insumo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->id_insumo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->last_insert_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->last_nom_insumo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cod_insumo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_insumo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->stock_min->Errors->ToString());
            $Error = ComposeStrings($Error, $this->stock_max->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->insumo_id->Show();
        $this->id_nom_insumo->Show();
        $this->id_insumo_id->Show();
        $this->last_insert_id->Show();
        $this->last_nom_insumo->Show();
        $this->cod_insumo->Show();
        $this->nom_insumo->Show();
        $this->stock_min->Show();
        $this->stock_max->Show();
        $this->Button_Insert->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End insumos Class @3-FCB6E20C

class clsinsumosDataSource extends clsDBDatos {  //insumosDataSource Class @3-B44978F7

//DataSource Variables @3-6BACC482
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $insumo_id;
    public $id_nom_insumo;
    public $id_insumo_id;
    public $last_insert_id;
    public $last_nom_insumo;
    public $cod_insumo;
    public $nom_insumo;
    public $stock_min;
    public $stock_max;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-67953584
    function clsinsumosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record insumos/Error";
        $this->Initialize();
        $this->insumo_id = new clsField("insumo_id", ccsInteger, "");
        
        $this->id_nom_insumo = new clsField("id_nom_insumo", ccsText, "");
        
        $this->id_insumo_id = new clsField("id_insumo_id", ccsText, "");
        
        $this->last_insert_id = new clsField("last_insert_id", ccsText, "");
        
        $this->last_nom_insumo = new clsField("last_nom_insumo", ccsText, "");
        
        $this->cod_insumo = new clsField("cod_insumo", ccsText, "");
        
        $this->nom_insumo = new clsField("nom_insumo", ccsText, "");
        
        $this->stock_min = new clsField("stock_min", ccsInteger, "");
        
        $this->stock_max = new clsField("stock_max", ccsInteger, "");
        

        $this->InsertFields["insumo_id"] = array("Name" => "insumo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["cod_insumo"] = array("Name" => "cod_insumo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_insumo"] = array("Name" => "nom_insumo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["stock_min"] = array("Name" => "stock_min", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["stock_max"] = array("Name" => "stock_max", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["insumo_id"] = array("Name" => "insumo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["cod_insumo"] = array("Name" => "cod_insumo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_insumo"] = array("Name" => "nom_insumo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["stock_min"] = array("Name" => "stock_min", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["stock_max"] = array("Name" => "stock_max", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-1F89F115
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlinsumo_id", ccsInteger, "", "", $this->Parameters["urlinsumo_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "insumo_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @3-44902522
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM insumos {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-E1DA2AF4
    function SetValues()
    {
        $this->insumo_id->SetDBValue(trim($this->f("insumo_id")));
        $this->cod_insumo->SetDBValue($this->f("cod_insumo"));
        $this->nom_insumo->SetDBValue($this->f("nom_insumo"));
        $this->stock_min->SetDBValue(trim($this->f("stock_min")));
        $this->stock_max->SetDBValue(trim($this->f("stock_max")));
    }
//End SetValues Method

//Insert Method @3-ED90950C
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["insumo_id"]["Value"] = $this->insumo_id->GetDBValue(true);
        $this->InsertFields["cod_insumo"]["Value"] = $this->cod_insumo->GetDBValue(true);
        $this->InsertFields["nom_insumo"]["Value"] = $this->nom_insumo->GetDBValue(true);
        $this->InsertFields["stock_min"]["Value"] = $this->stock_min->GetDBValue(true);
        $this->InsertFields["stock_max"]["Value"] = $this->stock_max->GetDBValue(true);
        $this->SQL = CCBuildInsert("insumos", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @3-6772540C
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["insumo_id"]["Value"] = $this->insumo_id->GetDBValue(true);
        $this->UpdateFields["cod_insumo"]["Value"] = $this->cod_insumo->GetDBValue(true);
        $this->UpdateFields["nom_insumo"]["Value"] = $this->nom_insumo->GetDBValue(true);
        $this->UpdateFields["stock_min"]["Value"] = $this->stock_min->GetDBValue(true);
        $this->UpdateFields["stock_max"]["Value"] = $this->stock_max->GetDBValue(true);
        $this->SQL = CCBuildUpdate("insumos", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @3-3D092B3C
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM insumos";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End insumosDataSource Class @3-FCB6E20C

//Initialize Page @1-2D60E9D5
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
$TemplateFileName = "add_insumo.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-3D361E45
CCSecurityRedirect("7;12;13;14;15;16;17;18;19;20", "");
//End Authenticate User

//Include events file @1-09EE5328
include_once("./add_insumo_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2D0839B4
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$insumos = new clsRecordinsumos("", $MainPage);
$MainPage->insumos = & $insumos;
$insumos->Initialize();
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

//Execute Components @1-5E6B2961
$insumos->Operation();
//End Execute Components

//Go to destination page @1-3F6C2BE2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($insumos);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B0377E5B
$insumos->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BCE35A10
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($insumos);
unset($Tpl);
//End Unload Page


?>
