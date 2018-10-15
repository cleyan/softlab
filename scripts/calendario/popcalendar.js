//////////////////////////////////////////////////////////////////////////
///																		//
/// Funciones para tooltip												//
/// 																	//
//////////////////////////////////////////////////////////////////////////

	//Formato de la tabla
	var fmtTemaTabla = "InLineFormTABLE"
	var fmtTemaEncabezado = "InLineTitulo"
	var fmtTemaPie = "InLineFooterTD"
	var fmtTemaCuerpo = "InLineDataTD"


var ns4 = document.layers;
var ns6 = document.getElementById && !document.all;
var ie4 = document.all;
offsetX = 10;
offsetY = -20;
var toolTipSTYLE="";
function initToolTips()
{
  if(ns4||ns6||ie4)
  {
    if(ns4) toolTipSTYLE = document.toolTipLayer;
    else if(ns6) toolTipSTYLE = document.getElementById("toolTipLayer").style;
    else if(ie4) toolTipSTYLE = document.all.toolTipLayer.style;
    if(ns4) document.captureEvents(Event.MOUSEMOVE);
    else
    {
      toolTipSTYLE.visibility = "visible";
      toolTipSTYLE.display = "none";
    }
    document.onmousemove = moveToMouseLoc;
  }
}


function initToolTipsFijo()
{
  if(ns4||ns6||ie4)
  {
    if(ns4) toolTipSTYLE = document.toolTipLayer;
    else if(ns6) toolTipSTYLE = document.getElementById("toolTipLayer").style;
    else if(ie4) toolTipSTYLE = document.all.toolTipLayer.style;
    if(ns4) document.captureEvents(Event.MOUSEMOVE);
    else
    {
      toolTipSTYLE.visibility = "visible";
      toolTipSTYLE.display = "none";
    }
    document.onclick = moveToMouseLoc;
  }
}


function toolTip(msg, icono, titulo)
{
  if(toolTip.arguments.length < 1) // hide
  {
    if(ns4) toolTipSTYLE.visibility = "hidden";
    else toolTipSTYLE.display = "none";
  }
  else // show
  {
    if(!icono) icono = "images/ayudita.gif";
    if(!titulo) titulo = "Ayuda en Línea";



/*  Contenido Original
    var content =
    '<table border="0" cellspacing="0" cellpadding="1" bgcolor="' + fg + '"><td>' +
    '<table border="0" cellspacing="0" cellpadding="1" bgcolor="' + bg + 
    '"><td align="center"><font face="sans-serif" color="' + fg +
    '" size="-2">&nbsp\;' + msg +
    '&nbsp\;</font></td></table></td></table>';
*/
// Contenido pichicateaado por Carlitos
    var content =
    '<table><tr class="'+fmtTemaPie+'"><td><img src="'+icono+'"></td><td>'+titulo+'</td></tr>' +
    '<tr><td colspan="2"><table width=100%><tr class="'+fmtTemaCuerpo+'"><td>'+ msg +
    '</td></tr></table></td></tr></table>';
	
	//alert(content);

    if(ns4)
    {
      toolTipSTYLE.document.write(content);
      toolTipSTYLE.document.close();
      toolTipSTYLE.visibility = "visible";
    }
    if(ns6)
    {
      document.getElementById("toolTipLayer").innerHTML = content;
      toolTipSTYLE.display='block'
    }
    if(ie4)
    {
      document.all("toolTipLayer").innerHTML=content;
      toolTipSTYLE.display='block'
    }

	  /*if(ns4||ns6)
	  {
	    x = toolTip.pageX;
	    y = toolTip.pageY;
	  }
	  else
	  {
	    x = toolTip.x + document.body.scrollLeft;
	    y = toolTip.y + document.body.scrollTop;
	  }
	  //toolTipSTYLE.left = x + offsetX;
	  //toolTipSTYLE.top = y + offsetY;*/
 
	 }
}
function moveToMouseLoc(e)
{
  if(ns4||ns6)
  {
    x = e.pageX;
    y = e.pageY;
  }
  else
  {
    x = event.x + document.body.scrollLeft;
    y = event.y + document.body.scrollTop;
  }
  toolTipSTYLE.left = x + offsetX;
  toolTipSTYLE.top = y + offsetY;
  return true;
}
