<?php
//Include Common Files @1-F0B6B1DF
define("RelativePath", "..");
define("PathToCurrentPage", "/Bodega/");
define("FileName", "ver_stock_bodega.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordinsumosSearch { //insumosSearch Class @3-362075BB

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

//Class_Initialize Event @3-A04A53BE
    function clsRecordinsumosSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record insumosSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "insumosSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_cod_insumo = new clsControl(ccsTextBox, "s_cod_insumo", "s_cod_insumo", ccsText, "", CCGetRequestParam("s_cod_insumo", $Method, NULL), $this);
            $this->s_nom_insumo = new clsControl(ccsTextBox, "s_nom_insumo", "s_nom_insumo", ccsText, "", CCGetRequestParam("s_nom_insumo", $Method, NULL), $this);
            $this->s_test_id = new clsControl(ccsListBox, "s_test_id", "s_test_id", ccsText, "", CCGetRequestParam("s_test_id", $Method, NULL), $this);
            $this->s_test_id->DSType = dsTable;
            $this->s_test_id->DataSource = new clsDBDatos();
            $this->s_test_id->ds = & $this->s_test_id->DataSource;
            $this->s_test_id->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            list($this->s_test_id->BoundColumn, $this->s_test_id->TextColumn, $this->s_test_id->DBFormat) = array("test_id", "nom_test", "");
            $this->insumosPageSize = new clsControl(ccsListBox, "insumosPageSize", "insumosPageSize", ccsText, "", CCGetRequestParam("insumosPageSize", $Method, NULL), $this);
            $this->insumosPageSize->DSType = dsListOfValues;
            $this->insumosPageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-6AFFD93B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_cod_insumo->Validate() && $Validation);
        $Validation = ($this->s_nom_insumo->Validate() && $Validation);
        $Validation = ($this->s_test_id->Validate() && $Validation);
        $Validation = ($this->insumosPageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_cod_insumo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nom_insumo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_test_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->insumosPageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-8B3835C9
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_cod_insumo->Errors->Count());
        $errors = ($errors || $this->s_nom_insumo->Errors->Count());
        $errors = ($errors || $this->s_test_id->Errors->Count());
        $errors = ($errors || $this->insumosPageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-A0179D0B
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
        $Redirect = "ver_stock_bodega.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ver_stock_bodega.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-BAFFB1E8
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

        $this->s_test_id->Prepare();
        $this->insumosPageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_cod_insumo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nom_insumo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_test_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->insumosPageSize->Errors->ToString());
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

        $this->s_cod_insumo->Show();
        $this->s_nom_insumo->Show();
        $this->s_test_id->Show();
        $this->insumosPageSize->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End insumosSearch Class @3-FCB6E20C

class clsGridinsumos { //insumos class @2-1012969D

//Variables @2-F2C85AAF

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
    public $Sorter_cod_insumo;
    public $Sorter_nom_insumo;
    public $Sorter_stock_min;
    public $Sorter_stock_max;
//End Variables

//Class_Initialize Event @2-DFC472F7
    function clsGridinsumos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "insumos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid insumos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinsumosDataSource($this);
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
        $this->SorterName = CCGetParam("insumosOrder", "");
        $this->SorterDirection = CCGetParam("insumosDir", "");

