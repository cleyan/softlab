<?php
//Include Common Files @1-5911DE46
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "list_pago_peticion.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGriddetalle_pago_bancos_forma { //detalle_pago_bancos_forma class @47-BDF41EE4

//Variables @47-69C1C2CF

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
    public $Sorter_fecha_ingreso;
    public $Sorter_nom_forma_pago;
    public $Sorter_num_cheque_bono;
    public $Sorter_valor;
    public $Sorter_fecha_documento;
    public $Sorter_nom_usuario;
//End Variables

//Class_Initialize Event @47-735C672D
    function clsGriddetalle_pago_bancos_forma($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "detalle_pago_bancos_forma";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid detalle_pago_bancos_forma";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsdetalle_pago_bancos_formaDataSource($this);
        $this->ds = & $this->DataSource;
        $this->SorterName = CCGetParam("detalle_pago_bancos_formaOrder", "");
        $this->SorterDirection = CCGetParam("detalle_pago_bancos_formaDir", "");

        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "add_pago_peticion.php";
        $this->fecha_ingreso = new clsControl(ccsLabel, "fecha_ingreso", "fecha_ingreso", ccsDate, $DefaultDateFormat, CCGetRequestParam("fecha_ingreso", ccsGet, NULL), $this);
        $this->nom_forma_pago = new clsControl(ccsLabel, "nom_forma_pago", "nom_forma_pago", ccsText, "", CCGetRequestParam("nom_forma_pago", ccsGet, NULL), $this);
        $this->nom_banco = new clsControl(ccsLabel, "nom_banco", "nom_banco", ccsText, "", CCGetRequestParam("nom_banco", ccsGet, NULL), $this);
        $this->nom_prevision = new clsControl(ccsLabel, "nom_prevision", "nom_prevision", ccsText, "", CCGetRequestParam("nom_prevision", ccsGet, NULL), $this);
        $this->num_cheque_bono = new clsControl(ccsLabel, "num_cheque_bono", "num_cheque_bono", ccsText, "", CCGetRequestParam("num_cheque_bono", ccsGet, NULL), $this);
        $this->valor = new clsControl(ccsLabel, "valor", "valor", ccsInteger, array(False, 0, Null, "", False, "\$", "", 1, True, ""), CCGetRequestParam("valor", ccsGet, NULL), $this);
        $this->fecha_documento = new clsControl(ccsLabel, "fecha_documento", "fecha_documento", ccsDate, $DefaultDateFormat, CCGetRequestParam("fecha_documento", ccsGet, NULL), $this);
        $this->nom_usuario = new clsControl(ccsLabel, "nom_usuario", "nom_usuario", ccsText, "", CCGetRequestParam("nom_usuario", ccsGet, NULL), $this);
        $this->observacion = new clsControl(ccsLabel, "observacion", "observacion", ccsMemo, "", CCGetRequestParam("observacion", ccsGet, NULL), $this);
        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->Sorter_fecha_ingreso = new clsSorter($this->ComponentName, "Sorter_fecha_ingreso", $FileName, $this);
        $this->Sorter_nom_forma_pago = new clsSorter($this->ComponentName, "Sorter_nom_forma_pago", $FileName, $this);
        $this->Sorter_num_cheque_bono = new clsSorter($this->ComponentName, "Sorter_num_cheque_bono", $FileName, $this);
        $this->Sorter_valor = new clsSorter($this->ComponentName, "Sorter_valor", $FileName, $this);
        $this->Sorter_fecha_documento = new clsSorter($this->ComponentName, "Sorter_fecha_documento", $FileName, $this);
        $this->Sorter_nom_usuario = new clsSorter($this->ComponentName, "Sorter_nom_usuario", $FileName, $this);
        $this->subTotal = new clsControl(ccsLabel, "subTotal", "subTotal", ccsInteger, array(False, 0, Null, "", False, "\$", "", 1, True, ""), CCGetRequestParam("subTotal", ccsGet, NULL), $this);
        $this->Saldo = new clsControl(ccsLabel, "Saldo", "Saldo", ccsInteger, array(False, 0, Null, "", False, "\$", "", 1, True, ""), CCGetRequestParam("Saldo", ccsGet, NULL), $this);
        $this->lnkAAbonos = new clsControl(ccsImageLink, "lnkAAbonos", "lnkAAbonos", ccsText, "", CCGetRequestParam("lnkAAbonos", ccsGet, NULL), $this);
        $this->lnkAAbonos->Parameters = CCAddParam($this->lnkAAbonos->Parameters, "peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->lnkAAbonos->Parameters = CCAddParam($this->lnkAAbonos->Parameters, "s_peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->lnkAAbonos->Page = "detalle_pago_peticiones.php";
        $this->lnkADetPet = new clsControl(ccsImageLink, "lnkADetPet", "lnkADetPet", ccsText, "", CCGetRequestParam("lnkADetPet", ccsGet, NULL), $this);
        $this->lnkADetPet->Parameters = CCAddParam($this->lnkADetPet->Parameters, "peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->lnkADetPet->Page = "det_Peticion.php";
        $this->lnkAddPago = new clsControl(ccsImageLink, "lnkAddPago", "lnkAddPago", ccsText, "", CCGetRequestParam("lnkAddPago", ccsGet, NULL), $this);
        $this->lnkAddPago->Parameters = CCAddParam($this->lnkAddPago->Parameters, "peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->lnkAddPago->Page = "add_pago_peticion.php";
    }
//End Class_Initialize Event

//Initialize Method @47-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @47-2B454126
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);

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
            $this->ControlsVisible["fecha_ingreso"] = $this->fecha_ingreso->Visible;
            $this->ControlsVisible["nom_forma_pago"] = $this->nom_forma_pago->Visible;
            $this->ControlsVisible["nom_banco"] = $this->nom_banco->Visible;
            $this->ControlsVisible["nom_prevision"] = $this->nom_prevision->Visible;
            $this->ControlsVisible["num_cheque_bono"] = $this->num_cheque_bono->Visible;
            $this->ControlsVisible["valor"] = $this->valor->Visible;
            $this->ControlsVisible["fecha_documento"] = $this->fecha_documento->Visible;
            $this->ControlsVisible["nom_usuario"] = $this->nom_usuario->Visible;
            $this->ControlsVisible["observacion"] = $this->observacion->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "detalle_pago_id", $this->DataSource->f("detalle_pago_id"));
                $this->fecha_ingreso->SetValue($this->DataSource->fecha_ingreso->GetValue());
                $this->nom_forma_pago->SetValue($this->DataSource->nom_forma_pago->GetValue());
                $this->nom_banco->SetValue($this->DataSource->nom_banco->GetValue());
                $this->nom_prevision->SetValue($this->DataSource->nom_prevision->GetValue());
                $this->num_cheque_bono->SetValue($this->DataSource->num_cheque_bono->GetValue());
                $this->valor->SetValue($this->DataSource->valor->GetValue());
                $this->fecha_documento->SetValue($this->DataSource->fecha_documento->GetValue());
                $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                $this->observacion->SetValue($this->DataSource->observacion->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ImageLink1->Show();
                $this->fecha_ingreso->Show();
                $this->nom_forma_pago->Show();
                $this->nom_banco->Show();
                $this->nom_prevision->Show();
                $this->num_cheque_bono->Show();
                $this->valor->Show();
                $this->fecha_documento->Show();
                $this->nom_usuario->Show();
                $this->observacion->Show();
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
        $this->peticion_id->Show();
        $this->Sorter_fecha_ingreso->Show();
        $this->Sorter_nom_forma_pago->Show();
        $this->Sorter_num_cheque_bono->Show();
        $this->Sorter_valor->Show();
        $this->Sorter_fecha_documento->Show();
        $this->Sorter_nom_usuario->Show();
        $this->subTotal->Show();
        $this->Saldo->Show();
        $this->lnkAAbonos->Show();
        $this->lnkADetPet->Show();
        $this->lnkAddPago->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @47-F9BF95CB
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_ingreso->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_forma_pago->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_banco->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_prevision->Errors->ToString());
        $errors = ComposeStrings($errors, $this->num_cheque_bono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_documento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->observacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End detalle_pago_bancos_forma Class @47-FCB6E20C

class clsdetalle_pago_bancos_formaDataSource extends clsDBDatos {  //detalle_pago_bancos_formaDataSource Class @47-9ABAA56E

//DataSource Variables @47-CDCD2947
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $fecha_ingreso;
    public $nom_forma_pago;
    public $nom_banco;
    public $nom_prevision;
    public $num_cheque_bono;
    public $valor;
    public $fecha_documento;
    public $nom_usuario;
    public $observacion;
//End DataSource Variables

//DataSourceClass_Initialize Event @47-2394F120
    function clsdetalle_pago_bancos_formaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid detalle_pago_bancos_forma";
        $this->Initialize();
        $this->fecha_ingreso = new clsField("fecha_ingreso", ccsDate, $this->DateFormat);
        
        $this->nom_forma_pago = new clsField("nom_forma_pago", ccsText, "");
        
        $this->nom_banco = new clsField("nom_banco", ccsText, "");
        
        $this->nom_prevision = new clsField("nom_prevision", ccsText, "");
        
        $this->num_cheque_bono = new clsField("num_cheque_bono", ccsText, "");
        
        $this->valor = new clsField("valor", ccsInteger, "");
        
        $this->fecha_documento = new clsField("fecha_documento", ccsDate, $this->DateFormat);
        
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        
        $this->observacion = new clsField("observacion", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @47-5AB56360
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_fecha_ingreso" => array("fecha_ingreso", ""), 
            "Sorter_nom_forma_pago" => array("nom_forma_pago", ""), 
            "Sorter_num_cheque_bono" => array("num_cheque_bono", ""), 
            "Sorter_valor" => array("valor", ""), 
            "Sorter_fecha_documento" => array("fecha_documento", ""), 
            "Sorter_nom_usuario" => array("nom_usuario", "")));
    }
//End SetOrder Method

//Prepare Method @47-89C31502
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "detalle_pago.peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @47-6E4E4F06
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((detalle_pago LEFT JOIN bancos ON\n\n" .
        "detalle_pago.banco_id = bancos.banco_id) LEFT JOIN formas_pago ON\n\n" .
        "detalle_pago.forma_pago_id = formas_pago.forma_pago_id) LEFT JOIN previsiones ON\n\n" .
        "detalle_pago.prevision_id = previsiones.prevision_id) LEFT JOIN usuarios ON\n\n" .
        "detalle_pago.usuario_id = usuarios.usuario_id";
        $this->SQL = "SELECT detalle_pago.*, nom_banco, nom_forma_pago, nom_prevision, nom_usuario \n\n" .
        "FROM (((detalle_pago LEFT JOIN bancos ON\n\n" .
        "detalle_pago.banco_id = bancos.banco_id) LEFT JOIN formas_pago ON\n\n" .
        "detalle_pago.forma_pago_id = formas_pago.forma_pago_id) LEFT JOIN previsiones ON\n\n" .
        "detalle_pago.prevision_id = previsiones.prevision_id) LEFT JOIN usuarios ON\n\n" .
        "detalle_pago.usuario_id = usuarios.usuario_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @47-81527F0F
    function SetValues()
    {
        $this->fecha_ingreso->SetDBValue(trim($this->f("fecha_ingreso")));
        $this->nom_forma_pago->SetDBValue($this->f("nom_forma_pago"));
        $this->nom_banco->SetDBValue($this->f("nom_banco"));
        $this->nom_prevision->SetDBValue($this->f("nom_prevision"));
        $this->num_cheque_bono->SetDBValue($this->f("num_cheque_bono"));
        $this->valor->SetDBValue(trim($this->f("valor")));
        $this->fecha_documento->SetDBValue(trim($this->f("fecha_documento")));
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
        $this->observacion->SetDBValue($this->f("observacion"));
    }
//End SetValues Method

} //End detalle_pago_bancos_formaDataSource Class @47-FCB6E20C

//Initialize Page @1-C2FD9FAD
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
$TemplateFileName = "list_pago_peticion.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-235FDDA2
CCSecurityRedirect("4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20", "");
//End Authenticate User

//Include events file @1-E8FCBCBA
include_once("./list_pago_peticion_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-4D7BF93B
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$detalle_pago_bancos_forma = new clsGriddetalle_pago_bancos_forma("", $MainPage);
$MainPage->detalle_pago_bancos_forma = & $detalle_pago_bancos_forma;
$detalle_pago_bancos_forma->Initialize();
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

//Go to destination page @1-3908CB64
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($detalle_pago_bancos_forma);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A43317FD
$detalle_pago_bancos_forma->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-AE388DAA
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($detalle_pago_bancos_forma);
unset($Tpl);
//End Unload Page


?>
