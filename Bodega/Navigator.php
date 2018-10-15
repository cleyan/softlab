<?php

//Navigator Class @0-685013F5

define("tpSimple", 1);
define("tpCentered", 2);
define("tpMoving", 3);

class clsNavigator
{

  var $ComponentType = "Navigator";
  var $TargetName;
  var $ds;
  var $PageNumber;
  var $TotalPages;
  var $Visible;

  var $NavigatorName;
  var $FileName;
  var $NumberPages;
  var $NavigatorType;

  var $CCSEvents;
  var $CCSEventResult;
  var $Parent;
  var $Attributes;

  function clsNavigator($ComponentName, $NavigatorName, $FileName, $NumberPages, $NavigatorType, & $Parent)
  {
    $this->TargetName = $ComponentName;
    $this->NavigatorName = $NavigatorName;
    $this->FileName = $FileName;
    $this->NumberPages = $NumberPages;
    $this->NavigatorType = $NavigatorType;
    $this->Visible = true;
    $this->CCSEvents = array();
    $this->Parent = & $Parent;
    $this->Attributes = new clsAttributes($this->NavigatorName . ":");
  }

  function Show()
  {
    global $Tpl;
    $this->EventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);

    if(!$this->Visible) { return; }
    $this->Attributes->Show();
    $NavigatorBlock = "Navigator " . $this->NavigatorName;
    $FirstOnPath = $NavigatorBlock . "/First_On";
    $FirstOffPath = $NavigatorBlock . "/First_Off";
    $PrevOnPath = $NavigatorBlock . "/Prev_On";
    $PrevOffPath = $NavigatorBlock . "/Prev_Off";
    $NextOnPath = $NavigatorBlock . "/Next_On";
    $NextOffPath = $NavigatorBlock . "/Next_Off";
    $LastOnPath = $NavigatorBlock . "/Last_On";
    $LastOffPath = $NavigatorBlock . "/Last_Off";
    $PageOnPath = $NavigatorBlock . "/Pages/Page_On";
    $PageOffPath = $NavigatorBlock . "/Pages/Page_Off";
    $PagesPath = $NavigatorBlock . "/Pages";

    if($this->PageNumber < 1) $this->PageNumber = 1;
    $LastPage = $this->TotalPages;
    if($LastPage == 0) $LastPage = 1;
    $QueryString = CCGetQueryString("QueryString", array($this->TargetName . "Page", "ccsForm"));

    // Parse First and Prev blocks
    if($this->PageNumber <= 1)
    {
      if($Tpl->BlockExists($FirstOffPath)) $Tpl->Parse($FirstOffPath, false);
      if($Tpl->BlockExists($PrevOffPath)) $Tpl->Parse($PrevOffPath, false);
    }
    else
    {
      if($Tpl->BlockExists($FirstOnPath)) 
      {
        $Tpl->SetVar("First_URL", $this->FileName . "?" . CCAddParam($QueryString, $this->TargetName . "Page", "1"));
        $Tpl->Parse($FirstOnPath, false);
      }
      if($Tpl->BlockExists($PrevOnPath)) 
      {
        $Tpl->SetVar("Prev_URL", $this->FileName . "?" . CCAddParam($QueryString, $this->TargetName . "Page", ($this->PageNumber - 1)));
        $Tpl->Parse($PrevOnPath, false);
      }
    }

    $PageOnExist = $Tpl->BlockExists($PageOnPath);
    $PageOffExist = $Tpl->BlockExists($PageOffPath);
    
