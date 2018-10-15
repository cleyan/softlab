<?php
        
//File Description @0-916F68BD
//======================================================
//
//  This file contains the following classes:
//      class clsSQLParameters
//      class clsSQLParameter
//      class clsControl
//      class clsField
//      class clsButton
//      class clsPanel
//      class clsFileUpload
//      class clsDatePicker
//      class clsErrors
//      class clsSection
//      class clsLocaleInfo
//      class clsLocale
//      class clsLocales
//      class clsAttribute
//      class clsAttributes
//
//======================================================
//End File Description

//Constant List @0-033DA0AC

// ------- Controls ---------------
define("ccsLabel",           1);
define("ccsLink",            2);
define("ccsTextBox",         3);
define("ccsTextArea",        4);
define("ccsListBox",         5);
define("ccsRadioButton",     6);
define("ccsButton",          7);
define("ccsCheckBox",        8);
define("ccsImage",           9);
define("ccsImageLink",       10);
define("ccsHidden",          11);
define("ccsCheckBoxList",    12);
define("ccsDatePicker",      13);
define("ccsReportLabel",     14);
define("ccsReportPageBreak", 15);

$ControlTypes = array(
  "", "Label","Link","TextBox","TextArea","ListBox","RadioButton",
  "Button","CheckBox","Image","ImageLink","Hidden","CheckBoxList",
  "DatePicker", "ReportLabel","ReportPageBreak"
);


// ------- Operators --------------
define("opEqual",              1);
define("opNotEqual",           2);
define("opLessThan",           3);
define("opLessThanOrEqual",    4);
define("opGreaterThan",        5);
define("opGreaterThanOrEqual", 6);
define("opBeginsWith",         7);
define("opNotBeginsWith",      8);
define("opEndsWith",           9);
define("opNotEndsWith",        10);
define("opContains",           11);
define("opNotContains",        12);
define("opIsNull",             13);
define("opNotNull",            14);
define("opIn",                 15);
define("opBetween",            16);
define("opNotIn",              17);
define("opNotBetween",         18);

// ------- Datasource types -------
define("dsTable",        1);
define("dsSQL",          2);
define("dsProcedure",    3);
define("dsListOfValues", 4);
define("dsEmpty",        5);

// ------- CheckBox states --------
define("ccsChecked", true);
define("ccsUnchecked", false);


//End Constant List

//CCCheckValue @0-962BACE6
function CCCheckValue($Value, $DataType)
{
  $result = false;
  if($DataType == ccsInteger)
    $result = is_int($Value); 
  else if($DataType == ccsFloat)
    $result = is_float($Value);
  else if($DataType == ccsDate)
    $result = (is_array($Value) || is_int($Value));
  else if($DataType == ccsBoolean)
    $result = is_bool($Value); 
  return $result;
}
//End CCCheckValue

//clsSQLParameters Class @0-02352C57

class clsSQLParameters
{
  
  var $Connection;
  var $Criterion;
  var $AssembledWhere;
  var $Errors;
  var $DataSource;
  var $AllParametersSet;
  var $ErrorBlock;

  var $Parameters1;

  function clsSQLParameters($ErrorBlock = "")
  {
    $this->ErrorBlock = $ErrorBlock;
  }

  function SetParameters($Name, $NewParameter)
  {
    $this->Parameters[$Name] = $NewParameter;
  }

  function AddParameter($ParameterID, $ParameterSource, $DataType, $Format, $DBFormat, $InitValue, $DefaultValue, $UseIsNull = false)
  {
    $this->Parameters[$ParameterID] = new clsSQLParameter($ParameterSource, $DataType, $Format, $DBFormat, $InitValue, $DefaultValue, $UseIsNull, $this->ErrorBlock);
  }

  function AllParamsSet()
  {
    $blnResult = true;

    if(isset($this->Parameters) && is_array($this->Parameters))
    {
      reset($this->Parameters);
      while ($blnResult && list ($key, $Parameter) = each ($this->Parameters)) 
      {
        if($Parameter->GetValue() === "" && $Parameter->GetValue() !== false && $Parameter->UseIsNull === false)
          $blnResult = false;
      }
    }
     return $blnResult;
  }

  function GetDBValue($ParameterID)
  {
    return $this->Parameters[$ParameterID]->GetDBValue();
  }

  function opAND($Brackets, $strLeft, $strRight)
  {
    $strResult = "";
    if (strlen($strLeft))
    {
      if (strlen($strRight)) 
      {
        $strResult = $strLeft . " AND " . $strRight;
        if ($Brackets) 
          $strResult = " (" . $strResult . ") ";
      }
      else
      {
        $strResult = $strLeft;
      }
    }
    else
    {
      if (strlen($strRight)) 
        $strResult = $strRight;
    }
    return $strResult;
  }

  function opOR($Brackets, $strLeft, $strRight)
  {
    $strResult = "";
    if (strlen($strLeft))
    {
      if (strlen($strRight))
      {
        $strResult = $strLeft . " OR " . $strRight;
        if ($Brackets) 
          $strResult = " (" . $strResult . ") ";
      }
      else
      {
        $strResult = $strLeft;
      }
    }
    else
    {
      if (strlen($strRight))
        $strResult = $strRight;
    }
    return $strResult;
  }

  function Operation($Operation, $FieldName, $DBValue, $SQLText, $UseIsNull = false)
  {
    $Result = "";

    if((is_array($DBValue) && count($DBValue)) || (!is_array($DBValue) && (strlen($DBValue) || $DBValue === false)))
    {
      $SQLTextVal = $SQLValue = is_array($SQLText) ? $SQLText[0] : $SQLText;
      if(!is_array($DBValue) && CCSubStr($SQLValue, 0, 1) == "'")
        $SQLValue = CCSubStr($SQLValue, 1, CCStrLen($SQLValue) - 2);

      switch ($Operation)
      {
        case opEqual:
          $Result = $FieldName . " = " . $SQLTextVal;
          break;
        case opNotEqual:
          $Result = $FieldName . " <> " . $SQLTextVal;
          break;
        case opLessThan:
          $Result = $FieldName . " < " . $SQLTextVal;
          break;
        case opLessThanOrEqual:
          $Result = $FieldName . " <= " . $SQLTextVal;
          break;
        case opGreaterThan:
          $Result = $FieldName . " > " . $SQLTextVal;
          break;
        case opGreaterThanOrEqual:
          $Result = $FieldName . " >= " . $SQLTextVal;
          break;                                
        case opBeginsWith:
          $Result = $FieldName . " like '" . $SQLValue . "%'";
          break;
        case opNotBeginsWith:
          $Result = $FieldName . " not like '" . $SQLValue . "%'";
          break;
        case opEndsWith:
          $Result = $FieldName . " like '%" . $SQLValue . "'";
          break;
        case opNotEndsWith:
          $Result = $FieldName . " not like '%" . $SQLValue . "'";
          break;
        case opContains:
          $Result = $FieldName . " like '%" . $SQLValue . "%'";
          break;
        case opNotContains:
          $Result = $FieldName . " not like '%" . $SQLValue . "%'";
          break;
        case opIsNull:
          $Result = $FieldName . " IS NULL";
          break;
        case opNotNull:
          $Result = $FieldName . " IS NOT NULL";
          break;
        case opIn:
          if (is_array($SQLText)) 
            $Result = $FieldName . " IN (" .  implode(", ", $SQLText) . ")";
          else
            $Result = $FieldName . " IN (" .  $SQLText . ")";
          break;
        case opBetween:
          if (is_array($SQLText) && count($SQLText) > 1) 
            $Result = $FieldName . " BETWEEN " .  $SQLText[0] . " AND " . $SQLText[1];
          elseif (is_array($SQLText)) 
            $Result = $FieldName . " BETWEEN " .  $SQLText[0] . " AND " . $SQLText[0];
          else
            $Result = $FieldName . " BETWEEN " .  $SQLText . " AND " . $SQLText;
          break;
        case opNotIn:
          if (is_array($SQLText)) 
            $Result = $FieldName . " NOT IN (" .  implode(", ", $SQLText) . ")";
          else
            $Result = $FieldName . " NOT IN (" .  $SQLText . ")";
          break;
        case opNotBetween:
          if (is_array($SQLText) && count($SQLText) > 1) 
            $Result = $FieldName . " NOT BETWEEN " .  $SQLText[0] . " AND " . $SQLText[1];
          elseif (is_array($SQLText)) 
            $Result = $FieldName . " NOT BETWEEN " .  $SQLText[0] . " AND " . $SQLText[0];
          else
            $Result = $FieldName . " NOT BETWEEN " .  $SQLText . " AND " . $SQLText;
          break;

      }
    } 
    else if ($UseIsNull) 
    {
      switch ($Operation)
      {
        case opEqual:
        case opLessThan:
        case opLessThanOrEqual:
        case opGreaterThan:
        case opGreaterThanOrEqual:
        case opBeginsWith:
        case opEndsWith:
        case opContains:
        case opIsNull:
        case opIn:
          $Result = $FieldName . " IS NULL";
          break;
        case opNotEqual:
        case opNotEndsWith:
        case opNotBeginsWith:
        case opNotContains:
        case opNotNull:
          $Result = $FieldName . " IS NOT NULL";
          break;
      }

    }

    return $Result;
  }
}
//End clsSQLParameters Class

//clsSQLParameter Class @0-AC5BDB87
class clsSQLParameter
{
  var $Errors;
  var $DataType;
  var $Format;
  var $DBFormat;
  var $Link;
  var $Caption;
  var $ErrorBlock;
  var $UseIsNull;

  var $Value = "";
  var $IsNull = true;
  var $DBValue;
  var $Text;
  

