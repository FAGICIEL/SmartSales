<?php

//-------------------------------------------------------------------------------
//
//		Controlleurs principaux
//
//-------------------------------------------------------------------------------	
$dConfig ['controller']['home'] = array('url' => 'cHome.php'); // accueil
$dConfig ['controller']['connect'] = array('url' => 'cConnect.php'); // connexion
$dConfig ['controller']['ajaxform'] = array('url' => 'cAjaxForm.php'); // formulaire en ajax	
//-------------------------------------------------------------------------------
//
//		Controlleurs secondaires
//
//-------------------------------------------------------------------------------
$dConfig ['always'] = array('get:mention', 'get:confident', 'get:contact', 'get:team', 'get:jobs', 'get:apropos'
    , 'get:help', 'get:logout');
$dConfig ['homeAlways'] = array('get:home', 'post:connect');
$dConfig ['connectAlways'] = array('get:home', 'get:logout', 'post:connect', 'get:connect');
//------------------------------------------------------------------------------- 
//---------- HOME s_controller
$dConfig ['s_controller']['home']['home'] = array('permitactions' =>
    array('get:home', 'get:logout', 'post:connect')
    , 'url' => 'eHome.php'); // accueil

$dConfig ['s_controller']['home']['confident'] = array('permitactions' => array()
    , 'url' => 'eConfident.php');
$dConfig ['s_controller']['home']['apropos'] = array('permitactions' => array()
    , 'url' => 'eApropos.php');
$dConfig ['s_controller']['home']['help'] = array('permitactions' => array()
    , 'url' => 'eHelp.php');
$dConfig ['s_controller']['home']['error'] = array('permitactions' =>
    array('get:home')
    , 'url' => 'eError.php');
//-----------------------------------------------------------------------
//---------- CONNECT s_controller
//------------------------------------------------------------------------
$dConfig ['s_controller']['connect']['home'] = array('permitactions' =>
    array()
    , 'url' => 'eConnect.php');

//--------------------------------------------------------------------------------
//------------------ AJAX CONTROLLER
$dConfig ['s_controller']['connect']['mention'] = array('permitactions' => array()
    , 'url' => 'eMention.php');
$dConfig ['s_controller']['connect']['confident'] = array('permitactions' => array()
    , 'url' => 'eConfident.php');
$dConfig ['s_controller']['connect']['contact'] = array('permitactions' => array()
    , 'url' => 'eContact.php');
$dConfig ['s_controller']['connect']['team'] = array('permitactions' => array()
    , 'url' => 'eTeam.php');
$dConfig ['s_controller']['connect']['jobs'] = array('permitactions' => array()
    , 'url' => 'eJobs.php');
$dConfig ['s_controller']['connect']['apropos'] = array('permitactions' => array()
    , 'url' => 'eApropos.php');
$dConfig ['s_controller']['connect']['help'] = array('permitactions' => array()
    , 'url' => 'eHelp.php');
$dConfig ['s_controller']['connect']['error'] = array('permitactions' => array()
    , 'url' => 'eError.php');
?>