<?php
//BindEvents Method @1-F9FDB28C
function BindEvents()
{
    global $compuesto_detalle;
    global $CCSEvents;
    $compuesto_detalle->lbl_grabado->CCSEvents["BeforeShow"] = "compuesto_detalle_lbl_grabado_BeforeShow";
    $compuesto_detalle->list_test->ds->CCSEvents["BeforeBuildSelect"] = "compuesto_detalle_list_test_ds_BeforeBuildSelect";
    $compuesto_detalle->CCSEvents["BeforeDelete"] = "compuesto_detalle_BeforeDelete";
    $compuesto_detalle->CCSEvents["BeforeInsert"] = "compuesto_detalle_BeforeInsert";
    $compuesto_detalle->CCSEvents["BeforeUpdate"] = "compuesto_detalle_BeforeUpdate";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//compuesto_detalle_lbl_grabado_BeforeShow @84-8D39A34E
function compuesto_detalle_lbl_grabado_BeforeShow(& $sender)
{
    $compuesto_detalle_lbl_grabado_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $compuesto_detalle; //Compatibility
//End compuesto_detalle_lbl_grabado_BeforeShow

//Custom Code @85-E7F96117
// -------------------------
    global $compuesto_detalle;

	$grabado=CCGetParam("grabado","");
	if ($grabado=="ok") {
		$compuesto_detalle->lbl_grabado->SetValue("<script>Alert('SE GUARDARON LOS CAMBIOS');</script>");
	} else {
		$compuesto_detalle->lbl_grabado->SetValue("");
	}


// -------------------------
//End Custom Code

//Close compuesto_detalle_lbl_grabado_BeforeShow @84-F7C93248
    return $compuesto_detalle_lbl_grabado_BeforeShow;
}
//End Close compuesto_detalle_lbl_grabado_BeforeShow

//DEL  // -------------------------
//DEL      global $compuesto_detalle;
//DEL  	global $DBDatos;
//DEL      $id = $compuesto_detalle->comp_test_id->GetValue();
//DEL  	$nom_test = CCGetDBValue("SELECT nom_test FROM test WHERE test_id=$id",$DBDatos);
//DEL  	$compuesto_detalle->nom_test->SetValue($nom_test);
//DEL  
//DEL  
//DEL  // -------------------------

//compuesto_detalle_list_test_ds_BeforeBuildSelect @21-C2BF4626
function compuesto_detalle_list_test_ds_BeforeBuildSelect(& $sender)
{
    $compuesto_detalle_list_test_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $compuesto_detalle; //Compatibility
//End compuesto_detalle_list_test_ds_BeforeBuildSelect

//Custom Code @37-E7F96117
// -------------------------
    global $compuesto_detalle;

    $ProjectConnection = null;
	$LinkedProject = "";
	
    //Select all projects of the currect user
    if (intval(CCGetFromGet("comp_test_id",0)) > 0) {
  
      //Create a new database connection object
      $ProjectConnection = new clsDBDatos;
      $ProjectConnection->query("SELECT test_id FROM compuesto_detalle WHERE comp_test_id =".$ProjectConnection->ToSQL(CCGetParam("comp_test_id",0),ccsInteger));
      while($ProjectConnection->next_record()) {
         if($LinkedProject != "") $LinkedProject .= ",";
            $LinkedProject .= $ProjectConnection->f("test_id");
      }	
      //Destroy the database connection  object
      unset($ProjectConnection);
   }

  //Modify the Where clause of the AvailableListBox List Box
  if($LinkedProject != "") {
  	 $LinkedProject .= ",".$compuesto_detalle->comp_test_id->GetValue();
     $compuesto_detalle->list_test->ds->Where = " compuesto <> 'V' AND test_id NOT IN (".$LinkedProject.")";
  }  

// -------------------------
//End Custom Code

//Close compuesto_detalle_list_test_ds_BeforeBuildSelect @21-FF2798C3
    return $compuesto_detalle_list_test_ds_BeforeBuildSelect;
}
//End Close compuesto_detalle_list_test_ds_BeforeBuildSelect

//compuesto_detalle_BeforeDelete @11-07327522
function compuesto_detalle_BeforeDelete(& $sender)
{
    $compuesto_detalle_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $compuesto_detalle; //Compatibility
//End compuesto_detalle_BeforeDelete

//Custom Code @40-E7F96117
// -------------------------
    global $compuesto_detalle;
	global $Redirect;

	$comp_test_id=CCGetParam("comp_test_id","");

    ProjectEmployeesModify("Delete");
	$compuesto_detalle->DeletetAllowed = false;
	die(header("Location: add_compuesto_detalle.php?comp_test_id=$comp_test_id"));
// -------------------------
//End Custom Code

//Close compuesto_detalle_BeforeDelete @11-3AE334DF
    return $compuesto_detalle_BeforeDelete;
}
//End Close compuesto_detalle_BeforeDelete

//compuesto_detalle_BeforeInsert @11-0326E327
function compuesto_detalle_BeforeInsert(& $sender)
{
    $compuesto_detalle_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $compuesto_detalle; //Compatibility
//End compuesto_detalle_BeforeInsert

//Custom Code @64-E7F96117
// -------------------------
    global $compuesto_detalle;
	global $Redirect;

	$comp_test_id=CCGetParam("comp_test_id","");

	ProjectEmployeesModify("Insert");
	$compuesto_detalle->InsertAllowed = false;

	die(header("Location: add_compuesto_detalle.php?comp_test_id=$comp_test_id&grabado=ok"));

// -------------------------
//End Custom Code

//Close compuesto_detalle_BeforeInsert @11-69EE5321
    return $compuesto_detalle_BeforeInsert;
}
//End Close compuesto_detalle_BeforeInsert

//compuesto_detalle_BeforeUpdate @11-7CCCA6A9
function compuesto_detalle_BeforeUpdate(& $sender)
{
    $compuesto_detalle_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $compuesto_detalle; //Compatibility
//End compuesto_detalle_BeforeUpdate

//Custom Code @39-E7F96117
// -------------------------
    global $compuesto_detalle;

	$comp_test_id=CCGetParam("comp_test_id","");

    ProjectEmployeesModify("Update");
	$compuesto_detalle->UpdateAllowed = false;
	die(header("Location: add_compuesto_detalle.php?comp_test_id=$comp_test_id&grabado=ok"));

// -------------------------
//End Custom Code

//Close compuesto_detalle_BeforeUpdate @11-A6C792AE
    return $compuesto_detalle_BeforeUpdate;
}
//End Close compuesto_detalle_BeforeUpdate

//Page_AfterInitialize @1-9B256B75
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_compuesto_detalle; //Compatibility
//End Page_AfterInitialize

//Custom Code @83-7EFB7411
// -------------------------
    global $add_compuesto_detalle;
    // Write your own code here.

	$test_id=CCGetParam("comp_test_id","");

	if ($test_id==""){
		echo "<h1>Antes debe grabar el Test</h1>";
		exit;
	}

	$db=new clsDBDatos();
	$sql="SELECT compuesto FROM test WHERE test_id=$test_id";
	$db->query($sql);
	
	$compuesto=($db->next_record()) ? $db->f(0) : "" ;

	unset($db);

	if ($compuesto != 'V') {
		print("<h1>El Test no es un Test Compuesto</h1>");
		exit;
	}


// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-60EA8807
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_compuesto_detalle; //Compatibility
//End Page_BeforeOutput

//Custom Code @93-2A29BDB7
// -------------------------
    // Write your own code here.

	global $main_block;

	CorrigeCodigo($main_block);



// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput


function ProjectEmployeesModify($Actions){ 

global $DBDatos;
global $compuesto_detalle;

  $EmpProjectConn = null;
  $EmpID = 0;
  $ProjectID = 0;
  $ProjectList = array();
  $GetLastInsKey = 0;

  //Create new database EmpProjectConnection object
  $EmpProjectConn = new clsDBDatos();
  
  //Retrieve current employee
  $EmpID = CCGetFromGet("comp_test_id",0);
  $ProjectList = explode(",",trim(CCGetFromPost("LinkedID","")));
	

  if($Actions == "Insert"){
	//Retrieve the last inserted key
   	//Use MS SQL method
   	//$GetLastInsKey = CCDLookup("@@IDENTITY","employees","",$DBIntranetDB);
   	//Use a method compatible with all databases (unsafe when multiple users insert records at the same time);
	//$GetLastInsKey = CCDLookup("max(emp_id)", "employees", "", $DBIntranetDB);
	$GetLastInsKey = CCGetFromGet("comp_test_id",0);
   	//Insert New links
	reset($ProjectList);
	while(list($key,$ProjectID) = each($ProjectList)) {
	  if(intval($ProjectID)>0){
	     $EmpProjectConn->query("INSERT INTO compuesto_detalle(test_id, comp_test_id) VALUES (".$EmpProjectConn->ToSQL($ProjectID,ccsInteger).",".$EmpProjectConn->ToSQL($GetLastInsKey,ccsInteger).")");
      }
    }
  }  	 
  if($EmpID >0){
    if( ($Actions == "Delete") || ($Actions == "Update")) {
	   //Delete project employees links
	   //die(printf("DELETE FROM compuesto_detalle WHERE comp_test_id=".$EmpProjectConn->ToSQL($EmpID,ccsInteger)));
	   $EmpProjectConn->query("DELETE FROM compuesto_detalle WHERE comp_test_id=".$EmpProjectConn->ToSQL($EmpID,ccsInteger));
	   
    } 
    if($Actions == "Update"){
       //Insert assigned employees
       reset($ProjectList);
       while(list($key,$ProjectID) = each($ProjectList)){
         if(intval($ProjectID)>0){
            $EmpProjectConn->query("INSERT INTO compuesto_detalle (test_id, comp_test_id) VALUES (".$EmpProjectConn->ToSQL($ProjectID,ccsInteger).",".$EmpProjectConn->ToSQL($EmpID,ccsInteger).")");
         }
       }
    }
  }

  //Close and destroy the database connection object
  unset($EmpProjectConn);  
}


?>
