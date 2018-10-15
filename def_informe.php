<?php
//Include Common Files @1-961EA37D
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "def_informe.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordinformesSearch { //informesSearch Class @3-EB7D0524

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

//Class_Initialize Event @3-C9A93B21
    function clsRecordinformesSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record informesSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "informesSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_nom_informe = new clsControl(ccsTextBox, "s_nom_informe", "s_nom_informe", ccsText, "", CCGetRequestParam("s_nom_informe", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-070EDCFF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_nom_informe->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_nom_informe->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-40D427CB
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_nom_informe->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-DDC6620F
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
        $Redirect = "def_informe.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "def_informe.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-D4AA1F0F
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
            $Error = ComposeStrings($Error, $this->s_nom_informe->Errors->ToString());
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

        $this->s_nom_informe->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End informesSearch Class @3-FCB6E20C

class clsGridinformes { //informes class @2-941BB5D0

//Variables @2-2448138C

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
    public $Sorter_nom_informe;
//End Variables

//Class_Initialize Event @2-CC959037
    function clsGridinformes($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "informes";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid informes";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinformesDataSource($this);
        $this->ds = & $this->DataSource;
        $this->SorterName = CCGetParam("informesOrder", "");
        $this->SorterDirection = CCGetParam("informesDir", "");

        $this->icon_plus = new clsControl(ccsLink, "icon_plus", "icon_plus", ccsText, "", CCGetRequestParam("icon_plus", ccsGet, NULL), $this);
        $this->icon_plus->HTML = true;
        $this->icon_plus->Page = "def_informe.php";
        $this->Editar = new clsControl(ccsImageLink, "Editar", "Editar", ccsText, "", CCGetRequestParam("Editar", ccsGet, NULL), $this);
        $this->Editar->Page = "def_informe.php";
        $this->nom_informe = new clsControl(ccsLabel, "nom_informe", "nom_informe", ccsText, "", CCGetRequestParam("nom_informe", ccsGet, NULL), $this);
        $this->informe_id = new clsControl(ccsHidden, "informe_id", "informe_id", ccsText, "", CCGetRequestParam("informe_id", ccsGet, NULL), $this);
        $this->linea = new clsControl(ccsLabel, "linea", "linea", ccsText, "", CCGetRequestParam("linea", ccsGet, NULL), $this);
        $this->detalle = new clsControl(ccsImageLink, "detalle", "detalle", ccsText, "", CCGetRequestParam("detalle", ccsGet, NULL), $this);
        $this->detalle->Page = "def_informe_detalle.php";
        $this->lbl_lin_fondo = new clsControl(ccsLabel, "lbl_lin_fondo", "lbl_lin_fondo", ccsText, "", CCGetRequestParam("lbl_lin_fondo", ccsGet, NULL), $this);
        $this->lbl_lin_fondo->HTML = true;
        $this->lbl_tree_1 = new clsControl(ccsLabel, "lbl_tree_1", "lbl_tree_1", ccsText, "", CCGetRequestParam("lbl_tree_1", ccsGet, NULL), $this);
        $this->lbl_tree_1->HTML = true;
        $this->det_grupo = new clsControl(ccsLink, "det_grupo", "det_grupo", ccsText, "", CCGetRequestParam("det_grupo", ccsGet, NULL), $this);
        $this->det_grupo->HTML = true;
        $this->det_grupo->Page = "def_grupos.php";
        $this->lbl_det_grupo = new clsControl(ccsLabel, "lbl_det_grupo", "lbl_det_grupo", ccsText, "", CCGetRequestParam("lbl_det_grupo", ccsGet, NULL), $this);
        $this->lbl_det_grupo->HTML = true;
        $this->informes_TotalRecords = new clsControl(ccsLabel, "informes_TotalRecords", "informes_TotalRecords", ccsText, "", CCGetRequestParam("informes_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_nom_informe = new clsSorter($this->ComponentName, "Sorter_nom_informe", $FileName, $this);
        $this->informes_Insert = new clsControl(ccsImageLink, "informes_Insert", "informes_Insert", ccsText, "", CCGetRequestParam("informes_Insert", ccsGet, NULL), $this);
        $this->informes_Insert->Page = "def_informe.php";
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Page = "menu_principal.php";
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-0E2F0C81
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nom_informe"] = CCGetFromGet("s_nom_informe", NULL);

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
            $this->ControlsVisible["icon_plus"] = $this->icon_plus->Visible;
            $this->ControlsVisible["Editar"] = $this->Editar->Visible;
            $this->ControlsVisible["nom_informe"] = $this->nom_informe->Visible;
            $this->ControlsVisible["informe_id"] = $this->informe_id->Visible;
            $this->ControlsVisible["linea"] = $this->linea->Visible;
            $this->ControlsVisible["detalle"] = $this->detalle->Visible;
            $this->ControlsVisible["lbl_lin_fondo"] = $this->lbl_lin_fondo->Visible;
            $this->ControlsVisible["lbl_tree_1"] = $this->lbl_tree_1->Visible;
            $this->ControlsVisible["det_grupo"] = $this->det_grupo->Visible;
            $this->ControlsVisible["lbl_det_grupo"] = $this->lbl_det_grupo->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                if(!is_array($this->Editar->Value) && !strlen($this->Editar->Value) && $this->Editar->Value !== false)
                    $this->Editar->SetText('[Editar]');
                if(!is_array($this->detalle->Value) && !strlen($this->detalle->Value) && $this->detalle->Value !== false)
                    $this->detalle->SetText(Detalles);
                $this->icon_plus->Parameters = CCGetQueryString("QueryString", array("detalle_informe_id", "limpiar", "ccsForm"));
                $this->icon_plus->Parameters = CCAddParam($this->icon_plus->Parameters, "detalle_informe_id", $this->DataSource->f("informe_id"));
                $this->Editar->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Editar->Parameters = CCAddParam($this->Editar->Parameters, "informe_id", $this->DataSource->f("informe_id"));
                $this->nom_informe->SetValue($this->DataSource->nom_informe->GetValue());
                $this->informe_id->SetValue($this->DataSource->informe_id->GetValue());
                $this->detalle->Parameters = CCGetQueryString("QueryString", array("informe_id", "ccsForm"));
                $this->detalle->Parameters = CCAddParam($this->detalle->Parameters, "informe_id", $this->DataSource->f("informe_id"));
                $this->det_grupo->Parameters = "";
                $this->det_grupo->Parameters = CCAddParam($this->det_grupo->Parameters, "s_informe_id", $this->DataSource->f("informe_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->icon_plus->Show();
                $this->Editar->Show();
                $this->nom_informe->Show();
                $this->informe_id->Show();
                $this->linea->Show();
                $this->detalle->Show();
                $this->lbl_lin_fondo->Show();
                $this->lbl_tree_1->Show();
                $this->det_grupo->Show();
                $this->lbl_det_grupo->Show();
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
        $this->informes_Insert->Parameters = CCGetQueryString("QueryString", array("informe_id", "ccsForm"));
        $this->informes_Insert->Parameters = CCAddParam($this->informes_Insert->Parameters, "accion", "agregar");
        $this->informes_Insert->Parameters = CCAddParam($this->informes_Insert->Parameters, "informe_id", "");
        $this->informes_TotalRecords->Show();
        $this->Sorter_nom_informe->Show();
        $this->informes_Insert->Show();
        $this->ImageLink1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-5B238B76
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->icon_plus->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Editar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_informe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->informe_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->linea->Errors->ToString());
        $errors = ComposeStrings($errors, $this->detalle->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_lin_fondo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_tree_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->det_grupo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_det_grupo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End informes Class @2-FCB6E20C

class clsinformesDataSource extends clsDBDatos {  //informesDataSource Class @2-27A8B5B7

//DataSource Variables @2-A369EC80
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $nom_informe;
    public $informe_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-AAB4DA16
    function clsinformesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid informes";
        $this->Initialize();
        $this->nom_informe = new clsField("nom_informe", ccsText, "");
        
        $this->informe_id = new clsField("informe_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-8831E34E
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "nom_informe";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_nom_informe" => array("nom_informe", "")));
    }
//End SetOrder Method

//Prepare Method @2-CD437C91
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nom_informe", ccsText, "", "", $this->Parameters["urls_nom_informe"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nom_informe", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-1A231B9A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM informes";
        $this->SQL = "SELECT * \n\n" .
        "FROM informes {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E75F4B5E
    function SetValues()
    {
        $this->nom_informe->SetDBValue($this->f("nom_informe"));
        $this->informe_id->SetDBValue($this->f("informe_id"));
    }
//End SetValues Method

} //End informesDataSource Class @2-FCB6E20C

class clsRecordinformes1 { //informes1 Class @24-273F5B61

//Variables @24-9E315808

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

//Class_Initialize Event @24-07AA5EC9
    function clsRecordinformes1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record informes1/Error";
        $this->DataSource = new clsinformes1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "informes1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->nom_informe = new clsControl(ccsTextBox, "nom_informe", "Nom Informe", ccsText, "", CCGetRequestParam("nom_informe", $Method, NULL), $this);
            $this->nom_informe->Required = true;
            $this->encabezado = new clsControl(ccsTextBox, "encabezado", "encabezado", ccsText, "", CCGetRequestParam("encabezado", $Method, NULL), $this);
            $this->pie = new clsControl(ccsTextBox, "pie", "Pie", ccsText, "", CCGetRequestParam("pie", $Method, NULL), $this);
            $this->informes_encabezado_id = new clsControl(ccsListBox, "informes_encabezado_id", "Diseño del Encabezado de columna", ccsInteger, "", CCGetRequestParam("informes_encabezado_id", $Method, NULL), $this);
            $this->informes_encabezado_id->DSType = dsTable;
            $this->informes_encabezado_id->DataSource = new clsDBDatos();
            $this->informes_encabezado_id->ds = & $this->informes_encabezado_id->DataSource;
            $this->informes_encabezado_id->DataSource->SQL = "SELECT * \n" .
"FROM informes_encabezado {SQL_Where} {SQL_OrderBy}";
            list($this->informes_encabezado_id->BoundColumn, $this->informes_encabezado_id->TextColumn, $this->informes_encabezado_id->DBFormat) = array("informes_encabezado_id", "nom_informes_encabezado", "");
            $this->informes_encabezado_id->Required = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @24-059DAC19
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlinforme_id"] = CCGetFromGet("informe_id", NULL);
    }
//End Initialize Method

//Validate Method @24-3CC3C1F7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->nom_informe->Validate() && $Validation);
        $Validation = ($this->encabezado->Validate() && $Validation);
        $Validation = ($this->pie->Validate() && $Validation);
        $Validation = ($this->informes_encabezado_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->nom_informe->Errors->Count() == 0);
        $Validation =  $Validation && ($this->encabezado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pie->Errors->Count() == 0);
        $Validation =  $Validation && ($this->informes_encabezado_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-859300F3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nom_informe->Errors->Count());
        $errors = ($errors || $this->encabezado->Errors->Count());
        $errors = ($errors || $this->pie->Errors->Count());
        $errors = ($errors || $this->informes_encabezado_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @24-C6C365F3
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
        $Redirect = "def_informe.php";
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "def_informe.php";
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

//InsertRow Method @24-F75C0864
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->nom_informe->SetValue($this->nom_informe->GetValue(true));
        $this->DataSource->encabezado->SetValue($this->encabezado->GetValue(true));
        $this->DataSource->pie->SetValue($this->pie->GetValue(true));
        $this->DataSource->informes_encabezado_id->SetValue($this->informes_encabezado_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @24-BFED4F9C
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->nom_informe->SetValue($this->nom_informe->GetValue(true));
        $this->DataSource->encabezado->SetValue($this->encabezado->GetValue(true));
        $this->DataSource->pie->SetValue($this->pie->GetValue(true));
        $this->DataSource->informes_encabezado_id->SetValue($this->informes_encabezado_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @24-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @24-2DA1C4E3
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

        $this->informes_encabezado_id->Prepare();

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
                    $this->nom_informe->SetValue($this->DataSource->nom_informe->GetValue());
                    $this->encabezado->SetValue($this->DataSource->encabezado->GetValue());
                    $this->pie->SetValue($this->DataSource->pie->GetValue());
                    $this->informes_encabezado_id->SetValue($this->DataSource->informes_encabezado_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nom_informe->Errors->ToString());
            $Error = ComposeStrings($Error, $this->encabezado->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pie->Errors->ToString());
            $Error = ComposeStrings($Error, $this->informes_encabezado_id->Errors->ToString());
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

        $this->nom_informe->Show();
        $this->encabezado->Show();
        $this->pie->Show();
        $this->informes_encabezado_id->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End informes1 Class @24-FCB6E20C

class clsinformes1DataSource extends clsDBDatos {  //informes1DataSource Class @24-0816D90D

//DataSource Variables @24-F87A5183
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
    public $nom_informe;
    public $encabezado;
    public $pie;
    public $informes_encabezado_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-12F19493
    function clsinformes1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record informes1/Error";
        $this->Initialize();
        $this->nom_informe = new clsField("nom_informe", ccsText, "");
        
        $this->encabezado = new clsField("encabezado", ccsText, "");
        
        $this->pie = new clsField("pie", ccsText, "");
        
        $this->informes_encabezado_id = new clsField("informes_encabezado_id", ccsInteger, "");
        

        $this->InsertFields["nom_informe"] = array("Name" => "nom_informe", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["encabezado"] = array("Name" => "encabezado", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["pie"] = array("Name" => "pie", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["informes_encabezado_id"] = array("Name" => "informes_encabezado_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_informe"] = array("Name" => "nom_informe", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["encabezado"] = array("Name" => "encabezado", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["pie"] = array("Name" => "pie", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["informes_encabezado_id"] = array("Name" => "informes_encabezado_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @24-622A50D8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlinforme_id", ccsInteger, "", "", $this->Parameters["urlinforme_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "informe_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @24-8189B798
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM informes {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @24-6A072919
    function SetValues()
    {
        $this->nom_informe->SetDBValue($this->f("nom_informe"));
        $this->encabezado->SetDBValue($this->f("encabezado"));
        $this->pie->SetDBValue($this->f("pie"));
        $this->informes_encabezado_id->SetDBValue(trim($this->f("informes_encabezado_id")));
    }
//End SetValues Method

//Insert Method @24-7D2C1C83
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["nom_informe"]["Value"] = $this->nom_informe->GetDBValue(true);
        $this->InsertFields["encabezado"]["Value"] = $this->encabezado->GetDBValue(true);
        $this->InsertFields["pie"]["Value"] = $this->pie->GetDBValue(true);
        $this->InsertFields["informes_encabezado_id"]["Value"] = $this->informes_encabezado_id->GetDBValue(true);
        $this->SQL = CCBuildInsert("informes", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @24-82FD9E6A
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["nom_informe"]["Value"] = $this->nom_informe->GetDBValue(true);
        $this->UpdateFields["encabezado"]["Value"] = $this->encabezado->GetDBValue(true);
        $this->UpdateFields["pie"]["Value"] = $this->pie->GetDBValue(true);
        $this->UpdateFields["informes_encabezado_id"]["Value"] = $this->informes_encabezado_id->GetDBValue(true);
        $this->SQL = CCBuildUpdate("informes", $this->UpdateFields, $this);
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

//Delete Method @24-CF6A31C1
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM informes";
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

} //End informes1DataSource Class @24-FCB6E20C

//Initialize Page @1-099F069C
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
$TemplateFileName = "def_informe.html";
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

//Include events file @1-E31AB0D8
include_once("./def_informe_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7FFB4ADF
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$informesSearch = new clsRecordinformesSearch("", $MainPage);
$informes = new clsGridinformes("", $MainPage);
$informes1 = new clsRecordinformes1("", $MainPage);
$MainPage->informesSearch = & $informesSearch;
$MainPage->informes = & $informes;
$MainPage->informes1 = & $informes1;
$informes->Initialize();
$informes1->Initialize();
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

//Execute Components @1-4D4E6F91
$informes1->Operation();
$informesSearch->Operation();
//End Execute Components

//Go to destination page @1-04A00BC0
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($informesSearch);
    unset($informes);
    unset($informes1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-46E22251
$informesSearch->Show();
$informes->Show();
$informes1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4A4B96E7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($informesSearch);
unset($informes);
unset($informes1);
unset($Tpl);
//End Unload Page


?>