  function clsSQLParameter($ParameterSource, $DataType, $Format, $DBFormat, $InitValue, $DefaultValue, $UseIsNull = false, $ErrorBlock = "")
  {
    $this->Value = NULL;

    $this->Errors = new clsErrors();
    $this->ErrorBlock = $ErrorBlock;
    $this->UseIsNull = $UseIsNull;

    $this->Caption = $ParameterSource;
    $this->DataType = $DataType;
    $this->Format = $Format;
    $this->DBFormat = $DBFormat;
    if(is_array($InitValue) || strlen($InitValue))
      $this->SetText($InitValue);
    else if(!is_null($DefaultValue))
      $this->SetText($DefaultValue);
  }

  function GetParsedValue($ParsingValue, $Format, $isDbFormat = false)
  {
    global $Tpl;
    global $CCSLocales;
    $varResult = "";

    if (strlen($ParsingValue))
    {
      switch ($this->DataType)
      {
        case ccsDate:
          $DateValidation = true;
          if (CCValidateDateMask($ParsingValue, $Format)) {
            $varResult = CCParseDate($ParsingValue, $Format);
            if(!$varResult || !CCValidateDate($varResult))
            {
              $DateValidation = false;
              $varResult = "";
            }
          } else {
            $DateValidation = false;
          }
          if(!$DateValidation) {
            if (is_array($Format)) {
              $FormatString = join("", $Format);
            } else {
              $FormatString = $Format;
            }
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectFormat', array($this->Caption, $FormatString)));
          }
          break;
        case ccsBoolean:
          if (CCValidateBoolean($ParsingValue, $Format))
            $varResult = CCParseBoolean($ParsingValue, $Format);
          else
          {
            if (is_array($Format)) {
              $FormatString = CCGetBooleanFormat($Format);;
            } else {
              $FormatString = $Format;
            }
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectFormat', array($this->Caption, $FormatString)));
          }
          break;
        case ccsInteger:
          if (CCValidateNumber($ParsingValue, $Format, $isDbFormat))
            $varResult = CCParseInteger($ParsingValue, $Format, $isDbFormat);
          else
          {
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectValue', $this->Caption));
          }
          break;
        case ccsFloat:
          if (CCValidateNumber($ParsingValue, $Format, $isDbFormat) )
            $varResult = CCParseFloat($ParsingValue, $Format, $isDbFormat);
          else 
          {
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectValue', $this->Caption));
          }
          break;
        case ccsText:
        case ccsMemo:
          $varResult = strval($ParsingValue);
          break;
      }
      if($this->Errors->Count() > 0)
      {
        if(strlen($this->ErrorBlock))
          $Tpl->replaceblock($this->ErrorBlock, $this->Errors->ToString());
        else
          echo $this->Errors->ToString();
      }
    }

    return $varResult;
  }

  function GetFormattedValue($Format, $isDbFormat = false)
  {
    $strResult = "";
    switch($this->DataType)
    {
      case ccsDate:
        $strResult = CCFormatDate($this->Value, $Format);
        break;
      case ccsBoolean:
        $strResult = CCFormatBoolean($this->Value, $Format);
        break;
      case ccsInteger:
      case ccsFloat:
      case ccsSingle:
        $strResult = CCFormatNumber($this->Value, $Format, $this->DataType, $isDbFormat);
        break;
      case ccsText:
      case ccsMemo:
        $strResult = strval($this->Value);
        break;
    }
    return $strResult;
  }

  function SetValue($Value)
  {
    if (is_array($Value) && ($this->DataType != ccsDate || is_array($Value[0]))) {
      $DBValues = array();
      $Texts = array();
      foreach ($Values as $Val) {
        $this->SetValue($val);
        $DBValues[] = $this->GetDBValue(true);
        $Texts[] = $this->getText(true);
      }
      $this->Value = $Value;
      $this->Text = $Texts;
      $this->DBValue = $DBValues;
      $this->IsNull = count($Value) > 0;
      return;
    }
    if (is_null($Value)) {
      $this->Value = "";
      $this->IsNull = true;
    } else {
      $this->Value = $Value;
      $this->IsNull = false;
    }
    $this->Text = $this->GetFormattedValue($this->Format);
    $this->DBValue = $this->GetFormattedValue($this->DBFormat, true);
  }

  function SetText($Text)
  {
    if (is_array($Text) && ($this->DataType != ccsDate || !CCValidateDate($Text))) {
      $Values = array();
      $DBValues = array();
      foreach ($Text as $Txt) {
        $this->SetText($Txt);
        $Values[] = $this->GetValue(true);
        $DBValues[] = $this->GetDBValue(true);
      }
      $this->Value = $Values;
      $this->Text = $Text;
      $this->DBValue = $DBValues;          
      $this->IsNull = count($Text) > 0;
    } elseif (CCCheckValue($Text, $this->DataType)) {
      $this->SetValue($Text);
    } else {
      $this->Text = $Text;
      $this->Value = $this->GetParsedValue($this->Text, $this->Format);
      if (is_null($this->Value)) {
        $this->Value = "";
        $this->IsNull = true;
      } else {
        $this->IsNull = false;
      }
      $this->DBValue = $this->GetFormattedValue($this->DBFormat, true);
    }
  }

  function SetDBValue($DBValue)
  {
    if (is_array($DBValue)) {
      $Values = array();
      $Texts = array();
      foreach ($DBValue as $DBVal) {
        $this->SetDBValue($DBVal);
        $Values[] = $this->GetValue(true);
        $Texts[] = $this->GetText(true);
      }
      $this->DBValue = $DBValue;
      $this->Value = $Values;
      $this->Text = $Texts;
      $this->IsNull = count($DBValue) > 0;
    } else {
      $this->DBValue = $DBValue;
      $this->Value = $this->GetParsedValue($this->DBValue, $this->DBFormat, true);
      $this->Text = $this->GetFormattedValue($this->Format);
    }
  }

  function GetValue($returnNull = false)
  {
    return $returnNull && $this->IsNull ? NULL : $this->Value;
  }

  function GetText()
  {
    return $this->Text;
  }

  function GetDBValue($returnNull = false)
  {
    return $returnNull && $this->IsNull ? NULL : $this->DBValue;
  }

}

//End clsSQLParameter Class

//clsControl Class @0-A6794D82
class clsControl
{
  var $ComponentType = "Control";
  var $Errors;
  var $DataType;
  var $DSType;
  var $Format;
  var $DBFormat;
  var $Caption;
  var $ControlType;
  var $ControlTypeName;
  var $Name;
  var $BlockName;
  var $HTML;
  var $Required;
  var $CheckedValue;
  var $UncheckedValue;
  var $State;
  var $BoundColumn;
  var $TextColumn;
  var $Multiple;
  var $Visible;

  var $Page;
  var $Parameters;

  var $CountValue;
  var $SumValue;
  var $ValueRelative;
  var $CountValueRelative;
  var $SumValueRelative;
  var $TotalFunction;
  var $IsPercent = false;
  var $IsEmptySource = false;

  var $isInternal = false;
  var $initialValue;
  var $prevItem = false;

  var $prevValue;
  var $prevCountValue;
  var $prevSumValue;
  var $prevValueRelative;
  var $prevCountValueRelative;
  var $prevSumValueRelative;


  var $Value = "";
  var $Text;
  var $EmptyText;
  var $Values;
  var $IsNull = true;

  var $CCSEvents;
  var $CCSEventResult;

  var $Parent;

  var $Attributes;


  function clsControl($ControlType, $Name, $Caption, $DataType, $Format, $InitValue = "", & $Parent)
  {
    global $ControlTypes;

    $this->Text = "";
    $this->Page = "";
    $this->Parameters = "";
    $this->CCSEvents = "";
    $this->Values = "";
    $this->BoundColumn = "";
    $this->TextColumn = "";
    $this->Visible = true;

    $this->Required = false;
    $this->HTML = false;
    $this->Multiple = false;

    $this->Errors = new clsErrors();

    $this->Name = $Name;
    $this->BlockName = $ControlTypes[$ControlType] . " " . $Name;
    $this->ControlType = $ControlType;
    $this->DataType = $DataType;
    $this->DSType = dsEmpty;
    $this->Format = $Format;
    $this->Caption = $Caption;
    if(is_array($InitValue)) {
      $this->Value = $InitValue;
      $this->IsNull = false;
    } else if(!is_null($InitValue))
      $this->SetText($InitValue);
    $this->Parent = & $Parent;
    $this->ComponentType = $ControlTypes[$ControlType];
    $this->Attributes = new clsAttributes($this->Name . ":");
  }

  function Validate()
  {
    global $CCSLocales;
    $validation = true;
    if($this->Required && ($this->Value === "" || is_null($this->Value)) && $this->Errors->Count() == 0)
    {
      $FieldName = strlen($this->Caption) ? $this->Caption : $this->Name;
      $this->Errors->addError($CCSLocales->GetText('CCS_RequiredField', $this->Caption));
    }
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
    return ($this->Errors->Count() == 0);
  }

