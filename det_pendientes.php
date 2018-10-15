<?php
//Include Common Files @1-8403D6A9
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "det_pendientes.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridbitacora_estados_usuarios { //bitacora_estados_usuarios class @2-379AE9A3

//Variables @2-20A76A33

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
    public $Sorter_fecha;
    public $Sorter_nom_estado;
    public $Sorter_nom_usuario;
//End Variables

//Class_Initialize Event @2-9F0AF948
    function clsGridbitacora_estados_usuarios($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "bitacora_estados_usuarios";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid bitacora_estados_usuarios";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsbitacora_estados_usuariosDataSource($this);
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
        $this->SorterName = CCGetParam("bitacora_estados_usuariosOrder", "");
        $this->SorterDirection = CCGetParam("bitacora_estados_usuariosDir", "");

        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->descripcion = new clsControl(ccsLabel, "descripcion", "descripcion", ccsMemo, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->nom_estado = new clsControl(ccsLabel, "nom_estado", "nom_estado", ccsText, "", CCGetRequestParam("nom_estado", ccsGet, NULL), $this);
        $this->nom_usuario = new clsControl(ccsLabel, "nom_usuario", "nom_usuario", ccsText, "", CCGetRequestParam("nom_usuario", ccsGet, NULL), $this);
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->bitacora_estados_usuarios_TotalRecords = new clsControl(ccsLabel, "bitacora_estados_usuarios_TotalRecords", "bitacora_estados_usuarios_TotalRecords", ccsText, "", CCGetRequestParam("bitacora_estados_usuarios_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_fecha = new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Sorter_nom_estado = new clsSorter($this->ComponentName, "Sorter_nom_estado", $FileName, $this);
        $this->Sorter_nom_usuario = new clsSorter($this->ComponentName, "Sorter_nom_usuario", $FileName, $this);
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

//Show Method @2-2B53180E
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);
        $this->DataSource->Parameters["expr25"] = 1;

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
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["nom_estado"] = $this->nom_estado->Visible;
            $this->ControlsVisible["nom_usuario"] = $this->nom_usuario->Visible;
            $this->ControlsVisible["Label1"] = $this->Label1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                $this->Label1->SetValue($this->DataSource->Label1->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->fecha->Show();
                $this->descripcion->Show();
                $this->nom_estado->Show();
                $this->nom_usuario->Show();
                $this->Label1->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->peticion_id->Show();
        $this->bitacora_estados_usuarios_TotalRecords->Show();
        $this->Sorter_fecha->Show();
        $this->Sorter_nom_estado->Show();
        $this->Sorter_nom_usuario->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-28DE44ED
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End bitacora_estados_usuarios Class @2-FCB6E20C

class clsbitacora_estados_usuariosDataSource extends clsDBDatos {  //bitacora_estados_usuariosDataSource Class @2-8BCB58D9

//DataSource Variables @2-EB6A5B31
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $fecha;
    public $descripcion;
    public $nom_estado;
    public $nom_usuario;
    public $Label1;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6FDAAD0E
    function clsbitacora_estados_usuariosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid bitacora_estados_usuarios";
        $this->Initialize();
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->descripcion = new clsField("descripcion", ccsMemo, "");
        
        $this->nom_estado = new clsField("nom_estado", ccsText, "");
        
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-83A5A3A2
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_fecha" => array("fecha", ""), 
            "Sorter_nom_estado" => array("nom_estado", ""), 
            "Sorter_nom_usuario" => array("nom_usuario", "")));
    }
//End SetOrder Method

//Prepare Method @2-F54E7CEC
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
        $this->wp->AddParameter("2", "expr25", ccsInteger, "", "", $this->Parameters["expr25"], 1, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "bitacora.peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "bitacora.tipo_bitacora_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-98B308DE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (bitacora LEFT JOIN estados ON\n\n" .
        "bitacora.estado_id = estados.estado_id) LEFT JOIN usuarios ON\n\n" .
        "bitacora.usuario_id = usuarios.usuario_id";
        $this->SQL = "SELECT bitacora.*, nom_estado, nom_usuario \n\n" .
        "FROM (bitacora LEFT JOIN estados ON\n\n" .
        "bitacora.estado_id = estados.estado_id) LEFT JOIN usuarios ON\n\n" .
        "bitacora.usuario_id = usuarios.usuario_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C60A741C
    function SetValues()
    {
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->nom_estado->SetDBValue($this->f("nom_estado"));
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
        $this->Label1->SetDBValue($this->f("tipo_bitacora_id"));
    }
//End SetValues Method

} //End bitacora_estados_usuariosDataSource Class @2-FCB6E20C

//Initialize Page @1-0725AD76
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
$TemplateFileName = "det_pendientes.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-EAC17683
include_once("./det_pendientes_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-22795B14
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$bitacora_estados_usuarios = new clsGridbitacora_estados_usuarios("", $MainPage);
$MainPage->bitacora_estados_usuarios = & $bitacora_estados_usuarios;
$bitacora_estados_usuarios->Initialize();
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

//Go to destination page @1-229C2CEA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($bitacora_estados_usuarios);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4CB84CBA
$bitacora_estados_usuarios->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-AD563934
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($bitacora_estados_usuarios);
unset($Tpl);
//End Unload Page


?>
