<?php
/**
 * Ce fichier sert � fixer les parametres partag�s
 * entre toutes les interfaces
 * @author : TCHOUABE
 * @since : 2011
 */
 $dReponse ['bodyId'] = 'homebody';
 $dReponse ['allWidth'] = 'allWidth';
 $dReponse ['listlang'] = 'listlang';
 //------------------------------------------------------------
 //--------- Construction de la chaine liste des langues
 if ($dSession ['state']['secondaire'] == 'home')
 {
	 $dReponse ['traduction_msg'] = bbdHtmlSpecialChars($bbdLang ['traduction_msg']) . ' : &nbsp;&nbsp;&nbsp;';
	 $dReponse ['list_lang']      = getLangList ();
 }
 else
 {
 	$lg								= $bbdLang ['lang'];
 	$dReponse ['list_lang']			= getLangList ($lg);
 	$dReponse ['traduction_msg'] 	= bbdHtmlSpecialChars($bbdLang ['copyright']);
 }
 $dReponse ['header']                 = $dConfig ['layout']['homeheader']['url'];
 $dReponse ['footer']                 = $dConfig ['layout']['homefooter']['url'];
 $dReponse ['msg_email_login']        = $bbdLang ['email'];
 $dReponse ['msg_password_login']     = $bbdLang ['password_login'];
 $dReponse ['msg_session_guard']      = $bbdLang ['session_guard'];
 $dReponse ['msg_password_forgotten'] = $bbdLang ['password_forgotten'];
 $dReponse ['msg_connect_button']     = $bbdLang ['connect_button'];
 //---------------------------------------------------------------------------
 //----------- template du controlleur
 $dReponse ['state_template'] = $dConfig ['c_template']['home']['url'];
 // Vue
 $dReponse ['content'] 		  = $dConfig ['view'][$dSession ['state']['secondaire'] ]['url'];
 // Template
 $dReponse ['template']   	  = $dConfig ['template'][$dSession ['state']['secondaire']]['url'];
 //----------------------------------------------------------------------------
 //-------- inclusion du controlleur de l'action
 require DIR_CONTROLLER . $dConfig ['s_controller']['home'][$dSession ['state']['secondaire']]['url'];
?>