  function GetParsedValue($ParsingValue)
  {
    global $CCSLocales;
    $varResult = "";
    if($this->Multiple && is_array($ParsingValue)) {
      $ParsingValue = $ParsingValue[0];
    }
    if(CCCheckValue($ParsingValue, $this->DataType))
      $varResult = $ParsingValue;
    else if(strlen($ParsingValue))
    {
      switch ($this->DataType)
      {
        case ccsDate:
          $DateValidation = true;
          if (CCValidateDateMask($ParsingValue, $this->Format)) {
            $varResult = CCParseDate($ParsingValue, $this->Format);
            if(!$varResult || !CCValidateDate($varResult))
            {
              $DateValidation = false;
              $varResult = "";
            }
          } else {
            $DateValidation = false;
          }
          if(!$DateValidation && $this->Errors->Count() == 0)
          {
            if (is_array($this->Format)) {
              $FormatString = join("", $this->Format);
            } else {
              $FormatString = $this->Format;
            }
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectFormat', array($this->Caption, $FormatString)));
          }
          break;
        case ccsBoolean:
          if (CCValidateBoolean($ParsingValue, $this->Format))
            $varResult = CCParseBoolean($ParsingValue, $this->Format);
          else if($this->Errors->Count() == 0) {
            if (is_array($this->Format)) {
              $FormatString = CCGetBooleanFormat($this->Format);
            } else {
              $FormatString = $this->Format;
            }
              $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectFormat', array($this->Caption, $FormatString)));          }
          break;
        case ccsInteger:
          if (CCValidateNumber($ParsingValue, $this->Format))
            $varResult = CCParseInteger($ParsingValue, $this->Format);
          else if($this->Errors->Count() == 0)
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectValue', $this->Caption));
          break;
        case ccsFloat:
          if (CCValidateNumber($ParsingValue, $this->Format))
            $varResult = CCParseFloat($ParsingValue, $this->Format);
          else if($this->Errors->Count() == 0)
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectValue', $this->Caption));
          break;
        case ccsText:
        case ccsMemo:
          $varResult = strval($ParsingValue);
          break;
      }
    }

    return $varResult;
  }

  function GetFormattedValue()
  {
    $strResult = "";
    switch($this->DataType)
    {
      case ccsDate:
        $strResult = CCFormatDate($this->Value, $this->Format);
        break;
      case ccsBoolean:
        $strResult = CCFormatBoolean($this->Value, $this->Format);
        break;
      case ccsInteger:
      case ccsFloat:
      case ccsSingle:
        $strResult = CCFormatNumber($this->Value, $this->Format, $this->DataType);
        break;
      case ccsText:
      case ccsMemo:
        $strResult = strval($this->Value);
        break;
    }
    return $strResult;
  }

  function Prepare()
  {
    if($this->DSType == dsTable || $this->DSType == dsSQL || $this->DSType == dsProcedure)
    {
      if(!isset($this->DataSource->CCSEvents)) $this->DataSource->CCSEvents = "";
      if(!strlen($this->BoundColumn)) $this->BoundColumn = 0;
      if(!strlen($this->TextColumn)) $this->TextColumn = 1;
      $this->EventResult = CCGetEvent($this->DataSource->CCSEvents, "BeforeBuildSelect", $this);
      $this->EventResult = CCGetEvent($this->DataSource->CCSEvents, "BeforeExecuteSelect", $this);
      $FieldName = strlen($this->Caption) ? $this->Caption : $this->Name;
      list($this->Values, $this->Errors) = CCGetListValues($this->DataSource, $this->DataSource->SQL, $this->DataSource->Where, $this->DataSource->Order, $this->BoundColumn, $this->TextColumn, $this->DBFormat, $this->DataType, $this->Errors, $FieldName, $this->DSType);
      $this->DataSource->close();
      $this->EventResult = CCGetEvent($this->DataSource->CCSEvents, "AfterExecuteSelect", $this);
    }
  }

  function Show($RowNumber = "")
  {
    global $Tpl;
    $this->EventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);

    $ControlName = ($RowNumber === "") ? $this->Name : $this->Name . "_" . $RowNumber;
    if($this->Multiple) $ControlName = $ControlName . "[]";

    if(!$this->Visible) {
      $Tpl->SetVar($this->Name . "_Name", $ControlName);
      $Tpl->SetVar($this->Name, "");
      if($Tpl->BlockExists($this->BlockName))
        $Tpl->setblockvar($this->BlockName, "");
      return;
    }

    $this->Attributes->Show();

    $Tpl->SetVar($this->Name . "_Name", $ControlName);
    switch($this->ControlType)
    {
      case ccsLabel:
        $value=$this->GetText();
        if (!$this->HTML) {
          $value = CCToHTML($value);
          $value = str_replace("\n", "<BR>", $value);
        }
        $Tpl->SetVar($this->Name, $value);
        $Tpl->ParseSafe($this->BlockName, false);
        break;
      case ccsReportLabel:
        $value=$this->GetText();
        if (strlen($this->EmptyText) && !strlen($value))
          $value = $this->EmptyText;
        if (!$this->HTML) {
          $value = CCToHTML($value);
          $value = str_replace("\n", "<BR>", $value);
        }
        $Tpl->SetVar($this->Name, $value);
        $Tpl->ParseSafe($this->BlockName, false);
        break;
      case ccsTextBox:
      case ccsTextArea:
      case ccsImage:
      case ccsHidden:
        $Tpl->SetVar($this->Name, CCToHTML($this->GetText()));
        $Tpl->ParseSafe($this->BlockName, false);
        break;
      case ccsLink:
        if ($this->HTML)
          $Tpl->SetVar($this->Name, $this->GetText());
        else {
          $value = CCToHTML($this->GetText());
          $value = str_replace("\n", "<BR>", $value);
          $Tpl->SetVar($this->Name, $value);
        }
        $Tpl->SetVar($this->Name . "_Src", $this->GetLink());
        $Tpl->ParseSafe($this->BlockName, false);
        break;
      case ccsImageLink:
        $Tpl->SetVar($this->Name . "_Src", CCToHTML($this->GetText()));
        $Tpl->SetVar($this->Name, $this->GetLink());
        $Tpl->ParseSafe($this->BlockName, false);
        break;
      case ccsCheckBox:
        if($this->Value)
          $Tpl->SetVar($this->Name, "CHECKED");
        else
          $Tpl->SetVar($this->Name, "");
        $Tpl->ParseSafe($this->BlockName, false);
        break;
      case ccsRadioButton:
        $BlockToParse = "RadioButton " . $this->Name;
        $Tpl->SetBlockVar($BlockToParse, "");
        if(is_array($this->Values))
        {
          for($i = 0; $i < sizeof($this->Values); $i++)
          {
            $Value = $this->Values[$i][0];
            $Text = $this->HTML ? $this->Values[$i][1] : CCToHTML($this->Values[$i][1]);
            $Selected = (CCCompareValues($Value,$this->Value, $this->DataType, $this->Format) == 0) ? " CHECKED" : "";
            $TextValue = CCToHTML(CCFormatValue($Value, $this->Format, $this->DataType, $this->Format));
            $Tpl->SetVar("Value", $TextValue);
            $Tpl->SetVar("Check", $Selected);
            $Tpl->SetVar("Description", $Text);
            $Tpl->Parse($BlockToParse, true);
          }
        }
        break;
      case ccsCheckBoxList:
        $BlockToParse = "CheckBoxList " . $this->Name;
        $Tpl->SetBlockVar($BlockToParse, "");
        if(is_array($this->Values))
        {
          for($i = 0; $i < sizeof($this->Values); $i++)
          {
            $Value = $this->Values[$i][0];
            $TextValue = CCToHTML(CCFormatValue($Value, $this->Format, $this->DataType));
            $Text = $this->HTML ? $this->Values[$i][1] : CCToHTML($this->Values[$i][1]);
	    if ($this->Multiple && is_array($this->Value)) {
              $Selected = "";
              foreach ($this->Value as $Val) {
                if (CCCompareValues($Value,$Val, $this->DataType, $this->Format) == 0) {
                  $Selected = " CHECKED";
                  break;  
                }
              }
	    } else {
              $Selected = (CCCompareValues($Value,$this->Value, $this->DataType, $this->Format) == 0) ? " CHECKED" : "";
            }
            $Tpl->SetVar("Value", $TextValue);
            $Tpl->SetVar("Check", $Selected);
            $Tpl->SetVar("Description", $Text);
            $Tpl->Parse($BlockToParse, true);
          }
        }
        break;
      case ccsListBox:
        $Options = "";
        if(is_array($this->Values))
        {
          for($i = 0; $i < sizeof($this->Values); $i++)
          {
            $Value = $this->Values[$i][0];
            $TextValue = CCToHTML(CCFormatValue($Value, $this->Format, $this->DataType));
            $Text = CCToHTML($this->Values[$i][1]);
	    if ($this->Multiple && is_array($this->Value)) {
              $Selected = "";
              foreach ($this->Value as $Val) {
                if (CCCompareValues($Value,$Val, $this->DataType, $this->Format) == 0) {
                  $Selected = " SELECTED";
                  break;  
                }
              }
	    } else {
              $Selected = (CCCompareValues($Value,$this->Value, $this->DataType, $this->Format) == 0) ? " SELECTED" : "";
            }
            $Options .= "<OPTION VALUE=\"" . $TextValue . "\"" . $Selected . ">" . $Text . "</OPTION>\n";
          }
        }
        $Tpl->SetVar($this->Name . "_Options", $Options);
        $Tpl->ParseSafe($this->BlockName, false);
        break;
      case ccsPageBreak:
          $Tpl->SetVar($this->Name, $this->Text);

    }
  }

  function SetValue($Value)
  {
    if($this->ControlType == ccsCheckBox) {
      $this->Value = CCCompareValues($Value, $this->CheckedValue, $this->DataType) == 0 || (CCCompareValues($Value, $this->UncheckedValue, $this->DataType) != 0 && (is_array($Value) || strlen($Value))) ? true : false;
      $this->IsNull = false;
    } else {
      $this->Value = $Value;
      $this->IsNull = is_null($Value);
    }
    $this->Text = $this->GetFormattedValue();
    if (!$this->isInternal) 
      $this->initialValue = $this->Value;
  }

  function SetText($Text, $RowNumber = "")
  {
    $ControlName = ($RowNumber === "") ? $this->Name : $this->Name . "_" . $RowNumber;
    if(CCCheckValue($Text, $this->DataType)) {
      $this->SetValue($Text);
    } else {
      if($this->ControlType == ccsCheckBox) {
        $RequestParameter = CCGetParam($ControlName);
        if (strlen($Text) && strlen($RequestParameter) && $Text == $RequestParameter) {
          $this->Value = true;
	  $this->IsNull = false;
        } else {
          $Value = $this->GetParsedValue($Text);
          $this->SetValue($Value);
        }
      } else {
	$this->Text = is_null($Text) ? "" : $Text;
        $this->Value = $this->GetParsedValue($this->Text);
        if (is_null($Text)) {
          $this->Value = "";
          $this->IsNull = true;
        } else {
          $this->IsNull = false;
        }
        if (!$this->isInternal) 
          $this->initialValue = $this->Value;
      }
    }
  }

