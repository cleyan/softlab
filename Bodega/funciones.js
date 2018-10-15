// JScript source code

var ns4 = (document.layers);
var ie4 = (document.all && !document.getElementById);
var ie5 = (document.all && document.getElementById);
var ns6 = (!document.all && document.getElementById);

function show(id){
	// Netscape 4
	if(ns4){
		document.layers[id].visibility = "show";
	}
	// Explorer 4
	else if(ie4){
		document.all[id].style.visibility = "visible";
	}
	// W3C - Explorer 5+ and Netscape 6+
	else if(ie5 || ns6){
		document.getElementById(id).style.visibility = "visible";
	}
}

function hide(id){
	// Netscape 4
	if(ns4){
		document.layers[id].visibility = "hide";
	}
	// Explorer 4
	else if(ie4){
		document.all[id].style.visibility = "hidden";
	}
	// W3C - Explorer 5+ and Netscape 6+
	else if(ie5 || ns6){
		document.getElementById(id).style.visibility = "hidden";
	}
}

// Abre ventana centrada con los valores
//					FileURL=ruta del archivo
//					winName=nombre de la ventana
//					w=ancho
//					h=alto
function openWindow(FileURL, winName, w, h, scroll, top, left, resizable) {
	
	if (!scroll) {
		scroll='no';
	} else {
		scroll='yes';
	}

	if (!resizable) {
		resizable='no';
	} else {
		resizable='yes';
	}



    winStats = "width=" + w + ",height=" + h + ", resizable=" + resizable  +  ", alwaysRaised=yes, dependent=yes, titlebar=no, dialog=yes, modal=yes,toolbar=no,location=no,directories=no,menubar=no,scrollbars=" + scroll + ",status=no,";
    if (navigator.appName.indexOf("Microsoft") >= 0) {// or if (document.all)
        var xMax = screen.width, yMax = screen.height;
    }else {
        if (navigator.appName.indexOf("Netscape") >= 0) {// or if (document.layers)
            var xMax = window.outerWidth, yMax = window.outerHeight;
        }else {
            var xMax = 640, yMax=480; //default guess
        }
    }
    //calculate center
    var xOffset = (xMax - w)/2, yOffset = (yMax - h)/2;
	if(!top) top=yOffset;

	if (!left) left=xOffset;

    winStats += "left=" + left + ",top=" + top;
	var laventana= window.open(FileURL, winName, winStats);
	laventana.focus();
}

function MsgBox(mensaje, tipo, param){
	window.showModalDialog('msgbox.php',param);
}

//Funciones para validad RUT
	function limpia(campo){
		campo.value="";
		campo.focus();
	}
	function valida_rut(rut){
		if(valida_formato(rut)){
			if(valida_difito(rut)){
				return true;
			}
			else {
				return false;
			}
		}
	}
	function valida_formato(rut){
		var cont=0;
		
		tmprut = rut.value;
		for ( i=0; i < tmprut.length; i++ ) {
			if (tmprut.charAt(i) == '-' ) {
				cont++;
			}
		}
		if(cont == 0){
			alert("Debe ingresar el Rut con el formato especificado (Ej: 11222333-4)");
			rut.value="";
			rut.focus();
			return false;
		}
		else if(cont > 1){
			alert("Debe ingresar el Rut con el formato especificado (Ej: 11222333-4)");
			rut.value="";
			rut.focus();
			return false;
		}
		else{
			return true;
		}
	}

	//el formato de rut que se recibe es: 11111111-1
	function valida_difito(rut)
	{
		var tmpstr="";
		var tmprut, i;
		var digito = "";
		
		tmprut = rut.value;
		
		if ( tmprut.length >= 9 && tmprut.length <= 10)
		{
			for ( i=0; i < tmprut.length; i++ ) 
			{
				if ( tmprut.charAt(i) != ' ' && tmprut.charAt(i) != '.' && tmprut.charAt(i) != '-' ) 
				{
					tmpstr = tmpstr + tmprut.charAt(i); //obtengo el rut sin caracteres... osea: 111111111
				}
			}
			tmprut = "";
			largo_rut = tmpstr.length; 	
		
			for ( i=0; i < largo_rut-1; i++ )
			{
				tmprut = tmprut + tmpstr.charAt(i);    //obtengo el rut sin digito verificador
			}
			digito= tmpstr.charAt(largo_rut-1);			//obtengo el digito verificador
		
			var dvr = '0';
			suma = 0;
			mul  = 2;

			for (i= tmprut.length - 1 ; i >= 0; i--) 
			{
				suma = suma + tmprut.charAt(i) * mul;
				if (mul == 7)
					mul = 2;
				else
					mul++;
			}

			res = suma % 11;
			if (res==1)
			{
				dvr = 'k';
			}
			else if (res==0) 
			{
				dvr = '0';
			}
			else
			{
				dvi = 11-res;
				dvr = dvi + "";
			}
			if (dvr != digito.charAt(0).toLowerCase()) 
			{
				alert("El RUT ingresado es inválido, ingreselo nuevamente");
				rut.value="";
				rut.focus();
				return false; //El DV no concordo con el RUT.
			}

			return true; //EL DV concordo con el RUT.
		}
		else if( tmprut.length = 0 )
		{
			return true;
		}
		else
		{
			alert("El RUT ingresado es inválido, ingreselo nuevamente");
			rut.value="";
			rut.focus();
			return false;
		}

	}	

