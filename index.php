<?php
/**
 * 	Controlleur frontal de l'application
 * 	@author TCHOUABE
 * 	28/05/2011
 */
 //--------------------------------------------
 require 'appTools/bbdDefines.php';
 require 'appTools/bbdTools.php';
//------- inclusion des fichiers de configurations
 require 'appTools/config.php';
 require 'application/model/DbTable.php';
// require 'application/model/CelCode.php';
// require 'application/model/CelPerson.php';
 //---
// $celUser = new CelPerson ();
// $code = new CelCode () ; //--- Design Pattern Singleton pour la generation des codes
 //--------------------------------------------
 //-- chargement de la config de l'application
 $param = $bbdParamDB ['dev'];
 error_reporting ($param ['erep']);
//--------------------------------------
//---------- Aide de vue
 require DIR_HELPER . 'htmlSpecialChars.php' ;
 require DIR_HELPER . 'dateFormate.php' ;
//---------------------------------------------------------------
//----------- Impl�mentation du singleton Registre
 //-----------------------------------------------------------
 //----------- Connexion � la BD
 mysql_connect ($param ['host'], $param ['user'], $param ['pass']);
 $cnx = mysql_select_db ($param ['name']);
 if ( ! $cnx ) 
 {
 	bbdLog( ">>>Error connect to the database : " . $_SERVER['REMOTE_ADDR'] . " - " .  $_SERVER['REQUEST_URI'] ) ;
 	exit () ;
 }
 mysql_set_charset(MYSQL_CHARSET); // précision sur l'encodage des données
 //----------- fin connexion BD
 //--------------------------------------------------
 //---- parametres persistant
 session_start ();
 //----------------------------------------------------------------------
 //------------- CHOIX DE LA LANGUE
 
 //--- cas possibles
 //- 1 - S'il la langue est en session , on verifie l'existence de la variable GET avec la cl� 'lang'
 //-- 1 - a - si la variable $_GET [ 'lang' ] existe , elle est prioritaire devant la session 
 //			  si le user n'est pas connect� . Dans le cas o� le user est connect� elle n'est pas consid�r�e
 //-- 1 - b - si la variable $_GET [ 'lang' ] n'existe pas , on recupere la variable de session $_SESSION [ 'lang' ]
 //- 2 - Si la variable $_SESSION [ 'lang' ] n'existe pas , on teste l'existence de la variable $_GET [ 'lang' ]
 //-- 2 - a - si la variable existe , on la recupere et on la met en session
 //-- 2 - b - si la variable n'existe pas , on recupere la langue par defaut et on la met en session
 //
 //
 if (isset ($_SESSION ['lang']) && ! isset ($_GET ['lang'])) // si la langue est en session
 {
 	if (isset ($_SESSION ['MDZ_CONNECT_USER_22'])) { // si le user est connect�
 		if (strcasecmp ($_GET ['action'], 'logout') == 0)
 			$lang = DEFAULT_LANG;
 		else 
 			$lang = $_SESSION ['lang'];
 	}
 	else { // sinon
 		if (isset ($_GET ['lang'])) { // si la langue est demand� par le user de facon explicite
	 		if (key_exists ($_GET ['lang'], $dConfig ['lang'])) // cette langue est elle reconnue par le systeme ?
		 		$lang = $_GET ['lang']; // Oui on la recupere
		 	else // Non
		 		$lang = DEFAULT_LANG; // On recupere la langue par defaut
 		}
 		else // sinon
 			$lang = $_SESSION ['lang'];
 	}
 }
 else // si la langue n'est pas en session
 {
 	if (isset ($_GET ['lang'])) { // si la langue est dans l'url
 		if (key_exists ($_GET ['lang'], $dConfig ['lang'])) // cette langue est elle reconnue par le systeme ?
	 		$lang = $_GET ['lang']; // Oui on la recupere
	 	else // Non
	 		$lang = DEFAULT_LANG ; // On recupere la langue par defaut
 	}
 	else // sinon
 		$lang = DEFAULT_LANG;
 }
 $_SESSION ['lang'] = $lang; // mise en session
 //
 //--- Log 
 bbdLog('>>> Lang : ' . $lang . ' - ' . $_SERVER ['REMOTE_ADDR'] . ' - ' .  $_SERVER ['REQUEST_URI']);
 //----------------------------------------------------------------
 //------ inclusion du fichier de langue
 require_once DIR_LANG . $lang . DIR_SEPARATOR . $dConfig ['lang'][$lang]; // inclusion du fichier de langue
 //--- Log 
 bbdLog( '--- Lang file included - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' .  $_SERVER [ 'REQUEST_URI' ] ) ;
 //----------------------------------------------------------------------
 //------------- FIN CHOIX DE LA LANGUE
 $dSession = $_SESSION ['session'];
 if ($dSession)
	$dSession = unserialize ($dSession);
 if (! isset ($_SESSION ['MDZ_CONNECT_USER_22'])) // si l'utilisateur a �t� identifi� (protection contre le vol de session)
 	$dSession ['state']['preview'] = empty ($_GET ['st']) ? 'home' : $_GET ['st'];
//--------------------------------------------------------------
// Inclusion du controller frontal
//---------------------------------------------------------------
 require 'application/controller/index.php';
?>