  function GetValue($returnNull = false)
  {
    if($this->ControlType == ccsCheckBox)
      $value = ($this->Value) ? $this->CheckedValue : $this->UncheckedValue;
    else if($this->Multiple && is_array($this->Value))
      $value = $this->Value[0];
    else
      $value = $returnNull && $this->IsNull ? NULL : $this->Value;

    return $value;
  }

  function GetText()
  {
    if(!strlen($this->Text))
      $this->Text = $this->GetFormattedValue();
    return $this->Text;
  }

  function GetLink()
  {
    if(CCSubStr($this->Page, 0, 2) == "./")
      return CCSubStr($this->Page, 2);
    if($this->Parameters == "")
      return $this->Page;
    else
      return $this->Page . "?" . $this->Parameters;
  }

  function SetLink($Link)
  {
    if(!strlen($Link))
    {
      $this->Page = "";
      $this->Parameters = "";
    }
    else
    {
      $LinkParts = explode("?", $Link);
      $this->Page = $LinkParts[0];
      $this->Parameters = (sizeof($LinkParts) == 2) ? $LinkParts[1] : "";
    }
  }

  function GetTotalValue($mode) 
  {
    if ($mode == "GetPrevValue") {
      if ($this->TotalFunction == "Count")
        $this->prevValue += 0;
      $this->Value = $this->prevValue;
      return $this->Value;      
    }
    if ($mode == "GetNextValue" && $this->TotalFunction) {
      if ($this->TotalFunction == "Count")
        $this->prevValue += 0;
      $this->Value = $this->prevValue;
      return $this->Value;      
    }

    $this->Value = $this->initialValue;

    $newVal = $this->prevValue;
    switch ($this->TotalFunction) {
      case "Sum":
        if (strval($this->Value) == "" && strval($this->prevValue) == "")
          break;
        $newVal = $this->Value + $this->prevValue;
        if ($this->IsPercent && (strval($this->Value) != "" || strval($this->prevValueRelative) != ""))
          $this->ValueRelative = $this->Value + $this->prevValueRelative;
        break;
      case "Count":
        $newVal = $this->prevValue + ($this->IsEmptySource || ($this->DataType == ccsBoolean && is_bool($this->Value)) || ($this->DataType == ccsDate  && CCValidateDate($this->Value)) || strval($this->Value) != "" ? 1 : 0);
        if ($this->IsPercent)
          $this->ValueRelative = $this->prevValueRelative + ($this->IsEmptySource || ($this->DataType == ccsBoolean && is_bool($this->Value)) || ($this->DataType == ccsDate  && CCValidateDate($this->Value)) || strval($this->Value) != "" ? 1 : 0);
        break;
      case "Min":
        if (strval($this->Value) == "") 
          break;
        $newVal = strval($this->prevValue) == "" ? $this->Value : min($this->Value,$this->prevValue);
        if ($this->IsPercent)
          $this->ValueRelative = strval($this->prevValueRelative) == "" ? $this->Value : min($this->Value,$this->prevValueRelative);
        break;
      case "Max":
        if (strval($this->Value) == "") 
          break;
        $newVal = strval($this->prevValue) == "" ? $this->Value : max($this->Value,$this->prevValue);
        if ($this->IsPercent)
          $this->ValueRelative = strval($this->prevValueRelative) == "" ? $this->Value : max($this->Value,$this->prevValueRelative);
        break;
      case "Avg":
        if (strval($this->Value) != "") { 
          $this->CountValue = $this->prevCountValue + 1;
          $this->SumValue = $this->prevSumValue + $this->Value;
        }
        if ($this->CountValue == 0) 
          $newVal = $this->prevValue;
        else
          $newVal = $this->SumValue / $this->CountValue;
        if ($this->IsPercent) { 
          if (strval($this->Value) !="") { 
            $this->CountValueRelative = $this->prevCountValueRelative + 1;
            $this->SumValueRelative = $this->prevSumValueRelative + $this->Value;
          }
          if ($this->CountValueRelative == 0)
            $this->ValueRelative = $this->prevValueRelative;
          else
            $this->ValueRelative = $this->SumValueRelative / $this->CountValueRelative;
        }
        break;
      default: 
        if ($mode == "" && $this->IsPercent && (strval($this->Value) != "" || strval($this->prevValueRelative) != "")) {
          $this->ValueRelative = $this->Value + $this->prevValueRelative;
        }
        $newVal = $this->Value;
    }
    $this->Value = $newVal;
    if ($mode == "GetNextValue") {
      return $this->Value;
    }
    $this->prevValueRelative = $this->ValueRelative;
    $this->prevValue = $newVal;
    $this->prevCountValue = $this->CountValue;
    $this->prevSumValue = $this->SumValue;
    $this->prevCountValueRelative = $this->CountValueRelative;
    $this->prevSumValueRelative = $this->SumValueRelative;
    return $this->Value;
  }

  function Reset() 
  {
    $this->Value = "";
    $this->CountValue = "";
    $this->SumValue = "";
    $this->prevValue = "";
    $this->prevCountValue = "";
    $this->prevSumValue = "";
  }

  function ResetRelativeValues() 
  {
    $this->ValueRelative = $this->initialValue;
    $this->prevValueRelative = "";
    $this->CountValueRelative = "";
    $this->SumValueRelative = "";
    $this->prevCountValueRelative = "";
    $this->prevSumValueRelative = "";
  }


}

//End clsControl Class

//clsField Class @0-AF50E684
class clsField
{
  var $DataType;
  var $DBFormat;
  var $Name;
  var $Errors;

  var $Value = "";
  var $IsNull = true;
  var $DBValue = "";

  function clsField($Name, $DataType, $DBFormat)
  {
    $this->Name = $Name;
    $this->DataType = $DataType;
    $this->DBFormat = $DBFormat;

    $this->Errors = new clsErrors;
  }

  function GetParsedValue()
  {
    global $CCSLocales;
    $varResult = "";

    if (strlen($this->DBValue))
    {
      switch ($this->DataType)
      {
        case ccsDate:
          $DateValidation = true;
          if (CCValidateDateMask($this->DBValue, $this->DBFormat)) {
            $varResult = CCParseDate($this->DBValue, $this->DBFormat);
            if(!$varResult || !CCValidateDate($varResult)) {
              $DateValidation = false;
              $varResult = "";
            }
          } else {
            $DateValidation = false;
          }
          if (!$DateValidation)
          {
            if (is_array($this->DBFormat)) {
              $FormatString = join("", $this->DBFormat);
            } else {
              $FormatString = $this->DBFormat;
            }
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectFieldFormat', array($this->Name, $FormatString)));
          }
          break;
        case ccsBoolean:
          if (CCValidateBoolean($this->DBValue, $this->DBFormat)) {
            $varResult = CCParseBoolean($this->DBValue, $this->DBFormat);
          } else {
            if (is_array($this->DBFormat)) {
              $FormatString = CCGetBooleanFormat($this->DBFormat);
            } else {
              $FormatString = $this->DBFormat;
            }
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectFieldFormat', array($this->Name, $FormatString)));
          }
          break;
        case ccsInteger:
          if (CCValidateNumber($this->DBValue, $this->DBFormat, true))
            $varResult = CCParseInteger($this->DBValue, $this->DBFormat, true);
          else 
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectFieldFormat', array($this->Name, $this->DBFormat)));
          break;
        case ccsFloat:
          if (CCValidateNumber($this->DBValue, $this->DBFormat, true) )
            $varResult = CCParseFloat($this->DBValue, $this->DBFormat, true);
          else 
            $this->Errors->addError($CCSLocales->GetText('CCS_IncorrectFieldFormat', array($this->Name, $this->DBFormat)));
          break;
        case ccsText:
        case ccsMemo:
          $varResult = strval($this->DBValue);
          break;
      }
    }

    return $varResult;
  }

  function GetFormattedValue()
  {
    $strResult = "";
    switch($this->DataType)
    {
      case ccsDate:
        $strResult = CCFormatDate($this->Value, $this->DBFormat);
        break;
      case ccsBoolean:
        $strResult = CCFormatBoolean($this->Value, $this->DBFormat);
        break;
      case ccsInteger:
      case ccsFloat:
      case ccsSingle:
        $strResult = CCFormatNumber($this->Value, $this->DBFormat, $this->DataType, true);
        break;
      case ccsText:
      case ccsMemo:
        $strResult = strval($this->Value);
        break;
    }
    return $strResult;
  }

  function SetDBValue($DBValue)
  {
    $this->DBValue = $DBValue;
    $this->Value = $this->GetParsedValue();
  }

  function SetValue($Value)
  {
    if (is_null($Value)) {
      $this->Value = "";
      $this->IsNull = true;
    } else {
      $this->Value = $Value;
      $this->IsNull = false;
    }
    $this->DBValue = $this->GetFormattedValue();
  }

  function GetValue($returnNull = false)
  {
    return $returnNull && $this->IsNull ? NULL : $this->Value;
  }

  function GetDBValue($returnNull = false)
  {
    return $returnNull && $this->IsNull ? NULL : $this->DBValue;
  }
}

//End clsField Class

//clsButton Class @0-4DEF3EA5
class clsButton
{
  var $ComponentType = "Button";
  var $Name;
  var $Visible;
  var $Pressed;

  var $CCSEvents = "";
  var $CCSEventResult;

  var $Parent;

  var $Attributes;

