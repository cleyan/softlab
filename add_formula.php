<?php
//Include Common Files @1-4C823D0A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_formula.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordformulas { //formulas Class @3-64A6D692

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

//Class_Initialize Event @3-55DC1BE0
    function clsRecordformulas($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record formulas/Error";
        $this->DataSource = new clsformulasDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "formulas";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->a = new clsControl(ccsListBox, "a", "A", ccsInteger, "", CCGetRequestParam("a", $Method, NULL), $this);
            $this->a->DSType = dsTable;
            $this->a->DataSource = new clsDBDatos();
            $this->a->ds = & $this->a->DataSource;
            $this->a->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->a->DataSource->Order = "nom_test";
            list($this->a->BoundColumn, $this->a->TextColumn, $this->a->DBFormat) = array("test_id", "nom_test", "");
            $this->a->DataSource->Order = "nom_test";
            $this->b = new clsControl(ccsListBox, "b", "B", ccsInteger, "", CCGetRequestParam("b", $Method, NULL), $this);
            $this->b->DSType = dsTable;
            $this->b->DataSource = new clsDBDatos();
            $this->b->ds = & $this->b->DataSource;
            $this->b->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->b->DataSource->Order = "nom_test";
            list($this->b->BoundColumn, $this->b->TextColumn, $this->b->DBFormat) = array("test_id", "nom_test", "");
            $this->b->DataSource->Order = "nom_test";
            $this->c = new clsControl(ccsListBox, "c", "C", ccsInteger, "", CCGetRequestParam("c", $Method, NULL), $this);
            $this->c->DSType = dsTable;
            $this->c->DataSource = new clsDBDatos();
            $this->c->ds = & $this->c->DataSource;
            $this->c->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->c->DataSource->Order = "nom_test";
            list($this->c->BoundColumn, $this->c->TextColumn, $this->c->DBFormat) = array("test_id", "nom_test", "");
            $this->c->DataSource->Order = "nom_test";
            $this->d = new clsControl(ccsListBox, "d", "D", ccsInteger, "", CCGetRequestParam("d", $Method, NULL), $this);
            $this->d->DSType = dsTable;
            $this->d->DataSource = new clsDBDatos();
            $this->d->ds = & $this->d->DataSource;
            $this->d->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->d->DataSource->Order = "nom_test";
            list($this->d->BoundColumn, $this->d->TextColumn, $this->d->DBFormat) = array("test_id", "nom_test", "");
            $this->d->DataSource->Order = "nom_test";
            $this->e = new clsControl(ccsListBox, "e", "E", ccsInteger, "", CCGetRequestParam("e", $Method, NULL), $this);
            $this->e->DSType = dsTable;
            $this->e->DataSource = new clsDBDatos();
            $this->e->ds = & $this->e->DataSource;
            $this->e->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->e->DataSource->Order = "nom_test";
            list($this->e->BoundColumn, $this->e->TextColumn, $this->e->DBFormat) = array("test_id", "nom_test", "");
            $this->e->DataSource->Order = "nom_test";
            $this->f = new clsControl(ccsListBox, "f", "F", ccsInteger, "", CCGetRequestParam("f", $Method, NULL), $this);
            $this->f->DSType = dsTable;
            $this->f->DataSource = new clsDBDatos();
            $this->f->ds = & $this->f->DataSource;
            $this->f->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->f->DataSource->Order = "nom_test";
            list($this->f->BoundColumn, $this->f->TextColumn, $this->f->DBFormat) = array("test_id", "nom_test", "");
            $this->f->DataSource->Order = "nom_test";
            $this->g = new clsControl(ccsListBox, "g", "G", ccsInteger, "", CCGetRequestParam("g", $Method, NULL), $this);
            $this->g->DSType = dsTable;
            $this->g->DataSource = new clsDBDatos();
            $this->g->ds = & $this->g->DataSource;
            $this->g->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->g->DataSource->Order = "nom_test";
            list($this->g->BoundColumn, $this->g->TextColumn, $this->g->DBFormat) = array("test_id", "nom_test", "");
            $this->g->DataSource->Order = "nom_test";
            $this->h = new clsControl(ccsListBox, "h", "H", ccsInteger, "", CCGetRequestParam("h", $Method, NULL), $this);
            $this->h->DSType = dsTable;
            $this->h->DataSource = new clsDBDatos();
            $this->h->ds = & $this->h->DataSource;
            $this->h->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->h->DataSource->Order = "nom_test";
            list($this->h->BoundColumn, $this->h->TextColumn, $this->h->DBFormat) = array("test_id", "nom_test", "");
            $this->h->DataSource->Order = "nom_test";
            $this->i = new clsControl(ccsListBox, "i", "I", ccsInteger, "", CCGetRequestParam("i", $Method, NULL), $this);
            $this->i->DSType = dsTable;
            $this->i->DataSource = new clsDBDatos();
            $this->i->ds = & $this->i->DataSource;
            $this->i->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->i->DataSource->Order = "nom_test";
            list($this->i->BoundColumn, $this->i->TextColumn, $this->i->DBFormat) = array("test_id", "nom_test", "");
            $this->i->DataSource->Order = "nom_test";
            $this->j = new clsControl(ccsListBox, "j", "J", ccsInteger, "", CCGetRequestParam("j", $Method, NULL), $this);
            $this->j->DSType = dsTable;
            $this->j->DataSource = new clsDBDatos();
            $this->j->ds = & $this->j->DataSource;
            $this->j->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->j->DataSource->Order = "nom_test";
            list($this->j->BoundColumn, $this->j->TextColumn, $this->j->DBFormat) = array("test_id", "nom_test", "");
            $this->j->DataSource->Order = "nom_test";
            $this->k = new clsControl(ccsListBox, "k", "K", ccsInteger, "", CCGetRequestParam("k", $Method, NULL), $this);
            $this->k->DSType = dsTable;
            $this->k->DataSource = new clsDBDatos();
            $this->k->ds = & $this->k->DataSource;
            $this->k->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->k->DataSource->Order = "nom_test";
            list($this->k->BoundColumn, $this->k->TextColumn, $this->k->DBFormat) = array("test_id", "nom_test", "");
            $this->k->DataSource->Order = "nom_test";
            $this->l = new clsControl(ccsListBox, "l", "L", ccsInteger, "", CCGetRequestParam("l", $Method, NULL), $this);
            $this->l->DSType = dsTable;
            $this->l->DataSource = new clsDBDatos();
            $this->l->ds = & $this->l->DataSource;
            $this->l->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->l->DataSource->Order = "nom_test";
            list($this->l->BoundColumn, $this->l->TextColumn, $this->l->DBFormat) = array("test_id", "nom_test", "");
            $this->l->DataSource->Order = "nom_test";
            $this->formula = new clsControl(ccsTextArea, "formula", "Formula", ccsText, "", CCGetRequestParam("formula", $Method, NULL), $this);
            $this->formula->Required = true;
            $this->decimales = new clsControl(ccsListBox, "decimales", "decimales", ccsInteger, "", CCGetRequestParam("decimales", $Method, NULL), $this);
            $this->decimales->DSType = dsListOfValues;
            $this->decimales->Values = array(array("0", "0"), array("1", "1"), array("2", "2"), array("3", "3"), array("4", "4"), array("5", "5"));
            $this->decimales->Required = true;
            $this->etiqueta = new clsControl(ccsTextBox, "etiqueta", "etiqueta", ccsText, "", CCGetRequestParam("etiqueta", $Method, NULL), $this);
            $this->permitir_falta = new clsControl(ccsCheckBox, "permitir_falta", "permitir_falta", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("permitir_falta", $Method, NULL), $this);
            $this->permitir_falta->CheckedValue = true;
            $this->permitir_falta->UncheckedValue = false;
            $this->valor_falta = new clsControl(ccsTextBox, "valor_falta", "valor_falta", ccsText, "", CCGetRequestParam("valor_falta", $Method, NULL), $this);
            $this->cambia_cero = new clsControl(ccsTextBox, "cambia_cero", "cambia_cero", ccsText, "", CCGetRequestParam("cambia_cero", $Method, NULL), $this);
            $this->alarma = new clsControl(ccsCheckBox, "alarma", "alarma", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("alarma", $Method, NULL), $this);
            $this->alarma->CheckedValue = true;
            $this->alarma->UncheckedValue = false;
            $this->operador = new clsControl(ccsListBox, "operador", "operador", ccsText, "", CCGetRequestParam("operador", $Method, NULL), $this);
            $this->operador->DSType = dsListOfValues;
            $this->operador->Values = array(array("<", "menor"), array(">", "mayor"), array("=", "igual"), array("!=", "diferente"));
            $this->target = new clsControl(ccsTextBox, "target", "target", ccsText, "", CCGetRequestParam("target", $Method, NULL), $this);
            $this->mensaje = new clsControl(ccsTextArea, "mensaje", "mensaje", ccsText, "", CCGetRequestParam("mensaje", $Method, NULL), $this);
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->permitir_falta->Value) && !strlen($this->permitir_falta->Value) && $this->permitir_falta->Value !== false)
                    $this->permitir_falta->SetValue(false);
                if(!is_array($this->alarma->Value) && !strlen($this->alarma->Value) && $this->alarma->Value !== false)
                    $this->alarma->SetValue(false);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @3-DFD3A45F
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urltest_id"] = CCGetFromGet("test_id", NULL);
    }
