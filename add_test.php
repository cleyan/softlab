<?php
//Include Common Files @1-A67EAEEC
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_test.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtest { //test Class @2-823F7E18

//Variables @2-9E315808

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

//Class_Initialize Event @2-E1E5053F
    function clsRecordtest($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record test/Error";
        $this->DataSource = new clstestDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "test";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->codigo_fonasa = new clsControl(ccsTextBox, "codigo_fonasa", "Código Fonasa", ccsText, "", CCGetRequestParam("codigo_fonasa", $Method, NULL), $this);
            $this->sub_codigo = new clsControl(ccsTextBox, "sub_codigo", "sub_codigo", ccsText, "", CCGetRequestParam("sub_codigo", $Method, NULL), $this);
            $this->cod_test = new clsControl(ccsTextBox, "cod_test", "Código del Test", ccsText, "", CCGetRequestParam("cod_test", $Method, NULL), $this);
            $this->cod_test->Required = true;
            $this->nom_test = new clsControl(ccsTextBox, "nom_test", "Nombre del Test", ccsText, "", CCGetRequestParam("nom_test", $Method, NULL), $this);
            $this->nom_test->Required = true;
            $this->unidad_medida = new clsControl(ccsTextBox, "unidad_medida", "Unidad Medida", ccsText, "", CCGetRequestParam("unidad_medida", $Method, NULL), $this);
            $this->secciones_id = new clsControl(ccsListBox, "secciones_id", "Sección", ccsInteger, "", CCGetRequestParam("secciones_id", $Method, NULL), $this);
            $this->secciones_id->DSType = dsTable;
            $this->secciones_id->DataSource = new clsDBDatos();
            $this->secciones_id->ds = & $this->secciones_id->DataSource;
            $this->secciones_id->DataSource->SQL = "SELECT * \n" .
"FROM secciones {SQL_Where} {SQL_OrderBy}";
            $this->secciones_id->DataSource->Order = "orden";
            list($this->secciones_id->BoundColumn, $this->secciones_id->TextColumn, $this->secciones_id->DBFormat) = array("seccion_id", "nom_seccion", "");
            $this->secciones_id->DataSource->Parameters["expr54"] = 'V';
            $this->secciones_id->DataSource->wp = new clsSQLParameters();
            $this->secciones_id->DataSource->wp->AddParameter("1", "expr54", ccsText, "", "", $this->secciones_id->DataSource->Parameters["expr54"], "", false);
            $this->secciones_id->DataSource->wp->Criterion[1] = $this->secciones_id->DataSource->wp->Operation(opEqual, "activo", $this->secciones_id->DataSource->wp->GetDBValue("1"), $this->secciones_id->DataSource->ToSQL($this->secciones_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->secciones_id->DataSource->Where = 
                 $this->secciones_id->DataSource->wp->Criterion[1];
            $this->secciones_id->DataSource->Order = "orden";
            $this->secciones_id->Required = true;
            $this->indicacion_id = new clsControl(ccsListBox, "indicacion_id", "Indicación", ccsInteger, "", CCGetRequestParam("indicacion_id", $Method, NULL), $this);
            $this->indicacion_id->DSType = dsTable;
            $this->indicacion_id->DataSource = new clsDBDatos();
            $this->indicacion_id->ds = & $this->indicacion_id->DataSource;
            $this->indicacion_id->DataSource->SQL = "SELECT * \n" .
"FROM indicaciones_test {SQL_Where} {SQL_OrderBy}";
            $this->indicacion_id->DataSource->Order = "nom_indicacion";
            list($this->indicacion_id->BoundColumn, $this->indicacion_id->TextColumn, $this->indicacion_id->DBFormat) = array("indicacion_test_id", "nom_indicacion", "");
            $this->indicacion_id->DataSource->Parameters["expr56"] = 'V';
            $this->indicacion_id->DataSource->wp = new clsSQLParameters();
            $this->indicacion_id->DataSource->wp->AddParameter("1", "expr56", ccsText, "", "", $this->indicacion_id->DataSource->Parameters["expr56"], "", false);
            $this->indicacion_id->DataSource->wp->Criterion[1] = $this->indicacion_id->DataSource->wp->Operation(opEqual, "activo", $this->indicacion_id->DataSource->wp->GetDBValue("1"), $this->indicacion_id->DataSource->ToSQL($this->indicacion_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->indicacion_id->DataSource->Where = 
                 $this->indicacion_id->DataSource->wp->Criterion[1];
            $this->indicacion_id->DataSource->Order = "nom_indicacion";
            $this->indicacion_id->Required = true;
            $this->metodo_id = new clsControl(ccsListBox, "metodo_id", "Método", ccsText, "", CCGetRequestParam("metodo_id", $Method, NULL), $this);
            $this->metodo_id->DSType = dsTable;
            $this->metodo_id->DataSource = new clsDBDatos();
            $this->metodo_id->ds = & $this->metodo_id->DataSource;
            $this->metodo_id->DataSource->SQL = "SELECT * \n" .
"FROM metodos {SQL_Where} {SQL_OrderBy}";
            $this->metodo_id->DataSource->Order = "nom_metodo";
            list($this->metodo_id->BoundColumn, $this->metodo_id->TextColumn, $this->metodo_id->DBFormat) = array("metodo_id", "nom_metodo", "");
            $this->metodo_id->DataSource->Order = "nom_metodo";
            $this->metodo_id->Required = true;
            $this->equipo_id = new clsControl(ccsListBox, "equipo_id", "Equipo", ccsInteger, "", CCGetRequestParam("equipo_id", $Method, NULL), $this);
            $this->equipo_id->DSType = dsTable;
            $this->equipo_id->DataSource = new clsDBDatos();
            $this->equipo_id->ds = & $this->equipo_id->DataSource;
            $this->equipo_id->DataSource->SQL = "SELECT * \n" .
"FROM equipos {SQL_Where} {SQL_OrderBy}";
            $this->equipo_id->DataSource->Order = "nom_equipo";
            list($this->equipo_id->BoundColumn, $this->equipo_id->TextColumn, $this->equipo_id->DBFormat) = array("equipo_id", "nom_equipo", "");
            $this->equipo_id->DataSource->Parameters["expr55"] = 'V';
            $this->equipo_id->DataSource->wp = new clsSQLParameters();
            $this->equipo_id->DataSource->wp->AddParameter("1", "expr55", ccsText, "", "", $this->equipo_id->DataSource->Parameters["expr55"], "", false);
            $this->equipo_id->DataSource->wp->Criterion[1] = $this->equipo_id->DataSource->wp->Operation(opEqual, "activo", $this->equipo_id->DataSource->wp->GetDBValue("1"), $this->equipo_id->DataSource->ToSQL($this->equipo_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->equipo_id->DataSource->Where = 
                 $this->equipo_id->DataSource->wp->Criterion[1];
            $this->equipo_id->DataSource->Order = "nom_equipo";
            $this->equipo_id->Required = true;
            $this->tipo_muestra_id = new clsControl(ccsListBox, "tipo_muestra_id", "Tipo de Muestra", ccsInteger, "", CCGetRequestParam("tipo_muestra_id", $Method, NULL), $this);
            $this->tipo_muestra_id->DSType = dsTable;
            $this->tipo_muestra_id->DataSource = new clsDBDatos();
            $this->tipo_muestra_id->ds = & $this->tipo_muestra_id->DataSource;
            $this->tipo_muestra_id->DataSource->SQL = "SELECT * \n" .
"FROM tipos_muestra {SQL_Where} {SQL_OrderBy}";
            $this->tipo_muestra_id->DataSource->Order = "nom_tipo_muestra";
            list($this->tipo_muestra_id->BoundColumn, $this->tipo_muestra_id->TextColumn, $this->tipo_muestra_id->DBFormat) = array("tipo_muestra_id", "nom_tipo_muestra", "");
            $this->tipo_muestra_id->DataSource->Parameters["expr57"] = 'V';
            $this->tipo_muestra_id->DataSource->wp = new clsSQLParameters();
            $this->tipo_muestra_id->DataSource->wp->AddParameter("1", "expr57", ccsText, "", "", $this->tipo_muestra_id->DataSource->Parameters["expr57"], "", false);
            $this->tipo_muestra_id->DataSource->wp->Criterion[1] = $this->tipo_muestra_id->DataSource->wp->Operation(opEqual, "activo", $this->tipo_muestra_id->DataSource->wp->GetDBValue("1"), $this->tipo_muestra_id->DataSource->ToSQL($this->tipo_muestra_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->tipo_muestra_id->DataSource->Where = 
                 $this->tipo_muestra_id->DataSource->wp->Criterion[1];
            $this->tipo_muestra_id->DataSource->Order = "nom_tipo_muestra";
            $this->tipo_muestra_id->Required = true;
            $this->informe_id = new clsControl(ccsListBox, "informe_id", "Informe predeterminado", ccsText, "", CCGetRequestParam("informe_id", $Method, NULL), $this);
            $this->informe_id->DSType = dsTable;
            $this->informe_id->DataSource = new clsDBDatos();
            $this->informe_id->ds = & $this->informe_id->DataSource;
            $this->informe_id->DataSource->SQL = "SELECT * \n" .
"FROM informes {SQL_Where} {SQL_OrderBy}";
            $this->informe_id->DataSource->Order = "nom_informe";
            list($this->informe_id->BoundColumn, $this->informe_id->TextColumn, $this->informe_id->DBFormat) = array("informe_id", "nom_informe", "");
            $this->informe_id->DataSource->Order = "nom_informe";
            $this->informe_id->Required = true;
            $this->aislado = new clsControl(ccsCheckBox, "aislado", "Aislado", ccsText, "", CCGetRequestParam("aislado", $Method, NULL), $this);
            $this->aislado->CheckedValue = $this->aislado->GetParsedValue('V');
            $this->aislado->UncheckedValue = $this->aislado->GetParsedValue('F');
            $this->compuesto = new clsControl(ccsCheckBox, "compuesto", "Compuesto", ccsText, "", CCGetRequestParam("compuesto", $Method, NULL), $this);
            $this->compuesto->CheckedValue = $this->compuesto->GetParsedValue('V');
            $this->compuesto->UncheckedValue = $this->compuesto->GetParsedValue('F');
            $this->resopcional = new clsControl(ccsCheckBox, "resopcional", "Acceso Rapido", ccsText, "", CCGetRequestParam("resopcional", $Method, NULL), $this);
            $this->resopcional->CheckedValue = $this->resopcional->GetParsedValue('V');
            $this->resopcional->UncheckedValue = $this->resopcional->GetParsedValue('F');
            $this->contextarea = new clsControl(ccsCheckBox, "contextarea", "Con Text Area", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("contextarea", $Method, NULL), $this);
            $this->contextarea->CheckedValue = true;
            $this->contextarea->UncheckedValue = false;
            $this->conarchivo = new clsControl(ccsCheckBox, "conarchivo", "Con Archivo", ccsText, "", CCGetRequestParam("conarchivo", $Method, NULL), $this);
            $this->conarchivo->CheckedValue = $this->conarchivo->GetParsedValue('V');
            $this->conarchivo->UncheckedValue = $this->conarchivo->GetParsedValue('F');
            $this->conmultipleresultado = new clsControl(ccsCheckBox, "conmultipleresultado", "Con Multiple Resultado", ccsText, "", CCGetRequestParam("conmultipleresultado", $Method, NULL), $this);
            $this->conmultipleresultado->CheckedValue = $this->conmultipleresultado->GetParsedValue('V');
            $this->conmultipleresultado->UncheckedValue = $this->conmultipleresultado->GetParsedValue('F');
            $this->formula = new clsControl(ccsCheckBox, "formula", "formula", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("formula", $Method, NULL), $this);
            $this->formula->CheckedValue = true;
            $this->formula->UncheckedValue = false;
            $this->edit_formula = new clsControl(ccsLink, "edit_formula", "edit_formula", ccsText, "", CCGetRequestParam("edit_formula", $Method, NULL), $this);
            $this->edit_formula->HTML = true;
            $this->edit_formula->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->edit_formula->Page = "#";
            $this->dias_demora = new clsControl(ccsTextBox, "dias_demora", "dias_demora", ccsInteger, "", CCGetRequestParam("dias_demora", $Method, NULL), $this);
            $this->orden_peticion = new clsControl(ccsTextBox, "orden_peticion", "Orden Peticion", ccsInteger, "", CCGetRequestParam("orden_peticion", $Method, NULL), $this);
            $this->orden_peticion->Required = true;
            $this->ver_orden_pet = new clsControl(ccsImageLink, "ver_orden_pet", "ver_orden_pet", ccsText, "", CCGetRequestParam("ver_orden_pet", $Method, NULL), $this);
            $this->ver_orden_pet->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->ver_orden_pet->Page = "#";
            $this->orden_informe = new clsControl(ccsTextBox, "orden_informe", "Orden Informe", ccsInteger, "", CCGetRequestParam("orden_informe", $Method, NULL), $this);
            $this->orden_informe->Required = true;
            $this->ver_orden_inf = new clsControl(ccsImageLink, "ver_orden_inf", "ver_orden_inf", ccsText, "", CCGetRequestParam("ver_orden_inf", $Method, NULL), $this);
            $this->ver_orden_inf->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->ver_orden_inf->Page = "#";
            $this->orden_ingreso = new clsControl(ccsTextBox, "orden_ingreso", "Orden en Venta de ingreso de Resultados", ccsInteger, "", CCGetRequestParam("orden_ingreso", $Method, NULL), $this);
            $this->orden_ingreso->Required = true;
            $this->anotaciones = new clsControl(ccsTextBox, "anotaciones", "Anotaciones", ccsText, "", CCGetRequestParam("anotaciones", $Method, NULL), $this);
            $this->observaciones = new clsControl(ccsTextArea, "observaciones", "Observaciones", ccsMemo, "", CCGetRequestParam("observaciones", $Method, NULL), $this);
            $this->plantilla_ht = new clsControl(ccsTextArea, "plantilla_ht", "plantilla_ht", ccsText, "", CCGetRequestParam("plantilla_ht", $Method, NULL), $this);
            $this->grupo_modelo_id = new clsControl(ccsListBox, "grupo_modelo_id", "grupo_modelo_id", ccsInteger, "", CCGetRequestParam("grupo_modelo_id", $Method, NULL), $this);
            $this->grupo_modelo_id->DSType = dsTable;
            $this->grupo_modelo_id->DataSource = new clsDBDatos();
            $this->grupo_modelo_id->ds = & $this->grupo_modelo_id->DataSource;
            $this->grupo_modelo_id->DataSource->SQL = "SELECT * \n" .
"FROM grupos_modelo {SQL_Where} {SQL_OrderBy}";
            list($this->grupo_modelo_id->BoundColumn, $this->grupo_modelo_id->TextColumn, $this->grupo_modelo_id->DBFormat) = array("grupo_modelo_id", "nom_grupo_modelo", "");
            $this->imprime_etq = new clsControl(ccsCheckBox, "imprime_etq", "imprime_etq", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("imprime_etq", $Method, NULL), $this);
            $this->imprime_etq->CheckedValue = true;
            $this->imprime_etq->UncheckedValue = false;
            $this->imprime_ot = new clsControl(ccsCheckBox, "imprime_ot", "imprime_ot", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("imprime_ot", $Method, NULL), $this);
            $this->imprime_ot->CheckedValue = true;
            $this->imprime_ot->UncheckedValue = false;
            $this->lbl_iframe_valores = new clsControl(ccsLabel, "lbl_iframe_valores", "lbl_iframe_valores", ccsText, "", CCGetRequestParam("lbl_iframe_valores", $Method, NULL), $this);
            $this->lbl_iframe_valores->HTML = true;
            $this->lbl_iframe_compuesto = new clsControl(ccsLabel, "lbl_iframe_compuesto", "lbl_iframe_compuesto", ccsText, "", CCGetRequestParam("lbl_iframe_compuesto", $Method, NULL), $this);
            $this->lbl_iframe_compuesto->HTML = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            $this->imprimible = new clsControl(ccsCheckBox, "imprimible", "imprimible", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("imprimible", $Method, NULL), $this);
            $this->imprimible->CheckedValue = true;
            $this->imprimible->UncheckedValue = false;
            if(!$this->FormSubmitted) {
                if(!is_array($this->aislado->Value) && !strlen($this->aislado->Value) && $this->aislado->Value !== false)
                    $this->aislado->SetValue(true);
                if(!is_array($this->compuesto->Value) && !strlen($this->compuesto->Value) && $this->compuesto->Value !== false)
                    $this->compuesto->SetValue(false);
                if(!is_array($this->resopcional->Value) && !strlen($this->resopcional->Value) && $this->resopcional->Value !== false)
                    $this->resopcional->SetValue(false);
                if(!is_array($this->contextarea->Value) && !strlen($this->contextarea->Value) && $this->contextarea->Value !== false)
                    $this->contextarea->SetValue(false);
                if(!is_array($this->conarchivo->Value) && !strlen($this->conarchivo->Value) && $this->conarchivo->Value !== false)
                    $this->conarchivo->SetValue(false);
                if(!is_array($this->conmultipleresultado->Value) && !strlen($this->conmultipleresultado->Value) && $this->conmultipleresultado->Value !== false)
                    $this->conmultipleresultado->SetValue(false);
                if(!is_array($this->formula->Value) && !strlen($this->formula->Value) && $this->formula->Value !== false)
                    $this->formula->SetValue(false);
                if(!is_array($this->dias_demora->Value) && !strlen($this->dias_demora->Value) && $this->dias_demora->Value !== false)
                    $this->dias_demora->SetText(0);
                if(!is_array($this->orden_peticion->Value) && !strlen($this->orden_peticion->Value) && $this->orden_peticion->Value !== false)
                    $this->orden_peticion->SetText(0);
                if(!is_array($this->orden_informe->Value) && !strlen($this->orden_informe->Value) && $this->orden_informe->Value !== false)
                    $this->orden_informe->SetText(0);
                if(!is_array($this->orden_ingreso->Value) && !strlen($this->orden_ingreso->Value) && $this->orden_ingreso->Value !== false)
                    $this->orden_ingreso->SetText(0);
                if(!is_array($this->imprime_etq->Value) && !strlen($this->imprime_etq->Value) && $this->imprime_etq->Value !== false)
                    $this->imprime_etq->SetValue(true);
                if(!is_array($this->imprime_ot->Value) && !strlen($this->imprime_ot->Value) && $this->imprime_ot->Value !== false)
                    $this->imprime_ot->SetValue(true);
                if(!is_array($this->imprimible->Value) && !strlen($this->imprimible->Value) && $this->imprimible->Value !== false)
                    $this->imprimible->SetValue(true);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-DFD3A45F
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urltest_id"] = CCGetFromGet("test_id", NULL);
    }
//End Initialize Method

//Validate Method @2-21CC211C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if($this->EditMode && strlen($this->DataSource->Where))
            $Where = " AND NOT (" . $this->DataSource->Where . ")";
        $this->DataSource->cod_test->SetValue($this->cod_test->GetValue());
        if(CCDLookUp("COUNT(*)", "test", "cod_test=" . $this->DataSource->ToSQL($this->DataSource->cod_test->GetDBValue(), $this->DataSource->cod_test->DataType) . $Where, $this->DataSource) > 0)
            $this->cod_test->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Código del Test"));
        $Validation = ($this->codigo_fonasa->Validate() && $Validation);
        $Validation = ($this->sub_codigo->Validate() && $Validation);
        $Validation = ($this->cod_test->Validate() && $Validation);
        $Validation = ($this->nom_test->Validate() && $Validation);
        $Validation = ($this->unidad_medida->Validate() && $Validation);
        $Validation = ($this->secciones_id->Validate() && $Validation);
        $Validation = ($this->indicacion_id->Validate() && $Validation);
        $Validation = ($this->metodo_id->Validate() && $Validation);
        $Validation = ($this->equipo_id->Validate() && $Validation);
        $Validation = ($this->tipo_muestra_id->Validate() && $Validation);
        $Validation = ($this->informe_id->Validate() && $Validation);
        $Validation = ($this->aislado->Validate() && $Validation);
        $Validation = ($this->compuesto->Validate() && $Validation);
        $Validation = ($this->resopcional->Validate() && $Validation);
        $Validation = ($this->contextarea->Validate() && $Validation);
        $Validation = ($this->conarchivo->Validate() && $Validation);
        $Validation = ($this->conmultipleresultado->Validate() && $Validation);
        $Validation = ($this->formula->Validate() && $Validation);
        $Validation = ($this->dias_demora->Validate() && $Validation);
        $Validation = ($this->orden_peticion->Validate() && $Validation);
        $Validation = ($this->orden_informe->Validate() && $Validation);
        $Validation = ($this->orden_ingreso->Validate() && $Validation);
        $Validation = ($this->anotaciones->Validate() && $Validation);
        $Validation = ($this->observaciones->Validate() && $Validation);
        $Validation = ($this->plantilla_ht->Validate() && $Validation);
        $Validation = ($this->grupo_modelo_id->Validate() && $Validation);
        $Validation = ($this->imprime_etq->Validate() && $Validation);
        $Validation = ($this->imprime_ot->Validate() && $Validation);
        $Validation = ($this->imprimible->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->codigo_fonasa->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sub_codigo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cod_test->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_test->Errors->Count() == 0);
        $Validation =  $Validation && ($this->unidad_medida->Errors->Count() == 0);
        $Validation =  $Validation && ($this->secciones_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->indicacion_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->metodo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->equipo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tipo_muestra_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->informe_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->aislado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->compuesto->Errors->Count() == 0);
        $Validation =  $Validation && ($this->resopcional->Errors->Count() == 0);
        $Validation =  $Validation && ($this->contextarea->Errors->Count() == 0);
        $Validation =  $Validation && ($this->conarchivo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->conmultipleresultado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->formula->Errors->Count() == 0);
        $Validation =  $Validation && ($this->dias_demora->Errors->Count() == 0);
        $Validation =  $Validation && ($this->orden_peticion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->orden_informe->Errors->Count() == 0);
        $Validation =  $Validation && ($this->orden_ingreso->Errors->Count() == 0);
        $Validation =  $Validation && ($this->anotaciones->Errors->Count() == 0);
        $Validation =  $Validation && ($this->observaciones->Errors->Count() == 0);
        $Validation =  $Validation && ($this->plantilla_ht->Errors->Count() == 0);
        $Validation =  $Validation && ($this->grupo_modelo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->imprime_etq->Errors->Count() == 0);
        $Validation =  $Validation && ($this->imprime_ot->Errors->Count() == 0);
        $Validation =  $Validation && ($this->imprimible->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-6588813B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->codigo_fonasa->Errors->Count());
        $errors = ($errors || $this->sub_codigo->Errors->Count());
        $errors = ($errors || $this->cod_test->Errors->Count());
        $errors = ($errors || $this->nom_test->Errors->Count());
        $errors = ($errors || $this->unidad_medida->Errors->Count());
        $errors = ($errors || $this->secciones_id->Errors->Count());
        $errors = ($errors || $this->indicacion_id->Errors->Count());
        $errors = ($errors || $this->metodo_id->Errors->Count());
        $errors = ($errors || $this->equipo_id->Errors->Count());
        $errors = ($errors || $this->tipo_muestra_id->Errors->Count());
        $errors = ($errors || $this->informe_id->Errors->Count());
        $errors = ($errors || $this->aislado->Errors->Count());
        $errors = ($errors || $this->compuesto->Errors->Count());
        $errors = ($errors || $this->resopcional->Errors->Count());
        $errors = ($errors || $this->contextarea->Errors->Count());
        $errors = ($errors || $this->conarchivo->Errors->Count());
        $errors = ($errors || $this->conmultipleresultado->Errors->Count());
        $errors = ($errors || $this->formula->Errors->Count());
        $errors = ($errors || $this->edit_formula->Errors->Count());
        $errors = ($errors || $this->dias_demora->Errors->Count());
        $errors = ($errors || $this->orden_peticion->Errors->Count());
        $errors = ($errors || $this->ver_orden_pet->Errors->Count());
        $errors = ($errors || $this->orden_informe->Errors->Count());
        $errors = ($errors || $this->ver_orden_inf->Errors->Count());
        $errors = ($errors || $this->orden_ingreso->Errors->Count());
        $errors = ($errors || $this->anotaciones->Errors->Count());
        $errors = ($errors || $this->observaciones->Errors->Count());
        $errors = ($errors || $this->plantilla_ht->Errors->Count());
        $errors = ($errors || $this->grupo_modelo_id->Errors->Count());
        $errors = ($errors || $this->imprime_etq->Errors->Count());
        $errors = ($errors || $this->imprime_ot->Errors->Count());
        $errors = ($errors || $this->lbl_iframe_valores->Errors->Count());
        $errors = ($errors || $this->lbl_iframe_compuesto->Errors->Count());
        $errors = ($errors || $this->imprimible->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-D9D08641
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
        $Redirect = "list_test.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
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

//InsertRow Method @2-3B626049
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->codigo_fonasa->SetValue($this->codigo_fonasa->GetValue(true));
        $this->DataSource->sub_codigo->SetValue($this->sub_codigo->GetValue(true));
        $this->DataSource->cod_test->SetValue($this->cod_test->GetValue(true));
        $this->DataSource->nom_test->SetValue($this->nom_test->GetValue(true));
        $this->DataSource->unidad_medida->SetValue($this->unidad_medida->GetValue(true));
        $this->DataSource->secciones_id->SetValue($this->secciones_id->GetValue(true));
        $this->DataSource->indicacion_id->SetValue($this->indicacion_id->GetValue(true));
        $this->DataSource->metodo_id->SetValue($this->metodo_id->GetValue(true));
        $this->DataSource->equipo_id->SetValue($this->equipo_id->GetValue(true));
        $this->DataSource->tipo_muestra_id->SetValue($this->tipo_muestra_id->GetValue(true));
        $this->DataSource->informe_id->SetValue($this->informe_id->GetValue(true));
        $this->DataSource->aislado->SetValue($this->aislado->GetValue(true));
        $this->DataSource->compuesto->SetValue($this->compuesto->GetValue(true));
        $this->DataSource->resopcional->SetValue($this->resopcional->GetValue(true));
        $this->DataSource->contextarea->SetValue($this->contextarea->GetValue(true));
        $this->DataSource->conarchivo->SetValue($this->conarchivo->GetValue(true));
        $this->DataSource->conmultipleresultado->SetValue($this->conmultipleresultado->GetValue(true));
        $this->DataSource->formula->SetValue($this->formula->GetValue(true));
        $this->DataSource->edit_formula->SetValue($this->edit_formula->GetValue(true));
        $this->DataSource->dias_demora->SetValue($this->dias_demora->GetValue(true));
        $this->DataSource->orden_peticion->SetValue($this->orden_peticion->GetValue(true));
        $this->DataSource->ver_orden_pet->SetValue($this->ver_orden_pet->GetValue(true));
        $this->DataSource->orden_informe->SetValue($this->orden_informe->GetValue(true));
        $this->DataSource->ver_orden_inf->SetValue($this->ver_orden_inf->GetValue(true));
        $this->DataSource->orden_ingreso->SetValue($this->orden_ingreso->GetValue(true));
        $this->DataSource->anotaciones->SetValue($this->anotaciones->GetValue(true));
        $this->DataSource->observaciones->SetValue($this->observaciones->GetValue(true));
        $this->DataSource->plantilla_ht->SetValue($this->plantilla_ht->GetValue(true));
        $this->DataSource->grupo_modelo_id->SetValue($this->grupo_modelo_id->GetValue(true));
        $this->DataSource->imprime_etq->SetValue($this->imprime_etq->GetValue(true));
        $this->DataSource->imprime_ot->SetValue($this->imprime_ot->GetValue(true));
        $this->DataSource->lbl_iframe_valores->SetValue($this->lbl_iframe_valores->GetValue(true));
        $this->DataSource->lbl_iframe_compuesto->SetValue($this->lbl_iframe_compuesto->GetValue(true));
        $this->DataSource->imprimible->SetValue($this->imprimible->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-73283DF7
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->codigo_fonasa->SetValue($this->codigo_fonasa->GetValue(true));
        $this->DataSource->sub_codigo->SetValue($this->sub_codigo->GetValue(true));
        $this->DataSource->cod_test->SetValue($this->cod_test->GetValue(true));
        $this->DataSource->nom_test->SetValue($this->nom_test->GetValue(true));
        $this->DataSource->unidad_medida->SetValue($this->unidad_medida->GetValue(true));
        $this->DataSource->secciones_id->SetValue($this->secciones_id->GetValue(true));
        $this->DataSource->indicacion_id->SetValue($this->indicacion_id->GetValue(true));
        $this->DataSource->metodo_id->SetValue($this->metodo_id->GetValue(true));
        $this->DataSource->equipo_id->SetValue($this->equipo_id->GetValue(true));
        $this->DataSource->tipo_muestra_id->SetValue($this->tipo_muestra_id->GetValue(true));
        $this->DataSource->informe_id->SetValue($this->informe_id->GetValue(true));
        $this->DataSource->aislado->SetValue($this->aislado->GetValue(true));
        $this->DataSource->compuesto->SetValue($this->compuesto->GetValue(true));
        $this->DataSource->resopcional->SetValue($this->resopcional->GetValue(true));
        $this->DataSource->contextarea->SetValue($this->contextarea->GetValue(true));
        $this->DataSource->conarchivo->SetValue($this->conarchivo->GetValue(true));
        $this->DataSource->conmultipleresultado->SetValue($this->conmultipleresultado->GetValue(true));
        $this->DataSource->formula->SetValue($this->formula->GetValue(true));
        $this->DataSource->edit_formula->SetValue($this->edit_formula->GetValue(true));
        $this->DataSource->dias_demora->SetValue($this->dias_demora->GetValue(true));
        $this->DataSource->orden_peticion->SetValue($this->orden_peticion->GetValue(true));
        $this->DataSource->ver_orden_pet->SetValue($this->ver_orden_pet->GetValue(true));
        $this->DataSource->orden_informe->SetValue($this->orden_informe->GetValue(true));
        $this->DataSource->ver_orden_inf->SetValue($this->ver_orden_inf->GetValue(true));
        $this->DataSource->orden_ingreso->SetValue($this->orden_ingreso->GetValue(true));
        $this->DataSource->anotaciones->SetValue($this->anotaciones->GetValue(true));
        $this->DataSource->observaciones->SetValue($this->observaciones->GetValue(true));
        $this->DataSource->plantilla_ht->SetValue($this->plantilla_ht->GetValue(true));
        $this->DataSource->grupo_modelo_id->SetValue($this->grupo_modelo_id->GetValue(true));
        $this->DataSource->imprime_etq->SetValue($this->imprime_etq->GetValue(true));
        $this->DataSource->imprime_ot->SetValue($this->imprime_ot->GetValue(true));
        $this->DataSource->lbl_iframe_valores->SetValue($this->lbl_iframe_valores->GetValue(true));
        $this->DataSource->lbl_iframe_compuesto->SetValue($this->lbl_iframe_compuesto->GetValue(true));
        $this->DataSource->imprimible->SetValue($this->imprimible->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-0250A06E
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

        $this->secciones_id->Prepare();
        $this->indicacion_id->Prepare();
        $this->metodo_id->Prepare();
        $this->equipo_id->Prepare();
        $this->tipo_muestra_id->Prepare();
        $this->informe_id->Prepare();
        $this->grupo_modelo_id->Prepare();

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
                    $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                    $this->sub_codigo->SetValue($this->DataSource->sub_codigo->GetValue());
                    $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->unidad_medida->SetValue($this->DataSource->unidad_medida->GetValue());
                    $this->secciones_id->SetValue($this->DataSource->secciones_id->GetValue());
                    $this->indicacion_id->SetValue($this->DataSource->indicacion_id->GetValue());
                    $this->metodo_id->SetValue($this->DataSource->metodo_id->GetValue());
                    $this->equipo_id->SetValue($this->DataSource->equipo_id->GetValue());
                    $this->tipo_muestra_id->SetValue($this->DataSource->tipo_muestra_id->GetValue());
                    $this->informe_id->SetValue($this->DataSource->informe_id->GetValue());
                    $this->aislado->SetValue($this->DataSource->aislado->GetValue());
                    $this->compuesto->SetValue($this->DataSource->compuesto->GetValue());
                    $this->resopcional->SetValue($this->DataSource->resopcional->GetValue());
                    $this->contextarea->SetValue($this->DataSource->contextarea->GetValue());
                    $this->conarchivo->SetValue($this->DataSource->conarchivo->GetValue());
                    $this->conmultipleresultado->SetValue($this->DataSource->conmultipleresultado->GetValue());
                    $this->formula->SetValue($this->DataSource->formula->GetValue());
                    $this->dias_demora->SetValue($this->DataSource->dias_demora->GetValue());
                    $this->orden_peticion->SetValue($this->DataSource->orden_peticion->GetValue());
                    $this->orden_informe->SetValue($this->DataSource->orden_informe->GetValue());
                    $this->orden_ingreso->SetValue($this->DataSource->orden_ingreso->GetValue());
                    $this->anotaciones->SetValue($this->DataSource->anotaciones->GetValue());
                    $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                    $this->plantilla_ht->SetValue($this->DataSource->plantilla_ht->GetValue());
                    $this->grupo_modelo_id->SetValue($this->DataSource->grupo_modelo_id->GetValue());
                    $this->imprime_etq->SetValue($this->DataSource->imprime_etq->GetValue());
                    $this->imprime_ot->SetValue($this->DataSource->imprime_ot->GetValue());
                    $this->imprimible->SetValue($this->DataSource->imprimible->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->codigo_fonasa->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sub_codigo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cod_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->unidad_medida->Errors->ToString());
            $Error = ComposeStrings($Error, $this->secciones_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->indicacion_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->metodo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->equipo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tipo_muestra_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->informe_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->aislado->Errors->ToString());
            $Error = ComposeStrings($Error, $this->compuesto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->resopcional->Errors->ToString());
            $Error = ComposeStrings($Error, $this->contextarea->Errors->ToString());
            $Error = ComposeStrings($Error, $this->conarchivo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->conmultipleresultado->Errors->ToString());
            $Error = ComposeStrings($Error, $this->formula->Errors->ToString());
            $Error = ComposeStrings($Error, $this->edit_formula->Errors->ToString());
            $Error = ComposeStrings($Error, $this->dias_demora->Errors->ToString());
            $Error = ComposeStrings($Error, $this->orden_peticion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ver_orden_pet->Errors->ToString());
            $Error = ComposeStrings($Error, $this->orden_informe->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ver_orden_inf->Errors->ToString());
            $Error = ComposeStrings($Error, $this->orden_ingreso->Errors->ToString());
            $Error = ComposeStrings($Error, $this->anotaciones->Errors->ToString());
            $Error = ComposeStrings($Error, $this->observaciones->Errors->ToString());
            $Error = ComposeStrings($Error, $this->plantilla_ht->Errors->ToString());
            $Error = ComposeStrings($Error, $this->grupo_modelo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->imprime_etq->Errors->ToString());
            $Error = ComposeStrings($Error, $this->imprime_ot->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lbl_iframe_valores->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lbl_iframe_compuesto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->imprimible->Errors->ToString());
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

        $this->codigo_fonasa->Show();
        $this->sub_codigo->Show();
        $this->cod_test->Show();
        $this->nom_test->Show();
        $this->unidad_medida->Show();
        $this->secciones_id->Show();
        $this->indicacion_id->Show();
        $this->metodo_id->Show();
        $this->equipo_id->Show();
        $this->tipo_muestra_id->Show();
        $this->informe_id->Show();
        $this->aislado->Show();
        $this->compuesto->Show();
        $this->resopcional->Show();
        $this->contextarea->Show();
        $this->conarchivo->Show();
        $this->conmultipleresultado->Show();
        $this->formula->Show();
        $this->edit_formula->Show();
        $this->dias_demora->Show();
        $this->orden_peticion->Show();
        $this->ver_orden_pet->Show();
        $this->orden_informe->Show();
        $this->ver_orden_inf->Show();
        $this->orden_ingreso->Show();
        $this->anotaciones->Show();
        $this->observaciones->Show();
        $this->plantilla_ht->Show();
        $this->grupo_modelo_id->Show();
        $this->imprime_etq->Show();
        $this->imprime_ot->Show();
        $this->lbl_iframe_valores->Show();
        $this->lbl_iframe_compuesto->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->imprimible->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End test Class @2-FCB6E20C

class clstestDataSource extends clsDBDatos {  //testDataSource Class @2-EDACDDB4

//DataSource Variables @2-3BAAAB1A
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
    public $codigo_fonasa;
    public $sub_codigo;
    public $cod_test;
    public $nom_test;
    public $unidad_medida;
    public $secciones_id;
    public $indicacion_id;
    public $metodo_id;
    public $equipo_id;
    public $tipo_muestra_id;
    public $informe_id;
    public $aislado;
    public $compuesto;
    public $resopcional;
    public $contextarea;
    public $conarchivo;
    public $conmultipleresultado;
    public $formula;
    public $edit_formula;
    public $dias_demora;
    public $orden_peticion;
    public $ver_orden_pet;
    public $orden_informe;
    public $ver_orden_inf;
    public $orden_ingreso;
    public $anotaciones;
    public $observaciones;
    public $plantilla_ht;
    public $grupo_modelo_id;
    public $imprime_etq;
    public $imprime_ot;
    public $lbl_iframe_valores;
    public $lbl_iframe_compuesto;
    public $imprimible;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-86EEC145
    function clstestDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record test/Error";
        $this->Initialize();
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->sub_codigo = new clsField("sub_codigo", ccsText, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->unidad_medida = new clsField("unidad_medida", ccsText, "");
        
        $this->secciones_id = new clsField("secciones_id", ccsInteger, "");
        
        $this->indicacion_id = new clsField("indicacion_id", ccsInteger, "");
        
        $this->metodo_id = new clsField("metodo_id", ccsText, "");
        
        $this->equipo_id = new clsField("equipo_id", ccsInteger, "");
        
        $this->tipo_muestra_id = new clsField("tipo_muestra_id", ccsInteger, "");
        
        $this->informe_id = new clsField("informe_id", ccsText, "");
        
        $this->aislado = new clsField("aislado", ccsText, "");
        
        $this->compuesto = new clsField("compuesto", ccsText, "");
        
        $this->resopcional = new clsField("resopcional", ccsText, "");
        
        $this->contextarea = new clsField("contextarea", ccsBoolean, $this->BooleanFormat);
        
        $this->conarchivo = new clsField("conarchivo", ccsText, "");
        
        $this->conmultipleresultado = new clsField("conmultipleresultado", ccsText, "");
        
        $this->formula = new clsField("formula", ccsBoolean, $this->BooleanFormat);
        
        $this->edit_formula = new clsField("edit_formula", ccsText, "");
        
        $this->dias_demora = new clsField("dias_demora", ccsInteger, "");
        
        $this->orden_peticion = new clsField("orden_peticion", ccsInteger, "");
        
        $this->ver_orden_pet = new clsField("ver_orden_pet", ccsText, "");
        
        $this->orden_informe = new clsField("orden_informe", ccsInteger, "");
        
        $this->ver_orden_inf = new clsField("ver_orden_inf", ccsText, "");
        
        $this->orden_ingreso = new clsField("orden_ingreso", ccsInteger, "");
        
        $this->anotaciones = new clsField("anotaciones", ccsText, "");
        
        $this->observaciones = new clsField("observaciones", ccsMemo, "");
        
        $this->plantilla_ht = new clsField("plantilla_ht", ccsText, "");
        
        $this->grupo_modelo_id = new clsField("grupo_modelo_id", ccsInteger, "");
        
        $this->imprime_etq = new clsField("imprime_etq", ccsBoolean, $this->BooleanFormat);
        
        $this->imprime_ot = new clsField("imprime_ot", ccsBoolean, $this->BooleanFormat);
        
        $this->lbl_iframe_valores = new clsField("lbl_iframe_valores", ccsText, "");
        
        $this->lbl_iframe_compuesto = new clsField("lbl_iframe_compuesto", ccsText, "");
        
        $this->imprimible = new clsField("imprimible", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["codigo_fonasa"] = array("Name" => "codigo_fonasa", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["sub_codigo"] = array("Name" => "sub_codigo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["cod_test"] = array("Name" => "cod_test", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_test"] = array("Name" => "nom_test", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["unidad_medida"] = array("Name" => "unidad_medida", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["secciones_id"] = array("Name" => "secciones_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["indicacion_id"] = array("Name" => "indicacion_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["metodo_id"] = array("Name" => "metodo_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["equipo_id"] = array("Name" => "equipo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["tipo_muestra_id"] = array("Name" => "tipo_muestra_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["informe_id"] = array("Name" => "informe_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["aislado"] = array("Name" => "aislado", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["compuesto"] = array("Name" => "compuesto", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["opcional"] = array("Name" => "opcional", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["con_text_area"] = array("Name" => "con_text_area", "Value" => "", "DataType" => ccsBoolean);
        $this->InsertFields["con_archivo"] = array("Name" => "con_archivo", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["con_multiple_resultado"] = array("Name" => "con_multiple_resultado", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["formula"] = array("Name" => "formula", "Value" => "", "DataType" => ccsBoolean);
        $this->InsertFields["dias_demora"] = array("Name" => "dias_demora", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["orden_peticion"] = array("Name" => "orden_peticion", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["orden_informe"] = array("Name" => "orden_informe", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["orden_ingreso"] = array("Name" => "orden_ingreso", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["anotaciones"] = array("Name" => "anotaciones", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["observaciones"] = array("Name" => "observaciones", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["plantilla_ht"] = array("Name" => "plantilla_ht", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["grupo_modelo_id"] = array("Name" => "grupo_modelo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["imprime_etq"] = array("Name" => "imprime_etq", "Value" => "", "DataType" => ccsBoolean);
        $this->InsertFields["imprime_ot"] = array("Name" => "imprime_ot", "Value" => "", "DataType" => ccsBoolean);
        $this->InsertFields["imprimible"] = array("Name" => "imprimible", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["codigo_fonasa"] = array("Name" => "codigo_fonasa", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["sub_codigo"] = array("Name" => "sub_codigo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cod_test"] = array("Name" => "cod_test", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_test"] = array("Name" => "nom_test", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["unidad_medida"] = array("Name" => "unidad_medida", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["secciones_id"] = array("Name" => "secciones_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["indicacion_id"] = array("Name" => "indicacion_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["metodo_id"] = array("Name" => "metodo_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["equipo_id"] = array("Name" => "equipo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipo_muestra_id"] = array("Name" => "tipo_muestra_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["informe_id"] = array("Name" => "informe_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["aislado"] = array("Name" => "aislado", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["compuesto"] = array("Name" => "compuesto", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["opcional"] = array("Name" => "opcional", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["con_text_area"] = array("Name" => "con_text_area", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["con_archivo"] = array("Name" => "con_archivo", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["con_multiple_resultado"] = array("Name" => "con_multiple_resultado", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["formula"] = array("Name" => "formula", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["dias_demora"] = array("Name" => "dias_demora", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["orden_peticion"] = array("Name" => "orden_peticion", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["orden_informe"] = array("Name" => "orden_informe", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["orden_ingreso"] = array("Name" => "orden_ingreso", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["anotaciones"] = array("Name" => "anotaciones", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["observaciones"] = array("Name" => "observaciones", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["plantilla_ht"] = array("Name" => "plantilla_ht", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["grupo_modelo_id"] = array("Name" => "grupo_modelo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["imprime_etq"] = array("Name" => "imprime_etq", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["imprime_ot"] = array("Name" => "imprime_ot", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["imprimible"] = array("Name" => "imprimible", "Value" => "", "DataType" => ccsBoolean);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-D26ADDE2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltest_id", ccsInteger, "", "", $this->Parameters["urltest_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "test_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-F1A82630
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM test {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-09DFCBCA
    function SetValues()
    {
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->sub_codigo->SetDBValue($this->f("sub_codigo"));
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->unidad_medida->SetDBValue($this->f("unidad_medida"));
        $this->secciones_id->SetDBValue(trim($this->f("secciones_id")));
        $this->indicacion_id->SetDBValue(trim($this->f("indicacion_id")));
        $this->metodo_id->SetDBValue($this->f("metodo_id"));
        $this->equipo_id->SetDBValue(trim($this->f("equipo_id")));
        $this->tipo_muestra_id->SetDBValue(trim($this->f("tipo_muestra_id")));
        $this->informe_id->SetDBValue($this->f("informe_id"));
        $this->aislado->SetDBValue($this->f("aislado"));
        $this->compuesto->SetDBValue($this->f("compuesto"));
        $this->resopcional->SetDBValue($this->f("opcional"));
        $this->contextarea->SetDBValue(trim($this->f("con_text_area")));
        $this->conarchivo->SetDBValue($this->f("con_archivo"));
        $this->conmultipleresultado->SetDBValue($this->f("con_multiple_resultado"));
        $this->formula->SetDBValue(trim($this->f("formula")));
        $this->dias_demora->SetDBValue(trim($this->f("dias_demora")));
        $this->orden_peticion->SetDBValue(trim($this->f("orden_peticion")));
        $this->orden_informe->SetDBValue(trim($this->f("orden_informe")));
        $this->orden_ingreso->SetDBValue(trim($this->f("orden_ingreso")));
        $this->anotaciones->SetDBValue($this->f("anotaciones"));
        $this->observaciones->SetDBValue($this->f("observaciones"));
        $this->plantilla_ht->SetDBValue($this->f("plantilla_ht"));
        $this->grupo_modelo_id->SetDBValue(trim($this->f("grupo_modelo_id")));
        $this->imprime_etq->SetDBValue(trim($this->f("imprime_etq")));
        $this->imprime_ot->SetDBValue(trim($this->f("imprime_ot")));
        $this->imprimible->SetDBValue(trim($this->f("imprimible")));
    }
//End SetValues Method

//Insert Method @2-C096168C
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["codigo_fonasa"]["Value"] = $this->codigo_fonasa->GetDBValue(true);
        $this->InsertFields["sub_codigo"]["Value"] = $this->sub_codigo->GetDBValue(true);
        $this->InsertFields["cod_test"]["Value"] = $this->cod_test->GetDBValue(true);
        $this->InsertFields["nom_test"]["Value"] = $this->nom_test->GetDBValue(true);
        $this->InsertFields["unidad_medida"]["Value"] = $this->unidad_medida->GetDBValue(true);
        $this->InsertFields["secciones_id"]["Value"] = $this->secciones_id->GetDBValue(true);
        $this->InsertFields["indicacion_id"]["Value"] = $this->indicacion_id->GetDBValue(true);
        $this->InsertFields["metodo_id"]["Value"] = $this->metodo_id->GetDBValue(true);
        $this->InsertFields["equipo_id"]["Value"] = $this->equipo_id->GetDBValue(true);
        $this->InsertFields["tipo_muestra_id"]["Value"] = $this->tipo_muestra_id->GetDBValue(true);
        $this->InsertFields["informe_id"]["Value"] = $this->informe_id->GetDBValue(true);
        $this->InsertFields["aislado"]["Value"] = $this->aislado->GetDBValue(true);
        $this->InsertFields["compuesto"]["Value"] = $this->compuesto->GetDBValue(true);
        $this->InsertFields["opcional"]["Value"] = $this->resopcional->GetDBValue(true);
        $this->InsertFields["con_text_area"]["Value"] = $this->contextarea->GetDBValue(true);
        $this->InsertFields["con_archivo"]["Value"] = $this->conarchivo->GetDBValue(true);
        $this->InsertFields["con_multiple_resultado"]["Value"] = $this->conmultipleresultado->GetDBValue(true);
        $this->InsertFields["formula"]["Value"] = $this->formula->GetDBValue(true);
        $this->InsertFields["dias_demora"]["Value"] = $this->dias_demora->GetDBValue(true);
        $this->InsertFields["orden_peticion"]["Value"] = $this->orden_peticion->GetDBValue(true);
        $this->InsertFields["orden_informe"]["Value"] = $this->orden_informe->GetDBValue(true);
        $this->InsertFields["orden_ingreso"]["Value"] = $this->orden_ingreso->GetDBValue(true);
        $this->InsertFields["anotaciones"]["Value"] = $this->anotaciones->GetDBValue(true);
        $this->InsertFields["observaciones"]["Value"] = $this->observaciones->GetDBValue(true);
        $this->InsertFields["plantilla_ht"]["Value"] = $this->plantilla_ht->GetDBValue(true);
        $this->InsertFields["grupo_modelo_id"]["Value"] = $this->grupo_modelo_id->GetDBValue(true);
        $this->InsertFields["imprime_etq"]["Value"] = $this->imprime_etq->GetDBValue(true);
        $this->InsertFields["imprime_ot"]["Value"] = $this->imprime_ot->GetDBValue(true);
        $this->InsertFields["imprimible"]["Value"] = $this->imprimible->GetDBValue(true);
        $this->SQL = CCBuildInsert("test", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-7633CCE4
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["codigo_fonasa"]["Value"] = $this->codigo_fonasa->GetDBValue(true);
        $this->UpdateFields["sub_codigo"]["Value"] = $this->sub_codigo->GetDBValue(true);
        $this->UpdateFields["cod_test"]["Value"] = $this->cod_test->GetDBValue(true);
        $this->UpdateFields["nom_test"]["Value"] = $this->nom_test->GetDBValue(true);
        $this->UpdateFields["unidad_medida"]["Value"] = $this->unidad_medida->GetDBValue(true);
        $this->UpdateFields["secciones_id"]["Value"] = $this->secciones_id->GetDBValue(true);
        $this->UpdateFields["indicacion_id"]["Value"] = $this->indicacion_id->GetDBValue(true);
        $this->UpdateFields["metodo_id"]["Value"] = $this->metodo_id->GetDBValue(true);
        $this->UpdateFields["equipo_id"]["Value"] = $this->equipo_id->GetDBValue(true);
        $this->UpdateFields["tipo_muestra_id"]["Value"] = $this->tipo_muestra_id->GetDBValue(true);
        $this->UpdateFields["informe_id"]["Value"] = $this->informe_id->GetDBValue(true);
        $this->UpdateFields["aislado"]["Value"] = $this->aislado->GetDBValue(true);
        $this->UpdateFields["compuesto"]["Value"] = $this->compuesto->GetDBValue(true);
        $this->UpdateFields["opcional"]["Value"] = $this->resopcional->GetDBValue(true);
        $this->UpdateFields["con_text_area"]["Value"] = $this->contextarea->GetDBValue(true);
        $this->UpdateFields["con_archivo"]["Value"] = $this->conarchivo->GetDBValue(true);
        $this->UpdateFields["con_multiple_resultado"]["Value"] = $this->conmultipleresultado->GetDBValue(true);
        $this->UpdateFields["formula"]["Value"] = $this->formula->GetDBValue(true);
        $this->UpdateFields["dias_demora"]["Value"] = $this->dias_demora->GetDBValue(true);
        $this->UpdateFields["orden_peticion"]["Value"] = $this->orden_peticion->GetDBValue(true);
        $this->UpdateFields["orden_informe"]["Value"] = $this->orden_informe->GetDBValue(true);
        $this->UpdateFields["orden_ingreso"]["Value"] = $this->orden_ingreso->GetDBValue(true);
        $this->UpdateFields["anotaciones"]["Value"] = $this->anotaciones->GetDBValue(true);
        $this->UpdateFields["observaciones"]["Value"] = $this->observaciones->GetDBValue(true);
        $this->UpdateFields["plantilla_ht"]["Value"] = $this->plantilla_ht->GetDBValue(true);
        $this->UpdateFields["grupo_modelo_id"]["Value"] = $this->grupo_modelo_id->GetDBValue(true);
        $this->UpdateFields["imprime_etq"]["Value"] = $this->imprime_etq->GetDBValue(true);
        $this->UpdateFields["imprime_ot"]["Value"] = $this->imprime_ot->GetDBValue(true);
        $this->UpdateFields["imprimible"]["Value"] = $this->imprimible->GetDBValue(true);
        $this->SQL = CCBuildUpdate("test", $this->UpdateFields, $this);
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

//Delete Method @2-27D4C73B
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM test";
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

} //End testDataSource Class @2-FCB6E20C

//Initialize Page @1-CC4727C5
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
$TemplateFileName = "add_test.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-176F2FD9
CCSecurityRedirect("5;12;13;14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-FA4B838D
include_once("./add_test_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7597046F
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$lbl_test_id = new clsControl(ccsLabel, "lbl_test_id", "lbl_test_id", ccsText, "", CCGetRequestParam("lbl_test_id", ccsGet, NULL), $MainPage);
$lbl_test_id->HTML = true;
$test = new clsRecordtest("", $MainPage);
$MainPage->lbl_test_id = & $lbl_test_id;
$MainPage->test = & $test;
if(!is_array($lbl_test_id->Value) && !strlen($lbl_test_id->Value) && $lbl_test_id->Value !== false)
    $lbl_test_id->SetText(CCGetParam("test_id",""));
$test->Initialize();
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

//Execute Components @1-D0BB4ECC
$test->Operation();
//End Execute Components

//Go to destination page @1-B197440E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($test);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0D2307FE
$test->Show();
$lbl_test_id->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B37F6FF3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($test);
unset($Tpl);
//End Unload Page


?>