    if($this->NavigatorType == tpCentered && ($PageOnExist || $PageOffExist))
    {
      $BeginPage = $this->PageNumber - intval(($this->NumberPages - 1) / 2);
      if($BeginPage < 1) $BeginPage = 1;
      $EndPage = $BeginPage + $this->NumberPages - 1;
      if($EndPage > $LastPage) 
      {
        $BeginPage = $BeginPage - $EndPage + $LastPage;
        if($BeginPage < 1) $BeginPage = 1;
        $EndPage = $LastPage;
      }
      for($J = $BeginPage; $J <= $EndPage; $J++)
      {
        if(intval($J) == intval($this->PageNumber) && $PageOffExist)
        {
          $Tpl->SetVar("Page_Number", $J);
          $Tpl->ParseTo($PageOffPath, true, $PagesPath);
        }
        else if($PageOnExist)
        {
          $Tpl->SetVar("Page_Number", $J);
          $Tpl->SetVar("Page_URL", $this->FileName . "?" . CCAddParam($QueryString, $this->TargetName . "Page", $J));
          $Tpl->ParseTo($PageOnPath, true, $PagesPath);
        }
      }
    }
    else if($this->NavigatorType == tpMoving && ($PageOnExist || $PageOffExist))
    {
      $GroupNumber = ceil($this->PageNumber / $this->NumberPages);
      $BeginPage = 1 + $this->NumberPages * ($GroupNumber - 1);
      $EndPage = $this->NumberPages * $GroupNumber;
      if($BeginPage < 1) $BeginPage = 1;
      if($EndPage > $LastPage) $EndPage = $LastPage;
      if($BeginPage > 1)
      {
        $Tpl->SetVar("Page_Number", "&lt;" . ($BeginPage - 1));
        $Tpl->SetVar("Page_URL", $this->FileName . "?" . CCAddParam($QueryString, $this->TargetName . "Page", ($BeginPage - 1)));
        $Tpl->ParseTo($PageOnPath, true, $PagesPath);
      }
      for($J = $BeginPage; $J <= $EndPage; $J++)
      {
        if(intval($J) == intval($this->PageNumber) && $PageOffExist)
        {
          $Tpl->SetVar("Page_Number", $J);
          $Tpl->ParseTo($PageOffPath, true, $PagesPath);
        }
        else if($PageOnExist)
        {
          $Tpl->SetVar("Page_Number", $J);
          $Tpl->SetVar("Page_URL", $this->FileName . "?" . CCAddParam($QueryString, $this->TargetName . "Page", $J));
          $Tpl->ParseTo($PageOnPath, true, $PagesPath);
        }
      }
      if($EndPage < $LastPage)
      {
        $Tpl->SetVar("Page_Number", ($EndPage + 1) . "&gt;");
        $Tpl->SetVar("Page_URL", $this->FileName . "?" . CCAddParam($QueryString, $this->TargetName . "Page", $EndPage + 1));
        $Tpl->ParseTo($PageOnPath, true, $PagesPath);
      }
    }
    else if($this->NavigatorType == tpSimple)
    {
      // Set Page Number
      $Tpl->SetVar("Page_Number", $this->PageNumber);
      if($PageOffExist) 
      {
        $Tpl->Parse($PageOffPath, false);
        if($Tpl->BlockExists($PagesPath)) $Tpl->Parse($PagesPath, false);
      }
    }

    // Set Total Pages
    $Tpl->SetVar("Total_Pages", $LastPage);

    // Parse Last and Next blocks
    if(intval($this->PageNumber) >= intval($LastPage))
    {
      if($Tpl->BlockExists($NextOffPath)) $Tpl->Parse($NextOffPath, false);
      if($Tpl->BlockExists($LastOffPath)) $Tpl->Parse($LastOffPath, false);
    }
    else
    {
      if($Tpl->BlockExists($NextOnPath)) 
      {
        $Tpl->SetVar("Next_URL", $this->FileName . "?" . CCAddParam($QueryString, $this->TargetName . "Page", ($this->PageNumber + 1)));
        $Tpl->Parse($NextOnPath, false);
      }
      if($Tpl->BlockExists($LastOnPath))
      {
        $Tpl->SetVar("Last_URL", $this->FileName . "?" . CCAddParam($QueryString, $this->TargetName . "Page", $LastPage));
        $Tpl->Parse($LastOnPath, false);
      }
    }

    $Tpl->Parse($NavigatorBlock, false);
  }

}
//End Navigator Class


?>