//End Initialize Method

//Validate Method @3-F9D66A79
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->a->Validate() && $Validation);
        $Validation = ($this->b->Validate() && $Validation);
        $Validation = ($this->c->Validate() && $Validation);
        $Validation = ($this->d->Validate() && $Validation);
        $Validation = ($this->e->Validate() && $Validation);
        $Validation = ($this->f->Validate() && $Validation);
        $Validation = ($this->g->Validate() && $Validation);
        $Validation = ($this->h->Validate() && $Validation);
        $Validation = ($this->i->Validate() && $Validation);
        $Validation = ($this->j->Validate() && $Validation);
        $Validation = ($this->k->Validate() && $Validation);
        $Validation = ($this->l->Validate() && $Validation);
        $Validation = ($this->formula->Validate() && $Validation);
        $Validation = ($this->decimales->Validate() && $Validation);
        $Validation = ($this->etiqueta->Validate() && $Validation);
        $Validation = ($this->permitir_falta->Validate() && $Validation);
        $Validation = ($this->valor_falta->Validate() && $Validation);
        $Validation = ($this->cambia_cero->Validate() && $Validation);
        $Validation = ($this->alarma->Validate() && $Validation);
        $Validation = ($this->operador->Validate() && $Validation);
        $Validation = ($this->target->Validate() && $Validation);
        $Validation = ($this->mensaje->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->a->Errors->Count() == 0);
        $Validation =  $Validation && ($this->b->Errors->Count() == 0);
        $Validation =  $Validation && ($this->c->Errors->Count() == 0);
        $Validation =  $Validation && ($this->d->Errors->Count() == 0);
        $Validation =  $Validation && ($this->e->Errors->Count() == 0);
        $Validation =  $Validation && ($this->f->Errors->Count() == 0);
        $Validation =  $Validation && ($this->g->Errors->Count() == 0);
        $Validation =  $Validation && ($this->h->Errors->Count() == 0);
        $Validation =  $Validation && ($this->i->Errors->Count() == 0);
        $Validation =  $Validation && ($this->j->Errors->Count() == 0);
        $Validation =  $Validation && ($this->k->Errors->Count() == 0);
        $Validation =  $Validation && ($this->l->Errors->Count() == 0);
        $Validation =  $Validation && ($this->formula->Errors->Count() == 0);
        $Validation =  $Validation && ($this->decimales->Errors->Count() == 0);
        $Validation =  $Validation && ($this->etiqueta->Errors->Count() == 0);
        $Validation =  $Validation && ($this->permitir_falta->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valor_falta->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cambia_cero->Errors->Count() == 0);
        $Validation =  $Validation && ($this->alarma->Errors->Count() == 0);
        $Validation =  $Validation && ($this->operador->Errors->Count() == 0);
        $Validation =  $Validation && ($this->target->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mensaje->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-3D74A34B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->a->Errors->Count());
        $errors = ($errors || $this->b->Errors->Count());
        $errors = ($errors || $this->c->Errors->Count());
        $errors = ($errors || $this->d->Errors->Count());
        $errors = ($errors || $this->e->Errors->Count());
        $errors = ($errors || $this->f->Errors->Count());
        $errors = ($errors || $this->g->Errors->Count());
        $errors = ($errors || $this->h->Errors->Count());
        $errors = ($errors || $this->i->Errors->Count());
        $errors = ($errors || $this->j->Errors->Count());
        $errors = ($errors || $this->k->Errors->Count());
        $errors = ($errors || $this->l->Errors->Count());
        $errors = ($errors || $this->formula->Errors->Count());
        $errors = ($errors || $this->decimales->Errors->Count());
        $errors = ($errors || $this->etiqueta->Errors->Count());
        $errors = ($errors || $this->permitir_falta->Errors->Count());
        $errors = ($errors || $this->valor_falta->Errors->Count());
        $errors = ($errors || $this->cambia_cero->Errors->Count());
        $errors = ($errors || $this->alarma->Errors->Count());
        $errors = ($errors || $this->operador->Errors->Count());
        $errors = ($errors || $this->target->Errors->Count());
        $errors = ($errors || $this->mensaje->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-889D7997
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
            }
        }
        $Redirect = "closeandrefresh.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
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

