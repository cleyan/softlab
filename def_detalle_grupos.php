<?php
//Include Common Files @1-87D64A07
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "def_detalle_grupos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsEditableGridgrupos_detalle { //grupos_detalle Class @2-6E7AA6DE

//Variables @2-0AADA924

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

//Class_Initialize Event @2-3187312F
    function clsEditableGridgrupos_detalle($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid grupos_detalle/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "grupos_detalle";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["grupo_detalle_id"][0] = "grupo_detalle_id";
        $this->DataSource = new clsgrupos_detalleDataSource($this);
        $this->ds = & $this->DataSource;

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

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

        $this->nom_grupo = new clsControl(ccsLabel, "nom_grupo", "nom_grupo", ccsText, "", NULL, $this);
        $this->grupos_detalle_TotalRecords = new clsControl(ccsLabel, "grupos_detalle_TotalRecords", "grupos_detalle_TotalRecords", ccsText, "", NULL, $this);
        $this->renum_informe = new clsControl(ccsImageLink, "renum_informe", "renum_informe", ccsText, "", NULL, $this);
        $this->renum_informe->Page = "def_detalle_grupos.php";
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", NULL, $this);
        $this->ImageLink1->Page = "edit_orden.php";
        $this->test_id = new clsControl(ccsListBox, "test_id", "Test Id", ccsInteger, "", NULL, $this);
        $this->test_id->DSType = dsSQL;
        $this->test_id->DataSource = new clsDBDatos();
        $this->test_id->ds = & $this->test_id->DataSource;
        list($this->test_id->BoundColumn, $this->test_id->TextColumn, $this->test_id->DBFormat) = array("test_id", "cod_test", "");
        $this->test_id->DataSource->Parameters["urlinforme_id"] = CCGetFromGet("informe_id", NULL);
        $this->test_id->DataSource->wp = new clsSQLParameters();
        $this->test_id->DataSource->wp->AddParameter("1", "urlinforme_id", ccsInteger, "", "", $this->test_id->DataSource->Parameters["urlinforme_id"], 0, false);
        $this->test_id->DataSource->SQL = "SELECT\n" .
        "  informes_detalle.informe_id,\n" .
        "  test.cod_test,\n" .
        "  test.nom_test,\n" .
        "  test.orden_informe,\n" .
        "  informes_detalle.test_id\n" .
        "FROM\n" .
        "  informes_detalle\n" .
        "  INNER JOIN test ON (informes_detalle.test_id = test.test_id)\n" .
        "WHERE\n" .
        "  (informes_detalle.informe_id = " . $this->test_id->DataSource->SQLValue($this->test_id->DataSource->wp->GetDBValue("1"), ccsInteger) . ") AND\n" .
        "  (test.compuesto = 'F')  \n" .
        "  UNION\n" .
        "  \n" .
        "  SELECT\n" .
        "  informes_detalle.informe_id,\n" .
        "  test.cod_test,\n" .
        "  test.nom_test,\n" .
        "  test.orden_informe,\n" .
        "  test.test_id\n" .
        "FROM\n" .
        "  informes_detalle\n" .
        "  INNER JOIN compuesto_detalle ON (informes_detalle.test_id = compuesto_detalle.comp_test_id)\n" .
        "  INNER JOIN test ON (compuesto_detalle.test_id = test.test_id)\n" .
        "WHERE\n" .
        "  (informes_detalle.informe_id = " . $this->test_id->DataSource->SQLValue($this->test_id->DataSource->wp->GetDBValue("1"), ccsInteger) . ") {SQL_OrderBy}";
        $this->test_id->DataSource->Order = "cod_test";
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", NULL, $this);
        $this->imgsube = new clsControl(ccsLink, "imgsube", "imgsube", ccsText, "", NULL, $this);
        $this->imgsube->HTML = true;
        $this->imgsube->Page = "def_detalle_grupos.php";
        $this->orden_informe = new clsControl(ccsLabel, "orden_informe", "orden_informe", ccsText, "", NULL, $this);
        $this->img_baja = new clsControl(ccsLink, "img_baja", "img_baja", ccsText, "", NULL, $this);
        $this->img_baja->HTML = true;
        $this->img_baja->Page = "def_detalle_grupos.php";
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-2B4F9EEF
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlgrupo_id"] = CCGetFromGet("grupo_id", NULL);
    }
//End Initialize Method

