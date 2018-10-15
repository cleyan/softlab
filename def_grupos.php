<?php
//Include Common Files @1-E5EBDA2E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "def_grupos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordgruposSearch { //gruposSearch Class @3-04C34E10

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

//Class_Initialize Event @3-3A3B84CC
    function clsRecordgruposSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record gruposSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "gruposSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_informe_id = new clsControl(ccsListBox, "s_informe_id", "s_informe_id", ccsInteger, "", CCGetRequestParam("s_informe_id", $Method, NULL), $this);
            $this->s_informe_id->DSType = dsTable;
            $this->s_informe_id->DataSource = new clsDBDatos();
            $this->s_informe_id->ds = & $this->s_informe_id->DataSource;
            $this->s_informe_id->DataSource->SQL = "SELECT * \n" .
"FROM informes {SQL_Where} {SQL_OrderBy}";
            $this->s_informe_id->DataSource->Order = "nom_informe";
            list($this->s_informe_id->BoundColumn, $this->s_informe_id->TextColumn, $this->s_informe_id->DBFormat) = array("informe_id", "nom_informe", "");
            $this->s_informe_id->DataSource->Order = "nom_informe";
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-BFDE77C3
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_informe_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_informe_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-5EC5406A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_informe_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-0735D59A
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
        $Redirect = "def_grupos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "def_grupos.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_informe_id", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-CBD77B2E
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

        $this->s_informe_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_informe_id->Errors->ToString());
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

        $this->s_informe_id->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End gruposSearch Class @3-FCB6E20C

class clsGridgrupos { //grupos class @2-B01B0AE9

//Variables @2-DBE94943

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
    public $Sorter_nom_grupo;
//End Variables

//Class_Initialize Event @2-30BF5E74
    function clsGridgrupos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "grupos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid grupos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsgruposDataSource($this);
        $this->ds = & $this->DataSource;
        $this->SorterName = CCGetParam("gruposOrder", "");
        $this->SorterDirection = CCGetParam("gruposDir", "");

