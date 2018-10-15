<?php
///////////////////////////////////////////////////////
// Archivo de Configuración                          //
// NO MODIFIQUE EL CONTENIDO DE ESTE ARCHIVO         //
// A menos que sepa EXACTAMENTE lo que hace.         //
// La reparación de este archivo por parte del       //
// Servicio técnico generará una ORDEN DE TRABAJO    //
// Con COBRO.                                        // 
///////////////////////////////////////////////////////

// Define los parametros de conección
// a la Base de Datos 
//SET_VAR_STRING("cfg_user","root");
//$cfg_password="";
//SET_VAR_STRING("cfg_database","softlab_v2");
//$cfg_host= "localhost";

$cfg_servidor="http://localhost";

//Estados de Petición
define("EDO_PET_NUEVA",1);  //Nueva
define("edo_pet_nueva",2);

// 

// Define la versión en uso
// No modifique estos valores
define("version_mayor",2);
define("version_menor",0);
define("version_revision",10);
define("SOFTLAB_VERSION","2.0.10");

//Define el número de minutos que dura una sesión
//antes de cerrarse automáticamente
define("IDLE_MIN",10);
