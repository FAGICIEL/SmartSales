<?php
/**
 * Fixe les diff�rentes variables
 * nom de vue a appel�e
 * ...
 */
 $dReponse ['homecontent']=  getXHTML ('vConnexion.html');
// Definition des messages en tenant compte de la langue
 $dReponse [ 'msg_email' ]             = $bbdLang [ 'email' ] ;
 $dReponse [ 'msg_password' ]          = $bbdLang [ 'password' ] ;
 $dReponse [ 'msg_ins' ]               = $bbdLang [ 'submit_inscription_msg' ] ;
 if (! isset ($dSession ['state']['status'])) 
 {
	$dReponse [ 'login' ]    	       = '' ;
	$dReponse [ 'passwd' ]           = '' ;
	$dReponse [ 'error_login' ] 	   = '' ;
 }
 elseif ( $dSession [ 'state' ][ 'status' ] == 'errorlogin' ) 
 {
 	$dReponse [ 'error_login' ] 	   = '<p>'. $bbdLang ['error_login_msg' ] . '</p>' ;
 }
 // Vue
 $dReponse [ 'content' ]               = $dConfig [ 'view' ][ 'home' ][ 'url' ] ;
 // Template
 $dReponse['template']           	   = $dConfig [ 'template' ][ 'home' ][ 'url' ] ;
 ?>