        $this->Link1 = new clsControl(ccsImageLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "def_detalle_grupos.php";
        $this->Detail = new clsControl(ccsImageLink, "Detail", "Detail", ccsText, "", CCGetRequestParam("Detail", ccsGet, NULL), $this);
        $this->Detail->Page = "def_grupos.php";
        $this->nom_grupo = new clsControl(ccsLabel, "nom_grupo", "nom_grupo", ccsText, "", CCGetRequestParam("nom_grupo", ccsGet, NULL), $this);
        $this->imprimir = new clsControl(ccsLabel, "imprimir", "imprimir", ccsBoolean, array("Sí", "No", ""), CCGetRequestParam("imprimir", ccsGet, NULL), $this);
        $this->alineacion = new clsControl(ccsLabel, "alineacion", "alineacion", ccsInteger, "", CCGetRequestParam("alineacion", ccsGet, NULL), $this);
        $this->nom_grupo_modelo = new clsControl(ccsLabel, "nom_grupo_modelo", "nom_grupo_modelo", ccsText, "", CCGetRequestParam("nom_grupo_modelo", ccsGet, NULL), $this);
        $this->orden = new clsControl(ccsLabel, "orden", "orden", ccsInteger, "", CCGetRequestParam("orden", ccsGet, NULL), $this);
        $this->imgsube = new clsControl(ccsImageLink, "imgsube", "imgsube", ccsText, "", CCGetRequestParam("imgsube", ccsGet, NULL), $this);
        $this->imgsube->HTML = true;
        $this->imgsube->Page = "def_grupos.php";
        $this->img_baja = new clsControl(ccsImageLink, "img_baja", "img_baja", ccsText, "", CCGetRequestParam("img_baja", ccsGet, NULL), $this);
        $this->img_baja->HTML = true;
        $this->img_baja->Page = "def_grupos.php";
        $this->grupos_TotalRecords = new clsControl(ccsLabel, "grupos_TotalRecords", "grupos_TotalRecords", ccsText, "", CCGetRequestParam("grupos_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_nom_grupo = new clsSorter($this->ComponentName, "Sorter_nom_grupo", $FileName, $this);
        $this->grupos_Insert = new clsControl(ccsImageLink, "grupos_Insert", "grupos_Insert", ccsText, "", CCGetRequestParam("grupos_Insert", ccsGet, NULL), $this);
        $this->grupos_Insert->Page = "def_grupos.php";
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Page = "def_informe.php";
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-34A489AB
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_informe_id"] = CCGetFromGet("s_informe_id", NULL);

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
            $this->ControlsVisible["Detail"] = $this->Detail->Visible;
            $this->ControlsVisible["nom_grupo"] = $this->nom_grupo->Visible;
            $this->ControlsVisible["imprimir"] = $this->imprimir->Visible;
            $this->ControlsVisible["alineacion"] = $this->alineacion->Visible;
            $this->ControlsVisible["nom_grupo_modelo"] = $this->nom_grupo_modelo->Visible;
            $this->ControlsVisible["orden"] = $this->orden->Visible;
            $this->ControlsVisible["imgsube"] = $this->imgsube->Visible;
            $this->ControlsVisible["img_baja"] = $this->img_baja->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Link1->Parameters = CCGetQueryString("QueryString", array("orden_informe_id", "accion", "orden_grupo_id", "ccsForm"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "grupo_id", $this->DataSource->f("grupo_id"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "informe_id", $this->DataSource->f("informe_id"));
                $this->Detail->Parameters = CCGetQueryString("QueryString", array("orden_informe_id", "accion", "orden_grupo_id", "ccsForm"));
                $this->Detail->Parameters = CCAddParam($this->Detail->Parameters, "grupo_id", $this->DataSource->f("grupo_id"));
                $this->nom_grupo->SetValue($this->DataSource->nom_grupo->GetValue());
                $this->imprimir->SetValue($this->DataSource->imprimir->GetValue());
                $this->alineacion->SetValue($this->DataSource->alineacion->GetValue());
                $this->nom_grupo_modelo->SetValue($this->DataSource->nom_grupo_modelo->GetValue());
                $this->orden->SetValue($this->DataSource->orden->GetValue());
                $this->imgsube->Parameters = CCGetQueryString("QueryString", array("orden_informe_id", "accion", "orden_grupo_id", "ccsForm"));
                $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "orden_informe_id", $this->DataSource->f("informe_id"));
                $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "accion", "subir");
                $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "orden_grupo_id", $this->DataSource->f("grupo_id"));
                $this->img_baja->Parameters = CCGetQueryString("QueryString", array("orden_informe_id", "accion", "orden_grupo_id", "ccsForm"));
                $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "orden_informe_id", $this->DataSource->f("informe_id"));
                $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "accion", "bajar");
                $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "orden_grupo_id", $this->DataSource->f("grupo_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Link1->Show();
                $this->Detail->Show();
                $this->nom_grupo->Show();
                $this->imprimir->Show();
                $this->alineacion->Show();
                $this->nom_grupo_modelo->Show();
                $this->orden->Show();
                $this->imgsube->Show();
                $this->img_baja->Show();
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
        $this->grupos_Insert->Parameters = CCGetQueryString("QueryString", array("grupo_id", "orden_informe_id", "accion", "orden_grupo_id", "nuevo", "ccsForm"));
        $this->grupos_Insert->Parameters = CCAddParam($this->grupos_Insert->Parameters, "nuevo", "si");
        $this->grupos_TotalRecords->Show();
        $this->Sorter_nom_grupo->Show();
        $this->grupos_Insert->Show();
        $this->ImageLink1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-A7650981
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Detail->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_grupo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imprimir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alineacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_grupo_modelo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->orden->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgsube->Errors->ToString());
        $errors = ComposeStrings($errors, $this->img_baja->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End grupos Class @2-FCB6E20C

class clsgruposDataSource extends clsDBDatos {  //gruposDataSource Class @2-4198F052

//DataSource Variables @2-2710B1EF
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $nom_grupo;
    public $imprimir;
    public $alineacion;
    public $nom_grupo_modelo;
    public $orden;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D3736C2C
    function clsgruposDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid grupos";
        $this->Initialize();
        $this->nom_grupo = new clsField("nom_grupo", ccsText, "");
        
        $this->imprimir = new clsField("imprimir", ccsBoolean, $this->BooleanFormat);
        
        $this->alineacion = new clsField("alineacion", ccsInteger, "");
        
        $this->nom_grupo_modelo = new clsField("nom_grupo_modelo", ccsText, "");
        
        $this->orden = new clsField("orden", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B83EAB08
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "grupos.informe_id, orden, grupo_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_nom_grupo" => array("nom_grupo", "")));
    }
//End SetOrder Method

//Prepare Method @2-B1685306
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_informe_id", ccsInteger, "", "", $this->Parameters["urls_informe_id"], 0, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "grupos.informe_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-724B2F27
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (grupos LEFT JOIN grupos_modelo ON\n\n" .
        "grupos.alineacion = grupos_modelo.grupo_modelo_id) LEFT JOIN informes ON\n\n" .
        "grupos.informe_id = informes.informe_id";
        $this->SQL = "SELECT grupos.*, nom_grupo_modelo, nom_informe \n\n" .
        "FROM (grupos LEFT JOIN grupos_modelo ON\n\n" .
        "grupos.alineacion = grupos_modelo.grupo_modelo_id) LEFT JOIN informes ON\n\n" .
        "grupos.informe_id = informes.informe_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-DA922E82
    function SetValues()
    {
        $this->nom_grupo->SetDBValue($this->f("nom_grupo"));
        $this->imprimir->SetDBValue(trim($this->f("imprimir")));
        $this->alineacion->SetDBValue(trim($this->f("alineacion")));
        $this->nom_grupo_modelo->SetDBValue($this->f("nom_grupo_modelo"));
        $this->orden->SetDBValue(trim($this->f("orden")));
    }
//End SetValues Method

} //End gruposDataSource Class @2-FCB6E20C

class clsRecordgrupos1 { //grupos1 Class @26-117C3A8F

//Variables @26-9E315808

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

//Class_Initialize Event @26-E57E5050
    function clsRecordgrupos1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record grupos1/Error";
        $this->DataSource = new clsgrupos1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "grupos1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->informe_id = new clsControl(ccsListBox, "informe_id", "Informe Id", ccsInteger, "", CCGetRequestParam("informe_id", $Method, NULL), $this);
            $this->informe_id->DSType = dsTable;
            $this->informe_id->DataSource = new clsDBDatos();
            $this->informe_id->ds = & $this->informe_id->DataSource;
            $this->informe_id->DataSource->SQL = "SELECT * \n" .
"FROM informes {SQL_Where} {SQL_OrderBy}";
            $this->informe_id->DataSource->Order = "nom_informe";
            list($this->informe_id->BoundColumn, $this->informe_id->TextColumn, $this->informe_id->DBFormat) = array("informe_id", "nom_informe", "");
            $this->informe_id->DataSource->Order = "nom_informe";
            $this->nom_grupo = new clsControl(ccsTextBox, "nom_grupo", "Nom Grupo", ccsText, "", CCGetRequestParam("nom_grupo", $Method, NULL), $this);
            $this->nom_grupo->Required = true;
            $this->imprimir = new clsControl(ccsCheckBox, "imprimir", "imprimir", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("imprimir", $Method, NULL), $this);
            $this->imprimir->CheckedValue = true;
            $this->imprimir->UncheckedValue = false;
            $this->titulo = new clsControl(ccsTextBox, "titulo", "titulo", ccsText, "", CCGetRequestParam("titulo", $Method, NULL), $this);
            $this->alineacion = new clsControl(ccsListBox, "alineacion", "alineacion", ccsInteger, "", CCGetRequestParam("alineacion", $Method, NULL), $this);
            $this->alineacion->DSType = dsTable;
            $this->alineacion->DataSource = new clsDBDatos();
            $this->alineacion->ds = & $this->alineacion->DataSource;
            $this->alineacion->DataSource->SQL = "SELECT * \n" .
"FROM grupos_modelo {SQL_Where} {SQL_OrderBy}";
            $this->alineacion->DataSource->Order = "ORDEN";
            list($this->alineacion->BoundColumn, $this->alineacion->TextColumn, $this->alineacion->DBFormat) = array("grupo_modelo_id", "nom_grupo_modelo", "");
            $this->alineacion->DataSource->Order = "ORDEN";
            $this->alineacion->Required = true;
            $this->titulo_alineacion = new clsControl(ccsRadioButton, "titulo_alineacion", "titulo_alineacion", ccsText, "", CCGetRequestParam("titulo_alineacion", $Method, NULL), $this);
            $this->titulo_alineacion->DSType = dsListOfValues;
            $this->titulo_alineacion->Values = array(array("0", "Izquierda"), array("1", "Derecha"), array("2", "Centrado"));
            $this->titulo_alineacion->HTML = true;
            $this->titulo_alineacion->Required = true;
            $this->CheckBox1 = new clsControl(ccsCheckBox, "CheckBox1", "CheckBox1", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("CheckBox1", $Method, NULL), $this);
            $this->CheckBox1->CheckedValue = true;
            $this->CheckBox1->UncheckedValue = false;
            $this->CheckBox2 = new clsControl(ccsCheckBox, "CheckBox2", "CheckBox2", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("CheckBox2", $Method, NULL), $this);
            $this->CheckBox2->CheckedValue = true;
            $this->CheckBox2->UncheckedValue = false;
            $this->pie = new clsControl(ccsTextBox, "pie", "pie", ccsText, "", CCGetRequestParam("pie", $Method, NULL), $this);
            $this->orden = new clsControl(ccsTextBox, "orden", "orden", ccsInteger, "", CCGetRequestParam("orden", $Method, NULL), $this);
            $this->orden->Required = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->informe_id->Value) && !strlen($this->informe_id->Value) && $this->informe_id->Value !== false)
                    $this->informe_id->SetText(CCGetParam('s_informe_id',''));
                if(!is_array($this->imprimir->Value) && !strlen($this->imprimir->Value) && $this->imprimir->Value !== false)
                    $this->imprimir->SetValue(false);
                if(!is_array($this->CheckBox1->Value) && !strlen($this->CheckBox1->Value) && $this->CheckBox1->Value !== false)
                    $this->CheckBox1->SetValue(false);
                if(!is_array($this->CheckBox2->Value) && !strlen($this->CheckBox2->Value) && $this->CheckBox2->Value !== false)
                    $this->CheckBox2->SetValue(false);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @26-036EC8C4
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlgrupo_id"] = CCGetFromGet("grupo_id", NULL);
    }
