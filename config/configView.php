<?php

//-------------------------------------------------------------------
//---- Tableau contenant les differents modeles de vues (gabarit)
$dConfig ['appviewmodel']['default'] = array('url' => 'appViewModel.html');
$dConfig ['ajaxform']['default'] = array('url' => 'appAjaxForm.html');
//
$dConfig ['viewgab']['connect'] = array('url' => 'viewConnect.html');
$dConfig ['viewgab']['mention'] = array('url' => 'viewMention.html');
$dConfig ['viewgab']['ajaxform'] = array('url' => 'viewAjaxForm.html');
//-------------------------------------------------------------------
//------ Tableau contenant les differentes vues �l�mentaires
//--- Home
$dConfig ['view']['home'] = array('url' => 'vHome.html');
$dConfig ['view']['error'] = array('url' => 'vError.html');
//--- Connexion
$dConfig ['view']['connect'] = array('url' => 'vConnect.html');

//--- Connexion -> Ajax From
//--- Other
$dConfig ['view']['mention'] = array('url' => 'vMention.html');
$dConfig ['view']['confident'] = array('url' => 'vConfident.html');
$dConfig ['view']['contact'] = array('url' => 'vContact.html');
$dConfig ['view']['team'] = array('url' => 'vTeam.html');
$dConfig ['view']['jobs'] = array('url' => 'vJobs.html');
$dConfig ['view']['apropos'] = array('url' => 'vApropos.html');
$dConfig ['view']['help'] = array('url' => 'vHelp.html');
//--------------------------------------
//------ les differents layouts
$dConfig ['layout']['homeheader'] = array('url' => 'homeheader.html');
$dConfig ['layout']['connectheader'] = array('url' => 'connectheader.html');
$dConfig ['layout']['ajaxformheader'] = array('url' => 'ajaxformheader.html');
$dConfig ['layout']['homefooter'] = array('url' => 'homefooter.html');
$dConfig ['layout']['connectfooter'] = array('url' => 'connectfooter.html');
$dConfig ['layout']['ajaxformfooter'] = array('url' => 'ajaxformfooter.html');
//
$dConfig ['layout']['menu'] = array('url' => 'menu.html');
$dConfig ['layout']['menu_left'] = array('url' => 'menu_left.html');
//-------------------------------------------------------------
//------ Tableau contenant la liste des fichiers de style
$dConfig ['css']['default'] = array('url' => 'default.css');
//-----------------------------------------------
//------- Tableau de la liste des scripts
$dConfig ['js'] = array();
?>