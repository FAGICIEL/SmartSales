<?php
 $rep = '../' ;
 require $rep . '../appTools/bbdDefines.php' ;
 require $rep . '../appTools/bbdTools.php' ;
 require $rep . '../config/configModel.php' ;
 require $rep . '../config/configApplication.php' ;
 require $rep . 'model/DbTable.php' ;
 require $rep . 'model/SbsCode.php';
 $code = new SbsCode () ; //--- Design Pattern Singleton pour la generation des codes
//--------------------------------------
//---------- Aide de vue
 require $rep . 'view/helper/htmlSpecialChars.php';
 require $rep . 'view/helper/dateFormate.php';
 session_start () ;
 $lang = $_SESSION ['lang'];
 $langRep = $rep . DIR_AJAX_LANG . $lang . DIR_SEPARATOR;
 require_once $langRep .$lang . '.php' ; // inclusion du fichier de langue
 // connexion � la bd
 $param  = $bbdParamDB ['dev'];
 mysql_connect ($param ['host'], $param ['user'], $param ['pass']);
 $cnx = mysql_select_db ($param ['name']);
 if (! $cnx) {
 	trigger_error ("impossible de se connecter à la base de donnée");
 	exit ();
 }
 //
 mysql_set_charset(MYSQL_CHARSET); // précision sur l'encodage des données
?>