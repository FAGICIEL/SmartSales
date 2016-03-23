<?php
 /**
 * 
 * Controleur secondaire
 * @author M. TCHOUABE
 */
 //--- recuperation de tous les amis de l'internaute
 require_once 'application/model/ClpUser.php';
 //--- Log 
 bbdLog( '>>> cConnect - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' .  $_SERVER [ 'REQUEST_URI' ] ) ;
 //
 $dReponse [ 'traduction_msg' ] 	 = $bbdLang [ 'copyright' ] ;
 $_SESSION [ 'SELECTED_LANG' ] 		 = $lg = $bbdLang [ 'lang' ] ;
 $dReponse [ 'list_lang' ]			 = $bbdLang [ 'list_lang' ][ $lg ] ;
 $dReponse [ 'header' ]              = $dConfig [ 'layout' ][ 'ajaxformheader' ][ 'url' ] ;
 $dReponse [ 'footer']               = $dConfig [ 'layout' ][ 'ajaxformfooter' ][ 'url' ] ;
 $dReponse [ 'content' ]             = $dConfig [ 'view' ][ 'ajaxform' ][ 'url' ] ;
 $dReponse [ 'ajax_close_label' ]    = $bbdLang [ 'close_button_label' ] ;
 //---------------------------------------------------------------------------
 //----------- template du controlleur
 $dReponse [ 'state_template' ] = $dConfig [ 'c_template' ][ 'ajaxform' ][ 'url' ] ;
 //
 $dReponse [ 'viewModel' ]    = $dConfig [ 'viewgab' ][ 'ajaxform' ][ 'url' ] ;
 //--- Log 
 bbdLog( '--- general view - ' . $dReponse [ 'viewModel' ] . ' - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' 
 			.  $_SERVER [ 'REQUEST_URI' ] ) ;
 //--- Log 
 bbdLog( '--- Controller template : ' . $dReponse [ 'state_template' ] . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' 
 			.  $_SERVER [ 'REQUEST_URI' ] ) ;
 // Vue �l�mentaire
 $dReponse [ 'content' ] = $dConfig [ 'view' ][ $dSession [ 'state' ][ 'secondaire' ] ][ 'url' ] ;
 //--- elementary Log 
 bbdLog( '--- Elementary view - ' . $dReponse [ 'content' ] . ' - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' 
 			.  $_SERVER [ 'REQUEST_URI' ] ) ;
 // Template
 $dReponse [ 'template' ]   = $dConfig [ 'template' ][ $dSession [ 'state' ][ 'secondaire' ] ][ 'url' ] ;
 //--- Log 
 bbdLog( '--- Elementary template - ' . $dReponse['template'] . ' - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' 
 			.  $_SERVER [ 'REQUEST_URI' ] ) ;
 //
 //----------------------------------------------------------------------------
 //-------- inclusion du controlleur de l'action
 require $dConfig [ 's_controller' ][ 'connect' ][ $dSession [ 'state' ][ 'secondaire' ] ][ 'url' ] ;
?>