<?php
//Include Common Files @1-4EB07AE8
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "stat_numerotest.php");
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

//Class_Initialize Event @11-2C9F9B7B
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
            $this->s_procedencia_id->DataSource->Parameters["expr125"] = GetUserProcedenciaID();
            $this->s_procedencia_id->DataSource->wp = new clsSQLParameters();
            $this->s_procedencia_id->DataSource->wp->AddParameter("1", "expr125", ccsInteger, "", "", $this->s_procedencia_id->DataSource->Parameters["expr125"], "", false);
            $this->s_procedencia_id->DataSource->wp->Criterion[1] = $this->s_procedencia_id->DataSource->wp->Operation(opEqual, "procedencia_id", $this->s_procedencia_id->DataSource->wp->GetDBValue("1"), $this->s_procedencia_id->DataSource->ToSQL($this->s_procedencia_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->s_procedencia_id->DataSource->wp->Criterion[2] = "( " . CCGetGroupID() . " > 4 )";
            $this->s_procedencia_id->DataSource->Where = $this->s_procedencia_id->DataSource->wp->opOR(
                 false, 
                 $this->s_procedencia_id->DataSource->wp->Criterion[1], 
                 $this->s_procedencia_id->DataSource->wp->Criterion[2]);
            $this->s_procedencia_id->DataSource->Order = "nom_procedencia";
            $this->s_equipo_id = new clsControl(ccsListBox, "s_equipo_id", "s_equipo_id", ccsInteger, "", CCGetRequestParam("s_equipo_id", $Method, NULL), $this);
            $this->s_equipo_id->DSType = dsTable;
            $this->s_equipo_id->DataSource = new clsDBDatos();
            $this->s_equipo_id->ds = & $this->s_equipo_id->DataSource;
            $this->s_equipo_id->DataSource->SQL = "SELECT * \n" .
"FROM equipos {SQL_Where} {SQL_OrderBy}";
            list($this->s_equipo_id->BoundColumn, $this->s_equipo_id->TextColumn, $this->s_equipo_id->DBFormat) = array("equipo_id", "nom_equipo", "");
            $this->s_fecha_ini = new clsControl(ccsTextBox, "s_fecha_ini", "Fecha Inicial", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_ini", $Method, NULL), $this);
            $this->s_fecha_ini->Required = true;
            $this->s_fecha_fin = new clsControl(ccsTextBox, "s_fecha_fin", "Fecha Final", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_fin", $Method, NULL), $this);
            $this->s_fecha_fin->Required = true;
            $this->s_decompuesto = new clsControl(ccsListBox, "s_decompuesto", "Tipo de Informe", ccsText, "", CCGetRequestParam("s_decompuesto", $Method, NULL), $this);
            $this->s_decompuesto->DSType = dsListOfValues;
            $this->s_decompuesto->Values = array(array("V", "Sólo los pedidos en un Compuesto"), array("F", "Sólo Los pedidos Aislados"));
            $this->s_decompuesto->HTML = true;
            $this->s_decompuesto->Required = true;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->s_procedencia_id->Value) && !strlen($this->s_procedencia_id->Value) && $this->s_procedencia_id->Value !== false)
                    $this->s_procedencia_id->SetText(GetUserProcedenciaID());
            }
        }
    }
//End Class_Initialize Event

//Validate Method @11-6BD3804A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_procedencia_id->Validate() && $Validation);
        $Validation = ($this->s_equipo_id->Validate() && $Validation);
        $Validation = ($this->s_fecha_ini->Validate() && $Validation);
        $Validation = ($this->s_fecha_fin->Validate() && $Validation);
        $Validation = ($this->s_decompuesto->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_equipo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_ini->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_fin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_decompuesto->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @11-6B3EB486
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_procedencia_id->Errors->Count());
        $errors = ($errors || $this->s_equipo_id->Errors->Count());
        $errors = ($errors || $this->s_fecha_ini->Errors->Count());
        $errors = ($errors || $this->s_fecha_fin->Errors->Count());
        $errors = ($errors || $this->s_decompuesto->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @11-9ABD4B56
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
        $Redirect = "stat_numerotest.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "stat_numerotest.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @11-05608A9A
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
        $this->s_equipo_id->Prepare();
        $this->s_decompuesto->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_equipo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_ini->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_fin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_decompuesto->Errors->ToString());
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
        $this->s_equipo_id->Show();
        $this->s_fecha_ini->Show();
        $this->s_fecha_fin->Show();
        $this->s_decompuesto->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End peticiones_previsiones_prSearch Class @11-FCB6E20C

