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
