<?php
//Include Common Files @1-1E95908E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "frmEligeTest.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtest_secciones_equiposSearch { //test_secciones_equiposSearch Class @19-8FE57956

//Variables @19-9E315808

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

//Class_Initialize Event @19-1EB98FAD
    function clsRecordtest_secciones_equiposSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record test_secciones_equiposSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "test_secciones_equiposSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_test = new clsControl(ccsTextBox, "s_test", "s_test", ccsText, "", CCGetRequestParam("s_test", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->lbl_hideseccion = new clsControl(ccsLabel, "lbl_hideseccion", "lbl_hideseccion", ccsText, "", CCGetRequestParam("lbl_hideseccion", $Method, NULL), $this);
            $this->lbl_hideseccion->HTML = true;
            $this->s_secciones_id = new clsControl(ccsListBox, "s_secciones_id", "s_secciones_id", ccsInteger, "", CCGetRequestParam("s_secciones_id", $Method, NULL), $this);
            $this->s_secciones_id->DSType = dsTable;
            $this->s_secciones_id->DataSource = new clsDBDatos();
            $this->s_secciones_id->ds = & $this->s_secciones_id->DataSource;
            $this->s_secciones_id->DataSource->SQL = "SELECT * \n" .
"FROM secciones {SQL_Where} {SQL_OrderBy}";
            list($this->s_secciones_id->BoundColumn, $this->s_secciones_id->TextColumn, $this->s_secciones_id->DBFormat) = array("seccion_id", "nom_seccion", "");
            $this->nombre_seccion = new clsControl(ccsLabel, "nombre_seccion", "nombre_seccion", ccsText, "", CCGetRequestParam("nombre_seccion", $Method, NULL), $this);
            $this->nombre_seccion->HTML = true;
            $this->s_test_equipo_id = new clsControl(ccsListBox, "s_test_equipo_id", "s_test_equipo_id", ccsInteger, "", CCGetRequestParam("s_test_equipo_id", $Method, NULL), $this);
            $this->s_test_equipo_id->DSType = dsTable;
            $this->s_test_equipo_id->DataSource = new clsDBDatos();
            $this->s_test_equipo_id->ds = & $this->s_test_equipo_id->DataSource;
            $this->s_test_equipo_id->DataSource->SQL = "SELECT * \n" .
"FROM equipos {SQL_Where} {SQL_OrderBy}";
            list($this->s_test_equipo_id->BoundColumn, $this->s_test_equipo_id->TextColumn, $this->s_test_equipo_id->DBFormat) = array("equipo_id", "nom_equipo", "");
        }
    }
//End Class_Initialize Event

