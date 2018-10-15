<?php
//BindEvents Method @1-C66E81CB
function BindEvents()
{
    global $resultados;
    global $CCSEvents;
    $resultados->CCSEvents["BeforeShow"] = "resultados_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//resultados_BeforeShow @2-DCBB5861
function resultados_BeforeShow(& $sender)
{
    $resultados_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resultados; //Compatibility
//End resultados_BeforeShow

//Custom Code @27-1292BE33
// -------------------------
    global $resultados;
    $test_id = CCGetParam("test_id","");
	$db = new clsDBDatos();
	$db->query("SELECT con_text_area FROM test WHERE test_id=$test_id");
	if($db->next_record()){
		if($db->f("con_text_area")=="F"){
			$db->query("SELECT COUNT(*) as total FROM valores_resultado WHERE test_id=$test_id");
			if($db->next_record()){
			//	printf("test: ".$test_id." reg: ".$db->f("total"));
				if($db->f("total") > 0){
					$resultados->style_text_valor->SetValue("style=\"display:none;\"");
					$resultados->style_textarea_valor->SetValue("style=\"display:none;\"");
			
				}
				else{
					$resultados->style_list_valor->SetValue("style=\"display:none;\"");
					$resultados->style_textarea_valor->SetValue("style=\"display:none;\"");
				}
			}
			else{
				$resultados->style_list_valor->SetValue("style=\"display:none;\"");
				$resultados->style_textarea_valor->SetValue("style=\"display:none;\"");
			}
		}
		else{
			$resultados->style_list_valor->SetValue("style=\"display:none;\"");
			$resultados->style_text_valor->SetValue("style=\"display:none;\"");
		}
	}
	unset($db);
// -------------------------
//End Custom Code

//Close resultados_BeforeShow @2-7EFD4B9D
    return $resultados_BeforeShow;
}
//End Close resultados_BeforeShow

//Page_BeforeOutput @1-5EFF7FC5
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_nuevo_resultado; //Compatibility
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
?>