//InsertRow Method @3-7A3BB864
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->a->SetValue($this->a->GetValue(true));
        $this->DataSource->b->SetValue($this->b->GetValue(true));
        $this->DataSource->c->SetValue($this->c->GetValue(true));
        $this->DataSource->d->SetValue($this->d->GetValue(true));
        $this->DataSource->e->SetValue($this->e->GetValue(true));
        $this->DataSource->f->SetValue($this->f->GetValue(true));
        $this->DataSource->g->SetValue($this->g->GetValue(true));
        $this->DataSource->h->SetValue($this->h->GetValue(true));
        $this->DataSource->i->SetValue($this->i->GetValue(true));
        $this->DataSource->j->SetValue($this->j->GetValue(true));
        $this->DataSource->k->SetValue($this->k->GetValue(true));
        $this->DataSource->l->SetValue($this->l->GetValue(true));
        $this->DataSource->formula->SetValue($this->formula->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @3-DF4BB72A
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->a->SetValue($this->a->GetValue(true));
        $this->DataSource->b->SetValue($this->b->GetValue(true));
        $this->DataSource->c->SetValue($this->c->GetValue(true));
        $this->DataSource->d->SetValue($this->d->GetValue(true));
        $this->DataSource->e->SetValue($this->e->GetValue(true));
        $this->DataSource->f->SetValue($this->f->GetValue(true));
        $this->DataSource->g->SetValue($this->g->GetValue(true));
        $this->DataSource->h->SetValue($this->h->GetValue(true));
        $this->DataSource->i->SetValue($this->i->GetValue(true));
        $this->DataSource->j->SetValue($this->j->GetValue(true));
        $this->DataSource->k->SetValue($this->k->GetValue(true));
        $this->DataSource->l->SetValue($this->l->GetValue(true));
        $this->DataSource->formula->SetValue($this->formula->GetValue(true));
        $this->DataSource->decimales->SetValue($this->decimales->GetValue(true));
        $this->DataSource->etiqueta->SetValue($this->etiqueta->GetValue(true));
        $this->DataSource->permitir_falta->SetValue($this->permitir_falta->GetValue(true));
        $this->DataSource->valor_falta->SetValue($this->valor_falta->GetValue(true));
        $this->DataSource->cambia_cero->SetValue($this->cambia_cero->GetValue(true));
        $this->DataSource->alarma->SetValue($this->alarma->GetValue(true));
        $this->DataSource->operador->SetValue($this->operador->GetValue(true));
        $this->DataSource->target->SetValue($this->target->GetValue(true));
        $this->DataSource->mensaje->SetValue($this->mensaje->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @3-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @3-52726113
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

        $this->a->Prepare();
        $this->b->Prepare();
        $this->c->Prepare();
        $this->d->Prepare();
        $this->e->Prepare();
        $this->f->Prepare();
        $this->g->Prepare();
        $this->h->Prepare();
        $this->i->Prepare();
        $this->j->Prepare();
        $this->k->Prepare();
        $this->l->Prepare();
        $this->decimales->Prepare();
        $this->operador->Prepare();

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
                    $this->a->SetValue($this->DataSource->a->GetValue());
                    $this->b->SetValue($this->DataSource->b->GetValue());
                    $this->c->SetValue($this->DataSource->c->GetValue());
                    $this->d->SetValue($this->DataSource->d->GetValue());
                    $this->e->SetValue($this->DataSource->e->GetValue());
                    $this->f->SetValue($this->DataSource->f->GetValue());
                    $this->g->SetValue($this->DataSource->g->GetValue());
                    $this->h->SetValue($this->DataSource->h->GetValue());
                    $this->i->SetValue($this->DataSource->i->GetValue());
                    $this->j->SetValue($this->DataSource->j->GetValue());
                    $this->k->SetValue($this->DataSource->k->GetValue());
                    $this->l->SetValue($this->DataSource->l->GetValue());
                    $this->formula->SetValue($this->DataSource->formula->GetValue());
                    $this->decimales->SetValue($this->DataSource->decimales->GetValue());
                    $this->etiqueta->SetValue($this->DataSource->etiqueta->GetValue());
                    $this->permitir_falta->SetValue($this->DataSource->permitir_falta->GetValue());
                    $this->valor_falta->SetValue($this->DataSource->valor_falta->GetValue());
                    $this->cambia_cero->SetValue($this->DataSource->cambia_cero->GetValue());
                    $this->alarma->SetValue($this->DataSource->alarma->GetValue());
                    $this->operador->SetValue($this->DataSource->operador->GetValue());
                    $this->target->SetValue($this->DataSource->target->GetValue());
                    $this->mensaje->SetValue($this->DataSource->mensaje->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->a->Errors->ToString());
            $Error = ComposeStrings($Error, $this->b->Errors->ToString());
            $Error = ComposeStrings($Error, $this->c->Errors->ToString());
            $Error = ComposeStrings($Error, $this->d->Errors->ToString());
            $Error = ComposeStrings($Error, $this->e->Errors->ToString());
            $Error = ComposeStrings($Error, $this->f->Errors->ToString());
            $Error = ComposeStrings($Error, $this->g->Errors->ToString());
            $Error = ComposeStrings($Error, $this->h->Errors->ToString());
            $Error = ComposeStrings($Error, $this->i->Errors->ToString());
            $Error = ComposeStrings($Error, $this->j->Errors->ToString());
            $Error = ComposeStrings($Error, $this->k->Errors->ToString());
            $Error = ComposeStrings($Error, $this->l->Errors->ToString());
            $Error = ComposeStrings($Error, $this->formula->Errors->ToString());
            $Error = ComposeStrings($Error, $this->decimales->Errors->ToString());
            $Error = ComposeStrings($Error, $this->etiqueta->Errors->ToString());
            $Error = ComposeStrings($Error, $this->permitir_falta->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valor_falta->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cambia_cero->Errors->ToString());
            $Error = ComposeStrings($Error, $this->alarma->Errors->ToString());
            $Error = ComposeStrings($Error, $this->operador->Errors->ToString());
            $Error = ComposeStrings($Error, $this->target->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mensaje->Errors->ToString());
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

        $this->a->Show();
        $this->b->Show();
        $this->c->Show();
        $this->d->Show();
        $this->e->Show();
        $this->f->Show();
        $this->g->Show();
        $this->h->Show();
        $this->i->Show();
        $this->j->Show();
        $this->k->Show();
        $this->l->Show();
        $this->formula->Show();
        $this->decimales->Show();
        $this->etiqueta->Show();
        $this->permitir_falta->Show();
        $this->valor_falta->Show();
        $this->cambia_cero->Show();
        $this->alarma->Show();
        $this->operador->Show();
        $this->target->Show();
        $this->mensaje->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End formulas Class @3-FCB6E20C

class clsformulasDataSource extends clsDBDatos {  //formulasDataSource Class @3-598D3AC1

//DataSource Variables @3-E7F7539E
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
    public $a;
    public $b;
    public $c;
    public $d;
    public $e;
    public $f;
    public $g;
    public $h;
    public $i;
    public $j;
    public $k;
    public $l;
    public $formula;
    public $decimales;
    public $etiqueta;
    public $permitir_falta;
    public $valor_falta;
    public $cambia_cero;
    public $alarma;
    public $operador;
    public $target;
    public $mensaje;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-9D648A9C
    function clsformulasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record formulas/Error";
        $this->Initialize();
        $this->a = new clsField("a", ccsInteger, "");
        
        $this->b = new clsField("b", ccsInteger, "");
        
        $this->c = new clsField("c", ccsInteger, "");
        
        $this->d = new clsField("d", ccsInteger, "");
        
        $this->e = new clsField("e", ccsInteger, "");
        
        $this->f = new clsField("f", ccsInteger, "");
        
        $this->g = new clsField("g", ccsInteger, "");
        
        $this->h = new clsField("h", ccsInteger, "");
        
        $this->i = new clsField("i", ccsInteger, "");
        
        $this->j = new clsField("j", ccsInteger, "");
        
        $this->k = new clsField("k", ccsInteger, "");
        
        $this->l = new clsField("l", ccsInteger, "");
        
        $this->formula = new clsField("formula", ccsText, "");
        
        $this->decimales = new clsField("decimales", ccsInteger, "");
        
        $this->etiqueta = new clsField("etiqueta", ccsText, "");
        
        $this->permitir_falta = new clsField("permitir_falta", ccsBoolean, $this->BooleanFormat);
        
        $this->valor_falta = new clsField("valor_falta", ccsText, "");
        
        $this->cambia_cero = new clsField("cambia_cero", ccsText, "");
        
        $this->alarma = new clsField("alarma", ccsBoolean, $this->BooleanFormat);
        
        $this->operador = new clsField("operador", ccsText, "");
        
        $this->target = new clsField("target", ccsText, "");
        
        $this->mensaje = new clsField("mensaje", ccsText, "");
        

        $this->InsertFields["a"] = array("Name" => "a", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["b"] = array("Name" => "b", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["c"] = array("Name" => "c", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["d"] = array("Name" => "d", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["e"] = array("Name" => "e", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["f"] = array("Name" => "f", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["g"] = array("Name" => "g", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["h"] = array("Name" => "h", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["i"] = array("Name" => "i", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["j"] = array("Name" => "j", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["k"] = array("Name" => "k", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["l"] = array("Name" => "l", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["formula"] = array("Name" => "formula", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["a"] = array("Name" => "a", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["b"] = array("Name" => "b", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["c"] = array("Name" => "c", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["d"] = array("Name" => "d", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["e"] = array("Name" => "e", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["f"] = array("Name" => "f", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["g"] = array("Name" => "g", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["h"] = array("Name" => "h", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["i"] = array("Name" => "i", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["j"] = array("Name" => "j", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["k"] = array("Name" => "k", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["l"] = array("Name" => "l", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["formula"] = array("Name" => "formula", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["decimales"] = array("Name" => "decimales", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["etiqueta"] = array("Name" => "etiqueta", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["permitir_falta"] = array("Name" => "permitir_falta", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["valor_falta"] = array("Name" => "valor_falta", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cambia_cero"] = array("Name" => "cambia_cero", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["alarma"] = array("Name" => "alarma", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["operador"] = array("Name" => "operador", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["target"] = array("Name" => "target", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mensaje"] = array("Name" => "mensaje", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-D26ADDE2
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

//Open Method @3-55AE4AE9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM formulas {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-8967CE1C
    function SetValues()
    {
        $this->a->SetDBValue(trim($this->f("a")));
        $this->b->SetDBValue(trim($this->f("b")));
        $this->c->SetDBValue(trim($this->f("c")));
        $this->d->SetDBValue(trim($this->f("d")));
        $this->e->SetDBValue(trim($this->f("e")));
        $this->f->SetDBValue(trim($this->f("f")));
        $this->g->SetDBValue(trim($this->f("g")));
        $this->h->SetDBValue(trim($this->f("h")));
        $this->i->SetDBValue(trim($this->f("i")));
        $this->j->SetDBValue(trim($this->f("j")));
        $this->k->SetDBValue(trim($this->f("k")));
        $this->l->SetDBValue(trim($this->f("l")));
        $this->formula->SetDBValue($this->f("formula"));
        $this->decimales->SetDBValue(trim($this->f("decimales")));
        $this->etiqueta->SetDBValue($this->f("etiqueta"));
        $this->permitir_falta->SetDBValue(trim($this->f("permitir_falta")));
        $this->valor_falta->SetDBValue($this->f("valor_falta"));
        $this->cambia_cero->SetDBValue($this->f("cambia_cero"));
        $this->alarma->SetDBValue(trim($this->f("alarma")));
        $this->operador->SetDBValue($this->f("operador"));
        $this->target->SetDBValue($this->f("target"));
        $this->mensaje->SetDBValue($this->f("mensaje"));
    }
//End SetValues Method

//Insert Method @3-174986FF
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["a"] = new clsSQLParameter("ctrla", ccsInteger, "", "", $this->a->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["b"] = new clsSQLParameter("ctrlb", ccsInteger, "", "", $this->b->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["c"] = new clsSQLParameter("ctrlc", ccsInteger, "", "", $this->c->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["d"] = new clsSQLParameter("ctrld", ccsInteger, "", "", $this->d->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["e"] = new clsSQLParameter("ctrle", ccsInteger, "", "", $this->e->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f"] = new clsSQLParameter("ctrlf", ccsInteger, "", "", $this->f->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["g"] = new clsSQLParameter("ctrlg", ccsInteger, "", "", $this->g->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["h"] = new clsSQLParameter("ctrlh", ccsInteger, "", "", $this->h->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i"] = new clsSQLParameter("ctrli", ccsInteger, "", "", $this->i->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["j"] = new clsSQLParameter("ctrlj", ccsInteger, "", "", $this->j->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["k"] = new clsSQLParameter("ctrlk", ccsInteger, "", "", $this->k->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["l"] = new clsSQLParameter("ctrll", ccsInteger, "", "", $this->l->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["formula"] = new clsSQLParameter("ctrlformula", ccsText, "", "", $this->formula->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["test_id"] = new clsSQLParameter("urltest_id", ccsInteger, "", "", CCGetFromGet("test_id", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["a"]->GetValue()) and !strlen($this->cp["a"]->GetText()) and !is_bool($this->cp["a"]->GetValue())) 
            $this->cp["a"]->SetValue($this->a->GetValue(true));
        if (!is_null($this->cp["b"]->GetValue()) and !strlen($this->cp["b"]->GetText()) and !is_bool($this->cp["b"]->GetValue())) 
            $this->cp["b"]->SetValue($this->b->GetValue(true));
        if (!is_null($this->cp["c"]->GetValue()) and !strlen($this->cp["c"]->GetText()) and !is_bool($this->cp["c"]->GetValue())) 
            $this->cp["c"]->SetValue($this->c->GetValue(true));
        if (!is_null($this->cp["d"]->GetValue()) and !strlen($this->cp["d"]->GetText()) and !is_bool($this->cp["d"]->GetValue())) 
            $this->cp["d"]->SetValue($this->d->GetValue(true));
        if (!is_null($this->cp["e"]->GetValue()) and !strlen($this->cp["e"]->GetText()) and !is_bool($this->cp["e"]->GetValue())) 
            $this->cp["e"]->SetValue($this->e->GetValue(true));
        if (!is_null($this->cp["f"]->GetValue()) and !strlen($this->cp["f"]->GetText()) and !is_bool($this->cp["f"]->GetValue())) 
            $this->cp["f"]->SetValue($this->f->GetValue(true));
        if (!is_null($this->cp["g"]->GetValue()) and !strlen($this->cp["g"]->GetText()) and !is_bool($this->cp["g"]->GetValue())) 
            $this->cp["g"]->SetValue($this->g->GetValue(true));
        if (!is_null($this->cp["h"]->GetValue()) and !strlen($this->cp["h"]->GetText()) and !is_bool($this->cp["h"]->GetValue())) 
            $this->cp["h"]->SetValue($this->h->GetValue(true));
        if (!is_null($this->cp["i"]->GetValue()) and !strlen($this->cp["i"]->GetText()) and !is_bool($this->cp["i"]->GetValue())) 
            $this->cp["i"]->SetValue($this->i->GetValue(true));
        if (!is_null($this->cp["j"]->GetValue()) and !strlen($this->cp["j"]->GetText()) and !is_bool($this->cp["j"]->GetValue())) 
            $this->cp["j"]->SetValue($this->j->GetValue(true));
        if (!is_null($this->cp["k"]->GetValue()) and !strlen($this->cp["k"]->GetText()) and !is_bool($this->cp["k"]->GetValue())) 
            $this->cp["k"]->SetValue($this->k->GetValue(true));
        if (!is_null($this->cp["l"]->GetValue()) and !strlen($this->cp["l"]->GetText()) and !is_bool($this->cp["l"]->GetValue())) 
            $this->cp["l"]->SetValue($this->l->GetValue(true));
        if (!is_null($this->cp["formula"]->GetValue()) and !strlen($this->cp["formula"]->GetText()) and !is_bool($this->cp["formula"]->GetValue())) 
            $this->cp["formula"]->SetValue($this->formula->GetValue(true));
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetText(CCGetFromGet("test_id", NULL));
        $this->InsertFields["a"]["Value"] = $this->cp["a"]->GetDBValue(true);
        $this->InsertFields["b"]["Value"] = $this->cp["b"]->GetDBValue(true);
        $this->InsertFields["c"]["Value"] = $this->cp["c"]->GetDBValue(true);
        $this->InsertFields["d"]["Value"] = $this->cp["d"]->GetDBValue(true);
        $this->InsertFields["e"]["Value"] = $this->cp["e"]->GetDBValue(true);
        $this->InsertFields["f"]["Value"] = $this->cp["f"]->GetDBValue(true);
        $this->InsertFields["g"]["Value"] = $this->cp["g"]->GetDBValue(true);
        $this->InsertFields["h"]["Value"] = $this->cp["h"]->GetDBValue(true);
        $this->InsertFields["i"]["Value"] = $this->cp["i"]->GetDBValue(true);
        $this->InsertFields["j"]["Value"] = $this->cp["j"]->GetDBValue(true);
        $this->InsertFields["k"]["Value"] = $this->cp["k"]->GetDBValue(true);
        $this->InsertFields["l"]["Value"] = $this->cp["l"]->GetDBValue(true);
        $this->InsertFields["formula"]["Value"] = $this->cp["formula"]->GetDBValue(true);
        $this->InsertFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("formulas", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @3-5D4C93D3
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["a"]["Value"] = $this->a->GetDBValue(true);
        $this->UpdateFields["b"]["Value"] = $this->b->GetDBValue(true);
        $this->UpdateFields["c"]["Value"] = $this->c->GetDBValue(true);
        $this->UpdateFields["d"]["Value"] = $this->d->GetDBValue(true);
        $this->UpdateFields["e"]["Value"] = $this->e->GetDBValue(true);
        $this->UpdateFields["f"]["Value"] = $this->f->GetDBValue(true);
        $this->UpdateFields["g"]["Value"] = $this->g->GetDBValue(true);
        $this->UpdateFields["h"]["Value"] = $this->h->GetDBValue(true);
        $this->UpdateFields["i"]["Value"] = $this->i->GetDBValue(true);
        $this->UpdateFields["j"]["Value"] = $this->j->GetDBValue(true);
        $this->UpdateFields["k"]["Value"] = $this->k->GetDBValue(true);
        $this->UpdateFields["l"]["Value"] = $this->l->GetDBValue(true);
        $this->UpdateFields["formula"]["Value"] = $this->formula->GetDBValue(true);
        $this->UpdateFields["decimales"]["Value"] = $this->decimales->GetDBValue(true);
        $this->UpdateFields["etiqueta"]["Value"] = $this->etiqueta->GetDBValue(true);
        $this->UpdateFields["permitir_falta"]["Value"] = $this->permitir_falta->GetDBValue(true);
        $this->UpdateFields["valor_falta"]["Value"] = $this->valor_falta->GetDBValue(true);
        $this->UpdateFields["cambia_cero"]["Value"] = $this->cambia_cero->GetDBValue(true);
        $this->UpdateFields["alarma"]["Value"] = $this->alarma->GetDBValue(true);
        $this->UpdateFields["operador"]["Value"] = $this->operador->GetDBValue(true);
        $this->UpdateFields["target"]["Value"] = $this->target->GetDBValue(true);
        $this->UpdateFields["mensaje"]["Value"] = $this->mensaje->GetDBValue(true);
        $this->SQL = CCBuildUpdate("formulas", $this->UpdateFields, $this);
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

//Delete Method @3-8A76AE6F
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM formulas";
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

} //End formulasDataSource Class @3-FCB6E20C



//Initialize Page @1-FC1ED556
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
$TemplateFileName = "add_formula.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-9AF55343
CCSecurityRedirect("15;16;17;18;19;20", "");
//End Authenticate User

//Include events file @1-0395BD59
include_once("./add_formula_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6A2598E8
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$alerta_grabado = new clsControl(ccsLabel, "alerta_grabado", "alerta_grabado", ccsText, "", CCGetRequestParam("alerta_grabado", ccsGet, NULL), $MainPage);
$alerta_grabado->HTML = true;
$nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $MainPage);
$nom_test->HTML = true;
$formulas = new clsRecordformulas("", $MainPage);
$MainPage->alerta_grabado = & $alerta_grabado;
$MainPage->nom_test = & $nom_test;
$MainPage->formulas = & $formulas;
$formulas->Initialize();
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

//Execute Components @1-879378F5
$formulas->Operation();
//End Execute Components

//Go to destination page @1-F58E8F4E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($formulas);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-523978B2
$formulas->Show();
$alerta_grabado->Show();
$nom_test->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-07CB8597
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($formulas);
unset($Tpl);
//End Unload Page


?>
