<?php
/**
 * Fixe les différentes variables
 * nom de vue a appelée
 * ...
 */
 //
 if ( ! isset ( $dReponse [ 'sorry_msg' ] ) ) 
 {
 	$dReponse [ 'sorry_msg' ]  = $bbdLang [ 'sorry_msg' ] ;
 }
 if ( ! isset ( $dReponse [ 'error_msg' ] ) ) 
 {
 	$dReponse [ 'error_msg' ]  = $bbdLang [ 'noaction_msg' ] ;
 }
 if ( ! isset ( $dReponse [ 'yetaction' ] ) ) 
 {
 	$dReponse [ 'yetaction' ]   = 'home' ;
 }
 if ( ! isset ( $dReponse [ 'goto_msg' ] ) ) 
 {
 	$dReponse [ 'goto_msg' ]   = $bbdLang [ 'back_msg' ] ;
 }
// Vue
 $dReponse['content']          = $dConfig ['view']['error']['url'] ;
// Template
 $dReponse['template'] 		   = $dConfig['template']['error']['url'];
 ?>