        $this->estado = new clsControl(ccsLabel, "estado", "estado", ccsText, "", CCGetRequestParam("estado", ccsGet, NULL), $this);
        $this->estado->HTML = true;
        $this->cod_insumo = new clsControl(ccsLabel, "cod_insumo", "cod_insumo", ccsText, "", CCGetRequestParam("cod_insumo", ccsGet, NULL), $this);
        $this->nom_insumo = new clsControl(ccsLabel, "nom_insumo", "nom_insumo", ccsText, "", CCGetRequestParam("nom_insumo", ccsGet, NULL), $this);
        $this->stock_min = new clsControl(ccsLabel, "stock_min", "stock_min", ccsInteger, "", CCGetRequestParam("stock_min", ccsGet, NULL), $this);
        $this->stock_max = new clsControl(ccsLabel, "stock_max", "stock_max", ccsInteger, "", CCGetRequestParam("stock_max", ccsGet, NULL), $this);
        $this->insumo_id = new clsControl(ccsHidden, "insumo_id", "insumo_id", ccsInteger, "", CCGetRequestParam("insumo_id", ccsGet, NULL), $this);
        $this->total_ingreso = new clsControl(ccsLabel, "total_ingreso", "total_ingreso", ccsInteger, "", CCGetRequestParam("total_ingreso", ccsGet, NULL), $this);
        $this->total_salida = new clsControl(ccsLabel, "total_salida", "total_salida", ccsInteger, "", CCGetRequestParam("total_salida", ccsGet, NULL), $this);
        $this->total_stock = new clsControl(ccsLabel, "total_stock", "total_stock", ccsInteger, "", CCGetRequestParam("total_stock", ccsGet, NULL), $this);
        $this->total_stock->HTML = true;
        $this->um = new clsControl(ccsLabel, "um", "um", ccsText, "", CCGetRequestParam("um", ccsGet, NULL), $this);
        $this->alt_estado = new clsControl(ccsLabel, "alt_estado", "alt_estado", ccsText, "", CCGetRequestParam("alt_estado", ccsGet, NULL), $this);
        $this->alt_estado->HTML = true;
        $this->Alt_cod_insumo = new clsControl(ccsLabel, "Alt_cod_insumo", "Alt_cod_insumo", ccsText, "", CCGetRequestParam("Alt_cod_insumo", ccsGet, NULL), $this);
        $this->Alt_nom_insumo = new clsControl(ccsLabel, "Alt_nom_insumo", "Alt_nom_insumo", ccsText, "", CCGetRequestParam("Alt_nom_insumo", ccsGet, NULL), $this);
        $this->Alt_stock_min = new clsControl(ccsLabel, "Alt_stock_min", "Alt_stock_min", ccsInteger, "", CCGetRequestParam("Alt_stock_min", ccsGet, NULL), $this);
        $this->Alt_stock_max = new clsControl(ccsLabel, "Alt_stock_max", "Alt_stock_max", ccsInteger, "", CCGetRequestParam("Alt_stock_max", ccsGet, NULL), $this);
        $this->Alt_insumo_id = new clsControl(ccsHidden, "Alt_insumo_id", "Alt_insumo_id", ccsInteger, "", CCGetRequestParam("Alt_insumo_id", ccsGet, NULL), $this);
        $this->alt_total_ingreso = new clsControl(ccsLabel, "alt_total_ingreso", "alt_total_ingreso", ccsInteger, "", CCGetRequestParam("alt_total_ingreso", ccsGet, NULL), $this);
        $this->alt_total_salida = new clsControl(ccsLabel, "alt_total_salida", "alt_total_salida", ccsText, "", CCGetRequestParam("alt_total_salida", ccsGet, NULL), $this);
        $this->alt_total_stock = new clsControl(ccsLabel, "alt_total_stock", "alt_total_stock", ccsInteger, "", CCGetRequestParam("alt_total_stock", ccsGet, NULL), $this);
        $this->alt_total_stock->HTML = true;
        $this->alt_um = new clsControl(ccsLabel, "alt_um", "alt_um", ccsText, "", CCGetRequestParam("alt_um", ccsGet, NULL), $this);
        $this->insumos_TotalRecords = new clsControl(ccsLabel, "insumos_TotalRecords", "insumos_TotalRecords", ccsText, "", CCGetRequestParam("insumos_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_cod_insumo = new clsSorter($this->ComponentName, "Sorter_cod_insumo", $FileName, $this);
        $this->Sorter_nom_insumo = new clsSorter($this->ComponentName, "Sorter_nom_insumo", $FileName, $this);
        $this->Sorter_stock_min = new clsSorter($this->ComponentName, "Sorter_stock_min", $FileName, $this);
        $this->Sorter_stock_max = new clsSorter($this->ComponentName, "Sorter_stock_max", $FileName, $this);
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

//Show Method @2-96530D64
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_cod_insumo"] = CCGetFromGet("s_cod_insumo", NULL);
        $this->DataSource->Parameters["urls_nom_insumo"] = CCGetFromGet("s_nom_insumo", NULL);
        $this->DataSource->Parameters["urls_test_id"] = CCGetFromGet("s_test_id", NULL);

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
            $this->ControlsVisible["estado"] = $this->estado->Visible;
            $this->ControlsVisible["cod_insumo"] = $this->cod_insumo->Visible;
            $this->ControlsVisible["nom_insumo"] = $this->nom_insumo->Visible;
            $this->ControlsVisible["stock_min"] = $this->stock_min->Visible;
            $this->ControlsVisible["stock_max"] = $this->stock_max->Visible;
            $this->ControlsVisible["insumo_id"] = $this->insumo_id->Visible;
            $this->ControlsVisible["total_ingreso"] = $this->total_ingreso->Visible;
            $this->ControlsVisible["total_salida"] = $this->total_salida->Visible;
            $this->ControlsVisible["total_stock"] = $this->total_stock->Visible;
            $this->ControlsVisible["um"] = $this->um->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->cod_insumo->SetValue($this->DataSource->cod_insumo->GetValue());
                    $this->nom_insumo->SetValue($this->DataSource->nom_insumo->GetValue());
                    $this->stock_min->SetValue($this->DataSource->stock_min->GetValue());
                    $this->stock_max->SetValue($this->DataSource->stock_max->GetValue());
                    $this->insumo_id->SetValue($this->DataSource->insumo_id->GetValue());
                    $this->um->SetValue($this->DataSource->um->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->estado->Show();
                    $this->cod_insumo->Show();
                    $this->nom_insumo->Show();
                    $this->stock_min->Show();
                    $this->stock_max->Show();
                    $this->insumo_id->Show();
                    $this->total_ingreso->Show();
                    $this->total_salida->Show();
                    $this->total_stock->Show();
                    $this->um->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_cod_insumo->SetValue($this->DataSource->Alt_cod_insumo->GetValue());
                    $this->Alt_nom_insumo->SetValue($this->DataSource->Alt_nom_insumo->GetValue());
                    $this->Alt_stock_min->SetValue($this->DataSource->Alt_stock_min->GetValue());
                    $this->Alt_stock_max->SetValue($this->DataSource->Alt_stock_max->GetValue());
                    $this->Alt_insumo_id->SetValue($this->DataSource->Alt_insumo_id->GetValue());
                    $this->alt_um->SetValue($this->DataSource->alt_um->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->alt_estado->Show();
                    $this->Alt_cod_insumo->Show();
                    $this->Alt_nom_insumo->Show();
                    $this->Alt_stock_min->Show();
                    $this->Alt_stock_max->Show();
                    $this->Alt_insumo_id->Show();
                    $this->alt_total_ingreso->Show();
                    $this->alt_total_salida->Show();
                    $this->alt_total_stock->Show();
                    $this->alt_um->Show();
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
        $this->insumos_TotalRecords->Show();
        $this->Sorter_cod_insumo->Show();
        $this->Sorter_nom_insumo->Show();
        $this->Sorter_stock_min->Show();
        $this->Sorter_stock_max->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-84CB30B2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->stock_min->Errors->ToString());
        $errors = ComposeStrings($errors, $this->stock_max->Errors->ToString());
        $errors = ComposeStrings($errors, $this->insumo_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_ingreso->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_salida->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_stock->Errors->ToString());
        $errors = ComposeStrings($errors, $this->um->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alt_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_cod_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_stock_min->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_stock_max->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_insumo_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alt_total_ingreso->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alt_total_salida->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alt_total_stock->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alt_um->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End insumos Class @2-FCB6E20C

class clsinsumosDataSource extends clsDBDatos {  //insumosDataSource Class @2-B44978F7

//DataSource Variables @2-A4CC087E
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $cod_insumo;
    public $nom_insumo;
    public $stock_min;
    public $stock_max;
    public $insumo_id;
    public $um;
    public $Alt_cod_insumo;
    public $Alt_nom_insumo;
    public $Alt_stock_min;
    public $Alt_stock_max;
    public $Alt_insumo_id;
    public $alt_um;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-AF97D59C
    function clsinsumosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid insumos";
        $this->Initialize();
        $this->cod_insumo = new clsField("cod_insumo", ccsText, "");
        
        $this->nom_insumo = new clsField("nom_insumo", ccsText, "");
        
        $this->stock_min = new clsField("stock_min", ccsInteger, "");
        
        $this->stock_max = new clsField("stock_max", ccsInteger, "");
        
        $this->insumo_id = new clsField("insumo_id", ccsInteger, "");
        
        $this->um = new clsField("um", ccsText, "");
        
        $this->Alt_cod_insumo = new clsField("Alt_cod_insumo", ccsText, "");
        
        $this->Alt_nom_insumo = new clsField("Alt_nom_insumo", ccsText, "");
        
        $this->Alt_stock_min = new clsField("Alt_stock_min", ccsInteger, "");
        
        $this->Alt_stock_max = new clsField("Alt_stock_max", ccsInteger, "");
        
        $this->Alt_insumo_id = new clsField("Alt_insumo_id", ccsInteger, "");
        
        $this->alt_um = new clsField("alt_um", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-AB2F025D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "nom_insumo";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_cod_insumo" => array("cod_insumo", ""), 
            "Sorter_nom_insumo" => array("nom_insumo", ""), 
            "Sorter_stock_min" => array("stock_min", ""), 
            "Sorter_stock_max" => array("stock_max", "")));
    }
//End SetOrder Method

//Prepare Method @2-D8D6D1DE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_cod_insumo", ccsText, "", "", $this->Parameters["urls_cod_insumo"], "", false);
        $this->wp->AddParameter("2", "urls_nom_insumo", ccsText, "", "", $this->Parameters["urls_nom_insumo"], "", false);
        $this->wp->AddParameter("3", "urls_test_id", ccsInteger, "", "", $this->Parameters["urls_test_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "cod_insumo", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "nom_insumo", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "insumos_x_test.test_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-72F6D2B3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM insumos_x_test RIGHT JOIN insumos ON\n\n" .
        "insumos_x_test.insumo_id = insumos.insumo_id";
        $this->SQL = "SELECT insumos.*, test_id \n\n" .
        "FROM insumos_x_test RIGHT JOIN insumos ON\n\n" .
        "insumos_x_test.insumo_id = insumos.insumo_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-CEFAE1F7
    function SetValues()
    {
        $this->cod_insumo->SetDBValue($this->f("cod_insumo"));
        $this->nom_insumo->SetDBValue($this->f("nom_insumo"));
        $this->stock_min->SetDBValue(trim($this->f("stock_min")));
        $this->stock_max->SetDBValue(trim($this->f("stock_max")));
        $this->insumo_id->SetDBValue(trim($this->f("insumo_id")));
        $this->um->SetDBValue($this->f("unidad_medida"));
        $this->Alt_cod_insumo->SetDBValue($this->f("cod_insumo"));
        $this->Alt_nom_insumo->SetDBValue($this->f("nom_insumo"));
        $this->Alt_stock_min->SetDBValue(trim($this->f("stock_min")));
        $this->Alt_stock_max->SetDBValue(trim($this->f("stock_max")));
        $this->Alt_insumo_id->SetDBValue(trim($this->f("insumo_id")));
        $this->alt_um->SetDBValue($this->f("unidad_medida"));
    }
//End SetValues Method

} //End insumosDataSource Class @2-FCB6E20C

//Initialize Page @1-AE6D7436
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
$TemplateFileName = "ver_stock_bodega.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "../";
$PathToRootOpt = "../";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-1C6D62C5
CCSecurityRedirect("16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-CB8497AA
include_once("./ver_stock_bodega_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D924F3AD
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$insumosSearch = new clsRecordinsumosSearch("", $MainPage);
$insumos = new clsGridinsumos("", $MainPage);
$MainPage->insumosSearch = & $insumosSearch;
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

//Initialize HTML Template @1-1D8FC0E6
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
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-ABDAC239
$insumosSearch->Operation();
//End Execute Components

//Go to destination page @1-09235F3C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($insumosSearch);
    unset($insumos);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9FDF5630
$insumosSearch->Show();
$insumos->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-814EC22F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($insumosSearch);
unset($insumos);
unset($Tpl);
//End Unload Page


?>