//End Initialize Method

//Validate Method @26-345295BC
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->informe_id->Validate() && $Validation);
        $Validation = ($this->nom_grupo->Validate() && $Validation);
        $Validation = ($this->imprimir->Validate() && $Validation);
        $Validation = ($this->titulo->Validate() && $Validation);
        $Validation = ($this->alineacion->Validate() && $Validation);
        $Validation = ($this->titulo_alineacion->Validate() && $Validation);
        $Validation = ($this->CheckBox1->Validate() && $Validation);
        $Validation = ($this->CheckBox2->Validate() && $Validation);
        $Validation = ($this->pie->Validate() && $Validation);
        $Validation = ($this->orden->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->informe_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_grupo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->imprimir->Errors->Count() == 0);
        $Validation =  $Validation && ($this->titulo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->alineacion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->titulo_alineacion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CheckBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CheckBox2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pie->Errors->Count() == 0);
        $Validation =  $Validation && ($this->orden->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @26-E060632B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->informe_id->Errors->Count());
        $errors = ($errors || $this->nom_grupo->Errors->Count());
        $errors = ($errors || $this->imprimir->Errors->Count());
        $errors = ($errors || $this->titulo->Errors->Count());
        $errors = ($errors || $this->alineacion->Errors->Count());
        $errors = ($errors || $this->titulo_alineacion->Errors->Count());
        $errors = ($errors || $this->CheckBox1->Errors->Count());
        $errors = ($errors || $this->CheckBox2->Errors->Count());
        $errors = ($errors || $this->pie->Errors->Count());
        $errors = ($errors || $this->orden->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @26-D34139FA
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = "def_grupos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "grupo_id"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "def_grupos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "grupo_id"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//InsertRow Method @26-977480F4
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->informe_id->SetValue($this->informe_id->GetValue(true));
        $this->DataSource->nom_grupo->SetValue($this->nom_grupo->GetValue(true));
        $this->DataSource->imprimir->SetValue($this->imprimir->GetValue(true));
        $this->DataSource->titulo->SetValue($this->titulo->GetValue(true));
        $this->DataSource->alineacion->SetValue($this->alineacion->GetValue(true));
        $this->DataSource->titulo_alineacion->SetValue($this->titulo_alineacion->GetValue(true));
        $this->DataSource->CheckBox1->SetValue($this->CheckBox1->GetValue(true));
        $this->DataSource->CheckBox2->SetValue($this->CheckBox2->GetValue(true));
        $this->DataSource->pie->SetValue($this->pie->GetValue(true));
        $this->DataSource->orden->SetValue($this->orden->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @26-C7CD6567
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->informe_id->SetValue($this->informe_id->GetValue(true));
        $this->DataSource->nom_grupo->SetValue($this->nom_grupo->GetValue(true));
        $this->DataSource->imprimir->SetValue($this->imprimir->GetValue(true));
        $this->DataSource->titulo->SetValue($this->titulo->GetValue(true));
        $this->DataSource->alineacion->SetValue($this->alineacion->GetValue(true));
        $this->DataSource->titulo_alineacion->SetValue($this->titulo_alineacion->GetValue(true));
        $this->DataSource->CheckBox1->SetValue($this->CheckBox1->GetValue(true));
        $this->DataSource->CheckBox2->SetValue($this->CheckBox2->GetValue(true));
        $this->DataSource->pie->SetValue($this->pie->GetValue(true));
        $this->DataSource->orden->SetValue($this->orden->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @26-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @26-D7ED6285
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

        $this->informe_id->Prepare();
        $this->alineacion->Prepare();
        $this->titulo_alineacion->Prepare();

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
                    $this->informe_id->SetValue($this->DataSource->informe_id->GetValue());
                    $this->nom_grupo->SetValue($this->DataSource->nom_grupo->GetValue());
                    $this->imprimir->SetValue($this->DataSource->imprimir->GetValue());
                    $this->titulo->SetValue($this->DataSource->titulo->GetValue());
                    $this->alineacion->SetValue($this->DataSource->alineacion->GetValue());
                    $this->titulo_alineacion->SetValue($this->DataSource->titulo_alineacion->GetValue());
                    $this->CheckBox1->SetValue($this->DataSource->CheckBox1->GetValue());
                    $this->CheckBox2->SetValue($this->DataSource->CheckBox2->GetValue());
                    $this->pie->SetValue($this->DataSource->pie->GetValue());
                    $this->orden->SetValue($this->DataSource->orden->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->informe_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_grupo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->imprimir->Errors->ToString());
            $Error = ComposeStrings($Error, $this->titulo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->alineacion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->titulo_alineacion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CheckBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CheckBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pie->Errors->ToString());
            $Error = ComposeStrings($Error, $this->orden->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->informe_id->Show();
        $this->nom_grupo->Show();
        $this->imprimir->Show();
        $this->titulo->Show();
        $this->alineacion->Show();
        $this->titulo_alineacion->Show();
        $this->CheckBox1->Show();
        $this->CheckBox2->Show();
        $this->pie->Show();
        $this->orden->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End grupos1 Class @26-FCB6E20C

class clsgrupos1DataSource extends clsDBDatos {  //grupos1DataSource Class @26-D810FFBF

//DataSource Variables @26-17B6A12A
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
    public $informe_id;
    public $nom_grupo;
    public $imprimir;
    public $titulo;
    public $alineacion;
    public $titulo_alineacion;
    public $CheckBox1;
    public $CheckBox2;
    public $pie;
    public $orden;
//End DataSource Variables

//DataSourceClass_Initialize Event @26-DD8B7EC9
    function clsgrupos1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record grupos1/Error";
        $this->Initialize();
        $this->informe_id = new clsField("informe_id", ccsInteger, "");
        
        $this->nom_grupo = new clsField("nom_grupo", ccsText, "");
        
        $this->imprimir = new clsField("imprimir", ccsBoolean, $this->BooleanFormat);
        
        $this->titulo = new clsField("titulo", ccsText, "");
        
        $this->alineacion = new clsField("alineacion", ccsInteger, "");
        
        $this->titulo_alineacion = new clsField("titulo_alineacion", ccsText, "");
        
        $this->CheckBox1 = new clsField("CheckBox1", ccsBoolean, $this->BooleanFormat);
        
        $this->CheckBox2 = new clsField("CheckBox2", ccsBoolean, $this->BooleanFormat);
        
        $this->pie = new clsField("pie", ccsText, "");
        
        $this->orden = new clsField("orden", ccsInteger, "");
        

        $this->InsertFields["informe_id"] = array("Name" => "informe_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_grupo"] = array("Name" => "nom_grupo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["imprimir"] = array("Name" => "imprimir", "Value" => "", "DataType" => ccsBoolean);
        $this->InsertFields["titulo"] = array("Name" => "titulo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["alineacion"] = array("Name" => "alineacion", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["titulo_alineacion"] = array("Name" => "titulo_alineacion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["linea_bl_antes"] = array("Name" => "linea_bl_antes", "Value" => "", "DataType" => ccsBoolean);
        $this->InsertFields["linea_bl_despues"] = array("Name" => "linea_bl_despues", "Value" => "", "DataType" => ccsBoolean);
        $this->InsertFields["pie"] = array("Name" => "pie", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["orden"] = array("Name" => "orden", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["informe_id"] = array("Name" => "informe_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_grupo"] = array("Name" => "nom_grupo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["imprimir"] = array("Name" => "imprimir", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["titulo"] = array("Name" => "titulo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["alineacion"] = array("Name" => "alineacion", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["titulo_alineacion"] = array("Name" => "titulo_alineacion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["linea_bl_antes"] = array("Name" => "linea_bl_antes", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["linea_bl_despues"] = array("Name" => "linea_bl_despues", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["pie"] = array("Name" => "pie", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["orden"] = array("Name" => "orden", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @26-232BA4FC
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgrupo_id", ccsInteger, "", "", $this->Parameters["urlgrupo_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "grupo_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @26-1E8DE7F8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM grupos {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @26-8E80EA31
    function SetValues()
    {
        $this->informe_id->SetDBValue(trim($this->f("informe_id")));
        $this->nom_grupo->SetDBValue($this->f("nom_grupo"));
        $this->imprimir->SetDBValue(trim($this->f("imprimir")));
        $this->titulo->SetDBValue($this->f("titulo"));
        $this->alineacion->SetDBValue(trim($this->f("alineacion")));
        $this->titulo_alineacion->SetDBValue($this->f("titulo_alineacion"));
        $this->CheckBox1->SetDBValue(trim($this->f("linea_bl_antes")));
        $this->CheckBox2->SetDBValue(trim($this->f("linea_bl_despues")));
        $this->pie->SetDBValue($this->f("pie"));
        $this->orden->SetDBValue(trim($this->f("orden")));
    }
//End SetValues Method

//Insert Method @26-F0B91A4F
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["informe_id"]["Value"] = $this->informe_id->GetDBValue(true);
        $this->InsertFields["nom_grupo"]["Value"] = $this->nom_grupo->GetDBValue(true);
        $this->InsertFields["imprimir"]["Value"] = $this->imprimir->GetDBValue(true);
        $this->InsertFields["titulo"]["Value"] = $this->titulo->GetDBValue(true);
        $this->InsertFields["alineacion"]["Value"] = $this->alineacion->GetDBValue(true);
        $this->InsertFields["titulo_alineacion"]["Value"] = $this->titulo_alineacion->GetDBValue(true);
        $this->InsertFields["linea_bl_antes"]["Value"] = $this->CheckBox1->GetDBValue(true);
        $this->InsertFields["linea_bl_despues"]["Value"] = $this->CheckBox2->GetDBValue(true);
        $this->InsertFields["pie"]["Value"] = $this->pie->GetDBValue(true);
        $this->InsertFields["orden"]["Value"] = $this->orden->GetDBValue(true);
        $this->SQL = CCBuildInsert("grupos", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @26-7292B5BC
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["informe_id"]["Value"] = $this->informe_id->GetDBValue(true);
        $this->UpdateFields["nom_grupo"]["Value"] = $this->nom_grupo->GetDBValue(true);
        $this->UpdateFields["imprimir"]["Value"] = $this->imprimir->GetDBValue(true);
        $this->UpdateFields["titulo"]["Value"] = $this->titulo->GetDBValue(true);
        $this->UpdateFields["alineacion"]["Value"] = $this->alineacion->GetDBValue(true);
        $this->UpdateFields["titulo_alineacion"]["Value"] = $this->titulo_alineacion->GetDBValue(true);
        $this->UpdateFields["linea_bl_antes"]["Value"] = $this->CheckBox1->GetDBValue(true);
        $this->UpdateFields["linea_bl_despues"]["Value"] = $this->CheckBox2->GetDBValue(true);
        $this->UpdateFields["pie"]["Value"] = $this->pie->GetDBValue(true);
        $this->UpdateFields["orden"]["Value"] = $this->orden->GetDBValue(true);
        $this->SQL = CCBuildUpdate("grupos", $this->UpdateFields, $this);
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

//Delete Method @26-7450B843
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM grupos";
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

} //End grupos1DataSource Class @26-FCB6E20C

//Initialize Page @1-C266F486
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
$TemplateFileName = "def_grupos.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-AA54A103
CCSecurityRedirect("15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-C278A8CF
include_once("./def_grupos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-CDDAC39F
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$gruposSearch = new clsRecordgruposSearch("", $MainPage);
$grupos = new clsGridgrupos("", $MainPage);
$grupos1 = new clsRecordgrupos1("", $MainPage);
$MainPage->gruposSearch = & $gruposSearch;
$MainPage->grupos = & $grupos;
$MainPage->grupos1 = & $grupos1;
$grupos->Initialize();
$grupos1->Initialize();
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

//Execute Components @1-BCB32D11
$grupos1->Operation();
$gruposSearch->Operation();
//End Execute Components

//Go to destination page @1-16716CBE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($gruposSearch);
    unset($grupos);
    unset($grupos1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B26DEEAD
$gruposSearch->Show();
$grupos->Show();
$grupos1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-7ECA8E9C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($gruposSearch);
unset($grupos);
unset($grupos1);
unset($Tpl);
//End Unload Page

?>