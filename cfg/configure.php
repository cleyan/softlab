<?php
///////////////////////////////////////////////////////
// Archivo de Configuraci�n                          //
// NO MODIFIQUE EL CONTENIDO DE ESTE ARCHIVO         //
// A menos que sepa EXACTAMENTE lo que hace.         //
// La reparaci�n de este archivo por parte del       //
// Servicio t�cnico generar� una ORDEN DE TRABAJO    //
// Con COBRO.                                        // 
///////////////////////////////////////////////////////

// Define los parametros de conecci�n
// a la Base de Datos 
//SET_VAR_STRING("cfg_user","root");
//$cfg_password="";
//SET_VAR_STRING("cfg_database","softlab_v2");
//$cfg_host= "localhost";

$cfg_servidor="http://localhost";

//Estados de Petici�n
define("EDO_PET_NUEVA",1);  //Nueva
define("edo_pet_nueva",2);

// 

// Define la versi�n en uso
// No modifique estos valores
define("version_mayor",2);
define("version_menor",0);
define("version_revision",10);
define("SOFTLAB_VERSION","2.0.10");

//Define el n�mero de minutos que dura una sesi�n
//antes de cerrarse autom�ticamente
define("IDLE_MIN",10);