//FIN: Funciones para validad RUT

function getEdad(fecha_nac){

    //calculo la fecha de hoy
    var hoy=new Date();
    //alert(hoy)

	//Los Datos de Hoy
	var year_hoy=hoy.getFullYear();
	var mes_hoy=hoy.getMonth() + 1;
	var dia_hoy=hoy.getDate();

	//la fecha recibida
	var fecha=fecha_nac;

	//alert(fecha);

    //calculo la fecha que recibo
    //La descompongo en un array
    var array_fecha = fecha.split("/")
    //si el array no tiene tres partes, la fecha es incorrecta
    if (array_fecha.length!=3)
		return  'Formato incorrecto, use dd/mm/yyyy';
		

    //compruebo que los ano, mes, dia son correctos
    var ano
    ano = parseInt(array_fecha[2],10);
    if (isNaN(ano) || ano > hoy.getFullYear() ) {
       return 'Año incorrecto';
	}

    var mes
    mes = parseInt(array_fecha[1],10);
    if (isNaN(mes) || mes < 1 || mes >12){
       return 'Mes incorrecto';
	}
	
    var dia
    dia = parseInt(array_fecha[0],10);
    if (isNaN(dia) || dia<1 || dia > 31){
       return 'Dia incorrecto';
	}

    //si el año de la fecha que recibo solo tiene 2 cifras hay que cambiarlo a 4
    if (ano<=99)
       ano +=1900

	//alert('Escrito: \n dia ' + dia + ' mes ' + mes + ' año ' + ano + '\n Hoy: \n año: ' + year_hoy + ' mes: ' + mes_hoy + ' dia ' + dia_hoy );
	
    ano = year_hoy - ano;
    mes = mes_hoy - mes;
    dia = dia_hoy - dia;

    //Si salió un día negativo
    if (dia < 0) {
        dia = 30 - Math.abs(dia);
        mes = mes - 1;
    }

    //Si salió un mes negativo
    if (mes < 0) {
        mes = 12 - Math.abs(mes);
        ano = ano - 1;
    }

	//Prepara la información a entregar	
    if (ano==0 && mes==0 && dia==0){
        return 'Recien Nacido?';

    } else if (ano<1 && mes<3){
        return mes + ' meses, ' + dia + ' dias';

    } else if (ano<1 && mes>=1) {
        return mes + ' meses';

    } else if (ano<1 && mes<1){
        return dia + ' dias';

    } else if (ano<2) {
        return ano + ' año, ' + mes + ' meses';

    } else {
		return ano + ' Años ';
    }	
	
	return ano + ' años, ' + mes + ' meses, ' +  dia  + ' dias';


}


function enfoque(idobjeto){
	var objeto=document.getElementById(idobjeto);

	if (objeto){
		if (!objeto.disabled){				
			objeto.focus();
			objeto.select();
		}		 
	}
}

