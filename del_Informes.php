<?php
//Include Common Files @1-A7453C5A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "del_Informes.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordinforme_datosSearch { //informe_datosSearch Class @13-EBBF47A2

//Variables @13-9E315808

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

//Class_Initialize Event @13-6E96EBAB
    function clsRecordinforme_datosSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record informe_datosSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "informe_datosSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_peticion_id = new clsControl(ccsTextBox, "s_peticion_id", "Nº de petición", ccsInteger, "", CCGetRequestParam("s_peticion_id", $Method, NULL), $this);
            $this->s_peticion_id->Required = true;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @13-36516E36
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_peticion_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_peticion_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @13-D9227DAE
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_peticion_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @13-98F26C3A
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
        $Redirect = "del_Informes.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "del_Informes.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @13-D42CD5DB
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
            $Error = ComposeStrings($Error, $this->s_peticion_id->Errors->ToString());
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

        $this->s_peticion_id->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End informe_datosSearch Class @13-FCB6E20C

class clsGridinforme_datos { //informe_datos class @2-5AF9B16F

//Variables @2-37707FD9

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
    public $Sorter_serie;
    public $Informe;
    public $Sorter_firma_nombre;
//End Variables

//Class_Initialize Event @2-5ECC56CB
    function clsGridinforme_datos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "informe_datos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid informe_datos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinforme_datosDataSource($this);
        $this->ds = & $this->DataSource;
        $this->SorterName = CCGetParam("informe_datosOrder", "");
        $this->SorterDirection = CCGetParam("informe_datosDir", "");

        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "del_Informes.php";
        $this->serie = new clsControl(ccsLabel, "serie", "serie", ccsText, "", CCGetRequestParam("serie", ccsGet, NULL), $this);
        $this->nom_informe = new clsControl(ccsLabel, "nom_informe", "nom_informe", ccsText, "", CCGetRequestParam("nom_informe", ccsGet, NULL), $this);
        $this->firma_nombre = new clsControl(ccsLabel, "firma_nombre", "firma_nombre", ccsText, "", CCGetRequestParam("firma_nombre", ccsGet, NULL), $this);
        $this->s_peticion_id = new clsControl(ccsLink, "s_peticion_id", "s_peticion_id", ccsText, "", CCGetRequestParam("s_peticion_id", ccsGet, NULL), $this);
        $this->s_peticion_id->Parameters = CCAddParam($this->s_peticion_id->Parameters, "peticion_id", CCGetFromGet("s_peticion_id", NULL));
        $this->s_peticion_id->Page = "det_Peticion.php";
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mmm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->rut = new clsControl(ccsLabel, "rut", "rut", ccsText, "", CCGetRequestParam("rut", ccsGet, NULL), $this);
        $this->Sorter_serie = new clsSorter($this->ComponentName, "Sorter_serie", $FileName, $this);
        $this->Informe = new clsSorter($this->ComponentName, "Informe", $FileName, $this);
        $this->Sorter_firma_nombre = new clsSorter($this->ComponentName, "Sorter_firma_nombre", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-2D9BCB37
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_peticion_id"] = CCGetFromGet("s_peticion_id", NULL);

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
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            $this->ControlsVisible["serie"] = $this->serie->Visible;
            $this->ControlsVisible["nom_informe"] = $this->nom_informe->Visible;
            $this->ControlsVisible["firma_nombre"] = $this->firma_nombre->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ImageLink1->Parameters = "";
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "peticion_id", $this->DataSource->f("peticion_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "informe_id", $this->DataSource->f("informe_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "serie", $this->DataSource->f("serie"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "s_peticion_id", CCGetFromGet("s_peticion_id", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "borrar", "si");
                $this->serie->SetValue($this->DataSource->serie->GetValue());
                $this->nom_informe->SetValue($this->DataSource->nom_informe->GetValue());
                $this->firma_nombre->SetValue($this->DataSource->firma_nombre->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ImageLink1->Show();
                $this->serie->Show();
                $this->nom_informe->Show();
                $this->firma_nombre->Show();
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
        $this->fecha->SetValue($this->DataSource->fecha->GetValue());
        $this->nombres->SetValue($this->DataSource->nombres->GetValue());
        $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
        $this->rut->SetValue($this->DataSource->rut->GetValue());
        $this->s_peticion_id->Show();
        $this->fecha->Show();
        $this->nombres->Show();
        $this->apellidos->Show();
        $this->rut->Show();
        $this->Sorter_serie->Show();
        $this->Informe->Show();
        $this->Sorter_firma_nombre->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-752D6279
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->serie->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_informe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->firma_nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End informe_datos Class @2-FCB6E20C

class clsinforme_datosDataSource extends clsDBDatos {  //informe_datosDataSource Class @2-4EAE0447

//DataSource Variables @2-05093AC3
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $fecha;
    public $nombres;
    public $apellidos;
    public $rut;
    public $serie;
    public $nom_informe;
    public $firma_nombre;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-66E9C255
    function clsinforme_datosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid informe_datos";
        $this->Initialize();
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->serie = new clsField("serie", ccsText, "");
        
        $this->nom_informe = new clsField("nom_informe", ccsText, "");
        
        $this->firma_nombre = new clsField("firma_nombre", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-D0F6E5E1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "serie, nom_informe";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_serie" => array("serie", ""), 
            "Informe" => array("nom_informe", ""), 
            "Sorter_firma_nombre" => array("firma_nombre", "")));
    }
//End SetOrder Method

//Prepare Method @2-A2E09059
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_peticion_id", ccsInteger, "", "", $this->Parameters["urls_peticion_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-02797088
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM informe_datos\n" .
        "WHERE peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "";
        $this->SQL = "SELECT DISTINCT serie, peticion_id, informe_id, nombres, apellidos, fecha, firma_nombre, rut, ficha, nom_informe \n" .
        "FROM informe_datos\n" .
        "WHERE peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-77ADA333
    function SetValues()
    {
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->rut->SetDBValue($this->f("rut"));
        $this->serie->SetDBValue($this->f("serie"));
        $this->nom_informe->SetDBValue($this->f("nom_informe"));
        $this->firma_nombre->SetDBValue($this->f("firma_nombre"));
    }
//End SetValues Method

} //End informe_datosDataSource Class @2-FCB6E20C

//Initialize Page @1-4D745AF8
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
$TemplateFileName = "del_Informes.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-C458E9F4
CCSecurityRedirect("17;18;20", "");
//End Authenticate User

//Include events file @1-CE64533F
include_once("./del_Informes_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C81D9CE2
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$informe_datosSearch = new clsRecordinforme_datosSearch("", $MainPage);
$informe_datos = new clsGridinforme_datos("", $MainPage);
$MainPage->informe_datosSearch = & $informe_datosSearch;
$MainPage->informe_datos = & $informe_datos;
$informe_datos->Initialize();
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

//Execute Components @1-15BD3CE2
$informe_datosSearch->Operation();
//End Execute Components

//Go to destination page @1-E6DAC72E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($informe_datosSearch);
    unset($informe_datos);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-25CA0CCA
$informe_datosSearch->Show();
$informe_datos->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A7A369FD
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($informe_datosSearch);
unset($informe_datos);
unset($Tpl);
//End Unload Page


?>