  function clsButton($Name, $Method, & $Parent)
  {
    $this->Name    = $Name;
    $this->Visible = true;
    $this->Parent  = & $Parent;
    $this->Pressed = CCGetRequestParam($Name, $Method) != "" || CCGetRequestParam($Name . "_x", $Method) != "";
    $this->Attributes = new clsAttributes($this->Name . ":");
  }

  function Show($RowNumber = "")
  {
    global $Tpl;
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
    if($this->Visible)
    {
      $this->Attributes->Show();
      $ControlName = ($RowNumber === "") ? $this->Name : $this->Name . "_" . $RowNumber;
      $Tpl->SetVar("Button_Name", $ControlName);
      $Tpl->Parse("Button " . $this->Name, false);
    }
    else
    {
      $Tpl->setblockvar("Button " . $this->Name, "");
    }
  }

}

//End clsButton Class

//clsPanel Class @0-C21BDAF1
class clsPanel
{
  var $ComponentType = "Panel";
  var $Name;
  var $Visible;
  var $Components = array();
  var $ComponentsArray = array();

  var $CCSEvents = "";
  var $CCSEventResult;


  function clsPanel($Name, & $Parent)
  {
    $this->Name = $Name;
    $this->Visible = true;
    $this->Parent = & $Parent;
  }
  
  function AddComponent($Name, &$Component){
    $this->Components[$Name] = & $Component;
    $this->ComponentsArray[] = & $Component;
  }

  function Show($RowNumber = "")
  {
    global $Tpl;
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
    if($this->Visible)
    {
      $ControlName = $this->Name;
      $ParentPath = $Tpl->block_path;
      $PanelPath = $ParentPath . "/Panel " . $ControlName;
      $Tpl->block_path =  $PanelPath;
      foreach($this->ComponentsArray as $num => $Component){
        if(strlen($RowNumber)) 
          $this->ComponentsArray[$num]->Show($RowNumber);
        else      
          $this->ComponentsArray[$num]->Show();
      }
      $Tpl->block_path = $ParentPath;
      $Tpl->Parse("Panel " . $this->Name, false);
    }
    else
    {
      $Tpl->setblockvar("Panel " . $this->Name, "");
    }
  }

}

//End clsPanel Class

//clsFileUpload Class @0-24B628B6
class clsFileUpload
{
  var $ComponentType = "FileUpload";
  var $Name;
  var $Caption;
  var $Visible;
  var $Required;

  var $TemporaryFolder;
  var $FileFolder;
  var $AllowedMask; // @deprecated , use AllowedFileMasks property
  var $AllowedFileMasks;
  var $DisallowedFileMasks;
  var $FileSizeLimit;
  var $Value;
  var $Text;
  var $State;

  var $CCSEvents = "";
  var $CCSEventResult;

  var $Parent;

  var $Attributes;

  function clsFileUpload($Name, $Caption, $TemporaryFolder, $FileFolder, $AllowedFileMasks, $DisallowedFileMasks, $FileSizeLimit, & $Parent)
  {
    global $CCSLocales;

    $this->Errors = new clsErrors;

    $this->Name            = $Name;
    $this->Visible         = true;
    $this->Caption         = $Caption;
    $this->Parent          = & $Parent;
    if(CCSubStr($TemporaryFolder, 0, 1) == "%") {
      $TemporaryFolder = CCSubStr($TemporaryFolder, 1);
      $TemporaryFolder = isset($_ENV[$TemporaryFolder]) ? $_ENV[$TemporaryFolder] : "";
    }
    $this->TemporaryFolder = $TemporaryFolder;
    if(CCSubStr($FileFolder, 0, 1) == "%") {
      $FileFolder = CCSubStr($FileFolder, 1);
      $FileFolder = isset($_ENV[$FileFolder]) ? $_ENV[$FileFolder] : "";
    }
    $this->FileFolder          = $FileFolder;
    $this->AllowedFileMasks    = $AllowedFileMasks;
    $this->AllowedMask         = & $this->AllowedFileMasks; 
    $this->DisallowedFileMasks = $DisallowedFileMasks;
    $this->FileSizeLimit       = $FileSizeLimit;
    $this->Value               = "";
    $this->Text                = "";
    $this->Required            = false;

    $FileName = "";
    $FieldName = $this->Caption;
    if( !is_dir($TemporaryFolder) ) {
      $this->Errors->addError($CCSLocales->GetText('CCS_TempFolderNotFound', $this->Caption));
    } else if( !is_writable($TemporaryFolder) ) {
      $this->Errors->addError($CCSLocales->GetText('CCS_TempInsufficientPermissions', $this->Caption));
    } else if( !is_dir($FileFolder) ) {
      $this->Errors->addError($CCSLocales->GetText('CCS_FilesFolderNotFound', $this->Caption));
    } else if( !is_writable($FileFolder) ) {
      $this->Errors->addError($CCSLocales->GetText('CCS_InsufficientPermissions', $this->Caption));
    } 
    $this->Attributes = new clsAttributes($this->Name . ":");

  }

  function Validate()
  {
    global $CCSLocales;
    $validation = true;
    if($this->Required && $this->Value === "" && $this->Errors->Count() == 0)
    {
      $FieldName = $this->Caption;
      $this->Errors->addError($CCSLocales->GetText('CCS_RequiredFieldUpload', $this->Caption));
    }
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
    return ($this->Errors->Count() == 0);
  }


  function Upload($RowNumber = "")
  {
    global $CCSLocales;
    global $TemplateEncoding;
    global $FileEncoding;
     

    $FieldName = $this->Caption;
    if(strlen($RowNumber)) {
      $ControlName = $this->Name . "_" . $RowNumber;
      $FileControl = $this->Name . "_File_" . $RowNumber;
      $DeleteControl = $this->Name . "_Delete_" . $RowNumber;
    } else {
      $ControlName = $this->Name;
      $FileControl = $this->Name . "_File";
      $DeleteControl = $this->Name . "_Delete";
    }

    $SessionName = CCGetParam($ControlName);
    $this->State = CCGetSession($SessionName, array(null, null));

    if (strlen(CCGetParam($DeleteControl))) { 
      // delete file from folder
      $ActualFileName = $this->State[0];
      if( file_exists($this->FileFolder . $ActualFileName) ) {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDeleteFile", $this);
        unlink($this->FileFolder . $ActualFileName);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDeleteFile", $this);
      } else if ( file_exists($this->TemporaryFolder . $ActualFileName) ) {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDeleteFile", $this);
        unlink($this->TemporaryFolder . $ActualFileName);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDeleteFile", $this);
      }
      $this->Value = ""; $this->Text = "";
      $this->State[0] = "";
    } else if (isset ($_FILES[$FileControl]) 
        && $_FILES[$FileControl]["tmp_name"] != "none" 
        && strlen ($_FILES[$FileControl]["tmp_name"])) {
      $this->Value = ""; $this->Text = "";
      $FileName = CCConvertEncoding(CCStrip($_FILES[$FileControl]["name"]), $TemplateEncoding, $FileEncoding);
      $GoodFileMask = 1;
      $meta_characters = array("*" => ".+", "?" => ".", "\\" => "\\\\", "^" => "\\^", "\$" => "\\\$", "." => "\\.", "[" => "\\[", "]" => "\\]", "|" => "\\|", "(" => "\\(", ")" => "\\)", "{" => "\\{", "}" => "\\}", "+" => "\\+", "-" => "\\-");
      if ($this->AllowedFileMasks != "") {
        $GoodFileMask = 0;
        $FileMasks=explode(';', $this->AllowedFileMasks);
        foreach ($FileMasks as $FileMask) {
          $FileMask = preg_replace("/(\\*|\\?|\\\\|\\^|\\\$|\\.|\\[|\\]|\\||\\(|\\)|\\{|\\}|\\+|\\-)/ei", "\$meta_characters['\\1']", $FileMask);
          if (preg_match("/^$FileMask$/i", $FileName)) {
            $GoodFileMask = 1;
            break;
          }
        }
      }


      if ($GoodFileMask && $this->DisallowedFileMasks != "") {
        $FileMasks=explode(';', $this->DisallowedFileMasks);
        foreach ($FileMasks as $FileMask) {
          $FileMask = preg_replace("/(\\*|\\?|\\\\|\\^|\\\$|\\.|\\[|\\]|\\||\\(|\\)|\\{|\\}|\\+|\\-)/ei", "\$meta_characters['\\1']", $FileMask);
          if (preg_match("/^$FileMask$/i", $FileName)) {
            $GoodFileMask = 0;
            break;
          }
        }
      }
      if($_FILES[$FileControl]["size"] > $this->FileSizeLimit) {
      $this->Errors->addError($CCSLocales->GetText('CCS_LargeFile', $this->Caption));
      } else if (!$GoodFileMask) {
      $this->Errors->addError($CCSLocales->GetText('CCS_WrongType', $this->Caption));
      } else {
        // move uploaded file to temporary folder
        $file_exists = true;
        $index = 0;
        while($file_exists) {
          $ActualFileName = date("YmdHis") . $index . "." . $FileName;
          $file_exists = file_exists($ActualFileName);
          $index++;
        }
        if( move_uploaded_file($_FILES[$FileControl]["tmp_name"], $this->TemporaryFolder . $ActualFileName) ) {
          $this->Value = $ActualFileName;
          $this->Text = $ActualFileName;
          if(isset($this->State[0]) && strlen($this->State[0])) {
            if(file_exists($this->TemporaryFolder . $this->State[0])) {
              $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDeleteFile", $this);
              unlink($this->TemporaryFolder . $this->State[0]);
              $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDeleteFile", $this);
              $this->State[0] = $ActualFileName;
            } else {
              if(!is_dir($this->TemporaryFolder . $this->State[1]) && file_exists($this->TemporaryFolder . $this->State[1])) {
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDeleteFile", $this);
                unlink($this->TemporaryFolder . $this->State[1]);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDeleteFile", $this);
              }
              $this->State[1] = $ActualFileName;
            }
          } else {
            $this->State[0] = $ActualFileName;
          }
        } else {
          $this->Errors->addError($CCSLocales->GetText('CCS_TempInsufficientPermissions', $this->Caption));
        }
      }
    } else {
      $this->SetValue(strlen($this->State[1]) ? $this->State[1] : $this->State[0]);
    }
  }

