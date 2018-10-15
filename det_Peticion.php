<?php
//Include Common Files @1-5C4CAD3E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "det_Peticion.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @930-78A66F85
include_once(RelativePath . "/detalle_peticion.php");
//End Include Page implementation

class clsEditableGridgrdDetalles { //grdDetalles Class @732-C5EF1E38

//Variables @732-0AADA924

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @732-D2CF806C
    function clsEditableGridgrdDetalles($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid grdDetalles/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "grdDetalles";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["estado_id"][0] = "estado_id";
        $this->CachedColumns["test_id"][0] = "test_id";
        $this->CachedColumns["detalle_peticion_id"][0] = "detalle_peticion_id";
        $this->DataSource = new clsgrdDetallesDataSource($this);
        $this->ds = & $this->DataSource;

        $this->EmptyRows = 0;
        $this->ReadAllowed = true;
        $this->Visible = (CCSecurityAccessCheck("4;5;8;11;12;13;14;15;16;17;18;19;20") == "success");
        if(!$this->Visible) return;

        $this->ReadAllowed = $this->ReadAllowed && CCUserInGroups(CCGetGroupID(), "4;5;8;11;12;13;14;15;16;17;18;19;20");
        $this->UpdateAllowed = CCUserInGroups(CCGetGroupID(), "4;5;8;11;12;13;14;15;16;17;18;19;20");
        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->lnk_detalles = new clsControl(ccsLink, "lnk_detalles", "lnk_detalles", ccsText, "", NULL, $this);
        $this->lnk_detalles->HTML = true;
        $this->lnk_detalles->Page = "";
        $this->lbl_class = new clsControl(ccsLabel, "lbl_class", "lbl_class", ccsText, "", NULL, $this);
        $this->lbl_class->HTML = true;
        $this->lbl_info = new clsControl(ccsLabel, "lbl_info", "lbl_info", ccsText, "", NULL, $this);
        $this->lbl_info->HTML = true;
        $this->detalle_compuesto = new clsControl(ccsLink, "detalle_compuesto", "detalle_compuesto", ccsText, "", NULL, $this);
        $this->detalle_compuesto->HTML = true;
        $this->detalle_compuesto->Page = "det_Peticion.php";
        $this->muestra_id = new clsControl(ccsLabel, "muestra_id", "muestra_id", ccsText, "", NULL, $this);
        $this->cod_test = new clsControl(ccsLabel, "cod_test", "Cod Test", ccsText, "", NULL, $this);
        $this->lbl_hidden = new clsControl(ccsLabel, "lbl_hidden", "lbl_hidden", ccsText, "", NULL, $this);
        $this->lbl_hidden->HTML = true;
        $this->precio = new clsControl(ccsTextBox, "precio", "Precio del Test", ccsInteger, "", NULL, $this);
        $this->precio->Required = true;
        $this->prioridad_id = new clsControl(ccsListBox, "prioridad_id", "Prioridad para el Test", ccsInteger, "", NULL, $this);
        $this->prioridad_id->DSType = dsTable;
        $this->prioridad_id->DataSource = new clsDBDatos();
        $this->prioridad_id->ds = & $this->prioridad_id->DataSource;
        $this->prioridad_id->DataSource->SQL = "SELECT * \n" .
"FROM prioridades {SQL_Where} {SQL_OrderBy}";
        list($this->prioridad_id->BoundColumn, $this->prioridad_id->TextColumn, $this->prioridad_id->DBFormat) = array("prioridad_id", "nom_prioridad", "");
        $this->prioridad_id->Required = true;
        $this->decompuesto = new clsControl(ccsHidden, "decompuesto", "decompuesto", ccsText, "", NULL, $this);
        $this->nom_estado = new clsControl(ccsLabel, "nom_estado", "Nom Estado", ccsText, "", NULL, $this);
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->lnkNueva = new clsControl(ccsImageLink, "lnkNueva", "lnkNueva", ccsText, "", NULL, $this);
        $this->lnkNueva->Page = "add_peticion.php";
        $this->lnkEditar = new clsControl(ccsImageLink, "lnkEditar", "lnkEditar", ccsText, "", NULL, $this);
        $this->lnkEditar->Parameters = CCAddParam($this->lnkEditar->Parameters, "peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->lnkEditar->Page = "edit_peticion.php";
        $this->lnkAbonos = new clsControl(ccsImageLink, "lnkAbonos", "lnkAbonos", ccsText, "", NULL, $this);
        $this->lnkAbonos->Parameters = CCAddParam($this->lnkAbonos->Parameters, "peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->lnkAbonos->Page = "list_pago_peticion.php";
        $this->lnkRecibo = new clsControl(ccsImageLink, "lnkRecibo", "lnkRecibo", ccsText, "", NULL, $this);
        $this->lnkRecibo->Page = "#";
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", NULL, $this);
        $this->ImageLink1->Page = "#";
        $this->lnkTomaMuestra = new clsControl(ccsImageLink, "lnkTomaMuestra", "lnkTomaMuestra", ccsText, "", NULL, $this);
        $this->lnkTomaMuestra->Parameters = CCAddParam($this->lnkTomaMuestra->Parameters, "peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->lnkTomaMuestra->Page = "ver_tomademuestra.php";
        $this->ImageLink2 = new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", NULL, $this);
        $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->ImageLink2->Page = "del_peticion.php";
        $this->ImageLink4 = new clsControl(ccsImageLink, "ImageLink4", "ImageLink4", ccsText, "", NULL, $this);
        $this->ImageLink4->Page = "";
        $this->lnkPendientes = new clsControl(ccsImageLink, "lnkPendientes", "lnkPendientes", ccsText, "", NULL, $this);
        $this->lnkPendientes->Page = "";
        $this->lnkResultados = new clsControl(ccsImageLink, "lnkResultados", "lnkResultados", ccsText, "", NULL, $this);
        $this->lnkResultados->Parameters = CCAddParam($this->lnkResultados->Parameters, "s_peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->lnkResultados->Page = "add_resultados_peticion2.php";
        $this->lnkValidar = new clsControl(ccsImageLink, "lnkValidar", "lnkValidar", ccsText, "", NULL, $this);
        $this->lnkValidar->Parameters = CCAddParam($this->lnkValidar->Parameters, "s_peticion_id", CCGetFromGet("peticion_id", NULL));
        $this->lnkValidar->Page = "validar_resultados_peticion.php";
        $this->lnkInformes = new clsControl(ccsImageLink, "lnkInformes", "lnkInformes", ccsText, "", NULL, $this);
        $this->lnkInformes->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->lnkInformes->Parameters = CCAddParam($this->lnkInformes->Parameters, "peticion_id", CCGetFromGet("s_peticion_id", NULL));
        $this->lnkInformes->Parameters = CCAddParam($this->lnkInformes->Parameters, "s_peticion_id", CCGetFromGet("s_peticion_id", NULL));
        $this->lnkInformes->Page = "list_informes.php";
    }
//End Class_Initialize Event

//Initialize Method @732-3DA453A4
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);
        $this->DataSource->Parameters["urlcondetalle"] = CCGetFromGet("condetalle", NULL);
        $this->DataSource->Parameters["urltest_main_id"] = CCGetFromGet("test_main_id", NULL);
    }
//End Initialize Method

//GetFormParameters Method @732-3C2CB47B
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["precio"][$RowNumber] = CCGetFromPost("precio_" . $RowNumber, NULL);
            $this->FormParameters["prioridad_id"][$RowNumber] = CCGetFromPost("prioridad_id_" . $RowNumber, NULL);
            $this->FormParameters["decompuesto"][$RowNumber] = CCGetFromPost("decompuesto_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @732-C26E742A
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["estado_id"] = $this->CachedColumns["estado_id"][$this->RowNumber];
            $this->DataSource->CachedColumns["test_id"] = $this->CachedColumns["test_id"][$this->RowNumber];
            $this->DataSource->CachedColumns["detalle_peticion_id"] = $this->CachedColumns["detalle_peticion_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->precio->SetText($this->FormParameters["precio"][$this->RowNumber], $this->RowNumber);
            $this->prioridad_id->SetText($this->FormParameters["prioridad_id"][$this->RowNumber], $this->RowNumber);
            $this->decompuesto->SetText($this->FormParameters["decompuesto"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                $Validation = ($this->ValidateRow($this->RowNumber) && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @732-595A3DC4
    function ValidateRow()
    {
        global $CCSLocales;
        $this->precio->Validate();
        $this->prioridad_id->Validate();
        $this->decompuesto->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->precio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prioridad_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->decompuesto->Errors->ToString());
        $this->precio->Errors->Clear();
        $this->prioridad_id->Errors->Clear();
        $this->decompuesto->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @732-A8634BC1
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["precio"][$this->RowNumber]) && count($this->FormParameters["precio"][$this->RowNumber])) || strlen($this->FormParameters["precio"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["prioridad_id"][$this->RowNumber]) && count($this->FormParameters["prioridad_id"][$this->RowNumber])) || strlen($this->FormParameters["prioridad_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["decompuesto"][$this->RowNumber]) && count($this->FormParameters["decompuesto"][$this->RowNumber])) || strlen($this->FormParameters["decompuesto"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @732-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @732-909F269B
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @732-18A2FF86
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["estado_id"] = $this->CachedColumns["estado_id"][$this->RowNumber];
            $this->DataSource->CachedColumns["test_id"] = $this->CachedColumns["test_id"][$this->RowNumber];
            $this->DataSource->CachedColumns["detalle_peticion_id"] = $this->CachedColumns["detalle_peticion_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->precio->SetText($this->FormParameters["precio"][$this->RowNumber], $this->RowNumber);
            $this->prioridad_id->SetText($this->FormParameters["prioridad_id"][$this->RowNumber], $this->RowNumber);
            $this->decompuesto->SetText($this->FormParameters["decompuesto"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->UpdateAllowed) { $Validation = ($this->UpdateRow() && $Validation); }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//UpdateRow Method @732-1C5B0E9B
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->precio->SetValue($this->precio->GetValue(true));
        $this->DataSource->prioridad_id->SetValue($this->prioridad_id->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//FormScript Method @732-49D33F41
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var grdDetallesElements;\n";
        $script .= "var grdDetallesEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "precioID = 0;\n";
        $script .= "var " . $this->ComponentName . "prioridad_idID = 1;\n";
        $script .= "var " . $this->ComponentName . "decompuestoID = 2;\n";
        $script .= "\nfunction initgrdDetallesElements() {\n";
        $script .= "\tvar ED = document.forms[\"grdDetalles\"];\n";
        $script .= "\tgrdDetallesElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.precio_" . $i . ", " . "ED.prioridad_id_" . $i . ", " . "ED.decompuesto_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @732-69A67CE3
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 3)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["estado_id"][$RowNumber] = $piece;
                $piece = $pieces[$i + 1];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["test_id"][$RowNumber] = $piece;
                $piece = $pieces[$i + 2];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["detalle_peticion_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["estado_id"][$RowNumber] = "";
                $this->CachedColumns["test_id"][$RowNumber] = "";
                $this->CachedColumns["detalle_peticion_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @732-69CEA9A4
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["estado_id"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["test_id"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["detalle_peticion_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @732-4524144A
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->prioridad_id->Prepare();

        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["lbl_class"] = $this->lbl_class->Visible;
        $this->ControlsVisible["lbl_info"] = $this->lbl_info->Visible;
        $this->ControlsVisible["detalle_compuesto"] = $this->detalle_compuesto->Visible;
        $this->ControlsVisible["muestra_id"] = $this->muestra_id->Visible;
        $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
        $this->ControlsVisible["lbl_hidden"] = $this->lbl_hidden->Visible;
        $this->ControlsVisible["precio"] = $this->precio->Visible;
        $this->ControlsVisible["prioridad_id"] = $this->prioridad_id->Visible;
        $this->ControlsVisible["decompuesto"] = $this->decompuesto->Visible;
        $this->ControlsVisible["nom_estado"] = $this->nom_estado->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["estado_id"][$this->RowNumber] = $this->DataSource->CachedColumns["estado_id"];
                    $this->CachedColumns["test_id"][$this->RowNumber] = $this->DataSource->CachedColumns["test_id"];
                    $this->CachedColumns["detalle_peticion_id"][$this->RowNumber] = $this->DataSource->CachedColumns["detalle_peticion_id"];
                    $this->lbl_class->SetText("");
                    $this->lbl_info->SetText("");
                    $this->detalle_compuesto->SetText("");
                    $this->lbl_hidden->SetText("");
                    $this->detalle_compuesto->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->detalle_compuesto->Parameters = CCAddParam($this->detalle_compuesto->Parameters, "test_main_id", $this->DataSource->f("test_main_id"));
                    $this->muestra_id->SetValue($this->DataSource->muestra_id->GetValue());
                    $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                    $this->precio->SetValue($this->DataSource->precio->GetValue());
                    $this->prioridad_id->SetValue($this->DataSource->prioridad_id->GetValue());
                    $this->decompuesto->SetValue($this->DataSource->decompuesto->GetValue());
                    $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->lbl_class->SetText("");
                    $this->lbl_info->SetText("");
                    $this->detalle_compuesto->SetText("");
                    $this->muestra_id->SetText("");
                    $this->cod_test->SetText("");
                    $this->lbl_hidden->SetText("");
                    $this->nom_estado->SetText("");
                    $this->muestra_id->SetValue($this->DataSource->muestra_id->GetValue());
                    $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                    $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                    $this->precio->SetText($this->FormParameters["precio"][$this->RowNumber], $this->RowNumber);
                    $this->prioridad_id->SetText($this->FormParameters["prioridad_id"][$this->RowNumber], $this->RowNumber);
                    $this->decompuesto->SetText($this->FormParameters["decompuesto"][$this->RowNumber], $this->RowNumber);
                    $this->detalle_compuesto->Parameters = CCAddParam($this->detalle_compuesto->Parameters, "test_main_id", $this->DataSource->f("test_main_id"));
                    $this->detalle_compuesto->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["estado_id"][$this->RowNumber] = "";
                    $this->CachedColumns["test_id"][$this->RowNumber] = "";
                    $this->CachedColumns["detalle_peticion_id"][$this->RowNumber] = "";
                    $this->lbl_class->SetText("");
                    $this->lbl_info->SetText("");
                    $this->detalle_compuesto->SetText("");
                    $this->muestra_id->SetText("");
                    $this->cod_test->SetText("");
                    $this->lbl_hidden->SetText("");
                    $this->precio->SetText("");
                    $this->prioridad_id->SetText("");
                    $this->decompuesto->SetText("");
                    $this->nom_estado->SetText("");
                    $this->detalle_compuesto->Parameters = CCAddParam($this->detalle_compuesto->Parameters, "test_main_id", $this->DataSource->f("test_main_id"));
                } else {
                    $this->lbl_class->SetText("");
                    $this->lbl_info->SetText("");
                    $this->detalle_compuesto->SetText("");
                    $this->muestra_id->SetText("");
                    $this->cod_test->SetText("");
                    $this->lbl_hidden->SetText("");
                    $this->nom_estado->SetText("");
                    $this->precio->SetText($this->FormParameters["precio"][$this->RowNumber], $this->RowNumber);
                    $this->prioridad_id->SetText($this->FormParameters["prioridad_id"][$this->RowNumber], $this->RowNumber);
                    $this->decompuesto->SetText($this->FormParameters["decompuesto"][$this->RowNumber], $this->RowNumber);
                    $this->detalle_compuesto->Parameters = CCAddParam($this->detalle_compuesto->Parameters, "test_main_id", $this->DataSource->f("test_main_id"));
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lbl_class->Show($this->RowNumber);
                $this->lbl_info->Show($this->RowNumber);
                $this->detalle_compuesto->Show($this->RowNumber);
                $this->muestra_id->Show($this->RowNumber);
                $this->cod_test->Show($this->RowNumber);
                $this->lbl_hidden->Show($this->RowNumber);
                $this->precio->Show($this->RowNumber);
                $this->prioridad_id->Show($this->RowNumber);
                $this->decompuesto->Show($this->RowNumber);
                $this->nom_estado->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["estado_id"] == $this->CachedColumns["estado_id"][$this->RowNumber]) && ($this->DataSource->CachedColumns["test_id"] == $this->CachedColumns["test_id"][$this->RowNumber]) && ($this->DataSource->CachedColumns["detalle_peticion_id"] == $this->CachedColumns["detalle_peticion_id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->lnk_detalles->Show();
        $this->Button_Submit->Show();
        $this->lnkNueva->Show();
        $this->lnkEditar->Show();
        $this->lnkAbonos->Show();
        $this->lnkRecibo->Show();
        $this->ImageLink1->Show();
        $this->lnkTomaMuestra->Show();
        $this->ImageLink2->Show();
        $this->ImageLink4->Show();
        $this->lnkPendientes->Show();
        $this->lnkResultados->Show();
        $this->lnkValidar->Show();
        $this->lnkInformes->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End grdDetalles Class @732-FCB6E20C

class clsgrdDetallesDataSource extends clsDBDatos {  //grdDetallesDataSource Class @732-37B9529D

//DataSource Variables @732-43ACF1B0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $UpdateFields = array();

    // Datasource fields
    public $lbl_class;
    public $lbl_info;
    public $detalle_compuesto;
    public $muestra_id;
    public $cod_test;
    public $lbl_hidden;
    public $precio;
    public $prioridad_id;
    public $decompuesto;
    public $nom_estado;
//End DataSource Variables

//DataSourceClass_Initialize Event @732-0EE2EB57
    function clsgrdDetallesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid grdDetalles/Error";
        $this->Initialize();
        $this->lbl_class = new clsField("lbl_class", ccsText, "");
        
        $this->lbl_info = new clsField("lbl_info", ccsText, "");
        
        $this->detalle_compuesto = new clsField("detalle_compuesto", ccsText, "");
        
        $this->muestra_id = new clsField("muestra_id", ccsText, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->lbl_hidden = new clsField("lbl_hidden", ccsText, "");
        
        $this->precio = new clsField("precio", ccsInteger, "");
        
        $this->prioridad_id = new clsField("prioridad_id", ccsInteger, "");
        
        $this->decompuesto = new clsField("decompuesto", ccsText, "");
        
        $this->nom_estado = new clsField("nom_estado", ccsText, "");
        

        $this->UpdateFields["precio"] = array("Name" => "precio", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["prioridad_id"] = array("Name" => "prioridad_id", "Value" => "", "DataType" => ccsInteger);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @732-2DE32BB7
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "test_main_id, decompuesto desc, cod_test";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @732-1DD96DC0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
        $this->wp->AddParameter("2", "urlcondetalle", ccsText, "", "", $this->Parameters["urlcondetalle"], 'V', false);
        $this->wp->AddParameter("3", "urltest_main_id", ccsInteger, "", "", $this->Parameters["urltest_main_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "peticiones_detalle.peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opNotEqual, "peticiones_detalle.decompuesto", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "peticiones_detalle.test_main_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], $this->wp->opOR(
             true, 
             $this->wp->Criterion[2], 
             $this->wp->Criterion[3]));
    }
//End Prepare Method

//Open Method @732-83F1FE8E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (peticiones_detalle LEFT JOIN estados ON\n\n" .
        "peticiones_detalle.estado_id = estados.estado_id) LEFT JOIN test ON\n\n" .
        "peticiones_detalle.test_id = test.test_id";
        $this->SQL = "SELECT nom_estado, peticiones_detalle.*, cod_test, nom_test \n\n" .
        "FROM (peticiones_detalle LEFT JOIN estados ON\n\n" .
        "peticiones_detalle.estado_id = estados.estado_id) LEFT JOIN test ON\n\n" .
        "peticiones_detalle.test_id = test.test_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @732-FF803653
    function SetValues()
    {
        $this->CachedColumns["estado_id"] = $this->f("estado_id");
        $this->CachedColumns["test_id"] = $this->f("test_id");
        $this->CachedColumns["detalle_peticion_id"] = $this->f("detalle_peticion_id");
        $this->muestra_id->SetDBValue($this->f("muestra_id"));
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->precio->SetDBValue(trim($this->f("precio")));
        $this->prioridad_id->SetDBValue(trim($this->f("prioridad_id")));
        $this->decompuesto->SetDBValue($this->f("decompuesto"));
        $this->nom_estado->SetDBValue($this->f("nom_estado"));
    }
//End SetValues Method

//Update Method @732-FECECDCD
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["precio"] = new clsSQLParameter("ctrlprecio", ccsInteger, "", "", $this->precio->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["prioridad_id"] = new clsSQLParameter("ctrlprioridad_id", ccsInteger, "", "", $this->prioridad_id->GetValue(true), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsdetalle_peticion_id", ccsInteger, "", "", $this->CachedColumns["detalle_peticion_id"], 0, false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["precio"]->GetValue()) and !strlen($this->cp["precio"]->GetText()) and !is_bool($this->cp["precio"]->GetValue())) 
            $this->cp["precio"]->SetValue($this->precio->GetValue(true));
        if (!is_null($this->cp["prioridad_id"]->GetValue()) and !strlen($this->cp["prioridad_id"]->GetText()) and !is_bool($this->cp["prioridad_id"]->GetValue())) 
            $this->cp["prioridad_id"]->SetValue($this->prioridad_id->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "detalle_peticion_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["precio"]["Value"] = $this->cp["precio"]->GetDBValue(true);
        $this->UpdateFields["prioridad_id"]["Value"] = $this->cp["prioridad_id"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("peticiones_detalle", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
			echo "<pre>". $thid
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End grdDetallesDataSource Class @732-FCB6E20C

class clsGridDetBitacora { //DetBitacora class @909-8F9CB984

//Variables @909-8BB04DCC

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
    public $Tipo;
    public $Sorter_nom_estado;
    public $Sorter_nom_usuario;
//End Variables

//Class_Initialize Event @909-EDD6B8FD
    function clsGridDetBitacora($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "DetBitacora";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid DetBitacora";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsDetBitacoraDataSource($this);
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
        $this->SorterName = CCGetParam("DetBitacoraOrder", "");
        $this->SorterDirection = CCGetParam("DetBitacoraDir", "");

        $this->lnkAccion = new clsControl(ccsLink, "lnkAccion", "lnkAccion", ccsText, "", CCGetRequestParam("lnkAccion", ccsGet, NULL), $this);
        $this->lnkAccion->HTML = true;
        $this->lnkAccion->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->lnkAccion->Page = "";
        $this->estado_id = new clsControl(ccsHidden, "estado_id", "estado_id", ccsInteger, "", CCGetRequestParam("estado_id", ccsGet, NULL), $this);
        $this->bitacora_id = new clsControl(ccsHidden, "bitacora_id", "bitacora_id", ccsInteger, "", CCGetRequestParam("bitacora_id", ccsGet, NULL), $this);
        $this->tipo_bitacora_id = new clsControl(ccsHidden, "tipo_bitacora_id", "tipo_bitacora_id", ccsText, "", CCGetRequestParam("tipo_bitacora_id", ccsGet, NULL), $this);
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "-", "mm", "-", "yyyy", " ", "h", ":", "nn", " ", "AM/PM"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->descripcion = new clsControl(ccsLabel, "descripcion", "descripcion", ccsMemo, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->nom_tipo_bitacora = new clsControl(ccsLabel, "nom_tipo_bitacora", "nom_tipo_bitacora", ccsText, "", CCGetRequestParam("nom_tipo_bitacora", ccsGet, NULL), $this);
        $this->nom_estado = new clsControl(ccsLabel, "nom_estado", "nom_estado", ccsText, "", CCGetRequestParam("nom_estado", ccsGet, NULL), $this);
        $this->nom_usuario = new clsControl(ccsLabel, "nom_usuario", "nom_usuario", ccsText, "", CCGetRequestParam("nom_usuario", ccsGet, NULL), $this);
        $this->Sorter_fecha = new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Tipo = new clsSorter($this->ComponentName, "Tipo", $FileName, $this);
        $this->Sorter_nom_estado = new clsSorter($this->ComponentName, "Sorter_nom_estado", $FileName, $this);
        $this->Sorter_nom_usuario = new clsSorter($this->ComponentName, "Sorter_nom_usuario", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @909-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @909-969DD81A
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);
        $this->DataSource->Parameters["expr940"] = CCGetGroupID();

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
            $this->ControlsVisible["lnkAccion"] = $this->lnkAccion->Visible;
            $this->ControlsVisible["estado_id"] = $this->estado_id->Visible;
            $this->ControlsVisible["bitacora_id"] = $this->bitacora_id->Visible;
            $this->ControlsVisible["tipo_bitacora_id"] = $this->tipo_bitacora_id->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["nom_tipo_bitacora"] = $this->nom_tipo_bitacora->Visible;
            $this->ControlsVisible["nom_estado"] = $this->nom_estado->Visible;
            $this->ControlsVisible["nom_usuario"] = $this->nom_usuario->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->estado_id->SetValue($this->DataSource->estado_id->GetValue());
                $this->bitacora_id->SetValue($this->DataSource->bitacora_id->GetValue());
                $this->tipo_bitacora_id->SetValue($this->DataSource->tipo_bitacora_id->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->nom_tipo_bitacora->SetValue($this->DataSource->nom_tipo_bitacora->GetValue());
                $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lnkAccion->Show();
                $this->estado_id->Show();
                $this->bitacora_id->Show();
                $this->tipo_bitacora_id->Show();
                $this->fecha->Show();
                $this->descripcion->Show();
                $this->nom_tipo_bitacora->Show();
                $this->nom_estado->Show();
                $this->nom_usuario->Show();
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
        $this->Sorter_fecha->Show();
        $this->Tipo->Show();
        $this->Sorter_nom_estado->Show();
        $this->Sorter_nom_usuario->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @909-E2B01AB3
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lnkAccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->estado_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->bitacora_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_bitacora_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_tipo_bitacora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End DetBitacora Class @909-FCB6E20C

class clsDetBitacoraDataSource extends clsDBDatos {  //DetBitacoraDataSource Class @909-0426F228

//DataSource Variables @909-E2DD5AB8
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $estado_id;
    public $bitacora_id;
    public $tipo_bitacora_id;
    public $fecha;
    public $descripcion;
    public $nom_tipo_bitacora;
    public $nom_estado;
    public $nom_usuario;
//End DataSource Variables

//DataSourceClass_Initialize Event @909-8F237425
    function clsDetBitacoraDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid DetBitacora";
        $this->Initialize();
        $this->estado_id = new clsField("estado_id", ccsInteger, "");
        
        $this->bitacora_id = new clsField("bitacora_id", ccsInteger, "");
        
        $this->tipo_bitacora_id = new clsField("tipo_bitacora_id", ccsText, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->descripcion = new clsField("descripcion", ccsMemo, "");
        
        $this->nom_tipo_bitacora = new clsField("nom_tipo_bitacora", ccsText, "");
        
        $this->nom_estado = new clsField("nom_estado", ccsText, "");
        
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @909-A6780FE1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_fecha" => array("fecha", ""), 
            "Tipo" => array("nom_tipo_bitacora", ""), 
            "Sorter_nom_estado" => array("nom_estado", ""), 
            "Sorter_nom_usuario" => array("nom_usuario", "")));
    }
//End SetOrder Method

//Prepare Method @909-62A4D9DA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
        $this->wp->AddParameter("2", "expr940", ccsInteger, "", "", $this->Parameters["expr940"], 0, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "bitacora.peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opLessThanOrEqual, "bitacora.nivel_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @909-BF8D84EE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((bitacora LEFT JOIN tipos_bitacora ON\n\n" .
        "bitacora.tipo_bitacora_id = tipos_bitacora.tipo_bitacora_id) LEFT JOIN usuarios ON\n\n" .
        "bitacora.usuario_id = usuarios.usuario_id) LEFT JOIN estados ON\n\n" .
        "bitacora.estado_id = estados.estado_id";
        $this->SQL = "SELECT bitacora.*, nom_tipo_bitacora, nom_usuario, nom_estado \n\n" .
        "FROM ((bitacora LEFT JOIN tipos_bitacora ON\n\n" .
        "bitacora.tipo_bitacora_id = tipos_bitacora.tipo_bitacora_id) LEFT JOIN usuarios ON\n\n" .
        "bitacora.usuario_id = usuarios.usuario_id) LEFT JOIN estados ON\n\n" .
        "bitacora.estado_id = estados.estado_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @909-0AB31F61
    function SetValues()
    {
        $this->estado_id->SetDBValue(trim($this->f("estado_id")));
        $this->bitacora_id->SetDBValue(trim($this->f("bitacora_id")));
        $this->tipo_bitacora_id->SetDBValue($this->f("tipo_bitacora_id"));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->nom_tipo_bitacora->SetDBValue($this->f("nom_tipo_bitacora"));
        $this->nom_estado->SetDBValue($this->f("nom_estado"));
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
    }
//End SetValues Method

} //End DetBitacoraDataSource Class @909-FCB6E20C

//Initialize Page @1-7DAEB2FC
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
$TemplateFileName = "det_Peticion.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-97F21E60
CCSecurityRedirect("4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-7380DF4B
include_once("./det_Peticion_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C500840C
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$lblRutaDetalle = new clsControl(ccsLabel, "lblRutaDetalle", "lblRutaDetalle", ccsText, "", CCGetRequestParam("lblRutaDetalle", ccsGet, NULL), $MainPage);
$lblRutaDetalle->HTML = true;
$fun_muestrarecibo = new clsControl(ccsLabel, "fun_muestrarecibo", "fun_muestrarecibo", ccsText, "", CCGetRequestParam("fun_muestrarecibo", ccsGet, NULL), $MainPage);
$fun_muestrarecibo->HTML = true;
$detalle_peticion = new clsdetalle_peticion("", "detalle_peticion", $MainPage);
$detalle_peticion->Initialize();
$grdDetalles = new clsEditableGridgrdDetalles("", $MainPage);
$DetBitacora = new clsGridDetBitacora("", $MainPage);
$MainPage->lblRutaDetalle = & $lblRutaDetalle;
$MainPage->fun_muestrarecibo = & $fun_muestrarecibo;
$MainPage->detalle_peticion = & $detalle_peticion;
$MainPage->grdDetalles = & $grdDetalles;
$MainPage->DetBitacora = & $DetBitacora;
$grdDetalles->Initialize();
$DetBitacora->Initialize();
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

//Execute Components @1-CC8CD93B
$grdDetalles->Operation();
$detalle_peticion->Operations();
//End Execute Components

//Go to destination page @1-A297DF3C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    $detalle_peticion->Class_Terminate();
    unset($detalle_peticion);
    unset($grdDetalles);
    unset($DetBitacora);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-494413FD
$detalle_peticion->Show();
$grdDetalles->Show();
$DetBitacora->Show();
$lblRutaDetalle->Show();
$fun_muestrarecibo->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-31E895F9
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
$detalle_peticion->Class_Terminate();
unset($detalle_peticion);
unset($grdDetalles);
unset($DetBitacora);
unset($Tpl);
//End Unload Page


?>