class clsGridpeticiones_previsiones_pr { //peticiones_previsiones_pr class @2-61F9B3F6

//Variables @2-6E51DF5A

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
//End Variables

//Class_Initialize Event @2-91B0B0BE
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

        $this->codigo_fonasa = new clsControl(ccsLabel, "codigo_fonasa", "codigo_fonasa", ccsText, "", CCGetRequestParam("codigo_fonasa", ccsGet, NULL), $this);
        $this->cod_test = new clsControl(ccsLabel, "cod_test", "cod_test", ccsText, "", CCGetRequestParam("cod_test", ccsGet, NULL), $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $this);
        $this->qty = new clsControl(ccsLabel, "qty", "qty", ccsInteger, "", CCGetRequestParam("qty", ccsGet, NULL), $this);
        $this->s_fecha_ini = new clsControl(ccsLabel, "s_fecha_ini", "s_fecha_ini", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_ini", ccsGet, NULL), $this);
        $this->s_fecha_fin = new clsControl(ccsLabel, "s_fecha_fin", "s_fecha_fin", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_fin", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-2AFB7955
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_fecha_ini"] = CCGetFromGet("s_fecha_ini", NULL);
        $this->DataSource->Parameters["urls_fecha_fin"] = CCGetFromGet("s_fecha_fin", NULL);
        $this->DataSource->Parameters["urls_procedencia_id"] = CCGetFromGet("s_procedencia_id", NULL);
        $this->DataSource->Parameters["urls_equipo_id"] = CCGetFromGet("s_equipo_id", NULL);
        $this->DataSource->Parameters["urls_decompuesto"] = CCGetFromGet("s_decompuesto", NULL);

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
            $this->ControlsVisible["codigo_fonasa"] = $this->codigo_fonasa->Visible;
            $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
            $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
            $this->ControlsVisible["qty"] = $this->qty->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                $this->qty->SetValue($this->DataSource->qty->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->codigo_fonasa->Show();
                $this->cod_test->Show();
                $this->nom_test->Show();
                $this->qty->Show();
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
        $this->s_fecha_ini->Show();
        $this->s_fecha_fin->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-F7CF8FF1
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_previsiones_pr Class @2-FCB6E20C

class clspeticiones_previsiones_prDataSource extends clsDBDatos {  //peticiones_previsiones_prDataSource Class @2-815EC6BB

//DataSource Variables @2-99A0BCFF
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $codigo_fonasa;
    public $cod_test;
    public $nom_test;
    public $qty;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-5078EC25
    function clspeticiones_previsiones_prDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_previsiones_pr";
        $this->Initialize();
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->qty = new clsField("qty", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-8D3B08E7
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "  test.cod_test";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-E1D8959C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_fecha_ini", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha_ini"], 4/17/2005, false);
        $this->wp->AddParameter("2", "urls_fecha_fin", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha_fin"], 4/17/2005, false);
        $this->wp->AddParameter("3", "urls_procedencia_id", ccsInteger, "", "", $this->Parameters["urls_procedencia_id"], 0, false);
        $this->wp->AddParameter("4", "urls_equipo_id", ccsInteger, "", "", $this->Parameters["urls_equipo_id"], 0, false);
        $this->wp->AddParameter("5", "urls_decompuesto", ccsText, "", "", $this->Parameters["urls_decompuesto"], "", false);
    }
//End Prepare Method

//Open Method @2-B218E15A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT \n" .
        "  test.codigo_fonasa,\n" .
        "  test.cod_test,\n" .
        "  test.nom_test,\n" .
        "  COUNT(*) AS qty\n" .
        "FROM\n" .
        "peticiones\n" .
        "RIGHT OUTER JOIN peticiones_detalle ON ( peticiones.peticion_id = peticiones_detalle.peticion_id )\n" .
        "LEFT OUTER JOIN test ON ( peticiones_detalle.test_id = test.test_id ) \n" .
        "WHERE\n" .
        "  (test.aislado = 'V') AND \n" .
        "  (peticiones.fecha BETWEEN '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsDate) . "' AND '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsDate) . "') AND \n" .
        "  (peticiones_detalle.decompuesto = '" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . "' or 'X' = '" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . "') AND \n" .
        "  (peticiones.procedencia_id = " . $this->SQLValue($this->wp->GetDBValue("3"), ccsInteger) . " or '0'='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsInteger) . "') AND \n" .
        "  (test.equipo_id=" . $this->SQLValue($this->wp->GetDBValue("4"), ccsInteger) . " or '0' = '" . $this->SQLValue($this->wp->GetDBValue("4"), ccsInteger) . "')\n" .
        "GROUP BY\n" .
        "  test.codigo_fonasa,\n" .
        "  test.cod_test,\n" .
        "  test.nom_test {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-33FBC279
    function SetValues()
    {
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->qty->SetDBValue(trim($this->f("qty")));
    }
//End SetValues Method

} //End peticiones_previsiones_prDataSource Class @2-FCB6E20C

class clsRecordImpresion { //Impresion Class @112-4EF81E21

//Variables @112-9E315808

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

//Class_Initialize Event @112-D0565D3E
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
            $this->s_fecha_ini = new clsControl(ccsHidden, "s_fecha_ini", "Fecha Incial", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_ini", $Method, NULL), $this);
            $this->s_fecha_ini->Required = true;
            $this->s_fecha_fin = new clsControl(ccsHidden, "s_fecha_fin", "Fecha Final", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_fin", $Method, NULL), $this);
            $this->s_fecha_fin->Required = true;
            $this->s_procedencia_id = new clsControl(ccsHidden, "s_procedencia_id", "s_procedencia_id", ccsInteger, "", CCGetRequestParam("s_procedencia_id", $Method, NULL), $this);
            $this->s_equipo_id = new clsControl(ccsHidden, "s_equipo_id", "s_equipo_id", ccsInteger, "", CCGetRequestParam("s_equipo_id", $Method, NULL), $this);
            $this->s_decompuesto = new clsControl(ccsHidden, "s_decompuesto", "s_decompuesto", ccsText, "", CCGetRequestParam("s_decompuesto", $Method, NULL), $this);
            $this->Imprimir = new clsButton("Imprimir", $Method, $this);
            $this->Cancelar = new clsButton("Cancelar", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @112-117C9C05
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_fecha_ini->Validate() && $Validation);
        $Validation = ($this->s_fecha_fin->Validate() && $Validation);
        $Validation = ($this->s_procedencia_id->Validate() && $Validation);
        $Validation = ($this->s_equipo_id->Validate() && $Validation);
        $Validation = ($this->s_decompuesto->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_fecha_ini->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_fin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_equipo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_decompuesto->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @112-FF2503EA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_fecha_ini->Errors->Count());
        $errors = ($errors || $this->s_fecha_fin->Errors->Count());
        $errors = ($errors || $this->s_procedencia_id->Errors->Count());
        $errors = ($errors || $this->s_equipo_id->Errors->Count());
        $errors = ($errors || $this->s_decompuesto->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @112-C185ACA4
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
                if(!CCGetEvent($this->Imprimir->CCSEvents, "OnClick", $this->Imprimir)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @112-D08EDF71
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
            $Error = ComposeStrings($Error, $this->s_fecha_ini->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_fin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_equipo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_decompuesto->Errors->ToString());
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

        $this->s_fecha_ini->Show();
        $this->s_fecha_fin->Show();
        $this->s_procedencia_id->Show();
        $this->s_equipo_id->Show();
        $this->s_decompuesto->Show();
        $this->Imprimir->Show();
        $this->Cancelar->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Impresion Class @112-FCB6E20C

//Include Page implementation @70-3294FEB1
include_once(RelativePath . "/calendar_tag.php");
//End Include Page implementation

//Include Page implementation @141-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Initialize Page @1-AA7A6E72
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
$TemplateFileName = "stat_numerotest.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-76A33665
CCSecurityRedirect("4;5;12;13;14;15;16;17;18;19;20", "");
//End Authenticate User

//Include events file @1-DD62E4DD
include_once("./stat_numerotest_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2DA8F3B6
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
$Header = new clsHeader("", "Header", $MainPage);
$Header->Initialize();
$MainPage->peticiones_previsiones_prSearch = & $peticiones_previsiones_prSearch;
$MainPage->peticiones_previsiones_pr = & $peticiones_previsiones_pr;
$MainPage->Impresion = & $Impresion;
$MainPage->calendar_tag = & $calendar_tag;
$MainPage->Header = & $Header;
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

//Execute Components @1-E7B52F36
$Header->Operations();
$calendar_tag->Operations();
$Impresion->Operation();
$peticiones_previsiones_prSearch->Operation();
//End Execute Components

//Go to destination page @1-352A9E0E
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
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-EFAD53B9
$peticiones_previsiones_prSearch->Show();
$peticiones_previsiones_pr->Show();
$Impresion->Show();
$calendar_tag->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FE8BDB4D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_previsiones_prSearch);
unset($peticiones_previsiones_pr);
unset($Impresion);
$calendar_tag->Class_Terminate();
unset($calendar_tag);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
