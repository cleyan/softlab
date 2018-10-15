<?php
//Include Common Files @1-CCF17CEA
define("RelativePath", "..");
define("PathToCurrentPage", "/Bodega/");
define("FileName", "list_ingreso_insumos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordinsumos_ingreso_insumosSearch { //insumos_ingreso_insumosSearch Class @51-1A7888D9

//Variables @51-9E315808

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

//Class_Initialize Event @51-C206AED1
    function clsRecordinsumos_ingreso_insumosSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record insumos_ingreso_insumosSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "insumos_ingreso_insumosSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_insumo = new clsControl(ccsTextBox, "s_insumo", "s_insumo", ccsText, "", CCGetRequestParam("s_insumo", $Method, NULL), $this);
            $this->s_fecha = new clsControl(ccsTextBox, "s_fecha", "s_fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_fecha", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @51-D5A081CC
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_insumo->Validate() && $Validation);
        $Validation = ($this->s_fecha->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_insumo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @51-6075EBD6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_insumo->Errors->Count());
        $errors = ($errors || $this->s_fecha->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @51-26986ED1
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
        $Redirect = "list_ingreso_insumos.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "list_ingreso_insumos.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @51-32D4449F
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
            $Error = ComposeStrings($Error, $this->s_insumo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha->Errors->ToString());
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

        $this->s_insumo->Show();
        $this->s_fecha->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End insumos_ingreso_insumosSearch Class @51-FCB6E20C

class clsGridinsumos_ingreso_insumos { //insumos_ingreso_insumos class @32-DA165BAD

//Variables @32-2E72971A

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
    public $Sorter_fecha;
    public $Sorter_cod_insumo;
    public $Sorter_nom_insumo;
    public $Sorter_cantidad;
    public $Sorter_costo;
//End Variables

//Class_Initialize Event @32-DBBF1B96
    function clsGridinsumos_ingreso_insumos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "insumos_ingreso_insumos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid insumos_ingreso_insumos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinsumos_ingreso_insumosDataSource($this);
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
        $this->SorterName = CCGetParam("insumos_ingreso_insumosOrder", "");
        $this->SorterDirection = CCGetParam("insumos_ingreso_insumosDir", "");

        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "ingreso_insumo.php";
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->cod_insumo = new clsControl(ccsLabel, "cod_insumo", "cod_insumo", ccsText, "", CCGetRequestParam("cod_insumo", ccsGet, NULL), $this);
        $this->nom_insumo = new clsControl(ccsLabel, "nom_insumo", "nom_insumo", ccsText, "", CCGetRequestParam("nom_insumo", ccsGet, NULL), $this);
        $this->cantidad = new clsControl(ccsLabel, "cantidad", "cantidad", ccsInteger, "", CCGetRequestParam("cantidad", ccsGet, NULL), $this);
        $this->costo = new clsControl(ccsLabel, "costo", "costo", ccsFloat, array(False, 0, Null, Null, False, "\$", "", 1, True, ""), CCGetRequestParam("costo", ccsGet, NULL), $this);
        $this->Link2 = new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Page = "ingreso_insumo.php";
        $this->Alt_fecha = new clsControl(ccsLabel, "Alt_fecha", "Alt_fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("Alt_fecha", ccsGet, NULL), $this);
        $this->Alt_cod_insumo = new clsControl(ccsLabel, "Alt_cod_insumo", "Alt_cod_insumo", ccsText, "", CCGetRequestParam("Alt_cod_insumo", ccsGet, NULL), $this);
        $this->Alt_nom_insumo = new clsControl(ccsLabel, "Alt_nom_insumo", "Alt_nom_insumo", ccsText, "", CCGetRequestParam("Alt_nom_insumo", ccsGet, NULL), $this);
        $this->Alt_cantidad = new clsControl(ccsLabel, "Alt_cantidad", "Alt_cantidad", ccsInteger, "", CCGetRequestParam("Alt_cantidad", ccsGet, NULL), $this);
        $this->Alt_costo = new clsControl(ccsLabel, "Alt_costo", "Alt_costo", ccsFloat, array(False, 0, Null, Null, False, "\$", "", 1, True, ""), CCGetRequestParam("Alt_costo", ccsGet, NULL), $this);
        $this->insumos_ingreso_insumos_TotalRecords = new clsControl(ccsLabel, "insumos_ingreso_insumos_TotalRecords", "insumos_ingreso_insumos_TotalRecords", ccsText, "", CCGetRequestParam("insumos_ingreso_insumos_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_fecha = new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Sorter_cod_insumo = new clsSorter($this->ComponentName, "Sorter_cod_insumo", $FileName, $this);
        $this->Sorter_nom_insumo = new clsSorter($this->ComponentName, "Sorter_nom_insumo", $FileName, $this);
        $this->Sorter_cantidad = new clsSorter($this->ComponentName, "Sorter_cantidad", $FileName, $this);
        $this->Sorter_costo = new clsSorter($this->ComponentName, "Sorter_costo", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @32-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @32-7C355D0D
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_insumo"] = CCGetFromGet("s_insumo", NULL);
        $this->DataSource->Parameters["urls_fecha"] = CCGetFromGet("s_fecha", NULL);

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
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["cod_insumo"] = $this->cod_insumo->Visible;
            $this->ControlsVisible["nom_insumo"] = $this->nom_insumo->Visible;
            $this->ControlsVisible["cantidad"] = $this->cantidad->Visible;
            $this->ControlsVisible["costo"] = $this->costo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "ingreso_insumo_id", $this->DataSource->f("ingreso_insumo_id"));
                    $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                    $this->cod_insumo->SetValue($this->DataSource->cod_insumo->GetValue());
                    $this->nom_insumo->SetValue($this->DataSource->nom_insumo->GetValue());
                    $this->cantidad->SetValue($this->DataSource->cantidad->GetValue());
                    $this->costo->SetValue($this->DataSource->costo->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Link1->Show();
                    $this->fecha->Show();
                    $this->cod_insumo->Show();
                    $this->nom_insumo->Show();
                    $this->cantidad->Show();
                    $this->costo->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "ingreso_insumo_id", $this->DataSource->f("ingreso_insumo_id"));
                    $this->Alt_fecha->SetValue($this->DataSource->Alt_fecha->GetValue());
                    $this->Alt_cod_insumo->SetValue($this->DataSource->Alt_cod_insumo->GetValue());
                    $this->Alt_nom_insumo->SetValue($this->DataSource->Alt_nom_insumo->GetValue());
                    $this->Alt_cantidad->SetValue($this->DataSource->Alt_cantidad->GetValue());
                    $this->Alt_costo->SetValue($this->DataSource->Alt_costo->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Link2->Show();
                    $this->Alt_fecha->Show();
                    $this->Alt_cod_insumo->Show();
                    $this->Alt_nom_insumo->Show();
                    $this->Alt_cantidad->Show();
                    $this->Alt_costo->Show();
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
        $this->insumos_ingreso_insumos_TotalRecords->Show();
        $this->Sorter_fecha->Show();
        $this->Sorter_cod_insumo->Show();
        $this->Sorter_nom_insumo->Show();
        $this->Sorter_cantidad->Show();
        $this->Sorter_costo->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @32-BBF69D9B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cantidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->costo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_cod_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_cantidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_costo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End insumos_ingreso_insumos Class @32-FCB6E20C

class clsinsumos_ingreso_insumosDataSource extends clsDBDatos {  //insumos_ingreso_insumosDataSource Class @32-34873AD7

//DataSource Variables @32-9C5F8846
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $fecha;
    public $cod_insumo;
    public $nom_insumo;
    public $cantidad;
    public $costo;
    public $Alt_fecha;
    public $Alt_cod_insumo;
    public $Alt_nom_insumo;
    public $Alt_cantidad;
    public $Alt_costo;
//End DataSource Variables

//DataSourceClass_Initialize Event @32-BE23964E
    function clsinsumos_ingreso_insumosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid insumos_ingreso_insumos";
        $this->Initialize();
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->cod_insumo = new clsField("cod_insumo", ccsText, "");
        
        $this->nom_insumo = new clsField("nom_insumo", ccsText, "");
        
        $this->cantidad = new clsField("cantidad", ccsInteger, "");
        
        $this->costo = new clsField("costo", ccsFloat, "");
        
        $this->Alt_fecha = new clsField("Alt_fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->Alt_cod_insumo = new clsField("Alt_cod_insumo", ccsText, "");
        
        $this->Alt_nom_insumo = new clsField("Alt_nom_insumo", ccsText, "");
        
        $this->Alt_cantidad = new clsField("Alt_cantidad", ccsInteger, "");
        
        $this->Alt_costo = new clsField("Alt_costo", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @32-02D6AF6B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "fecha desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_fecha" => array("fecha", ""), 
            "Sorter_cod_insumo" => array("cod_insumo", ""), 
            "Sorter_nom_insumo" => array("nom_insumo", ""), 
            "Sorter_cantidad" => array("cantidad", ""), 
            "Sorter_costo" => array("costo", "")));
    }
//End SetOrder Method

//Prepare Method @32-571CD0E1
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_insumo", ccsText, "", "", $this->Parameters["urls_insumo"], "", false);
        $this->wp->AddParameter("2", "urls_insumo", ccsText, "", "", $this->Parameters["urls_insumo"], "", false);
        $this->wp->AddParameter("3", "urls_fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->Parameters["urls_fecha"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "cod_insumo", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "nom_insumo", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "fecha", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opOR(
             true, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @32-2B20FC9F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM insumos_ingreso INNER JOIN insumos ON\n\n" .
        "insumos_ingreso.insumo_id = insumos.insumo_id";
        $this->SQL = "SELECT ingreso_insumo_id, insumos_ingreso.insumo_id AS insumo_id, cantidad, fecha, costo, cod_insumo, nom_insumo \n\n" .
        "FROM insumos_ingreso INNER JOIN insumos ON\n\n" .
        "insumos_ingreso.insumo_id = insumos.insumo_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @32-D99ECB84
    function SetValues()
    {
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->cod_insumo->SetDBValue($this->f("cod_insumo"));
        $this->nom_insumo->SetDBValue($this->f("nom_insumo"));
        $this->cantidad->SetDBValue(trim($this->f("cantidad")));
        $this->costo->SetDBValue(trim($this->f("costo")));
        $this->Alt_fecha->SetDBValue(trim($this->f("fecha")));
        $this->Alt_cod_insumo->SetDBValue($this->f("cod_insumo"));
        $this->Alt_nom_insumo->SetDBValue($this->f("nom_insumo"));
        $this->Alt_cantidad->SetDBValue(trim($this->f("cantidad")));
        $this->Alt_costo->SetDBValue(trim($this->f("costo")));
    }
//End SetValues Method

} //End insumos_ingreso_insumosDataSource Class @32-FCB6E20C

//Include Page implementation @88-07A1C36D
include_once(RelativePath . "/Bodega/calendar_tag.php");
//End Include Page implementation

//Initialize Page @1-9D587BBC
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
$TemplateFileName = "list_ingreso_insumos.html";
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

//Include events file @1-FC42F6F0
include_once("./list_ingreso_insumos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-32BBBE70
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$insumos_ingreso_insumosSearch = new clsRecordinsumos_ingreso_insumosSearch("", $MainPage);
$insumos_ingreso_insumos = new clsGridinsumos_ingreso_insumos("", $MainPage);
$ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $MainPage);
$ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$ImageLink1->Page = "ingreso_insumo.php";
$calendar_tag = new clscalendar_tag("", "calendar_tag", $MainPage);
$calendar_tag->Initialize();
$MainPage->insumos_ingreso_insumosSearch = & $insumos_ingreso_insumosSearch;
$MainPage->insumos_ingreso_insumos = & $insumos_ingreso_insumos;
$MainPage->ImageLink1 = & $ImageLink1;
$MainPage->calendar_tag = & $calendar_tag;
$insumos_ingreso_insumos->Initialize();
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

//Execute Components @1-CA28D34D
$calendar_tag->Operations();
$insumos_ingreso_insumosSearch->Operation();
//End Execute Components

//Go to destination page @1-816EA1BF
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($insumos_ingreso_insumosSearch);
    unset($insumos_ingreso_insumos);
    $calendar_tag->Class_Terminate();
    unset($calendar_tag);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-818FE08C
$insumos_ingreso_insumosSearch->Show();
$insumos_ingreso_insumos->Show();
$calendar_tag->Show();
$ImageLink1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2A99B562
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($insumos_ingreso_insumosSearch);
unset($insumos_ingreso_insumos);
$calendar_tag->Class_Terminate();
unset($calendar_tag);
unset($Tpl);
//End Unload Page


?>