//GetFormParameters Method @2-9D0C5099
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["test_id"][$RowNumber] = CCGetFromPost("test_id_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-8B34A528
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["grupo_detalle_id"] = $this->CachedColumns["grupo_detalle_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @2-1E8E6A05
    function ValidateRow()
    {
        global $CCSLocales;
        $this->test_id->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->test_id->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-01E55D26
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["test_id"][$this->RowNumber]) && count($this->FormParameters["test_id"][$this->RowNumber])) || strlen($this->FormParameters["test_id"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @2-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-6C7F91A1
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
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "accion"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            } else {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "accion", "accion"));
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            } else {
                $Redirect = "def_grupos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "accion", "accion"));
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @2-DD956823
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["grupo_detalle_id"] = $this->CachedColumns["grupo_detalle_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
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

//InsertRow Method @2-83DA1699
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @2-D33E31DC
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
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

//DeleteRow Method @2-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @2-F5380AE0
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var grupos_detalleElements;\n";
        $script .= "var grupos_detalleEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "test_idID = 0;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 1;\n";
        $script .= "\nfunction initgrupos_detalleElements() {\n";
        $script .= "\tvar ED = document.forms[\"grupos_detalle\"];\n";
        $script .= "\tgrupos_detalleElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.test_id_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-766FC6F6
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
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["grupo_detalle_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["grupo_detalle_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-0D7C1266
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["grupo_detalle_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-5B207228
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->test_id->Prepare();

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
        $this->ControlsVisible["test_id"] = $this->test_id->Visible;
        $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
        $this->ControlsVisible["imgsube"] = $this->imgsube->Visible;
        $this->ControlsVisible["orden_informe"] = $this->orden_informe->Visible;
        $this->ControlsVisible["img_baja"] = $this->img_baja->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["grupo_detalle_id"][$this->RowNumber] = $this->DataSource->CachedColumns["grupo_detalle_id"];
                    $this->imgsube->SetText("");
                    $this->img_baja->SetText("");
                    $this->CheckBox_Delete->SetValue(false);
                    $this->test_id->SetValue($this->DataSource->test_id->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->imgsube->Parameters = CCGetQueryString("QueryString", array("test_id", "grupo_id", "accion", "ccsForm"));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "test_id", $this->DataSource->f("test_id"));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "informe_id", CCGetFromGet("informe_id", NULL));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "accion", "sube_inf");
                    $this->orden_informe->SetValue($this->DataSource->orden_informe->GetValue());
                    $this->img_baja->Parameters = CCGetQueryString("QueryString", array("test_id", "grupo_id", "accion", "ccsForm"));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "test_id", $this->DataSource->f("test_id"));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "informe_id", CCGetFromGet("informe_id", NULL));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "accion", "baja_inf");
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->nom_test->SetText("");
                    $this->imgsube->SetText("");
                    $this->orden_informe->SetText("");
                    $this->img_baja->SetText("");
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->orden_informe->SetValue($this->DataSource->orden_informe->GetValue());
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "test_id", $this->DataSource->f("test_id"));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "informe_id", CCGetFromGet("informe_id", NULL));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "accion", "sube_inf");
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "test_id", $this->DataSource->f("test_id"));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "informe_id", CCGetFromGet("informe_id", NULL));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "accion", "baja_inf");
                    $this->imgsube->Parameters = CCGetQueryString("QueryString", array("test_id", "grupo_id", "accion", "ccsForm"));
                    $this->img_baja->Parameters = CCGetQueryString("QueryString", array("test_id", "grupo_id", "accion", "ccsForm"));
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["grupo_detalle_id"][$this->RowNumber] = "";
                    $this->test_id->SetText("");
                    $this->nom_test->SetText("");
                    $this->imgsube->SetText("");
                    $this->orden_informe->SetText("");
                    $this->img_baja->SetText("");
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "test_id", $this->DataSource->f("test_id"));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "informe_id", CCGetFromGet("informe_id", NULL));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "accion", "sube_inf");
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "test_id", $this->DataSource->f("test_id"));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "informe_id", CCGetFromGet("informe_id", NULL));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "accion", "baja_inf");
                } else {
                    $this->nom_test->SetText("");
                    $this->imgsube->SetText("");
                    $this->orden_informe->SetText("");
                    $this->img_baja->SetText("");
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "test_id", $this->DataSource->f("test_id"));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "informe_id", CCGetFromGet("informe_id", NULL));
                    $this->imgsube->Parameters = CCAddParam($this->imgsube->Parameters, "accion", "sube_inf");
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "test_id", $this->DataSource->f("test_id"));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "informe_id", CCGetFromGet("informe_id", NULL));
                    $this->img_baja->Parameters = CCAddParam($this->img_baja->Parameters, "accion", "baja_inf");
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->test_id->Show($this->RowNumber);
                $this->nom_test->Show($this->RowNumber);
                $this->imgsube->Show($this->RowNumber);
                $this->orden_informe->Show($this->RowNumber);
                $this->img_baja->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["grupo_detalle_id"] == $this->CachedColumns["grupo_detalle_id"][$this->RowNumber])) {
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
        $this->renum_informe->Parameters = CCGetQueryString("QueryString", array("test_id", "grupo_id", "accion", "ccsForm"));
        $this->renum_informe->Parameters = CCAddParam($this->renum_informe->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
        $this->renum_informe->Parameters = CCAddParam($this->renum_informe->Parameters, "informe_id", CCGetFromGet("informe_id", NULL));
        $this->renum_informe->Parameters = CCAddParam($this->renum_informe->Parameters, "accion", "renumerar_inf");
        $this->renum_informe->Parameters = CCAddParam($this->renum_informe->Parameters, "grupos_detalleOrder", "Orden_en_Informe");
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "grupo_id", CCGetFromGet("grupo_id", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "grupos_detalle_test_grupoOrder", "Sorter_orden_informe");
        $this->nom_grupo->Show();
        $this->grupos_detalle_TotalRecords->Show();
        $this->renum_informe->Show();
        $this->ImageLink1->Show();
        $this->Button_Submit->Show();
        $this->Cancel->Show();

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

} //End grupos_detalle Class @2-FCB6E20C

class clsgrupos_detalleDataSource extends clsDBDatos {  //grupos_detalleDataSource Class @2-99B562FF

//DataSource Variables @2-29D75B92
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $test_id;
    public $nom_test;
    public $imgsube;
    public $orden_informe;
    public $img_baja;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-CEA6B9A2
    function clsgrupos_detalleDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid grupos_detalle/Error";
        $this->Initialize();
        $this->test_id = new clsField("test_id", ccsInteger, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->imgsube = new clsField("imgsube", ccsText, "");
        
        $this->orden_informe = new clsField("orden_informe", ccsText, "");
        
        $this->img_baja = new clsField("img_baja", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["grupo_id"] = array("Name" => "grupo_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B865A5CE
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "orden_informe, nom_test";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-2C59890B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgrupo_id", ccsInteger, "", "", $this->Parameters["urlgrupo_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "grupo_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-8851AAE5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM grupos_detalle LEFT JOIN test ON\n\n" .
        "grupos_detalle.test_id = test.test_id";
        $this->SQL = "SELECT grupos_detalle.*, nom_test, orden_informe, orden_ingreso \n\n" .
        "FROM grupos_detalle LEFT JOIN test ON\n\n" .
        "grupos_detalle.test_id = test.test_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D9F0BDBB
    function SetValues()
    {
        $this->CachedColumns["grupo_detalle_id"] = $this->f("grupo_detalle_id");
        $this->test_id->SetDBValue(trim($this->f("test_id")));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->orden_informe->SetDBValue($this->f("orden_informe"));
    }
//End SetValues Method

//Insert Method @2-094FC579
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["test_id"] = new clsSQLParameter("ctrltest_id", ccsInteger, "", "", $this->test_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["grupo_id"] = new clsSQLParameter("urlgrupo_id", ccsInteger, "", "", CCGetFromGet("grupo_id", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetValue($this->test_id->GetValue(true));
        if (!is_null($this->cp["grupo_id"]->GetValue()) and !strlen($this->cp["grupo_id"]->GetText()) and !is_bool($this->cp["grupo_id"]->GetValue())) 
            $this->cp["grupo_id"]->SetText(CCGetFromGet("grupo_id", NULL));
        $this->InsertFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->InsertFields["grupo_id"]["Value"] = $this->cp["grupo_id"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("grupos_detalle", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-2BEF343C
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->cp["test_id"] = new clsSQLParameter("ctrltest_id", ccsInteger, "", "", $this->test_id->GetValue(true), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsgrupo_detalle_id", ccsInteger, "", "", $this->CachedColumns["grupo_detalle_id"], 0, false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetValue($this->test_id->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "grupo_detalle_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("grupos_detalle", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-016E9A09
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsgrupo_detalle_id", ccsInteger, "", "", $this->CachedColumns["grupo_detalle_id"], 0, false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "urlgrupo_id", ccsInteger, "", "", CCGetFromGet("grupo_id", NULL), 0, false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $wp->Criterion[1] = $wp->Operation(opEqual, "grupo_detalle_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "grupo_id", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsInteger),false);
        $Where = $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]);
        $this->SQL = "DELETE FROM grupos_detalle";
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End grupos_detalleDataSource Class @2-FCB6E20C

//Initialize Page @1-1DE3B3C1
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
$TemplateFileName = "def_detalle_grupos.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-92DD033C
include_once("./def_detalle_grupos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-893E5C46
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$grupos_detalle = new clsEditableGridgrupos_detalle("", $MainPage);
$MainPage->grupos_detalle = & $grupos_detalle;
$grupos_detalle->Initialize();
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

//Execute Components @1-DC6DEEA6
$grupos_detalle->Operation();
//End Execute Components

//Go to destination page @1-4FD962AB
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($grupos_detalle);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F99D49C5
$grupos_detalle->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1321B665
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($grupos_detalle);
unset($Tpl);
//End Unload Page


?>