  function Move()
  {
    global $CCSLocales;
    if (strlen($this->Value) && !file_exists($this->FileFolder . $this->Value)) {
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeProcessFile", $this);
      $FileName = $this->GetFileName();
      $FieldName = $this->Caption;
      if (!file_exists($this->TemporaryFolder . $this->Value)) {
        $this->Errors->addError($CCSLocales->GetText('CCS_FileNotFound', array($this->TemporaryFolder . $this->Value, $this->Caption)));
      } else if (!@copy($this->TemporaryFolder . $this->Value, $this->FileFolder . $this->Value)) {
        $this->Errors->addError($CCSLocales->GetText('CCS_InsufficientPermissions', $this->Caption));
      } else if (strlen($this->State[1])) {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDeleteFile", $this);
        unlink($this->FileFolder . $this->State[0]);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDeleteFile", $this);
      }
      if($this->Errors->Count() == 0 && file_exists($this->TemporaryFolder . $this->Value)) {
        unlink($this->TemporaryFolder . $this->Value);
      }
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterProcessFile", $this);
    }
  }

  function Delete()
  {
    if( !is_dir($this->FileFolder . $this->State[0]) && file_exists($this->FileFolder . $this->State[0]) ) {
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDeleteFile", $this);
      unlink($this->FileFolder . $this->State[0]);
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDeleteFile", $this);
    } else if ( !is_dir($this->TemporaryFolder . $this->State[0]) && file_exists($this->TemporaryFolder . $this->State[0]) ) {
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDeleteFile", $this);
      unlink($this->TemporaryFolder . $this->State[0]);
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDeleteFile", $this);
    }
    if( !is_dir($this->FileFolder . $this->State[1]) && file_exists($this->FileFolder . $this->State[1]) ) {
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDeleteFile", $this);
      unlink($this->FileFolder . $this->State[1]);
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDeleteFile", $this);
    } else if ( !is_dir($this->TemporaryFolder . $this->State[1]) && file_exists($this->TemporaryFolder . $this->State[1]) ) {
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDeleteFile", $this);
      unlink($this->TemporaryFolder . $this->State[1]);
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDeleteFile", $this);
    }
  }

  function Show($RowNumber = "")
  {
    global $Tpl;
    if($this->Visible)
    {
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);

      if(!$this->Visible) {
        $Tpl->setblockvar("FileUpload " . $this->Name, "");
        return;
      }

      $this->Attributes->Show();

      if(strlen($RowNumber)) {
        $ControlName = $this->Name . "_" . $RowNumber;
        $FileControl = $this->Name . "_File_" . $RowNumber;
        $DeleteControl = $this->Name . "_Delete_" . $RowNumber;
      } else {
        $ControlName = $this->Name;
        $FileControl = $this->Name . "_File";
        $DeleteControl = $this->Name . "_Delete";
      }

      $SessionName = CCGetParam($ControlName);
      if(!strlen($SessionName)) {
        $random_value = mt_rand(100000,9999999) . mt_rand(100000,9999999);
        $SessionName = "FileUpload" . $random_value . date("dHis");
        $this->State = array($this->Value, "");
      } 

      CCSetSession($SessionName, $this->State);

      $Tpl->SetVar("State", $SessionName);
      $Tpl->SetVar("ControlName", $ControlName);
      $Tpl->SetVar("FileControl", $FileControl);
      $Tpl->SetVar("DeleteControl", $DeleteControl);
      if (strlen($this->Value) ) {
        $Tpl->SetVar("ActualFileName", $this->Value);
        $Tpl->SetVar("FileName", $this->GetFileName());
        $Tpl->SetVar("FileSize", $this->GetFileSize());
        $Tpl->parse("FileUpload " . $this->Name . "/Info", false);
        if($this->Required) {
          $Tpl->parse("FileUpload " . $this->Name . "/Upload", false);
          $Tpl->setblockvar("FileUpload " . $this->Name . "/DeleteControl", "");
        } else {
          $Tpl->setblockvar("FileUpload " . $this->Name . "/Upload", "");
          $Tpl->parse("FileUpload " . $this->Name . "/DeleteControl", false);
        }
      } else {
        $Tpl->parse("FileUpload " . $this->Name . "/Upload", false);
        $Tpl->setblockvar("FileUpload " . $this->Name . "/Info", "");
        $Tpl->setblockvar("FileUpload " . $this->Name . "/DeleteControl", "");
      }

      $Tpl->Parse("FileUpload " . $this->Name, false);
    }
    else
    {
      $Tpl->setblockvar("FileUpload " . $this->Name, "");
    }
  }

  function SetValue($Value) {
    global $CCSLocales;
    $this->Text = $Value;
    $this->Value = $Value;
    $this->State[0] = $Value;
    if(strlen($Value) 
      && !file_exists($this->TemporaryFolder . $Value) 
      && !file_exists($this->FileFolder . $Value)) {
        $FileName = $this->GetFileName();
        $FieldName = $this->Caption;
	$this->Errors->addError($CCSLocales->GetText('CCS_FileNotFound', array($Value, $this->Caption)));
    }
  }

  function SetText($Text) {
    $this->SetValue($Text);
  }

  function GetValue() {
    return $this->Value;
  }

  function GetText() {
    return $this->Text;
  }

  function GetFileName() {
    return CCGetOriginalFileName($this->Value);
  }

  function GetFileSize() {
    $filesize = 0;
    if( file_exists($this->FileFolder . $this->Value) ) {
      $filesize = filesize($this->FileFolder . $this->Value);
    } else if ( file_exists($this->TemporaryFolder . $this->Value) ) {
      $filesize = filesize($this->TemporaryFolder . $this->Value);
    }
    return $filesize;
  }

}

//End clsFileUpload Class

//clsDatePicker Class @0-A7253533
class clsDatePicker
{
  var $ComponentType = "DatePicker";
  var $Name;
  var $DateFormat;
  var $Style;
  var $FormName;
  var $ControlName;
  var $Visible;
  var $Errors;

  var $Attributes;

  var $CCSEvents = "";
  var $CCSEventResult;

  var $Parent;

  function clsDatePicker($Name, $FormName, $ControlName, & $Parent)
  {
    $this->Name        = $Name;
    $this->FormName    = $FormName;
    $this->ControlName = $ControlName;
    $this->Parent      = & $Parent;
    $this->Visible     = true;

    $this->Errors = new clsErrors;
    $this->Attributes = new clsAttributes($this->Name . ":");
  }

  function Show($RowNumber = "")
  {
    global $Tpl;
    if($this->Visible)
    {
      $this->Attributes->Show();
      $ControlName = ($RowNumber === "") ? $this->ControlName : $this->ControlName . "_" . $RowNumber;
      $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
      $Tpl->SetVar("Name",        $this->FormName . "_" . $this->Name);
      $Tpl->SetVar("FormName",    $this->FormName);
      $Tpl->SetVar("DateControl", $ControlName);

      $Tpl->Parse("DatePicker " . $this->Name, false);
    }
    else
    {
      $Tpl->setblockvar("DatePicker " . $this->Name, "");
    }
  }

}

//End clsDatePicker Class

//clsErrors Class @0-29B52C31
class clsErrors
{
  var $Errors;
  var $ErrorsCount;
  var $ErrorDelimiter;

  function clsErrors()
  {
    $this->Errors = array();
    $this->ErrorsCount = 0;
    $this->ErrorDelimiter = "<br>";
  }

  function addError($Description)
  {
    if (strlen($Description))
    {
      $this->Errors[$this->ErrorsCount] = $Description; 
      $this->ErrorsCount++;
    }
  }

  function AddErrors($Errors)
  {
    for($i = 0; $i < $Errors->Count(); $i++)
      $this->addError($Errors->Errors[$i]);
  }

  function Clear()
  {
    $this->Errors = array();
    $this->ErrorsCount = 0;
  }

  function Count()
  {
    return $this->ErrorsCount;
  }

  function ToString()
  {

    if(sizeof($this->Errors) > 0)
      return join($this->ErrorDelimiter, $this->Errors);
    else
      return "";
  }

}
//End clsErrors Class

//clsSection Class @0-E5D77A50
class clsSection
{
  var $ComponentType = "Section";
  var $Visible = true;
  var $Height = 0;
  var $CCSEvents = array();
  var $CCSEventResult;
  var $Parent;
  var $Attributes;
  function clsSection(& $Parent) {
    $this->Parent = & $Parent;
  }

}
//End clsSection Class

//clsLocaleInfo @0-3560C5D0
class clsLocaleInfo {
  var $FormatInfo;
  var $Name;
  var $Language;
  var $Country;
  var $BooleanFormat;
  var $DecimalDigits;
  var $DecimalSeparator;
  var $GroupSeparator;
  var $MonthNames;
  var $MonthShortNames;
  var $WeekdayNames;
  var $WeekdayShortNames;
  var $WeekdayNarrowNames;
  var $ShortDate;
  var $LongDate;
  var $ShortTime;
  var $LongTime;
  var $GeneralDate;
  var $FirstWeekDay;
  var $OverrideNumberFormats;
  var $AMDesignator;
  var $PMDesignator;
  var $Encoding;
  var $PHPEncoding;
  var $PHPLocale;