//Validate Method @19-DEAD8315
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_test->Validate() && $Validation);
        $Validation = ($this->s_secciones_id->Validate() && $Validation);
        $Validation = ($this->s_test_equipo_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_test->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_secciones_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_test_equipo_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @19-89D284BA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_test->Errors->Count());
        $errors = ($errors || $this->lbl_hideseccion->Errors->Count());
        $errors = ($errors || $this->s_secciones_id->Errors->Count());
        $errors = ($errors || $this->nombre_seccion->Errors->Count());
        $errors = ($errors || $this->s_test_equipo_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @19-C2D0C228
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
        $Redirect = "frmEligeTest.php" . "?" . CCGetQueryString("All", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "frmEligeTest.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_test", "s_secciones_id", "s_test_equipo_id", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @19-F6091F8B
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

        $this->s_secciones_id->Prepare();
        $this->s_test_equipo_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lbl_hideseccion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_secciones_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nombre_seccion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_test_equipo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        if($this->FormSubmitted || CCGetFromGet("ccsForm")) {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        } else {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("All", ""), "ccsForm", $CCSForm);
        }
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->s_test->Show();
        $this->Button_DoSearch->Show();
        $this->lbl_hideseccion->Show();
        $this->s_secciones_id->Show();
        $this->nombre_seccion->Show();
        $this->s_test_equipo_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End test_secciones_equiposSearch Class @19-FCB6E20C

class clsGridtest_secciones_equipos { //test_secciones_equipos class @2-332F90FE

//Variables @2-8A25C358

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
    public $Sorter_cod_test;
    public $Sorter_nom_test;
    public $Sorter_codigo_fonasa;
    public $Sorter_nom_seccion;
    public $Sorter_nom_equipo;
//End Variables

//Class_Initialize Event @2-A1B45386
    function clsGridtest_secciones_equipos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "test_secciones_equipos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid test_secciones_equipos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstest_secciones_equiposDataSource($this);
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
        $this->SorterName = CCGetParam("test_secciones_equiposOrder", "");
        $this->SorterDirection = CCGetParam("test_secciones_equiposDir", "");

        $this->lblOp = new clsControl(ccsLabel, "lblOp", "lblOp", ccsText, "", CCGetRequestParam("lblOp", ccsGet, NULL), $this);
        $this->lblOp->HTML = true;
        $this->cod_test = new clsControl(ccsLabel, "cod_test", "cod_test", ccsText, "", CCGetRequestParam("cod_test", ccsGet, NULL), $this);
        $this->test_id = new clsControl(ccsHidden, "test_id", "test_id", ccsText, "", CCGetRequestParam("test_id", ccsGet, NULL), $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $this);
        $this->codigo_fonasa = new clsControl(ccsLabel, "codigo_fonasa", "codigo_fonasa", ccsText, "", CCGetRequestParam("codigo_fonasa", ccsGet, NULL), $this);
        $this->nom_seccion = new clsControl(ccsLabel, "nom_seccion", "nom_seccion", ccsText, "", CCGetRequestParam("nom_seccion", ccsGet, NULL), $this);
        $this->nom_equipo = new clsControl(ccsLabel, "nom_equipo", "nom_equipo", ccsText, "", CCGetRequestParam("nom_equipo", ccsGet, NULL), $this);
        $this->Alt_lblOp = new clsControl(ccsLabel, "Alt_lblOp", "Alt_lblOp", ccsText, "", CCGetRequestParam("Alt_lblOp", ccsGet, NULL), $this);
        $this->Alt_lblOp->HTML = true;
        $this->Alt_cod_test = new clsControl(ccsLabel, "Alt_cod_test", "Alt_cod_test", ccsText, "", CCGetRequestParam("Alt_cod_test", ccsGet, NULL), $this);
        $this->Alt_test_id = new clsControl(ccsHidden, "Alt_test_id", "Alt_test_id", ccsText, "", CCGetRequestParam("Alt_test_id", ccsGet, NULL), $this);
        $this->Alt_nom_test = new clsControl(ccsLabel, "Alt_nom_test", "Alt_nom_test", ccsText, "", CCGetRequestParam("Alt_nom_test", ccsGet, NULL), $this);
        $this->Alt_codigo_fonasa = new clsControl(ccsLabel, "Alt_codigo_fonasa", "Alt_codigo_fonasa", ccsText, "", CCGetRequestParam("Alt_codigo_fonasa", ccsGet, NULL), $this);
        $this->Alt_nom_seccion = new clsControl(ccsLabel, "Alt_nom_seccion", "Alt_nom_seccion", ccsText, "", CCGetRequestParam("Alt_nom_seccion", ccsGet, NULL), $this);
        $this->Alt_nom_equipo = new clsControl(ccsLabel, "Alt_nom_equipo", "Alt_nom_equipo", ccsText, "", CCGetRequestParam("Alt_nom_equipo", ccsGet, NULL), $this);
        $this->Sorter_cod_test = new clsSorter($this->ComponentName, "Sorter_cod_test", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->Sorter_codigo_fonasa = new clsSorter($this->ComponentName, "Sorter_codigo_fonasa", $FileName, $this);
        $this->Sorter_nom_seccion = new clsSorter($this->ComponentName, "Sorter_nom_seccion", $FileName, $this);
        $this->Sorter_nom_equipo = new clsSorter($this->ComponentName, "Sorter_nom_equipo", $FileName, $this);
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

//Show Method @2-AB3267EE
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_test"] = CCGetFromGet("s_test", NULL);
        $this->DataSource->Parameters["urls_secciones_id"] = CCGetFromGet("s_secciones_id", NULL);
        $this->DataSource->Parameters["urlseccion_id"] = CCGetFromGet("seccion_id", NULL);
        $this->DataSource->Parameters["urls_test_equipo_id"] = CCGetFromGet("s_test_equipo_id", NULL);

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
            $this->ControlsVisible["lblOp"] = $this->lblOp->Visible;
            $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
            $this->ControlsVisible["test_id"] = $this->test_id->Visible;
            $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
            $this->ControlsVisible["codigo_fonasa"] = $this->codigo_fonasa->Visible;
            $this->ControlsVisible["nom_seccion"] = $this->nom_seccion->Visible;
            $this->ControlsVisible["nom_equipo"] = $this->nom_equipo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                    $this->test_id->SetValue($this->DataSource->test_id->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                    $this->nom_seccion->SetValue($this->DataSource->nom_seccion->GetValue());
                    $this->nom_equipo->SetValue($this->DataSource->nom_equipo->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->lblOp->Show();
                    $this->cod_test->Show();
                    $this->test_id->Show();
                    $this->nom_test->Show();
                    $this->codigo_fonasa->Show();
                    $this->nom_seccion->Show();
                    $this->nom_equipo->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_cod_test->SetValue($this->DataSource->Alt_cod_test->GetValue());
                    $this->Alt_test_id->SetValue($this->DataSource->Alt_test_id->GetValue());
                    $this->Alt_nom_test->SetValue($this->DataSource->Alt_nom_test->GetValue());
                    $this->Alt_codigo_fonasa->SetValue($this->DataSource->Alt_codigo_fonasa->GetValue());
                    $this->Alt_nom_seccion->SetValue($this->DataSource->Alt_nom_seccion->GetValue());
                    $this->Alt_nom_equipo->SetValue($this->DataSource->Alt_nom_equipo->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Alt_lblOp->Show();
                    $this->Alt_cod_test->Show();
                    $this->Alt_test_id->Show();
                    $this->Alt_nom_test->Show();
                    $this->Alt_codigo_fonasa->Show();
                    $this->Alt_nom_seccion->Show();
                    $this->Alt_nom_equipo->Show();
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
        $this->Sorter_cod_test->Show();
        $this->Sorter_nom_test->Show();
        $this->Sorter_codigo_fonasa->Show();
        $this->Sorter_nom_seccion->Show();
        $this->Sorter_nom_equipo->Show();
        $this->Navigator1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-AF84190F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblOp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_seccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_equipo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_lblOp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_seccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_equipo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End test_secciones_equipos Class @2-FCB6E20C

class clstest_secciones_equiposDataSource extends clsDBDatos {  //test_secciones_equiposDataSource Class @2-130151B2

//DataSource Variables @2-163F43D0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $cod_test;
    public $test_id;
    public $nom_test;
    public $codigo_fonasa;
    public $nom_seccion;
    public $nom_equipo;
    public $Alt_cod_test;
    public $Alt_test_id;
    public $Alt_nom_test;
    public $Alt_codigo_fonasa;
    public $Alt_nom_seccion;
    public $Alt_nom_equipo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-16E569FB
    function clstest_secciones_equiposDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid test_secciones_equipos";
        $this->Initialize();
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->test_id = new clsField("test_id", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->nom_seccion = new clsField("nom_seccion", ccsText, "");
        
        $this->nom_equipo = new clsField("nom_equipo", ccsText, "");
        
        $this->Alt_cod_test = new clsField("Alt_cod_test", ccsText, "");
        
        $this->Alt_test_id = new clsField("Alt_test_id", ccsText, "");
        
        $this->Alt_nom_test = new clsField("Alt_nom_test", ccsText, "");
        
        $this->Alt_codigo_fonasa = new clsField("Alt_codigo_fonasa", ccsText, "");
        
        $this->Alt_nom_seccion = new clsField("Alt_nom_seccion", ccsText, "");
        
        $this->Alt_nom_equipo = new clsField("Alt_nom_equipo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-4F2042F3
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_cod_test" => array("cod_test", ""), 
            "Sorter_nom_test" => array("nom_test", ""), 
            "Sorter_codigo_fonasa" => array("codigo_fonasa", ""), 
            "Sorter_nom_seccion" => array("nom_seccion", ""), 
            "Sorter_nom_equipo" => array("nom_equipo", "")));
    }
//End SetOrder Method

//Prepare Method @2-1EBF97C9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_test", ccsText, "", "", $this->Parameters["urls_test"], "", false);
        $this->wp->AddParameter("2", "urls_test", ccsText, "", "", $this->Parameters["urls_test"], "", false);
        $this->wp->AddParameter("3", "urls_test", ccsText, "", "", $this->Parameters["urls_test"], "", false);
        $this->wp->AddParameter("4", "urls_secciones_id", ccsInteger, "", "", $this->Parameters["urls_secciones_id"], "", false);
        $this->wp->AddParameter("5", "urlseccion_id", ccsInteger, "", "", $this->Parameters["urlseccion_id"], "", false);
        $this->wp->AddParameter("6", "urls_test_equipo_id", ccsInteger, "", "", $this->Parameters["urls_test_equipo_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "cod_test", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "nom_test", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "codigo_fonasa", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "secciones_id", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsInteger),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "test.secciones_id", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsInteger),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "test.equipo_id", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opOR(
             true, $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), $this->wp->opOR(
             true, 
             $this->wp->Criterion[4], 
             $this->wp->Criterion[5])), 
             $this->wp->Criterion[6]);
    }
//End Prepare Method

//Open Method @2-2498B598
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (test LEFT JOIN equipos ON\n\n" .
        "test.equipo_id = equipos.equipo_id) LEFT JOIN secciones ON\n\n" .
        "test.secciones_id = secciones.seccion_id";
        $this->SQL = "SELECT test_id, secciones_id, test.equipo_id AS test_equipo_id, codigo_fonasa, cod_test, nom_test, orden_peticion, nom_seccion, secciones.activo AS secciones_activo,\n\n" .
        "nom_equipo, equipos.activo AS equipos_activo \n\n" .
        "FROM (test LEFT JOIN equipos ON\n\n" .
        "test.equipo_id = equipos.equipo_id) LEFT JOIN secciones ON\n\n" .
        "test.secciones_id = secciones.seccion_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-CF6FCD23
    function SetValues()
    {
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->test_id->SetDBValue($this->f("test_id"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->nom_seccion->SetDBValue($this->f("nom_seccion"));
        $this->nom_equipo->SetDBValue($this->f("nom_equipo"));
        $this->Alt_cod_test->SetDBValue($this->f("cod_test"));
        $this->Alt_test_id->SetDBValue($this->f("test_id"));
        $this->Alt_nom_test->SetDBValue($this->f("nom_test"));
        $this->Alt_codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->Alt_nom_seccion->SetDBValue($this->f("nom_seccion"));
        $this->Alt_nom_equipo->SetDBValue($this->f("nom_equipo"));
    }
//End SetValues Method

} //End test_secciones_equiposDataSource Class @2-FCB6E20C

//Initialize Page @1-20C18A29
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
$TemplateFileName = "frmEligeTest.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-090F6010
include_once("./frmEligeTest_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0AF7472B
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$test_secciones_equiposSearch = new clsRecordtest_secciones_equiposSearch("", $MainPage);
$test_secciones_equipos = new clsGridtest_secciones_equipos("", $MainPage);
$MainPage->test_secciones_equiposSearch = & $test_secciones_equiposSearch;
$MainPage->test_secciones_equipos = & $test_secciones_equipos;
$test_secciones_equipos->Initialize();
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

//Execute Components @1-2267C973
$test_secciones_equiposSearch->Operation();
//End Execute Components

//Go to destination page @1-88DE7D0F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($test_secciones_equiposSearch);
    unset($test_secciones_equipos);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-39998404
$test_secciones_equiposSearch->Show();
$test_secciones_equipos->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-CAF6027F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($test_secciones_equiposSearch);
unset($test_secciones_equipos);
unset($Tpl);
//End Unload Page


?>
