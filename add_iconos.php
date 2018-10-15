<?php
//Include Common Files @1-414E77A8
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_iconos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridiconos { //iconos class @2-B2380F05

//Variables @2-CE566967

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
    public $AltRowControls;
    public $IsAltRow;
    public $Sorter_nom_icono;
    public $Sorter_path_icono;
//End Variables

//Class_Initialize Event @2-FDB67882
    function clsGridiconos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "iconos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid iconos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsiconosDataSource($this);
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
        $this->SorterName = CCGetParam("iconosOrder", "");
        $this->SorterDirection = CCGetParam("iconosDir", "");

        $this->Detail = new clsControl(ccsLink, "Detail", "Detail", ccsText, "", CCGetRequestParam("Detail", ccsGet, NULL), $this);
        $this->Detail->Page = "add_iconos.php";
        $this->nom_icono = new clsControl(ccsLabel, "nom_icono", "nom_icono", ccsText, "", CCGetRequestParam("nom_icono", ccsGet, NULL), $this);
        $this->path_icono = new clsControl(ccsLabel, "path_icono", "path_icono", ccsText, "", CCGetRequestParam("path_icono", ccsGet, NULL), $this);
        $this->path_icono->HTML = true;
        $this->path = new clsControl(ccsHidden, "path", "path", ccsText, "", CCGetRequestParam("path", ccsGet, NULL), $this);
        $this->Alt_Detail = new clsControl(ccsLink, "Alt_Detail", "Alt_Detail", ccsText, "", CCGetRequestParam("Alt_Detail", ccsGet, NULL), $this);
        $this->Alt_Detail->Page = "add_iconos.php";
        $this->Alt_nom_icono = new clsControl(ccsLabel, "Alt_nom_icono", "Alt_nom_icono", ccsText, "", CCGetRequestParam("Alt_nom_icono", ccsGet, NULL), $this);
        $this->Alt_path_icono = new clsControl(ccsLabel, "Alt_path_icono", "Alt_path_icono", ccsText, "", CCGetRequestParam("Alt_path_icono", ccsGet, NULL), $this);
        $this->Alt_path_icono->HTML = true;
        $this->alt_path = new clsControl(ccsHidden, "alt_path", "alt_path", ccsText, "", CCGetRequestParam("alt_path", ccsGet, NULL), $this);
        $this->iconos_TotalRecords = new clsControl(ccsLabel, "iconos_TotalRecords", "iconos_TotalRecords", ccsText, "", CCGetRequestParam("iconos_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_nom_icono = new clsSorter($this->ComponentName, "Sorter_nom_icono", $FileName, $this);
        $this->Sorter_path_icono = new clsSorter($this->ComponentName, "Sorter_path_icono", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->iconos_Insert = new clsControl(ccsLink, "iconos_Insert", "iconos_Insert", ccsText, "", CCGetRequestParam("iconos_Insert", ccsGet, NULL), $this);
        $this->iconos_Insert->Parameters = CCGetQueryString("QueryString", array("icono_id", "ccsForm"));
        $this->iconos_Insert->Page = "add_iconos.php";
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

//Show Method @2-4A45490A
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


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
            $this->ControlsVisible["Detail"] = $this->Detail->Visible;
            $this->ControlsVisible["nom_icono"] = $this->nom_icono->Visible;
            $this->ControlsVisible["path_icono"] = $this->path_icono->Visible;
            $this->ControlsVisible["path"] = $this->path->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->Detail->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->Detail->Parameters = CCAddParam($this->Detail->Parameters, "icono_id", $this->DataSource->f("icono_id"));
                    $this->nom_icono->SetValue($this->DataSource->nom_icono->GetValue());
                    $this->path->SetValue($this->DataSource->path->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Detail->Show();
                    $this->nom_icono->Show();
                    $this->path_icono->Show();
                    $this->path->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_Detail->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->Alt_Detail->Parameters = CCAddParam($this->Alt_Detail->Parameters, "icono_id", $this->DataSource->f("icono_id"));
                    $this->Alt_nom_icono->SetValue($this->DataSource->Alt_nom_icono->GetValue());
                    $this->alt_path->SetValue($this->DataSource->alt_path->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Alt_Detail->Show();
                    $this->Alt_nom_icono->Show();
                    $this->Alt_path_icono->Show();
                    $this->alt_path->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parseto("AltRow", true, "Row");
                }
                $this->IsAltRow = (!$this->IsAltRow);
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
        $this->iconos_TotalRecords->Show();
        $this->Sorter_nom_icono->Show();
        $this->Sorter_path_icono->Show();
        $this->Navigator->Show();
        $this->iconos_Insert->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-EB261C9F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Detail->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_icono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->path_icono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->path->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_Detail->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_icono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_path_icono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alt_path->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End iconos Class @2-FCB6E20C

class clsiconosDataSource extends clsDBDatos {  //iconosDataSource Class @2-F356E480

//DataSource Variables @2-9AD1AAD4
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $nom_icono;
    public $path;
    public $Alt_nom_icono;
    public $alt_path;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F6C65E26
    function clsiconosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid iconos";
        $this->Initialize();
        $this->nom_icono = new clsField("nom_icono", ccsText, "");
        
        $this->path = new clsField("path", ccsText, "");
        
        $this->Alt_nom_icono = new clsField("Alt_nom_icono", ccsText, "");
        
        $this->alt_path = new clsField("alt_path", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-AF716489
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_nom_icono" => array("nom_icono", ""), 
            "Sorter_path_icono" => array("path_icono", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-D7EE55CC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM iconos";
        $this->SQL = "SELECT * \n\n" .
        "FROM iconos {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-276127EA
    function SetValues()
    {
        $this->nom_icono->SetDBValue($this->f("nom_icono"));
        $this->path->SetDBValue($this->f("path_icono"));
        $this->Alt_nom_icono->SetDBValue($this->f("nom_icono"));
        $this->alt_path->SetDBValue($this->f("path_icono"));
    }
//End SetValues Method

} //End iconosDataSource Class @2-FCB6E20C

class clsRecordiconos1 { //iconos1 Class @17-B8C2B7D9

//Variables @17-9E315808

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

//Class_Initialize Event @17-CC0D3E9F
    function clsRecordiconos1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record iconos1/Error";
        $this->DataSource = new clsiconos1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "iconos1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->icono_id = new clsControl(ccsHidden, "icono_id", "Id", ccsInteger, "", CCGetRequestParam("icono_id", $Method, NULL), $this);
            $this->nom_icono = new clsControl(ccsTextBox, "nom_icono", "Nombre descriptivo", ccsText, "", CCGetRequestParam("nom_icono", $Method, NULL), $this);
            $this->nom_icono->Required = true;
            $this->FileUpload_path_icono = new clsFileUpload("FileUpload_path_icono", "FileUpload_path_icono", "TEMP/", "images/", "*.gif", "*.exe;*.zip;*.php;*.htm;*.html", 100000, $this);
            $this->FileUpload_path_icono->Required = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @17-120DF9E4
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlicono_id"] = CCGetFromGet("icono_id", NULL);
    }
//End Initialize Method

//Validate Method @17-580CE03F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->icono_id->Validate() && $Validation);
        $Validation = ($this->nom_icono->Validate() && $Validation);
        $Validation = ($this->FileUpload_path_icono->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->icono_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_icono->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload_path_icono->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @17-D38CF113
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->icono_id->Errors->Count());
        $errors = ($errors || $this->nom_icono->Errors->Count());
        $errors = ($errors || $this->FileUpload_path_icono->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @17-05B7C240
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

        $this->FileUpload_path_icono->Upload();

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
        $Redirect = "add_iconos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "menu_principal.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @17-022CA70C
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->icono_id->SetValue($this->icono_id->GetValue(true));
        $this->DataSource->nom_icono->SetValue($this->nom_icono->GetValue(true));
        $this->DataSource->FileUpload_path_icono->SetValue($this->FileUpload_path_icono->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload_path_icono->Move();
        }
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @17-8F667539
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->icono_id->SetValue($this->icono_id->GetValue(true));
        $this->DataSource->nom_icono->SetValue($this->nom_icono->GetValue(true));
        $this->DataSource->FileUpload_path_icono->SetValue($this->FileUpload_path_icono->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload_path_icono->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @17-9CB422A3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload_path_icono->Delete();
        }
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @17-DB437226
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
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->icono_id->SetValue($this->DataSource->icono_id->GetValue());
                    $this->nom_icono->SetValue($this->DataSource->nom_icono->GetValue());
                    $this->FileUpload_path_icono->SetValue($this->DataSource->FileUpload_path_icono->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->icono_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_icono->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload_path_icono->Errors->ToString());
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

        $this->icono_id->Show();
        $this->nom_icono->Show();
        $this->FileUpload_path_icono->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End iconos1 Class @17-FCB6E20C

class clsiconos1DataSource extends clsDBDatos {  //iconos1DataSource Class @17-B07F8253

//DataSource Variables @17-CE6AD5E5
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
    public $icono_id;
    public $nom_icono;
    public $FileUpload_path_icono;
//End DataSource Variables

//DataSourceClass_Initialize Event @17-E8B90DA4
    function clsiconos1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record iconos1/Error";
        $this->Initialize();
        $this->icono_id = new clsField("icono_id", ccsInteger, "");
        
        $this->nom_icono = new clsField("nom_icono", ccsText, "");
        
        $this->FileUpload_path_icono = new clsField("FileUpload_path_icono", ccsText, "");
        

        $this->InsertFields["icono_id"] = array("Name" => "icono_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_icono"] = array("Name" => "nom_icono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["path_icono"] = array("Name" => "path_icono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["icono_id"] = array("Name" => "icono_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_icono"] = array("Name" => "nom_icono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["path_icono"] = array("Name" => "path_icono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @17-13815DFF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlicono_id", ccsInteger, "", "", $this->Parameters["urlicono_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "icono_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @17-97CA81B2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM iconos {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @17-EC898F61
    function SetValues()
    {
        $this->icono_id->SetDBValue(trim($this->f("icono_id")));
        $this->nom_icono->SetDBValue($this->f("nom_icono"));
        $this->FileUpload_path_icono->SetDBValue($this->f("path_icono"));
    }
//End SetValues Method

//Insert Method @17-23EDFDAB
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["icono_id"]["Value"] = $this->icono_id->GetDBValue(true);
        $this->InsertFields["nom_icono"]["Value"] = $this->nom_icono->GetDBValue(true);
        $this->InsertFields["path_icono"]["Value"] = $this->FileUpload_path_icono->GetDBValue(true);
        $this->SQL = CCBuildInsert("iconos", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @17-2757F527
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["icono_id"]["Value"] = $this->icono_id->GetDBValue(true);
        $this->UpdateFields["nom_icono"]["Value"] = $this->nom_icono->GetDBValue(true);
        $this->UpdateFields["path_icono"]["Value"] = $this->FileUpload_path_icono->GetDBValue(true);
        $this->SQL = CCBuildUpdate("iconos", $this->UpdateFields, $this);
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

//Delete Method @17-5C55BE1B
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM iconos";
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

} //End iconos1DataSource Class @17-FCB6E20C

//Initialize Page @1-77565C5D
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
$TemplateFileName = "add_iconos.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-2E557B45
CCSecurityRedirect("20", "error_nivel.php");
//End Authenticate User

//Include events file @1-287378AA
include_once("./add_iconos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DE92868B
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$iconos = new clsGridiconos("", $MainPage);
$iconos1 = new clsRecordiconos1("", $MainPage);
$MainPage->iconos = & $iconos;
$MainPage->iconos1 = & $iconos1;
$iconos->Initialize();
$iconos1->Initialize();
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

//Execute Components @1-3F819CAA
$iconos1->Operation();
//End Execute Components

//Go to destination page @1-99C02AFA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($iconos);
    unset($iconos1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0F26D208
$iconos->Show();
$iconos1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2507B75E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($iconos);
unset($iconos1);
unset($Tpl);
//End Unload Page


?>