  function clsLocaleInfo($name, $LocaleInfoArray) {
    $this->Name = $name;
    $this->Language = $LocaleInfoArray[0];
    $this->Country = $LocaleInfoArray[1];

    $this->BooleanFormat = $LocaleInfoArray[2];

    $this->DecimalDigits = $LocaleInfoArray[3];
    $this->DecimalSeparator = $LocaleInfoArray[4];
    $this->GroupSeparator = $LocaleInfoArray[5];

    $this->MonthNames = $LocaleInfoArray[6];
    $this->MonthShortNames = $LocaleInfoArray[7];

    $this->WeekdayNames = $LocaleInfoArray[8];
    $this->WeekdayShortNames = $LocaleInfoArray[9];
    $this->WeekdayNarrowNames = $LocaleInfoArray[10];

    $this->ShortDate = $LocaleInfoArray[11];
    $this->LongDate = $LocaleInfoArray[12];

    $this->ShortTime = $LocaleInfoArray[13];
    $this->LongTime = $LocaleInfoArray[14];
    $this->AMDesignator = $LocaleInfoArray[15];
    $this->PMDesignator = $LocaleInfoArray[16];

    $this->GeneralDate = array();
    foreach ($this->ShortDate as $val) {
     array_push($this->GeneralDate, $val);
    }
     array_push($this->GeneralDate, " ");
    foreach ($this->LongTime as $val) {
     array_push($this->GeneralDate, $val);
    }
    $this->FirstWeekDay = $LocaleInfoArray[17];
    $this->OverrideNumberFormats = $LocaleInfoArray[18];
    $this->PHPLocale = $LocaleInfoArray[19];
    $this->Encoding = $LocaleInfoArray[20];
    $this->PHPEncoding = $LocaleInfoArray[21];
  }

  function GetInfo($name) {
    return $this->$name;
  }
  
  function GetCCSFormatInfo() {
    if (!$this->FormatInfo)
      $this->FormatInfo = join("|" , Array($this->Name, $this->Language, $this->Country,  join(";", $this->BooleanFormat),
        $this->DecimalDigits, $this->DecimalSeparator, $this->GroupSeparator,
        join(";", $this->MonthNames) ,  join(";", $this->MonthShortNames),
        join(";", $this->WeekdayNames), join(";", $this->WeekdayShortNames),
        join("", $this->ShortDate), join("", $this->LongDate),
        join("", $this->ShortTime), join("", $this->LongTime),       
        $this->FirstWeekDay, $this->AMDesignator, $this->PMDesignator));
    return $this->FormatInfo;
  }
}

//End clsLocaleInfo

//clsLocale Class @0-19417A99
class clsLocale {
  var $Name;
  var $Dir;
  var $Ext = ".txt";
  var $ParentLocale;
  var $ParentLocaleName = "";
  var $IsLoaded = false;
  var $LocaleInfo;
  var $Messages;
  var $InternalEncoding = "ISO-8859-1";

  function clsLocale($name, $LocaleInfoArray, $dir = "") {
    $this->Name = $name;
    $this->Dir = $dir;
    $this->Translations = array();
    $this->LocaleInfo = new clsLocaleInfo($name, $LocaleInfoArray);
    $arr = explode("-", $name, 2);
    if (count($arr) == 2)
      $this->ParentLocaleName = $arr[0];
  }

  function LoadTranslation($filename = "") {
    $this->Messages = array();
    $this->Messages["CCS_ASC"] = "Ascendente";
    $this->Messages["CCS_Bytes"] = "bytes";
    $this->Messages["CCS_Cancel"] = "Cancelar";
    $this->Messages["CCS_Charset"] = "windows-1252";
    $this->Messages["CCS_Clear"] = "Limpiar";
    $this->Messages["CCS_CustomLinkField"] = "Detalles";
    $this->Messages["CCS_CustomOperationError_MissingParameters"] = "One or more parameters missing to perform the Update/Delete. The application is misconfigured.";
    $this->Messages["CCS_DatabaseCommandError"] = "Error en el comnado de la Base de Datos.";
    $this->Messages["CCS_DatePickerNav61"] = "El selector de fecha no es compatible con Netscape 6.1";
    $this->Messages["CCS_Delete"] = "Borrar";
    $this->Messages["CCS_DeleteConfirmation"] = "Borrar registro?";
    $this->Messages["CCS_DESC"] = "Descendente";
    $this->Messages["CCS_FileNotFound"] = "El archivo {0} especificado en {1} no se encontró.";
    $this->Messages["CCS_FilesFolderNotFound"] = "Imposible transferir el archivo del campo {0} - el folder destino no existe.";
    $this->Messages["CCS_Filter"] = "Palabra clave";
    $this->Messages["CCS_First"] = "Inicio";
    $this->Messages["CCS_FirstWeekDay"] = "Dom";
    $this->Messages["CCS_GridFormPostfix"] = "";
    $this->Messages["CCS_GridFormPrefix"] = "Lista de";
    $this->Messages["CCS_GridFormSuffix"] = "Lista de";
    $this->Messages["CCS_GridPageNumberError"] = "Invalid page number.";
    $this->Messages["CCS_GridPageSizeError"] = "(CCS06) Invalid page size.";
    $this->Messages["CCS_IncorrectEmailFormat"] = "Email no valido en el campo {0}.";
    $this->Messages["CCS_IncorrectFormat"] = "El campo {0} no es valido. Use el siguiente formato: {1}.";
    $this->Messages["CCS_IncorrectPhoneFormat"] = "El campo {0} tiene un formato invalido.";
    $this->Messages["CCS_IncorrectValue"] = "El campo {0} no es valido.";
    $this->Messages["CCS_IncorrectZipFormat"] = "El campo {0} tiene un formato invalido.";
    $this->Messages["CCS_Insert"] = "Agregar";
    $this->Messages["CCS_InsertLink"] = "Agregar Nuevo";
    $this->Messages["CCS_InsufficientPermissions"] = "Insuficientes permisos para transferir el archivo del campo {0}.";
    $this->Messages["CCS_LanguageID"] = "es";
    $this->Messages["CCS_LargeFile"] = "Es tamaño del archivo en el campo {0} es muy grande.";
    $this->Messages["CCS_Last"] = "Final";
    $this->Messages["CCS_LocaleID"] = "es";
    $this->Messages["CCS_Login"] = "Nombre de usuario";
    $this->Messages["CCS_LoginBtn"] = "Login";
    $this->Messages["CCS_LoginError"] = "Login o Password incorrecto.";
    $this->Messages["CCS_LogoutBtn"] = "Logout";
    $this->Messages["CCS_Main"] = "Inicio";
    $this->Messages["CCS_MaskValidation"] = "La validación fallo en el campo {0}.";
    $this->Messages["CCS_MaximumLength"] = "La longitud de {0} no puede ser mayor de {1} caracteres.";
    $this->Messages["CCS_MaximumValue"] = "El valor de {0} no puede ser más alto de {1}.";
    $this->Messages["CCS_MinimumLength"] = "La longitud de {0} no puede ser menor de {1} caracteres.";
    $this->Messages["CCS_MinimumValue"] = "El valor de {0} no puede menor de {1}.";
    $this->Messages["CCS_Months"] = "Enero, Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre, Diciembre";
    $this->Messages["CCS_More"] = "Más...";
    $this->Messages["CCS_Next"] = "Siguiente";
    $this->Messages["CCS_NoCategories"] = "Categorias no encontradas";
    $this->Messages["CCS_NoRecords"] = "No se encontaron registros";
    $this->Messages["CCS_Of"] = "de";
    $this->Messages["CCS_OperationError"] = "Incapaz de realizar la operación: {0}. Unos o mas parásmetros no están especificados";
    $this->Messages["CCS_Password"] = "Contraseña";
    $this->Messages["CCS_Previous"] = "Anterior";
    $this->Messages["CCS_RecordFormPostfix"] = "";
    $this->Messages["CCS_RecordFormPrefix"] = "Agregar/Editar";
    $this->Messages["CCS_RecordFormPrefix2"] = "Ver";
    $this->Messages["CCS_RecordFormSuffix"] = "Agregar/Editar";
    $this->Messages["CCS_RecPerPage"] = "Registro por página";
    $this->Messages["CCS_RememberLogin"] = "Recordar mi nombre de usuario y Contraseña";
    $this->Messages["CCS_RequiredField"] = "El campo {0} es necesario.";
    $this->Messages["CCS_RequiredFieldUpload"] = "El archivo adjunto en el campo {0} es necesario.";
    $this->Messages["CCS_Search"] = "Buscar";
    $this->Messages["CCS_SearchFormPostfix"] = "";
    $this->Messages["CCS_SearchFormPrefix"] = "Buscar";
    $this->Messages["CCS_SearchFormSuffix"] = "Buscar";
    $this->Messages["CCS_SelectField"] = "Seleccionar Campo";
    $this->Messages["CCS_SelectOrder"] = "Seleccionar Orden";
    $this->Messages["CCS_SelectValue"] = "Seleccionar Valor";
    $this->Messages["CCS_ShortMonths"] = "Ene, Feb, Mar, Abr, May, Jun, Jul, Ago, Sep, Oct, Nov, Dic";
    $this->Messages["CCS_ShortWeekdays"] = "Dom, Lun, Mar, Mie, Jue, Vie, Sab";
    $this->Messages["CCS_SortBy"] = "Ordenar por";
    $this->Messages["CCS_SortDir"] = "Forma de Orden";
    $this->Messages["CCS_SubmitConfirmation"] = "Enviar registro?";
    $this->Messages["CCS_TempFolderNotFound"] = "Insuficientes permisos para transferir el archivo del campo {0} - el folder temporal destino no existe.";
    $this->Messages["CCS_TempInsufficientPermissions"] = "Insuficientes permisos para transferir el archivo del campo {0} en el folder temporal.";
    $this->Messages["CCS_Today"] = "Hoy";
    $this->Messages["CCS_TotalRecords"] = "Total de Registros:";
    $this->Messages["CCS_UniqueValue"] = "El campo {0} ya existe.";
    $this->Messages["CCS_Update"] = "Grabar";
    $this->Messages["CCS_UploadComponentError"] = "Ocurrió un error mientras se iniciaba la transferencia del componente..";
    $this->Messages["CCS_UploadComponentNotFound"] = "{0} transfiriendo componente \"\"{1}\"\" no se encontró. Seleccione otro o instale el componente.";
    $this->Messages["CCS_UploadingError"] = "Ocurrio un error al transferir el archivo del campo {0}. Descripción del error: {1}.";
    $this->Messages["CCS_Weekdays"] = "Domingo, Lunes, Martes, Miércoles, Jueves, Viernes, Sábado";
    $this->Messages["CCS_WrongType"] = "Es tipo de archivo en el campo {0} no está permitido.";
    $this->IsLoaded = true;
  }

