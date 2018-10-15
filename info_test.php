<?php
class clsGridinfo_testtest { //test class @2-F12A788D

//Variables @2-B1F7C844

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
    public $Sorter_codigo_fonasa;
    public $Sorter_cod_test;
//End Variables

//Class_Initialize Event @2-0654B570
    function clsGridinfo_testtest($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "test";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid test";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinfo_testtestDataSource($this);
        $this->ds = & $this->DataSource;
        $this->Visible = (CCSecurityAccessCheck("17;18;19;20") == "success");
        $this->SorterName = CCGetParam("testOrder", "");
        $this->SorterDirection = CCGetParam("testDir", "");

        $this->codigo_fonasa = new clsControl(ccsLabel, "codigo_fonasa", "codigo_fonasa", ccsText, "", CCGetRequestParam("codigo_fonasa", ccsGet, NULL), $this);
        $this->sub_codigo = new clsControl(ccsLabel, "sub_codigo", "sub_codigo", ccsText, "", CCGetRequestParam("sub_codigo", ccsGet, NULL), $this);
        $this->cod_test = new clsControl(ccsLink, "cod_test", "cod_test", ccsText, "", CCGetRequestParam("cod_test", ccsGet, NULL), $this);
        $this->cod_test->Page = $this->RelativePath . "add_test.php";
        $this->Sorter_codigo_fonasa = new clsSorter($this->ComponentName, "Sorter_codigo_fonasa", $FileName, $this);
        $this->Sorter_cod_test = new clsSorter($this->ComponentName, "Sorter_cod_test", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-1F7D1C6D
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
            $this->ControlsVisible["codigo_fonasa"] = $this->codigo_fonasa->Visible;
            $this->ControlsVisible["sub_codigo"] = $this->sub_codigo->Visible;
            $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                $this->sub_codigo->SetValue($this->DataSource->sub_codigo->GetValue());
                $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                $this->cod_test->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->cod_test->Parameters = CCAddParam($this->cod_test->Parameters, "test_id", $this->DataSource->f("test_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->codigo_fonasa->Show();
                $this->sub_codigo->Show();
                $this->cod_test->Show();
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
        $this->Sorter_codigo_fonasa->Show();
        $this->Sorter_cod_test->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-4ED84050
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sub_codigo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End test Class @2-FCB6E20C

class clsinfo_testtestDataSource extends clsDBDatos {  //testDataSource Class @2-75601EEF

//DataSource Variables @2-0DD391E5
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $codigo_fonasa;
    public $sub_codigo;
    public $cod_test;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A926BDCA
    function clsinfo_testtestDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid test";
        $this->Initialize();
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->sub_codigo = new clsField("sub_codigo", ccsText, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-FCE6FDE1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_codigo_fonasa" => array("codigo_fonasa", ""), 
            "Sorter_cod_test" => array("cod_test", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-40D51D3D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT \n" .
        "  test.test_id,\n" .
        "  test.codigo_fonasa,\n" .
        "  test.sub_codigo,\n" .
        "  test.cod_test,\n" .
        "  test.nom_test\n" .
        "FROM\n" .
        "  test\n" .
        "WHERE\n" .
        " `test`.`aislado`='F'\n" .
        "AND\n" .
        "  test.test_id NOT IN (select DISTINCT test_id from `compuesto_detalle`)\n" .
        "  ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-1B948A8E
    function SetValues()
    {
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->sub_codigo->SetDBValue($this->f("sub_codigo"));
        $this->cod_test->SetDBValue($this->f("cod_test"));
    }
//End SetValues Method

} //End testDataSource Class @2-FCB6E20C

class clsGridinfo_testtest1 { //test1 class @10-8CBB3553

//Variables @10-D6E5F49B

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
    public $Sorter_codigo_fonasa;
    public $Sorter_sub_codigo;
    public $Sorter_cod_test;
//End Variables

//Class_Initialize Event @10-C600A7B2
    function clsGridinfo_testtest1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "test1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid test1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinfo_testtest1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->Visible = (CCSecurityAccessCheck("17;18;19;20") == "success");
        $this->SorterName = CCGetParam("test1Order", "");
        $this->SorterDirection = CCGetParam("test1Dir", "");

        $this->codigo_fonasa = new clsControl(ccsLabel, "codigo_fonasa", "codigo_fonasa", ccsText, "", CCGetRequestParam("codigo_fonasa", ccsGet, NULL), $this);
        $this->sub_codigo = new clsControl(ccsLabel, "sub_codigo", "sub_codigo", ccsText, "", CCGetRequestParam("sub_codigo", ccsGet, NULL), $this);
        $this->cod_test = new clsControl(ccsLink, "cod_test", "cod_test", ccsText, "", CCGetRequestParam("cod_test", ccsGet, NULL), $this);
        $this->cod_test->Page = $this->RelativePath . "add_test.php";
        $this->Sorter_codigo_fonasa = new clsSorter($this->ComponentName, "Sorter_codigo_fonasa", $FileName, $this);
        $this->Sorter_sub_codigo = new clsSorter($this->ComponentName, "Sorter_sub_codigo", $FileName, $this);
        $this->Sorter_cod_test = new clsSorter($this->ComponentName, "Sorter_cod_test", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @10-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @10-B592AD14
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
            $this->ControlsVisible["codigo_fonasa"] = $this->codigo_fonasa->Visible;
            $this->ControlsVisible["sub_codigo"] = $this->sub_codigo->Visible;
            $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                $this->sub_codigo->SetValue($this->DataSource->sub_codigo->GetValue());
                $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                $this->cod_test->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->cod_test->Parameters = CCAddParam($this->cod_test->Parameters, "test_id", $this->DataSource->f("test_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->codigo_fonasa->Show();
                $this->sub_codigo->Show();
                $this->cod_test->Show();
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
        $this->Sorter_codigo_fonasa->Show();
        $this->Sorter_sub_codigo->Show();
        $this->Sorter_cod_test->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @10-4ED84050
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sub_codigo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End test1 Class @10-FCB6E20C

class clsinfo_testtest1DataSource extends clsDBDatos {  //test1DataSource Class @10-6DF4C860

//DataSource Variables @10-0DD391E5
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $codigo_fonasa;
    public $sub_codigo;
    public $cod_test;
//End DataSource Variables

//DataSourceClass_Initialize Event @10-EAA7A9B6
    function clsinfo_testtest1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid test1";
        $this->Initialize();
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->sub_codigo = new clsField("sub_codigo", ccsText, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @10-CBFC5820
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_codigo_fonasa" => array("codigo_fonasa", ""), 
            "Sorter_sub_codigo" => array("sub_codigo", ""), 
            "Sorter_cod_test" => array("cod_test", "")));
    }
//End SetOrder Method

//Prepare Method @10-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @10-2540B60A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM `compuesto_detalle`)";
        $this->SQL = "SELECT\n" .
        "  test.test_id,\n" .
        "  test.codigo_fonasa,\n" .
        "  test.sub_codigo,\n" .
        "  test.cod_test,\n" .
        "  test.nom_test\n" .
        "FROM\n" .
        "  test\n" .
        "WHERE\n" .
        "  `test`.`compuesto`='V'\n" .
        "AND\n" .
        "  test.test_id IN (select DISTINCT test_id from `compuesto_detalle`)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @10-1B948A8E
    function SetValues()
    {
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->sub_codigo->SetDBValue($this->f("sub_codigo"));
        $this->cod_test->SetDBValue($this->f("cod_test"));
    }
//End SetValues Method

} //End test1DataSource Class @10-FCB6E20C

class clsinfo_test { //info_test class @1-9664A579

//Variables @1-EEEBE252
    public $ComponentType = "IncludablePage";
    public $Connections = array();
    public $FileName = "";
    public $Redirect = "";
    public $Tpl = "";
    public $TemplateFileName = "";
    public $BlockToParse = "";
    public $ComponentName = "";
    public $Attributes = "";

    // Events;
    public $CCSEvents = "";
    public $CCSEventResult = "";
    public $RelativePath;
    public $Visible;
    public $Parent;
    public $TemplateSource;
//End Variables

//Class_Initialize Event @1-694FF4BF
    function clsinfo_test($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "info_test.php";
        $this->Redirect = "";
        $this->TemplateFileName = "info_test.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-32F67158
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->test);
        unset($this->test1);
    }
//End Class_Terminate Event

//BindEvents Method @1-268F1324
    function BindEvents()
    {
        $this->CCSEvents["BeforeOutput"] = "info_test_BeforeOutput";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-7E2A14CF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
    }
//End Operations Method

//Initialize Method @1-86520E22
    function Initialize($Path = "")
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        global $Scripts;
        $IncScripts = "|";
        $SList = explode("|", $IncScripts);
        foreach ($SList as $Script) {
            if ($Script != "" && strpos($Scripts, "|" . $Script . "|") === false)  $Scripts = $Scripts . $Script . "|";
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;
        $this->DBDatos = new clsDBDatos();
        $this->Connections["Datos"] = & $this->DBDatos;

        // Create Components
        $this->test = new clsGridinfo_testtest($this->RelativePath, $this);
        $this->test1 = new clsGridinfo_testtest1($this->RelativePath, $this);
        $this->test->Initialize();
        $this->test1->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-480426E3
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        if ($this->TemplateSource) {
            $Tpl->LoadTemplateFromStr($this->TemplateSource, $this->ComponentName, $this->TemplateEncoding);
        } else {
            $Tpl->LoadTemplate("/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        }
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->test->Show();
        $this->test1->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
        $TplData = $Tpl->GetVar($this->ComponentName);
        $Tpl->SetVar($this->ComponentName, $TplData);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
    }
//End Show Method

} //End info_test Class @1-FCB6E20C

//Include Event File @1-ED6EFAB6
include_once(RelativePath . "/info_test_events.php");
//End Include Event File


?>
