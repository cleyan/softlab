<?php
//Include Common Files @1-2108F85C
define("RelativePath", "..");
define("PathToCurrentPage", "/Ayuda/");
define("FileName", "config_mensajes.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsEditableGridmensajes_ayuda { //mensajes_ayuda Class @2-22004C69

//Variables @2-8AAA8AE1

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
    public $Sorter_mensaje_ayuda_id;
    public $Sorter_nom_pagina;
    public $Sorter_nom_mensaje;
    public $Sorter_icono_id;
//End Variables

//Class_Initialize Event @2-95EA7020
    function clsEditableGridmensajes_ayuda($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid mensajes_ayuda/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "mensajes_ayuda";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["mensaje_ayuda_id"][0] = "mensaje_ayuda_id";
        $this->DataSource = new clsmensajes_ayudaDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

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

        $this->SorterName = CCGetParam("mensajes_ayudaOrder", "");
        $this->SorterDirection = CCGetParam("mensajes_ayudaDir", "");

        $this->mensajes_ayuda_TotalRecords = new clsControl(ccsLabel, "mensajes_ayuda_TotalRecords", "mensajes_ayuda_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_mensaje_ayuda_id = new clsSorter($this->ComponentName, "Sorter_mensaje_ayuda_id", $FileName, $this);
        $this->Sorter_nom_pagina = new clsSorter($this->ComponentName, "Sorter_nom_pagina", $FileName, $this);
        $this->Sorter_nom_mensaje = new clsSorter($this->ComponentName, "Sorter_nom_mensaje", $FileName, $this);
        $this->Sorter_icono_id = new clsSorter($this->ComponentName, "Sorter_icono_id", $FileName, $this);
        $this->mensaje_ayuda_id = new clsControl(ccsTextBox, "mensaje_ayuda_id", "Mensaje Ayuda Id", ccsText, "", NULL, $this);
        $this->mensaje_ayuda_id->Required = true;
        $this->nom_pagina = new clsControl(ccsTextBox, "nom_pagina", "Nom Pagina", ccsText, "", NULL, $this);
        $this->nom_mensaje = new clsControl(ccsTextBox, "nom_mensaje", "Nom Mensaje", ccsText, "", NULL, $this);
        $this->mensaje = new clsControl(ccsTextArea, "mensaje", "Mensaje", ccsMemo, "", NULL, $this);
        $this->icono_id = new clsControl(ccsListBox, "icono_id", "Icono Id", ccsInteger, "", NULL, $this);
        $this->icono_id->DSType = dsTable;
        $this->icono_id->DataSource = new clsDBDatos();
        $this->icono_id->ds = & $this->icono_id->DataSource;
        $this->icono_id->DataSource->SQL = "SELECT * \n" .
"FROM iconos {SQL_Where} {SQL_OrderBy}";
        list($this->icono_id->BoundColumn, $this->icono_id->TextColumn, $this->icono_id->DBFormat) = array("icono_id", "nom_icono", "");
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
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

//GetFormParameters Method @2-BE4FC2F5
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["mensaje_ayuda_id"][$RowNumber] = CCGetFromPost("mensaje_ayuda_id_" . $RowNumber, NULL);
            $this->FormParameters["nom_pagina"][$RowNumber] = CCGetFromPost("nom_pagina_" . $RowNumber, NULL);
            $this->FormParameters["nom_mensaje"][$RowNumber] = CCGetFromPost("nom_mensaje_" . $RowNumber, NULL);
            $this->FormParameters["mensaje"][$RowNumber] = CCGetFromPost("mensaje_" . $RowNumber, NULL);
            $this->FormParameters["icono_id"][$RowNumber] = CCGetFromPost("icono_id_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-EABB32FF
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["mensaje_ayuda_id"] = $this->CachedColumns["mensaje_ayuda_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->mensaje_ayuda_id->SetText($this->FormParameters["mensaje_ayuda_id"][$this->RowNumber], $this->RowNumber);
            $this->nom_pagina->SetText($this->FormParameters["nom_pagina"][$this->RowNumber], $this->RowNumber);
            $this->nom_mensaje->SetText($this->FormParameters["nom_mensaje"][$this->RowNumber], $this->RowNumber);
            $this->mensaje->SetText($this->FormParameters["mensaje"][$this->RowNumber], $this->RowNumber);
            $this->icono_id->SetText($this->FormParameters["icono_id"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @2-D774AA51
    function ValidateRow()
    {
        global $CCSLocales;
        $this->mensaje_ayuda_id->Validate();
        $this->nom_pagina->Validate();
        $this->nom_mensaje->Validate();
        $this->mensaje->Validate();
        $this->icono_id->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->mensaje_ayuda_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_pagina->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_mensaje->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mensaje->Errors->ToString());
        $errors = ComposeStrings($errors, $this->icono_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->mensaje_ayuda_id->Errors->Clear();
        $this->nom_pagina->Errors->Clear();
        $this->nom_mensaje->Errors->Clear();
        $this->mensaje->Errors->Clear();
        $this->icono_id->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-F7746147
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["mensaje_ayuda_id"][$this->RowNumber]) && count($this->FormParameters["mensaje_ayuda_id"][$this->RowNumber])) || strlen($this->FormParameters["mensaje_ayuda_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nom_pagina"][$this->RowNumber]) && count($this->FormParameters["nom_pagina"][$this->RowNumber])) || strlen($this->FormParameters["nom_pagina"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nom_mensaje"][$this->RowNumber]) && count($this->FormParameters["nom_mensaje"][$this->RowNumber])) || strlen($this->FormParameters["nom_mensaje"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["mensaje"][$this->RowNumber]) && count($this->FormParameters["mensaje"][$this->RowNumber])) || strlen($this->FormParameters["mensaje"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["icono_id"][$this->RowNumber]) && count($this->FormParameters["icono_id"][$this->RowNumber])) || strlen($this->FormParameters["icono_id"][$this->RowNumber]));
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

//Operation Method @2-6B923CC2
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @2-FA170456
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["mensaje_ayuda_id"] = $this->CachedColumns["mensaje_ayuda_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->mensaje_ayuda_id->SetText($this->FormParameters["mensaje_ayuda_id"][$this->RowNumber], $this->RowNumber);
            $this->nom_pagina->SetText($this->FormParameters["nom_pagina"][$this->RowNumber], $this->RowNumber);
            $this->nom_mensaje->SetText($this->FormParameters["nom_mensaje"][$this->RowNumber], $this->RowNumber);
            $this->mensaje->SetText($this->FormParameters["mensaje"][$this->RowNumber], $this->RowNumber);
            $this->icono_id->SetText($this->FormParameters["icono_id"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @2-72A6A0CE
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->mensaje_ayuda_id->SetValue($this->mensaje_ayuda_id->GetValue(true));
        $this->DataSource->nom_pagina->SetValue($this->nom_pagina->GetValue(true));
        $this->DataSource->nom_mensaje->SetValue($this->nom_mensaje->GetValue(true));
        $this->DataSource->mensaje->SetValue($this->mensaje->GetValue(true));
        $this->DataSource->icono_id->SetValue($this->icono_id->GetValue(true));
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

//UpdateRow Method @2-D0E700CB
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->mensaje_ayuda_id->SetValue($this->mensaje_ayuda_id->GetValue(true));
        $this->DataSource->nom_pagina->SetValue($this->nom_pagina->GetValue(true));
        $this->DataSource->nom_mensaje->SetValue($this->nom_mensaje->GetValue(true));
        $this->DataSource->mensaje->SetValue($this->mensaje->GetValue(true));
        $this->DataSource->icono_id->SetValue($this->icono_id->GetValue(true));
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

//FormScript Method @2-7F29A626
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var mensajes_ayudaElements;\n";
        $script .= "var mensajes_ayudaEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "mensaje_ayuda_idID = 0;\n";
        $script .= "var " . $this->ComponentName . "nom_paginaID = 1;\n";
        $script .= "var " . $this->ComponentName . "nom_mensajeID = 2;\n";
        $script .= "var " . $this->ComponentName . "mensajeID = 3;\n";
        $script .= "var " . $this->ComponentName . "icono_idID = 4;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 5;\n";
        $script .= "\nfunction initmensajes_ayudaElements() {\n";
        $script .= "\tvar ED = document.forms[\"mensajes_ayuda\"];\n";
        $script .= "\tmensajes_ayudaElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.mensaje_ayuda_id_" . $i . ", " . "ED.nom_pagina_" . $i . ", " . "ED.nom_mensaje_" . $i . ", " . "ED.mensaje_" . $i . ", " . "ED.icono_id_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-95F2749C
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
                $this->CachedColumns["mensaje_ayuda_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["mensaje_ayuda_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-6F99D83B
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["mensaje_ayuda_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-0FF0AD32
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->icono_id->Prepare();

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
        $this->ControlsVisible["mensaje_ayuda_id"] = $this->mensaje_ayuda_id->Visible;
        $this->ControlsVisible["nom_pagina"] = $this->nom_pagina->Visible;
        $this->ControlsVisible["nom_mensaje"] = $this->nom_mensaje->Visible;
        $this->ControlsVisible["mensaje"] = $this->mensaje->Visible;
        $this->ControlsVisible["icono_id"] = $this->icono_id->Visible;
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
                    $this->CachedColumns["mensaje_ayuda_id"][$this->RowNumber] = $this->DataSource->CachedColumns["mensaje_ayuda_id"];
                    $this->CheckBox_Delete->SetValue(false);
                    $this->mensaje_ayuda_id->SetValue($this->DataSource->mensaje_ayuda_id->GetValue());
                    $this->nom_pagina->SetValue($this->DataSource->nom_pagina->GetValue());
                    $this->nom_mensaje->SetValue($this->DataSource->nom_mensaje->GetValue());
                    $this->mensaje->SetValue($this->DataSource->mensaje->GetValue());
                    $this->icono_id->SetValue($this->DataSource->icono_id->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->mensaje_ayuda_id->SetText($this->FormParameters["mensaje_ayuda_id"][$this->RowNumber], $this->RowNumber);
                    $this->nom_pagina->SetText($this->FormParameters["nom_pagina"][$this->RowNumber], $this->RowNumber);
                    $this->nom_mensaje->SetText($this->FormParameters["nom_mensaje"][$this->RowNumber], $this->RowNumber);
                    $this->mensaje->SetText($this->FormParameters["mensaje"][$this->RowNumber], $this->RowNumber);
                    $this->icono_id->SetText($this->FormParameters["icono_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["mensaje_ayuda_id"][$this->RowNumber] = "";
                    $this->mensaje_ayuda_id->SetText("");
                    $this->nom_pagina->SetText("");
                    $this->nom_mensaje->SetText("");
                    $this->mensaje->SetText("");
                    $this->icono_id->SetText("");
                } else {
                    $this->mensaje_ayuda_id->SetText($this->FormParameters["mensaje_ayuda_id"][$this->RowNumber], $this->RowNumber);
                    $this->nom_pagina->SetText($this->FormParameters["nom_pagina"][$this->RowNumber], $this->RowNumber);
                    $this->nom_mensaje->SetText($this->FormParameters["nom_mensaje"][$this->RowNumber], $this->RowNumber);
                    $this->mensaje->SetText($this->FormParameters["mensaje"][$this->RowNumber], $this->RowNumber);
                    $this->icono_id->SetText($this->FormParameters["icono_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mensaje_ayuda_id->Show($this->RowNumber);
                $this->nom_pagina->Show($this->RowNumber);
                $this->nom_mensaje->Show($this->RowNumber);
                $this->mensaje->Show($this->RowNumber);
                $this->icono_id->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["mensaje_ayuda_id"] == $this->CachedColumns["mensaje_ayuda_id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->mensajes_ayuda_TotalRecords->Show();
        $this->Sorter_mensaje_ayuda_id->Show();
        $this->Sorter_nom_pagina->Show();
        $this->Sorter_nom_mensaje->Show();
        $this->Sorter_icono_id->Show();
        $this->Navigator->Show();
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

} //End mensajes_ayuda Class @2-FCB6E20C

class clsmensajes_ayudaDataSource extends clsDBDatos {  //mensajes_ayudaDataSource Class @2-1CCCEF5E

//DataSource Variables @2-3E3C6D24
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
    public $mensaje_ayuda_id;
    public $nom_pagina;
    public $nom_mensaje;
    public $mensaje;
    public $icono_id;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-25A6D726
    function clsmensajes_ayudaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid mensajes_ayuda/Error";
        $this->Initialize();
        $this->mensaje_ayuda_id = new clsField("mensaje_ayuda_id", ccsText, "");
        
        $this->nom_pagina = new clsField("nom_pagina", ccsText, "");
        
        $this->nom_mensaje = new clsField("nom_mensaje", ccsText, "");
        
        $this->mensaje = new clsField("mensaje", ccsMemo, "");
        
        $this->icono_id = new clsField("icono_id", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["mensaje_ayuda_id"] = array("Name" => "mensaje_ayuda_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_pagina"] = array("Name" => "nom_pagina", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_mensaje"] = array("Name" => "nom_mensaje", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mensaje"] = array("Name" => "mensaje", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["icono_id"] = array("Name" => "icono_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mensaje_ayuda_id"] = array("Name" => "mensaje_ayuda_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_pagina"] = array("Name" => "nom_pagina", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_mensaje"] = array("Name" => "nom_mensaje", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mensaje"] = array("Name" => "mensaje", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["icono_id"] = array("Name" => "icono_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B5A5D81D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mensaje_ayuda_id" => array("mensaje_ayuda_id", ""), 
            "Sorter_nom_pagina" => array("nom_pagina", ""), 
            "Sorter_nom_mensaje" => array("nom_mensaje", ""), 
            "Sorter_icono_id" => array("icono_id", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-EFC93AAB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mensajes_ayuda";
        $this->SQL = "SELECT * \n\n" .
        "FROM mensajes_ayuda {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-BADE3691
    function SetValues()
    {
        $this->CachedColumns["mensaje_ayuda_id"] = $this->f("mensaje_ayuda_id");
        $this->mensaje_ayuda_id->SetDBValue($this->f("mensaje_ayuda_id"));
        $this->nom_pagina->SetDBValue($this->f("nom_pagina"));
        $this->nom_mensaje->SetDBValue($this->f("nom_mensaje"));
        $this->mensaje->SetDBValue($this->f("mensaje"));
        $this->icono_id->SetDBValue(trim($this->f("icono_id")));
    }
//End SetValues Method

//Insert Method @2-09F065C3
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["mensaje_ayuda_id"]["Value"] = $this->mensaje_ayuda_id->GetDBValue(true);
        $this->InsertFields["nom_pagina"]["Value"] = $this->nom_pagina->GetDBValue(true);
        $this->InsertFields["nom_mensaje"]["Value"] = $this->nom_mensaje->GetDBValue(true);
        $this->InsertFields["mensaje"]["Value"] = $this->mensaje->GetDBValue(true);
        $this->InsertFields["icono_id"]["Value"] = $this->icono_id->GetDBValue(true);
        $this->SQL = CCBuildInsert("mensajes_ayuda", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-EED863D9
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "mensaje_ayuda_id=" . $this->ToSQL($this->CachedColumns["mensaje_ayuda_id"], ccsText);
        $this->UpdateFields["mensaje_ayuda_id"]["Value"] = $this->mensaje_ayuda_id->GetDBValue(true);
        $this->UpdateFields["nom_pagina"]["Value"] = $this->nom_pagina->GetDBValue(true);
        $this->UpdateFields["nom_mensaje"]["Value"] = $this->nom_mensaje->GetDBValue(true);
        $this->UpdateFields["mensaje"]["Value"] = $this->mensaje->GetDBValue(true);
        $this->UpdateFields["icono_id"]["Value"] = $this->icono_id->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mensajes_ayuda", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @2-1472B29A
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "mensaje_ayuda_id=" . $this->ToSQL($this->CachedColumns["mensaje_ayuda_id"], ccsText);
        $this->SQL = "DELETE FROM mensajes_ayuda";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End mensajes_ayudaDataSource Class @2-FCB6E20C

//Initialize Page @1-F2792094
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
$TemplateFileName = "config_mensajes.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "../";
$PathToRootOpt = "../";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-2E557B45
CCSecurityRedirect("20", "error_nivel.php");
//End Authenticate User

//Include events file @1-3DDCFCEF
include_once("./config_mensajes_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-775D48C2
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mensajes_ayuda = new clsEditableGridmensajes_ayuda("", $MainPage);
$MainPage->mensajes_ayuda = & $mensajes_ayuda;
$mensajes_ayuda->Initialize();
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

//Execute Components @1-3CA42616
$mensajes_ayuda->Operation();
//End Execute Components

//Go to destination page @1-2ED1A3E8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($mensajes_ayuda);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-46ECBF59
$mensajes_ayuda->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F3E87ED5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($mensajes_ayuda);
unset($Tpl);
//End Unload Page


?>