  function GetMessage($id) {
    global $CCSLocales;
    global $FileEncoding;
    if ($id == "CCS_LocaleID") return $this->Name;
    if ($id == "CCS_LanguageID") return $this->LocaleInfo->GetInfo("Language");
    if ($id == "CCS_FormatInfo") return $this->LocaleInfo->GetCCSFormatInfo();

    if (!$this->IsLoaded)
      $this->LoadTranslation();
    if (array_key_exists($id,  $this->Messages)) {
      return $FileEncoding != $this->InternalEncoding && $id != "CCS_FormatInfo" ? CCConvertEncoding($this->Messages[$id], $this->InternalEncoding, $FileEncoding) : $this->Messages[$id];
    } else if ($this->ParentLocale) {
      return $this->ParentLocale->GetMessage($id);
    } elseif ($this->ParentLocaleName && array_key_exists($this->ParentLocaleName, $CCSLocales->Locales)) {
      $this->ParentLocale = & $CCSLocales->Locales[$this->ParentLocaleName];
      return $this->ParentLocale->GetMessage($id);
    } elseif (strtolower($CCSLocales->DefaultLocale) != strtolower($this->Name)) {
      $DefaultLocale = $CCSLocales->Locales[$CCSLocales->DefaultLocale];
      return $DefaultLocale->GetMessage($id);  
    } else {
      return $id;
    }

  }
}

//End clsLocale Class

//clsLocales Class @0-177D4A0E
class clsLocales {
  var $Locale;
  var $DefaultLocale;
  var $Locales;
  var $Dir;

  function clsLocales($dir, $locale = "")  {
    $this->Dir = $dir;
    $this->Locale = $locale;
    $this->DefaultLocale = "";
    $this->Locales = array();
  }

  function Init() {
  }

  function AddLocale($name, $LocaleInfoArray) {
    $lname = strtolower($name);
    if (array_key_exists($lname, $this->Locales))
      return;
    $this->Locales[$lname] = new clsLocale($name, $LocaleInfoArray, $this->Dir);
  }

  function GetText($id, $params = Null, $locale = "") {
    if ($locale == "")  
      $locale = $this->Locale;
    if ($locale == "")  
      $locale = $this->DefaultLocale;
    if (!array_key_exists($locale, $this->Locales))
      return "";
    $Result = $this->Locales[$locale]->GetMessage($id);
    if ($Result != "") {
      $Result = preg_replace("/\\\\n/", "\n", $Result);
      $Result = preg_replace("/\\\\/", "\\", $Result);
      if (is_array($params)) {
        for ($i = 0; $i < count($params); $i++)
          $Result = preg_replace("/\{$i\}/", $params[$i], $Result);
      } elseif (!is_null($params)) {
          $Result = preg_replace("/\{0}/", $params, $Result);
      }
    }
    return $Result;
  }

  function GetFormatInfo($name, $locale = "") {
    if ($locale == "")  
      $locale = $this->Locale;
    if ($locale == "")  
      $locale = $this->DefaultLocale;
    return $this->Locales[$locale]->LocaleInfo->GetInfo($name);
  }

  function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
  }

  function FindLocale($locale) {
    $locale = strtolower($locale);
    if (!$this->Locale && $locale) {
      $arr = explode("-", $locale, 2);        
      $lang = $arr[0];
      $country = isset($arr[1]) ? $arr[1] : "";
      $defaultCountry = array_key_exists($lang, $this->Locales) ? strtolower($this->Locales[$lang]->LocaleInfo->GetInfo("Country")) : "";
      if (!$country && $defaultCountry && array_key_exists($lang . "-" . $defaultCountry, $this->Locales)) 
        return $lang . "-" . $defaultCountry;
      elseif ($country && !array_key_exists($locale, $this->Locales) && array_key_exists($lang . "-" . $defaultCountry, $this->Locales)) 
        return $lang . "-" . $defaultCountry;
      elseif (array_key_exists($locale, $this->Locales))
        return $locale;
      elseif (array_key_exists($lang, $this->Locales))
        return $lang;
    }
    return false;
  }

  function SetLocale($locale) {
    if (!$this->Locale && $locale) {
      $this->Locale = $this->FindLocale($locale);
      if (!$this->Locale) 
        $this->Locale = $this->DefaultLocale;
    }
  }

  function  SetLocaleFromHttpHeader($Name = "HTTP_ACCEPT_LANGUAGE") {
    if ($this->Locale)
      return false;
    $Locales = array();
    $locale = "";
    $q = "";
    if (!isset($_SERVER[$Name])) return;
    $arr = explode(",", strtolower($_SERVER[$Name]));
    foreach ($arr as $L) {
      if(preg_match("/(.+);q=(\\d+(\\.\\d+)?)/", $L, $matches)) {
        $locale = $matches[1];
        $q = doubleval($matches[2]);
      } else {
        $locale = $L;
        $q = 1;
      }
      if (!array_key_exists(strval($q), $this->Locales))
        $Locales[strval($q)] = array();
      array_push($Locales[strval($q)], $locale);
    }
    uksort($Locales, array($this, "cmp"));

    foreach ($Locales as $q) {
      foreach ($q as $locale) {
        if ($result = $this->FindLocale($locale)) {
          $this->Locale = $result;
          return;
        }
      }
    }
  }

}


//End clsLocales Class

//clsMainPage Class @0-C6182AC7
class clsMainPage
{
  var $ComponentType = "Page";
  var $Parent = false;
  var $Connections = array();
  var $Attributes = array();
}
//End clsMainPage Class

//clsAttribute class @0-DA97D467
class clsAttribute {
  var  $DataType = ccsText;
  var  $Format = "";
  var  $Name = "";
  var  $Prefix = "";

  var  $Value;
  var  $Text;

  function clsAttribute($Name, $Prefix, $DataType="", $Format = "") {
    $this->Name = $Name;
    $this->Prefix = $Prefix;
    if ($this->DataType)
      $this->DataType = $DataType;
    $this->Format = $Format;
  }

  function GetParsedValue($ParsingValue, $MaskFormat) {
    return CCParseValue($ParsingValue, $MaskFormat, $this->DataType, "", "");
  }


  function GetFormattedValue($MaskFormat) {
      return CCFormatValue($this->Value, $MaskFormat, $this->DataType);
  }  

  function Show() {
    global $Tpl;
    $Tpl->SetVar($this->Prefix . $this->Name, $this->GetText());
  }

  function SetValue($NewValue) {
    $this->Text = null;
    $this->Value = $NewValue;
  }

  function GetValue() {
    return $this->Value;
  }

  function SetText($NewText) {
    $this->Text = $NewText;
    $this->Value = $this->GetParsedValue($NewText, $this->Format);
  }

  function GetText() {
    if (is_null($this->Text))
      $this->Text = $this->GetFormattedValue($this->Format);
    return $this->Text;
  }

}
//End clsAttribute class

//clsAttributes class @0-24208EAB
class clsAttributes {
  var $Objects = array();
  var $Block = "";
  var $Accumulate = "";
  var $Prefix = "";

  function clsAttributes($Prefix) {
    $this->Prefix = $Prefix;
  }

  function Add(& $Attr) {
    $this->Objects[$Attr->Name] = & $Attr;
  }

  function AddAttribute($Name, $DataType = "", $Format = "") {
    $this->Objects[$Name] = new clsAttribute($Name, $this->Prefix, $DataType, $Format);
  }

  function GetValue($Name) {
    return array_key_exists($Name, $this->Objects) ? $this->Objects[$Name]->GetValue() : "";
  }

  function GetText($Name) {
    return array_key_exists($Name, $this->Objects) ? $this->Objects[$Name]->GetText() : "";
  }

  function SetValue($Name, $NewValue, $DataType = "", $Format = "") {
    if (!array_key_exists($Name, $this->Objects))
      $this->AddAttribute($Name, $DataType, $Format);
    $this->Objects[$Name]->SetValue($NewValue);
  }

  function SetText($Name, $NewText) {
    if (!array_key_exists($Name, $this->Objects))
      $this->AddAttribute($Name);
    $this->Objects[$Name]->SetText($NewText);
  }

  function Show() {
    foreach ($this->Objects as $Name => $Attribute) 
        $this->Objects[$Name]->Show();
  }

  function Clear() {
    $this->Objects = array();
  }

  function GetAsArray() {
    $arr = array();
    foreach ($this->Objects as $Name => $Value) {
      $arr[$Name] = array($this->Objects[$Name]->GetValue(), $this->Objects[$Name]->GetText(), $this->Objects[$Name]->DataType, $this->Objects[$Name]->Format);
    }
    $arr["."] = $this->Prefix;
    return $arr;
  }

  function RestoreFromArray($Arr) {
    $this->Objects = array();
    $this->Prefix = $Arr["."];
    $this->AddFromArray($Arr);
  }

  function AddFromArray($Arr) {
    foreach ($Arr as $Name => $Value) {
      if ($Name != ".") {
        $this->Objects[$Name] = new clsAttribute($Name, $this->Prefix, $Value[2], $Value[3]);
        $this->Objects[$Name]->Value = $Value[0];
        $this->Objects[$Name]->Text = $Value[1];
      }
    }
  }

}
//End clsAttributes class


?>
