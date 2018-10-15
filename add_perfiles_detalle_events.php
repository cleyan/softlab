<?php
//BindEvents Method @1-3FD581C0
function BindEvents()
{
    global $perfiles;
    global $CCSEvents;
    $perfiles->listbox_perfiles->CCSEvents["BeforeShow"] = "perfiles_listbox_perfiles_BeforeShow";
    $perfiles->list_test->ds->CCSEvents["BeforeBuildSelect"] = "perfiles_list_test_ds_BeforeBuildSelect";
    $perfiles->CCSEvents["BeforeUpdate"] = "perfiles_BeforeUpdate";
    $perfiles->CCSEvents["BeforeInsert"] = "perfiles_BeforeInsert";
    $perfiles->CCSEvents["BeforeDelete"] = "perfiles_BeforeDelete";
    $perfiles->CCSEvents["BeforeShow"] = "perfiles_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//perfiles_listbox_perfiles_BeforeShow @31-30FB2714
function perfiles_listbox_perfiles_BeforeShow(& $sender)
{
    $perfiles_listbox_perfiles_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $perfiles; //Compatibility
//End perfiles_listbox_perfiles_BeforeShow

//Custom Code @32-88640227
// -------------------------
    global $perfiles;
	global $DBDatos;

	$perfil_id_get = CCGetParam("perfil_id","");
	$bd = new clsDBDatos();
	$html_listbox = "<select name='perfiles' style='width:100%' onChange='parent.mainFrame.location.href=this.options[this.selectedIndex].value'>\n";
	if($perfil_id_get==""){
		$html_listbox .="<option value='add_perfiles_detalle.php?perfil_id=0' selected>Seleccionar Valor</option>";
	}
	else{
		$html_listbox .="<option value='add_perfiles_detalle.php?perfil_id=0'>Seleccionar Valor</option>";
	}
	$bd->query("SELECT nom_perfil, perfil_id FROM perfiles ORDER BY nom_perfil");
	$result = $bd->next_record();
	if($result){
		do{
			$nom_perfil = $bd->f("nom_perfil");
			$perfil_id = $bd->f("perfil_id");
			if($perfil_id_get == $perfil_id){
				$html_listbox.= "<option value='add_perfiles_detalle.php?perfil_id=$perfil_id&nom_perfil=$nom_perfil' selected>$nom_perfil</option>\n";
			}
			else{
				$html_listbox.= "<option value='add_perfiles_detalle.php?perfil_id=$perfil_id&nom_perfil=$nom_perfil'>$nom_perfil</option>\n";
			}
		}
		while($bd->next_record());
	$html_listbox.= "</select>\n";
	}
	$perfiles->listbox_perfiles->SetValue($html_listbox);
// -------------------------
//End Custom Code

//Close perfiles_listbox_perfiles_BeforeShow @31-AE92B236
    return $perfiles_listbox_perfiles_BeforeShow;
}
//End Close perfiles_listbox_perfiles_BeforeShow

//perfiles_list_test_ds_BeforeBuildSelect @11-BBFBFBDA
function perfiles_list_test_ds_BeforeBuildSelect(& $sender)
{
    $perfiles_list_test_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $perfiles; //Compatibility
//End perfiles_list_test_ds_BeforeBuildSelect

//Custom Code @22-88640227
// -------------------------
    global $perfiles;

	$ProjectConnection = null;
	$LinkedProject = "";
	
    //Select all projects of the currect user
    if (intval(CCGetFromGet("perfil_id",0)) > 0) {
  
      //Create a new database connection object
      $ProjectConnection = new clsDBDatos;
      $ProjectConnection->query("SELECT test_id FROM perfiles_detalle WHERE perfil_id =".$ProjectConnection->ToSQL(CCGetParam("perfil_id",0),ccsInteger));
      while($ProjectConnection->next_record()) {
         if($LinkedProject != "") $LinkedProject .= ",";
            $LinkedProject .= $ProjectConnection->f("test_id");
      }	
      //Destroy the database connection  object
      unset($ProjectConnection);
   }

  //Modify the Where clause of the AvailableListBox List Box
  if($LinkedProject != "") {
     $perfiles->list_test->ds->Where = "test_id NOT IN (".$LinkedProject.") AND aislado ='V'";
  }  


// -------------------------
//End Custom Code

//Close perfiles_list_test_ds_BeforeBuildSelect @11-0F088A64
    return $perfiles_list_test_ds_BeforeBuildSelect;
}
//End Close perfiles_list_test_ds_BeforeBuildSelect

//perfiles_BeforeUpdate @2-2C3C4476
function perfiles_BeforeUpdate(& $sender)
{
    $perfiles_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $perfiles; //Compatibility
//End perfiles_BeforeUpdate

//Custom Code @25-88640227
// -------------------------
    global $perfiles;
    ProjectEmployeesModify("Update");
// -------------------------
//End Custom Code

//Close perfiles_BeforeUpdate @2-E35BD558
    return $perfiles_BeforeUpdate;
}
//End Close perfiles_BeforeUpdate

//perfiles_BeforeInsert @2-41BF1234
function perfiles_BeforeInsert(& $sender)
{
    $perfiles_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $perfiles; //Compatibility
//End perfiles_BeforeInsert

//Custom Code @26-88640227
// -------------------------
    global $perfiles;
	ProjectEmployeesModify("Insert");
// -------------------------
//End Custom Code

//Close perfiles_BeforeInsert @2-2C7214D7
    return $perfiles_BeforeInsert;
}
//End Close perfiles_BeforeInsert

//perfiles_BeforeDelete @2-C0A82335
function perfiles_BeforeDelete(& $sender)
{
    $perfiles_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $perfiles; //Compatibility
//End perfiles_BeforeDelete

//Custom Code @27-88640227
// -------------------------
    global $perfiles;
    ProjectEmployeesModify("Delete");
// -------------------------
//End Custom Code

//Close perfiles_BeforeDelete @2-7F7F7329
    return $perfiles_BeforeDelete;
}
//End Close perfiles_BeforeDelete

//perfiles_BeforeShow @2-DBAADC73
function perfiles_BeforeShow(& $sender)
{
    $perfiles_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $perfiles; //Compatibility
//End perfiles_BeforeShow

//Custom Code @34-88640227
// -------------------------
    global $perfiles;
    if(!$perfiles->EditMode){
		$perfiles->Button_Insert->Visible = false;
		$perfiles->Button_Cancel->Visible = false;
	}
// -------------------------
//End Custom Code

//Close perfiles_BeforeShow @2-4E85FFF7
    return $perfiles_BeforeShow;
}
//End Close perfiles_BeforeShow

//Page_BeforeOutput @1-4D32E160
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_perfiles_detalle; //Compatibility
//End Page_BeforeOutput

//Custom Code @36-2A29BDB7
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
global $perfiles;

  $EmpProjectConn = null;
  $EmpID = 0;
  $ProjectID = 0;
  $ProjectList = array();
  $GetLastInsKey = 0;

  //Create new database EmpProjectConnection object
  $EmpProjectConn = new clsDBDatos();
  
  //Retrieve current employee
  $EmpID = CCGetFromGet("perfil_id",0);
  $ProjectList = explode(",",trim(CCGetFromPost("LinkedID","")));
	

  if($Actions == "Insert"){
	//Retrieve the last inserted key
   	//Use MS SQL method
   	//$GetLastInsKey = CCDLookup("@@IDENTITY","employees","",$DBIntranetDB);
   	//Use a method compatible with all databases (unsafe when multiple users insert records at the same time);
	//$GetLastInsKey = CCDLookup("max(emp_id)", "employees", "", $DBIntranetDB);
	$GetLastInsKey = CCGetFromGet("perfil_id",0);
   	//Insert New links
	reset($ProjectList);
	while(list($key,$ProjectID) = each($ProjectList)) {
	  if(intval($ProjectID)>0){
	     $EmpProjectConn->query("INSERT INTO perfiles_detalle(test_id, perfil_id) VALUES (".$EmpProjectConn->ToSQL($ProjectID,ccsInteger).",".$EmpProjectConn->ToSQL($GetLastInsKey,ccsInteger).")");
      }
    }
  }  	 
  if($EmpID >0){
    if( ($Actions == "Delete") || ($Actions == "Update")) {
	   //Delete project employees links
	   //die(printf("DELETE FROM compuesto_detalle WHERE comp_test_id=".$EmpProjectConn->ToSQL($EmpID,ccsInteger)));
	   $EmpProjectConn->query("DELETE FROM perfiles_detalle WHERE perfil_id=".$EmpProjectConn->ToSQL($EmpID,ccsInteger));
	   
    } 
	if($Actions == "Delete"){
		$EmpProjectConn->query("DELETE FROM perfiles WHERE perfil_id=".$EmpProjectConn->ToSQL($EmpID,ccsInteger));
	}
    if($Actions == "Update"){
       //Insert assigned employees
       reset($ProjectList);
       while(list($key,$ProjectID) = each($ProjectList)){
         if(intval($ProjectID)>0){
            $EmpProjectConn->query("INSERT INTO perfiles_detalle (test_id, perfil_id) VALUES (".$EmpProjectConn->ToSQL($ProjectID,ccsInteger).",".$EmpProjectConn->ToSQL($EmpID,ccsInteger).")");
         }
       }
    }
  }

  //Close and destroy the database connection object
  unset($EmpProjectConn);  
}

?>
